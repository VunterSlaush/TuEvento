<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Califica;
use App\Propuesta;
use App\Comite;

class CalificaController extends Controller
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
    	return view('califica.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function calificada()
    {

    	$califica = Califica::where('cedula','=',Auth::id())->get();

    	$propuestas= array();

    	foreach ($califica as $key => $calific) {

    		$propuesta = Propuesta::find($calific->idPropuesta);
    		array_push($propuestas,$propuesta);

    	}

    	return view('califica.calificada',compact('califica','propuestas'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function porcalificar()
    {

    	$soycomite = Comite::where('cedula','=',Auth::id())->get();

    	$propuestasvec = array();

    	foreach ($soycomite as $key => $comite) {

    		$propuestas = Propuesta::where('idEvento','=',$comite->idEvento)->get();

    		foreach ($propuestas as $key => $propuesta) {

    			$califica = Califica::where('idPropuesta','=',$propuesta->id)->get();

    			if($califica->isEmpty()){

    				array_push($propuestasvec,$propuesta);
    			}

    		}

    	}

    	return view('califica.pendiente',compact('propuestasvec'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('califica.create');
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
          'calificacion' =>  'required'
        ]);

        $request->merge(['cedula' => Auth::id()]);

        Califica::create($request->all());

      return redirect()->route('califica.porcalificar')
              ->with('success', 'Propuesta calificada!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $califica = Califica::find($id);

        $propuesta = Propuesta::find($califica ->idPropuesta);

        return view('califica.show',compact('califica','propuesta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $califica = Califica::where('idPropuesta','=', $id)->first();
        return view('califica.edit',['califica' => $califica]);
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
        'calificacion' =>  'required'
      ]);

      Califica::find($id)->update($request->all());

      return redirect()->route('califica.calificada')
              ->with('success','calificacion editada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Califica::find($id)->delete();

      return redirect()->route('califica.calificada')
              ->with('success','calificacion eliminada');
    }


}
