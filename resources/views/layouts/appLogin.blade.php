<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="baseUrl" value="{{url('/')}}">

    <title>{{trans('string.app_name')}} | Login</title>
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

    {{HTML::script('//js.maxmind.com/js/apis/geoip2/v2.1/geoip2.js')}}
    {{HTML::script('/js/localisationScript.js')}}
    {{HTML::style('css/button.css')}}
    <link href="{{asset('material/css/style.css')}}" rel="stylesheet">
    <script>
        window.localLang = "{{app()->getLocale()}}";
    </script>
     {{HTML::script('js/trans.data.source.js')}}
    {{HTML::script("js/my-lang.js")}}


    @yield('css')

</head>

<body class="signup-page" >
<div class="signup-box">
    <div class="logo">
        <a href="{{url('/')}}"><b>{{\Config::get("app.name")}}</b></a>
        <small>{!! Lang::get('string.slogan') !!}</small>
    </div>
    <div class="card">
        <div class="body">
            
            @if(session()->has('error'))
                @include('alert/alert', ['type' => 'danger', 'message' => session('error')])
            @endif

            @if(session()->has('success'))
                @include('alert/alert', ['type' => 'success', 'message' => session('success')])
            @endif

            @if(session()->has('warning'))
                @include('alert/alert', ['type' => 'warning', 'message' => session('warning')])
            @endif
            <br>

            @if ($errors->any())
                <br>
                <div class="alert alert-danger">
                    <ul style="color:#ffffff!important">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')

        </div>
    </div>
</div>
{{HTML::script('material/plugins/jquery/jquery.min.js')}}
{{HTML::script('material/plugins/bootstrap/js/bootstrap.js')}}
{{HTML::script('material/plugins/node-waves/waves.js')}}
{{HTML::script('material/plugins/jquery-validation/jquery.validate.js')}}
{{HTML::script('material/js/admin.js')}}
{{HTML::script('material/js/pages/examples/sign-in.js')}}
{{HTML::script('startUI/js/lib/notie/notie.js')}}{{-- 
{{HTML::script('https://www.gstatic.com/firebasejs/4.4.0/firebase.js')}} --}}
{{HTML::script('material/js/pages/examples/sign-up.js')}}
{{--  {{HTML::script('js/fb.js') }} --}}

<script type="text/javascript">
    //document.addEventListener("deviceready", chargerLangue(), false);
    var onSuccess = function(location){
        setDetectedLocation(location);
    };
    var onError = function(error){

    };
    geoip2.city(onSuccess, onError);

    //window.sqlitePlugin.openDatabase()
</script>

@yield('scripts')
</body>

</html>
