<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Presentador;
use App\Actividad;
use App\User;
use App\Asiste;
use Illuminate\Support\Facades\DB;

class ActividadPresentadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_actividad)
    {
      $actividad = Actividad::find($id_actividad);
      return view('actividadPresentador.create',['actividad' => $actividad]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id_actividad)
    {
      DB::beginTransaction();

      try {
        $actividad = Actividad::where('id','=',$id_actividad)->first();

        $request->merge(['id_actividad' => $id_actividad]);
        $presentador = Presentador::create($request->all());
        $user = User::where('cedula',$presentador->id_user)->first();
        $this->createAsistencia($id_actividad,$user->cedula);
        DB::commit();

        return json_encode(["success" => true, "presentador" => $presentador, "user" => $user]);

      }
      catch (Exception $e)
      {
        DB::rollBack();
        return json_encode(["success" => false, "msg" => 'Error al Agregar Presentador']);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_actividad,$id)
    {
        Presentador::where('id',$id)->delete();
        return json_encode(['success' => true]);
    }
}
