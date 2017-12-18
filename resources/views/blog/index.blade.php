@extends("main")

@section("pagetitle", " Blog")

@section("stylesheets")
<style type="text/css">
  .floating-label-form-group input, .floating-label-form-group textarea{
    font-size: 1.1em;
  }
</style>
@endsection

@section('bgimg', 'background-image: url("/img/home-bg.jpg")')
@section('subheading','A Clean Bootstrap Blog')

@section("content")
  <!-- Main Content -->
  <div class="container-fluid wow fadeIn" data-wow-delay="0.2s">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-lg-10 col-lg-offset-1" style="margin: auto;">
        
          <div class="row">
            <div class="col-md-9">
              <section class="section extra-margins">
                <!--Section heading-->
                <h1 class="section-heading"><i class="fa fa-files-o"></i> Recents Posts</h1>
                <!--Section sescription-->
                <p class="section-description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
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
                        <a href="{{route('blog.category', $post -> category -> name)}}" class="blue-text"><h5><i class="fa fa-folder"></i> {{ $post -> category -> name }}</h5></a>
                        <h3><a href="{{ url('blog/'.$post->slug) }}"><strong>{{ $post -> title }}</strong></a></h3>
                        <p>{{ $post -> description }}</p>
                        <p class="">by <a href="{{route('blog.users', $post->user->first_name.'.'.$post->user->last_name)}}" class="author"><strong>{{ $post->user->last_name}} {{ $post->user->first_name}}</strong></a> on {{ date('M d, Y', strtotime($post -> created_at)) }}</p>
                        <a href="{{ url('blog/'.$post->slug) }}" class="btn btn-default pull-right"> Read more <i class="glyphicon glyphicon-eye-open"></i></a>
                    </div>
                    <!--/Second column-->

                </div>
                <!--/First row
                <hr class="hr-mobile">-->
                @endforeach

              </section>
            </div>

            <div class="col-md-3 wow fadeIn" data-wow-delay="0.2s">        

              <!-- search form -->
                <form action="{{route('blog.search')}}" method="post" class="sidebar-form"  style="margin-top: 15px; border-top: none;">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  {{method_field("POST")}}

                    <div class="row">
                      <div class="col-xs-9">
                        <div class="row control-group">
                          <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Search...</label>
                            <input type="text" class="form-control" name="q" placeholder="Search..." id="q" required data-validation-required-message="Please enter your name.">
                            <p class="help-block text-danger"></p>
                          </div>
                        </div>
                      </div>

                      <div class="col-xs-3"><br>
                         <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                </form>

                <div class="widget-wrapper card" style="padding: 10px; margin: 20px 0px ;">
                    <h1><i class="fa fa-folder"></i> Categories:</h1>
                    <div class="list-group">
                      @foreach ($categories as $category)
                        <a href="{{route('blog.category', $category->name)}}" class="list-group-item">{{$category->name}}</a>
                      @endforeach
                    </div>
                </div>

                <div class="row card" style="padding: 10px; margin: 20px 0px ;">
                  <h2><i class="fa fa-tags"></i>Tags</h2>
                  <div class="col-xs-12">
                  <hr>
                    @foreach ($tags as $tag)
                      <a href="{{route('blog.tag', $tag->name)}}">{{$tag->name}}&nbsp</a>
                    @endforeach
                  </div>
                </div>


                <div class="row card" style="padding: 10px; margin: 20px 0px ;">
                  <h2><i class="fa fa-envelope"></i> <span class="text-center">Subscribe To Our Newsletter</span></h2>
                  <div class="col-xs-12" style="margin-top: 10px;">
                    <form name="sentMessage" id="contactForm" method="post" action="#">
                      <div class="row control-group">
                          <div class="form-group col-xs-12 floating-label-form-group controls">
                              <label>Name</label>
                              <input type="text" class="form-control" name="name" placeholder="Name" id="name" required data-validation-required-message="Please enter your name." value="{{old('name')}}">
                              <p class="help-block text-danger"></p>
                          </div>
                      </div>
                      <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                              <label>Email Address</label>
                              <input type="email" class="form-control" name="email" placeholder="Email Address" id="email" required data-validation-required-message="Please enter your email address." value="{{old('email')}}">
                              <p class="help-block text-danger"></p>
                        </div>
                      </div>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <br>
                        <div id="success"></div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <button type="submit" class="btn btn-default pull-right">Send</button>
                            </div>
                        </div>
                    </form>
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

      </div>
    </div>
@endsection

@section("scripts")
@endsection