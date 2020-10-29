@extends('templates.webapp-new.template')

@section('title',  $unit->building.' '.$unit->unit_no)
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
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          {{-- <img src="{{ asset('/argon/assets/img/brand/logo.png') }}" class="navbar-brand-img" alt="...">--}}{{ $property->name }} 
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/dashboard">
                <i class="fas fa-tachometer-alt text-orange"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' )
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/home">
                <i class="fas fa-home text-indigo"></i>
                <span class="nav-link-text">Home</span>
              </a>
            </li>
            @endif
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/calendar">
                <i class="fas fa-calendar-alt text-red"></i>
                <span class="nav-link-text">Calendar</span>
              </a>
            </li>
            @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' || Auth::user()->user_type === 'billing' || Auth::user()->user_type === 'treasury')
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/tenants">
                <i class="fas fa-user text-green"></i>
                <span class="nav-link-text">Tenants</span>
              </a>
            </li>
          
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/owners">
                <i class="fas fa-user-tie text-teal"></i>
                <span class="nav-link-text">Owners</span>
              </a>
            </li>
            @endif

            <li class="nav-item">
              <a class="nav-link active" href="/property/{{$property->property_id }}/concerns">
                <i class="fas fa-tools text-cyan"></i>
                <span class="nav-link-text">Concerns</span>
              </a>
            </li>
            @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' )
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/joborders">
                <i class="fas fa-list text-dark"></i>
                <span class="nav-link-text">Job Orders</span>
              </a>
            </li>
           
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}}/personnels">
                <i class="fas fa-user-secret text-gray"></i>
                <span class="nav-link-text">Personnels</span>
              </a>
            </li>
            @endif

            @if(Auth::user()->user_type === 'billing' || Auth::user()->user_type === 'manager')
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/bills">
                <i class="fas fa-file-invoice-dollar text-pink"></i>
                <span class="nav-link-text">Bills</span>
              </a>
            </li>
            @endif
            @if(Auth::user()->user_type === 'treasury' || Auth::user()->user_type === 'manager')
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/collections">
                <i class="fas fa-coins text-yellow"></i>
                <span class="nav-link-text">Collections</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/financials">
                <i class="fas fa-chart-line text-purple"></i>
                <span class="nav-link-text">Financials</span>
              </a>
            </li>
            @endif
            @if(Auth::user()->user_type === 'manager' || Auth::user()->user_type === 'ap' || Auth::user()->user_type === 'admin')
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/payables">
                <i class="fas fa-file-export text-indigo"></i>
                <span class="nav-link-text">Payables</span>
              </a>
            </li>
            @endif
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/users">
                <i class="fas fa-user-circle text-green"></i>
                <span class="nav-link-text">Users</span>
              </a>
            </li>
          </ul>
          <!-- Divider -->
          <hr class="my-3">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Documentation</span>
          </h6>
          <!-- Navigation -->
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link" href="/property/{{ $property->property_id }}/getting-started" target="_blank">
                <i class="ni ni-spaceship"></i>
                <span class="nav-link-text">Getting started</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/property/{{ $property->property_id }}/system-updates" target="_blank">
                <i class="fas fa-bug text-red"></i>
                <span class="nav-link-text">System Updates</span>
              </a>
            </li>
          <li class="nav-item">
              <a class="nav-link" href="/property/{{ $property->property_id }}/announcements" target="_blank">
                <i class="fas fa-microphone text-purple"></i>
                <span class="nav-link-text">Annoncements</span>
              </a>
            </li>
             {{--  <li class="nav-item">
              <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/plugins/charts.html" target="_blank">
                <i class="ni ni-chart-pie-35"></i>
                <span class="nav-link-text">Plugins</span>
              </a>
            </li> --}}
            
          </ul>
        </div>
      </div>
    </div>
  </nav>
@endsection

@section('upper-content')
<div class="row align-items-center py-4">
  <div class="col-lg-6 col-7">
    <h6 class="h2 text-dark d-inline-block mb-0">{{ $unit->building.' '.$unit->unit_no }}</h6>
    
  </div>

  <div class="col-lg-6 col-5 text-right">
    <a href="/concerns" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a> 
    @if(Auth::user()->user_type==='manager' || Auth::user()->user_type='admin')
   
  
    @if($concern->concern_status != 'closed')
    <a href="#" data-toggle="modal" data-target="#editConcernDetails" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i> Edit</a> 
    <a href="#" data-toggle="modal" data-target="#markAsCompleteModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-check-square fa-sm text-white-50"></i> Mark as complete</a> 
    @else
    <a href="#" data-toggle="modal" data-target="#/" class="d-none d-sm-inline-block btn btn-sm btn-dark shadow-sm"><i class="fas fa-check-square fa-sm text-white-50"></i> Concern has been closed</a> 
    @endif
    @endif
  </div>


</div>

<div class="row">
     
 

          <div class="table-responsive text-nowrap">
            <table class="table">
              <tr>
                <td>Date Reported</td>
                <td>{{ Carbon\Carbon::parse($concern->date_reported)->format('M d Y') }}</td>
              </tr>
                 <tr>
                      <td>Reported by</th>
                      <td><a href="/property/{{ $property->property_id }}/home/{{ $unit->unit_id }}/tenant/{{ $tenant->tenant_id }}">{{ $tenant->first_name.' '.$tenant->last_name }}</a></td>
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
           <tr>
            <td>Feedback</td>
            <td>{{ $concern->feedback? $concern->feedback : 'NA' }}</td>
         </tr>
            
             </table>
              <form action="/concern/{{ $concern->concern_id }}/response" method="POST">
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
      
            <p>Thread ({{ $responses->count() }})</p>        
             @foreach ($responses as $item)
            
      
              <table class="table   table-bordered">
                  <tr>
                      <td> 
                        {{ $item->posted_by }} on {{ Carbon\Carbon::parse($item->created_at) }}
                        <br>
                        {!! $item->response !!}
                      </td>
                  </tr>
              </table>
             @endforeach
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
                    <option value="minor and not urgent">minor and not urgent</option>
                    <option value="minor but urgent">minor but urgent</option>
                    <option value="major but not urgent">major but not urgent</option>
                    <option value="major and urgent">major and urgent</option>
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
  <br>

     
      <p class="text-left">Feedback</p>
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

@section('main-content')

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



