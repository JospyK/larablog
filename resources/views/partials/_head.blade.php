    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="author" content="Jospy GOUDALO"/>
    <meta name="description" content=""/>
    <meta name="robots" content="index, follow"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>{{ env('APP_NAME') }} | @yield("pagetitle")</title>

    <!-- Bootstrap Core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>

    <!-- Theme CSS -->
    <link href="/css/clean-blog.css" rel="stylesheet"/>
    <link href="/css/main.css" rel="stylesheet"/>
    <link href="/css/animate.css" rel="stylesheet"/>
    <link href="/mdb/css/mdb.css" rel="stylesheet"/>
    <link rel="stylesheet" href="/css/compiled.min.css"/>

    <!-- Custom Fonts -->
    <link href="/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    @yield("stylesheets")
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};
    </script>