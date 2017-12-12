@extends("dash")

@section("pagetitle", " Results")

@section('stylesheets')
  <link rel="stylesheet" type="text/css"  href="/css/parsley.css">
  <link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css">
@endsection


@section('content')

      <div class="row">
        <div class=" col-sm-10 col-sm-offset-1">
          <!-- search form -->
          <form action="{{route('dash.search')}}" method="post" class="sidebar-form">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            {{method_field("POST")}}
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search.." value="{{$search}}" style="color: #888;">
                  <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                  </span>
            </div>
          </form>
        </div>
      </div>


@if($posts->count() != 0)

    <!-- Main Content -->
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title col-md-6">New Post</h3>
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
      <!-- /.row -->


@else
  <h3>No post found</h3>
@endif




@if($categories->count() != 0)

<div class="row">
<div class="col-xs-12">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title col-md-6">All Categories</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example2" class="table table-hover">
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
          @foreach($categories as $category)
            <tr>
              <td class="fit">{{ $category -> id }}</td>
              <td class="fit"><a href="{{route('categories.show', $category->id)}}">{{ $category -> name }}</a></td>
              <td class="fit">{{$category->posts->count()}}</td>
              <td>{{ date('d M Y', strtotime($category -> created_at)) }}</td>
              <td>{{ date('d M Y', strtotime($category -> updated_at)) }}</td>

              <td>
                <a href="{{route('categories.show', $category->id)}}" class="btn btn-default"><span class="glyphicon glyphicon-eye-open"> </span> View</a>
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

@else
  <h3>No category found</h3>
@endif


@if($tags->count() != 0)

  <!-- Main Content -->
<div class="row">
<div class="col-xs-12">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title col-md-6">All Tags</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example3" class="table table-hover">
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

@else
  <h3>No tag found</h3>
@endif

@endsection

@section('scripts')
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $("#example2").DataTable();
    $("#example3").DataTable();
    $('#example4').DataTable({
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
