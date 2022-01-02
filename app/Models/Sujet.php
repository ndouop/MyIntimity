<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Sujet
 * @package App\Models
 * @version May 29, 2017, 4:57 pm UTC
 */
class Sujet extends Model
{
    use SoftDeletes;

    public $table = 'sujets';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'age_debut',
        'age_fin',
        'anonyme',
        'categorie_id',
        'user_id',
        'description',
        'actif',
        'nblike',
        'nbcoment'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'age_debut' => 'integer',
        'age_fin' => 'integer',
        'anonyme' => 'integer',
        'categorie_id' => 'integer',
        'user_id' => 'integer',
        'description' => 'string',
        'actif' => 'integer',
        'nblike' => 'integer',
        'nbcoment' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'description' => 'required',
        'categorie_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function categorie()
    {
        return $this->belongsTo(\App\Models\Categorie::class);
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function reponses()
    {
        return $this->hasMany(\App\Models\Reponse::class);
    }
}
