<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCategorieAPIRequest;
use App\Http\Requests\API\UpdateCategorieAPIRequest;
use App\Models\Categorie;
use App\Repositories\CategorieRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CategorieController
 * @package App\Http\Controllers\API
 */

class CategorieAPIController extends AppBaseController
{
    /** @var  CategorieRepository */
    private $categorieRepository;

    public function __construct(CategorieRepository $categorieRepo)
    {
        $this->categorieRepository = $categorieRepo;
    }

    /**
     * Display a listing of the Categorie.
     * GET|HEAD /categories
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->categorieRepository->pushCriteria(new RequestCriteria($request));
        $this->categorieRepository->pushCriteria(new LimitOffsetCriteria($request));
        $categories = $this->categorieRepository->all();

        return $this->sendResponse($categories->toArray(), 'Categories retrieved successfully');
    }

    /**
     * Store a newly created Categorie in storage.
     * POST /categories
     *
     * @param CreateCategorieAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCategorieAPIRequest $request)
    {
        $input = $request->all();

        $categories = $this->categorieRepository->create($input);

        return $this->sendResponse($categories->toArray(), 'Categorie saved successfully');
    }

    /**
     * Display the specified Categorie.
     * GET|HEAD /categories/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Categorie $categorie */
        $categorie = $this->categorieRepository->findWithoutFail($id);

        if (empty($categorie)) {
            return $this->sendError('Categorie not found');
        }

        return $this->sendResponse($categorie->toArray(), 'Categorie retrieved successfully');
    }

    /**
     * Update the specified Categorie in storage.
     * PUT/PATCH /categories/{id}
     *
     * @param  int $id
     * @param UpdateCategorieAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategorieAPIRequest $request)
    {
        $input = $request->all();

        /** @var Categorie $categorie */
        $categorie = $this->categorieRepository->findWithoutFail($id);

        if (empty($categorie)) {
            return $this->sendError('Categorie not found');
        }

        $categorie = $this->categorieRepository->update($input, $id);

        return $this->sendResponse($categorie->toArray(), 'Categorie updated successfully');
    }

    /**
     * Remove the specified Categorie from storage.
     * DELETE /categories/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Categorie $categorie */
        $categorie = $this->categorieRepository->findWithoutFail($id);

        if (empty($categorie)) {
            return $this->sendError('Categorie not found');
        }

        $categorie->delete();

        return $this->sendResponse($id, 'Categorie deleted successfully');
    }
}
