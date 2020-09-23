@extends('layouts.app')

@section('title', $tenant->first_name.' '.$tenant->last_name.' | Edit')

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
            <li class="nav-item active">
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
         <!-- 404 Error Text -->
         <form id="editTenantForm" action="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}" method="POST">
          @method('put')
          {{ csrf_field() }}
      </form>
       
                  <div class="form-group row">
                      <div class="col">
                          <small>First Name</small>
                          <input form="editTenantForm" class="form-control" type="text" name="first_name" value="{{ $tenant->first_name }}">
                      </div>
                      <div class="col">
                          <small>Middle Name</small>
                          <input form="editTenantForm" class="form-control" type="text" name="middle_name" value="{{ $tenant->middle_name }}">
                      </div>
                      <div class="col">
                          <small>Last Name</small>
                          <input form="editTenantForm" class="form-control" type="text" name="last_name" value="{{ $tenant->last_name }}">
                      </div>
                  </div>
           
                  <div class="form-group row">
                      <div class="col">
                          <small>Gender</small>
                          <select form="editTenantForm" class="form-control" name="gender" id="">
                              <option value="{{ $tenant->gender }}">{{ $tenant->gender }}</option>
                              <option value="female">female</option>
                              <option value="male">male</option>
                          </select>
                      </div>
                      <div class=" col">
                          <small>Birthdate</small>
                          <input form="editTenantForm" class="form-control" type="date" name="birthdate" value="{{ $tenant->birthdate }}">
                      </div>
                      <div class="col">
                          <small>Civil Status:</small>
                          <select form="editTenantForm"  id="civil_status" name="civil_status" class="form-control">
                              <option value="{{ $tenant->civil_status }}" selected>{{ $tenant->civil_status }}</option>
                              <option value="single" selected>single</option>
                              <option value="married">married</option>
                          </select>
                      </div>
                      <div class=" col">
                          <small>ID/ID number</small>
                          <input form="editTenantForm" class="form-control" type="text" name="id_number" value="{{ $tenant->id_number }}">
                      </div>
                  </div>
                 
                  <div class="form-group row">
                      <div class=" col-md-8">
                          <small for="">Barangay</small>
                          <input form="editTenantForm" class="form-control" type="text" name="barangay" value="{{ $tenant->barangay }}">
                      </div>
                      <div class=" col-md-4">
                          <small for="">City</small>
                          <input form="editTenantForm" class="form-control" type="text" name="city" value="{{ $tenant->city }}">
                      </div>
                     
                  </div>
                  <div class="form-group row">
                      <div class=" col-md-4">
                          <small for="">Province</small>
                          <input form="editTenantForm" class="form-control" type="text" name="province" value="{{ $tenant->province }}">
                      </div>
                      <div class=" col-md-4">
                          <small for="">Country</small>
                          <input form="editTenantForm" class="form-control" type="text" name="country" value="{{ $tenant->country }}">
                      </div>
                      <div class=" col-md-4">
                          <small for="">Zipcode</small>
                          <input form="editTenantForm" class="form-control" type="text" name="zip_code" value="{{ $tenant->zip_code }}">
                      </div>
                  </div>

                  <div class="form-group row">
                      <div class="col">
                          <small for="">Contact No</small>
                          <input form="editTenantForm" class="form-control" type="text" name="contact_no" value="{{ $tenant->contact_no }}">
                      </div>
                      <div class="col" id="email_address">
                          <small for="">Email Address</small>
                          <input form="editTenantForm" class="form-control" type="text" name="email_address" value="{{ $tenant->email_address }}">
                        @if($tenant->email_address === null)
                        <small class="text-danger">Please add an email</small>
                        @endif
                      </div>
                      <div class="col">
                        <small for="">Monthly Rent</small>
                        <input form="editTenantForm" class="form-control" type="number" name="tenant_monthly_rent" value="{{ $tenant->tenant_monthly_rent }}">
                    </div>
                  </div>
             
                  <hr>
                  <div class="form-group row">
                      <div class="col">
                          <small for="">Guardian</small>
                          <input form="editTenantForm" class="form-control" type="text" name="guardian" value="{{ $tenant->guardian }}">
                      </div>
                      <div class="col">
                          <small for="">Relationhip to the tenant</small>
                          <input form="editTenantForm" class="form-control" type="text" name="guardian_relationship" value="{{ $tenant->guardian_relationship }}">
                      </div>
                      <div class="col">
                          <small for="">Contact no</small>
                          <input form="editTenantForm" class="form-control" type="text" name="guardian_contact_no" value="{{ $tenant->guardian_contact_no }}">
                      </div>
                  </div>
  
                  <hr>

                  <div class="form-group row">
                      <div class="col">
                          <small for="">High School</small>
                          <input form="editTenantForm" class="form-control" type="text" name="high_school" value="{{ $tenant->high_school }}">
                      </div>
                      <div class="col">
                          <small for="">Adddress</small>
                          <input form="editTenantForm" class="form-control" type="text" name="high_school_address" value="{{ $tenant->high_school_address }}">
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col">
                          <small for="">College/University</small>
                          <input form="editTenantForm" class="form-control" type="text" name="college_school" value="{{ $tenant->college_school }}">
                      </div>
                      <div class="col">
                          <small for="">Address</small>
                          <input form="editTenantForm" class="form-control" type="text" name="college_school_address" value="{{ $tenant->college_school_address }}">
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col">
                          <small for="">Course</small>
                          <input form="editTenantForm" class="form-control" type="text" name="course" value="{{ $tenant->course }}">
                      </div>
                      <div class="col">
                          <small for="">Year Level</small>
                          <select form="editTenanForm" class="form-control" name="year_level" id="">
                              <option value="{{ $tenant->year_level }}">{{ $tenant->year_level }}</option>
                                <option value="senior high">junior high</option>
                                <option value="first year">first year</option>
                                <option value="second year">second year</option>
                                <option value="third year">third year</option>
                                <option value="fourth year">fourth year</option>
                                <option value="fifth year">fifth year</option>
                                <option value="graduate student">graduate student</option>
                            </select>
                      </div>
                  </div>
  
                  <hr>
  
      
                  <div class="form-group row">
                      <div class="col">
                          <small for="">Employer/Company</small>
                          <input form="editTenantForm" class="form-control" type="text" name="employer" value="{{ $tenant->employer }}">
                      </div>
                      <div class="col">
                          <small for="">Position/Job description</small>
                          <input form="editTenantForm" class="form-control" type="text" name="job" value="{{ $tenant->job }}">
                      </div>
                      <div class="col">
                          <small for="">Years of Employment</small>
                          <input form="editTenantForm" class="form-control" type="number" name="years_of_employment" value="{{ $tenant->years_of_employment }}">
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col">
                          <small for="">Address</small>
                          <input form="editTenantForm" class="form-control" type="text" name="employer_address" value="{{ $tenant->employer_address }}">
                      </div>
                      <div class="col">
                          <small for="">Contact No</small>
                          <input form="editTenantForm" class="form-control" type="text" name="employer_contact_no" value="{{ $tenant->employer_contact_no }}">
                      </div>
                      
                  </div>
                  <hr>
                  @if($tenant->tenants_note !== 'new' )
                  <div class="form-group row">
                      <div class="col">
                        <small>Note</small>
                          <textarea form="editTenantForm" class="form-control" name="tenants_note" id="" cols="30" rows="5">
                              {{ $tenant->tenants_note }}
                          </textarea>
                      </div>
                  </div>
                  @endif
  
  
      <p class="text-right">   
          <a href="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</a>
          <button type="submit" form="editTenantForm" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;"><i class="fas fa-check fa-sm text-white-50"></i> Update Tenant</button>
      </p>
@endsection

@section('scripts')

@endsection



