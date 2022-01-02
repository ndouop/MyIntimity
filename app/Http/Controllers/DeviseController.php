<?php

namespace App\Http\Controllers;

use App\DataTables\DeviseDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateDeviseRequest;
use App\Http\Requests\UpdateDeviseRequest;
use App\Repositories\DeviseRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class DeviseController extends AppBaseController
{
    /** @var  DeviseRepository */
    private $deviseRepository;

    public function __construct(DeviseRepository $deviseRepo)
    {
        $this->deviseRepository = $deviseRepo;
    }

    /**
     * Display a listing of the Devise.
     *
     * @param DeviseDataTable $deviseDataTable
     * @return Response
     */
    public function index(DeviseDataTable $deviseDataTable)
    {
        return $deviseDataTable->render('devises.index');
    }

    /**
     * Show the form for creating a new Devise.
     *
     * @return Response
     */
    public function create()
    {
        return view('devises.create');
    }

    /**
     * Store a newly created Devise in storage.
     *
     * @param CreateDeviseRequest $request
     *
     * @return Response
     */
    public function store(CreateDeviseRequest $request)
    {
        $input = $request->all();

        $devise = $this->deviseRepository->create($input);

        Flash::success('Devise saved successfully.');

        return redirect(route('devises.index'));
    }

    /**
     * Display the specified Devise.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $devise = $this->deviseRepository->findWithoutFail($id);

        if (empty($devise)) {
            Flash::error('Devise not found');

            return redirect(route('devises.index'));
        }

        return view('devises.show')->with('devise', $devise);
    }

    /**
     * Show the form for editing the specified Devise.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $devise = $this->deviseRepository->findWithoutFail($id);

        if (empty($devise)) {
            Flash::error('Devise not found');

            return redirect(route('devises.index'));
        }

        return view('devises.edit')->with('devise', $devise);
    }

    /**
     * Update the specified Devise in storage.
     *
     * @param  int              $id
     * @param UpdateDeviseRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDeviseRequest $request)
    {
        $devise = $this->deviseRepository->findWithoutFail($id);

        if (empty($devise)) {
            Flash::error('Devise not found');

            return redirect(route('devises.index'));
        }

        $devise = $this->deviseRepository->update($request->all(), $id);

        Flash::success('Devise updated successfully.');

        return redirect(route('devises.index'));
    }

    /**
     * Remove the specified Devise from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $devise = $this->deviseRepository->findWithoutFail($id);

        if (empty($devise)) {
            Flash::error('Devise not found');

            return redirect(route('devises.index'));
        }

        $this->deviseRepository->delete($id);

        Flash::success('Devise deleted successfully.');

        return redirect(route('devises.index'));
    }
}
