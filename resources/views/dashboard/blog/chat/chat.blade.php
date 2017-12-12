@extends("dash")

@section("pagetitle", "Direct Chat")

@section('stylesheets')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" type="text/css"  href="/css/parsley.css">
  <style type="text/css">
  .box{
  }
  .direct-chat-messages {
    overflow-y: none;
    height: 400px;
}
  </style>
@endsection

@section('content')
<!-- DIRECT CHAT -->

<div class="box box-primary direct-chat direct-chat-primary col-xs-12">
  
  <div class="box-header with-border">
    <h3 class="box-title">Direct Chat</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Online" data-widget="chat-pane-toggle">
        <i class="fa fa-users"></i></button>
    </div>
  </div>

  <!-- /.box-header -->
  <div class="box-body">
    <!-- Conversations are loaded here -->
    <div class="direct-chat-messages col-xs-12">
      @foreach($messages as $message)
        @if($message->user->id != Sentinel::getUser()->id)
          <!-- Message. Default to the left -->
          <div class="direct-chat-msg">
            <!-- /.direct-chat-info -->
            <img class="direct-chat-img" src="{{'/img/user_image/'.$message->user->image}}" alt="message user image"><!-- /.direct-chat-img -->
            <div class="direct-chat-text col-xs-8 pull-left">
              <div class="direct-chat-info clearfix">
                <span class="direct-chat-name pull-left"><strong>{{$message->user->first_name}}</strong></span>
                <span class="direct-chat-timestamp pull-right">{{ date('d M Y', strtotime($message -> created_at)) }}</span>
              </div>
              {{$message->message}}
            </div>
            <!-- /.direct-chat-text -->
          </div>
          <!-- /.direct-chat-msg -->
        @endif

        @if($message->user->id == Sentinel::getUser()->id)
          <!-- Message to the right -->
          <div class="direct-chat-msg right">
            <!-- /.direct-chat-info -->
            <img class="direct-chat-img pull-right" src="{{'/img/user_image/'.Sentinel::getUser()->image}}" alt="message user image"><!-- /.direct-chat-img -->
            <div class="direct-chat-text col-xs-8 pull-right">
            <div class="direct-chat-info clearfix">
              <span class="direct-chat-name pull-right""><strong>{{$message->user->first_name}}</strong></span>
              <span class="direct-chat-timestamp pull-left" style="color: #ddd";>{{ date('d M Y', strtotime($message -> created_at)) }} </span>
            </div>
              {{$message->message}}
            </div>
            <!-- /.direct-chat-text -->
          </div>
          <!-- /.direct-chat-msg -->
        @endif
      @endforeach
    </div>
    <!--/.direct-chat-messages-->
  </div>

  <!-- /.box-body -->
  <div class="box-footer">
    <form action="{{route('messages.store')}}" method="post" id="messageform">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        {{method_field("POST")}}
        <div class="input-group">
        <input type="text" name="message" placeholder="Type Message ..." class="form-control" style="height: 40px; margin-top: 3px;">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-primary btn-flat">Send</button>
            </span>
      </div>
    </form>
  </div>

  <!-- /.box-footer-->
</div>
<!--/.direct-chat -->
@endsection
