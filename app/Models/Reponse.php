<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Reponse
 * @package App\Models
 * @version May 29, 2017, 4:51 pm UTC
 */
class Reponse extends Model
{
    use SoftDeletes;

    public $table = 'reponses';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'sujet_id',
        'user_id',
        'message',
        'anonyme',
        'actif',
        'firebase_comment_id',
        'nbreply'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'sujet_id' => 'integer',
        'user_id' => 'integer',
        'message' => 'string',
        'anonyme' => 'integer',
        'actif' => 'integer',
        'firebase_comment_id'=>'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'sujet_id' => 'required',
        'message' => 'required',
        'user_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function sujet()
    {
        return $this->belongsTo(\App\Models\Sujet::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function fichiers()
    {
        return $this->hasMany(\App\Models\Fichier::class);
    }

    public function replies()
    {
        return $this->hasMany(\App\Models\Reply::class);
    }

}
