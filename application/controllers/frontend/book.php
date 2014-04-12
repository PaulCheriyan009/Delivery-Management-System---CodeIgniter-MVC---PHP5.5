<?php
/**
 * Created by PhpStorm.
 * User: adambull
 * Date: 12/04/2014
 * Time: 14:11
 */

class book extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('facilities_model');
        $this->load->model('deliveries_model');
    }
    function index() {
        $data['facilities'] = $this->facilities_model->get_facilities();
        $data['main_content'] = 'frontend/view_delivery_booking';
        $this->load->view('includes/frontend_template',$data);
    }
    function get_timeslots($facility_id,$date) {
        $facility_id = $this->uri->segment(2);
        $format = 'd-m-Y';
        $date = DateTime::createFromFormat($format, $this->uri->segment(3));
        if($this->input->server('REQUEST_METHOD') === 'POST') {
                $data['free_timeslots'] = $this->deliveries_model->get_free_delivery_timeslots($facility_id,$date->format('Y-m-d'));

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data['free_timeslots']));
        } else {
            redirect(base_url());
        }
    }
} 