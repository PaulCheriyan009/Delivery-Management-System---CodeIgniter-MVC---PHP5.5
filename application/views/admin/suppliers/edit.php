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
            <a href="#">Edit</a>
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
            echo '<strong>Well done!</strong>, changes have been made';
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

    echo form_open('admin/suppliers/update/'.$this->uri->segment(4).'', $attributes);
    ?>
    <fieldset>
        <div class="alert alert-info">
            <i class="fa fa-info-circle"></i> We will automatically look up your address details for you if you provide a valid postcode.
        </div>
        <div class="control-group">
            <label for="inputError" class="control-label">Company Name</label>
            <div class="controls">
                <input type="text" id="company_name" name="company_name" value="<?php echo $supplier[0]['company_name'] ?>" >
            </div>
        </div>
        <div class="control-group lookup">
            <label for="inputError" class="control-label">Lookup</label>
            <div class="controls">
                <input type="text" id="autocomplete" placeholder="Start typing an address..." name="autocomplete">
            </div>
        </div>
        <div class="hidden-slide-down">
            <div class="control-group">
                <label for="inputError" class="control-label">Address 1</label>
                <div class="controls">
                    <input type="text" id="street_number" name="company_address1" value="<?php echo $supplier[0]['company_address1'] ?>" >
                </div>
            </div>
            <div class="control-group">
                <label for="inputError" class="control-label">Address 2</label>
                <div class="controls">
                    <input type="text" id="route" name="company_address2" value="<?php echo $supplier[0]['company_address2'] ?>" >
                </div>
            </div>
            <div class="control-group">
                <label for="inputError" class="control-label">Town / City</label>
                <div class="controls">
                    <input type="text" id="locality" name="company_locality" value="<?php echo $supplier[0]['company_locality'] ?>" >
                </div>
            </div>
            <div class="control-group">
                <label for="inputError" class="control-label">County</label>
                <div class="controls">
                    <input type="text" id="administrative_area_level_2" name="company_county" value="<?php echo $supplier[0]['company_county'] ?>" >
                </div>
            </div>
            <div class="control-group">
                <label for="inputError" class="control-label">Country</label>
                <div class="controls">
                    <input type="text" id="country" name="company_country" value="<?php echo $supplier[0]['company_country'] ?>" >
                </div>
            </div>
            <div class="control-group">
                <label for="inputError" class="control-label">Postcode</label>
                <div class="controls">
                    <input type="text" id="postal_code_prefix" name="company_postcode" value="<?php echo $supplier[0]['company_postcode'] ?>" >
                </div>
            </div>
        </div>
        <div class="control-group">
            <label for="inputError" class="control-label">Business Sector</label>
            <div class="controls">
                <input type="text" id="company_sector" name="company_sector" placeholder="Please enter what the company does" value="<?php echo $supplier[0]['company_sector'] ?>" >
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
    }
</script>
</div>