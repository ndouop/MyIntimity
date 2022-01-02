


@if(count($inboxes)==0)
        <span class="mess-item-name">{{trans('front/navbar.notMsg')}}</span>
@else
    @if($inboxes->where("seen",false)->count()==0)
        <span class="mess-item-name">{{trans('front/navbar.notMsgSeen')}}</span>

    @else
        <div class="tab-pane active" id="tab-incoming" role="tabpanel">
            <div class="dropdown-menu-messages-list">
                @foreach($inboxes->where("seen",false) as $noSeen)
                    <div onclick="rediriger('{{url('chat-room?receiver_id='.$noSeen->sender->id)}}');" class="mess-item" style="cursor: pointer;" >
                        <span class="avatar-preview avatar-preview-32">
                            <img src="{{is_null($noSeen->sender->avatar)?asset("images/default/avatar-2-32.png"):asset('images/avatars/thumbnails/thumb_'.$noSeen->sender->avatar)}}" alt="">
                        </span>
                        <span class="mess-item-name">{{$noSeen->sender->login}}</span>
                        <span class="mess-item-txt">
                            {!! mb_strimwidth($noSeen->content, 0, 30, "...") !!}
                        </span>
                    </div>
                    <br><br>
                @endforeach
            </div>
        </div>
    @endif
    @if($inboxes->where("seen",true)->count()!=0){{-- 
        <a href="#" class="mess-item" style="cursor: none;" onclick="event.preventDefault()">
            <span class="mess-item-name">{{trans('front/navbar.notification.notMsgSeen')}}</span>
        </a>
    @else --}}
        <div class="tab-pane" id="tab-outgoing" role="tabpanel">
            <div class="dropdown-menu-messages-list">
                @foreach($inboxes->where("seen",false) as $seen)
                    <a href="#" class="mess-item" style="cursor: pointer;" onclick="getChatPage('{{url($seen->link)}}',{{$seen->id}},event,{{$seen->seen}});">
                        <span class="avatar-preview avatar-preview-32">
                            <img src="{{is_null($seen->sender->avatar)?asset("images/default/avatar-2-32.png"):asset('images/avatars/thumbnails/thumb_'.$seen->sender->avatar)}}" alt="">
                        </span>
                        <span class="mess-item-name">{{$seen->sender->login}}</span>
                        <span class="mess-item-txt">
                            {!! mb_strimwidth($noSeen->content, 0, 30, "...") !!}
                        </span>
                    </a>
                    <br><br>
                @endforeach
            </div>
        </div>
    @endif
@endif