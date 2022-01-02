<?php

namespace App\Repositories;

use App\Models\Sujet;
use InfyOm\Generator\Common\BaseRepository;

class SujetRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
     * Configure the Model
     **/
    public function model()
    {
        return Sujet::class;
    }
}
