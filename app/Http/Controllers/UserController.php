<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::select('id','name','email','isActive','role')->get();
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name'=>'required',
            'email'=>'required',
            'role'=>'required',
            'password'=>'required|confirmed',
        ]);
        DB::table('users')->insert([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'role'=>$data['role'],
            'password'=>bcrypt($data['password']),
        ]);
        return redirect()->route('users.index')->withSuccess('El usuario fue registrado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->isActive == 'active') {
            $user->update(['isActive' => 'inactive']);
            return response()->json(['type'=>'inactive','status'=>'El usuario fue desactivado correctamente']);
        }else{
            $user->update(['isActive' => 'active']);
            return response()->json(['type'=>'active','status'=>'El usuario fue activado correctamente']);
        }
    }
}
