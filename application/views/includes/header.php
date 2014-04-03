<!DOCTYPE html> 
<html lang="en-US">
<head>
  <title>Delivery Management System 2014</title>
  <meta charset="utf-8">
  <!-- global.css imports all other css files -->
  <link href="<?php echo base_url(); ?>assets/css/admin/global.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.9.0.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
    <!-- jQuery UI -->
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
</head>
<body>
<header>
	<div class="navbar navbar-fixed-top">
	  <div class="navbar-inner">
	    <div class="container">
	      <a class="brand" href="#">Delivery Management System</a>
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
                <li><a href="<?php echo base_url(); ?>admin/changepermission">Change User Permissions</a></li>
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