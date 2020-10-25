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
        <h1 class="h4 text-gray-900 mb-4">System Users ({{ $users->count() }}/5)</h1>
      </div>
      <div class="row">
          <div class="table-responsive text-nowrap">
              <table class="table">
                  <?php $ctr=1; ?>
                  <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Role</th>
                      <th>Date added</th>
                  </tr>
                  @foreach ($users as $item)
                      <tr>
                          <th>{{ $ctr++ }}</th>
                          <td><a href="/property/{{ $item->property_id_foreign }}/user/{{ $item->id }}">{{ $item->name }}</a></td>
                          <td>{{ $item->user_type }}</td>
                          <td>{{ Carbon\Carbon::parse($item->created_at)->format('M d Y') }}</td>
                      </tr>
                  @endforeach
              </table>
          </div>
      </div>
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



