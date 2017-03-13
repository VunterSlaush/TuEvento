<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evento;
use App\Area;
use App\Asiste;
use App\AreaEvento;
use App\TipoActividad;
use App\Actividad;
use App\Propuesta;
use App\TipoActividadEvento;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
      $evento = Evento::where('creador',Auth::id())->get();
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
        'fecha_inicio' =>  'required|date|after:today',
        'fecha_fin' =>  'required|date|after:fecha_inicio',
        'image' =>  'max:10000|image'
      ]);

      try {
        DB::beginTransaction();

        $request->merge(['creador' => Auth::id()]);
        $request->merge(['estado' => 'inscripciones']);

        $nuevoEvento = Evento::create($request->all());

        $areas = $request->input('area');
        $tipos = $request->input('tipo');

        if($areas == null || $tipos == null || count($areas) == 0 || count($tipos) == 0)
        {
          return view('evento.create')->withErrors(['Error al crear evento verifica los datos proporcionados']);
        }

        foreach ($areas as $key => $a)
        {
          $a = strtolower($a);
          $area = Area::where('nombre', '=', $a)->first();

          if ($area === null) {
            $area = new Area(['nombre' => $a]);
            $area->save();
          }

          $area_evento = new AreaEvento(['id_area' => $area->id,
                                         'id_evento' => $nuevoEvento->id]);
          $area_evento->save();
        }


        $tipos_cantidad = $request->input('tipo_cantidad');
        $tipos_evaluable = $request->input('tipo_evaluable');
        foreach ($tipos as $key => $value)
        {
          $value = strtolower($value);
          $tipo = TipoActividad::where('nombre', '=', $value)->first();
          if ($tipo === null) {
            $tipo = new TipoActividad(['nombre' => $value]);
            $tipo->save();
          }
          if($tipos_evaluable != null)
            $evaluable = $tipos_evaluable[$key];

          $tipo_evento = new TipoActividadEvento(['id_tipo' => $tipo->id,
                                                  'id_evento' => $nuevoEvento->id,
                                                  'cant_maxima'=> $tipos_cantidad[$key],
                                                  'evaluable' => $evaluable ]);
          $tipo_evento->save();
        }

        if ($request->hasFile('image') && $request->file('image')->isValid()){

            $rel_path='public\\uploads\\'.'evento_'.$nuevoEvento->id;
            $path_save='/uploads/'.'evento_'.$nuevoEvento->id;
            $dest = base_path($rel_path);
            $ext = $request->file('image')->getClientOriginalExtension();
            $fileName = 'imagen.'.$ext;
            $request->file('image')->move($dest,$fileName);
            //
            $nuevoEvento->imagen =  $path_save.'/'.$fileName;
            ///$nuevoEvento->imagen =  $request->file('image')->storeAs('evento_'.$nuevoEvento->id,'imagen.'.$ext,'public');
            $nuevoEvento->save();
        }

        DB::commit();

      } catch (\Exception $qe) {
        DB::rollBack();
        return view('evento.create')->withErrors(['Error al crear evento verifica los datos proporcionados']);
      }

      return redirect()->route('evento.show',$nuevoEvento->id)
              ->with('message','evento creado');
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
      $img = Storage::url($evento->imagen);
      return view('evento.edit',['evento' => $evento,'img_path' => $img]);
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
          'nombre' =>  'required',
          'fecha_inicio' =>  'required|date|after:today',
          'fecha_fin' =>  'required|date|after:fecha_inicio',
          'image' =>  'max:10000|image'
        ]);

        try {
          DB::beginTransaction();
          Evento::find($id)->update($request->all());
          $updatedEvento = Evento::find($id);
          $areas = $request->input('area');
          $tipos = $request->input('tipo');
          $area_id = $request->input('area_id');

          foreach ($areas as $key => $a)
          {
            $a = strtolower($a);
            $area = Area::where('nombre', '=', $a)->first();

            if ($area === null) {
                $area = new Area(['nombre' => $a]);
                $area->save();
            }

            $area_evento = AreaEvento::where('id_area', '=', $area->id)->first();

            if ($area_evento === null){
            $area_evento = new AreaEvento(['id_area' => $area->id,
                                           'id_evento' => $updatedEvento->id]);
            $area_evento->save();

            }
          }


          $tipos_cantidad = $request->input('tipo_cantidad');
          $tipos_evaluable = $request->input('tipo_evaluable');
          foreach ($tipos as $key => $value)
          {
            $value = strtolower($value);
            $tipo = TipoActividad::where('nombre', '=', $value)->first();
            if ($tipo === null) {
              $tipo = new TipoActividad(['nombre' => $value]);
              $tipo->save();
            }

            $tipo_evento = TipoActividadEvento::where('id_tipo', '=', $tipo->id)->first();
            if ($tipo_evento === null) {

              $evaluable = $tipos_evaluable[$key];

              $tipo_evento = new TipoActividadEvento(['id_tipo' => $tipo->id,
                                                      'id_evento' => $updatedEvento->id,
                                                      'cant_maxima'=> $tipos_cantidad[$key],
                                                      'evaluable' => $evaluable ]);
              Log::info("tipo evento".$tipo_evento);
              $tipo_evento->save();
            }
          }

          DB::commit();

        } catch (\Exception $qe) {
          DB::rollBack();
          return redirect()->back()->withErrors(['Error al crear evento verifica los datos proporcionados']);
        }

        return redirect()->route('evento.show',$updatedEvento->id)
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
      return json_encode(["success" => true]);
    }

    public function mis_eventos()
    {
        $evento = Evento::where('creador',Auth::id())->get();
        return view('evento.index',['evento' => $evento]);
    }

    public function organizar($id){
      $evento = Evento::find($id);
      $collection = collect ($evento->actividades);
      $actividades = $collection->sortBy(function ($col){
        return strtotime($col->fecha) + strtotime($col->hora_inicio);
      })->values()->all();
      return view('evento.organizar',['evento' => $evento, 'actividades' => $actividades]);
    }

    public function stateUpdate(Request $request)
    {
      $evento = json_decode($request->evento,true);

      try
      {
        $eventoToUpdate  = Evento::find($evento["id"]);
        $eventoToUpdate->update($evento);
      }
      catch (\Exception $qe)
      {
        return json_encode(['success'=>'false']);
      }
      return json_encode(['success'=>'true']);
    }

    public function areaUpdate(Request $request)
    {
      $area = json_decode($request->area,true);

      try{
        $area_exist = Area::where('nombre', '=', $area["nombre"])->first();

        if ($area_exist  === null) {
            $updateArea = Area::find($area["id"])->update($area);
        }else{
          $area_evento=AreaEvento::where('id_area','=',$area["id"])->first();
          $area_evento->id_area = $area_exist->id;
          AreaEvento::find($area_evento->id)->update(['id' => $area_evento->id,'id_area' => $area_evento->id_area]);
        }

      } catch (\Exception $qe) {
        return json_encode(['success'=>'false']);
      }
      return json_encode(['success'=>'true']);
    }

    public function areaDelete(Request $request)
    {
      $area = json_decode($request->area,true);

      try{
        $area_evento=AreaEvento::where('id_area','=',$area["id"])->first();
        $area_evento->delete();

      } catch (\Exception $qe) {
        return json_encode(['success'=>'false']);
      }
      return json_encode(['success'=>'true']);
    }

    public function tipoUpdate(Request $request)
    {
      $tipo = json_decode($request->tipo,true);
      Log::info($tipo);
      try{
        $tipo_exist = TipoActividad::where('nombre', '=', $tipo["nombre"])->first();

        if ($tipo_exist  === null) {
            $tipoUpdate = TipoActividad::find($tipo["id"]);
            $tipoUpdate->nombre = $tipo["nombre"];
            $tipoUpdate->save();

            $tipoEventoUpdate = TipoActividadEvento::where('id_tipo','=',$tipo["id"])->first();
            $tipoEventoUpdate->cant_maxima = $tipo["cant_maxima"];
            $tipoEventoUpdate->evaluable = $tipo["evaluable"];
            $tipoEventoUpdate->save();
        }
        else{
          $tipo_evento=TipoActividadEvento::where('id_tipo','=',$tipo["id"])->first();
          $tipo_evento->id_tipo = $tipo_exist->id;
          $tipo_evento->save();
        }

      } catch (\QueryException $qe) {
        return json_encode(['success'=>'false']);
      }

      return json_encode(['success'=>'true']);
    }

    public function tipoDelete(Request $request)
    {
      $tipo = json_decode($request->tipo,true);
      try{
        $tipo_evento=TipoActividadEvento::where('id_tipo','=',$tipo["id"])->first();
        $tipo_evento->delete();

      } catch (\Exception $qe) {
        return json_encode(['success'=>'false']);
      }
      return json_encode(['success'=>'true']);
    }

    public function convertirPropuestas($evento)
    {
      $tipo_actividades = $this->generarArrayTipoActividades($evento);
      $propuestas = $this->generarArrayPropuestasPromedio($evento);
      $propuestas_pasadas = collect();
      foreach ($propuestas as $key => $value)
      {
        if($this->propuestaApta($value['tipo'],$tipo_actividades))
          $propuestas_pasadas->push($value['propuesta']);
      }
      return $propuestas_pasadas;

    }

    private function propuestaApta($propuesta,$tipos)
    {
      foreach ($tipos as $key => $value)
      {
        if($value['nombre'] == $propuesta)
        {
          if($value['actuales'] < $value['cant_max'])
          {
            $aux = $value;
            $aux['actuales']++;
            $tipos->forget($key);
            $tipos->push($aux);
            return true;
          }
        }
      }
      return false;
    }

    public function generarArrayTipoActividades($evento)
    {
      $tipos = collect();
      foreach ($evento->TipoActividad as $key => $value)
      {
        $tipos->push(['nombre' =>$value->tipoActividad->nombre, 'cant_max' => $value->cant_maxima,
                      'actuales' => 0, 'evaluable' => $value->evaluable, 'id' => $value->id_tipo]);
      }
      return $tipos->sortByDesc('evaluable');
    }

    public function conseguirNotaEvalua($evalua)
    {
      $nota = 0;
      foreach ($evalua->respuestas as $key => $value)
      {
        $nota += $value->opcion->valor;
      }
      return $nota;
    }

    public function generarArrayPropuestasPromedio($evento)
    {
      $propuestas = collect();

      foreach($evento->propuestas as $key => $value) {
        if($this->esEvaluable($evento,$value->tipo))
          $propuestas->push($this->generarPropuestaConPromedio($value));
      }
      return $propuestas->sortBy('promedio');
    }

    public function generarPropuestaConPromedio($propuesta)
    {
      $cant_ev = $propuesta->evaluaciones->count();
      $suma = 0;
      foreach ($propuesta->evaluaciones as $key => $value)
      {
        $suma += $this->conseguirNotaEvalua($value);
      }
      if($cant_ev > 0)
        $promedio = $suma / $cant_ev;
      else
        $promedio = 0;
      return ['propuesta' => $propuesta, 'promedio' => $promedio, 'tipo' => $propuesta->tipo->nombre];
    }

    private function esEvaluable($evento, $tipo)
    {
      foreach ($evento->tipoActividad as $key => $value)
      {
        if($value->id_tipo == $tipo->id)
          return $value->evaluable;
      }
      return false;
    }

    public function verListaAprobados($id_evento)
    {
      $evento = Evento::find($id_evento);
      if($evento->estado == 'inscripciones') // Cambiar si se necesita que se aprueben en otro estado!
      {
        $aprobados = $this->convertirPropuestas($evento);
        return view('evento.aprobados',['evento' => $evento, 'aprobados' => $aprobados]);
      }
      else
      {
        return redirect('/evento/'+$evento->id);
      }
    }

    public function reprobar(Request $request)
    {
      DB::beginTransaction();
      try
      {
        $evento = Evento::find($request->input('id_evento'));
        $ids = $request->input('ids');
        foreach ($ids as $key => $value) {
          $this->borrarPropuesta($value);
        }
        DB::commit();
        return json_encode(['success' => true]);
      }
      catch (Exception $e)
      {
        DB::rollBack();
        return json_encode(['success' => false, 'msg' => 'Error al Ejecutar']);
      }
    }

    public function borrarPropuesta($id_propuesta)
    {
      $propuesta = Propuesta::find($id_propuesta);
      $propuesta->delete();
    }

    public function aprobar(Request $request)
    {
      DB::beginTransaction();
      try {
        $evento = Evento::find($request->input('id_evento'));
        $ids = $request->input('ids');
        foreach ($ids as $key => $value) {
          $this->convertirEnActividad($value);
          $this->borrarPropuesta($value);
        }
        DB::commit();

        return json_encode(['success' => true]);
      }
      catch (Exception $e)
      {
        DB::rollBack();
        return json_encode(['success' => false, 'msg' => 'Error al Ejecutar']);
      }
    }

    public function convertirEnActividad($id_propuesta)
    {
      $propuesta = Propuesta::find($id_propuesta);
      $actividad =  Actividad::create([
          'id_user' => $propuesta->autor,
          'id_evento' => $propuesta->id_evento,
          'titulo' => $propuesta->titulo,
          'tipo' => $propuesta->id_tipo,
          'area' => $propuesta->id_area,
          'resumen' => $propuesta->descripcion
        ]);
        $this->createAsistencia($actividad->id,$actividad->id_user);
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
}
