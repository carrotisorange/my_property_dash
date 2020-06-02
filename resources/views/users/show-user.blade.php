@extends('layouts.app')
@section('title', $user->name)
@section('content')
<div class="container">
   <p class="text-right"><a href="/users/{{ $user->id }}" class="btn btn-primary"><i class="fas fa-user-edit"></i> edit</a>   </button></p>
    
    <table class="table table-bordered">
        <tr>
           <th>name</th>
           <th>email</th>
           <th>user type</th>
           <th>status</th>
           <th>property</th>
        </tr>
        <tr> 
           <td>{{ $user->name }}</td>
           <td>{{ $user->email }}</td>
           <td>{{ $user->user_type }}</td>
           <td>{{ $user->status }}</td>
           <td>{{ $user->property }}</td>
        </tr>
    </table>
</div>
@endsection