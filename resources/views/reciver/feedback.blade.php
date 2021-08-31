@extends('layouts.app')
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
                    <div class="card-header card-header-icon card-header-rose">
                        <div class="card-icon">
                            <i class="material-icons">contact_support</i>
                        </div>
                        <h3 class="card-title"><strong>SMS Conversations</strong></h3>
                    </div><hr>
                    <div class="card-header">
                        <a href="{{ route('download') }}" class="btn btn-primary">
                            <i class="material-icons">backup</i> Feedback Message export excel
                        </a>
                    <div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Feed Phone</th>
                                        <th>Feed Content</th>
                                        <th>Feed Date</th>
                                        <th>Insert Date</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                            <th>No</th>
                                            <th>Feed Phone</th>
                                            <th>Feed Content</th>
                                            <th>Feed Date</th>
                                            <th>Insert Date</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($feedback as $item)
                                    <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->cEnsFeedPhone}}</td>
                                            <td>{{$item->cEnsFeedContent}}</td>
                                            <td>{{$item->dEnsFeedDate}}</td>
                                            <td>{{$item->dInsertDate}}</td>
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
