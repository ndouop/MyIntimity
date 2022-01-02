<?php

namespace App\Http\Controllers;

use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Config;
use App\Models\Reponse;
use App\Models\Sujet;
use App\Models\Reply;
use Illuminate\Http\Request;
use App\Events\CommentPosted;
use Validator;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            //'reponse_id' => 'required',
            'message' => 'required'
        ];
       
        $id_user = auth()->user()->id;
        $input = $request->all();
        $val = Validator::make($input,$rules);

        if ($val->fails()) {
            return response()->json(['status'=>false,'motif'=>trans("back/reply.check_empty_response")]);
        }

        $reponse_id = \App\Models\Reponse::whereFirebaseCommentId($input['firebase_comment_id'])->first()->id;

        $input['user_id']=$id_user;

        $values = [
            "reponse_id"=>$reponse_id,
            "nblike"=>0,
            "niveau"=>1,
            "user_id"=>$id_user,
            "sujet_id"=>$input["sujet_id"],
            "created_at"=>$input["created_at"],
            "message"=>$input["message"],
            "anonyme"=>$input["anonyme"]
        ];
        
        try {
            $reply = Reply::create($values);
            $reply->reponse->increment('nbreply');
           
            $avatar = (is_null(auth()->user()->avatar))?asset("images/default/avatar-2-32.png"):asset('images/avatars/thumbnails/thumb_'.auth()->user()->avatar);

            $return = array(
                    'id'=>$reply->id,
                    'message'=>$reply->message,
                    'anonyme'=>$reply->anonyme,
                    'reponse_id'=>$reply->reponse_id,
                    'sujet_id'=>$reply->reponse->sujet->id,
                    'nblike'=>$reply->nblike,
                    "niveau"=>$reply->niveau,
                    'created_at'=>getTimeHumansPoster($reply->created_at),
                    'user'=>array(
                        'nom'=>auth()->user()->nom,
                        'prenom'=>auth()->user()->prenom,
                        "id"=>auth()->user()->id,
                        "login"=>auth()->user()->login,
                        "avatar"=>$avatar
                    )
                );

            // notification de l'utilisateur ayant posté le message.

            $content = $reply->message;
            $anonyme = $reply->anonyme;
            $sender_id = auth()->user()->id;
            $link = 'forum/discussion/sujet/'.$reply->reponse->sujet->id;
            $user_cencerned_id = $reply->reponse->user->id;

            //-------------push notification from firebase----------

            $this->notifyUserOnNewMess($reply->reponse->sujet->user->id,$reply->id);

            //--------------end push fcm----------------------------
            
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['status'=>false,'motif'=>$e->getMessage()/*"Un probleme est survenu, verifiez que votre reponse n'est pas vide"*/]);
        }

        return ['status'=>true,'message'=>trans("back/reply.success_store"),'reply'=>$return];
        //return redirect(route('reponses.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function notifyUserOnNewMess($userId, $replyId)
    {
        $user = \App\Models\User::find($userId);
        $reply = Reply::find($replyId);
        if (!empty($user) && !empty($reply)) {
            $path_to_firebase_cm = 'https://fcm.googleapis.com/fcm/send';
            $fields = array(
                'to' => $user->fcm_token,
                'notification' => array(
                    'title' => \Config::get("app.name"),
                    'icon' => \Config::get("app.icon"),
                    "click_action" => url('forum/discussion/sujet/'.$reply->reponse->sujet->id),
                    'body' => ($reply->anonyme?"Anonyme ": $reply->user->login)." a laissé un commentaire sur votre sujet"
                ),
                'data' => array('message' => "")
            );

            $headers = array(
                'Authorization:key=' . Config::get('app.fcm_server_key'),
                'Content-Type:application/json'
            );
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $path_to_firebase_cm);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

            $result = curl_exec($ch);

            curl_close($ch);

            return $result;
        }
    }
}
