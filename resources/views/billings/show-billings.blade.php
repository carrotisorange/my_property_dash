@extends('layouts.app')
@section('title', $tenant->first_name.' '.$tenant->last_name)
@section('content')
<div class="container">
    @if(Auth::user()->user_type === 'treasury')
    <p><a href="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}/payments" class="btn btn-primary"><i class="fas fa-dollar-sign"></i> see payment history</a>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#acceptPayment"><i class="fas fa-plus"></i> payment</button>
    @endif
    </p>
    <h4 class="text-center text-primary">ACCOUNTING DEPARTMENT</h4>
    <p class="text-center">
        Bareng Drive, Purok 11 Bakakeng Sur, Baguio City, 2600 Philippines
        <br>
        E-mail add: marthagoshenland@yahoo.com.ph; CP No. 09467576159/ 09068758142
    </p>
    <h5 class="text-center">{{strToUpper( Auth::user()->property) }}</h5>
    <table class="table table-borderless">
        <tr>
            <td>To: <b>{{ $tenant->first_name.' '.$tenant->last_name }}</b></td>
            
            <td class="text-right" colspan="2">Date: <b>{{ Carbon\Carbon::now()->firstOfMonth()->format('M d Y') }}</b></td>
        </tr>
        <tr>
            <td>Unit: 
                <b>
                    @foreach($unit_no as $item)
                    {{ $item->building.' '.$item->unit_no }}
                    @endforeach
                </b>
            </td>
            <td colspan="2" class="text-right text-danger">Due Date: <b>{{ Carbon\Carbon::now()->firstOfMonth()->addDays(6)->format('M d Y') }}</b></td>
        </tr>
        <tr>
            <th class="text-center" colspan="3">STATEMENT OF ACCOUNT</th>
        </tr>
        <tr>
            <th class="text-right" colspan="3">Amount</th>
        </tr>
       
        @foreach ($monthly_rent as $item)
        <tr>
            <th>{{ $item->billing_desc }}</th>
            <td>{{ $item->details }}</td>
            <th class="text-right" colspan="3">{{ number_format($item->billing_amt,2) }}</th>
        </tr>
        @endforeach
        
        <tr>
            <th class="text-left" colspan="3">Other Charges</th>
            
        </tr>
    
        @foreach ($other_charges as $item)
        <tr>
            <th>{{ $item->billing_desc }}</th>
            <td>{{ $item->details }}</td>
            <th class="text-right" colspan="3">{{ number_format($item->billing_amt,2) }}</th>
        </tr>
       
        @endforeach
        <tr class="text-primary" >
            <th colspan="2">TOTAL AMOUNT PAYABLE (If paid before due date)</th>
            <th class="text-right">
                {{ number_format($total_bills,2) }} 
            </th>
        </tr>
        {{-- <tr>
            <td colspan="2">ADD: 10% surcharge ON RENT if not paid on due date</td>
            <th class="text-right">
                {{ number_format($total_bills * .1,2) }}
            </th>
        </tr> --}}
        <tr class="text-danger" >
            <th colspan="2">TOTAL AMOUNT PAYABLE AFTER DUE DATE</th>
            <th class="text-right">
                {{ number_format($total_bills + ($total_bills * .1) ,2) }}
            </th>
        </tr>
    </table>
    <br>
    <div class="card">
        <div class="card-body">
            <b>Notice to All Tenants: </b>
                <br>
                Failure to pay the amount due on 7th of the month there will be a 10% surcharge and subject your unit to DISCONNECTION of utilities (water & electric)
                <br>
                THIS SERVES AS YOUR INITIAL NOTICE (DEMAND LETTER)
                You can also deposit your cash/check payment to any BDO Branch:
                <br>
                <b>BDO Account</b>
                <br>
                Account Name: Martha GoshenLand Property Management Inc.
                <br>
                Account Number: 0009-4032-9085
        </div>
    </div>
</div>

{{-- modal for adding payments. --}}

<div class="modal fade" id="acceptPayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">add payment</h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form id="acceptPaymentForm" action="/payments" method="POST">
            {{ csrf_field() }}
            </form>
            
            <div class="form-group row">
                <div class="col">
                    <label for="">Date</label>
                <input form="acceptPaymentForm" type="date" class="form-control" name="payment_created" value={{date('Y-m-d')}} required>
                </div>
            </div>
          
            <div class="form-group row">
                <div class="col">
                    <label for="">Form of Payment</label>
                    <select form="acceptPaymentForm" class="form-control" name="form_of_payment" id="">
                        <option value="cash">cash</option>
                        <option value="bank deposit">bank deposit</option>
                        <option value="cheque">cheque</option>
                    </select>
                </div>
                <div class="col">
                    <label for="">Amount</label>
                    <input form="acceptPaymentForm" type="number" class="form-control" id="" min="1" name="amt_paid" value="{{ $total_bills }}" required>
                </div>
             
                <div class="col">
                    <label for="">Acknowledgment Receipt No</label>
                    <input form="acceptPaymentForm" type="number" class="form-control" id="" name="ar_number">
                </div>
            </div>

            <div class="form-group row">
                <div class="col">
                    <label for="">Bank Name</label>
                    <input form="acceptPaymentForm" class="form-control" type="text" name="bank_name">
                    <small class="text-danger">For bank deposit only</small>
                </div>
                <div class="col">
                    <label for="">Cheque No</label>
                    <input form="acceptPaymentForm" class="form-control" type="text" name="cheque_no">
                    <small class="text-danger">For cheque only</small>
                </div>
            </div>
         
            <input type="hidden" form="acceptPaymentForm" id="payment_tenant_id" name="payment_tenant_id" value="{{ $tenant->tenant_id }}">
            <input type="hidden" form="acceptPaymentForm" id="unit_tenant_id" name="unit_tenant_id" value="{{ $tenant->unit_tenant_id }}">
            <input type="hidden" form="acceptPaymentForm" id="tenant_status" name="tenant_status" value="{{ $tenant->tenant_status }}">
            <div class="form-group row">
                <div class="col">
                    <label for="">Payment description</label>
                    <textarea form="acceptPaymentForm" class="form-control" name="payment_note" required>
                    </textarea>
                    
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> cancel</button>
            <button form="acceptPaymentForm" type="submit" class="btn btn-primary" ><i class="fas fa-check"></i> add</button>
        </div>
 
    </div>
    </div>
</div>
@endsection
