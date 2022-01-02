@extends('discution.template')

@section('css')
<style type="text/css">
	.link-see-comments{
		text-decoration: none;
		list-style: none;
		font-size: 19px;
		text-decoration-style: none;
		font-style: bold;
	}

	.btn.btn-seemore {
	    background-color: rgba(0, 168, 255, 0.27);
	    border-color: rgba(0, 168, 255, 0.52);
	    border-radius: 0;
	}
	.btn.btn-seemore:hover{
		background: rgba(0, 168, 255, 0.8);;
	}
	.titre-page{
		font-size: 1.5em !important;
		color: #608aff;
	}

</style>
@stop

@section('content')
	<div class="page-content" id="up">
		<div class="container-fluid">
			<div class="row">


				<div class="col-lg-4  col-md-4 col-sm-4 col-xs-12">
					@include('users.others.profile._infoUser')


				</div><!--.col- -->


				<div class="col-lg-8  col-md-8 col-sm-8 col-xs-12">
					<section class="box-typical scroolable block-subjects">
						<header class="box-typical-header">
							<div class="tbl-row">
								<div class="tbl-cell tbl-cell-title">
									<h3 class="titre-page">{{trans("front/profile.my_s_title")}}</h3>
								</div>
							</div>
						</header>
						<div class="box-typical-body">
							@foreach($subjects as $subj)
								<?php
								$imgs = extract_img_to_string($subj->description);
								$subject_without_img_tag = $subj->description;
								if ($imgs) {
									$img_tag = $imgs['TAG_IMG'];
									$subject_without_img_tag = (count($img_tag)!=0)?delete_img_to_string($img_tag,$subj->description):$subj->description;
									$myS_Cmtd = auth()->user()->lastSubjectWhereIAmCommented();
								}
								?>
								<article class="comment-item">
									<div class="user-card-row">
										<div class="tbl-row">
											<div class="tbl-cell tbl-cell-photo">
												<a href="#">
													<img src="{{asset(is_null($subj->user->avatar)?"images/default/avatar-2-48.png":"images/avatars/thumbnails/thumb_".$subj->user->avatar)}}" alt="">
												</a>
											</div>
											<div class="tbl-cell">
												<span class="user-card-row-name"><a href="#">{{auth()->user()->login}}</a></span>
											</div>
											<div class="tbl-cell tbl-cell-date">
												<span class="semibold">
													<i class="fa fa-clock-o"></i> {{getTimeHumansPoster($subj->created_at)}}
												</span>
											</div>
										</div>
									</div>
									<div class="comment-item-txt">
										<p>{!! reduceText($subject_without_img_tag,1024,true,"forum/discussion/sujet/".$subj->id) !!} </p>
										@if($imgs)
											<hr>
											<div class="gallery-grid">
												@for($w = 0;$w < count($imgs['POP_IMG']); $w++)
													<div class="gallery-col">
														<article class="gallery-item" style="border: 1px grey solid">
															<img class="gallery-picture" src="{{$imgs['POP_IMG'][$w]}}" alt="" height="158">
															<div class="gallery-hover-layout">
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
													</div>
												@endfor
											</div>
										@endif
									</div>
									<div class="comment-item-meta">
										<a href="#" class="meta-item" onclick="event.preventDefault();likeSubject({{$subj->id}});">
											<i class="font-icon font-icon-heart"></i>
											<span id="__like{{$subj->id}}">{{$subj->nblike}}</span>
										</a>
										<a href="{{url("forum/discussion/sujet/".$subj->id)}}" class="meta-item" title="voir les commentaires">
											<i class="font-icon font-icon-comment"></i>
											<span class="nbcomment_{{ $subj->id }}">{{$subj->nbcomment}}</span>
										</a>

									</div>
								</article>
							@endforeach
							<div id="seemore-content"></div>
						</div>
					</section>
					<br>
					@if(count($subjects) >= 10)
						<button id="seemore-subject" class="btn btn-seemore btn-block" value="9" name="seemore_mySubjects" onclick="seemore_mySubjects();">See more</button>
					@endif
					<br>
					<br>
					<br>
				</div>


			</div><!--.row-->
		</div><!--.container-fluid-->

	</div><!--.page-content-->
@stop

@section('scripts')

@stop