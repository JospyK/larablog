@extends("dash")
@section("pagetitle", " View Post")

@section("stylesheets")
  <link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('bgimg', 'background-image: url("/img/home-bg.jpg")')
@section('subheading',' $post -> description')

@section("content")

<!-- Post Content -->
<article>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 fit"  style="margin-bottom: 20px;">
        <img src="{{'/img/post_image/'.htmlspecialchars($post->image)}}" class="img-responsive">
        <h1 class="fit">{{ $post -> title }}
        <a href="{{route('posts.preview', $post->slug)}}" class="btn btn-info pull-right">See Real Preview</a>
        </h1>
        <h3 class="fit">{{ $post -> description }}</h3>
        <p class="fit">{!! $post -> body !!}</p>
        <hr>

        <div class="tags"><span class="glyphicon glyphicon-tags"> </span> Tags : 
          @foreach($post->tags as $tag)
            <span class="label label-default">{{$tag -> name}}</span>
          @endforeach
        </div>
      </div>

      <div class="col-md-4">
        <div class="panel panel-primary">
        <div class="panel-heading">DETAILS</div>
        <div class="panel panel-body">
          
          <dl class="dl-horizontal fit">
            <label>URL :</label><br>
            <a href="{{ url('blog/'.$post->slug) }}">{{ url("blog/".$post->slug) }}</a>
            </dl>

          <dl class="dl-horizontal fit">
            <label>Category : </label><br>
            <a href="{{route('categories.show',  $post->category->id)}}">{{ $post -> category -> name}}</a>
          </dl>

          <dl class="dl-horizontal fit">
            <label>Author : </label><br>
            <a href="">{{ $post -> user -> first_name}}</a>
          </dl>

          <dl class="dl-horizontal">
            <p>
            <label>Created At :</label><br>
            {{ date('j M Y, H:i', strtotime($post->created_at)) }}</p>
          </dl>
          
          <dl class="dl-horizontal">
            <p>
            <label>Last Updatate at :</label><br>
            {{ date( 'j M Y, H:i', strtotime($post -> updated_at))}}</p>
          </dl>
          
          <hr>

          <dl class="dl-horizontal fit">
            <div class="row">
              <div class="col-xs-7">
                <label>Statut : </label>
                <span class="label label-{{$post -> statut}}">
                  {{  ($post->statut == 'success') ? 'Accepté'            : '' }}
                  {{  ($post->statut == 'danger' ) ? 'Refusé'             : '' }}
                  {{  ($post->statut == 'info'   ) ? 'En attente dedition': '' }}
                  {{  ($post->statut == 'warning') ? 'Pending'            : '' }}
                </span>
              </div>

              @if(Sentinel::getUser()->roles()->first()->slug == 'admin' && $post->user->id != Sentinel::getUser()->id)
                <div class="col-xs-5">
                  <button class="btn btn-info btn-block" data-toggle="modal" data-target="#statutmenu"><span class="glyphicon glyphicon-pencil"> </span> Change</button>
                </div>
              @endif

              <br>
            </div>
              <br>
            <div class="row">
              <div class="col-xs-12">
                <div class="callout callout-{{$post -> statut}}">
                  <p>{{$post -> edit_message}}</p>
                </div>
              </div>
            </div>
          </dl>
          
          <hr>

          <div class="row">
            @if($post->user->id == Sentinel::getUser()->id)
              @if($post->statut != 'success')
                <div class="col-xs-12" style="margin-bottom: 10px;">
                  <div class="col-xs-6">
                    <a href="{{route('posts.edit', $post->id)}}" class="btn btn-info btn-block">  <span class="glyphicon glyphicon-pencil"> </span> Edit</a>
                  </div>
                  <div class="col-xs-6">
                    <a class="btn btn-danger btn-block" href="{{route('posts.delete', $post->id)}}">  <span class="glyphicon glyphicon-trash"> </span> Trash</a> 
                  </div>
                </div>
              @else
                <div class="col-xs-12" style="margin-bottom: 10px;">
                  <a href="{{route('posts.edit', $post->id)}}" class="btn btn-info btn-block"><span class="glyphicon glyphicon-pencil"> </span> Edit</a>
                </div>
              @endif
            @endif

            <div class="col-xs-12">
              <a href="{{route('posts.index')}}" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-eye-open"> </span> See all posts</a>
            </div>
          </div>
        </div>

        </div>
      </div>


    
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title col-xs-12">
              <span class="glyphicon glyphicon-comment"></span>
              {{ $post->comments->count() }}{{ ($post->comments->count()<=1)? " Comment": " Comments"}}
            </h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
          <div class="be-comment col-md-12">
              <table id="example1" class="table table-hover">
                <thead>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Comment</th>
                  <th>Options</th>
                </thead>

                <tbody>
                  @foreach ($post->comments as $comment)
                    <tr>
                      <td>{{$comment->name}}</td>
                      <td>{{$comment->email}}</td>
                      <td>{{$comment->commnent}}</td>
                      <td class="">
                        <a href="{{route('comments.edit', $comment->id)}}" class="btn btn-default"><span class="glyphicon glyphicon-pencil"> </span></a>
                        <a href="{{route('comments.delete', $comment->id)}}" class="btn btn-default"><span class="glyphicon glyphicon-trash"> </span></a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>


@if(Sentinel::getUser()->roles()->first()->slug == 'admin')
  <!-- Trigger the modal with a button -->
  <!-- Modal -->
  <div id="statutmenu" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Statut Menu</h4>
        </div>

        <div class="modal-body">
          <!-- Main Content -->
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-10 col-md-offset-1">
                <h3>Please set the post state</h3>
                <div class="row">
                  <div class="col-xs-4">
                    <form name"sentMessage" id="contactForm" action="{{route('posts.accept', $post->id)}}" method="post" data-parsley-validate>
                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                      {{method_field("POST")}}
                      <button class="btn btn-success btn-block" type="submit"><span class="glyphicon glyphicon-ok"> </span> Allow</button> 
                    </form>
                  </div>

                  <div class="col-xs-4">
                    <button class="btn btn-info btn-block" data-toggle="modal" data-target="#edit" data-dismiss="modal"><span class="glyphicon glyphicon-pencil"> </span> edit msg</button>
                  </div>

                  <div class="col-xs-4">
                    <button class="btn btn-danger btn-block" data-toggle="modal" data-target="#refuse" data-dismiss="modal"><span class="glyphicon glyphicon-pencil"> </span> Refuse</button>
                  </div>

                </div>
              </div>
            </div>
          </div>  
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>

      </div>

    </div>
  </div>


  <!-- Trigger the modal with a button -->
  <!-- Modal -->
  <div id="edit" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Request</h4>
        </div>

        <div class="modal-body">
          <!-- Main Content -->
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-10 col-md-offset-1">
                <h3>Please add the message</h3>
                <form name="sentMessage" id="contactForm" action="{{route('posts.askEdit', $post->id)}}" method="POST" data-parsley-validate>
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  {{method_field("POST")}}

                  <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                      <label>Description</label>
                      <textarea rows="5" class="form-control" placeholder="Description" id="description" name="description" required data-validation-required-message="Please write a short description."></textarea>
                      <p class="help-block text-danger"></p>
                    </div>
                  </div>

                  <br>
                  <div id="success"></div>
                    <button type="submit" class="btn btn-default">Send Edit Request</button>
                </form>
              </div>
            </div>
          </div>  
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>

      </div>

    </div>
  </div>


  <!-- Trigger the modal with a button -->
  <!-- Modal -->
  <div id="refuse" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Refuse Post</h4>
        </div>

        <div class="modal-body">
          <!-- Main Content -->
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-10 col-md-offset-1">
                <h3>Please add the message</h3>
                <form name="sentMessage" id="contactForm" action="{{route('posts.refuse', $post->id)}}" method="POST" data-parsley-validate>
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  {{method_field("POST")}}

                  <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                      <label>Tell us why your refuse the post</label>
                      <textarea rows="5" class="form-control" placeholder="Tell us why your refuse the post" id="raisons" name="raisons" required data-validation-required-message="Please write a short description."></textarea>
                      <p class="help-block text-danger"></p>
                    </div>
                  </div>

                  <br>
                  <div id="success"></div>
                      <button type="submit" class="btn btn-default">Validate</button>
                </form>
              </div>
            </div>
          </div>  
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>

      </div>

    </div>
  </div>
  @endif

</article>

@endsection

@section("scripts")
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
@endsection