@extends('discution.template')

@section("title")
	{{trans('string.app_name')}} - {{trans("front/forum.comment.title")}}
@stop

@section('css')
{{HTML::style('css/toastr.css')}}
{{HTML::style('startUI/css/lib/clockpicker/bootstrap-clockpicker.min.css')}}
<style type="text/css">
	article.box-typical{
		font-family: Verdana, "DejaVu Sans", "Bitstream Vera Sans", Geneva, sans-serif;
	}
</style>
@stop


@section('content')

<div class="profile-header-photo">
	<div class="profile-header-photo-in" style="background-image: url('{{url('images/groupe-de-jeunes.jpg')}}');">
		<div class="tbl-cell">
			<div class="info-block">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xl-9 col-xl-offset-3 col-lg-8 col-lg-offset-4 col-md-offset-0">
							<div class="tbl info-tbl">
								<div class="tbl-row">
									<div class="tbl-cell">
										<p class="title">{{trans("front/forum.entete.title")}}</p>
										@if(auth()->check())
											<p>{{trans("front/forum.entete.y_member")}}</p>
										@else
											<p>{{trans("front/forum.entete.y_conn")}} <a href="{{url("login")}}">{{trans("front/forum.entete.btn_conn")}}</a></p>
										@endif
									</div>
								</div>
							</div>
							<div class="col-md-12 align-right">
								@if(auth()->check())
									@if(auth()->user()->myLastSubject())
										<a href="{{url('/forum/discussion/sujet/'.auth()->user()->myLastSubject()->id)}}">
											<button type="button" class="btn btn-inline btn-info-outline Kbtn-react-user">{{trans("front/forum.entete.btn_last_p")}}</button>
										</a>
									@endif
									@if(auth()->user()->lastSubjectWhereIAmCommented())
										<a href="{{url('/forum/discussion/sujet/'.auth()->user()->lastSubjectWhereIAmCommented()->id)}}">
											<button type="button" class="btn btn-inline btn-info-outline Kbtn-react-user">{{trans("front/forum.entete.btn_last_r")}}</button>
										</a>
									@endif

									<a href="{{route('my-subjects')}}">
										<button type="button" class="btn btn-inline btn-info-outline Kbtn-react-user">{{trans("front/forum.entete.btn_mys")}}</button>
									</a>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">

	<div class="row">
		@include('discution.includes.left')

		<div class="col-xl-9 col-lg-8">
		@include('alert.block-alert')
			
			<section class="tabs-section">
				<div class="tabs-section-nav tabs-section-nav-left">
					<ul class="nav" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" href="#tabs-2-tab-1" role="tab" data-toggle="tab">
								<span class="nav-link-in">{{trans("front/forum.comment.s_recent")}}</span>
							</a>
						</li>
						<li class="nav-item" onclick="getBestComments()">
							<a class="nav-link" href="#tabs-2-tab-2" role="tab" data-toggle="tab">
								<span class="nav-link-in">{{trans("front/forum.comment.s_comment")}}</span>
							</a>
						</li>
						<li class="nav-item" onclick="getBestLikes()">
							<a class="nav-link" href="#tabs-2-tab-3" role="tab" data-toggle="tab" >
								<span class="nav-link-in">{{trans("front/forum.comment.s_like")}}</span>
							</a>
						</li>
					</ul>
				</div><!--.tabs-section-nav-->

				<div class="tab-content no-styled profile-tabs">
					<div role="tabpanel" class="tab-pane active" id="tabs-2-tab-1">
						<form class="box-typical">
							<input type="text" class="write-something" placeholder="{{trans("front/forum.comment.add_suj_ph")}}" onclick="getModal()">
							<div class="box-typical-footer new-subject">
								<div class="tbl">
									{{-- <div class="tbl-row"> --}}
										<div class="tbl-cell tbl-cell-action">
											<button type="submit" class="btn btn-rounded pull-right Kbtn-new-subject" onclick="event.preventDefault();getModal()">{{trans("front/forum.comment.add_suj_btn")}}</button>
										</div>
									{{-- </div> --}}
								</div>
							</div>
						</form><!--.box-typical-->
						@if(!is_null($sujet))
							<article class="box-typical profile-post" id="app" subject-data-id="{{$sujet->id}}">
								<?php
									$imgs = extract_img_to_string($sujet->description);
									$subject_without_img_tag = $sujet->description;
									if ($imgs) {
										$img_tag = $imgs['TAG_IMG'];
										$subject_without_img_tag = (count($img_tag)!=0)?delete_img_to_string($img_tag,$sujet->description):$sujet->description;
										//$myS_Cmtd = $user_connect->lastSubjectWhereIAmCommented();
									}
									
								?>
								<div class="profile-post-header">
									<div class="user-card-row">
										<div class="tbl-row">
											<div class="tbl-cell tbl-cell-photo">
												<a href="#">
												@if(!is_null($sujet->user->avatar) && !$sujet->anonyme)
													<img src="{{asset('startUI/img/'.$sujet->user->avatar)}}" alt="">
												@else
													<img src="{{asset('startUI/img/avatar-1-64.png')}}" alt="">
												@endif
												</a>
											</div>
											<div class="tbl-cell">
												<div class="user-card-row-name">
													<a href="#">{{ (!$sujet->anonyme) ? $sujet->user->login : "Anonyme" }}</a>
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													(<a  href="{{url('forum/choiceCategorie/'.$sujet->categorie->id)}}" class="blue-link " title="{{trans("front/forum.comment.txt1")}}">
														{{$sujet->categorie->label}}
													</a>)
													@if(auth()->check() && $sujet->user_id == auth()->user()->id)
													<a href="{{url('sujet/fermer/'.$sujet->id)}}" class="blue Kbtn-close-subject" data-toggle="modal" data-target=".bd-example-modal-sm" onclick="getModalCloseSubject()">{{trans("front/forum.comment.btn_close_s")}}</a>
													@endif
												</div>
												<div class="color-blue-grey-lighter align-right">
													<span title="posté {{getTimeHumansPoster($sujet->created_at)}}">
														<i class="fa fa-clock-o"></i> {{getTimeHumansPoster($sujet->created_at)}}
													</span>
												</div>
											</div>
										</div>
									</div>
									
								</div>
								<div class="profile-post-content">
									<p>{!! $subject_without_img_tag !!}</p>
									@if($imgs)
									<hr>
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
								</div>
								<div class="box-typical-footer profile-post-meta">
									<a href="#" class="meta-item" onclick="event.preventDefault();likeSubject({{$sujet->id}});">
										<i class="font-icon font-icon-heart"></i>
										<span id="__like{{$sujet->id}}">{{$sujet->nblike}}</span>
									</a>
									<a href="#" class="meta-item">
										<i class="font-icon font-icon-comment"></i>
										<span class="nbcomment_{{ $sujet->id }}">{{$sujet->nbcomment}}</span> {{trans("front/forum.comment.btn_comment")}}
									</a>
								</div>
								<input type="hidden" name="sujet_id" value="{{$sujet->id}}">
								<div class="comment-rows-container hover-action pre-scrollable">
									
									{{-- <comment  v-for="comment in comments" :comment="comment" :key="comment.id"></comment> --}}
									<comment-log :comments="comments" subject-data-id="{{$sujet->id}}"></comment-log>

								</div><!--.comment-rows-container-->
								{{-- @include('discution.includes.components.bt-footer') --}}
								<input type="hidden" name="sujet" class="subject-id" value="{{$sujet->id}}">
								<input type="hidden" name="subject_poster_id" class="subject_poster_id" value="{{$sujet->user->id}}">
								<input type="hidden" name="subject_poster_fuid" class="subject_poster_fuid" value="{{$sujet->user->fuid}}">
								<span subject-data-id="{{$sujet->id}}"></span>
								@if($sujet->actif)
									@if(auth()->check())
										<comment-composer v-on:commentsent="addComment"></comment-composer>
									@else
										<a href="{{url('forum/discussion/comment_guest/'.$sujet->id)}}" class="btn btn-primary pull-right btn-comment-guest">{{trans("front/forum.comment.btn_comment_offline")}}</a>
									@endif
								@else
									<div class="alert alert-danger alert-icon alert-close alert-dismissible fade in" role="alert">
										<i class="font-icon font-icon-warning"></i>
										{{trans("front/forum.comment.s_close")}}<i class="fa fa-smiledown"></i>!
									</div>
								@endif
							</article>
						@else
					        <div class="page-center-in" style="display: block!important;">
				                <div class="page-error-box" style="color: #ff005acc!important;padding: 10px 30px 15px!important;max-width: none;">
				                    <div class="error-code" style="font-size: 27px!important"><i class="fa fa-frown-o"></i></div>
				                    <div class="error-title" style="font-size: 25px!important">{{trans("front/forum.comment.s_notfound")}}</div>
				                    <a href="{{url('/forum')}}" class="btn btn-rounded">{{trans('front/exceptions.back_home')}}</a>
				                </div>
					        </div>
						@endif
					</div><!--.tab-pane-->
					<div role="tabpanel" class="tab-pane" id="tabs-2-tab-2">
						<section class="box-typical box-typical-padding">
							
						</section>
						<div id="loading"></div>
						<div id="best_comments"></div>
					</div><!--.tab-pane-->
					<div role="tabpanel" class="tab-pane" id="tabs-2-tab-3">
						<section class="box-typical box-typical-padding">
							
						</section>
						<div id="loading2"></div>
						<div id="best_likes"></div>
					</div><!--.tab-pane-->
					
				</div><!--.tab-content-->
			</section><!--.tabs-section-->

		</div>
	</div><!--.row-->
</div>

<div class="modal fade"
	 id="myModal"
	 tabindex="-1"
	 role="dialog"
	 aria-labelledby="myModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content" style="/*height: 640px!important*/">
			<div class="modal-header">
				<button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
					<i class="font-icon-close-2"></i>
				</button>
				<h4 class="modal-title" id="myModalLabel">{{trans("front/forum.comment.modal.title")}}</h4>
			</div>
			@include('discution.includes.components.modals.create-subject')
		</div>
	</div>
</div><!--.modal-->
@if(!is_null($sujet))
	<div class="modal fade" id="modalClose" 
		 tabindex="-1"
		 role="dialog"
		 aria-labelledby="mySmallModalLabel"
		 aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				{{ Form::open(['url'=>'sujet/fermer/'.$sujet->id,'method'=>"post"]) }}
				<div class="modal-header">
					<button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
						<i class="font-icon-close-2"></i>
					</button>
					<h4 class="modal-title" id="myModalLabel">{{trans("front/forum.comment.modal.close_s")}}</h4>
				</div>
				<div class="modal-body">
					{{trans("front/forum.comment.modal.txt1")}}
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-rounded btn-default Kbtn-square" data-dismiss="modal">{{trans("front/forum.comment.modal.close_s_btn_no")}}</button>
					<button type="submit" class="btn btn-rounded btn-primary Kbtn-square">{{trans("front/forum.comment.modal.close_s_btn_yes")}}</button>
				</div>
				{{ Form::close() }}
			</div>
		</div>
	</div><!--.modal-->
@endif
@stop

@section('scripts')
	<script>
   		var route_prefix = "{{ url(config('lfm.prefix')) }}";
  	</script>

  <!-- CKEditor init -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/ckeditor.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/adapters/jquery.js"></script>
  <script>
	    $('textarea[name=description]').ckeditor({
	      height: 100,
	      filebrowserImageBrowseUrl: route_prefix + '?type=Images',
	      filebrowserImageUploadUrl: route_prefix + '/upload?type=Images&_token={{csrf_token()}}',
	      filebrowserBrowseUrl: route_prefix + '?type=Files',
	      filebrowserUploadUrl: route_prefix + '/upload?type=Files&_token={{csrf_token()}}'
	    });
  
    {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/lfm.js')) !!}
  </script>
  <script>
    $('#lfm').filemanager('image', {prefix: route_prefix});
  </script>

  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>
  <script>
    $(document).ready(function() {
      $('#summernote').summernote();
    });
  </script>
  <script>
    $(document).ready(function(){

      // Define function to open filemanager window
      var lfm = function(options, cb) {
          var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
          window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
          window.SetUrl = cb;
      };

      // Define LFM summernote button
      var LFMButton = function(context) {
          var ui = $.summernote.ui;
          var button = ui.button({
              contents: '<i class="note-icon-picture"></i> ',
              tooltip: 'Insert image with filemanager',
              click: function() {

                  lfm({type: 'image', prefix: '/laravel-filemanager'}, function(url, path) {
                      context.invoke('insertImage', url);
                  });

              }
          });
          return button.render();
      };

      // Initialize summernote with LFM button in the popover button group
      // Please note that you can add this button to any other button group you'd like
      $('#summernote-editor').summernote({
          toolbar: [
              ['popovers', ['lfm']],
          ],
          buttons: {
              lfm: LFMButton
          }
      })
    });
  </script>

	{{HTML::script('js/app.js')}}
@stop
