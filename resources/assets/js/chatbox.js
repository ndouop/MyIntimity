require('./bootstrap');

window.Vue = require('vue');
window.moment = require('moment');

moment.locale('en');
/*
* firebase instanciation
*/
var VueFire = require('vuefire');

var Firebase = require('firebase');

// explicit installation required in module environments
Vue.use(VueFire);

//use vuefire = vuejs/firebase

var firebaseApp = Firebase.initializeApp({
        /*apiKey: "AIzaSyC-hGd6ww5RdhAI5tgX-gauxDz-W9MuLIc",
        authDomain: "intimity-4e835.firebaseapp.com",
        databaseURL: "https://intimity-4e835.firebaseio.com",
        storageBucket: "intimity-4e835.appspot.com",
        messagingSenderId: "259599804095"*/
        apiKey: "AIzaSyArINd-sPHadpOXOzruiip1tXc-ZFphJZA",
        authDomain: "nivekafirebase.firebaseapp.com",
        databaseURL: "https://nivekafirebase.firebaseio.com",
        projectId: "nivekafirebase",
        storageBucket: "nivekafirebase.appspot.com",
        messagingSenderId: "457290517797"
    }
);
var db = firebaseApp.database();
var auth = firebaseApp.auth();
var user = firebaseApp.auth().currentUser;
var fire_messages = db.ref('chat/'+bd_ref_firebase());

Vue.component('chat-composer',{
	template:''+
		''+
            '<textarea rows="2" class="form-control" v-model="messageText" v-on:keyup.enter="sendMessage" placeholder="Entrez votre message ici ..."></textarea>'+
        '',
    data:function(){
    	return {
    		messageText:'',
    		receiver:parseInt($('.span-container-receiver-id').attr('data-receiver-id'))
    	}
    },

    props:['messages'],
    methods:{
    	sendMessage:function(){
            console.log("1============");
            if (this.messageText.length==0) {
                return false;
            }else{
                this.$emit('messagesent',{
                    message:this.messageText,
                    receiver_id:this.receiver,
                    messageForSender:true,
                    //hour:moment(moment(), "YYYY-MM-DD hh:mm:ss").fromNow()
                    hour:moment().format('Y-m-d H:m:s')
                });
            }

    		this.messageText="";
    	}
    }
});

Vue.component('message',{
	template:'<div class="__message__">'+
				'<div class="clearfix" :title="message.hour">'+
                    '<div v-if="message.messageForSender">'+
                        '<div class="chat-message-content speech-bubble-right clearfix">'+
                            '<p>{{message.message}}</p>'+
                        '</div>'+       
                        /*'<span class="chat-time-right">{{message.hour}}</span>'+*/
                    '</div>'+
                    '<div v-else>'+
                        '<div class="avatar chat-list-item-photo">'+
                            '<img :src="message.avatar" class="avatar-thumb-forum-subject">'+
                        '</div>'+
                        '<div class="chat-message-content speech-bubble-left clearfix">'+
                            '<p>{{message.message}}</p>'+
                        '</div>'+       
                        /*'<span class="chat-time-left">{{message.hour}}</span>'+*/
                    '</div>'+
                '</div>'+
		    '</div>',

	props:['messages'],
	props:['message'],

	methods:{

	},

});

Vue.component('chat-log', {
    template:'  '+
    '<div class="chat-log">'+
      '<message v-for="(message,index) in messages" :message="message" :key="message.id"></message>'+
      '<div class="empty">'+
        '<div style="font-style:italic">Aucun message</div>'+
      '</div>'+
  	'</div>',

  props:['messages']
});

Vue.component('live-chat-box',{
    template:'<div class="live-chat">'+
        '<div v-if="receiver.length===0"></div>'+
        '<div v-else id="live-chat">'+
            '<span class="span-container-receiver-id" :data-receiver-id="receiver.id">'+
                '<span class="data-receiver-name" :value="receiver.prenom"></span>'+
                '<span class="data-receiver-avatar" :value="receiver.avatar"></span>'+
                '<span class="data-receiver-login" :value="receiver.login"></span>'+
            '</span>'+      
            '<header class="clearfix">'+           
                '<a href="#" class="chat-close">x</a>'+
                '<h4>{{receiver.login}}</h4>'+
                '<span class="chat-message-counter">3</span>'+
            '</header>'+
            '<div class="chat"> '+    
                '<div class="chat-history">'+
                    '<div class="previous-messages-history"></div>'+
                    /*'<chat-log :messages="messages"></chat-log>'+*/
                    '<div class="empty" v-if="messages.length === 0">'+
                        '<div style="font-style:italic">Aucun message</div>'+
                    '</div>'+
                    '<div v-else>'+
                        '<div v-for="(message,index) in messages">'+
                            '<div class="clearfix" :title="message.hour">'+
                                '<div v-if="message.messageForSender">'+
                                    '<div class="chat-message-content speech-bubble-right clearfix">'+
                                        '<p>{{message.message}}</p>'+
                                    '</div>'+       
                                    /*'<span class="chat-time-right">{{message.hour}}</span>'+*/
                                '</div>'+
                                '<div v-else>'+
                                    '<div class="avatar chat-list-item-photo">'+
                                        '<img :src="message.avatar" class="avatar-thumb-forum-subject">'+
                                    '</div>'+
                                    '<div class="chat-message-content speech-bubble-left clearfix">'+
                                        '<p>{{message.message}}</p>'+
                                    '</div>'+       
                                    /*'<span class="chat-time-left">{{message.hour}}</span>'+*/
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div> <!-- end chat-history -->'+
                '<form action="#" method="post" class="chat-form">'+
                    '<fieldset>                  '+
                        '<chat-composer v-on:messagesent="sendMessage"></chat-composer>'+ /*
                        '<textarea rows="2" class="form-control" v-model="message.messageText" v-on:keyup.enter="sendMessage" placeholder="Entrez votre message ici ..."></textarea>'+
                        */'<input type="hidden">'+
                    '</fieldset>'+
                '</form>'+
                '<div class="chat-option">'+
                    '<i class="fa fa-file-image-o" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;&nbsp;'+
                    '<i class="fa fa-meh-o" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;&nbsp;'+ 
                    '<i class="fa fa-thumbs-o-up" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;&nbsp;'+ 
                '</div> '+
            '</div>'+
        '</div>'+
    '</div>',

    //props:['receiver','messages','message'],
    props:{
        receiver:{
            type:Array,
            requerd:true
        },
        messages:{
            type:Array,
            required:true
        }/*,
        message:[String,Object,Array]*/
    },

    data:function(){
        return {
            messageText:'',
            receiver:parseInt($('.span-container-receiver-id').attr('data-receiver-id'))
        }
    },

    props:['messages'],
    methods:{
        sendMessage:function(){
            console.log("2============");
            if (this.messageText.length==0) {
                return false;
            }else{
                this.$emit('messagesent',{
                    message:this.messageText,
                    receiver_id:this.receiver,
                    messageForSender:true,
                    //hour:moment(moment(), "YYYY-MM-DD hh:mm:ss").fromNow()
                    hour:moment().format('Y-m-d H:m:s')
                });
            }

            this.messageText="";
        }
/*
        sendMessage(message){

            if (userIsConnect()==false) {
                haveFuid($('.data-sender-fuid').attr('value'));
            }
            this.$firebaseRefs.anArray.push(message);
            this.messages.push(message);
            axios.post('/messages',message).then(responses=>{
                if (!responses.data.status) {
                    toastr.error(responses.data.motif);
                    console.log('Erreur');
                }else{
                    //this.messages.push(message);
                    //toastr.success(responses.data.message);
                }
            });       

        },*/
    }
});

const chat = new Vue({
    data : {
        messages:[],
        box:"",
        receiver_id:parseInt($('.span-container-receiver-id').attr('data-receiver-id')),
    	sender_id:$('.span-container-sender-id').attr('.data-sender-id'),
        receiver:/*{
            id:0,
            nom:"",
            prenom:"",
            login:"",
            fuid:"",
            passfire:"",
            avatar:"",
            email:""
        }*/[]
    },

    firebase : {
        anArray: db.ref('chat/'+bd_ref_firebase()).limitToLast(20),  
    },

    methods:{
    	sendMessage(message){

            if (userIsConnect()==false) {
                haveFuid($('.data-sender-fuid').attr('value'));
            }
            this.$firebaseRefs.anArray.push(message);
            this.messages.push(message);
            axios.post('/messages',message).then(responses=>{
                if (!responses.data.status) {
                    toastr.error(responses.data.motif);
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

        getBox:function(r_id){
            var receiver_=[];
            axios.get('getBox/'+r_id).then(response=>{
                receiver_.id = response.data.id;
                receiver_.nom = response.data.nom,
                receiver_.prenom = response.data.prenom,
                receiver_.fuid = response.data.fuid,
                receiver_.passfire = response.data.passfire,
                receiver_.avatar = response.data.avatar
            });

            this.receiver.push(receiver_);
            console.log(this.receiver);
            console.log(this.receiver.length);
        },

	    isMessageOfSender(id_sender){
	    	var user_id_connect = parseInt($('.span-container-sender-id').attr('data-sender-id'));

	    	if (user_id_connect == id_sender) {
	    		return true;
	    	}
	    	else
	    		return false;
	    	
	    }
	},
    created(){
        console.log('created');
        this.receiver = [];

        if (fire_messages==null || fire_messages.length == 0) {
            axios.get('/messages?receiver_id='+this.receiver_id).then(responses=>{
                var input_to_push= [];
                var array = [];
                $.each(responses.data,function(index,value){
                    input_to_push = {
                        message:value.message,
                        //hour:moment(value.created_at, "YYYY-MM-DD hh:mm:ss").fromNow(),
                        hour:thisDateMoreThanOneDay(value.created_at),
                        messageForSender:isMessageOfSender(this.sender_id),
                        avatar:$('.span-container-receiver-id').find('.data-receiver-avatar').attr('value')
                    };
                    
                    array.push(input_to_push);
                });
                this.messages = array;
            }); 
        }else{
            var input_to_push= [];
            var array = [];
            fire_messages.once('value', function(snapshot) {
              snapshot.forEach(function(childSnapshot) {
                var childKey = childSnapshot.key;
                var childData = childSnapshot.val();
                input_to_push = {
                    receiver_id:childData.receiver_id,
                    message:childData.message,
                    hour:thisDateMoreThanOneDay(childData.hour),
                    messageForSender:childData.messageForSender,
                    avatar:$('.span-container-receiver-id').find('.data-receiver-avatar').attr('value')
                };
                array.push(input_to_push);
              });
            });
            this.messages = array;
        }
    }

}).$mount('#chat');

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
    let sender_passfire = "1234563";/*$('.data-sender-fuid').attr('value')*/
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

function getImagePath(img) {
    // body...
    if (img==null) {
        return $('meta[name="baseUrl"]').attr("value")+"/images/default/avatar-2-32.png";
    }
    else
        return $('meta[name="baseUrl"]').attr("value")+"/images/avatars/thumbnails/"+img;
}

function bd_ref_firebase() {
    let user_1 = parseInt($('.span-container-sender-id').attr('data-sender-id'));
    let user_2 = parseInt($('.span-container-receiver-id').attr('data-receiver-id'));

    if (user_1>user_2) {
        return user_2.toString()+'_'+user_1.toString();
    }else
        return user_2.toString()+'_'+user_1.toString();
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
