@extends('discution.template')

@section('css')

    {{HTML::style('css/chat.css')}}


@stop

@section('content')


    <?php

    $user = auth()->user();

    ?>
        <div class="container-fluid">
            <div class="row margin-top-chat">

                <div class="col-lg-4  col-md-4 col-sm-4 col-xs-12">
                    @include('users.others.profile._infoUser')
                </div><!--.col- -->
                <div class="col-lg-8  col-md-8 col-sm-8 col-xs-12">


                    {{-- ce block est tres important ne doit etre en aucun cas etre supprimer ou modifier ni meme deplacer --}}
                    @if (auth()->check())
                        <div class="user-connect">
                            <input type="hidden" class="firstname" value="{{auth()->user()->prenom}}">
                            <input type="hidden" class="lastname" value="{{auth()->user()->nom}}">
                            <input type="hidden" class="id" value="{{auth()->user()->id}}">
                            <input type="hidden" class="avatar" value="{{is_null(auth()->user()->avatar)?"avatar-2-64.png":auth()->user()->avatar}}">
                        </div>
                    @endif



                    <div class="container-fluid messenger">

                        <div class="box-typical chat-container">

                            @include('chat.components.chat-list')

                            @include('chat.components.chat-list-info')

                            @include('chat.components.chat-area')
                        </div><!--.chat-container-->

                    </div><!--.container-fluid-->




                </div><!--.col- -->
            </div><!--.row-->
        </div><!--.container-fluid-->






@stop

@section('scripts')
    <script>
        $(function() {
            $('.chat-settings .change-bg-color label').on('click', function() {
                var color = $(this).data('color');

                $('.messenger-message-container.from').each(function() {
                    $(this).removeClass(function (index, css) {
                        return (css.match (/(^|\s)bg-\S+/g) || []).join(' ');
                    });

                    $(this).addClass('bg-' + color);
                });
            });
        });
    </script>

    {{HTML::script('js/chat.js')}}

@stop