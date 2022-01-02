			<section class="box-typical faq-page">
				<form class="horizontal-form" id="form-search-subject" action='{{url("sujet/search")}}' method="post">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-5 col-sm-5 col-lg-5">
								<label for="categorie">{{trans('front/forum.comment.modal.label.cat')}}</label>
						        <div class="form-group row">
						            <div class="col-sm-12  col-md-12 col-sm-12">
						                <select class="select2" name="categorie_id" id="categorie_id" value="{{old('categorie_id')}}">
						                    @if(count($categories))
						                        @foreach($categories as $cat)
						                            <option value="{{$cat->id}}">{{$cat->label}}</option>
						                        @endforeach
						                    @endif 
						                </select>
						            </div>
						        </div>
							</div>
							<div class="col-md-3 col-sm-3 col-lg-3">
                                <span class="help-block">{{trans('front/forum.comment.modal.label.date')}}</span>
                                <div class="form-group">
                                    <input class="form-control form-control-inline date-picker" size="116" type="text" value="" name="created_at"/>
                                </div>
                                <!-- /input-group -->
                            </div>
{{-- 							<div class="col-md-4 col-sm-4 col-lg-4">
								<label for="range_age">{{trans('front/forum.comment.modal.label.age')}}</label>
						        <div class="form-group row">
					                <div class="form-group col-sm-6">
					                    <input id="demo_vertical_s" jump="demo_vertical_s" type="text" value="10" name="age_debut" class="form-control" value="{{old('age_debut')}}">
					                </div>
					                <div class="form-group col-sm-6">
					                    <input id="demo_vertical_s" jump="demo_vertical_s" type="text" value="10" name="age_fin" value="{{old('age_fin')}}">
					                </div>
						        </div>
							</div> --}}
							<div class="col-md-1 col-sm-1 col-lg-1">
						        <div class="checkbox-bird">
						        	<label for="check-bird-9" style="margin-bottom: 12px">{{trans('front/forum.comment.modal.label.actif')}}</label>
									<input type="checkbox" name="actif" value="1" id="check-bird-9" checked/><label for="check-bird-9" ></label>
								</div>
							</div>
							<div class="col-md-2 col-sm-2 col-lg-2">
								<label>&nbsp;&nbsp;&nbsp;</label>
								<button class="btn btn-primary Kbtn-square" type="submit" class="btn-submit">
									{{trans('front/forum.comment.modal.label.btn_search')}}
								</button>
							</div>
						</div>
					</div>
				</form><!--.faq-page-header-search-->
				<section class="faq-page-questions">
					<div class="row" id="result">
						
					</div>
				</section><!--.faq-page-questions-->
			</section><!--.faq-page-->
			