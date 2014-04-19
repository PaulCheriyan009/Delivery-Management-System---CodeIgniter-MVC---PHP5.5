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
            echo '<strong>Well done!</strong> driver details successfully.';
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
      $options_companies = array('' => "Select");
      foreach ($companies as $row)
      {
          $options_companies[$row['company_id']] = $row['company_name'];
      }
      //form validation
      echo validation_errors();

      echo form_open('admin/drivers/update/'.$this->uri->segment(4).'', $attributes);
      ?>
        <fieldset>
            <div class="control-group">
                <label for="inputError" class="control-label">First Name</label>
                <div class="controls">
                    <input type="text" id="driver_first_name" name="driver_first_name" value="<?php echo $driver[0]['driver_first_name']; ?>" >
                </div>
            </div>
                <div class="control-group">
                    <label for="inputError" class="control-label">Last Name</label>
                    <div class="controls">
                        <input type="text" id="driver_last_name" name="driver_last_name" value="<?php echo $driver[0]['driver_last_name']; ?>" >
                    </div>
                </div>
                <div class="control-group">
                    <label for="inputError" class="control-label">Date of Birth</label>
                    <div class="controls">
                        <input type="text" class="datepicker-dob" id="driver_dob" name="driver_dob" value="<?php echo $driver[0]['driver_dob']; ?>" >
                    </div>
                </div>
                <div class="control-group">
                    <label for="inputError" class="control-label">Phone Number</label>
                    <div class="controls">
                        <input type="text" id="driver_phone_number" name="driver_phone_number" value="<?php echo $driver[0]['driver_phone_number']; ?>" >
                    </div>

                <div class="control-group">
                    <label for="inputError" class="control-label">Associated Company</label>
                    <div class="controls">
                        <?php
                        echo form_dropdown('company_id',$options_companies,$driver[0]['company_id']);
                        ?>
                    </div>
                </div>
            <div class="form-actions">
                <button class="btn btn-primary" type="submit">Save changes</button>
                <button class="btn" type="reset">Cancel</button>
            </div>
        </fieldset>

      <?php echo form_close(); ?>

    </div>
     <script>
         $(function(){
             $('.datepicker-dob').datepicker({
                 dateFormat:"dd-mm-yy",
                 showOptions: {
                     direction:"up"
                 },
                 autoSize:true
             });
         });
     </script>