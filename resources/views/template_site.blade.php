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
		
		{{HTML::style("calendrier/css/lib/lobipanel/lobipanel.min.css") }}
		{{HTML::style('calendrier/css/lib/jqueryui/jquery-ui.min.css') }}
		{{HTML::style('css/lib/font-awesome/font-awesome.min.css') }}
		{{HTML::style('calendrier/simple_calender/css/dncalendar-skin.css') }}
		{{HTML::style('calendrier/css/normalize2.css') }}
		{{HTML::style('calendrier/css/demo.css') }}
		{{HTML::style('calendrier/css/component.css') }}
		{{HTML::style('calendrier/css/main.css') }}
		{{HTML::style('calendrier/css/style.css') }}



	</head>

  <body>

  
	<!-- start: Header -->
        
	<header class="site-header">
	    <div class="container-fluid">
	        <a href="#" class="site-logo">
	            <img class="hidden-md-down" src="{{ asset('calendrier/images/logo.png')}}" alt="">
	            <img class="hidden-lg-up" src="{{ asset('calendrier/images/logo.png')}}" alt="">
	        </a>
	
	        <button class="hamburger hamburger--htla">
	            <span>toggle menu</span>
	        </button>
	        <div class="site-header-content">
	            <div class="site-header-content-in">
	                <div class="site-header-shown">
	                    
	                    <div class="dropdown dropdown-lang margin-menu">
	                        <a class="" href="{{url('cycle')}}"><span class="font-icon glyphicon glyphicon-home"></span> Accueil </a>
	                    </div>
						<div class="dropdown dropdown-lang margin-menu">
	                        <a class="" href="{{url('contactTeam')}}"><span class="font-icon glyphicon glyphicon-send"></span> Contact </a>
	                    </div>
						<div class="dropdown dropdown-lang margin-menu">
	                        <a class="" href="{{url('soutenirTeam')}}"><i class="fa fa-money"></i> Soutenir </a>
	                    </div>
						
						
						
	                    <div class="dropdown user-menu">
	                        <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                          
								
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
	





	<script src="{{ asset('calendrier/js/lib/jquery/jquery.min.js')}}"></script>
	<script src="{{ asset('calendrier/js/lib/tether/tether.min.js')}}"></script>
	<script src="{{ asset('calendrier/js/lib/bootstrap/bootstrap.min.js')}}"></script>
	<script src="{{ asset('calendrier/js/plugins.js')}}"></script>

	<script src="{{ asset('http://maps.googleapis.com/maps/api/js?v=3&amp;sensor=false')}}"></script>
	<script src="{{ asset('calendrier/js/lib/google-maps/infobox.js')}}"></script>
	<script src="{{ asset('calendrier/js/lib/google-maps/google-maps-init.js')}}"></script>

	<script src="{{ asset('calendrier/js/lib/jqueryui/jquery-ui.min.js')}}"></script>
	<script src="{{ asset('calendrier/js/lib/lobipanel/lobipanel.min.js')}}"></script>
	<script src="{{ asset('calendrier/js/lib/jquery-tag-editor/jquery.caret.min.js')}}"></script>
	<script src="{{ asset('calendrier/js/lib/jquery-tag-editor/jquery.tag-editor.min.js')}}"></script>
	<script src="{{ asset('calendrier/js/lib/bootstrap-select/bootstrap-select.min.js')}}"></script>
	<script src="{{ asset('calendrier/js/lib/select2/select2.full.min.js')}}"></script>
	<script src="{{ asset('calendrier/js/lib/match-height/jquery.matchHeight.min.js')}}"></script>
    <script src="{{ asset('calendrier/js/fonction.js')}}"></script>
	{{HTML::script('https://www.gstatic.com/charts/loader.js')}}
	{{HTML::script('calendrier/js/loader.js')}}
	{{HTML::script('calendrier/simple_calender/js/dncalendar.js')}}
	{{HTML::script('calendrier/js/modernizr.custom.js')}}
	{{HTML::script('calendrier/js/classie.js')}}
	{{HTML::script('calendrier/js/tiltSlider.js')}}
	{{HTML::script('calendrier/js/app.js')}}
		
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
