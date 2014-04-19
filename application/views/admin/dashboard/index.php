<div class="container">
    <div class="row dashboard-begin">
        <div class="span12">

            <ul class="breadcrumb">
                <li>
                    <a href="<?php echo site_url("admin"); ?>">
                        <?php echo ucfirst($this->uri->segment(1));?>
                    </a>
                    <span class="divider">/</span>
                </li>
                <li class="active">
                    <i class="fa fa-dashboard"></i> <?php echo ucfirst($this->uri->segment(2));?>
                </li>
            </ul>
            <h1>Dashboard <small>Statistics Overview</small></h1>
            <hr>
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
        <!-- begin action panel -->
        <div class="row-fluid">
            <div class="span4 pagination-centered">
                <h4>Deliveries In Progress</h4>
                <hr>
                <p>Please check them out once they are done.</p>
            </div>
            <div class="span4 pagination-centered">
                <h4>Authorizations Pending</h4>
                <hr>
                <p>Please authorize the deliveries below.</p>
            </div>
            <div class="span4 pagination-centered">
                <h4>Expired Deliveries</h4>
                <hr>
                <p>The following deliveries did not turn up..</p>
            </div>
        </div>
        <!-- begin info -->
        <div class="row-fluid">
            <div class="span4 pagination-centered">
                <div class="items">
                    <?php
                    if(!empty($in_progress_deliveries)) {
                        echo '<table class="table table-striped"><thead><tr><th>ID</th><th>Notes</th><th>Actions</th></tr></thead><tbody>';
                        foreach($in_progress_deliveries as $row) {
                            if(empty($row['description'])) {
                                $row['description'] = '-';
                            }
                            echo '<tr><td><a href="'.site_url("admin").'/deliveries/update/'.$row['delivery_id'].'">'.$row['delivery_id'].'</a></td><td>'.$row['description'].'</td><td><a href="'.site_url('admin').'/deliveries/add_facility/'.$row['delivery_id'].'" class="btn btn-info">Check Out</a></td></tr>';
                        }
                        echo '</tbody></table>';
                    } else {
                        echo '<p>Sorry, no results.</p>';
                    }
                      ?>
                </div>
            </div>
            <div class="span4 pagination-centered">
                <div class="items">
                        <?php
                        if(!empty($booked_deliveries)) {
                            echo '<table class="table table-striped"><thead><tr><th>ID</th><th>Notes</th></tr></thead><tbody>';
                            foreach($booked_deliveries as $row) {
                                if(empty($row['description'])) {
                                    $row['description'] = '-';
                                }
                                echo '<tr><td><a href="'.site_url("admin").'/deliveries/update/'.$row['delivery_id'].'">'.$row['delivery_id'].'</a></td><td>'.$row['description'].'</td><td><a href="" class="btn btn-primary authorize-delivery">Authorize</a><input type="hidden" value="'.$row['delivery_id'].'"></td></tr>';
                            }
                            echo '</tbody></table>';
                        } else {
                            echo '<p>Sorry, no results.</p>';
                        }
                        ?>
                </div>
            </div>
            <div class="span4 pagination-centered">
                <div class="items">
                        <?php
                        if(!empty($expired_deliveries)) {
                            echo '<table class="table table-striped"><thead><tr><th>ID</th><th>Notes</th></tr></thead><tbody>';
                            foreach($expired_deliveries as $row) {
                                if(empty($row['description'])) {
                                    $row['description'] = '-';
                                }
                                echo '<tr><td><a href="'.site_url("admin").'/deliveries/update/'.$row['delivery_id'].'">'.$row['delivery_id'].'</a></td><td>'.$row['description'].'</td></tr>';
                            }
                            echo '</tbody></table>';
                            echo '</tbody></table>';
                        } else {
                            echo '<p>Sorry, no results.</p>';
                        }
                        ?>
                </div>
            </div>
        </div>
        <hr>
        <!-- begin graphs -->
        <h3>Upcoming Deliveries (Next 5 Days)</h3>
        <hr>
        <div class="row-fluid">
            <div id="graph2" class="span12 pagination-centered">
            </div>
        </div>
        <hr>
        <h3>Deliveries (Past 5 Days)</h3>
        <hr>
        <div class="row-fluid">
            <div id="graph1" class="span12 pagination-centered">
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        var base_url = '<?php echo base_url() ?>';
        $('.authorize-delivery').click(function(e){
            e.preventDefault();
            var delivery_id = $(this).parent().find('input[type="hidden"]').val();
            $.ajax({
                url:base_url + 'admin/dashboard/authorize-delivery/' + delivery_id + '/2',
                type: 'POST',
                context:this,
                dataType:'json',
                success: function(data) {
                    $(this).text('Authorized');
                    $(this).removeClass('btn-primary');
                    $(this).addClass('btn-success');
                    $(this).parent().parent().parent().parent().hide('fade',1000);
                }
            })
        });

        var d = new Date();
        d.setDate(d.getDate() - 5);
        $.ajax({
            type: 'POST',
            url: base_url + 'admin/dashboard/get_delivery_count_by_date_range/' + formattedDate(d) + '/' + formattedDate(new Date()),
            cache: false,
            success: function (data) {
                if ($.isEmptyObject(data)) {
                    $('#graph1').html('<p style="text-align:left;font-style: italic;">Sorry there have been no deliveries made in the past 5 days.</p><hr>');
                } else {
                    new Morris.Line({
                        // ID of the element in which to draw the chart.
                        element: 'graph1',
                        // Chart data records -- each entry in this array corresponds to a point on
                        // the chart.
                        data: data,
                        // The name of the data record attribute that contains x-values.
                        xkey: 'Date',
                        parseTime: false,
                        // A list of names of data record attributes that contain y-values.
                        ykeys: ['Quantity'],
                        // Labels for the ykeys -- will be displayed when you hover over the
                        // chart.
                        labels: ['Quantity']
                    });
                }
            }
        });

        var d2 = new Date();
        d2.setDate(d2.getDate() + 5);
        $.ajax({
            type: 'POST',
            url: base_url + 'admin/dashboard/get_delivery_count_by_date_range/' + formattedDate(new Date())  + '/' + formattedDate(d2),
            cache: false,
            success: function (data) {
                if ($.isEmptyObject(data)) {
                    $('#graph1').html('<p style="text-align:left;font-style: italic;">Sorry there are no upcoming deliveries in the next 5 days.</p><hr>');
                } else {
                    new Morris.Line({
                        // ID of the element in which to draw the chart.
                        element: 'graph2',
                        // Chart data records -- each entry in this array corresponds to a point on
                        // the chart.
                        data: data,
                        // The name of the data record attribute that contains x-values.
                        xkey: 'Date',
                        parseTime: false,
                        // A list of names of data record attributes that contain y-values.
                        ykeys: ['Quantity'],
                        // Labels for the ykeys -- will be displayed when you hover over the
                        // chart.
                        labels: ['Quantity']
                    });
                }
            }
        });
    });
</script>