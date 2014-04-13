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
    function index($delivery_id) {
        $delivery_id = $this->uri->segment(2);
        $data['facilities'] = $this->facilities_model->get_facilities();
        $data['main_content'] = 'frontend/view_delivery_booking';
        $data['delivery_id'] = $delivery_id;
        $data['date_stamp'] = $this->deliveries_model->get_date_of_delivery($delivery_id);
        $this->load->view('includes/frontend_template',$data);
    }
    function delivery_listing() {
        $data['user_id'] = $this->session->userdata['user_id'];
        $data['driver_id'] = $this->session->userdata['driver_id'];
        $driver_id = $this->session->userdata['driver_id'];
        $data['deliveries'] = $this->deliveries_model->get_deliveries_for_driver($driver_id);
        $data['main_content'] = 'frontend/view_delivery_listing';
        $this->load->view('includes/frontend_template',$data);
    }
    function create_delivery() {
        $data['main_content'] = 'frontend/view_delivery_creation';
        $this->load->view('includes/frontend_template',$data);
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            $dateformat = DateTime::createFromFormat('d-m-Y',$this->input->post('date_stamp'));
            $data_to_store = array(
              'vehicle_id' => $_POST['vehicle_id'],
              'date_stamp' => $dateformat->format('Y-m-d'),
              'status_id' => $_POST['status_id'],
              'driver_id' => $_POST['driver_id']
            );
            $this->deliveries_model->store_deliveries($data_to_store);
            redirect(base_url().'your-deliveries');
        }
    }
    function add_timeslot($delivery_id,$facility_id,$date,$time) {
        if($this->input->server('REQUEST_METHOD') === 'POST') {
            $delivery_id = $this->uri->segment(2);
            $facility_id = $this->uri->segment(3);
            $date = DateTime::createFromFormat('d-m-Y', $this->uri->segment(4));
            $time = $this->uri->segment(5);
            $data_to_store = array(
                'delivery_id' => $delivery_id,
                'facility_id' => $facility_id,
                'date_stamp' => $date->format('Y-m-d'),
                'start_time' => $time
            );
            $this->deliveries_model->add_facility_to_existing_delivery($data_to_store);
        } else {
            $this->output->set_status_header('401');
        }

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
            $this->output->set_status_header('401');
        }
    }
} 