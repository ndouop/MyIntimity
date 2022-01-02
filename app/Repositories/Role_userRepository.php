<?php

namespace App\Repositories;

use App\Models\Role_user;
use InfyOm\Generator\Common\BaseRepository;

class Role_userRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'role_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Role_user::class;
    }
}
