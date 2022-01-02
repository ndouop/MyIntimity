<?php

namespace App\Http\Controllers;

use App\DataTables\FriendDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateFriendRequest;
use App\Http\Requests\UpdateFriendRequest;
use App\Repositories\FriendRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request;
use App\Models\Friend;

class FriendController extends AppBaseController
{
    /** @var  FriendRepository */
    private $friendRepository;

    public function __construct(FriendRepository $friendRepo)
    {
        $this->friendRepository = $friendRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the Friend.
     *
     * @param FriendDataTable $friendDataTable
     * @return Response
     */
    public function index(FriendDataTable $friendDataTable)
    {
        return $friendDataTable->render('friends.index');
    }

    /**
     * Show the form for creating a new Friend.
     *
     * @return Response
     */
    public function create()
    {
        return view('friends.create');
    }

    /**
     * Store a newly created Friend in storage.
     *
     * @param CreateFriendRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $user_id = auth()->user()->id;
        $friend_id = $request->friend;

        $checkIfExist = Friend::where(function($query) use ($user_id,$friend_id) {
                                $query->where('user_id',$user_id);
                                $query->where('friend',$friend_id);
                            })
                            ->orWhere(function($query) use ($user_id,$friend_id) {
                                $query->where('user_id',$friend_id);
                                $query->where('friend',$user_id);
                            })->first();

        if (count($checkIfExist)) {
            if ($checkIfExist->etat) {
                return response()->json(['status'=>false,'motif'=>trans("back/friend.already_friend_with_this")]);
            }else{

                if ($checkIfExist->friend == $user_id) {
                    return response()->json(['status'=>false,'motif'=>trans("back/friend.confirm_friend_request").\HTML::link(url('friend/confirm/'.$request->friend.'/'.$user_id),trans("back/friend.confirm"))]);
                }
                if ($checkIfExist->friend == $request->friend) {
                    return response()->json(['status'=>false,'motif'=>trans("back/friend.wait_request_confirm")]);
                }
                
            }
        }



        try {

            Friend::create(['user_id'=>$user_id,'friend'=>$request->friend]);
            return response()->json(['status'=>true,'message'=>trans("back/frien.ask_sended")]);;

        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['status'=>false,'motif'=>trans("back/friend.error_store")]);
        }

    }

    /**
     * Display the specified Friend.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $friend = $this->friendRepository->findWithoutFail($id);

        if (empty($friend)) {
            Flash::error('Friend not found');

            return redirect(route('friends.index'));
        }

        return view('friends.show')->with('friend', $friend);
    }

    /**
     * Show the form for editing the specified Friend.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $friend = $this->friendRepository->findWithoutFail($id);

        if (empty($friend)) {
            Flash::error('Friend not found');

            return redirect(route('friends.index'));
        }

        return view('friends.edit')->with('friend', $friend);
    }

    /**
     * Update the specified Friend in storage.
     *
     * @param  int              $id
     * @param UpdateFriendRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFriendRequest $request)
    {
        $friend = $this->friendRepository->findWithoutFail($id);

        if (empty($friend)) {
            Flash::error('Friend not found');

            return redirect(route('friends.index'));
        }

        $friend = $this->friendRepository->update($request->all(), $id);

        Flash::success('Friend updated successfully.');

        return redirect(route('friends.index'));
    }

    /**
     * Remove the specified Friend from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $friend = $this->friendRepository->findWithoutFail($id);

        if (empty($friend)) {
            Flash::error('Friend not found');

            return redirect(route('friends.index'));
        }

        $this->friendRepository->delete($id);

        Flash::success('Friend deleted successfully.');

        return redirect(route('friends.index'));
    }

    public function weAreFriend($me_id,$friend_id)
    {

        $check = Friend::where(function($query) use ($me_id,$friend_id) {
                                $query->where('user_id',$me_id);
                                $query->where('friend',$friend_id);
                            })
                            ->orWhere(function($query) use ($me_id,$friend_id) {
                                $query->where('user_id',$friend_id);
                                $query->where('friend',$me_id);
                            })->first();
        if (count($check)) {
            return true;
        }else
            return false;
    }

    public function confirm_friendship($user_id,$friend)
    {
        
        $friendship_instance = Friend::whereUserIdAndFriend($friend,$user_id)->first();

        if (!count($friendship_instance)) {
            return \Response::json(['status'=>false,'motif'=>trans("back/friend.access_denied")]);
        }

        else{
            try {
                $friendship_instance->etat = true;
                $friendship_instance->save();
                return response()->json(['status'=>true,'message'=>'Vous etes desormais ami(e)']);
            } catch (\Illuminate\Database\QueryException $e) {
                return response()->json(['status'=>false,'error!']);
            }
        }
    }

}


