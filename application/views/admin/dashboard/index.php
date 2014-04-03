<div class="container">
    <div class="row dashboard-begin">
        <div class="span12">
            <h1>Dashboard <small>Statistics Overview</small></h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
            </ol>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                Welcome to the 2014 Delivery Management System. You are currently in <b>Dashboard view</b>. Your Dashboard is where you will find all of the vital statistics relating to the deliveries - you can choose from other views in the navigation bar at the top of the page such as Deliveries, Facilities, Drivers, and Suppliers. Dashboard view intends to give you an overview of the current state of the DMS environment.
            </div>
        </div>
    </div>
    <div class="container information-panel">
    <div class="row-fluid">
        <div class="span4 pagination-centered">
           <i class="fa fa-truck fa-5x"></i>
        </div>
        <div class="span4 pagination-centered">
           <i class="fa fa-info-circle fa-5x"></i>
        </div>
        <div class="span4 pagination-centered">
            <i class="fa fa-pencil-square-o fa-5x"></i>
        </div>
    </div>
        <div class="row-fluid">
            <div class="span4 pagination-centered">
                <h4>New Deliveries</h4>
            </div>
            <div class="span4 pagination-centered">
                <h4>New Authorization Requests</h4>
            </div>
            <div class="span4 pagination-centered">
                <h4>New Work Items</h4>
            </div>
        </div>
        <!-- begin info -->
        <div class="row-fluid">
            <div class="span4 pagination-centered">
                <div class="items">
                    <ul>
                        <?php
                        foreach($new_deliveries as $row) {
                            echo '<li><table><tbody><td><a href="'.site_url("admin").'/deliveries/update/'.$row['delivery_id'].'">'.$row['delivery_id'].'</a></td><td><i class="fa fa-clock-o"></i> '.$row['time_stamp'].'</td><td></td><td>test</td></tbody></table></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="span4 pagination-centered">
                <div class="items">test</div>
            </div>
            <div class="span4 pagination-centered">
                <div class="items">test</div>
            </div>
        </div>
    </div>
</div>