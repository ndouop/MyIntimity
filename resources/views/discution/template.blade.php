<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="{{trans('string.app_name')}} est une application qui vous permet de pr&eacute;visualiser votre cycle, et marque les p&eacute;riodes improtantes de celui-ci afin que rien ne vous &eacute;chappe. Votre s&eacute;curit&eacute; intime">
	<meta name="author" content="Vision Numerique">
	<meta name="keyword" content="vision numerique, MyIntimity, contraception, cycle menstruel, calendrier menstruel, choix du sexe, ovulation, application, règles, forum, éducation sexuelle, période féconde, période de règles, menstruation, menstru, période favorable pour un garçon ">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="baseUrl" value="{{url('/')}}">

	<title>
		@yield("title")
	</title>

	<!--
	<link href="{{asset('startUI/img/favicon.144x144.png')}}" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="{{asset('startUI/img/favicon.114x114.png')}}" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="{{asset('startUI/img/favicon.72x72.png')}}" rel="apple-touch-icon" type="image/png" sizes="72x72">
	<link href="{{asset('startUI/img/favicon.57x57.png')}}" rel="apple-touch-icon" type="image/png">
	<link href="{{asset('startUI/img/smile.png')}}" rel="icon" type="image/png">
	<link href="{{asset('favicon.ico')}}" rel="shortcut icon"> -->


	<link rel="manifest" href="{{asset('images/icon/manifest.json')}}">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="{{asset('images/icon/ms-icon-144x144.png')}}">
	<meta name="theme-color" content="#ffffff">


	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	{{HTML::script('https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js')}}
	{{HTML::script('https://oss.maxcdn.com/respond/1.4.2/respond.min.js')}}
	<![endif]-->
	{{HTML::style('startUI/css/lib/ion-range-slider/ion.rangeSlider.css')}}
	{{HTML::style('startUI/css/lib/ion-range-slider/ion.rangeSlider.skinHTML5.css')}}
	{{HTML::style('startUI/css/lib/font-awesome/font-awesome.min.css')}}
	{{HTML::style('startUI/js/lib/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}
	{{HTML::style('startUI/css/main.source.css')}}
	{{HTML::style('css/rose.css')}}
	{{HTML::style('chat-box/cb.css')}}
	{{HTML::style('css/style.css')}}
	{{HTML::style('css/menu.css')}}
	{{HTML::style('css/footer.css')}}
	{{HTML::style('assets/plugins/Magnific-Popup-master/dist/magnific-popup.css')}}
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

	{{HTML::script('//js.maxmind.com/js/apis/geoip2/v2.1/geoip2.js')}}
	{{HTML::script('/js/localisationScript.js')}}
	<script>
		window.localLang = "{{app()->getLocale()}}";
	</script>
	 {{HTML::script('js/trans.data.source.js')}}
	{{HTML::script("js/my-lang.js")}}

	@yield('css')
</head>
<body class="bg-general">

<?php
$user_connect = auth()->user();
?>
@if (auth()->check())
	<span id="iam-gest" value="false"></span>
	<div class="user-connect">
		<input type="hidden" class="firstname" value="{{$user_connect->prenom}}">
		<input type="hidden" class="lastname" value="{{$user_connect->nom}}">
		<input type="hidden" class="login" value="{{$user_connect->login}}">
		<input type="hidden" class="id" value="{{$user_connect->id}}">
		<input type="hidden" class="fuid" value="{{$user_connect->fuid}}">
		<input type="hidden" class="email" value="{{$user_connect->email}}">
		<input type="hidden" class="passfire" value="{{$user_connect->passfire}}">
		<input type="hidden" class="avatar" value="{{$user_connect->avatar}}">
	</div>

	<span class="span-container-sender-id" data-sender-id="{{$user_connect->id}}">
        <span class="data-sender-name" value="{{$user_connect->nom}} {{$user_connect->prenom}}"></span>
        <span class="data-sender-fuid" value="{{$user_connect->fuid}}"></span>
        <span class="data-sender-email" value="{{$user_connect->email}}"></span>
        <span class="data-sender-avatar" value="{{is_null($user_connect->avatar)?"avatar-1-32.png":$user_connect->avatar}}"></span>
        <span class="data-sender-login" value="{{$user_connect->login}}"></span>
    </span>

@else
	<span id="iam-gest" value="true"></span>
@endif

@include('discution.includes.navbar',
    ["notifications"=> (auth()->check() ? auth()->user()->notificationsNotSeen(): null),
    "inboxes"=> (auth()->check() ? auth()->user()->inboxes: null)
    ])
<br>
<div class="page-content" id="up">
	@yield('content')
	{{-- ici un insert le block du chatbox --}}
	<div class="block-chatbox"></div>
	{{-- @include('chat.components.box') --}}
	{{-- end block-chatbox --}}
	@include('discution.includes.footer')
	@include('discution.includes.components.gotoup')

</div><!--.page-content-->



@include('layouts.footer')




{{-- {{HTML::script(mix('js/app.js'))}} --}}
{{HTML::script('startUI/js/lib/jquery/jquery.min.js')}}
{{HTML::script('startUI/js/lib/tether/tether.min.js')}}
{{HTML::script('startUI/js/lib/bootstrap/bootstrap.min.js')}}
{{HTML::script('startUI/js/lib/jScrollPane/jquery.jscrollpane.min.js')}}
{{HTML::script('startUI/js/plugins.js')}}
{{HTML::script('startUI/js/lib/bootstrap-select/bootstrap-select.min.js')}}
{{HTML::script('startUI/js/lib/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}
{{HTML::script('startUI/js/lib/select2/select2.full.min.js')}}
{{HTML::script('startUI/js/lib/salvattore/salvattore.min.js')}}
{{HTML::script('startUI/js/lib/ion-range-slider/ion.rangeSlider.js')}}
{{HTML::script('startUI/js/lib/notie/notie.js')}}
{{HTML::script('startUI/js/app.js')}}
{{HTML::script('js/bundle.js')}}
{{HTML::script('js/my.js')}}
{{HTML::script('assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup.min.js')}}
{{HTML::script('js/magnific-gallery.js')}}

<script>
	var baseUrl = "{{url('/')}}";
	$('.date-picker').datepicker({
	    orientation: "left",
	    autoclose: true
	});
	$(".select2").select2();
</script>

@yield('scripts')

</body>
</html>