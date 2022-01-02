@extends('front.template')


@section('css')
    {{HTML::style('material/plugins/bootstrap/css/bootstrap.css')}}
    {{HTML::style('material/plugins/node-waves/waves.css')}}
    {{HTML::style('material/plugins/animate-css/animate.css')}}
    {{--HTML::style('material/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')--}}
    {{HTML::style('material/plugins/waitme/waitMe.css')}}
    {{HTML::style('material/plugins/bootstrap-select/css/bootstrap-select.css')}}
    {{HTML::style('material/css/style.css')}}
    {{HTML::style('material/css/themes/all-themes.css')}}
@stop
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-6 col-md-offset-3 col-sm-offset- col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Ajout d'une nouvelle categories
                            </h2>
                        </div>
                        <div class="body">
                            {!! Form::open(['route' => 'categories.store','id'=>'form']) !!}

                                @include('categories.fields')

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    {{HTML::script('material/plugins/jquery/jquery.min.js')}}
    {{HTML::script('material/plugins/bootstrap/js/bootstrap.js')}}

    {{HTML::script('material/plugins/jquery-slimscroll/jquery.slimscroll.js')}}
    {{--HTML::script('material/plugins/bootstrap-select/js/bootstrap-select.js')--}}
    {{HTML::script('material/plugins/node-waves/waves.js')}}
    {{HTML::script('material/plugins/autosize/autosize.js')}}
    {{--HTML::script('material/plugins/momentjs/moment.js')--}}
    {{--HTML::script('material/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')--}}

    {{HTML::script('material/js/admin.js')}}
    {{HTML::script('material/js/pages/forms/basic-form-elements.js')}}
    {{HTML::script('material/js/demo.js')}}

    <script type="text/javascript">
        $('#form').validate();
    </script>

@stop
