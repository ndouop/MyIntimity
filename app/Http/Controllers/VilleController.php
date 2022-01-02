<?php

namespace App\Http\Controllers;

use App\DataTables\VilleDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateVilleRequest;
use App\Http\Requests\UpdateVilleRequest;
use App\Repositories\VilleRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class VilleController extends AppBaseController
{
    /** @var  VilleRepository */
    private $villeRepository;

    public function __construct(VilleRepository $villeRepo)
    {
        $this->villeRepository = $villeRepo;
    }

    /**
     * Display a listing of the Ville.
     *
     * @param VilleDataTable $villeDataTable
     * @return Response
     */
    public function index(VilleDataTable $villeDataTable)
    {
        return $villeDataTable->render('villes.index');
    }

    /**
     * Show the form for creating a new Ville.
     *
     * @return Response
     */
    public function create()
    {
        return view('villes.create');
    }

    /**
     * Store a newly created Ville in storage.
     *
     * @param CreateVilleRequest $request
     *
     * @return Response
     */
    public function store(CreateVilleRequest $request)
    {
        $input = $request->all();

        $ville = $this->villeRepository->create($input);

        Flash::success('Ville saved successfully.');

        return redirect(route('villes.index'));
    }

    /**
     * Display the specified Ville.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $ville = $this->villeRepository->findWithoutFail($id);

        if (empty($ville)) {
            Flash::error('Ville not found');

            return redirect(route('villes.index'));
        }

        return view('villes.show')->with('ville', $ville);
    }

    /**
     * Show the form for editing the specified Ville.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $ville = $this->villeRepository->findWithoutFail($id);

        if (empty($ville)) {
            Flash::error('Ville not found');

            return redirect(route('villes.index'));
        }

        return view('villes.edit')->with('ville', $ville);
    }

    /**
     * Update the specified Ville in storage.
     *
     * @param  int              $id
     * @param UpdateVilleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVilleRequest $request)
    {
        $ville = $this->villeRepository->findWithoutFail($id);

        if (empty($ville)) {
            Flash::error('Ville not found');

            return redirect(route('villes.index'));
        }

        $ville = $this->villeRepository->update($request->all(), $id);

        Flash::success('Ville updated successfully.');

        return redirect(route('villes.index'));
    }

    /**
     * Remove the specified Ville from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $ville = $this->villeRepository->findWithoutFail($id);

        if (empty($ville)) {
            Flash::error('Ville not found');

            return redirect(route('villes.index'));
        }

        $this->villeRepository->delete($id);

        Flash::success('Ville deleted successfully.');

        return redirect(route('villes.index'));
    }
}
