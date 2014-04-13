<div class="container">

    <form class="form-signin" method="post" role="form" action="<?php echo base_url(); ?>login">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="email" class="form-control" placeholder="Email address" name="email" required="" autofocus="">
        <input type="password" class="form-control" name="password" placeholder="Password" required="">
        <label class="checkbox">
            <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-lg btn-primary btn-block" value="login" type="submit">Sign in</button>
        <?php
        if(isset($message_error)) {
            echo '<div class="error"><p>Sorry, but you cannot access this area</p></div>';
        }
        ?>
</form>
</div>