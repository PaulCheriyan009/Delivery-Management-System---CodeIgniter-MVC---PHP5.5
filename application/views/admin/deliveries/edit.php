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
          <a href="#">Update</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Updating <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>

 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> product updated with success.';
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

      $options_facility = array('' => "Select");
      foreach ($facilities as $row)
      {
          $options_facility[$row['facility_id']] = $row['facility_name'];
      }

      //form validation
      echo validation_errors();

      echo form_open('admin/deliveries/update/'.$this->uri->segment(4).'', $attributes);
      ?>
        <fieldset>
            <div class="control-group">
                <label for="inputError" class="control-label">Description</label>
                <div class="controls">

                    <input type="text" id="" name="description" value="<?php echo $delivery[0]['description'] ?>" >
                    <!--<span class="help-inline">Woohoo!</span>-->
                </div>
            </div>
            <div class="control-group">
                <label for="inputError" class="control-label">Date</label>
                <div class="controls">
                    <?php
                    $date = DateTime::createFromFormat('Y-m-d', $delivery[0]['date_stamp']);
                    ?>
                    <input type="text" class="datepicker" id="" name="date_stamp" value="<?php echo $date->format('d-m-Y'); ?>">
                    <!--<span class="help-inline">Cost Price</span>-->
                </div>
            </div>
            <div class="control-group">
                <label for="inputError" class="control-label">Time</label>
                <div class="controls">
                    <?php
                    $time = DateTime::createFromFormat("G:i:s", $delivery[0]['time_stamp']);
                    ?>
                    <input type="text" id="deliverytime" name="time_stamp" value="<?php echo $time->format('h:i') ?>">
                    <!--<span class="help-inline">Cost Price</span>-->
                </div>
            </div>
            <div class="control-group">
                <label for="inputError" class="control-label">Vehicle Registration</label>
                <div class="controls">
                    <input type="text" id="vehicle_registration" name="vehicle_registration" value="<?php echo $delivery[0]['vehicle_registration'] ?>">
                    <input type="hidden" id="vehicle_id" name="vehicle_id" value="<?php echo $delivery[0]['vehicle_registration'] ?>"/>
                    <p class="form-message">Please begin typing your vehicle's registration and you will be provided with results to best match your vehicle</p>
                    <!--<span class="help-inline">OOps</span>-->
                </div>
            </div>
            <div class="control-group">
                <label for="inputError" class="control-label">Status</label>
                <div class="controls">
                    <?php
                    echo form_dropdown('status_id', $options_status, $delivery[0]['status_id'], 'class="span2"');
                    ?>
                    <!--<span class="help-inline">OOps</span>-->
                </div>
            </div>
            <!-- driver id -->
            <div class="control-group">
                <label for="inputError" class="control-label">Driver ID</label>
                <div class="controls">
                    <input type="text" name="driver_id" value="<?php echo $delivery[0]['driver_id'] ?>">
                    <!--<span class="help-inline">OOps</span>-->
                </div>
            </div>
            <div class="control-group">
                <label for="inputError" class="control-label"></label>
            <div class="controls"><a class="btn btn-info fancybox fancybox.iframe" href="<?php echo site_url("admin").'/deliveries/add_facility/'.$this->uri->segment(4) ?>">view/edit facilities</a></div>
            </div>

          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <button class="btn" type="reset">Cancel</button>
          </div>
        </fieldset>

      <?php echo form_close(); ?>

    </div>
     <script>
         // get vehicle reg and id here
         var controller = 'deliveries';
         var base_url = '<?php echo base_url(); ?>';
         $(this).ready( function() {
             $("#vehicle_registration").autocomplete({
                 minLength: 1,
                 source:
                     function(req, add){
                         $.ajax({
                             url: "<?php echo base_url(); ?>admin/vehicles/get_vehicle_by_registration",
                             dataType: 'json',
                             type: 'GET',
                             data: req,
                             success: function (data) {
                                 add($.map(data.message, function (el) {
                                     return {
                                         label: el.key,
                                         value: el.value
                                     };
                                 }));
                             }
                         });
                     },
                 select: function (event, ui) {
                     // Prevent value from being put in the input:
                     this.value = ui.item.label;
                     // Set the next input's value to the "value" of the item.
                     $('#vehicle_id').val(ui.item.value);
                     event.preventDefault();
                 }
             });
         });
     </script>