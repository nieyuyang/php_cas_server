@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    Central Authentication Service
                    @if(config('cas_server.allow_register'))
                        <span class="pull-right"><a href="{{ route('register.get') }}">Register</a></span>
                    @endif
                </div>
                <div class="panel-body">
                    @foreach($errorMsgs as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                    <form class="form-horizontal" role="form" method="POST" action="{{ cas_route('login_action') }}">
                        @if(!config('cas_server.disable_pwd_login'))
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>
                                @if(config('cas_server.allow_reset_pwd'))
                                <a class="btn btn-link" href="{{ route('password.reset.request.get') }}">Forgot Your Password?</a>
                                @endif
                            </div>
                        </div>
                        @endif
                        @if(count($plugins) > 0)
                        <div class="form-group">
                            @foreach($plugins as $plugin)
                                <a class="col-lg-3" href="{{ route('oauth.login', ['name' => $plugin->getFieldName()]) }}">{{ $plugin->getName() }}</a>
                            @endforeach
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection