@extends('layouts.app')
@section('title', $user->name.' (Edit)')
@section('content')
<div class="container">
   <p class="text-right"><button form="editUserForm" type="submit" class="btn btn-primary"><i class="fas fa-check"></i> save</button></p>
   <form id="editUserForm" action="/users/{{ $user->id }}" method="POST">
      @method('put')
      {{ csrf_field() }}
  </form>
    <table class="table table-bordered">
       <tr>
          <th>name</th>
          <td> <input form="editUserForm" class="form-control col-md-4" type="text" name="name" value="{{ $user->name }}" required></td>
       </tr>
       <tr>
         <th>email</th>
         <td> <input form="editUserForm" class="form-control col-md-4" type="text" name="email" value="{{ $user->email }}" required></td>
      </tr>
      <tr>
         <th>new password</th>
         <td> <input form="editUserForm" class="form-control col-md-4" type="password" name="password"></td>
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