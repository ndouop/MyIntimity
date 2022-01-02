<?php

namespace App\Repositories;

use App\Models\Permission_role;
use InfyOm\Generator\Common\BaseRepository;

class Permission_roleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'permission_id',
        'role_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Permission_role::class;
    }
}
