@extends("dash")

@section("pagetitle", " All user")

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
 <h3 class="box-title col-md-6">New user</h3>
    <div class="col-md-6">
    <a class="btn btn-info pull-right" href="{{ route('register')}}"><span class="glyphicon glyphicon-plus"> </span> Add user</a>

    </div>
  <hr>
 </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>first name</th>
              <th>last name</th>
              <th>Classe</th>
              <th>Total Posts</th>
              <th>Level</th>
              <th>Created At</th>
              <th>Updated At</th>
              <th>Options</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
              <tr class="">
                <td class="fit">{{ $user -> id }}</td>
                <td class="fit">
                    {{ substr($user -> first_name, 0, 40) }}
                    {{ strlen($user-> first_name) > 40 ? "...." : "" }}
                </td>
                <td class="fit">{{ $user->last_name }}</td>
                
                <td class="fit">{{ $user->classe}}</td>

                <td>{{$user->posts->count()}}</td>

                <td class="fit">{{$user->roles()->first()->name}}</td>

                <td>{{ date('d M Y', strtotime($user -> created_at)) }}</td>
                <td>{{ date('d M Y', strtotime($user -> updated_at)) }}</td>
                <td>
                 <a href="{{route('users.show', $user->id)}}" class="btn btn-default"><span class="glyphicon glyphicon-eye-open"> </span> View</a>
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