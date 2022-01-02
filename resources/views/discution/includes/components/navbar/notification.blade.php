@if(count($notis)==0)
	<div class="dropdown-menu-notif-item">
	   {{trans('front/navbar.not_notis')}}
	</div>
@else
	@foreach($notis as $noti)
	    <div class="dropdown-menu-notif-item" onclick="getCommentSubjectPage('{{url($noti->link)}}',{{$noti->id}},event);">


			<div class="color-blue-grey-lighter">
				<span class="pull-right">{{getTimeHumansPoster($noti->created_at)}}</span>

			</div>
			<div class="photo">
	            <img src="{{(is_null($noti->sender->avatar) || $noti->sender->avatar == '') ?
	            			asset("images/default/avatar-2-32.png") :
	            			asset('images/avatars/thumbnails/thumb_'.$noti->sender->avatar)}}" alt="">
				<br>

	        </div>
			<div class="alert-notification pull-right">
				<a href="#">{{$noti->sender->login}}</a> {{trans('front/navbar.notification_label')}}
			</div>
	    </div>
	@endforeach
@endif