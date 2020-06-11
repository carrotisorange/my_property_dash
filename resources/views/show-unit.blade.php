@extends('layouts.app')
@section('title', $unit->building.' '.$unit->unit_no)
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <button type="button" title="edit room information." class="btn btn-primary" data-toggle="modal" data-target="#editUnit" data-whatever="@mdo"><i class="fas fa-edit"></i>edit</button> 
            @if ($tenant_active->count() < $unit->beds)
            <button title="{{ $unit->beds - $tenant_active->count() }} remaining tenant/s to be fully occupied." type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                <i class="fas fa-user-plus"></i> tenant <span class="badge badge-light">{{  $tenant_active->count() }}/{{ $unit->beds }} 
              </button>
              <div class="dropdown-menu">
                  <a href="/units/{{ $unit->unit_id }}/tenant-step1" class="dropdown-item" >Student</a>
                  {{-- <a href="/units/{{ $unit->unit_id }}/tenants-working-step1" class="dropdown-item" >Working</a> --}}
              </div>
            @else
                <button type="button" title="{{ $unit->beds - $tenant_active->count() }} remaining tenant/s to be fully occupied." class="btn btn-primary" data-toggle="modal" data-target="#warningTenant" data-whatever="@mdo"><i class="fas fa-user-plus"></i> add tenant ({{ $tenant_active->count() }}/{{ $unit->beds }})</button>
            @endif
            {{-- if unit owner does not exist in this unit, then show the add investor button, otherwise, hide. --}}
            @if ($unit_owner->count() < 1)
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addInvestor" data-whatever="@mdo"><i class="fas fa-user-plus"></i> investor</button>
            @endif
            <br> <br>
                <?php $numberFormatter = new NumberFormatter('en_US', NumberFormatter::ORDINAL) ?>
                   <table class="table table-bordered table-striped">
                       <tr>
                           <th colspan="2" >Room Information</th>
                       </tr>
                       <tr>
                            <td>unit no</th>
                            <td>{{ $unit->unit_no }}</td>
                       </tr>
                        <tr>
                            <td>building</td>
                            <td>{{ $unit->building }}</td>
                       </tr>
                       <tr>
                            <td>floor no</td>
                            <td>{{ $numberFormatter->format($unit->floor_no) }}</td>
                       </tr>
                       <tr>
                            <td>room type</td>
                            <td>{{ $unit->type_of_units }}</td>
                       </tr>
                       <tr>
                            <td>no of bed</td>
                            <td>{{ $unit->beds }}</td>     
                        </tr>
                        <tr>
                            <td>status</td>
                            <td>{{ $unit->status }}</td>
                        </tr>
                        <tr>
                            <td>monthly rent <br>(excluding utilities)</td> 
                            <td>{{ number_format($unit->monthly_rent,2) }}</td>

                            <?php 
                                session([Auth::user()->property.'tenant_monthly_rent'=> $unit->monthly_rent]);
                                session([Auth::user()->property.'unit_id'=> $unit->unit_id]);
                                session([Auth::user()->property.'unit_no'=> $unit->unit_no]);
                                session([Auth::user()->property.'building'=> $unit->building]);
                            ?>
                        </tr>
                        @if ($unit_owner->count() > 0)
                            @foreach ($unit_owner as $item)
                        
                        <tr>
                            <th colspan="2">Investor Information</th>
                            
                        </tr>
                        <tr>
                            <td>investor </td>
                            <td><a href="{{ route('show-investor',['unit_id'=> $item->unit_id, 'unit_owner_id'=>$item->unit_owner_id]) }}">{{ $item->unit_owner }} </a></td>
                        </tr>
                        <tr>
                            <td>representative</td>
                            <td>{{ $item->investor_representative }}</td>
                        </tr>
                        <tr>
                            <td>contract duration</td>
                            <td>
                                @if($item->contract_end == NULL)
                                    {{ Carbon\Carbon::parse($item->contract_start)->format('M d Y') }} (Renewable) 
                                @else
                                    {{ Carbon\Carbon::parse($item->contract_start)->format('M d Y') .'-'. Carbon\Carbon::parse($item->contract_end)->format('M d Y')  }} 
                                @endif
                            </td>
                        </tr>
                            @endforeach
                        @endif
                   </table>
        </div>
    
        
        <div class="col-md-6">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="pills-active-tab" data-toggle="pill" href="#active" role="tab" aria-controls="pills-active" aria-selected="true"><i class="fas fa-user-check"></i>&nbsp&nbspcurrent tenants  <span class="badge badge-light">{{ $tenant_active->count() }}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-reserved-tab" data-toggle="pill" href="#reserved" role="tab" aria-controls="pills-reserved" aria-selected="false"><i class="fas fa-user-clock"></i>&nbsp&nbspreserved tenants <span class="badge badge-light">{{ $tenant_reservations->count() }}</a>
                  </li>
                <li class="nav-item">
                  <a class="nav-link" id="pills-inactive-tab" data-toggle="pill" href="#inactive" role="tab" aria-controls="pills-inactive" aria-selected="false"><i class="fas fa-user-times"></i>&nbsp&nbspprevious tenants <span class="badge badge-light">{{ $tenant_inactive->count() }}</a>
                </li>
                
              </ul>
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="pills-active-tab">  
                    <table class="table table-borderless">
                        @if($tenant_active->count() <= 0)
                        <tr>
                            <br><br><br>
                            <p class="text-center">No tenants found!</p>
                        </tr>
                        @else
                        <tr>
                            <th class="text-center">#</th>
                            <th>name</th>
                            <th>status</th>
                            <th>contract</th>   
                                     
                            <th></th>
                        </tr>
                        <?php
                            $ctr = 1;
                        ?>   
                    @foreach ($tenant_active as $item)
                        <tr>
                            <th class="text-center">{{ $ctr++ }}</th>
                            <td><a href="{{ route('show-tenant',['unit_id'=> $item->unit_id, 'tenant_id'=>$item->tenant_id]) }}">{{ $item->first_name.' '.$item->last_name }} </a></td>
                            <td> 
                                @if($item->tenant_status === 'active')
                                <a class="badge badge-primary">{{ $item->tenant_status }}</a>
                                @elseif($item->tenant_status === 'inactive')
                                <a class="badge badge-secondary">{{ $item->tenant_status }}</a>
                                @else
                                <a class="badge badge-warning">{{ $item->tenant_status }}</a>
                                @endif
                            </td>
                            <td>{{ Carbon\Carbon::parse($item->movein_date)->format('M d Y').'-'.Carbon\Carbon::parse($item->moveout_date)->format('M d Y') }}</td>
                           
                            <th title="before moveout">{{ Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse($item->moveout_date), false) }} days left</th>
                        </tr>
                    @endforeach
                        @endif                        
                    </table>
                </div>
                <div class="tab-pane fade" id="inactive" role="tabpanel" aria-labelledby="pills-inactive-tab">
                    <table class="table table-borderless">
                        @if($tenant_inactive->count() <= 0)
                        <tr>
                            <br><br><br>
                            <p class="text-center">No tenants found!</p>
                        </tr>
                        @else
                        <tr>
                            <th class="text-center">#</th>
                            <th>name</th>
                            <th>status</th>
                            <th>moveout since</th>   
                                     
                            <th></th>
                        </tr>
                        <?php
                            $ctr = 1;
                        ?>   
                    @foreach ($tenant_inactive as $item)
                        <tr>
                            <th class="text-center">{{ $ctr++ }}</th>
                            <td><a href="{{ route('show-tenant',['unit_id'=> $item->unit_id, 'tenant_id'=>$item->tenant_id]) }}">{{ $item->first_name.' '.$item->last_name }} </a></td>
                            <td>
                                @if($item->tenant_status === 'active')
                                <a class="badge badge-primary">{{ $item->tenant_status }}</a>
                                @elseif($item->tenant_status === 'inactive')
                                <a class="badge badge-secondary">{{ $item->tenant_status }}</a>
                                @else
                                <a class="badge badge-warning">{{ $item->tenant_status }}</a>
                                @endif
                            </td>
                            <td>{{ Carbon\Carbon::parse($item->moveout_date)->format('M d Y') }}</td>
                        </tr>
                    @endforeach
                        @endif                        
                    </table>
                </div>
                <div class="tab-pane fade" id="reserved" role="tabpanel" aria-labelledby="pills-reserved-tab">
                    <table class="table table-borderless">
                        @if($tenant_reservations->count() <= 0)
                        <tr>
                            <br><br><br>
                            <p class="text-center">No tenants found!</p>
                        </tr>
                        @else
                        <tr>
                            <th class="text-center">#</th>
                            <th>name</th>
                            <th>reserved via</th>
                            <th>reservation date</th>   
                                     
                            <th></th>
                        </tr>
                        <?php
                            $ctr = 1;
                        ?>   
                    @foreach ($tenant_reservations as $item)
                        <tr>
                            <th class="text-center">{{ $ctr++ }}</th>
                            <td><a href="{{ route('show-tenant',['unit_id'=> $item->unit_id, 'tenant_id'=>$item->tenant_id]) }}">{{ $item->first_name.' '.$item->last_name }} </a></td>
                            @if($item->type_of_tenant === 'online')
                            <td><a class="badge badge-success">{{ $item->type_of_tenant }}</td>
                            @else
                            <td><a class="badge badge-warning">{{ $item->type_of_tenant }}</td>
                            @endif
                            <td>{{ Carbon\Carbon::parse($item->created_at)->format('M d Y') }}</td>
                            <th>{{ Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse($item->created_at)->addDays(7), false) }} days before exp</th>
                        </tr>
                    @endforeach
                        @endif                        
                    </table>
                </div>
              </div>
        </div>        
    </div>

        {{-- Modal to edit unit --}}

        <div class="modal fade" id="editUnit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form id="editUnitForm" action="/units/{{$unit->unit_id }}" method="POST">
                    @method('put')
                    {{ csrf_field() }}
                </form>
                <div class="modal-body">
                <form>
                    <div class="form-group">
                    <label for="recipient-name" class="col-form-label">unit no</label>
                    <input form="editUnitForm" type="text" value="{{ $unit->unit_no }}" name="unit_no" class="form-control" id="unit_no" >
                    </div>
                    <div class="form-group">
                    <label for="message-text" class="col-form-label">Floor No:</label>
                    <select form="editUnitForm" id="floor_no" name="floor_no" class="form-control">
                        <option value="{{ $unit->floor_no }}" readonly selected class="bg-primary">{{ $unit->floor_no }}</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">5</option>
                        <option value="5">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">building:</label>
                        <input form="editUnitForm" type="text" value="{{ $unit->building }}" name="building" class="form-control">
                        {{-- <select form="editUnitForm" id="building" name="building" class="form-control">
                            <option value="{{ $unit->building }}" readonly selected class="bg-primary">{{ $unit->building }}</option>
                            @foreach ($units_per_building as $item)
                            <option value="{{ $item->building }}">{{ $item->building }}</option>
                           @endforeach
                        </select> --}}
                        </div>
                    <div class="form-group">
                    <label for="message-text" class="col-form-label">room type</label>
                    <select form="editUnitForm" id="type_of_units" name="type_of_units" class="form-control">
                        <option value="{{ $unit->type_of_units }}" readonly selected class="bg-primary">{{ $unit->type_of_units }}</option>
                        <option value="leasing">leasing</option>
                        <option value="commercial">commercial</option>
                        <option value="residential">residential</option>
                    </select>
                    </div>
                    <div class="form-group">
                    <label for="message-text" class="col-form-label">beds</label>
                    <input form="editUnitForm" min="1" max="4" type="number" value="{{ $unit->beds }}" name="beds" class="form-control">
                    </div>
                    <div class="form-group">
                    <label for="message-text" class="col-form-label">status</label>
                    <select form="editUnitForm" id="status" name="status" class="form-control">
                        <option value="{{ $unit->status }}" readonly selected class="bg-primary">{{ $unit->status }}</option>
                        <option value="vacant">vacant</option>
                        <option value="occupied">occupied</option>
                        <option value="reserved">reserved</option>
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">monthly rent</label>
                        <input form="editUnitForm" min="1" type="number" value="{{ $unit->monthly_rent }}" name="monthly_rent" class="form-control">
                        </div>
                </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> close</button>
                <button form="editUnitForm" type="submit" class="btn btn-primary" ><i class="fas fa-check"></i> save</button>
                </div>
            </div>
            </div>
        </div>

        {{-- Modal to add investor --}}
        <div class="modal fade" id="addInvestor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Investor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form id="addInvestorForm" action="/units" method="POST">
                    {{ csrf_field() }}
                </form>
                <div class="modal-body">
                    <input form="addInvestorForm" type="hidden" value="{{ $unit->unit_id }}" name="unit_id">
                    {{-- <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Date Invested:</label>
                    <input form="addInvestorForm" type="date" value="{{ date("Y-m-d")  }}" class="form-control" name="date_invested" id="date_invested">
                    </div> --}}

                    <div class="form-group">
                    <label for="message-text" class="col-form-label">name</label>
                    <input form="addInvestorForm" type="text"  value="{{ $unit->unit_owner }}" class="form-control" name="unit_owner" id="unit_owner" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">email address</label>
                        <input form="addInvestorForm" type="email" class="form-control" name="investor_email_address" id="investor_email_address">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">contact no</label>
                        <input form="addInvestorForm" type="text" class="form-control" name="contact_no" id="contact_no">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">address</label>
                        <input form="addInvestorForm" type="text" class="form-control" name="investor_address" id="investor_address"    >
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">representative</label>
                        <input form="addInvestorForm" type="text" class="form-control" name="investor_representative" id="investor_representative">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label"><b>contract duration</b></label>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="recipient-name" class="col-form-label">start</label>
                            <input form="addInvestorForm" type="date" class="form-control" name="contract_start" id="contract_start">
                        </div>
                        <div class="col">
                            <label for="recipient-name" class="col-form-label">end</label>
                            <input form="addInvestorForm" type="date" class="form-control" name="contract_end" id="contract_end">
                        </div>
                    </div>
                 <br>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label"><b>bank details</b></label>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">bank name</label>
                        <input form="addInvestorForm" type="text" class="form-control" name="bank_name" id="bank_name">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">account name</label>
                        <input form="addInvestorForm" type="text" class="form-control" name="account_name" id="account_name">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">account number</label>
                        <input form="addInvestorForm" type="text" class="form-control" name="account_number" id="account_number">
                    </div>

                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> close</button>
                <button form="addInvestorForm" type="submit" class="btn btn-primary" ><i class="fas fa-check"></i> save</button>
                </div>
            </div>
            </div>
        </div>


                   {{-- Modal for warning message --}}
                   <div class="modal fade" id="warningTenant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Error Adding Tenant</h5>
                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                           <p class="text-center">
                                The room is fully occupied.
                           </p>
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
@endsection







