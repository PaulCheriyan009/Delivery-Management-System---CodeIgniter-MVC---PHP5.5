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
            <?php echo ucfirst($this->uri->segment(2));?>
            <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-success">Add a new supplier</a>
        </h2>
    </div>

    <div class="row">
        <div class="span12 columns">
            <div class="well">

                <?php

                $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');

                //save the columns names in a array that we will use as filter
                $options_suppliers = array();
                foreach ($suppliers as $array) {
                    foreach ($array as $key => $value) {
                        $options_suppliers[$key] = $key;
                    }
                    break;
                }

                echo form_open('admin/suppliers', $attributes);

                echo form_label('Search:', 'search_string');
                echo form_input('search_string', $search_string_selected);

                echo form_label('Order by:', 'order');
                echo form_dropdown('order', $options_suppliers, $order, 'class="span2"');

                $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Go');

                $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
                echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span1"');

                echo form_submit($data_submit);

                echo form_close();
                ?>

            </div>
            <div class="alert alert-danger">If you want a delete a supplier, bear in mind that any vehicles linked to the supplier will also be <strong>automatically deleted</strong>, and in turn any deliveries linked to the vehicle will also be deleted.</div>
            <table class="table table-striped table-bordered table-condensed">
                <thead>
                <tr>
                    <th class="header">ID</th>
                    <th class="yellow header headerSortDown">Name</th>
                    <th class="header">Address</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($suppliers as $row)
                {
                    echo '<tr>';
                    echo '<td>'.$row['company_id'].'</td>';
                    echo '<td>'.$row['company_name'].'</td>';
                    echo '<td><p>'.$row['company_address1'].'</p><p>'.$row['company_address2'].'</p><p>'.$row['company_locality'].'</p><p>'.$row['company_county'].'</p><p>'.$row['company_country'].'</p><p>'.strtoupper($row['company_postcode']).'</td>';
                    echo '<td class="crud-actions">
                  <span>
                  <a href="'.site_url("admin").'/suppliers/update/'.$row['company_id'].'" class="btn btn-info">view & edit</a>

                  <a onclick="return confirm(\'Are you sure? Deleting this supplier will also remove all of its associated vehicles and deliveries!\')" href="'.site_url("admin").'/suppliers/delete/'.$row['company_id'].'" class="btn btn-danger">delete</a>
                  </span>
                  <div class="btn-group full-width">
                      <a class="btn btn-warning dropdown-toggle" data-toggle="dropdown" href="#">
                        more actions
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="">view/edit drivers</a></li>
                        <li><a href="">view/edit vehicles</a></li>
                      </ul>
                    </div>
                </td>';
                    echo '</tr>';
                }
                ?>
                </tbody>
            </table>

            <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

        </div>
    </div>