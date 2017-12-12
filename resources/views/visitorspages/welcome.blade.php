@extends("main")

@section("pagetitle", " Homepage")

@section("stylesheets")

@endsection

@section('bgimg', 'background-image: url("/img/home-bg.jpg")')
@section('subheading','A Clean Bootstrap Blog')

@section("content")
  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
      <h1>Welcome to this awesome blog</h1>
      <p>Contenu a personnnaliser en fonction des objectids</p>
      </div>
    </div>
  </div>
@endsection

@section("scripts")

@endsection