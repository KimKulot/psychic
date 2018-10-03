<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/public_html/assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/public_html/assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/public_html/assets/adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/public_html/assets/adminlte/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/public_html/assets/adminlte/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  
  <link rel="stylesheet" href="/public_html/assets/adminlte/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="/public_html/assets/adminlte/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="/public_html/assets/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="/public_html/assets/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="/public_html/assets/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link href="/public_html/css/styles.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/public_html/css/pricing-menu.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- JQuery -->
	<script src='//code.jquery.com/jquery-1.11.0.min.js'></script>
	
	<!-- JQuery UI - Overcast -->
	<script src='/media/javascript/jqui/jquery-ui-1.8.16.custom.min.js'></script>
	
	<!-- JQuery Date/Time -->
	<script src='/media/javascript/datetime/jquery-ui-timepicker-addon.js'></script>
	
	<!-- JQuery Switch -->
	<script src='/media/javascript/ajax_switch/jquery.iphone-switch.js'></script>
	
	<!-- JQuery Hint 
	<script src='/media/javascript/hint.js'></script>
	-->
	<script src="/public_html/assets/adminlte/bower_components/morris.js/morris.min.js"></script>
	<!-- Bootstrap -->
	<script src='/media/bootstrap/js/bootstrap.min.js'></script>

	<!-- Bootstrap datepicker-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini" style="margin-bottom: unset !important;">

	
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Member</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu" id="member-sign" onclick="toggledrop()">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="/public_html/assets/adminlte/dist/img/user-icon.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?= ucwords($member['first_name']) . ' ' . ucwords($member['last_name']); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="/public_html/assets/adminlte/dist/img/user-icon.png" class="img-circle" alt="User Image">

                <p>
                  <?= ucwords($member['first_name']) . ' ' . ucwords($member['last_name']); ?>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/members/edit/<?= $member['id']; ?>" class="btn btn-default btn-flat">Edit Account</a>
                </div>
                <div class="pull-right">
                  <a href='/members/logout' onclick="Javascript:return confirm('Are you sure you want to logout?');" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li><a href="/members/member_account"><i class="fa fa-credit-card"></i><span>Fund Account</span></a></li>
		    <li><a href="/members/psychics"><i class="fa fa-user-secret"></i><span>Online Readers</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-send"></i>
            <span>SMS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/members/sms_sent"><i class="fa fa-circle-o"></i> SMS Sent</a></li>
            <li><a href="/members/sms_received"><i class="fa fa-circle-o"></i> SMS Received</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  
  <?php
      
      if(validation_errors()) echo validation_errors('<div class=\'errors\'>','</div>');
      if($this->error) echo '<div class=\'errors\'>'.$this->error.'</div>';
      if($this->session->flashdata('error')) echo '<div class=\'errors\'>'.$this->session->flashdata('error').'</div>';
      if($this->session->flashdata('response')) echo '<div class=\'responses\'>'.$this->session->flashdata('response').'</div>';
    
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php
      
      if(validation_errors()) echo validation_errors('<div class=\'errors\'>','</div>');
      if($this->error) echo '<div class=\'callout callout-warning errors\'>'.$this->error.'</div>';
      if($this->session->flashdata('error')) echo '<div class=\'callout callout-warning errors\'>'.$this->session->flashdata('error').'</div>';
      if($this->session->flashdata('response')) echo '<div class=\'callout callout-success responses\'>'.$this->session->flashdata('response').'</div>';
    
    ?>
    <!-- <div class="callout callout-success" style="margin-bottom: unset;">
      <p >Add the layout-top-nav class to the body tag to get this layout. This feature can also be used with a
        sidebar! So use this class if you want to remove the custom dropdown menus from the navbar and use regular
        links instead.</p>
    </div>
 -->    
  

						