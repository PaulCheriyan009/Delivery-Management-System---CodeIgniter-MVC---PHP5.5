<div class="container top">

    <ul class="breadcrumb">
        <li>
            <a href="<?php echo site_url("admin"); ?>">
                <?php echo ucfirst($this->uri->segment(1));?>
            </a>
            <span class="divider">/</span>
        </li>
        <li class="active">
            <?php echo ucfirst($this->uri->segment(2));?>
        </li>
    </ul>

    <div class="page-header users-header">
        <h2>
            <?php
            echo $supplier_name
            ?> - <small>All Vehicles</small>
            <a href="<?php echo site_url("admin")?>/vehicles/add" class="btn btn-success">Add a new vehicle</a>
        </h2>
    </div>

    <div class="row">
        <div class="span12 columns">
            <p class="well">
                Here are all of the vehicles currently listed for <i><?php echo $supplier_name ?></i>:
            </p>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="header">Vehicle ID</th>
                    <th class="yellow header headerSortDown">Registration No.</th>
                    <th class="yellow header headerSortDown">Make</th>
                    <th class="yellow header headerSortDown">Model</th>
                    <th class="yellow header headerSortDown">Year of Production</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(!empty($vehicles)) {
                    foreach($vehicles as $row)
                    {
                        echo '<tr>';
                        echo '<td>'.$row['vehicle_id'].'</td>';
                        echo '<td>'.$row['vehicle_registration'].'</td>';
                        echo '<td>'.$row['vehicle_make'].'</td>';
                        echo '<td>'.$row['vehicle_model'].'</td>';
                        echo '<td>'.$row['vehicle_year_of_production'].'</td>';
                        echo '<td class="crud-actions">
                  <a href="'.site_url("admin").'/vehicles/update/'.$row['vehicle_id'].'" class="btn btn-info">view & edit</a>
                  <a href="'.site_url("admin").'/vehicles/delete/'.$row['vehicle_id'].'" class="btn btn-danger">delete</a>
                </td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="6"><p class="no-records">Sorry, but there are no vehicles added for '.$supplier_name.' at the moment.</p></td></tr>';
                }

                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>