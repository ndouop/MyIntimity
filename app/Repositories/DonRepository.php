<?php

namespace App\Repositories;

use App\Models\Don;
use InfyOm\Generator\Common\BaseRepository;

class DonRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'montant',
        'devise',
        'user_id',
        'mode'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Don::class;
    }
}
