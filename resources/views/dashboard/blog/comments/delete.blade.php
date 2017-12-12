@extends("dash")
@section("pagetitle", " Delete Comment")

@section("stylesheets")
@endsection

@section('bgimg', 'background-image: url("/img/home-bg.jpg")')
@section('subheading',' ')

@section("content")

<!-- Post Content -->
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <p>Name :    {{$comment->name}} </p>
      <p>Email :   {{$comment->email}}</p>
      <p>Comment : {{$comment->commnent}}</p>

    <div class="col-xs-6">
      <form name"sentMessage" id="contactForm" action="{{route('comments.destroy', $comment->id)}}" method="post" data-parsley-validate>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        {{method_field("DELETE")}}
        <button class="btn btn-danger btn-block" type="submit"><span class="glyphicon glyphicon-trash"> </span> Delete</button> 
      </form>
    </div>
    <div class="col-xs-6">
      <button class="btn btn-primary btn-block" type="submit"><span class="glyphicon glyphicon-trash"> </span> Cancel</button> 
    </div>
    </div>
  </div>
</div>
@endsection

@section("scripts")
@endsection