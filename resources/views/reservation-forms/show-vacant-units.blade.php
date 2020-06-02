@extends('layouts.app')
@section('title', 'My Property Dash')
@section('content')
<div class="container">
    <form action="/units/" method="GET" >
        @csrf
        <div class="row">
            <div class="col">
                <select class="form-control" name="property" onchange='this.form.submit()'>
                    @if(session('property') == NULL)
                    <option value=""><small id="" class="form-text text-muted">Please Select Property</small></option>
                    @foreach ($properties as $item)
                    <option value="{{ $item->unit_property }}">{{ $item->unit_property }}</option>
                    @endforeach
                    @else
                    <option value="{{ session('property') }}">{{ session('property') }}</option>
                    @foreach ($properties as $item)
                    <option value="{{ $item->unit_property }}">{{ $item->unit_property }}</option>
                    @endforeach
                    @endif
                </select>    
            </div>

            {{-- <div class="col">
                <select class="form-control" name="building" onchange='this.form.submit()'>
                    <option value="">Select Building</option>
                    @foreach ($buildings as $item)
                    <option value="{{ $item->building }}">{{ $item->building }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col">
                <select class="form-control" name="floor_no" onchange='this.form.submit()'>
                    <option value="">Select Floor No</option>
                    @foreach ($floor_nos as $item)
                    <option value="{{ $item->floor_no }}">{{ $item->floor_no }}</option>
                    @endforeach
                </select>
            </div> --}}
        </div>
       
    </form>
    <br>
   @if($units->count() > 0)
   <p class="text-center"><small ><b>{{ $units->count() }}</b> units found.</small></p>
   @endif
    <div class="row border-rounded">
        <table class="table">
            <tr>
                <td>
                    @foreach ($units as $item)
                            <a title="{{ number_format($item->monthly_rent,2) }}/month" href="/units/{{$item->unit_id}}" class="btn btn-secondary">
                                <i class="fas fa-home fa-2x"></i>
                                <br>
                                <font size="-3" >{{ $item->unit_no }} </font>
                            </a>   
                    @endforeach
                </td>
                <br>
            </tr>
        </table>
    </div>
</div>  
@endsection