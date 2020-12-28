

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        
        @if(session()->has('alert-type'))
        <div class="alert {{session()->get('alert-type')}}">
        {{session()->get('alert')}}
        </div>
        @endif
        
            <div class="card">
                <div class="card-header">{{ __('Training Index') }}
                
                <div class="float-right">
                <form method="GET" action="">

                <div class="input-group">
                <input type="text" name="keyword" class="form-control"/>
                <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Search</button>
                </div>
                </div>
                </div>
                </form>

                <div class="card-body">
                <table class="table">
<thead>
<tr>
<th>Bil-id</th>
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
            <a href="{{route('trainings:edit', $training)}}" class="btn btn-success">Edit</a>
            </td>
            <td>
            <a onclick="return confirm('Are you sure want to delete?')" href="{{route('trainings:delete', $training)}}" class="btn btn-danger">Delete</a>
            </td>
            </tr>

    @endforeach
</tbody>

</table>

{{$trainings
->appends(['keyword' =>request()->get('keyword')])
->Links()}}
              
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
