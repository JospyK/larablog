@extends("dash")

@section("pagetitle", " All Categories")

@section('stylesheets')
  <link rel="stylesheet" type="text/css"  href="/css/parsley.css">
  <link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css">
@endsection


@section('content')


<!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{'/img/user_image/'.Sentinel::getUser()->image}}" alt="User profile picture">

            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a><strong>Last Name</strong> <span class="pull-right"> {{ $user->last_name }}</span></a></li>
                <li><a><strong>First Name</strong> <span class="pull-right"> {{ $user->first_name }}</span></a></li>
                <li><a><strong>Role</strong> <span class="pull-right"> {{ $user->roles()->first()->name }}</span></a></li>
                <li><a><strong>Classe</strong> <span class="pull-right"> {{ $user->classe }}</span></a></li>
                <li><a><strong><i class="fa fa-file-text-o margin-r-5"></i> Description</strong>
                  <p>{{ $user->description }}</p></a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#posts" data-toggle="tab">Posts</a></li>
              <li><a href="#timeline" data-toggle="tab">Timeline</a></li>
              <li><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="posts">


              <div class="row">
                <div class="col-md-8">

                  <div class="chart-responsive">
                    <canvas id="salesChart" class="hidden" style="height: 0px;"></canvas><br>
                    <canvas id="pieChart"></canvas>
                  </div>

                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <div class="box-footer no-padding no-border">
                    <ul class="nav nav-pills nav-stacked">
                      <li><a class="text-green"><i class="fa fa-circle-o"></i> posts acceptés
                          <span class="pull-right"> {{$user->posts->where('statut', '=', 'success')->count() }} </span></a></li>
                      <li><a class="text-orange"><i class="fa fa-circle-o"></i> posts en attente
                          <span class="pull-right"> {{$user->posts->where('statut', '=', 'warning')->count() }} </span></a></li>
                      <li><a class="text-light-blue"><i class="fa fa-circle-o"></i> posts en attente d'edittion
                          <span class="pull-right"> {{$user->posts->where('statut', '=', 'info')->count() }} </span></a></li>
                      <li><a class="text-red"><i class="fa fa-circle-o"></i> posts refusés
                          <span class="pull-right"> {{$user->posts->where('statut', '=', 'danger')->count() }} </span></a></li>
                      <li role="separator" class="divider"><hr></li>
                      <li><a class=""><i class="fa fa-circle-o"></i> Tous les posts
                          <span class="pull-right"> {{$user->posts->count() }} </span></a></li>
                    </ul>
                  </div>
                </div>
                <!-- /.col -->
              </div>


              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-red">
                          10 Feb. 2014
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-envelope bg-blue"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                      <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                      <div class="timeline-body">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                        quora plaxo ideeli hulu weebly balihoo...
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-primary btn-xs">Read more</a>
                        <a class="btn btn-danger btn-xs">Delete</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-user bg-aqua"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                      <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                      </h3>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-comments bg-yellow"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                      <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                      <div class="timeline-body">
                        Take me to your leader!
                        Switzerland is small and neutral!
                        We are more like Germany, ambitious and misunderstood!
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-green">
                          3 Jan. 2014
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-camera bg-purple"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                      <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                      <div class="timeline-body">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <form class="form-horizontal" name="sentMessage" id="contactForm" action="{{route('users.update', $user->id)}}" method="POST" data-parsley-validate enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  {{method_field("PUT")}}
                  
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">First Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" name="first_name" value="{{ $user-> first_name}}" placeholder="Name">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Last Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" name="last_name" value="{{ $user->last_name }}" placeholder="Name">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputDescription" class="col-sm-2 control-label">Description</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputDescription" name="description" placeholder="Description">{{ $user->description}}</textarea>
                    </div>
                  </div>

                  <div class="row control-group hidden">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                      <label>Image</label>
                      <input type="file" class="form-control" id="image" name="image" maxlength="255" autofocus>
                      <p class="help-block text-danger"></p>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-xs-12">
                      <label class="btn btn-danger pull-left" for="image">
                        <span class="glyphicon glyphicon-picture"> </span> Change Image
                      </label>
                      <button type="submit" class="btn btn-danger pull-right">Submit</button>
                    </div>
                  </div>

                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>

@endsection

@section('scripts')
  <!-- ChartJS 1.0.1 -->
  <script src="/plugins/chartjs/Chart.min.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="/dist/js/pages/dashboard2.js"></script>
@endsection