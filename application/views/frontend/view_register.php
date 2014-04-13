<div class="container signup">
    <form id="multipage" class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>register">
        <h2 class="form-signin-heading">Driver Registration</h2>
        <?php
        //flash messages
        if(isset($username_taken)) {
            echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Sorry</strong> Username is already taken';
            echo '</div>';
        }
        ?>
        <fieldset id="aboutyou">
            <legend>About You</legend>
            <div class="form">
                <div class="form-group">
                    <div class="col-md-3">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="firstname" placeholder="First Name">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-3">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="lastname" placeholder="Last Name">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-3">
                        <label>Phone Number</label>
                        <input type="text" class="form-control" name="phonenumber" placeholder="Phone Number">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-3">
                        <label>Date of Birth</label>
                        <input type="text" class="form-control datepicker" name="driver_date_of_birth" placeholder="Date of Birth">
                    </div>
                </div>
        </fieldset>
        <fieldset id="credentials">
            <legend>Your Credentials</legend>

            <div class="form-group">
                <div class="col-md-3">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email Address">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3">
                    <label>Confirm Email</label>
                    <input type="email" class="form-control" name="confirmemail" placeholder="Confirm Email">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Username">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3">
                    <input type="submit" value="Register" class="btn btn-primary"/>
                </div>
            </div>
        </fieldset>
        <div class="error"><?php echo validation_errors();?></div>
        </div>
    </form>
</div>