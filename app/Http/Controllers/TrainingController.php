<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;
use File;
use Storage;
use App\Http\Requests\StoreTrainingRequest;
use Mail;
use Notification;
use App\Notifications\DeleteTrainingNotification;
use App\Notifications\CreateTrainingNotification;


class TrainingController extends Controller
{

    public function __construct()
    {

        $this->middleware(['auth','admin']);
        
    }

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
    
     //ni utk paparkan semua
    $trainings = \App\Models\Training::paginate(5);  
   //dd($trainings); //cara nak debug
   
//get current aunthenticate user
//$user=auth()->user(); //ni yg login sja

//get user trainings using relationship with paginate 5
//$trainings = $user->trainings()->paginate();
//paginate susun paling latest add
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

    $user=auth()->user();
    Notification::send($user, new CreateTrainingNotification());

    //Ni pindah masuk ke app->http->requests->StoreTrainingRequest.php
    // $this->validate(
     //   $request,
      //  [
      //      'title'=>'required|min:3',
      //      'description'=>'required|min:5',
      //      'trainer'=>'required',       
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

    //send email to user--day 5 -ni guna biasa tanpa class
   // Mail::send('email.training-created',[   //guna facade ada dot dot . .
     //   'title'=> $training->title,
      //  'description'=>$training->description
     //  ], function( $message){
    //     $message->to('nurulzaihazainal@gmail.com');
    //      $message->subject('training created using inline mail');
   //   });
 
 //send email to user guna mailable class bawa parameter $training utk msk dlm kelas TrainingCreated.php
 //guna ni bg nak kurangkan code dlm controller so buat ia 1 kelas
 //Mail::to('nurulzaihazainal@gmail.com')->send(new \App\Mail\TrainingCreated($training));

 //queue job
 //kena run supervisor "php artisan queue:listen"
 //boleh check kat db table:job
 
 dispatch(new\App\Jobs\SendEmailJob($training));
    
 //return redirect back
    //return redirect()->back();
    return redirect()
    ->route('training:list')
    ->with([
        'alert-type'=>'alert-primary',
        'alert'=> 'Your training has been created!']);
}

//public function show($id){ --msa kat get kena pakai id
//Route::get('/trainings/{id}',[App\Http\Controllers\TrainingController::class,'show'])->name('trainings:show');

public function show(Training $training){
    
    $this->authorize('view',$training);
    
    //find id on table using model
    // $training = Training ::find($id); --jika bw parameter $id kena letak ni
    
    //dd($training);  --check output keluar
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
    //return redirect()->route('training:list');
   return redirect()
    ->route('training:list')
    ->with([
        'alert-type'=>'alert-success',
        'alert'=> 'Your training has been updated!']);

}

public function delete(Training $training){
   
   $user=auth()->user();
   Notification::send($user, new DeleteTrainingNotification());
   
   
    if($training->attachment !=null){
       Storage::disk('public')->delete($training->attachment);
   }
   
    $training->delete();
    
    //return redirect()->route('training:list');
    return redirect()
    ->route('training:list')
    ->with([
        'alert-type'=>'alert-danger',
        'alert'=> 'Your training has been deleted!']);
    
}

public function forceDelete(Training $training){
   
    $user=auth()->user();
    Notification::send($user, new DeleteTrainingNotification());
    
    
     if($training->attachment !=null){
        Storage::disk('public')->delete($training->attachment);
    }
    
     $training->forceDelete();
     
     //return redirect()->route('training:list');
     return redirect()
     ->route('training:list')
     ->with([
         'alert-type'=>'alert-danger',
         'alert'=> 'Your training has been deleted!']);
     
 }


}

