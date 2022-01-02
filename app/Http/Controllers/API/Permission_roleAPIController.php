<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePermission_roleAPIRequest;
use App\Http\Requests\API\UpdatePermission_roleAPIRequest;
use App\Models\Permission_role;
use App\Repositories\Permission_roleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class Permission_roleController
 * @package App\Http\Controllers\API
 */

class Permission_roleAPIController extends AppBaseController
{
    /** @var  Permission_roleRepository */
    private $permissionRoleRepository;

    public function __construct(Permission_roleRepository $permissionRoleRepo)
    {
        $this->permissionRoleRepository = $permissionRoleRepo;
    }

    /**
     * Display a listing of the Permission_role.
     * GET|HEAD /permissionRoles
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->permissionRoleRepository->pushCriteria(new RequestCriteria($request));
        $this->permissionRoleRepository->pushCriteria(new LimitOffsetCriteria($request));
        $permissionRoles = $this->permissionRoleRepository->all();

        return $this->sendResponse($permissionRoles->toArray(), 'Permission Roles retrieved successfully');
    }

    /**
     * Store a newly created Permission_role in storage.
     * POST /permissionRoles
     *
     * @param CreatePermission_roleAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePermission_roleAPIRequest $request)
    {
        $input = $request->all();

        $permissionRoles = $this->permissionRoleRepository->create($input);

        return $this->sendResponse($permissionRoles->toArray(), 'Permission Role saved successfully');
    }

    /**
     * Display the specified Permission_role.
     * GET|HEAD /permissionRoles/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Permission_role $permissionRole */
        $permissionRole = $this->permissionRoleRepository->findWithoutFail($id);

        if (empty($permissionRole)) {
            return $this->sendError('Permission Role not found');
        }

        return $this->sendResponse($permissionRole->toArray(), 'Permission Role retrieved successfully');
    }

    /**
     * Update the specified Permission_role in storage.
     * PUT/PATCH /permissionRoles/{id}
     *
     * @param  int $id
     * @param UpdatePermission_roleAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePermission_roleAPIRequest $request)
    {
        $input = $request->all();

        /** @var Permission_role $permissionRole */
        $permissionRole = $this->permissionRoleRepository->findWithoutFail($id);

        if (empty($permissionRole)) {
            return $this->sendError('Permission Role not found');
        }

        $permissionRole = $this->permissionRoleRepository->update($input, $id);

        return $this->sendResponse($permissionRole->toArray(), 'Permission_role updated successfully');
    }

    /**
     * Remove the specified Permission_role from storage.
     * DELETE /permissionRoles/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Permission_role $permissionRole */
        $permissionRole = $this->permissionRoleRepository->findWithoutFail($id);

        if (empty($permissionRole)) {
            return $this->sendError('Permission Role not found');
        }

        $permissionRole->delete();

        return $this->sendResponse($id, 'Permission Role deleted successfully');
    }
}
