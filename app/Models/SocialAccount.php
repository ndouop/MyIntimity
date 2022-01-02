<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{

    public $table = 'social_accounts';
    protected $fillable = ['user_id', 'provider_user_id', 'provider'];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'provider_user_id' => 'string',
        'provider' => 'string'
    ];


    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

}
