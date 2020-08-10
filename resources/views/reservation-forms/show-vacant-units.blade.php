@extends('layouts.app')
@section('title', 'My Property Dash')
@section('content')
    <ul class="nav nav-pills mb-3 text-right" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#all" role="tab" aria-controls="pills-all" aria-selected="true"><i class="fas fa-home"></i> All <span class="badge badge-light">{{ $units->count() }}</span></a>
        </li>
    @foreach ($buildings as $item)
    <li class="nav-item">
            <a class="nav-link" id="pills-{{ $item->building }}-tab" data-toggle="pill" href="#{{ $item->building }}" role="tab" aria-controls="pills-{{ $item->building }}" aria-selected="true"><i class="fas fa-home"></i> {{ $item->building }} <span class="badge badge-light">{{ $item->count }}</span></a>
        </li>
    @endforeach
    </ul>

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="pills-all-tab">
            <div class="row ">
                <table class="table">
                    <tr>
                        <td>
                            @foreach ($units as $item)
                                <a title="{{ number_format($item->monthly_rent,2) }}/month" href="/{{ $item->unit_property }}/units/{{$item->unit_id}}" class="btn btn-secondary">
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

        @foreach ($buildings as $item)
        <div class="tab-pane fade" id="{{ $item->building }}" role="tabpanel" aria-labelledby="pills-{{ $item->building }}-tab">
            <div class="row ">
                <table class="table">
                    <tr>
                        <td>
                            @foreach ($units as $building)
                                @if($building->building === $item->building)
                                <a title="{{ number_format($building->monthly_rent,2) }}/month" href="/units/{{$building->unit_id}}" class="btn btn-secondary">
                                    <i class="fas fa-home fa-2x"></i>
                                    <br>
                                    <font size="-3" >{{ $building->unit_no }} </font>
                                </a>   
                                @endif
                            @endforeach
                        </td>
                        <br>
                    </tr>
                </table>
            </div> 
        </div>
        @endforeach
    </div>
@endsection

