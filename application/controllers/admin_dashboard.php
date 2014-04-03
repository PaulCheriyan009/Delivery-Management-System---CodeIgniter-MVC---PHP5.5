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
//        $this->load->model('facilities_model');

        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
    }
    public function index() {
//        $this->output->enable_profiler(TRUE);
        // load custom dashboard pg into view
        $data['main_content'] = 'admin/dashboard/index';
        $data['todays_delivery_count'] = $this->deliveries_model->get_todays_deliveries_count();

        $data['new_deliveries'] = $this->deliveries_model->get_todays_new_deliveries();
        $this->load->view('includes/template', $data);
    }
} 