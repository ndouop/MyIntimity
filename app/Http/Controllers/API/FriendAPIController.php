<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFriendAPIRequest;
use App\Http\Requests\API\UpdateFriendAPIRequest;
use App\Models\Friend;
use App\Repositories\FriendRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class FriendController
 * @package App\Http\Controllers\API
 */

class FriendAPIController extends AppBaseController
{
    /** @var  FriendRepository */
    private $friendRepository;

    public function __construct(FriendRepository $friendRepo)
    {
        $this->friendRepository = $friendRepo;
    }

    /**
     * Display a listing of the Friend.
     * GET|HEAD /friends
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->friendRepository->pushCriteria(new RequestCriteria($request));
        $this->friendRepository->pushCriteria(new LimitOffsetCriteria($request));
        $friends = $this->friendRepository->all();

        return $this->sendResponse($friends->toArray(), 'Friends retrieved successfully');
    }

    /**
     * Store a newly created Friend in storage.
     * POST /friends
     *
     * @param CreateFriendAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateFriendAPIRequest $request)
    {
        $input = $request->all();

        $friends = $this->friendRepository->create($input);

        return $this->sendResponse($friends->toArray(), 'Friend saved successfully');
    }

    /**
     * Display the specified Friend.
     * GET|HEAD /friends/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Friend $friend */
        $friend = $this->friendRepository->findWithoutFail($id);

        if (empty($friend)) {
            return $this->sendError('Friend not found');
        }

        return $this->sendResponse($friend->toArray(), 'Friend retrieved successfully');
    }

    /**
     * Update the specified Friend in storage.
     * PUT/PATCH /friends/{id}
     *
     * @param  int $id
     * @param UpdateFriendAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFriendAPIRequest $request)
    {
        $input = $request->all();

        /** @var Friend $friend */
        $friend = $this->friendRepository->findWithoutFail($id);

        if (empty($friend)) {
            return $this->sendError('Friend not found');
        }

        $friend = $this->friendRepository->update($input, $id);

        return $this->sendResponse($friend->toArray(), 'Friend updated successfully');
    }

    /**
     * Remove the specified Friend from storage.
     * DELETE /friends/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Friend $friend */
        $friend = $this->friendRepository->findWithoutFail($id);

        if (empty($friend)) {
            return $this->sendError('Friend not found');
        }

        $friend->delete();

        return $this->sendResponse($id, 'Friend deleted successfully');
    }
}
