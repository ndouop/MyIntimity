<section class="chat-area"  id="chat-room" style="width: 100% !important;">
    <div class="chat-area-in">
        <div class="chat-area-header">
            <div class="chat-list-item online">
                <div class="chat-list-item-name">
                    <span class="name">{{$receiver->prenom}} {{$receiver->nom}} ({{$receiver->login}})</span>
                </div>
            </div>
        </div>

        {{-- receiver information --}}

        <span class="span-container-receiver-id" data-receiver-id="{{$receiver->id}}">
            <span class="data-receiver-name" value="{{$receiver->prenom}} {{$receiver->nom}}"></span>
            <span class="data-receiver-avatar" value="{{$receiver->avatar}}"></span>
            <span class="data-receiver-login" value="{{$receiver->login}}"></span>
        </span>

        {{-- sender information --}}

        <span class="span-container-sender-id" data-sender-id="{{auth()->user()->id}}">
            <span class="data-sender-name" value="{{auth()->user()->nom}} {{auth()->user()->prenom}}"></span>
            <span class="data-sender-avatar" value="{{is_null(auth()->user()->avatar)?"avatar-1-32.png":auth()->user()->avatar}}"></span>
            <span class="data-sender-login" value="{{auth()->user()->login}}"></span>
            <span class="data-sender-passfire" value="{{auth()->user()->passfire}}"></span>
            <span class="data-sender-fuid" value="{{auth()->user()->fuid}}"></span>
            <span class="data-sender-email" value="{{auth()->user()->email}}"></span>
        </span>

        <div class="chat-dialog-area scrollable-block" v-chat-scroll>
            <div class="messenger-dialog-area">

                <chat-log :messages="messages" subject-data-id=""></chat-log>
            </div>
        </div>

        <div class="chat-area-bottom">
            <chat-composer  v-on:messagesent="sendMessage"></chat-composer>
        </div><!--.chat-area-bottom-->
    </div><!--.chat-area-in-->
</section><!--.chat-area-->
