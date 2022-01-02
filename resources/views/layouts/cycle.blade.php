


<div class="container-fluid cycle">

    @if(auth()->user() &&  Route::getCurrentRoute()->uri() != 'profile')
        <div class="col-lg-3  col-md-3 col-sm-3 col-xs-12">
            @include('users.others.profile._infoUser')
        </div>
        <div class="col-lg-9  col-md-9 col-sm-9 col-xs-12">
    @else
        <div class="row{{-- col-lg-12  col-md-12 col-sm-12 col-xs-12 --}}">
    @endif
            <section class="box-typical contacts-page" style="">
                <header class="box-typical-header box-typical-header-bordered" style="{{Route::getCurrentRoute()->uri() == 'profile'?'display: none':''}}">
                    <div class="tbl-row">
                        <div class="tbl-cell tbl-cell-title">
                            <div class="col-md-10">
                                <h3 class="titre-page">{{\Config::get("app.name")}} - {{trans('front/cycle.gest_c')}}</h3>
                            </div>
                        </div>
                        <div class="tbl-cell tbl-cell-actions">
                        </div>
                    </div>
                </header>
                <?php
                if(auth()->check())
                    $user = auth()->user();
                ?>
                <div class="tab-content">
                    <div role="tabpanel" class="clearfix tab-pane active" id="tab-contact-1">
                        <div class="">
                            <div class="col-lg-3  col-md-3 col-sm-3 col-xs-12" style="border-right: 2px solid #a7a4a42e;">
                                <section class="contacts-page-section">
                                      {{trans("front/cycle.box_title")}}
                                </section>
                                {{-- <div class="col-md-4"> --}}
                                <div class="form-group">
                                    <label for="estRegulier" style="font-weight: bold;">{{trans("front/cycle.type_c")}}</label>
                                    <select class="select2" name="estRegulier" id = "estRegulier" onchange="chargerParam()">
                                        <option value="1">{{trans("front/cycle.reg")}}  </option>
                                        <option value="0">{{trans("front/cycle.irreg")}} </option>
                                    </select>
                                </div>      
                                <div class="form-group">
                                    <label for="ddr" style="font-weight: bold;">{!! trans("front/cycle.ddr",["attr"=>"1<sup>er</sup>"])!!} </label>
                                    <div class="input-group date datetimepicker-1" >
                                        <input type="text" value="{{ (isset($user) && !is_null($user->ddr)) ?  date_format(date_create($user->ddr), 'Y-m-d') : date('Y-m-d')}}"  name ="ddr" id="ddr" class="form-control">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="div-dcycle">
                                    <label for="dcycle" style="font-weight: bold;">{{trans("front/cycle.dcycle")}}</label>
                                    <div class="input-group">
                                        <input type="number" value="{{ (isset($user) && !is_null($user->duree_cycle)) ? $user->duree_cycle : 28}}" name="dcycle" id="dcycle" placeholder="{{trans("front/cycle.dcycle")}}" class="form-control" >
                                        <span class="input-group-addon">
                                            {{trans("front/cycle.j")}}
                                        </span>
                                    </div>
                                </div>
                                <div id="r_i" style="display: none;" isHide="true">
                                    <div class="form-group">
                                        <label for="dmin" style="font-weight: bold;">{{trans("front/cycle.dmin")}}</label>
                                        <div class="input-group">
                                            <input type="number" value="{{ (isset($user) && !is_null($user->duree_min)) ? $user->duree_min : 20}}" name="dmin" id="dmin" placeholder="{{trans("front/cycle.dmin")}}" class="form-control" >
                                            <span class="input-group-addon">
                                                {{trans("front/cycle.j")}}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="dmax" style="font-weight: bold;">{{trans("front/cycle.dmax")}}</label>
                                        <div class="input-group">
                                            <input type="number" value="{{ (isset($user) && !is_null($user->duree_max)) ? $user->duree_max : 32}}" name="dmax" id="dmax" placeholder="{{trans("front/cycle.dmax")}}" class="form-control" >
                                            <span class="input-group-addon">
                                                {{trans("front/cycle.j")}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="dseign" style="font-weight: bold;">{{trans("front/cycle.aseign")}}</label>
                                    <div class="input-group">
                                        <input type="number" value="{{ (isset($user) && !is_null($user->duree_ecoulement)) ? $user->duree_ecoulement : 4}}" name="dseign" id="dseign"  placeholder="{{trans("front/cycle.aseign")}}" class="form-control" >
                                        <span class="input-group-addon">
                                            {{trans("front/cycle.j")}}
                                        </span>
                                    </div>
                                </div>
                                <input type="hidden" value="{{route("save-param-user")}}" name="path" id="path" >
                                <input type="hidden" value="{{(auth()->check() ? 1 : 0 )}}" name="user-conect" id="user-conect" >
                                <button type="button" class="btn btn-primary btn-block Kbtn-square" onclick="performPrediction()" style="margin-bottom: 25px;">
                                    {{trans("front/cycle.previ")}}
                                </button>
                                <span id="save-param-user-msg">  </span>
                            </div>
                            <div class="col-lg-9  col-md-9 col-sm-9 col-xs-12" style="padding: 0">
                                <div class="calendar">
                                    <header>
                                        <h2 id="le_mois" class="languagespecificHTML"> </h2>
                                        <a class="class-prev-mois" onclick="updatePrevTableau()">
                                            <i class="fa fa-angle-left arrow-dropleft"></i>
                                        </a>
                                        <a class="class-next-mois" onclick="updateNextTableau()">
                                            <i class="fa fa-angle-right arrow-dropright"></i>
                                        </a>
                                    </header>
                                    <table class="le_calendrier">
                                        <thead>
                                        <tr>
                                            <td class="languagespecificHTML" data-text="lun">Mon</td>
                                            <td class="languagespecificHTML" data-text="mar">Tue</td>
                                            <td class="languagespecificHTML" data-text="merc">Wed</td>
                                            <td class="languagespecificHTML" data-text="jeud">Thu</td>
                                            <td class="languagespecificHTML" data-text="vend">Fri</td>
                                            <td class="languagespecificHTML" data-text="sam">Sat</td>
                                            <td class="languagespecificHTML" data-text="dim">Sun</td>
                                        </tr>
                                        </thead>
                                        <tbody id="le_calendrier">
                                        </tbody>
                                    </table>
                                    <br><br>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <br/><br/>
                                <span class="prev-ecoul legende-color"> &nbsp; </span> <span class="legende-text" > {{trans("front/cycle.p_regle")}} </span>
                                <br/><br/>
                                <span class="prev-fille1 legende-color"> &nbsp; </span>
                                <span class="prev-fille2 legende-color"> &nbsp; </span>
                                <span class="prev-ovul legende-color event"> &nbsp; </span>
                                <span class="prev-gar legende-color"> &nbsp; </span>
                                <span class="legende-text" > {{trans("front/cycle.p_fecond")}} </span>
                                <br/><br/>
                                <span class="prev-fille1 legende-color"> &nbsp; </span> <span class="prev-fille2 legende-color"> &nbsp; </span><span class="legende-text" > {{trans("front/cycle.p_fav_f")}} </span>
                                <br/><br/>
                                <span class="prev-ovul legende-color event"> &nbsp; </span> <span class="legende-text" > {{trans("front/cycle.ov_fav_masc")}}  </span>
                                <br/><br/>
                                <span class="prev-gar legende-color"> &nbsp; </span> <span class="legende-text" > {{trans("front/cycle.p_fav_m")}}</span>
                                <br/><br/>
                                <span class="prev-fin-cycle legende-color "> &nbsp; </span> <span class="legende-text" > {{trans("front/cycle.fin_c")}} </span>
                                <br/><br/>
                            </div>
                        </div>
                    </div>
                </div><!--.tab-content-->
            </section><!--.box-typical-->
        </div><!--.container-fluid-->
    </div><!--.container-fluid-->

<!--.container-fluid-->

