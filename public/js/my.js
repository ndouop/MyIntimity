
//base des url
var __baseUrl=$('meta[name="baseUrl"]').attr('value');
var trans = window.Translator;
var local = (window.localLang!="")?window.localLang:"fr";
	trans.setLanguage(local);
var sources = window.transDataSource;
trans.setDATA(sources);

var guest = $("#iam-gest");

function getUrlParameter(sParam) {
	var sPageURL = decodeURIComponent(window.location.search.substring(1)),
		sURLVariables = sPageURL.split('&'),
		sParameterName,
		i;

	for (i = 0; i < sURLVariables.length; i++) {
		sParameterName = sURLVariables[i].split('=');

		if (sParameterName[0] === sParam) {
			return sParameterName[1] === undefined ? true : sParameterName[1];
		}
	}
}



//manage gotoup
	//checker si la page a dega été scroller vers le base. si oui on affiche le bouton up
	$(function () {
	     var $win = $(window);
	     $win.scroll(function () {
	         if ($win.scrollTop() < 10)
	             $(".gotoup").hide("slow");
	         else {
	             $(".gotoup").show("slow");
	         }
	     });
	 });
	//aller en haut de page si on click sur le bouton gotoup
	$('.gotoup').on('click', function(evt){
	   evt.preventDefault(); 
		var target = $(".gotoup a").attr('href');
		$('html, body')
			.stop()
			.animate({scrollTop: $(target).offset().top}, 3000 );
	});



	$('#navbar-search-friend').on('click',function(e){
		$('.bd-example-modal-lg').modal('show');
	});

	$('#form-search-user label').click(function(){
		var eltName = $(this).attr('for');
		var elt=$('label[for="'+eltName+'"]');
		if ($(this).attr('state')=='hide') {
			$('.'+eltName).show(400);
			$(this).attr('state','display');
			$(this).children('.fa').removeClass('fa-plus').addClass('fa-minus');
		}else{
			$('.'+eltName).hide(400);
			$(this).attr('state','hide');
			$(this).children('.fa').removeClass('fa-minus').addClass('fa-plus');
		}
			
	});

	$('#form-search-user').submit(function(e){
		e.preventDefault();
		var params = $(this).serialize();
		$.ajaxSetup({
			headers:{
				'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			url:__baseUrl+'/user/search',
			type:'POST',
			dataType:'json',
			data:params,
			error:function(data){
				notie.alert(3,data.statusText,5);
			},
			success:function(data){
				$('#list-users').html('');
				if(data.status){
					if (data.length!=0) {
						$('#list-users').html('');
						$('#list-users').show();
						$('#list-empty').hide();
						$(".result-list-users").show('fast');
						$.each(data.datas,function(index,value){
							$('#list-users').append(value);
						});							
					}else{
						//alert(1);
						$('.add-customers-screen-in').html(
							'<p class="lead color-blue-grey-lighter">'+trans.getValue("no_result_found")+'</p>'+
							'<div class="">'+
								'<img src="'+__baseUrl+'/startUI/img/smiley-sorry.png">'+
							'</div>'+
							'<h2>'+trans.getValue("we_are_sorry")+'</h2>'
						);
						$('#list-empty').show();
						$('#list-users').hide();
					}

				}else{
					//alert(2);
					$('.add-customers-screen-in').html(
						'<p class="lead color-blue-grey-lighter"> '+trans.getValue("no_result_found")+'</p>'+
						'<div class="">'+
							'<img src="'+__baseUrl+'/startUI/img/smiley-sorry.png">'+
						'</div>'+
						'<h2>'+trans.getValue("we_are_sorry")+'</h2>'
						);
					$('#list-empty').show();
					$('#list-users').hide();
				}
			}
		});
	})
				
	function demandeAmitie(friend_id) {		
		var params = {friend:friend_id};
		$.ajaxSetup({
			headers:{
				'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			url:__baseUrl+'/friends',
			type:'POST',
			dataType:'json',
			data:params,
			error:function(data){
				notie.alert(3,data.statusText,5);
			},
			success:function(data){
				if(!data.status){
					notie.alert(3,data.motif,5);
				}else{
					notie.alert(1,data.message,5);
					$('#invitation_'+friend_id).replaceWith('<span href="#" onclick="event.preventDefault();" class="badge badge-pink badge-sm">'+trans.getValue("inv_sent")+'</span>');

				}
			}
		});
	}

	function gotoCommentPage(url) {
			window.location.replace(url);
		}
	function getBestComments() {
		var cat = "";
		if(getUrlParameter('categorie') !== undefined)
			cat = "?cat="+getUrlParameter('categorie');
		$.get(__baseUrl+"/sujet/bestcomments"+cat, function(data){
			if (data.length > 0) {
				$('#best_comments').empty();
				$('#loading').hide();
				$.each(data,function(index,value){
					$('#best_comments').append(value);
				});
			}
			else{
				$('#loading').hide();

				$('#best_comments').html(
					'<div class="alert alert-danger alert-no-border alert-close alert-dismissible fade in" role="alert">'+
					'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
						'<span aria-hidden="true">&times;</span>'+
					'</button>'+
					trans.getValue("no_s_found")+
				'</div>'
					);
			}
		});
	}

	function getBestLikes() {
		$('#best_likes').empty();
		var cat = "";
		if(getUrlParameter('categorie') !== undefined)
			cat = "?cat="+getUrlParameter('categorie');

		$.get(__baseUrl+"/sujet/bestlikes"+cat,function(data){
			if (data.length > 0) {
				$('#best_likes').empty();
				$('#loading2').hide();
				$.each(data,function(index,value){
					
					$('#best_likes').append(value);
				});
			}
			else{
				$('#loading2').hide();

				$('#best_likes').html(
					'<div class="alert alert-danger alert-no-border alert-close alert-dismissible fade in" role="alert">'+
					'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
						'<span aria-hidden="true">&times;</span>'+
					'</button>'+
					trans.getValue("no_s_found")+
				'</div>'
					);
			}
		});
	}


	function likeSubject(id) {
		var params = {
			sujet_id:id
		};
		if (guest=="true") {
			window.location.replace(__baseUrl+"/login");
		}else{
			$.ajaxSetup({
				headers:{
					'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
				}
			});

			$.ajax({
				url:__baseUrl+'/likes',
				type:'POST',
				dataType:'json',
				data:params,
				error:function(data){
					notie.alert(3,data.statusText,5);
				},
				success:function(data){

					if (!data.status) {
						/*if (!data.status.unlike) {
							var last_nblike_value = parseInt($('#__like'+id).text());
							$('#__like'+id).empty().html(last_nblike_value-1);
							notie.alert(3,data.motif,5);
						}*/
					}else{
						if (data.already) {
							return false;
						}
						var last_nblike_value = parseInt($('#__like'+id).text());
						$('#__like'+id).empty().html(last_nblike_value+1);
						$("#__like"+id).parent().find("i").addClass("icon-like-color");
						notie.alert(1,trans.getValue("like_ok"),3);
					}
				}
			});			
		}


	}

	$('#form-search-subject').submit(function(e){
		e.preventDefault();
		$('#result').empty();
		var _data_=$(this).serializeArray();

		$.ajaxSetup({
			headers:{
				'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			url:$(this).attr('action'),
			type:$(this).attr('method'),
			data:_data_,
			dataType:'json',
			error:function (data) {
				notie.alert(3,data.statusText,5);
				$('#result').html('<h2 color="red">500 : '+trans.getValue("err_500")+'!!</h2>');
			},
			success:function(data){
				$('#result').empty();
				if (data.length==0) {
					$('#result').html(trans.getValue("no_result_found2"));
				}else{
					console.log(data);
					$.each(data,function(index,value){
						$('#result').append(value);
					});
				}
			}
		});
	});

	$(".__disabled").click(function(event){
		event.preventDefault();
		$(this).attr('style','color:grey')
	})

	function getModal() {
		$('#myModal').modal('show');
		$(this).val('no writable');
	}

	function getModalCloseSubject() {
		$('#modalClose').modal('show');
	}
	$(document).ready(function(){
		$("input[jump='demo_vertical']").TouchSpin({
			verticalbuttons: true
		});
	});
	$(document).ready(function(){
		$("input[jump='demo_vertical_s']").TouchSpin({
			verticalbuttons: true
		});
	});

	$('#form-search-subject').submit(function(e){
		e.preventDefault();
		var _data_=$(this).serializeArray();

		$.ajaxSetup({
			headers:{
				'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			url:$(this).attr('action'),
			type:$(this).attr('method'),
			data:_data_,
			dataType:'json',
			error:function (data) {
				notie.alert(3,data.statusText,5);
			},
			success:function(data){
				$('#result').empty();
				if (data.length==0) {
					$('#result').html(trans.getValue("no_result_found2"));
				}else{
					$.each(data,function(index,value){
						$('#result').append(value);
					});
				}
			}
		});
	});

	function getBoxChat(receiver_id){
		$.get(__baseUrl+'/getBox/'+receiver_id,function(data){

			$('.block-chatbox').html(data);
			//console.log(data);
		})
	}

	function getReceiver(receiver_id){
		var lastReceiver = $.session('receivers');
		$.get(__baseUrl+'/get/receiver/'+receiver_id,function(data){

			//store in session
			var lastReceiver = $.session('receivers');
			$.session.set('receivers')
			//console.log(data);
		})
	}

	$('#live-chat header').on('click', function() {
		$('.chat').slideToggle(300, 'swing');
		$('.chat-message-counter').fadeToggle(300, 'swing');
	});

	$('.chat-close').on('click', function(e) {
		e.preventDefault();
		$('#live-chat').fadeOut(300);
	});

	function getChatPage(_url,id,event,isSeen){
		event.preventDefault();
		if (isSeen==true) {
			window.location.replace(_url)
		}
		$.ajaxSetup({
			headers:{
				'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			url:__baseUrl+"/inbox/setSeen",
			type:"POST",
			data:{inbox_id:id},
			dataType:'json',
			error:function (data) {
				notie.alert(1,data.statusText,1);
			},
			success:function(data){
				if (!data.status) {
					notie.alert(1,data.motif,1);
				}else{
					window.location.replace(_url)
				}
			}
		});
	}



	function rediriger(url){
		//alert(url);
		window.location.href = url;
	}


	if (guest=="true") {

		var CronJob = require('cron').CronJob;
		var user_connect = $('.user-connect').find('.id').val();
		new CronJob('0 0-59/8 * * * *', function() {
			$.ajax({
				url:__baseUrl+"/notification/getNewNotification",
				type:"GET",
				data:{user_id:user_connect},
				dataType:'json',
				error:function (data) {				
				},
				success:function(data){
					console.log(data);
					var noeud = $(".dropdown-menu-notif-list");
					if (data.length!=0) {
						$('div.notif a.header-alarm').removeClass(' active').addClass(" active");
						var nbNotif = parseInt($("#nbNotif").text());
						$('#nbNotif').text(nbNotif+data.length);
						$.each(data,function(index,value){
							noeud.prepend(value);
						});
					}
				}
			});
		}, null, true, 'Africa/Douala');
	}

	function dateTime(){
		var dt = new Date();
		time = dt.toLocaleTimeString();
		var y=dt.getFullYear();
		var m = dt.getMonth()+1;
		var d = dt.getDay();
		if (m.toString().length == 1) {
			m = "0"+m;
		}
		if (d.toString().length == 1) {
			d="0"+d;
		}

		var dateTime = y+"-"+m+"-"+d+" "+time;

		return dateTime;
	}

	function seemore_mySubjects(){
		var departure = parseInt($("button[name='seemore_mySubjects'].btn-seemore").val());
		var arrival = departure+2;

		$.get(__baseUrl+'/my-subject/seemore?departure='+departure+'&arrival='+arrival,function(data){
			if(data.length>0){
				if(data.length < 10)
					$('#seemore-subject').attr("disable", true);

				$("button[name='seemore_mySubjects'].btn-seemore").val(arrival+data.length);
				var time=500;
				$.each(data,function(index,value){
					
					setTimeout(function() {
						$('#seemore-content').append(value).fadeIn("slow");
					}, time);
					time+=500;
				});
			}else{
				//seemore-subject
				$('#seemore-subject').attr("disable", true);
			}
		});
	}

	function confirmInvitation(_url,changor) {
		$.ajaxSetup({
			headers:{
				'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			url:_url,
			type:"POST",
			dataType:'json',
			error:function (data) {
				notie.alert(3,data.statusText,5);
			},
			success:function(data){
				if (data.status) {
					notie.alert(1,data.message,5);
					$("a.plus-link-circle.icon-"+changor).removeClass("plus-link-circle").attr('onclick',"event.preventDefault();").html("<i class='fa fa-check'><i>");
					$("p a.text-"+changor).text(trans.getValue("y_friend"));
				}else{
					notie.alert(3,data.motif,5);
				}
			}
		});
	}


	$("#souscribeToNewsletterBtnSubmit").click(function(e){
		e.preventDefault();
		var form = $("#souscribeToNewsletter");
		let email = form.find("#souscribeToNewsletterEmail").val();
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	    if (!filter.test(email)) {
	        notie.alert(3,trans.getValue("tape_valid_mail"),10);
	        form.find("#souscribeToNewsletterEmail").focus;
	        return false;
	    }

	    $.ajaxSetup({
	        headers:{
	            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
	        }
	    });

        $.ajax({
	        url:form.attr("action"),
	        type:form.attr('method'),
	        dataType:'json',
	        data:form.serializeArray(),
	        error:function(data){
	            notie.alert(3,data.statusText,10);
	        },
	        success:function(data){
	            if(!data.status){
	                notie.alert(3,data.motif,10);
	            }else{
	                form.find("#souscribeToNewsletterEmail").val("");
	                notie.alert(1,data.message,10);
	            }
	        }
	    });
    });
