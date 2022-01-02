@extends('discution.template')

@section('css')
{{HTML::style('css/toastr.css')}}
{{HTML::style('startUI/css/lib/fullcalendar/fullcalendar.min.css')}}

@include('layouts.cycleIncludeCSS')

<style type="text/css">
	.blue-link{
		color:#00a8ff;
		cursor: pointer;
	}

</style>
@stop

@section('title')
	{{(auth()->user()->prenom || auth()->user()->nom) ?
                       auth()->user()->prenom.' '.auth()->user()->nom :
                       auth()->user()->login}} | MyIntimity
@stop



@section('content')
	<?php

		$user = auth()->user();

	?>
	<div class="page-content" id="up">
		<div class="container-fluid">
			<div class="row">

				<div class="col-lg-3  col-md-3 col-sm-4 col-xs-12">
					@include('users.others.profile._infoUser')
				</div><!--.col- -->

				<div class="col-lg-9  col-md-9 col-sm-9 col-xs-12" style="padding: 0;">
					<section class="tabs-section">

					{{-- mon dernier sujet posté --}}
					<?php
						$myS = auth()->user()->myLastSubject();
						$myS_Cmtd = auth()->user()->lastSubjectWhereIAmCommented();
					?>
					
						<div class="tabs-section-nav">
							<div class="tbl">

								<ul class="nav" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" href="#tabs-2-tab-1" role="tab" data-toggle="tab">
											<span class="nav-link-in">
												<i class="fa fa-comment" aria-hidden="true"></i> {{trans("front/profile.s_last_p")}}
												@if($myS)
													<span class="label label-pill label-danger">{{count($myS->reponses)}}</span>
												@else
													<span class="label label-pill label-default">0</span>
												@endif
											</span>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#tabs-2-tab-2" role="tab" data-toggle="tab">
											<span class="nav-link-in">
												<i class="fa fa-pencil-square-o" aria-hidden="true"></i> {{trans("front/profile.s_last_r")}} 
												<span class="label label-pill label-success">{{($myS_Cmtd && count($myS_Cmtd)!=0) ? count($myS_Cmtd->reponses) : 0}}</span>
											</span>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#tabs-2-tab-3" role="tab" data-toggle="tab">
											<span class="nav-link-in">
												<i class="fa fa-bars" aria-hidden="true"></i> {{trans("front/profile.s_my_last_p")}}
												<span class="label label-pill label-info">{{auth()->user()->sujets->count()}}</span>
											</span>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#tabs-2-tab-4" role="tab" data-toggle="tab">
											<span class="nav-link-in">
												<i class="font-icon font-icon-calend"></i>{{trans("front/profile.previ")}}
												<span class="label label-pill label-primary"></span>
											</span>
										</a>
									</li>
								</ul>
							</div>
						</div><!--.tabs-section-nav-->

						<div class="tab-content">
							<div role="tabpanel" class="tab-pane fade in active" id="tabs-2-tab-1">
								<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
									<div class="panel-collapse-in">
										@if($myS)
										<div class="user-card-row">

										<?php
											$imgs = extract_img_to_string($myS->description);
											$subject_without_img_tag = $myS->description;
											if ($imgs) {
												$img_tag = $imgs['TAG_IMG'];
												$subject_without_img_tag = (count($img_tag)!=0)?delete_img_to_string($img_tag,$myS->description):$myS->description;
												//$myS_Cmtd = auth()->user()->lastSubjectWhereIAmCommented();
											}
											
										?>
											<div class="tbl-row">
												<div class="tbl-cell tbl-cell-photo">
													<a href="#">
														@if(!is_null(auth()->user()->avatar))
															<img src="{{asset('images/avatars/thumbnails/'.auth()->user()->avatar)}}" alt="avatar" class="avatar-thumb-forum-subject">
														@else
															<img src="{{asset('images/default/avatar-2-48.png')}}" alt="">
														@endif
													</a>
												</div>
												<div class="tbl-cell">
													<p class="user-card-row-name"><a href="#">{{auth()->user()->login}}</a></p>
													<p class="user-card-row-location"> {{getTimeHumansPoster($myS->created_at)}} </p>
												</div>
											</div>
										</div>
											<br>
										<p>{{-- {{auth()->user()->myLastSubject()->description}}... <a href="{{url('/forum/discussion/sujet/'.auth()->user()->myLastSubject()->id)}}">More</a> --}}
											{!! reduceText($subject_without_img_tag,1024,true,"forum/discussion/sujet/".$myS->id) !!}
										</p>
										<hr>
										@if($imgs)
										<div class="gallery-grid zoom-gallery">
											@for($w = 0;$w < count($imgs['POP_IMG']); $w++)
												{{-- <div class="gallery-col">
													<article class="gallery-item" style="border: 1px grey solid">
														<a href="{{$imgs['POP_IMG'][$w]}}" data-source="{{$imgs['POP_IMG'][$w]}}" title="">
															<img class="gallery-picture" src="{{$imgs['POP_IMG'][$w]}}" alt="" height="158">
														</a> --}}
														<a href="{{$imgs['POP_IMG'][$w]}}" data-source="{{$imgs['POP_IMG'][$w]}}" title="[image - {{$w+1}}]" style="width:185px;height:185px;">
															<img src="{{$imgs['POP_IMG'][$w]}}" width="185px" height="185">
														</a>
														{{-- <div class="gallery-hover-layout">
															<div class="gallery-hover-layout-in">
																<p class="gallery-item-title">seen</p>
																<div class="btn-group">
																	<button type="button" class="btn">
																		<i class="font-icon font-icon-eye"></i>
																	</button>
																</div>
															</div>
														</div> 
													</article>
												</div>--}}
											@endfor
										</div>
										@endif

										@else
											{!! trans('front/profile.txt1') !!}
										@endif
									</div>
								</div>
							</div><!--.tab-pane-->
							
							<div role="tabpanel" class="tab-pane fade" id="tabs-2-tab-2">
								<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
									<div class="panel-collapse-in">
										@if($myS_Cmtd)
										<div class="user-card-row">
											<div class="tbl-row">
												<div class="tbl-cell tbl-cell-photo">
													<a href="#">
														@if(!is_null(auth()->user()->avatar))
															<img src="{{asset('images/avatars/thumbnails/'.auth()->user()->avatar)}}" alt="avatar" class="avatar-thumb-forum-subject">
														@else
															<img src="{{asset('images/default/avatar-2-48.png')}}" alt="">
														@endif
													</a>
												</div>
												<div class="tbl-cell">
													<p class="user-card-row-name"><a href="#">{{auth()->user()->login}}</a></p>
													<p class="user-card-row-location"> {{getTimeHumansPoster($myS_Cmtd->created_at)}} </p>
												</div>
											</div>
										</div>
											<br>
										<p>{{-- {{auth()->user()->myLastSubject()->description}}... <a href="{{url('/forum/discussion/sujet/'.auth()->user()->myLastSubject()->id)}}">More</a> --}}
											{!! reduceText($myS_Cmtd->description,200,true,"forum/discussion/sujet/".$myS_Cmtd->id) !!}
										</p>
										@else
											{!! trans('front/profile.txt2') !!}
										@endif
									</div>
								</div>
							</div><!--.tab-pane-->
							<div role="tabpanel" class="tab-pane fade" id="tabs-2-tab-3">
								@if(auth()->user()->sujets->count())
									<section class="box-typical box-typical-max-280 scrollable">
										<div class="box-typical-body">
											<div class="table-responsive">
												<table class="table table-hover table-sm">
													<tbody>
														<?php $q=1;?>
														@foreach(auth()->user()->sujets as $sj)
														<tr>
															<td>{{$q}}</td>
															<td>{{$sj->categorie->label}}</td>
															<td class="color-blue-grey-lighter"><a href="{{url("forum/discussion/sujet/".$sj->id)}}">{!! reduceText($sj->description,128,true) !!}</a>
															</td>
															<td class="table-icon-cell">
																<i class="font-icon font-icon-heart"></i>
																{{$sj->nblike}}
															</td>
															<td class="table-icon-cell">
																<i class="font-icon font-icon-comment"></i>
																{{$sj->nbcomment}}
															</td>
															<td>{{getTimeHumansPoster($sj->created_at)}}</td>
														</tr>
														<?php $q++;?>
														@endforeach
													</tbody>
												</table>
											</div>
										</div><!--.box-typical-body-->
									</section>
								@else
									{!! trans('front/profile.txt3') !!}
								@endif
							</div><!--.tab-pane-->
							<div role="tabpanel" class="tab-pane fade" id="tabs-2-tab-4">
								@include('layouts.cycle')
							</div><!--.tab-pane-->
						</div><!--.tab-content-->
					</section>
					
					<section class="box-typical">
						<header class="box-typical-header-sm">
							{!! trans('front/profile.friend_sub') !!}
							<div class="slider-arrs">
								<button type="button" class="posts-slider-prev" value="Precedent">
									<i class="font-icon font-icon-arrow-left"></i>
								</button>
								<button type="button" class="posts-slider-next" value="Suivant">
									<i class="font-icon font-icon-arrow-right"></i>
								</button>
							</div>
						</header>
						<div class="posts-slider">
							@if(count($users_most_interesting))
								@foreach($users_most_interesting as $u)
									@if($u->pay_id == auth()->user()->pay_id && $u->id != auth()->user()->id)
										<div class="slide">
											<article class="follow-group">
												<div class="follow-group-logo">
													<a href="#" class="follow-group-logo-in"><img src="{{asset(is_null($u->avatar)?"images/default/avatar-2-48.png":"images/avatars/thumbnails/thumb_".$u->avatar)}}" alt=""></a>
												</div>
												<div class="follow-group-name">
													<a href="#">{{$u->login}}</a>
												</div>
												<div class="follow-group-link btn-follow-{{$u->id}}">
													<a href="#" onclick="event.preventDefault();demandeAmitie({{$u->id}})">
														<span class="plus-link-circle"><span>&plus;</span></span>
														{!! trans('front/profile.add') !!}
													</a>
												</div>
											</article>
										</div>
									@endif
								@endforeach
							@else

							@endif
						</div>
					</section><!--.box-typical-->
					<section class="box-typical">
						<header class="box-typical-header-sm">
							{!! trans('front/profile.s_10comments') !!}
							<div class="slider-arrs">
								<button type="button" class="recomendations-slider-prev">
									<i class="font-icon font-icon-arrow-left"></i>
								</button>
								<button type="button" class="recomendations-slider-next">
									<i class="font-icon font-icon-arrow-right"></i>
								</button>
							</div>
						</header>
						<div class="recomendations-slider">
							@if(count($subjects_most_commented))
								@foreach($subjects_most_commented as $subject)
									<div class="slide" >
										<div class="citate-speech-bubble">
											{!! reduceText($subject->description,150,true) !!}
										</div>
										<div class="user-card-row">
											<div class="tbl-row">
												<div class="tbl-cell">
													<p class="user-card-row-name ">

														<span class="comment_like_sujet" title="Participez à cette discution"><a href="{{url("/forum/discussion/sujet/".$subject->id)}}"><i class="fa fa-comment"></i> </a>{{$subject->nbcomment}}</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
														@if(Auth::User()->IAlreadyLikedThisPost($subject->id))
															<span class="comment_like_sujet deja_like" title="Vous aimez déjà ce sujet"><i class="fa fa-thumbs-up"></i> {{$subject->nblike}}</span>
														@else
															<span class="comment_like_sujet" title="Cliquez pour aimer ce sujet"><i class="fa fa-thumbs-up"></i> {{$subject->nblike}}</span>
														@endif
														<span class="date_sujet">{{getTimeHumansPoster($subject->created_at)}}</span>
													</p>
													<!--p class="user-card-row-status">
														<a href="#">{{$subject->categorie->label}}</a>
													</p-->
												</div>
											</div>
										</div>
									</div><!--.slide-->
								@endforeach
							@else

							@endif

						</div><!--.recomendations-slider-->
					</section><!--.box-typical-->
					<section class="box-typical">
						<header class="box-typical-header-sm">
							{!! trans('front/profile.s_10likes') !!}
							<div class="slider-arrs">
								<button type="button" class="recomendations-slider-prev_2">
									<i class="font-icon font-icon-arrow-left"></i>
								</button>
								<button type="button" class="recomendations-slider-next_2">
									<i class="font-icon font-icon-arrow-right"></i>
								</button>
							</div>
						</header>
						<div class="recomendations-slider_2">
							@if(count($subjects_most_liked))
								@foreach($subjects_most_liked as $subject)
									<div class="slide">
										<div class="citate-speech-bubble">
											{!! reduceText($subject->description,150,true) !!}
										</div>
										<div class="user-card-row">
											<div class="tbl-row">
												<div class="tbl-cell">
													<p class="user-card-row-name ">
														<span class="comment_like_sujet" title="{!! trans('front/profile.participer') !!}"><a href="{{url("/forum/discussion/sujet/".$subject->id)}}"><i class="fa fa-comment"></i> </a>{{$subject->nbcomment}}</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
														@if(Auth::User()->IAlreadyLikedThisPost($subject->id))
															<span class="comment_like_sujet deja_like" title="{!! trans('front/profile.already_like') !!}"><i class="fa fa-thumbs-up"></i> {{$subject->nblike}}</span>
														@else
															<span class="comment_like_sujet" title="{!! trans('front/profile.clic_like') !!}"><i class="fa fa-thumbs-up"></i> {{$subject->nblike}}</span>
														@endif
														<span class="date_sujet">{{getTimeHumansPoster($subject->created_at)}}</span>
													</p>
													<!--p class="user-card-row-name"><a href="#">{{getTimeHumansPoster($subject->created_at)}}</a></p>
													<p class="user-card-row-status"><a href="{{url("/forum/discussion/sujet/".$subject->id)}}">{{$subject->categorie->label}}</a> | <i class="fa fa-comment"></i> {{$subject->nbcomment}} | <i class="fa fa-thumbs-up"></i> {{$subject->nblike}} </p-->
												</div>
											</div>
										</div>
									</div><!--.slide-->
								@endforeach
							@else

							@endif

						</div><!--.recomendations-slider-->
					</section><!--.box-typical-->
				</div><!--.col- -->
			</div><!--.row-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->

	<input id="code" type="hidden" class="form-control" name="code" value="{{ !is_null(auth()->user()->pay_id) ? auth()->user()->pay->code : '' }}" >
	<input id="pays_nom" type="hidden" class="form-control" name="pays_nom" value="{{ !is_null(auth()->user()->pay_id) ? auth()->user()->pay->nom : '' }}" >
	<input id="region" type="hidden" class="form-control" name="region" value="{{ !is_null(auth()->user()->region_id) ? auth()->user()->region->nom : '' }}" >
	<input id="ville" type="hidden" class="form-control" name="ville" value="{{ !is_null(auth()->user()->ville_id) ? auth()->user()->ville->nom : '' }}" >

	<div id="toto">

	</div>

@endsection



@section('scripts')

	{{HTML::script('js/toastr.js')}}
	{{HTML::script('startUI/js/lib/clockpicker/bootstrap-clockpicker.min.js')}}
	{{HTML::script('startUI/js/lib/clockpicker/bootstrap-clockpicker-init.js')}}
	{{HTML::script('startUI/js/lib/daterangepicker/daterangepicker.js')}}
	{{HTML::script('startUI/js/lib/fullcalendar/fullcalendar.min.js')}}

	{{HTML::script('https://www.gstatic.com/firebasejs/3.9.0/firebase-app.js')}}
	{{HTML::script('https://www.gstatic.com/firebasejs/3.9.0/firebase-messaging.js')}}



	@include('layouts.cycleIncludeJS')


	<script type="text/javascript">
        //document.addEventListener("deviceready", chargerLangue(), false);
		$( document ).ready(function() {
			setDetectedLocation2(location, '{{route("set-localisation")}}', {{auth()->user()->id}});
		});


		/*
        var onSuccess = function(location){
			setDetectedLocation2(location, '{{route("set-localisation")}}', {{auth()->user()->id}});

        };

        var onError = function(error){

        };

        geoip2.city(onSuccess, onError);

        //window.sqlitePlugin.openDatabase()
		*/


	</script>

	{{-- {{HTML::script('startUI/js/lib/typeahead/jquery.typeahead.min.js')}} --}}
	<script type="text/javascript">


	$('#prevision').fullCalendar();
	var baseUrl="{{url('/')}}";

	function demandeAmitie(friend_id) {
			
		var params = {friend:friend_id};
		$.ajaxSetup({
			headers:{
				'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			url:baseUrl+'/friends',
			type:'POST',
			dataType:'json',
			data:params,
			error:function(data){
				toastr.error(data.statusText);
			},
			success:function(data){
				if(!data.status){
					toastr.error(data.motif);
				}else{
					$('.btn-follow-'+friend_id).empty();
					$('.btn-follow-'+friend_id).html('<div class="exp-timeline-range">Invitation Envoyée</div>');
					//toastr.success(data.message);
				}
			}
		});
	}

	firebase.initializeApp({
	    //'messagingSenderId': '279114179969'
	   apiKey: "AIzaSyBBS6Fe-1cwppGScoWQVM72TRnAjprmt2M",
	    authDomain: "intimity-183711.firebaseapp.com",
	    databaseURL: "https://intimity-183711.firebaseio.com",
	    projectId: "intimity-183711",
	    storageBucket: "intimity-183711.appspot.com",
	    messagingSenderId: "279114179969"
	});
	var messaging = window.firebase.messaging();

/*	if ('serviceWorker' in navigator) {
	  window.addEventListener('load', function() {
	    navigator.serviceWorker.register('/firebase-messaging-sw.js').then(function(registration) {
	      // Registration was successful
	      console.log('ServiceWorker registration successful with scope: ', registration.scope);
	    }, function(err) {
	      // registration failed :(
	      console.log('ServiceWorker registration failed: ', err);
	    });
	  });
	}*/







































/*    function getPermission() {
        window.messaging.requestPermission()
            .then(() => {
                console.log(messaging.getToken());
                return window.messaging.getToken();
            })
            .then(token => {
                console.log("getPermission  ==>  " + token);
                updateToken(token);
            })
            .catch((err) => {
                console.log('Unable to get permission to notify.', err);
            });
    }*/

    function updateToken(_token){
		$.ajaxSetup({
			headers:{
				'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			url:baseUrl+'/updateToken/'+_token,
			type:'POST',
			dataType:'json',
			error:function(data){
				notie.alert(3,data.statusText,5);
			},
			success:function(data){

				notie.alert(1,data.message,5);
				/*if(!data.status){
					notis.alert(1,data.motif,5);
				}else{
					notis.alert(1,data.motif,5);
				}*/
			}
		});
    }


    //getPermission();

	</script>
@stop