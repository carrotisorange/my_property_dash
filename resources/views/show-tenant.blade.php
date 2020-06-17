@extends('layouts.app')
@section('title', $tenant->first_name.' '.$tenant->last_name)
@section('content')
<div class="container">
    <h5 style="text-align:left;">
        <a href="/units/{{ $tenant->unit_tenant_id }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> go back to unit</a>
        <a href="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}/edit" class="btn btn-primary"><i class="fas fa-user-edit"></i> edit</a>  
        <a href="{{ route('show-billings',['unit_id' => $tenant->unit_tenant_id, 'tenant_id'=>$tenant->tenant_id]) }}" class="btn btn-primary"><i class="fas fa-file-invoice-dollar"></i> billing <span class="badge badge-light">{{ $billings->count() }}</span> </a>
        <a href="{{ route('show-payments',['unit_id' => $tenant->unit_tenant_id, 'tenant_id'=>$tenant->tenant_id]) }}" class="btn btn-primary"><i class="fas fa-dollar-sign"></i> payment history <span class="badge badge-light">{{ $payments->count() }}</span></a>
        <span style="float:right;">
            {{-- <form action="/tenants/{{ $tenant->tenant_id }}" method="POST">
                {{ csrf_field() }}
                @method('delete')
                <button type="submit">Delete</button>
            </form> --}}
        <a class="btn btn-primary" data-toggle="modal" data-target="#extendTenant" data-whatever="@mdo"><i class="fas fa-external-link-alt"></i> extend/renew</a>
        @if ($tenant->tenant_status === 'active' || $tenant->tenant_status === 'pending')
            @if($pending_balance > 0)
        <a class="btn btn-danger" data-toggle="modal" data-target="#moveoutTenantWarning" data-whatever="@mdo"><i class="fas fa-sign-out-alt"></i> moveout</a>
            @else
        <a class="btn btn-danger" data-toggle="modal" data-target="#moveoutTenant" data-whatever="@mdo"><i class="fas fa-sign-out-alt"></i> moveout</a>
            @endif
        @else
        @endif
        </span>
    </h5>
    <table class="table table-bordered table-striped">
        <tr>
                <th colspan="2">Personal Information</th>
            </tr>
            <tr>
                <td>Full Name</td>
                <td>{{ $tenant->first_name.' '.$tenant->middle_name.' '.$tenant->last_name }} 
                    @if($tenant->tenant_status === 'active')
                        <a class="badge badge-primary">{{ $tenant->tenant_status }}</a>
                    @elseif($tenant->tenant_status === 'pending')
                        <a class="badge badge-warning">{{ $tenant->tenant_status }}</a>
                    @else
                        <a class="badge badge-danger">{{ $tenant->tenant_status }}</a>
                    @endif
                </td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>{{ $tenant->gender }}</td>
            </tr>
            <tr>
                <td>Birthdate</th>
                <td>{{ Carbon\Carbon::parse($tenant->birthdate)->format('M d Y') }}</td>
            </tr>
            <tr>
                <td>Civil Status</td>
                <td>{{ $tenant->civil_status }}</td>
            </tr>
            <tr>
                <td>ID/ID Number</td>
                <td>{{ $tenant->id_number }}</td>
            </tr>
            <tr>
                <td>Address</td>
                <td>{{ $tenant->barangay.', '.$tenant->city.', '.$tenant->province.', '.$tenant->country.', '.$tenant->zip_code }}</td>
            </tr>
            <tr>
                <th colspan="2">Contact Information</th
            </tr>
            <tr>
                <td>Contact No</td>
                <td>{{ $tenant->contact_no }}</td>
            </tr>
            <tr>
                <td>Email Address</td>
                <td>{{ $tenant->email_address }}</td>
            </tr>
            <tr>
                <th colspan="2">Person to contact in case of emergency</th>

            </tr>
            <tr>
                <td>Name</td>
                <td>{{ $tenant->guardian }}</td>
            </tr>
            <tr>
                <td>Relationship with the tenant</td>
                <td>{{ $tenant->guardian_relationship }}</td>
            </tr>
            <tr>
                <td>Contact No</td>
                <td>{{ $tenant->guardian_contact_no }}</td>
            </tr>
        
            <tr>
                <th>Education Background</th>
                <td></td>
            </tr>
            <tr>
                <td>High School</td>
                <td>{{ $tenant->high_school.', '.$tenant->high_school_address }}</td>
            </tr>
            <tr>
                <td>College/University</td>
                <td>{{ $tenant->college_school.', '.$tenant->college_school_address }}</td>
            </tr>
            <tr>
                <td>Course/Year</td>
                <td>{{ $tenant->course.', '.$tenant->year_level }}</td>
            </tr>
          
            <tr>
                <th colspan="2">Employment Information</th>

            </tr>
            <tr>
                <td>Employer</td>
                <td>{{ $tenant->employer}}</td>
            </tr>
            <tr>
                <td>Address</td>
                <td>{{ $tenant->employer_address }}</td>
            </tr>
            <tr>
                <td>Contact No</td>
                <td>{{ $tenant->employer_contact_no }}</td>
            </tr>

            <tr>
                <td>Job description</td>
                <td>{{ $tenant->job }}</td>
            </tr>
            <tr>
                <td>Years of employment</td>
                <td>{{ $tenant->years_of_employment }}</td>
            </tr>
            <tr>
                <th colspan="2">Rental Information</th>
            </tr>
            <tr>
                <td>Monthly Rent</td>
                <td>{{ number_format($tenant->tenant_monthly_rent, 2) }}</td>
            </tr>
            <?php 
                $renewal_history = explode(",", $tenant->renewal_history); 
                $diffInMonths =  number_format(Carbon\Carbon::now()->floatDiffInMonths(Carbon\Carbon::parse($tenant->moveout_date), false));
                $diffInDays =  number_format(Carbon\Carbon::now()->DiffInDays(Carbon\Carbon::parse($tenant->moveout_date), false));
            ?>
            <tr>
                <td>Contract Duration</td>
                <td>{{ Carbon\Carbon::parse($tenant->movein_date)->format('M d Y').'-'.Carbon\Carbon::parse($tenant->moveout_date)->format('M d Y') }} <a class="badge badge-primary">{{ $tenant->has_extended}} 
                    @if( count($renewal_history) > 1)
                    ({{ count($renewal_history)-1 }}x) </a>  
                    @endif
                    @if($diffInDays <= -1)
                    <a class="badge badge-danger">contract has lapsed {{ $diffInDays*-1 }} days ago</a> 
                     @else
                    <a class="badge badge-warning">contract expires in {{ $diffInDays }} days </a>
                     @endif
                    </a>  
                </td>
            </tr>
            
            <tr>
                <td>Contract Renewal History</td>
                <?php $numberFormatter = new NumberFormatter('en_US', NumberFormatter::ORDINAL) ?>
                <td>
                    @for ($i = 1; $i < count($renewal_history); $i++)
                         {{ $numberFormatter->format($i) .' renewal: '.$renewal_history[$i] }}<br>
                    @endfor     
                </td>
            </tr>
            <tr>
                <td>Note</td>
                <td>
                    {{ $tenant->tenants_note }}
                </td>
            </tr>
        </table>
</div>
{{-- Modal to moveout tenant --}}
<div class="modal fade" id="moveoutTenant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Moveout </h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form id="moveoutTenantForm" action="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}" method="POST">
                {{ csrf_field() }}
            </form>
            <input type="hidden" form="moveoutTenantForm" id="unit_tenant_id" name="unit_tenant_id" value="{{ $tenant->unit_tenant_id }}"required>
            <input type="hidden" form="moveoutTenantForm" id="tenant_id" name="tenant_id" value="{{ $tenant->tenant_id }}"required>
            <div class=" row">
                <div class="col">
                    <label for="moveout_date">move out date</label>
                    <input type="date" form="moveoutTenantForm" class="form-control" name="actual_move_out_date" id="actual_moveout_date" value={{date('Y-m-d')}} required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <label for="ex1">reason for moving-out</label>
                      <select form="moveoutTenantForm" class="form-control" name="reason_for_moving_out" id="reason_for_moving_out">
                          <option value="end of contract" selected>end of contract</option>
                          <option value="delinquent">delinquent</option>
                          <option value="force majeure">force majeure</option>
                          <option value="run away">run away</option>
                          <option value="unruly">unruly</option>
                      </select>
                  </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <p>
                        moveout charges
                        @foreach ($security_deposits as $item)
                            <ul>
                                <li>{{ $item->payment_note.' - '. number_format($item->amt_paid,2)}} </li>
                            </ul>
                        @endforeach
                        <span style="float:right">
                            <a id="add_row" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                            <a id='delete_row' class="btn btn-danger"><i class="fas fa-minus"></i></a>
                        </span>
                    </p>
                    <br>
                    <table class = "table table-hover " id="tab_logic">
                        <tr>
                            <th class="text-center">#</th>
                            <th>description</th>
                            <th>amount</th>
                        </tr>
                            <input form="moveoutTenantForm" type="hidden" id="no_of_items" name="no_of_items" >
                        <tr id='addr1'></tr>
                    </table>
                </div>
              </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> cancel</button>
            <button form="moveoutTenantForm" type="submit" class="btn btn-danger" ><i class="fas fa-check"></i> moveout</button>
        </div>
    </div>
    </div>
</div>
</div>

{{-- Modal for renewing tenant --}}
<div class="modal fade" id="extendTenant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Extend/Renew</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form id="extendTenantForm" action="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}/renew" method="POST">
                {{ csrf_field() }}
            </form>

            <div class="row">
                <div class="col">
                    <label for="movein_date">enter the new move in date</label>
                    <input type="date" form="extendTenantForm" class="form-control" name="movein_date" value="{{ $tenant->moveout_date }}" required>
                    {{-- <input type="text" form="" class="form-control" name="" value="{{ Carbon\Carbon::parse($tenant->moveout_date)->format('M d Y') }}" required readonly> --}}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <label for="moveout_date">extend contract to </label>
                    <input type="number" form="extendTenantForm" class="form-control" name="no_of_months" min="1" placeholder="enter no of months" required >
                    <input type="hidden" form="extendTenantForm" class="form-control" name="old_movein_date" value="{{ $tenant->movein_date }}" required>
                </div>
            </div>
             <br>
            
            <div class="row">
                <div class="col">
                    <p>
                        additional charges
                        <small class="text-danger">(optional)</small>
                        <span style="float:right">
                            <a id="add_charges" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                            <a id='remove_charges' class="btn btn-danger"><i class="fas fa-minus"></i></a>
                        </span>
                    </p>
                    <br>
                        <table class = "table table-hover " id="extend_table">
                            <tr>
                                <th class="text-center">#</th>
                                <th>description</th>
                                <th>amount</th>
                            </tr>
                                <input form="extendTenantForm" type="hidden" id="no_of_row" name="no_of_row" >
                                <input form="extendTenantForm" type="hidden" id="current_date" name="current_date" value="{{ date('Y-m-d') }}">
                            
                            <tr id='row1'></tr>
                        </table>
                </div>
              </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> cancel</button>
            <button form="extendTenantForm" type="submit" class="btn btn-primary" ><i class="fas fa-check"></i> extend/renew</button>
        </div>
    </div>
    </div>
</div>

{{-- Modal for warning message --}}
<div class="modal fade" id="moveoutTenantWarning" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tenant can't move out</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
           <p class="text-center">
               Tenant has a pending balance of <a title="click this to see the breakdown" href=#billing>{{ number_format($pending_balance,2) }}</a>.
           </p>
        </div>
    </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        var i=1;
    $("#add_row").click(function(){
        $('#addr'+i).html("<th>"+ (i) +"</th><td><input form='moveoutTenantForm' name='desc"+i+"' id='desc"+i+"' type='text' class='form-control input-md'></td><td><input form='moveoutTenantForm'   name='amt"+i+"' id='amt"+i+"' type='number' min='1' class='form-control input-md'></td>");


     $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
     i++;

     document.getElementById('no_of_items').value = i;
 });

    $("#delete_row").click(function(){
        if(i>1){
        $("#addr"+(i-1)).html('');
        i--;
        document.getElementById('no_of_items').value = i;
        }
    });

        var j=1;
    $("#add_charges").click(function(){
        $('#row'+j).html("<th class='text-center'>"+ (j) +"</th><td><select form='extendTenantForm' name='desc"+j+"' name='desc"+j+"' class='form-control'><option value='Security Deposit (Rent)'>Security Deposit (Rent)</option><option value='Security Deposit (Utilities)'>Security Deposit (Utilities)</option><option value='Advance Rent'>Advance Rent</option></select></td><td><input form='extendTenantForm' name='amt"+j+"' type='number' min='1' class='form-control input-md'></td>");

     $('#extend_table').append('<tr id="row'+(j+1)+'"></tr>');
     j++;
        document.getElementById('no_of_row').value = j;

 });

    $("#remove_charges").click(function(){
        if(j>1){
        $("#row"+(j-1)).html('');
        j--;
        document.getElementById('no_of_row').value = j;
        }
    });
});
</script>

@endsection
