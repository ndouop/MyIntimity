<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Message
 * @package App\Models
 * @version May 29, 2017, 4:49 pm UTC
 */
class Inbox extends Model
{
    use SoftDeletes;

    public $table = 'inbox';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'sender_id',
        'content',
        'receiver_id',
        'link',
        "seen",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
   
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
/*    public function conversation()
    {
        return $this->belongsTo(\App\Models\Conversation::class);
    }
*/
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function sender()
    {
        return $this->belongsTo(\App\Models\User::class,'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(\App\Models\User::class,'receiver_id');
    }
}