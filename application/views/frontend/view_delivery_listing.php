<style>
    <?php include 'assets/css/frontend/bookingscreen.css' ?>
</style>
<div class="container">
    <div class="row">
        <div id="main">
            <h1>Your Deliveries</h1>
            <p class="lead">
            Here are your current deliveries:

                <?php
                if(!empty($deliveries)) {
                    foreach ($deliveries as $row) {
                        echo 'yes';
                    }
                }
                ?>
            </p>
        </div>
    </div>
</div>