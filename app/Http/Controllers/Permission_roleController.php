<?php

namespace App\Http\Controllers;

use App\DataTables\Permission_roleDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatePermission_roleRequest;
use App\Http\Requests\UpdatePermission_roleRequest;
use App\Repositories\Permission_roleRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class Permission_roleController extends AppBaseController
{
    /** @var  Permission_roleRepository */
    private $permissionRoleRepository;

    public function __construct(Permission_roleRepository $permissionRoleRepo)
    {
        $this->permissionRoleRepository = $permissionRoleRepo;
    }

    /**
     * Display a listing of the Permission_role.
     *
     * @param Permission_roleDataTable $permissionRoleDataTable
     * @return Response
     */
    public function index(Permission_roleDataTable $permissionRoleDataTable)
    {
        return $permissionRoleDataTable->render('permission_roles.index');
    }

    /**
     * Show the form for creating a new Permission_role.
     *
     * @return Response
     */
    public function create()
    {
        return view('permission_roles.create');
    }

    /**
     * Store a newly created Permission_role in storage.
     *
     * @param CreatePermission_roleRequest $request
     *
     * @return Response
     */
    public function store(CreatePermission_roleRequest $request)
    {
        $input = $request->all();

        $permissionRole = $this->permissionRoleRepository->create($input);

        Flash::success('Permission Role saved successfully.');

        return redirect(route('permissionRoles.index'));
    }

    /**
     * Display the specified Permission_role.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $permissionRole = $this->permissionRoleRepository->findWithoutFail($id);

        if (empty($permissionRole)) {
            Flash::error('Permission Role not found');

            return redirect(route('permissionRoles.index'));
        }

        return view('permission_roles.show')->with('permissionRole', $permissionRole);
    }

    /**
     * Show the form for editing the specified Permission_role.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $permissionRole = $this->permissionRoleRepository->findWithoutFail($id);

        if (empty($permissionRole)) {
            Flash::error('Permission Role not found');

            return redirect(route('permissionRoles.index'));
        }

        return view('permission_roles.edit')->with('permissionRole', $permissionRole);
    }

    /**
     * Update the specified Permission_role in storage.
     *
     * @param  int              $id
     * @param UpdatePermission_roleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePermission_roleRequest $request)
    {
        $permissionRole = $this->permissionRoleRepository->findWithoutFail($id);

        if (empty($permissionRole)) {
            Flash::error('Permission Role not found');

            return redirect(route('permissionRoles.index'));
        }

        $permissionRole = $this->permissionRoleRepository->update($request->all(), $id);

        Flash::success('Permission Role updated successfully.');

        return redirect(route('permissionRoles.index'));
    }

    /**
     * Remove the specified Permission_role from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $permissionRole = $this->permissionRoleRepository->findWithoutFail($id);

        if (empty($permissionRole)) {
            Flash::error('Permission Role not found');

            return redirect(route('permissionRoles.index'));
        }

        $this->permissionRoleRepository->delete($id);

        Flash::success('Permission Role deleted successfully.');

        return redirect(route('permissionRoles.index'));
    }
}
