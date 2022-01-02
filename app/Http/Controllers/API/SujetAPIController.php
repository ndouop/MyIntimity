<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSujetAPIRequest;
use App\Http\Requests\API\UpdateSujetAPIRequest;
use App\Models\Sujet;
use App\Repositories\SujetRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class SujetController
 * @package App\Http\Controllers\API
 */

class SujetAPIController extends AppBaseController
{
    /** @var  SujetRepository */
    private $sujetRepository;

    public function __construct(SujetRepository $sujetRepo)
    {
        $this->sujetRepository = $sujetRepo;
    }

    /**
     * Display a listing of the Sujet.
     * GET|HEAD /sujets
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->sujetRepository->pushCriteria(new RequestCriteria($request));
        $this->sujetRepository->pushCriteria(new LimitOffsetCriteria($request));
        $sujets = $this->sujetRepository->all();

        return $this->sendResponse($sujets->toArray(), 'Sujets retrieved successfully');
    }

    /**
     * Store a newly created Sujet in storage.
     * POST /sujets
     *
     * @param CreateSujetAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSujetAPIRequest $request)
    {
        $input = $request->all();

        $sujets = $this->sujetRepository->create($input);

        return $this->sendResponse($sujets->toArray(), 'Sujet saved successfully');
    }

    /**
     * Display the specified Sujet.
     * GET|HEAD /sujets/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Sujet $sujet */
        $sujet = $this->sujetRepository->findWithoutFail($id);

        if (empty($sujet)) {
            return $this->sendError('Sujet not found');
        }

        return $this->sendResponse($sujet->toArray(), 'Sujet retrieved successfully');
    }

    /**
     * Update the specified Sujet in storage.
     * PUT/PATCH /sujets/{id}
     *
     * @param  int $id
     * @param UpdateSujetAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSujetAPIRequest $request)
    {
        $input = $request->all();

        /** @var Sujet $sujet */
        $sujet = $this->sujetRepository->findWithoutFail($id);

        if (empty($sujet)) {
            return $this->sendError('Sujet not found');
        }

        $sujet = $this->sujetRepository->update($input, $id);

        return $this->sendResponse($sujet->toArray(), 'Sujet updated successfully');
    }

    /**
     * Remove the specified Sujet from storage.
     * DELETE /sujets/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Sujet $sujet */
        $sujet = $this->sujetRepository->findWithoutFail($id);

        if (empty($sujet)) {
            return $this->sendError('Sujet not found');
        }

        $sujet->delete();

        return $this->sendResponse($id, 'Sujet deleted successfully');
    }
}
