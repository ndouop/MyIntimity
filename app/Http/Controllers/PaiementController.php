<?php

namespace App\Http\Controllers;

use App\DataTables\PaiementDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatePaiementRequest;
use App\Http\Requests\UpdatePaiementRequest;
use App\Repositories\PaiementRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class PaiementController extends AppBaseController
{
    /** @var  PaiementRepository */
    private $paiementRepository;

    public function __construct(PaiementRepository $paiementRepo)
    {
        $this->paiementRepository = $paiementRepo;
    }

    /**
     * Display a listing of the Paiement.
     *
     * @param PaiementDataTable $paiementDataTable
     * @return Response
     */
    public function index(PaiementDataTable $paiementDataTable)
    {
        return $paiementDataTable->render('paiements.index');
    }

    /**
     * Show the form for creating a new Paiement.
     *
     * @return Response
     */
    public function create()
    {
        return view('paiements.create');
    }

    /**
     * Store a newly created Paiement in storage.
     *
     * @param CreatePaiementRequest $request
     *
     * @return Response
     */
    public function store(CreatePaiementRequest $request)
    {
        $input = $request->all();

        $paiement = $this->paiementRepository->create($input);

        Flash::success('Paiement saved successfully.');

        return redirect(route('paiements.index'));
    }

    /**
     * Display the specified Paiement.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $paiement = $this->paiementRepository->findWithoutFail($id);

        if (empty($paiement)) {
            Flash::error('Paiement not found');

            return redirect(route('paiements.index'));
        }

        return view('paiements.show')->with('paiement', $paiement);
    }

    /**
     * Show the form for editing the specified Paiement.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $paiement = $this->paiementRepository->findWithoutFail($id);

        if (empty($paiement)) {
            Flash::error('Paiement not found');

            return redirect(route('paiements.index'));
        }

        return view('paiements.edit')->with('paiement', $paiement);
    }

    /**
     * Update the specified Paiement in storage.
     *
     * @param  int              $id
     * @param UpdatePaiementRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePaiementRequest $request)
    {
        $paiement = $this->paiementRepository->findWithoutFail($id);

        if (empty($paiement)) {
            Flash::error('Paiement not found');

            return redirect(route('paiements.index'));
        }

        $paiement = $this->paiementRepository->update($request->all(), $id);

        Flash::success('Paiement updated successfully.');

        return redirect(route('paiements.index'));
    }

    /**
     * Remove the specified Paiement from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $paiement = $this->paiementRepository->findWithoutFail($id);

        if (empty($paiement)) {
            Flash::error('Paiement not found');

            return redirect(route('paiements.index'));
        }

        $this->paiementRepository->delete($id);

        Flash::success('Paiement deleted successfully.');

        return redirect(route('paiements.index'));
    }
}
