<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Propuesta;
use Illuminate\Support\Facades\Auth;

class PropuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $propuesta = Propuesta::all();
      return view('propuesta.index',['propuesta' => $propuesta]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('propuesta.create');
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
          'idEvento' =>  'required'
        ]);

        $request->merge(['autor' => Auth::id()]);

        Propuesta::create($request->all());

        return redirect()->route('propuesta.index')
                ->with('success','propuesta creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $propuesta = Propuesta::find($id);
        return view('propuesta.show',['propuesta' => $propuesta]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $propuesta = Propuesta::find($id);
        return view('propuesta.edit',['propuesta' => $propuesta]);
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
        'idEvento' =>  'required'
      ]);

      Propuesta::find($id)->update($request->all());

      return redirect()->route('propuesta.index')
              ->with('success','propuesta editada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Propuesta::find($id)->delete();

      return redirect()->route('propuesta.index')
              ->with('success','propuesta eliminada');
    }
}
