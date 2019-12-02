</head>
<body class="hold-transition skin-blue light sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo site_url('dashboard'); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b></b>RBPos</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>RBPOS Dev</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa fa-bell-o"></i>
              <span class='label label-danger'>
              <div class="notif">
              
              </div>
              </span>
            </a>
            <ul class="dropdown-menu">
              <li class="header"></li>
              
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="<?php echo base_url('workorder'); ?>" class="ket">
                       <div class="xx">
                      </div> 
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url('assets/AdminLTE/dist/img/1.jpg')?>" class="user-image" alt="User Image">
              <span class="hidden-xs"></span>
              <span class="hidden-xs"> <?php echo $this->session->userdata("nama"); ?></span>
            </a>

            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="<?php echo base_url('assets/AdminLTE/dist/img/1.jpg')?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $this->session->userdata("nama"); ?>
                  <span class="hidden-xs"> (<?php echo $this->session->userdata("level"); ?>)</span>
                  <?php 
                    $nama_user = $this->session->userdata("nama");
                   ?>                
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-success btn-flat"><i class="fa fa-user" aria-hidden="true"></i> Profil</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo site_url('login/logout'); ?>" class="btn btn-warning btn-flat"><i class="fa fa-sign-out" aria-hidden="true"></i> Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  
