@extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary  card-header-icon">
                          <a href="{{ route('download') }}" class="btn btn-primary">
                              <i class="material-icons">backup</i>
                          </a>
                        <h4 class="card-title">Feedback Message export excel</h4>
                   </div>
                    <div class="card-body">
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
                                            <!-- <td>{{$item->nEnsFeedSmsID}}</td> -->
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
    </div>
</div>
@endsection
