<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>DMS-contact</title>
    <!-- css stylesheets -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/contact_style.css" rel="stylesheet">
</head>
<body>
    <!-- modal box -->
    <div class="modal fade" id="my-modal-box" tabindex="-1" role="dialog" aria-labelledby="my-modal-box-l" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <div class="modal-title" id="my-modal-box-l">
              <h3>Share it</h3>
            </div>
          </div><!-- /.modal-header -->
          <div class="modal-body">
            <p>Share it box content</p>
            <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
            <a class="addthis_button_preferred_1"></a>
            <a class="addthis_button_preferred_2"></a>
            <a class="addthis_button_preferred_3"></a>
            <a class="addthis_button_preferred_4"></a>
            <a class="addthis_button_compact"></a>
            <a class="addthis_counter addthis_bubble_style"></a>
            </div>
          </div><!-- /.modal-body -->
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- fixed navigation bar -->
    <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#b-menu-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url();?>booking">DMS Distribution</a>
        </div>
        <div class="collapse navbar-collapse" id="b-menu-1">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo base_url(); ?>register">Register</a></li>
            <li><a href="<?php echo base_url(); ?>login">Login</a></li>
            <li><a href="">Contact Us</a></li>
          </ul>
        </div> <!-- /.nav-collapse -->
      </div> <!-- /.container -->
    </div> <!-- /.navbar -->
	<div class="container1">
	<div class="contact"><h3>CONTACT</h3></div>	
	<form class="form form-horizontal">
		<div class="form">
			<div class="form-group">
				<div class="col-md-3">
					<label>First Name</label>
					<input type="email" class="form-control" id="firstname" placeholder="First Name">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					<label>Last Name</label>
					<input type="password" class="form-control" id="lastname" placeholder="Last Name">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					<label>Email</label>
					<input type="email" class="form-control" id="email" placeholder="email">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					<label for="message">Message:</label>
					<textarea id="message" name="message" rows="14" cols="40"></textarea>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="submit" value="login" class="btn btn-primary">Submit</button>
				</div>
			</div></br>
		</div>
	</form>
	<div class="footer">
      <footer>
	      <p>&copy; DMS Company 2014</p>
      </footer>
     </div>
     <!-- add javascripts -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>
</html>