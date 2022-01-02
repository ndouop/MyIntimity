<?php

namespace App\Repositories;

use App\Models\User;
use InfyOm\Generator\Common\BaseRepository;

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'login',
        'email',
        'actif',
        'password',
        'langue',
        /*'paramettre_id',*/
        'tel1',
        'tel2',
        'name',
        'prenom',
        'sexe',
        'avatar',
        'date_naissance',
        'pay_id',
        'region_id',
        'ville_id',
        'addresse_detaille',
        'couverture',
        'bp_user',
        'ddr',
        'duree_ecoulement',
        'duree_cycle',
        'heure_notification'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }
}
