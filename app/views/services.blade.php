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


<!-- Modal -->
<div class="modal fade" id="addServicePopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo Lang::get('auth.CLOSE'); ?></span></button>
        <h4 class="modal-title" id="popupLabel"></h4>
      </div>
        <div class="modal-body">
            <form role="form">

              <div class="form-group">
                <label class="control-label" for="recipient-name"></label>
              <div class="col-lg-6">
                  <label class="checkbox-inline" onclick="clientRelated();"><input type="checkbox" id="client_related" value="1"> <?php echo Lang::get('auth.CLIENT_RELATED'); ?> </label>

              </div>                
              </div>


              <div class="form-group" id="client_div" style="display:none;">
                <label class="control-label" for="recipient-name"><?php echo Lang::get('auth.SELECT_CLIENT'); ?> :</label>
                <div id="client_container">

                </div>
              </div>              

              <div class="form-group">
                <label class="control-label" for="recipient-name"><?php echo Lang::get('common.NAME'); ?> :</label>
                <input type="text" id="service_name" class="form-control">
                <input type="hidden" id="service_id" value="">

              </div>

              <div class="form-group">
                <label class="control-label" for="recipient-name"><?php echo Lang::get('auth.CLIENT_PRICE'); ?> :</label>
                <input type="text" id="client_price" class="form-control">
              </div>

              <div class="form-group">
                <label class="control-label" for="recipient-name"><?php echo Lang::get('auth.EMPLOYEE_PRICE'); ?> :</label>
                <input type="text" id="employee_price" class="form-control">
              </div>

              <div class="form-group">
                <label class="control-label" for="message-text"><?php echo Lang::get('common.DESC'); ?> :</label>
                <textarea id="description" class="form-control"></textarea>
              </div>
            </form>
          </div>      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="addUpdateService();" class="btn btn-primary"><?php echo Lang::get('common.SAVE_CHANGES'); ?> </button>
      </div>
    </div>
  </div>
</div>  








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
            <div class="box-info">
              <h4>  <?php echo Lang::get('common.SERVICES'); ?> 
<?php
  if($can_update)
  {
?>
              <button type="button" onclick="showServicePopup(0);" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addServicePopup">
               <?php echo Lang::get('common.ADD_SERVICE'); ?>
              </button>
<?php 
}
?>
              </h4>
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th><?php echo Lang::get('common.NAME'); ?> <i class="fa fa-sort nameall" style="float:right;cursor:pointer;" onclick="sortbyFunc('all', 'name', 'services');"></i> <i style="cursor:pointer;float:right;display:none;"  onclick="sortbyFunc('asc', 'name', 'services');" class="fa fa-sort-asc nameasc"></i>  <i style="cursor:pointer;display:none; float:right;" onclick="sortbyFunc('desc', 'name', 'services');" class="fa fa-sort-desc namedesc"></i></th>
                    <th><?php echo Lang::get('auth.EMPLOYEE_PRICE'); ?>  <i class="fa fa-sort employee_priceall" style="float:right;cursor:pointer;" onclick="sortbyFunc('all', 'employee_price', 'services');"></i> <i style="cursor:pointer;float:right;display:none;"  onclick="sortbyFunc('asc', 'employee_price', 'services');" class="fa fa-sort-asc employee_priceasc"></i>  <i style="cursor:pointer;display:none; float:right;" onclick="sortbyFunc('desc', 'employee_price', 'services');" class="fa fa-sort-desc employee_pricedesc"></i></th>
                    <th><?php echo Lang::get('auth.CLIENT_PRICE'); ?>  <i class="fa fa-sort client_priceall" style="float:right;cursor:pointer;" onclick="sortbyFunc('all', 'client_price', 'services');"></i> <i style="cursor:pointer;float:right;display:none;"  onclick="sortbyFunc('asc', 'client_price', 'services');" class="fa fa-sort-asc client_priceasc"></i>  <i style="cursor:pointer;display:none; float:right;" onclick="sortbyFunc('desc', 'client_price', 'services');" class="fa fa-sort-desc client_pricedesc"></i></th>
                    <th><?php echo Lang::get('common.DESC'); ?></th>
<?php
  if($can_update)
  {
?> 
                    <th width="200"><?php echo Lang::get('common.ACTIONS'); ?></th>
   <?php
   }
   ?>                 
                  </tr>
                </thead>
                <tbody id="dataBody">
 
                </tbody>
              </table>
            </div><!--box-info end-->
          </div><!--col-md-12 end-->
        </div><!--row end-->

      </div><!--scrollable wrapper end--> 
    </div><!--margin-container end--> 
  </div><!--main end--> 
</div><!--layout-container end--> 
<script>
    var ADD_SERVICE = "<?php echo Lang::get('common.ADD_SERVICE'); ?>";
    var NO_RECORD = "<?php echo Lang::get('common.NO_RECORD'); ?>";

    var UPDATE_SERVICE = "<?php echo Lang::get('common.UPDATE_SERVICE'); ?>";   
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
<script src="js/modules/service.js" type="text/javascript"></script>
<script src="js/modules/project.js" type="text/javascript"></script>


  <script>
  var can_update = '<?php echo $can_update; ?>';

  $( document ).ready(function() {
  getClients();


    getServices();
  });    
    </script>
</body>
</html>