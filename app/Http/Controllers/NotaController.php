<?php

namespace App\Http\Controllers;

use App\Estudiante;
use App\Nota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('notas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cursos=DB::table('courses')->get([
            'id',
            'nombre'
        ]);
        $periodos=DB::table('periodos')->get([
            'id',
            'anio'
        ]);
        $grados=DB::table('grados')->get([
            'id',
            'slug'
        ]);
        $estudiantes=DB::table('estudiantes')->get(['id','nombre','dni']);
        return view('notas.create',compact('cursos','estudiantes','periodos','grados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          
        try {
            DB::beginTransaction();
    	
    		$notas=json_decode($request->notas);

            foreach ($notas as $nota) {
                $note=new Nota();
                $note->estudiante_id=$nota->estudiante_id;
                $note->periodo_id=$nota->periodo_id;
                $note->grado_id=$nota->grado_id;
                $note->course_id=$nota->curso_id;
                $note->promedio=$nota->promedio;
                $note->grado=$nota->grado;
                $note->save();
                
            }

    		DB::commit();
            return response()->json([
                'success'=>true,
                'message'=>'Compra creada con exito'
            ]);
            
    	} catch (\Exception $e) {
            DB::rollBack();
    		return response()->json([
                'success'=>false,
                'message'=>$e->getMessage()
            ]);
            
    	}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estudiante=Estudiante::findOrfail($id);
        return view('notas.show',compact('estudiante'));
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
    public function destroy($id)
    {
        //
    }
}
