





<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
					<i class="font-icon-close-2"></i>
				</button>
				<h4 class="modal-title" id="myModalLabel">Retrouvez des amies</h4>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
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
								                    <?php $pays_search = \App\Models\Pay::all(); ?>
													@if(count($pays_search) > 0)
								                    	<option value="0">-----------</option>
								                        @foreach($pays_search as $p)
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
												<input style="display: none" type="text" class="form-control ville" id="ville" placeholder="First Name" name="ville">
											</fieldset>
										</div>
										<button class="btn btn-sm btn-block" style="border: 0px!important;" type="submit">Rechercher</button>
									</form>
								</div>
							</div>				
						</div>
						<div class="col-sm-9">
							<div class="box-typical box-typical-full-height" id="list-empty">
								<div class="add-customers-screen tbl" id="error-search-msg">
									<div class="add-customers-screen-in">
										<div class="add-customers-screen-user">
											<i class="font-icon font-icon-user"></i>
										</div>
										<h2>Recherchez des personnes sur {!! Lang::get('string.app_name') !!}</h2>
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
										<a href="{{\URL::previous()}}" class="btn">Retour</a>
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
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
</div><!--.modal-->
</div><!--.modal-->

