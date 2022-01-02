<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDeviseAPIRequest;
use App\Http\Requests\API\UpdateDeviseAPIRequest;
use App\Models\Devise;
use App\Repositories\DeviseRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class DeviseController
 * @package App\Http\Controllers\API
 */

class DeviseAPIController extends AppBaseController
{
    /** @var  DeviseRepository */
    private $deviseRepository;

    public function __construct(DeviseRepository $deviseRepo)
    {
        $this->deviseRepository = $deviseRepo;
    }

    /**
     * Display a listing of the Devise.
     * GET|HEAD /devises
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->deviseRepository->pushCriteria(new RequestCriteria($request));
        $this->deviseRepository->pushCriteria(new LimitOffsetCriteria($request));
        $devises = $this->deviseRepository->all();

        return $this->sendResponse($devises->toArray(), 'Devises retrieved successfully');
    }

    /**
     * Store a newly created Devise in storage.
     * POST /devises
     *
     * @param CreateDeviseAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDeviseAPIRequest $request)
    {
        $input = $request->all();

        $devises = $this->deviseRepository->create($input);

        return $this->sendResponse($devises->toArray(), 'Devise saved successfully');
    }

    /**
     * Display the specified Devise.
     * GET|HEAD /devises/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Devise $devise */
        $devise = $this->deviseRepository->findWithoutFail($id);

        if (empty($devise)) {
            return $this->sendError('Devise not found');
        }

        return $this->sendResponse($devise->toArray(), 'Devise retrieved successfully');
    }

    /**
     * Update the specified Devise in storage.
     * PUT/PATCH /devises/{id}
     *
     * @param  int $id
     * @param UpdateDeviseAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDeviseAPIRequest $request)
    {
        $input = $request->all();

        /** @var Devise $devise */
        $devise = $this->deviseRepository->findWithoutFail($id);

        if (empty($devise)) {
            return $this->sendError('Devise not found');
        }

        $devise = $this->deviseRepository->update($input, $id);

        return $this->sendResponse($devise->toArray(), 'Devise updated successfully');
    }

    /**
     * Remove the specified Devise from storage.
     * DELETE /devises/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Devise $devise */
        $devise = $this->deviseRepository->findWithoutFail($id);

        if (empty($devise)) {
            return $this->sendError('Devise not found');
        }

        $devise->delete();

        return $this->sendResponse($id, 'Devise deleted successfully');
    }
}
