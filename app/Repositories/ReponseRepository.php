<?php

namespace App\Repositories;

use App\Models\Reponse;
use InfyOm\Generator\Common\BaseRepository;

class ReponseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'sujet_id',
        'user_id',
        'message',
        'anonyme',
        'actif'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Reponse::class;
    }
}
