@extends('layouts.app')
@section('title', 'Investor')
@section('content')
<div class="container">
    <div class="row">
        <p style="float:right;">
            <button type="button" title="edit this unit information." class="btn btn-primary" data-toggle="modal" data-target="#editTenant" data-whatever="@mdo"><i class="fas fa-edit"></i>edit</button> 
        </p>
        <table class="table table-bordered table-striped">
           <tr>
               <th>Name:</th>
               <td>{{ $investor->unit_owner }}</td>
           </tr>
        </table>
    </div>
</div>
@endsection