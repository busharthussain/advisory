@extends('layouts.app')

@section('content')

    <section id="wrapper">
        <div class="login-register" style="background-image:url({!! asset('assets/images/login-register.jpg') !!});">
            <div class="login-box card">
                <div class="card-body">
                    <div class="logo-holder text-center">
                        <img src="{!! asset('assets/images/login-logo.png') !!}" alt="logo" />
                        <span>Advisory Board</span>
                    </div>
                    <form class="form-horizontal form-material" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <h3 class="box-title m-b-20">Sign In</h3>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-xs-12">
                                <input id="email" type="email" placeholder="Email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <p style="position: relative;bottom: 10px;">{{ $errors->first('email') }}</p>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="col-xs-12">
                                    <input id="password" type="Password" class="form-control" name="password" placeholder="Password" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <p style="position: relative;bottom: 10px;">{{ $errors->first('password') }}</p>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12 font-14">
                                        <div class="checkbox checkbox-primary pull-left p-t-0">
                                            <input id="checkbox-signup" type="checkbox">
                                            <label for="checkbox-signup"> Remember me </label>
                                        </div> <a href="{{ route('password.request') }}" id="to-recover" class="text-dark pull-right"><!-- <i class="fa fa-lock m-r-5"></i> --> Forgot Password?</a> </div>
                                </div>
                                <div class="form-group text-center m-t-20">
                                    <div class="col-xs-12">
                                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                                    </div>
                                </div>
                                <div class="form-group m-b-0">
                                    <!-- <div class="col-sm-12 text-center">
                                        <div>Don't have an account? <a href="pages-register.html" class="text-info m-l-5"><b>Sign Up</b></a></div>
                                    </div> -->
                                </div>
                    </form>
                    <form class="form-horizontal" id="recoverform" action="index.html">
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <h3>Recover Password</h3>
                                <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" placeholder="Email"> </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
