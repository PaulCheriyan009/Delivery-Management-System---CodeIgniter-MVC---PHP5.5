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
          Adding <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>

      <?php
      //flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> new facility created with success.';
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

      //form validation
      echo validation_errors();
      
      echo form_open('admin/facilities/add', $attributes);
      ?>
        <fieldset>
            <div class="alert alert-info">
                <i class="fa fa-info-circle"></i> We will automatically look up your address details for you if you provide a valid postcode.
            </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Facility Name</label>
            <div class="controls">
              <input type="text" id="facility_name" name="facility_name" value="<?php echo set_value('facility_name'); ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <!-- ADDRESS -->
            <div class="control-group">
                <label for="inputError" class="control-label">Lookup</label>
                <div class="controls">
                    <input type="text" id="autocomplete" name="autocomplete" value="<?php echo set_value('facility_address1'); ?>" >
                    <!--<span class="help-inline">Woohoo!</span>-->
                </div>
            </div>
            <!-- begin hidden address fields -->
            <div class="hidden-slide-down">
            <div class="control-group">
                <label for="inputError" class="control-label">Address 1</label>
                <div class="controls">
                    <input type="text" id="street_number" name="facility_address1" value="<?php echo set_value('facility_address1'); ?>" >
                    <!--<span class="help-inline">Woohoo!</span>-->
                </div>
            </div>
            <div class="control-group">
                <label for="inputError" class="control-label">Address 2</label>
                <div class="controls">
                    <input type="text" id="route" name="facility_address2" value="<?php echo set_value('facility_address2'); ?>" >
                    <!--<span class="help-inline">Woohoo!</span>-->
                </div>
            </div>
            <div class="control-group">
                <label for="inputError" class="control-label">Town / City</label>
                <div class="controls">
                    <input type="text" id="locality" name="facility_locality" value="<?php echo set_value('facility_locality'); ?>" >
                    <!--<span class="help-inline">Woohoo!</span>-->
                </div>
            </div>
                <div class="control-group">
                    <label for="inputError" class="control-label">Postcode</label>
                    <div class="controls">
                        <input type="text" id="postal_code" name="facility_postcode" value="<?php echo set_value('facility_postcode'); ?>" >
                        <!--<span class="help-inline">Woohoo!</span>-->
                    </div>
                </div>
            </div><!-- end hdn addresses -->
            <div class="control-group">
                <label for="inputError" class="control-label">Max Capacity</label>
                <div class="controls">
                    <input type="text" id="facility_max_capacity" name="facility_max_capacity" value="<?php echo set_value('facility_max_capacity'); ?>" >
                    <!--<span class="help-inline">Woohoo!</span>-->
                </div>
            </div>
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <button class="btn" type="reset">Cancel</button>
          </div>
        </fieldset>

      <?php echo form_close(); ?>

    </div>
     