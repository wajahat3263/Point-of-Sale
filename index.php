<?php


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>POS | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="plugins/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="plugins/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- Sweet Alert 2 -->
  <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="background-image: url(assets/img/login.png); overflow: hidden;">
  <style type="text/css">
    .sweet-alert
      {
         /*width: 500px !important;*/
         font-size: 18px;
      }
</style>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="login-box-body">
    <div class="login-logo">
      <img src="assets/img/logo.png" height="150">
  </div>
    <!-- <p class="login-box-msg">Sign in to start your session</p> -->

    <form action="" method="post" id="login_form">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="User name/Email" name="username_email" value="<?php 
        if(isset($_COOKIE['email_username'])){
          echo $_COOKIE['email_username'];
        } 
        ?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" value="<?php 
        if(isset($_COOKIE['pass_word'])){
          echo $_COOKIE['pass_word'];
        } 
        ?>">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-6" style="margin-top: -12px;">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember_me" <?php 
        if(isset($_COOKIE['pass_word'])){?>
          checked
        <?php
        } 
        ?>> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-6 text-right">
          <a href="forgot_password.php">Forgot Password?</a>
        </div>
        <!-- /.col -->
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-success btn-block" id="login">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!-- <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> -->
    <!-- /.social-auth-links -->
    <!-- <div class="row">
      <div class="col-xs-12 text-center" style="margin-top: 10px;">
        <a href="register.html">Register a new membership</a>
      </div>
    </div> -->
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="plugins/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>

<!-- Sweet Alert 2 -->
<script src="plugins/sweetalert2/sweetalert2.js"></script>

<script>
  $(document).ready(function() {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });


    ///Login Ajax Request///
        $("#login").click(function(e){
            if($("#login_form")[0].checkValidity()){
                e.preventDefault();

                var login_data=new FormData($("#login_form")[0]);
                login_data.append("action","login_user");

                $.ajax({
                    url: 'includes/user_module.php',
                    method: 'post',
                    data: login_data,
                    contentType: false,
                    processData: false,
                    success:function(response){
                        console.log(response);
                        if($.trim(response) === 'logged_in'){
                            window.location = 'dashboard.php';
                        }else if($.trim(response) === 'wrong_password'){
                            Swal.fire({
                                        title: "Password Error!",
                                        text: "Password is Wrong Please Try Again!",
                                        type: "error",
                                        customClass: "sweet-alert",
                                    });
                        }else if($.trim(response) === 'user_not_found'){
                          Swal.fire({
                                        title: "Error!",
                                        text: "User Not Found!",
                                        type: "error",
                                        customClass: "sweet-alert",
                                    });
                        }else{
                          Swal.fire({
                                        title: "Error!",
                                        text: "Something went wrong!",
                                        type: "error",
                                        customClass: "sweet-alert",
                                    });
                        }
                    }
                });
            }
        });





  });
</script>
</body>
</html>
