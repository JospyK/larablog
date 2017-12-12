@forelse(Sentinel::getUser()->unreadnotifications as $notification)
	@if(snake_case(class_basename($notification->type)) == 'new_post_notification')
		<li>
		  <a href="#">
		    <i class="fa fa-files-o text-aqua"></i><strong>{{ $notification->data['post']['title']}}</strong> write by <strong> {{ $notification->data['user']['first_name']}}</strong> has been accepted and published
		  </a>
		</li>
	@endif

	@empty
		<li>
		  <a href="#"> <i class="fa fa-times text-red"></i> No Notifications </a>
		</li>
<!-- lindseystomp -->
@endforelse	
