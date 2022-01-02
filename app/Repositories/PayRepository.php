<?php

namespace App\Repositories;

use App\Models\Pay;
use InfyOm\Generator\Common\BaseRepository;

class PayRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'nom'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Pay::class;
    }
}
