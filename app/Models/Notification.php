<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Message
 * @package App\Models
 * @version May 29, 2017, 4:49 pm UTC
 */
class Notification extends Model
{
    use SoftDeletes;

    public $table = 'notifications';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_cencerned_id',
        'content',
        'sender_id',
        'seen',
        'link',
        "anomyme",
        "created_at",
        "updated_at",
        "deleted_at"
        
    ];



    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function concern()
    {
    	return $this->belongsTo(\App\Models\User::class,"user_cencerned_id");
    }

    public function sender()
    {
    	return $this->belongsTo(\App\Models\User::class,"sender_id");
    }


}
