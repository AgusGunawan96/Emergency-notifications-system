@extends('layouts.app')
@section('pagetitle')Disaster History @endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon card-header-rose">
                        <div class="card-icon">
                            <i class="material-icons">360</i>
                        </div>
                        <h3 class="card-title"><strong>Disasters History</strong></h3>
                    </div><hr>
                    <div class="card-body">
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="10%" class="disabled-sorting text-center">No</th>                                 
                                        <th width="80%" class="text-center">Date</th>
                                        <th width="10%" class="disabled-sorting text-center">Action</th>
                                    </tr>
                                </thead>
                                 <tfoot>
                                    <tr>
                                            <th>No</th>                                   
                                            <th>Date</th>
                                            <th>Action</th>
                                    </tr>
                                </tfoot> 
                                <tbody>
                                    @foreach ($dates as $item_user)
                                    <tr>
                                            <td class="text-center">{{$loop->iteration}}</td>
                                            <td class="text-left">{{$item_user}}</td>
                                            <td class="text-center"><a href="{{ route('reciver_date_show',$item_user) }}" class="btn btn-primary btn-info btn-round"><i class="material-icons">remove_red_eye</i>&nbsp;&nbsp;&nbsp;View</a></td>
                                        </tr>
                                    @endforeach
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     @push('plugin')
    
    @endpush
@endsection
