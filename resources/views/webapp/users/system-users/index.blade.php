@extends('templates.website.arsha-login')

@section('title', 'Users')

@section('sidebar')
   
@endsection

@section('css')

@endsection

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
           <a href="/property/all/" class="btn btn-success btn-user btn-block"> <i class="fas fa-home"></i> Home</a>
       </div>
       <div class="col">
        @if(Auth::user()->trial_ends_at > Carbon\Carbon::today())
        <a href="/property/{{ $property->property_id }}/user/create" class="btn btn-primary btn-user btn-block"><i class="fas fa-plus-circle"></i> User </a>
        @else
        <a href="#" data-toggle="modal" data-target="#openProVersion" class="btn btn-primary btn-user btn-block"><i class="fas fa-hand-point-up"></i> User</a> 
        @endif
     
    </div>
     </div>

     <div class="modal fade" id="showWarning" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title text-danger" id="exampleModalLabel"><i class="fas fa-exclamation-triangle"></i> Trial period has expired</h5>
        
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          </div>
         <div class="modal-body">
           <p class="text-center">
             Would you like to proceed with the payment?
             <br>
           
           </p>
         </div>
        <div class="modal-footer">
          <a href="thepropertymanager.online#pricing" target="_blank" class="btn btn-info"><i class="fas fa-tags"></i> See pricing</a> 
          <a href="#" data-toggle="modal" data-target="#openPaymentInfo" class="btn btn-success"><i class="fas fa-credit-card"></i> Proceed</a> 
  
      
        </div> 
        </div>
        </div>
        
        </div>
  

        <div class="modal fade" id="openProVersion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
              <h5 class="modal-title text-info" id="exampleModalLabel"><i class="fas fa-exclamation-info"></i> Upgrade to Pro</h5>
            
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>
             <div class="modal-body">
               <p class="text-center">
                 Would you like to proceed with the payment?
                 <br>
               
               </p>
             </div>
            <div class="modal-footer">
              <a href="thepropertymanager.online#pricing" target="_blank" class="btn btn-info"><i class="fas fa-tags"></i> See pricing</a> 
              <a href="#" data-toggle="modal" data-target="#openPaymentInfo" class="btn btn-success"><i class="fas fa-credit-card"></i> Proceed</a> 
      
          
            </div> 
            </div>
            </div>
            
            </div>

            
      <div class="modal fade" id="openPaymentInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title text-success" id="exampleModalLabel"><i class="fas fa-credit-card"></i> Payment Instructions</h5>
        
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          </div>
         <div class="modal-body">
           <p>
            Please send your proof of payment to the email address <span class="font-italic font-weight-bold">thepropertymanager2020@gmail.com</span>
            <ul>
              <li>  GCash = 09752826318 </li>
              <li>  BDO = 0009 4037 3114</li>
            </ul>
           </p>
         
         </div>
        <div class="modal-footer">

         <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close"><i class="fas fa-times fa-sm text-white-50"></i> Close </button>
      
        </div> 
        </div>
        </div>
        
        </div>
    
@endsection

@section('scripts')

@endsection



