<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actividad;
use App\Evento;
use App\Area;
use App\AreaActividad;
use App\TipoActividad;
use App\TipoActividadActividad;
use Illuminate\Support\Facades\Auth;

class EventoActividadController extends Controller
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
    public function index($id_evento)
    {
      if(Auth::guest())
      {
        return redirect('/');
      }
      else
      {
        $actividad = Actividad::where('id_evento',$id_evento)->get();
        $nombre_evento = Evento::where('id',$id_evento)->first()->nombre;
        return view('eventoActividad.index',['actividad' => $actividad,'id_evento' => $id_evento, 'nombre_evento' => $nombre_evento]);
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_evento)
    {
        $evento = Evento::where('id','=',$id_evento)->first();
        $nombre_evento = Evento::where('id',$id_evento)->first()->nombre;
        return view('eventoActividad.create',['evento' => $evento,'nombre_evento' => $nombre_evento]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id_evento)
    {
      $this->validate($request,[
        'fecha' =>  'required',
        'titulo' =>  'required'
      ]);

      try{
        $request->merge(['id_evento' => $id_evento]);
        $tipo_value = $request->input('tipo_actividad');
        $tipo = TipoActividad::where('nombre','=',$tipo_value)->first();
        $request->merge(['tipo' => $tipo->id]);

        $nueva_actividad = Actividad::create($request->all());

        $area_value = $request->input('area');

        $area = Area::where('nombre','=',$area_value)->first();

        $request->merge(['id_area' => $area->id]);


        $area_actividad = new AreaActividad(['id_area' => $area->id,
                                       'id_actividad' => $nueva_actividad->id]);
        $area_actividad->save();

        $nombre_evento = Evento::where('id',$id_evento)->first()->nombre;
      } catch (\Illuminate\Database\QueryException $qe) {
        return redirect()->back()->withErrors(['Error al crear actividad']);
      }

      return redirect()->route('evento.actividad.show',['id_evento' => $id_evento,'nombre_evento' => $nombre_evento,'actividad' => $nueva_actividad])
              ->with('success','actividad creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_evento,$id)
    {
      if(Auth::guest())
      {
        return redirect('/');
      }
      else
      {

        $nombre_evento = Evento::where('id',$id_evento)->first()->nombre;
        $actividad = Actividad::find($id);
        return view('eventoActividad.show',['actividad' => $actividad,'id_evento'=> $id_evento,'nombre_evento' => $nombre_evento]);
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_evento,$id_actvidad)
    {
      $actividad = Actividad::find($id_actvidad);
      $evento = Evento::where('id','=',$id_evento)->first();
      $nombre_evento = Evento::where('id',$id_evento)->first()->nombre;
      return view('eventoActividad.edit',['actividad' => $actividad,'id_evento'=> $id_evento,'nombre_evento' => $nombre_evento,'evento' => $evento]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_evento,$id_actividad)
    {

      Actividad::find($id_actividad)->update($request->all());
      try{
        $actividad = Actividad::find($id_actividad);
        $nombre_evento = Evento::where('id',$id_evento)->first()->nombre;
        $evento = Evento::where('id','=',$id_evento)->first();
      } catch (\Illuminate\Database\QueryException $qe) {
        return redirect()->back()->withErrors(['Error al editar Actividad']);
      }

      return redirect()->route('evento.actividad.show',['id_evento' => $id_evento,'nombre_evento' => $nombre_evento,'actividad' => $actividad])
              ->with('success','actividad creada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
