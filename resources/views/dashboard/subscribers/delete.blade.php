@extends("dash")
@section("pagetitle", " Delete Post")

@section("stylesheets")
@endsection

@section('bgimg', 'background-image: url("/img/home-bg.jpg")')
@section('subheading',' ')

@section("content")

<!-- Post Content -->
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <p>Name :    {{$post->name}} </p>
      <p>Email :   {{$post->email}}</p>
      <p>post : {{$post->commnent}}</p>

    <div class="col-xs-4">
      <a class="btn btn-primary btn-block" href="{{route('posts.edit', $post->id)}}"><span class="glyphicon glyphicon-trash"> </span> Edit</a> 
    </div>
    <div class="col-xs-4">
      <form name"sentMessage" id="contactForm" action="{{route('posts.destroy', $post->id)}}" method="post" data-parsley-validate>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        {{method_field("DELETE")}}
        <button class="btn btn-danger btn-block" type="submit"><span class="glyphicon glyphicon-trash"> </span> Delete</button>
      </form>
    </div>
    <div class="col-xs-4">
      <a class="btn btn-primary btn-block" href="{{route('posts.show', $post->id)}}"><span class="glyphicon glyphicon-trash"> </span> Cancel</a> 
    </div>
    </div>
  </div>
</div>
@endsection

@section("scripts")
@endsection