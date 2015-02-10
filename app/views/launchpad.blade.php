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
<script src="js/modules/common.js"></script> 

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<!--layout-container start-->
<div id="layout-container"> 
  <!--Left navbar start-->



<!-- Modal -->
<div class="modal fade" id="addCatPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="popupLabel"></h4>
      </div>
        <div class="modal-body">
            <form role="form" class="form-horizontal">

              <div class="form-group">
                <label class="col-lg-3 control-label" for="recipient-name"><?php echo Lang::get('auth.NAME'); ?> :</label>
              <div class="col-lg-6">
                <input type="text" id="name" class="form-control">
                </div>
                <input type="hidden" id="cat_id" value="">
              </div>

              <div class="form-group">
                <label class="col-lg-3 control-label" for="recipient-name"><?php echo Lang::get('auth.MIN_HOURS'); ?> :</label>
              <div class="col-lg-6">                
                <input type="text" id="min_hours" class="form-control">
              </div>                
              </div>

              <div class="form-group">
                <label class="col-lg-3 control-label" for="recipient-name"><?php echo Lang::get('auth.MAX_HOURS'); ?> :</label>
              <div class="col-lg-6">                
                <input type="text" id="max_hours" class="form-control">
              </div>                
              </div>

              <div class="form-group">
                <label class="col-lg-3 control-label" for="recipient-name"><?php echo Lang::get('auth.DESC'); ?> :</label>
              <div class="col-lg-6">
              <textarea id="desc" cols="50"></textarea>
              </div>
              </div>
                                          
            </form>
          </div>      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="addUpdateCat();" class="btn btn-primary"><?php echo Lang::get('common.SAVE_CHANGES'); ?> </button>
      </div>
    </div>
  </div>
</div>  








  <!--main start-->
  <div id="main" style="left:0px !important;">



    <!--margin-container start-->
    <div class="margin-container">
    <!--scrollable wrapper start-->


      <div class="scrollable wrapper">

<!-- Button trigger modal -->



<div class="page-heading" style="text-align:center">
              <h1>Choose Account</h1>
            </div>
            <hr style="color:#000 !important; border-color:none !important;">

<p style="text-align:center">Please choose the Account you would like to access below.</p>

        <div class="row">

        <!--col-md-12 start-->
          <div class="col-md-12" style="width:66%; margin-left:300px;">



          <!--box-info start-->
<div class="row">

<?php
  if(!empty($accounts))
    foreach ($accounts as $key => $account) {
?>
                              <div class="col-lg-6" onclick="setAccount(<?php echo $account['account_id']; ?>);">
                                  <div class="panel" style="cursor:pointer;">
                                      <div class="panel-body">
                                          <div class="bio-chart">
                                          <img src="images/placeholder.png">
                                          </div>
                                          <div class="bio-desk">
                                              <h4 class="red"><?php echo $account['name'];?></h4>
<!--                                              <p>Started : 22 November</p>
                                              <p>Deadline : 10 January</p>
                                              -->
                                          </div>
                                      </div>
                                  </div>
                              </div>

<?php

    }
?>




                          </div>
          </div><!--col-md-12 end-->
        </div><!--row end-->

      </div><!--scrollable wrapper end--> 
    </div><!--margin-container end--> 
  </div><!--main end--> 
</div><!--layout-container end--> 
<script>
    var ADD_CATEGORY = "<?php echo Lang::get('auth.ADD_CATEGORY'); ?>";
    var NO_RECORD = "<?php echo Lang::get('common.NO_RECORD'); ?>";
    var UPDATE_CATEGORY = "<?php echo Lang::get('auth.UPDATE_CATEGORY'); ?>";   
    var EDIT = "<?php echo Lang::get('common.EDIT'); ?>";
    var DELETE = "<?php echo Lang::get('common.DELETE'); ?>";        
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
<script src="js/modules/launchpad.js" type="text/javascript"></script>
</body>
</html>