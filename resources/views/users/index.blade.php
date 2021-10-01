@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
<h1 class="mt-4">Dashboard User</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">User List</li>
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
