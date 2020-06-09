@extends('layouts.app')
@section('title', 'Post Rental')
@section('content')
<div class="container">
    <form id="add_billings" action="/tenants/billings-post" method="POST">
        {{ csrf_field() }}
        </form>
    <table class="table table-bordered table-striped">
        <tr>
            <th  class="text-center">#</th>
            <th>name</th>
            <th>unit no</th>   
            <th>description</th>  
            <th>details</th>     
            <th>amount</th>
        </tr>
       <?php
         $ctr = 1;
         $desc_ctr = 1;
         $amt_ctr = 1;
         $id_ctr = 1;
         $details_ctr = 1;
       ?>   
       @foreach($active_tenants as $item)
        <tr>
            <th class="text-center">{{ $ctr++ }}</th>   
            
            <td>{{ $item->first_name.' '.$item->last_name }}<input type="hidden" form="add_billings" name="tenant{{ $id_ctr++ }}" value={{ $item->tenant_id }}></td>
            <td>{{ $item->building.' '.$item->unit_no }}</td>
            <td><input class="form-control" type="text" form="add_billings" name="desc{{ $desc_ctr++ }}" value="Monthly Rent" readonly></td>
            <td>
                <input form="add_billings" type="text" class='form-control' name="details{{ $details_ctr++  }}" value="{{ Carbon\Carbon::now()->startOfMonth()->format('M d') }}- {{ Carbon\Carbon::now()->endOfMonth()->format('d Y') }} " >
            </td>
            <td>
                <input form="add_billings" class="form-control" type="number" name="amt{{ $amt_ctr++ }}" value="{{ $item->tenant_monthly_rent }}" oninput="this.value = Math.abs(this.value)">
            </td>
       </tr>
       @endforeach
    </table>
    <p class="text-right">
        <a href="/#billings" class="btn btn-secondary"><i class="fas fa-times"></i> cancel</a>
        <button type="submit" form="add_billings" class="btn btn-primary" onclick="this.form.submit(); this.disabled = true; this.value = 'Submitting the form';"><i class="fas fa-check"></i> post</button>
    </p>
</div>
@endsection