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

    echo form_open('admin/vehicles/update/'.$this->uri->segment(4).'', $attributes);
    ?>

    <fieldset>
        <div class="control-group">
            <label for="inputError" class="control-label">Registration No.</label>
            <div class="controls">
                <input type="text" id="vehicle_registration" name="vehicle_registration" value="<?php echo $vehicle[0]['vehicle_registration']; ?>" >
            </div>
        </div>
        <div class="control-group">
            <label for="inputError" class="control-label">Make</label>
            <div class="controls">
                <input type="text" id="vehicle_make" name="vehicle_make" value="<?php echo $vehicle[0]['vehicle_make']; ?>" >
            </div>
        </div>
        <div class="control-group">
            <label for="inputError" class="control-label">Model</label>
            <div class="controls">
                <input type="text" class="datepicker-dob" id="vehicle_model" name="vehicle_model" value="<?php echo $vehicle[0]['vehicle_model']; ?>" >
            </div>
        </div>
        <div class="control-group">
            <label for="inputError" class="control-label">Year of Production / Creation</label>
            <div class="controls">
                <input type="text" id="vehicle_year_of_production" name="vehicle_year_of_production" value="<?php echo $vehicle[0]['vehicle_year_of_production']; ?>" >
            </div>
        </div>
            <div class="control-group">
                <label for="inputError" class="control-label">Associated Company</label>
                <div class="controls">
                    <?php
                    echo form_dropdown('company_id',$options_companies,$vehicle[0]['company_id']);
                    ?>
                </div>
            </div>
            <div class="form-actions">
                <button class="btn btn-primary" type="submit">Save changes</button>
                <button class="btn" type="reset">Cancel</button>
            </div>
    </fieldset>
</div>