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
                    echo '<ul class="delivery-listing">';
                    echo '<li class="header"><span>ID</span><span>Time</span></li>';
                    foreach ($deliveries as $row) {
                        echo '<li><span>'.$row['delivery_id'].'</span><span><i class="fa fa-clock-o"></i>&nbsp;'.$row['date_stamp'].'</span><span><a class="btn btn-primary" href="'.base_url().'book-timeslot/'.$row['delivery_id'].'">Add Facilities</a></span></li>';
                    }
                    echo '</ul>';
                }
                ?>
            </p>
        </div>
    </div>
</div>