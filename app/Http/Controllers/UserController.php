<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        
        // query training
       $users = \App\Models\User::all();
        // dd($trainings); //cara nak debug

    
    //return to view 
    //resources/views/trainings/index.blade.php
    //return view('trainings.index');
    return view('users.index',compact('users'));
}
}
