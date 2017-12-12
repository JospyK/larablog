@extends("dash")

@section("pagetitle", " Edit Comment")

@section('stylesheets')
  <link rel="stylesheet" type="text/css"  href="/css/parsley.css">
  <link rel="stylesheet" type="text/css"  href="/css/select2.css">
@endsection

@section('bgimg', 'background-image: url("/img/home-bg.jpg")')
@section('subheading','A Clean Bootstrap Blog')

@section('content')

<!-- Post Content -->
<article>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8">
        <form name"sentMessage" id="contactForm" action="{{route('comments.update', $comment->id)}}" method="POST" data-parsley-validate>
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          {{method_field("PUT")}}

          <div class="row control-group">
              <div class="form-group col-md-6 floating-label-form-group controls">
                  <label>Name</label>
                  <input type="text" class="form-control" value="{{$comment->name}}" placeholder="Name" id="name" name="name" required data-validation-required-message="Please enter your ame." maxlength="255" disabled>
                  <p class="help-block text-danger"></p>
              </div>
              <div class="form-group col-md-6 floating-label-form-group controls">
                  <label>Email</label>
                  <input type="text" class="form-control" value="{{$comment->email}}" placeholder="Email" id="email" name="email" required data-validation-required-message="Please enter your email." maxlength="255" disabled>
                  <p class="help-block text-danger"></p>
              </div>
          </div>
          <div class="row control-group">
              <div class="form-group col-xs-12 floating-label-form-group controls">
                  <label>Comment</label>
                  <textarea rows="5" class="form-control" placeholder="Comment" id="comment" name="comment" required data-validation-required-message="Please write the comment.">{{$comment->commnent}}</textarea>
                  <p class="help-block text-danger"></p>
              </div>
          </div>

          <br>
          <div id="success"></div>
          <div class="row">
              <div class="form-group col-xs-12">
                  <button type="submit" class="btn btn-default">Save Edit</button>
              </div>
          </div>
        </form>
      </div>

      <div class="col-md-4">
        <div class="well">
          <dl class="dl-horizontal">
            <dt>Created At :</dt><dd>{{ date('j M Y, H:i', strtotime($comment->created_at)) }}</dd>
          </dl>
          
          <dl class="dl-horizontal">
            <dt>Last Updatate at :</dt><dd>{{ date( 'j M Y, H:i', strtotime($comment -> updated_at))}}</dd>
          </dl>
          
          <hr>

          <div class="row">
            <div class="col-sm-8 col-sm-offset-2 ">
              <a href="{{route('posts.show', $comment->id)}}" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-trash"> </span> Cancel</a>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</article>
@endsection

@section('scripts')
  <script type="text/javascript" src="/js/parsley.min.js"></script>
  <script type="text/javascript" src="/js/select2.js"></script>

  <script type="text/javascript">
    $(".js-example-basic-multiple").select2();
  </script>


@endsection 