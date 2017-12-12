
<div id="sidebar" class="visible">

    <h3 class="text-center">Dashboard</h3>

    <hr>
    
    <ul>     
        
        <li><a class="btn-block" href="/">Home</a></li>
        
        <li class="">
            <div class="colllapse" data-toggle="collapse" data-target="#collapse1">Articles
            <span class="caret"></span>
            </div>
            <ul id="collapse1" class="collapse">
              <li class="first"><a class="btn-block" href="/posts">All</a></li>
              <li class="last"><a class="btn-block" href="/posts/create">Create</a></li>
            </ul>
        </li>

        <li class=""><a class="btn-block" href="/categories">Categories</a></li>
        <li class=""><a class="btn-block" href="/tags">Tags</a></li>

        
        <li class="">
            <div class="colllapse" data-toggle="collapse" data-target="#collapse4">
            Utilisateurs
            <span class="caret"></span>
            </div>
            <ul id="collapse4" class="collapse">
              <li class="first">Two</li>
              <li class="last">Three</li>
            </ul>
        </li>
        
        <li>Notifications</li>
        
        <li>Draft</li>

    </ul>
</div>

<div id="overside" class="">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-1">
        <div id="btn">
            <span class="glyphicon glyphicon-list"></span>
        </div>   
      </div>
      <div class="col-xs-9">
          <h3 class="text-center">@yield("pagetitle")</h3>
      </div>
      <div class="col-xs-2">
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                  toto <span class="caret"></span>
              </a>

              <ul class="dropdown-menu" role="menu">
                <li><a href="{{route('posts.index')}}">Posts</a></li>
                <li><a href="{{ route('categories.index')}}">Categories</a></li>
                <li><a href="{{ route('tags.index')}}">Tags</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li>
                    <form id="logout-form" action="/logout" method="POST">
                        {{ csrf_field() }}
                      <input type="submit" value="Logout">
                    </form>
                </li>
              </ul>
          </li>
      </ul>
    <!-- /.navbar-collapse -->


      </div>
    </div>
      <hr>
  </div>
