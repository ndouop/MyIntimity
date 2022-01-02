<?php

namespace App\Repositories;

use App\Models\like;
use InfyOm\Generator\Common\BaseRepository;

class likeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'reponse_id',
        'sujet_id',
        'reponse_autre_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return like::class;
    }
}
