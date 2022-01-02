<div class="modal-upload">
    <div class="modal-upload-cont">
        <div class="modal-upload-cont-in">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="nouveau-sujet">

                    {!! Form::open(['route' => 'save-sujet']) !!}
                        <div class="modal-body">
                            @include('discution.includes.components.subjects.fields')
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-rounded btn-default  Kbtn-square" data-dismiss="modal">{{trans("front/forum.comment.modal.cancel")}}</button>
                            <button type="submit" class="btn btn-rounded btn-primary Kbtn-square">{{trans("front/forum.comment.modal.post")}}</button>
                        </div>
                    {!! Form::close() !!}

                </div><!--.tab-pane-->
                <div role="tabpanel" class="tab-pane" id="recherche-sujet">
                    <div class="modal-upload-body scrollable-block">
                        @include('discution.includes.components.subjects.search')
                    </div>
                </div><!--.tab-pane-->
            </div><!--.tab-content-->
        </div><!--.modal-upload-cont-in-->
    </div><!--.modal-upload-cont-->
    <div class="modal-upload-side">
        <ul class="upload-list" role="tablist">
            <li class="nav-item">
                <a href="#nouveau-sujet" role="tab active" data-toggle="tab">
                    <i class="font-icon font-icon-plus"></i>
                    <span>{{trans("front/forum.comment.modal.new_s")}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#recherche-sujet" role="tab" data-toggle="tab">
                    <i class="font-icon font-icon-search"></i>
                    <span>{{trans("front/forum.comment.modal.search_s")}}</span>
                </a>
            </li>
        </ul>
    </div>
</div>