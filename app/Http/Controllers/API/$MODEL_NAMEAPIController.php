<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Create$MODEL_NAMEAPIRequest;
use App\Http\Requests\API\Update$MODEL_NAMEAPIRequest;
use App\Models\$MODEL_NAME;
use App\Repositories\$MODEL_NAMERepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class $MODEL_NAMEController
 * @package App\Http\Controllers\API
 */

class $MODEL_NAMEAPIController extends AppBaseController
{
    /** @var  $MODEL_NAMERepository */
    private $$MODELNAMERepository;

    public function __construct($MODEL_NAMERepository $$MODELNAMERepo)
    {
        $this->$MODELNAMERepository = $$MODELNAMERepo;
    }

    /**
     * Display a listing of the $MODEL_NAME.
     * GET|HEAD /$MODELNAMES
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->$MODELNAMERepository->pushCriteria(new RequestCriteria($request));
        $this->$MODELNAMERepository->pushCriteria(new LimitOffsetCriteria($request));
        $$MODELNAMES = $this->$MODELNAMERepository->all();

        return $this->sendResponse($$MODELNAMES->toArray(), '$ M O D E L  N A M E S retrieved successfully');
    }

    /**
     * Store a newly created $MODEL_NAME in storage.
     * POST /$MODELNAMES
     *
     * @param Create$MODEL_NAMEAPIRequest $request
     *
     * @return Response
     */
    public function store(Create$MODEL_NAMEAPIRequest $request)
    {
        $input = $request->all();

        $$MODELNAMES = $this->$MODELNAMERepository->create($input);

        return $this->sendResponse($$MODELNAMES->toArray(), '$ M O D E L  N A M E saved successfully');
    }

    /**
     * Display the specified $MODEL_NAME.
     * GET|HEAD /$MODELNAMES/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var $MODEL_NAME $$MODELNAME */
        $$MODELNAME = $this->$MODELNAMERepository->findWithoutFail($id);

        if (empty($$MODELNAME)) {
            return $this->sendError('$ M O D E L  N A M E not found');
        }

        return $this->sendResponse($$MODELNAME->toArray(), '$ M O D E L  N A M E retrieved successfully');
    }

    /**
     * Update the specified $MODEL_NAME in storage.
     * PUT/PATCH /$MODELNAMES/{id}
     *
     * @param  int $id
     * @param Update$MODEL_NAMEAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Update$MODEL_NAMEAPIRequest $request)
    {
        $input = $request->all();

        /** @var $MODEL_NAME $$MODELNAME */
        $$MODELNAME = $this->$MODELNAMERepository->findWithoutFail($id);

        if (empty($$MODELNAME)) {
            return $this->sendError('$ M O D E L  N A M E not found');
        }

        $$MODELNAME = $this->$MODELNAMERepository->update($input, $id);

        return $this->sendResponse($$MODELNAME->toArray(), '$MODEL_NAME updated successfully');
    }

    /**
     * Remove the specified $MODEL_NAME from storage.
     * DELETE /$MODELNAMES/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var $MODEL_NAME $$MODELNAME */
        $$MODELNAME = $this->$MODELNAMERepository->findWithoutFail($id);

        if (empty($$MODELNAME)) {
            return $this->sendError('$ M O D E L  N A M E not found');
        }

        $$MODELNAME->delete();

        return $this->sendResponse($id, '$ M O D E L  N A M E deleted successfully');
    }
}
