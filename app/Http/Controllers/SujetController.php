<?php

namespace App\Http\Controllers;

use App\DataTables\SujetDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSujetRequest;
use App\Http\Requests\UpdateSujetRequest;
use App\Repositories\SujetRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request;
use App\Models\Sujet;

class SujetController extends AppBaseController
{


    /** @var  SujetRepository */
    private $sujetRepository;

    public function __construct(SujetRepository $sujetRepo)
    {
        $this->sujetRepository = $sujetRepo;
        //$this->middleware('auth')->except('index', 'bestcomments', 'bestlikes', 'getAll');
    }

    /**
     * Display a listing of the Sujet.
     *
     * @param SujetDataTable $sujetDataTable
     * @return Response
     */
    public function index(SujetDataTable $sujetDataTable)
    {
        return $sujetDataTable->render('sujets.index');
    }

    /**
     * Show the form for creating a new Sujet.
     *
     * @return Response
     */
    public function create()
    {
        $categories = \App\Models\Categorie::all();
        return view('sujets.create',compact('categories'));
    }

    /**
     * Store a newly created Sujet in storage.
     *
     * @param CreateSujetRequest $request
     *
     * @return Response
     */
    public function store(CreateSujetRequest $request)
    {

        /*if ( $request->age_debut > $request->age_fin) {
            return back()->withError(trans("back/sujt.error_old"));
        }
*/
        $input = $request->all();
        /*if ($request->age_debut==$request->age_fin) {
            $input["age_fin"]=150;
        }

        if ($input["age_fin"]=="") {
            $input["age_fin"]=150;
        }
        if ($input["age_debut"]=="") {
            $input["age_debut"]=13;
        }*/
        $input["age_debut"]=13;
        $input["age_fin"]=150;
        $input['user_id'] = auth()->user()->id;

        $sujet = $this->sujetRepository->create($input);

        //Flash::success('Sujet saved successfully.');

        return redirect("forum/discussion/sujet/".$sujet->id)->withSuccess(trans("back/sujet.success_store"));
    }

    /**
     * Display the specified Sujet.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sujet = $this->sujetRepository->findWithoutFail($id);

        if (empty($sujet)) {
            Flash::error('Sujet not found');

            return redirect(route('sujets.index'));
        }

        return view('sujets.show')->with('sujet', $sujet);
    }

    /**
     * Show the form for editing the specified Sujet.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sujet = $this->sujetRepository->findWithoutFail($id);

        if (empty($sujet)) {
            Flash::error('Sujet not found');

            return redirect(route('sujets.index'));
        }

        return view('sujets.edit')->with('sujet', $sujet);
    }

    /**
     * Update the specified Sujet in storage.
     *
     * @param  int $id
     * @param UpdateSujetRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSujetRequest $request)
    {
        $sujet = $this->sujetRepository->findWithoutFail($id);

        if (empty($sujet)) {
            Flash::error('Sujet not found');

            return redirect(route('sujets.index'));
        }

        $sujet = $this->sujetRepository->update($request->all(), $id);

        Flash::success('Sujet updated successfully.');

        return redirect(route('sujets.index'));
    }

    /**
     * Remove the specified Sujet from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sujet = $this->sujetRepository->findWithoutFail($id);

        if (empty($sujet)) {
            Flash::error('Sujet not found');

            return redirect(route('sujets.index'));
        }

        $this->sujetRepository->delete($id);

        Flash::success('Sujet deleted successfully.');

        return redirect(route('sujets.index'));
    }
    public function getAll($sujet_id)
    {
        $sujet = \App\Models\Sujet::whereActifAndId(true,$sujet_id)->first();
        $categories = \App\Models\Categorie::all();

        return view('discution.index',compact('sujet',"categories"));
    }

    public function close($id){
        $subject = Sujet::findOrFail($id);

        try {
            $subject->actif=false;
            $subject->save();

            return redirect("forum")->withSuccess(trans("back/sujet.success_close"));
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withError('Sujet non fermé');
        }
    }

    public function search(Request $request)
    {
        $inputs = $request->all();
        $keys = array();
        $keys_values = array();
        
        if (!array_key_exists("actif", $inputs)) {
            $inputs['actif']=0;
        }

        foreach ($inputs as $key => $value) {
            if (!is_null($value)) {
                $keys[]=$key;
                $keys_values[$key]=$value;
            }
        }
        $strQuery = "SELECT * FROM sujets WHERE ";

        foreach ($keys as $value) {
            if ($value=='created_at') {
                $date = str_replace("/", '-', $keys_values[$value]);
                $strQuery .= " $value LIKE '%$keys_values[$value]%' AND ";
            }else
                $strQuery .= "$value='$keys_values[$value]' AND ";
        }

        $strQuery = substr($strQuery,0,strlen($strQuery)-4);
  
        $subjects = \DB::select($strQuery);

        $lang = config('app.locale');
        \Carbon\Carbon::setLocale($lang);
        $content_html = [];

        foreach ($subjects as $subject) {
            $content_html[]='
            <div class="col-md-6">
                <article class="faq-page-quest">
                    <header class="faq-page-quest-title">
                        <a href="'.url("/forum/discussion/sujet/".$subject->id).'">'.trans("back/sujet.poster_le").(new \Carbon\Carbon($subject->created_at))->toFormattedDateString().trans("back/sujet.post_by").($subject->anonyme?trans("back/user.anonyme"):\App\Models\User::find($subject->user_id)->login).'</a>
                    </header>
                    <p onclick="gotoSub(\''.url("forum/discussion/sujet/".$subject->id).'\')">'.reduceText($subject->description,130,true,url("/forum/discussion/sujet/".$subject->id)).'</p>
                </article>
            </div>';
        }

        return $content_html;
    }

    public function lasts_subjects()
    {
        $sujets = Sujet::whereActif(true)->limit(20)->get();

        $sujets_html = array();

        if (count($sujets)) {
            foreach ($sujets as $s) {
                $sujets_html[] = '
                    <a href="#" class="help-dropdown-popup-item">
                        '.$s->categorie->label.' / '.$s->user->nom.' '.$s->user->prenom.'
                        <span class="describe">'.$s->description.'</span>
                    </a>
                ';
            }
        }

        return response()->json($sujets_html);
    }

    public function bestcomments()
    {
        if (request()->ajax()) {
            $bestcomments_html = array();
            $cat = request('cat');

            if(is_null($cat) || !is_int(intval($cat)))
                $bestcomments = Sujet::whereActif(true)->orderBy("nbcomment","DESC")->limit(10)->get();
            else
                $bestcomments = Sujet::whereActifAndCategorieId(true, $cat)->orderBy("nbcomment","DESC")->limit(10)->get();

            
            foreach ($bestcomments as $sujet) {
                $bestcomments_html[] = '
                <article class="box-typical profile-post" id="app" subject-data-id="'.$sujet->id.'">
                    <div class="profile-post-header">
                        <div class="user-card-row">
                            <div class="tbl-row">
                                <div class="tbl-cell tbl-cell-photo">
                                    <a href="#">
                                        '.$this->haveAvatar($sujet->user->avatar, $sujet->anonyme).'
                                    </a>
                                </div>
                                <div class="tbl-cell">
                                    <div class="user-card-row-name"><a href="#">'.((!$sujet->anonyme)?$sujet->user->login:"Anonyme").'</a></div>
                                    <div class="color-blue-grey-lighter">'.getTimeHumansPoster($sujet->created_at).'</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-post-content">
                        <p>'.$sujet->description.'</p>
                    </div>
                    <div class="box-typical-footer profile-post-meta">
                        <a href="#" class="meta-item" onclick="event.preventDefault();likeSubject('.$sujet->id.');">
                            <i class="font-icon font-icon-heart"></i>
                            <span id="__like'.$sujet->id.'">'.$sujet->nblike.'</span>
                        </a>
                        <a href="'.url("forum/discussion/sujet/".$sujet->id).'" class="meta-item">
                            <i class="font-icon font-icon-comment"></i>
                            '.$sujet->nbcomment .' '. trans("back/sujet.comments") .'
                        </a>
                    </div>
                </article>';
            }
            return $bestcomments_html;
        }
    }

    public function bestlikes()
    {
        if (request()->ajax()) {

            var_dump(__('back/sujet.comments'));die;
            $bestlikes_html = array();
            $cat = request('cat');
            if(is_null($cat) || !is_int(intval($cat)))

                $bestlikes = Sujet::whereActif(true)->orderBy("nblike","DESC")->limit(10)->get();
            else
                $bestlikes = Sujet::whereActifAndCategorieId(true, $cat)->orderBy("nblike","DESC")->limit(10)->get();


            foreach ($bestlikes as $sujet) {
                $bestlikes_html[] = '
                <article class="box-typical profile-post" id="app" subject-data-id="'.$sujet->id.'">
                    <div class="profile-post-header">
                        <div class="user-card-row">
                            <div class="tbl-row">
                                <div class="tbl-cell tbl-cell-photo">
                                    <a href="#">
                                        '.$this->haveAvatar($sujet->user->avatar, $sujet->anonyme).'
                                    </a>
                                </div>
                                <div class="tbl-cell">
                                    <div class="user-card-row-name"><a href="#">'.((!$sujet->anonyme)?$sujet->user->login:"Anonyme").'</a></div>
                                    <div class="color-blue-grey-lighter">'.getTimeHumansPoster($sujet->created_at).'</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-post-content">
                        <p>'.$sujet->description.'</p>
                    </div>
                    <div class="box-typical-footer profile-post-meta">
                        <a href="#" class="meta-item" onclick="event.preventDefault();likeSubject('.$sujet->id.');">
                            <i class="font-icon font-icon-heart"></i>
                            <span id="__like'.$sujet->id.'">'.$sujet->nblike.'</span>
                        </a>
                        <a href="'.url("forum/discussion/sujet/".$sujet->id).'" class="meta-item">
                            <i class="font-icon font-icon-comment"></i>
                            '.$sujet->nbcomment .' '. trans("back/sujet.comments") . '
                        </a>
                    </div>
                </article>';
            }

            return $bestlikes_html;
        }
    }

    public function haveAvatar($value_avatar, $anonime)
    {
        if (is_null($value_avatar) || $anonime == true) {
            return "<img src='".url('images/default/avatar-2-32.png')."' alt=''>";
        }else {
            return "<img class='avatar-thumb-forum-subject' src='".asset("images/avatars/thumbnails/thumb_".$value_avatar)."' alt=''>";
        }
    }


    public function mySubjects()
    {
        $subjects = auth()->user()->sujets->take(10);
        $invitation_sent_in_agreement = \App\Models\Friend::whereFriendAndEtat(auth()->user()->id, false)->get();
        $friends = auth()->user()->friends();
        $nbFriend = count($friends);

        //return view('soutenir', compact('friends', 'nbFriend', 'invitation_sent_in_agreement'));
        return view("users.others.last-subjects",compact("subjects",'friends', 'nbFriend', 'invitation_sent_in_agreement'));
    }

    public function seemore(){
        $departure = request("departure");
        $arrival = request("arrival");


        $subjects = Sujet::whereUserId(auth()->user()->id)->offset($departure)->take($arrival-$departure)->get();

        $subjectsHtml = array();

        if(count($subjects)==0){
            return [];
        }else{
            foreach ($subjects as $subj) {
                $subjectsHtml[]=$this->seemoreItemHtml($subj);
            }
        }

        return $subjectsHtml;
                        
    }

    public function seemoreItemHtml($subj){

        $itemHtml = array();
        $imgs = extract_img_to_string($subj->description);
        $subject_without_img_tag = $subj->description;
        if ($imgs) {
            $img_tag = $imgs['TAG_IMG'];
            $subject_without_img_tag = (count($img_tag)!=0)?delete_img_to_string($img_tag,$subj->description):$subj->description;

        }

        $imgHtml = "";

        if($imgs){
            $imgHtmlHead = '<hr><div class="gallery-grid">';
            $imgHtmlBody='';

            for($w = 0;$w < count($imgs['POP_IMG']); $w++)
            {
                $imgHtmlBody.='<div class="gallery-col">
                    <article class="gallery-item" style="border: 1px grey solid">
                        <img class="gallery-picture" src="'.$imgs['POP_IMG'][$w].'" alt="" height="158">
                        <div class="gallery-hover-layout">
                            <div class="gallery-hover-layout-in">
                                <p class="gallery-item-title">seen</p>
                                <div class="btn-group">
                                    <button type="button" class="btn">
                                        <i class="font-icon font-icon-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>';
            }

            $imgHtml = $imgHtmlHead."".$imgHtmlBody."</div>";
        }

        $itemHtml = '<article class="comment-item">
            <div class="user-card-row">
                <div class="tbl-row">
                    <div class="tbl-cell tbl-cell-photo">
                        <a href="#">
                            <img src="'.url(is_null($subj->user->avatar)?"images/default/avatar-2-48.png":"images/avatars/thumbnails/".$subj->user->avatar).'" alt="">
                        </a>
                    </div>
                    <div class="tbl-cell">
                        <span class="user-card-row-name"><a href="#">'.auth()->user()->login.'</a></span>
                    </div>
                    <div class="tbl-cell tbl-cell-date">
                        <span class="semibold">'.\Carbon\Carbon::parse($subj->created_at)->toDayDateTimeString().' </span>
                    </div>
                </div>
            </div>
            <div class="comment-item-txt">
                <p>>'.reduceText($subject_without_img_tag,1024,true,"forum/discussion/sujet/".$subj->id) .' </p>
                '.$imgHtml.'
            </div>
            <div class="comment-item-meta">
                <a href="#" class="star active">
                    <span class="comment_like_sujet deja_like" title="'.trans("back/sujet.already_like_this").'"><i class="fa fa-thumbs-up"></i>'.$subj->nblike.'</span>
                </a>
                <a href="#">
                    <span class="comment_like_sujet" title="'.trans("back/sujet.clic_to_like").'"><i class="fa fa-comment"></i> '.$subj->nbcomment.'</span>
                </a>
                <a href="'.url("forum/discussion/sujet/".$subj->id).'" class="link-see-comments">'.trans("back/sujet.show_all_commets").'</a>
            </div>
        </article>';

        return $itemHtml;
    }


    public function getNewNotification(){
        //date_default_timezone_set('Africa/Douala');
        $user_id = request('user_id');
        $datenow = \Carbon\Carbon::now()->toDateTimeString();
        $dateBefore5min = \Carbon\Carbon::now()->subMinutes(30)->toDateTimeString();
        $notifications = \App\Models\Notification::where("seen",false)
            ->whereBetween('created_at',[$dateBefore5min,$datenow])
            ->get();
        $response_html = [];
        foreach ($notifications as $key => $noti) {
            $path_avatar = is_null($noti->sender->avatar)?url("images/default/avatar-2-32.png"):url("images/avatars/thumbnails/".$noti->sender->avatar);

            $response_html[] = '<div class="dropdown-menu-notif-item" onclick=\'getCommentSubjectPage("'.url($noti->link).'",'.$noti->id.',event);\'>
                  <div class="photo">
                      <img src="'.$path_avatar.'" alt="">
                  </div>
                  <a href="#">'.$noti->sender->login.'</a>'.trans('front/navbar.notification.label').'
                  <div class="color-blue-grey-lighter">'.getTimeHumansPoster($noti->created_at).'</div>
              </div>';
        }
        return Response::json($response_html);
    }

    public function inboxSetSeen(){
        $ib_id = request('inbox_id');

        //update noti
        $ib = \App\Models\Inbox::find($ib_id);
        $ib->seen = true;

        try {
            $ib->save();

            return ['status'=>true];

        } catch (\Illuminate\Database\QueryException $e) {
            return ['status'=>false,"motif"=>trans('back/string.error_update_noti_seen')];
        }
    }
    public function notificationSetSeen(){
        $noti_id = request('notification_id');

        //update noti
        $noti = \App\Models\Notification::find($noti_id);
        $noti->seen = true;

        try {
            $noti->save();

            return ['status'=>true];

        } catch (\Illuminate\Database\QueryException $e) {
            return ['status'=>false,"motif"=>trans('back/string.error_update_noti_seen')];
        }
    }





}
