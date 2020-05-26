@extends('layouts.app')
@section('title', 'Payment Details')
@section('content')
<div class="container">
    @foreach ($payment as $item)
    <table class="table table-bordered table-striped">
        <tr>
            <td>Tenant</td>
            <td>{{ $item->first_name.' '.$item->last_name }}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>{{ $item->tenant_status }}</td>
        </tr>
        
        <tr>
            <td>Unit No</td>
            <td>{{ $item->building.' '.$item->unit_no }}</td>
        </tr>
        <tr>
            <td>Payment Made</td>
            <td>{{ Carbon\Carbon::parse($item->payment_created)->format('M d Y') }}</td>
        </tr>
        <tr>
            <td>Official Receipt Number</td>
            <td>{{ $item->or_number }}</td>
        </tr>
        <tr>
            <td>Acknowledgement Receipt Number</td>
            <td>{{ $item->ar_number }}</td>
        </tr>
        <tr>
            <td>Form of Payment</td>
            <td>{{ $item->form_of_payment }}</td>
        </tr>
        <tr>
            <td>Amount Paid</td>
            <td>{{ number_format($item->amt_paid,2) }}</td>
        </tr>
        @if($item->form_of_payment === 'bank deposit')
        <tr>
            <td>Bank Name</td>
            <td>{{ $item->bank_name }}</td>
        </tr>
        @elseif($item->form_of_payment === 'cheque')
        <tr>
            <td>Cheque Number</td>
            <td>{{ $item->check_no }}</td>
        </tr>
        @endif
        <tr>
            <td>Payment Description</td>
            <td>{{ $item->payment_note }}</td>
        </tr>

    </table>
    @endforeach
</div> 
@endsection
