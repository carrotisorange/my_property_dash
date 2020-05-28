@extends('layouts.app')
@section('title', session(Auth::user()->property.'building').' '.session(Auth::user()->property.'unit_no').' '.'(Step 1 of 4)')
@section('content')
<div class="container">
    <form id="addTenantForm1" action="/units/{{ session(Auth::user()->property.'unit_id') }}/tenant-step1" method="POST">
        {{ csrf_field() }}
    </form>
    <h4>Personal Information (1/4)</h4>
    <hr>
        
        <input form="addTenantForm1" type="hidden" value="{{ session(Auth::user()->property.'unit_id') }}" name="unit_id"> 
        <div class="row">
            <div class="col">
                <label for="recipient-name" class="col-form-label">First Name:</label>
                <input form="addTenantForm1" type="text" class="form-control" name="first_name" id="first_name" value="{{ session(Auth::user()->property.'first_name') }}" required>
            </div>
            <div class="col">
                <label for="recipient-name" class="col-form-label">Middle Name:</label>
                <input form="addTenantForm1" type="text" class="form-control" name="middle_name" id="middle_name" value="{{ session(Auth::user()->property.'middle_name') }}">
            </div>
            <div class="col">
                <label for="recipient-name" class="col-form-label">Last Name:</label>
                <input form="addTenantForm1" type="text" class="form-control" name="last_name" id="last_name" value="{{ session(Auth::user()->property.'last_name') }}" required>
            </div>
            </div>
        <div class="row">
            <div class="col">
                <label for="recipient-name" class="col-form-label">Birthdate:</label>
                <input form="addTenantForm1" type="date" class="form-control" name="birthdate" id="birthdate" value="{{ session(Auth::user()->property.'birthdate') }}">
            </div>
            <div class="col">
                <label for="recipient-name" class="col-form-label">Gender:</label>
                <select form="addTenantForm1"  id="gender" name="gender" class="form-control" required >        
                    <option value="{{ session(Auth::user()->property.'gender') }}" selected>{{ session(Auth::user()->property.'gender') }}</option>
                    <option value="male">male</option>
                    <option value="female">female</option>
                </select>
            </div>
            <div class="col">
                <label for="recipient-name" class="col-form-label">Civil Status:</label>
                <select form="addTenantForm1"  id="civil_status" name="civil_status" class="form-control">
                    <option value="{{ session('civil_status') }}" selected>{{ session(Auth::user()->property.'civil_status') }}</option>
                    <option value="single" selected>single</option>
                    <option value="married">married</option>
                </select>
            </div>
            <div class="col">
                <label for="recipient-name" class="col-form-label">ID/ID Number:</label>
                <input form="addTenantForm1" type="text" class="form-control" name="id_number" id="id_number" value="{{ session(Auth::user()->property.'id_number') }}">
            </div>
        </div>
        
        <div class="row">
            <div class="col">
              <label for="recipient-name" class="col-form-label">Contact Number:</label>
              <input form="addTenantForm1" type="text" class="form-control" name="contact_no" id="contact_no" value="{{ session(Auth::user()->property.'contact_no') }}" required >
            </div>
            <div class="col">
              <label for="recipient-name" class="col-form-label">Email Address:</label>
              <input form="addTenantForm1" type="email" class="form-control" name="email_address" id="email_address" value="{{ session(Auth::user()->property.'email_address') }}">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="recipient-name" class="col-form-label">House No/Barangay:</label>
                <input form="addTenantForm1" type="text" class="form-control" name="barangay" id="barangay" value="{{ session(Auth::user()->property.'barangay') }}">
            </div>
            <div class="col">
                <label for="recipient-name" class="col-form-label">City:</label>
                <input form="addTenantForm1" type="text" class="form-control" name="city" id="city" value="{{ session(Auth::user()->property.'city') }}">
            </div>
        </div>
        <div class="row">
            <div class="col">
              <label for="recipient-name" class="col-form-label">Province:</label>
              <input form="addTenantForm1" type="text" class="form-control" name="province" id="province" value="{{ session(Auth::user()->property.'province') }}">
            </div>
            <div class="col">
                <label for="recipient-name" class="col-form-label">Country:</label>
                <input form="addTenantForm1" type="text" class="form-control" name="country" id="country" value="{{ session(Auth::user()->property.'country') }}">
            </div>
            <div class="col">
                <label for="recipient-name" class="col-form-label">Zip Code:</label>
                <input form="addTenantForm1" type="text" class="form-control" name="zip_code" id="zip_code" value="{{ session(Auth::user()->property.'zip_code') }}">
            </div>
        </div>
        <br>
        <b>Person to contact in case of emergency</b>
        <div class="row">   
            <div class="col">
                <label for="recipient-name" class="col-form-label">Name:</label>
                <input form="addTenantForm1" type="text" class="form-control" name="guardian" id="guardian" value="{{ session(Auth::user()->property.'guardian') }}">
            </div>
            <div class="col">
                <label for="recipient-name" class="col-form-label">Relationship to the tenant:</label>
                <input form="addTenantForm1" type="text" class="form-control" name="guardian_relationship" id="guardian_relationship" value="{{ session(Auth::user()->property.'guardian_relationship') }}">
            </div>
            <div class="col">
                <label for="recipient-name" class="col-form-label">Contact No:</label>
                <input form="addTenantForm1" type="text" class="form-control" name="guardian_contact_no" id="guardian_contact_no" value="{{ session(Auth::user()->property.'guardian_contact_no') }}">
            </div>
       </div>
        
        <br>
        <p class="text-right">   
            <a href="/units/{{ session(Auth::user()->property.'unit_id') }}" class="btn btn-secondary"><i class="fas fa-times"></i> cancel</a>
            <button type="submit" form="addTenantForm1" class="btn btn-primary"><i class="fas fa-arrow-right"></i> next</button>
        </p>
    
</div>
@endsection








