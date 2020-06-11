@extends('layouts.app')
@section('title', 'Investors')
@section('content')
<div class="container">
    <div class="justify-content-center">
        <form action="/unit_owners/search" method="GET" >
            @csrf
            <div class="input-group">
            <input type="text" class="form-control" name="search"  value="{{ session('search_unit_owner') }}">
            </div>
        </form>
        <br>
        <p class="text-center"><small ><b>{{ $investors->count() }}</b> unit owners found.</small></p>
        <table class="table table-striped">
            <thead>
             <tr>
                <th>#</th>
                <th>Name</th>
                <th>Building</th>
                <th>Unit No</th>
                <th>Contract Expires On</th>
            </tr>
            </thead>
            <?php
              $ctr = 1;
            ?>   
            <tbody>
            @foreach ($investors as $item)
            <tr>
                <th>{{ $ctr++ }}</th>
                <td><a href="{{ route('show-investor',['unit_id'=> $item->unit_id, 'unit_owner_id'=>$item->unit_owner_id]) }}">{{ $item->unit_owner }} </a></td>
                <td>{{ $item->building }}</td>
                <td>{{ $item->unit_no }}</td>
               <td>{{ Carbon\Carbon::parse($item->contract_end)->format('M d Y') }}</td>
            </tr>
            @endforeach
            </tbody>
         </table>
    </div>
</div>
@endsection








