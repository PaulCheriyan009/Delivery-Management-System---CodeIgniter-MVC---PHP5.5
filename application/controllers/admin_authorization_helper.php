<?php
/**
 * Created by PhpStorm.
 * User: adambull
 * Date: 07/04/2014
 * Time: 20:10
 */
/* This class helps to "spoof" the different events regarding booking of deliveries
*/
class Admin_authorization_helper extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('deliveries_model');
//        $this->load->model('facilities_model');

        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
    }
} 