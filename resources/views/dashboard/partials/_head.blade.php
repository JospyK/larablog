  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <meta name="author" content="Jospy GOUDALO"/>
  <meta name="description" content=""/>
  <meta name="robots" content="noindex, follow" />
  <meta name="csrf-token" content="{{ csrf_token() }}"/>

  <title>{{ env('APP_NAME') }} | @yield("pagetitle")</title>
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css"/>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/vendor/font-awesome/css/font-awesome.min.css"/>
  <!-- Ionicons -->
  <link rel="stylesheet" href="/dist/css/ionicons.min.css"/>
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/AdminLTE.min.css"/>
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/dist/css/skins/_all-skins.min.css"/>
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="/mdb/css/mdb.css" rel="stylesheet"/>
  @yield("stylesheets")

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <script>
      window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};
  </script>
  
