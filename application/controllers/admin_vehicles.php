<?php
/**
 * Created by PhpStorm.
 * User: adambull
 * Date: 02/04/2014
 * Time: 16:43
 */

class Admin_vehicles extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
//        $this->load->model('deliveries_model');
//        $this->load->model('facilities_model');
        $this->load->model('vehicles_model');
        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
    }
    public function index() {

    }

    public function get_vehicle_by_registration($search_string) {
        $keyword = $this->input->post('term');
        $data['response'] = 'false'; //Set default response
        $query = $this->vehicles_model->get_vehicles_by_registration($keyword); //Search DB
        if( ! empty($query) )
        {
            $data['response'] = 'true'; //Set response
            $data['message'] = array(); //Create array
            foreach( $query as $row )
            {
                $data['message'][] = array(
                    'value'=>$row['vehicle_id'],
                    'key' => $row['vehicle_make'].' '.$row['vehicle_model'].' ('.$row['vehicle_year_of_production'].') - '.$row['vehicle_registration']
                );  //Add a row to array
            }
        }
        if('IS_AJAX')
        {
            echo json_encode($data); //echo json string if ajax request

        }
        else
        {
            $this->load->view('autocomplete/index',$data); //Load html view of search results
        }
    }
}