@extends('discution.template')

@section("title")
	{{trans('string.app_name')}} - Forum
@stop
@section('css')
{{HTML::style('css/toastr.css')}}
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
									{{-- div class="tbl-cell tbl-cell-stat">
										<div class="inline-block">
											<p class="title">{{count(\App\Models\User::whereActif(true)->get())}}</p>
											<p>Membre(s)</p>
										</div>
									</div>
									<div class="tbl-cell tbl-cell-stat">
										<div class="inline-block">
											<p class="title">{{count(\App\Models\Sujet::whereActif(true)->limit(20)->get())}}</p>
											<p>Nouvelle(s) discussion(s)</p>
										</div>
									</div>
									<div class="tbl-cell tbl-cell-stat">
										<div class="inline-block">
											<p class="title">18</p>
											<p>Video(s)</p>
										</div>
									</div --}}
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
									<button type="button" onclick="window.location.replace('{{route("my-subjects")}}')" class="btn btn-inline btn-info-outline Kbtn-react-user">{{trans("front/forum.entete.btn_mys")}}</button>
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
										{{-- <div class="tbl-cell">
											<button type="button" class="btn-icon">
												<i class="font-icon font-icon-earth"></i>
											</button>
											<button type="button" class="btn-icon">
												<i class="font-icon font-icon-picture"></i>
											</button>
											<button type="button" class="btn-icon">
												<i class="font-icon font-icon-calend"></i>
											</button>
											<button type="button" class="btn-icon">
												<i class="font-icon font-icon-video-fill"></i>
											</button>
										</div> --}}
										<div class="tbl-cell tbl-cell-action">
											<button type="submit" class="btn btn-rounded pull-right Kbtn-new-subject" onclick="event.preventDefault();getModal()">{{trans("front/forum.comment.add_suj_btn")}}</button>
										</div>
									{{-- </div> --}}
								</div>
							</div>
						</form><!--.box-typical-->

						@if(count($sujets))
							@foreach($sujets as $sujet)

								<?php
									$imgs = extract_img_to_string($sujet->description);
									$subject_without_img_tag = $sujet->description;
									if ($imgs) {
										$img_tag = $imgs['TAG_IMG'];
										$subject_without_img_tag = (count($img_tag)!=0)?delete_img_to_string($img_tag,$sujet->description):$sujet->description;
										//$myS_Cmtd = auth()->user()->lastSubjectWhereIAmCommented();
									}
									
								?>
								<article class="box-typical profile-post" id="app" subject-data-id="1">
									<div class="profile-post-header">
										<div class="user-card-row">
											<div class="tbl-row">
												<div class="tbl-cell tbl-cell-photo">
													<a href="#">
														<img src="{{(asset(is_null($sujet->user->avatar) || $sujet->anonyme)?"images/default/avatar-2-48.png":"images/avatars/thumbnails/thumb_".$sujet->user->avatar)}}" alt="">
													</a>
												</div>
												<div class="tbl-cell">
													<div class="user-card-row-name"><a href="#">{{ (!$sujet->anonyme)?$sujet->user->login:"Anonyme" }}</a></div>
													<div class="color-blue-grey-lighter">{{getTimeHumansPoster($sujet->created_at)}} 
													</div>
												</div>
										</div>
										{{-- <a href="#" class="shared">
											<i class="font-icon font-icon-share"></i>
										</a> --}}
									</div>
									<div class="profile-post-content">
										<p>{!! reduceText($subject_without_img_tag,1024,true,"forum/discussion/sujet/".$sujet->id) !!} <span class="more_text"></span></p>
									@if($imgs)
										<hr>
										<div class="gallery-grid zoom-gallery">
											@for($w = 0;$w < count($imgs['POP_IMG']); $w++)
												{{-- <div class="gallery-col">
													<article class="gallery-item" style="border: 1px grey solid">
														<a href="{{$imgs['POP_IMG'][$w]}}" data-source="{{$imgs['POP_IMG'][$w]}}" title="">
															<img class="gallery-picture" src="{{$imgs['POP_IMG'][$w]}}" alt="" height="158">
														</a> --}}
														<a href="{{$imgs['POP_IMG'][$w]}}" data-source="{{$imgs['POP_IMG'][$w]}}" title="[image - {{$w}}]" style="width:185px;height:185px;">
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

										@if(auth()->check() && auth()->user()->IAlreadyLikedThisPost($sujet->id))
											<a href="#" class="meta-item icon-like-color" colr="{{$sujet->id}}">
												<i class="font-icon font-icon-heart"></i>
												<span id="__like{{$sujet->id}}">{{$sujet->nblike}}</span>
											</a>
										@else
											<a href="#" class="meta-item" onclick="event.preventDefault();likeSubject({{$sujet->id}});" colr="{{$sujet->id}}">
												<i class="font-icon font-icon-heart"></i>
												<span id="__like{{$sujet->id}}">{{$sujet->nblike}}</span>
											</a>
										@endif
										<a href="{{url('forum/discussion/sujet/'.$sujet->id)}}" class="meta-item">
											<i class="font-icon font-icon-comment"></i>
											{{$sujet->nbcomment}} {{trans("front/forum.comment.btn_comment")}}
										</a>
									</div>
								</article>
							@endforeach

							<nav>
{{-- 								<ul class="pagination ">
									<li class="page-item">
										<a class="page-link" href="#" aria-label="Previous">
											<span aria-hidden="true">&laquo;</span>
											<span class="sr-only">Previous</span>
										</a>
									</li> --}}
									@if ($sujets->lastPage() > 1)
									<ul class="pagination pagination-lg">
									    <li class="{{ ($sujets->currentPage() == 1) ? '__disabled' : 'page-item' }} ">
									        <a class="page-link sr-only" href="{{ $sujets->url(1) }}" aria-label="Previous">{{trans("front/forum.comment.prev")}}</a>
									    </li>
									    @for ($i = 1; $i <= $sujets->lastPage(); $i++)
									        <li class="{{ ($sujets->currentPage() == $i) ? ' active' : '' }} page-item">
									            <a class="page-link" href="{{ $sujets->url($i) }}">{{ $i }}</a>
									        </li>
									    @endfor
									    <li class="{{ ($sujets->currentPage() == $sujets->lastPage()) ? ' __disabled' : 'page-item' }} ">
									        <a class="page-link sr-only" href="{{ $sujets->url($sujets->currentPage()+1) }}" >{{trans("front/forum.comment.next")}}</a>
									    </li>
									</ul>
									@endif
									{{-- <li class="page-item">
										<a class="page-link" href="#" aria-label="Next">
											<span aria-hidden="true">&raquo;</span>
											<span class="sr-only">Next</span>
										</a>
									</li>
								</ul> --}}
							</nav>
							<div class="pagination">
								
							</div>
						@endif
					</div><!--.tab-pane-->
					<div role="tabpanel" class="tab-pane" id="tabs-2-tab-2">
						<section class="box-typical box-typical-padding">
							{{trans("front/forum.comment.s_comment")}}
						</section>
						<div id="loading"></div>
						<div id="best_comments"></div>
					</div><!--.tab-pane-->
					<div role="tabpanel" class="tab-pane" id="tabs-2-tab-3">
						<section class="box-typical box-typical-padding">
							{{trans("front/forum.comment.s_like")}}
						</section>
						<div id="best_likes"></div>
						<div id="loading2"></div>
					</div><!--.tab-pane-->
				</div><!--.tab-content-->
			</section>

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
		<div class="modal-content" style="/*height: 540px!important*/">
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
@stop

@section('scripts')

	{{HTML::script('js/toastr.js')}}
	{{HTML::script('startUI/js/lib/clockpicker/bootstrap-clockpicker.min.js')}}
	{{HTML::script('startUI/js/lib/clockpicker/bootstrap-clockpicker-init.js')}}
	{{HTML::script('startUI/js/lib/daterangepicker/daterangepicker.js')}}
	<script type="text/javascript">

		function getMoreTextHasBeenReduce($text){
			console.log(this.text());
		}

		$('#daterange3').daterangepicker({
			singleDatePicker: true,
			showDropdowns: true,
			alwaysShowCalendars:true,
			autoApply:true,
			endDate:'',
			locale:{format: 'YYYY-MM-DD'}
		});


	</script>
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
  </script>

  <script>
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
@stop
