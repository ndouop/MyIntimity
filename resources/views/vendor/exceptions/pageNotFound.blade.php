<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>{{\Config::get("app.name")}} - 404</title>

	<link href="startUI/img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="startUI/img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="startUI/img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
	<link href="startUI/img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
	<link href="startUI/img/favicon.png" rel="icon" type="image/png">
	<link href="startUI/img/favicon.ico" rel="shortcut icon">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
    {{HTML::style('startUI/css/lib/font-awesome/font-awesome.min.css')}}
    {{HTML::style('startUI/css/main.css')}}
 	<style type="text/css">
 		.page-center{
 			margin-top: 197px
 		}
 	</style>
</head>
<body>

    <div class="page-center">
        <div class="page-center-in">
            <div class="container-fluid">
                <div class="page-error-box">
                    <div class="error-code">4<i class="fa fa-frown-o"></i>4</div>
                    <div class="error-title">{{trans('front/exceptions.msg_404')}}</div>
                    <a href="{{url('/')}}" class="btn btn-rounded">{{trans('front/exceptions.back_home')}}</a>
                </div>
            </div>
        </div>
    </div><!--.page-center-->

	{{HTML::script('startUI/js/app.js')}}
</body>
</html>