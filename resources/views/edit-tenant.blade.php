@extends('layouts.app')
@section('title', $tenant->first_name.' '.$tenant->last_name.' (Edit)')
@section('content')
<div class="container">
    <form id="editTenantForm" action="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}" method="POST">
        @method('put')
        {{ csrf_field() }}
    </form>
        <h4>Personal Information</h4>
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
                    <div class=" col">
                        <small>Civil Status</small>
                        <input form="editTenantForm" class="form-control" type="text" name="civil_status" value="{{ $tenant->civil_status }}">
                    </div>
                    <div class=" col">
                        <small>ID/ID number</small>
                        <input form="editTenantForm" class="form-control" type="text" name="id_number" value="{{ $tenant->id_number }}">
                    </div>
                </div>
                
                <br>

                <h4>Address</h4>
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

                <br>

                <h4>Contact Information</h4>
                <div class="form-group row">
                    <div class="col">
                        <small for="">Contact No</small>
                        <input form="editTenantForm" class="form-control" type="text" name="contact_no" value="{{ $tenant->contact_no }}">
                    </div>
                    <div class="col">
                        <small for="">Email Address</small>
                        <input form="editTenantForm" class="form-control" type="text" name="email_address" value="{{ $tenant->email_address }}">
                    </div>
                </div>
           
                <br>

                <h4>Person to contact in case of emergency</h4>
                <div class="form-group row">
                    <div class="col">
                        <small for="">Name</small>
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

                <br>

                <h4>Educational Backgound</h4>
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

                <br>

                <h4>Employment Information</h4>
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

                <h4>Note</h4>
                <div class="form-group row">
                    <div class="col">
                        <textarea form="editTenantForm" class="form-control" name="tenants_note" id="" cols="30" rows="5">
                            {{ $tenant->tenants_note }}
                        </textarea>
                    </div>
                </div>


    <p class="text-right">   
        <a href="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}" class="btn btn-secondary"><i class="fas fa-times"></i> cancel</a>
        <button form="editTenantForm" type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Update</button>
    </p>
    
</div>
@endsection








