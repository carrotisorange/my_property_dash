@extends('layouts.app')
@section('title', $tenant->first_name.' '.$tenant->last_name)
@section('content')
<div class="container">
    <h4>payment history ({{ $payments->count() }})</h4>
    <table class="table table-bordered table-striped">
        <tr>
            <th class="text-center">#</th>
            <th>date paid</th>
            <th>amount</th>
            <th>form of payment</th>
            <th>description</th>
            
        </tr>
        <?php $ctr = 1; ?> 
        @foreach ($payments as $item)
         @if($payments->count() <= 0)
        <tr>
            <td colspan="6" class="text-center">No payments found!</td>
        </tr>
        @else
        <tr>
            <th class="text-center">{{ $ctr++ }}</th>
            <td>{{ Carbon\Carbon::parse($item->payment_created)->format('M d Y') }}</td>
            <td><a href="/units/{{ $item->unit_tenant_id }}/tenants/{{ $item->tenant_id }}/payments/{{ $item->payment_id }}">{{ number_format($item->amt_paid,2) }}</a></td>
            <td>{{ $item->form_of_payment }}</td>
            <td>{{ $item->payment_note }}</td>
            {{-- <td>
                <form action="/payments/{{ $item->payment_id }}" method="POST">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td> --}}
        </tr>
        @endif
        @endforeach
    </table>
</div>
@endsection