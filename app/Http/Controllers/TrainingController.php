<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index(){
        // query training
       $trainings = \App\Models\Training::all();
   // dd($trainings); //cara nak debug

    
    //return to view 
    //resources/views/trainings/index.blade.php
    //return view('trainings.index');
    return view('trainings.index',compact('trainings'));
}
}

