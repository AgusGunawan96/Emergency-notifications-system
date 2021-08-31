<!-- @guest
    @php
        header("location: public/auth/login");
    @endphp
@endguest

@auth
@extends('layouts.app')
@section('pagetitle')403 Forbidden @endsection
@section('content')
    @section('customcss')
        <style>
            .full-height {
                height: 70vh;
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .code {
                border-right: 2px solid;
                font-size: 26px;
                padding: 0 15px 0 15px;
                text-align: center;
            }

            .message {
                font-size: 18px;
                text-align: center;
            }
        </style>
    @endsection

    @if (session('profilepic'))
        @section('profilepic'){{ session('profilepic') }} @endsection
    @else
        @section('profilepic'){{ asset('assets/img/boy.png') }} @endsection
    @endif

    @section('content')
    @section('pagetitle') Forbidden Access  @endsection
        
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                        <div class="flex-center position-ref full-height">
                                <div class="code">
                                    403            
                                </div>

                                <div class="message" style="padding: 10px;">
                                    Ooopps Sorry!!! You do not have access to this module
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    @endsection

    @section('customjs')
    @endsection
@endauth -->
