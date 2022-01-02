/**
 * Created by NCR on 08/12/2017.
 */


var monthList = ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"]

var parametres = [];
var mois_courant = new Date((new Date()).getFullYear(), (new Date()).getMonth(), 1);


function saveParam()
{
    var paramString = JSON.stringify(window.parametres);

    localStorage.setItem("parametres",paramString);

}



function initParam(){

    var paramString = localStorage.getItem("parametres");
    if(paramString != null){
        window.parametres = JSON.parse(paramString);
    }


}


function dateInParameter(ladate){
    if(window.parametres != null && window.parametres.length > 0){
        for(var i = 0; i < window.parametres.length; i++){
            var param = window.parametres[i];
            var premier = new Date(window.parametres[i].ddr + "T" + "00:00:00");
            var dernier = new Date(premier.getFullYear(), premier.getMonth(), premier.getDate() + parseInt(param.duree_cycle));
            if(!param.estRegulier)
                dernier = new Date(premier.getFullYear(), premier.getMonth(), premier.getDate() + param.duree_max);

            if((cmpDate(premier, ladate) == 0 || cmpDate(premier, ladate) == -1) &&
                (cmpDate(ladate, dernier) == 0 || cmpDate(ladate, dernier) == -1)){
                return i;
            }
        }
    }

    return -1;

}



function genererPrevisionCycleNormale(leparam){

    var dt_dernier = new Date(leparam.ddr + "T" + "00:00:00");
    //console.log(" ** genererPrevisionNormale : " + dt_dernier   );
    var prev = [];
    var prev_observer = [];
    var j = 0 ;
    var chainedate = "";
    //console.log(" ** parametre : ");
    //console.log(leparam  );
    for(var i = 0; i < leparam.duree_ecoulement; i++){
        var chainedate = dt_dernier.getFullYear() + "-" + formatNumber(dt_dernier.getMonth() + 1) + "-" + formatNumber(dt_dernier.getDate());
        if(i == 0) {
            prev[j] = [
                new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + i),
                "prev-ecoul",
                "onclick=modifierLaDate('" + chainedate + "');"];
        }else{
            prev[j] = [
                new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + i),
                "prev-ecoul",
                ""];
        }
        j++;
    }

    if(leparam.duree_cycle - 14 - 2 > 0) {
        var dt = new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + leparam.duree_cycle);
        dt.setDate(dt.getDate() - 16);
        prev[j] = [dt, "prev-fille1", ""];
        j++;
        dt = new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + leparam.duree_cycle);
        dt.setDate(dt.getDate() - 15);
        prev[j] = [dt, "prev-fille2", ""];
        j++;
        dt = new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + leparam.duree_cycle);
        //console.log("date cycle : " + dt);
        dt.setDate(dt.getDate() - 14);
        prev[j] = [dt, "prev-ovul event", ""];
        //console.log("date ovulation : " + prev[j]);
        j++;
        dt = new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + leparam.duree_cycle);
        dt.setDate(dt.getDate() - 13);
        prev[j] = [dt, "prev-gar", ""];
        j++;
        dt = new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + leparam.duree_cycle);
        dt.setDate(dt.getDate() - 1);
        prev[j] = [dt, "prev-fin-cycle", ""];

        j++;
    }


    //console.log(" ** prevision : ");
    //console.log("voila " + Math.random() + " ------- " + prev);
    //console.log(prev);
    //console.log(" ******************************************************************************************* ");
    return prev;
}

function calculerCycleIrregulier(leparam){
    var param = leparam;
    var tab_prev = [];
    var j = 0;
    for(var i = param.duree_min; i <= param.duree_max; i++){
        param.duree_cycle = i;
        tab_prev[j] = genererPrevisionCycleNormale(param);
        j++;
    }
    //console.log(" -------------------------------------------------------------------------------------------------- ");
    //console.log(" ** calculerCycleIrregulier : ");
    //console.log(tab_prev);
    return tab_prev;
}

function fusionerCycleIrregulier(tab_prev){
    
    //console.log(" ************************************************************************************** ");
    //console.log(" ** fusionerCycleIrregulier Enter : ");
    //console.log(tab_prev);

    var result = [];
    var cpt = 0;
    if(tab_prev.length > 0) {
        result = tab_prev[0].slice();
        while(cpt < result.length && result[cpt].length > 1 && result[cpt][1] != "prev-ovul event"){
            cpt++;
        }
        cpt++;
    }
    var j = 0;
    for(i = 1; i < tab_prev.length; i++){
        while(j < tab_prev[i].length && tab_prev[i][j].length > 1 && tab_prev[i][j][1] != "prev-ovul event"){
            j++;
        }
        if(j < tab_prev[i].length) {
            result[cpt] = tab_prev[i][j].slice();
            result[cpt + 1] = tab_prev[i][j + 1].slice();
            cpt++;
            if (i == tab_prev.length - 1) {
                result[cpt+1] = tab_prev[i][j + 2].slice();
            }
        }
    }

    //console.log(" ** fusionerCycleIrregulier out : ");
    //console.log(result);

    return result;
}

function genererPrevisionCycleIrregulier(leparam){
    var tab_prev = calculerCycleIrregulier(leparam);

    var prev = fusionerCycleIrregulier(tab_prev);

    //console.log("fusionerCycleIrregulier : ");
    //console.log(tab_prev);

    return prev;
}

function genererPrevisionCycle(leparam){
    if(leparam.estRegulier){
        //console.log("generer Prevision Cycle Normale : ");
        return genererPrevisionCycleNormale(leparam);
    }
    //console.log("generer Prevision Cycle Irregulier : ");
    return genererPrevisionCycleIrregulier(leparam);
}


function isValidDate(date){
    var d = new Date(date + "T" + "00:00:00");
    if ( Object.prototype.toString.call(d) === "[object Date]" ) {
        // it is a date
        if ( isNaN( d.getTime() ) ) {  // d.valueOf() could also work
            return true;
        }
        else {
            return false;
        }
    }
    else {
        return false;
    }
}

function isCycleValide(cycle){
    if(!isValidDate(cycle.ddr))
        return false;
    if(!Number.isInteger(cycle.duree_ecoulement))
        return false;
    if(!Number.isInteger(cycle.duree_cycle))
        return false;
    if(!Number.isInteger(cycle.duree_min))
        return false;
    if(!Number.isInteger(cycle.duree_max))
        return false;

    return true;
}

function getParamFromView(){


    var param = {
        ddr : $('#ddr').val(),
        duree_ecoulement : parseInt($('#dseign').val()),
        duree_cycle : parseInt($('#dcycle').val()),
        duree_min : parseInt($('#dmin').val()),
        duree_max : parseInt($('#dmax').val()),
        heure_notification : "06:00",
        estRegulier : $('#r_i').attr('isHide') == "true"
    };

    if(isCycleValide(param))
        window.parametres[window.parametres.length - 1] = param;

}

/**
 * permet de récuperer tous les parametre couvrant le mois
 * @param ladate : l'anné et le mois (tjrs le premier jour du mois)
 */
function getParamDuMois(ladate){

    var firstDay = new Date(ladate.getFullYear(), ladate.getMonth(), 1);
    var lastDay = new Date(ladate.getFullYear(), ladate.getMonth() + 1, 0);
    var param = [];
    var j = 0;

    for(i = 0; i < window.parametres.length; i++){
        var pc = new Date(window.parametres[i].ddr + "T" + "00:00:00");
        var pcf = new Date(pc.getFullYear(), pc.getMonth(), pc.getDate() + window.parametres[i].duree_cycle);
        if(!window.parametres[i].estRegulier)
            pcf = new Date(pc.getFullYear(), pc.getMonth(), pc.getDate() + window.parametres[i].duree_max);
        if(
            ((cmpDate(firstDay, pc) == -1 || cmpDate(firstDay, pc) == 0) &&
            (cmpDate(pc, lastDay) == -1 || cmpDate(pc, lastDay) == 0)) ||
            ((cmpDate(firstDay, pcf) == -1 || cmpDate(firstDay, pcf) == 0) &&
            (cmpDate(pcf, lastDay) == -1 || cmpDate(pcf, lastDay) == 0))
          ){
            param[j] = window.parametres[i];
            j++;
        }
    }

    return param;
}

function sortParam(a, b) {

    if (a.ddr > b.ddr) {
        return 1;
    }
    if (a.ddr < b.ddr) {
        return -1;
    }
    return 0;
}


function formatNumber(num){
    return ((num < 10)? "0"+num : num);
}


function genererParaMois(ladate){
    if(window.parametres.length > 0) {
        window.parametres = window.parametres.sort(sortParam);

        console.log("genererParaMois");

        var temp_date = new Date(ladate.getFullYear(), ladate.getMonth(), 1);
        var first_date = new Date(window.parametres[0].ddr + "T" + "00:00:00");
        var last_date = new Date(window.parametres[window.parametres.length - 1].ddr + "T" + "00:00:00");
        var lastDay = new Date(ladate.getFullYear(), ladate.getMonth() + 1, 0);
        var new_param = [];

        if(dateInParameter(temp_date) == -1 && cmpDate(temp_date, first_date) == -1){
            console.log("gauche de param");
            var param = window.parametres[0];
            var temps = first_date;
            console.log("temps : " + temps);
            var i = 0;
            while (cmpDate(temp_date, temps) == -1 || cmpDate(temp_date, lastDay) == 0 ) {
                //temps = new Date(temps.getFullYear(), temps.getMonth(), temps.getDate() - param.duree_cycle);
                if(param.estRegulier)
                    temps.setDate(temps.getDate() - param.duree_cycle);
                else
                    temps.setDate(temps.getDate() - param.duree_max);
                    //temps = new Date(temps.getFullYear(), temps.getMonth(), temps.getDate() - param.duree_max);
                console.log(!param.estRegulier);
                console.log("temps in : " + temps);
                new_param[i] = {
                    ddr: temps.getFullYear() + "-" + formatNumber(temps.getMonth() + 1) + "-" + formatNumber(temps.getDate()),
                    duree_ecoulement: param.duree_ecoulement,
                    duree_cycle: param.duree_cycle,
                    duree_min: param.duree_min,
                    duree_max: param.duree_max,
                    heure_notification: param.heure_notification,
                    estRegulier: param.estRegulier
                };
                console.log(new_param[i]);
                i++;
            }
            console.log(new_param);
            if (new_param.length > 0) {
                window.parametres = window.parametres.concat(new_param);
                //window.parametres = window.parametres.concat(new_param);
            }
        }
        new_param = [];
        if(dateInParameter(lastDay) == -1 && cmpDate(last_date, lastDay) == -1){
            console.log("droite de param");
            var param = window.parametres[window.parametres.length - 1];
            var temps = last_date;
            console.log("temps : " + temps);
            var i = 0;
            while (cmpDate(temps, lastDay) == -1 || cmpDate(temps, lastDay) == 0 ) {
                if(param.estRegulier)
                    temps.setDate(temps.getDate() + param.duree_cycle);
                else
                    temps.setDate(temps.getDate() + param.duree_max);

                console.log("temps in : " + temps);
                new_param[i] = {
                    ddr: temps.getFullYear() + "-" + formatNumber(temps.getMonth() + 1) + "-" + formatNumber(temps.getDate()),
                    duree_ecoulement: param.duree_ecoulement,
                    duree_cycle: param.duree_cycle,
                    duree_min: param.duree_min,
                    duree_max: param.duree_max,
                    heure_notification: param.heure_notification,
                    estRegulier: param.estRegulier
                };
                console.log(new_param[i]);
                i++;
            }
            console.log(new_param);
            if (new_param.length > 0) {
                window.parametres = window.parametres.concat(new_param);
            }
        }
        console.log("avant trie ");
        console.log(window.parametres);
        window.parametres = window.parametres.sort(sortParam);
        console.log("apres trie ");
        console.log(window.parametres);


        return true;







        /*
        while (getParamDuMois(temp_date) == null && cmpDate(last_date, temp_date) == -1) {
            temp_date = new Date(temp_date.getFullYear(), temp_date.getMonth() - 1, 1);

        }




        if(!dateInParameter(temp_date)){
            var temps = temp_date;
            var pparam = window.parametres[0];
            var last_date_pparam = new Date(pparam.ddr + "T" + "00:00:00");
            while (cmpDate(temp_date, temps) == -1 || cmpDate(temp_date, lastDay) == 0 ) {
                if (i == 0)
                    temp_date = new Date(param.ddr + "T" + "00:00:00");
                temp_date = new Date(temp_date.getFullYear(), temp_date.getMonth(), temp_date.getDate() + param.duree_cycle);
                if(!param.estRegulier)
                    temp_date = new Date(temp_date.getFullYear(), temp_date.getMonth(), temp_date.getDate() + param.duree_max);
                new_param[i] = {
                    ddr: temp_date.getFullYear() + "-" + formatNumber(temp_date.getMonth() + 1) + "-" + temp_date.getDate(),
                    duree_ecoulement: param.duree_ecoulement,
                    duree_cycle: param.duree_cycle,
                    duree_min: param.duree_min,
                    duree_max: param.duree_max,
                    heure_notification: param.heure_notification,
                    estRegulier: param.estRegulier
                };
                i++;
            }
        }
        var params = getParamDuMois(temp_date);

        console.log("param du mois : ");
        console.log(params);

        if(params != null) {
            if (cmpDate(temp_date, ladate) == -1 || cmpDate(ladate, temp_date) == 0 ) {
                var param = params[params.length - 1];
                var new_param = [];
                i = 0;

                while (cmpDate(temp_date, lastDay) == 0 || cmpDate(temp_date, lastDay) == -1) {
                    if (i == 0)
                        temp_date = new Date(param.ddr + "T" + "00:00:00");
                    temp_date = new Date(temp_date.getFullYear(), temp_date.getMonth(), temp_date.getDate() + param.duree_cycle);
                    if(!param.estRegulier)
                        temp_date = new Date(temp_date.getFullYear(), temp_date.getMonth(), temp_date.getDate() + param.duree_max);
                    new_param[i] = {
                        ddr: temp_date.getFullYear() + "-" + formatNumber(temp_date.getMonth() + 1) + "-" + temp_date.getDate(),
                        duree_ecoulement: param.duree_ecoulement,
                        duree_cycle: param.duree_cycle,
                        duree_min: param.duree_min,
                        duree_max: param.duree_max,
                        heure_notification: param.heure_notification,
                        estRegulier: param.estRegulier
                    };
                    i++;

                }

                console.log("genererParaMois params != null : ");
                console.log(new_param);
                if (new_param.length > 0) {
                    window.parametres = window.parametres.concat(new_param);
                }
                return true;
            }
        }else if(cmpDate(temp_date, last_date) == -1){
            var param = window.parametres[0];
            var new_param = [];
            i = 0;
            while (cmpDate(temp_date, lastDay) == -1 || cmpDate(temp_date, lastDay) == 0 ) {
                if (i == 0)
                    temp_date = new Date(param.ddr + "T" + "00:00:00");
                temp_date = new Date(temp_date.getFullYear(), temp_date.getMonth(), temp_date.getDate() + param.duree_cycle);
                if(!param.estRegulier)
                    temp_date = new Date(temp_date.getFullYear(), temp_date.getMonth(), temp_date.getDate() + param.duree_max);
                new_param[i] = {
                    ddr: temp_date.getFullYear() + "-" + formatNumber(temp_date.getMonth() + 1) + "-" + temp_date.getDate(),
                    duree_ecoulement: param.duree_ecoulement,
                    duree_cycle: param.duree_cycle,
                    duree_min: param.duree_min,
                    duree_max: param.duree_max,
                    heure_notification: param.heure_notification,
                    estRegulier: param.estRegulier
                };
                i++;
            }

            if (new_param.length > 0) {
                var temps_tab = new_param.reverse().concat(window.parametres);
                window.parametres = temps_tab;
            }
            return true;

        }
        */

    }

    return false;

}



function cmpDate(dt1, dt2){
    if(dt1.getFullYear() < dt2.getFullYear())
        return -1;
    if(dt1.getFullYear() > dt2.getFullYear())
        return 1;

    if(dt1.getMonth() < dt2.getMonth())
        return -1;
    if(dt1.getMonth() > dt2.getMonth())
        return 1;

    if(dt1.getDate() < dt2.getDate())
        return -1;
    if(dt1.getDate() > dt2.getDate())
        return 1;

    //dt1 == dt2
    return 0;
}




function genererTableau(ladate, prevision)
{
    if (typeof prevision === 'undefined' || !prevision)
        prevision = [];


    tableau = "";
    var la_date = new Date((new Date()).getFullYear(), (new Date()).getMonth(), (new Date()).getDate());
    var dt = new  Date(ladate.getFullYear(), ladate.getMonth(), 1);
    var annee = dt.getFullYear();
    var le_mois = dt.getMonth();


    if(dt.getDay() != 1)
    {
        while(dt.getDay() != 1)
        {
            dt.setDate(dt.getDate() - 1);
            //dt = new Date(dt.getFullYear(), dt.getMonth(), dt.getDate() - 1);
        }
    }

    tableau = "<tr>";
    var cpt = 0;

    var observateur = 0;

    while(dt.getMonth() != le_mois)
    {

        while(cpt < prevision.length && cmpDate(prevision[cpt][0], dt) == -1)
            cpt++;
        if(cpt < prevision.length  && cmpDate(prevision[cpt][0], dt) == 0 ){
            tableau += '<td class="prev-month" '+prevision[cpt][2]+'><span class="'+prevision[cpt][1]+'">' + dt.getDate() + '</span></td>';
            cpt++;
        }else{
            tableau += '<td class="prev-month"><span class="">' + dt.getDate() + '</span></td>';
        }

        dt = new Date(dt.getFullYear(), dt.getMonth(), dt.getDate() + 1);

    }

    cpt = 0;observateur = 0;
    while(dt.getMonth() == le_mois)
    {

        if(dt.getDay() == 1)
            tableau += '<tr>';

        while(cpt < prevision.length && cmpDate(prevision[cpt][0], dt) == -1)
            cpt++;


        if(cmpDate(la_date, dt) == 0){
            if(cpt < prevision.length && cmpDate( prevision[cpt][0], dt) == 0){
                tableau += '<td class="selectionner" '+prevision[cpt][2]+'> <span class="'+prevision[cpt][1]+'">' + dt.getDate() + '</span></td>';
                cpt++;
            }else{
                tableau += '<td class="selectionner "><span>' + dt.getDate() + '</span></td>';
            }
        }else{
            if(cpt < prevision.length && cmpDate( prevision[cpt][0], dt) == 0){
                tableau += '<td '+prevision[cpt][2]+'><span class="'+prevision[cpt][1]+'">' + dt.getDate() + '</span></td>';
                cpt++;
            }else{
                tableau += '<td><span>' + dt.getDate() + '</span></td>';
            }

        }
        if(dt.getDay() == 0)
            tableau += '</tr>';
        dt = new Date(dt.getFullYear(), dt.getMonth(), dt.getDate() + 1);


    }

    cpt = 0;observateur = 0;
    if(dt.getDay() != 1)
    {
        while(dt.getDay() != 1)
        {
            while(cpt < prevision.length && cmpDate( prevision[cpt][0], dt) == -1)
                cpt++;

            if(cpt < prevision.length && cmpDate( prevision[cpt][0], dt) == 0){
                tableau += '<td class="next-month"> <span class="'+prevision[cpt][1]+'">' + dt.getDate() + '</span></td>';
            }else{
                tableau += '<td class="next-month"><span>' + dt.getDate() + '</span></td>';
            }
            dt = new Date(dt.getFullYear(), dt.getMonth(), dt.getDate() + 1);

        }
        tableau += "</tr>";
    }


    $('#le_calendrier').html(tableau);
    $('#le_mois').html(window.monthList[le_mois] + " " + annee	);



}


function predireMois(ladate){
    genererParaMois(ladate);
    console.log("ladate : " + ladate);
    console.log("paramettre : ");
    console.log(window.parametres);
    var params = getParamDuMois(ladate);
    console.log("params : " + params.length);
    console.log(params);
    var prevision = [];

    for(var i = 0; i < params.length; i++){
        prevision = prevision.concat(genererPrevisionCycle(params[i]));

    }
    console.log(prevision);
    genererTableau(ladate, prevision);

}


function updateNextTableau()
{
    window.mois_courant = new Date(window.mois_courant.getFullYear(), window.mois_courant.getMonth() + 1, 1);
    predireMois(window.mois_courant);
}
function updatePrevTableau()
{
    window.mois_courant = new Date(window.mois_courant.getFullYear(), window.mois_courant.getMonth() - 1, 1);
    predireMois(window.mois_courant);
}


function initialeCall(){
    predireMois(window.mois_courant);
}


function setParamFromBD(new_param){
    window.parametres = [];
    window.parametres[0] = new_param;

}
function performPrediction(){
    var isHide = $('#r_i').attr('isHide');
    if (isHide == "true") {
        //alert("dedans");
        //$('#cycle-irregulier').hide(800);
        var new_param = {
            ddr: $('#ddr').val(),
            duree_ecoulement: parseInt($('#dseign').val()),
            duree_cycle: parseInt($('#dcycle').val()),
            duree_min: 20,
            duree_max: 35,
            heure_notification: "06:00",
            estRegulier: true
        };
        window.parametres = [];
        //window.parametres = window.parametres.concat(new_param);
        window.parametres[0] = new_param;
        if($('#user-conect').val() == 1){
            saveToServe();
        }
        predireMois(window.mois_courant);

    }else{
        var new_param = {
            ddr: $('#ddr').val(),
            duree_ecoulement: parseInt($('#dseign').val()),
            duree_cycle: parseInt($('#dcycle').val()),
            duree_min: parseInt($('#dmin').val()),
            duree_max: parseInt($('#dmax').val()),
            heure_notification: "06:00",
            estRegulier: false
        };
        window.parametres = [];
        //window.parametres = window.parametres.concat(new_param);
        window.parametres[0] = new_param;
        if($('#user-conect').val() == 1){
            saveToServe();
        }
        predireMois(window.mois_courant);

        /*
        //enregistrement dans la BD
        if($('#user-conect').val() == 1){
            //saveToServe();
        }
        window.duree_cycle = window.duree_cycle_min;

        code = "";
        for(i = window.duree_cycle_min; i <= window.duree_cycle_max; i++){
            if(i == window.duree_cycle_min)
                code += "<option value='"+i+"' selected> prevision sur "+i+" jour </option>";
            else
                code += "<option value='"+i+"'> prevision sur "+i+" jour </option>";
        }
        $('#cycle-irregulier').html(code);
        $('#cycle-irregulier').show(800);
        saveParam();
        synchroniserCycleDate();
        genererTableau();
        //alert(window.date_regle + "---" + window.duree_cycle +"---"+window.duree_ecoulement+ "---" + window.duree_cycle_min +"---"+window.duree_cycle_max);

        //window.heure_notif = "06:00";
        */

    }
}

function saveToServe(){

    url = $('#path').val();
    $.ajax({
        url : url,
        type : 'post',
        data : window.parametres[0],
        beforeSend: function() {
            $("#save-param-user-msg").html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
        },
        success : function(result, statut){
            //alert(result.status);
            if(result.status == "1"){
                $("#save-param-user-msg").html('<span>vos param&egrave;tres on &eacute;t&eacute; mis &agrave; jour</span>');
                setTimeout(removeSuccessMsg, 5000);
            }else{
                //alert('echec de chargement');
            }
        },

        error : function(resultat, statut, erreur){
            $("#save-param-user-msg").html("");
            alert('error');
        },

        complete : function(resultat, statut){
            $("#loadingCour").addClass('hidden');

        }

    });
}




/******************************************************************************************/

function removeSuccessMsg(){
    $("#save-param-user-msg").html('');
}



function chargerParam(){

    var isHide = $('#r_i').attr('isHide');
    if (isHide == "true") {
        $('#div-dcycle').hide(700);
        $('#r_i').show(700);
        $('#r_i').attr('isHide','false');
    }else{
        $('#r_i').hide(700);
        $('#div-dcycle').show(700);
        $('#r_i').attr('isHide','true');

    }

}

function modifierLaDate(chainedate){
    //alert("votre cycle commence le " + chainedate);
}



function predirIrregulier(val){
    window.le_mois_ajouter = 0;
    window.duree_cycle = parseInt(val);
    synchroniserCycleDate();
    genererTableau();
}


















