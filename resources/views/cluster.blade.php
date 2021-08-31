@extends('layouts.app')
@section('pagetitle')Select Employee @endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon card-header-rose">
                        <div class="card-icon">
                            <i class="material-icons">person_add</i>
                        </div>
                          <h3 class="card-title"><strong>Employee Selection</strong></h3>
                    </div><hr>
                    <form id="nEmployeeID" onSubmit="return validatecs()" name="nEmployeeID" action="{{ route('send_user')}}" method="POST">
                        @csrf 
                        @foreach($da as $da)
                        <input type="hidden" name="da[]" value="{{$da}}">                       
                        @endforeach
                        <div class="card-header card-header-primary card-header-icon">
                          <input type="button" class="btn btn-primary" value="Select All" onclick="check();">
                          <input type="button" class="btn btn-primary" value="Unselect All" onclick="uncheck();">
                          <button type="button" class="open_modal_cs btn btn-info" data-toggle="modal" data-target="#exampleModal">
                              <i class="material-icons">send</i>
                              SEND SMS
                          </button>
                        </div>
                  <div class="card-body">
                        <table class="table table-striped table-no-bordered table-hover" id="datatables">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th style="text-align: center">MARK</th>
                                    <th style="text-align: center">CLUSTER NAME</th>
                                    <th style="text-align: center">FULL NAME</th>
                                    <th style="text-align: center">EMPLOYEE NIP</th>
                                    <th style="text-align: center">MOBILE</th>
                                    <th style="text-align: center">AREA</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cluster as $item)
                                <tr>
                                <td>{{$loop->iteration}}</td>
                                <td style="text-align: center">
                                    <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="checkbox" class="form-check-input" name="nEmployeeID[]" style="text-align:center" id="check1" value="{{$item->nEmployeeID}}">
                                    <span class="form-check-sign">
                                  <span class="check">
                                  </span>
                                    </span>
                                    </label>
                                    </div>
                                      <input type="hidden"  name="cMobile[{{$item->nEmployeeID}}]" style="text-align:center" value="{{$item->cMobile}}">
                                      <input type="hidden"  name="cClusterName[{{$item->nEmployeeID}}]" style="text-align:center" value="{{$item->cClusterName}}">
                                  </td>
                                      <td style="text-align: center">{{$item->cClusterName}}</td>
                                      <td style="text-align: center">{{$item->cPeopleSourceName}}</td>
                                      <td style="text-align: center">{{$item->cEmployeeNip}}</td>
                                      <td style="text-align: center">{{$item->cMobile}}</td>
                                      <td style="text-align: center">{{$item->cClusterName}}</td>
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
                            <div class="modal-body">
                            @csrf
                            <div class="form-group">
                              <br>            
                            <div class="input-group no-border">
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
                              <button type="submit" name="send_btn" class="btn btn-primary" id="btn-submit">Send SMS</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
@endsection
