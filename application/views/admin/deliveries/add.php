    <div class="container top">
      
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li>
          <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          <a href="#">New</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Add <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>
 
      <?php
      //flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> new delivery created with success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
      ?>
      
      <?php
      //form data
      $attributes = array('class' => 'form-horizontal', 'id' => '');
      $options_status = array('' => "Select");
      foreach ($status as $row)
      {
          $options_status[$row['status_id']] = $row['status_name'];
      }

      //form validation
      echo validation_errors();
      
      echo form_open('admin/deliveries/add', $attributes);
      ?>
        <fieldset>
          <div class="control-group">
            <label for="inputError" class="control-label">Description</label>
            <div class="controls">
              <input type="text" id="description" name="description" value="<?php echo set_value('description'); ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Date</label>
            <div class="controls">
              <input type="text" class="datepicker" id="" name="date_stamp" value="<?php echo set_value('date_stamp'); ?>">
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>          
          <div class="control-group">
            <label for="inputError" class="control-label">Time</label>
            <div class="controls">
              <input type="text" id="deliverytime" name="time_stamp" value="<?php echo set_value('time_stamp'); ?>">
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Vehicle Registration</label>
            <div class="controls">
              <input type="text" name="vehicle_id" value="<?php echo set_value('vehicle_id'); ?>">
              <p class="form-message">Search for your vehicle by make/model and we will grab its registration for you</p>
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            <!-- driver id -->
            <div class="control-group">
                <label for="inputError" class="control-label">Driver ID</label>
                <div class="controls">
                    <input type="text" name="driver_id" value="<?php echo set_value('driver_id'); ?>">
                    <!--<span class="help-inline">OOps</span>-->
                </div>
            </div>
            <!-- set initial status -->
            <div class="control-group">
                <label for="inputError" class="control-label">Status</label>
                <div class="controls">
                    <?php
                    echo form_dropdown('status_id', $options_status, 'class="span2"');
                    ?>
                    <!--<span class="help-inline">OOps</span>-->
                </div>
            </div>
<!--          --><?php
//          echo '<div class="control-group">';
//            echo '<label for="facility_id" class="control-label">Facility</label>';
//            echo '<div class="controls">';
//              //echo form_dropdown('manufacture_id', $options_manufacture, '', 'class="span2"');
//
//              echo form_dropdown('facility_id', $options_facility, set_value('facility_id'), 'class="span2"');
//
//            echo '</div>';
//          echo '</div">';
//          ?>
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <button class="btn" type="reset">Cancel</button>
          </div>
        </fieldset>

      <?php echo form_close(); ?>

    </div>
     