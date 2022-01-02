<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFichierAPIRequest;
use App\Http\Requests\API\UpdateFichierAPIRequest;
use App\Models\Fichier;
use App\Repositories\FichierRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class FichierController
 * @package App\Http\Controllers\API
 */

class FichierAPIController extends AppBaseController
{
    /** @var  FichierRepository */
    private $fichierRepository;

    public function __construct(FichierRepository $fichierRepo)
    {
        $this->fichierRepository = $fichierRepo;
    }

    /**
     * Display a listing of the Fichier.
     * GET|HEAD /fichiers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->fichierRepository->pushCriteria(new RequestCriteria($request));
        $this->fichierRepository->pushCriteria(new LimitOffsetCriteria($request));
        $fichiers = $this->fichierRepository->all();

        return $this->sendResponse($fichiers->toArray(), 'Fichiers retrieved successfully');
    }

    /**
     * Store a newly created Fichier in storage.
     * POST /fichiers
     *
     * @param CreateFichierAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateFichierAPIRequest $request)
    {
        $input = $request->all();

        $fichiers = $this->fichierRepository->create($input);

        return $this->sendResponse($fichiers->toArray(), 'Fichier saved successfully');
    }

    /**
     * Display the specified Fichier.
     * GET|HEAD /fichiers/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Fichier $fichier */
        $fichier = $this->fichierRepository->findWithoutFail($id);

        if (empty($fichier)) {
            return $this->sendError('Fichier not found');
        }

        return $this->sendResponse($fichier->toArray(), 'Fichier retrieved successfully');
    }

    /**
     * Update the specified Fichier in storage.
     * PUT/PATCH /fichiers/{id}
     *
     * @param  int $id
     * @param UpdateFichierAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFichierAPIRequest $request)
    {
        $input = $request->all();

        /** @var Fichier $fichier */
        $fichier = $this->fichierRepository->findWithoutFail($id);

        if (empty($fichier)) {
            return $this->sendError('Fichier not found');
        }

        $fichier = $this->fichierRepository->update($input, $id);

        return $this->sendResponse($fichier->toArray(), 'Fichier updated successfully');
    }

    /**
     * Remove the specified Fichier from storage.
     * DELETE /fichiers/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Fichier $fichier */
        $fichier = $this->fichierRepository->findWithoutFail($id);

        if (empty($fichier)) {
            return $this->sendError('Fichier not found');
        }

        $fichier->delete();

        return $this->sendResponse($id, 'Fichier deleted successfully');
    }
}
