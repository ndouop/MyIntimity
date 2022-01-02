<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>{{trans("auth.password.reset.title")}} | {{\Config::get("app.name")}}</title>
    <!-- Favicon-->
    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{asset('material/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{asset('material/plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{asset('material/plugins/animate-css/animate.css')}}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{asset('material/css/themes/theme-pink.css')}}" rel="stylesheet">
    <link href="{{asset('material/css/style.css')}}" rel="stylesheet">
</head>

<body class="signup-page" >
<div class="signup-box">
    <div class="logo">
        <a href="javascript:void(0);"><b>{{trans('string.app_name')}}</b></a>
        <small>{!! Lang::get('string.slogan') !!}</small>
    </div>
        <div class="card">
            <div class="body">
                <form method="post" action="{{ url('/password/reset') }}" id="form">
                    {!! csrf_field() !!}
                    <div class="msg">{{trans("auth.password.reset.msg")}}</div>

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="input-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{trans("auth.password.reset.label.login")}}" required autofocus>
                        </div>
                         @if ($errors->has('email'))
                            <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="input-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control p" name="password" placeholder="{{trans("auth.password.reset.label.pwd")}}" required>
                        </div>
                        @if ($errors->has('password'))
                            <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="input-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control cp" name="password_confirmation" placeholder="{{trans("auth.password.reset.label.cpwd")}}" required>
                        </div>
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-5">
                            <button class="btn btn-block bg-teal waves-effect btn-sm" type="submit">{{trans("auth.password.reset.btn")}} </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{HTML::script('material/plugins/jquery/jquery.min.js')}}
    {{HTML::script('material/plugins/bootstrap/js/bootstrap.js')}}
    {{HTML::script('material/plugins/node-waves/waves.js')}}
    {{HTML::script('material/plugins/jquery-validation/jquery.validate.js')}}
    {{HTML::script('material/js/admin.js')}}
    {{HTML::script('material/js/pages/examples/sign-in.js')}}

    <script type="text/javascript">
        $('#form').submit(function(e){
            let password = $(this).find('.p').val();
            let c_p = $(this).find('.cp').val();

            if (password!=c_p) {
                e.preventDefault();

                alert('confirm password error! :( ');
            }
        });
    </script>


</body>

</html>

