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

    <div class="row">
        <div class="span12 columns">

        <div class="alert alert-danger">
            Warning: Deleting a driver will also delete their accompanying booking portal user account. Proceed with caution!
        </div>
        <table class="table table-striped table-bordered table-condensed">
            <thead>
            <tr>
                <th class="header">Driver ID</th>
                <th class="yellow header headerSortDown">First Name</th>
                <th class="yellow header headerSortDown">Last Name</th>
                <th class="yellow header headerSortDown">Date of Birth</th>
                <th class="yellow header headerSortDown">Phone Number</th>
                <th class="yellow header headerSortDown">Company</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($drivers as $row)
            {
                echo '<tr>';
                echo '<td>'.$row['driver_id'].'</td>';
                echo '<td>'.$row['driver_first_name'].'</td>';
                echo '<td>'.$row['driver_last_name'].'</td>';
                echo '<td>'.$row['driver_dob'].'</td>';
                echo '<td>'.$row['driver_phone_number'].'</td>';
                echo '<td>'.$row['company_name'].'</td>';
                echo '<td class="crud-actions">
                  <a href="'.site_url("admin").'/drivers/update/'.$row['driver_id'].'" class="btn btn-info">view & edit</a>
                  <a href="'.site_url("admin").'/drivers/delete/'.$row['driver_id'].'" class="btn btn-danger">delete</a>
                </td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>

        <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>
    </div>
</div>