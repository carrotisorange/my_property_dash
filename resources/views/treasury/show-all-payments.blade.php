@extends('layouts.app')
@section('title', 'Payments')
@section('content')
<div class="container">
    <form action="/payments/search" method="GET" >
        @csrf
        <div class="input-group">
            <input type="date" class="form-control" value="{{ session(Auth::user()->property.'search_payment') }}" name="search" onchange='this.form.submit()'>
        </div>
    </form>
    <br>
    <table class="table table-striped table-bordered">
        <tr>
           <th class="text-center"># </th>
           <th>name</th>
           <th>unit no</th>
           <th>form of payment</th>
           <th>description</th>
           <th>amount</th>
           <th></th>
       </tr>
       <?php $ctr = 1; ?>   
       @if($payments->count() <= 0)
       <tr>
           <td colspan="6" class="text-center">No payments found!</td>
       </tr>
       @else
       @foreach ($payments as $item)
       <tr>
           <th class="text-center">{{ $ctr++ }}</th>
           <td>{{ $item->first_name.' '.$item->last_name }}</td>
           <td>{{ $item->building.' '.$item->unit_no }}</td>
           <td>{{ $item->form_of_payment }}</td>
           <td>{{ $item->payment_note }}</td>
           <td>{{ number_format($item->amt_paid,2) }}</td>
           <td><a href="/units/{{ $item->unit_tenant_id }}/tenants/{{ $item->tenant_id }}/payments/{{ $item->payment_id }}">View Details</a></td>
           
       </tr>
       @endforeach
       <th colspan="5">TOTAL</th>
       <th>{{ number_format($payments->sum('amt_paid'),2) }}</th>
       <td></td>
       @endif
    </table>
</div>
@endsection