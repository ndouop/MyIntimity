<?php

namespace App\Http\Controllers;

use App\DataTables\PayDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatePayRequest;
use App\Http\Requests\UpdatePayRequest;
use App\Repositories\PayRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class PayController extends AppBaseController
{
    /** @var  PayRepository */
    private $payRepository;

    public function __construct(PayRepository $payRepo)
    {
        $this->payRepository = $payRepo;
    }

    /**
     * Display a listing of the Pay.
     *
     * @param PayDataTable $payDataTable
     * @return Response
     */
    public function index(PayDataTable $payDataTable)
    {
        return $payDataTable->render('pays.index');
    }

    /**
     * Show the form for creating a new Pay.
     *
     * @return Response
     */
    public function create()
    {
        return view('pays.create');
    }

    /**
     * Store a newly created Pay in storage.
     *
     * @param CreatePayRequest $request
     *
     * @return Response
     */
    public function store(CreatePayRequest $request)
    {
        $input = $request->all();

        $pay = $this->payRepository->create($input);

        Flash::success('Pay saved successfully.');

        return redirect(route('pays.index'));
    }

    /**
     * Display the specified Pay.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pay = $this->payRepository->findWithoutFail($id);

        if (empty($pay)) {
            Flash::error('Pay not found');

            return redirect(route('pays.index'));
        }

        return view('pays.show')->with('pay', $pay);
    }

    /**
     * Show the form for editing the specified Pay.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pay = $this->payRepository->findWithoutFail($id);

        if (empty($pay)) {
            Flash::error('Pay not found');

            return redirect(route('pays.index'));
        }

        return view('pays.edit')->with('pay', $pay);
    }

    /**
     * Update the specified Pay in storage.
     *
     * @param  int              $id
     * @param UpdatePayRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePayRequest $request)
    {
        $pay = $this->payRepository->findWithoutFail($id);

        if (empty($pay)) {
            Flash::error('Pay not found');

            return redirect(route('pays.index'));
        }

        $pay = $this->payRepository->update($request->all(), $id);

        Flash::success('Pay updated successfully.');

        return redirect(route('pays.index'));
    }

    /**
     * Remove the specified Pay from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pay = $this->payRepository->findWithoutFail($id);

        if (empty($pay)) {
            Flash::error('Pay not found');

            return redirect(route('pays.index'));
        }

        $this->payRepository->delete($id);

        Flash::success('Pay deleted successfully.');

        return redirect(route('pays.index'));
    }
}
