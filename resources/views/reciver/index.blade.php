@extends('layouts.app')
@section('pagetitle')SMS Details @endsection
@section('content')
<style>
#page {
    display: none;
}
#loading {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 100;
    width: 100vw;
    height: 100vh;
    background-color: rgba(192, 192, 192, 0.5);
    background-image: url("http://i.stack.imgur.com/MnyxU.gif");
    background-repeat: no-repeat;
    background-position: center;
}
</style>
<div id="loading"></div>
<div id="page" class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon card-header-primary">
                        <div class="card-icon">
                            <i class="material-icons">directions_walk</i>
                        </div>
                        <h3 class="card-title"><strong>SMS Details</strong></h3>
                    </div><hr>
                    <div class="card-body">
                    <div class="table-responsive">
                      @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div style="width:1200px; overflow-x; overflow-y;">
                    
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                <tr>
                          <th colspan="3"></th>
                          <th colspan="2" class="text-center"><div class="col-md-3 col-sm-4">
                        <span class="btn btn-link btn-reddit">
                           <h4><strong><i class="material-icons">done_all</i>SMS Sent</h4></strong>
                      </span>
                      </div></th>
                          <th colspan="2" class="text-center"><div class="col-md-4 col-sm-5">
                        <span class="btn btn-link btn-dribbble">
                        
                       <h4><strong><i class="material-icons">feedback</i>SMS FeedBack</strong></h4>
                      </span>
                      </div>
                    </div></th>
                      </tr>
                                    <tr>
                                        <th>No</th> 
                                        <th>Name</th> 
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th style="text-align: center">Message</th>
                                        <th>Date</th>
                                        <th>Feedback Date</th>
                                        <th style="text-align: center">Message</th>                                        
                                        
                                        
                                    </tr>
                                </thead>
                                 <tfoot>
                                    <tr>
                                            <th>No</th> 
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            <th style="text-align: center">Message</th>
                                            <th>Date</th>
                                            <th>Feedback Date</th>
                                            <th style="text-align: center">Message</th>                                         
                                            
                                    </tr>
                                </tfoot> 
                                <tbody>
                                    @foreach ($reciver as $item_user)
                                    <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item_user->cPeopleSourceName}}</td>
                                           
                                            <td>{{$item_user->cEnsPhone}}</td>
                                            <td>{{$item_user->cEnsStatus}}</td>
                                            <td>{{$item_user->cEnsMessages}}</td>
                                            <td>{{$item_user->dEnsDate}}</td>
                                            <td>{{$item_user->dEnsFedbackDate}}</td>
                                            <td style="white-space: nowrap; width: 100px; overflow: hidden; text-overflow: ellipsis;">{{$item_user->cEnsFeedback}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
@endsection
