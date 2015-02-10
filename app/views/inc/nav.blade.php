<?php
if(!Session::has('user'))
{
  ?>
  <script>window.location = 'login'</script>
  <?php
  die();
}
else
{
  $sess = Session::get('user');
  if(!isset($sess['account_id']))
  {
  ?>
  <script>window.location = 'login'</script>
  <?php
  die();
  }

}
?>

     <div class="row"> 
        <!--col-md-12 start-->
        <div class="col-md-12"> 
          <!--profile dropdown start-->
          <ul class="user-info pull-right">
            <li class="hidden-xs">
              <input type="text" placeholder=" Search" id="search_key" class="form-control page-search" onkeyup="searchModule(this.value);">
            </li>
            <li class="profile-info dropdown"> <a data-toggle="dropdown" class="dropdown-toggle lightcolor" href="#"> <img class="img-circle profile_pic" width="50" height="50" alt="" src="<?php if(!empty(Session::get('user')['pic']) && file_exists(public_path().'/data/pictures/'.Session::get('user')['pic'])) echo URL::to('/data/pictures/'.Session::get('user')['pic']); else echo 'images/avatar1.jpg'; ?>"><?php echo Session::get('user')['full_name'];?></a>
              <ul class="dropdown-menu">
                <li class="caret"></li>
                <li> <a href="<?php echo URL::to('profile');?>"> <i class="fa fa-user"></i> <?php echo Lang::get('common.EDIT_PROFILE'); ?> </a> </li>
                <li> <a href="<?php echo URL::to('settings');?>"> <i class="fa fa-user"></i> <?php echo Lang::get('auth.SETTINGS'); ?> </a> </li>
                <li> <a href="<?php echo URL::to('logout'); ?>"> <i class="fa fa-clipboard"></i> <?php echo Lang::get('common.LOGOUT'); ?> </a> </li>
              </ul>
            </li>
          </ul><!--profile dropdown end--> 
          
          <!--top nav start-->
            <!--task start-->
 <!--top nav start-->
          <ul class="nav top-menu hidden-xs notify-row fadeInRightBig animated">

            <!--notification start-->
            <li class="dropdown" id="header_notification_bar"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-bell-o"></i> <span id="notification_count" class="badge bg-warning"></span> </a>
              <ul class="dropdown-menu extended notification" id="notification_div">


              </ul>
            </li><!--notification end-->

            <li></li>
          </ul><!--top nav end--> 

            <a href="?lang=en">English </a> |
            <a href="?lang=gr">German </a> 

          </ul><!--top nav end--> 
        </div><!--col-md-12 end--> 
      </div><!--row end--> 
