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
        echo form_label('Choose a facility', 'facility_id','class="form-label"');
        echo form_dropdown('facility_id', $options_facility, 'class="form-control"');
        echo '<div id="date_panel">';
        echo form_label('Choose a date', 'date_stamp','class="form-label" id="date_stamp_label"');
        echo form_input('date_stamp','','placeholder="Please select a date"');
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