@extends('layouts.app')
@section('pagetitle')Dashboard @endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="header">
                    <div class="row"> 
                        <div class="col-lg-6 col-md-6">
                            <div class="card">
                                <div class="card-header card-header-icon card-header-danger">
                                    <div class="card-icon">
                                        <i class="material-icons">alarm_add</i>
                                    </div>
                                  <h3 class="card-title"><strong>3 Last Disasters</strong></h3>
                                </div><hr>
                                    <div class="card-body table-responsive">
                                        <div style="height:300px; overflow-y;">
                                            <table class="table table-hover">
                                                <thead >
                                                    <th class="text-center" width="5%">#</th>
                                                    <th width="45%">Disasters</th>
                                                    <th width="50%">&nbsp;</th>
                                                </thead>
                                            <tbody>
                                            @csrf
                                            @foreach($data_disaster as $val)
                                              <tr>         
                                                <td class="text-center">{{$loop->iteration}}</td>                                                
                                                <td class="text-left"><span class="badge badge-danger">{{ date("d M Y", strtotime($val->dEnsGroupDate)) }}</span></br>                                                
                                                {{ $val->cEnsDisasterName.', '.$val->cClusterName }}</td>
                                                <td class="text-right">{{$loop->iteration}}</td>
                                              </tr>                    
                                            @endforeach
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                            </div>
                        </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="card">
                                    <div class="card-header card-header-icon card-header-info">
                                        <div class="card-icon">
                                            <i class="material-icons">accessibility</i>
                                        </div>
                                      <h3 class="card-title"><strong>Emplyees Who Need Help !!!</strong></h3>
                                    </div><hr>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                            @csrf
                                            <form action="/send-feedback" method="GET">
                                        <div style="height:300px; overflow-y;">
                                    <table class="table table-striped" style="table-layout: fixed;">
                                <thead>
                            <tr>
                                  <th class="text-center" style="width: 50px;">#</th>
                                  <th></th>
                                  <th>Actions</th>
                            </tr>
                                </thead>
                          <tbody>
                          @foreach($need_help as $tfb)
                            <tr>
                              <td class="text-center">{{$loop->iteration}}</td>
                              <td class="text-left"><span class="badge badge-success">{{ $tfb->cPeopleSourceName.' | '.$tfb->cClusterName}}</span></br><strong>{{$tfb->cMobile }}</strong></td>
                              <td>
                                  @csrf 
                                  <input type="hidden"  name="nEnsID" value="{{$tfb->nEnsID}}">
                                  <input type="hidden"  name="dEnsFedbackDate" value="{{$tfb->dEnsFedbackDate}}">
                                  <input type="hidden"  name="cMobile" value="{{$tfb->cMobile}}">
                                  <button type="button" class="btn btn-sm btn-info btn-round" data-toggle="modal" data-target="#exampleModal">
                                    <i class="material-icons">contact_mail</i> Send SMS
                                  </button>
                              </td>
                            </tr>
                          @endforeach
                          </tbody>
                                </table>
                              </div>
                      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="card-header card-header-text card-header-rose">
                                <div class="card-text">
                                  <!-- <i class="material-icons">send</i> -->
                                  <h6 class="card-title">Send Message</h6>
                                </div>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                    <div class="input-group no-border">
                                      <textarea row="4" cols="50" name="message" class="form-control" placeholder="Type here..."></textarea>
                                    </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Send SMS</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
                  </div>
                    <div class="col-xs-6 col-sm-6 col-md-6" Header height="100px"> 
                      <div class="card">
                        <div class="card-header card-header-icon card-header-success">
                          <div class="card-icon">
                              <i class="material-icons">comment</i>
                          </div>
                          <h3 class="card-title"><strong>SMS Responses </strong></h3>
                      </div><hr>
                    <div class="card-body">
                      <div id="container1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                    </div>
                    <div class="card-footer">
                      <div class="col-md-12">
                        <i class="fa fa-circle text-info"></i> Total Employee : {{ $bls_fb1+$bls_fb2+$nobls_fb }} person
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6" Header height="100px"> 
                  <div class="card">
                    <div class="card-header card-header-icon card-header-rose">
                        <div class="card-icon">
                            <i class="material-icons">av_timer</i>
                        </div>
                        <h3 class="card-title"><strong>SMS Responses By Time</strong></h3>
                    </div><hr>
                    <div class="card-body">
                      <div id="container2" style="min-width: 310px; height: 445px; margin: 0 auto"></div>
                    </div>
                  </div>
                </div>
              </div>            
        @push('plugin')                   
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/series-label.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script>
        // Build the chart container1
        var bls_fb1 = <?php echo $bls_fb1; ?>;
        var bls_fb2 = <?php echo $bls_fb2; ?>;
        var nobls_fb = <?php echo $nobls_fb; ?>;
        
        Highcharts.chart('container1', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: ''
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y}</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>, {point.y}',
                        distance: -50,
                        filter: {
                            property: 'percentage',
                            operator: '>',
                            value: 4
                        }
                    }
                }
            },
            series: [{
                name: 'Count',
                data: [
                    { name: 'They are save', y: bls_fb1 },
                    { name: 'Need Help', y: bls_fb2 },
                    { name: 'Not Responding', y: nobls_fb }
                ]
            }]
        });

        // Build the chart container2
        var times =  
        <?php echo json_encode($fb_tms); ?>;
        Highcharts.chart('container2', {
            chart: {
                type: 'line'
            },
            title: {
                text: ''
            },
            xAxis: {
                categories: ['1 Hour', '2 Hour', '3 Hour', 'More']
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: 'Time Response',
                data: times
            }]
        });
          </script>
        @endpush
@endsection
