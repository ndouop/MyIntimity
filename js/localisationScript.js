
function  setDetectedLocation(locat)
{
    $.ajax({
        //url : url,
        url : 'https://ipinfo.io',
        type : 'get',
        dataType : 'JSON',
        beforeSend: function() {
            //alert('before send');
        },
        success : function(result, statut){
            if(Object.keys(result).length > 0){
                $('#code').attr('value', result.country);
                $('#pays_nom').attr('value', result.country);
                $('#region').attr('value', result.region);
                $('#ville').attr('value', result.city);
                $('#ip').attr('value', result.ip);
            }
        },

        error : function(resultat, statut, erreur){
            /*alert('error');
            console.log(resultat);
            console.log(statut);
            console.log(erreur);*/
        },

        complete : function(resultat, statut){
            //$("#loadingCour").addClass('hidden');

        }

    });

}



function  setDetectedLocation2(locat, url, user_id)
{
    //alert();
    $.ajax({
        //url : url,
        url : 'https://ipinfo.io',
        type : 'get',
        dataType : 'JSON',
        beforeSend: function() {
            //alert('before send');
        },
        success : function(result, statut){

            //alert(JSON.stringify(result));
            //$("#toto").html(result);
            if(Object.keys(result).length > 0 && $("#code").val() == ''){
                saveUserLocation(url, user_id, result);
            }
        },

        error : function(resultat, statut, erreur){
            //alert('error');
            //console.log(resultat);
            //console.log(statut);
            //console.log(erreur);
        },

        complete : function(resultat, statut){
            //$("#loadingCour").addClass('hidden');

        }

    });


}


function  saveUserLocation(url, user_id, data)
{

    $.ajax({
        url : url,
        type : 'post',
        data : {
            _token : window.token,
            user_id : user_id,
            code : data.country,
            pays_nom : data.country,
            region : data.region,
            ip : data.ip,
            ville : data.city
        },
        beforeSend: function() {
            //alert('before send');
        },
        success : function(result, statut){
            //alert('retour');
            if(result.resultat == "1"){
                //alert('cest fait localisation');
            }else{
                //alert('echec de localisation');
            }
        },

        error : function(resultat, statut, erreur){
            //alert('error');
            //console.log(resultat);
            //console.log(statut);
            //console.log(erreur);
        },

        complete : function(resultat, statut){
            //$("#loading").addClass('hidden');

        }

    });


}