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
              <h1><?php echo Lang::get('auth.EDIT_COMPANY_PROFILE'); ?></h1>
            </div>
          </div>
        </div>

        
        
        
        
        <div class="row">
<!--                   <div class="profile-nav col-lg-3">


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
                  </div> -->
                  <div class="profile-info col-lg-9">
                      <div class="panel">
<!--                          <div class="bio-graph-heading">
                              Aliquam ac magna metus. Nam sed arcu non tellus fringilla fringilla ut vel ispum. Aliquam ac magna metus.
                          </div>
                          -->
                          <div class="panel-body bio-graph-info">

                                  <div class="notification-bar" id="profile_update_msg"></div>

                              <h1> <?php echo Lang::get('auth.COMPANY_INFO'); ?></h1>
                              <form role="form" class="form-horizontal">

                                  <div class="form-group">
                                      <label class="col-lg-2 control-label"> <?php echo Lang::get('auth.COMPANY_NAME'); ?></label>
                                      <div class="col-lg-6">
                                          <input type="text" placeholder=" " value="<?php echo $account['name'];?>" id="company_name" class="form-control">
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="col-lg-2 control-label"> <?php echo Lang::get('auth.TIMEZONE'); ?></label>
                                      <div class="col-lg-6">

            <select name="timezone" id="timezone">
                <option value="Pacific/Midway">(GMT-11:00) Midway Island, Samoa</option>
                <option value="America/Adak">(GMT-10:00) Hawaii-Aleutian</option>
                <option value="Pacific/Marquesas">(GMT-09:30) Marquesas Islands</option>
                <option value="Pacific/Gambier">(GMT-09:00) Gambier Islands</option>
                <option value="America/Anchorage">(GMT-09:00) Alaska</option>
                <option value="America/Ensenada">(GMT-08:00) Tijuana, Baja California</option>
                <option value="Etc/GMT+8">(GMT-08:00) Pitcairn Islands</option>
                <option value="America/Los_Angeles">(GMT-08:00) Pacific Time (US &amp; Canada)</option>
                <option value="America/Denver">(GMT-07:00) Mountain Time (US &amp; Canada)</option>
                <option value="America/Chihuahua">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                <option value="America/Dawson_Creek">(GMT-07:00) Arizona</option>
                <option value="America/Belize">(GMT-06:00) Saskatchewan, Central America</option>
                <option value="America/Cancun">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                <option value="Chile/EasterIsland">(GMT-06:00) Easter Island</option>
                <option value="America/Chicago">(GMT-06:00) Central Time (US &amp; Canada)</option>
                <option value="America/New_York">(GMT-05:00) Eastern Time (US &amp; Canada)</option>
                <option value="America/Havana">(GMT-05:00) Cuba</option>
                <option value="America/Bogota">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                <option value="America/Caracas">(GMT-04:30) Caracas</option>
                <option value="America/Santiago">(GMT-04:00) Santiago</option>
                <option value="America/La_Paz">(GMT-04:00) La Paz</option>
                <option value="Atlantic/Stanley">(GMT-04:00) Faukland Islands</option>
                <option value="America/Campo_Grande">(GMT-04:00) Brazil</option>
                <option value="America/Goose_Bay">(GMT-04:00) Atlantic Time (Goose Bay)</option>
                <option value="America/Glace_Bay">(GMT-04:00) Atlantic Time (Canada)</option>
                <option value="America/St_Johns">(GMT-03:30) Newfoundland</option>
                <option value="America/Araguaina">(GMT-03:00) UTC-3</option>
                <option value="America/Montevideo">(GMT-03:00) Montevideo</option>
                <option value="America/Miquelon">(GMT-03:00) Miquelon, St. Pierre</option>
                <option value="America/Godthab">(GMT-03:00) Greenland</option>
                <option value="America/Argentina/Buenos_Aires">(GMT-03:00) Buenos Aires</option>
                <option value="America/Sao_Paulo">(GMT-03:00) Brasilia</option>
                <option value="America/Noronha">(GMT-02:00) Mid-Atlantic</option>
                <option value="Atlantic/Cape_Verde">(GMT-01:00) Cape Verde Is.</option>
                <option value="Atlantic/Azores">(GMT-01:00) Azores</option>
                <option value="Europe/Belfast">(GMT) Greenwich Mean Time : Belfast</option>
                <option value="Europe/Dublin">(GMT) Greenwich Mean Time : Dublin</option>
                <option value="Europe/Lisbon">(GMT) Greenwich Mean Time : Lisbon</option>
                <option value="Europe/London">(GMT) Greenwich Mean Time : London</option>
                <option value="Africa/Abidjan">(GMT) Monrovia, Reykjavik</option>
                <option value="Europe/Amsterdam" selected="selected">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
                <option value="Europe/Belgrade">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
                <option value="Europe/Brussels">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
                <option value="Africa/Algiers">(GMT+01:00) West Central Africa</option>
                <option value="Africa/Windhoek">(GMT+01:00) Windhoek</option>
                <option value="Asia/Beirut">(GMT+02:00) Beirut</option>
                <option value="Africa/Cairo">(GMT+02:00) Cairo</option>
                <option value="Asia/Gaza">(GMT+02:00) Gaza</option>
                <option value="Africa/Blantyre">(GMT+02:00) Harare, Pretoria</option>
                <option value="Asia/Jerusalem">(GMT+02:00) Jerusalem</option>
                <option value="Europe/Minsk">(GMT+02:00) Minsk</option>
                <option value="Asia/Damascus">(GMT+02:00) Syria</option>
                <option value="Europe/Moscow">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
                <option value="Africa/Addis_Ababa">(GMT+03:00) Nairobi</option>
                <option value="Asia/Tehran">(GMT+03:30) Tehran</option>
                <option value="Asia/Dubai">(GMT+04:00) Abu Dhabi, Muscat</option>
                <option value="Asia/Yerevan">(GMT+04:00) Yerevan</option>
                <option value="Asia/Kabul">(GMT+04:30) Kabul</option>
                <option value="Asia/Karachi">(GMT+05:00) Pakistan Standard Time, Yekaterinburg Standard Time</option>
                <option value="Asia/Tashkent">(GMT+05:00) Tashkent</option>
                <option value="Asia/Kolkata">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
                <option value="Asia/Katmandu">(GMT+05:45) Kathmandu</option>
                <option value="Asia/Dhaka">(GMT+06:00) Astana, Dhaka</option>
                <option value="Asia/Novosibirsk">(GMT+06:00) Novosibirsk</option>
                <option value="Asia/Rangoon">(GMT+06:30) Yangon (Rangoon)</option>
                <option value="Asia/Bangkok">(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
                <option value="Asia/Krasnoyarsk">(GMT+07:00) Krasnoyarsk</option>
                <option value="Asia/Hong_Kong">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
                <option value="Asia/Irkutsk">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
                <option value="Australia/Perth">(GMT+08:00) Perth</option>
                <option value="Australia/Eucla">(GMT+08:45) Eucla</option>
                <option value="Asia/Tokyo">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
                <option value="Asia/Seoul">(GMT+09:00) Seoul</option>
                <option value="Asia/Yakutsk">(GMT+09:00) Yakutsk</option>
                <option value="Australia/Adelaide">(GMT+09:30) Adelaide</option>
                <option value="Australia/Darwin">(GMT+09:30) Darwin</option>
                <option value="Australia/Brisbane">(GMT+10:00) Brisbane</option>
                <option value="Australia/Hobart">(GMT+10:00) Hobart</option>
                <option value="Asia/Vladivostok">(GMT+10:00) Vladivostok</option>
                <option value="Australia/Lord_Howe">(GMT+10:30) Lord Howe Island</option>
                <option value="Etc/GMT-11">(GMT+11:00) Solomon Is., New Caledonia</option>
                <option value="Asia/Magadan">(GMT+11:00) Magadan</option>
                <option value="Pacific/Norfolk">(GMT+11:30) Norfolk Island</option>
                <option value="Asia/Anadyr">(GMT+12:00) Anadyr, Kamchatka</option>
                <option value="Pacific/Auckland">(GMT+12:00) Auckland, Wellington</option>
                <option value="Etc/GMT-12">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
                <option value="Pacific/Chatham">(GMT+12:45) Chatham Islands</option>
                <option value="Pacific/Tongatapu">(GMT+13:00) Nuku'alofa</option>
                <option value="Pacific/Kiritimati">(GMT+14:00) Kiritimati</option>
              </select>                                      </div>
                                  </div>

                                      <div class="form-group">
                                          <label class="col-lg-2 control-label"><?php echo Lang::get('auth.COMPANY_LOGO'); ?></label>
                                          <div class="col-lg-6">
                                              <input type="file" id="picture" name="picture" data-url="company/upload" class="file-pos">

                                              <img src="<?php if(!empty($account['logo']) && file_exists(public_path().'/data/company/'.$account['logo'])) echo URL::to('/data/company/'.$account['logo']); else echo 'images/placeholder.png'; ?>" id="temp_pic" width="80" height="80">

                                              <input type="hidden" value="<?php if(!empty($account['logo'])) echo $account['logo']; ?>" id="pic_path">
                                          </div>
                                      </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                          <a class="btn btn-danger" href="javascript:void(0);" onclick="updateCompanyProfile();"> <?php echo Lang::get('auth.SAVE'); ?></a>
                                          <button class="btn btn-default" type="button">Cancel</button>
                                      </div>
                                  </div>


                              </form>
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
var COMPANY_UPDATE_ERROR = "<?php echo Lang::get('auth.COMPANY_UPDATE_ERROR'); ?>";
var COMPANY_UPDATE_SUCCESS = "<?php echo Lang::get('auth.COMPANY_UPDATE_SUCCESS'); ?>";


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
<script src="js/modules/settings.js"></script>

<script>
$(function () {
    <?php
    if(!empty($account['timezone']))
    {
    ?>
    $('#timezone').val('<?php echo $account['timezone'];?>');
    <?php
  }
  ?>

    $('#picture').fileupload({
        dataType: 'json',
        done: function (e, data) {
        file = canvas_url + '/data/company/' + data.result.file_name;
        $('#pic_path').val(data.result.file_name);
        $('#temp_pic').attr('src',file);
        }
    });
});
</script>
</body>
</html>