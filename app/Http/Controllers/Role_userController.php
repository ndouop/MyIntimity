<?php

namespace App\Http\Controllers;

use App\DataTables\Role_userDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateRole_userRequest;
use App\Http\Requests\UpdateRole_userRequest;
use App\Repositories\Role_userRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class Role_userController extends AppBaseController
{
    /** @var  Role_userRepository */
    private $roleUserRepository;

    public function __construct(Role_userRepository $roleUserRepo)
    {
        $this->roleUserRepository = $roleUserRepo;
    }

    /**
     * Display a listing of the Role_user.
     *
     * @param Role_userDataTable $roleUserDataTable
     * @return Response
     */
    public function index(Role_userDataTable $roleUserDataTable)
    {
        return $roleUserDataTable->render('role_users.index');
    }

    /**
     * Show the form for creating a new Role_user.
     *
     * @return Response
     */
    public function create()
    {
        return view('role_users.create');
    }

    /**
     * Store a newly created Role_user in storage.
     *
     * @param CreateRole_userRequest $request
     *
     * @return Response
     */
    public function store(CreateRole_userRequest $request)
    {
        $input = $request->all();

        $roleUser = $this->roleUserRepository->create($input);

        Flash::success('Role User saved successfully.');

        return redirect(route('roleUsers.index'));
    }

    /**
     * Display the specified Role_user.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $roleUser = $this->roleUserRepository->findWithoutFail($id);

        if (empty($roleUser)) {
            Flash::error('Role User not found');

            return redirect(route('roleUsers.index'));
        }

        return view('role_users.show')->with('roleUser', $roleUser);
    }

    /**
     * Show the form for editing the specified Role_user.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $roleUser = $this->roleUserRepository->findWithoutFail($id);

        if (empty($roleUser)) {
            Flash::error('Role User not found');

            return redirect(route('roleUsers.index'));
        }

        return view('role_users.edit')->with('roleUser', $roleUser);
    }

    /**
     * Update the specified Role_user in storage.
     *
     * @param  int              $id
     * @param UpdateRole_userRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRole_userRequest $request)
    {
        $roleUser = $this->roleUserRepository->findWithoutFail($id);

        if (empty($roleUser)) {
            Flash::error('Role User not found');

            return redirect(route('roleUsers.index'));
        }

        $roleUser = $this->roleUserRepository->update($request->all(), $id);

        Flash::success('Role User updated successfully.');

        return redirect(route('roleUsers.index'));
    }

    /**
     * Remove the specified Role_user from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $roleUser = $this->roleUserRepository->findWithoutFail($id);

        if (empty($roleUser)) {
            Flash::error('Role User not found');

            return redirect(route('roleUsers.index'));
        }

        $this->roleUserRepository->delete($id);

        Flash::success('Role User deleted successfully.');

        return redirect(route('roleUsers.index'));
    }
}
