@extends("dash")

@section("pagetitle", " All Tags")

@section('stylesheets')
  <link rel="stylesheet" type="text/css"  href="/css/parsley.css">
  <link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('bgimg', 'background-image: url("/img/home-bg.jpg")')
@section('subheading','A Clean Bootstrap Blog')

@section('content')

  <!-- Main Content -->

<div class="row">
<div class="col-xs-12">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title col-md-6">All Tags</h3>
  	<div class="col-md-6">
  	<button class="btn btn-info pull-right"  data-toggle="modal" data-target="#addtag"><span class="glyphicon glyphicon-plus"> </span> Add Tag</button>

			<!-- Trigger the modal with a button -->
			<!-- Modal -->
			<div id="addtag" class="modal fade" role="dialog">
			  <div class="modal-dialog">

			    <!-- Modal content-->
			    <div class="modal-content">

			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title"><span class="glyphicon glyphicon-plus"> </span> Add Tag</h4>
			      </div>

			      <div class="modal-body">
							<div class="container-fluid">
								<div class="row">
									<div class="col-md-8 col-md-offset-2">
													<!-- Main Content -->
					      		<br><caption><span class="glyphicon glyphicon-plus"> </span> Add Tag</caption><br><br>
						      	<form name="sentMessage" id="contactForm" action="{{route('tags.store')}}" method="POST" data-parsley-validate>
					            <div class="row control-group">
					              <div class="form-group col-xs-12 floating-label-form-group controls">
					                <label>Name</label>
					                <input type="text" class="form-control" placeholder="Tag Name" id="name" name="name" required data-validation-required-message="Please enter the tag name." maxlength="250" autofocus>
					                <p class="help-block text-danger"></p>
						            </div>
						        	</div>	
										  <input type="hidden" name="_token" value="{{csrf_token()}}">
										  <br>
										  <div id="success"></div>
										  <div class="row">
									      <div class="form-group col-xs-12">
									        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-plus"> </span> Add Tag</button>
									      </div>
										  </div>
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
		</div>
  <hr>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Posts</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Options</th>
          </tr>
        </thead>
        <tbody>
          @foreach($tags as $tag)
            <tr>
              <td class="fit">{{ $tag -> id }}</td>
              <td class="fit"><a href="{{route('tags.show', $tag->id)}}">{{ $tag -> name }}</a></td>
              <td class="fit">{{$tag->posts->count()}}</td>
              <td>{{ date('d M Y', strtotime($tag -> created_at)) }}</td>
              <td>{{ date('d M Y', strtotime($tag -> updated_at)) }}</td>

              <td>
                <a href="{{route('tags.show', $tag->id)}}" class="btn btn-default"><span class="glyphicon glyphicon-eye-open"> </span> View</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>
<!-- /.col -->
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