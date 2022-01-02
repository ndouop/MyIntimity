<?php

namespace App\Http\Controllers;

use App\DataTables\SoldeDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSoldeRequest;
use App\Http\Requests\UpdateSoldeRequest;
use App\Repositories\SoldeRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class SoldeController extends AppBaseController
{
    /** @var  SoldeRepository */
    private $soldeRepository;

    public function __construct(SoldeRepository $soldeRepo)
    {
        $this->soldeRepository = $soldeRepo;
    }

    /**
     * Display a listing of the Solde.
     *
     * @param SoldeDataTable $soldeDataTable
     * @return Response
     */
    public function index(SoldeDataTable $soldeDataTable)
    {
        return $soldeDataTable->render('soldes.index');
    }

    /**
     * Show the form for creating a new Solde.
     *
     * @return Response
     */
    public function create()
    {
        return view('soldes.create');
    }

    /**
     * Store a newly created Solde in storage.
     *
     * @param CreateSoldeRequest $request
     *
     * @return Response
     */
    public function store(CreateSoldeRequest $request)
    {
        $input = $request->all();

        $solde = $this->soldeRepository->create($input);

        Flash::success('Solde saved successfully.');

        return redirect(route('soldes.index'));
    }

    /**
     * Display the specified Solde.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $solde = $this->soldeRepository->findWithoutFail($id);

        if (empty($solde)) {
            Flash::error('Solde not found');

            return redirect(route('soldes.index'));
        }

        return view('soldes.show')->with('solde', $solde);
    }

    /**
     * Show the form for editing the specified Solde.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $solde = $this->soldeRepository->findWithoutFail($id);

        if (empty($solde)) {
            Flash::error('Solde not found');

            return redirect(route('soldes.index'));
        }

        return view('soldes.edit')->with('solde', $solde);
    }

    /**
     * Update the specified Solde in storage.
     *
     * @param  int              $id
     * @param UpdateSoldeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSoldeRequest $request)
    {
        $solde = $this->soldeRepository->findWithoutFail($id);

        if (empty($solde)) {
            Flash::error('Solde not found');

            return redirect(route('soldes.index'));
        }

        $solde = $this->soldeRepository->update($request->all(), $id);

        Flash::success('Solde updated successfully.');

        return redirect(route('soldes.index'));
    }

    /**
     * Remove the specified Solde from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $solde = $this->soldeRepository->findWithoutFail($id);

        if (empty($solde)) {
            Flash::error('Solde not found');

            return redirect(route('soldes.index'));
        }

        $this->soldeRepository->delete($id);

        Flash::success('Solde deleted successfully.');

        return redirect(route('soldes.index'));
    }
}
