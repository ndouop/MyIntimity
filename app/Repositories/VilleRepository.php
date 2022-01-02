<?php

namespace App\Repositories;

use App\Models\Ville;
use InfyOm\Generator\Common\BaseRepository;

class VilleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nom',
        'region_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Ville::class;
    }
}
