<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Units | Edit</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('dashboard/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css"><link href="{{ asset('index/assets/img/favicon.ico') }}" rel="icon">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <!-- Custom styles for this template-->
  <link href="{{ asset('dashboard/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">


        <!-- End of Topbar -->
        <div class="container-fluid">
            <br>
                                    <!-- Content Row -->
                                    <div class="row">
                  
                                        <!-- Content Column -->
                                        <div class="col-lg-12 mb-4">
                                          <!-- DataTales Example -->
                                          <div class="card shadow mb-4">
                                            {{-- <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                              <h6 class="m-0 font-weight-bold text-primary">LOGINS HISTORY </h6>
                                              <div class="dropdown no-arrow">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                </a> 
                                                 <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink"> --}}
                                                  {{-- <div class="dropdown-header">Dropdown Header:</div> --}}
                                                  {{-- <a class="dropdown-item" target="_blank" href="/logins">See All</a> --}}
                                                  {{-- <a class="dropdown-item" href="#">Another action</a>
                                                  <div class="dropdown-divider"></div>
                                                  <a class="dropdown-item" href="#">Something else here</a> --}}
                                                {{-- </div> 
                                              </div>
                                            </div> --}}
                                       
                                           <div class="card-body">
                                            <div class="table-responsive text-nowrap">
                                                <form id="editUnitsForm" action="/units/edit/{{ Auth::user()->property }}" method="POST">
                                                    
                                                    {{ csrf_field() }}
                                                </form>
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Unit No</th>
                                                            <th>Room Type</th>
                                                            <th>Status</th>
                                                            <th>Building</th>
                                                            <th>Floor No</th>
                                                            <th>Max Occupancy</th>
                                                            <th>Monthly Rent</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody> 
                                                        <?php 
                                                            $ctr = 1;
                                                            $unit_id = 1;
                                                            $unit_no = 1;
                                                            $type_of_units = 1;
                                                            $status =1;
                                                            $building =1;
                                                            $floor_no = 1;
                                                            $max_occupancy =1;
                                                            $monthly_rent = 1;
                                                        ?>
                                                        @foreach ($units as $item)
                                                            <tr>
                                                                <th> {{ $ctr++ }}</th>
                                                                <td>
                                                                  <input form="editUnitsForm" type="text" name="unit_no{{ $unit_no++  }}" id="" value="{{ $item->unit_no }}">
                                                                  <input form="editUnitsForm" type="hidden" name="unit_id{{ $unit_id++  }}" id="" value="{{ $item->unit_id }}">
                                                                </td>
                                                                <td>
                                                                  <select form="editUnitsForm" type="text" name="type_of_units{{ $type_of_units++  }}">
                                                                    <option value="{{ $item->type_of_units }}" readonly selected class="bg-primary">{{ $item->type_of_units }}</option>
                                                                    <option value="commercial">commercial</option>
                                                                    <option value="residential">residential</option>
                                                                </select>
                                                                 
                                                                </td>
                                                                <td>
                                                                  <select form="editUnitsForm" type="text" name="status{{ $status++  }}" id="" >
                                                                    <option value="{{ $item->status }}" readonly selected class="bg-primary">{{ $item->status }}</option>
                                                                    <option value="vacant">vacant</option>
                                                                    <option value="occupied">occupied</option>
                                                                    
                                                                    <option value="reserved">reserved</option>
                                                                </select>
                                                                
                                                                </td>
                                                                <td><input form="editUnitsForm" type="text" name="building{{ $building++  }}" id="" value="{{ $item->building }}"></td>
                                                                <td>
                                                                  <select form="editUnitsForm" type="number" name="floor_no{{ $floor_no++ }}">
                                                                    <option value="{{ $item->floor_no }}" readonly selected class="bg-primary">{{ $item->floor_no }}</option>
                                                                    <option value="-5">5th basement</option>
                                                                    <option value="-4">4th basement</option>
                                                                    <option value="-3">3rd basement</option>
                                                                    <option value="-2">2nd basement</option>
                                                                    <option value="-1">1st basement</option>
                                                                     
                                                                      <option value="1">1st floor</option>
                                                                      <option value="2">2nd floor</option>
                                                                      <option value="3">3rd floor</option>
                                                                      <option value="4">4th floor</option>
                                                                      <option value="5">5th floor</option>
                                                                      <option value="6">6th floor</option>
                                                                      <option value="7">7th floor</option>
                                                                      <option value="8">8th floor</option>
                                                                      <option value="9">9th floor</option>
                                                                  </select>
                                                                 
                                                                </td>
                                                                <td><input form="editUnitsForm" type="number" name="max_occupancy{{ $max_occupancy++  }}" id="" value="{{ $item->max_occupancy }} "> pax</td>
                                                                <td><input form="editUnitsForm" type="number" step="0.001" name="monthly_rent{{ $monthly_rent++  }}" id="" value="{{$item->monthly_rent }}"></td>
                                                                <td>
                                                                  <form action="/units/{{ $item->unit_id }}" method="POST">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button title="remove this bill" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"  onclick="return confirm('Are you sure you want perform this action?');"><i class="fas fa-times fa-sm text-white-50"></i></button>
                                                                  </form> 
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                  
                                              </table>
                                               </div>
                                               <br>
                                               <p class="text-right">
                                                <a href="/home" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</a>
                                                <button type="submit" form="editUnitsForm" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"  onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;"><i class="fas fa-check fa-sm text-white-50"></i> Save Changes</button>
                                            </p>
                                           </div>
                                           
                                         </div>
                                 
                                             </div>
                      
                                   
                                      </div>
        </div>
       
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; The PMO Co 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    
    <!-- End of Content Wrapper -->


  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-danger" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
              Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        </div>
      </div>
    </div>
  </div>



 
</body>

</html>
