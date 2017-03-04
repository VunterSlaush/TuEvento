<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Propuesta;
use App\Evento;
use App\TipoActividad;
use App\Area;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventoPropuestaController extends Controller
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
        $propuesta = Propuesta::where('id_evento',$id_evento)->get();
        return view('eventoPropuesta.index',['propuesta' => $propuesta,'id_evento' => $id_evento]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_evento)
    {
      $evento = Evento::where('id','=',$id_evento)->first();
      return view('eventoPropuesta.create',['evento' => $evento]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id_evento)
    {

      $this->validate($request,[
        'titulo' => 'required',
        'adjunto' =>  'max:10000',
      ]);

      try{
        DB::beginTransaction();
        $request->merge(['autor' => Auth::id()]);
        $request->merge(['id_evento' => $id_evento]);
        $area_value = $request->input('area');
        $tipo_value = $request->input('tipo');
        $area = Area::where('nombre','=',$area_value)->first();
        $tipo = TipoActividad::where('nombre','=',$tipo_value)->first();
        $request->merge(['id_area' => $area->id]);
        $request->merge(['id_tipo' => $tipo->id]);

        $propuesta = Propuesta::create($request->all());

        if ($request->hasFile('adjunto') && $request->file('adjunto')->isValid()){
            $rel_path='uploads\\'.'evento_'.$id_evento.'\\propuestas';
            $dest = base_path($rel_path);
            $ext = $request->file('adjunto')->getClientOriginalExtension();
            $fileName = 'propuesta_'.$propuesta->id.'.'.$ext;
            $request->file('adjunto')->move($dest,$fileName);

            $propuesta->adjunto =  $rel_path.'\\'.$fileName;
            $propuesta->update();
        }

        DB::commit();
      } catch (\Illuminate\Database\QueryException $qe) {
        DB::rollBack();
        return redirect()->back()->withInput()->withErrors(['Error al crear propuesta'.$qe]);
      }

      return redirect()->route('evento.propuesta.index',['id_evento' => $id_evento])
              ->with('success','propuesta creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_evento,$id_propuesta)
    {
      if(Auth::guest())
      {
        return redirect('/');
      }
      else
      {
        $propuesta = Propuesta::find($id_propuesta);
        return view('eventoPropuesta.show',['propuesta' => $propuesta,'id_evento'=> $id_evento]);
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_evento,$id_propuesta)
    {
      $propuesta = Propuesta::find($id_propuesta);
      return view('eventoPropuesta.edit',['propuesta' => $propuesta,'id_evento'=> $id_evento]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_evento,$id_propuesta)
    {
      try{
        DB::beginTransaction();
        Propuesta::find($id_propuesta)->update($request->all());
        DB::commit();
      } catch (\Illuminate\Database\QueryException $qe) {
        DB::rollBack();
        return redirect()->back()->withErrors(['Error al editar propuesta ']);
      }

      return redirect()->route('evento.propuesta.index',['id_evento' => $id_evento])
              ->with('success','propuesta editada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_evento,$id_propuesta)
    {
      Propuesta::find($id_propuesta)->delete();

      return redirect()->route('evento.propuesta.index',['id_evento' => $id_evento])
              ->with('success','propuesta eliminada');
    }
}
