<?php

namespace App\Http\Controllers;

use App\DataTables\likeDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatelikeRequest;
use App\Http\Requests\UpdatelikeRequest;
use App\Repositories\likeRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\Like;
use App\Models\Sujet;

class likeController extends AppBaseController
{
    /** @var  likeRepository */
    private $likeRepository;

    public function __construct(likeRepository $likeRepo)
    {
        $this->likeRepository = $likeRepo;
        //$this->middleware('auth');
    }

    /**
     * Display a listing of the like.
     *
     * @param likeDataTable $likeDataTable
     * @return Response
     */
    public function index(likeDataTable $likeDataTable)
    {
        return $likeDataTable->render('likes.index');
    }

    /**
     * Show the form for creating a new like.
     *
     * @return Response
     */
    public function create()
    {
        return view('likes.create');
    }

    /**
     * Store a newly created like in storage.
     *
     * @param CreatelikeRequest $request
     *
     * @return Response
     */
    public function store(CreatelikeRequest $request)
    {

        if (!$request->ajax()) {
            return response()->json(['status'=>false,'motif'=>trans("back/like.unauthorized")]);
        }

        $input = [
            'user_id'=>auth()->user()->id,
            'sujet_id'=>$request->sujet_id
        ];
        $checkIfExist = Like::where($input)->get();

        if (count($checkIfExist)) {
            \DB::table('likes')->where($input)->delete();
            Sujet::findOrFail($request->sujet_id)->decrement('nblike');
            return response()->json(['status'=>false,'motif'=>trans("back/like.like_remove"),'unlike'=>true]);

        }
        try {
            $store = Like::create($input);

            try {
                Sujet::findOrFail($request->sujet_id)->increment('nblike');
            } catch (Illuminate\Database\QueryException $e) {
                \DB::table('likes')->where($input)->delete();
            }

            return response()->json(['status'=>true]);

        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(['status'=>false,'motif'=>trans("back/like.error_store")]);
        }
        

    }

    public function storeResponse(CreatelikeRequest $request)
    {

        if (!$request->ajax()) {
            return response()->json(['status'=>false,'motif'=>trans("back/like.unauthorized")]);
        }

        $input = [
            'user_id'=>auth()->user()->id,
            'reponse_id'=>$request->reponse_id
        ];
        $checkIfExist = Like::where($input)->get();

        if (count($checkIfExist)) {
            \DB::table('likes')->where($input)->delete();
            Sujet::findOrFail($request->reponse_id)->decrement('nblike');
            return response()->json(['status'=>false,'motif'=>trans("back/like.like_remove"),'unlike'=>true]);

        }
        try {
            $store = Like::create($input);

            try {
                Sujet::findOrFail($request->reponse_id)->increment('nblike');
            } catch (Illuminate\Database\QueryException $e) {
                \DB::table('likes')->where($input)->delete();
            }

            return response()->json(['status'=>true]);

        } catch (Illuminate\Database\QueryException $e) {
            return response()->json(['status'=>false,'motif'=>trans("back/like.error_store")]);
        }
        

    }

    /**
     * Display the specified like.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $like = $this->likeRepository->findWithoutFail($id);

        if (empty($like)) {
            Flash::error('Like not found');

            return redirect(route('likes.index'));
        }

        return view('likes.show')->with('like', $like);
    }

    /**
     * Show the form for editing the specified like.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $like = $this->likeRepository->findWithoutFail($id);

        if (empty($like)) {
            Flash::error('Like not found');

            return redirect(route('likes.index'));
        }

        return view('likes.edit')->with('like', $like);
    }

    /**
     * Update the specified like in storage.
     *
     * @param  int              $id
     * @param UpdatelikeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatelikeRequest $request)
    {
        $like = $this->likeRepository->findWithoutFail($id);

        if (empty($like)) {
            Flash::error('Like not found');

            return redirect(route('likes.index'));
        }

        $like = $this->likeRepository->update($request->all(), $id);

        Flash::success('Like updated successfully.');

        return redirect(route('likes.index'));
    }

    /**
     * Remove the specified like from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $like = $this->likeRepository->findWithoutFail($id);

        if (empty($like)) {
            Flash::error('Like not found');

            return redirect(route('likes.index'));
        }

        $this->likeRepository->delete($id);

        Flash::success('Like deleted successfully.');

        return redirect(route('likes.index'));
    }
}
