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
        <h1 class="h4 text-gray-900 mb-4">Users</h1>
      </div>
      <div class="row">
          <div class="table-responsive text-nowrap">
              <table class="table">
                  <?php $ctr=1; ?>
                  <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Role</th>
                  
                  </tr>
                  @foreach ($users as $item)
                      <tr>
                          <th>{{ $ctr++ }}</th>
                          <td><a href="/property/{{ $item->property_id_foreign }}/system-user/{{ $item->id }}">{{ $item->name }}</a></td>
                          <td>{{ $item->email }}</td>
                          <td>{{ $item->user_type }}</td>
           
                      </tr>
                  @endforeach
              </table>
          </div>
      </div>
      <hr>
      <div class="row">
        
       
      
        <div class="col">
       
           <a href="/property/all/" class="btn btn-success btn-user btn-block"> Properties </a>
       
       </div>

      
       <div class="col">

        <a href="/property/{{ $property->property_id }}/user/create" class="btn btn-primary btn-user btn-block"> Add More </a>
    
    </div>

     

     </div>
    
@endsection

@section('scripts')

@endsection



