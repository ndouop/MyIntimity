@extends('discution.template')

@section('css')
    <style>
        .box-typical .logo{
            width: 100%;

        }
        .box-typical .logo img{
            width: 80%;
            margin-left: 10%;
            margin-top: 25px;
            margin-bottom: 25px;
        }
        .img-resp{
            width: auto;
            max-height: 155px;
        }
        .img-resp:hover{
            cursor: pointer;
        }
        .info-paiement{
            color: #4198e4;
            font-size: 1.1em;
            font-weight: bold;
        }
        .center{
            text-align: center;
        }
        @media (max-width: 720px) {
            .hidden-sm {
                display: none;
            }
        }
    </style>
@stop

@section('title')
    {{trans('front/soutenir.title')}}
@stop


@section('content')
    <br><br><br>


    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4  col-md-4 col-sm-12 col-xs-12 hidden-sm">
                @if(auth()->check())
                    @include('users.others.profile._infoUser')

                @else
                    <section class="box-typical">
                        <div class="logo">
                            <img src="{{ asset('assetsLandin/img/logo_rose512.png')}}" class="" alt="">
                        </div>
                    </section><!--.box-typical-->
                @endif
                &nbsp;
            </div>

            <div class="col-md-8  col-md-8 col-sm-12 col-xs-12">
                <section class="box-typical">
                    <header class="box-typical-header-sm">{{trans('string.app_name')}} : <span>{{trans('string.slogan')}}</span></header>

                </section>
                <article class="box-typical profile-post">
                    <div class="profile-post-header">
                        <h4>{{trans('front/soutenir.why_p')}}</h4>
                    </div>
                    <div class="profile-post-content">
                        <p>
                            {{trans('front/soutenir.txt1')}}
                        </p>
                        <p>
                            <cite>
                                {{trans('front/soutenir.txt2')}}
                            </cite>
                        </p>
                        <span>
                            <a href="https://plan-international.fr/info/actualites/news/2016-09-23-causes-et-consequences-des-grossesses-precoces">
                                {{trans('front/soutenir.txt3')}}
                            </a>
                        </span>
                    </div>
                </article>
                <article class="box-typical profile-post">
                    <div class="profile-post-header">
                        <h4>{{trans('front/soutenir.y_particip')}}</h4>
                    </div>
                    <div class="profile-post-content">
                        <p>{!! trans('front/soutenir.txt5') !!}</p>
                    </div>
                </article>
                <article class="box-typical profile-post">
                    <div class="profile-post-header">
                        <h4>{{trans('front/soutenir.do_d')}}</h4>
                    </div>
                    <div class="profile-post-content">
                        <div class="row">
                            <div class="col-lg-4  col-md-4 col-sm-4 col-xs-12 center">
                                <img src="{{asset('images/paypal.png')}}" class="img-resp"  onclick="event.preventDefault();getBlockAmount('paydunya');">
                                <br><br>
                                <span class="info-paiement">vision-numeriq@gmail.com</span>
                            </div>
                            <div class="col-lg-4  col-md-4 col-sm-4 col-xs-12 center">
                                <img src="{{asset('images/MoMo.jpg')}}" class="img-resp"  onclick="event.preventDefault();getBlockAmount('paydunya');">
                                <br><br>
                                <span class="info-paiement">(+237) 677 79 39 62</span>
                            </div>
                            <div class="col-lg-4  col-md-4 col-sm-4 col-xs-12 center">
                                <img src="{{asset('images/orange-money.png')}}" class="img-resp"  onclick="event.preventDefault();getBlockAmount('paydunya');">
                                <br><br>
                                <span class="info-paiement">(+237) 969 14 82 50</span>
                            </div>
                        </div>
                    </div>
                </article>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background:#0071B3">
                                <h5 class="modal-title" id="exampleModalLabel">{{trans('front/soutenir.js_sou',['attr'=>\Config::get("app.name")])}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- form id="form-donate" action="{{url('/paydunya/invoice_payement')}}" method="post" -->
                            <form id="form-donate" action="{{url('/donate')}}" method="post">
                                <input type="hidden" name="mode" id="mode">
                                {!! csrf_field() !!}
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="montant" class="form-control-label">{{trans('front/soutenir.ammount')}}</label>
                                            <input type="number" class="form-control" name="montant" id="montant" min="1"
                                                   onkeyup="isNumeric();" required>
                                            <!-- div class="input-group-addon">
                                              <span class="">FCFA</span>
                                            </div -->
                                            <div class="form-tooltip-error"></div>
                                        </div>
                                    </div>
                                    <!-- div class="form-group">
                                      <label for="message-text" class="form-control-label">Message/laissez nous une note</label>
                                      <textarea class="form-control" id="message" name="message" rows="5"></textarea>
                                    </div -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('front/soutenir.cancel')}}</button>
                                    <button type="submit" class="btn btn-primary theme_background_color ">{{trans('front/soutenir.continuer')}}</button>
                                </div>
                                <!-- div id="paypal-button"></div -->
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="boutonpaypal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background:#0071B3">
                                <h5 class="modal-title" id="exampleModalLabel">{{trans('front/soutenir.txt6')}}<span id ="montantPapal"></span> &euro; </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id="paypal-button"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @endsection


@section('scripts')
    {{HTML::script('material/plugins/jquery/jquery.min.js')}}
    {{HTML::script('material/plugins/bootstrap/js/bootstrap.js')}}
    {{HTML::script('material/plugins/node-waves/waves.js')}}
    {{HTML::script('material/plugins/jquery-validation/jquery.validate.js')}}
    {{HTML::script('material/js/admin.js')}}
    {{HTML::script('material/js/pages/examples/sign-in.js')}}

            <!-- CORE JQUERY  -->
    {{HTML::script('assets/plugins/jquery-1.10.2.js')}}
            <!-- BOOTSTRAP CORE SCRIPT   -->
    {{HTML::script('assets/plugins/bootstrap.js')}}

            <!-- CUSTOM SCRIPTS -->
    {{HTML::script('assets/js/custom.js')}}

            <!-- paypal js -->
    {{HTML::script('https://www.paypalobjects.com/api/checkout.js')}}

    <script type="text/javascript">
        var form = $("#form-donate");
        //var minAmount = 1000;
        var minAmount = 1;

        function getBlockAmount(moyen) {

            $('#mode').val(moyen);
            $('#exampleModal').modal('toggle');
            $('#exampleModal').on('show.bs.modal', function () {

                var modal = $(this);

                modal.find('.modal-title').text('Je soutiens Intimity par ' + moyen);
                $('#mode').val(moyen)

            })
        }


        // appel de paypal
        function paypalPay(montant) {
            $('#montantPapal').text(montant);
            $('#exampleModal').modal('hide');
            $('#boutonpaypal').modal('toggle');
            paypal.Button.render({

                // env: 'production', // Or 'sandbox'
                env: 'sandbox', // Or 'sandbox'
                /*
                 style: {
                 label: 'buynow',
                 fundingicons: true, // optional
                 branding: true, // optional
                 size:  'small', // small | medium | large | responsive
                 shape: 'rect',   // pill | rect
                 color: 'gold'   // gold | blue | silve | black
                 }, */

                client: {
                    sandbox: 'ATawIRHT37bjr88tMeapnf0D0jtvDNnz61849N-gNEQ_G1s8m4htb53pgvjmr9V8BwKY2u7al-5_-nli',
                    production: 'Abg2xWiZgLLnqvTzfRjSUI6ISjPHXdRmtnM7aPtL01VM-BQ7uvbxeJkY-GC7Ng0zJfmFAoDatZHJh6g2'
                },

                commit: true, // Show a 'Pay Now' button

                payment: function (data, actions) {
                    return actions.payment.create({
                        payment: {
                            transactions: [
                                {
                                    //amount: { total: '1.00', currency: 'USD' }
                                    amount: {total: montant, currency: 'EUR'}
                                }
                            ]
                        }
                    });
                },

                onAuthorize: function (data, actions) {
                    return actions.payment.execute().then(function (payment) {

                        // The payment is complete!
                        // You can now show a confirmation message to the customer

                        // on save dans la bd
                        savePay(montant);
                        $('#boutonpaypal').modal('hide');

                        alert('Toute la communauté Intimity vous remercie pour votre geste');


                    });
                }

            }, '#paypal-button');

        }

        // fin paypal

        function savePay($montant) {
            /*
             $.ajaxSetup({
             headers: {
             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
             }
             }); */

            $.ajax({
                //url: "https://api.smart-univers.com/intimity/public/api/dons",
                url: "http://localhost/projets/mine/intimity_api/public/api/dons",
                type: "POST",
                dataType: "json",
                data: {'montant': $montant, 'mode': "PayPal", 'devise': 'EUR', 'user_id': '0'},
            }).done(function (data) {
                console.log(data);
                /*
                 if (data.json.data.statut) {
                 window.location.href = data.url_;
                 }

                 else {
                 alert(data.json.message);
                 } */

            }).fail(function (data) {
                console.log(data);
                //alert(data.statutText);
            })
        }


        form.submit(function (e) {
            e.preventDefault();
            var montant = $(this).find('#montant').val();
            var message = $(this).find('#montant').val();
            /*
             $.ajaxSetup({
             headers:{
             "X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr('content')
             }
             }) */

            if (parseInt(montant) >= minAmount) {
                paypalPay(montant);
                //$('#paypal-button').click();

            }
            else {
                $(".form-tooltip-error").text('Renseignez un montant superieur ou egal à ' + minAmount);
                $("input#montant").attr("style", "border:1px solid red");
            }
        })


        function regexToCheckAmount(amount) {
            let regex = /^[0-9]*$/g;
            if (regex.test(amount)) {
                return true;
            } else {
                return false;
            }
        }

        function isNumeric() {
            let val = $('#montant').val();
            if (regexToCheckAmount(val)) {
                $('#montant').css({"border": "1px solid grey"});
                $(".form-tooltip-error").text('');
                return true;
            } else {
                $('#montant').css({"border": "1px solid red"});
                $(".form-tooltip-error").text('valeur invalide.').css("color", "red");

            }
        }

    </script>


@stop



