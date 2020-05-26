@extends('layouts.app')
@section('title', session(Auth::user()->property.'building').' '.session(Auth::user()->property.'unit_no').' '.'(Step 4 of 4)')
@section('content')
<div class="container">
    <form id="addTenantForm4" action="/tenants" method="POST">
        {{ csrf_field() }}
    </form>
    <h4>Payment Requirements (4/4)</h4>
    <h2><p class="text-right" id="total_bills">Total: </p></h2>

    <br>
    <div class="row">
        <div class="col">
             <table class = "text-center table table-hover " id="tab_logic">
                 <tr>
                     <th>#</th>
                     <th>Description</th>
                     <th>Amount</th>
                 </tr>
                     <input form="addTenantForm4" type="hidden" id="no_of_items" name="no_of_items" value="3">
                 <tr id='addr0'>
                     <th>1</th>
                     <td><input form="addTenantForm4"  type="text" name='desc0' id='desc0' class="form-control" value="Security Deposit (Rent)" readonly/></td>
                     <td><input oninput="this.value = Math.abs(this.value)" form="addTenantForm4"  onkeyup="computeTotal()" type="number" name='amt0' id='amt0' class="form-control" value="{{ session(Auth::user()->property.'tenant_monthly_rent') }}"/></td>
                 </tr>
                 <tr id='addr1'>
                    <th>2</th>
                    <td><input form="addTenantForm4"  type="text" name='desc1' id='desc1' class="form-control" value="Security Deposit (Utilities)" readonly/></td>
                    <td><input oninput="this.value = Math.abs(this.value)" form="addTenantForm4"  onkeyup="computeTotal()" type="number" name='amt1' id='amt1' class="form-control" value="2000"/></td>
                </tr>
                 <tr>
                     <th>3</th>
                    <td><input form="addTenantForm4"  type="text" name='desc2' id='desc2' class="form-control" value="Advance Rent" readonly/></td>
                    <td><input oninput="this.value = Math.abs(this.value)" form="addTenantForm4"  onkeyup="computeTotal()" type="number" name='amt2' id='amt2' class="form-control" value="{{ session(Auth::user()->property.'tenant_monthly_rent') }}"/></td>
                 </tr>
                 <tr id='addr2'></tr>
             </table>      
        </div>
       </div>

        <p class="text-right">   
            <a href="/units/{{ session(Auth::user()->property.'unit_id') }}/tenant-step3" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> prev</a>
            <button type="submit" form="addTenantForm4" class="btn btn-primary"><i class="fas fa-check"></i> save</button>
        </p>
    
</div>
<script type="text/javascript">
 $(document).ready(function(){
    document.getElementById('total_bills').innerHTML = 'Total:  ' + (parseFloat(document.getElementById('amt0').value) + parseFloat(document.getElementById('amt1').value) + parseFloat(document.getElementById('amt2').value)).toFixed(2).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    });
       
function computeTotal(){
    document.getElementById('total_bills').innerHTML = 'Total:  ' + (parseFloat(document.getElementById('amt0').value) + parseFloat(document.getElementById('amt1').value) + parseFloat(document.getElementById('amt2').value)).toFixed(2).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}
    
</script>

@endsection








