@extends("dash")

@section("pagetitle", " All Post")

@section('stylesheets')
  <link rel="stylesheet" type="text/css"  href="/css/parsley.css">
  <link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css">
@endsection


@section("content")
    <!-- Main Content -->

<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
 <h3 class="box-title col-md-6">New Post</h3>
    <div class="col-md-6">
    <a class="btn btn-info pull-right" href="{{route('posts.create')}}"><span class="glyphicon glyphicon-plus"> </span> Add Post</a>

    </div>
  <hr>
 </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Slug</th>
              <th>Description</th>
              <th>Body</th>
              <th>Author</th>
              <th>Comments</th>
              <th>category</th>
              <th>tags</th>
              <th>Created At</th>
              <th>Updated At</th>
              <th>Options</th>
            </tr>
          </thead>
          <tbody>
            @foreach($posts as $post)
              <tr class="{{ $post->statut }}">
                <td class="fit">{{ $post -> id }}</td>
                <td class="fit">
                    {{ substr($post -> title, 0, 20) }}
                    {{ strlen($post-> title) > 20 ? "...." : "" }}
                </td>
                <td class="fit">{{ $post -> slug }}</td>
                <td class="fit">
                    {{ substr($post -> description, 0, 20) }}
                    {{ strlen($post-> description) >20 ? "...." : "" }}
                </td>
                <td class="fit">
                    {{ substr(strip_tags($post -> body), 0, 20) }}
                    {{ strlen(strip_tags($post-> body)) >20 ? "...." : "" }}
                </td>
                <td>{{ $post -> user -> first_name }}</td>

                <td class="fit">{{ $post -> comments -> count() }}</td>
                <td class="fit">{{ $post -> category -> name}}</td>
                <td class="fit">{{ $post -> tags -> count() }}</td>

                <td>{{ date('d M Y', strtotime($post -> created_at)) }}</td>
                <td>{{ date('d M Y', strtotime($post -> updated_at)) }}</td>
                <td>
                 <a href="{{route('posts.show', $post->id)}}" class="btn btn-default"><span class="glyphicon glyphicon-eye-open"> </span> View</a>
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