@extends("main")

<?php $userName = htmlspecialchars($user->first_name); 
  $userlastName = htmlspecialchars($user->last_name); ?>

@section("pagetitle", "$userlastName $userName")

@section("stylesheets")
@endsection

@section('bgimg', 'background-image: url("/img/home-bg.jpg")')
@section('subheading','Author')

@section("content")
  <!-- Main Content -->
  <div class="container wow fadeIn" data-wow-delay="0.2s">
    <div class="row">
      <div class="col-md-9">
        <section class="section extra-margins">
          <!--Section heading-->
          <h1 class="section-heading">{{$user->first_name}} Posts</h1>
          <!--Section sescription-->
          <p class="section-description">{{$user->description}}</p>
          <br>

          @foreach ($posts as $post)
          <!--First row-->
          <div class="row card" style="padding-top: 20px; margin: 15px 0px ;">

              <!--First column-->
              <div class="col-md-5 mb-r">
                  <!--Featured image-->
                  <div class="view overlay hm-white-slight">
                      <img src="{{'/img/post_image/'.htmlspecialchars($post->image)}}" class="img-responsive" alt="{{ $post -> title }} image">
                      <a>
                          <div class="mask waves-effect waves-light"></div>
                      </a>
                  </div>
              </div>
              <!--/First column-->

              <!--Second column-->
              <div class="col-md-7 mb-r">
                  <!--Excerpt-->
                  <a href="{{route('blog.category', $post->category->name)}}" class="blue-text"><h5><i class="fa fa-heart"></i> {{ $post -> category -> name }}</h5></a>
                  <h3><strong>{{ $post -> title }}</strong></h3>
                  <p>{{ $post -> description }}</p>
                  <p>by <a href="{{route('blog.users', $post->user->first_name.'.'.$post->user->last_name)}}"><strong>{{ $post->user->last_name}}</strong></a> on {{ date('M d, Y', strtotime($post -> created_at)) }}</p>
                  <a href="{{ url('blog/'.$post->slug) }}" class="btn btn-default pull-right">Read more <i class="glyphicon glyphicon-eye-open"></i></a>
              </div>
              <!--/Second column-->

          </div>
          <!--/First row
          <hr class="hr-mobile">-->
          @endforeach

        </section>
      </div>

      <div class="col-md-3 wow fadeIn" data-wow-delay="0.2s">        

          <!--Card-->
          <div class="card card-personal" style="margin-top: 30px; padding: 20px;">
            <!--Card image-->
            <img class="img-fluid" src="{{'/img/user_image/'.$user->image}}" alt="Card image cap">
            <!--/.Card image-->

            <!--Card content-->
            <div class="card-block">
              <!--Title-->
              <a><h3 class="card-title title-one"><strong>{{$user->last_name}} {{$user->first_name}}</strong></h3></a>
              <p class="card-meta">Joined in {{date('Y', strtotime($user->created_at))}}</p>
              <p class="card-meta"><a href="mailto:{{$user->email}}" style="text-decoration: none;"><i class="fa fa-envelope"></i> {{$user->email}}</a></p>

              <!--Text-->
              <p class="card-text">{{$user->description}}</p>
              <hr>
              <a class="card-meta"><span><i class="fa fa-file"></i> {{$user->posts->where('statut', '=','success')->count()}} {{ ($user->posts->count()<=1)? " Post": " Posts"}} </span></a>
            </div>
            <!--/.Card content-->
          </div>
          <!--/.Card-->

          <div class="widget-wrapper card" style="padding: 10px; margin: 15px 0px ;">
            <h1>Categories:</h1>
            <div class="list-group">
              @foreach ($categories as $category)
                <a href="{{route('blog.category', $category->name)}}" class="list-group-item                                 {{Request::is('blog/category/'.$category->name) ? 'active' : ''}}">{{$category->name}}</a>
              @endforeach
            </div>
          </div>

          <div class="row card" style="padding: 10px; margin: 15px 0px ;">
          <h1>Tags :</h1>
            <div class="col-xs-12">
              @foreach ($tags as $tag)
                <a href="{{route('blog.tag', $tag->name)}}">{{$tag->name}}&nbsp</a>
              @endforeach
            </div>
          </div>

      </div>
    </div>
    
    <!-- Pager -->
    <div class="row">
      <div class="col-md-12">
        <div class="text-center">
          {!! $posts->links() !!}
        </div>
      </div>
    </div>
  </div>
@endsection

@section("scripts")
@endsection