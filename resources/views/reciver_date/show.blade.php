@extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary card-header-icon">
                         <div class="card-icon">
                           <i class="material-icons">Date</i>
                        </div>
                        <h4 class="card-title">Reciver Date</h4>
                   </div>
                    <div class="card-body">
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                <tr>
                                        <th>No</th>                                 
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <th>Feedback Message</th>                                        
                                        
                                        
                                    </tr>
                                </thead>
                                 <tfoot>
                                    <tr>
                                            <th>No</th>                                   
                                            <th>Phone</th>
                                            <th>Status</th>
                                            <th>Message</th>
                                            <th>Date</th>
                                            <th>Feedback Message</th>                                         
                                            
                                    </tr>
                                </tfoot> 
                                <tbody>
                                    @foreach ($reciver as $item_user)
                                    <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item_user->cEnsPhone}}</td>
                                            <td>{{$item_user->cEnsStatus}}</td>
                                            <td>{{$item_user->cEnsMessages}}</td>
                                            <td>{{$item_user->dEnsDate}}</td>
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
<script type="text/javascript">
            <!--
            //initial checkCount of zero
            var checkCount=0
            //maximum number of allowed checked boxes
            var maxChecks=1
            function setChecks(obj){
            //increment/decrement checkCount
            if(obj.checked){
            checkCount=checkCount+1
            }else{
            checkCount=checkCount-1
            }
            //if they checked a 4th box, uncheck the box, then decrement checkcount and pop alert
            if (checkCount>maxChecks){
            obj.checked=false
            checkCount=checkCount-1
            alert('you may only choose up to '+maxChecks+' options')
            }
            }
            //-->
            </script>
    @push('plugin')
    @endpush
@endsection
