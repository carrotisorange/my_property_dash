@extends('layouts.app')

@section('title', 'Notifications')

@section('sidebar')
      <!-- Nav Item - Dashboard -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/board">
            <div class="sidebar-brand-icon">
               <i class="fab fa-product-hunt"></i>
            </div>
            <div class="sidebar-brand-text mx-3">{{ Auth::user()->property }}<sup></sup></div>
          </a>
      
          <!-- Divider -->
          <hr class="sidebar-divider my-0">
      
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
        <li class="nav-item">
            <a class="nav-link" href="/concerns">
          <i class="far fa-comment-dots"></i>
              <span>Concerns</span></a>
        </li>
        @endif
    
        @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' )
        <li class="nav-item">
            <a class="nav-link" href="/job-orders">
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
            @endif
      
               @if(Auth::user()->user_type === 'manager' || Auth::user()->user_type === 'ap' || Auth::user()->user_type === 'admin')
            <li class="nav-item">
            <a class="nav-link" href="/account-payables">
            <i class="fas fa-hand-holding-usd"></i>
              <span>Account Payables</span></a>
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
  <h1 class="h3 mb-0 text-gray-800">Notifications</h1>
</div>
@foreach($notifications as $item)
   @if($item->action==='request to moveout has been approved!' ||$item->action==='has been added to the property!' || $item->action==='property has been set-up!' ) 
          @if($item->updated_at === null)
          <form id="notificationtForm" action="/units/{{ $item->unit_tenant_id }}/tenants/{{ $item->tenant_id }}" method="POST">
              @method('put')
              {{ csrf_field() }}
              <input form="notificationtForm" type="hidden" name="action" value="open notification">
              <input form="notificationtForm" type="hidden" name="notification_id" value="{{ $item->notification_id }}">
          </form>
            <button form="notificationtForm" class="dropdown-item d-flex align-items-center">
            <div class="mr-3">
            <div class="icon-circle bg-success">
                <i class="fas fa-check text-white"></i>
              </div>
            </div>
            <div>
              <div class="small text-gray-500">{{Carbon\Carbon::parse($item->created_at)->format('M d Y')}}</div>
              <span class="font-weight-bold">{{ $item->first_name.' '.$item->last_name.' '.$item->building.' '.$item->unit_no.' '.$item->action }}</span>
            </div>
          </button> 
          <hr>
          @else
            <a class="dropdown-item d-flex align-items-center" href="/units/{{$item->unit_no}}/tenants/{{ $item->tenant_id }}">
            <div class="mr-3">
            <div class="icon-circle bg-success">
                <i class="fas fa-check text-white"></i>
              </div>
            </div>
            <div>
              <div class="small text-gray-500">{{Carbon\Carbon::parse($item->created_at)->format('M d Y')}}</div>
              <span class="">{{ $item->first_name.' '.$item->last_name.' '.$item->building.' '.$item->unit_no.' '.$item->action }}</span>
            </div>
          </a> 
          <hr>
          @endif
        @else
        @if($item->updated_at === null)
          <form id="notificationtForm" action="/units/{{ $item->unit_tenant_id }}/tenants/{{ $item->tenant_id }}" method="POST">
              @method('put')
              {{ csrf_field() }}
              <input form="notificationtForm" type="hidden" name="action" value="open notification">
              <input form="notificationtForm" type="hidden" name="notification_id" value="{{ $item->notification_id }}">
          </form>
            <button form="notificationtForm" class="dropdown-item d-flex align-items-center">
            <div class="mr-3">
            <div class="icon-circle bg-warning">
            <i class="fas fa-exclamation-triangle text-white"></i>
          </div>
            </div>
            <div>
              <div class="small text-gray-500">{{Carbon\Carbon::parse($item->created_at)->format('M d Y')}}</div>
              <span class="font-weight-bold">{{ $item->first_name.' '.$item->last_name.' '.$item->building.' '.$item->unit_no.' '.$item->action }}</span>
            </div>
          </button> 
          <hr>
          @else
            <a class="dropdown-item d-flex align-items-center" href="/units/{{$item->unit_no}}/tenants/{{ $item->tenant_id }}">
            <div class="mr-3">
            <div class="icon-circle bg-warning">
            <i class="fas fa-exclamation-triangle text-white"></i>
          </div>
            </div>
            <div>
              <div class="small text-gray-500">{{Carbon\Carbon::parse($item->created_at)->format('M d Y')}}</div>
              <span class="">{{ $item->first_name.' '.$item->last_name.' '.$item->building.' '.$item->unit_no.' '.$item->action }}</span>
            </div>
          </a> 
          <hr>
          
          @endif
        @endif
      @endforeach
           

            
      
       
@endsection

@section('scripts')

@endsection



