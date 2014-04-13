<style>
    <?php include 'assets/css/frontend/bookingscreen.css' ?>
</style>
<div class="container">
    <div class="row">
<div id="main">
    <h1>Find A Timeslot</h1>
    <p class="lead">
        Please use the page below to book timeslots for your chosen delivery. All timeslots last for an hour at any given facility, and timeslots do not overlap with one another.</p><p class="lead">The start of the timeslot corresponds to the start time of the delivery's authorization to the facility. The end of the timeslot corresponds to the end of the delivery's authorization at that particular facility.</p>

    <div class="filter">
        <?php
        $options_facility = array(0 => "all");
        foreach ($facilities as $row) {
            $options_facility[$row['facility_id']] = $row['facility_name'];
        }
        echo form_label('Delivery ID','delivery_id');
        $attributes = array(
            'name' => 'delivery_id',
            'value' => $delivery_id,
            'disabled' => true

        );
        $date = DateTime::createFromFormat('Y-m-d', $date_stamp[0]['date_stamp']);
        $date = $date->format('d-m-Y');
        echo form_input($attributes);
        echo form_label('Date', 'date_stamp','class="form-label" id="date_stamp_label"');
        echo form_input('date_stamp',$date,'disabled="true"');
        echo form_label('Choose a facility', 'facility_id','class="form-label"');
        echo form_dropdown('facility_id', $options_facility, 'class="form-control"');
        echo '<div id="date_panel">';
        echo '</div>';
        ?>
        <hr>
    </div>
    <div id="timeslot_results" class="results">
        <div class="loading">
            <i class="fa fa-refresh fa-spin fa-3x"></i>
        </div>
        <p class="well">
            Please choose a timeslot from the list:
        </p>
        <div class="result_inner">

        </div>
    </div>
</div>
</div>
</div>
<script>
    $('[name=facility_id]').ddslick({
        width:300,
        selectText:"Please select",
        onSelected: function(data) {
            facility_id = data.selectedData.value;
            date = $('input[name="date_stamp"]').val();
            $.ajax({
                type:'POST',
                url:'http://localhost/get-facility-timeslots/' + facility_id + '/' + date,
                dataType: 'json',
                beforeSend: function() {
                    $('.loading').show();
                    $('#timeslot_results').focus().slideDown();
                    $('.result_inner ul').remove();
                },
                success: function(data) {
                    setTimeout(function() {
                        $('.loading').hide();
                        $('#timeslot_results div.result_inner').append('<ul>');
                        $.each(data, function() {
                            $.each(this, function(k, v) {
                                $('#timeslot_results div.result_inner ul').append('<li><button class="btn btn-primary btn-lg">' + v + '</button></li>');
                            });
                        });
                        $('#timeslot_results div.result_inner').append('</ul>');
                    }, 1000);
                }
            })
        }
    });
</script>