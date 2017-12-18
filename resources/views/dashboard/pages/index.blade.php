@extends("dash")

@section("pagetitle", " Welcome")

@section('stylesheets')
  <link rel="stylesheet" type="text/css"  href="/css/parsley.css">
  <link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css">
  <style type="text/css">
    .info-box-content hr{
      margin: 10px;
    }
    .info-box-content{
      padding-top: 10px;
      padding-bottom: 10px;
    }
  </style>
@endsection


@section('content')

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-files-o"></i></span>

            <div class="text-center info-box-content">
              <span class="info-box-text">Posts</span>
              <hr>
              <span class="info-box-number">{{$data["acceptedPosts"]}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-folder"></i></span>

            <div class="text-center info-box-content">
              <span class="info-box-text">Categories</span>
              <hr>
              <span class="info-box-number">{{$data["allCategories"]}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-tags"></i></span>

            <div class="text-center info-box-content">
              <span class="info-box-text">Tags</span>
              <hr>
              <span class="info-box-number">{{$data["allTags"]}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>

            <div class="text-center info-box-content">
              <span class="info-box-text">Users</span>
              <hr>
              <span class="info-box-number">{{$data["allUsers"]}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-8">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Posts Stats</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>

              <div class="box-body">
                <div class="col-md-6">
                  <div class="chart-responsive">
                    <canvas id="salesChart" class="hidden" style="height: 0px;"></canvas><br>
                    <canvas id="pieChart"></canvas>
                  </div>
                </div>
              <!-- /.col -->
                <div class="col-md-6">
                  <div class="box-footer no-padding no-border">
                    <ul class="nav nav-pills nav-stacked">
                      <li><a class="text-green"><i class="fa fa-circle-o"></i> posts acceptés
                          <span class="pull-right"> {{$data["allPosts"]->where('statut', '=', 'success')->count() }} </span></a></li>
                      <li><a class="text-orange"><i class="fa fa-circle-o"></i> posts en attente
                          <span class="pull-right"> {{$data["allPosts"]->where('statut', '=', 'warning')->count() }} </span></a></li>
                      <li><a class="text-light-blue"><i class="fa fa-circle-o"></i> posts en attente d'edittion
                          <span class="pull-right"> {{$data["allPosts"]->where('statut', '=', 'info')->count() }} </span></a></li>
                      <li><a class="text-red"><i class="fa fa-circle-o"></i> posts refusés
                          <span class="pull-right"> {{$data["allPosts"]->where('statut', '=', 'danger')->count() }} </span></a></li>
                      <li role="separator" class="divider"><hr></li>
                      <li><a class=""><i class="fa fa-circle-o"></i> Tous les posts
                          <span class="pull-right"> {{$data["allPosts"]->count() }} </span></a></li>
                    </ul>
                  </div>
                </div>
              <!-- /.col -->
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <!-- PRODUCT LIST -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Recently Added Posts</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                @foreach($data["lastPosts"] as $post)
                <li class="item">
                  <div class="product-img">
                    <img src="{{'/img/post_image/'.htmlspecialchars($post->image)}}" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <a href="{{route('posts.show', $post->id)}}" class="product-title">{{$post->title}}
                      <span class="label label-success pull-right">{{$post->comments()->count()}} Comments</span></a>
                        <span class="product-description">
                          {{$post->description}}
                        </span>
                  </div>
                </li>
                @endforeach
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="{{route('posts.all')}}" class="uppercase">View All Post</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>

        <div class="col-md-4">
          <!-- USERS LIST -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Members</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <ul class="users-list clearfix">
              @foreach($data["lastUsers"] as $user)
                <li>
                  <img src="{{'/img/user_image/'.$user->image}}" alt="User Image">
                  <a class="users-list-name" href="#">{{$user->first_name}}</a>
                  <span class="users-list-date">{{$user->created_at}}</span>
                </li>
              @endforeach
              </ul>
              <!-- /.users-list -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="{{route('users.index')}}" class="uppercase">View All Users</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!--/.box -->
        </div>
    </div>
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
  <!-- ChartJS 1.0.1 -->
<script src="/plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/dist/js/pages/dashboard2.js"></script>
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
