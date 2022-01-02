<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{config()->get("app.name")}}</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <script>
        window.localLang = "{{app()->getLocale()}}";
    </script>
     {{HTML::script('js/trans.data.source.js')}}
    {{HTML::script("js/my-lang.js")}}
    @yield('css')
</head>

<body class="theme-pink" style="background-color: #FFFFFF!important">
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    @include('front.main.top')

    <section class="content" id="app">
        <div class="container-fluid">
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
                    <ul style="color:#2196f3!important">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- <example></example>
            <subjectComment></subjectComment> -->
            @yield('content')
        </div>
    </section>

    {{HTML::script('js/app.js')}}
    @yield('scripts')
   
    
</body>
</html>