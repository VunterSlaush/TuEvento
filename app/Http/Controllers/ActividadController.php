<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actividad;
use App\Asiste;
use App\Propuesta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $actividad = Actividad::all();
      return view('actividad.index',['actividad' => $actividad]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('actividad.create');
    }

    public function createFromPropuesta($id){
      $propuesta = Propuesta::find($id);

      Actividad::create([
        'ponente' => $propuesta->autor,
        'id_evento' => $propuesta->id_evento,
        'fecha' => "2017-01-20",
        'titulo' => $propuesta->titulo,
        'hora_inicio' => "2017-01-20 00:00:00",
        'hora_fin' => "2017-01-20 00:00:00",
        'resumen' => $propuesta->descripcion
      ]);

      //Esto es para pruebas, en realidad no te deberia retorna al index de las actividades.
      return redirect()->route('actividad.index')
              ->with('success','actividad creado');
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
        'id' =>  'required',
        'ponente' =>  'required',
        'evento' =>  'required',
        'fecha' =>  'required',
        'titulo' =>  'required'
      ]);

        Actividad::create($request->all());

        return redirect()->route('actividad.index')
                ->with('success','actividad creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $actividad = Actividad::find($id);
      return view('actividad.show',['actividad' => $actividad]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $actividad = Actividad::find($id);
      return view('actividad.edit',['actividad' => $actividad]);
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
        $this->validate($request,[
          'ponente' =>  'required',
          'fecha' =>  'required',
          'titulo' =>  'required'
        ]);

        Actividad::find($id)->update($request->all());

        return redirect()->route('actividad.index')
                ->with('success','actividad editada');
    }

    public function verificarAsistencia($id)
    {
      if(Auth::guest())
      {
        return redirect('/login');
      }
      else
      {
        return view('actividad.verificar_asistencia',['id_actividad' => $id]);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Actividad::find($id)->delete();

      return redirect()->route('actividad.index')
              ->with('success','actividad eliminada');
    }

    public function mis_actividades()
    {
        $actividad = Actividad::where('id_user',Auth::id())->get();
        return view('actividad.index',['actividad' => $actividad]);
    }

    public function asistir($id)
    {
        $asiste = new Asiste;
        $asiste->id_actividad = $id;
        $asiste->cedula = Auth::id();
        $asiste->codigo = $this->generateRandomString(8);
        $asiste->asistio = false;
        $asiste->save();
        return redirect('/miHorario');
    }

    function generateRandomString($length = 10)
    {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
    }

}
