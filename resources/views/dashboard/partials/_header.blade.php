<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield("pagetitle")
        <small>{{Sentinel::getUser()->roles()->first()->name}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

        @for($i = 1; $i <= count(Request::segments()); $i++)
          <li class="{{($i==count(Request::segments())-1) ? 'active' : ''}}">
            <a href="@for($j =1; $j <= $i; $j++){{'/'.Request::segment($j)}}@endfor">{{Request::segment($i)}}</a>
          </li>
        @endfor
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      @include("partials._messages")
      @yield("content")
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->