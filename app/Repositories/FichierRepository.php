<?php

namespace App\Repositories;

use App\Models\Fichier;
use InfyOm\Generator\Common\BaseRepository;

class FichierRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'sujet_id',
        'reponse_id',
        'fichier',
        'actif',
        'user_id',
        'type_f',
        'taille'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Fichier::class;
    }
}
