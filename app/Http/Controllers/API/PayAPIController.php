<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePayAPIRequest;
use App\Http\Requests\API\UpdatePayAPIRequest;
use App\Models\Pay;
use App\Repositories\PayRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PayController
 * @package App\Http\Controllers\API
 */

class PayAPIController extends AppBaseController
{
    /** @var  PayRepository */
    private $payRepository;

    public function __construct(PayRepository $payRepo)
    {
        $this->payRepository = $payRepo;
    }

    /**
     * Display a listing of the Pay.
     * GET|HEAD /pays
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->payRepository->pushCriteria(new RequestCriteria($request));
        $this->payRepository->pushCriteria(new LimitOffsetCriteria($request));
        $pays = $this->payRepository->all();

        return $this->sendResponse($pays->toArray(), 'Pays retrieved successfully');
    }

    /**
     * Store a newly created Pay in storage.
     * POST /pays
     *
     * @param CreatePayAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePayAPIRequest $request)
    {
        $input = $request->all();

        $pays = $this->payRepository->create($input);

        return $this->sendResponse($pays->toArray(), 'Pay saved successfully');
    }

    /**
     * Display the specified Pay.
     * GET|HEAD /pays/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Pay $pay */
        $pay = $this->payRepository->findWithoutFail($id);

        if (empty($pay)) {
            return $this->sendError('Pay not found');
        }

        return $this->sendResponse($pay->toArray(), 'Pay retrieved successfully');
    }

    /**
     * Update the specified Pay in storage.
     * PUT/PATCH /pays/{id}
     *
     * @param  int $id
     * @param UpdatePayAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePayAPIRequest $request)
    {
        $input = $request->all();

        /** @var Pay $pay */
        $pay = $this->payRepository->findWithoutFail($id);

        if (empty($pay)) {
            return $this->sendError('Pay not found');
        }

        $pay = $this->payRepository->update($input, $id);

        return $this->sendResponse($pay->toArray(), 'Pay updated successfully');
    }

    /**
     * Remove the specified Pay from storage.
     * DELETE /pays/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Pay $pay */
        $pay = $this->payRepository->findWithoutFail($id);

        if (empty($pay)) {
            return $this->sendError('Pay not found');
        }

        $pay->delete();

        return $this->sendResponse($id, 'Pay deleted successfully');
    }
}
