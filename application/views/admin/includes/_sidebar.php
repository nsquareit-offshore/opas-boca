<?php 
$cur_tab = $this->uri->segment(2)==''?'dashboard': $this->uri->segment(2);  
?>  

<?php 
        $user_array = (get_user_name_by_id($this->session->userdata('user_id')));
       
        $upload_data = $user_array['image'] ? $user_array['image'] : 'profilepic_default.png';

        ?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary-blue elevation-4">
  <!-- Brand Logo -->
  <a href="<?= base_url('admin'); ?>" class="brand-link1">
    <img src="<?= base_url($this->general_settings['logo']); ?>" alt="Logo" class="brand-image1 img-circle1 1elevation-3"
         style="opacity: 1;width: 100%;">
    <span class="brand-text font-weight-light"><?php $this->general_settings['application_name']; ?></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-2 mb-2 d-flex">
      <div class="image">
        <img src="<?= base_url()."uploads/coach/".$upload_data; ?>" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        
        <a href="#" class="d-block"><?= $user_array['firstname'].' '.$user_array['lastname'] ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <?php 

        $count = 1;
          $menu = get_sidebar_menu(); 

          foreach ($menu as $nav):

            $sub_menu = get_sidebar_sub_menu($nav['module_id']);

            $has_submenu = (count($sub_menu) > 0) ? true : false;
        ?>

        <?php 
        if($count == 3){
          ?>
          <?php if($user_array['admin_role_id'] == 1 || $user_array['admin_role_id'] == 6): ?> 
          <li id="athlete" class="nav-item has-treeview has-treeview">

            <a href="<?= base_url('admin/goalkeeper_forms/'); ?>" class="nav-link">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Goalkeeper Report<i class="right fa fa-angle-left"></i></p>
            </a>

            <ul class="nav nav-treeview">            
              <li class="nav-item">
                <a href="<?= base_url('admin/goalkeeper_forms/'); ?>" class="nav-link">
                  <i class="fa fa-pencil-square-o nav-icon"></i>
                  <p>Create/Update Report</p>
                </a>
              </li>

              
              <li class="nav-item">
                <a href="<?= base_url('admin/download_goalkeeper_report/'); ?>" class="nav-link">
                  <i class="fa fa-download nav-icon"></i>
                  <p>Send/Download Report</p>
                </a>
              </li>

                         
            </ul>
          </li>
          <?php endif; ?>

          <?php if($user_array['admin_role_id'] == 1 || $user_array['admin_role_id'] == 6): ?> 
          <li id="athlete" class="nav-item has-treeview has-treeview">

            <a href="<?= base_url('admin/academic_forms/'); ?>" class="nav-link">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Academy Report<i class="right fa fa-angle-left"></i></p>
            </a>

            <ul class="nav nav-treeview">            
              <li class="nav-item">
                <a href="<?= base_url('admin/academic_forms/'); ?>" class="nav-link">
                  <i class="fa fa-pencil-square-o nav-icon"></i>
                  <p>Create/Update Report</p>
                </a>
              </li>

              
              <li class="nav-item">
                <a href="<?= base_url('admin/download_academic_report/'); ?>" class="nav-link">
                  <i class="fa fa-download nav-icon"></i>
                  <p>Send/Download Report</p>
                </a>
              </li>

                         
            </ul>
          </li>
          <?php endif; ?>

          <?php
        }
        ?>

        <?php if($this->rbac->check_module_permission($nav['controller_name'])): ?> 

        <li id="<?= ($nav['controller_name']) ?>" class="nav-item <?= ($has_submenu) ? 'has-treeview' : '' ?> has-treeview">

          <a href="<?= base_url('admin/'.$nav['controller_name']) ?>" class="nav-link">
            <i class="nav-icon fa <?= $nav['fa_icon'] ?>"></i>
            <p>
              <?= trans($nav['module_name']) ?>
              <?= ($has_submenu) ? '<i class="right fa fa-angle-left"></i>' : '' ?>
            </p>
          </a>

          <!-- sub-menu -->
          <?php 
            if($has_submenu): 
          ?>
          <ul class="nav nav-treeview">

            <?php foreach($sub_menu as $sub_nav): ?>

            <li class="nav-item">
              <a href="<?= base_url('admin/'.$nav['controller_name'].'/'.$sub_nav['link']); ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p><?= trans($sub_nav['name']) ?></p>
              </a>
            </li>

            <?php endforeach; ?>
           
          </ul>
          <?php endif; ?>
          <!-- /sub-menu -->
        </li>

        <?php endif; ?>

        <?php $count++; 
        endforeach; ?>

         <?php if($user_array['admin_role_id'] == 1): ?> 
          <li id="settings" class="nav-item  has-treeview">

          <a href="<?= base_url('admin/settings/'); ?>" class="nav-link">
            <i class="nav-icon fa fa-cog"></i>
            <p>Settings</p>
          </a>

          <!-- sub-menu -->
                    <!-- /sub-menu -->
        </li>
        <?php endif; ?>

 

<!--         <li class="nav-header"><?= trans('miscellaneous') ?></li>
        <li class="nav-item">
          <a href="https://adminlte.io/docs" class="nav-link">
            <i class="nav-icon fa fa-file"></i>
            <p><?= trans('documentation') ?></p>
          </a>
        </li>
        <li class="nav-header"><?= trans('labels') ?></li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-circle-o text-danger"></i>
            <p class="text"><?= trans('important') ?></p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-circle-o text-warning"></i>
            <p><?= trans('warning') ?></p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-circle-o text-info"></i>
            <p><?= trans('informational') ?></p>
          </a>
        </li> -->
        
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<script>
  $("#<?= $cur_tab ?>").addClass('menu-open');
  $("#<?= $cur_tab ?> > a").addClass('active');
</script>