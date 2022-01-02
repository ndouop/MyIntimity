@extends('discution.template')

@section('css')
    {{HTML::style('css/toastr.css')}}
    {{HTML::style('startUI/css/lib/fullcalendar/fullcalendar.min.css')}}
    {{HTML::style('css/stepForm.css')}}

    @include('layouts.cycleIncludeCSS')

    <style type="text/css">
        .blue-link{
            color:#00a8ff;
            cursor: pointer;
        }

    </style>
@stop

@section('title')
    Modifier | {{(auth()->user()->prenom || auth()->user()->nom) ?
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

                <div class="col-lg-4  col-md-4 col-sm-4 col-xs-12">
                    @include('users.others.profile._infoUser')


                </div><!--.col- -->

                <div class="col-lg-8  col-md-8 col-sm-8 col-xs-12">

                    {{Form::open([
                        'id'=>'wizard_with_validation',
                        'files'=>true,
                        'method'=>'post',
                        'route'=>'update_profile_save'
                        ])}}

                    <section class="tabs-section step-form">

                        <div class="tabs-section-nav">
                            <div class="tbl">

                                <ul class="nav" role="tablist">
                                    <li class="nav-item">
                                        <span class="nav-link active" id="tabs-1-tab-0" href="#" role="tab" data-toggle="tab">
											<span class="nav-link-in">
												Account Information

											</span>
                                        </span>
                                    </li>
                                    <li class="nav-item">
                                        <span class="nav-link" id="tabs-1-tab-1" href="#" role="tab" data-toggle="tab">
											<span class="nav-link-in">
												Profile Information
                                            </span>
                                        </span>
                                    </li>
                                    <li class="nav-item">
                                        <span class="nav-link" id="tabs-1-tab-2" href="#" role="tab" data-toggle="tab">
											<span class="nav-link-in">
												Information sur le cycle
											</span>
                                        </span>
                                    </li>

                                </ul>
                            </div>
                        </div><!--.tabs-section-nav-->

                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="tabs-2-tab-0">
                                <fieldset>
                                    <div class="form-group form-float form-group-sm">
                                        <div class="form-line ">
                                            <label class="form-label">Login*</label>
                                            <input type="text" readonly class="form-control" name="login" value="{{old('login',$user->login)}}" >

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Langue</label>
                                        <select class="form-control select2" name="langue_id">
                                            @foreach($langues as $lang)
                                                <option value="{{$lang->id}}" {{($user->langue_id==$lang->id) ? "selected" : ""}}>{{$lang->nom}}</option>

                                            @endforeach
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
                                            <label class="form-label" value="{{old('avatar')}}"></label>
                                            <input type="file" class="form-control" name="avatar" >
                                        </div>
                                    </div>
                                </fieldset>
                            </div><!--.tab-pane-->

                            <div role="tabpanel" class="tab-pane fade" id="tabs-2-tab-1">
                                <fieldset>
                                    <div class="col-sm-6">
                                        <div class=" container-fluid">
                                            <div class="form-group form-float form-group-sm">
                                                <div class="form-line">
                                                    <label class="form-label">Nom</label>
                                                    <input type="text" name="nom" class="form-control" value="{{old('nom',$user->nom)}}">

                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <label class="form-label">Prenom</label>
                                                    <input type="text" name="prenom" class="form-control"  value="{{old('prenom',$user->prenom)}}">

                                                </div>
                                            </div>
                                            <!--div class="form-group form-float form-group-sm">
                                                <div class="form-line">
                                                    <input type="email" name="email" class="form-control" required value="{{old('email',$user->email)}}">
                                                    <label class="form-label">Email*</label>
                                                </div>
                                            </div-->
                                            <label class="form-label">Date de naissance</label>
                                            <div class="input-group date datetimepicker-1" >
                                                <input type="text" name ="date_naissance" id="date_naissance" placeholder="yyyy-mm-dd"
                                                       value="{{old('date_naissance',$user->date_naissance)}}"  class="datepicker form-control">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                </div>
                                            </div>

                                            <div class="form-group form-float form-group-sm">
                                                <div class="form-line">
                                                    <label class="form-label">Sexe</label>
                                                    <select class="form-control" name="sexe"  value="{{old('sexe',ucfirst($user->sexe))}}">
                                                        <option value="feminin">Feminin</option>
                                                        <option value="masculin">Masculin</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group form-float form-group-sm">
                                                <div class="form-line">
                                                    <label class="form-label">Addresse</label>
                                                    <textarea name="addresse_detaille" cols="30"  placeholder="descrivez votre adresse ici..."  rows="3" class="form-control no-resize" >{{old('addresse_detaille',$user->addresse_detaille)}}</textarea>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="container-fluid">
                                            <div class="form-group form-float form-group-sm">
                                                <div class="form-line">
                                                    <label class="form-label">Téléphone 1 </label>
                                                    <input type="number" name="tel1" class="form-control"   value="{{old('tel1',$user->tel1)}}">

                                                </div>
                                            </div>
                                            <div class="form-group form-float form-group-sm">
                                                <div class="form-line">
                                                    <label class="form-label">Téléphone 2 </label>
                                                    <input type="number"  value="{{old('tel2',$user->tel2)}}" name="tel2" class="form-control" >

                                                </div>
                                            </div>
                                            <div class="form-group form-float form-group-sm localisation">
                                                <div class="form-line">
                                                    <label class="form-label">Pays</label>
                                                    <select class="form-control show-tick select2" value="{{old('pays')}}" name="pay_id" id="pays"
                                                            onchange="getRegion(this.value)">
                                                        @foreach($pays as $p)
                                                            <option value="{{$p->id}}" {{($p->id == $user->pay_id) ? 'selected' : ''}}>{{$p->nom}}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                <br>
                                                <div id="block-region">
                                                    @if(!is_null($user->pay_id))
                                                        <div class="form-group">
                                                            <select class="form-control" name="region_id" id="region_id" onchange="getVille(this.value)">
                                                                @foreach($user->pay->regions as $r)
                                                                    <option value="{{$r->id}}" {{($r->id == $user->region_id) ? 'selected' : ''}}>{{$r->nom}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div id="block-ville">
                                                    @if(!is_null($user->region_id))
                                                        <div class="form-group">
                                                            <select class="form-control" name="ville_id" id="ville_id">
                                                                @foreach($user->region->villes as $v)
                                                                    <option value="{{$v->id}}" {{($v->id == $user->ville_id) ? 'selected' : ''}}>{{$v->nom}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @endif
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

                            </div><!--.tab-pane-->
                            <div role="tabpanel" class="tab-pane fade" id="tabs-2-tab-2">
                                <fieldset>
                                    <div class="">
                                        <div class="container-fluid">
                                            <div class="form-group form-float form-group-sm">
                                                <div class="form-line">
                                                    <label class="form-label"> premier jour des Dernières Règles</label>
                                                    <input type="text" name="ddr" class="form-control" value="{{old('ddr',$user->ddr)}}">

                                                </div>
                                            </div>
                                            <div class="form-group form-float form-group-sm">
                                                <div class="form-line">
                                                    <label class="form-label">durée d'écoulement(en jour)</label>
                                                    <input type="number" name="duree_ecoulement" class="form-control" value="{{old('duree_ecoulement',$user->duree_ecoulement)}}">

                                                </div>
                                            </div>
                                            <div class="form-group form-float form-group-sm">
                                                <div class="form-line">
                                                    <label class="form-label">durée de cycle(en jour)</label>
                                                    <input type="number" name="duree_cycle" class="form-control" value="{{old('duree_cycle',$user->duree_cycle)}}">

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label class="form-label">Heure de notification</label>
                                                    <input type="text" name="heure_notification" class="timepicker form-control" placeholder="Please choose a time..." value="{{old('heure_notification',$user->heure_notification)}}">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                            </div><!--.tab-pane-->

                        </div><!--.tab-content-->
                    </section>

                    <section class="card">
                        <div class="card-block">
                            <div class="row">
                                <div class="col-lg-12  col-md-12 col-sm-12 col-xs-12">
                                    <button type="button" class="btn btn-inline pull-right" id="next-form">Suivant</button>
                                    <button type="button" class="btn btn-inline pull-right" id="prev-form">Précédent</button>
                                </div>
                            </div>
                        </div>
                    </section><!--.box-typical-->


                    {{Form::close()}}

                </div><!--.col- -->
            </div><!--.row-->
        </div><!--.container-fluid-->
    </div><!--.page-content-->
@stop



@section('scripts')

    {{HTML::script('js/toastr.js')}}
    {{HTML::script('startUI/js/lib/clockpicker/bootstrap-clockpicker.min.js')}}
    {{HTML::script('startUI/js/lib/clockpicker/bootstrap-clockpicker-init.js')}}
    {{HTML::script('startUI/js/lib/daterangepicker/daterangepicker.js')}}
    {{HTML::script('startUI/js/lib/fullcalendar/fullcalendar.min.js')}}

    {{HTML::script('https://www.gstatic.com/firebasejs/3.9.0/firebase-app.js')}}
    {{HTML::script('https://www.gstatic.com/firebasejs/3.9.0/firebase-messaging.js')}}
    {{HTML::script('js/monjs.js')}}
    {{HTML::script('js/stepForm.js')}}



    @include('layouts.cycleIncludeJS')


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

        $('.datetimepicker-1').datetimepicker({
            widgetPositioning: {
                horizontal: 'right'
            },
            debug: false,
            format: "L",
        });


    </script>

@endsection