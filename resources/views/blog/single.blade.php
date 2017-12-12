@extends("main")

<?php $titleTag = htmlspecialchars($post->title); ?>
@section("pagetitle",  " $titleTag")


@section('stylesheets')
  <link rel="stylesheet" type="text/css"  href="/css/parsley.css">
  <link rel="stylesheet" href="/css/bootstrap-social.css">
  <style type="text/css">
    ul li i.fa{
      padding: 5px 15px;
    }

    .inline-ul a{
      margin-bottom: 5px;
    }
  </style>
@endsection

<?php $image = "/img/post_image/".htmlspecialchars($post->image); 
      $img = "background-image: url($image)";
?>

@section('bgimg', " $img")
@section('subheading', " $post->description")

@section("content")

<!-- Post Content -->
<article>
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <h1 class="fit">{{ $post -> title }}</h1>
        <h3 class="fit">{{ $post -> description }}</h3>
        <p class="fit"> {!! $post -> body !!} Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
        <hr>
        <div class="tags"><span class="glyphicon glyphicon-tags"> </span> Tags : 
          @foreach($post->tags as $tag)
            <span class="label label-default">{{$tag -> name}}</span>
          @endforeach
        </div>
        <!--Social Icons-->
        <ul class="inline-ul" style="margin: 20px 0px;"><strong>Share it: </strong><br> 
          <li><a type="button" href="" class="btn btn-facebook"><i class="fa fa-facebook" title=""></i></a></li>
          <li><a type="button" href="" class="btn btn-twitter"><i class="fa fa-twitter" title=""></i></a></li>
          <li><a type="button" href="" class="btn btn-google"><i class="fa fa-google" title="">+</i></a></li>
          <li><a type="button" href="" class="btn btn-linkedin"><i class="fa fa-linkedin" title=""></i></a></li>
          <li><a type="button" href="" class="btn btn-whatsapp btn-success "><i class="fa fa-whatsapp" title=""></i></a></li>
        </ul>
      </div>

      <div class="col-md-4">
        <div class="card" style="margin-top: 30px; padding: 20px;">
            <!--Card image-->
            <h3 class="text-center"><strong>Details</strong></h3>
            <hr>
            
            <dl class="dl-horizontal fit">
              <label>URL :</label><br>
              <a href="{{ url('blog/'.$post->slug) }}">{{ url("blog/".$post->slug) }}</a>
            </dl>

            <dl class="dl-horizontal fit">
              <label>Category : </label>
              <a href="{{route('blog.category', $post->category->name)}}">{{ $post -> category -> name}}</a>
            </dl>

            <dl class="dl-horizontal fit">
              <label>Author : </label>
              <a href="{{route('blog.users', $post->user->id)}}">{{ $post -> user -> first_name}}</a>
            </dl>
            
            <dl class="dl-horizontal">
              <label>Created At :</label><br>
              {{ date('j M Y, H:i', strtotime($post->created_at)) }}
            </dl>
            
            <dl class="dl-horizontal">
              <label>Last Updatate at :</label><br>
              {{ date( 'j M Y, H:i', strtotime($post -> updated_at))}}
            </dl>
            
            <hr>

            <div class="row fit">
              <ul class="inline-ul" style="margin: 20px 0px;"><strong>Share it: </strong><br> 
                <li><a type="button" href="" class="btn btn-facebook"><i class="fa fa-facebook" title=""></i></a></li>
                <li><a type="button" href="" class="btn btn-twitter"><i class="fa fa-twitter" title=""></i></a></li>
                <li><a type="button" href="" class="btn btn-google"><i class="fa fa-google" title="">+</i></a></li>
                <li><a type="button" href="" class="btn btn-linkedin"><i class="fa fa-linkedin" title=""></i></a></li>
                <li><a type="button" href="" class="btn btn-whatsapp btn-success "><i class="fa fa-whatsapp" title=""></i></a></li>
              </ul>
            </div>
        </div>

      <!--Card-->
        <div class="card card-personal" style="margin-top: 30px; padding: 20px;">
            <!--Card image-->
            <h3 class="text-center"><strong>About Author</strong></h3>
            <hr>
            <img class="img-fluid" src="{{'/img/user_image/'.$post->user->image}}" alt="Card image cap">
            <!--/.Card image-->

            <!--Card content-->
            <div class="card-block">
                <!--Title-->
                <a><h3 class="card-title title-one"><strong>{{$post->user->last_name}} {{$post->user->first_name}}</strong></h3></a>
                <p class="card-meta">Joined in {{date('Y', strtotime($post->user->created_at))}}</p>
                <p class="card-meta"><a href="mailto:{{$post->user->email}}" style="text-decoration: none;"><i class="fa fa-envelope"></i> {{$post->user->email}}</a></p>

                <!--Text-->
                <p class="card-text">{{$post->user->description}}</p>
                <hr>
                <a class="card-meta" href="{{route('blog.users', $post->user->id)}}"><span><i class="fa fa-file"></i> {{$post->user->posts->where('statut', '=','success')->count()}} {{ ($post->user->posts->count()<=1)? " Post": " Posts"}} </span></a>
            </div>
            <!--/.Card content-->
        </div>
      <!--/.Card-->

      @if($sameauthorposts->count() > 0)
      <!--Card-->
        <div class="card card-personal" style="margin-top: 30px; padding: 20px;">
          <h3 class="text-center"><strong>From The Same Author</strong></h3>
          <hr>

          <div>
            <div id="leCarousel" class="carousel slide" data-ride="carousel" style="width:100%; height: auto;">
                
                <div class="carousel-inner" role="listbox">

                      @foreach($sameauthorposts as $sameauthorpost)
                      <div class="item">
                        <!--First row-->
                        <div class="card col-xs-12" style="padding-top: 5px;">
                          
                          <!--First column-->
                          <div class="col-xs-12 mb-r">
                              <!--Featured image-->
                              <div class="view overlay hm-white-slight">
                                  <img src="{{'/img/post_image/'.htmlspecialchars($sameauthorpost->image)}}" class="img-responsive" alt="{{ $sameauthorpost -> title }} image">
                                  <a>
                                      <div class="mask waves-effect waves-light"></div>
                                  </a>
                              </div>
                          </div>
                          <!--/First column-->

                          <!--Second column-->
                          <div class="col-xs-12 mb-r">
                              <!--Excerpt-->
                              <a href="" class="blue-text"><h5><i class="fa fa-heart"></i> {{ $sameauthorpost -> category -> name }}</h5></a>
                              <h3><strong>{{ $sameauthorpost -> title }}</strong></h3>
                              <p>{{ $sameauthorpost -> description }}</p>
                              <p>by <a href="{{route('users.show', $sameauthorpost->user->id)}}" class="author"><strong>{{ $sameauthorpost->user->last_name}} {{ $sameauthorpost->user->first_name}}</strong></a> on {{ date('M d, Y', strtotime($sameauthorpost -> created_at)) }}</p>

                              <a href="{{ url('blog/'.$sameauthorpost->slug) }}" class="btn btn-default pull-right">Read more <i class="glyphicon glyphicon-eye-open"></i></a>
                          </div>
                          <!--/Second column-->
                        </div>
                      <!--/First row
                      <hr class="hr-mobile">-->
                      </div>
                      @endforeach

                </div>
            </div>
          <hr>  
          <div class="row">
            <div class="col-xs-12">

              <a href="#leCarousel" class="pull-left" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> </a>

              <a href="#leCarousel" class="pull-right" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> </a>
            
            </div>
          </div>
        </div>
      <!--/.Card-->
      </div>
      @endif

  </div>
</article>

<div class="container">
<hr>
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h3>Please leave us a comment!</h3>
        <p>What do you think about this post?</p>
        <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
        <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
        <!-- NOTE: To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
        <form name="sentMessage" id="contactForm" action="{{route('comments.store', $post->id)}}" method="POST" data-parsley-validate>
            <div class="row control-group">
                <div class="form-group col-xs-12 col-md-6 floating-label-form-group controls">
                    <label>Name</label>
                    <input type="text" class="form-control" placeholder="Name" id="name" name="name" required data-validation-required-message="Please enter your ame." maxlength="255">
                    <p class="help-block text-danger"></p>
                </div>
                <div class="form-group col-xs-12 col-md-6 floating-label-form-group controls">
                    <label>Email</label>
                    <input type="text" class="form-control" placeholder="Email" id="email" name="email" required data-validation-required-message="Please enter your email." maxlength="255">
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="row control-group">
                <div class="form-group col-xs-12 floating-label-form-group controls">
                    <label>Comment</label>
                    <textarea rows="4" class="form-control" placeholder="Comment" id="comment" name="comment" required data-validation-required-message="Please write the comment."></textarea>
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <br>
            <div id="success"></div>
            <div class="row">
                <div class="form-group col-xs-12">
                    <button type="submit" class="btn btn-default pull-right">Comment</button>
                </div>
            </div>
        </form>
    </div>
  </div>
</div>
<br>

@if($post->comments->count()>0)
<div class="container">
  <div class="row">
  	<h2 class="col-xs-12">
  		<span class="glyphicon glyphicon-comment"></span>
  		{{ $post->comments->count() }}{{ ($post->comments->count()<=1)? " Comment": " Comments"}} 
  	</h2>
    <hr/> 
    @foreach($post->comments as $comment)
  	<div class="col-xs-12">
      <hr/> 
      <div class="comment">
        <img class="img-rounded cimg" src='{{"https://www.gravatar.com/avatar/".md5(strtolower(trim($comment->email)))}}' alt="{{ $comment->name }}"/>

        <div class="cname">
          <h4 class="">{{ $comment->name }}</h4>
          <p class=""><small>{{ date('d M y, g:i A', strtotime($comment->created_at)) }}</small></p>
        </div>

        <div class="ccontent"> 
            <p>{{ $comment->commnent }}</p>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endif

@if($propositions->count() >0)
<hr>
<div class="container">
  <div class="row">
    <div class="row col-xs-12 card-group" style="margin: auto;">
      <h1 class="col-xs-12" style="margin: 20px 0px;">You May Also Like...</h1>
      @foreach($propositions as $proposition)
        <!--First row-->
        <div class="card col-xs-12 col-md-4" style="padding-top: 20px;">
          
          <!--First column-->
          <div class="col-xs-12 mb-r">
              <!--Featured image-->
              <div class="view overlay hm-white-slight">
                  <img src="{{'/img/post_image/'.htmlspecialchars($proposition->image)}}" class="img-responsive" alt="{{ $proposition -> title }} image">
                  <a>
                      <div class="mask waves-effect waves-light"></div>
                  </a>
              </div>
          </div>
          <!--/First column-->

          <!--Second column-->
          <div class="col-xs-12 mb-r">
              <!--Excerpt-->
              <a href="" class="blue-text"><h5><i class="fa fa-heart"></i> {{ $proposition -> category -> name }}</h5></a>
              <h3><a href="{{ url('blog/'.$post->slug) }}"><strong>{{ $proposition -> title }}</strong></a></h3>
              <p>{{ $proposition -> description }}</p>
              <p>by <a href="{{route('users.show', $proposition->user->id)}}" class="author"><strong>{{ $proposition->user->last_name}} {{ $proposition->user->first_name}}</strong></a> on {{ date('M d, Y', strtotime($proposition -> created_at)) }}</p>
              <a href="{{ url('blog/'.$proposition->slug) }}" class="btn btn-default pull-right">Read more <i class="glyphicon glyphicon-eye-open"></i></a>
          </div>
          <!--/Second column-->
        </div>
      <!--/First row
      <hr class="hr-mobile">-->
      @endforeach
    </div>
  </div>
</div>
@endif
@endsection

@section('scripts')
  <script type="text/javascript" src="/js/parsley.min.js"></script>
  <script type="text/javascript">
    var cible = $('.carousel-inner div.item');
    cible.first().addClass('active');
  </script>
@endsection 