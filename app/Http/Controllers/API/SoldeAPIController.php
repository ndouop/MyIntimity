<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSoldeAPIRequest;
use App\Http\Requests\API\UpdateSoldeAPIRequest;
use App\Models\Solde;
use App\Repositories\SoldeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class SoldeController
 * @package App\Http\Controllers\API
 */

class SoldeAPIController extends AppBaseController
{
    /** @var  SoldeRepository */
    private $soldeRepository;

    public function __construct(SoldeRepository $soldeRepo)
    {
        $this->soldeRepository = $soldeRepo;
    }

    /**
     * Display a listing of the Solde.
     * GET|HEAD /soldes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->soldeRepository->pushCriteria(new RequestCriteria($request));
        $this->soldeRepository->pushCriteria(new LimitOffsetCriteria($request));
        $soldes = $this->soldeRepository->all();

        return $this->sendResponse($soldes->toArray(), 'Soldes retrieved successfully');
    }

    /**
     * Store a newly created Solde in storage.
     * POST /soldes
     *
     * @param CreateSoldeAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSoldeAPIRequest $request)
    {
        $input = $request->all();

        $soldes = $this->soldeRepository->create($input);

        return $this->sendResponse($soldes->toArray(), 'Solde saved successfully');
    }

    /**
     * Display the specified Solde.
     * GET|HEAD /soldes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Solde $solde */
        $solde = $this->soldeRepository->findWithoutFail($id);

        if (empty($solde)) {
            return $this->sendError('Solde not found');
        }

        return $this->sendResponse($solde->toArray(), 'Solde retrieved successfully');
    }

    /**
     * Update the specified Solde in storage.
     * PUT/PATCH /soldes/{id}
     *
     * @param  int $id
     * @param UpdateSoldeAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSoldeAPIRequest $request)
    {
        $input = $request->all();

        /** @var Solde $solde */
        $solde = $this->soldeRepository->findWithoutFail($id);

        if (empty($solde)) {
            return $this->sendError('Solde not found');
        }

        $solde = $this->soldeRepository->update($input, $id);

        return $this->sendResponse($solde->toArray(), 'Solde updated successfully');
    }

    /**
     * Remove the specified Solde from storage.
     * DELETE /soldes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Solde $solde */
        $solde = $this->soldeRepository->findWithoutFail($id);

        if (empty($solde)) {
            return $this->sendError('Solde not found');
        }

        $solde->delete();

        return $this->sendResponse($id, 'Solde deleted successfully');
    }
}
