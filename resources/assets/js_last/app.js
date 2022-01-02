
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

var trans = window.Translator;
var local = (window.localLang!="")?window.localLang:"fr";
    trans.setLanguage(local);
var sources = window.transDataSource;
trans.setDATA(sources);

//timer
window.moment = require('moment');
window.momentTZ = require('moment-timezone');
moment().tz("Africa/Douala");

moment.locale(local);

/*Vue.component('example', require('./components/Example.vue'));*/
/*Vue.component('subjectComment', require('./components/SubjectComment.vue'));*/

var VueFire = require('vuefire');

var Firebase = require('firebase');

// explicit installation required in module environments
Vue.use(VueFire);

//use vuefire = vuejs/firebase

var firebaseApp = Firebase.initializeApp({
    apiKey: "AIzaSyBBS6Fe-1cwppGScoWQVM72TRnAjprmt2M",
    authDomain: "intimity-183711.firebaseapp.com",
    databaseURL: "https://intimity-183711.firebaseio.com",
    projectId: "intimity-183711",
    storageBucket: "intimity-183711.appspot.com",
    messagingSenderId: "279114179969"
});
  
var db = firebaseApp.database();
var auth = firebaseApp.auth();
var user = firebaseApp.auth().currentUser;
var user_is_connected = $("#iam-gest").attr('value');
var fire_comments = db.ref('subjects/'+db_ref_firebase()+"/comments")
var fire_replies = db.ref("subjects/replies");

if (user_is_connected == "true") {

    Vue.component('comment-composer', {
        template:'<div class="comment-composer">'+
            '<textarea class="write-something" id="write-something" rows="5" placeholder="trans("lep_comment")" v-model="messageText" ></textarea>'+
            '<div class="box-typical-footer">'+
                '<div class="tbl">'+
                    '<div class="tbl-row">'+
                        '<div class="tbl-cell">'+
                            '<div class="anonime_check pull-right">'+
                                '<input type="checkbox" v-model="anonyme" value="0" id="anonime_check">'+
                                '<label for="anonime_check">trans("anonyme")</label>'+
                            '</div>'+
                        '</div>'+
                        '<div class="tbl-cell tbl-cell-action">'+
                            '<button type="submit" class="btn btn-rounded" @click="sendComment($event)">trans("sent")</button>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div>'+
        '</div>',
        data:function() {
            return {
                messageText: '',
                anonyme:0,
                connected_id:$('.user-connect').find('.id').val(),
                status_user:$("#iam-gest").attr('value')
            }
        },
        props:['comments'],
        methods:{
            trans:function(key){
                return window.trans.getValue(key);
            },
            sendComment:function(){
                var dtab = moment.utc().format().slice(0,-1).split("T");
                var dt =  dtab[0]+' '+dtab[1];
                console.log(dt);
                this.$emit('commentsent',{
                    message:this.messageText,
                    sujet_id:parseInt($('.comment-composer').parent().attr('subject-data-id')),
                    anonyme:(this.anonyme==1)?true:false,
                    created_at:dt,
                    user:{
                        login:(this.anonyme==1)?"Anomyme":$('.user-connect').find('.login').val(),
                        /*prenom:$('.user-connect').find('.firstname').val(),
                        nom:$('.user-connect').find('.lastname').val(),*/
                        id:$('.user-connect').find('.id').val(),
                        avatar:$('.user-connect').find('.avatar').val()
                    },
                    replies:[],
                    firebase_comment_id:(new Date).getTime()
                });
                this.messageText = "";
            }
        }
    });

}

    Vue.component('replies-log',{
        template:'<div class="reply-log">'+
            '<div v-if="replies.length!==0">'+
                '<Reply v-for="(_reply_,index) in replies" :connected_id=connected_id :_reply_=_reply_ :index=index :key=_reply_.id></Reply>'+
            '</div>'+
        '</div>',

        props:['replies'],

        data: function(){
            return {
                connected_id:$('.user-connect').find('.id').val()
            }
        }
    });

    Vue.component('Reply',{
        template : '<div class="Reply">'+
                        '<div class="comment-row-item quote" style="font-size: 0.91rem;">'+
                            '<div class="avatar-preview avatar-preview-32">'+
                                '<a href="#">'+
                                    '<img :src="getImagePath(_reply_.user.avatar,_reply_.anonyme)" alt="">'+
                                '</a>'+
                            '</div>'+
                            '<div class="tbl comment-row-item-header">'+
                                '<div class="tbl-row">'+
                                    '<div class="tbl-cell tbl-cell-name">{{_reply_.user.login}}</div>'+
                                    '<div class="tbl-cell tbl-cell-date">{{timeFromNow(_reply_.created_at)}}</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="comment-row-item-content">'+
                                '<p>{{_reply_.message}}</p>'+
                            '</div>'+
                        '</div>'+
                    '</div>'
                ,

        data : function(){
                return {
                message: '',
                
                user: {
                    login:"login",
                    prenom:'Kevin',
                    avatar:"photo-64-2.jpg"
                },
                datePost:"il y'a 3O min"
            }
        },
        props:['_reply_'],
        methods:{
            remove:function(reply,index){
                
                this.$delete(this.comments,index);
                
                axios.delete("/reply/"+comment.id).then(responses=>{
                    if (!responses.data.status) {
                        notie.alert(3,responses.data.motif,5);
                    }
                    else{
                        notie.alert(1,responses.data.message,5);
                    }
                });
            },

            timeFromNow:function (date) {
                let chaine = date.split(" ")[0]+'T'+date.split(" ")[1]+'Z';
                return moment(moment(chaine)
                        .tz(moment.tz.guess())
                        .format("YYYY-MM-DD HH:mm:ss"))
                        .fromNow();
            },

            reply:function(reply,index){
                console.log(comment);
            },

            likeComment:function(reply,index){
                console.log(comment);
            },

            getImagePath:function(img,anonyme) {
                if (anonyme) {
                    return $('meta[name="baseUrl"]').attr("value")+"/images/default/avatar-2-32.png";
                }
                else{
                    if (img==null || img=="") {
                    return $('meta[name="baseUrl"]').attr("value")+"/images/default/avatar-2-32.png";
                    }
                    else
                        return $('meta[name="baseUrl"]').attr("value")+"/images/avatars/thumbnails/thumb_"+img;
                }
            },

            edit:function(reply,index){
                console.log(comment);
            }
        }
    });

    Vue.component("reply-composer",{
        template: '<div class="reply-composer">'+
                    '<form class="write-message">'+
                        '<div class="avatar">'+
                            '<img :src="comment.user.avatar" alt="">'+
                        '</div>'+
                        '<div class="form-group">'+
                            '<textarea rows="4" v-model="replyTextModel" class="form-control" placeholder="trans(\'tape_reply\')"></textarea>'+
                        '</div>'+
                        '<div class="dropdown dropdown-typical dropup attach">'+
                            '<span class="lbl">'+
                                '<div class="checkbox">'+
                                    '<input type="checkbox" id="check-1" v-model="replyAnonymeModel" value="0">'+
                                    '<label for="check-1">Anonyme</label>'+
                                '</div>'+
                            '</span>'+
                        '</div>'+
                        '<button type="submit"  class="btn btn-rounded float-left" @click="sendReply($event,comment)">Send</button>'+
                    '</form>'+
                '</div>',

        props:['comment'],

        data:function(){

            return {
                replyAnonymeModel:0,
                replyTextModel:"",
                user: {
                    nom:'',
                    prenom:'',
                    avatar:"photo-64-2.jpg"
                },
                datePost:"il y'a 3O min",
                firebase_comment_id:0
            }
        },

        methods:{
            trans:function(key){
                return window.trans.getValue(key);
            },
            sendReply:function(event,comment){
                event.preventDefault();
                var dtab = moment.utc().format().slice(0,-1).split("T");
                var dt =  dtab[0]+' '+dtab[1];
                var data = {
                    message:this.replyTextModel,
                    sujet_id:parseInt($('.comment-composer').parent().attr('subject-data-id')),
                    anonyme:this.replyAnonymeModel != 0,
                    niveau:1,
                    nblike:0,
                    firebase_comment_id:comment.message.firebase_comment_id,
                    reponse_id:comment.id,
                    created_at:dt,
                    user:{
                        login:(this.replyAnonymeModel==1)?"Anomyme":$('.user-connect').find('.login').val(),
                        id:$('.user-connect').find('.id').val(),
                        avatar:$('.user-connect').find('.avatar').val()
                    }
                };

                /*var commentsChildItem = db.ref('subjects/'+$('.comment-composer').parent().attr('subject-data-id')+'/comments');*/
                var refreply = db.ref('subjects/'+$('.comment-composer').parent().attr('subject-data-id')+'/replies/'+comment.message.firebase_comment_id);
                /*db.ref('subjects/'+$('.comment-composer').parent().attr('subject-data-id')+'/comments').once('value',function (snapshot) {
                    snapshot.forEach(function (value) {
                        if(value.val().firebase_comment_id==comment.firebase_comment_id){
                            refreply = commentsChildItem.child(value.key);
                        }
                    })
                });*/


                //noinspection BadExpressionStatementJS
                axios.post($('meta[name="baseUrl"]').attr("value")+"/replies",data)
                    .then(responses=>{
                        let donnees = responses.data;
                        if (!donnees.status) {
                            notie.alert(3,data.motif,10);
                            console.log('Erreur');
                        }else{
                            refreply.push(data);
                            let reply = donnees.reply;
                            notie.alert(1,donnees.message,10);
                            $("#repliesInsertedByJquery"+comment.firebase_comment_id).append(replyBlockHtml(reply));
                            $('.nbreply_'+reply.sujet_id+"_"+comment.firebase_comment_id).text(
                                parseInt($('.nbreply_'+reply.sujet_id+"_"+comment.firebase_comment_id).text())+1
                            );
                        }
                    });

                this.replyTextModel = "";
                this.replyAnonymeModel = 0;
            },
        }
    });

    Vue.component('Comment', {
      template: '   <div class="comment">'+
            '<div class="comment-row-item">'+
                '<div class="avatar-preview avatar-preview-32">'+
                    '<a href="#">'+
                        '<img :src="comment.user.avatar" alt="">'+
                    '</a>'+
                '</div>'+
                '<div class="tbl comment-row-item-header">'+
                    '<div class="tbl-row">'+
                        /*'<div class="tbl-cell tbl-cell-name" v-if="!comment.anonyme"> <span>{{ comment.user.prenom }} {{ comment.user.nom }}</span> </div>'+*/
                        '<div class="tbl-cell tbl-cell-name"> {{ comment.user.login }} </div>'+
                        '<div class="tbl-cell tbl-cell-date">{{ timeFromNow(comment.created_at) }}</div>'+
                    '</div>'+
                '</div>'+
                '<div class="comment-row-item-content">'+
                    '<p>{{ comment.message }}</p>'+
                    '<span v-if="comment.user.id == connected_id">'+
                        /*'<button type="button" class="comment-row-item-action edit">'+
                            '<i class="font-icon font-icon-pencil"></i>'+
                        '</button>'+
                        '<button type="button" class="comment-row-item-action del" v-on:click="remove(comment,index)">'+
                            '<i class="font-icon font-icon-trash"></i>'+
                        '</button>'+*/
                    '</span>'+
                    //'<replies-log v-if="comment.replies!=undefined" :replies=comment.replies></replies-log>'+
                    /*block replies inserted by jquery after created on database*/
                    //'<div :id="identifyedGeneratorReply(\'repliesInsertedByJquery\',comment.id)"></div>'+
                    /*end jquery inserting*/
                    /*composer reply*/
                    //'<div class="chat-area-bottom" :id="identifyedGeneratorReply(\'replyReponseComposer\',comment.id)" style="display:none;">'+
                    //    '<reply-composer :comment=comment></reply-composer>'+
                    //'</div>'+
                    /*end composer reply*/
                '</div>'+
                /*'<div class="comment-item-meta">'+
                    '<a href="#" class="star" style="margin-right:12px" v-on:click="likeComment(comment,index)">'+
                        '<i class="fa fa-thumbs-up fa-1x" style="font-size: 1em;"></i>'+
                        '(<i style="font-size: 0.8em;">{{comment.nblike}}</i>)'+
                    '</a>'+
                    '<a href="#" v-on:click="reply($event,comment,index)">'+
                        '<i style="font-size: 0.9em;">Reply</i>'+
                    '</a>'+
                '</div>'+*/
            '</div>'+
        '</div>',

      
        props:['comment','index','comments','connected_id'],

        methods:{
            trans:function(key){
                return window.trans.getValue(key);
            },
            identifyedGeneratorReply:function(prefix,id_response){
                return prefix+id_response;
            },

            replyCountItemGeneratorClassName:function (s,r) {
                return "nbreply_"+s+"_"+r;
            },
            timeFromNow:function (date) {
                console.log(date.split(" ")[0]+'T'+date.split(" ")[1]+'Z');

                let chaine = date.split(" ")[0]+'T'+date.split(" ")[1]+'Z';
                return moment(moment(chaine)
                        .tz(moment.tz.guess())
                        .format("YYYY-MM-DD HH:mm:ss"))
                        .fromNow();
            },

            remove:function(comment,index){
                
                this.$delete(this.comments,index);
                
                axios.delete("/reponses/"+comment.id).then(responses=>{
                    if (!responses.data.status) {
                        notie.alert(3,responses.data.motif,5);
                    }
                    else{
                        notie.alert(1,responses.data.message,5);
                    }
                });
            },

            reply:function(event,comment,index){
                event.preventDefault();

                if(!$("#replyReponseComposer"+comment.id).is(':visible'))
                    $("#replyReponseComposer"+comment.id).show();
                else
                    $("#replyReponseComposer"+comment.id).hide();
            },

            likeComment:function(comment,index){
                console.log(comment);
            },

            edit:function(comment,index){
                console.log(comment);
            }
        },

        data: function(){
            return {
                message: '',
                replyAnonymeModel:0,
                replyTextModel:"",
                subjectId:parseInt($('.comment-composer').parent().attr('subject-data-id')),
                user: {
                    nom:'',
                    prenom:'',
                    avatar:"photo-64-2.jpg"
                },
                datePost:"il y'a 3O min",

                componentsArray:['reply-composer'],
            }
        }
    })
    Vue.component('comment-log', {
        template:'  <div class="comment-log">'+
          '<Comment v-for="(comment,index) in comments" :connected_id=connected_id :comments="comments" :comment="comment" :index=index :key="comment.id"></Comment>'+
          '<div class="empty" v-show="comments.length === 0">'+
          '</div>'+
      '</div>',

      props:['comments'],

      data: function(){
        return {
            connected_id:$('.user-connect').find('.id').val()
        }
      }

    });

    ///-----------------------------------------------------///

    const app = new Vue({

        data : {
            comments:[],
            replies:[],
            connected_id:$('.user-connect').find('.id').val(),
            user_connect_fuid:$('.user-connect').find('.fuid').val(),
            user_connect_email : $('.user-connect').find('.email').val(),
            user_connect_pf : $('.user-connect').find('.passfire').val()
        },

        firebase : {
            anArray: db.ref('subjects/'+db_ref_firebase()+"/comments").limitToLast(150),
        },
        methods:{
            addComment:function(comment){
                var user_connect_pf = $('.user-connect').find('.passfire').val();
                var user_connect_fuid = $('.user-connect').find('.fuid').val();
                var user_connect_email = $('.user-connect').find('.email').val();
               // '/messages/'+this.sujet.user.fuid+'/'+this.sujet.id

                //a remettre plus tard que la connexion sera reetablie
                /*auth.onAuthStateChanged(function(user){
                    if (user!=null) {
                        true; 
                    }else{
                        siginUser(user_connect_email,user_connect_pf);
                    }
                });*/

                this.$firebaseRefs.anArray.push({message:comment});

                axios.post($('meta[name="baseUrl"]').attr("value")+'/reponses',comment).then(responses=>{
                     
                    if (!responses.data.status) {
                        notie.alert(3,responses.data.motif,10);
                        console.error('Erreur');
                    }else{
                         notie.alert(1,responses.data.message,10);
                         console.log(responses.data);
                         $('.nbcomment_'+responses.data.reponse.sujet_id).text(this.comments.length);
                    }

                });

/*                if (userIsConnect()==false) {
                    haveFuid($('.user-connect').find('.fuid').val());
                }
                //this.$firebaseRefs.anArray.push(comment);
                
                axios.post($('meta[name="baseUrl"]').attr("value")+'/reponses',comment).then(responses=>{
                     
                    if (!responses.data.status) {
                        notie.alert(3,responses.data.motif,5);
                        console.log('Erreur');
                    }else{
                        this.comments.push(responses.data.reponse);
                        notie.alert(1,responses.data.message,5);
                    }

                });*/
            },

            addReply:function(reply){
                axios.post($('meta[name="baseUrl"]').attr("value")+"/replies",reply)
                    .then(responses=>{
                        if (!responses.data.status) {
                        notie.alert(3,responses.data.motif,10);
                        console.log('Erreur');
                    }else{
                        notie.alert(1,responses.data.message,10);
                        console.log(responses.data);
                        $('.nbreplay_'+responses.data.reply.sujet_id+"_"+responses.data.reply.reponse_id).text(this.replies.length);
                    }
                });
            }
        },
        created(){
            let sujet_id = $('input.subject-id').val();
            var array_onready=[];
            var array_onchild_add = [];
            /*if ($("#iam-gest").attr('value')=="false") {

                axios.get($('meta[name="baseUrl"]').attr("value")+'/reponses?sujet='+sujet_id).then(responses=>{

                    for (var i = 0; i < responses.data.length; i++) {
                        array.push(responses.data[i]);
                    }
                });
            } else {*/
                //a remettre plus tard que la connexion sera reetablie
                //siginUser(this.user_connect_email, this.user_connect_pf);
                /*var repref = db.ref('subjects/'+db_ref_firebase()+'/comments');*/
                fire_comments.once('value', function(snapshot) {
                    snapshot.forEach(function(childSnapshot) {
                        var childKey = childSnapshot.key;
                        var childData = childSnapshot.val();
                        var replies=[];
                        console.log("childData",childData);
                        //-----------------retrieve replies on firebase-------------//

                        db.ref('subjects/'+db_ref_firebase()+"/replies/"+childData.message.firebase_comment_id).once("value",
                            function (snapshots) {
                                snapshots.forEach(function (reply) {
                                    replies.push(reply.toJSON());
                                })
                            }
                        );
                        var input_to_push={
                            message:childData.message.message,
                            sujet_id:childData.message.sujet_id,
                            anonyme:childData.message.anonyme,
                            created_at:childData.message.created_at,
                            firebase_comment_id:childData.message.firebase_comment_id,
                            id:childData.message.firebase_comment_id,
                            user:{
                                /*prenom:childData.user.prenom,
                                nom:childData.user.nom,*/
                                id:childData.message.user.id,
                                login:login:getUserLogin(childData.message.anonyme,childData.message.user.login),
                                avatar:getImagePath(childData.message.user.avatar,childData.message.anonyme)
                            },
                            replies:replies
                        };
                        array_onready.push(input_to_push);
                    });
                });
                
                fire_comments.on("child_added", function(snapshot, prevChildKey) {
                    var childData = snapshot.val();
                    var input_to_push={
                        message:childData.message.message,
                        sujet_id:childData.message.sujet_id,
                        anonyme:childData.message.anonyme,
                        created_at:childData.message.created_at,
                        firebase_comment_id:childData.message.firebase_comment_id,
                        id:childData.message.firebase_comment_id,
                        user:{
                            /*prenom:childData.user.prenom,
                            nom:childData.user.nom,*/
                            id:childData.message.user.id,
                            login:getUserLogin(childData.message.anonyme,childData.message.user.login),
                            /*id:$('.user-connect').find('.id').val(),*/
                            avatar:getImagePath(childData.message.user.avatar,childData.message.anonyme)
                        }
                    };
                    //a revoir le plutot possible et decommenter
                    array_onchild_add.push(input_to_push);
                });
            //}

            
                this.comments = array_onready;
            
                this.comments = array_onchild_add;

            //this.comments = array;

/*            fire_replies.child($('.comment-composer').parent().attr('subject-data-id'))
                .on("child_added",function (snapshot, prevChildKey) {
                    let comments = snapshot.val();
                    snapshot.child()
                    console.log('COMMENTS=>['+snapshot.key+']',comments);

                    comments.forEach(function (childReplySnapshots) {
                        let comment = childReplySnapshots.val();
                        let comment_id = comment.id;
                        console.log('COMMENT=>['+childReplySnapshots.key+']',comment);
                        let replies = childReplySnapshots.child(comment_id);
                        replies.forEach(function (snapshots) {
                            console.log('Reply=>['+snapshots.key+']',snapshots.val());
                        })
                    })
                });*/
/*           db.ref('subjects/replies/'+sujet_id).once("value",function (snapshot) {
                snapshot.forEach(function (repliesSnapshot) {
                    console.log("replies2["+repliesSnapshot.key+"]",repliesSnapshot.val());
                    repliesSnapshot.forEach(function (replySnapshot) {
                        console.log("reply["+replySnapshot.key+"]",replySnapshot.val());
                    })
                })
            });*/

            db.ref('subjects/'+db_ref_firebase()+"/replies")
            /*.endAt()*/
            .limitToLast(1)
            .on("child_added",function (snapshot) {
                
                snapshot.forEach(function (repliesSnapshot) {
                    let reply = repliesSnapshot.val();
                

                    if($('.user-connect').find('.id').val()!=reply.user.id){
                        reply.user.avatar = getImagePath(reply.user.avatar,reply.user.anonyme);
                        $("#repliesInsertedByJquery"+reply.firebase_comment_id).append(replyBlockHtml(reply));
                        $('.nbreply_'+reply.sujet_id+"_"+reply.firebase_comment_id).text(
                            parseInt($('.nbreply_'+reply.sujet_id+"_"+reply.firebase_comment_id).text())+1
                        );
                    }
                })
            });
/*            fire_replies.ref($('.comment-composer').parent().attr('subject-data-id'))
                .once("value",function (snapshot) {
                    let comments = snapshot.val();
                    snapshot.child()
                    console.log('COMMENTS=>['+snapshot.key+']',comments);

                    comments.forEach(function (childReplySnapshots) {
                        let comment = childReplySnapshots.val();
                        let comment_id = comment.id;
                        console.log('COMMENT=>['+childReplySnapshots.key+']',comment);
                        let replies = childReplySnapshots.child(comment_id);
                        replies.forEach(function (snapshots) {
                            console.log('Reply=>['+snapshots.key+']',snapshots.val());
                        })
                    })
                });*/
        }  
    }).$mount('#app');

    function db_ref_firebase() {
        let id = $('input.subject-id').val();

        return id;
        
    }
    //---------------------------------//
    function haveFuid(fuid) {
        let sender_email = $('.user-connect').find('.email').val();
        let sender_passfire = $('.user-connect').find('.passfire').val()
        
        if (/*fuid!=null || fuid!=undefined || */fuid!="") {
            console.log('signinuser:');
            let resp = siginUser(sender_email, sender_passfire);
            if (resp) { return true; }
                else { return false; }

        }else{
           
            createAccountFirebase(sender_email,sender_passfire);
        }
    }

    function siginUser(email,passfire){

        auth.signInWithEmailAndPassword(email,passfire).then(response=>{
            console.log('ok_signinuser:'+response);
            return true;
        }).catch(error=>{
            console.log(error);
            return false;
        });

    }

    function createAccountFirebase(email,passfire) {

        auth.createUserWithEmailAndPassword(email,passfire).then(response=>{
            
            auth.signInWithEmailAndPassword(email,passfire).then(response=>{
                console.log('ok_signinuser_firebase:'+response);
                updateUserFuidInDB();
                return true;
            }).catch(error=>{
                console.log("error_signInWithEmailAndPassword:"+error);
                return false;
            });
        }).catch(error=>{
            console.log('error_createUserWithEmailAndPassword:'+error);
            return false;
        });
    }

    function thisDateMoreThanOneDay(datetime) {
        let diff = moment().diff(datetime,'days');
        if (diff = 1) {
            return "hier à "+moment().format("HH:mm");
        }else if(diff > 1){
            return moment(datetime).format("LLLL");
        }else{
            return moment().format("HH:mm");
        }
    }

    function getImagePath(img,anonyme) {
        if (anonyme) {
            return $('meta[name="baseUrl"]').attr("value")+"/images/default/avatar-2-32.png";
        }
        else{
            if (img==null || img=="") {
                return $('meta[name="baseUrl"]').attr("value")+"/images/default/avatar-2-32.png";
            }
            else
                return $('meta[name="baseUrl"]').attr("value")+"/images/avatars/thumbnails/thumb_"+img;
        }
    }
    /*function userIsConnect(){


        
        if (user!=null) {
            return true;
        }else{
            return false;
        }
    }
    */
    function userIsConnect(){

        var resp=false;

        auth.onAuthStateChanged(function(user){
            console.log(user.uid);
            if (user!=null) {
                 resp=true;
            }else{
                resp=false;
            }
            console.log("__"+resp);
        });
        return resp;
    }

    function getFuid(){
        return auth.currentUser.uid;
    }

    function updateUserFuidInDB(){
        let fuid=getFuid();
        axios.post('user/update_fuid/'+fuid).then(response=>{
            if(response.statut==false)
                console.log(response);
            else
                console.log(response);
        },error=>{
            console.log(error);
        })
    }

    function updateUserPassFireInDB(passfire){
        
        axios.post('user/update_passfire/'+passfire).then(response=>{
            if(response.statut==false)
                console.log(response);
            else
                console.log(response);
        },error=>{
            console.log(error);
        })
    }
    
    function getUserLogin(anonymat,loginValue){
        if(!anonymat){
            return loginValue;
        }else{
            return "Anonyme";
        }
    }

    function replyBlockHtml(reply) {
        let photoPath = getImagePath(reply.user.avatar,reply.anonyme);

        return '<div class="comment-row-item quote" style="font-size: 0.91rem;">'+
            '<div class="avatar-preview avatar-preview-32">'+
                '<a href="#">'+
                    '<img src="'+reply.user.avatar+'" alt="">'+
                '</a>'+
            '</div>'+
            '<div class="tbl comment-row-item-header">'+
                '<div class="tbl-row">'+
                    '<div class="tbl-cell tbl-cell-name">'+reply.user.login+'</div>'+
                    '<div class="tbl-cell tbl-cell-date">'+reply.created_at+'</div>'+
                '</div>'+
            '</div>'+
            '<div class="comment-row-item-content">'+
                '<p>'+reply.message+'</p>'+
            '</div>'+
        '</div>';
    }


