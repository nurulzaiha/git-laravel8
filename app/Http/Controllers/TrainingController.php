<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;
use File;
use Storage;
use App\Http\Requests\StoreTrainingRequest;

class TrainingController extends Controller
{
    public function index(Request $request){

        if($request->keyword){
            $search = $request->keyword;
          
            //$trainings = Training::where('title','LIKE','%'.$search.'%')->paginate(5);
         
            // $trainings = Training::where('title','LIKE','%'.$search.'%')
            //->orWhere('description','LIKE','%'.$search.'%')
            //->paginate(1);

            $trainings = auth()->user()->trainings()->where('title','LIKE','%'.$search.'%')
            ->orWhere('description','LIKE','%'.$search.'%')
            ->orderBy('created_at','desc')
            ->paginate(1);


        }else{

        // query training
     //  $trainings = \App\Models\Training::all();//return semua
    
    //   $trainings = \App\Models\Training::paginate(2); --all keluar semua 
   // dd($trainings); //cara nak debug
   //get current aunthenticate user
$user=auth()->user(); //ni yg login sja

//get user trainings using relationship with paginate 5
$trainings = $user->trainings()->paginate(5);
//$trainings = $user->trainings()->latest()->paginate(2);
}
    //return to view 
    //resources/views/trainings/index.blade.php
    //return view('trainings.index');
    return view('trainings.index',compact('trainings'));
}
public function create(){

    //resources/views/trainings/create.blade.php
    return view('trainings.create');
}

public function store(StoreTrainingRequest $request){

   // $this->validate(
     //   $request,
      //  [
      //      'title'=>'required|min:3',
      //      'description'=>'required|min:5',
       //     'trainer'=>'required',
            
      //  ]
     //   );
    
    
    //store all data from form to training table
    //dd($request->all());
    //method 1 - POPO - Plain Old PHP Object
    $training = new Training();
    $training->title = $request->title;
    $training->description= $request-> description;
    $training->trainer= $request-> trainer;
    $training->user_id= auth()->user()->id;
    $training->save();

    if($request->hasFile('attachment')){
        //rename file-  10-2020-12-22.jpg
        $filename = $training->id.'-'.date("Y-m-d").'.'.$request->attachment->getClientOriginalExtension();
        //store file on storage
        Storage::disk('public')->put($filename, File::get($request->attachment));
        //update row with filename
        $training->update(['attachment'=>$filename]);
    }

    //return redirect back
    //return redirect()->back();
    return redirect()
    ->route('training:list')
    ->with([
        'alert-type'=>'alert-primary',
        'alert'=> 'Your training has been created!']);
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
   // return redirect()->route('training:list');
   return redirect()
    ->route('training:list')
    ->with([
        'alert-type'=>'alert-success',
        'alert'=> 'Your training has been updated!']);

}

public function delete(Training $training){
   if($training->attachment !=null){
       Storage::disk('public')->delete($training->attachement);
   }
   
    $training->delete();
    //return redirect()->route('training:list');
    return redirect()
    ->route('training:list')
    ->with([
        'alert-type'=>'alert-danger',
        'alert'=> 'Your training has been deleted!']);
    
}
}

