<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use Flash;
use Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\User;
use App\Models\Pay;
use App\Models\Region;
use App\Models\Ville;

class UserController extends AppBaseController
{


    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
       // $this->middleware('guest')->only('create'); 
       //$this->middleware('auth')->only('create');
    }

    /**
     * Display a listing of the User.
     *
     * @param UserDataTable $userDataTable
     * @return Response
     */
    public function index(UserDataTable $userDataTable)
    {
        return $userDataTable->render('users.index');
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
		//$villes = \App\Models\Ville::all();
		$pays = \App\Models\Pay::all();
		//$regions = \App\Models\Region::all();

        $user = auth()->user();
        $invitation_sent_in_agreement = \App\Models\Friend::whereFriendAndEtat(auth()->user()->id,false)->get();
        $friends = auth()->user()->friends();
        $nbFriend = count($friends);
/*      $last_conversation = auth()->user()
                                    ->messages
                                    ->orderBy('created_at','DESC')
                                    ->first();*/

        //$last_friend_we_have_conversation = $last_conversation->
        return view('users.create',
            compact('friends','receiver','nbFriend','invitation_sent_in_agreement','pays','user')
        );
		
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();

        if (count($request->file())) {
            # code...

            $valid=\Validator::make(['avatar'=>\Input::file('avatar')],[

                'avatar'=>'image|required|mimes:gif,jpg,jpeg,bmp,png|max:5000',

            ]);

            if($valid->fails()){
                return redirect()->back()->with('error',trans("back/user.error_img_format"))->withInput();
            }
            
            $file=\Input::file('avatar');
            $filename=time().'.'.$file->getClientOriginalExtension();
            $image=\Image::make($file)
                ->save(public_path('/images/avatars/'.$filename));
            $image->resize(500,500)
                ->save(public_path('/images/avatars/profile/profile_'.$filename));
            $image->resize(100,100)
                ->save(public_path('/images/avatars/thumbnails/thumb_'.$filename));
            $input['avatar'] = $filename;
        }
        


        //$input['password']=bcrypt($input['password']);
        //dd($input);

        //$user = $this->userRepository->update($input,auth()->user()->id);
        $user = User::find(auth()->user()->id)->update($input);
        //User::update($input,auth()->user()->id);

        if ($user) {
            /*if (!is_null($user->email)) {
                //$this->sendEmail($user->email,$user->login,'enregistrement a Intimity avec success',"Well done");
            }
            
            \Auth::login($user);*/

            return redirect('/')->withSuccess('Well done! :)');
        }

        return back();
    }

    /**
     * Display the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
           // Flash::error('User not found');

            return redirect(route('users.index'))->withError('User not found');
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->findWithoutFail($id);
		$villes = \App\Models\Ville::all();
		$pays = \App\Models\Pays::all();
		$regions = \App\Models\Region::all();

        if (empty($user)) {
            //Flash::error('User not found');

            return redirect(route('users.index'))->withError('User not found');
        }

        return view('users.edit')->with(['user'=>$user,'villes'=>$villes,'regions'=>$regions,'pays'=>$pays]);
    }

    /**
     * Update the specified User in storage.
     *
     * @param  int              $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            //Flash::error('User not found');

            return redirect(route('users.index'))->withError('User not found');
        }

        $user = $this->userRepository->update($request->all(), $id);

        Flash::success('User updated successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            //Flash::error('User not found');

            return redirect(route('users.index'))->withError('User not found');
        }

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('users.index'));
    }

    //profile user

    public function profile()   
    {

        //$user_id = request('u');

        $user_id = auth()->user()->id;

        $subjects_most_commented = [];
        $subjects_most_liked = [];
        $users_most_interesting = array();
        $invitation_sent_in_agreement = array();

        $parameters = [
            'calendrier'=>array(),
            'derniere_date_des_regles'=>'',
            'duree_du_seignement'=>'',
            'duree_du_cycle'=>'',
            'mode_notification'=>"",
            'heure_notification'=>'',
        ];

        $friends = [];

        $friends = auth()->user()->friends();
        $subjects_most_commented = \App\Models\Sujet::whereActif(true)
                                                    ->orderBy('nbcomment','DESC')
                                                    ->limit(10)
                                                    ->get();

        $subjects_most_liked = \App\Models\Sujet::whereActif(true)/*whereUserId($user_id)*/
                                                    ->orderBy('nblike','DESC')
                                                    ->limit(10)
                                                    ->get();

        $invitation_sent_in_agreement = \App\Models\Friend::whereFriendAndEtat($user_id,false)->get();
        

        $user = User::findOrFail($user_id);

        $users_most_interestings = User::whereActif(true)
                                    ->latest()
                                    ->limit(40)
                                    ->get();
        foreach ($users_most_interestings as $u) {
            if (!$this->weAreFriend2($user_id,$u->id)) {
                $users_most_interesting[] = $u;
            }
        }

        $compacters = array(
                'user' => $user,
                'subjects_most_commented'=>$subjects_most_commented,
                'subjects_most_liked'=>$subjects_most_liked,
                'parameters'=>$parameters,
                'users_most_interesting'=>$users_most_interesting,
                'invitation_sent_in_agreement'=>$invitation_sent_in_agreement,
                'nbFriend'=>count($friends)
            );

        return view('users.others.profile.index',$compacters);
    }

    public function sendEmail($user_email,$user_name,$title,$content)
    {
        /*$title = "test Intimity email";
        $content = "je suis le contenu du mail";
        $user_email = "nivekalara237@gmail.com";
        $user_name = "kemta";*/
        
        try
        {
            $data = ['email'=> $user_email,'name'=> $user_name,'subject' => $title, 'content' => $content];
            Mail::send('emails/test', $data, function($message) use($data)
            {
                $subject=$data['subject'];
                $message->from('nivekalara237@gmail.com');
                $message->to($data['email'], $data['name'])->subject($subject);
            });
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
        }

    }

    public function search()
    {
        $pays = \App\Models\Pay::all();
        return view('users.others.search',compact('pays'));
    }

    public function searchPost(Request $request)
    {
        $nom = '';
        $prenom = '';
        $pays_id = 0;
        $ville_id = 0;
        $response_html=array();
        $query = User::whereActif(true);
        $nb = 0;
        if ($request->ajax()) {

            $nom = $request->nom;
            $prenom = $request->prenom;
            $pays_id = $request->pays;
            $region = $request->region;
            $ville = $request->ville;
            if ($nom == "" && $prenom == "" && $pays_id == 0 && $region == "" && $ville == "") {
                return response()->json(['status'=>false]);
            }else{
                if ($nom != "") {
                    $query = $query->where('nom','like','%'.$nom.'%')->orWhere('login','like','%'.$nom.'%');
                    $nb++;
                }
                if ($prenom != "") {
                    $query = $query->where('prenom','like','%'.$prenom.'%');
                    $nb++;
                }

                if ($pays_id > 0) {
                    $query = $query->where('pay_id',$pays_id);
                    $nb++;
                }
                if ($region != "") {
                    $region_id = \App\Models\Region::where('nom','like','%'.$region.'%')->pluck('id')->toArray();
                    if(count($region_id) > 0) {
                        $query = $query->whereIn('region_id', $region_id);
                        $nb++;
                    }
                }
                if ($ville != "") {
                    $ville_id = \App\Models\Ville::where('nom','like','%'.$ville.'%')->pluck('id')->toArray();
                    if(count($ville_id) > 0) {
                        $query = $query->whereIn('ville_id', $ville_id);
                        $nb++;
                    }
                }

                $query = $query->get();
            }

            if (count($query) && $nb > 0) {
                foreach ($query as $user) {

                    $response_html[] = '

                        <tr>
                            <td class="table-photo">
                                <img src="'.asset(is_null($user["avatar"])?"images/default/avatar-2-48.png":"images/avatars/thumbnails/thumb_".$user["avatar"]).'" alt="" data-toggle="tooltip" data-placement="bottom" title="'.$user["avatar"].'">
                            </td>
                            <td class="blue_">'.$user["nom"].' '.$user["prenom"].' <span class="text-italic-color-fad">@'.$user["login"].'</span></td>
                            <td class="">


                            </td>
                            <td class="table-date">'.
                        $this->weAreFriend(auth()->user()->id,$user['id']).'
                                <a target="_blank" class="btn btn-rounded btn-inline btn-secondary-outline" href="'.url('chat-room').'?receiver_id='.$user['id'].'"> <i class="ont-icon font-icon-comments-2"></i> Message</a>
                            </td>
                        </tr>
                    ';
                }
                return response()->json(['status'=>true,'datas'=>$response_html]);
            }else{
                return response()->json(['status'=>false]);
            }

        }
    }

    public function weAreFriend($me_id,$friend_id)
    {
        $check = \App\Models\Friend::where(function($query) use ($me_id,$friend_id) {
                                $query->where('user_id',$me_id);
                                $query->where('friend',$friend_id);
                            })
                            ->orWhere(function($query) use ($me_id,$friend_id) {
                                $query->where('user_id',$friend_id);
                                $query->where('friend',$me_id);
                            })
                            ->whereEtat(true)
                            ->first();
        if (count($check)) {
            if ($check->etat) {
                return '<span href="#" onclick="event.preventDefault();" class="badge badge-pink badge-sm">'.trans("back/user.is_friend").'</span>';
            }
            return '<span href="#" onclick="event.preventDefault();" class="badge badge-pink badge-sm">'.trans("back/user.req_send").'</span>';
        }else
            return '<button class="btn btn-rounded btn-inline btn-primary-outline" id="invitation_'.$friend_id.'" onclick="demandeAmitie('.$friend_id.')">'.trans("back/user.inv").'</button>';
    }

    public function weAreFriend2($me_id,$friend_id)
    {
        $check = \App\Models\Friend::where(function($query) use ($me_id,$friend_id) {
                                $query->where('user_id',$me_id);
                                $query->where('friend',$friend_id);
                            })
                            ->orWhere(function($query) use ($me_id,$friend_id) {
                                $query->where('user_id',$friend_id);
                                $query->where('friend',$me_id);
                            })
                            ->whereEtat(true)
                            ->first();
        if (count($check))
            return true;
        else
            return false;             
    }

    public function saveParamPrevision(Request $request)
    {
        $result = array();
        $result["status"] = 0;
        if (isset($request->ddr)) {
            $user = auth()->user();
            //$user->ddr = $request->date_regle;
            $user->ddr = $request->ddr;
            $user->duree_cycle = $request->duree_cycle;
            $user->duree_ecoulement = $request->duree_ecoulement;
            $user->duree_min = $request->duree_min;
            $user->duree_max = $request->duree_max;
            $user->estRegulier = ($request->estRegulier == true) ? 1 : 0;
            $user->heure_notification = $request->heure_notification;
            $user->save();
            $result["status"] = 1;
        }
        //$result["statu"] = 0;
        return response()->json($result);
    }
    public function soutenirTeam()
    {
        if(auth()->check()) {
            $invitation_sent_in_agreement = \App\Models\Friend::whereFriendAndEtat(auth()->user()->id, false)->get();
            $friends = auth()->user()->friends();
            $nbFriend = count($friends);

            return view('soutenir', compact('friends', 'nbFriend', 'invitation_sent_in_agreement'));
        }else{
            return view('soutenir');
        }
    }
    public function term()
    {
        return view('term');

    }


    public function updateFCMToken($token)
    {
        $user = User::find(auth()->user()->id);
        $user->fcm_token = $token;
        $user->save();

        return ['message'=>'weel done -- '.$token];
    }


    public function updateProfileForm(){

        $pays = \App\Models\Pay::all();

        $user = auth()->user();
        $invitation_sent_in_agreement = \App\Models\Friend::whereFriendAndEtat(auth()->user()->id,false)->get();
        $friends = auth()->user()->friends();
        $nbFriend = count($friends);
        $langues = \App\Models\Langue::all();

        return view('users.updateProfile',
            compact('friends','receiver','nbFriend','invitation_sent_in_agreement','pays','user', 'langues')
        );



    }




    public function saveProfile(Request $request){

        $input = $request->all();
        $user = User::find(auth()->user()->id);
        if (count($request->file()) > 0) {
            # code...

            $valid=\Validator::make(['avatar'=>\Input::file('avatar')],[

                'avatar'=>'image|required|mimes:gif,jpg,jpeg,bmp,png|max:5000',

            ]);

            if($valid->fails()){
                return redirect()->back()->with('error',trans("back/user.error_img_format"))->withInput();
            }

            $file=\Input::file('avatar');
            //$filename=time().'.'.$file->getClientOriginalExtension();

            $destinationPath = 'images/avatars/';
            //$ext = pathinfo(storage_path().'/'.$file->getClientOriginalName(), PATHINFO_EXTENSION);
            $fichier = uniqid().'.'.$file->getClientOriginalExtension();
            $fichier = (!is_null($user) && (is_null($user->avatar) || $user->avatar == "")) ? $fichier : $user->avatar;
            $image=\Image::make($file)
                ->save($destinationPath.$fichier);
            $image->resize(500,500)
                ->save($destinationPath.'profile/profile_'.$fichier);
            $image->resize(100,100)
                ->save($destinationPath.'thumbnails/thumb_'.$fichier);


            $input['avatar'] = $fichier;

        }



        //$input['password']=bcrypt($input['password']);
        //dd($input);

        //$user = $this->userRepository->update($input,auth()->user()->id);
        $user = User::find(auth()->user()->id)->update($input);
        //User::update($input,auth()->user()->id);

        if ($user) {
            /*if (!is_null($user->email)) {
                //$this->sendEmail($user->email,$user->login,'enregistrement a Intimity avec success',"Well done");
            }

            \Auth::login($user);*/

            return redirect('profile')->withSuccess(trans("back/user.success_udate"));
        }
        return back();
    }

    public function saveLocalisation(Request $request)
    {
        $user = $this->userRepository->findWithoutFail($request->user_id);

        //$user = User::find($request->user_id);

        $data = $request->all();
        $result = array();
        $result['resultat'] = 0;
        if (!empty($user)) {
        //if(!is_null($user)){ // on crée le profil
            $pays = Pay::where('code', strtoupper($data['code']))->get();
            if(count($pays) > 0){
                $pays_id = $pays[0]->id;

                $region = Region::where('nom', 'like', '%'.$data['region'].'%')->where('pay_id',$pays_id)->get();
                if(count($region) > 0){
                    $region_id = $region[0]->id;

                    $ville = Ville::where('nom', 'like', '%'.$data['ville'].'%')->where('region_id',$region_id)->get();
                    if(count($ville) > 0){
                        $ville_id = $ville[0]->id;

                    }else{
                        $ville = new Ville();
                        $ville->nom = $data['ville'];
                        $ville->region_id = $region->id;
                        $ville->save();

                        $ville_id = $ville->id;
                    }

                }else{
                    $region = new Region();
                    $region->nom = $data['region'];
                    $region->pay_id = $pays_id;
                    $region->save();
                    $region_id = $region->id;
                    $ville = new Ville();
                    $ville->nom = $data['ville'];
                    $ville->region_id = $region->id;
                    $ville->save();

                    $ville_id = $ville->id;
                }
            }else{ // on enregistre son pays, sa region  et sa ville
                $pays = new Pay();
                $pays->code = $data['code'];
                $pays->nom = $data['pays_nom'];
                $pays->save();
                $pays_id = $pays->id;

                $region = new Region();
                $region->nom = $data['region'];
                $region->pay_id = $pays->id;
                $region->save();
                $region_id = $region->id;

                $ville = new Ville();
                $ville->nom = $data['ville'];
                $ville->region_id = $region->id;
                $ville->save();

                $ville_id = $ville->id;


            }
            $ip = \App\Models\Ville_ip::where('ville_id', $ville_id)->where('ip', $data['ip'])->get();
            if(count($ip) <= 0){
                $ip = new \App\Models\Ville_ip();
                $ip->ville_id = $ville_id;
                $ip->ip = $data['ip'];
                $ip->save();
            }
            $user->pay_id = $pays_id;
            $user->region_id = $region_id;
            $user->ville_id = $ville_id;
            $user->save();

            $result['resultat'] = 1;
        }
        return response()->json($result);
    }
}