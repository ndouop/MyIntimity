<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Reponse
 * @package App\Models
 * @version May 29, 2017, 4:51 pm UTC
 */
class Reply extends Model
{
    use SoftDeletes;

    public $table = 'replies';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'reponse_id',
        'user_id',
        'message',
        'anonyme',
        'actif',
        "nblike",
        "niveau"
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'reponse_id' => 'integer',
        'user_id' => 'integer',
        'message' => 'string',
        'anonyme' => 'integer',
        'actif' => 'integer',
        "nblike"=>"integer",
        "niveau"=>"integer"
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'reponse_id' => 'required',
        'message' => 'required',
        'user_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function reponse()
    {
        return $this->belongsTo(\App\Models\Reponse::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

}
