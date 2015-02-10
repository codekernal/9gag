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
<link rel="stylesheet" href="plugins/PCharts/style.css" type="text/css">
<link href="plugins/kalendar/kalendar.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
<script src="js/modules/common.js"></script> 

</head>
<body>
<!--layout-container start-->
<div id="layout-container"> 
  <!--Left navbar start-->
@include('inc.left')
  
  
  <!--main start-->
  <div id="main">
    <div class="head-title">
      <div class="menu-switch"><i class="fa fa-bars"></i></div>
      <!--row start-->
@include('inc.nav')

    </div>
    <!--margin-container start-->
    <div class="margin-container">
    <!--scrollable wrapper start-->

      <div class="scrollable wrapper">
        <div class="row">
          <div class="col-md-12">
            <div class="page-heading">
              <h1><?php echo Lang::get('common.EDIT_PROFILE'); ?></h1>
            </div>
          </div>
        </div>

        
        
        
        
        <div class="row">
                  <div class="profile-nav col-lg-3">


                      <div class="panel">
                          <div class="user-heading round">
                              <a href="#">
                              <img class="profile_pic" src="<?php if(!empty(Session::get('user')['pic']) && file_exists(public_path().'/data/pictures/'.Session::get('user')['pic'])) echo URL::to('/data/pictures/'.Session::get('user')['pic']); else echo 'images/avatar1.jpg'; ?>" alt=""> </a>
                              <h1><?php echo Session::get('user')['full_name'];?></h1>
                              <p><?php echo Session::get('user')['email'];?></p>
                        </div>

                          <ul class="nav nav-pills nav-stacked">
                              <li class="active"><a href="#"> <i class="icon-edit"></i>  <?php echo Lang::get('common.EDIT_PROFILE'); ?> </a></li>
                              
                          </ul>

                      </div>
                  </div>
                  <div class="profile-info col-lg-9">
                      <div class="panel">
<!--                          <div class="bio-graph-heading">
                              Aliquam ac magna metus. Nam sed arcu non tellus fringilla fringilla ut vel ispum. Aliquam ac magna metus.
                          </div>
                          -->
                          <div class="panel-body bio-graph-info">

                                  <div class="notification-bar" id="profile_update_msg"></div>

                              <h1> <?php echo Lang::get('auth.PROFILE_INFO'); ?></h1>
                              <form role="form" class="form-horizontal">

                                  <div class="form-group">
                                      <label class="col-lg-2 control-label"> <?php echo Lang::get('auth.FIRST_NAME'); ?></label>
                                      <div class="col-lg-6">
                                          <input type="text" placeholder=" " value="<?php if(Session::has('user')) echo Session::get('user')['first_name']; ?>" id="first_name" class="form-control">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-lg-2 control-label"> <?php echo Lang::get('auth.LAST_NAME'); ?></label>
                                      <div class="col-lg-6">
                                          <input type="text" placeholder=" " value="<?php if(Session::has('user')) echo Session::get('user')['last_name']; ?>" id="last_name" class="form-control">
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">Email</label>
                                      <div class="col-lg-6">
                                          <input type="text" placeholder=" " readonly="readonly" value="<?php if(Session::has('user')) echo Session::get('user')['email']; ?>"  id="email" class="form-control">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-lg-2 control-label"> <?php echo Lang::get('auth.MOBILE'); ?></label>
                                      <div class="col-lg-6">
                                          <input type="text" placeholder=" " value="<?php if(Session::has('user')) echo Session::get('user')['mobile']; ?>" id="mobile" class="form-control">
                                      </div>
                                  </div>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label"><?php echo Lang::get('auth.CHANGE_AVATOR'); ?></label>
                                          <div class="col-lg-6">
                                              <input type="file" id="picture" name="picture" data-url="picture/upload" class="file-pos">

                                              <img src="<?php if(!empty(Session::get('user')['pic']) && file_exists(public_path().'/data/pictures/'.Session::get('user')['pic'])) echo URL::to('/data/pictures/'.Session::get('user')['pic']); else echo 'images/avatar1.jpg'; ?>" id="temp_pic" width="80" height="80">

                                              <input type="hidden" value="<?php if(Session::has('user')) echo Session::get('user')['pic']; ?>" id="pic_path">
                                          </div>
                                      </div>                                  
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                          <a class="btn btn-danger" href="javascript:void(0);" onclick="updateProfile();"> <?php echo Lang::get('auth.SAVE'); ?></a>
                                          <button class="btn btn-default" type="button">Cancel</button>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </div>
                      <div>
                          <div class="box-info">
                              <h2>  <?php echo Lang::get('auth.SET_NEW_PASSWORD'); ?></h2>
                                  <div class="notification-bar" id="password_update_msg"></div>

                              <div class="panel-body">
                                  <form role="form" class="form-horizontal">
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label"> <?php echo Lang::get('auth.CURRENT_PASSWORD'); ?></label>
                                          <div class="col-lg-6">
                                              <input type="password" placeholder=" " id="current_password" class="form-control">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label"> <?php echo Lang::get('auth.NEW_PASSWORD'); ?></label>
                                          <div class="col-lg-6">
                                              <input type="password" placeholder=" " id="new_password" class="form-control">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label"><?php echo Lang::get('auth.RETYPE_NEW_PASSWORD'); ?></label>
                                          <div class="col-lg-6">
                                              <input type="password" placeholder=" " id="confirm_password" class="form-control">
                                          </div>
                                      </div>



                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <a href="javascript:void(0);" class="btn btn-primary" onclick="updatePassword()"><?php echo Lang::get('auth.SAVE'); ?></a>
                                              <button class="btn btn-default" type="button">Cancel</button>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
        
        
        
        
        
        
      </div>
    </div><!--margin-container end--> 
  </div><!--main end--> 
</div><!--layout-container end--> 

<script>
var MATCH_ERROR = "<?php echo Lang::get('auth.MATCH_ERROR'); ?>";
var PROFILE_UPDATE_ERROR = "<?php echo Lang::get('auth.PROFILE_UPDATE_ERROR'); ?>";
var PROFILE_UPDATE_SUCCESS = "<?php echo Lang::get('auth.PROFILE_UPDATE_SUCCESS'); ?>";


var PASSWORD_ERROR = "<?php echo Lang::get('auth.PASSWORD_ERROR'); ?>";
var PASSWORD_SUCCESS = "<?php echo Lang::get('auth.PASSWORD_SUCCESS'); ?>";
</script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-1.10.2.js"></script> 
<script src="js/jquery-ui-1.9.1.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="bs3/js/bootstrap.min.js"></script> 
<script src="js/smooth-sliding-menu.js"></script> 
<script src="js/console-numbering.js"></script> 
<script src="js/to-do-admin.js"></script> 
<script src="plugins/PCharts/PCharts.js" type="text/javascript"></script> 
<script src="plugins/PCharts/serial.js" type="text/javascript"></script> 
<script src="plugins/PCharts/amstock.js" type="text/javascript"></script> 
<script src="plugins/PCharts/edit-chart.js" type="text/javascript"></script> 
<script src="plugins/PCharts/gauge.js" type="text/javascript"></script> 
<script src="plugins/PCharts/radar.js" type="text/javascript"></script> 
<script src="plugins/PCharts/pie.js" type="text/javascript"></script> 
<script src="plugins/kalendar/kalendar.js" type="text/javascript"></script> 
<script src="plugins/kalendar/edit-kalendar.js" type="text/javascript"></script>
<script src="js/jquery.ui.widget.js"></script>
<script src="js/jquery.iframe-transport.js"></script>
<script src="js/jquery.fileupload.js"></script>
<script src="js/modules/common.js"></script>
<script src="js/modules/profile.js"></script>

<script>
$(function () {
    $('#picture').fileupload({
        dataType: 'json',
        done: function (e, data) {
        file = canvas_url + '/data/pictures/' + data.result.file_name;
        $('#pic_path').val(data.result.file_name);
        $('#temp_pic').attr('src',file);
        }
    });
});
</script>
</body>
</html>