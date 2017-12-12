@extends("main")

@section("pagetitle", " Authors")

@section("stylesheets")
@endsection

@section('bgimg', 'background-image: url("/img/home-bg.jpg")')
@section('subheading','Our Awesome Authors....')

@section("content")
  <!-- Main Content -->
  <div class="container wow fadeIn" data-wow-delay="0.2s">
    <div class="card-group">
      <div class="row">
        @foreach($users as $user)
          <!--Card-->
          <div class="card card-personal col-md-4 col-lg-3" style="margin-top: 30px; padding: 20px;">

              <!--Card image-->
              <img class="img-fluid" src="{{'/img/user_image/'.$user->image}}" alt="Card image cap">
              <!--/.Card image-->

              <!--Card content-->
              <div class="card-block">
                  <!--Title-->
                  <h3 class="card-title title-one"><a href="{{route('blog.users', $user->id)}}"><strong>{{$user->last_name}} {{$user->first_name}}</strong></a></h3>
                  <p class="card-meta">Joined in {{date('m, Y', strtotime($user->created_at))}}</p>
                  <p class="card-meta"><a href="mailto:{{$user->email}}" style="text-decoration: none;"><i class="fa fa-envelope"></i> {{$user->email}}</a></p>

                  <!--Text-->
                  <p class="card-text">{{$user->description}}</p>
                  <hr>
                  <a class="card-meta" href="{{route('blog.users', $user->id)}}"><span><i class="fa fa-file"></i> {{$user->posts->where('statut', '=','success')->count()}} {{ ($user->posts->count()<=1)? " Post": " Posts"}} </span></a>
              </div>
              <!--/.Card content-->

          </div>
          <!--/.Card-->
        @endforeach
      </div>
    </div>
    
    <!-- Pager -->
    <div class="row">
    	<div class="col-md-12">
    		<div class="text-center">
    			{!! $users->links() !!}
    		</div>
    	</div>
    </div>
  </div>
@endsection

@section("scripts")
@endsection