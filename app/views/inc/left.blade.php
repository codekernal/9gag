<?php
  $r = Request::path();
?>
  <div id="nav"> 
    <!--logo start-->
    <div class="profile">
      <div class="logo"><a href="<?php echo URL::to('dashboard');?>">
      <?php
        $account_id = Session::get('user')['account_id'];
        $accountRepo = new AccountsRepo();
        $accountData = $accountRepo->getAccount($account_id);
        if(!empty($accountData['logo']))
        {
          echo '      <img width="100" height="57" src="'.URL::to('/data/company/'.$accountData['logo']).'" alt=""></a>';          
        }
        else
          echo '      <img src="images/logo.png" alt=""></a>';
      ?>


      </div>
    </div><!--logo end--> 
    
    <!--navigation start-->
    <ul class="navigation">
      <li><a class="<?php  if($r == 'dashboard') echo 'active'; ?> lightcolor"  href="<?php echo URL::to('dashboard');?>"><i class="fa fa-home"></i><span><?php echo Lang::get('common.DASHBOARD'); ?></span></a></li>
<?php
  if($_GET['person_account_data']['role_id'] != '1')
  {
?>
      <input type="hidden" name="search_module" id="search_module" value="<?php echo $r;?>">
      <li><a class="<?php  if($r == 'projects') echo 'active'; ?> lightcolor"  href="<?php echo URL::to('projects');?>"><i class="fa fa-folder-open"></i><span><?php echo Lang::get('auth.PROJECTS'); ?></span></a></li>
      <li class="sub"> <a class="<?php if($r == 'services') echo 'active'; ?> lightcolor" href="<?php echo URL::to('services');?>"><i class="fa fa-columns"></i><span><?php echo Lang::get('common.SERVICES'); ?></span></a>
      <li class="sub"> <a class="<?php if($r == 'clients') echo 'active'; ?> lightcolor" href="<?php echo URL::to('clients');?>"><i class="fa fa-male"></i><span><?php echo Lang::get('common.CLIENTS'); ?></span></a>
      <li class="sub"> <a class="<?php if($r == 'categories') echo 'active'; ?> lightcolor" href="<?php echo URL::to('categories');?>"><i class="fa fa-sitemap"></i><span><?php echo Lang::get('auth.HR'); ?></span></a>      
      <li class="sub"> <a class="<?php if($r == 'resources') echo 'active'; ?> lightcolor" href="<?php echo URL::to('resources');?>"><i class="fa fa-male"></i><span><?php echo Lang::get('common.RESOURCES'); ?></span></a>      
<?php
}
?>
<!--         <ul class="navigation-sub">
          <li><a href="buttons.html"><i class="fa fa-power-off"></i><span>Button</span></a></li>
          <li><a href="grids.html"><i class="fa fa-columns"></i><span>Grid</span></a></li>
          <li><a href="icons.html"><i class="fa fa-flag"></i><span>Icon</span></a></li>
          <li><a href="tab-accordions.html"><i class="fa fa-plus-square-o"></i><span>Tab / Accordion</span></a></li>
          <li><a href="nestable.html"><i class="fa  fa-arrow-circle-o-down"></i><span>Nestable</span></a></li>
          <li><a href="slider.html"><i class="fa fa-font"></i><span>Slider</span></a></li>
          <li><a href="timeline.html"><i class="fa fa-filter"></i><span>Timeline</span></a></li>
          <li><a href="gallery.html"><i class="fa fa-picture-o"></i><span>Gallery</span></a></li>
        </ul> -->
      </li>
<!--       <li class="sub"><a href="#"><i class="fa fa-list-alt"></i><span>Forms</span></a>
        <ul class="navigation-sub">
          <li><a href="form-components.html"><i class="fa fa-table"></i><span>Components</span></a></li>
          <li><a href="form-validation.html"><i class="fa fa-leaf"></i><span>Validation</span></a></li>
          <li><a href="form-wizard.html"><i class="fa fa-th"></i><span>Wizard</span></a></li>
          <li><a href="input-mask.html"><i class="fa fa-laptop"></i><span>Input Mask</span></a></li>
          <li><a href="muliti-upload.html"><i class="fa fa-files-o"></i><span>Multi Upload</span></a></li>
        </ul>
      </li>
      <li class="sub"><a href="#"><i class="fa fa-table"></i><span>Table</span></a>
        <ul class="navigation-sub">
          <li><a href="basic-tables.html"><i class="fa fa-table"></i><span>Basic Table</span></a></li>
          <li><a href="data-tables.html"><i class="fa fa-columns"></i><span>Data Table</span></a></li>
        </ul>
      </li>
      <li><a href="fullcalendar.html"><i class="fa fa-calendar nav-icon"></i><span>Calendar</span></a></li>
      <li><a href="charts.html"><i class="fa fa-bar-chart-o"></i><span>Charts</span></a></li>
      <li class="sub"><a href="#"><i class="fa fa-folder-open-o"></i><span>Pages</span></a>
        <ul class="navigation-sub">
          <li><a href="404-error.html"><i class="fa fa-warning"></i><span>404 Error</span></a></li>
          <li><a href="500-error.html"><i class="fa fa-warning"></i><span>500 Error</span></a></li>
          <li><a href="balnk-page.html"><i class="fa fa-copy"></i><span>Blank Page</span></a></li>
          <li><a href="profile.html"><i class="fa fa-user"></i><span>Profile</span></a></li>
          <li><a href="login.html"><i class="fa fa-sign-out"></i><span>Login</span></a></li>
          <li><a href="map.html"><i class="fa fa-map-marker"></i><span>Map</span></a></li>
        </ul>
      </li> -->
    </ul><!--navigation end--> 
  </div><!--Left navbar end--> 

<div id="confirm" class="modal fade" style="z-index:99999!important">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- dialog body -->



      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
      </div>
  
      <div class="modal-body">
          <p>Are you sure?</p>
      </div>
      
      <!-- dialog buttons -->
      <div class="modal-footer">

      <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Delete</button>
      <button type="button" data-dismiss="modal" class="btn">Cancel</button>
 
      </div>
    </div>
  </div>
</div>



