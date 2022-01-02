@extends('discution.template')

@section('css')
{{HTML::style('css/toastr.css')}}
@stop


@section('content')

	<div class="container-fluid">
		<center><h5 class="center">Retrouvez des amies</h5></center>
		<div class="row">
			<div class="col-sm-3">
				<div class="box-typical box-typical-full-height">
					<div class=" tbl">
						<form class="" action="user/search" method="post" id="form-search-user">
							<div class="container-fluid">
								<fieldset class="form-group">
									<label class="form-label semibold" for="nom">NOM</label>
									<input type="text" class="form-control" id="nom" placeholder="inserer le nom" name="nom">
								</fieldset>

								<fieldset class="form-group">
									<label class="form-label semibold blue-link" for="prenom" state="hide"><i class="fa fa-plus"></i> PRENOM</label>
									<input style="display: none" type="text" class="form-control prenom" id="prenom" placeholder="inserer le prenom" name="prenom">
								</fieldset>

								<fieldset class="form-group">
									<label class="form-label semibold blue-link" for="pays"><i class="fa fa-plus"></i> PAYS</label>
					                <select style="display: none" class="form-control pays" name="pays" id="categorie_id">
					                    @if(count($pays))
					                    	<option value="0"></option>
					                        @foreach($pays as $p)
					                            <option value="{{$p->id}}">{{$p->nom}}</option>
					                        @endforeach
					                    @endif 
					                </select>
								</fieldset>

								<fieldset class="form-group">
									<label class="form-label semibold blue-link" for="region"><i class="fa fa-plus"></i> REGION</label>
									<input style="display: none" type="text" class="form-control region" id="region" placeholder="region" name="region">
								</fieldset>

								<fieldset class="form-group">
									<label class="form-label semibold blue-link" for="ville"><i class="fa fa-plus"></i> VILLE</label>
									<input style="display: none" type="text" class="form-control ville" id="ville" placeholder="ville" name="ville">
								</fieldset>
							</div>
							<button class="btn btn-sm btn-block Kbtn-square" style="border: 0px!important;" type="submit">Rechercher</button>
						</form>
					</div>
				</div>				
			</div>
			<div class="col-sm-9">
				<div class="box-typical box-typical-full-height" id="list-empty">
					<div class="add-customers-screen tbl">
						<div class="add-customers-screen-in">
							<div class="add-customers-screen-user">
								<i class="font-icon font-icon-user"></i>
							</div>
							<h2>Recherchez des personnes sur {{trans('string.app_name')}}</h2>
							<p class="lead color-blue-grey-lighter">
								Cette option vous permet de : 
								<ul>
									<li> * Retrouver les personnes ayant un compte sur cette plateforme </li>
									<li> * Apres avoir clique sur rechercher:
										<ul>
											<li>** Envoyer une demande a un amie</li>
											<li>** chater avec votre amie de choix.</li>
										</ul>
									</li>
								</ul>
							</p>
							<a href="{{\URL::previous()}}" class="btn Kbtn-square">Retour</a>
						</div>
					</div>
				</div><!--.box-typical-->	
				<div class="result-list-users box-typical box-typical-full-height" style="display: none">
					<div class="box-typical-body">
						<div class="table-responsive">
							<table class="table table-hover">
								<tbody id="list-users">
									
								</tbody>
							</table>
						</div>
					</div><!--.box-typical-body-->
				</div>
							
			</div>
		</div>
	</div><!--.container-fluid-->

@stop

@section('scripts')
	{{HTML::script('js/toastr.js')}}
	{{HTML::script('startUI/js/lib/clockpicker/bootstrap-clockpicker.min.js')}}
	{{HTML::script('startUI/js/lib/clockpicker/bootstrap-clockpicker-init.js')}}
	{{HTML::script('startUI/js/lib/daterangepicker/daterangepicker.js')}}
	<script type="text/javascript">
		toastr.options = {
		  "closeButton": true,
		  "debug": true,
		  "newestOnTop": true,
		  "progressBar": true,
		  "positionClass": "toast-top-full-width",
		  "preventDuplicates": false,
		  "showDuration": "20000",
		  "hideDuration": "2002",
		  "timeOut": "4000",
		  "extendedTimeOut": "20000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"
		};

	</script>
	{{-- {{HTML::script('startUI/js/lib/typeahead/jquery.typeahead.min.js')}} --}}
	<script type="text/javascript">

		
/*		var users=[];
		$.get(baseUrl+'/user/typeahead',function(data){
			console.log(data)
			$.each(data,function(index,value){
				;
				users.push(value.nom+' '+value.prenom);
			});
		});*/		

	</script>
@stop