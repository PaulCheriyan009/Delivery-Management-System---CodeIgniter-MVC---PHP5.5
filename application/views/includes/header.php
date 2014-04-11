<!DOCTYPE html> 
<html lang="en-US">
<head>
  <title>Delivery Management System 2014</title>
  <meta charset="utf-8">
  <!-- global.css imports all other css files -->
  <link href="<?php echo base_url(); ?>assets/css/admin/global.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />

    <!-- javascript stuff -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.fancybox.pack.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui-timepicker-addon.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/admin.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
    <!-- morris graphing -->
    <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
</head>
<body>
<header>
	<div class="navbar">
	  <div class="navbar-inner">
	    <div class="container">
	      <a class="brand" href="<?php echo base_url(); ?>admin/dashboard">Delivery Management System</a>
	      <ul class="nav">
<!--              <li class="icon-brand"><a href="--><?php //echo base_url(); ?><!--"><i class="fa fa-truck"></i></a></li>-->
              <li <?php if($this->uri->segment(2) == 'dashboard'){echo 'class="active"';}?>>
                  <a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a>
              </li>
	        <li <?php if($this->uri->segment(2) == 'deliveries'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/deliveries"><i class="fa fa-truck"></i> Deliveries</a>
	        </li>
	        <li <?php if($this->uri->segment(2) == 'facilities'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/facilities"><i class="fa fa-building-o"></i> Facilities</a>
	        </li>
            <!-- driver tab -->
              <li <?php if($this->uri->segment(2) == 'drivers'){echo 'class="active"';}?>>
                  <a href="<?php echo base_url(); ?>admin/drivers"><i class="fa fa-group"></i> Drivers</a>
              </li>
              <li <?php if($this->uri->segment(2) == 'vehicles'){echo 'class="active"';}?>>
                  <a href="<?php echo base_url(); ?>admin/vehicles"><i class="fa fa-globe"></i> Vehicles</a>
              </li>
              <li <?php if($this->uri->segment(2) == 'suppliers'){echo 'class="active"';}?>>
                  <a href="<?php echo base_url(); ?>admin/suppliers"><i class="fa fa-globe"></i> Suppliers</a>
              </li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cogs"></i> Settings <b class="caret"></b></a>
	          <ul class="dropdown-menu">
                <li><a href="<?php echo base_url(); ?>frontend/home">Go to booking site</a></li>
	            <li>
	              <a href="<?php echo base_url(); ?>admin/logout">Logout</a>
	            </li>
	          </ul>
	        </li>
	      </ul>
	    </div>
	  </div>
	</div>
</header>
