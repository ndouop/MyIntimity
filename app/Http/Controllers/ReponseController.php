<?php

namespace App\Http\Controllers;

use App\DataTables\ReponseDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateReponseRequest;
use App\Http\Requests\UpdateReponseRequest;
use App\Repositories\ReponseRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Config;
use App\Models\Reponse;
use App\Models\Sujet;
use App\Models\Notification;
use Illuminate\Http\Request;

class ReponseController extends AppBaseController
{
    /** @var  ReponseRepository */
    private $reponseRepository;
    private $userRepository;

    public function __construct(ReponseRepository $reponseRepo)
    {
        $this->reponseRepository = $reponseRepo;
        //$this->userRepository = new UserRepository();
        $this->middleware('auth')->except('index','notifyedPoster');
        //$this->middleware('ajax')->except('index');
    }

    /**
     * Display a listing of the Reponse.
     *
     * @param ReponseDataTable $reponseDataTable
     * @return Response
     */
    public function index()
    {
        //$user = auth()->user();
        $subject_id = request('sujet');
        $reponses = array();
        $avatar = '';
        $responses = Sujet::find($subject_id)->reponses;
        $replies = [];

        if (count($responses)) {
            foreach ($responses as $re) {

                if ($re->avatar!=null) {
                    $avatar = asset('images/avatars/thumbnails/thumb_'.$re->avatar);
                }else{
                    $avatar = asset('images/default/avatar-2-32.png');
                }
                $reponses[]=array(
                    "id" => $re->id,
                    "message" => $re->message,
                    "anonyme" => $re->anonyme,
                    "created_at" => $re->created_at,
                    "sujet_id" => $re->sujet_id,
                    "firebase_comment_id"=> $re->firebase_comment_id,
                    "user" => array(
                            "id" => $re->user->id,
                            "nom" => $re->user->nom,
                            "prenom" => $re->user->prenom,
                            "avatar" => $avatar
                        ),
                    "replies"=>\App\Models\Reply::whereReponseId($re->id)->with("user")->get()->toArray()
                );
            }
        }
        //dd($reponses);
        return response()->json($reponses);

    }

    /**
     * Show the form for creating a new Reponse.
     *
     * @return Response
     */
    public function create()
    {
        return view('reponses.create');
    }

    /**
     * Store a newly created Reponse in storage.
     *
     * @param CreateReponseRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = [
            'sujet_id' => 'required',
            'message' => 'required'
        ];
       
        $id_user = auth()->user()->id;
        $input = $request->all();
        $val = \Validator::make($input,$rules);

        if ($val->fails()) {
            return response()->json(['status'=>false,'motif'=>"Un probleme est survenu, veuillez que votre reponse n'est pas vide__"]);
        }

        $input['user_id']=$id_user;

        
        try {
            $reponse = Reponse::create($input);
            $reponse->sujet->increment('nbcomment');
           
            $avatar = is_null(auth()->user()->avatar)?asset("images/default/avatar-2-32.png"):asset('images/avatars/thumbnails/thumb_'.auth()->user()->avatar);

            $return = array(
                    'message'=>$reponse->message,
                    'anonyme'=>$reponse->anonyme,
                    'sujet_id'=>$reponse->sujet_id,
                    'nbcomment'=>$reponse->nbcomment,
                    'created_at'=>$reponse->created_at,
                    'user'=>array(
                            'nom'=>auth()->user()->nom,
                            'prenom'=>auth()->user()->prenom,
                            "id"=>auth()->user()->id,
                            "avatar"=>$avatar
                        ),
                    "replies"=>[]
                );


             //broadcast(new CommentPosted($reponse,$reponse->sujet))->toOthers();


            // notification de l'utilisateur ayant posté le message.

            $content = $reponse->message;
            $anonyme = $reponse->anonyme;
            $sender_id = auth()->user()->id;
            $link = 'forum/discussion/sujet/'.$reponse->sujet->id;
            $user_cencerned_id = $reponse->sujet->user->id;

            //-------------push notification from firebase----------

            $this->notifyUserOnNewMess($reponse->sujet->user->id,$reponse->id);

            //--------------end push fcm----------------------------

            $this->notifyedPoster([
                "content" => $content,
                "anonyme" => $anonyme,
                "link" => $link,
                "user_cencerned_id" => $user_cencerned_id,
                "sender_id" => $sender_id
            ]);
            
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['status'=>false,'motif'=>"Un probleme est survenu, verifiez que votre reponse n'est pas vide --  ".$e->getMessage()]);
        }

        return ['status'=>true,'message'=>'votre commentaire a été ajouté.','reponse'=>$return];
        //return redirect(route('reponses.index'));
    }

    /**
     * Display the specified Reponse.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $reponse = $this->reponseRepository->findWithoutFail($id);

        if (empty($reponse)) {
            Flash::error('Reponse not found');

            return redirect(route('reponses.index'));
        }

        return view('reponses.show')->with('reponse', $reponse);
    }

    /**
     * Show the form for editing the specified Reponse.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $reponse = $this->reponseRepository->findWithoutFail($id);

        if (empty($reponse)) {
            Flash::error('Reponse not found');

            return redirect(route('reponses.index'));
        }

        return view('reponses.edit')->with('reponse', $reponse);
    }

    /**
     * Update the specified Reponse in storage.
     *
     * @param  int              $id
     * @param UpdateReponseRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReponseRequest $request)
    {
        $reponse = $this->reponseRepository->findWithoutFail($id);

        if (empty($reponse)) {
            Flash::error('Reponse not found');

            return redirect(route('reponses.index'));
        }

        $reponse = $this->reponseRepository->update($request->all(), $id);

        Flash::success('Reponse updated successfully.');

        return redirect(route('reponses.index'));
    }

    /**
     * Remove the specified Reponse from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $response = $this->reponseRepository->findWithoutFail($id);
        
        //$response = Reponse::find(intval($id));
        if (is_null($response)) {
            return response()->json(['status'=>false,'motif'=>'Cette reponse n\'existe pas.']);
        }

        $user = auth()->user();

        if ($user->id!=$response->user_id) {
            return response()->json(['status'=>false,'motif'=>'Acces non authorisé.']);
        }

        $this->reponseRepository->delete($id);

        return response()->json(['status'=>true,'message'=>'Successfull !!']);
    }

    public function notifyedPoster($data)
    {
        $notif = Notification::create($data);

        return true;
    }

    /*private function notifyUserOnNewMess($userId, $reponseId)
    {
        $user = \App\Models\User::find($userId);
        $reponse = $this->reponseRepository->findWithoutFail($reponseId);
        if (!empty($user) && !empty($reponse)) {
            $path_to_firebase_cm = 'https://fcm.googleapis.com/fcm/send';
            $fields = array(
                'to' => $user->fcm_token,
                'notification' => array(
                    'title' => \Config::get("app.name"),
                    'icon' => \Config::get("app.icon"),
                    //"click_action" => url('forum/discussion/sujet/'.$reponse->sujet->id),
                    'body' => ($reponse->anonyme?"Anonyme ": $reponse->user->login)." a laissé un commentaire sur votre sujet"
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
    }*/

    // notifier le user pour un nouveau comment sur son sujet
    private function notifyUserOnNewMess($userId, $reponseId)
    {
        $path_to_firebase_cm = 'https://fcm.googleapis.com/fcm/send';
        //$reponseId=1;
        //$user = $this->userRepository->findWithoutFail($userId);
        $reponse = $this->reponseRepository->findWithoutFail($reponseId);
        if (!empty($reponse)) {
            // $userIds = $this->reponseRepository->findWhere(['sujet_id', '=', $reponse->sujet_id]);
            $users = $users = DB::table("users")
                //->select('fcm_token', 'id')
                ->select('fcm_token')
                // ->whereNotIn("user_id",[$userId])
                ->where("id", '!=', $reponse->user_id)
                ->where("id", '!=', $reponse->sujet->user_id)
                ->whereIn('id', DB::table("reponses")
                    ->select("user_id")
                    // ->whereNotIn("user_id",[$userId])
                    ->where("sujet_id", $reponse->sujet_id)
                    ->distinct()
                    ->pluck('user_id')
                )->get();

            /*
            var_dump($users); die();
            $userIds = DB::table("reponses")
                ->select("user_id")
                // ->whereNotIn("user_id",[$userId])
                ->where("sujet_id", $reponse->sujet_id)
                ->distinct()
                ->get(); */
            //$this->reponseRepository->findWhere(['sujet_id', '=', $reponse->sujet_id]);
            //if (count($userIds) > 0) {
            foreach ($users as $user) {
                /* if ($id->user_id != $reponse->user_id) {
                     $user = $this->userRepository->findWithoutFail($id->user_id);
                     if (!empty($user)) { */
                //if()
                if (!is_null($user->fcm_token)) {
                    $fields = array(
                        'to' => $user->fcm_token,
                        //'to' =>"cRWgrxe9K0M:APA91bE8Uy23yjawDxSVK0YoXXERkyqCL8dB3Or8W9pFHlBlk5DTi9GNbmMgat9Hwls3D6Z0yDQq4Mb1E8HKXF8JCTNG2AnZge0f7Lk9i1lVIxGCFZlFt_mHrFitEhp2lzSijW5wyP8i",
                        'notification' => array('title' => 'MyIntimity',
                            //'body' => ($reponse->anonyme ? "Anonyme " : $reponse->user->login) . " a laissé un commentaire sur votre sujet",
                            'body' => ($reponse->anonyme ? "Anonyme " : $reponse->user->login) . " a aussi commenté le sujet de " .( $reponse->sujet->anonyme ? "Anonyme " : $reponse->sujet->user->login),
                            'icon' => "https://www.myintimity.vision-numerique.com/images/logo_mdpi.png"
                            // "click_action" => url('https://www.myintimity.vision-numerique.com/forum/discussion/sujet/'.$reponse->sujet->id)

                        ),
                        'data' => array('message' => "sujet;" . $reponse->sujet_id . ";u")
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
                }
            }
            /* }
         }*/
        }

        if ($reponse->user_id != $userId) {
            $user = $this->userRepository->findWithoutFail($userId);
            if (!empty($user)) {
                if(!is_null($user->fcm_token)) {
                    $fields = array(
                        'to' => $user->fcm_token,
                        //'to' =>"cRWgrxe9K0M:APA91bE8Uy23yjawDxSVK0YoXXERkyqCL8dB3Or8W9pFHlBlk5DTi9GNbmMgat9Hwls3D6Z0yDQq4Mb1E8HKXF8JCTNG2AnZge0f7Lk9i1lVIxGCFZlFt_mHrFitEhp2lzSijW5wyP8i",
                        'notification' => array('title' => 'MyIntimity',
                            //'body' => ($reponse->anonyme ? "Anonyme " : $reponse->user->login) . " a laissé un commentaire sur votre sujet",
                            'body' => ($reponse->anonyme ? "Anonyme " : $reponse->user->login) . " a laissé un commentaire sur votre sujet",
                            'icon' => "https://www.myintimity.vision-numerique.com/images/logo_mdpi.png"
                            // "click_action" => url('https://www.myintimity.vision-numerique.com/forum/discussion/sujet/'.$reponse->sujet->id)

                        ),
                        'data' => array('message' => "sujet;" . $reponse->sujet_id . ";u")
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
                }
            }
        }
        //return $result;
        //}
    }

}

