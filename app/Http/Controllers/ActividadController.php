<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actividad;
use App\Asiste;
use App\Propuesta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ActividadController extends Controller
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
      $actividad = Actividad::where('id_user',Auth::id())->get();
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

      try{
        Actividad::create([
          'id_user' => $propuesta->autor,
          'id_evento' => $propuesta->id_evento,
          'titulo' => $propuesta->titulo,
          'tipo' => $propuesta->id_tipo,
          'area' => $propuesta->id_area,
          'resumen' => $propuesta->descripcion
        ]);
        $propuesta->delete();
      } catch (\Exception $qe) {
        return redirect()->back()->withErrors(['Error al Aplicar propuesta']);
      }

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

      try{
        Actividad::create($request->all());
      } catch (\Exception $qe) {
        return redirect()->back()->withErrors(['Error al crear Actividad']);
      }

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
        try{
          Actividad::find($id)->update($request->all());
        } catch (\Exception $qe) {
          return redirect()->back()->withErrors(['Error al editar Actividad']);
        }

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
        $actividad = Actividad::find($id);
        return view('actividad.verificar_asistencia',['actividad' => $actividad]);
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

      //return redirect()->route('actividad.index')->with('success','actividad eliminada');
      return json_encode(["success" => true]);
    }

    public function mis_actividades()
    {
        $actividad = Actividad::where('id_user',Auth::id())->get();
        return view('actividad.index',['actividad' => $actividad]);
    }

    public function asistir($id)
    {
        try
        {
          $this->createAsistencia($id,Auth::id());
          return redirect('/miHorario');
        } catch (\Exception $e) {

          return redirect('/miHorario')->withErrors(['Error al marcar asistencia']);;
        }

    }

    function createAsistencia($id,$cedula)
    {
      $asiste = new Asiste;
      $asiste->id_actividad = $id;
      $asiste->cedula = $cedula;
      $asiste->codigo = $this->generateRandomString(8);
      $asiste->asistio = false;
      $asiste->save();
      return $asiste;
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

    function schedulerUpdate(Request $request){
      $actividad = json_decode($request->actividad,true);
      try{
        Actividad::find($actividad["id"])->update($actividad);
      } catch (\Exception $qe) {
        return json_encode(['success'=>'false']);
      }
      return json_encode(['success'=>'true']);
    }

}
