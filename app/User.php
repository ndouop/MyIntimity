<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App\Models
 * @version May 29, 2017, 3:29 pm UTC
 */
class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use \HighIdeas\UsersOnline\Traits\UsersOnlineTrait;

    public $table = 'users';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'login',
        'email',
        'actif',
        'password',
        'langue',
        'langue_id',
        //'remember_token',
        //'paramettre_id',
        'tel1',
        'tel2',
        'nom',
        'prenom',
        'sexe',
        'avatar',
        'date_naissance',
        'pay_id',
        'region_id',
        'ville_id',
        'addresse_detaille',
        'couverture',
        'bp_user',
        'ddr',
        'duree_ecoulement',
        'duree_cycle',
        'heure_notification'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'login' => 'string',
        'email' => 'string',
        'actif' => 'integer',
        'password' => 'string',
        'langue' => 'string',
        'langue_id' => 'integer',
        /*'remember_token' => 'string',*/
        /*'paramettre_id' => 'integer',*/
        'tel1' => 'string',
        'tel2' => 'string',
        'nom' => 'string',
        'prenom' => 'string',
        'sexe' => 'string',
        'avatar' => 'string',
        'date_naissance' => 'string',
        'pay_id' => 'integer',
        'region_id' => 'integer',
        'ville_id' => 'integer',
        'addresse_detaille' => 'string',
        'couverture' => 'string',
        'bp_user' => 'string',
        'ddr' => 'date',
        'duree_ecoulement' => 'integer',
        'duree_cycle' => 'integer',
        'heure_notification' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

        'login' => 'required|string',
        //'password' => 'required|string',
        'email' => 'required|email',
        'tel1' => 'numeric',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function pay()
    {
        return $this->belongsTo(\App\Models\Pay::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function langue()
    {
        return $this->belongsTo(\App\Models\Langue::class, 'langue_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function region()
    {
        return $this->belongsTo(\App\Models\Region::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function ville()
    {
        return $this->belongsTo(\App\Models\Ville::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function friends()
    {
        $friends_id1 = \App\Models\Friend::whereUserId($this->id)->orderBy('created_at','desc')->pluck('friend')->all();
        $friends_id2 = \App\Models\Friend::whereFriend($this->id)->orderBy('created_at','desc')->pluck('user_id')->all();

        $friends_id = array();

        if(count($friends_id1) <= 0)
            $friends_id = $friends_id2;
        else if(count($friends_id2) <= 0)
            $friends_id = $friends_id1;
        else
            $friends_id = array_merge($friends_id2,$friends_id1);

        $friends = \App\Models\User::whereIn('id', $friends_id)->get();

        //dd($friends->take(7));

        return $friends;
        //return $this->hasMany(\App\Models\Friend::class,"friend");
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function isFriends($user_id)
    {
        dd($user_id);

        $friends_id1 = \App\Models\Friend::whereUserId($user_id)
            ->Where('friend',$this->id)
            ->orWhere('user_id',$this->id)
            ->where('friend',$user_id)
            ->get();

        if(count($friends_id1) > 0)
            return true;
        else
            return false;

    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function likes()
    {
        return $this->hasMany(\App\Models\Like::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function conversations()
    {
        return $this->hasMany(\App\Models\Conversation::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function destinataire()
    {
        return $this->hasMany(\App\Models\Message::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function paiements()
    {
        return $this->hasMany(\App\Models\Paiement::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function reponses()
    {
        return $this->hasMany(\App\Models\Reponse::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function roleUsers()
    {
        return $this->hasMany(\App\Models\RoleUser::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function soldes()
    {
        return $this->hasMany(\App\Models\Solde::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function sujets()
    {
        return $this->hasMany(\App\Models\Sujet::class);
    }

    public function messages()
    {
        return $this->hasMany(\App\Models\Message::class);
    }

    public function myMessagesByReceiver($receiver_id)
    {
        $user_id = $this->id;
        return \App\Models\Message::where(function($msg1) use ($user_id,$receiver_id){
            $msg1->where('sender_id',$user_id);
            $msg1->where('receiver_id',$receiver_id);
        })
            ->orWhere(function($msg2) use ($user_id,$receiver_id){
                $msg2->where('sender_id',$receiver_id);
                $msg2->where('receiver_id',$user_id);
            })
            ->orderBy('created_at','ASC')
            ->get();
    }

    public function isFriend($user_consern_id)
    {
        $friends_id1 = \App\Models\Friend::whereUserId($user_consern_id)
            ->Where('friend',$this->id)
            ->orWhere('user_id',$this->id)
            ->where('friend',$user_consern_id)
            ->get();

        if(count($friends_id1) > 0)
            return true;
        else
            return false;

        /*
        //dd($user_consern_id);
        $friend = \App\Models\Friend::whereUserIdAndFriend($this->id,$user_consern_id)->get();

        if (count($friend))
            return true;
        else
            return false;
        */
    }

    public function myFriends()
    {
        $friends = \App\Models\Friend::whereUserId($this->id);
        return $friends;
    }

    public function IAlreadyLikedThisPost($post_id)
    {
        $like_instance = \App\Models\Like::where('user_id','=',$this->id)
            ->where('sujet_id','=',$post_id)
            ->get();

        if (count($like_instance)) {
            return true;
        }else{
            return false;
        }
    }

    public function myLastSubject(){
        $subject = \App\Models\Sujet::whereUserId($this->id)
            ->orderBy('created_at','DESC')
            ->first();

        if (is_null($subject)) {
            return false;
        }

        return $subject;
    }

    public function lastSubjectWhereIAmCommented()
    {
        /* $reponse = \App\Models\Reponse::whereUserId($this->id)
                             //->where('user_id','!=',$this->id)
                             ->orderBy('created_at','DESC')
                             ->join('sujets')
                             ->first();*/
        $reponse = \DB::table('reponses')
            ->join('sujets','sujets.id','=','reponses.sujet_id')
            ->where('sujets.user_id','!=',$this->id)
            ->orderBy('reponses.created_at','DESC')
            ->select('reponses.id','sujets.id',"reponses.sujet_id")
            ->first();

        if (is_null($reponse)) {
            return false;
        }else {
            $subject = \App\Models\Sujet::findOrFail($reponse->sujet_id);
            if (is_null($subject)) {
                return false;
            }else{
                return $subject;
            }
        }
    }


    public function notifications()
    {
        return $this->hasMany(\App\Models\Notification::class);
    }

    public function inboxes()
    {
        return $this->hasMany(\App\Models\Notification::class, "user_cencerned_id");
    }

    public function notificationsNotSeen()
    {
        $notis = \App\Models\Notification::where("user_cencerned_id",$this->id)
            ->where('seen',false)
            ->orderBy("created_at","DESC")
            ->get();

        return $notis;
    }
}
