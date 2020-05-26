@extends('layouts.app')
@section('title', session(Auth::user()->property.'building').' '.session(Auth::user()->property.'unit_no').' '.'(Step 2 of 4)')
@section('content')
<div class="container">
    <form id="addTenantForm2" action="/units/{{ session(Auth::user()->property.'unit_id') }}/tenant-step2" method="POST">
        {{ csrf_field() }}
    </form>
    <h4>Educational Background (for student) (2/4)</h4>
    <hr>
    <div class="row">
        <div class="col">
            <label for="recipient-name" class="col-form-label">High School:</label>
            <input form="addTenantForm2" type="text" class="form-control" name="high_school" id="high_school" value="{{ session(Auth::user()->property.'high_school') }}">
        </div>
        <div class="col">
            <label for="recipient-name" class="col-form-label">Address:</label>
            <input form="addTenantForm2" type="text" class="form-control" name="high_school_address" id="high_school_address" value="{{ session(Auth::user()->property.'high_school_address') }}">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="recipient-name" class="col-form-label">College/University:</label>
            <input form="addTenantForm2" type="text" class="form-control" name="college_school" id="college_school" value="{{ session(Auth::user()->property.'college_school') }}">
        </div>
        <div class="col">
            <label for="recipient-name" class="col-form-label">Address:</label>
            <input form="addTenantForm2" type="text" class="form-control" name="college_school_address" id="college_school_address" value="{{ session(Auth::user()->property.'college_school_address') }}">
        </div>
    </div>
    <div class="row">
        <div class="col">
          <label for="recipient-name" class="col-form-label">Course:</label>
          <input form="addTenantForm2" type="text" class="form-control" name="course" id="course" value="{{ session(Auth::user()->property.'course') }}">
        </div>
        <div class="col">
          <label for="recipient-name" class="col-form-label">Year Level:</label>
          <select form="addTenantForm2" class="form-control" name="year_level" id="">
            <option value="{{ session(Auth::user()->property.'year_level') }}">{{ session(Auth::user()->property.'year_level') }}</option>
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
      <h4>Employment Background (for working) (2/4)</h4>
    <hr>
    <div class="row">
        <div class="col">
            <label for="recipient-name" class="col-form-label">Employer/Company:</label>
            <input form="addTenantForm2" type="text" class="form-control" name="employer" id="emplloyer" value="{{ session(Auth::user()->property.'employer') }}">
        </div>
        <div class="col">
            <label for="recipient-name" class="col-form-label">Job Description/Position:</label>
            <input form="addTenantForm2" type="text" class="form-control" name="job" id="job" value="{{ session(Auth::user()->property.'job') }}">
        </div>
        <div class="col">
            <label for="recipient-name" class="col-form-label">Years of Employment:</label>
            <input form="addTenantForm2" type="number" class="form-control" name="years_of_employment" id="years_of_employment" value="{{ session(Auth::user()->property.'years_of_employment') }}">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="recipient-name" class="col-form-label">Contact No:</label>
            <input form="addTenantForm2" type="text" class="form-control" name="employer_contact_no" id="employer_contact_no" value="{{ session(Auth::user()->property.'employer_contact_no') }}">
        </div>
        <div class="col">
            <label for="recipient-name" class="col-form-label">Address:</label>
            <input form="addTenantForm2" type="text" class="form-control" name="employer_address" id="employer_address" value="{{ session(Auth::user()->property.'employer_address') }}">
        </div>
        
    </div>
      <br>        
        <br>
        <p class="text-right">   
            <a href="/units/{{ session(Auth::user()->property.'unit_id') }}/tenant-step1" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> prev</a>
            <button type="submit" form="addTenantForm2" class="btn btn-primary"><i class="fas fa-arrow-right"></i> next</button>
        </p>
</div>
@endsection








