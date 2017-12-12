@extends("dash")

@section("pagetitle", " Mail Box")

@section('stylesheets')
  <!-- iCheck -->
  <link rel="stylesheet" href="/plugins/iCheck/flat/blue.css">
  <link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css">
  <style type="text/css">
    #example2_wrapper{
      margin: 10px;
    }
  </style>
@endsection


@section("content")
  <div class="row">
    <div class="col-md-3">
      <a href="{{route('newsletter.create')}}" class="btn btn-primary btn-block margin-bottom">Create</a>

      <br>
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Folders</h3>

          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body no-padding">
          <ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="#"><i class="fa fa-inbox"></i> Inbox<span class="label label-primary pull-right">12</span></a></li>
            <li><a href="#"><i class="fa fa-envelope-o"></i> Sent</a></li>
            <li><a href="#"><i class="fa fa-star-o"></i> Important</a></li>
            <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li>
          </ul>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /. box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Inbox</h3>

          <div class="box-tools pull-right">
            <div class="has-feedback">
              <input type="text" class="form-control input-sm" placeholder="Search Mail">
              <span class="glyphicon glyphicon-search form-control-feedback"></span>
            </div>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <div class="mailbox-controls">
            <!-- Check all button -->
            <div class="btn-group">
              <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
              <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
              <a type="button" class="btn btn-default btn-sm" href="{{route('newsletter.index')}}"><i class="fa fa-refresh"></i></a>
            </div>
            <!-- /.btn-group -->
          </div>
          <div class="mailbox-messages">
            <table id="example2" class="table table-hover">
              <thead  style="margin:10px;">
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($news as $new)
                  <tr>
                    <td><input type="checkbox"></td>
                    <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow" style="font-size: 18px; padding-top:3px;"></i></a></td>
                    <td class="mailbox-name"><a href="{{route('newsletter.show', $new->id)}}">{{$new->title}}</a></td>
                    <td class="mailbox-subject">
                      <b>
                        {{$new->subject}}
                      </b> -
                        {{ substr(strip_tags($new -> body), 0, 20) }}
                        {{ strlen(strip_tags($new-> body)) >20 ? "..." : "" }}
                    </td>
                    <td class="mailbox-date">{{ date('j M Y, H:i', strtotime($new->created_at)) }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <!-- /.table -->
          </div>
          <!-- /.mail-box-messages -->
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /. box -->
    </div>
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
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": true
    });
  });
</script>
<script src="/plugins/iCheck/icheck.min.js"></script>
<!-- Page Script -->
<script>
  $(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");

      //Switch states
      if (glyph) {
        $this.toggleClass("glyphicon-star");
        $this.toggleClass("glyphicon-star-empty");
      }

      if (fa) {
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
    });
  });
</script>
@endsection