<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDonAPIRequest;
use App\Http\Requests\API\UpdateDonAPIRequest;
use App\Models\Don;
use App\Repositories\DonRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class DonController
 * @package App\Http\Controllers\API
 */

class DonAPIController extends AppBaseController
{
    /** @var  DonRepository */
    private $donRepository;

    public function __construct(DonRepository $donRepo)
    {
        $this->donRepository = $donRepo;
    }

    /**
     * Display a listing of the Don.
     * GET|HEAD /dons
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->donRepository->pushCriteria(new RequestCriteria($request));
        $this->donRepository->pushCriteria(new LimitOffsetCriteria($request));
        $dons = $this->donRepository->all();

        return $this->sendResponse($dons->toArray(), 'Dons retrieved successfully');
    }

    /**
     * Store a newly created Don in storage.
     * POST /dons
     *
     * @param CreateDonAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDonAPIRequest $request)
    {
        $input = $request->all();

        $dons = $this->donRepository->create($input);

        return $this->sendResponse($dons->toArray(), 'Don saved successfully');
    }

    /**
     * Display the specified Don.
     * GET|HEAD /dons/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Don $don */
        $don = $this->donRepository->findWithoutFail($id);

        if (empty($don)) {
            return $this->sendError('Don not found');
        }

        return $this->sendResponse($don->toArray(), 'Don retrieved successfully');
    }

    /**
     * Update the specified Don in storage.
     * PUT/PATCH /dons/{id}
     *
     * @param  int $id
     * @param UpdateDonAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDonAPIRequest $request)
    {
        $input = $request->all();

        /** @var Don $don */
        $don = $this->donRepository->findWithoutFail($id);

        if (empty($don)) {
            return $this->sendError('Don not found');
        }

        $don = $this->donRepository->update($input, $id);

        return $this->sendResponse($don->toArray(), 'Don updated successfully');
    }

    /**
     * Remove the specified Don from storage.
     * DELETE /dons/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Don $don */
        $don = $this->donRepository->findWithoutFail($id);

        if (empty($don)) {
            return $this->sendError('Don not found');
        }

        $don->delete();

        return $this->sendResponse($id, 'Don deleted successfully');
    }
}
