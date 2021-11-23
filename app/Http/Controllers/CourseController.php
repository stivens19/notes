<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    

    public function index()
    {
        $courses=DB::table('courses')->get();
        return view('courses.index',compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=request()->validate([
            'nombre'=>'required'
        ]);

        Course::create(['nombre' => $data['nombre']]);
        return redirect()->route('courses.index')->withSuccess('El curso fue registrado correctamente !!!');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('courses.edit',compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $data=request()->validate([
            'nombre'=>'required'
        ]);

        $course->update([
            'nombre'=>$data['nombre']
        ]);

        return redirect()->route('courses.index')->withSuccess('El curso fue actualizado correctamente !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
