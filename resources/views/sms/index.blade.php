@extends('layouts.app')
@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
          <div class="col-lg-6 col-md-12">
              <div class="card">
                <div class="card-header card-header-text card-header-warning">
                  <div class="card-text">
                    <h4 class="card-title">List Receiver</h4>
                  </div>
                </div>
                <div class="card-body table-responsive">
                  <div style="height:200px; overflow-y;">
                  <table class="table table-hover">
                    <thead class="text-warning">
                    <th class="text-center" style="width: 50px;">#</th>
                      <th>Cluster</th>
                      <th></th>
                      <th>Jumlah</th>
                    </thead>
                    <tbody>
                    @csrf
                    @foreach($clsr_dt as $key => $val)
                    <tr>
                      <td class="text-center">{{$loop->iteration}}</td>
                      <td>{{ $key }}</td>
                      <td>:</td>
                      <td>{{ $val }}</td>
                    </tr>                    
                    @endforeach
                    </tbody>
                  </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">mail_outline</i>
                  </div>
                  <div class="form-check">
                        <label class="form-check-label">
                        </label>
                    </div>
                 </div>
                <div class="card-body ">
                    @csrf
                    <form action="/send-all-user" method="GET">
                    <div class="form-group">
                      <br>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <select required name="disaster[]" class="selectpicker" multiple data-style="select-with-transition" title="Choose Disaster" data-size="5">
                        @foreach ($disaster as $item)
                        <option value="{{$item->nEnsDisasterID}}"> {{$item->cEnsDisasterName}} </option>
                        @endforeach
                      </select>
                    </div>
                    @foreach($employe as $value)
                      <input type="hidden" name="employe[]" value="{{$value}}">                       
                    @endforeach
                    @foreach($da as $clsr)
                      <input type="hidden" name="cluster[]" value="{{$clsr}}">                       
                    @endforeach
                    <br>
                    <label for="examplePass" class="bmd-label-floating">Message</label>
                    <p>(Jumlah Karakter Maksimal: 160) </p>
                    <textarea id="karakter" name="message" class="form-control" cols="30" rows="10" maxlength="160">Anda terduga berada di lokasi bencana. Segera respon SMS ini dgn mengetik (1/2)
1.Saya selamat tdk butuh bantuan 
2.Saya butuh bantuan</textarea>
                    <span id="hitung">26</span>  Karakter Tersisa.
                    </div>
                </div>
                <div class="card-footer ">
                  <button type="submit" class="btn btn-fill btn-rose">Submit</button>
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
    </div>
    @push('plugin')
    <link rel="stylesheet" href="main.css" type="{{asset('text/css')}}" />
    <script type="text/javascript">
      $(document).ready(function() {
            $('#karakter').keyup(function() {
                var len = this.value.length;
                if (len >= 160) {
                    this.value = this.value.substring(0, 160);
                }
                $('#hitung').text(160 - len);
            });
      });
    </script>
    @endpush
@endsection
