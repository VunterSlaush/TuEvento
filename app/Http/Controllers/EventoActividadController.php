<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actividad;
use App\Evento;
use App\Area;
use App\User;
use App\AreaActividad;
use App\TipoActividad;
use App\TipoActividadActividad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

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
        $evento = Evento::find($id_evento);
        $usuarios = User::all();
        $actividades = Actividad::where('id_evento',$id_evento)->get();
        return view('eventoActividad.create',['evento' => $evento,
                                              'usuarios' => $usuarios,
                                              'actividad' => $actividades,]);
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
        'fecha' =>  'after:today',
        'titulo' =>  'required',
        'hora_fin' => 'after:hora_inicio'
      ]);

      try {
        DB::beginTransaction();
        $request->merge(['id_evento' => $id_evento]);
        $tipo_value = $request->input('tipo_actividad');

        if ($tipo_value == "") {
          return redirect()->back()->withInput()->withErrors(['Por favor ingrese un Tipo']);
        }

        $tipo = TipoActividad::where('nombre','=',$tipo_value)->first();
        $request->merge(['tipo' => $tipo->id]);

        $request->merge(['id_user' => $request->input('id_user')]);
        $hora_inicio = $request->input('hora_inicio');
        $hora_fin = $request->input('hora_fin');
        $fecha = $request->input('fecha');

        if ($hora_inicio == "" && $hora_fin == "" && $fecha == ""){
          $nueva_actividad = Actividad::create($request->except('hora_inicio','hora_fin','fecha'));
        } else{
          if ( $hora_inicio != "" && $hora_fin != "" && $fecha != ""){
              $nueva_actividad = Actividad::create($request->all());
          }else{
            return redirect()->back()->withInput()->withErrors(['Por favor complete Hora de Inicio, Hora de fin y Fecha o deje todos los campos en blanco']);
          }
        }

        $area_value = $request->input('area');

        if ($area_value == "") {
          return redirect()->withInput()->back()->withErrors(['Por favor ingrese un area']);
        }

        $area = Area::where('nombre','=',$area_value)->first();

        $request->merge(['id_area' => $area->id]);


        $area_actividad = new AreaActividad(['id_area' => $area->id,
                                       'id_actividad' => $nueva_actividad->id]);
        $area_actividad->save();

        $nombre_evento = Evento::where('id',$id_evento)->first()->nombre;

        DB::commit();

      } catch (\Illuminate\Database\QueryException $qe) {
        DB::rollBack();
        return redirect()->back()->withInput()->withErrors(['Error al crear actividad verifica los datos proporcionados']);
      }

      $nombre_evento = Evento::where('id',$id_evento)->first()->nombre;
      return view('eventoActividad.show',['actividad' => $nueva_actividad,'id_evento'=> $id_evento,'nombre_evento' => $nombre_evento])->with('message','Actividad creada');

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
      $evento = Evento::find($id_evento);
      return view('eventoActividad.edit',['actividad' => $actividad,'evento' => $evento]);
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

      try{
        Actividad::find($id_actividad)->update($request->all());
        $actividad = Actividad::find($id_actividad);
        $evento = Evento::where('id','=',$id_evento)->first();
      } catch (\Illuminate\Database\QueryException $qe) {
        return redirect()->back()->withErrors(['Error al editar Actividad']);
      }

      return redirect()->route('evento.actividad.show',['actividad' => $actividad,'evento' => $evento])
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
