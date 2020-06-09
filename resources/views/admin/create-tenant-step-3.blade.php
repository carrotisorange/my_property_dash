@extends('layouts.app')
@section('title', session(Auth::user()->property.'building').' '.session(Auth::user()->property.'unit_no').' '.'(Step 3 of 4)')
@section('content')
<div class="container">
    <form id="addTenantForm3" action="/units/{{ session(Auth::user()->property.'unit_id') }}/tenant-step3" method="POST">
        {{ csrf_field() }}
    </form>
    <h4>Contract Duration (3/4)</h4>
    <hr>
    <div class="row">
        <div class="col">
          <label for="recipient-name" class="col-form-label">Move In Date:</label>
          <input form="addTenantForm3" type="date" class="form-control" name="movein_date" id="movein_date" value={{date('Y-m-d')}} required>
        </div>
        <div class="col">
          <label for="recipient-name" class="col-form-label">Move Out Date:</label>
          <input onkeyup="duration()" form="addTenantForm3" type="date" class="form-control" name="moveout_date" value="{{ session(Auth::user()->property.'moveout_date') }}" id="moveout_date" required>
        </div>
        <div class="col">
            <label for="recipient-name" class="col-form-label">Monthly Rent:</label>
            <input form="addTenantForm3" type="number" class="form-control" name="tenant_monthly_rent" min="1" id="tenant_monthly_rent" value="{{ session(Auth::user()->property.'tenant_monthly_rent') }}" required>
        </div>
      </div>
        <br>
        <p class="text-right">   
            <a href="/units/{{ session(Auth::user()->property.'unit_id') }}/tenant-step2" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> prev</a>
            <button type="submit" form="addTenantForm3" class="btn btn-primary"><i class="fas fa-arrow-right"></i> next</button>
        </p>
    
</div>
@endsection








