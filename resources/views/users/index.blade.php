<h1> hai Nurul Zaiha!! </h1>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
<table class="table">
<thead>
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Created at</th>
</tr>
</thead>
<tbody>
@foreach($users as $user)
               
               <tr>
               <td>{{$user->id}}</td>
               <td>{{$user->name}}</td>
               <td>{{$user->email}}</td>
               <td>{{$user->created_at ? $user-> created_at->diffForHumans():'No data'}}</td>
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
