
@section('css')
    {{HTML::style('css/footer.css')}}

@stop


<footer>
    <div class="no-margin no-padding">

        <div class="col-md-12 line1 no-margin">
            <div class="col-md-12 text-center espace-titre-footer">
                <h3 class="text-news-letter">{{trans('front/footer.souscrib')}}</h3>
            </div>
            <div class="col-md-12 text-center">
                <div class="col-md-4"> &nbsp; </div>
                <div class="col-md-3 no-padding-top">
                    <a href="https://goo.gl/WnXk6K" target="_blank">
                        <img class="logo-google-play" src="{{ asset('images/google-play-badge.png')}}" title="{{trans("front/footer.play_dispo")}}">
                    </a>
                </div>
                <div class="col-md-5 text-right ">
                    <form id="souscribeToNewsletter" action="{{url('souscribeToNewsletter')}}" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="input-group">
                            <input class="form-control" id="souscribeToNewsletterEmail" name='email' placeholder='{{trans("front/footer.email")}}'/>
                            <div class="input-group-addon no-padding">
                                <button type="submit" id="souscribeToNewsletterBtnSubmit" class="btn btn-repondre btn-sm">{{Lang::get('cycle.souscrir')}}</button>
                            </div>
                        </div>
                    </form>
                    
                    <br/>
                    <div class="social col-md-12 text-right">
                        <a href="https://fb.me/MyIntimityApp">
                            <button type="button" class="btn-square-icon f-btn">
                                <i class="fa fa-facebook fa-2x"></i>
                                Facebook
                            </button>
                        </a>
                        <!--button type="button" class="btn-square-icon g-btn">
                            <i class="fa fa-google"></i>
                            google
                        </button>
                        <button type="button" class="btn-square-icon t-btn">
                            <i class="fa fa-twitter"></i>
                            twitter
                        </button-->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 line2">
            <div class="container">
                <div class="row downLine">
                    <div class="col-md-6 text-left copy espace-top-bottom-footer">
                        <p>
                            {{trans('front/footer.all_r')}} &nbsp;&nbsp; &copy; &nbsp;&nbsp;
                            <span class = "blueProxiPressing">{!! config()->get("app.name") !!}</span> {{\Carbon\Carbon::now()->year}}
                        </p>
                    </div>
                    <div class="col-md-6 text-right dm espace-top-bottom-footer ">
                        <a href="{{route('term')}}" class="link-footer pull-right"> {{trans('front/footer.cond')}} </a>
                        <a href="{{route('term')}}" class="link-footer pull-right"> {{trans("front/footer.pol_conf")}} </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>



