		<div class="col-xl-3 col-lg-4">
			<aside class="profile-side">
				<section class="box-typical">
					<header class="box-typical-header-sm bordered">{{trans("front/forum.left.box_cat_title")}}</header>
					<div class="box-typical-inner categories">
						@if(count($categories))
							@foreach($categories as $cat)
								<a href="{{url("forum/choiceCategorie/".$cat->id)}}" class="categories-link" style="color: #00F!important">
									<p class="line-with-icon">
										<i class="font-icon"></i>
										{{$cat->label}}
									</p>
								</a>
							@endforeach
						@endif

					</div>
				</section>
				<?php

					$all_response_count = \App\Models\Reponse::all()->count();
					$color = ['aquamarine','animated','danger','success','striped','info','warning',''];
					$counter=0;
				?>
				<section class="box-typical">
					<header class="box-typical-header-sm bordered">{{trans("front/forum.left.box_state_title")}}</header>
					<div class="box-typical-inner">
						@if(count($categories))
							@foreach($categories as $cat)
								<div class="progress-compact-style">
                                    <div class="progress-header">
                                        <div class="progress-lbl">{{$cat->label}}</div>
                                        <div class="progress-val">{{round(pourcentage_de_reaction($cat->id),2)}}%</div>
                                    </div>
                                    <progress class="progress progress-{{$color[$counter]}}" value="{{round(pourcentage_de_reaction($cat->id),0)}}" max="100">{{round(pourcentage_de_reaction($cat->id),5)}}</progress>
                                </div>
								<?php $counter++; ?>
							@endforeach
						@endif
					</div>
				</section>
			</aside>
		</div>