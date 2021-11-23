<?php

namespace App\Http\Controllers;

use App\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatatableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function notas()
    {
        $estudiantes=Estudiante::select(['id','nombre','apellido','dni'])->get();
        return datatables()->of($estudiantes)->addIndexColumn()
        ->addColumn('action', function($row){
            $btn = '<a href="/notas/'.$row->id.'" class="btn btn-success"><i class="fas fa-eye"></i></a>';
             return $btn;
        })
        ->addColumn('nombre_completo', function($row){
            return $row->nombre.' '.$row->apellido;
        })
        ->rawColumns(['action','nombre_completo'])
        ->make(true);
    }
    public function certificado($id)
    {
        $estudiante=Estudiante::findOrfail($id)->with(['cursos'=>function($query){
            $query->groupBy('id')->with('notas.periodo','notas.gradoo');
        }])->get();

        return response()->json($estudiante);
    }
   
}
