<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
      body {
          font: normal 7px Verdana, Arial, sans-serif;
          }
    </style>

</head>

<body>

    <!-- End of Topbar -->
    <div class="container">
          <h5 class="text-black-50">{{ Auth::user()->property }} - Moveout Clearance</h5>
          {{-- <p class="text-right"> <b>AR #:</b> </p> --}}
          <p>
            <b>Actual Moveout Date:</b> {{ Carbon\Carbon::parse($tenant->actual_move_out_date)->format('M d Y') }}
            
            <br>
            <b>Room:</b> {{ $unit->building.' '.$unit->unit_no }}</b>
          </p>
      
          <p class="text-justfiy">
              <br>Guard on Duty: 
              <br>
              <br>Pease allow Mr/Ms {{ $tenant->first_name.' '.$tenant->last_name }} for having no liabilities both for the condominium corporation and unit owner. With the vested capacity
              of the undersigned mentioned tenant is hereby allowed to permanently move-out from the {{ Auth::user()->property }}

              
          </p>
          <table class="table table-borderless">
                <tr>
                    <th>
                        _______________________
                        <br>
                        Tenant
                    </th>
                    <th>
                        _______________________
                        <br>
                      
                        Maintenance
                    </th>
                    <th>
                        _______________________
                        <br>
                     
                        Treasury
                    </th>
                </tr>
                <tr>
                    <th>
                        _______________________
                        <br>
                    
                        Leasing Department
                    </th>
                    <th>
                        _______________________
                        <br>
                   
                        Billing
                    </th>
                </tr>
          </table>
          ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
          <p class="text-justify">
             This is to certify that, {{ $tenant->first_name.' '.$tenant->last_name }}, tenant of unit {{ $unit->building.' '.$unit->unit_no }} is cleared from all his/her
             obligations (monthly rentals, utilities, and moveout charges) from the {{ Auth::user()->property }} and is permitted to leave/moveout from the {{ Auth::user()->property }}.


             <br>
             <br>
           
          </p>
          <table class="table table-borderless">
            <tr>
                <th>
                    _______________________
                    <br>
                    Leasing Department
                </th>
                <th>
                    Office's Copy
                    <br>

                </th>
            </tr>
         
      </table>

          ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

          <p class="text-justify">
            This is to certify that, {{ $tenant->first_name.' '.$tenant->last_name }}, tenant of unit {{ $unit->building.' '.$unit->unit_no }} is cleared from all his/her
            obligations (monthly rentals, utilities, and moveout charges) from the {{ Auth::user()->property }} and is permitted to leave/moveout from the {{ Auth::user()->property }}.


            <br>
            <br>
          
         </p>
         <table class="table table-borderless">
            <tr>
                <th>
                    _______________________
                    <br>
                    Guard On Duty
                </th>
                <th>
                    Tenant's Copy
                    <br>

                </th>
            </tr>
         
      </table>
      
        
          


</body>

</html>
