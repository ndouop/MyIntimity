<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatelikeAPIRequest;
use App\Http\Requests\API\UpdatelikeAPIRequest;
use App\Models\like;
use App\Repositories\likeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class likeController
 * @package App\Http\Controllers\API
 */

class likeAPIController extends AppBaseController
{
    /** @var  likeRepository */
    private $likeRepository;

    public function __construct(likeRepository $likeRepo)
    {
        $this->likeRepository = $likeRepo;
    }

    /**
     * Display a listing of the like.
     * GET|HEAD /likes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->likeRepository->pushCriteria(new RequestCriteria($request));
        $this->likeRepository->pushCriteria(new LimitOffsetCriteria($request));
        $likes = $this->likeRepository->all();

        return $this->sendResponse($likes->toArray(), 'Likes retrieved successfully');
    }

    /**
     * Store a newly created like in storage.
     * POST /likes
     *
     * @param CreatelikeAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatelikeAPIRequest $request)
    {
        $input = $request->all();

        $likes = $this->likeRepository->create($input);

        return $this->sendResponse($likes->toArray(), 'Like saved successfully');
    }

    /**
     * Display the specified like.
     * GET|HEAD /likes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var like $like */
        $like = $this->likeRepository->findWithoutFail($id);

        if (empty($like)) {
            return $this->sendError('Like not found');
        }

        return $this->sendResponse($like->toArray(), 'Like retrieved successfully');
    }

    /**
     * Update the specified like in storage.
     * PUT/PATCH /likes/{id}
     *
     * @param  int $id
     * @param UpdatelikeAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatelikeAPIRequest $request)
    {
        $input = $request->all();

        /** @var like $like */
        $like = $this->likeRepository->findWithoutFail($id);

        if (empty($like)) {
            return $this->sendError('Like not found');
        }

        $like = $this->likeRepository->update($input, $id);

        return $this->sendResponse($like->toArray(), 'like updated successfully');
    }

    /**
     * Remove the specified like from storage.
     * DELETE /likes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var like $like */
        $like = $this->likeRepository->findWithoutFail($id);

        if (empty($like)) {
            return $this->sendError('Like not found');
        }

        $like->delete();

        return $this->sendResponse($id, 'Like deleted successfully');
    }
}
