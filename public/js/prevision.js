
var monthList = ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"]
//var la_date = Date.now();
var le_mois_ajouter = 0;
var ddd = new Date();
var date_regle = ddd.getFullYear()+"-"+ddd.getMonth()+ "-01";
var duree_cycle = 28;
var duree_ecoulement = 4;
var duree_cycle_min = 20;
var duree_cycle_max = 32;
var heure_notif = "06:00";
var trans = window.Translator;
var local = (window.localLang!="")?window.localLang:"fr";
    trans.setLanguage(local);
var sources = window.transDataSource;
trans.setDATA(sources);


function saveParam()
{

    date_regle1 = $('#ddr').val();
    duree_cycle1 = $('#dcycle').val();
    duree_ecoulement1 = $('#dseign').val();
    //heure_notif1 = $('#heure_notif').val();
    duree_cycle_min1 = $('#dmin').val();
    duree_cycle_max1 = $('#dmax').val();
    regle_irrgulier = $('#r_i').attr('isHide');

    //alert(date_regle1 + "---" + duree_cycle1 +"---"+duree_ecoulement1+ "---" + duree_cycle_min1 +"---"+duree_cycle_max1);


    localStorage.setItem("date_regle",date_regle1);
    localStorage.setItem("duree_cycle", duree_cycle1);
    localStorage.setItem("duree_ecoulement", duree_ecoulement1);
    //localStorage.setItem("heure_notif", heure_notif1);
    localStorage.setItem("duree_cycle_min", duree_cycle_min1);
    localStorage.setItem("duree_cycle_max", duree_cycle_max1);
    localStorage.setItem("regle_irrgulier", regle_irrgulier);


}



function initParam(user){

    if($('#user-conect').val() != 1) {
        window.date_regle = localStorage.getItem("date_regle");
        window.duree_cycle = localStorage.getItem("duree_cycle");
        window.duree_ecoulement = localStorage.getItem("duree_ecoulement");
        //window.heure_notif = localStorage.getItem("heure_notif");
        window.duree_cycle_min = localStorage.getItem("duree_cycle_min1");
        window.duree_cycle_max = localStorage.getItem("duree_cycle_max1");
        regle_irrgulier = localStorage.getItem("regle_irrgulier");
    }else{
        window.date_regle = $('#ddr').val();
        window.duree_cycle = $('#dcycle').val();
        window.duree_ecoulement = $('#dseign').val();
        //window.heure_notif = localStorage.getItem("heure_notif");
        window.duree_cycle_min = $('#dmin').val();
        window.duree_cycle_max = $('#dmax').val();
        regle_irrgulier = $('#r_i').attr('isHide');
    }



    if(window.date_regle == null || window.duree_cycle == null ||
        window.duree_ecoulement == null)
    {
        var ddd = new Date();
        window.date_regle = ddd.getFullYear()+"-"+formatNumber(ddd.getMonth())+ "-01";
        window.duree_cycle = 28;
        window.duree_ecoulement = 4;
        window.duree_cycle_min = 20;
        window.duree_cycle_max = 32;
        window.heure_notif = "06:00";
    }else{
        var ddd = new Date();
        d = ddd.getFullYear()+"-"+formatNumber(ddd.getMonth())+ "-01";
        $('#ddr').val((window.date_regle == null ? d : window.date_regle));
        $('#dcycle').val((window.duree_cycle == null ? 28 : window.duree_cycle));
        $('#dseign').val((window.duree_ecoulement == null ? 4 : window.duree_ecoulement));
        $('#dmin').val((window.duree_cycle_min == null ? 20 : window.duree_cycle_min));
        $('#dmax').val((window.duree_cycle_max == null ? 32 : window.duree_cycle_max));
        $('#r_i').attr('isHide', (regle_irrgulier == null ? "true" : regle_irrgulier));
    }


}





function genererTableau()
{
    tableau = "";
    var la_date = new Date();
    var dt = new  Date(la_date.getFullYear(), la_date.getMonth()+ window.le_mois_ajouter, 1);
    var annee = dt.getFullYear();


    console.log(" -- la_date : " + la_date.getFullYear() + "-" + la_date.getMonth() + "-" +la_date.getDate());
    console.log("dt : " + dt.getFullYear() + "-" + dt.getMonth() + "-" +dt.getDate());
    console.log("window.duree_cycle : " + window.duree_cycle);
    console.log("window.date_regle : " + window.date_regle);

    le_mois = dt.getMonth();
    var prevision = calculerPrevision(dt.getFullYear(), dt.getMonth(), dt.getDate());

    console.log("*********************************************************************************************");
    console.log(prevision);
    if(dt.getDay() != 1)
    {
        //console.log(dt);
        while(dt.getDay() != 1)
        {
            dt = new Date(dt.getFullYear(), dt.getMonth(), dt.getDate() - 1);
            //console.log(dt);
            //console.log(dt.getDay());
        }
    }
    tableau = "<tr>";
    var cpt = 0;
    while(dt.getMonth() != le_mois)
    {
        while(cpt < prevision['current'].length && cmpDate(prevision['current'][cpt][0], dt) == -1 )
            cpt++;

        if(cpt < prevision['current'].length && cmpDate(prevision['current'][cpt][0], dt) == 0 ){
            tableau += '<td class="prev-month"><span class="'+prevision['current'][cpt][1]+'">' + dt.getDate() + '</span></td>';
            //console.log('<td class="prev-month '+prevision['prev'][cpt][1]+'">' + dt.getDate() + '</td>');
            cpt++;
        }else{
            tableau += '<td class="prev-month"><span class="">' + dt.getDate() + '</span></td>';
        }

        dt = new Date(dt.getFullYear(), dt.getMonth(), dt.getDate() + 1);
        //console.log(dt);
    }

    cpt = 0;
    while(dt.getMonth() == le_mois)
    {
        if(dt.getDay() == 1)
            tableau += '<tr>';

        while(cpt < prevision['current'].length && cmpDate(prevision['current'][cpt][0], dt) == -1)
            cpt++;


        if(cmpDate(la_date, dt) == 0){
            if(cpt < prevision['current'].length && cmpDate( prevision['current'][cpt][0], dt) == 0){
                tableau += '<td class="selectionner"> <span class="'+prevision['current'][cpt][1]+'">' + dt.getDate() + '</span></td>';
                //console.log('<td class="selectionner '+prevision['current'][cpt][1]+'">' + dt.getDate() + '</td>');
                cpt++;
            }else{
                tableau += '<td class="selectionner "><span>' + dt.getDate() + '</span></td>';
            }
        }else{
            if(cpt < prevision['current'].length && cmpDate( prevision['current'][cpt][0], dt) == 0){
                tableau += '<td><span class="'+prevision['current'][cpt][1]+'">' + dt.getDate() + '</span></td>';
                //console.log('<td class="'+prevision['current'][cpt][1]+'">' + dt.getDate() + '</td>');
                cpt++;
            }else{
                tableau += '<td><span>' + dt.getDate() + '</span></td>';
            }

        }
        if(dt.getDay() == 0)
            tableau += '</tr>';
        dt = new Date(dt.getFullYear(), dt.getMonth(), dt.getDate() + 1);

    }

    cpt = 0;
    //console.log(prevision['current'][cpt][1]);
    if(dt.getDay() != 1)
    {
        while(dt.getDay() != 1)
        {
            while(cpt < prevision['current'].length && cmpDate( prevision['current'][cpt][0], dt) == -1)
                cpt++;

            if(cpt < prevision['current'].length && cmpDate( prevision['current'][cpt][0], dt) == 0){
                tableau += '<td class="next-month"> <span class="'+prevision['current'][cpt][1]+'">' + dt.getDate() + '</span></td>';
                //console.log('<td class="next-month '+prevision['next'][cpt][1]+'">' + dt.getDate() + '</td>');
            }else{
                tableau += '<td class="next-month"><span>' + dt.getDate() + '</span></td>';
            }
            dt = new Date(dt.getFullYear(), dt.getMonth(), dt.getDate() + 1);
        }
        tableau += "</tr>";
    }

    //console.log(le_mois);

    $('#le_calendrier').html(tableau);
    $('#le_mois').html(window.monthList[le_mois] + " " + annee	);



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


function genererTableauPrev(aaaa, mm, dd){

    var dt_dernier = new Date(aaaa, mm, dd);
    //console.log(dt_dernier);
    var prev = [];
    prev[0] = [dt_dernier, "prev-ecoul"];
    var j = 1 ;
    for(i = 1; i < window.duree_ecoulement; i++){
        prev[j] = [new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + i), "prev-ecoul"];
        j++;
    }
    prev[j] = [new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + window.duree_cycle - 14 - 2), "prev-fille1"];
    j++;
    prev[j] = [new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + window.duree_cycle - 14 - 1), "prev-fille2"];
    j++;
    prev[j] = [new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + window.duree_cycle - 14 ), "prev-ovul event"];
    j++;
    prev[j] = [new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + window.duree_cycle - 14 + 1), "prev-gar"];
    j++;
    prev[j] = [new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + window.duree_cycle - 1), "prev-fin-cycle"];

    //console.log(prev);

    return prev;
}
function genererTableauPrev2(aaaa, mm, dd){

    console.log(" ** genererTableauPrev2 : " + aaaa + "-" + mm + "-" + dd);

    var dt_dernier = new Date(aaaa, mm, dd - this.duree_cycle);
    console.log(" ** genererTableauPrev2 : " + dt_dernier   );
    var prev = [];
    var j = 0 ;

    for(i = 0; i < window.duree_ecoulement; i++){
        prev[j] = [new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + i), "prev-ecoul"];
        j++;
    }
    window.duree_cycle = parseInt(window.duree_cycle);
    console.log(" ** genererTableauPrev2 : " + window.duree_cycle   );
    prev[j] = [new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + window.duree_cycle - 14 - 2), "prev-fille1"];
    j++;
    prev[j] = [new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + window.duree_cycle - 14 - 1), "prev-fille2"];
    j++;
    prev[j] = [new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + window.duree_cycle - 14 ), "prev-ovul event"];
    j++;
    prev[j] = [new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + window.duree_cycle - 14 + 1), "prev-gar"];
    j++;
    prev[j] = [new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + window.duree_cycle - 1), "prev-fin-cycle"];

    j++;
    dt_dernier = new Date(aaaa, mm, dd);
    for(i = 0; i < window.duree_ecoulement; i++){
        prev[j] = [new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + i), "prev-ecoul"];
        j++;
    }
    prev[j] = [new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + window.duree_cycle - 14 - 2), "prev-fille1"];
    j++;
    prev[j] = [new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + window.duree_cycle - 14 - 1), "prev-fille2"];
    j++;
    prev[j] = [new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + window.duree_cycle - 14 ), "prev-ovul event"];
    j++;
    prev[j] = [new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + window.duree_cycle - 14 + 1), "prev-gar"];
    j++;
    prev[j] = [new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + window.duree_cycle - 1), "prev-fin-cycle"];


    j++;
    dt_dernier = new Date(aaaa, mm, dd + this.duree_cycle);
    for(i = 0; i < window.duree_ecoulement; i++){
        prev[j] = [new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + i), "prev-ecoul"];
        j++;
    }
    prev[j] = [new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + window.duree_cycle - 14 - 2), "prev-fille1"];
    j++;
    prev[j] = [new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + window.duree_cycle - 14 - 1), "prev-fille2"];
    j++;
    prev[j] = [new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + window.duree_cycle - 14 ), "prev-ovul event"];
    j++;
    prev[j] = [new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + window.duree_cycle - 14 + 1), "prev-gar"];
    j++;
    prev[j] = [new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + window.duree_cycle - 1), "prev-fin-cycle"];

    //console.log(prev[1]);
    //console.log(prev);

    return prev;
}

function calculerPrevision(aaaa, mm, dd)
{
    var result = [];
    var ladate = new Date(aaaa, mm, dd);

    if(window.date_regle == "0000-00-00")
        window.date_regle = localStorage.getItem("date_regle");
    console.log(" ** window.date_regle : " + window.date_regle);
    console.log(window.date_regle + "T" + "00:00:00");
    var dt_dernier = new Date(window.date_regle + "T" + "00:00:00");
    console.log(" ** dt_dernier " + dt_dernier);
    console.log(" ** la_date : " + ladate);
    console.log(" ** la_date : " + aaaa + "-" + mm + "-" +dd);
    console.log(" ** le mois dt_dernier : " + dt_dernier.getMonth());
    console.log(" ** le mois la_date : " + ladate.getMonth());
    // l'ann?e et le mois corresponde
    if(dt_dernier.getFullYear() == ladate.getFullYear() && dt_dernier.getMonth() == ladate.getMonth()){
        result["prev"] = genererTableauPrev(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() - parseInt(window.duree_cycle));
        result["current"] = genererTableauPrev2(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate());
        result["next"] = genererTableauPrev(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + parseInt(window.duree_cycle));
        console.log(result["current"]);
    }else{
        // la dernier date est < la date courante
        while(dt_dernier.getFullYear() < ladate.getFullYear())
            dt_dernier = new Date(dt_dernier.getFullYear() + 1, dt_dernier.getMonth(), dt_dernier.getDate());
        // la dernier date est > la date courante
        while(dt_dernier.getFullYear() > ladate.getFullYear())
            dt_dernier = new Date(dt_dernier.getFullYear() - 1, dt_dernier.getMonth(), dt_dernier.getDate());
        // la dernier date est < la date courante
        while(dt_dernier.getFullYear() == ladate.getFullYear() && dt_dernier.getMonth() < ladate.getMonth()){
            console.log(" ** mod 1 dt_dernier : " + dt_dernier);
            console.log(" ** la_la la  : " + dt_dernier.getFullYear() + "-" + dt_dernier.getMonth() + "-" +(dt_dernier.getDate() * 1 + parseInt(window.duree_cycle)));
            dt_dernier = new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + parseInt(window.duree_cycle));
            console.log(" ** mod dt_dernier : " + dt_dernier);
        }
        // la dernier date est > la date courante
        while(dt_dernier.getFullYear() == ladate.getFullYear() && dt_dernier.getMonth() > ladate.getMonth())
            dt_dernier = new Date(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() - parseInt(window.duree_cycle));

        result["prev"] = genererTableauPrev(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() - parseInt(window.duree_cycle));

        console.log(dt_dernier);
        result["current"] = genererTableauPrev2(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate());
        result["next"] = genererTableauPrev(dt_dernier.getFullYear(), dt_dernier.getMonth(), dt_dernier.getDate() + parseInt(window.duree_cycle));
        console.log(result["current"]);

    }

    return result;
}

function formatNumber(num){
    return ((num < 10)? "0"+num : num);
}

function synchroniserCycleDate(){

    console.log("++ window.date_regle " + window.date_regle);
    var la_date = new Date();
    var dt = new  Date(la_date.getFullYear(), la_date.getMonth() + window.le_mois_ajouter, 1);
    var dat = new Date(window.date_regle + "T" + "00:00:00");
    console.log("++ dat " + dat);

    while(dat.getFullYear() > dt.getFullYear())
        dat = new  Date(dat.getFullYear(), dat.getMonth(), dat.getDate() - parseInt(window.duree_cycle));
    while(dat.getFullYear() < dt.getFullYear())
        dat = new  Date(dat.getFullYear(), dat.getMonth(), dat.getDate() + parseInt(window.duree_cycle));

    while(dat.getMonth() < dt.getMonth())
        dat = new  Date(dat.getFullYear(), dat.getMonth(), dat.getDate() + parseInt(window.duree_cycle));
    while(dat.getMonth() > dt.getMonth())
        dat = new  Date(dat.getFullYear(), dat.getMonth(), dat.getDate() - parseInt(window.duree_cycle));

    window.date_regle = dat.getFullYear() + "-" + formatNumber(dat.getMonth() + 1) + "-" +formatNumber(dat.getDate());



}
function updateNextTableau()
{
    window.le_mois_ajouter++;
    synchroniserCycleDate();
    genererTableau();
}
function updatePrevTableau()
{
    window.le_mois_ajouter--;
    synchroniserCycleDate();
    genererTableau();
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

function predirIrregulier(val){
    window.le_mois_ajouter = 0;
    window.duree_cycle = parseInt(val);
    synchroniserCycleDate();
    genererTableau();
}
function initialeCall(){
    //alert(window.date_regle + "---" + window.duree_cycle +"---"+window.duree_ecoulement+ "---" + window.duree_cycle_min +"---"+window.duree_cycle_max);
    window.le_mois_ajouter = 0;
    console.log("******************* initiale call [before] :  window.date_regle " + window.date_regle);
    synchroniserCycleDate();

    console.log("******************* initiale call [After] :  window.date_regle " + window.date_regle);
    genererTableau();
}

function removeSuccessMsg(){
    $("#save-param-user-msg").html('');
}

function saveToServe(){
    date_regle1 = $('#ddr').val();
    duree_cycle1 = $('#dcycle').val();
    duree_ecoulement1 = $('#dseign').val();
    //heure_notif1 = $('#heure_notif').val();
    duree_cycle_min1 = $('#dmin').val();
    duree_cycle_max1 = $('#dmax').val();
    regle_irrgulier = $('#r_i').attr('isHide');
    url = $('#path').val();
    $.ajax({
        url : url,
        type : 'post',
        data : {
            date_regle : date_regle1,
            duree_cycle : duree_cycle1,
            duree_ecoulement : duree_ecoulement1,
            duree_cycle_min : duree_cycle_min1,
            duree_cycle_max : duree_cycle_max1,
            regle_irrgulier : (regle_irrgulier == "true") ? 0 : 1
        },
        beforeSend: function() {
            $("#save-param-user-msg").html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
        },
        success : function(result, statut){
            //alert(result.status);
            if(result.status == "1"){
                $("#save-param-user-msg").html('<span>'+trans.getValue("param_update"));
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

function performPrediction(){
    var isHide = $('#r_i').attr('isHide');
    if (isHide == "true") {
        $('#cycle-irregulier').hide(800);
        window.date_regle = $('#ddr').val();
        window.duree_cycle = parseInt($('#dcycle').val());
        window.duree_ecoulement = parseInt($('#dseign').val());
        //enregistrement dans la BD
        if($('#user-conect').val() == 1){
            saveToServe();
        }

        saveParam();
        synchroniserCycleDate();
        genererTableau();


        //alert(window.date_regle + "---" + window.duree_cycle +"---"+window.duree_ecoulement);
        //window.heure_notif = "06:00";
    }else{
        window.date_regle = $('#ddr').val();
        window.duree_cycle = parseInt($('#dcycle').val());
        window.duree_ecoulement = parseInt($('#dseign').val());
        window.duree_cycle_min = parseInt($('#dmin').val());
        window.duree_cycle_max = parseInt($('#dmax').val());
        //enregistrement dans la BD
        if($('#user-conect').val() == 1){
            saveToServe();
        }
        window.duree_cycle = window.duree_cycle_min;

        code = "";
        for(i = window.duree_cycle_min; i <= window.duree_cycle_max; i++){
            if(i == window.duree_cycle_min)
                code += "<option value='"+i+"' selected> "+trans.getValue("prev_sur")+" "+i+" "+trans.getValue("day")+" </option>";
            else
                code += "<option value='"+i+"'> "+trans.getValue("prev_sur")+i+" "+trans.getValue("day")+" </option>";
        }
        $('#cycle-irregulier').html(code);
        $('#cycle-irregulier').show(800);
        saveParam();
        synchroniserCycleDate();
        genererTableau();
        //alert(window.date_regle + "---" + window.duree_cycle +"---"+window.duree_ecoulement+ "---" + window.duree_cycle_min +"---"+window.duree_cycle_max);

        //window.heure_notif = "06:00";

    }
}