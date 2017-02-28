<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evento;
use App\Jurado;
use App\Area;
use App\AreaJurado;
use App\User;

class EventoJuradoController extends Controller
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
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create($id_evento)
  {
      $evento = Evento::where('id','=',$id_evento)->first();
      return view('eventoJurado.create',['evento' => $evento]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request,$id_evento)
  {
    try{
      $evento = Evento::where('id','=',$id_evento)->first();
      $request->merge(['id_evento' => $id_evento]);
      $area_value = $request->input('area');
      $id_user = $request->input('id_user');
      $user = User::where('cedula','=',$id_user)->first();
      $area = Area::where('nombre','=',$area_value)->first();
      $jurado = Jurado::where('id_user','=',$id_user)->where('id_evento','=',$id_evento)->first();
      if($jurado == null)
      {
          $jurado = Jurado::create(['id_user' =>$id_user,'id_evento' => $id_evento]);
      }
      $areaJurado = new AreaJurado(['id_area' => $area->id,
                                  'id_jurado' => $jurado->id]);
      $areaJurado->save();
    }
    catch (\Illuminate\Database\QueryException $qe)
    {
        return json_encode(['success'=>false,'msg' => 'Error al añadir jurado']);
    }
    return json_encode(['success'=>true,'jurado'=>$jurado, 'area' => $area, 'user' => $user]);
  }


  public function deleteAreaJurado(Request $request)
  {
    $areaId = $request->input('id_area');
    $juradoId = $request->input('id_jurado');
    $result = AreaJurado::where('id_area',$areaId)->where('id_jurado',$juradoId)->delete();
    if(AreaJurado::where('id_jurado',$juradoId)->count() == 0)
      Jurado::where('id',$juradoId)->delete();

    return json_encode(['success'=>true, 'result'=> $result]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */


  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */


  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id_evento,$id)
  {
    Jurado::find($id)->delete();

    return redirect()->route('evento.comite.index',['id_evento' => $id_evento])
            ->with('success','comite eliminada');
  }
}
