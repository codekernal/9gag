<!DOCTYPE html>
<html>
<head>
<title>Planner</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link href="bs3/css/bootstrap.min.css" rel="stylesheet">
<link href="css/style-responsive.css" rel="stylesheet">

<link href="css/datepicker.css" rel="stylesheet">
<link href="css/atom-style.css" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="plugins/PCharts/style.css" type="text/css">
<link rel="stylesheet" type="text/css" media="screen" href="css/jquery.datetimepicker.css" />

<link href="plugins/kalendar/kalendar.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
<script src="js/modules/common.js"></script> 
<script src="js/jquery-1.10.2.js"></script> 
<script src="js/jquery-ui-1.9.1.js"></script> 
<script type="text/javascript" src="js/jquery.datetimepicker.js"></script>

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
@include('inc.left')


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
                <label class="col-lg-3 control-label" for="recipient-name"><?php echo Lang::get('auth.SALARY_PAYMENT'); ?> :</label>
              <div class="col-lg-6">
                  <select id="payment_type">
                  <option value="">-- Select Salary Payment --</option>
                  <option value="1">Monthly</option>
                  <option value="2">Hourly</option>
                  <option value="3">Invoice</option>
                  </select>
              </div>                
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

<div class="modal fade" id="addEducationPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="popupEducationLabel"></h4>
      </div>
        <div class="modal-body">
            <form role="form" class="form-horizontal">

              <div class="form-group">
                <label class="col-lg-3 control-label" for="recipient-name"><?php echo Lang::get('auth.NAME'); ?> :</label>
              <div class="col-lg-6">
                <input type="text" id="education_name" class="form-control">
                </div>
                <input type="hidden" id="education_id" value="">
              </div>


              <div class="form-group">
                <label class="col-lg-3 control-label" for="recipient-name"><?php echo Lang::get('auth.RAISE'); ?> :</label>
              <div class="col-lg-6">                
                <input type="text" id="raise" class="form-control" value="0">
              </div>                
              </div>

              <div class="form-group">
                <label class="col-lg-3 control-label" for="recipient-name"><?php echo Lang::get('auth.DESC'); ?> :</label>
              <div class="col-lg-6">
              <textarea id="education_desc" cols="50"></textarea>
              </div>
              </div>
                                          
            </form>
          </div>      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="addUpdateEducation();" class="btn btn-primary"><?php echo Lang::get('common.SAVE_CHANGES'); ?> </button>
      </div>
    </div>
  </div>
</div>  

<div class="modal fade" id="addSalaryTypesPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="popupSalaryTypesLabel"></h4>
      </div>
        <div class="modal-body">
            <form role="form" class="form-horizontal">

              <div class="form-group">
                <label class="col-lg-3 control-label" for="recipient-name"><?php echo Lang::get('auth.SALARYTYPE'); ?> :</label>
              <div class="col-lg-6">
                <input type="text" id="salary_type_name" class="form-control">
                </div>
                <input type="hidden" id="salary_type_id" value="">
              </div>

              <div class="form-group">
                <label class="col-lg-3 control-label" for="recipient-name"><?php echo Lang::get('auth.RAISE'); ?> :</label>
              <div class="col-lg-6">                
                <input type="text" id="salary_raise" class="form-control" value="0">
              </div>                
              </div>

              <div class="form-group">
                <label class="col-lg-3 control-label" for="recipient-name"><?php echo Lang::get('auth.DESC'); ?> :</label>
              <div class="col-lg-6">
              <textarea id="salary_desc" cols="50"></textarea>
              </div>
              </div>
                                          
            </form>
          </div>      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="addUpdateSalaryType();" class="btn btn-primary"><?php echo Lang::get('common.SAVE_CHANGES'); ?> </button>
      </div>
    </div>
  </div>
</div>  

<!--  <div class="modal fade" id="addSurchargePopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="popupSurchargeLabel"></h4>
      </div>
        <div class="modal-body">
            <form role="form" class="form-horizontal">

              <div class="form-group">
                <label class="col-lg-3 control-label" for="recipient-name"><?php echo Lang::get('auth.START_TIME'); ?> :</label>
              <div class="col-lg-6">
                <input type="text" id="start_time" class="form-control">
                </div>
              </div>

              <div class="form-group">
                <label class="col-lg-3 control-label" for="recipient-name"><?php echo Lang::get('auth.END_TIME'); ?> :</label>
              <div class="col-lg-6">
                <input type="text" id="end_time" class="form-control">
              </div>
              </div>

              <div class="form-group">
                <label class="col-lg-3 control-label" for="recipient-name"><?php echo Lang::get('auth.RAISE'); ?> :</label>
              <div class="col-lg-6">
                <input type="text" id="night_shift_raise" class="form-control" value="0">
              </div>
              </div>
                                          
            </form>
          </div>      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="addUpdateEducation();" class="btn btn-primary"><?php echo Lang::get('common.SAVE_CHANGES'); ?> </button>
      </div>
    </div>
  </div>
</div>  
 --> 


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

<!-- Button trigger modal -->

        <div class="row">
        <!--col-md-12 start-->
          <div class="col-md-12">
          <!--box-info start-->
              <h4>  <?php echo Lang::get('auth.CATEGORY'); ?> 
              <?php
                if($can_update)
                {
              ?>
                            <button type="button" onclick="showCatPopup(0);" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addCatPopup">
                             <?php echo Lang::get('auth.ADD_CATEGORY'); ?>
                            </button>

                            <button type="button" onclick="showEducationPopup(0);" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addEducationPopup">
                             <?php echo Lang::get('auth.ADD_EDUCATION'); ?>
                            </button>

<!--                             <button type="button" onclick="showSalaryTypePopup(0);" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addSalaryTypesPopup">
                             <?php echo Lang::get('auth.ADD_SALARY_TYPE'); ?>
                            </button> -->

                            <button type="button" onclick="showSurchargeTypePopup(0);" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addSurchargePopup">
                             <?php echo Lang::get('auth.ADD_SURCHARGE'); ?>
                            </button>
              <?php
              }
              ?>
              </h4>

            <div class="tab-container">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab"><?php echo Lang::get('auth.HR_CATEGORIES'); ?></a></li>
                <li><a href="#profile" data-toggle="tab"><?php echo Lang::get('auth.EDUCATION'); ?></a></li>
                <li><a href="#salary" data-toggle="tab"><?php echo Lang::get('auth.SALARY_TYPE'); ?></a></li>
                <li><a href="#surcharges" data-toggle="tab"><?php echo Lang::get('auth.SURCHARGES'); ?></a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active cont" id="home" style="height:100%;">

              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th><?php echo Lang::get('auth.NAME'); ?> <i class="fa fa-sort nameall" style="float:right;cursor:pointer;" onclick="sortbyFunc('all', 'name', 'categories');"></i> <i style="cursor:pointer;float:right;display:none;"  onclick="sortbyFunc('asc', 'name', 'categories');" class="fa fa-sort-asc nameasc"></i>  <i style="cursor:pointer;display:none; float:right;" onclick="sortbyFunc('desc', 'name', 'categories');" class="fa fa-sort-desc namedesc"></i></th>
                    <th style="width:20%;"> <?php echo Lang::get('auth.WORKING_HOURS'); ?> <i class="fa fa-sort min_hoursall" style="float:right;cursor:pointer;" onclick="sortbyFunc('all', 'min_hours', 'categories');"></i> <i style="cursor:pointer;float:right;display:none;"  onclick="sortbyFunc('asc', 'min_hours', 'categories');" class="fa fa-sort-asc min_hoursasc"></i>  <i style="cursor:pointer;display:none; float:right;" onclick="sortbyFunc('desc', 'min_hours', 'categories');" class="fa fa-sort-desc min_hoursdesc"></i></th>
                    <th><?php echo Lang::get('auth.DESC'); ?></th>

                    <?php
                      if($can_update)
                      {
                    ?>                    
                    <th width="150"><?php echo Lang::get('common.ACTIONS'); ?></th>
                      <?php
                    }
                      ?>

                  </tr>
                </thead>
                <tbody id="dataBody">
 
                </tbody>
              </table>

                </div>
            <div class="tab-pane cont" id="profile" style="height:100%;">

              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th><?php echo Lang::get('auth.NAME'); ?> <i class="fa fa-sort nameall" style="float:right;cursor:pointer;" onclick="sortbyFunc('all', 'name', 'education');"></i> <i style="cursor:pointer;float:right;display:none;"  onclick="sortbyFunc('asc', 'name', 'education');" class="fa fa-sort-asc nameasc"></i>  <i style="cursor:pointer;display:none; float:right;" onclick="sortbyFunc('desc', 'name', 'education');" class="fa fa-sort-desc namedesc"></i></th>
                    <th style="width:20%;"><?php echo Lang::get('auth.RAISE'); ?> <i class="fa fa-sort raiseall" style="float:right;cursor:pointer;" onclick="sortbyFunc('all', 'raise', 'education');"></i> <i style="cursor:pointer;float:right;display:none;"  onclick="sortbyFunc('asc', 'raise', 'education');" class="fa fa-sort-asc raiseasc"></i>  <i style="cursor:pointer;display:none; float:right;" onclick="sortbyFunc('desc', 'raise', 'education');" class="fa fa-sort-desc raisedesc"></i></th>
                    <th><?php echo Lang::get('auth.DESC'); ?></th>

                    <?php
                      if($can_update)
                      {
                    ?>                    
                    <th width="150"><?php echo Lang::get('common.ACTIONS'); ?></th>
                      <?php
                    }
                      ?>

                  </tr>
                </thead>
                <tbody id="dataBodyEducation">
 
                </tbody>
              </table>

                </div>

            <div class="tab-pane cont" id="salary" style="height:100%;min-height:600px;">

        <div class="notification-bar" id="year_update_msg" style="display:block"></div>
        
              <h4>Monthly Payment</h4>                
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Category / Year</th>
                    <th>1 Year</th>
                    <th>2 Year</th>
                    <th>3 Year</th>
                    <th>4 Year</th>
                    <th>5 Year</th>
                    <th>6 Year</th>
                    <th>7 Year</th>
                    <th>8 Year</th>
                    <th>9 Year</th>
                    <th>10 Year</th>
                  </tr>
                </thead>
                <tbody id="monthlysalary">
 
                </tbody>
              </table>


              <h4>Hourly Payment</h4>                
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Category / Year</th>
                    <th>1 Year</th>
                    <th>2 Year</th>
                    <th>3 Year</th>
                    <th>4 Year</th>
                    <th>5 Year</th>
                    <th>6 Year</th>
                    <th>7 Year</th>
                    <th>8 Year</th>
                    <th>9 Year</th>
                    <th>10 Year</th>
                  </tr>
                </thead>
                <tbody id="hourlysalary">
 
                </tbody>
              </table>


              <h4>Invoice Payment</h4>                
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Category / Year</th>
                    <th>1 Year</th>
                    <th>2 Year</th>
                    <th>3 Year</th>
                    <th>4 Year</th>
                    <th>5 Year</th>
                    <th>6 Year</th>
                    <th>7 Year</th>
                    <th>8 Year</th>
                    <th>9 Year</th>
                    <th>10 Year</th>
                  </tr>
                </thead>
                <tbody id="invoicesalary">
 
                </tbody>
              </table>


            <a style="float:right;" class="btn-danger btn" onclick="updateYearPayments();" href="javascript:void(0);"> <?php echo Lang::get('auth.SUBMIT'); ?> </a>




                </div>

            <div class="tab-pane cont box-info" id="surcharges" style="height:100%;">



<form action="" class="form-horizontal row-border" data-validate="parsley" id="validate-form">
                <div class="col-md-6">
                <h4><?php echo Lang::get('auth.NIGHT_SHIFT'); ?></h4>
                <hr>
                  <form role="form" class="form-horizontal">
                    <div class="form-group lable-padd">
                      <label class="col-lg-3 control-label" for="recipient-name"><?php echo Lang::get('auth.START_TIME'); ?> :</label>
                    <div class="col-sm-6">
                      <input type="text" id="start_time" class="form-control">
                      </div>
                    </div>

                    <div class="form-group lable-padd">
                      <label class="col-lg-3 control-label" for="recipient-name"><?php echo Lang::get('auth.END_TIME'); ?> :</label>
                    <div class="col-sm-6">
                      <input type="text" id="end_time" class="form-control">
                    </div>
                    </div>

                    <div class="form-group lable-padd">
                      <label class="col-lg-3 control-label" for="recipient-name"><?php echo Lang::get('auth.RAISE'); ?> :</label>
                    <div class="col-sm-6">
                      <input type="text" id="night_shift_raise" class="form-control" value="0">
                    </div>
                    </div>                                          

                    <p>&nbsp;</p>
                    <div class="form-group">
                      <div class="col-lg-offset-6 col-lg-10">
                        <a class="btn-danger btn" onclick="updateNightShift();" href="javascript:void(0);"> <?php echo Lang::get('auth.SUBMIT'); ?> </a>
                      </div>
                    </div>
                  </form>


                </div>


                <div class="col-md-6">
                <h4><?php echo Lang::get('auth.PUBLIC_HOLIDAYS'); ?></h4>
                <hr>
                  <form role="form" class="form-horizontal">

                    <div class="form-group lable-padd">
                      <label class="col-lg-3 control-label" for="recipient-name"><?php echo Lang::get('auth.RAISE'); ?> :</label>
                    <div class="col-sm-6">
                      <input type="text" id="raise_holiday1" class="holiday_raise" class="form-control" value="0">
                    </div>
                    </div>

                    <div class="form-group lable-padd">
                      <label class="col-lg-3 control-label" for="recipient-name"><?php echo Lang::get('auth.NAME'); ?> :</label>
                    <div class="col-sm-6">
                      <input type="text" id="name_holiday1" class="holiday_name" class="form-control" value="">
                    </div>
                    </div>

                    <div class="form-group lable-padd">
                      <label class="col-lg-3 control-label" for="recipient-name"><?php echo Lang::get('auth.HOLIDAY'); ?> :</label>
                    <div class="col-sm-6">
                      <input type="text" id="holiday1" readonly="readonly" style="cursor:pointer; background-color: #FFFFFF; z-index:9999;" class="form-control datepicker form-control-inline input-medium default-date-picker holiday">
                    </div>
                    </div>



                    <div id="holiday_div">
                      
                    </div>


                    <a class="btn-notification btn" onclick="addMoreHoliday();" href="javascript:void(0);"><?php echo Lang::get('auth.ADD_MORE'); ?></a>

                    <p>&nbsp;</p>
                    <div class="form-group">
                      <div class="col-lg-offset-6 col-lg-10">
                        <a class="btn-danger btn" onclick="addHoliday();" href="javascript:void(0);"><?php echo Lang::get('auth.SUBMIT'); ?></a>
                      </div>
                    </div>
                  </form>


                </div>

              </form>










<!--               <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th><?php echo Lang::get('auth.NAME'); ?></th>
                    <th style="width:20%;"><?php echo Lang::get('auth.RAISE'); ?></th>
                    <th><?php echo Lang::get('auth.DESC'); ?></th>

                    <?php
                      if($can_update)
                      {
                    ?>                    
                    <th width="150"><?php echo Lang::get('common.ACTIONS'); ?></th>
                      <?php
                    }
                      ?>

                  </tr>
                </thead>
                <tbody id="dataBodySurcharges">
 
                </tbody>
              </table> -->

                </div>

              </div>
            </div>

            <div class="box-info">



            </div><!--box-info end-->
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
    var ADD_EDUCATION = "<?php echo Lang::get('auth.ADD_EDUCATION'); ?>";
    var UPDATE_EDUCATION = "<?php echo Lang::get('auth.UPDATE_EDUCATION'); ?>";   
    var ADD_SALARY_TYPE = "<?php echo Lang::get('auth.ADD_SALARY_TYPE'); ?>";
    var UPDATE_SALARY_TYPE = "<?php echo Lang::get('auth.UPDATE_SALARY_TYPE'); ?>";   

    var EDIT = "<?php echo Lang::get('common.EDIT'); ?>";
    var DELETE = "<?php echo Lang::get('common.DELETE'); ?>";        
</script>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script type="text/javascript" src="js/bootstrap-datepicker.js"></script> 

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
<script src="js/modules/category.js" type="text/javascript"></script>


  <script>
    var can_update = '<?php echo $can_update; ?>';

  $( document ).ready(function() {

   $('.holiday').datepicker({
    autoclose:true
   });

   jQuery('#start_time, #end_time').datetimepicker({
      datepicker:false,
      format:'H:i'
    });

    getNightShift();
    getCategories();
    getEducations();
    getSalaryTypes();
    getHolidays();
  });    
    </script>
</body>
</html>