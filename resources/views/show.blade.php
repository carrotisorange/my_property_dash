@extends('layouts.sm-2.template')

@section('content')
<table class="table table-bordered">
    <form id="editUnitsForm" action="/units/edit/{{ Auth::user()->property }}/{{ Carbon\Carbon::now()->getTimestamp()}}" method="POST">
    
        @csrf
        @method('PUT')

    </form>
    <thead>
      <?php 
        $ctr=1; 
        $owner=1;
        $unit=1;
        $foreign=1;
      ?>
        <tr>
          <th>#</th>
           <th>Owner ID</th>
         
        
           <th>Unit ID</th>
      
           <th>Unit ID Foreign</th>
  
         
           {{-- <td></td> --}}
       </tr>
    </thead>   
       <tbody>
       @foreach ($owners as $item)
       <tr>
         <th>{{ $ctr++ }}</th>
        
        <td><input type="text" form="editUnitsForm" name="owner{{ $owner++ }}" value="{{ $item->unit_owner_id }}"></td>
        <td><input type="text" form="editUnitsForm" name="unit{{ $unit++ }}" value="{{ $item->unit_id }}"></td>


        <td><input type="text" form="editUnitsForm" name="foreign{{ $foreign++ }}" value="{{ $item->unit_id_foreign }}"></td>
           
          
         

           {{-- <td>
             <form action="/owners/{{ $item->unit_owner_id }}" method="POST">
            @csrf
            @method('delete')
            <button title="remove" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"  onclick="return confirm('Are you sure you want perform this action?');"><i class="fas fa-times fa-sm text-white-50"></i></button>
          </form>
        </td> --}}
       </tr>
       @endforeach
       </tbody>
</table>
<button type="submit" form="editUnitsForm">Submit</button>
@endsection