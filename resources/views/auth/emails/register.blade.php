<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Email - {{\Config::get("app.name")}}</title>
    <!-- Designed by https://github.com/kaytcat -->
    <!-- Header image designed by Freepik.com -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style type="text/css">



        /* Take care of image borders and formatting */

        img {
            max-width: 600px;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        a img {
            border: none;
        }

        table {
            border-collapse: collapse !important;
        }

        #outlook a {
            padding: 0;
        }

        .ReadMsgBody {
            width: 100%;
        }

        .ExternalClass {
            width: 100%;
        }

        .backgroundTable {
            margin: 0 auto;
            padding: 0;
            width: 100%;
        !important;
        }

        table td {
            border-collapse: collapse;
        }

        .ExternalClass * {
            line-height: 115%;
        }

        /* General styling */

        td {
            font-family: Arial, sans-serif;
            color: #5e5e5e;
            font-size: 16px;
            text-align: left;
        }

        body {
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
            width: 100%;
            height: 100%;
            color: #5e5e5e;
            font-weight: 400;
            font-size: 16px;
        }

        h1 {
            margin: 10px 0;
        }

        a {
            color: #d34cbf;
            text-decoration: none;
        }

        .body-padding {
            padding: 0 75px;
        }

        .force-full-width {
            width: 100% !important;
        }

        .icons {
            text-align: right;
            padding-right: 30px;
        }

        .logo {
            text-align: left;
            padding-left: 30px;
        }

        .computer-image {
            padding-left: 30px;
        }

        .header-text {
            text-align: left;
            padding-right: 30px;
            padding-left: 20px;
        }

        .header {
            color: #232925;
            font-size: 24px;
        }

        .center {
            text-align: center !important;
        }

    </style>

    <style type="text/css" media="screen">
        @media screen {
        @import url(http://fonts.googleapis.com/css?family=PT+Sans:400,700);
            /* Thanks Outlook 2013! */
            * {
                font-family: 'PT Sans', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
            }
        }
    </style>

    <style type="text/css" media="only screen and (max-width: 599px)">
        /* Mobile styles */
        @media only screen and (max-width: 599px) {

            table[class*="w320"] {
                width: 320px !important;
            }

            td[class*="icons"] {
                display: block !important;
                text-align: center !important;
                padding: 0 !important;
            }

            td[class*="logo"] {
                display: block !important;
                text-align: center !important;
                padding: 0 !important;
            }

            td[class*="computer-image"] {
                display: block !important;
                width: 230px !important;
                padding: 0 45px !important;
                border-bottom: 1px solid #e3e3e3 !important;
                background-color: white !important;
            }

            td[class*="header-text"] {
                display: block !important;
                text-align: center !important;
                padding: 0 25px !important;
                padding-bottom: 25px !important;
            }

            *[class*="mobile-hide"] {
                display: none !important;
                width: 0 !important;
                height: 0 !important;
                line-height: 0 !important;
                font-size: 0 !important;
            }

        }
    </style>
</head>
<body offset="0" class="body"
      style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none" bgcolor="#ffffff">
<table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%">
    <tr>
        <td align="center" valign="top" style="background-color:#ffffff" width="100%">

            <center>
                <table cellspacing="0" cellpadding="0" width="600" class="w320">
                    <tr>
                        <td align="center" valign="top">

                            <table class="force-full-width" cellspacing="0" cellpadding="0" bgcolor="#232925">
                                <tr>
                                    <td style="background-color:#d34cbf" class="logo">
                                        <br>
                                        <a href="#" style="color : #ffffff; font-size : 22px; font-weight : bold;">{{\Config::get("app.name")}}</a>
                                    </td>
                                    <td style="background-color:#d34cbf" class="icons">
                                        <br>
                                        <a href="#" style="color : white !important;"><i class="fa fa-facebook" ></i></a>
                                        <a href="#" style="color : white !important;"><i class="fa fa-twitter" ></i></a>
                                        <a href="#" style="color : white !important;"><i class="fa fa-google-plus" ></i></a>
                                        <a href="#" style="color : white !important;"><i class="fa fa-instagram" ></i></a>

                                    </td>
                                </tr>
                            </table>

                            <table cellspacing="0" cellpadding="0" class="force-full-width" bgcolor="#232925">
                                <tr>
                                    <td class="computer-image" style="background-color: white !important;">
                                        <br>
                                        <br class="mobile-hide"/>
                                        <img style="display:block;" width="224" height="213"
                                             src="{!!$message->embed('assetsLandin/img/logo_rose512.png')!!}"
                                             alt="logo {{\Config::get("app.name")}}">
                                        <br>

                                    </td>
                                    <td style="color: #ffffff;" class="header-text">
                                        <br>
                                        <br>
                                        <span style="font-size: 24px;">{{trans("auth.thk_confiance")}}</span><br><br>
                                        {{trans("auth.email.register.myintimity.slog")}}
                                        <br>
                                        <br>

                                        <div><!--[if mso]>
                                            <v:rect xmlns:v="urn:schemas-microsoft-com:vml"
                                                    xmlns:w="urn:schemas-microsoft-com:office:word" href="http://"
                                                    style="height:40px;v-text-anchor:middle;width:150px;" stroke="f"
                                                    fillcolor="#2b934f">
                                                <w:anchorlock/>
                                                <center>
                                            <![endif]-->

                                            <!--[if mso]>
                                            </center>
                                            </v:rect>
                                            <![endif]-->
                                        </div>
                                    </td>
                                </tr>
                            </table>


                            <table class="force-full-width" cellspacing="0" cellpadding="30" bgcolor="#ebebeb">
                                <tr>
                                    <td>
                                        <table cellspacing="0" cellpadding="0" class="force-full-width">
                                            <tr>
                                                <td class="center">
                                                    <span class="header">{{trans("auth.email.register.y_param")}}</span><br>
                                                    {{trans("auth.email.register.y_login")}} : {{$login}}<br>
                                                    {{trans("auth.email.register.y_pwd")}} : {{$pwd}}<br><br>
                                                    <span class="header">{{\Config::get("app.name")}}</span><br>
                                                    {{trans("auth.email.register.link_text_cycle")}}
                                                    <a href="{{url('cycle')}}">{{trans("auth.email.register.link_val_cycle")}}</a>.
                                                    {{\Config::get("app.name")}} {{trans("auth.email.register.txt1")}}
                                                    <br><br>
                                                    <span class="header">{{trans("auth.email.register.txt2")}}</span><br>
                                                    {{trans("auth.email.register.txt3",["app_name"=>\Config::get("app.name")])}}
                                                     <a href="{{url('forum')}}">Forum</a>.
                                                    {{trans("auth.email.register.txt4")}}
                                                    <br><br>
                                                    <span class="header">{{trans("auth.email.register.txt5")}} {{\Config::get("app.name")}}</span><br>
                                                    {{trans("auth.email.register.txt6",["app_name"=>\Config::get("app.name")])}}
                                                    <br><br>
                                                    <a href="#" style="color : #424fff !important;"><i class="fa fa-facebook" ></i></a>
                                                    <a href="#" style="color : #426cff !important;"><i class="fa fa-twitter" ></i></a>
                                                    <a href="#" style="color : #ff2123 !important;"><i class="fa fa-google-plus" ></i></a>
                                                    <a href="#" style="color : #ff6c31 !important;"><i class="fa fa-instagram" ></i></a>
                                                    <br><br>
                                                    <a href="{{url('term')}}">{{trans("auth.email.register.cond")}}</a>&nbsp;&nbsp;*&nbsp;&nbsp;
                                                    <a href="{{url('term')}}">{{trans("auth.email.register.confid")}}</a>&nbsp;&nbsp;*&nbsp;&nbsp;
                                                    <a href="{{url('term')}}">{{trans("auth.email.register.pol_donn")}}</a>

                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>


                            <table class="force-full-width" cellspacing="0" cellpadding="20" bgcolor="#2b934f">
                                <tr>
                                    <td style="background-color:#d34cbf; color:#ffffff; font-size: 14px; text-align: center; font-weight:bold;">
                                        © 2017 Intimity
                                    </td>
                                </tr>
                            </table>


                        </td>
                    </tr>
                </table>

            </center>
        </td>
    </tr>
</table>
</body>
</html>