@extends('layouts.app')
@section('title', 'Posted bills')
@section('content')
<div class="container">
    <table id="billing" class="table table-bordered table-striped">
        <tr>
            <th class="text-center">#</th>
            <th>billing date</th>
            <th>name</th>
            <th>unit no</th>
            <th>description</th>
            <th>details</th>
            <th>amount</th>
        </tr>
        <?php $ctr = 1;?> 
        @foreach ($billings as $item)
        <tr>
            <th class="text-center">{{ $ctr++ }}</th>
            
            <td>{{ Carbon\Carbon::parse($item->billing_date)->format('M d Y') }}</td>
            <td>{{ $item->first_name.' '.$item->last_name }}</td>
            <td>{{ $item->building.' '.$item->unit_no }}</td>
            <td>{{ $item->billing_desc }}</td>
            <td>{{ $item->details }}</td>
            <td>{{ number_format($item->billing_amt,2) }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection