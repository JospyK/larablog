<!-- Navigation -->
<nav class="navbar navbar-default navbar-custom navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header page-scroll">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        Menu <i class="fa fa-bars"></i>
      </button>
      <a class="navbar-brand" href="/">{{ env('APP_NAME') }}</a>
    </div>

<!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li class="{{ Request::is('/')? 'active' : ''}}">
            <a href="/">Home</a>
        </li>
        <li class="{{ Request::is('about')? 'active' : ''}}">
            <a href="/about">About</a>
        </li>
        <li class="{{ Request::is('blog')? 'active' : ''}}">
            <a href="/blog">Blog</a>
        </li>
        <li class="{{ Request::is('contact')? 'active' : ''}}">
            <a href="/contact">Contact</a>
        </li>
        <!-- <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <b class="caret"></b></a>
          <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
            <li><a href="#">Logout</a></li>
          </ul>
        </li> -->
        <!-- Authentication Links -->
        @if (!Sentinel::check())
          <li><a href="/login">Login</a></li>
        @else
          <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                  {{ Sentinel::getUser()->first_name }} {{ Sentinel::getUser()->last_name }} <span class="caret"></span>
              </a>

              <ul class="dropdown-menu" role="menu">
                <li><a href="{{route('users.show', Sentinel::getUser()->id)}}">Profil</a></li>
                <li role="separator" class="divider"></li>
                <li>
                    <form id="logout-form" action="/logout" method="POST">
                        {{ csrf_field() }}
                    </form>
                      <a href="#" onclick="document.getElementById('logout-form').submit();">Logout</a>
                </li>
              </ul>
          </li>
        @endif
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container -->
</nav>