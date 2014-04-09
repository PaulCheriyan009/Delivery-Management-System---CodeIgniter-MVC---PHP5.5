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
            <div class="control-group lookup">
                <label for="inputError" class="control-label">Lookup</label>
                <div class="controls">
                    <input type="text" id="autocomplete" placeholder="Start typing an address..." name="autocomplete" value="<?php echo set_value('facility_address1'); ?>" >
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
                    <label for="inputError" class="control-label">County</label>
                    <div class="controls">
                        <input type="text" id="administrative_area_level_2" name="facility_county" value="<?php echo set_value('facility_country'); ?>" >
                        <!--<span class="help-inline">Woohoo!</span>-->
                    </div>
                </div>
                <div class="control-group">
                    <label for="inputError" class="control-label">Country</label>
                    <div class="controls">
                        <input type="text" id="country" name="facility_country" value="<?php echo set_value('facility_country'); ?>" >
                        <!--<span class="help-inline">Woohoo!</span>-->
                    </div>
                </div>
                <div class="control-group">
                    <label for="inputError" class="control-label">Postcode</label>
                    <div class="controls">
                        <input type="text" id="postal_code_prefix" name="facility_postcode" value="<?php echo set_value('facility_postcode'); ?>" >
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
    <script>
        $(function(){
            initialize();
        });
        function initialize() {
            autocomplete = new google.maps.places.Autocomplete(document.getElementById('autocomplete'), { types: [ 'geocode' ] });
            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                fillInAddress();
            });
        }
        function fillInAddress() {
            var component_form = {
                'street_number': 'short_name',
                'route': 'long_name',
                'locality': 'long_name',
                'postal_code_prefix': 'long_name',
                'administrative_area_level_2': 'long_name',
                'country':'long_name'

            };
            var place = autocomplete.getPlace();

            for (var component in component_form) {
                document.getElementById(component).value = "";
                document.getElementById(component).disabled = false;
            }

            for (var j = 0; j < place.address_components.length; j++) {
                var att = place.address_components[j].types[0];
                if (component_form[att]) {
                    var val = place.address_components[j][component_form[att]];
                    document.getElementById(att).value = val;
                }
            }
//        $('.hidden-slide-down').show('slide',500);
//        $('div.lookup').hide('slide',500);
        }
    </script>