@extends('templates.website.arsha-login')

@section('title', 'Users')

@section('sidebar')
   

@endsection

@section('css')

@endsection

@section('content')

@section('content')

<form   class="user" action="/property/select" method="POST">
    @csrf
      <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">{{ $user->name }}</h1>
      </div>

      <div class="row">
        <div class="table-responsive text-nowrap">
            <table class="table">
                
                <tr>
                   
                    <th>Name</th>
    
                      <th>Email</th>
                    <th>Role</th>
                    <th>Date added</th>
                </tr>
                
                    <tr>
                       
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->user_type }}</td>
                        <td>{{ Carbon\Carbon::parse($user->created_at)->format('M d Y') }}</td>
                    </tr>
               
            </table>
        </div>
    </div>
    

   
      <hr>
      <div class="row">
        
       
      
         <div class="col">
        
            <a href="/property/all/" class="btn btn-primary btn-user btn-block"><i class="fas fa-home"></i> Home </a>
        
        </div>

        <div class="col">
        
            <a href="/property/{{ $property->property_id }}/user/all" class="btn btn-warning btn-user btn-block"> <i class="fas fa-users"></i>Users </a>
        
        
        </div>
        <div class="col">

            <a href="/property/{{ $property->property_id }}/user/create" class="btn btn-success btn-user btn-block"> <i class="fas fa-plus-circle"></i>Users </a>
        
          </div>

      </div>
  

@endsection

@section('scripts')

@endsection



