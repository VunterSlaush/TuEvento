<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evento;
use App\Area;
use App\AreaEvento;
use App\TipoActividad;
use App\TipoActividadEvento;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evento = Evento::all();
        return view('evento.index',['evento' => $evento]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('evento.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request,[
        'nombre' =>  'required',
        'fecha_inicio' =>  'required',
        'fecha_fin' =>  'required',
        'image' =>  'max:10000|image'
      ]);

      try {
        $request->merge(['creador' => Auth::id()]);
        $request->merge(['estado' => 'inscripciones']);


        $nuevoEvento = Evento::create($request->all());

        $areas = $request->input('area');
        foreach ($areas as $a)
        {
          $area = Area::where('nombre', '=', $a)->first();
          if ($area === null) {
            $area = new Area(['nombre' => $a]);
            $area->save();
          }

          $area_evento = new AreaEvento(['id_area' => $area->id,
                                         'id_evento' => $nuevoEvento->id]);
          $area_evento->save();
        }

        $tipos = $request->input('tipo');
        $tipos_cantidad = $request->input('tipo_cantidad');
        $tipos_evaluable = $request->input('tipo_evaluable');
        foreach ($tipos as $key => $value)
        {
          $tipo = TipoActividad::where('nombre', '=', $value)->first();
          if ($tipo === null) {
            $tipo = new TipoActividad(['nombre' => $value]);
            $tipo->save();
          }
          if($tipos_evaluable != null)
            $evaluable = array_key_exists ($key, $tipos_evaluable);
          else
            $evaluable = false;

          $tipo_evento = new TipoActividadEvento(['id_tipo' => $tipo->id,
                                                  'id_evento' => $nuevoEvento->id,
                                                  'cant_maxima'=> $tipos_cantidad[$key],
                                                  'evaluable' => $evaluable ]);
          $tipo_evento->save();
        }

        if ($request->hasFile('image') && $request->file('image')->isValid()){
            $rel_path='uploads\\'.'evento_'.$nuevoEvento->id;
            $dest = base_path($rel_path);
            $ext = $request->file('image')->getClientOriginalExtension();
            $fileName = 'imagen.'.$ext;
            $request->file('image')->move($dest,$fileName);

            $nuevoEvento->imagen =  $rel_path.'\\'.$fileName;
            $nuevoEvento->update();
        }

      } catch (\Illuminate\Database\QueryException $qe) {
        return redirect()->back()->withErrors(['Error al crear evento verifica los datos proporcionados:'+$qe->getSql()]);
      }

      return redirect()->route('evento.show',$nuevoEvento->id)
              ->with('message','evento editado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $evento = Evento::find($id);
      return view('evento.show',['evento' => $evento]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $evento = Evento::find($id);
      return view('evento.edit',['evento' => $evento]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      try{
        $this->validate($request,[
          'nombre' =>  'required',
          'fecha_inicio' =>  'required',
          'fecha_fin' =>  'required',
          'cant_max_actividades' =>  'required|numeric',
          'punt_min_aprobatorio' =>  'required|numeric', //50%
        ]);

        Evento::find($id)->update($request->all());

      } catch (\Illuminate\Database\QueryException $qe) {
        return redirect()->back()->withErrors(['Error al editar evento verifica los datos proporcionados']);
      }

      return redirect()->route('evento.index')
              ->with('message','evento editado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $evento = Evento::find($id);
      $evento->delete();
      return redirect()->route('evento.index')
              ->with('message','evento eliminado');
    }

    public function mis_eventos()
    {
        $evento = Evento::where('creador',Auth::id())->get();
        return view('evento.index',['evento' => $evento]);
    }
}
