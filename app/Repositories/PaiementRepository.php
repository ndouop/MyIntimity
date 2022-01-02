<?php

namespace App\Repositories;

use App\Models\Paiement;
use InfyOm\Generator\Common\BaseRepository;

class PaiementRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'montant',
        'user_id',
        'devise_id',
        'mode',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Paiement::class;
    }
}
