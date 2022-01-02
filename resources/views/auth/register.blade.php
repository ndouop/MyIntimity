@extends('layouts.appLogin')

@section('css')
    <style type="text/css">
        .social-btn{
            border-radius: 0!important;
        }
    </style>
@stop


@section('content')

    <a href="{{url('/redirect/facebook')}}" class="social-btn facebook" style="background:#3039B9!important">{{trans("auth.register.reg_with_fck")}}</a>
    <a href="{{url('/redirect/google')}}" class="social-btn google" style="background: #FF1158!important">{{trans("auth.register.reg_with_ggle")}}</a>
    <form id="sign_up" method="POST" action="{{ url('/registerWithFb') }}">
        {!! csrf_field() !!} 

        <div class="msg">{{trans("auth.register.msg")}}</div>
        <div id="alert-bck"></div>
        <div class="input-group">
            <div class="input-group has-feedback{{ $errors->has('login') ? ' has-error' : '' }}">
            <span class="input-group-addon">
                <i class="material-icons">person</i>
            </span>
            <div class="form-line">
                <input type="text" class="form-control login" name="login" placeholder="{{trans("auth.register.label.login")}}" required autofocus>
            </div>
            @if ($errors->has('login'))
                <span class="help-block">
                    <strong>{{ $errors->first('login') }}</strong>
                </span>
            @endif
        </div>
        <div class="input-group">
            <div class="input-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
            <span class="input-group-addon">
                <i class="material-icons">email</i>
            </span>
            <div class="form-line">
                <input type="email" class="form-control email" name="email" placeholder="{{trans("auth.register.label.email")}}" required>
            </div>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="input-group">
            <div class="input-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
            <span class="input-group-addon">
                <i class="material-icons">lock</i>
            </span>
            <div class="form-line">
                <input type="password" class="form-control password" name="password" minlength="6" placeholder="{{trans("auth.register.label.pwd")}}" required>
            </div>

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">lock</i>
            </span>
            <div class="form-line">
                <input type="password" class="form-control" name="confirm" id="confirm" minlength="6" placeholder="{{trans("auth.register.label.cpwd")}}" required>
            </div>
        </div>
        <div class="form-group">
            <input type="checkbox" name="" id="terms" class="filled-in chk-col-pink">
            <label for="terms">{!! trans("auth.register.agree_cond")!!}{{-- j'ai lu et j'accepte les  <a href="{{route('term')}}">conditions d'utilisations</a>. --}}</label>
        </div>

        <input id="code" type="hidden" class="form-control" name="code" value="{{ old('code') }}" >
        <input id="pays_nom" type="hidden" class="form-control" name="pays_nom" value="{{ old('pays_nom') }}" >
        <input id="region" type="hidden" class="form-control" name="region" value="{{ old('region') }}" >
        <input id="ville" type="hidden" class="form-control" name="ville" value="{{ old('ville') }}" >
        <input id="ip" type="hidden" class="form-control" name="ip" value="{{ old('ip') }}" >


        <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">{{trans("auth.register.btn")}}</button>

        <div class="m-t-25 m-b--5 align-center">
            <a href="{{route('login')}}">{{trans("auth.register.membership")}}</a>
        </div>
    </form>

@stop

@section('scripts')

@stop