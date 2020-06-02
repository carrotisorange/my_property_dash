@extends('layouts.app')
@section('title', 'Users')
@section('content')
<div class="container">
    <div class="justify-content-center">
        <form action="/users/search" method="GET" >
            @csrf
            <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="enter user name" value="{{ session('search_user') }}">
            </div>
        </form>
        <br>
        <p class="text-center"><small ><b>{{ $users->count() }}</b> users found.</small></p>
        <table class="table table-striped">
            <tr>
               <th class="text-center">#</th>
               <th>name</th>
               <th>email</th>
               <th>user type</th>
               <th>status</th>
               <th>property</th>
               </tr>
           <?php $ctr = 1;?>   
           @foreach ($users as $item)
           <tr>
               <th class="text-center">{{ $ctr++ }}</th>
               <td><a href="/users/{{ $item->id }}">{{ $item->name }}</a></td>
               <td>{{ $item->email }}</td>
               <td>{{ $item->user_type }}</td>
               <td>{{ $item->status }}</td>
               <td>{{ $item->property }}</td>
           </tr>
           @endforeach
        </table>
    </div>
</div>
@endsection








