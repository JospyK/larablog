
  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini" style="font-size: 18px;"><b><span class="fa fa-dashboard"></span></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>{{ env('APP_NAME') }}</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->


              @if(Sentinel::getUser()->roles()->first()->slug == 'manager')

                <li class="dropdown messages-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-edit"></i>
                      <span class="label label-info">{{Sentinel::getUser()->posts->where('statut', '=', 'info')->count()}}</span>
                  </a>
                  <ul class="dropdown-menu">
                    @if(Sentinel::getUser()->posts->where('statut', '=', 'info')->count() > 0)
                      <li class="header">You have {{Sentinel::getUser()->posts->where('statut', '=', 'info')->count()}} edit request</li>
                    @endif
                    <li>
                      <!-- inner menu: contains the actual data -->
                      <ul class="menu">
                      @forelse(Sentinel::getUser()->posts->where('statut', '=', 'info') as $epost)
                        <li>
                          <a href="#">
                            <div class="pull-left">
                              <img src="{{'/img/post_image/'.htmlspecialchars($epost->image)}}" class="img-circle" alt="Post Image">
                            </div>
                            <h4>
                              {{$epost->title}}
                              <small><i class="fa fa-clock-o"></i> {{ date('d M Y', strtotime($epost -> created_at)) }}</small>
                            </h4>
                            <p>{{$epost->description}}</p>
                          </a>
                        </li>
                          @empty
                              <li> <a href="#" style="color: #333;"> <i class="fa fa-times text-red"> </i> No Edit Request </a></li>
                        @endforelse
                      </ul>
                    </li>
                  </ul>
                </li>

              @elseif(Sentinel::getUser()->roles()->first()->slug == 'admin')

                <li class="dropdown messages-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-edit"></i>
                      <span class="label label-info">{{\App\Post::all()->where('statut', '=', 'info')->count()}}</span>
                  </a>
                  <ul class="dropdown-menu">
                    @if(\App\Post::all()->where('statut', '=', 'info')->count() > 0)
                      <li class="header">You have {{\App\Post::all()->where('statut', '=', 'info')->count()}} edit request</li>
                    @endif
                    <li>
                      <!-- inner menu: contains the actual data -->
                      <ul class="menu">
                      @forelse(\App\Post::all()->where('statut', '=', 'info') as $epost)
                        <li>
                          <a href="#">
                            <div class="pull-left">
                              <img src="{{'/img/post_image/'.htmlspecialchars($epost->image)}}" class="img-circle" alt="Post Image">
                            </div>
                            <h4>
                              {{$epost->title}}
                              <small><i class="fa fa-clock-o"></i> {{ date('d M Y', strtotime($epost -> created_at)) }}</small>
                            </h4>
                            <p>{{$epost->description}}</p>
                          </a>
                        </li>
                          @empty
                              <li> <a href="#" style="color: #333;"> <i class="fa fa-times text-red"> </i> No Edit Request </a></li>
                        @endforelse
                      </ul>
                    </li>
                  </ul>
                </li>

              @endif




          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu" id="markasread">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning count">{{Sentinel::getUser()->unreadnotifications->count() }}</span>
            </a>
            <ul class="dropdown-menu">
              @if(Sentinel::getUser()->unreadnotifications->count() > 0)
                <li class="header">You have {{Sentinel::getUser()->unreadnotifications->count() }} notifications</li>
              @endif
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  @include('dashboard.partials._notifications')
                </ul>
              </li>
              @if(Sentinel::getUser()->unreadnotifications->count() > 0)
                <li class="footer"><a href="#">View all</a></li>
              @endif
            </ul>
          </li>
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{'/img/user_image/'.Sentinel::getUser()->image}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Sentinel::getUser()->first_name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{'/img/user_image/'.Sentinel::getUser()->image}}" class="img-circle" alt="User Image">

                <p>
                  {{ Sentinel::getUser()->first_name }} {{ Sentinel::getUser()->last_name }} - 
                  {{Sentinel::getUser()->roles()->first()->name}}
                  <small>Member since {{ date('d M Y', strtotime(Sentinel::getUser() -> created_at)) }}</small>
                </p>
              </li>
              <!-- Menu Body 
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                 /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{route('users.show', Sentinel::getUser()->id)}}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <form id="logout-form" action="/logout" method="POST"> {{ csrf_field() }} </form>
                  <a href="#" class="btn btn-default btn-flat" onclick="document.getElementById('logout-form').submit();">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>

    </nav>
  </header>