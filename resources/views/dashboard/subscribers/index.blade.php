@extends("dash")

@section("pagetitle", " My subscribers")

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
        <h3 class="box-title">New subscriber</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>name</th>
              <th>Email</th>
              <th>Created At</th>
              <th>Updated At</th>
            </tr>
          </thead>
          <tbody>
            @foreach($subscribers as $subscriber)
              <tr class="{{ $subscriber->statut }}">
                <td class="fit">{{ $subscriber -> id }}</td>
                <td class="fit">
                    {{ substr($subscriber -> name, 0, 20) }}
                    {{ strlen($subscriber-> name) > 20 ? "..." : "" }}
                </td>
                <td class="fit">{{ $subscriber -> email }}</td>

                <td>{{ date('d M Y', strtotime($subscriber -> created_at)) }}</td>
                <td>{{ date('d M Y', strtotime($subscriber -> updated_at)) }}</td>
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