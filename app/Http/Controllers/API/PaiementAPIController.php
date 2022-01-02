<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePaiementAPIRequest;
use App\Http\Requests\API\UpdatePaiementAPIRequest;
use App\Models\Paiement;
use App\Repositories\PaiementRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PaiementController
 * @package App\Http\Controllers\API
 */

class PaiementAPIController extends AppBaseController
{
    /** @var  PaiementRepository */
    private $paiementRepository;

    public function __construct(PaiementRepository $paiementRepo)
    {
        $this->paiementRepository = $paiementRepo;
    }

    /**
     * Display a listing of the Paiement.
     * GET|HEAD /paiements
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->paiementRepository->pushCriteria(new RequestCriteria($request));
        $this->paiementRepository->pushCriteria(new LimitOffsetCriteria($request));
        $paiements = $this->paiementRepository->all();

        return $this->sendResponse($paiements->toArray(), 'Paiements retrieved successfully');
    }

    /**
     * Store a newly created Paiement in storage.
     * POST /paiements
     *
     * @param CreatePaiementAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePaiementAPIRequest $request)
    {
        $input = $request->all();

        $paiements = $this->paiementRepository->create($input);

        return $this->sendResponse($paiements->toArray(), 'Paiement saved successfully');
    }

    /**
     * Display the specified Paiement.
     * GET|HEAD /paiements/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Paiement $paiement */
        $paiement = $this->paiementRepository->findWithoutFail($id);

        if (empty($paiement)) {
            return $this->sendError('Paiement not found');
        }

        return $this->sendResponse($paiement->toArray(), 'Paiement retrieved successfully');
    }

    /**
     * Update the specified Paiement in storage.
     * PUT/PATCH /paiements/{id}
     *
     * @param  int $id
     * @param UpdatePaiementAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePaiementAPIRequest $request)
    {
        $input = $request->all();

        /** @var Paiement $paiement */
        $paiement = $this->paiementRepository->findWithoutFail($id);

        if (empty($paiement)) {
            return $this->sendError('Paiement not found');
        }

        $paiement = $this->paiementRepository->update($input, $id);

        return $this->sendResponse($paiement->toArray(), 'Paiement updated successfully');
    }

    /**
     * Remove the specified Paiement from storage.
     * DELETE /paiements/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Paiement $paiement */
        $paiement = $this->paiementRepository->findWithoutFail($id);

        if (empty($paiement)) {
            return $this->sendError('Paiement not found');
        }

        $paiement->delete();

        return $this->sendResponse($id, 'Paiement deleted successfully');
    }
}
