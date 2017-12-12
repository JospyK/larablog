<!DOCTYPE html>
<html lang="en">

<head>
  @include("partials._head")
</head>

  <body id="page-top">

    @include("partials._nav")
    
    @include("partials._header")
    
    @include("partials._messages")

    @yield("content")

    <hr>
    
    @include("partials._footer")

    @include("partials._javascript")

    @yield("scripts")
  </body>
  
</html>
