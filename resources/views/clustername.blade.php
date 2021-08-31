@extends('layouts.app')
@section('pagetitle')SMS Notification @endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon card-header-rose">
                        <div class="card-icon">
                            <i class="material-icons">post_add</i>
                        </div>
                        <h3 class="card-title"><strong>Send SMS Notification</strong></h3>
                    </div><hr>
                    <form id="Pelajaran" onSubmit="return validatecn();" name="Pelajaran" action="{{ route('post_sms')}}" method="POST">
                        @csrf
                        <div class="card-header card-header-primary card-header-icon">
                            <button class="btn btn-primary" name="search_btn" type="submit"><i class="material-icons">search</i>
                                Send SMS by Employee
                            </button>
                            <button type="button" class="open_modal_cn btn btn-info" data-toggle="modal" data-target="#exampleModal">
                                <i class="material-icons">send</i>
                                Send SMS by Cluster Area
                            </button>
                        </div>
                        <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-danger">
                            {{ session('status') }}
                        </div>
                        @endif
                            <table class="table table-striped table-no-bordered table-hover" width="100%"  id="cluster-table">
                                <thead>
                                    <tr>
                                        <th width="10%" class="disabled-sorting text-center">NO</th>
                                        <th width="10%" class="disabled-sorting text-center">MARK</th>
                                        <th width="80%" class="text-left">NAME</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cluster as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                                <td style="text-align: center">
                                                    <div class="form-check">
                                                <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="mark[]" id="check1" value="{{$item->nClusterID}}">
                                        <span class="form-check-sign">
                                    <span class="check"></span>
                                        </span>
                                            </label>
                                                </div>
                                                    </td>
                                                <td style="text-align: text-left">{{$item->cClusterName}}</td>
                                            </tr>
                                    @endforeach
                                </tbody>
                                


                            </table>
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="card-header card-header-text card-header-rose" style="text-align: center">
                                <div class="card-text">
                                  <!-- <i class="material-icons">send</i> -->
                                  <h6 class="card-title">Send Message</h6>
                                </div>
                              <button type="button" class="close_modal close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body ">
                            @csrf
                            <div class="form-group">
                            <br>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <select id="disaster" name="disaster[]" class="selectpicker" data-style="btn btn-primary btn-round" title="Choose Disaster" data-size="5">
                                    @foreach ($disaster as $item)
                                    <option value="{{$item->nEnsDisasterID}}"> {{$item->cEnsDisasterName}} </option>
                                    @endforeach
                                </select>
                                <br><br>
                                <p>(Jumlah Karakter Maksimal: 160) </p>
                                <textarea id="karakter" name="message" class="form-control" cols="30" rows="10" maxlength="160">Anda terduga berada di lokasi bencana. Segera respon SMS ini dgn mengetik (1/2)
1.Saya selamat tdk butuh bantuan 
2.Saya butuh bantuan</textarea>
                                <span id="hitung">26</span>  Karakter Tersisa.
                            </div>
                            </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="close_modal btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" id="send_btn" name="send_btn" class="btn btn-primary">Send SMS</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
        @endsection
        @push('scripts')
 <script>
    $(function() {
        $('#cluster-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'cluster/json',
            columns: [
                { data: 'nClusterID', name: 'nClusterID', className: "center"},
                { data: 'nClusterID', name: 'nClusterID', render:function (data, type, full, meta) {
                    return '<div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="mark[]" id="check1" value="' + data + '"><span class="form-check-sign"><span class="check"></span></span></label></div>';
                }, className: "center"},
                { data: 'cClusterName', name: 'cClusterName', className: "text-left"}
            ],
            initComplete: function () {
                this.api().columns().every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).appendTo($(column.footer()).empty())
                    .on('change', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });
                });
            }
        });
    });

 </script>
 @endpush

