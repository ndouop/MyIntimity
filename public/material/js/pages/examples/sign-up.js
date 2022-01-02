// Initialize Firebase
/*var config = {
    apiKey: "AIzaSyArINd-sPHadpOXOzruiip1tXc-ZFphJZA",
    authDomain: "nivekafirebase.firebaseapp.com",
    databaseURL: "https://nivekafirebase.firebaseio.com",
    projectId: "nivekafirebase",
    storageBucket: "nivekafirebase.appspot.com",
    messagingSenderId: "457290517797"
};
firebase.initializeApp(config);*/

$(function () {
    $('#sign_up').validate({

            rules: {
                'terms': {
                    required: true
                },
                'confirm': {
                    equalTo: '[name="password"]'
                }
            },
            highlight: function (input) {
                
                $(input).parents('.form-line').addClass('error');
            },
            unhighlight: function (input) {
                $(input).parents('.form-line').removeClass('error');
            },
            errorPlacement: function (error, element) {
                $(element).parents('.input-group').append(error);
            },

            submitHandler: function(form){
                var email = $(form).find(".email").val();
                var passfire = $(form).find('.password').val();

                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url:$(form).attr('action'),
                    type:'POST',
                    dataType:'json',
                    data:$(form).serializeArray(),
                    error:function(data){
                         notie.alert(3, data.statusText, 2);
                    },
                    success:function(data){
                        if(!data.status){
                             if (data.validator) {
                                let errorsHtml = "<ul style='font-size:16px'>";
                                $.each( data.errors, function( key, value ) {
                                    errorsHtml += '<li>' + value[0] + '</li>'; 
                                });
                                errorsHtml+="</ul>";

                                notie.alert(3, errorsHtml, 60);
                             }
                        }else{
                             notie.alert(1, data.message, 2);


/*                             firebase.auth().createUserWithEmailAndPassword(email,passfire).then(response=>{
                                console.log(response);
                                window.location.replace($("meta[name='baseUrl']").attr("value")+"/profile");
                             }).cath(error=>{
                                console.log(error.message);
                             })*/


                             window.location.replace($("meta[name='baseUrl']").attr("value")+"/profile");
                        }
                    }
                });
            }
    });

});



/*rules: {
            'terms': {
                required: true
            },
            'confirm': {
                equalTo: '[name="password"]'
            }
        },
        highlight: function (input) {
            
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.input-group').append(error);
            $(element).parents('.form-group').append(error);
        }
    });*/