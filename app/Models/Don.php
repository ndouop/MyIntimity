<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Don
 * @package App\Models
 * @version May 29, 2017, 4:46 pm UTC
 */
class Don extends Model
{
    use SoftDeletes;

    public $table = 'dons';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'montant',
        'devise',
        'user_id',
        'mode'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'montant' => 'float',
        'devise' => 'string',
        'user_id' => 'integer',
        'mode' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
