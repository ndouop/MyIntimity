<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>WELCOME - INTIMITY </title>
    <!--REQUIRED STYLE SHEETS-->
    <!-- BOOTSTRAP CORE STYLE CSS -->
    {{HTML::style('assets/css/bootstrap.css')}}
    <!-- FONTAWESOME STYLE CSS -->
    {{HTML::style('assets/css/font-awesome.min.css')}}
    <!--ANIMATED FONTAWESOME STYLE CSS -->
    {{HTML::style('assets/css/font-awesome-animation.css')}}
       <!-- CUSTOM STYLE CSS -->
    {{HTML::style('assets/css/style.css')}}
    {{HTML::style('assets/css/responsive.css')}}
    {{HTML::style('assets/css/rose.css')}}
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      {{HTML::script('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')}}
      {{HTML::script('https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js')}}
    <![endif]-->
</head>
<body onload="getMessage();">
       <!-- NAV SECTION -->
    <div class="navbar navbar-inverse navbar-fixed-top theme_background_color">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"INTIMITY</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class=""><a href="{{url('/')}}">Home</a></li>
                    <li><a href="#services-sec">Nos Services</a></li>
                     <li><a href="{{url('/cycle')}}">Calendrier Mensuel</a></li>
                     <li><a href="{{url('/forum')}}">Forum</a></li>
                     @if(auth()->guest())
                        <li><a href="{{url('/users/create')}}">Inscription</a></li>
                        <li><a href="{{url('/login')}}">Connexion</a></li>
                     @else
                        <li><a  style="color: #001" href="{{url('/profile')}}">{{auth()->user()->prenom}} {{auth()->user()->nom}}</a></li>
                     @endif
                </ul>
            </div>
           
        </div>
    </div>

    <section id="price-sec " style="margin-top: 80px">
        <div class="container">
            <div class="row">
                <h1>Selectionnez un mode de payement :</h1>
                  
                <div class="col-md-12 text-center ">
                  <div class="col-md-3">
                      <ul class="plan">
                          <li class="plan-head">Par PayPal</li>
                          <li>
                            <img src="{{asset('images/paypal.png')}}">
                          </li>
                          <a href="">
                            <li href="#" class="main-price">Continuer..</li>
                          </a>
                      </ul>
                  </div>
                  <div class="col-md-3">
                      <ul class="plan">
                          <li class="plan-head">Par PayDunya</li>
                          <li>
                            <img src="{{asset('images/paydunya.jpg')}}">
                            <img src="{{asset('images/logo_paydunya.png')}}">
                          </li>
                          <a href="" onclick="event.preventDefault();getBlockAmount('paydunya');">
                            <li href="#" class="main-price">Continuer..</li>
                          </a>
                      </ul>
                  </div>
                  <div class="col-md-3">
                      <ul class="plan">
                          <li class="plan-head">Par Mobile Monney</li>
                          <li>
                            <img src="{{asset('images/virement_bancaire_b.png')}}">
                          </li>
                          <a href="" onclick="event.preventDefault();getBlockAmount('momo');">
                            <li href="#" class="main-price">Continuer..</li>
                          </a>
                          <li id="block-amount-momo">
                            
                          </li>
                      </ul>
                  </div>
                  <div class="col-md-3">
                      <ul class="plan">
                          <li class="plan-head">Par virement Bancaire</li>
                          <li>
                            <img src="{{asset('images/virement_bancaire_b.png')}}">
                          </li>
                          <a href="" onclick="event.preventDefault();getBlockAmount('virement');">
                            <li href="#" class="main-price">Continuer..</li>
                          </a>
                          <li id="block-amount-virement">
                            
                          </li>
                      </ul>
                  </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Modal de payement --}}

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background:#0071B3">
            <h5 class="modal-title" id="exampleModalLabel">Mode de Donation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div> 
          <form id="form-donate" action="{{url('/paydunya/invoice_payement')}}" method="post">
            <input type="hidden" name="mode" id="mode">
            <div class="modal-body">
              <div class="form-group">
                <div class="input-group">
                  <label for="recipient-name" class="form-control-label">Montant</label>
                  <input type="text" class="form-control" name="montant" id="montant" value="1000" onkeyup="isNumeric();">
                  <div class="input-group-addon">
                    <span class="">FCFA</span>
                  </div>
                  <div class="form-tooltip-error"></div>
                </div>
              </div>
              <div class="form-group">
                <label for="message-text" class="form-control-label">Message/laissez nous une note</label>
                <textarea class="form-control" id="message" name="message" rows="5"></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
              <button type="submit" class="btn btn-primary theme_background_color ">Payer Maintenant</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    {{-- end/modal --}}

    <!-- SOCIAL STATS SECTION-->
    <section class="sub-footer">
      <div class="container">
        <div class="copyright-text col-md-6 col-sm-6 col-xs-12">
          <p>© 2017 ????. All rights reserved.</p>
        </div>
        <div class="designed-by col-md-6 col-sm-6 col-xs-12">
          <p>Designed by: <a href="#">Nivekalara dev'room</a></p>
        </div>
      </div>
    </section>

    <!-- END FOOTER SECTION -->

    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    {{HTML::script('assets/plugins/jquery-1.10.2.js')}}
    <!-- BOOTSTRAP CORE SCRIPT   -->
    {{HTML::script('assets/plugins/bootstrap.js')}}
  
    <!-- CUSTOM SCRIPTS -->
    {{HTML::script('assets/js/custom.js')}}

    <script type="text/javascript">
      var form = $("#form-donate");
      var minAmount = 1000;

      function getMessage() {
        $('#exampleModal').modal('toggle')
      }
      function getBlockAmount(moyen){
        
        $('#mode').val(moyen)
        $('#exampleModal').modal('toggle')
        $('#exampleModal').on('show.bs.modal', function () {
        
          var modal = $(this)

          modal.find('.modal-title').text('Vous avez choisi un payement par ' + moyen)
          $('#mode').val(moyen)
          
        })
      }

      form.submit(function(e){
        e.preventDefault();
        let montant = $(this).find('#montant').val();
        let message = $(this).find('#montant').val();

        $.ajaxSetup({
          headers:{
            "X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr('content')
          }
        })

        if (parseInt(montant)>=minAmount) {

          $.ajax({
            url:$(this).attr('action'),
            type:$(this).attr("method"),
            dataType:"json",
            data:$(this).serializeArray(),
          }).done(function(data){

              if (data.statut) {
                window.location.href=data.url_;
              }

              else{
                alert(data.message);
              }
            
          }).fail(function(data){
            alert(data.statutText);
          })

        }
        else{
            $(".form-tooltip-error").text('Desolé!! car nous n\'acceptons pas les montant inferieur a '+minAmount);
            $("input#montant").attr("style","border:1px solid red");
        }
      })


      function regexToCheckAmount(amount) {
        let regex = /^[0-9]*$/g;
        if (regex.test(amount)) {
          return true;
        }else{
          return false;
        }
      }

      function isNumeric() {
        let val = $('#montant').val();
        if (regexToCheckAmount(val)) {
          $('#montant').css({"border":"1px solid grey"});
          $(".form-tooltip-error").text('');
          return true;
        }else{
          $('#montant').css({"border":"1px solid red"});
          $(".form-tooltip-error").text('valeur invalide.').css("color","red");

        }
      }

    </script>

</body>
</html>

