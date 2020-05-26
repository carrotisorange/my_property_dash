@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-2">
          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="v-pills-dashboard-tab" data-toggle="pill" href="#v-pills-dashboard" role="tab" aria-controls="v-pills-dashboard" aria-selected="true"><i class="fas fa-tachometer-alt"></i>&nbsp&nbspDashboard</a>
            <a class="nav-link" id="v-pills-tenants-tab" data-toggle="pill" href="#v-pills-tenants" role="tab" aria-controls="v-pills-tenants" aria-selected="false"> <i class="fas fa-door-closed"></i>&nbsp&nbspTenants</a>
            <a class="nav-link" id="v-pills-investors-tab" data-toggle="pill" href="#v-pills-investors" role="tab" aria-controls="v-pills-investors" aria-selected="false"><i class="fas fa-user-tie"></i>&nbsp&nbspInvestors</a>
            <a class="nav-link" id="v-pills-payments-tab" data-toggle="pill" href="#v-pills-payments" role="tab" aria-controls="v-pills-payments" aria-selected="false"><i class="fas fa-user"></i>&nbsp&nbspPayments</a>
          </div>
        </div>
        <div class="col-10">
          <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-dashboard" role="tabpanel" aria-labelledby="v-pills-dashboard-tab">
                <div class="card">
                    <div class="card-body">
                        <h4>Dashboard ({{ Carbon\Carbon::today()->format('M d Y') }})</h4>
                        <br>
                       
                         <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <b>Collection Rate <span class="text-danger">({{ number_format($current_collection_rate,1) }} %)</span></b>
                                    </div>
                                    <div class="card-body">
                                        {!! $collectionRate->container() !!}  
                                    </div>
                                </div>    
                            </div>   
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <b>Delinquent Accounts </b>
                                    </div>
                                    <div class="card-body">
                                        <table class="table ">
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Unit No</th>
                                                <th>Balance</th>
                                            </tr>
                                            <?php
                                            $ctr = 1;
                                            ?>   
                                            @foreach ($delinquent_accounts as $item)
                                            @if($item->total_payments <=0 )
                                            <tr>
                                                <th>{{ $ctr++ }}</th>
                                                <td>{{ $item->first_name.' '.$item->last_name }}</td>
                                                <td>{{ $item->unit_no }}</td>
                                                <td>{{ number_format($item->total_bills,2) }}</td>
                                            </tr>
                                            @elseif($item->total_bills-($item->total_payments/$item->count_bills) > 0)
                                            <tr>
                                                <th>{{ $ctr++ }}</th>
                                                <td>{{ $item->first_name.' '.$item->last_name }}</td>
                                                <td>{{ $item->unit_no }}</td>
                                                <td>{{ number_format($item->total_bills-($item->total_payments/$item->count_bills),2) }}</td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </table>
                                        
                                    </div>
                                </div>    
                            </div>   
                         </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-tenants" role="tabpanel" aria-labelledby="v-pills-tenants-tab">
                <div class="card">
                    <div class="card-body">
                    <h4>Tenants ({{ $tenants->count() }})</h4>
                        <br>
                        
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-investors" role="tabpanel" aria-labelledby="v-pills-investors-tab">
                <div class="card">
                    <div class="card-body">
                        <h4>Investors ({{ $investors->count() }})</h4>
                        <br>
                        <table class="table table-striped table-bordered">
                            
                             <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Unit No</th>
                             
                                <th>Contract Expires on</th>    
                                </tr>
                            
                            <?php
                              $ctr = 1;
                            ?>   
                            
                            @foreach ($investors as $item)
                            <tr>
                                <th>{{ $ctr++ }}</th>
                                <td><a href="{{ route('show-investor',['unit_id'=> $item->unit_id, 'unit_owner_id'=>$item->unit_owner_id]) }}">{{ $item->unit_owner }} </a></td>
                                <td>{{ $item->unit_no }}</td>
                             
                                <td>{{ Carbon\Carbon::parse($item->contract_end)->format('M d Y') }}</td>
                            </tr>
                            @endforeach
                            
                         </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-payments" role="tabpanel" aria-labelledby="v-pills-payments-tab">
                <div class="card">
                    <div class="card-body">
                        <h4>Payments ({{ $payments->count() }})</h4>
                        <br>
                        
                        <table class="table table-striped table-bordered">
                            <tr>
                               <th>#</th>
                               <th>Name</th>
                               <th>Unit No</th>
                               <th>Form of Payment</th>
                               <th>Amount Paid</th>
                               <th></th>    
                           </tr>
                           
                           <?php
                             $ctr = 1;
                           ?>   
                           @if($payments->count() <= 0)
                           <tr>
                               <td colspan="6" class="text-center">No payments found!</td>
                           </tr>
                           @else
                           @foreach ($payments as $item)
                           <tr>
                               <th>{{ $ctr++ }}</th>
                               <td>{{ $item->first_name.' '.$item->last_name }}</td>
                               <td>{{ $item->unit_no }}</td>
                               <td>{{ $item->form_of_payment }}</td>
                               <td>{{ number_format($item->amt_paid,2) }}</td>
                               <td><a href="{{ route('show-payment',['unit_id'=>$item->unit_id,'tenant_id'=> $item->payment_tenant_id, 'payment_id'=>$item->payment_id]) }}">View Details</a></td>
                           </tr>
                           @endforeach
                           @endif
                        </table>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
     
</div>
<script>
  $(document).ready(() => {
  var url = window.location.href;
  if (url.indexOf("#") > 0){
  var activeTab = url.substring(url.indexOf("#") + 1);
    $('.nav[role="tablist"] a[href="#'+activeTab+'"]').tab('show');
  }

  $('a[role="tab"]').on("click", function() {
    var newUrl;
    const hash = $(this).attr("href");
      newUrl = url.split("#")[0] + hash;
    history.replaceState(null, null, newUrl);
  });
});
</script>
{!! $collectionRate->script() !!}
@endsection


