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
<link rel="stylesheet" href="css/colorPicker.css" type="text/css" />
<link href="css/datepicker.css" rel="stylesheet">
<script src="js/modules/common.js"></script> 
<script>
var admin_id = <?php echo Session::get('user')['id']; ?>
</script>

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
<div class="modal fade" id="addClientPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="popupLabel"></h4>
      </div>
        <div class="modal-body">
            <form role="form" class="form-horizontal">
              <div class="notification-bar" id="msg"></div>

              <div class="form-group" id="select_resource">
                <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.SELECT_RESOURCE'); ?> :</label>
              <div class="col-lg-6">

                <select id="resource_type" class="form-control" onchange="showContainer(this.value);">
                  <option value=""> <?php echo Lang::get('auth.SELECT_RESOURCE'); ?>                 
                  <option value="person"> <?php echo Lang::get('auth.PERSON'); ?>
                  <option value="vehicle"> <?php echo Lang::get('auth.VEHICLE'); ?>
                </select>
                </div>
                <input type="hidden" id="client_id" value="">
              </div>

          <div id="person_container" style="display:none;">    

            <div class="tab-container tab-left">
              <ul class="nav nav-tabs flat-tabs">
                <li class="active"><a data-toggle="tab" href="#tab3-1"><i class="fa fa-home"></i> General Info</a></li>
                <li class=""><a data-toggle="tab" href="#tab3-2"><i class="fa fa-bars"></i> HR</a></li>
                <li class=""><a data-toggle="tab" href="#tab3-3"><i class="fa fa-check-circle"></i> Skills</a></li>
                <li class=""><a data-toggle="tab" href="#tab4-3"><i class="fa fa-book"></i> Education</a></li>

              </ul>
              <div class="tab-content">
                <div id="tab3-1" class="tab-pane cont fade active in">

              <div class="form-group">
                <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.ROLE'); ?> :</label>
              <div class="col-lg-6">                
              <select id="role_id">
                <option value="1">Employee</option>
                <option value="2">Planner</option>
                <option value="3">Admin</option>
                <option value="4">Planner (Read only)</option>
              </select>
              </div>                
              </div>

              <div class="form-group">
                <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.PERSONAL_NR'); ?> :</label>
              <div class="col-lg-6">                
                <input type="text" id="personal_nr" class="form-control">
              </div>                
              </div>

              <div class="form-group">
                <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('common.FIRST_NAME'); ?> :</label>
              <div class="col-lg-6">                
                <input type="text" id="first_name" class="form-control">
              </div>                
              </div>

              <div class="form-group">
                <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('common.LAST_NAME'); ?> :</label>
              <div class="col-lg-6">                
                <input type="text" id="last_name" class="form-control">
              </div>                
              </div>

              <div class="form-group">
                <label class="col-lg-4 control-label" for="recipient-name">Email :</label>
              <div class="col-lg-6">                
                <input type="text" id="email" class="form-control">
              </div>                
              </div>

              <div class="form-group">
                <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('common.MOBILE'); ?>  :</label>
              <div class="col-lg-6">                
                <input type="text" id="mobile" class="form-control">
              </div>                
              </div>

              <div class="form-group">
                <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.COLOR'); ?> :</label>
              <div class="col-lg-6">

                  <div class="controlset"> <input id="person_color" style="display:none;" type="text" name="person_color" value="#00000" /></div>

              </div>                
              </div>

              <div class="form-group" id="invite_status_div" style="display:none;">
                <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.INVITE_STATUS'); ?> :</label>
              <div class="col-lg-6" id="invite_status">

              </div>                
              </div>



              <div class="form-group">
              <div id="invite_div">                
                  <label class="checkbox-inline">
                    <input type="checkbox" id="invite" value="1">
                    <?php echo Lang::get('auth.INVITE_USER'); ?> </label>
                    <br>
                    <?php echo Lang::get('auth.INVITE_EXPLAIN'); ?> 
              </div>                
              </div>

              <div class="form-group">
                <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.TIMEZONE'); ?> :</label>
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
              </select>

              </div>                
              </div>



          <div class="form-group">
              <label class="col-lg-4 control-label"><?php echo Lang::get('auth.CHANGE_AVATOR'); ?></label>
              <div class="col-lg-6">

                  <input type="file" id="picture" name="picture" data-url="picture/upload" class="file-pos">

                  <img src="" id="temp_pic" style="display:none;" width="80" height="80"> 
                  <input type="hidden" value="" id="id">
                  <input type="hidden" value="" style="display:none;" id="pic_path">
              </div>
          </div>   


              <div class="form-group">
                <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.NOTES'); ?> :</label>
              <div class="col-lg-6">
                <textarea id="notes" class="form-control"> </textarea>
              </div>                
              </div>

                </div>
                <div id="tab3-2" class="tab-pane cont fade">

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
<select class="form-control" name="countries" id="country">
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


                <div class="form-group">
                  <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.Birthday'); ?> :</label>
                <div class="col-lg-6">                
                      <input type="text" id="birthday" readonly="readonly" style="cursor:pointer; background-color: #FFFFFF" class="form-control datepicker form-control-inline input-medium default-date-picker">
                </div>                
                </div>

                <div class="form-group">
                  <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.AVH'); ?> :</label>
                <div class="col-lg-6">                
                  <input type="text" id="avh" class="form-control">
                </div>                
                </div>

                <div class="form-group">
                  <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.HIRE_DATE'); ?> :</label>
                <div class="col-lg-6">                
                      <input type="text" id="hire_date" onchange="getSalary();" readonly="readonly" style="cursor:pointer; background-color: #FFFFFF" class="form-control datepicker form-control-inline input-medium default-date-picker">
                </div>                
                </div>

                <div class="form-group">
                  <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.LEAVINGDATE'); ?> :</label>
                <div class="col-lg-6">                
                      <input type="text" id="leaving_date" readonly="readonly" style="cursor:pointer; background-color: #FFFFFF" class="form-control datepicker form-control-inline input-medium default-date-picker">
                </div>                
                </div>

<!--                <div class="form-group">
                  <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.SALARY_TYPE'); ?> :</label>
                <div class="col-lg-6">                

                <?php
                  echo '<select id="salary_type_id"><option value="0">-- No salary type -- </option>';

                if(!empty($salary_types))
                {
                  foreach($salary_types as $salary_type)
                  {
                  ?>
                    <option value="{{$salary_type['id']}}">{{$salary_type['name']}} </option>;
                  <?php
                  }
                }
                  echo '</select>';
                ?>
                </div>                
                </div> -->

               <div class="form-group">
                  <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.EMPCATEGORY'); ?> :</label>
                <div class="col-lg-6">                
                <?php
                if(!empty($cats))
                {
                  echo '<select id="cat_id" onchange="getSalary();">';
                  foreach($cats as $cat)
                  {
                  ?>
                    <option value="{{$cat['id']}}">{{$cat['name']}} </option>;
                  <?php
                  }
                  echo '</select>';
                }
                else
                {
                  echo 'No category found. <a href="">Add Category</a>';
                }
                ?>
                </div>                
                </div>

<!--                <div class="form-group">
                  <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.SALARY_PAYMENT'); ?> :</label>
                <div class="col-lg-6">                
                <select id="salary_payment">
                <option value="hourly">Hourly</option>
                <option value="monthly">Monthly</option>
                <option value="invoice">Invoice</option>
                </select>
                </div>                  
                </div>
 -->

               <div class="form-group">
                  <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.SALARY'); ?> :</label>
                <div class="col-lg-6" id="salary_div"> 
                    <?php echo Lang::get('auth.SELECT_HIRE_DATE'); ?>
                </div>                
                </div>

               <div class="form-group">
                  <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.BANK_NAME'); ?> :</label>
                <div class="col-lg-6">                
                  <input type="text" id="bank_name" class="form-control">
                </div>                
                </div>

               <div class="form-group">
                  <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.ACCOUNT_NUMBER'); ?> :</label>
                <div class="col-lg-6">                
                  <input type="text" id="account_number" class="form-control">
                </div>                
                </div>

               <div class="form-group">
                  <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.STATUS'); ?> :</label>
                <div class="col-lg-6">
                  <select id="status">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>                    
                  </select>
                </div>                
                </div>



                </div>

                <div id="tab3-3" class="tab-pane cont fade">

               <div class="form-group">
                <div class="col-lg-6" style="margin-left:10px !important;">
                <?php
                if(!empty($services))
                {
                  foreach($services as $service)
                  {
                    ?>
                      <div style="margin-bottom:0px;" class="form-group">
                        <div>
                          <label class="checkbox-inline"><input type="checkbox" id="service_<?php echo $service['id']; ?>" class="services" value="<?php echo $service['id']; ?>"><i class="fa fa-plus-square"></i> <?php echo $service['name']; ?></label>
                        </div>
                      </div>
                    <?php
                  }

                }
                ?>
                </div>                
                </div>


                </div>



                <div id="tab4-3" class="tab-pane cont fade">

               <div class="form-group">
                <div class="col-lg-6" style="margin-left:10px !important;">
                <?php
                if(!empty($educations))
                {
                  foreach($educations as $education)
                  {
                    ?>
                      <div style="margin-bottom:0px;" class="form-group">
                        <div>
                          <label class="checkbox-inline"><input type="checkbox" id="education_<?php echo $education['id']; ?>" class="educations" value="<?php echo $education['id']; ?>"> <?php echo $education['name']; ?></label>
                        </div>
                      </div>
                    <?php
                  }

                }
                ?>
                </div>                
                </div>


                </div>


              </div>
            </div>




          </div>

          <div id="vehicle_container" style="display:none;">
              <div class="form-group">
                <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('common.NAME'); ?> :</label>
              <div class="col-lg-6">
                <input type="text" id="vehicle_name" class="form-control">
              </div>                
              </div>


              <div class="form-group">
                <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.COLOR'); ?> :</label>
              <div class="col-lg-6">

                  <div class="controlset"> <input id="vehicle_color" style="display:none;" type="text" name="vehicle_color" value="#000000" /></div>

              </div>                
              </div>




              <div class="form-group">
                <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.TIMEZONE'); ?> :</label>
              <div class="col-lg-6">                

            <select name="vehicle_timezone" id="vehicle_timezone">
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
              </select>

              </div>                
              </div>


          <div class="form-group">
              <label class="col-lg-4 control-label"><?php echo Lang::get('auth.CHANGE_AVATOR'); ?></label>
              <div class="col-lg-6">

                  <input type="file" id="vehicle_picture" name="vehicle_picture" data-url="vehicle/upload" class="file-pos">

                  <img src="" id="vehicle_temp_pic" style="display:none;" width="80" height="80"> 

                  <input type="hidden" value="<?php if(Session::has('user')) echo Session::get('user')['pic']; ?>" id="vehicle_pic_path">
              </div>
        </div>


              <div class="form-group">
                <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.NOTES'); ?> :</label>
              <div class="col-lg-6">
                <textarea id="vehicle_notes" class="form-control"> </textarea>
              </div>                
              </div>

          </div>          
                                          
            </form>
          </div>      <div class="modal-footer">  
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="addUpdateResource();" class="btn btn-primary"><?php echo Lang::get('common.SAVE_CHANGES'); ?> </button>
      </div>
    </div>
  </div>
</div>  

<div class="modal fade" id="resourceDetail" tabindex="-1" role="dialog" aria-labelledby="resourceDetail" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="detailpopupLabel"></h4>
      </div>
        <div class="modal-body">
            <form role="form" class="form-horizontal">

            <div class="tab-container tab-left">
              <ul class="nav nav-tabs flat-tabs">
                <li class="active"><a href="#detail-1" data-toggle="tab"><i class="fa fa-home"></i> General Info</a></li>
                <li><a href="#detail-2" data-toggle="tab"><i class="fa fa-text-height"></i> HR</a></li>
                <li><a href="#detail-3" data-toggle="tab"><i class="fa fa-camera"></i> Skills</a></li>
                <li><a href="#detail-4" data-toggle="tab"><i class="fa fa-camera"></i> Projects</a></li>
                <li><a href="#detail-5" data-toggle="tab"><i class="fa fa-camera"></i> Educations</a></li>

              </ul>
              <div class="tab-content">
                <div class="tab-pane active cont fade in" id="detail-1">

              <div class="form-group">
                <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.ROLE'); ?> :</label>
              <div class="col-lg-6 detail_label" id="role_label">                 
              </div>                
              </div>

              <div class="form-group">
                <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.PERSONAL_NR'); ?> :</label>
              <div class="col-lg-6 detail_label" id="personal_nr_label">                 
              </div>                
              </div>

              <div class="form-group">
                <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.NAME'); ?> :</label>
              <div class="col-lg-6 detail_label" id="name_label">                 
              </div>                
              </div>


              <div class="form-group">
                <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.EMAIL'); ?> :</label>
              <div class="col-lg-6 detail_label" id="email_label">                 
              </div>                
              </div>

              <div class="form-group">
                <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.MOBILE'); ?> :</label>
              <div class="col-lg-6 detail_label" id="mobile_label">
              </div>                
              </div>


              <div class="form-group">
                <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.COLOR'); ?> :</label>
                   <div id="color_label" style="width:20px;height:20px;margin-left:160px;">
              </div>
              </div>

              <div class="form-group">
                <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.INVITE_STATUS'); ?> :</label>
              <div class="col-lg-6 detail_label" id="invite_label">
              </div>
              </div>


              <div class="form-group">
                <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.TIMEZONE'); ?> :</label>
              <div class="col-lg-6 detail_label" id="timezone_label">
              </div>
              </div>


              <div class="form-group">
                <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.AVATOR'); ?> :</label>

                  <img width="50" height="50" id="pic_label" style="margin-left: 15px;" src="<?php echo URL::to('images/avatar1.jpg'); ?>">
              
              </div>



              <div class="form-group">
                <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.NOTES'); ?> :</label>
              <div class="col-lg-6 detail_label" id="notes_label">
              </div>
              </div>
              </div>





                <div class="tab-pane cont fade" id="detail-2">

                  <div class="form-group">
                    <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('common.STREET_ADDRESS'); ?> :</label>
                  <div class="col-lg-6 detail_label" id="street_address_label">
                  </div>
                  </div>


                  <div class="form-group">
                    <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('common.CITY'); ?> :</label>
                  <div class="col-lg-6 detail_label" id="city_label">
                  </div>
                  </div>

                  <div class="form-group">
                    <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('common.ZIP'); ?> :</label>
                  <div class="col-lg-6 detail_label" id="zip_label">
                  </div>
                  </div>

                  <div class="form-group">
                    <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('common.COUNTRY'); ?> :</label>
                  <div class="col-lg-6 detail_label" id="country_label">
                  </div>
                  </div>

                  <div class="form-group">
                    <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.Birthday'); ?> :</label>
                  <div class="col-lg-6 detail_label" id="birthday_label">
                  </div>
                  </div>

                  <div class="form-group">
                    <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.AVH'); ?> :</label>
                  <div class="col-lg-6 detail_label" id="avh_label">
                  </div>
                  </div>

                  <div class="form-group">
                    <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.HIRE_DATE'); ?> :</label>
                  <div class="col-lg-6 detail_label" id="hire_date_label">
                  </div>
                  </div>

                  <div class="form-group">
                    <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.LEAVINGDATE'); ?> :</label>
                  <div class="col-lg-6 detail_label" id="leaving_date_label">
                  </div>
                  </div>

                  <div class="form-group">
                    <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.EMPCATEGORY'); ?> :</label>
                  <div class="col-lg-6 detail_label" id="empcategory_label">
                  </div>
                  </div>
<!-- 
                  <div class="form-group">
                    <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.SALARY_PAYMENT'); ?> :</label>
                  <div class="col-lg-6 detail_label" id="salary_payment_label">
                  </div>
                  </div> -->

                  <div class="form-group">
                    <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.BANK_NAME'); ?> :</label>
                  <div class="col-lg-6 detail_label" id="bank_name_label">
                  </div>
                  </div>

                  <div class="form-group">
                    <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.ACCOUNT_NUMBER'); ?> :</label>
                  <div class="col-lg-6 detail_label" id="account_number_label">
                  </div>
                  </div>

                  <div class="form-group">
                    <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.STATUS'); ?> :</label>
                  <div class="col-lg-6 detail_label" id="status_label">
                  </div>
                  </div>


                </div>
                <div class="tab-pane fade" id="detail-3">

                  <div class="form-group">
                    <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.SKILLS'); ?> :</label>
                  <div class="col-lg-6 detail_label" id="skills_label">
                  </div>
                  </div>

               </div>


                <div class="tab-pane fade" id="detail-4">

                  <div class="form-group">
                    <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.WORKING_HOURS'); ?> :</label>
                  <div class="col-lg-6 detail_label">
                   <?php echo Lang::get('auth.MONTHLY_HOURS'); ?> :   <span id="monthly_hours"> </span><br>
                   <?php echo Lang::get('auth.YEARLY_HOURS'); ?> :   <span id="yearly_hours"> </span>                   
                  </div>
                  </div>


                  <div class="form-group">
                    <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.PROJECTS'); ?> :</label>
                  <div class="col-lg-6 detail_label" id="projects_label">
                  </div>
                  </div>

               </div>

                <div class="tab-pane fade" id="detail-5">

                  <div class="form-group">
                    <label class="col-lg-4 control-label" for="recipient-name"><?php echo Lang::get('auth.EDUCATIONS'); ?> :</label>
                  <div class="col-lg-6 detail_label" id="educations_label">
                  </div>
                  </div>

               </div>

            

              

              </div>
            </div>



            </form>
          </div>      <div class="modal-footer">  
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="addUpdateResource();" class="btn btn-primary"><?php echo Lang::get('common.SAVE_CHANGES'); ?> </button>
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
              <h4>  <?php echo Lang::get('auth.RESOURCES'); ?> 
<?php
  if($can_update)
  {
?>
              <button type="button" onclick="showResourcePopup('', 'Vehicle');" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addClientPopup">
               <?php echo Lang::get('auth.ADD_VEHICLE'); ?>
              </button>

              <button type="button" onclick="showResourcePopup('', 'Person');" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addClientPopup">
               <?php echo Lang::get('auth.ADD_PERSON'); ?>
              </button>
<?php
}
?>
              </h4>





            </div><!--box-info end-->
          </div><!--col-md-12 end-->
        </div><!--row end-->




          <div class="tab-container">
              <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Persons</a></li>
                <li><a data-toggle="tab" href="#profile">Vehicles</a></li>
              </ul>
              <div class="tab-content" style="height:100%;">
                <div id="home" class="tab-pane active cont" style="height:100%;">



              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th><?php echo Lang::get('auth.PICTURE'); ?></th>
                    <th><?php echo Lang::get('auth.NAME'); ?></th>
                    <th><?php echo Lang::get('auth.EMAIL'); ?></th>
                    <th><?php echo Lang::get('auth.MOBILE'); ?></th>
<?php
  if($can_update)
  {
?>                    
                    <th width="210"><?php echo Lang::get('common.ACTIONS'); ?></th>
   <?php
 }
 ?>
                  </tr>
                </thead>
                <tbody id="dataBodyPerson">
 
                </tbody>
              </table>





                </div>
                <div id="profile" class="tab-pane cont" style="height:100%;">


              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th><?php echo Lang::get('auth.NAME'); ?></th>
                    <th><?php echo Lang::get('auth.TYPE'); ?></th>
                    <th><?php echo Lang::get('auth.COLOR'); ?></th>
                    <th><?php echo Lang::get('auth.AVATOR'); ?></th>
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
                <tbody id="dataBodyVehicle">
 
                </tbody>
              </table>


                </div>

              </div>
            </div>




      </div><!--scrollable wrapper end--> 
    </div><!--margin-container end--> 
  </div><!--main end--> 
</div><!--layout-container end--> 
<script>
    var ADD_RESOURCE = "<?php echo Lang::get('auth.ADD_RESOURCE'); ?>";
    var NO_RECORD = "<?php echo Lang::get('common.NO_RECORD'); ?>";
    var UPDATE_RESOURCE = "<?php echo Lang::get('common.UPDATE_RESOURCE'); ?>";   
    var EDIT = "<?php echo Lang::get('common.EDIT'); ?>";
    var DETAIL = "<?php echo Lang::get('auth.DETAIL'); ?>";
    var DELETE = "<?php echo Lang::get('common.DELETE'); ?>";        
    var SELECT_HIRE_DATE = "<?php echo Lang::get('auth.SELECT_HIRE_DATE'); ?>";        


</script>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-1.10.2.js"></script> 
<script src="js/jquery-ui-1.9.1.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script language="javascript" type="text/javascript" src="js/jquery.colorPicker.min.js"/></script>
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
<script src="js/jquery.fileupload.js"></script>
<script src="js/modules/common.js"></script>
<script src="js/modules/resources.js"></script>


  <script>
    var can_update = '<?php echo $can_update; ?>';

  $( document ).ready(function() {
   $('.default-date-picker').datepicker({
    autoclose:true
   });

   $('#vehicle_color').colorPicker();
   $('#person_color').colorPicker();

    $('#vehicle_picture').fileupload({
        dataType: 'json',
        done: function (e, data) {
        file = canvas_url + 'data/vehicle/' + data.result.file_name;
        $('#vehicle_pic_path').val(data.result.file_name);
        $('#vehicle_temp_pic').attr('src',file);
        $('#vehicle_temp_pic').show();        

        }
    });

    $('#picture').fileupload({
        dataType: 'json',
        done: function (e, data) {
        file = canvas_url + 'data/pictures/' + data.result.file_name;
        $('#pic_path').val(data.result.file_name);
        $('#temp_pic').attr('src',file);
        $('#temp_pic').show();        
        }
    });

    getResources();
  });    
    </script>
</body>
</html>