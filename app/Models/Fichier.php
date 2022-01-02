<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Fichier
 * @package App\Models
 * @version May 29, 2017, 4:47 pm UTC
 */
class Fichier extends Model
{
    use SoftDeletes;

    public $table = 'fichiers';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'sujet_id',
        'reponse_id',
        'fichier',
        'actif',
        'user_id',
        'type_f',
        'taille'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'sujet_id' => 'integer',
        'reponse_id' => 'integer',
        'fichier' => 'string',
        'actif' => 'integer',
        'user_id' => 'integer',
        'type_f' => 'string',
        'taille' => 'string'
    ];

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
    public function reponse()
    {
        return $this->belongsTo(\App\Models\Reponse::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function sujet()
    {
        return $this->belongsTo(\App\Models\Sujet::class);
    }
}
