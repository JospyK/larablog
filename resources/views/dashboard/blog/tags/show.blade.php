@extends("dash")

@section("pagetitle", " $tag->name Tag")

@section('stylesheets')
  <link rel="stylesheet" type="text/css"  href="/css/parsley.css">
  <link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('content')

<div class="row">
<div class="col-xs-12">
  <div class="box">
    <div class="box-header">
        <!-- Main Content -->
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <h1 class=""><span class="glyphicon glyphicon-tags"> </span>  {{$tag->name}} Tag <small>{{$tag->posts->count()}} {{($tag->posts->count() <= 1)? ' Post' : ' Posts'}}</small></h1>
          </div>
          <br>
          @if(Sentinel::getUser()->roles()->first()->slug == 'admin')
            <div class="col-md-2">
              <button class="btn btn-default btn-block"  data-toggle="modal" data-target="#edit"><span class="glyphicon glyphicon-pencil"></span> Edit</buttonn>
            </div>
            <div class="col-md-2">
              <button class="btn btn-danger btn-block"  data-toggle="modal" data-target="#delete"><span class="glyphicon glyphicon-trash"></span> Delete</button>
            </div>
            <div class="col-md-2">
              <a class="btn btn-default btn-block" href="{{route('tags.index')}}" ><span class="glyphicon glyphicon-eye-open"> </span> All Tags</a>
          </div>
          @elseif(Sentinel::getUser()->roles()->first()->slug == 'manager')
            <div class="col-md-3">
              <button class="btn btn-default btn-block"  data-toggle="modal" data-target="#edit"><span class="glyphicon glyphicon-pencil"></span> Edit</buttonn>
            </div>
            <div class="col-md-3">
              <a class="btn btn-default btn-block" href="{{route('tags.index')}}" ><span class="glyphicon glyphicon-eye-open"> </span> All Tags</a>
          </div>
          @endif
        </div>
        <hr>
    </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-hover">
  			<thead>
  				<tr>
  					<th>#</th>
  					<th>Post Title</th>
            <th>Post Category</th>
  					<th>Tags</th>
  					<th>Options</th>
  				</tr>
  			</thead>
  			<tbody>
  				@foreach ($tag->posts as $post)
  					<tr>
  						<td>{{ $post->id}}</td>
              <td><a href="{{route('posts.show', $post->id)}}">{{ $post->title }}</a></td>
  						<td><a href="{{route('categories.show', $post -> category -> id)}}">{{ $post -> category -> name}}</a></td>
  						<td>
  							@foreach($post->tags as $tag)
  								<span class="label label-default">{{ $tag->name }}</span>
  							@endforeach
  						</td>
  						<td>
  							<a href="{{route('posts.show', $post->id)}}" class="btn btn-default btn-xs" ><span class="glyphicon glyphicon-eye-open"></span> View</a>
  						</td>
  					</tr>
  				@endforeach
  			</tbody>
  		</table>
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
          <h4 class="modal-title">Edit Tag</h4>
        </div>

        <div class="modal-body">
          <!-- Main Content -->
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-10 col-md-offset-1">
                <h3>Please edit your tag</h3>
                <form name="sentMessage" id="contactForm" action="{{route('tags.update', $tag->id)}}" method="POST" data-parsley-validate>
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  {{method_field("PUT")}}

                  <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                      <label>Name</label>
                      <input type="text" class="form-control" placeholder="Tag Name" id="name" name="name" value="{{$tag->name}}" required data-validation-required-message="Please enter the tag name." maxlength="250" autofocus>
                      <p class="help-block text-danger"></p>
                    </div>
                  </div>  
                  <br>
                  <div id="success"></div>
                      <button type="submit" class="btn btn-default">Edit Tag</button>
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
  <div id="delete" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-trash"> </span> Delete</h4>
        </div>

        <div class="modal-body">
          <!-- tag Content -->
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-10 col-md-offset-1">
                <p>Name :    {{$tag->name}} </p>

              <div class="col-xs-4">
                <button class="btn btn-default btn-block" data-toggle="modal" data-target="#edit" data-dismiss="modal"><span class="glyphicon glyphicon-pencil"> </span> Edit</button>
              </div>
              <div class="col-xs-4">
                <form name"sentMessage" id="contactForm" action="{{route('tags.destroy', $tag->id)}}" method="post" data-parsley-validate>
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    {{method_field("DELETE")}}
                    <button class="btn btn-danger btn-block" type="submit"><span class="glyphicon glyphicon-trash"> </span> Delete</button> 
                  </form>
              </div>
              <div class="col-xs-4">
                <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button>
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

</div>
@endsection

@section('scripts')
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
