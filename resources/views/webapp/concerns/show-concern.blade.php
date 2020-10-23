@extends('templates.webapp.template')

@section('title', $unit->building.' '.$unit->unit_no)


@section('css')
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

  <style>
    div.stars {
  width: 270px;
  display: inline-block;
}

input.star { display: none; }

label.star {
  float: right;
  padding: 10px;
  font-size: 36px;
  color: #444;
  transition: all .2s;
}

input.star:checked ~ label.star:before {
  content: '\f005';
  color: #FD4;
  transition: all .25s;
}

input.star-5:checked ~ label.star:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}

input.star-1:checked ~ label.star:before { color: #F62; }

label.star:hover { transform: rotate(-15deg) scale(1.3); }

label.star:before {
  content: '\f006';
  font-family: FontAwesome;
}
  </style>
@endsection

@section('sidebar')
   
      
           <!-- Heading -->
      
          <!-- Nav Item - Pages Collapse Menu -->
          <li class="nav-item">
                <a class="nav-link" href="/board">
                  <i class="fas fa-fw fa-tachometer-alt"></i>
                  <span>Dashboard</span></a>
              </li>
      
            <hr class="sidebar-divider">
      
            <div class="sidebar-heading">
              Interface
            </div>  
            @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' )
          <li class="nav-item">
            <a class="nav-link" href="/home">
              <i class="fas fa-home"></i>
              <span>Home</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/calendar">
              <i class="fas fa-calendar-alt"></i>
              <span>Calendar</span></a>
          </li>
          @endif
        
          @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' || Auth::user()->user_type === 'billing' || Auth::user()->user_type === 'treasury')
            <li class="nav-item">
              <a class="nav-link" href="/tenants">
                <i class="fas fa-users fa-chart-area"></i>
                <span>Tenants</span></a>
            </li>
            @endif
      
        @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' || Auth::user()->user_type === 'treasury' && (Auth::user()->property_ownership === 'Multiple Owners'))
        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="/owners">
            <i class="fas fa-user-tie"></i>
            <span>Owners</span></a>
        </li>
         @endif
      
         @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' )
            <!-- Nav Item - Tables -->
        <li class="nav-item active">
            <a class="nav-link" href="/concerns">
          <i class="far fa-comment-dots"></i>
              <span>Concerns</span></a>
        </li>
        @endif
    
        @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' )
        <li class="nav-item">
            <a class="nav-link" href="/joborders">
              <i class="fas fa-tools fa-table"></i>
              <span>Job Orders</span></a>
        </li>
        @endif
      
             <!-- Nav Item - Tables -->
        @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' )
          <li class="nav-item">
            <a class="nav-link collapsed" href="/personnels" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
              <i class="fas fa-user-cog"></i>
                <span>Personnels</span>
              </a>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <a class="collapse-item" href="/housekeeping">Housekeeping</a>
                  <a class="collapse-item" href="/maintenance">Maintenance</a>
                </div>
              </div>
            </li>
        @endif
      
           @if(Auth::user()->user_type === 'billing' || Auth::user()->user_type === 'manager')
            <!-- Nav Item - Tables -->
            <li class="nav-item">
              <a class="nav-link" href="/bills">
                <i class="fas fa-file-invoice-dollar fa-table"></i>
                <span>Bills</span></a>
            </li>
           @endif
      
           @if(Auth::user()->user_type === 'treasury' || Auth::user()->user_type === 'manager')
              <li class="nav-item">
              <a class="nav-link" href="/collections">
                <i class="fas fa-file-invoice-dollar"></i>
                <span>Collections</span></a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="/financials">
                <i class="fas fa-coins"></i>
                <span>Financials</span></a>
            </li>
            @endif
      
               @if(Auth::user()->user_type === 'manager' || Auth::user()->user_type === 'ap' || Auth::user()->user_type === 'admin')
            <li class="nav-item">
            <a class="nav-link" href="/payables">
            <i class="fas fa-hand-holding-usd"></i>
              <span>Payables</span></a>
          </li>
          @endif
      
          @if(Auth::user()->user_type === 'manager')
           <!-- Nav Item - Tables -->
           <li class="nav-item">
            <a class="nav-link" href="/users">
              <i class="fas fa-user-circle"></i>
              <span>Users</span></a>
          </li>
          @endif
          
          <!-- Divider -->
          <hr class="sidebar-divider d-none d-md-block">
      
          <!-- Sidebar Toggler (Sidebar) -->
          <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
          </div>
    
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">{{ $unit->building.' '.$unit->unit_no }}</h1>
</div>

<div class="row">
  <div class="col-md-12">
    <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-concern-tab" data-toggle="tab" href="#concern" role="tab" aria-controls="nav-concern" aria-selected="true"><i class="far fa-comment-dots fa-sm text-primary-50"></i> Concern</a>
        <a class="nav-item nav-link" id="nav-expenses-tab" data-toggle="tab" href="#expenses" role="tab" aria-controls="nav-expenses" aria-selected="false"><i class="fas fa-dollar-sign fa-sm text-primary-50"></i> Expenses</a>
      </div>
    </nav>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="concern" role="tabpanel" aria-labelledby="nav-concern-tab">
        <br>
        <a href="/concerns" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a> 
        @if(Auth::user()->user_type==='manager' || Auth::user()->user_type='admin')
        <a href="#" data-toggle="modal" data-target="#editConcernDetails" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i> Edit</a> 
      
        @if($concern->concern_status != 'closed')
        <a href="#" data-toggle="modal" data-target="#markAsCompleteModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-check-square fa-sm text-white-50"></i> Mark as complete</a> 
        @else
        <a href="#" data-toggle="modal" data-target="#/" class="d-none d-sm-inline-block btn btn-sm btn-dark shadow-sm"><i class="fas fa-check-square fa-sm text-white-50"></i> Concern has been closed</a> 
        @endif
        @endif
        <div class="col-md-12 mx-auto">
          <br>
          <div class="table-responsive text-nowrap">
            <table class="table">
              <tr>
                <td>Date Reported</td>
                <td>{{ Carbon\Carbon::parse($concern->date_reported)->format('M d Y') }}</td>
              </tr>
                 <tr>
                      <td>Reported by</th>
                      <td><a href="/units/{{ $unit->unit_id }}/tenants/{{ $tenant->tenant_id }}/">{{ $tenant->first_name.' '.$tenant->last_name }}</a></td>
                 </tr>     
             <tr>
                  <td>Description</td>
                  <td>{{ $concern->concern_item }}</td>
             </tr>
             <tr>
                  <td>Type</td>
                  <td>
                    {{ $concern->concern_type }}
                  </td>
             </tr>
            
             <tr>
                  <td>Urgency</td>
                  <td>
                    @if($concern->concern_urgency === 'urgent')
                    <span class="badge badge-danger">{{ $concern->concern_urgency }}</span>
                    @elseif($concern->concern_urgency === 'major')
                    <span class="badge badge-warning">{{ $concern->concern_urgency }}</span>
                    @else
                    <span class="badge badge-primary">{{ $concern->concern_urgency }}</span>
                    @endif
                  </td>
             </tr>
             <tr>
                <td>Status</td>
                  <td>
                      @if($concern->concern_status === 'pending')
                      <span class="badge badge-warning">{{ $concern->concern_status }} for {{ number_format(Carbon\Carbon::parse($concern->date_reported)->DiffInDays(Carbon\Carbon::now()), 0) }} days</span>
                      @elseif($concern->concern_status === 'active')
                      <span class="badge badge-primary">{{ $concern->concern_status }} for {{ number_format(Carbon\Carbon::parse($concern->updated_at)->DiffInDays(Carbon\Carbon::now()), 0) }} days </span> 
                      @else
                      <span class="badge badge-secondary">{{ $concern->concern_status }} on {{ Carbon\Carbon::parse($concern->updated_at)->format('M d Y')}}</span> 
                      @endif
                  </td>
             </tr>
             
             <tr>
               <td >Concern</td>
               <td>{{ $concern->concern_desc }}</td>
             </tr>
             <tr>
              <td>Rating</td>
              <td>{{ $concern->rating? $concern->rating.'/5' : 'NA' }}</td>
           </tr>
            
             </table>
         
            <p>Enter your response here...</p>
              <form action="/responses" method="POST">
                @csrf
                <input type="hidden" name="concern_id" value={{ $concern->concern_id }}>
                <input type="hidden" name="unit_id" value={{ $unit->unit_id }}>
                <input type="hidden" name="tenant_id" value={{ $tenant->tenant_id }}>
                <textarea class="form-control" name="response" id="" cols="30" rows="3" placeholder="type your response here..."></textarea>
               
                <br>
                <p class="text-right">
                  <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="this.form.submit(); this.disabled = true;"> submit </button>
                </p>
              </form>
      
            <h5>Thread ({{ $responses->count() }})</h5>        
             @foreach ($responses as $item)
            
         
          <?php  $explode = explode(" ", $item->posted_by) ?>
              <table class="table   table-bordered">
                  <tr>
                      <td> 
                        {{ $explode[0] }} on {{ Carbon\Carbon::parse($item->created_at) }}
                        <br>
                        {!! $item->response !!}
                      </td>
                  </tr>
              </table>
             @endforeach
            </div>
        </div>
      </div>
      
      <div class="tab-pane fade" id="expenses" role="tabpanel" aria-labelledby="nav-expenses-tab">...</div>
    </div>
  </div>
</div>


<div class="modal fade" id="editConcernDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
  <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Concern</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
      <form id="editConcernDetailsForm" action="/concerns/{{ $concern->concern_id }}" method="POST">
        @method('put')
        {{ csrf_field() }}
      </form>
        <div class="row">
            <div class="col">
                <small>Date reported</small>
                <input type="date" form="editConcernDetailsForm" class="form-control" name="date_reported" value="{{ $concern->date_reported }}" required>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <small>Description</small>
                <input type="text" form="editConcernDetailsForm" class="form-control" name="concern_item" value="{{ $concern->concern_item }}" required>
            </div>
        </div>
      <br>
        <div class="row">
            <div class="col">
                <small>Type</small>
                <select class="form-control" form="editConcernDetailsForm" name="concern_type" id="" required>
                    <option value="{{ $concern->concern_type }}" readonly selected class="bg-primary">{{ $concern->concern_type }}</option>
                    <option value="billing">billing</option>
                    <option value="internet">internet</option>
                    <option value="employee">employee</option>
                    <option value="neighbour">neighbour</option>
                    <option value="noise">noise</option>
                    <option value="odours">odours</option>
                    <option value="parking">parking</option>
                    <option value="pets">pets</option>
                    <option value="repair">repair</option>
                    <option value="others">others</option>
                </select>
            </div>
        </div>
<br>
        <div class="row">
            <div class="col">
                <small>Urgency</small>
                <select class="form-control" form="editConcernDetailsForm" name="concern_urgency" id="" required>
                    <option value="{{ $concern->concern_urgency }}" readonly selected class="bg-primary">{{ $concern->concern_urgency }}</option>
                   <option value="minor">minor</option>
                   <option value="major">major</option>
                   <option value="urgent">urgent</option>
                </select>
            </div>
        </div>
<br>
     
        <div class="row">
          <div class="col">
              <small>Concern</small>
             <textarea form="editConcernDetailsForm" class="form-control" name="concern_desc" id="" cols="30" rows="10" required>
              {{ $concern->concern_desc }}
             </textarea>
          </div>
      </div>

      </div>
      <div class="modal-footer">

          <button form="editConcernDetailsForm" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="this.form.submit(); this.disabled = true;"><i class="fas fa-check fa-sm text-white-50"></i> Save Changes</button>
      </div>
  </div>
  </div>

</div>

<div class="modal fade" id="markAsCompleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
  <div class="modal-content  text-center">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Rate Employee</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
      <form id="markAsCompleteModalForm" action="/concerns/{{ $concern->concern_id }}/closed" method="POST">
        @method('put')
        {{ csrf_field() }}
      </form>
      <div class="stars">
          <input  form="markAsCompleteModalForm" class="star star-5" id="star-5" type="radio" value="5" name="rating"/>
          <label class="star star-5" for="star-5"></label>
          <input  form="markAsCompleteModalForm" class="star star-4" id="star-4" type="radio" value="4" name="rating"/>
          <label class="star star-4" for="star-4"></label>
          <input  form="markAsCompleteModalForm" class="star star-3" id="star-3" type="radio" value="3" name="rating"/>
          <label class="star star-3" for="star-3"></label>
          <input  form="markAsCompleteModalForm" class="star star-2" id="star-2" type="radio" value="2" name="rating"/>
          <label class="star star-2" for="star-2"></label>
          <input  form="markAsCompleteModalForm" class="star star-1" id="star-1" type="radio" value="1" name="rating"/>
          <label class="star star-1" for="star-1"></label>
      </div>
      <hr>
     
      <p>Feedback</p>
      <textarea form="markAsCompleteModalForm" class="form-control" name="" id="" cols="30" rows="5" name="feedback" required>
        
      </textarea>
  
 
      </div>
      <div class="modal-footer">
          <button form="markAsCompleteModalForm" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="this.form.submit(); this.disabled = true;"> Submit</button>
      </div>
  </div>
  </div>

</div>

@endsection
@section('scripts')
<script src="//cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace( 'response', {
      filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
      filebrowserUploadMethod: 'form',
  });
  </script>
@endsection



