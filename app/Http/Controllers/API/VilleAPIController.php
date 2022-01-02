<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateVilleAPIRequest;
use App\Http\Requests\API\UpdateVilleAPIRequest;
use App\Models\Ville;
use App\Repositories\VilleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class VilleController
 * @package App\Http\Controllers\API
 */

class VilleAPIController extends AppBaseController
{
    /** @var  VilleRepository */
    private $villeRepository;

    public function __construct(VilleRepository $villeRepo)
    {
        $this->villeRepository = $villeRepo;
    }

    /**
     * Display a listing of the Ville.
     * GET|HEAD /villes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->villeRepository->pushCriteria(new RequestCriteria($request));
        $this->villeRepository->pushCriteria(new LimitOffsetCriteria($request));
        $villes = $this->villeRepository->all();

        return $this->sendResponse($villes->toArray(), 'Villes retrieved successfully');
    }

    /**
     * Store a newly created Ville in storage.
     * POST /villes
     *
     * @param CreateVilleAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateVilleAPIRequest $request)
    {
        $input = $request->all();

        $villes = $this->villeRepository->create($input);

        return $this->sendResponse($villes->toArray(), 'Ville saved successfully');
    }

    /**
     * Display the specified Ville.
     * GET|HEAD /villes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Ville $ville */
        $ville = $this->villeRepository->findWithoutFail($id);

        if (empty($ville)) {
            return $this->sendError('Ville not found');
        }

        return $this->sendResponse($ville->toArray(), 'Ville retrieved successfully');
    }

    /**
     * Update the specified Ville in storage.
     * PUT/PATCH /villes/{id}
     *
     * @param  int $id
     * @param UpdateVilleAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVilleAPIRequest $request)
    {
        $input = $request->all();

        /** @var Ville $ville */
        $ville = $this->villeRepository->findWithoutFail($id);

        if (empty($ville)) {
            return $this->sendError('Ville not found');
        }

        $ville = $this->villeRepository->update($input, $id);

        return $this->sendResponse($ville->toArray(), 'Ville updated successfully');
    }

    /**
     * Remove the specified Ville from storage.
     * DELETE /villes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Ville $ville */
        $ville = $this->villeRepository->findWithoutFail($id);

        if (empty($ville)) {
            return $this->sendError('Ville not found');
        }

        $ville->delete();

        return $this->sendResponse($id, 'Ville deleted successfully');
    }
}
