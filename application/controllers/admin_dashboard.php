<?php
/**
 * Created by PhpStorm.
 * User: adambull
 * Date: 30/03/2014
 * Time: 03:05
 */

class Admin_dashboard extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('deliveries_model');

        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
    }
    public function index() {
        // load custom dashboard pg into view
        $data['main_content'] = 'admin/dashboard/index';
        $data['in_progress_count'] = $this->deliveries_model->get_deliveries_by_status_count(2);
        $data['booked_deliveries'] = $this->deliveries_model->get_deliveries_by_status(1);
        $data['expired_deliveries'] = $this->deliveries_model->get_deliveries_by_status(4);
        $data['in_progress_deliveries'] = $this->deliveries_model->get_deliveries_by_status(2);
        $this->load->view('includes/template', $data);
    }
    public function get_delivery_count_by_date_range($start_date,$end_date) {
        $start_date = $this->uri->segment(4);
        $end_date = $this->uri->segment(5);
        $data['delivery_count'] = $this->deliveries_model->get_delivery_counts_day_view($start_date,$end_date);
        $this->output->set_content_type('application/json')
            ->set_output(json_encode($data['delivery_count']));
    }
    public function update_status($delivery_id,$status_id) {
        $delivery_id = $this->uri->segment(4);
        $status_id = $this->uri->segment(5);
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $data_to_store = array(
                'status_id' => $status_id
            );
            $this->deliveries_model->update_delivery($delivery_id,$data_to_store);
        } else {
            redirect(site_url('admin'));
        }
    }
} 