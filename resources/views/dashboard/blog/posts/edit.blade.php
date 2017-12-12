@extends("dash")

@section("pagetitle", " Edit Post")

@section('stylesheets')
  <link rel="stylesheet" type="text/css"  href="/css/parsley.css">
  <link rel="stylesheet" type="text/css"  href="/css/select2.css">
  <style type="text/css">
    #change-image{
      position: relative;
      top: -50px;
      left: -30px;
      z-index: 1;
    }
  </style>
@endsection

@section('bgimg', 'background-image: url("/img/home-bg.jpg")')
@section('subheading','A Clean Bootstrap Blog')

@section('content')

<!-- Post Content -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"><span class="glyphicon glyphicon-help"> </span> Some Informations</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <!-- /.col -->
              <div class="col-md-8">
                <img src="{{'/img/post_image/'.htmlspecialchars($post->image)}}" class="img-responsive">
                <div class="row">
                  <div id="change-image">
                    <label class="btn btn-danger pull-right" for="image"><span class="glyphicon glyphicon-picture"> </span> Change Image</label> 
                  </div>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-md-4 text-center" >

                <dl class="dl-horizontal row">
                  <label class="col-xs-5"><span class="pull-right">Image :</span></label>
                  <span class="col-xs-7"><span class="pull-left">20Mo</span></span>
                </dl>

                <dl class="dl-horizontal row">
                  <label class="col-xs-5"><span class="pull-right">Comments :</span></label>
                  <span class="col-xs-7"><span class="pull-left">{{ $post->comments()->count() }}</span></span>
                </dl>

                <dl class="dl-horizontal row">
                  <label class="col-xs-5"><span class="pull-right">Created At :</span></label>
                  <span class="col-xs-7"><span class="pull-left">{{ date('j M Y, H:i', strtotime($post->created_at)) }}</span></span>
                </dl>
                
                <dl class="dl-horizontal row">
                  <label class="col-xs-5"><span class="pull-right">Last Updatate :</span></label>
                  <span class="col-xs-7"><span class="pull-left">{{ date( 'j M Y, H:i', strtotime($post -> updated_at))}}</span></span>
                </dl>
                
                <dl class="dl-horizontal row fit">
                    <label class="col-xs-5"><span class="pull-right">Statut : </span></label>
                    <span class="label label-{{$post -> statut}} pull-left">
                        {{  ($post->statut == 'success') ? 'Accepté'            : '' }}
                        {{  ($post->statut == 'danger' ) ? 'Refusé'             : '' }}
                        {{  ($post->statut == 'info'   ) ? 'En attente dedition': '' }}
                        {{  ($post->statut == 'warning') ? 'Pending'            : '' }}
                    </span>
                    
                  <div class="row">
                    <div class="col-xs-10 col-xs-offset-1">
                      <div class="callout callout-{{$post -> statut}}">
                        <p>{{$post -> edit_message}}</p>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                      <a href="{{route('posts.show', $post->id)}}" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-trash"></span> Cancel</a>
                    </div>
                  </div>
                </dl>

              </div>
            </div>
            <!-- /.row -->
          </div>
          <!-- ./box-body -->
        </div>
        <!-- /.box -->
      </div>


      <div class="col-md-10 col-md-offset-1">
        <form name="sentMessage" id="contactForm" action="{{route('posts.update', $post->id)}}" method="POST" data-parsley-validate enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        {{method_field("PUT")}}

          <div class="row control-group">
              <div class="form-group col-xs-12 floating-label-form-group controls">
                  <label>Name</label>
                  <input type="text" class="form-control" placeholder="Title" id="title" name="title" value="{{ $post -> title }}" required data-validation-required-message="Please enter the post title." maxlength="250" autofocus>
                  <p class="help-block text-danger"></p>
              </div>
          </div>
          <div class="row control-group">
              <div class="form-group col-md-4 floating-label-form-group controls">
                  <br>
                  <select class="form-control" name="category_id" required data-validation-required-message="Please select a category">Categories
                    @foreach($categories as $category)
                      <option value="{{$category->id}}" {{ ($category->id == $post->category->id ) ? 'selected' : '' }}>{{$category->name}}</option>
                    @endforeach
                  </select>
                  <p class="help-block text-danger"></p>
              </div>
							<div class="form-group col-md-8 floating-label-form-group controls">
                  <br>
                	<select class="form-control js-example-basic-multiple" multiple="multiple" name="tags[]" required data-validation-required-message="Please select tags">Tags
              		  @foreach($tags as $tag)
   										@foreach ($post->tags as $post_tag)
   	                    <option value="{{$tag->id}}" {{ ($tag->id == $post_tag->id)? 'selected':'' }}> {{$tag->name}}</option>
                      @endforeach
                    @endforeach
                  </select>
              		  <p class="help-block text-danger"></p>
              </div>
          </div>
          
          <?php $image = "/img/post_image/".htmlspecialchars($post->image); 
                $img = "background-image: url($image)";
          ?>
          <div class="row control-group hidden">
              <div class="form-group col-xs-12 floating-label-form-group controls">
                  <label>Image</label>
                  <input type="file" class="form-control" id="image" name="image" data-validation-required-message="Please select the post image." maxlength="255" autofocus>
                  <p class="help-block text-danger"></p>
              </div>
          </div>

          <div class="row control-group">
              <div class="form-group col-xs-12 floating-label-form-group controls">
                  <label>Description</label>
                  <textarea rows="2" class="form-control" value="$image" placeholder="Description" id="description" name="description" required data-validation-required-message="Please write a short description.">{{ $post -> description }}</textarea>
                  <p class="help-block text-danger"></p>
              </div>
          </div>
          <div class="row control-group">
              <div class="form-group col-xs-12 floating-label-form-group controls">
                  <label>Body</label>
                  <textarea rows="5" class="form-control" placeholder="Body" id="body" name="body" data-validation-required-message="Please write the body.">{!! $post -> body !!}</textarea>
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
    </div>
  </div>
@endsection

@section('scripts')
  <script type="text/javascript" src="/js/parsley.min.js"></script>
  <script type="text/javascript" src="/js/select2.js"></script>
  <script type="text/javascript" src="/js/tinymce/tinymce.min.js"></script>

  <script type="text/javascript">
    $(".js-example-basic-multiple").select2();
  </script>

  <script type="text/javascript">
    tinymce.init({
      selector: 'textarea#body',
      plugins: 'link',
      menubar: false
    });
  </script>
@endsection 