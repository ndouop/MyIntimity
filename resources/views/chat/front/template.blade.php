<!DOCTYPE html>
<html>
<head lang="{{ Config::get('app.locale') }}">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="baseUrl" value="{{url("/")}}">
	<title>{{trans('string.app_name')}} - {{trans('front/chat.title')}}</title>

	<link href="{{asset('startUI/img/favicon.144x144.png')}}" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="{{asset('startUI/img/favicon.114x114.png')}}" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="{{asset('startUI/img/favicon.72x72.png')}}" rel="apple-touch-icon" type="image/png" sizes="72x72">
	<link href="{{asset('startUI/img/favicon.57x57.png')}}" rel="apple-touch-icon" type="image/png">
	<link href="{{asset('startUI/img/favicon.png')}}" rel="icon" type="image/png">
	<link href="{{asset('startUI/img/favicon.ico')}}" rel="shortcut icon">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js')}}
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js')}}
	<![endif]-->
    <link rel="stylesheet" href="{{asset('startUI/css/lib/font-awesome/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('startUI/css/main.css')}}">
    {{HTML::style("css/chat.css")}}
    {{HTML::style('css/footer.css')}}
    <script>
        window.localLang = "{{app()->getLocale()}}";
    </script>
     {{HTML::script('js/trans.data.source.js')}}
    {{HTML::script("js/my-lang.js")}}
    @yield('css')
</head>
<body class="with-side-menu">
    @include('discution.includes.navbar',
        ["notifications"=> (auth()->check() ? auth()->user()->notificationsNotSeen(): null),
        "inboxes"=> (auth()->check() ? auth()->user()->inboxes: null)
        ])
    <div class="center-content">
        @yield('content')  
    </div>
    @include('layouts.footer')


{{--HTML::script('js/app.js')--}}

{{HTML::script('startUI/js/lib/jquery/jquery.min.js')}}
{{HTML::script('startUI/js/lib/tether/tether.min.js')}}
{{HTML::script('startUI/js/lib/bootstrap/bootstrap.min.js')}}
{{HTML::script('startUI/js/plugins.js')}}
{{HTML::script('startUI/js/lib/bootstrap-select/bootstrap-select.min.js')}}
{{HTML::script('startUI/js/lib/select2/select2.full.min.js')}}

    {{HTML::script('startUI/js/lib/notie/notie.js')}}
{{--  <script type="text/javascript" src="http://mervick.github.io/lib/google-code-prettify/prettify.js"></script>
  <script>
    window.emojioneVersion = "3.1";
  </script>
  <script type="text/javascript" src="startUI/js/lib/emojionearea-master/dist/emojionearea.js"></script> --}}
    {{HTML::script('js/chat.js')}}
    <script>
        $(function() {
            $('.chat-settings .change-bg-color label').on('click', function() {
                var color = $(this).data('color');

                $('.messenger-message-container.from').each(function() {
                    $(this).removeClass(function (index, css) {
                        return (css.match (/(^|\s)bg-\S+/g) || []).join(' ');
                    });

                    $(this).addClass('bg-' + color);
                });
            });
        });
    </script>

    {{HTML::script('startUI/js/app.js')}}
    {{HTML::script('js/my.js')}}

@yield('scripts')
</body>
</html>