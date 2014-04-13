



<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-inline">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <?php
                    if(!$this->session->userdata('is_logged_in')) {
                        echo '<li><a href="'.base_url().'register">Register</a></li>
                 <li><a href="'.base_url().'login">Login</a></li>
                 <li><a href="'.base_url().'admin">Admin Log In</a></li>';
                    }
                    ?>
                </ul>
                <p class="copyright text-muted small">Copyright &copy; Delivery Management System <?php echo date("Y") ?>. All Rights Reserved</p>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
