<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>DMS</title>
    <!-- css stylesheets -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
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
          <a class="navbar-brand" href=" ">DMS Distribution</a>
        </div>
        <div class="collapse navbar-collapse" id="b-menu-1">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo site_url('register');?>">Register</a></li>
            <li><a href="<?php echo site_url('login');?>">Login</a></li>
            <li><a href="<?php echo site_url('contact');?>">Contact Us</a></li>
          </ul>
        </div> <!-- /.nav-collapse -->
      </div> <!-- /.container -->
    </div> <!-- /.navbar -->
	<div class="container1">
		<!-- slider -->
		<div id="slider" class="carousel slide" data-ride="carousel">
		  <!-- controls -->
		  <ol class="carousel-indicators">
			<li data-target="#slider" data-slide-to="0" class="active"></li>
			<li data-target="#slider" data-slide-to="1"></li>
			<li data-target="#slider" data-slide-to="2"></li>
		  </ol>
		  <div class="carousel-inner">
			<!-- slides -->
			<div class="item active">
			  <div class="container">
				<div class="carousel-caption">
				  <h1>DMS Distribution</h1>
				  <h4>We only tolerate the highest standard of handling and delivering our products</h4>
				</div>
			  </div>
			</div>
			<div class="item">
			  <div class="container">
				<div class="carousel-caption">
				  <h1>DMS Distribution</h1>
				  <h4>We get the job done right on time</h4>
				</div>
			  </div>
			</div>
			<div class="item">
			  <div class="container">
				<div class="carousel-caption">
				  <h1>DMS Distribution</h1>
				  <h4>We continue to grow as a company and as a community</h4>
				</div>
			  </div>
			</div>
		  </div>
		  <!-- left-right controls -->
		  <a class="left carousel-control" href="#slider" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
		  <a class="right carousel-control" href="#slider" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
		</div><!-- /.carousel -->
	</div>
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