


    {{HTML::script('startUI/js/plugins.js')}}
    {{HTML::script('startUI/js/lib/clockpicker/bootstrap-clockpicker.min.js')}}
    {{HTML::script('startUI/js/lib/daterangepicker/daterangepicker.js')}}
    {{HTML::script('js/prevision.js')}}

    <script type="text/javascript">

        $( document ).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.datetimepicker-1').datetimepicker({
                widgetPositioning: {
                    horizontal: 'right'
                },
                debug: false,
                format: "L",
            });

            initParam({{(isset($user) ? 'true' : 'false')}});
            initialeCall();

        });


    </script>


