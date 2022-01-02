<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="Reassured Woman : l'intimité au féminin">
		<meta name="author" content="Vision Numerique">
		<meta name="keyword" content="pressing, vision numerique, ">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		@yield('meta')
		
		<link rel="shortcut icon" href="img/favicon.png">

		<title>
			@yield('title')
		</title>
		
		
		<link href="img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
		<link href="img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
		<link href="img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
		<link href="img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
		<link href="img/favicon.png" rel="icon" type="image/png">
		<link href="img/favicon.ico" rel="shortcut icon">

		
		<!--[if lt IE 9]>
			<script src="{{ asset('https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js')}}"> </script>
			<script src="{{ asset('https://oss.maxcdn.com/respond/1.4.2/respond.min.js')}}"> </script>
		<![endif]-->
		
		{{HTML::style("css/lib/lobipanel/lobipanel.min.css") }}
		{{HTML::style('css/lib/jqueryui/jquery-ui.min.css') }}
		{{HTML::style('css/lib/font-awesome/font-awesome.min.css') }}
		{{HTML::style('simple_calender/css/dncalendar-skin.css') }}
		{{HTML::style('css/normalize2.css') }}
		{{HTML::style('css/demo.css') }}
		{{HTML::style('css/component.css') }}
		{{HTML::style('css/main.css') }}
		{{HTML::style('css/style.css') }}



	</head>

  <body>
  @include('lang.lang')
  
	<!-- start: Header -->
        
	<header class="site-header">
	    <div class="container-fluid">
	        <a href="#" class="site-logo">
	            <img class="hidden-md-down" src="{{ asset('images/logo.png')}}" alt="">
	            <img class="hidden-lg-up" src="{{ asset('images/logo.png')}}" alt="">
	        </a>
	
	        <button class="hamburger hamburger--htla">
	            <span>toggle menu</span>
	        </button>
	        <div class="site-header-content">
	            <div class="site-header-content-in">
	                <div class="site-header-shown">
	                    
	                    <div class="dropdown dropdown-lang margin-menu">
	                        <a class="" href="{{url('cycle')}}"> Accueil </a>
	                    </div>
						@if(!Auth::check())
	                    <div class="dropdown dropdown-lang margin-menu">
	                        <a class="" href="{{url('login')}}"> Connexion </a>
	                    </div>
						@endif
						
						@if(Auth::check())
							<div class="dropdown dropdown-lang margin-menu">
								<a class="" href="{{url('profil')}}"> profil </a>
							</div>
						@endif
	                    <div class="dropdown user-menu">
	                        <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                            @if(Auth::check())
									@if(Auth::User()->avatar != null && Auth::User()->avatar != "")
										{{HTML::image("images/Avatar/".Auth::User()->avatar, "Avatar", array("class"=>""))}}
									@else
										@if(Auth::User()->sexe == "H")
											{{HTML::image("images/Avatar/default_male.png", "Avatar", array("class"=>""))}}
										@else
											{{HTML::image("images/Avatar/default_female.png", "Avatar", array("class"=>""))}}
										@endif
									@endif
								@else
									<img src="img/avatar-2-64.png" alt="">
								@endif
								
	                        </button>
	                        
	                    </div>
	
	                    <button type="button" class="burger-right">
	                        <i class="font-icon-menu-addl"></i>
	                    </button>
	                </div><!--.site-header-shown-->
	
	                <div class="mobile-menu-right-overlay"></div>
	                
	            </div><!--site-header-content-in-->
	        </div><!--.site-header-content-->
	    </div><!--.container-fluid-->
	</header><!--.site-header-->
	<!-- end: Header -->
	
	<div class="mobile-menu-left-overlay"></div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
  
  
	
	@yield('contenu')
    
	
	
	
	
	
	
	
	

    <!--footer start-->
	
	<footer>
		<div class="col-md-12 line1 no-margin">
			<div class="col-md-12 text-center espace-titre-footer">
				<h3>Souscrivez pour plus d'information!</h3>
			</div>
			<div class="col-md-12 text-center">
				<div class="col-md-4">
					<section class="box-typical box-sujet-like">
						<header class="box-typical-header-sm">
							Dernier post
						</header>
						<div class="col-md-12">
							@if(isset($sujets_cment) && count($sujets_cment) > 0)
								<?php
									$sujet_like = $sujets_cment[0];
								?>
								<div class="slide">
									<div class="citate-speech-bubble">
										{{mb_strimwidth($sujet_like->description, 0, 100, "...")}}
									</div>
									<div class="user-card-row">
										<div class="tbl-row">
											<div class="tbl-cell tbl-cell-photo">
												@if($sujet_like->anonyme == 0)
													@if($sujet_like->user->avatar != null && $sujet_like->user->avatar != "")
														{{HTML::image("images/Avatar/".$sujet_like->user->profile[0].image, "Avatar", array("class"=>""))}}
													@else
														@if($sujet_like->user->sexe == "H")
															{{HTML::image("images/Avatar/default_male.png", "Avatar", array("class"=>""))}}
														@else
															{{HTML::image("images/Avatar/default_female.png", "Avatar", array("class"=>""))}}
														@endif
													@endif
													<br/>
													<span class="center blue-name">{{$sujet_like->user->login}}</span>
												@else
													@if($sujet_like->user->sexe == "H")
														{{HTML::image("images/Avatar/default_male.png", "Avatar", array("class"=>""))}}
													@else
														{{HTML::image("images/Avatar/default_female.png", "Avatar", array("class"=>""))}}
													@endif
													<span class="center blue-name">{{Lang::get('cycle.anonyme')}}</span>
												@endif
											</div>
											<div class="tbl-cell">
												
												<p class="user-card-row-status">
													<div class="col-md-12 like-footer" > 
														@if(Auth::check() && $sujet_like->user_like(Auth::User()->id)->count() == 0)
															<span id="likesujet_{{$sujet_like->id}}" onclick=" like_sujet({{$sujet_like->id}},{{Auth::User()->id}},{{$sujet_like->nblike}}, 0, '{{Lang::get('cycle.vous')}}', '{{Lang::get('cycle.vous_et')}}', '{{Lang::get('cycle.autre')}}' );" >
																<i class="fa fa-heart icon-like-coment"></i> {{$sujet_like->nblike}}
															</span>
														@else

															@if(!Auth::check())
																<a href="{{URL::to('/login')}}"><i class="fa fa-heart icon-like-coment"></i></a> {{$sujet_like->nblike}}
															@else
																<i class="fa fa-heart  icon-like-coment-active"></i> 
																@if($sujet_like->nblike -1 <= 0)
																	{{Lang::get('cycle.vous')}}
																@else
																	{{Lang::get('cycle.vous_et')}} {{$sujet_like->nblike -1}} {{Lang::get('cycle.autre')}}
																@endif
															@endif
														@endif
														&nbsp;&nbsp;&nbsp;
														
														<i class="fa fa-comment icon-like-coment"></i>  {{$sujet_like->nbcoment}}
														&nbsp;&nbsp;&nbsp;
														<a href="{{url('detail_sujet/'.$sujet_like->id)}}" title="{{Lang::get('string.detail')}}">
															<i class="fa fa-eye icon-like-coment"></i> 
														</a>
													</div>
												</p>
											</div>
										</div>
									</div>
								</div><!--.slide-->
							@endif
							

							
						</div><!--.recomendations-slider-->
					</section><!--.box-typical-->
				</div>
				<div class="col-md-3">
				
				</div>
				<div class="col-md-5 text-right ">
					<div class="input-group">
						<input class="form-control" name='email' placeholder='Enter Votre email'/>
						<div class="input-group-addon no-padding">
							<button type="submit" class="btn btn-repondre btn-sm">{{Lang::get('cycle.souscrir')}}</button>
						</div>
					</div>
					<br/>
					<div class="social col-md-12 text-right">
						<button type="button" class="btn-square-icon f-btn">
							<i class="fa fa-facebook"></i>
							Facebook
						</button>
						<button type="button" class="btn-square-icon g-btn">
							<i class="fa fa-google"></i>
							google
						</button>
						<button type="button" class="btn-square-icon t-btn">
							<i class="fa fa-twitter"></i>
							twitter
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="line2">
			<div class="container">
				<div class="row downLine">
					<div class="col-md-6 text-left copy espace-top-bottom-footer">
						<p>
							Copyright &copy; 2016 &nbsp;&nbsp;&nbsp;
							<span class = "blueProxiPressing">R</span>
							<span class = "whiteProxiPressing">W</span> 
						</p>
					</div>
					<div class="col-md-6 text-right dm espace-top-bottom-footer">
						<ul id="downMenu">
							<li class="active"><a href="#home">Accueil</a></li>
							<li><a href="#about">A propos</a></li>
							
							<li class="last"><a href="#contact">Contact</a></li>
							<!--li><a href="#features">Features</a></li-->
						</ul>
					</div>
				</div>
			</div>
		</div>
		
    </footer>




  <script src="{{ asset('js/lib/jquery/jquery.min.js')}}"></script>
  <script src="{{ asset('js/lib/tether/tether.min.js')}}"></script>
  <script src="{{ asset('js/lib/bootstrap/bootstrap.min.js')}}"></script>
  <script src="{{ asset('js/plugins.js')}}"></script>

	<script src="{{ asset('js/lib/jqueryui/jquery-ui.min.js')}}"></script>
	<script src="{{ asset('js/lib/lobipanel/lobipanel.min.js')}}"></script>
	<script src="{{ asset('js/lib/jquery-tag-editor/jquery.caret.min.js')}}"></script>
	<script src="{{ asset('js/lib/jquery-tag-editor/jquery.tag-editor.min.js')}}"></script>
	<script src="{{ asset('js/lib/bootstrap-select/bootstrap-select.min.js')}}"></script>
	<script src="{{ asset('js/lib/select2/select2.full.min.js')}}"></script>
	<script src="{{ asset('js/lib/match-height/jquery.matchHeight.min.js')}}"></script>
    <script src="{{ asset('js/fonction.js')}}"></script>
	{{HTML::script('js/loader.js')}}
	{{HTML::script('simple_calender/js/dncalendar.js')}}
	{{HTML::script('js/modernizr.custom.js')}}
	{{HTML::script('js/classie.js')}}
	{{HTML::script('js/tiltSlider.js')}}
		
	<script>
		new TiltSlider( document.getElementById( 'slideshow' ) );
		
		window.setInterval(function(){              
			$('nav>.current').next().trigger('click');
			if($('nav > .current').next().index() == '-1'){
				$('nav > span').trigger('click');
			}               
		}, 5000);
		
	</script>
	

	 
	<script>
		$(document).ready(function() {
			window.urlposter_sujet = "{{URL::action("ApiController@api_poster_sujet")}}";
			window.urllike_sujet = "{{URL::action("ApiController@api_like")}}";
			window.token = '{{csrf_token()}}';
			window.urlmaj_calander = "{{URL::action("CycleController@maj_calander")}}";
			window.window.urlnotes = "{{URL::action("CycleController@notes")}}";

			
			
			
			
			
			$('.panel').lobiPanel({
				sortable: true
			});
			$('.panel').on('dragged.lobiPanel', function(ev, lobiPanel){
				$('.dahsboard-column').matchHeight();
			});

			google.charts.load('current', {'packages':['corechart']});
			google.charts.setOnLoadCallback(drawChart);
			function drawChart() {
				var dataTable = new google.visualization.DataTable();
				dataTable.addColumn('string', 'Day');
				dataTable.addColumn('number', 'Values');
				// A column for custom tooltip content
				dataTable.addColumn({type: 'string', role: 'tooltip', 'p': {'html': true}});
				dataTable.addRows([
					['MON',  130, ' '],
					['TUE',  130, '130'],
					['WED',  180, '180'],
					['THU',  175, '175'],
					['FRI',  200, '200'],
					['SAT',  170, '170'],
					['SUN',  250, '250'],
					['MON',  220, '220'],
					['TUE',  220, ' ']
				]);

				var options = {
					height: 314,
					legend: 'none',
					areaOpacity: 0.18,
					axisTitlesPosition: 'out',
					hAxis: {
						title: '',
						textStyle: {
							color: '#fff',
							fontName: 'Proxima Nova',
							fontSize: 11,
							bold: true,
							italic: false
						},
						textPosition: 'out'
					},
					vAxis: {
						minValue: 0,
						textPosition: 'out',
						textStyle: {
							color: '#fff',
							fontName: 'Proxima Nova',
							fontSize: 11,
							bold: true,
							italic: false
						},
						baselineColor: '#16b4fc',
						ticks: [0,25,50,75,100,125,150,175,200,225,250,275,300,325,350],
						gridlines: {
							color: '#1ba0fc',
							count: 15
						},
					},
					lineWidth: 2,
					colors: ['#fff'],
					curveType: 'function',
					pointSize: 5,
					pointShapeType: 'circle',
					pointFillColor: '#f00',
					backgroundColor: {
						fill: '#008ffb',
						strokeWidth: 0,
					},
					chartArea:{
						left:0,
						top:0,
						width:'100%',
						height:'100%'
					},
					fontSize: 11,
					fontName: 'Proxima Nova',
					tooltip: {
						trigger: 'selection',
						isHtml: true
					}
				};

				var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
				chart.draw(dataTable, options);
			}
			$(window).resize(function(){
				drawChart();
				setTimeout(function(){
				}, 1000);
			});
			
			
			
			var my_calendar = $("#dncalendar-container").dnCalendar({
				minDate: "2016-01-15",
				maxDate: "2017-12-02",
				defaultDate: "{{date('Y-m-d')}}",
				monthNames: [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ], 
				monthNamesShort: [ 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Agu', 'Sep', 'Oct', 'Nov', 'Dec' ],
				dayNames: [ 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                dayNamesShort: [ 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat' ],
                dataTitles: { defaultDate: 'default', today : '{{Lang::get('cycle.ojrd8')}}' },
                notes:{!! Session::has('notes') ? Session::get('notes') : json_encode(array()) !!},
			    showNotes: true,
                startWeek: 'monday',
                dayClick: function(date, view) {
                	alert(date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear());
                }
			});

			// init calendar
			my_calendar.build();

			
			
			
			
			
		});
	</script>
	{{HTML::script('js/app.js')}}
	

	


</body>
</html>
