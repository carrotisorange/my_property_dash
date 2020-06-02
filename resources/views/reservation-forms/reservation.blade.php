@extends('layouts.app')
@section('title', $unit->building.' '.$unit->unit_no)
@section('content')
<div class="container">
    <form id="reservationForm" action="/reservation/" method="POST">
        {{ csrf_field() }}
    </form>
    <h5>Personal Information</h5>
    <hr>
        <input form="reservationForm" type="hidden" value="{{ $unit->unit_id }}" name="unit_id"> 
        <div class="row">
            <div class="col">
                <label for="recipient-name" class="col-form-label">First Name:</label>
                <input form="reservationForm" type="text" class="form-control" name="first_name" id="first_name" value="" required>
            </div>
            <div class="col">
                <label for="recipient-name" class="col-form-label">Middle Name:</label>
                <input form="reservationForm" type="text" class="form-control" name="middle_name" id="middle_name" value="">
            </div>
            <div class="col">
                <label for="recipient-name" class="col-form-label">Last Name:</label>
                <input form="reservationForm" type="text" class="form-control" name="last_name" id="last_name" value="" required>
            </div>
            </div>
        <div class="row">
            <div class="col">
                <label for="recipient-name" class="col-form-label">Birthdate:</label>
                <input form="reservationForm" type="date" class="form-control" name="birthdate" id="birthdate" value="">
            </div>
            <div class="col">
                <label for="recipient-name" class="col-form-label">Gender:</label>
                <select form="reservationForm"  id="gender" name="gender" class="form-control" required >        
                    <option value="" selected>Please select one</option>
                    <option value="male">male</option>
                    <option value="female">female</option>
                </select>
            </div>
            {{-- <div class="col">
                <label for="recipient-name" class="col-form-label">Civil Status:</label>
                <select form="reservationForm"  id="civil_status" name="civil_status" class="form-control">
                    <option value="" selected>Please select one</option>
                    <option value="single" selected>single</option>
                    <option value="married">married</option>
                </select>
            </div>
            <div class="col">
                <label for="recipient-name" class="col-form-label">ID/ID Number:</label>
                <input form="reservationForm" type="text" class="form-control" name="id_number" id="id_number" value="">
            </div> --}}
        </div>
        
        <div class="row">
            <div class="col">
              <label for="recipient-name" class="col-form-label">Contact Number:</label>
              <input form="reservationForm" type="text" class="form-control" name="contact_no" id="contact_no" value="" required >
            </div>
            <div class="col">
              <label for="recipient-name" class="col-form-label">Email Address:</label>
              <input form="reservationForm" type="email" class="form-control" name="email_address" id="email_address" value="">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="recipient-name" class="col-form-label">House No/Barangay:</label>
                <input form="reservationForm" type="text" class="form-control" name="barangay" id="barangay" value="">
            </div>
            <div class="col">
                <label for="recipient-name" class="col-form-label">City:</label>
                <input form="reservationForm" type="text" class="form-control" name="city" id="city" value="">
            </div>
        </div>
        <div class="row">
            <div class="col">
              <label for="recipient-name" class="col-form-label">Province:</label>
              <input form="reservationForm" type="text" class="form-control" name="province" id="province" value="">
            </div>
            <div class="col">
                <label for="recipient-name" class="col-form-label">Country:</label>
                <input form="reservationForm" type="text" class="form-control" name="country" id="country" value="">
            </div>
            <div class="col">
                <label for="recipient-name" class="col-form-label">Zip Code:</label>
                <input form="reservationForm" type="text" class="form-control" name="zip_code" id="zip_code" value="">
            </div>
        </div>
        <br>
        {{-- <b>Person to contact in case of emergency</b>
        <div class="row">   
            <div class="col">
                <label for="recipient-name" class="col-form-label">Name:</label>
                <input form="reservationForm" type="text" class="form-control" name="guardian" id="guardian" value="">
            </div>
            <div class="col">
                <label for="recipient-name" class="col-form-label">Relationship to the tenant:</label>
                <input form="reservationForm" type="text" class="form-control" name="guardian_relationship" id="guardian_relationship" value="">
            </div>
            <div class="col">
                <label for="recipient-name" class="col-form-label">Contact No:</label>
                <input form="reservationForm" type="text" class="form-control" name="guardian_contact_no" id="guardian_contact_no" value="">
            </div>
       </div>
       <br> --}}
       <h5>Educational Background (for student) </h5>
    <hr>
    <div class="row">
        <div class="col">
            <label for="recipient-name" class="col-form-label">High School:</label>
            <input form="reservationForm" type="text" class="form-control" name="high_school" id="high_school" value="">
        </div>
        <div class="col">
            <label for="recipient-name" class="col-form-label">Address:</label>
            <input form="reservationForm" type="text" class="form-control" name="high_school_address" id="high_school_address" value="">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="recipient-name" class="col-form-label">College/University:</label>
            <input form="reservationForm" type="text" class="form-control" name="college_school" id="college_school" value="">
        </div>
        <div class="col">
            <label for="recipient-name" class="col-form-label">Address:</label>
            <input form="reservationForm" type="text" class="form-control" name="college_school_address" id="college_school_address" value="">
        </div>
    </div>
    <div class="row">
        <div class="col">
          <label for="recipient-name" class="col-form-label">Course:</label>
          <input form="reservationForm" type="text" class="form-control" name="course" id="course" value="">
        </div>
        <div class="col">
          <label for="recipient-name" class="col-form-label">Year Level:</label>
          <select form="reservationForm" class="form-control" name="year_level" id="">
            <option value="">Please select one</option>
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
      <h5>Employment Background (for working)</h5>
    <hr>
    <div class="row">
        <div class="col">
            <label for="recipient-name" class="col-form-label">Employer/Company:</label>
            <input form="reservationForm" type="text" class="form-control" name="employer" id="emplloyer" value="">
        </div>
        <div class="col">
            <label for="recipient-name" class="col-form-label">Job Description/Position:</label>
            <input form="reservationForm" type="text" class="form-control" name="job" id="job" value="">
        </div>
        <div class="col">
            <label for="recipient-name" class="col-form-label">Years of Employment:</label>
            <input form="reservationForm" type="number" class="form-control" name="years_of_employment" id="years_of_employment" value="">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="recipient-name" class="col-form-label">Contact No:</label>
            <input form="reservationForm" type="text" class="form-control" name="employer_contact_no" id="employer_contact_no" value="">
        </div>
        <div class="col">
            <label for="recipient-name" class="col-form-label">Address:</label>
            <input form="reservationForm" type="text" class="form-control" name="employer_address" id="employer_address" value="">
        </div>
    </div>
    <br>
    <h5>Contract Duration</h5>
    <hr>
    <div class="row">
        <div class="col">
          <label for="recipient-name" class="col-form-label">Move In Date:</label>
          <input form="reservationForm" type="date" class="form-control" name="movein_date" id="movein_date" value={{date('Y-m-d')}} required>
        </div>
        <div class="col">
          <label for="recipient-name" class="col-form-label">Move Out Date:</label>
          <input onkeyup="duration()" form="reservationForm" type="date" class="form-control" name="moveout_date" value="" required>
        </div>
        {{-- <div class="col"> --}}
            {{-- <label for="recipient-name" class="col-form-label">Monthly Rent:</label> --}}
            <input form="reservationForm" type="hidden" class="form-control" name="tenant_monthly_rent" id="tenant_monthly_rent" value="{{ $unit->monthly_rent }}" required readonly>
        {{-- </div> --}}
      </div>
      <br><br>
      <h5>Payment Requirements</h5>
    <h5><p class="text-right" id="total_bills">Total: </p></h5>
    <div class="row">
        <div class="col">
             <table class="table" id="tab_logic">
                 <tr>
                     <th class="text-center">#</th>
                     <th>Description</th>
                     <th>Amount</th>
                 </tr>
                     <input form="reservationForm" type="hidden" id="no_of_items" name="no_of_items" value="3">
                 <tr id='addr0'>
                     <th class="text-center">1</th>
                     <td><input form="reservationForm"  type="text" name='desc0' id='desc0' class="form-control" value="Security Deposit (Rent)" readonly/></td>
                     <td><input oninput="this.value = Math.abs(this.value)" form="reservationForm"  onkeyup="computeTotal()" type="number" name='amt0' id='amt0' class="form-control" value="{{ $unit->monthly_rent }}" readonly/></td>
                 </tr>
                 <tr id='addr1'>
                    <th class="text-center">2</th>
                    <td><input form="reservationForm"  type="text" name='desc1' id='desc1' class="form-control" value="Security Deposit (Utilities)" readonly/></td>
                    <td><input oninput="this.value = Math.abs(this.value)" form="reservationForm"  onkeyup="computeTotal()" type="number" name='amt1' id='amt1' class="form-control" value="2000" readonly/></td>
                </tr>
                 <tr>
                     <th class="text-center">3</th>
                    <td><input form="reservationForm"  type="text" name='desc2' id='desc2' class="form-control" value="Advance Rent" readonly/></td>
                    <td><input oninput="this.value = Math.abs(this.value)" form="reservationForm"  onkeyup="computeTotal()" type="number" name='amt2' id='amt2' class="form-control" value="{{ $unit->monthly_rent }}" readonly/></td>
                 </tr>
                 <tr id='addr2'></tr>
             </table>      
        </div>
        
       </div>
       <br>
       <p class="text-right">   
            <a href="/units/" class="btn btn-secondary"><i class="fas fa-times"></i> cancel</a>
           <button type="submit" form="reservationForm" class="btn btn-primary"><i class="fas fa-check"></i> save</button>
       </p>
       {{-- <br>
       <h4>Leasing Agreement</h4>
       <div class="row">
           <div class="col">
           <ol>
               <li> 
                <input form="reservationForm" type="checkbox" class="form-check-input" required>
                   <label class="form-check-label" for="exampleCheck1">Please check if you agree to the terms and conditions.</label>
                </li>
                
           </ol>
            
        </div>
        
       </div> --}}
        
       
    
</div>
<script type="text/javascript">
    $(document).ready(function(){
       document.getElementById('total_bills').innerHTML = 'Total:  ' + (parseFloat(document.getElementById('amt0').value) + parseFloat(document.getElementById('amt1').value) + parseFloat(document.getElementById('amt2').value)).toFixed(2).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
       });
          
   function computeTotal(){
       document.getElementById('total_bills').innerHTML = 'Total:  ' + (parseFloat(document.getElementById('amt0').value) + parseFloat(document.getElementById('amt1').value) + parseFloat(document.getElementById('amt2').value)).toFixed(2).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
   }
       
   </script>
@endsection








