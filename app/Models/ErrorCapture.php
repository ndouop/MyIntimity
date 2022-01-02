<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Categorie
 * @package App\Models
 * @version May 29, 2017, 4:45 pm UTC
 */
class ErrorCapture extends Model
{
    use SoftDeletes;

    public $table = 'errors_capture';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'body',
        'code',
        'type',
        'user_id',
        'url',
        'actif'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function user()
    {
        return $this->BelongsTo(\App\Models\User::class);
    }

}
