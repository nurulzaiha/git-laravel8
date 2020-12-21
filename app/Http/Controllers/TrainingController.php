<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;

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
public function create(){

    //resources/views/trainings/create.blade.php
    return view('trainings.create');
}

public function store(Request $request){
    
    //store all data from form to training table
    //dd($request->all());
    //method 1 - POPO - Plain Old PHP Object
    $training = new Training();
    $training->title = $request->title;
    $training->description= $request-> description;
    $training->trainer= $request-> trainer;
    $training->user_id= auth()->user()->id;
    $training->save();

    //return redirect back
    return redirect()->back();
}

public function show($id){
    //find id on table using model
    $training = Training ::find($id);
//dd($training);
    //return to view
    return view('trainings.show', compact('training'));
}

public function edit($id){
    //find id
    $training = Training ::find($id);

    //return to view
    return view('trainings.edit', compact('training'));
}
//public function update($id,Request $request){ -- ni asal xinstatiate
//public function update(training $training,Request $request){ --find dah instatiate
    // $training = Training ::find($id); --xpyh dah ltk kalo dah instatiate
public function update($id,Request $request){
    //find id at table
    $training = Training ::find($id);

    //update training
    //method 1-popo(xguna ni)
    //method 2-mass assignment (so guna ni)-define fillable input property kat model
    //$training ->update($request->all()); --ni utk update semua
    $training ->update($request->only('title','description','trainer'));

    //return to training
    return redirect()->route('training:list');
}

public function delete(Training $training){
    $training->delete();
    return redirect()->route('training:list');
}
}

