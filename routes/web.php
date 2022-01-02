<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get("tempo",function ()
{
   return view("auth.tempo"); 
});

/*

Route::resource('pays', 'PayController');

Route::resource('users', 'UserController');

Route::resource('users', 'UserController');

Route::resource('pays', 'PayController');

Route::resource('pays', 'PayController');

Route::resource('pays', 'PayController');

Route::resource('pays', 'PayController');

Route::resource('regions', 'RegionController');

Route::resource('villes', 'VilleController');

Route::resource('categories', 'CategorieController');

Route::resource('devises', 'DeviseController');

Route::resource('dons', 'DonController');

Route::resource('fichiers', 'FichierController');

Route::resource('friends', 'FriendController');

Route::resource('likes', 'likeController');

Route::resource('messages', 'MessageController');

Route::resource('paiements', 'PaiementController');

Route::resource('permissions', 'PermissionController');

Route::resource('permissionRoles', 'Permission_roleController');

Route::resource('reponses', 'ReponseController');

Route::resource('roles', 'RoleController');

Route::resource('roleUsers', 'Role_userController');

Route::resource('soldes', 'SoldeController');

Route::resource('sujets', 'SujetController');

Route::resource('villes', 'VilleController');

*/


//Route::group(["middleware"=>["config_elementary","uri_checker"]],function() {


    Route::get('/', 'HomeController@welcome');

    //Route::get('/home', 'HomeController@index');


    Route::get('/redirect/facebook', 'SocialAuthController@redirectToFacebook');
    Route::get('/callback/facebook', 'SocialAuthController@handleFacebookCallback');

    Route::get('/redirect/google', 'SocialAuthController@redirectToGoogle');
    Route::get('/callback/google', 'SocialAuthController@handleGoogleCallback');

// calcul du cycle
    Route::any("cycle", "CycleController@cycle"); // vue


    Route::group(['middleware' => ['auth']], function () {

        Route::get('profile', 'UserController@profile');

        Route::get('getBox', 'ChatController@getBox');
        Route::get('chat-room', 'ChatController@index');
        Route::get('chat-room/friend/{id}', 'ChatController@conversation');

        //friend
        Route::get('user/search', 'UserController@search');
        Route::post('user/search', 'UserController@searchPost');

        Route::post('friend/confirm/{user_id}/{friend}', 'FriendController@confirm_friendship');


        Route::get('profile/update', 'UserController@updateProfileForm')->name('update_profile');
        Route::post('profile/update', 'UserController@saveProfile')->name('update_profile_save');

        Route::post('set-localisation', 'UserController@saveLocalisation')->name('set-localisation');


        Route::group(['middleware' => ['ajax']], function () {
            Route::get('get/region/{pays}', function ($pays) {
                $regions = \DB::table('regions')->select('*')->wherePayId($pays)->get();
                return response()->json($regions);
            });

            Route::get('get/ville/{region}', function ($region) {
                $villes = \DB::table('villes')->select('*')->whereRegionId($region)->get();
                return response()->json($villes);
            });
        });


        Route::get('lasts_subjects', 'SujetController@lasts_subjects');
        
        Route::post("likes","likeController@store")->name('likes');


        ///----------notification and inbox----------------
        Route::post('notification/setSeen', 'SujetController@notificationSetSeen')->name("notificationSetSeen");
        Route::post('inbox/setSeen', 'SujetController@inboxSetSeen')->name("inboxSetSeen");
        Route::get('notification/getNewNotification', 'SujetController@getNewNotification')->name("getNewNotification");

        Route::post('save-sujet', 'SujetController@store')->name("save-sujet");

        Route::post("/replies", 'ReplyController@store');

        /************************* route roger ********************************************/

        Route::get('my-subjects', 'SujetController@mySubjects')->name("my-subjects");
        Route::post('save-param-user', 'UserController@saveParamPrevision')->name("save-param-user");
        Route::get('/my-subject/seemore', 'SujetController@seemore')->name("seemore-my-subject");


        Route::resource('friends', 'FriendController');
        Route::get('friends', 'FriendController@store')->name("friends");


    });

    Route::get('voila',function(){
        dd(strpos(url()->current(), '/app'));
        //dd(url()->current());

    });
//FORUM
//Route::get('discussion/sujets','SujetController@getAll');
    Route::get('forum', 'ForumController@index')->name('forum');
    Route::get('forum/choiceCategorie/{categorie}', 'ForumController@choiceCategorie');
    Route::get('forum/discussion/sujet/{id}', 'SujetController@getAll');
    Route::get('forum/discussion/comment_guest/{id}', 'SujetController@getAll')->name('comment_guest')->middleware('auth');
    Route::get('/sujet/fermer/{id}', 'SujetController@close');
    Route::post('sujet/search', 'SujetController@search');

    Route::get('sujet/bestcomments', 'SujetController@bestcomments');
    Route::get('sujet/bestlikes', 'SujetController@bestlikes');
// requete ajax
    Route::any("maj_calander", "CycleController@maj_calander");
// charger les notes
    Route::any("notes", "CycleController@notes");


    Route::post('registerWithFb', "Auth\\RegisterController@registerWithFb");


    Route::post("updateToken/{token}", "UserController@updateFCMToken");

    Route::get('soutenirTeam', 'UserController@soutenirTeam')->name("soutenirTeam");
    Route::get('term', 'UserController@term')->name("term");
    Route::get('testImage', 'SocialAuthFacebookController@testImage')->name("testImage");

    Route::post("contactUs", "HomeController@contactMyIntimity")->name("contactUs");
    Route::post("souscribeToNewsletter", "HomeController@souscribeToNewsletter")->name("souscribeToNewsletter");


    Route::resource('reponses', 'ReponseController');
    
    Auth::routes();


//});

/*

Route::post('user/update_fuid/{fuid}',function($fuid){
    $resp = \App\Models\User::update(['fuid'=>$fuid]);

    if ($resp) {
        return \Response::json(true);
    }else
        return \Response::json(false);
});

Route::post('user/update_fuid/{fuid}',function($fuid){
    $resp = \App\Models\User::find(auth()->user()->id)->update(['fuid'=>$fuid]);

    if ($resp) {
        return \Response::json(true);
    }else
        return \Response::json(false);
});

Route::post('user/update_passfire/{passfire}',function($passfire){
    $resp = \App\Models\User::find(auth()->user()->id)->update(['passfire'=>$passfire]);

    if ($resp) {
        return \Response::json(true);
    }else
        return \Response::json(false);
});

Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@switchLang']);

Route::get("getDateTime",function(){
    $datet = date("Y-m-d H:m:s");

    return \Response::json(['datetime'=>$datet]);
});
*/


/*Route::post('notification/setSeen',function(){
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
    });*/
/*Route::post('inbox/setSeen',function(){
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
});*/
/*Route::get('notification/getNewNotification',function(){

    date_default_timezone_set('Africa/Douala');
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
});*/


/*

Route::get('categorie/typeahead',function(){
    $cats = \App\Models\Categorie::all();
    return $cats;
});

Route::get('user/typeahead',function(){
    $users = \App\Models\User::whereActif(true)->get();
    return $users;
});

*/


//Route::get('user/sujets','SujetController')

//chat-room



/* **** api  ***/


//Route PAYDUNIA
//Route::post('paydunya/setcallback','PayDunyaController@setCallBack');
//Route::post('paydunya/invoice_payement','PayDunyaController@invoice_payement');
/*Route::get('paydunya/formcmd','PayDunyaController@formcmd');
Route::post('paydunya/livraison','PayDunyaController@livraison');*/
//Route::get('paydunya/return_url','PayDunyaController@return_url');







//--------------fcm token-------------



Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@switchLang']);

