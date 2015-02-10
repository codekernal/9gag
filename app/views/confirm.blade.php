<!DOCTYPE html>
<html>
<head>
<title>Planner</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link href="{{URL::to('bs3/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{URL::to('css/style-responsive.css')}}" rel="stylesheet">
<link href="{{URL::to('css/atom-style.css')}}" rel="stylesheet">
<link href="{{URL::to('css/font-awesome.min.css')}}" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/modules/common.js"></script> 

<script src="{{URL::to('js/jquery-1.10.2.js')}}"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="{{URL::to('bs3/js/bootstrap.min.js')}}"></script>
<script src="{{URL::to('js/modules/auth.js')}}"></script> 

<script>
var LOGIN_ERROR = "<?php echo Lang::get('auth.LOGIN_ERROR'); ?>";
var LOGIN_SUCCESS = "<?php echo Lang::get('auth.LOGIN_SUCCESS'); ?>";

</script>
</head>
<body>

<div class="container login-bg">

<form class="login-form-signin">
  <div class="login-logo"><img src="{{URL::to('images/logo.png')}}"></div>
    <h2 class="login-form-signin-heading"><?php echo Lang::get('auth.EMAIL_CONFIRMATION'); ?>
    </h2>
        <div class="login-wrap">

            <?php echo $msg;?>

        </div>



      </form>

    </div>



</body>
</html>