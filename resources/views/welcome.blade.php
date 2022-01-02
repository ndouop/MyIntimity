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

    <script src="{{asset('assets/plugins/sweetalert-master/dist/sweetalert-dev.js')}}"></script>
    {{HTML::style('assets/plugins/sweetalert-master/dist/sweetalert.css')}}
</head>
<body onload="getswal('warning')">
<?php
  
  $return_donation_data = [
      "status"=>"true",
      "customer_name"=>"mlkmlk",
      "customer_email"=>"lklk",
      "customer_phone"=>"mlkmk",
      "invoice_url"=>"kmkl",
      "total_amount"=>"mlùl"
  ];

?>
  @if(isset($return_donation_data))
    <div class="alert_return">
      @if(count($return_donation_data)!=0)
        <div class="success">
          
        </div>
      @else
        <div class="error">
          
        </div>
      @endif
    </div>
  @endif
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
   <!--END NAV SECTION -->
  
  <!--HOME SECTION-->
  <div id="home-sec">

  </div>
  <!--END HOME SECTION-->

 <section class="main-gallery" id="home">
    <div class="overlay">
      <div class="container" style="height: 320px">
          <div class="row">
              <div class="col-md-12 text-center">
                 <h1 class="text-capitalize bigFont" data-scroll-reveal="wait 0.45s, then enter top and move 80px over 1s">Intimity Platform</h1>

                <p class="intro" data-scroll-reveal="wait 0.45s, then enter left and move 80px over 1s">Une slogan ici...</p>
              </div>
              
              <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                        <div class="text-center top40">
                            <a href="#" class="btn btns white-background themecolor fadeInDown">Google Play</a>
                            <a href="{{url('/dons/create')}}" class=" btn btns theme_background_color white fadeInLeft">Soutenir le projet</a>
                            <a href="{{url('/cycle')}}" class="btn btns black-background white fadeInRight">Free started</a>

                        </div>
                    </div>
              
          </div>
      </div>
    </div>
      
  </section>
   

    <!--SERVICES SECTION-->    
    <section  id="services-sec">
      <div class="container">
        <div class="row ">
          <h1>NOS SERVICES</h1>
          <div class="col-md-12 g-pad-bottom">
            <div class="col-md-6"></div>
          </div>
          <div class="col-md-12 text-center">
              <div class="col-md-3 ">
                  <div class="service-div">
                      <i class="fa fa-desktop fa-5x faa-vertical animated"></i>
                      <h4>Sure Quique Menu </h4>
                      <p>
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                   Curabitur nec nisl odio. Mauris vehicula at nunc id posuere.
                      </p>
                       <p>
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                      </p>
                  </div>
              </div>
              <div class="col-md-3 ">
                  <div class="service-div">
                      <i class="fa fa-calendar fa-5x faa-ring animated"></i>
                      <h4> Calendrier Mensuel </h4>
                      <p>
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                   Curabitur nec nisl odio. Mauris vehicula at nunc id posuere.
                      </p>
                       <p>
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                      </p>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="service-div">
                      <i class="fa fa-comments-o fa-5x faa-shake animated"></i>
                      <h4>FORUM DE DISCUSSION</h4>
                      <p>
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                   Curabitur nec nisl odio. Mauris vehicula at nunc id posuere.
                      </p>
                       <p>
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                      </p>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="service-div">
                      <i class="fa fa-comment fa-5x faa-shake animated"></i>
                      <h4>Chat</h4>
                      <p>
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                   Curabitur nec nisl odio. Mauris vehicula at nunc id posuere.
                      </p>
                       <p>
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                      </p>
                  </div>
              </div>
          </div>
          <div class="col-md-12 g-pad-bottom">
            <div class="col-md-12">
              <h2>Lorem ipsum dolor sit amet</h2>
              <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                   Curabitur nec nisl odio. Mauris vehicula at nunc id posuere.
                     Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                   Curabitur nec nisl odio. Mauris vehicula at nunc id posuere.   
                   Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                   Curabitur nec nisl odio. Mauris vehicula at nunc id posuere.
                     Lorem ipsum dolor sit amet, consectetur adipiscing elit.            
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--END SERVICES SECTION-->

     <!--PRICE SECTION-->
    <section id="price-sec">
        <div class="container">
            <div class="row ">
                <h1>PLAN d'ACTION :</h1>
                  <div class="col-md-12 g-pad-bottom">
                    <div class="col-md-6">
                      <h2>Lorem ipsum dolor sit amet</h2>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                         Curabitur nec nisl odio. Mauris vehicula at nunc id posuere.
                           Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                         Curabitur nec nisl odio. Mauris vehicula at nunc id posuere.              
                      </p>
                    </div>
                    <div class="col-md-6">
                      <h2>Lorem ipsum dolor sit amet</h2>
                      <p>
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                           Curabitur nec nisl odio. Mauris vehicula at nunc id posuere.
                             Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                           Curabitur nec nisl odio. Mauris vehicula at nunc id posuere.              
                      </p>
                    </div>
                  </div>
                <div class="col-md-12 text-center ">
                  <div class="col-md-4">
                      <ul class="plan">
                          <li class="plan-head">BASIC PLAN</li>
                         
                          <li><strong>12</strong> Accounts</li>
                          <li><strong>52</strong> Emails</li>
                          <li><strong>50 GB</strong> Space</li>
                          <li><strong>Free</strong> Support</li>
                           <li class="main-price">$99 only</li>
                          <li class="bottom">
                              <a href="#" class="btn btn-danger btn-lg btn-block">Read More</a>
                          </li>
                      </ul>
                  </div>
                  <div class="col-md-4">
                      <ul class="plan">
                          <li class="plan-head">POPULAR PLAN</li>
                          
                          <li><strong>12</strong> Accounts</li>
                          <li><strong>52</strong> Emails</li>
                          <li><strong>50 GB</strong> Space</li>
                          <li><strong>Free</strong> Support</li>
                          <li class="main-price">$199 only</li>
                          <li class="bottom">
                              <a href="#" class="btn btn-primary btn-lg btn-block">Read More</a>
                          </li>
                      </ul>
                  </div>
                  <div class="col-md-4">
                      <ul class="plan">
                          <li class="plan-head">VALUE PLAN</li>
                       
                          <li><strong>12</strong> Accounts</li>
                          <li><strong>52</strong> Emails</li>
                          <li><strong>50 GB</strong> Space</li>
                          <li><strong>Free</strong> Support</li>
                             <li class="main-price">$299 only</li>
                          <li class="bottom">
                              <a href="#" class="btn btn-success btn-lg btn-block">Read More</a>
                          </li>
                      </ul>
                  </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END PRICE SECTION-->
    <!--STATS SECTION-->
    <section class="c-blue">
        <div class="container">
            <div class="row ">
                <div class="col-md-3 ">
                    <div class="stats-div">
                        <h3>{{$subjects_c}}+ </h3>
                        <h4>Sujets</h4>
                    </div>
                </div>


                <div class="col-md-3 ">
                    <div class="stats-div">
                        <h3>{{$users_c}}+ </h3>
                        <h4>Membres inscrits</h4>
                    </div>

                </div>
                <div class="col-md-3 ">

                    <div class="stats-div">
                        <h3>{{$categories_c}}+ </h3>
                        <h4>Categories de sujet</h4>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="stats-div">
                        <h3>10+ </h3>
                        <h4>Nouveaux sujets</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END STATS SECTION-->

    <!--CONTACT SECTION-->
    
    <section  id="contact-sec">
        <div class="container">
             
            <div class="row">
                 <h1>Contact Us :</h1>
                  <div class="col-md-12 g-pad-bottom">
                  <div class="col-md-6">
                    <h2>Lorem ipsum dolor sit amet</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                         Curabitur nec nisl odio. Mauris vehicula at nunc id posuere.
                           Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                         Curabitur nec nisl odio. Mauris vehicula at nunc id posuere.              
                    </p>
                      </div>
                 <div class="col-md-6">
                    <h2>Lorem ipsum dolor sit amet</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                         Curabitur nec nisl odio. Mauris vehicula at nunc id posuere.
                           Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                         Curabitur nec nisl odio. Mauris vehicula at nunc id posuere.              
                    </p>
                      </div>
                     </div>
                <div class="col-md-6">
                   
                    <form>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" required="required" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" required="required" placeholder="Email address">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <textarea name="message" id="message" required="required" class="form-control" rows="3" placeholder="Message"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit Request</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <p>
                   <strong>Address:</strong>  123,Your locality , Counrty Name, Pin-20100090. <br />
                 <strong>Email:</strong>  info@yourdomain.com <br />
                          <strong>Web:</strong>  www.yourdomain.com <br />
                         <strong>Mobile:</strong>  +00-909-808-707-00<br />
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!--END CONTACT SECTION-->

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
      
     function getswal(typ) {
      let msg;
      let title_;
      if (typ=="success") {
        msg = "Nous vous remercions pour votre soutient";
        title_ = "Operation effectuée avec succès";
      }else if (typ == "warning") {
        msg = "Probleme survenu lors de la facturation";
        title_ = "Operation erronée";
      }else{
        msg = "Une erreur est survenu pendant le proccessus. Veuillez recommencé"
        title_ = "Fatal Error!"
      }
        swal({
          title: title_,
          text: "<span style=\"color:#F8BB86\"> "+msg+" <span>",
          html: true,
          confirmButtonColor: '#F8198D',
          type:typ
        });
     }
    </script>

</body>
</html>

