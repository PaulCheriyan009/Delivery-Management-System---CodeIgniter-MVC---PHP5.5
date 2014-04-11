<div class="container">
    <div class="error"><h5><?php echo validation_errors();?></h5></div>
    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>register">
        <h2 class="form-signin-heading">Driver Registration</h2>
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
                    <label>Date of Birth</label>
                    <input type="text" class="form-control datepicker" name="driver_date_of_birth" placeholder="Date of Birth">
                </div>
            </div>
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
                    <button type="submit" value="login" class="btn btn-primary">Create Account</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </form>
</div>