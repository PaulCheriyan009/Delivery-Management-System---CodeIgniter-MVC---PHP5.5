<?php
class Tests extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('unit_test');
        // load all models

        $this->load->model('deliveries_model');
        $this->load->model('drivers_model');
    }
    public function index() {
        // define & set unit test output template
        $template = '
        <table class="table table-striped">
            {rows}
                <tr>
                <td>{item}</td>
                <td>{result}</td>
                </tr>
            {/rows}
        </table>';

        $this->unit->set_template($template);

        // runs all tests with output on screen

        $this->unit->run($this->deliveries_model->get_todays_deliveries_count(),'is_int','Todays delivery count function returns an integer');
        $this->unit->run($this->deliveries_model->get_date_of_delivery(37),'is_array','get_date_of_delivery($delivery_id) returns array');

        $this->unit->run($this->deliveries_model->get_todays_new_deliveries(), 'is_array','get_todays_new_deliveries() function returns an array');
        $this->unit->run($this->deliveries_model->get_free_delivery_timeslots(6,'2014-04-04'),'is_array','get_free_delivery_timeslots($facility_id,$date_stamp) returns an array of timeslots');

        $this->unit->run($this->deliveries_model->get_facility_count_for_delivery(37),'is_numeric','get_facility_count_for_delivery($delivery_id) should return a numeric value');

        $this->unit->run($this->deliveries_model->count_deliveries(),'is_int','count_deliveries() should return an integer');


        // finally load appropriate view
        $this->load->view('unit_tests');
    }
} 