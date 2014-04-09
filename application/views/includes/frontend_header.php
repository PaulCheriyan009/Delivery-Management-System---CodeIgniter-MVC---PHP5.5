<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>DMS</title>
    <!-- css stylesheets -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/frontend/style.css" rel="stylesheet">
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
                <li><a href="<?php echo base_url(); ?>register">Register</a></li>
                <li><a href="<?php echo base_url(); ?>login">Login</a></li>
                <li><a href="<?php echo base_url(); ?>admin">Admin Log In</a></li>
<!--                <li><a href="--><?php //echo base_url(); ?><!--contact">Contact Us</a></li>-->
            </ul>
        </div> <!-- /.nav-collapse -->
    </div> <!-- /.container -->
</div> <!-- /.navbar -->
<div class="container1">