<?php
$page = $_SERVER['PHP_SELF'];
if ($isform == 'Y') {
  $sec = "5000";
} else {
  $sec = "60";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <style>
    .disabled-link {
      pointer-events: none;
    }
  </style>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
  <title><?php echo $title;?> | Housemaid</title>
  <link rel="icon" href="<?php echo base_url();?>assets/backend/dist/img/HousemaidLogo.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/backend/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/backend/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/backend/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/backend/dist/css/adminlte.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/backend/plugins/summernote/summernote-bs4.min.css">
  <!-- CodeMirror -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/backend/plugins/codemirror/codemirror.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/backend/plugins/codemirror/theme/monokai.css">
  <!-- SimpleMDE -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/backend/plugins/simplemde/simplemde.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">

  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="<?php echo base_url();?>assets/backend/dist/img/HousemaidLogo2.png" alt="HousemaidLogo" height="150" width="150">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item dropdown user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo base_url();?>assets/backend/dist/img/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="User Image">
            <span class="d-none d-md-inline"><?php echo $_SESSION['logged_in']['nama'].' | '.$_SESSION['logged_in']['role_lengkap'];?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <!-- User image -->
            <li class="user-header bg-primary">
              <img src="<?php echo base_url();?>assets/backend/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">

              <p>
                <?php echo $_SESSION['logged_in']['nama'];?>
              </p>
            </li>
            <li class="user-footer">
              <a href="<?php echo base_url('index.php/Login/logout'); ?>" onclick="clicked(event)" class="btn btn-default btn-flat float-right">Sign out</a>
            </li>
          </ul>
        </li>
      </ul>  
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?php echo base_url('index.php/Main');?>" class="brand-link">
        <img src="<?php echo base_url();?>assets/backend/dist/img/HousemaidLogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">HOUSEMAID</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-header">MENU</li>
            <?php foreach($menuParent->result() as $row ): $parent = $row->ID; ?>
              <?php if ($row->IS_PARENT == 'Y') { 
                if ($row->CHILD == 'Y') { ?>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="<?php echo $row->ICON;?>"></i>
                      <p>
                        <?php echo $row->NAMA_MENU;?>
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <?php foreach($menuChild->result() as $row ): ?>
                        <?php if ($row->PARENT2 == $parent) { ?>
                          <li class="nav-item">
                            <a href="<?php echo base_url().$row->URL2;?>" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p><?php echo $row->NAMA_MENU2;?></p>
                            </a>
                          </li>
                        <?php } endforeach;?>
                      </ul>
                    </li>
                  <?php } else { ?>
                    <li class="nav-item">
                      <a href="<?php echo base_url().$row->URL;?>" class="nav-link <?php if($menu == 'dashboard'){ echo 'menu-open active';}?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                          <?php echo $row->NAMA_MENU;?>
                        </p>
                      </a>
                    </li>
                  <?php } ?>
                <?php } else {

                } ?>
              <?php endforeach;?>
            </ul>
          </nav>
        </div>
        <!-- /.sidebar -->
      </aside>