<?php

namespace App\Repositories;

use App\Models\Devise;
use InfyOm\Generator\Common\BaseRepository;

class DeviseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'nom',
        'symbole',
        'actif'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Devise::class;
    }
}
