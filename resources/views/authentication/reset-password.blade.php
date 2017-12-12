<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title> {{env('APP_NAME')}} | Reset Password</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css"/>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/vendor/font-awesome/css/font-awesome.min.css"/>
  <!-- Ionicons -->
  <link rel="stylesheet" href="/dist/css/ionicons.min.css"/>
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/AdminLTE.min.css"/>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">

  <div class="login-logo">
    <a href="/"><b>IT</b>Review</a>
  </div>

  <!-- /.login-logo -->
    @include("dashboard.partials._messages")

  <div id="danger"></div>
  <div class="login-box-body">
    <p class="login-box-msg">Enter your password to recover your password</p>

    <form role="form" method="POST" action="/forgot-password">
      {{ csrf_field() }}
      
      <div class="form-group has-feedback">
        <label for="password" class="control-label">Password</label>
        <input id="password" type="password" class="form-control" name="password" autocomplete="off" required autofocus placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      
      <div class="form-group has-feedback">
        <label for="password_confirmation" class="control-label">Password Confirmation</label>
        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" autocomplete="off" required autofocus placeholder="password_confirmation">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-group pull-right">Reset</button>
        </div>
        <!-- /.col -->
      </div>
    </form>


  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
