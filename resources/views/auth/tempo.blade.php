<html>
   <head>
      <title> Login | {{config()->get("app.name")}} </title>
      <meta charset="UTF-8">
      <link rel="stylesheet" type="text/css" href="{{asset('startUI/css/main.css')}}">
      <link href="{{asset('css/login.css')}}" rel='stylesheet' type="text/css">
      <script type="text/javascript">
         function validate()
         {
            if( document.myForm.title.value == "" )
            {
               alert( "Please provide title!" );
               document.myForm.title.focus() ;
               return false;
            }
             
            if( document.myForm.message.value == "" )
            {
               alert( "Please provide message!" );
               document.myForm.message.focus() ;
               return false;
            }
             
         if( document.myForm.image.value == "" )
            {
               alert( "Please provide image url path!" );
               document.myForm.image.focus() ;
               return false;
            }
            return( true );
         }
      </script>
   </head>
 
   <body>
    <div class="container">
      <div class="row">
        <div class="col-md-4  col-sm-4 col-xs-12">
          <div class="login-page" >
            <h1 text-color:"#ffffff">
              <center>{{config()->get("app.name")}}</center>
              <center style="font-size:12px">{{trans("string.slogan")}}</center>
            </h1>
              
            <div class="form">
              <form class="login-form" action="#" method="post" name="myForm" onsubmit="return(validate());" >
                <input type="text" placeholder="Title" name="title" id="title"/>
                <input type="text" placeholder="Message" name="message" id="message"/>
                <input type="text" placeholder="Image URL Path" name="image" id="image"/>
                <input type="submit" name="submit" id="submit" value="Submit">
                <div id="outputvalue">  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="{{asset('startUI/js/lib/bootstrap/bootstrap.min.js')}}"></script>
   </body>
</html>