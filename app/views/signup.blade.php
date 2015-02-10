<!DOCTYPE html>
<html>
<head>
<title>Planner</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link href="bs3/css/bootstrap.min.css" rel="stylesheet">
<link href="css/style-responsive.css" rel="stylesheet">
<link href="css/atom-style.css" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/modules/common.js"></script> 

<script src="js/jquery-1.10.2.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="bs3/js/bootstrap.min.js"></script>
<script src="js/modules/auth.js"></script> 

<script>
var SIGNUP_ERROR = "<?php echo Lang::get('auth.SIGNUP_ERROR'); ?>";
var SIGNUP_SUCCESS = "<?php echo Lang::get('auth.SIGNUP_SUCCESS'); ?>";

</script>
</head>
<body>

<div class="container login-bg">

<form class="login-form-signin">
  <div class="login-logo"><img src="images/logo.png"></div>
    <h2 class="login-form-signin-heading"><?php echo Lang::get('auth.CREATE_ACCOUNT_HEADING'); ?></h2>
        <div class="login-wrap">

        <div class="notification-bar" id="msg"></div>

            <input type="text" autofocus placeholder="Email" id="email" class="form-control">

           <input type="text" autofocus placeholder="<?php echo Lang::get('auth.FIRST_NAME'); ?>" id="first_name" class="form-control">

            <input type="text" autofocus placeholder="<?php echo Lang::get('auth.LAST_NAME'); ?>" id="last_name" class="form-control">

            <input type="text" autofocus placeholder="<?php echo Lang::get('auth.COMPANY_NAME'); ?>" id="company_name" class="form-control">

            <input type="password" id="password" placeholder="<?php echo Lang::get('auth.PASSWORD'); ?>" class="form-control">

                <span class="pull-right">
<!--                     <a href="#myModal" data-toggle="modal">  <?php echo Lang::get('auth.FORGOT_PASSWORD'); ?></a> -->

                </span>
            </label>
            <a  href="javascript:void(0)" onclick="signup();" class="btn btn-lg btn-primary btn-block"><?php echo Lang::get('auth.CREATE_ACCOUNT'); ?></a>
          
            
            <div class="registration">
                <?php echo Lang::get('auth.ALREADY_ACCOUNT'); ?>

                <a href="<?php echo URL::to('/login'); ?>"><?php echo Lang::get('auth.SIGN_IN'); ?></a>
                <br>

                <a href="?lang=en">English</a> | <a href="?lang=gr">German</a>
            </div>

        </div>



      </form>

    </div>



</body>
</html>