<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRole_userAPIRequest;
use App\Http\Requests\API\UpdateRole_userAPIRequest;
use App\Models\Role_user;
use App\Repositories\Role_userRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class Role_userController
 * @package App\Http\Controllers\API
 */

class Role_userAPIController extends AppBaseController
{
    /** @var  Role_userRepository */
    private $roleUserRepository;

    public function __construct(Role_userRepository $roleUserRepo)
    {
        $this->roleUserRepository = $roleUserRepo;
    }

    /**
     * Display a listing of the Role_user.
     * GET|HEAD /roleUsers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->roleUserRepository->pushCriteria(new RequestCriteria($request));
        $this->roleUserRepository->pushCriteria(new LimitOffsetCriteria($request));
        $roleUsers = $this->roleUserRepository->all();

        return $this->sendResponse($roleUsers->toArray(), 'Role Users retrieved successfully');
    }

    /**
     * Store a newly created Role_user in storage.
     * POST /roleUsers
     *
     * @param CreateRole_userAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateRole_userAPIRequest $request)
    {
        $input = $request->all();

        $roleUsers = $this->roleUserRepository->create($input);

        return $this->sendResponse($roleUsers->toArray(), 'Role User saved successfully');
    }

    /**
     * Display the specified Role_user.
     * GET|HEAD /roleUsers/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Role_user $roleUser */
        $roleUser = $this->roleUserRepository->findWithoutFail($id);

        if (empty($roleUser)) {
            return $this->sendError('Role User not found');
        }

        return $this->sendResponse($roleUser->toArray(), 'Role User retrieved successfully');
    }

    /**
     * Update the specified Role_user in storage.
     * PUT/PATCH /roleUsers/{id}
     *
     * @param  int $id
     * @param UpdateRole_userAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRole_userAPIRequest $request)
    {
        $input = $request->all();

        /** @var Role_user $roleUser */
        $roleUser = $this->roleUserRepository->findWithoutFail($id);

        if (empty($roleUser)) {
            return $this->sendError('Role User not found');
        }

        $roleUser = $this->roleUserRepository->update($input, $id);

        return $this->sendResponse($roleUser->toArray(), 'Role_user updated successfully');
    }

    /**
     * Remove the specified Role_user from storage.
     * DELETE /roleUsers/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Role_user $roleUser */
        $roleUser = $this->roleUserRepository->findWithoutFail($id);

        if (empty($roleUser)) {
            return $this->sendError('Role User not found');
        }

        $roleUser->delete();

        return $this->sendResponse($id, 'Role User deleted successfully');
    }
}
