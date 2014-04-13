<style>
    <?php include 'assets/css/frontend/bookingscreen.css' ?>
</style>
<div class="container">
    <div class="row">
        <div id="main">
            <h1>New Delivery</h1>
            <p class="lead">
                Please use the form below to create a new delivery.</p>
            <p class="lead">
           <strong>You will be able to book timeslots at individual facilities after you have created the delivery.</strong>
            </p>
            <div id="new-delivery-form">
                <?php
                echo form_open('create-delivery');
                echo form_label('Date:','name_label', 'class="form-label"');
                echo form_input('date_stamp','','class="datepicker-booking" placeholder="Choose a date"');
                echo '<hr>';
                ?>
                <div class="control-group">
                    <label for="inputError" class="control-label">Vehicle Registration:</label>
                    <div class="controls">
                        <p class="form-message">Please begin typing your vehicle's registration and you will be provided with results to best match your vehicle</p>
                        <input type="text" id="vehicle_registration" placeholder="Start typing your vehicle's registration" name="vehicle_registration">
                        <input type="hidden" id="vehicle_id" name="vehicle_id"/>
                    </div>
                </div>
                <!-- begin other hidden fields -->
                <input type="hidden" id="status_id" name="status_id" value="1"/>
                <input type="hidden" id="driver_id" name="driver_id" value="<?php echo $this->session->userdata('driver_id')?>"/>
                <?php
                echo '<hr>';
                echo form_submit('submit_new_delivery','Create New Delivery','class="btn btn-primary btn-lg"');
                echo form_close();
                echo '<hr>';
                ?>
            </div>
            </div>
        </div>
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
