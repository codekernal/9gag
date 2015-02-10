<!DOCTYPE html>
<html>
<head>
<title>Planner</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->

<link href="bs3/css/bootstrap.min.css" rel="stylesheet">
<link href="css/style-responsive.css" rel="stylesheet">
<link href="css/atom-style.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" media="screen" href="css/jquery.datetimepicker.css" />

  


<link href="css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="plugins/PCharts/style.css" type="text/css">
<link href="plugins/kalendar/kalendar.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
<script src="js/modules/common.js"></script> 
<link href="css/datepicker.css" rel="stylesheet">


<script src="js/jquery-1.10.2.js"></script> 
<script src="js/jquery-ui-1.9.1.js"></script
<script src="js/modules/common.js"></script>
 
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



<div class="modal fade in" id="tasks" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- dialog body -->

      <div class="modal-header">
          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
          <h4 id="myModalLabel" class="modal-title">Tasks</h4>
      </div>
  
      <div class="modal-body">
              <div class="tab-container">
                <ul class="nav nav-tabs nav-tabs-tasks">
                  <li class="active"><a href="#home" data-toggle="tab">Tasks</a></li>
                  <li><a href="#profile" data-toggle="tab">Add Task</a></li>
                </ul>
                <div class="tab-content">
                <input type="hidden" id="task_id" name="task_id" value="">
                  <div class="tab-pane active cont" id="home">


                  </div>
                  <div class="tab-pane cont" id="profile" style="height:auto;">

              <form role="form" class="form-horizontal">

                    <div class="form-group">
                      <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.TASK_NAME'); ?> :</label>
                    <div class="col-lg-6">
                      <input type="text" id="task_name" class="form-control">
                    </div>
                    </div>

                    <div class="form-group">
                      <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.SERVICES'); ?> :</label>
                    <div class="col-lg-6" id="services_div">

                    </div>
                    </div>

                    <div class="form-group">
                      <label class="col-lg-4 control-label" for="recipient-name"></label>
                    <div class="col-lg-6" style="float:right;">

                        <a href="javascript:void(0);" onclick="addVechicle();">Add Vehicle</a>  
                        <a style="display:none;" id="addPersonAnchor" href="javascript:void(0);" onclick="addPerson();">Add Person</a>                        
                    </div>
                    </div>


                    <div id="vehicle_container">

                    </div>

                    <div id="person_container">

                    </div>


                    <div class="form-group dates_range">
                      <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.TIME_TYPES'); ?> :</label>
                    <div class="col-lg-6">

                    <div class="form-group">
                      <label class="radio-inline">
                        <input type="radio" id="single" name="time_type" checked="checked" value="single" onclick="changeTimeType('single');">
                        Single </label>
                      <label class="radio-inline">
                        <input type="radio" id="recurring" name="time_type" value="recurring" onclick="changeTimeType('recurring');">
                        Recurring </label>
                    </div>
                    </div>
                    </div>


                    <div class="form-group" id="start_date_div">
                      <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.START_DATE'); ?> :</label>
                    <div class="col-lg-6">
                      <input type="text" id="start_date" readonly="readonly" style="cursor:pointer; background-color: #FFFFFF" class="form-control datepicker form-control-inline input-medium default-date-picker">
                    </div>
                    </div>

                    <div class="form-group"  id="end_date_div"  style="display:none;">
                      <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.END_DATE'); ?> :</label>
                    <div class="col-lg-6">                
                      <input type="text" id="end_date" readonly="readonly" style="cursor:pointer; background-color: #FFFFFF" class="form-control default-date-picker">
                    </div>                
                    </div>


                <div class="form-group" id="start_time_div">
                      <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.START_TIME'); ?> :</label>
                    <div class="col-lg-6">
                            <div class='col-sm-8'>
                                <div class="form-group">
                                    <div class='input-group date'>
                                        <input type='text' class="form-control" id='start_time' />
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <script type="text/javascript">
                               jQuery('#start_time').datetimepicker({
                                  datepicker:false,
                                  format:'H:i'
                                });
                            </script>
                    </div>
                    </div>


                    <div class="form-group" id="end_time_div">
                      <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.END_TIME'); ?> :</label>
                    <div class="col-lg-6">
                            <div class='col-sm-8'>
                                <div class="form-group">
                                    <div class='input-group date'>
                                        <input type='text' class="form-control" id='end_time' />
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <script type="text/javascript">
         jQuery('#end_time').datetimepicker({
                                  datepicker:false,
                                  format:'H:i'
                                });
                       
                            </script>
                    </div>
                    </div>


         <div id="days_container" style="display:none; margin-left:20px;" class="form-group">
              <div class="notification-bar" id="days_msg">asdsa</div>

<!--                   <h3><?php echo Lang::get('auth.SET_DAYS'); ?></h3>
                <p class="text-muted"><?php echo Lang::get('auth.DAYS_DESC'); ?></p> -->


                    <div>
                    <?php 
                    for($i=1;$i<=7;$i++)
                    {
                    ?>
                      <div style="margin-bottom:0px;" class="form-group">

                      <div class="col-lg-6" style="width:99%;"><label style="float:left; width:35%;" class="checkbox-inline">

                          <input type="checkbox" class="days" value="<?php echo $i;?>" onclick="showDayTime(<?php echo $i;?>, this.checked);" id="day_<?php echo $i;?>"><?php echo Lang::get('auth.DAY'.$i); ?></label>

                          <div style="float:left;width:24%;display:none;" class="day_div<?php echo $i;?>">
                                <div class="form-group" style="width:120px;display:block">
                                    <div class='input-group date'>
                                        <input type='text' class="form-control" placeholder="Start Time" id='start_time<?php echo $i;?>' />
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                          </div>

                          <div style="float:left;width: 120px;margin-left: 28px;display:none;"  class="day_div<?php echo $i;?>">
                                <div class="form-group"  style="width:120px;display:block">
                                    <div class='input-group date'>
                                        <input type='text' class="form-control" id='end_time<?php echo $i;?>' placeholder="End Time" />
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                          </div>

                            <script type="text/javascript">
                               jQuery('#start_time<?php echo $i;?>, #end_time<?php echo $i;?>').datetimepicker({
                                  datepicker:false,
                                  format:'H:i'
                                });
                       
                            </script>

                          </div></div>
                          <?php
                        }
                          ?>

<!--                           <div style="margin-bottom:0px;" class="form-group"><div class="col-lg-6">
                          <label class="checkbox-inline"><input class="days" type="checkbox" value="2" id="day_2">
                          <?php echo Lang::get('auth.DAY2'); ?></label></div></div>
                          <div style="margin-bottom:0px;" class="form-group"><div class="col-lg-6">
                          <label class="checkbox-inline"><input class="days" type="checkbox" value="3" id="day_3"><?php echo Lang::get('auth.DAY3'); ?></label></div></div>
                          <div style="margin-bottom:0px;" class="form-group">
                          <div class="col-lg-6"><label class="checkbox-inline"><input class="days" type="checkbox" value="4" id="day_4">
                           <?php echo Lang::get('auth.DAY4'); ?></label></div></div>
                           <div style="margin-bottom:0px;" class="form-group">
                          <div class="col-lg-6"><label class="checkbox-inline"><input class="days" type="checkbox" value="5" id="day_5">
                           <?php echo Lang::get('auth.DAY5'); ?></label></div></div>
                           <div style="margin-bottom:0px;" class="form-group">
                          <div class="col-lg-6"><label class="checkbox-inline"><input class="days" type="checkbox" value="6" id="day_6">
                           <?php echo Lang::get('auth.DAY6'); ?></label></div></div>                          
                           <div style="margin-bottom:0px;" class="form-group">
                          <div class="col-lg-6"><label class="checkbox-inline"><input class="days" type="checkbox" value="7" id="day_7">
                           <?php echo Lang::get('auth.DAY7'); ?></label></div></div> -->

                  </div>

                  </div>

                  </div>
                </div>
              </div>
              </form>
      </div>
      
      <!-- dialog buttons -->
      <div class="modal-footer">

      <button id="delete" class="btn btn-primary" type="button" onclick="addUpdateTask();">Save</button>
      <button class="btn" data-dismiss="modal" type="button">Cancel</button>
 
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="addClientPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="popupLabel"></h4>
      </div>
        <div class="modal-body">
            <form role="form" class="form-horizontal">



          <div class="tab-container tab-left">
              <ul class="nav nav-tabs flat-tabs">
                <li id="first_li" class="active"><a data-toggle="tab" href="#tab3-1"><i class="fa fa-home"></i> <?php echo Lang::get('auth.INFORMATION'); ?> </a></li>
<!--                 <li><a data-toggle="tab" href="#tab3-2"><i class="fa fa-text-height"></i> <?php echo Lang::get('auth.SERVICES'); ?> </a></li> -->

                <li><a data-toggle="tab" href="#tab3-4"><i class="fa fa-money"></i> <?php echo Lang::get('auth.BUDGET'); ?> </a></li>
<!--                 <li><a data-toggle="tab" href="#tab3-5"><i class="fa fa-clock-o"></i> <?php echo Lang::get('auth.DATES'); ?> </a></li> -->

                <li><a data-toggle="tab" href="#tab3-7"><i class="fa fa-edit"></i> <?php echo Lang::get('auth.STATUS'); ?> </a></li>
                <li><a data-toggle="tab" href="#tab3-8"><i class="fa fa-tasks"></i> <?php echo Lang::get('auth.NOTES'); ?> </a></li>
                <li><a data-toggle="tab" href="#tab3-9"><i class="fa fa-link"></i> <?php echo Lang::get('auth.LINKS'); ?> </a></li>

              </ul>
              <div class="tab-content">
                <div id="tab3-1" class="tab-pane active cont fade in">
                <h3><?php echo Lang::get('auth.PROJECT_INFORMATION'); ?></h3> <hr>
                <p class="text-muted"><?php echo Lang::get('auth.INOFRMATION_DESC'); ?></p>
                  <div class="form-group">
                    <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('common.NAME'); ?> :</label>
                  <div class="col-lg-6">                
                    <input type="text" id="project_name" class="form-control">
                    <input type="hidden" id="project_id" value="" class="form-control">
                  </div>                
                  </div>

                  <div class="form-group">

                    <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.CLIENT'); ?> :</label>
                  <div class="col-lg-6">

                    <div id="client_container">
                      
                    </div>

                  </div>                
                  </div>

                  <div class="form-group">
                    <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.NO_OF_EMPLOYEES'); ?> :</label>
                  <div class="col-lg-6">                
                    <input type="text" id="employee_count" class="form-control">
                  </div>                
                  </div>                  

<!--
                  <div class="form-group">
                    <label class="col-lg-3 control-label" for="recipient-name"><?php echo Lang::get('auth.TAG_CODE'); ?> :</label>
                  <div class="col-lg-6">                
                    <input type="text" id="project_code" class="form-control">
                  </div>                
                  </div>

-->
<!--                   <div class="form-group">
                      <label class="col-lg-3 control-label"><?php echo Lang::get('auth.IMAGE'); ?></label>
                      <div class="col-lg-6">
                          <input type="file" id="picture" name="picture" data-url="project/upload" class="file-pos">
                          <img src="images/placeholder.png" id="temp_pic" width="80" height="80">
                          <input type="hidden" value="" id="pic_path">
                      </div>
                  </div>                                   -->


                  <div class="form-group">
                  <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('common.STREET_ADDRESS'); ?> :</label>
                  <div class="col-lg-6">
                    <input type="text" id="street_address" class="form-control">
                  </div>                
                  </div>

                  <div class="form-group">
                  <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('common.CITY'); ?> :</label>
                  <div class="col-lg-6">
                    <input type="text" id="city" class="form-control">
                  </div>                
                  </div>

                  <div class="form-group">
                  <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('common.ZIP'); ?> :</label>
                  <div class="col-lg-6">
                    <input type="text" id="zip" class="form-control">
                  </div>                
                  </div>

               <div class="form-group">
                  <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('common.COUNTRY'); ?> :</label>
                <div class="col-lg-6">                
                  <select class="form-control" name="country" id="country">
                  <option value="Switzerland" selected="selected">Switzerland</option>
                  <option value="Germany">Germany</option>
                  <option value="Austria">Austria</option>
                  <option value="Afghanistan">Afghanistan</option>
                  <option value="Åland Islands">Åland Islands</option>
                  <option value="Albania">Albania</option>
                  <option value="Algeria">Algeria</option>
                  <option value="American Samoa">American Samoa</option>
                  <option value="Andorra">Andorra</option>
                  <option value="Angola">Angola</option>
                  <option value="Anguilla">Anguilla</option>
                  <option value="Antarctica">Antarctica</option>
                  <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                  <option value="Argentina">Argentina</option>
                  <option value="Armenia">Armenia</option>
                  <option value="Aruba">Aruba</option>
                  <option value="Australia">Australia</option>
                  <option value="Azerbaijan">Azerbaijan</option>
                  <option value="Bahamas">Bahamas</option>
                  <option value="Bahrain">Bahrain</option>
                  <option value="Bangladesh">Bangladesh</option>
                  <option value="Barbados">Barbados</option>
                  <option value="Belarus">Belarus</option>
                  <option value="Belgium">Belgium</option>
                  <option value="Belize">Belize</option>
                  <option value="Benin">Benin</option>
                  <option value="Bermuda">Bermuda</option>
                  <option value="Bhutan">Bhutan</option>
                  <option value="Bolivia">Bolivia</option>
                  <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                  <option value="Botswana">Botswana</option>
                  <option value="Bouvet Island">Bouvet Island</option>
                  <option value="Brazil">Brazil</option>
                  <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                  <option value="Brunei Darussalam">Brunei Darussalam</option>
                  <option value="Bulgaria">Bulgaria</option>
                  <option value="Burkina Faso">Burkina Faso</option>
                  <option value="Burundi">Burundi</option>
                  <option value="Cambodia">Cambodia</option>
                  <option value="Cameroon">Cameroon</option>
                  <option value="Canada">Canada</option>
                  <option value="Cape Verde">Cape Verde</option>
                  <option value="Cayman Islands">Cayman Islands</option>
                  <option value="Central African Republic">Central African Republic</option>
                  <option value="Chad">Chad</option>
                  <option value="Chile">Chile</option>
                  <option value="China">China</option>
                  <option value="Christmas Island">Christmas Island</option>
                  <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                  <option value="Colombia">Colombia</option>
                  <option value="Comoros">Comoros</option>
                  <option value="Congo">Congo</option>
                  <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                  <option value="Cook Islands">Cook Islands</option>
                  <option value="Costa Rica">Costa Rica</option>
                  <option value="Cote D'ivoire">Cote D'ivoire</option>
                  <option value="Croatia">Croatia</option>
                  <option value="Cuba">Cuba</option>
                  <option value="Cyprus">Cyprus</option>
                  <option value="Czech Republic">Czech Republic</option>
                  <option value="Denmark">Denmark</option>
                  <option value="Djibouti">Djibouti</option>
                  <option value="Dominica">Dominica</option>
                  <option value="Dominican Republic">Dominican Republic</option>
                  <option value="Ecuador">Ecuador</option>
                  <option value="Egypt">Egypt</option>
                  <option value="El Salvador">El Salvador</option>
                  <option value="Equatorial Guinea">Equatorial Guinea</option>
                  <option value="Eritrea">Eritrea</option>
                  <option value="Estonia">Estonia</option>
                  <option value="Ethiopia">Ethiopia</option>
                  <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                  <option value="Faroe Islands">Faroe Islands</option>
                  <option value="Fiji">Fiji</option>
                  <option value="Finland">Finland</option>
                  <option value="France">France</option>
                  <option value="French Guiana">French Guiana</option>
                  <option value="French Polynesia">French Polynesia</option>
                  <option value="French Southern Territories">French Southern Territories</option>
                  <option value="Gabon">Gabon</option>
                  <option value="Gambia">Gambia</option>
                  <option value="Georgia">Georgia</option>
                  <option value="Ghana">Ghana</option>
                  <option value="Gibraltar">Gibraltar</option>
                  <option value="Greece">Greece</option>
                  <option value="Greenland">Greenland</option>
                  <option value="Grenada">Grenada</option>
                  <option value="Guadeloupe">Guadeloupe</option>
                  <option value="Guam">Guam</option>
                  <option value="Guatemala">Guatemala</option>
                  <option value="Guernsey">Guernsey</option>
                  <option value="Guinea">Guinea</option>
                  <option value="Guinea-bissau">Guinea-bissau</option>
                  <option value="Guyana">Guyana</option>
                  <option value="Haiti">Haiti</option>
                  <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                  <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                  <option value="Honduras">Honduras</option>
                  <option value="Hong Kong">Hong Kong</option>
                  <option value="Hungary">Hungary</option>
                  <option value="Iceland">Iceland</option>
                  <option value="India">India</option>
                  <option value="Indonesia">Indonesia</option>
                  <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                  <option value="Iraq">Iraq</option>
                  <option value="Ireland">Ireland</option>
                  <option value="Isle of Man">Isle of Man</option>
                  <option value="Israel">Israel</option>
                  <option value="Italy">Italy</option>
                  <option value="Jamaica">Jamaica</option>
                  <option value="Japan">Japan</option>
                  <option value="Jersey">Jersey</option>
                  <option value="Jordan">Jordan</option>
                  <option value="Kazakhstan">Kazakhstan</option>
                  <option value="Kenya">Kenya</option>
                  <option value="Kiribati">Kiribati</option>
                  <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                  <option value="Korea, Republic of">Korea, Republic of</option>
                  <option value="Kuwait">Kuwait</option>
                  <option value="Kyrgyzstan">Kyrgyzstan</option>
                  <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                  <option value="Latvia">Latvia</option>
                  <option value="Lebanon">Lebanon</option>
                  <option value="Lesotho">Lesotho</option>
                  <option value="Liberia">Liberia</option>
                  <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                  <option value="Liechtenstein">Liechtenstein</option>
                  <option value="Lithuania">Lithuania</option>
                  <option value="Luxembourg">Luxembourg</option>
                  <option value="Macao">Macao</option>
                  <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                  <option value="Madagascar">Madagascar</option>
                  <option value="Malawi">Malawi</option>
                  <option value="Malaysia">Malaysia</option>
                  <option value="Maldives">Maldives</option>
                  <option value="Mali">Mali</option>
                  <option value="Malta">Malta</option>
                  <option value="Marshall Islands">Marshall Islands</option>
                  <option value="Martinique">Martinique</option>
                  <option value="Mauritania">Mauritania</option>
                  <option value="Mauritius">Mauritius</option>
                  <option value="Mayotte">Mayotte</option>
                  <option value="Mexico">Mexico</option>
                  <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                  <option value="Moldova, Republic of">Moldova, Republic of</option>
                  <option value="Monaco">Monaco</option>
                  <option value="Mongolia">Mongolia</option>
                  <option value="Montenegro">Montenegro</option>
                  <option value="Montserrat">Montserrat</option>
                  <option value="Morocco">Morocco</option>
                  <option value="Mozambique">Mozambique</option>
                  <option value="Myanmar">Myanmar</option>
                  <option value="Namibia">Namibia</option>
                  <option value="Nauru">Nauru</option>
                  <option value="Nepal">Nepal</option>
                  <option value="Netherlands">Netherlands</option>
                  <option value="Netherlands Antilles">Netherlands Antilles</option>
                  <option value="New Caledonia">New Caledonia</option>
                  <option value="New Zealand">New Zealand</option>
                  <option value="Nicaragua">Nicaragua</option>
                  <option value="Niger">Niger</option>
                  <option value="Nigeria">Nigeria</option>
                  <option value="Niue">Niue</option>
                  <option value="Norfolk Island">Norfolk Island</option>
                  <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                  <option value="Norway">Norway</option>
                  <option value="Oman">Oman</option>
                  <option value="Pakistan">Pakistan</option>
                  <option value="Palau">Palau</option>
                  <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                  <option value="Panama">Panama</option>
                  <option value="Papua New Guinea">Papua New Guinea</option>
                  <option value="Paraguay">Paraguay</option>
                  <option value="Peru">Peru</option>
                  <option value="Philippines">Philippines</option>
                  <option value="Pitcairn">Pitcairn</option>
                  <option value="Poland">Poland</option>
                  <option value="Portugal">Portugal</option>
                  <option value="Puerto Rico">Puerto Rico</option>
                  <option value="Qatar">Qatar</option>
                  <option value="Reunion">Reunion</option>
                  <option value="Romania">Romania</option>
                  <option value="Russian Federation">Russian Federation</option>
                  <option value="Rwanda">Rwanda</option>
                  <option value="Saint Helena">Saint Helena</option>
                  <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                  <option value="Saint Lucia">Saint Lucia</option>
                  <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                  <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                  <option value="Samoa">Samoa</option>
                  <option value="San Marino">San Marino</option>
                  <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                  <option value="Saudi Arabia">Saudi Arabia</option>
                  <option value="Senegal">Senegal</option>
                  <option value="Serbia">Serbia</option>
                  <option value="Seychelles">Seychelles</option>
                  <option value="Sierra Leone">Sierra Leone</option>
                  <option value="Singapore">Singapore</option>
                  <option value="Slovakia">Slovakia</option>
                  <option value="Slovenia">Slovenia</option>
                  <option value="Solomon Islands">Solomon Islands</option>
                  <option value="Somalia">Somalia</option>
                  <option value="South Africa">South Africa</option>
                  <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                  <option value="Spain">Spain</option>
                  <option value="Sri Lanka">Sri Lanka</option>
                  <option value="Sudan">Sudan</option>
                  <option value="Suriname">Suriname</option>
                  <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                  <option value="Swaziland">Swaziland</option>
                  <option value="Sweden">Sweden</option>
                  <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                  <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                  <option value="Tajikistan">Tajikistan</option>
                  <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                  <option value="Thailand">Thailand</option>
                  <option value="Timor-leste">Timor-leste</option>
                  <option value="Togo">Togo</option>
                  <option value="Tokelau">Tokelau</option>
                  <option value="Tonga">Tonga</option>
                  <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                  <option value="Tunisia">Tunisia</option>
                  <option value="Turkey">Turkey</option>
                  <option value="Turkmenistan">Turkmenistan</option>
                  <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                  <option value="Tuvalu">Tuvalu</option>
                  <option value="Uganda">Uganda</option>
                  <option value="Ukraine">Ukraine</option>
                  <option value="United Arab Emirates">United Arab Emirates</option>
                  <option value="United Kingdom">United Kingdom</option>
                  <option value="United States">United States</option>
                  <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                  <option value="Uruguay">Uruguay</option>
                  <option value="Uzbekistan">Uzbekistan</option>
                  <option value="Vanuatu">Vanuatu</option>
                  <option value="Venezuela">Venezuela</option>
                  <option value="Viet Nam">Viet Nam</option>
                  <option value="Virgin Islands, British">Virgin Islands, British</option>
                  <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                  <option value="Wallis and Futuna">Wallis and Futuna</option>
                  <option value="Western Sahara">Western Sahara</option>
                  <option value="Yemen">Yemen</option>
                  <option value="Zambia">Zambia</option>
                  <option value="Zimbabwe">Zimbabwe</option>
                  </select>
                </div>                
                </div>

                </div>
<!--                 <div id="tab3-2" class="tab-pane cont fade">


                  
                  <div class="form-group">

                    <label class="col-lg-3 control-label" for="recipient-name"><?php echo Lang::get('auth.CLIENT'); ?> :</label>
                  <div class="col-lg-6">

                    <div id="client_container">
                      
                    </div>

                  </div>                
                  </div>

                  <div id="services_container" style="display:none;"></div>                


                  <div id="resources_container">
                    <hr style="margin-bottom:5px;margin-top:5px;">
                    <h3><?php echo Lang::get('auth.ADD_RESOURCES'); ?> </h3> 
                    <hr style="margin-bottom:5px;margin-top:5px;">
                    <div id="res_container"></div>                    
                  </div>

                </div>

                <div id="tab3-3" class="tab-pane cont fade">
                <p class="text-muted"><?php echo Lang::get('auth.RESOURCES_DESC'); ?></p>


                </div>
 -->
                <div id="tab3-4" class="tab-pane fade">

                <h3><?php echo Lang::get('auth.PROJECT_BUDGET'); ?></h3> <hr>
                <p class="text-muted"><?php echo Lang::get('auth.BUDGET_DESC'); ?></p>

                  <div class="form-group">
                  <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.BUDGET'); ?> :</label>
                  <div class="col-lg-6">                
                    <select id="project_budget" onchange="showBudget(this.value);">
                      <option value="0">No Budget</option>
                      <option value="1">Total Project Hours</option>
                    </select>
                  </div>                
                  </div>

                  <div class="form-group" id="project_hours_div" style="display:none;">
                  <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.PROJECT_HOURS'); ?> :</label>
                  <div class="col-lg-6">                
                    <input type="text" id="project_hours" class="form-control">
                  </div>                
                  </div>

                  <div class="form-group">
                  <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.EXPRESS_PRICE'); ?> :</label>
                  <div class="col-lg-6">                

                    <label class="checkbox-inline">
                    <input type="checkbox" id="express_price" value="1">
                    <?php echo Lang::get('auth.EXPRESS_PRICE'); ?></label>


                  </div>                
                  </div>                  

                  <div class="form-group">
                  <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.PRICE_TYPE'); ?> :</label>
                  <div class="col-lg-6">                
                    <select id="budget_type" onchange="showPrice(this.value);">
                      <option value="">-- Select budget type --</option>                    
                      <option value="fixed">Fixed</option>
                      <option value="hourly">Per hour</option>
                    </select>
                  </div>                
                  </div>

                  <div class="form-group" id="price_div" style="display:none;">
                  <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.PRICE'); ?> :</label>
                  <div class="col-lg-6">
                    <input type="text" id="price" class="form-control">
                  </div>                
                  </div>



                 </div>


                <div id="tab3-5" class="tab-pane fade">
               <h3><?php echo Lang::get('auth.PROJECT_DATES'); ?></h3> <hr>
                <p class="text-muted"><?php echo Lang::get('auth.DATES_DESC'); ?></p>

                    <div class="form-group dates_range">
                      <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.TIME_TYPES'); ?> :</label>
                    <div class="col-lg-6">

                <div class="col-sm-20">
                  <label class="radio-inline">
                    <input type="radio" id="single" name="time_type" checked="checked" value="single" onclick="changeTimeType('single');">
                    Single </label>
                  <label class="radio-inline">
                    <input type="radio" id="recurring" name="time_type" value="recurring" onclick="changeTimeType('recurring');">
                    Recurring </label>
                </div>
                    </div>
                    </div>

                    <div class="form-group" id="start_date_div">
                      <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.START_DATE'); ?> :</label>
                    <div class="col-lg-6">
                      <input type="text" id="start_date" readonly="readonly" style="cursor:pointer; background-color: #FFFFFF" class="form-control datepicker form-control-inline input-medium default-date-picker">
                    </div>
                    </div>

                    <div class="form-group"  id="end_date_div"  style="display:none;">
                      <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.END_DATE'); ?> :</label>
                    <div class="col-lg-6">                
                      <input type="text" id="end_date" readonly="readonly" style="cursor:pointer; background-color: #FFFFFF" class="form-control default-date-picker">
                    </div>                
                    </div>

                    <div class="form-group" id="start_time_div">
                      <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.START_TIME'); ?> :</label>
                    <div class="col-lg-6">
                            <div class='col-sm-8'>
                                <div class="form-group">
                                    <div class='input-group date'>
                                        <input type='text' class="form-control" id='start_time' />
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <script type="text/javascript">
                               jQuery('#start_time').datetimepicker({
                                  datepicker:false,
                                  format:'H:i'
                                });
                            </script>
                    </div>
                    </div>


                    <div class="form-group" id="end_time_div">
                      <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.END_TIME'); ?> :</label>
                    <div class="col-lg-6">
                            <div class='col-sm-8'>
                                <div class="form-group">
                                    <div class='input-group date'>
                                        <input type='text' class="form-control" id='end_time' />
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <script type="text/javascript">
         jQuery('#end_time').datetimepicker({
                                  datepicker:false,
                                  format:'H:i'
                                });
                       
                            </script>
                    </div>
                    </div>


                    <div id="days_container" style="display:none;">
        <div class="notification-bar" id="days_msg">asdsa</div>

                  <h3><?php echo Lang::get('auth.SET_DAYS'); ?></h3>
                <p class="text-muted"><?php echo Lang::get('auth.DAYS_DESC'); ?></p>


                    <div>
                    <?php 
                    for($i=1;$i<=7;$i++)
                    {
                    ?>
                      <div style="margin-bottom:0px;" class="form-group">

                      <div class="col-lg-6" style="width:99%;"><label style="float:left; width:35%;" class="checkbox-inline">

                          <input type="checkbox" class="days" value="<?php echo $i;?>" onclick="showDayTime(<?php echo $i;?>, this.checked);" id="day_<?php echo $i;?>"><?php echo Lang::get('auth.DAY'.$i); ?></label>

                          <div style="float:left;width:24%;display:none;" class="day_div<?php echo $i;?>">
                                <div class="form-group" style="width:120px;display:block">
                                    <div class='input-group date'>
                                        <input type='text' class="form-control" placeholder="Start Time" id='start_time<?php echo $i;?>' />
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                          </div>

                          <div style="float:left;width: 120px;margin-left: 28px;display:none;"  class="day_div<?php echo $i;?>">
                                <div class="form-group"  style="width:120px;display:block">
                                    <div class='input-group date'>
                                        <input type='text' class="form-control" id='end_time<?php echo $i;?>' placeholder="End Time" />
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                          </div>

                            <script type="text/javascript">
                               jQuery('#start_time<?php echo $i;?>, #end_time<?php echo $i;?>').datetimepicker({
                                  datepicker:false,
                                  format:'H:i'
                                });
                       
                            </script>

                          </div></div>
                          <?php
                        }
                          ?>

<!--                           <div style="margin-bottom:0px;" class="form-group"><div class="col-lg-6">
                          <label class="checkbox-inline"><input class="days" type="checkbox" value="2" id="day_2">
                          <?php echo Lang::get('auth.DAY2'); ?></label></div></div>
                          <div style="margin-bottom:0px;" class="form-group"><div class="col-lg-6">
                          <label class="checkbox-inline"><input class="days" type="checkbox" value="3" id="day_3"><?php echo Lang::get('auth.DAY3'); ?></label></div></div>
                          <div style="margin-bottom:0px;" class="form-group">
                          <div class="col-lg-6"><label class="checkbox-inline"><input class="days" type="checkbox" value="4" id="day_4">
                           <?php echo Lang::get('auth.DAY4'); ?></label></div></div>
                           <div style="margin-bottom:0px;" class="form-group">
                          <div class="col-lg-6"><label class="checkbox-inline"><input class="days" type="checkbox" value="5" id="day_5">
                           <?php echo Lang::get('auth.DAY5'); ?></label></div></div>
                           <div style="margin-bottom:0px;" class="form-group">
                          <div class="col-lg-6"><label class="checkbox-inline"><input class="days" type="checkbox" value="6" id="day_6">
                           <?php echo Lang::get('auth.DAY6'); ?></label></div></div>                          
                           <div style="margin-bottom:0px;" class="form-group">
                          <div class="col-lg-6"><label class="checkbox-inline"><input class="days" type="checkbox" value="7" id="day_7">
                           <?php echo Lang::get('auth.DAY7'); ?></label></div></div> -->

                  </div>

                  </div>


                 </div>


                <div id="tab3-7" class="tab-pane cont fade">
               <h3><?php echo Lang::get('auth.PROJECT_STATUS'); ?></h3> <hr>
                <p class="text-muted"><?php echo Lang::get('auth.STATUS_DESC'); ?></p>

                    <div class="form-group">
                      <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.PROJECT_STATUS'); ?> :</label>
                    <div class="col-lg-6">                
                     <select id="project_status">
                       <option value="Active"><?php echo Lang::get('auth.Active'); ?></option>
                       <option value="Archived"><?php echo Lang::get('auth.Archived'); ?></option>
                       <option value="Pending"><?php echo Lang::get('auth.Pending'); ?></option>
                       <option value="Planned"><?php echo Lang::get('auth.Planned'); ?></option>
                       <option value="Floating"><?php echo Lang::get('auth.Floating'); ?></option>
                     </select>
                    </div>                
                    </div>

                    <div class="form-group">
                        <table class="table table-striped statusTable">
                            <thead>
                            <tr>
                                <td><?php echo Lang::get('auth.STATUS'); ?></td>
                                <td><?php echo Lang::get('auth.HOURS_REPORTED'); ?></td>
                                <td><?php echo Lang::get('auth.DISPLAY_ON_GRID'); ?></td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><i class="fa fa-square" style="color: #81A489"></i> <?php echo Lang::get('auth.Active'); ?></td>
                                <td>Yes</td>
                                <td>Yes</td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-square" style="color: #134B57"></i> <?php echo Lang::get('auth.Archived'); ?></td>
                                <td>Yes</td>
                                <td>No</td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-square" style="color: #90afb8"></i> <?php echo Lang::get('auth.Pending'); ?></td>
                                <td>No</td>
                                <td>Yes</td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-square" style="color: #F2A054"></i> <?php echo Lang::get('auth.Planned'); ?></td>
                                <td>No</td>
                                <td>Yes</td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-square" style="color: #C04D31"></i> <?php echo Lang::get('auth.Floating'); ?></td>
                                <td>Yes</td>
                                <td>Yes</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>


                </div>

                <div id="tab3-8" class="tab-pane cont fade">
                  <h3><?php echo Lang::get('auth.NOTES'); ?></h3>
                <p class="text-muted"><?php echo Lang::get('auth.NOTES_DESC'); ?></p>


                    <textarea id="project_notes" style="width:90%;height:74%;"></textarea>


                </div>


                <div id="tab3-9" class="tab-pane cont fade">
                  <h3><?php echo Lang::get('auth.PROJECT_LINKS'); ?></h3>
                <p class="text-muted"><?php echo Lang::get('auth.LINKS_DESC'); ?></p>

                  <div class="form-group">
                    <div class="basecamp_URL"><input id="basecamp" class="span2 basecamp_URL" type="text" placeholder="Basecamp URL"></div>
                  </div>

                  <div class="form-group">
                    <div class="trello_URL"><input id="trello" class="span2 trello_URL" type="text" placeholder="Trello URL"></div>
                  </div>

                  <div class="form-group">
                    <div class="google_URL"><input id="google" class="span2 google_URL" type="text" placeholder="Google URL"></div>
                  </div>

                  <div class="form-group">
                    <div class="harvest_URL"><input id="harvest" class="span2 harvest_URL" type="text" placeholder="Harvest URL"></div>
                  </div>

                 <div class="form-group">
                    <div class="dropbox_URL"><input id="dropbox" class="span2 dropbox_URL" type="text" placeholder="Dropbox URL"></div>
                  </div>



                </div>


              </div>




            </div>

                                          
            </form>
          </div>      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="addUpdateProject();" class="btn btn-primary"><?php echo Lang::get('common.SAVE_CHANGES'); ?> </button>
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
              <h4>  <?php echo Lang::get('auth.PROJECTS'); ?> 
<?php
  if($can_update)
  {
?>
              <button type="button" onclick="showProjectPopup(0);" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addClientPopup">
               <?php echo Lang::get('auth.ADD_PROJECTS'); ?>
              </button>
<?php
}
?>

              </h4>
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>                  
                    <th><?php echo Lang::get('auth.NAME'); ?> <i class="fa fa-sort nameall" style="float:right;cursor:pointer;" onclick="sortbyFunc('all', 'name', 'projects');"></i> <i style="cursor:pointer;float:right;display:none;"  onclick="sortbyFunc('asc', 'name', 'projects');" class="fa fa-sort-asc nameasc"></i>  <i style="cursor:pointer;display:none; float:right;" onclick="sortbyFunc('desc', 'name', 'projects');" class="fa fa-sort-desc namedesc"></i></th>
                    <th><?php echo Lang::get('auth.CLIENT'); ?></th>
<!--                     <th><?php echo Lang::get('auth.SERVICES'); ?></th>
                    <th><?php echo Lang::get('auth.RESOURCES'); ?></th>
                    <th><?php echo Lang::get('auth.START_END'); ?>   <i class="fa fa-sort start_dateall" style="float:right;cursor:pointer;" onclick="sortbyFunc('all', 'start_date', 'projects');"></i> <i style="cursor:pointer;float:right;display:none;"  onclick="sortbyFunc('asc', 'start_date', 'projects');" class="fa fa-sort-asc start_dateasc"></i>  <i style="cursor:pointer;display:none; float:right;" onclick="sortbyFunc('desc', 'start_date', 'projects');" class="fa fa-sort-desc start_datedesc"></i></th>
                    <th><?php echo Lang::get('auth.DAYS'); ?></th> -->
                    <th><?php echo Lang::get('auth.STATUS'); ?><i class="fa fa-sort statusall" style="float:right;cursor:pointer;" onclick="sortbyFunc('all', 'status', 'projects');"></i> <i style="cursor:pointer;float:right;display:none;"  onclick="sortbyFunc('asc', 'status', 'projects');" class="fa fa-sort-asc statusasc"></i>  <i style="cursor:pointer;display:none; float:right;" onclick="sortbyFunc('desc', 'status', 'projects');" class="fa fa-sort-desc statusdesc"></i></th>

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
            </div><!--box-info end-->
          </div><!--col-md-12 end-->
        </div><!--row end-->

      </div><!--scrollable wrapper end--> 
    </div><!--margin-container end--> 
  </div><!--main end--> 

</div><!--layout-container end--> 
<script>
    var ADD_PROJECT = "<?php echo Lang::get('auth.ADD_PROJECT'); ?>";
    var NO_RECORD = "<?php echo Lang::get('common.NO_RECORD'); ?>";
    var UPDATE_PROJECT = "<?php echo Lang::get('auth.UPDATE_PROJECT'); ?>";   
    var EDIT = "<?php echo Lang::get('common.EDIT'); ?>";
    var DELETE = "<?php echo Lang::get('common.DELETE'); ?>";        
    var TASKS = "<?php echo Lang::get('common.TASKS'); ?>";        

</script>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 

<script type="text/javascript" src="js/bootstrap-datepicker.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="bs3/js/bootstrap.min.js"></script> 
<script src="js/smooth-sliding-menu.js"></script> 
<script src="js/console-numbering.js"></script> 
<script src="js/to-do-admin.js"></script> 


<script src="plugins/PCharts/PCharts.js" type="text/javascript"></script> 
<script src="plugins/PCharts/serial.js" type="text/javascript"></script> 
<!-- <script src="plugins/PCharts/amstock.js" type="text/javascript"></script>  -->
<!-- <script src="plugins/PCharts/edit-chart.js" type="text/javascript"></script>  -->
<script src="plugins/PCharts/gauge.js" type="text/javascript"></script> 
<script src="plugins/PCharts/radar.js" type="text/javascript"></script> 
<script src="plugins/PCharts/pie.js" type="text/javascript"></script> 
<script src="plugins/kalendar/kalendar.js" type="text/javascript"></script> 
<script src="plugins/kalendar/edit-kalendar.js" type="text/javascript"></script>
<script src="js/jquery.fileupload.js"></script>
<script type="text/javascript" src="js/moment.js"></script>
<script src="js/modules/project.js" type="text/javascript"></script>


  <script>

  var can_update = '<?php echo $can_update; ?>';

  $( document ).ready(function() {

   $('.default-date-picker').datepicker({
    autoclose:true
   });

   getProjects();

    $('#picture').fileupload({
        dataType: 'json',
        done: function (e, data) {
        file = canvas_url + 'data/project/' + data.result.file_name;
        $('#pic_path').val(data.result.file_name);
        $('#temp_pic').attr('src',file);
        $('#temp_pic').show();        
        }
    });
  });    
    </script>
</body>
</html>