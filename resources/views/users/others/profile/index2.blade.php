@extends('front.template')

@section('css')
	<link href="{{asset('material/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{asset('material/plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{asset('material/plugins/animate-css/animate.css')}}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{asset('material/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('material/plugins/light-gallery/css/lightgallery.css')}}" rel="stylesheet">
    <link href="{{asset('material/css/themes/all-themes.css')}}" rel="stylesheet" />
@stop

@section('content')
	<div class="row clearfix">
        <div class="card">
            <div class="header">
                <h2>
                    PAGE PERSONNELLE
                </h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs tab-nav-right" role="tablist">
                            <li role="presentation" class="active"><a href="#home_animation_1" data-toggle="tab">ACCEUIL</a></li>
                            <li role="presentation"><a href="#profile_animation_1" data-toggle="tab">PROFILE</a></li>
                            <li role="presentation"><a href="#messages_animation_1" data-toggle="tab">INTERACTIONS</a></li>
                            <li role="presentation"><a href="#settings_animation_1" data-toggle="tab">PARAMATRES MENSUELS</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane animated flipInX active col-lg-10 col-md-offset-1 col-sm-offset-1 col-lg-offset-1 col-md-10 col-sm-10 col-xs-12" id="home_animation_1" >
                                <p>
                                    <div class="row" style="height: 300px!important">
	                                    <a href="{{asset('material/images/image-gallery/10.jpg')}}" data-sub-html="Demo Description" >
	                                        <img class="img-responsive thumbnail" src="{{asset('material/images/image-gallery/10.jpg')}}">
	                                    </a>
	                                </div>
                                </p>
                            </div>
                            <div role="tabpanel" class="tab-pane animated flipInX" id="profile_animation_1">
                                <p>
                                    Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                    Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent
                                    aliquid pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere
                                    gubergren sadipscing mel.
                                </p>
                            </div>
                            <div role="tabpanel" class="tab-pane animated flipInX" id="messages_animation_1">
                                <p>
			                        <div class="body">
			                            <div class="table-responsive">
			                                <table class="table table-hover dashboard-task-infos">
			                                    <thead>
			                                        <tr>
			                                            <th>#</th>
			                                            <th>Task</th>
			                                            <th>Status</th>
			                                            <th>Manager</th>
			                                            <th>Progress</th>
			                                        </tr>
			                                    </thead>
			                                    <tbody>
			                                        <tr>
			                                            <td>1</td>
			                                            <td>Task A</td>
			                                            <td><span class="label bg-green">Doing</span></td>
			                                            <td>John Doe</td>
			                                            <td>
			                                                <div class="progress">
			                                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%"></div>
			                                                </div>
			                                            </td>
			                                        </tr>
			                                        <tr>
			                                            <td>2</td>
			                                            <td>Task B</td>
			                                            <td><span class="label bg-blue">To Do</span></td>
			                                            <td>John Doe</td>
			                                            <td>
			                                                <div class="progress">
			                                                    <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"></div>
			                                                </div>
			                                            </td>
			                                        </tr>
			                                        <tr>
			                                            <td>3</td>
			                                            <td>Task C</td>
			                                            <td><span class="label bg-light-blue">On Hold</span></td>
			                                            <td>John Doe</td>
			                                            <td>
			                                                <div class="progress">
			                                                    <div class="progress-bar bg-light-blue" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%"></div>
			                                                </div>
			                                            </td>
			                                        </tr>
			                                        <tr>
			                                            <td>4</td>
			                                            <td>Task D</td>
			                                            <td><span class="label bg-orange">Wait Approvel</span></td>
			                                            <td>John Doe</td>
			                                            <td>
			                                                <div class="progress">
			                                                    <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%"></div>
			                                                </div>
			                                            </td>
			                                        </tr>
			                                        <tr>
			                                            <td>5</td>
			                                            <td>Task E</td>
			                                            <td>
			                                                <span class="label bg-red">Suspended</span>
			                                            </td>
			                                            <td>John Doe</td>
			                                            <td>
			                                                <div class="progress">
			                                                    <div class="progress-bar bg-red" role="progressbar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100" style="width: 87%"></div>
			                                                </div>
			                                            </td>
			                                        </tr>
			                                    </tbody>
			                                </table>
			                            </div>
			                        </div>
                                </p>
                            </div>
                            <div role="tabpanel" class="tab-pane animated flipInX" id="settings_animation_1">
                                <p>
			                        <div class="body">
			                            <div class="table-responsive">
			                                <table class="table table-hover dashboard-task-infos">
			                                    <thead>
			                                        <tr>
			                                            <th>#</th>
			                                            <th>Task</th>
			                                            <th>Status</th>
			                                            <th>Manager</th>
			                                            <th>Progress</th>
			                                        </tr>
			                                    </thead>
			                                    <tbody>
			                                        <tr>
			                                            <td>1</td>
			                                            <td>Task A</td>
			                                            <td><span class="label bg-green">Doing</span></td>
			                                            <td>John Doe</td>
			                                            <td>
			                                                <div class="progress">
			                                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%"></div>
			                                                </div>
			                                            </td>
			                                        </tr>
			                                        <tr>
			                                            <td>2</td>
			                                            <td>Task B</td>
			                                            <td><span class="label bg-blue">To Do</span></td>
			                                            <td>John Doe</td>
			                                            <td>
			                                                <div class="progress">
			                                                    <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"></div>
			                                                </div>
			                                            </td>
			                                        </tr>
			                                        <tr>
			                                            <td>3</td>
			                                            <td>Task C</td>
			                                            <td><span class="label bg-light-blue">On Hold</span></td>
			                                            <td>John Doe</td>
			                                            <td>
			                                                <div class="progress">
			                                                    <div class="progress-bar bg-light-blue" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%"></div>
			                                                </div>
			                                            </td>
			                                        </tr>
			                                        <tr>
			                                            <td>4</td>
			                                            <td>Task D</td>
			                                            <td><span class="label bg-orange">Wait Approvel</span></td>
			                                            <td>John Doe</td>
			                                            <td>
			                                                <div class="progress">
			                                                    <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%"></div>
			                                                </div>
			                                            </td>
			                                        </tr>
			                                        <tr>
			                                            <td>5</td>
			                                            <td>Task E</td>
			                                            <td>
			                                                <span class="label bg-red">Suspended</span>
			                                            </td>
			                                            <td>John Doe</td>
			                                            <td>
			                                                <div class="progress">
			                                                    <div class="progress-bar bg-red" role="progressbar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100" style="width: 87%"></div>
			                                                </div>
			                                            </td>
			                                        </tr>
			                                    </tbody>
			                                </table>
			                            </div>
			                        </div>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>

@stop

@section('scripts')

	{{HTML::script('material/plugins/jquery/jquery.min.js')}}
	{{HTML::script('material/plugins/bootstrap/js/bootstrap.js')}}
	{{HTML::script('material/plugins/bootstrap-select/js/bootstrap-select.js')}}
	{{HTML::script('material/jquery-slimscroll/jquery.slimscroll.js')}}
	{{HTML::script('material/plugins/jquery-slimscroll/jquery.slimscroll.js')}}
	{{HTML::script('material/plugins/node-waves/waves.js')}}
	{{HTML::script('material/plugins/light-gallery/js/lightgallery-all.js')}}
	{{HTML::script('material/js/pages/medias/image-gallery.js')}}
	{{HTML::script('material/js/admin.js')}}
	{{HTML::script('material/js/demo.js')}}

@stop