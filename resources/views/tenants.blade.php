@extends('layouts.app')
@section('title', 'Tenants')
@section('content')
<div class="container">
    <div class="justify-content-center">
        <form action="/tenants/search" method="GET" >
            @csrf
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search tenants" value="{{ session(Auth::user()->property.'search_tenant') }}">
            </div>
        </form>
        <br>
        <p class="text-center"><small ><b>{{ $tenants->count() }}</b> units found.</small></p>
            <table class="table table-striped">
                <thead>
                 <tr>
                     <th class="text-center">#</th>
                     <th>name</th>
                     <th>unit no</th>
                     <th>contact no</th>
                     <th>monthly rent</th>
                     <th>contract expires in</th>    
                </tr>
                </thead>
                <?php
                  $ctr = 1;
                ?>   
                <tbody>
                @foreach ($tenants as $item)
                <tr>
                    <th class="text-center">{{ $ctr++ }}</th>
                    <td>
                        @if(Auth::user()->user_type === 'admin')
                        <a href="{{ route('show-tenant',['unit_id'=> $item->unit_id, 'tenant_id'=>$item->tenant_id]) }}">{{ $item->first_name.' '.$item->last_name }}</a>
                        @elseif(Auth::user()->user_type === 'treasury')
                        <a href="/units/{{ $item->unit_id }}/tenants/{{ $item->tenant_id }}/billings">{{ $item->first_name.' '.$item->last_name }}</a>
                        @endif

                        @if($item->tenant_status === 'active')
                        <a class="badge badge-primary">{{ $item->tenant_status }}</a>
                        @elseif($item->tenant_status === 'inactive')
                        <a class="badge badge-secondary">{{ $item->tenant_status }}</a>
                        @else
                        <a class="badge badge-warning">{{ $item->tenant_status }}</a>
                        @endif
                    </td>
                    <td>{{ $item->unit_no }}</td>
                    <td>{{ $item->contact_no }}</td>
                    <td>{{ number_format($item->tenant_monthly_rent,2) }}</td>
                    <td title="months before move-out">{{ number_format(Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse($item->moveout_date), false)/30,1) }} mon</td>
                    
                </tr>
                @endforeach
                </tbody>
             </table>
    </div>
</div>
@endsection








