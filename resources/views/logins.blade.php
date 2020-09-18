<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Logins</title>

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
                                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                              <h6 class="m-0 font-weight-bold text-primary">UNITS </h6>
                                              <div class="dropdown no-arrow">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                </a> 
                                                 <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                                  {{-- <div class="dropdown-header">Dropdown Header:</div> --}}
                                                  <a class="dropdown-item" target="_blank" href="/logins">See All</a>
                                                  {{-- <a class="dropdown-item" href="#">Another action</a>
                                                  <div class="dropdown-divider"></div>
                                                  <a class="dropdown-item" href="#">Something else here</a> --}}
                                                </div> 
                                              </div>
                                            </div>
                                       
                                           <div class="card-body">
                                            <div class="table-responsive text-nowrap">
                                                <table class="table table-striped">
                                                  @foreach ($sessions as $day => $logins)
                                                    <tr>
                                                        <th colspan="6">{{ Carbon\Carbon::parse($day)->format('M d Y') }} ({{ $logins->count() }})</th>
                                                    </tr>
                                                    <tr>
                                                        <th>USER</th>
                                                        <th>EMAIL</th>
                                                        <th>ROLE</th>
                                                        <th>PROPERTY</th>
                                                        <th>LOGIN AT</th>
                                                        <th>STATUS</th>
                                                           
                                                    </tr>
                                                  </tr>
                                                    @foreach ($logins as $item)
                                                    <tr>
                                                        
                                      <td><a href="/users/{{ $item->id }}">{{ $item->name }}</a></td>
                                      <td>{{ $item->email }}</td>
                                      <td>{{ $item->user_type }}</td>
                                      <td>{{ $item->property }}</td>
                                      <td>{{ Carbon\Carbon::parse($item->session_last_login_at)->toTimeString() }}</td>
                                      <?php  
                                                                    $diffInMinutes = Carbon\Carbon::parse($item->last_logout_at)->diffInMinutes();
                                                                    $diffInHours = Carbon\Carbon::parse($item->last_logout_at)->diffInHours();
                                                                    $diffInDays = Carbon\Carbon::parse($item->last_logout_at)->diffInDays()
                                                                 ?>
                                                                 <td>
                                                                    @if($item->user_current_status === 'online')
                                                                   <span class="badge badge-success"> {{ $item->user_current_status }}</span>
                                                                   @else
                                                                    @if($diffInMinutes < 60)
                                                                    <span class="badge badge-secondary"> {{ $diffInMinutes }} minutes ago</span> 
                                                                      @elseif($diffInHours > 24)
                                                                      <span class="badge badge-secondary"> {{ $diffInDays }} days ago</span>
                                                                      @else
                                                                      <span class="badge badge-secondary">  {{ $diffInHours }} hours ago</span>
                                                                      @endif
                                                                   @endif
                                                                  </td>                                                             
                                                    </tr>
                                                    @endforeach
                                                        
                                                  @endforeach
                                              </table>
                                               </div>
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
