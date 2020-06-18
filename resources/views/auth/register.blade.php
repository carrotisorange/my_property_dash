@extends('layouts.app')
@section('title', 'Register Your Property')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4>The Property Manager</h4>
                    <p>
                        My Property Dash is a property management system that lets landlords manage their property anytime and anywhere with minimal effort. Unlike OTA (Trivago, Agoda, etc.) that allows
                        landlors to advertise their property online as a transient, My Property Dash offers longterm stay for tenants.
                        <br><br>
                        <b>Products:</b>
                        <br>
                        Community Management And Rental Property Management System
                        <br><br>
                        <b>Users of the application</b>
                        <br>
                        <ul>
                            <li>Condomonium Corporations Managers</li>
                            <li>Homeowners Associations Manager</li>
                            
                            <li>Building Owners</li>
                            <li>Real Estate Lessors</li>
                            <li>Leasing Agents</li>
                            <li>Dormitory Operators</li>
                        </ul>
                        
                        <b>Features of the application:</b>
                        <ul>
                            <li>Admin System</li>
                            <li>Billing and collection System</li>
                            <li>Expense Tracker</li>
                            <li>Tenant Information</li>
                            <li>Online Payment System</li>
                            <li>Job Order System</li>
                            <li>Concierge</li>
                            <li>Concerns Portal for Tenant</li>
                            <li>Roles Management</li>
                            <li>Monitoring System</li>
                            <li>Dashboard System</li>
                            <li>Management Informat</li>
                            <li>Online Access for Landlords and unit owners</li>
                        </ul>
                    </p>
                   
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <b>REGISTER YOUR PROPERTY HERE</b>
                    
                    <form method="POST" action="/register">
                        @csrf

                        <div class="row">
                            <div class="col">
                                <label for="name" class="col-form-label">{{ __('name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="email" class="col-form-label">{{ __('email') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="property" class="col-form-label">{{ __('name of your property') }}</label>
                                <input id="property" type="text" class="form-control @error('property') is-invalid @enderror" name="property" value="{{ old('property') }}" required autocomplete="property">

                                @error('property')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="password" class="col-form-label ">{{ __('password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="password-confirm" class=" col-form-label">{{ __('confirm password') }}</label>
                    
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                           
                            </div>
                            
                        </div>
                        <br>
                        <p class="text-right"> 
                            <button type="submit" class="btn btn-primary" id="registerButton" onclick="this.form.submit(); this.disabled = true; this.value = 'Submitting the form';">
                                <i class="fas fa-check"></i> register
                        </button></p>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
