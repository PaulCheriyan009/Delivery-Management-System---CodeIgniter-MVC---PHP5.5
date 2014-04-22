<div class="intro-header">

    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="intro-message">
                    <?php
                    if(!$this->session->userdata('is_logged_in')) {
                        echo '<h1>Open for business</h1><h3>Welcome to the new Delivery Management System 2014</h3><p style="margin-top:20px;"><a href="register" style="padding:15px 26px;" class="btn btn-primary btn-primary btn-lg">Get Started Now!</a></p>';
                    } else {
                        echo '<h1>Hello '.$this->session->userdata('first_name').'!</h1><h3>Welcome to the new booking portal.</h3>';
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->

</div>
<!-- /.intro-header -->



<?php if(!$this->session->userdata('is_logged_in')) { ?>
<div class="content-section-a">

    <div class="container">

        <div class="row">
            <div class="col-lg-5 col-sm-6">
                <hr class="section-heading-spacer">
                <div class="clearfix"></div>
                <h2 class="section-heading">Register Your Details Now!</h2>
                <p class="lead">As a driver delivering to many facilities, have you ever found that booking in a delivery at each facility is much harder than it should be?</br></br>To save all of the hassle, you can now register on the Delivery Management System and automatically book your deliveries online.</p>
            </div>
            <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                <img class="img-responsive" src="<?php echo base_url(); ?>assets/img/ipad.png" alt="">
            </div>
        </div>

    </div>
    <!-- /.container -->

</div>
<!-- /.content-section-a -->

<div class="content-section-b">

    <div class="container">

        <div class="row">
            <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
                <hr class="section-heading-spacer">
                <div class="clearfix"></div>
                <h2 class="section-heading">Already a Member?</h2>
                <p class="lead">Login to view your current deliveries, and to book new ones!</p>
                <p>
                    <a href="<?php echo base_url(); ?>login" class="btn btn-primary btn-lg">Sign In Now</a>
                </p>
            </div>
            <div class="col-lg-5 col-sm-pull-6  col-sm-6">
                <img class="img-responsive" src="<?php echo base_url(); ?>assets/img/doge.png" alt="">
            </div>
        </div>
    </div>
    <!-- /.container -->

</div>
<!-- /.content-section-b -->
<div class="content-section-a">

    <div class="container">

        <div class="row">
            <div class="col-lg-5 col-sm-6">
                <hr class="section-heading-spacer">
                <div class="clearfix"></div>
                <h2 class="section-heading">Are you a DMS Company Employee?</h2>
                <p class="lead">
                    To visit the administration area, please follow the link below.
                </p>
                <a href="<?php echo site_url('admin')?>" class="btn btn-warning btn-lg">Go to Admin Area</a>
            </div>
            <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                <img class="img-responsive" src="<?php echo base_url(); ?>assets/img/admin.png" alt="">
            </div>
        </div>

    </div>
    <!-- /.container -->

</div>
<!-- /.content-section-a -->
<div class="banner">

    <div class="container">

        <div class="row">
            <div class="col-lg-6">
                <h2>Useful Links</h2>
            </div>
            <div class="col-lg-6">
                <ul class="list-inline banner-social-buttons">
                    <li><a href="<?php echo base_url(); ?>login" class="btn btn-default btn-lg"><i class="fa fa-sign-in fa-fw"></i> <span class="network-name">Login</span></a>
                    </li>
                    <li><a href="<?php echo base_url(); ?>register" class="btn btn-default btn-lg"><i class="fa fa-pencil-square-o"></i> <span class="network-name">Sign Up</span></a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
    <!-- /.container -->
    <? } ?>
</div>
<!-- /.banner -->