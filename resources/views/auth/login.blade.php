@extends('layouts.login.header')
@section('content_login')
<div class="wrapper wrapper-full-page">
    <div class="page-header login-page header-filter" filter-color="black"
        style="background-image: url('/assets/img/bg3.jpg'); background-size: cover; background-position: top center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="card card-login card-hidden">
                            <div class="card-header card-header-rose text-center">
                                <h4 class="card-title">Emergency Notification System Login</h4>
                                <div class="social-line">
                                <a class="btn btn-sm btn-github btn-round" onclick="window.location='{{ url("/auth/google") }}'">
                                    <img src="{{ asset('images/google.png') }}">&nbsp;+ Sign in
                                </a>
                                </div>
                            </div>
                            <div class="card-body ">
                                <p class="card-description text-center">Or Be Classical</p>
                                <span class="bmd-form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="material-icons">email</i>
                                            </span>
                                        </div>
                                        <input id="email" placeholder="Email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </span>
                                <span class="bmd-form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="material-icons">lock_outline</i>
                                            </span>
                                        </div>
                                        <input id="password" placeholder="Password..." type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </span>
                            </div>
                            <div class="card-footer justify-content-center">
                                <button type="submit" class="btn btn-rose btn-link btn-lg">
                                    {{ __('Lets Go') }}
                                </button>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
