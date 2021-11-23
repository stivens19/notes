<?php

namespace App\Http\Controllers;

use App\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estudiantes=Estudiante::select('id','nombre','apellido','dni','direccion')->get();
        return view('estudiantes.index',compact('estudiantes'));
    }

    public function store(Request $request)
    {
        $data=$request->validate([
            'nombre'=>'required',
            'apellido'=>'required',
            'dni'=>'required|unique:estudiantes,dni',
        ]);
        $estudiante=new Estudiante();
        $estudiante->nombre=$data['nombre'];
        $estudiante->apellido=$data['apellido'];
        $estudiante->dni=$data['dni'];
        if($request->direccion){
            $estudiante->direccion=$request->direccion;
        }
        $estudiante->save();
        return redirect()->route('estudiantes.index')->withSuccess('Estudiante creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function show(Estudiante $estudiante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function edit(Estudiante $estudiante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estudiante $estudiante)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estudiante $estudiante)
    {
        //
    }
}
