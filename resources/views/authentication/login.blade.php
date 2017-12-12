<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title> {{env('APP_NAME')}} | Log in</title>
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
  <!-- iCheck -->
  <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="/plugins/pace/pace.min.css">

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

  <div id="danger"></div>
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form id="login-form" role="form" method="POST" action="">
      
      <div class="form-group has-feedback">
        <label for="email" class="control-label">E-Mail Address</label>
        <input id="email" type="email" class="form-control" name="email" autocomplete="off" required autofocus placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <label for="password" class="control-label">Password</label>
        <input type="password" class="form-control" placeholder="Password" id="password" name="password" autocomplete="off" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input id="password" type="checkbox" name="remenber_me"> Remenber me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-group pull-right">Login</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!-- 
    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>
    /.social-auth-links -->

    <a href="/forgot-password">I forgot my password</a><br>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<!-- jQuery 2.2.3 -->
<script src="/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
<!-- PACE -->
<script src="/plugins/pace/pace.min.js"></script>

    <script type="text/javascript">
        $(document).ajaxStart(function() { Pace.restart(); });


        $('.alert').hide();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        $("#login-form").submit( function (event){
            event.preventDefault();
            
            var postData = {
                'email' : $('input[name=email]').val(),
                'password' : $('input[name=password]').val(),
                'remenber_me' : $('input[name=remenber_me]').is(':checked'),
            }

            $.ajax({
                type: 'POST',
                url: '/login',
                data: postData,
                
                success: function(response){
                    window.location.href = response.redirect
                },

                error: function(response){
                    $('#danger').append('<div class="container-fluid"><div class="row"><div class="col-sm-10 col-sm-offset-1 alert alert-danger text-center" role="alert" data-dismmiss="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times</button><strong></strong></div></div></div>')
                    $('.alert-danger').text(response.responseJSON.error)
                }
            })            
        });
    </script>
</body>
</html>
