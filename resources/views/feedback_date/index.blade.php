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
                        <h4 class="card-title">Feedback Date</h4>
                   </div>
                    <div class="card-body">
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Ens Feed Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Ens Feed Date</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($dates as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $item }}</td>
                                        <td><a href="{{ route('feedback_date_show',$item) }}" class="btn btn-primary"><i class="material-icons">remove_red_eye</i>View</a></td>
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
