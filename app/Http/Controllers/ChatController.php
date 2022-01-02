<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friend;
use App\Models\Message;
use App\Models\User;
use DB,Response;


class ChatController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $receiver_id = request('receiver_id');


        if (is_null($receiver_id)) {
            return redirect("forum")->with('error',trans("back/chat.error_con_to_user"));
        }
        $receiver = User::find($receiver_id);

        if (!$receiver->actif || is_null($receiver)) {
            return redirect("forum")->with('error',trans("back/chat.error_con_to_user"));
        }

        if (auth()->user()->id == $receiver_id) {
            return redirect("forum")->with('error',trans("back/chat.error_dont_write_to_you"));
        }


        if (!auth()->user()->isFriend($receiver_id)) {
            return redirect("forum")->with('error',trans("back/chat.error_dont_friend"));
        }

        $invitation_sent_in_agreement = \App\Models\Friend::whereFriendAndEtat(auth()->user()->id,false)->get();
    	$friends = auth()->user()->friends();
        $nbFriend = count($friends);
/*    	$last_conversation = auth()->user()
									->messages
									->orderBy('created_at','DESC')
									->first();*/

		//$last_friend_we_have_conversation = $last_conversation->
    	return view('chat.index',compact('friends','receiver','nbFriend','invitation_sent_in_agreement'));
    }

    public function getBox($receiver_id)
    {
/*
        $info_user_connected = '
        <div class="user-connect">
            <input type="hidden" class="firstname" value="'.auth()->user()->prenom.'">
            <input type="hidden" class="lastname" value="'.auth()->user()->nom.'">
            <input type="hidden" class="user_pf" value="'.auth()->user()->passfire.'">
            <input type="hidden" class="fuid" value="'.auth()->user()->fuid.'">
            <input type="hidden" class="id" value="'.auth()->user()->id.'">
            <input type="hidden" class="avatar" value="'.is_null(auth()->user()->avatar)?"avatar-2-64.png":auth()->user()->avatar.'">
        </div>

        <span class="span-container-sender-id" data-sender-id="'.auth()->user()->id.'">
            <span class="data-sender-name" value="'.auth()->user()->nom.' '.auth()->user()->prenom.'"></span>
            <span class="data-sender-fuid" value="'.auth()->user()->fuid.'"></span>
            <span class="data-sender-email" value="'.auth()->user()->email.'"></span>
            <span class="data-sender-avatar" value="'.is_null(auth()->user()->avatar)?"avatar-1-32.png":auth()->user()->avatar.'"></span>
            <span class="data-sender-login" value="'.auth()->user()->login.'"></span>
        </span>
        ';
        $receiver = \App\Models\User::find($receiver_id);
        $info_receiver = '
            <span class="span-container-receiver-id" data-receiver-id="'.$receiver->id.'">
                <span class="data-receiver-name" value="'.$receiver->prenom.' '.$receiver->nom.'"></span>
                <span class="data-receiver-avatar" value="'.asset(is_null($receiver->avatar)?"images/default/avatar-2-32.png":"images/avatars/thumbnails/".$receiver->avatar).'"></span>
                <span class="data-receiver-login" value="'.$receiver->login.'"></span>
            </span>
        ';


  $response_html = ' 
    <!-- receiver information -->

        '.$info_receiver.'

    <!-- sender information -->

        '.$info_user_connected.'

           
        <header class="clearfix">           
            <a href="#" class="chat-close">x</a>
            <h4>'.$receiver->login.'</h4>
            <span class="chat-message-counter">3</span>
        </header>
        <div class="chat" style="">     
            <div class="chat-history">
                <div class="previous-messages-history"></div>
                <chat-log :messages="messages"></chat-log>
            </div> <!-- end chat-history -->
            <form action="#" method="post" class="chat-form">
                <fieldset>                  
                    <chat-composer  v-on:messagesent="sendMessage"></chat-composer>
                    <input type="hidden">
                </fieldset>
            </form>
            <div class="chat-option">
                <i class="fa fa-file-image-o" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;&nbsp;
                <i class="fa fa-meh-o" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;&nbsp; 
                <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;&nbsp; 
            </div> 
        </div> <!-- end chat -->
    

    <script>
        
    </script>';

    return \Response::json($response_html);*/
    
        $receiver = \App\Models\User::find($receiver_id);
        return \View::make('chat.components.box')
                        ->with('receiver',$receiver)
                        ->render();
    }

    public function getReceiver($id)
    {
        $receiver = \App\Models\User::find($id);

        return Response::json($receiver);
    }
}

