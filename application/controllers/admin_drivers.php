<?php
/**
 * Created by PhpStorm.
 * User: adambull
 * Date: 02/04/2014
 * Time: 19:01
 */

class Admin_drivers extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('drivers_model');

        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
    }
    public function index() {
        $data['main_content'] = 'admin/drivers/list';
        $this->load->view('includes/template', $data);
    }
} 