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
            ?> - <small>All Drivers</small>
            <a  href="<?php echo site_url("admin")?>/drivers/add" class="btn btn-success">Add a new driver</a>
        </h2>
    </div>

    <div class="row">
        <div class="span12 columns">
            <p class="well">
                Here are all of the drivers currently listed for <i><?php echo $supplier_name ?></i>:
            </p>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="header">Driver ID</th>
                    <th class="yellow header headerSortDown">First Name</th>
                    <th class="yellow header headerSortDown">Last Name</th>
                    <th class="yellow header headerSortDown">Date of Birth</th>
                    <th class="yellow header headerSortDown">Phone Number</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(!empty($drivers)) {
                    foreach($drivers as $row)
                    {
                        echo '<tr>';
                        echo '<td>'.$row['driver_id'].'</td>';
                        echo '<td>'.$row['driver_first_name'].'</td>';
                        echo '<td>'.$row['driver_last_name'].'</td>';
                        echo '<td>'.$row['driver_dob'].'</td>';
                        echo '<td>'.$row['driver_phone_number'].'</td>';
                        echo '<td class="crud-actions">
                  <a href="'.site_url("admin").'/drivers/update/'.$row['driver_id'].'" class="btn btn-info">view & edit</a>
                  <a href="'.site_url("admin").'/drivers/delete/'.$row['driver_id'].'" class="btn btn-danger">delete</a>
                </td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="6"><p class="no-records">Sorry but there are no drivers for '.$supplier_name.' at the moment.</p></td></tr>';
                }
                ?>
                </tbody>
            </table>
            </div>
        </div>
     </div>