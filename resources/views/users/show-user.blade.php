@extends('layouts.app')
@section('title', $user->name)
@section('content')
<div class="container">
   <p class="text-right"><a href="/users/{{ $user->id }}/edit" class="btn btn-primary"><i class="fas fa-user-edit"></i> edit</a></p>
    <table class="table table-bordered">
       <tr>
          <th>name</th>
          <td>{{ $user->name }}</td>
       </tr>
       <tr>
         <th>email</th>
         <td>{{ $user->email }}</td>
      </tr>
      <tr>
         <th>user type</th>
         <td>{{ $user->user_type }}</td>
      </tr>
      <tr>
         <th>status</th>
         <td>{{ $user->status }}</td>
      </tr>
      <tr>
         <th>property</th>
         <td>{{ $user->property }}</td>
      </tr>
      
    </table>
</div>
@endsection