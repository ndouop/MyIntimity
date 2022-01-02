@extends('discution.template')

@section('css')

    {{HTML::style('material/css/style.css')}}

    {{HTML::style('css/toastr.css')}}
    {{HTML::style('startUI/css/lib/fullcalendar/fullcalendar.min.css')}}
    <style type="text/css">
        .blue-link{
            color:#00a8ff;
            cursor: pointer;
        }
        .input-group-addon{
            
        }
        select{
            border-bottom: 2px solid #1f91f3 !important;
        }
    </style>

@stop
@section('content')

    <?php $user = auth()->user(); ?>

    <section class="content">
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-lg-4  col-md-4 col-sm-4 col-xs-12">

                    @include('users.others.profile._infoUser')


                </div><!--.col- -->
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="card">
                        <div class="header">
                        </div>
                        <div class="body">
                            {{Form::open(['id'=>'wizard_with_validation','files'=>true,'method'=>'post','url'=>'users'])}}
                                <h3>Account Information</h3>
                                <fieldset>
                                    <div class="form-group form-float form-group-sm">
                                        <div class="form-line ">
                                            <input type="text" class="form-control" name="login" value="{{old('login',$user->login)}}" required>
                                            <label class="form-label">Login*</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Langue</label>
                                        <select class="form-control select2" name="langue">
                                            <option value="en" {{($user->langue=="en") ? "selected" : ""}}>Anglais</option>
                                            <option value="fr"  {{($user->langue=="fr") ? "selected" : ""}}>Français</option>
                                        </select>
                                    </div>{{-- 
                                    <div class="form-group form-float form-group-sm">
                                        <div class="form-line">
                                            <input type="password" class="form-control" name="password" id="password" required  value="{{old('password',$user->password)}}">
                                            <label class="form-label">Mot de pass*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float form-group-sm">
                                        <div class="form-line">
                                            <input type="password" class="form-control" name="confirm" required>
                                            <label class="form-label">confirmation du mot de passe*</label>
                                        </div>
                                    </div> --}}

                                    <div class="form-group form-float form-group-sm">
                                        <div class="form-line">
                                            <input type="file" class="form-control" name="avatar" >
                                            <label class="form-label" value="{{old('avatar')}}"></label>
                                        </div>
                                    </div>
                                </fieldset>

                                <h3>Profile Information</h3>
                                <fieldset>
                                    <div class="col-sm-6">
                                        <div class=" container-fluid">
                                            <div class="form-group form-float form-group-sm">
                                                <div class="form-line">
                                                    <input type="text" name="nom" class="form-control" value="{{old('nom',$user->nom)}}">
                                                    <label class="form-label">Nom*</label>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="prenom" class="form-control"  value="{{old('prenom',$user->prenom)}}">
                                                    <label class="form-label">Prenom*</label>
                                                </div>
                                            </div>
                                            <!--div class="form-group form-float form-group-sm">
                                                <div class="form-line">
                                                    <input type="email" name="email" class="form-control" required value="{{old('email',$user->email)}}">
                                                    <label class="form-label">Email*</label>
                                                </div>
                                            </div-->
                                            <div class="form-group">
                                                <label class="form-label">Date de naissance*</label>
                                                <div class="form-line">
                                                    <input type="text" class="datepicker form-control"  placeholder="Svp choisissez la date..." name="date_naissance"  value="{{old('date_naissance',$user->date_naissance)}}">
                                                </div>
                                            </div>
                                            <div class="form-group form-float form-group-sm">
                                                <div class="form-line">
                                                    <select class="form-control" name="sexe"  value="{{old('sexe',ucfirst($user->sexe))}}">
                                                        <option value="feminin">Feminin</option>
                                                        <option value="masculin">Masculin</option>
                                                    </select>
                                                    <label class="form-label">Sexe*</label>
                                                </div>
                                            </div>
                                            <div class="form-group form-float form-group-sm">
                                                <div class="form-line">
                                                    <textarea name="addresse" cols="30" rows="3" class="form-control no-resize"  value="{{old('addresse',$user->addresse)}}"></textarea>
                                                    <label class="form-label">Addresse*</label>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="container-fluid">
                                            <div class="form-group form-float form-group-sm">
                                                <div class="form-line">
                                                    <input type="number" name="tel1" class="form-control"   value="{{old('tel1',$user->tel1)}}">
                                                    <label class="form-label">Téléphone 1 </label>
                                                </div>
                                            </div>
                                            <div class="form-group form-float form-group-sm">
                                                <div class="form-line">
                                                    <input type="number"  value="{{old('tel2',$user->tel2)}}" name="tel2" class="form-control" >
                                                    <label class="form-label">Téléphone 2 </label>
                                                </div>
                                            </div>
                                            <div class="form-group form-float form-group-sm">
                                                <div class="form-line">
                                                    <select class="form-control show-tick select2" value="{{old('pays')}}" name="pays" id="pays"
                                                            onchange="getRegion(this.value)">
                                                        @foreach($pays as $p)
                                                            <option value="{{$p->id}}" {{($p->id == $user->pay_id) ? 'selected' : ''}}>{{$p->nom}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label class="form-label">Pays</label>
                                                </div>
                                            </div>
                                            <div id="block-region" style="background: teal;"></div>
                                            <div id="block-ville" style="background: pink"></div>
                                            <div class="form-group form-float form-group-sm">
                                                <div class="form-line">
                                                    <textarea class="form-control " rows="5" name="addresse_detaille" placeholder="descrivez votre adresse ici..."  value="{{old('addresse_detaille',$user->addresse_detaille)}}"></textarea>
                                                </div>
                                            </div>
                                            <!--div class="form-group form-float form-group-sm">
                                                <div class="form-line">
                                                    <input type="text" name="couverture" class="form-control"  value="{{old('couverture',$user->couverture)}}">
                                                    <label class="form-label">couverture</label>
                                                </div>
                                            </div-->
                                            <!--div class="form-group form-float form-group-sm">
                                                <div class="form-line">
                                                    <input type="text" name="bp_user" class="form-control" value="{{old('bp_user',$user->bp_user)}}">
                                                    <label class="form-label">Boite postale</label>
                                                </div>
                                            </div-->

                                        </div>
                                    </div>

                                </fieldset>

                                <h3>Information sur le cycle</h3>

                                <fieldset>
                                    <div class="">
                                        <div class="container-fluid">
                                            <div class="form-group form-float form-group-sm">
                                                <div class="form-line">
                                                    <input type="text" name="ddr" class="form-control" value="{{old('ddr',$user->ddr)}}">
                                                    <label class="form-label"> DDR</label>
                                                </div>
                                            </div>
                                            <div class="form-group form-float form-group-sm">
                                                <div class="form-line">
                                                    <input type="number" name="duree_ecoulement" class="form-control" value="{{old('duree_ecoulement',$user->duree_ecoulement)}}">
                                                    <label class="form-label">durée d'oucoulement(en jour)</label>
                                                </div>
                                            </div>
                                            <div class="form-group form-float form-group-sm">
                                                <div class="form-line">
                                                    <input type="number" name="duree_cycle" class="form-control" value="{{old('duree_cycle',$user->duree_cycle)}}">
                                                    <label class="form-label">durée de cycle(en jour)</label>
                                                </div>
                                            </div>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" name="heure_notification" class="timepicker form-control" placeholder="Please choose a time..." value="{{old('heure_notification',$user->heure_notification)}}">
                                                        
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </fieldset>


                           {{Form::close()}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Advanced Form Example With Validation -->
        </div>
    </section>

@endsection

@section('scripts')
     {{HTML::script('material/plugins/jquery/jquery.min.js')}}
     {{HTML::script('material/plugins/bootstrap/js/bootstrap.js')}}


     {{HTML::script('material/plugins/jquery-slimscroll/jquery.slimscroll.js')}}
     {{HTML::script('material/plugins/jquery-validation/jquery.validate.js')}}
     {{HTML::script('material/plugins/jquery-steps/jquery.steps.js')}}
     {{HTML::script('material/plugins/sweetalert/sweetalert.min.js')}}

     {{HTML::script('material/plugins/node-waves/waves.js')}}
     {{HTML::script('material/plugins/autosize/autosize.js')}}
     {{HTML::script('material/plugins/momentjs/moment.js')}}
     {{HTML::script('material/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}
     {{HTML::script('material/js/pages/forms/form-wizard.js')}}
     {{HTML::script('material/js/pages/forms/basic-form-elements.js')}}
     {{HTML::script('material/js/admin.js')}}
     {{HTML::script('material/js/demo.js')}}
     {{HTML::script('js/monjs.js')}}


    <script type="text/javascript">
         var baseUrl='{{url("/")}}';




    </script>



@stop
