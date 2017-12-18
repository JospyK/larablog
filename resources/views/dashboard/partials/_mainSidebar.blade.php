
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{'/img/user_image/'.Sentinel::getUser()->image}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Sentinel::getUser()->first_name }} {{ Sentinel::getUser()->last_name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="{{route('dash.search')}}" method="post" class="sidebar-form">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        {{method_field("POST")}}
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>

        <li class="{{ Request::is('/') ? 'active' : ''}}"><a href="/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        
        <li class="{{ (Request::is('dashboard/posts') or Request::is('dashboard/posts/create')) ? 'active' : ''}} treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Posts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              @if(Sentinel::getUser()->roles()->first()->slug == 'manager')
                @if(Sentinel::getUser()->posts->where('statut', '=', 'info')->count() >0)
                <span class="label label-info pull-right">{{Sentinel::getUser()->posts->where('statut', '=', 'info')->count()}}</span>
                @endif
                @if(Sentinel::getUser()->posts->where('statut', '=', 'warning')->count() >0)
                <span class="label label-warning pull-right">{{Sentinel::getUser()->posts->where('statut', '=', 'warning')->count()}}</span>
                @endif
              @elseif(Sentinel::getUser()->roles()->first()->slug == 'admin')
                @if(\App\Post::all()->where('statut', '=', 'info')->count() >0)
                <span class="label label-info pull-right">{{\App\Post::all()->where('statut', '=', 'info')->count()}}</span>
                @endif
                @if(\App\Post::all()->where('statut', '=', 'warning')->count() >0)
                <span class="label label-warning pull-right">{{\App\Post::all()->where('statut', '=', 'warning')->count()}}</span>
                @endif
              @endif
            </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a href="{{route('posts.index')}}"><i class="fa fa-circle-o"></i> My Posts</a></li>
            <li class=""><a href="{{route('posts.trashed')}}"><i class="fa fa-circle-o"></i> Trashed Posts</a></li>
            <li class=""><a href="{{route('posts.all')}}"><i class="fa fa-circle-o"></i> All Posts</a></li>
            <li class=""><a href="{{route('posts.create')}}"><i class="fa fa-circle-o"></i> New Post</a></li>
          </ul>
        </li>

        <li class="{{ Request::is('dashboard/categories') ? 'active' : ''}}"><a href="{{ route('categories.index') }}"><i class="fa fa-folder"></i> <span>Categories</span></a></li>

        <li class="{{ Request::is('dashboard/tags') ? 'active' : ''}}"><a href="{{ route('tags.index') }}"><i class="fa fa-tags"></i> <span>Tags</span></a></li>
        
        <li class="{{ Request::is('dashboard/users') ? 'active' : ''}}"><a href="{{ route('users.index') }}"><i class="fa fa-users"></i> <span>Users</span></a></li>

        <li class="{{ Request::is('dashboard/messages') ? 'active' : ''}}">
          <a href="{{route('messages.index')}}">
            <i class="fa fa-comments"></i> <span>Messages</span>
<!--             <span class="pull-right-container">
              <small class="label pull-right bg-red">{{Sentinel::getUser()->messages->where('read', '=', null)->count()}}</small>
            </span> -->
          </a>
        </li>

        <li class="{{ Request::is('/blog') ? 'active' : ''}}"><a href="{{ route('blog.index') }}"><i class="fa fa-home"></i> <span>Go to blog</span></a></li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
