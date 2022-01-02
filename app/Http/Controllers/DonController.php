<?php

namespace App\Http\Controllers;

use App\DataTables\DonDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateDonRequest;
use App\Http\Requests\UpdateDonRequest;
use App\Repositories\DonRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class DonController extends AppBaseController
{
    /** @var  DonRepository */
    private $donRepository;

    public function __construct(DonRepository $donRepo)
    {
        $this->donRepository = $donRepo;
    }

    /**
     * Display a listing of the Don.
     *
     * @param DonDataTable $donDataTable
     * @return Response
     */
    public function index(DonDataTable $donDataTable)
    {
        return $donDataTable->render('dons.index');
    }

    /**
     * Show the form for creating a new Don.
     *
     * @return Response
     */

    public function donate_mode()
    {
        return view('dons.mode'); 
    }

    public function create()
    {
         return view('dons.mode'); 
    }

    /**
     * Store a newly created Don in storage.
     *
     * @param CreateDonRequest $request
     *
     * @return Response
     */
    public function store(CreateDonRequest $request)
    {
        $input = $request->all();

        $don = $this->donRepository->create($input);

        Flash::success('Don saved successfully.');

        return redirect(route('dons.index'));
    }

    /**
     * Display the specified Don.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $don = $this->donRepository->findWithoutFail($id);

        if (empty($don)) {
            Flash::error('Don not found');

            return redirect(route('dons.index'));
        }

        return view('dons.show')->with('don', $don);
    }

    /**
     * Show the form for editing the specified Don.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $don = $this->donRepository->findWithoutFail($id);

        if (empty($don)) {
            Flash::error('Don not found');

            return redirect(route('dons.index'));
        }

        return view('dons.edit')->with('don', $don);
    }

    /**
     * Update the specified Don in storage.
     *
     * @param  int              $id
     * @param UpdateDonRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDonRequest $request)
    {
        $don = $this->donRepository->findWithoutFail($id);

        if (empty($don)) {
            Flash::error('Don not found');

            return redirect(route('dons.index'));
        }

        $don = $this->donRepository->update($request->all(), $id);

        Flash::success('Don updated successfully.');

        return redirect(route('dons.index'));
    }

    /**
     * Remove the specified Don from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $don = $this->donRepository->findWithoutFail($id);

        if (empty($don)) {
            Flash::error('Don not found');

            return redirect(route('dons.index'));
        }

        $this->donRepository->delete($id);

        Flash::success('Don deleted successfully.');

        return redirect(route('dons.index'));
    }
}
