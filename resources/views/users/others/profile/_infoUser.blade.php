

    <section class="box-typical">
        <div class="profile-card" style=" ">
            <div class="profile-card-photo">
                @if(is_null(auth()->user()->avatar))
                    <img src="{{asset('images/default/avatar-2-128.png')}}" alt=""/>
                @else
                    <img src="{{asset('images/avatars/profile/profile_'.auth()->user()->avatar)}}" alt=""/>
                @endif
            </div>
            <div class="profile-card-name">
                {{(auth()->user()->prenom || auth()->user()->nom) ?
                        auth()->user()->prenom.' '.auth()->user()->nom :
                        auth()->user()->login}}
            </div>
            <br><br>
            <a href="{{url('/profile/update')}}" type="button" class="btn btn-block Kbtn-square" style="height: 47px!important;
    max-width: none!important;
    line-height: 2.2!important">{!! trans('front/profile.update') !!}</a>
        </div><!--.profile-card-->
    </section><!--.box-typical-->
    <section class="box-typical">
        <header class="box-typical-header-sm">
            {!! trans('front/profile.amis') !!}
            &nbsp;
            <a href="#" class="full-count">{{count(auth()->user()->friends())}}</a><i class="fa fa-users"></i>
        </header>
        <div class="friends-list">
            @if(count(auth()->user()->friends()))
                @foreach(auth()->user()->friends() as $friend)
                    <article class="friends-list-item">
                        <div class="user-card-row intimity-user-list-row">
                            <div class="tbl-row">
                                <div class="tbl-cell tbl-cell-photo">
                                    <a href="#">
                                        @if(is_null(auth()->user()->avatar))
                                            <img src="{{asset('images/default/avatar-2-128.png')}}" alt=""/>
                                        @else
                                            <img src="{{asset(is_null($friend->avatar)?"images/default/avatar-2-48.png":"images/avatars/thumbnails/thumb_".$friend->avatar)}}" class="avatar-thumb-forum-subject" alt="">
                                        @endif
                                    </a>
                                </div>
                                <div class="tbl-cell">
                                    <p class="user-card-row-name status-online"><a href="{{url('chat-room?receiver_id='.$friend->id)}}">{{$friend->login}}</a></p>
                                    <p class="user-card-row-location"><a href="{{url('chat-room?receiver_id='.$friend->id)}}">{{$friend->nom}} {{$friend->nom}}</a></p>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
                @if(count(auth()->user()->friends())>7)
                    <div class="user-card-row">
                        <div class="tbl-row">
                            <div class="tbl-cell">
                                <p class="user-card-row-status" style="padding-left: 18px"> <a href="{{url('seenall/friend/'.auth()->user()->id)}}">{!! trans('front/profile.see_all') !!}</a> </p>
                            </div>
                        </div>
                    </div>
                @endif
            @else

            @endif
        </div>
    </section><!--.box-typical-->
    <!--section class="box-typical">
        <header class="box-typical-header-sm">Recherche parmi mes ami(e)s</header>
        <div class="col-lg-12 friends-list">
            <div class="form-group">
                <div class="form-control-wrapper form-control-icon-left">
                    <input type="text" class="form-control" placeholder="tapez le nom ici..."/>
                    <i class="font-icon font-icon-serach color-green"></i>
                </div>
            </div>
        </div>
    </section-->
    <section class="box-typical">
        <header class="box-typical-header-sm">{!! trans('front/profile.ask_f') !!} </header>
        <div class="friends-list stripped">
            @if(count($invitation_sent_in_agreement))
                @foreach($invitation_sent_in_agreement as $friend)
                    <article class="friends-list-item">
                        <div class="user-card-row">
                            <div class="tbl-row">
                                <div class="tbl-cell tbl-cell-photo">
                                    <a href="#">
                                        <img src="{{asset('startUI/img/photo-64-2.jpg')}}" alt="">
                                    </a>
                                </div>
                                <div class="tbl-cell">
                                    <p class="user-card-row-name status-online"><a href="#">{{$friend->user->login}}</a></p>
                                    <p class="user-card-row-status">{{getTimeHumansPoster($friend->created_at)}} <a href="{{url('friend/confirm/'.auth()->user()->id.'/'.$friend->user_id)}}" class="bg-blue text-{{auth()->user()->id.'-'.$friend->user_id}}">{!! trans('front/profile.confirm') !!}</a></p>
                                </div>
                                <div class="tbl-cell tbl-cell-action">
                                    <a href="#" onclick="event.preventDefault();confirmInvitation('{{url('friend/confirm/'.auth()->user()->id.'/'.$friend->user_id)}}','{{auth()->user()->id.'-'.$friend->user_id}}');" class="plus-link-circle icon-{{auth()->user()->id.'-'.$friend->user_id}}"><span>&plus;</span></a>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            @else

            @endif
        </div>
    </section>
