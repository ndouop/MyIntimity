<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateReponseAPIRequest;
use App\Http\Requests\API\UpdateReponseAPIRequest;
use App\Models\Reponse;
use App\Repositories\ReponseRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ReponseController
 * @package App\Http\Controllers\API
 */

class ReponseAPIController extends AppBaseController
{
    /** @var  ReponseRepository */
    private $reponseRepository;

    public function __construct(ReponseRepository $reponseRepo)
    {
        $this->reponseRepository = $reponseRepo;
    }

    /**
     * Display a listing of the Reponse.
     * GET|HEAD /reponses
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->reponseRepository->pushCriteria(new RequestCriteria($request));
        $this->reponseRepository->pushCriteria(new LimitOffsetCriteria($request));
        $reponses = $this->reponseRepository->all();

        return $this->sendResponse($reponses->toArray(), 'Reponses retrieved successfully');
    }

    /**
     * Store a newly created Reponse in storage.
     * POST /reponses
     *
     * @param CreateReponseAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateReponseAPIRequest $request)
    {
        $input = $request->all();

        $reponses = $this->reponseRepository->create($input);

        return $this->sendResponse($reponses->toArray(), 'Reponse saved successfully');
    }

    /**
     * Display the specified Reponse.
     * GET|HEAD /reponses/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Reponse $reponse */
        $reponse = $this->reponseRepository->findWithoutFail($id);

        if (empty($reponse)) {
            return $this->sendError('Reponse not found');
        }

        return $this->sendResponse($reponse->toArray(), 'Reponse retrieved successfully');
    }

    /**
     * Update the specified Reponse in storage.
     * PUT/PATCH /reponses/{id}
     *
     * @param  int $id
     * @param UpdateReponseAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReponseAPIRequest $request)
    {
        $input = $request->all();

        /** @var Reponse $reponse */
        $reponse = $this->reponseRepository->findWithoutFail($id);

        if (empty($reponse)) {
            return $this->sendError('Reponse not found');
        }

        $reponse = $this->reponseRepository->update($input, $id);

        return $this->sendResponse($reponse->toArray(), 'Reponse updated successfully');
    }

    /**
     * Remove the specified Reponse from storage.
     * DELETE /reponses/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Reponse $reponse */
        $reponse = $this->reponseRepository->findWithoutFail($id);

        if (empty($reponse)) {
            return $this->sendError('Reponse not found');
        }

        $reponse->delete();

        return $this->sendResponse($id, 'Reponse deleted successfully');
    }
}
