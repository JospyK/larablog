@extends("dash")

@section("pagetitle", " Mail Box")

@section('stylesheets')
  <link rel="stylesheet" type="text/css" href="/css/parsley.css">
@endsection

@section("content")
    <!-- Main content -->
      <div class="row">
        <div class="col-md-3">
          <a href="{{route('newsletter.create')}}" class="btn btn-primary btn-block margin-bottom">Compose</a>
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
              <h3 class="box-title">Read Mail</h3>

              <!-- <div class="box-tools pull-right">
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
              </div> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
                <h3>{{$new->subject}}</h3>
                <h5>From: {{$new->user->first_name}}
                  <span class="mailbox-read-time pull-right">{{ date('j M Y, H:i', strtotime($new->created_at)) }}</span></h5>
              </div>
              <!-- /.mailbox-read-info -->
<!--               
              <div class="mailbox-controls with-border text-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Delete">
                    <i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Reply">
                    <i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Forward">
                    <i class="fa fa-share"></i></button>
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print">
                    <i class="fa fa-print"></i></button>
                </div>
                <!- /.btn-group 
              </div>
              <!- /.mailbox-controls --> 

              <div class="mailbox-read-message">
                {!! $new -> body !!}
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <a href="{{route('newsletter.diffuse', $new->id)}}" type="button" class="btn btn-info pull-right"><i class="fa fa-reply"></i> Diffuse</a>
              <a href="{{route('newsletter.destroy', $new->id)}}" type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</a>
              <a href="{{route('newsletter.edit', $new->id)}}" type="button" class="btn btn-primary"><i class="fa fa-trash-o"></i> Edit</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      @endsection

@section('script')

@endsection