<style>
	.labar{
		position: fixed;
		z-index: 9999;
		width: 100%;
		background-color: white;
	}
	.nav-bar-margin-right{
		margin-right: 50px;
	}
	.circle-img{
		width: 70px;
		/*height: 70px;*/
	}
	.circle-img img{
		width: 30px;
		height: 30px;
		padding: 3px;
		border-radius: 15px;
		border: 1px solid #b8a6bd;
		margin-top: -5px;
	}
	.img-logo{
		margin-top: -10px;
	}
	.navbar-margin-top{
		margin-top: -10px;
	}

	li.simple-nav{
		border: 1px solid #ffffff;
		padding: 3px 15px;
		-webkit-border-radius: 4px;
		-moz-border-radius: 4px;
		border-radius: 4px;
		font-size: 15px
	}
	li.simple-nav:hover{
		border: 1px solid #E8E8E8;
	}
	.dropdown-menu-notif, .dropdown-menu-messages{
		width: 300px;
		height: 250px;
	}
	.dropdown-menu-notif .dropdown-menu-notif-header, .dropdown-menu-messages .dropdown-menu-notif-header{
		height: 30px;
		border-bottom: 1px solid #e9e9e9;
		padding-left: 10px;
		padding-right: 10px;
		font-size: 1.2em;
	}
	.dropdown-menu-notif .dropdown-menu-notif-list, .dropdown-menu-messages .dropdown-menu-notif-list{
		height: 180px;
		padding-left: 10px;
		overflow-x: hidden;
		width: 100%;
		overflow-y: scroll;

		padding-right: 17px; /* Increase/decrease this value for cross-browser compatibility */

	}
	.dropdown-menu-notif .dropdown-menu-notif-more, .dropdown-menu-messages .dropdown-menu-notif-more{
		border-top: 1px solid #e9e9e9;
		font-size: 1.1em;
		padding-left: 10px;
		padding-top: 3px;
	}
</style>

<?php $notifications = (isset($notifications) ? $notifications : null); ?>
<?php $inboxes = (isset($inboxes) ? $inboxes : null); ?>

<nav class="navbar navbar-toggleable-md navbar-light bg-faded labar Kbtn-square" >
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse navbar-margin-top" id="navbarTogglerDemo01">
		<div class="row">
			<div class="col-md-2">
				<a href="{{url('/')}}" class="site-logo">
					<img class="hidden-md-down img-logo" src="{{asset('images/logo_hdpi.png')}}" alt="">
					<img class="hidden-lg-up img-logo" src="{{asset('images/logo_mdpi.png')}}" alt="">
				</a>
			</div>
			<div class="col-md-3">
				@if(auth()->check())
					<div class="form-group">
						<div class="form-control-wrapper form-control-icon-left">
							<input type="text" id="navbar-search-friend Kbtn-square" class="form-control" placeholder="{{trans("front/navbar.search_friend_field")}}" />
							<i class="font-icon font-icon-search color-green"></i>
						</div>
					</div>
				@endif
			</div>
			<div class="col-md-7">
				<ul class="navbar-nav mr-auto mt-2 mt-lg-0 pull-right">
					<li class="nav-item simple-nav">
						<a class="nav-link text-primary" href="{{route('soutenirTeam')}}">
							{{ trans("front/navbar.support_projet") }}
						</a>
					</li>
					<li class="nav-item simple-nav">
						<a class="nav-link text-danger" style="color: #FD1254;font-weight: bold;" title="{{trans("front/navbar.cycle_opt_title")}}" href="{{url('cycle')}}">
							{{ trans("front/navbar.cycle_opt") }}
						</a>
					</li>
					@if(auth()->check())
						<li class="nav-item dropdown simple-nav">
							<a class="nav-link dropdown-toggle text-primary Kbtn-square" href="{{url('forum')}}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								{{ trans("front/navbar.forum") }}
							</a>
							<div class="dropdown-menu dropdown-menu-right " aria-labelledby="navbarDropdown">
								<a class="dropdown-item text-primary" href="{{url('forum')}}">{{ trans("front/navbar.forum") }}</a>
								@if(auth()->user()->myLastSubject())
									<a class="dropdown-item text-primary" href="{{url('/forum/discussion/sujet/'.auth()->user()->myLastSubject()->id)}}">
										{{ trans("front/navbar.my_last_subject") }}
									</a>
								@else
									<a class="dropdown-item text-primary" href="{{url('forum')}}">
										{{ trans("front/navbar.my_last_subject") }}
									</a>
								@endif
								@if(auth()->user()->lastSubjectWhereIAmCommented())
									<a class="dropdown-item text-primary" href="{{url('/forum/discussion/sujet/'.auth()->user()->lastSubjectWhereIAmCommented()->id)}}">
										{{ trans("front/navbar.my_last_react") }}
									</a>
								@else
									<a class="dropdown-item text-primary" href="{{url('forum')}}">
										{{ trans("front/navbar.my_subject") }}
									</a>
								@endif
								<a class="dropdown-item text-primary" href="{{route('my-subjects')}}">{{ trans("front/navbar.my_subject") }}</a>
							</div>
						</li>

						<li class="nav-item dropdown simple-nav">
							<a href="#"
							   class="header-alarm nav-link dropdown-toggle {{(count($notifications)!=0)?" active":""}}"
							   id="dd-notification"
							   role="button"
							   data-toggle="dropdown"
							   aria-haspopup="true"
							   aria-expanded="false">
								<i class="font-icon-alarm"></i>
							</a>

							<div class="dropdown-menu dropdown-menu-right dropdown-menu-notif" aria-labelledby="dd-notification">
								<div class="dropdown-menu-notif-header">
									{{trans("front/navbar.notification")}}
									<span class="label label-pill label-danger" id="nbNotif">{{count($notifications)}}</span>
								</div>
								<div class="dropdown-menu-notif-list">
									@include('discution.includes.components.navbar.notification',['notis'=>$notifications])
								</div>
								<div class="dropdown-menu-notif-more">
									<a href="#seeMoreNotification">{{trans("front/navbar.see_more")}}</a>
								</div>
							</div>
						</li>


						<li class="nav-item dropdown simple-nav">
							<a href="#"
							   class="header-alarm nav-link dropdown-toggle {{(count($inboxes)!=0)?" active":""}}"
							   id="dd-messages"
							   data-toggle="dropdown"
							   aria-haspopup="true"
							   role="button"
							   aria-expanded="false">
								<i class="font-icon-mail"></i>
							</a>

							<div class="dropdown-menu dropdown-menu-right dropdown-menu-messages" aria-labelledby="dd-messages">
								<div class="dropdown-menu-notif-header">
									<span class="pull-left">
										{{trans('front/navbar.notif_non_vue')}}
										<span class="label label-pill label-danger">{{(!is_null($inboxes) ? count($inboxes->where("seen",false)) : 0 )}}</span>
									</span>
									<span class="pull-right">
										{{trans('front/navbar.notif_vue')}}
										<span class="label label-pill label-danger">{{(!is_null($inboxes) ? count($inboxes->where("seen",true)) : 0 )}}</span>
									</span>
								</div>

								<div class="dropdown-menu-notif-list">
									@include("discution.includes.components.navbar.inbox",['inboxes'=>$inboxes])
								</div>
								<div class="dropdown-menu-notif-more">
									<a href="#">{{trans("front/navbar.see_more")}}</a>
								</div>
							</div>
						</li>

						<li class="nav-item dropdown user-menu nav-bar-margin-right circle-img">
							<a class="nav-link dropdown-toggle text-primary" href="#" id="userProfile" role="button"
							   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<img src="{{is_null(auth()->user()->avatar)?asset("images/default/avatar-2-32.png"):asset('images/avatars/thumbnails/thumb_'.auth()->user()->avatar)}}" alt="">

							</a>
							<div class="dropdown-menu dropdown-menu-right " aria-labelledby="userProfile">
								<a class="dropdown-item text-primary" href="{{url('profile')}}">
									<span class="font-icon glyphicon glyphicon-user"></span>
									{{ trans("front/navbar.profile") }}
								</a>
								<a class="dropdown-item text-primary" href="{{url('profile/update')}}">
									<span class="font-icon glyphicon glyphicon-cog"></span>
									{{ trans("front/navbar.settings") }}
								</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item text-primary" href="{{ route('logout') }}"
								   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
									<span class="font-icon glyphicon glyphicon-log-out"></span>
									{{ trans("front/navbar.logout") }}
								</a>
							</div>
							<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						</li>
					@else
						<li class="nav-item simple-nav  Kbtn-square">
							<a class="nav-link text-primary " href="{{route('forum')}}">
								{{ trans("front/navbar.forum") }}
							</a>
						</li>

						<li class="nav-item ">
							<a class="nav-link btn btn-inline Kbtn-square" style="color: white" href="{{route('register')}}">
								{{ trans("front/navbar.signin") }}
							</a>
						</li>
						<li class="nav-item ">
							<a class="nav-link btn btn-inline Kbtn-square" style="color: white" href="{{route('login')}}">
								{{ trans("front/navbar.login") }}
							</a>
						</li>
					@endif
				</ul>
			</div>
		</div>

	</div>
</nav>



