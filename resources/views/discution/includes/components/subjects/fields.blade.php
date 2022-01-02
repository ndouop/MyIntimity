

    {{--  <h5 class="with-border m-t-0">{{trans('front/forum.comment.modal.label.t_age')}}</h5>
       <div class="form-group row">
            <label for="age_range" style="font-weight: bold;"></label>
            <div class="col-lg-6 col-sm-12 col-md-12">
                <label for="minimum" class="col-sm-3 form-control-label">{{trans('front/forum.comment.modal.label.min')}}Mininum</label>
                <div class="form-group col-sm-9">
                    <input id="demo_vertical" jump="demo_vertical" type="number" value="13" name="age_debut" class="form-control" value="{{old('age_debut')}}">
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <label for="maximum" class="col-sm-3 form-control-label">{{trans('front/forum.comment.modal.label.max')}}Maximum</label>
                <div class="form-group col-sm-9">
                    <input id="demo_vertical" jump="demo_vertical" type="number" value="150" name="age_fin" value="{{old('age_fin')}}">
                </div>
            </div>
        </div> --}}
        
        <div class="form-group row">
            <div class="col-sm-12  col-md-12 col-sm-12 with-border m-t-0">
                <div class="col-md-2">
                    <label class="" for="categorie_id">{{trans('front/forum.comment.modal.label.cat')}}</label>
                </div>
                <div class="col-md-10">
                    <select class="select2" name="categorie_id" id="categorie_id" value="{{old('categorie_id')}}">
                        @if(count($categories))
                            @foreach($categories as $cat)
                                <option value="{{$cat->id}}">{{$cat->label}}</option>
                            @endforeach
                        @endif 
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
                <textarea rows="10" class="form-control" name="description" placeholder="decrivez votre sujet ici.." id="description" value="{{old('description')}}">texte ici...</textarea>
            </div>
        </div>

        <div class="checkbox">
            <input type="checkbox" id="check-1" name="anonyme" value="1" >
            <label for="check-1" id="popov">{{trans('front/forum.comment.modal.label.anonyme')}} </label>
        </div>
 