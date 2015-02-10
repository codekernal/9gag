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
<!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
 -->
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
var LOGIN_ERROR = "<?php echo Lang::get('auth.LOGIN_ERROR'); ?>";
var LOGIN_SUCCESS = "<?php echo Lang::get('auth.LOGIN_SUCCESS'); ?>";

</script>
</head>
<body>

<div class="container login-bg" id="login_div" style="display:block;">
<form class="login-form-signin">
  <div class="login-logo"><img src="images/logo.png"></div>
    <h2 class="login-form-signin-heading"><?php echo Lang::get('auth.LOGIN_ACCOUNT'); ?></h2>
        <div class="login-wrap">

        <div class="notification-bar" id="msg"></div>

            <input type="text" autofocus placeholder="Email" id="email" class="form-control">

            <input type="password" id="password" placeholder="<?php echo Lang::get('auth.PASSWORD'); ?>" class="form-control">
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> <?php echo Lang::get('auth.REMEMBER'); ?>
                <span class="pull-right">
                     <a href="javascript:void(0);" onclick="showForgot();" data-toggle="modal">  <?php echo Lang::get('auth.FORGOT_PASSWORD'); ?>?</a>

                </span>
            </label>
            <a  href="javascript:void(0)" onclick="login();" class="btn btn-lg btn-primary btn-block"><?php echo Lang::get('auth.SIGN_IN'); ?></a>
          
            
            <div class="registration">
                <?php echo Lang::get('auth.NO_ACCOUNT'); ?>
                <a href="<?php echo URL::to('/signup'); ?>"><?php echo Lang::get('auth.NEW_ACCOUNT'); ?></a>

                <a href="?lang=en">English</a> | <a href="?lang=gr">German</a>
            </div>

        </div>
      </form>
    </div>


<div class="container login-bg" id="forgot_div" style="display:none;">
<form class="login-form-signin">
  <div class="login-logo"><img src="images/logo.png"></div>
    <h2 class="login-form-signin-heading"><?php echo Lang::get('auth.FORGOT_PASSWORD'); ?></h2>
        <div class="login-wrap">

        <div class="notification-bar" id="forgotmsg"></div>

            <input type="text" autofocus placeholder="Email" id="forgot_email" class="form-control">


            <a  href="javascript:void(0)" onclick="reset();" class="btn btn-lg btn-primary btn-block"><?php echo Lang::get('auth.RESET'); ?></a>
          
            
            <div class="registration">
                <?php echo Lang::get('auth.ALREADY_ACCOUNT'); ?>
                <a onclick="showLogin();" href="javascript:void(0);"><?php echo Lang::get('auth.SIGN_IN'); ?></a>
<br>
                <a href="?lang=en">English</a> | <a href="?lang=gr">German</a>
            </div>

        </div>
      </form>
    </div>


</body>
</html>