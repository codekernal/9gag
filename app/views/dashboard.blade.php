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

<link href='css/fullcalendar.css' rel='stylesheet' />
<link href='css/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='js/moment.min.js'></script>
<script src="js/jquery-1.10.2.js"></script> 
<script src="js/jquery-ui-1.9.1.js"></script> 
<script src='js/fullcalendar.min.js'></script>

<script src="js/modules/common.js" type="text/javascript"></script>
<script src="js/modules/dashboard.js" type="text/javascript"></script>
<script src='js/lang-all.js'></script>



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



<?php
// echo "<pre>";
// print_R($projects);
$admin = true;
  if(isset($projects['projects']) && !empty($projects['projects']))
  {
                    if(!empty($projects['id']))
                    {
                      $admin = false;

?>
      <div class="row">
          <div class="col-sm-6 col-md-6 col-lg-6 upper_div" style="width:25%;">
          <h3><?php echo Lang::get('auth.PROJECTS'); ?></h3>
            <div class="panel-group accordion" id="accordion">
            <?php 
            foreach($projects['projects'] as $project)
            {
              if(empty($project['resources']))
                continue;

            ?>
              <div class="panel panel-default">
                <div class="panel-heading">
<!--  onclick="getProjectCalender('<?php echo $project['project']['id']; ?>', '<?php echo $projects['id'];?>', '<?php echo Lang::get('auth.CUR_LANGUAGE'); ?>');" -->
                  <h4 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?php echo $project['project']['id'];?>"> <i class="fa fa-angle-right"></i> <?php echo $project['project']['name'];?> </a> </h4>
                </div>
                <div style="height: 0px;" id="collapseOne<?php echo $project['project']['id'];?>" class="panel-collapse collapse">

                        <?php

                        if(isset($project['resources']) && !empty($project['resources']))
                        {
                          foreach($project['resources'] as $resource)
                          {
                        ?>
                        <ul class="nav nav-pills nav-stacked mail-nav">
                            <li><a onclick="loadSchedue(<?php echo $project['project']['id'];?>,<?php echo $resource['resource_id'];?>, '<?php echo Lang::get('auth.CUR_LANGUAGE'); ?>');" href="javascript:void(0);"> <i class="fa fa-male"></i> <?php echo $resource['first_name'];?> </a></li>
                        </ul>
                        <?php
                        }
                        }

                    ?>
                </div>
              </div>
            <?php
            }
            ?>
            </div>
          </div>


  <div id='calendar' class="col-lg-8" style="background-color:#fff;padding:50px;"> Please select project and resource from left panel.</div>
 
         </div>

<?php
  }
  ?>
   <script>
$( document ).ready(function() {
  getProjectCalender('<?php echo Lang::get('auth.CUR_LANGUAGE'); ?>');
});    
  </script>
  <div id='calendar' class="col-lg-8" style="background-color:#fff;padding:50px;"> </div>

  <?php
}
if($admin)
{
  ?>
<div class="col-sm-3">

                <section class="panel">
                    <div class="panel-body">

                    <h4><?php echo Lang::get('auth.BOOKED_HOURS'); ?></h4>
                    <table class="table table-hover">
                    <tbody>
                      <tr>
                        <td><?php echo Lang::get('auth.TODAY'); ?></td>
                        <td><?php echo floor($stats['booked_hours']['today']) ?></td>
                      </tr>
                      <tr>
                        <td><?php echo Lang::get('auth.THIS_WEEK'); ?></td>
                        <td><?php echo floor($stats['booked_hours']['week']) ?></td>
                      </tr>
                      <tr>
                        <td><?php echo Lang::get('auth.THIS_MONTH'); ?></td>
                        <td><?php echo floor($stats['booked_hours']['month']) ?></td>
                      </tr>
                    </tbody>
                  </table>

                    <h4><?php echo Lang::get('auth.RESOURCES_PERSON'); ?></h4>
                    <table class="table table-hover">
                    <tbody>
                      <tr>
                        <td><?php echo Lang::get('auth.TODAY'); ?></td>
                        <td><?php echo count($stats['persons']['today']); ?></td>
                      </tr>
                      <tr>
                        <td><?php echo Lang::get('auth.THIS_WEEK'); ?></td>
                        <td><?php echo count($stats['persons']['week']); ?></td>
                      </tr>
                      <tr>
                        <td><?php echo Lang::get('auth.THIS_MONTH'); ?></td>
                        <td><?php echo count($stats['persons']['month']); ?></td>
                      </tr>
                    </tbody>
                  </table>                  

                    <h4><?php echo Lang::get('auth.RESOURCES_VEHICLE'); ?></h4>
                    <table class="table table-hover">
                    <tbody>
                      <tr>
                        <td><?php echo Lang::get('auth.TODAY'); ?></td>
                        <td><?php echo count($stats['vehicles']['today']); ?></td>
                      </tr>
                      <tr>
                        <td><?php echo Lang::get('auth.THIS_WEEK'); ?></td>
                        <td><?php echo count($stats['vehicles']['week']); ?></td>
                      </tr>
                      <tr>
                        <td><?php echo Lang::get('auth.THIS_MONTH'); ?></td>
                         <td><?php echo count($stats['vehicles']['month']); ?></td>
                      </tr>
                    </tbody>
                  </table>



                    <h4><?php echo Lang::get('auth.CLIENTS'); ?></h4>
                    <table class="table table-hover">
                    <tbody>
                      <tr>
                        <td><?php echo Lang::get('auth.TODAY'); ?></td>
                         <td><?php echo count($stats['clients']['today']); ?></td>
                      </tr>
                      <tr>
                        <td><?php echo Lang::get('auth.THIS_WEEK'); ?></td>
                         <td><?php echo count($stats['clients']['week']); ?></td>
                      </tr>
                      <tr>
                        <td><?php echo Lang::get('auth.THIS_MONTH'); ?></td>
                         <td><?php echo count($stats['clients']['month']); ?></td>
                      </tr>
                    </tbody>
                  </table>


                    <h4><?php echo Lang::get('auth.PROJECTS'); ?></h4>
                    <table class="table table-hover">
                    <tbody>
                      <tr>
                        <td><?php echo Lang::get('auth.TODAY'); ?></td>
                         <td><?php echo count($stats['projects']['today']); ?></td>
                      </tr>
                      <tr>
                        <td><?php echo Lang::get('auth.THIS_WEEK'); ?></td>
                         <td><?php echo count($stats['projects']['week']); ?></td>
                      </tr>
                      <tr>
                        <td><?php echo Lang::get('auth.THIS_MONTH'); ?></td>
                         <td><?php echo count($stats['clients']['month']); ?></td>
                      </tr>
                    </tbody>
                  </table>


                    </div>
                </section>
            </div>
  <?php
}
?>




 

      </div><!--scrollable wrapper end--> 
    </div><!--margin-container end--> 
  </div><!--main end--> 
</div><!--layout-container end--> 


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 

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

<script>
$( document ).ready(function() {
  getNotifications();
});

</script>

</body>
</html>