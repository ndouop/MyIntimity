require('./bootstrap');
window.Vue = require('vue');

///scrollable
import VueChatScroll from 'vue-chat-scroll';
Vue.use(VueChatScroll);
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
/*
* firebase instanciation
*/
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
    }
);
var db = firebaseApp.database();
var auth = firebaseApp.auth();
var user = firebaseApp.auth().currentUser;
var fire_messages = db.ref('chat/'+bd_ref_firebase());
var backFromFirebase=false;

Vue.component('global', {
  template: '<h5>A message from the global component</h5>'
});

Vue.component('chat-composer',{
    template:''+
        '<form class="write-message">'+
            '<div class="form-group">'+
                '<textarea rows="1" class="form-control" v-model="messageText" v-on:keyup.enter="sendMessage" placeholder="trans(\'tap_mess\')"></textarea>'+
                '<div class="dropdown dropdown-typical dropup attach">'+
                    '<a class="dropdown-toggle dropdown-toggle-txt"'+
                       'id="dd-chat-attach"'+
                       'data-target="#"'+
                       'data-toggle="dropdown"'+
                       'aria-haspopup="true"'+
                       'aria-expanded="false">'+
                        '<span class="font-icon fa fa-file-o"></span>'+
                    '</a>'+/*
                    '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-chat-attach">'+
                        '<a class="dropdown-item" href="#"><i class="font-icon font-icon-cam-photo"></i>Photo</a>'+
                        '<a class="dropdown-item" href="#"><i class="font-icon font-icon-cam-video"></i>Video</a>'+
                        '<a class="dropdown-item" href="#"><i class="font-icon font-icon-sound"></i>Audio</a>'+
                        '<a class="dropdown-item" href="#"><i class="font-icon font-icon-page"></i>Document</a>'+
                        '<a class="dropdown-item" href="#"><i class="font-icon font-icon-earth"></i>Map</a>'+
                    '</div>'+*/
                '</div>'+
            '</div>'+
        '</form>',
    data:function(){
        return {
            messageText:'',
            receiver:parseInt($('.span-container-receiver-id').attr('data-receiver-id'))
        }
    },

    props:['messages'],
    methods:{            
        trans:function(key){
            return window.trans.getValue(key);
        },
        sendMessage:function(){
            if (this.messageText.length==0) {
                return false;
            }else{
                this.$emit('messagesent',{
                    message:this.messageText.trim(),
                    receiver_id:this.receiver,
                    /*messageForSender:true,*/
                    IAmReceiver:true,
                    hour:moment.utc().format()
                });
            }

            this.messageText="";
        }
    }
});


Vue.component('message',{
    template:'<div class="__message__">'+
                '<div v-if="message.IAmReceiver" class="_float-right">'+
                    '<div class="messenger-message-container from bg-blue pull-right" :title="timeFromNow(message.hour)">'+
                        '<div class="messages bulbe-right pull-right">'+
                            '<div class="message message-receiver pull-right">'+
                                '<div class=" pull-right">'+
                                    '{{message.message}}'+
                                '</div>'+
                            '</div>'+
        /*'<div class="time-ago from" style="color:blue">{{}}</div>'+*/
                        '</div>'+
                    '</div>'+
                '</div>'+
                '<div v-else class="_float-left">'+
                    '<div class="messenger-message-container pull-left" :title="timeFromNow(message.hour)">'+
                        '<div class="avatar  pull-left">'+
                            '<img :src="getAvatarReceiver()">'+
                        '</div>'+
                        '<div class="messages bulbe-left  pull-left">'+
                            '<div class="message message-sender">'+
                                '<div class="pull-left">'+
                                    '{{message.message}}'+
                                '</div>'+
                            '</div>'+
        /*'<div class="time-ago">{{message.hour}}</div>'+*/
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div>',

    props:['message'],

    methods:{
        timeFromNow:function (date) {
            let dt = moment(date).tz(moment.tz.guess()).format("YYYY-MM-DD HH:mm:ss")
            return moment(dt,"YYYY-MM-DD hh:mm:ss").fromNow();
        },
        getAvatarReceiver:function(){
            let avatar = $(".data-receiver-avatar").attr("value");
            if (avatar == "")
                return $('meta[name="baseUrl"]').attr("value")+"/images/default/avatar-2-32.png";
            else
                return $('meta[name="baseUrl"]').attr("value")+"/images/avatars/thumbnails/thumb_"+avatar;
                
        }
    },

    data:{
        receiver_id:parseInt($('.span-container-receiver-id').attr('data-receiver-id')),
        sender_id:$('.span-container-sender-id').attr('data-sender-id')
    }

});

Vue.component('chat-log', {
    template:'  '+
    '<div class="chat-log">'+
      '<message v-for="(message,index) in messages" :message="message" :key="message.id"></message>'+
      '<div class="empty" v-show="messages.length === 0">'+
      '</div>'+
    '</div>',

  props:['messages']
});


const chat = new Vue({

    data : {
        messages:[],
        receiver_id:parseInt($('.span-container-receiver-id').attr('data-receiver-id')),
        sender_id:$('.span-container-sender-id').attr('data-sender-id')
    },

    firebase : {
        anArray: db.ref('chat/'+bd_ref_firebase()).limitToLast(50),  
    },

    methods:{
        sendMessage(message){

            //this.messages.push(message);
           /* axios.post('/messages',message).then(responses=>{
                 
                if (!responses.data.status) {
                    toastr.error(responses.data.motif);
                    console.log('Erreur');
                }else{
                    this.messages.push(message);
                    //toastr.success(responses.data.message);
                }

            });*/

            if (userIsConnect()==false) {
                haveFuid($('.data-sender-fuid').attr('value'));
            }/*
            if (chatPageIsMounted()) {
                console.log("ok");
            }*/else{
                console.log("ko");
            }
            this.$firebaseRefs.anArray.push(message);
            this.messages.push(message);
            
            axios.post('/messages',message).then(responses=>{
                if (!responses.data.status) {
                    notie.alert(3,responses.data.motif,10);
                    console.log('Erreur');
                }else{
                    //this.messages.push(message);
                    //toastr.success(responses.data.message);
                }
            });  
        },

        getHourForDate:function(date){
            return ;
        },

        isMessageOfSender(id_sender){
            var user_id_connect = parseInt($('.span-container-sender-id').attr('data-sender-id'));

            if (user_id_connect == id_sender) {
                return true;
            }
            else
                return false;
            
        }/*,
        scrollToEnd: function() {       
            var container = this.$el.querySelector(".scrollable-block");
                container.scrollTop = container.scrollHeight;
        }*/
    },
    created(){

        if (!userIsConnect()) {
            /*siginUser($('.data-sender-email').attr('value')
                ,$('.data-sender-passfire').attr('value'));*/;

        }

        /*axios.get('/messages?receiver_id='+this.receiver_id).then(responses=>{
            var input_to_push= [];
            var array = [];
            $.each(responses.data,function(index,value){
                input_to_push = {
                    message:value.message,
                    hour:moment(value.created_at, "YYYY-MM-DD hh:mm:ss").fromNow(),
                    messageForSender:isMessageOfSender(this.sender_id),
                    avatar:$('.span-container-receiver-id').find('.data-receiver-avatar').attr('value')
                };
                
                array.push(input_to_push);
            });
            this.messages = array;
        });*/

        var input_to_push= [];
        var array = [];
        var _sender_ = parseInt($('.span-container-sender-id').attr('data-sender-id'));
        var _receiver_ = parseInt($('.span-container-receiver-id').attr('data-receiver-id'));
        fire_messages.once('value', function(snapshot) {
          snapshot.forEach(function(childSnapshot) {
            var childKey = childSnapshot.key;
            var childData = childSnapshot.val();
            input_to_push = {
                receiver_id:childData.receiver_id,
                message:childData.message,
                hour:childData.hour,
                /*messageForSender:childData.messageForSender,*/
                IAmReceiver:(childData.receiver_id!=_sender_)?true:false,
                avatar:$('.span-container-receiver-id').find('.data-receiver-avatar').attr('value')
            };
            array.push(input_to_push);
          });
            window.backFromFirebase = true;

        });


        fire_messages.on("child_added", function(snapshot, prevChildKey) {
            if(window.backFromFirebase){
                var newMessage = snapshot.val();
                input_to_push = {
                    receiver_id:newMessage.receiver_id,
                    message:newMessage.message,
                    hour:newMessage.hour,
                    IAmReceiver:false,
                    avatar:getAvatarReceiver()
                };

                if($('.span-container-sender-id').attr('data-sender-id') == newMessage.receiver_id)
                    array.push(input_to_push);
            }

        });
        this.messages = array;

    },
    ready: function() {    
       console.log('First');
       setTimeout(function() {
         console.log('Seconds');
       }, 100);
    }

}).$mount('#chat-room');

window.Chat = chat;  

function isMessageOfSender(id_sender){
    var user_id_connect = parseInt($('.span-container-sender-id').attr('data-sender-id'));

    if (user_id_connect == id_sender) {
        return true;
    }
    else
        return false;   
}

function haveFuid(fuid) {
    let sender_email = $('.data-sender-email').attr('value');
    let sender_passfire = $('.data-sender-passfire').attr('value')
    if (fuid!=null || fuid!=undefined) {
        console.log('signinuser:');
        let resp = siginUser(sender_email, sender_passfire);
        if (resp) { return true; }
            else { return false; }

    }else if (fuid==null || fuid==undefined) {
        console.log('create:');
        createAccountFirebase(sender_email,sender_passfire);
    }else
        return true;
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
        console.log('ok_ctrateuser:'+response);
        auth.signInWithEmailAndPassword(email,passfire).then(response=>{
            console.log('ok_signinuser:'+response);
            updateUserInDB();
            return true;
        },error=>{
            return false;
        });
    },error=>{
        return false;
    })
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

function getAvatarReceiver(){
    var avatar = $(".data-receiver-avatar").attr("value");
    if (avatar == "") {
        return getImagePath(null);
    }else
        return getImagePath(avatar);
}

function getImagePath(img) {
    
    if (img==null) {
        return $('meta[name="baseUrl"]').attr("value")+"/images/default/avatar-2-32.png";
    }
    else
        return $('meta[name="baseUrl"]').attr("value")+"/images/avatars/thumbnails/thumb_"+img;
}

function bd_ref_firebase() {
    let user_1 = parseInt($('.span-container-sender-id').attr('data-sender-id'));
    let user_2 = parseInt($('.span-container-receiver-id').attr('data-receiver-id'));

    if (user_1>user_2) {
        return user_2.toString()+'_'+user_1.toString();
    }else
        return user_1.toString()+'_'+user_2.toString();
 }

function userIsConnect(){
    console.log(user);
    if (user!=null) {
        return true;
    }else{
        return false;
    }
}

function getFuid(){
    return auth.currentUser.uid;
}

function updateUserInDB(){
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

function getTimeZone() {
  var offset = new Date().getTimezoneOffset(), o = Math.abs(offset);
  return (offset < 0 ? "+" : "-") + ("00" + Math.floor(o / 60)).slice(-2) + ":" + ("00" + (o % 60)).slice(-2);
}
