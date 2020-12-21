<h1> hai trainings </h1>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                <table class="table">
<thead>
<tr>
<th>ID</th>
<th>Title</th>
<th>Description</th>
<th>User ID</th>
<th>User</th>
<th>Email</th>
<th>Created at</th>
<th>Actions</th>

</tr>
</thead>
<tbody>
    @foreach($trainings as $training)
               
            <tr>
            <td>{{$training->id}}</td>
            <td>{{$training->title}}</td>
            <td>{{$training->description}}</td>
            <td>{{$training->user_id}}</td>
            <td>{{$training->user->name}}</td>
            <td><strong>{{$training->user->email}}</strong></td>
            <td>{{$training->created_at ? $training-> created_at->diffForHumans():'No data'}}</td>
            <td>
            <a href="{{route('trainings:show', $training)}}" class="btn btn-primary">View</a>
            </td>
            <td>
            <a href="{{route('trainings:edit', $training)}}" class="btn btn-primary">Edit</a>
            </td>
            </tr>

    @endforeach
</tbody>
</table>
               
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
