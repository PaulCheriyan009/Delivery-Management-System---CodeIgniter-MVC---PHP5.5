<?php
        $options_facility = array(0 => "all");
        $attributes = array('class' => 'form', 'id' => '');
        foreach ($facilities as $row)
        {
            $options_facility[$row['facility_id']] = $row['facility_name'];
        }
//        if()
        echo '<legend>Current Facilities</legend>';

        if(count($delivery_info) > 0) {
        echo '<table class="table table-striped"><thead><th>ID</th><th>Name</th><th>Town/City</th><th>Postcode</th><th></th><th></th></thead><tbody>';
        foreach($delivery_info as $row) {
            echo '<tr>';
            echo '<td>'.$row['facility_id'].'</td>';
            echo '<td>'.$row['facility_name'].'</td>';
            echo '<td>'.$row['facility_locality'].'</td>';
            echo '<td class="postcode">'.$row['facility_postcode'].'</td>';
            echo '<td><a class="btn btn-info" href="#"><i class="fa fa-map-marker"></i> Map</a>';
            echo '<td><a class="delete-facility btn btn-danger" href="#"><i class="fa fa-trash-o fa-lg"></i> Delete</a>';
            echo '<input id="link_id" name="id" type="hidden" value="'.$row['id'].'"/></td>';
            echo '</tr>';
        }

        echo '</tbody></table>';
        } else {
            echo '<p>Sorry but there are no facilities linked to this delivery. Add some below.</p>';
        }//end check for array length
        echo form_open('admin/deliveries/add_facility', $attributes);

            echo '<fieldset class="fancybox"><legend>Add New Facility</legend>';
//            echo '<p class="well">Please select a facility from the dropdown below to add it to your chosen delivery</p>';
            echo '<label for="delivery_id">Delivery ID</label>';
            $options = array(
                'name' => 'delivery_id',
                'id' => 'delivery_id',
                'disabled' => 'true',
                'value' => $delivery_id,
                'readonly' => 'readonly'
            );
            echo form_input($options);
            echo '<label for="facility_id">Facility</label>';
//            echo '<div class="control-group">';
//            echo '<div class="controls">';
              echo form_dropdown('facility_id', $options_facility, set_value('facility_id'), 'class="span3" id="facility_id"');
            $button_class = array('class' => 'btn btn-primary');
            echo '<input type="text" id="authorization_start_time" name="authorization_start_time"/>';
//            echo form_submit($button_class, 'Add Facility!');
//            echo '</div>';
          echo '</fieldset>';


        echo '<div class="form-actions">';

//        echo form_submit($button_class, 'Save Changes');
    echo '<button id="submitFacility" type="button" data-loading-text="Loading..." class="btn btn-primary">Save changes</button>';
    echo '<a id="close-fancybox" class="btn">Cancel</a></div>';
echo form_close();
?>
<script src="<?php echo base_url(); ?>assets/js/jquery-1.7.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<!-- form plugins! -->
<script src="<?php echo base_url(); ?>assets/js/jquery.are-you-sure.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.valid8.js"></script>
<!-- jQuery UI -->
<script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.10.4.custom.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.fancybox.pack.js"></script>
<script src="<?php echo base_url(); ?>assets/js/admin.js"></script>



<script>
    var controller = 'deliveries';
    var base_url = '<?php echo base_url(); ?>';
<!--    var delivery_id = '--><?php //echo $delivery_id ?><!--';-->
    var facility_id = $('[name="facility_id"]').val();
    $('[name="facility_id"]').change(function() {
        facility_id = $(this).val();
    });

    $('.delete-facility').click(function(e){
         var link_id = $(this).parent().find('input[type="hidden"]').val();
            $.ajax({
                type: "POST",
                context: this,
                url: base_url + 'admin/' + controller + "/delete_facility/" + link_id
            })
                .done(function( msg ) {
                    $(this).parent().parent().fadeOut(500);
//                    parent.$.fancybox.close();
                });
    });
    // add facility
    $('#submitFacility').click(function(e){
        var delivery_id = $('#delivery_id').val();
        var facility_id = $('#facility_id').val();
        $.ajax({
            type: "POST",
            context: this,
            dataType: 'html',
            url: base_url + 'admin/' + controller + "/add_facility/" + delivery_id + "/" + facility_id
        })
            .done(function(data) {
                $(this).attr('disabled', true);
                $(this).text('Loading...');
                $('#result_column').html(data);
            });
    });
</script>
