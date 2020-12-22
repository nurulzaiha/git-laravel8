<h1> hai trainings </h1>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Show Training') }} - By: {{$training->user->name}}</div>

                <div class="card-body">
               
<form method="POST" action="">
@csrf
<div class="form-group">
<label>Title</label>
<input type ="text" name="title" class="form-control" required value="{{$training->title}}" readonly>
</div>

<div class="form-group">
<label>Description</label>
<textarea name="description" class="form-control" readonly>{{$training->description}}</textarea>
</div>

<div class="form-group">
<label>Trainer</label>
<input type ="text" name="trainer" class="form-control" required value="{{$training->trainer}}" readonly>
</div>

@if($training->attachment)

<!-- <a href="{{asset('storage/'.$training->attachment)}}" target="_blank">Open attachment<a> -->

<a href="{{$training->attachment_url}}" target="_blank">Open attachment<a>
@endif

<a href="javascript:history.back()" class="btn btn-primary">Back to Training list</a>
            
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
