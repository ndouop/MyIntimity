<!doctype html>
<!--[if lt IE 7]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="fr" class="no-js">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
	<meta name="description" content="{{trans('string.app_name')}} est une application qui vous permet de pr&eacute;visualiser votre cycle, et marque les p&eacute;riodes improtantes de celui-ci afin que rien ne vous &eacute;chappe. Votre s&eacute;curit&eacute; intime">
	<meta name="author" content="Vision Numerique">
	<meta name="keyword" content="vision numerique, MyIntimity, contraception, cycle menstruel, calendrier menstruel, choix du sexe, ovulation, application, règles, forum, éducation sexuelle, période féconde, période de règles, menstruation, menstru, période favorable pour un gar�on ">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{trans('string.app_name')}} | {{trans('front/welcome.title')}}</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <!-- Bootstrap 3.3.2 -->
    <link rel="stylesheet" href="{{ asset('assetsLandin/css/bootstrap.min.css')}}">
    
    <link rel="stylesheet" href="{{ asset('assetsLandin/css/animate.css')}}">
    <link rel="stylesheet" href="{{ asset('assetsLandin/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assetsLandin/css/slick.css')}}">
    <link rel="stylesheet" href="{{ asset('assetsLandin/js/rs-plugin/css/settings.css')}}">

    <link rel="stylesheet" href="{{ asset('assetsLandin/css/styles.css')}}">
    {{HTML::style('css/footer.css')}}
    <script>
        window.localLang = "{{app()->getLocale()}}";
    </script>
     {{HTML::script('js/trans.data.source.js')}}
    {{HTML::script("js/my-lang.js")}}


    <script type="text/javascript" src="{{ asset('assetsLandin/js/modernizr.custom.32033.js')}}"></script>

		{{HTML::style('css/style.css') }}
    <!--[if lt IE 9]>
      <script src="{{ asset('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')}}"></script>
      <script src="{{ asset('https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')}}"></script>
    <![endif]-->
</head>

<body>
    
    <div class="pre-loader">
        <div class="load-con">
            <img src="{{ asset('assetsLandin/img/logo_rose512.png')}}" class="animated fadeInDown" alt="">
            <div class="spinner">
              <div class="bounce1"></div>
              <div class="bounce2"></div>
              <div class="bounce3"></div>
            </div>
        </div>
    </div>
   
    <header>
        
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display  -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="fa fa-bars fa-mg"></span>
                        </button>
                        <a class="navbar-brand" href="{{url('/')}}">
                            <img src="{{ asset('assetsLandin/img/logo_rose512.png')}}" alt="" class="logo" width="100px">
                        </a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right">
                            <li><a href="#about">{!! Lang::get('string.menu_about') !!}</a> </li>
                            <li><a href="#features">{!! Lang::get('string.menu_feature') !!}</a> </li>
                            <li><a href="#screens">{!! Lang::get('string.menu_resention') !!}</a> </li>
                            <li><a href="#getApp">{!! Lang::get('string.menu_app2') !!}</a> </li>
                            <!--li><a href="#support">{!! Lang::get('string.menu_contact') !!}</a-->
                            <li><a href="{{url('cycle')}}">{!! Lang::get('string.menu_prevision') !!}</a>
                            <li><a href="{{url('soutenirTeam')}}">{!! Lang::get('string.menu_soutien') !!}</a> </li>
                            <li><a href="{{url('forum')}}">{!! Lang::get('string.menu_forum') !!}</a> </li>
                            <li><a href="{{url('cycle')}}">{!! Lang::get('string.menu_cycle') !!}</a> </li>
                            @if(auth()->check())
                                <li>
                                    <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ trans("front/navbar.logout") }}
                                    </a>
                                </li>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            @else
                                <li><a href="{{url('login')}}">{!! Lang::get('string.admin_label_login') !!}</a> </li>
                            @endif
                        </ul>
                        
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-->
        </nav>

        
        <!--RevSlider-->
        <div class="tp-banner-container">
            <div class="tp-banner" >
                <ul>
                    <!-- SLIDE  -->
                    <li data-transition="fade" data-slotamount="7" data-masterspeed="1500" >
                        <!-- MAIN IMAGE -->
                        <img src="assetsLandin/img/transparent.png"  alt="slidebg1"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                        <!-- LAYERS -->
                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption lfl fadeout hidden-xs"
                            data-x="left"
                            data-y="bottom"
                            data-hoffset="30"
                            data-voffset="0"
                            data-speed="500"
                            data-start="700"
                            data-easing="Power4.easeOut">
                            <img src="assetsLandin/img/freeze/Slides/hand-freeze1.png" alt="">
                        </div>


                        <div class="tp-caption large_white_bold sft title-size" data-x="550" data-y="center" data-hoffset="0" data-voffset="-80" data-speed="500" data-start="1200" data-easing="Power4.easeOut">
                            {!! Lang::get('string.app_name') !!}
                        </div>
                        <div class="tp-caption large_white_light sfb texte-size" data-x="550" data-y="center" data-hoffset="0" data-voffset="0" data-speed="1000" data-start="1500" data-easing="Power4.easeOut">
                            {!! trans('front/welcome.txt0') !!}<br/>
                        </div>

                        <div class="tp-caption sfb hidden-xs" data-x="550" data-y="center" data-hoffset="0" data-voffset="85" data-speed="1000" data-start="1700" data-easing="Power4.easeOut">
                            
                        </div>
                        <div class="tp-caption sfr hidden-xs" data-x="730" data-y="center" data-hoffset="0" data-voffset="85" data-speed="1500" data-start="1900" data-easing="Power4.easeOut">
                            <a href="https://goo.gl/WnXk6K" class="btn btn-default btn-lg">{{trans('front/welcome.opt_app')}}</a>
                        </div>

                    </li>
                    <!-- SLIDE 2 -->
                    <li data-transition="zoomout" data-slotamount="7" data-masterspeed="1000" >
                        <!-- MAIN IMAGE -->
                        <img src="assetsLandin/img/transparent.png"  alt="slidebg1"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                        <!-- LAYERS -->
                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption lfb fadeout hidden-xs"
                            data-x="center"
                            data-y="bottom"
                            data-hoffset="0"
                            data-voffset="0"
                            data-speed="1000"
                            data-start="700"
                            data-easing="Power4.easeOut">
                            <img src="assetsLandin/img/freeze/Slides/freeze-slide3.png" alt="">
                        </div>

                        
                        <div class="tp-caption large_white_light sft" data-x="center" data-y="250" data-hoffset="0" data-voffset="0" data-speed="1000" data-start="1400" data-easing="Power4.easeOut">
                            {{trans('front/welcome.slog')}} <i class="fa fa-heart"></i>
                        </div>
                        
                        
                    </li>

                    <!-- SLIDE 3 -->
                    <li data-transition="zoomout" data-slotamount="7" data-masterspeed="1000" >
                        <!-- MAIN IMAGE -->
                        <img src="assetsLandin/img/transparent.png"  alt="slidebg1"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                        <!-- LAYERS -->
                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption customin customout hidden-xs"
                            data-x="right"
                            data-y="center"
                            data-hoffset="0"
                            data-customin="x:50;y:150;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.5;scaleY:0.5;skewX:0;skewY:0;opacity:0;transformPerspective:0;transformOrigin:50% 50%;"
                        data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                            data-voffset="50"
                            data-speed="1000"
                            data-start="700"
                            data-easing="Power4.easeOut">
                            <img src="assetsLandin/img/freeze/Slides/family-freeze1.png" alt="">
                        </div>

                        <div class="tp-caption customin customout visible-xs"
                            data-x="center"
                            data-y="center"
                            data-hoffset="0"
                            data-customin="x:50;y:150;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.5;scaleY:0.5;skewX:0;skewY:0;opacity:0;transformPerspective:0;transformOrigin:50% 50%;"
                        data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                            data-voffset="0"
                            data-speed="1000"
                            data-start="700"
                            data-easing="Power4.easeOut">
                            <img src="assetsLandin/img/freeze/Slides/family-freeze1.png" alt="">
                        </div>

                        <div class="tp-caption lfb visible-xs" data-x="center" data-y="center" data-hoffset="0" data-voffset="400" data-speed="1000" data-start="1200" data-easing="Power4.easeOut">
                            <a href="{{url('/soutenirTeam')}}" class="btn btn-primary inverse btn-lg">{{trans('front/welcome.sout_app')}}</a>
                        </div>

                        
                        <div class="tp-caption mediumlarge_light_white sfl hidden-xs espace-texte-gauche" data-x="left" data-y="center" data-hoffset="0" data-voffset="-50" data-speed="1000" data-start="1000" data-easing="Power4.easeOut">
                           {{trans('front/welcome.f_disc')}}
                        </div>
                        <div class="tp-caption mediumlarge_light_white sft hidden-xs espace-texte-gauche" data-x="left" data-y="center" data-hoffset="0" data-voffset="0" data-speed="1000" data-start="1200" data-easing="Power4.easeOut">
                           {{trans('front/welcome.anonym')}}
                        </div>
                        <div class="tp-caption small_light_white sfb hidden-xs espace-texte-gauche" data-x="left" data-y="center" data-hoffset="0" data-voffset="80" data-speed="1000" data-start="1600" data-easing="Power4.easeOut">
                           <p style="color : white;">
						   {!! trans('front/welcome.txt1') !!}
						   </p>
                        </div>

                        <div class="tp-caption lfl hidden-xs espace-texte-gauche" data-x="left" data-y="center" data-hoffset="0" data-voffset="160" data-speed="1000" data-start="1800" data-easing="Power4.easeOut">
                            <a href="{{url('soutenirTeam')}}" class="btn btn-primary inverse btn-lg">{{trans('front/welcome.sout_app')}}</a>
                        </div>
                        
                        
                    </li>
                    
                </ul>
            </div>
        </div>


    </header>


    <div class="wrapper">

        

        <section id="about">
            <div class="container">
                
                <div class="section-heading scrollpoint sp-effect3">
                    <h1>{{trans('front/welcome.a_propo')}} </h1>
                    <div class="divider"></div>
                    <p>{!! Lang::get('string.app_name') !!} {{trans('front/welcome.txt2')}}</p>
                </div>
                <div class="row">
                    <div class="col-md-2 col-sm-1 col-xs-12">
                        &nbsp;
                    </div>
                    <style>
                        .video-container {
                            position: relative;
                            padding-bottom: 56.25%;
                            padding-top: 30px;
                            height: 0;
                            overflow: hidden;
                        }

                        .video-container iframe,
                        .video-container object,
                        .video-container embed {
                            position: absolute;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                        }
                        .video-wrapper {
                            width: 100%;
                            /*max-width: 100%;*/

                        }
                        .marding-bot{
                            margin-bottom: 45px;
                        }
                    </style>
                    <div class="col-md-8 col-sm-10 col-xs-12 marding-bot">
                        <div class="video-wrapper">
                            <div class="video-container">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/0DbMNFRh6-M?rel=0" frameborder="0" allowfullscreen></iframe>
                            </div>
                            <!-- /video -->
                        </div>

                    </div>
                    <div class="col-md-2 col-sm-1 col-xs-12">
                        &nbsp;
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <div class="about-item scrollpoint sp-effect2">
                            <i class="fa fa-calendar fa-2x"></i>
                            <h3>{{trans('front/welcome.prev_m')}}</h3>
                            <p>{!! Lang::get('string.app_name') !!}{{trans('front/welcome.txt3')}}</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-6" >
                        <div class="about-item scrollpoint sp-effect5">
                            <i class="fa fa-child fa-2x"></i>
                            <h3>{{trans('front/welcome.sex_bb')}}</h3>
                            <p>{!! Lang::get('string.app_name') !!}{{trans('front/welcome.txt4')}}</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12" >
                        <div class="about-item scrollpoint sp-effect5">
                            <i class="fa fa-users fa-2x"></i>
                            <h3>{{trans('front/welcome.f_disc')}}</h3>
                            <p>{{trans('front/welcome.txt5')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="features">
            <div class="container">
                <div class="section-heading scrollpoint sp-effect3">
                    <h1>{{trans('front/welcome.fonct')}}</h1>
                    <div class="divider"></div>
                    <p>{{trans('front/welcome.app_intui')}}</p>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-4 scrollpoint sp-effect1">
                        <div class="media text-right feature">
                            <a class="pull-right" href="#">
                                <i class="fa fa-cogs fa-2x"></i>
                            </a>
                            <div class="media-body">
                                <h3 class="media-heading">{{trans('front/welcome.gest_prof')}}</h3>
                                {{trans('front/welcome.txt6')}}
                            </div>
                        </div>
                        <div class="media text-right feature">
                            <a class="pull-right" href="#">
                                <i class="fa fa-calendar fa-2x"></i>
                            </a>
                            <div class="media-body">
                                <h3 class="media-heading">{{trans('front/welcome.previ')}}</h3>
                                {{trans('front/welcome.txt7')}}
                            </div>
                        </div>
                        <div class="media text-right feature">
                            <a class="pull-right" href="#">
                                <i class="fa fa-child fa-2x"></i>
                            </a>
                            <div class="media-body">
                                <h3 class="media-heading">{{trans('front/welcome.fec')}}</h3>
                                {{trans('front/welcome.txt8')}}
                            </div>
                        </div>
                        <div class="media text-right feature">
                            <a class="pull-right" href="#">
                                <i class="fa fa-building-o fa-2x"></i> 
                            </a>
                            <div class="media-body">
                                <h3 class="media-heading">{{trans('front/welcome.sex_child')}}</h3>
                                {{trans('front/welcome.txt9')}}
                            </div>
                        </div>
                        <div class="media text-right feature">
                            <a class="pull-right" href="#">
                                <i class="fa fa-bell fa-2x"></i>
                            </a>
                            <div class="media-body">
                                <h3 class="media-heading">{{trans('front/welcome.noti')}}</h3>
                                {{trans('front/welcome.txt10')}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4" >
                        <img src="assetsLandin/img/freeze/iphone-freeze2.png" class="img-responsive scrollpoint sp-effect5" alt="">
                    </div>
                    <div class="col-md-4 col-sm-4 scrollpoint sp-effect2">
                        <div class="media feature">
                            <a class="pull-left" href="#">
                                <i class="fa fa-map-marker fa-2x"></i>
                            </a>
                            <div class="media-body">
                                <h3 class="media-heading">{{trans('front/welcome.loc')}}</h3>
                                {{trans('front/welcome.txt11')}}
                            </div>
                        </div>
                        <div class="media feature">
                            <a class="pull-left" href="#">
                                <i class="fa fa-film fa-2x"></i>
                            </a>
                            <div class="media-body">
                                <h3 class="media-heading">Media</h3>
                                {{trans('front/welcome.txt12')}}
                            </div>
                        </div>
                        <div class="media feature">
                            <a class="pull-left" href="#">
                                <i class="fa fa-filter fa-2x"></i> 
                            </a>
                            <div class="media-body">
                                <h3 class="media-heading">{{trans('front/welcome.contrac')}}</h3>
                                {{trans('front/welcome.txt13')}}
                            </div>
                        </div>
                        <div class="media feature">
                            <a class="pull-left" href="#">
                                <i class="fa fa-group fa-2x"></i> 
                            </a>
                            <div class="media-body">
                                <h3 class="media-users">{{trans('front/welcome.create_rel')}}</h3>
                                {{trans('front/welcome.txt14')}}
                            </div>
                        </div>
                        <div class="media active feature">
                            <a class="pull-left" href="#">
                                <i class="fa fa-plus fa-2x"></i>
                            </a>
                            <div class="media-body">
                                <h3 class="media-heading">{{trans('front/welcome.more_yet')}}</h3>
                                {{trans('front/welcome.txt15')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="reviews">
            <div class="container">
                <div class="section-heading inverse scrollpoint sp-effect3">
                    <h1>{{trans('front/welcome.ours_s')}}</h1>
                    <div class="divider"></div>
                    <p>{{trans('front/welcome.txt16')}}</p>
                </div>
                <div class="row">
                    <div class="col-md-10 col-md-push-1 scrollpoint sp-effect3">
                        <div class="review-filtering">
							@if(isset($sujets_like))
								<?php $i = 0; ?>
								@foreach($sujets_like as $sujet_like)
									
									<div class="review {{($i > 0) ? 'rollitin' : ''}}">
										<div class="row">
											<div class="col-md-2">
												<div class="review-person">
													@if($sujet_like->anonyme == 0)
														@if(!is_null($sujet_like->user->avatar) && $sujet_like->user->avatar != "")
															{{HTML::image("images/Avatar/".$sujet_like->user->avatar, "Avatar", array("class"=>""))}}
														@else
															@if($sujet_like->user->sexe != "feminin")
																{{HTML::image("images/avatars/default_male.png", "Avatar", array("class"=>""))}}
															@else
																{{HTML::image("images/avatars/default_female.png", "Avatar", array("class"=>""))}}
															@endif
														@endif
													@else
														@if($sujet_like->user->sexe != "feminin")
															{{HTML::image("images/avatars/default_male.png", "Avatar", array("class"=>""))}}
														@else
															{{HTML::image("images/avatars/default_female.png", "Avatar", array("class"=>""))}}
														@endif
													@endif
												</div>
											</div>
											<div class="col-md-10">
												<div class="review-comment">
													<h3>{!! mb_strimwidth($sujet_like->description, 0, 100, "...") !!}</h3>
													<p>
														@if($sujet_like->anonyme == 0)
															<span class="center blue-name">{{$sujet_like->user->login}}</span>
														@else
															<span class="center blue-name">{{Lang::get('cycle.anonyme')}}</span>
														@endif
														<div class="tbl-cell">
															<p class="user-card-row-status">
																<div class="col-md-12 style-like-acceuil" > 
																	@if(Auth::check() && !Auth::User()->IAlreadyLikedThisPost($sujet_like->id))
																		<span id="likesujet_{{$sujet_like->id}}"
                                                                              onclick=" like_sujet({{$sujet_like->id}},{{Auth::User()->id}},{{$sujet_like->nblike}}, 0, '{{Lang::get('cycle.vous')}}', '{{Lang::get('cycle.vous_et')}}', '{{Lang::get('cycle.autre')}}' );" >
																			<i class="fa fa-heart icon-like-coment"></i> {{$sujet_like->nblike}}
																		</span>
																	@else

																		@if(!Auth::check())
																			<a href="{{URL::to('/login')}}"><i class="fa fa-heart icon-like-coment"></i></a> {{$sujet_like->nblike}}
																		@else
																			<i class="fa fa-heart  icon-like-coment-active"></i> 
																			@if($sujet_like->nblike - 1 <= 0)
																				{{Lang::get('cycle.vous')}}
																			@else
																				{{Lang::get('cycle.vous_et')}} {{$sujet_like->nblike -1}} {{Lang::get('cycle.autre')}}
																			@endif
																		@endif
																	@endif
																	&nbsp;&nbsp;&nbsp;
																	
																	<a href="{{url('/forum/discussion/sujet/'.$sujet_like->id)}}"><i class="fa fa-comment icon-like-coment"></i></a> {{$sujet_like->nbcomment}}
																	&nbsp;&nbsp;&nbsp;
																	<a href="{{url('/forum/discussion/sujet/'.$sujet_like->id)}}" title="{{Lang::get('string.detail')}}">
																		<i class="fa fa-eye icon-like-coment"></i> 
																	</a>
																</div>
															</p>
														</div>
													</p>
												</div>
											</div>
										</div>
									</div>
									<?php $i++; ?>
									
								@endforeach
										
							@endif
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="screens">
            <div class="container">

                <div class="section-heading scrollpoint sp-effect3">
                    <h1>{{trans('front/welcome.pres')}}</h1>
                    <div class="divider"></div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-sm-1 col-xs-12">
                        &nbsp;
                    </div>
                    <style>

                    </style>
                    <div class="col-md-8 col-sm-10 col-xs-12 marding-bot">
                        <div class="video-wrapper">
                            <div class="video-container">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/xx7g_lwnN2k?rel=0" frameborder="0" allowfullscreen></iframe>

                            </div>
                            <!-- /video -->
                        </div>

                    </div>
                    <div class="col-md-2 col-sm-1 col-xs-12">
                        &nbsp;
                    </div>
                </div>
                <div class="slider filtering scrollpoint sp-effect5" >
                    <div class="one">
                        <img src="assetsLandin/img/freeze/screens/profile1.jpg" alt="">
                        <h4>{{trans('front/welcome.share')}}</h4>
                    </div>
                    <div class="one">
                        <img src="assetsLandin/img/freeze/screens/menu1.jpg" alt="">
                        <h4>{{trans('front/welcome.main_tog')}}</h4>
                    </div>
                    <div class="one">
                        <img src="assetsLandin/img/freeze/screens/sales1.jpg" alt="">
                        <h4>{{trans('front/welcome.noti')}}</h4>
                    </div>
                    <div class="one">
                        <img src="assetsLandin/img/freeze/screens/calendar1.jpg" alt="">
                        <h4>{{trans('front/welcome.previ')}}</h4>
                    </div>
                </div>
            </div>
        </section>

        <section id="getApp">
            <div class="container-fluid">
                <div class="section-heading inverse scrollpoint sp-effect3">
                    <h1>{{trans('front/welcome.opt_app')}}</h1>
                    <div class="divider"></div>
                    <p>{{trans('front/welcome.txt17')}}

                    </p>

                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="hanging-phone scrollpoint sp-effect2 hidden-xs">
                            <img src="assetsLandin/img/freeze/freeze-angled3.png" alt="">
                        </div>
                        <div class="platforms">
                            <a href="https://goo.gl/WnXk6K" class="btn btn-primary inverse scrollpoint sp-effect1">
                                <i class="fa fa-android fa-3x pull-left"></i>
                                <span>{{trans('front/welcome.dwnld')}}</span><br>
                                <b>Android</b>
                            </a>
                            
                                
                        </div>

                    </div>
                </div>

                

            </div>
        </section>

        <section id="support" class="doublediagonal">
            <div class="container">
                <div class="section-heading scrollpoint sp-effect3">
                    <h1>Contact</h1>
                    <div class="divider"></div>
                    <p>{{trans('front/welcome.txt18')}}</p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-7 col-sm-7 ">
                                <form role="form" action="{{url('/')}}" id="contactUsForm" method="post">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="form-group">
                                        <label for="contactUsNom">{{trans('front/welcome.label.nom')}} *</label>
                                        <input type="text" class="form-control" id="contactUsNom"  name="nom" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="contactUsEmail">{{trans('front/welcome.label.email')}} * </label>
                                        <input type="email" class="form-control" id="contactUsEmail"  name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="contactUsMessage">{{trans('front/welcome.label.msg')}} *</label>
                                        <textarea cols="30" rows="10" class="form-control" id="contactUsMessage"  name="msg" required></textarea>
                                    </div>
                                    <button type="submit" id="contactUsFormBtnSubmit" class="btn btn-primary btn-lg">
                                        {{trans('front/welcome.send')}}
                                        <i class="fa fa-spinner fa-spin" id="loading"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-5 col-sm-5 contact-details scrollpoint sp-effect2">
                                <div class="media">
                                    <a class="pull-left" href="#" >
                                        <i class="fa fa-map-marker fa-2x"></i>
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">{{trans('front/welcome.txt19')}}</h4>
                                    </div>
                                </div>
                                <div class="media">
                                    <a class="pull-left" href="#" >
                                        <i class="fa fa-envelope fa-2x"></i>
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">
                                            <a href="mailto:contact@myintimity.vision-numerique.com">contact@myintimity.vision-numerique.com</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



@include('layouts.footer')

        

    </div>
    <script src="assetsLandin/js/jquery-1.11.1.min.js"></script>
    <script src="assetsLandin/js/bootstrap.min.js"></script>
    <script src="assetsLandin/js/slick.min.js"></script>
    <script src="assetsLandin/js/placeholdem.min.js"></script>
    <script src="assetsLandin/js/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
    <script src="assetsLandin/js/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script src="assetsLandin/js/waypoints.min.js"></script>
    {{HTML::script('startUI/js/lib/notie/notie.js')}}
    <script src="assetsLandin/js/scripts.js"></script>
    <script>
        $(document).ready(function() {

            $("#loading").hide();

            appMaster.preLoader();
        });
    </script>
</body>

</html>
