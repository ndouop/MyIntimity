<?php

namespace App\Http\Controllers;

use App\DataTables\MessageDataTable;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\CreateMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Repositories\MessageRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\Message;
use App\Models\Conversation;
use App\Events\ChatMessageSend;
use App\Models\Inbox;

class MessageController extends AppBaseController
{
    /** @var  MessageRepository */
    private $messageRepository;


    public function __construct(MessageRepository $messageRepo)
    {
        $this->messageRepository = $messageRepo;
        //$this->middleware('auth');
    }

    /**
     * Display a listing of the Message.
     *
     * @param MessageDataTable $messageDataTable
     * @return Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        /*check if this user is friend by $friend*/
/*        if (!$user->isFriend($request->receiver_id)) {
            return ['status'=>false,'motif'=>'Vous n\'etes pas amie avec cette utilisateur.'];
        }*/
/*        if (empty($request->receiver_id) || is_null($request->receiver_id) || !is_numeric($request->receiver_id)) {
            dd('here');
            return response()->json(['status'=>false,'motif'=>'Fatal Error. Cette personne n\'existe']);
        }*/
   
        $receiver_id = $request->receiver_id;

        $messages = array();

        $messages = $user->myMessagesByReceiver($request->receiver_id);

        return response()->json($messages);

    }

    /**
     * Show the form for creating a new Message.
     *
     * @return Response
     */
    public function create()
    {
        return view('messages.create');
    }

    /**
     * Store a newly created Message in storage.
     *
     * @param CreateMessageRequest $request
     *
     * @return Response
     */
    public function store(CreateMessageRequest $request)
    {
  
        $user = auth()->user();

        /*check if this user is friend by $friend*/
        /*if (!$user->isFriend($request->receiver_id)) {
            return ['status'=>false,'motif'=>'Vous n\'etes pas amie avec cette utilisateur.'];
        }*/
        /*if (empty($request->receiver_id) || is_null($request->receiver_id) || !is_numeric($request->receiver_id)) {
            dd('here');
            return response()->json(['status'=>false,'motif'=>'Fatal Error. Cette personne n\'existe']);
        }*/


        $input = [
            'sender_id'=>$user->id,
            'receiver_id'=>$request->receiver_id,
            'message'=>$request->message
        ];

        try {
            $message= Message::create($input);

            
            //event(new ChatMessageSend($message));

            //notification d l'utilisateur




            /*$content = $request->message;
            $sender_id = $user->id;
            $link = 'chat-room?receiver_id='+$request->sujet->id;
            $receiver_id = $request->receiver_id;

            $this->notifyedReceiver([
                "content" => $content,
                "anonyme" => $anonyme,
                "link" => $link,
                "receiver_id" => $receiver_id,
                "sender_id" => $sender_id
            ]);

            */

            return response()->json(['status'=>true,'message'=>'ok']);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['status'=>flase,'motif'=>trans("back/message.error_store")]);
        }
    }

    /**
     * Display the specified Message.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $message = $this->messageRepository->findWithoutFail($id);

        if (empty($message)) {
            Flash::error('Message not found');

            return redirect(route('messages.index'));
        }

        return view('messages.show')->with('message', $message);
    }

    /**
     * Show the form for editing the specified Message.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $message = $this->messageRepository->findWithoutFail($id);

        if (empty($message)) {
            Flash::error('Message not found');

            return redirect(route('messages.index'));
        }

        return view('messages.edit')->with('message', $message);
    }

    /**
     * Update the specified Message in storage.
     *
     * @param  int              $id
     * @param UpdateMessageRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMessageRequest $request)
    {
        $message = $this->messageRepository->findWithoutFail($id);

        if (empty($message)) {
            Flash::error('Message not found');

            return redirect(route('messages.index'));
        }

        $message = $this->messageRepository->update($request->all(), $id);

        Flash::success('Message updated successfully.');

        return redirect(route('messages.index'));
    }

    /**
     * Remove the specified Message from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $message = $this->messageRepository->findWithoutFail($id);

        if (empty($message)) {
            Flash::error('Message not found');

            return redirect(route('messages.index'));
        }

        $this->messageRepository->delete($id);

        Flash::success('Message deleted successfully.');

        return redirect(route('messages.index'));
    }

    public function notifyedReceiver($data)
    {
        $ib = Inbox::create($data);
        return true;
    }
}
