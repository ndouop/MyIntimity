@extends('layouts.appLogin')

@section('css')
<style type="text/css">
@import url(https://fonts.googleapis.com/css?family=Roboto:300);
h1 {
    color:#ffffff;
    padding: 15px;
  font-family: "Roboto", sans-serif;
}
.login-page {
  width: 660px;
  padding: 8% 0 0;
  margin: auto;
}
#outputvalue {
 font-family: "Roboto", sans-serif;
    color: #4CAF50;
    text-align: center;
    margin: 10px 0px;
    font-size: 17px;
}
.form {
  position: relative;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.form input {
  font-family: "Roboto", sans-serif;
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
}
input[type=submit] {
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #4CAF50;
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 18px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
.form button:hover,.form button:active,.form button:focus {
  background: #43A047;
}
.form .message {
  margin: 15px 0 0;
  color: #b3b3b3;
  font-size: 12px;
}
.form .message a {
  color: #4CAF50;
  text-decoration: none;
}
.form .register-form {
  display: none;
}
.container {
  position: relative;
  z-index: 1;
  max-width: 300px;
  margin: 0 auto;
}
.container:before, .container:after {
  content: "";
  display: block;
  clear: both;
}
.container .info {
  margin: 50px auto;
  text-align: center;
}
.container .info h1 {
  margin: 0 0 15px;
  padding: 0;
  font-size: 36px;
  font-weight: 300;
  color: #1a1a1a;
}
.container .info span {
  color: #4d4d4d;
  font-size: 12px;
}
.container .info span a {
  color: #000000;
  text-decoration: none;
}
.container .info span .fa {
  color: #EF3B3A;
}
body {
  background: #76b852; /* fallback for old browsers */
  background: -webkit-linear-gradient(right, #76b852, #8DC26F);
  background: -moz-linear-gradient(right, #76b852, #8DC26F);
  background: -o-linear-gradient(right, #76b852, #8DC26F);
  background: linear-gradient(to left, #76b852, #8DC26F);
  font-family: "Roboto", sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;     
}</style>
@stop


@section('content')


    <a href="{{url('/redirect/facebook')}}" class="social-btn facebook Kbtn-square">{{trans("auth.login.conn_with_fck")}}</a>
    <a href="{{url('/redirect/google')}}" class="social-btn google Kbtn-square">{{trans("auth.login.conn_with_ggle")}}</a>

    <form method="post" action="{{ url('/login') }}">
        {!! csrf_field() !!}
        <div class="msg">{{trans("auth.login.msg")}}</div>
        <div class="input-group has-feedback{{ $errors->has('login') ? ' has-error' : '' }}">
            <span class="input-group-addon">
                <i class="material-icons">person</i>
            </span>
            <div class="form-line">
                <input type="text" class="form-control" name="login" placeholder="{{trans("auth.login.label.login")}}" required autofocus>
            </div>
             @if ($errors->has('login'))
                <span class="help-block">
                <strong>{{ $errors->first('login') }}</strong>
            </span>
            @endif
        </div>
        <div class="input-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
            <span class="input-group-addon">
                <i class="material-icons">lock</i>
            </span>
            <div class="form-line">
                <input type="password" class="form-control" name="password" placeholder="{{trans("auth.login.label.pwd")}}" required>
            </div>
            @if ($errors->has('password'))
                <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>
        <div class="row">
            <div class="col-xs-7 p-t-5">
                <input type="checkbox" name="remember" id="rememberme" class="filled-in chk-col-pink">

                <label for="rememberme">{{trans("auth.login.rememberme")}}</label>
            </div>
            <div class="col-xs-5">
                <input id="code" type="hidden" class="form-control" name="code" value="{{ old('code') }}" >
                <input id="pays_nom" type="hidden" class="form-control" name="pays_nom" value="{{ old('pays_nom') }}" >
                <input id="region" type="hidden" class="form-control" name="region" value="{{ old('region') }}" >
                <input id="ville" type="hidden" class="form-control" name="ville" value="{{ old('ville') }}" >
                <button class="btn btn-block waves-effect btn-sm bg-pink  Kbtn-square" type="submit">{{trans("auth.login.btnSubmit")}}</button>
            </div>
        </div>
        <div class="row m-t-15 m-b--20">
            <div class="col-xs-6">
                <a href="{{ url('/register') }}" class="text-center">{{trans("auth.login.create_account_now")}}</a>
            </div>
            <div class="col-xs-6 align-right">
                <a href="{{ url('/password/reset') }}">{{trans("auth.initpwd_titre")}}</a>
            </div>
        </div>
    </form>


@stop

@section('scripts')

    <script type="text/javascript">


    </script>

@stop
