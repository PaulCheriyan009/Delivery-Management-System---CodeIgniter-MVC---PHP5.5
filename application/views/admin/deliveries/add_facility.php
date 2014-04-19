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
<?php
        $options_facility = array(0 => "all");
        $attributes = array('class' => 'form', 'id' => '');
        foreach ($facilities as $row)
        {
            $options_facility[$row['facility_id']] = $row['facility_name'];
        }
//        if()
        echo '<legend>Current Facilities</legend>';
        echo '<p>Please use this page to check out deliveries out of particular facilities once they are done. Once you have <strong>checked out of all facilities</strong>, then the delivery status will automatically be changed to "done"</p>';
        if(count($delivery_info) > 0) {
        echo '<div id="rows"><table class="table table-striped"><thead><th>ID</th><th>Name</th><th>Town/City</th><th>Postcode</th><th>Start Time</th><th>Status</th><th>&nbsp;</th><th>&nbsp;</th></thead><tbody>';
        foreach($delivery_info as $row) {
            echo '<tr class="'.$row['status'].'">';
            echo '<td>'.$row['facility_id'].'</td>';
            echo '<td>'.$row['facility_name'].'</td>';
            echo '<td>'.$row['facility_locality'].'</td>';
            echo '<td class="postcode">'.$row['facility_postcode'].'</td>';
            echo '<td>'.$row['start_time'].'</td>';
            echo '<td>'.$row['status'].'</td>';
            echo '<td><a class="span1 delete-facility btn btn-danger" href="#"><i class="fa fa-trash-o fa-lg"></i> Remove</a>';
            echo '<td><a class="span1 btn btn-success update-status" href="#"><i class="fa fa-check-square-o"></i> Done</a></td>';
            echo '<input id="link_id" name="id" type="hidden" value="'.$row['id'].'"/></td>';
            echo '</tr>';
        }

        echo '</tbody></table></div>';
        } else {
            echo '<div id="rows"><p>Sorry but there are no facilities linked to this delivery. Add some below.</p></div>';
        }//end check for array length
//        echo form_open('admin/deliveries/add_facility', $attributes);
//
//            echo '<fieldset class="fancybox"><legend>Add New Facility</legend>';
////            echo '<p class="well">Please select a facility from the dropdown below to add it to your chosen delivery</p>';
//            echo '<label for="delivery_id">Delivery ID</label>';
//            $options = array(
//                'name' => 'delivery_id',
//                'id' => 'delivery_id',
//                'disabled' => 'true',
//                'value' => $delivery_id,
//                'readonly' => 'readonly'
//            );
//            echo form_input($options);
//            $time_opts1 = array(
//              'class' => 'time_picker',
//              'name' => 'authorization_start_time'
//            );
//            echo '<label for="authorization_start_time">Authorization Start Time</label>';
//            echo form_input($time_opts1);
//            echo '<label for="facility_id">Facility</label>';
////            echo '<div class="control-group">';
////            echo '<div class="controls">';
//              echo form_dropdown('facility_id', $options_facility, set_value('facility_id'), 'class="span3" id="facility_id"');
//            $button_class = array('class' => 'btn btn-primary');
////            echo form_submit($button_class, 'Add Facility!');
////            echo '</div>';
//          echo '</fieldset>';
//
//
//        echo '<div class="form-actions">';
//
////        echo form_submit($button_class, 'Save Changes');
//    echo '<button id="submitFacility" type="button" data-loading-text="Loading..." class="btn btn-primary">Save changes</button>';
//    echo '<a id="close-fancybox" class="btn">Cancel</a></div>';
//echo form_close();
?>
</div>
<script>
    var controller = 'deliveries';
    var base_url = '<?php echo base_url(); ?>';
    $('#rows').on('click','a.delete-facility',function(e){
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
    // update status
    $('#rows').on('click','a.update-status',function(e){
        var link_id = $(this).parent().parent().find('input[type="hidden"]').val();
        $.ajax({
            type: "POST",
            context: this,
            url: base_url + 'admin/' + controller + "/update_facility_status/" + link_id
        })
            .done(function( msg ) {
                $(this).parent().parent().addClass('success');
            });
    });
    // add facility
    $('#submitFacility').click(function(e){
        var delivery_id = $('#delivery_id').val();
        var facility_id = $('#facility_id').val();
        var start_time = $('[name="authorization_start_time"]').val();
        var end_time = $('[name="authorization_end_time"]').val();
        $.ajax({
            type: "POST",
            context: this,
            dataType: 'json',
            url: base_url + 'admin/' + controller + "/add_facility/" + delivery_id + "/" + facility_id + "/" + start_time + "/" + end_time
        })
            .done(function(data) {
                $(this).attr('disabled', true);
                $(this).text('Loading...');
                // remove current table rows
                $('.table').remove();
                // build html for each row
                $('#rows').empty();
                var table_start = "<table class=\'table table-striped'\><thead><tr><th>ID</th><th>Name</th><th>Town/City</th><th>Postcode</th><th></th><th></th></tr></thead>";
                $('#rows').append(table_start);
                $.each(data, function(key,value) {
                    $('.table').append('<tr><td>' + data[key].facility_id + '</td><td>' + data[key].facility_name + '</td><td>' + data[key].facility_locality + '</td><td>' + data[key].facility_postcode + '</td><td><a class="delete-facility btn btn-danger" href="#"><i class="fa fa-trash-o fa-lg"></i> Delete</a><input id="link_id" name="id" type="hidden" value="' + data[key].id + '"></td></tr>').show('fade',500);

                });
                var table_end = "</tbody></table>";
                $('#rows').append(table_end);
                $(this).attr('disabled',false);
                $(this).text('Save changes');
//
            });
    });
</script>