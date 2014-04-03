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
          <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-success">Add a new delivery</a>
        </h2>
      </div>
      
      <div class="row">
        <div class="span12 columns">
          <div class="well">
           
            <?php
           
            $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');

            $options_facility = array(0 => "all");
            foreach ($facilities as $row)
            {
              $options_facility[$row['facility_id']] = $row['facility_name'];
            }
            //save the columns names in a array that we will use as filter         
            $options_deliveries = array();
            foreach ($deliveries as $array) {
              foreach ($array as $key => $value) {
                $options_deliveries[$key] = $key;
              }
              break;
            }

            echo form_open('admin/deliveries', $attributes);
     
              echo form_label('Search:', 'search_string');
              echo form_input('search_string', $search_string_selected, 'style="width: 170px;
height: 26px;"');

              echo form_label('Filter by facility:', 'facility_id');
              echo form_dropdown('facility_id', $options_facility, $facility_selected, 'class="span2"');

              echo form_label('Order by:','order');
              echo form_dropdown('order', $options_deliveries, $order, 'class="span2"');

              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Go');

              $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
              echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span1"');

              echo form_submit($data_submit);

            echo form_close();
            ?>

          </div>

          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">ID</th>
                <th class="yellow header headerSortDown">Date</th>
                <th class="green header">Time</th>
                <th class="red header">Driver Name</th>
                <th class="red header">Vehicle ID</th>
                <th class="red header">Description</th>
                <th class="red header">Status</th>
                <th class="red header">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php

              foreach($deliveries as $row)
              {
                  switch($row['status_id']) {
                      case 1:
                          $the_class = 'booked';
                          break;
                      case 2:
                          $the_class = 'in-progress';
                          break;
                      case 3:
                          $the_class = 'cancelled';
                          break;
                      case 4:
                          $the_class = 'expired';
                          break;
                      case 5:
                          $the_class = 'success';
                          break;
                  }
                echo '<tr class="'.$the_class.'">';
                echo '<td>'.$row['delivery_id'].'</td>';
                  $date = DateTime::createFromFormat('Y-m-d', $row['date_stamp']);
                echo '<td>'.$date->format('F j, Y').'</td>';
                echo '<td>'.$row['time_stamp'].'</td>';
                echo '<td>' . $row['driver_first_name'] . ' ' . $row['driver_last_name'] . '</td>';
                echo '<td>'.$row['vehicle_id'].'</td>';
                echo '<td>'.$row['description'].'</td>';
                echo '<td>'.$row['status_name'].'</td>';
//                echo '<td>'.$row['facility_id'].'</td>';
                echo '<td class="crud-actions">
                <span>
                  <a href="'.site_url("admin").'/deliveries/update/'.$row['delivery_id'].'" class="btn btn-info">edit</a>
                  <a href="'.site_url("admin").'/deliveries/delete/'.$row['delivery_id'].'" class="btn btn-danger">delete</a>
                </span>
                <a class="btn btn-info fancybox fancybox.iframe" href="'.site_url("admin").'/deliveries/add_facility/'.$row['delivery_id'].'">view/edit facilities</a>
                </td>';
                echo '</tr>';
              }
              ?>      
            </tbody>
          </table>

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>
          <input type="hidden" id="selectedID"/>
      </div>
    </div>