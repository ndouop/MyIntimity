<?php

namespace App\Repositories;

use App\Models\Friend;
use InfyOm\Generator\Common\BaseRepository;

class FriendRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'friend',
        'etat'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Friend::class;
    }
}
