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
        $this->load->model('suppliers_model');
        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
    }
    public function index()
    {

        //all the posts sent by the view
        $search_string = $this->input->post('search_string');
        $order = $this->input->post('order');
        $order_type = $this->input->post('order_type');

        //pagination settings
        $config['per_page'] = 5;

        $config['base_url'] = base_url().'admin/suppliers';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';

        //limit end
        $page = $this->uri->segment(3);

        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        }

        //if order type was changed
        if($order_type){
            $filter_session_data['order_type'] = $order_type;
        }
        else{
            //we have something stored in the session?
            if($this->session->userdata('order_type')){
                $order_type = $this->session->userdata('order_type');
            }else{
                //if we have nothing inside session, so it's the default "Asc"
                $order_type = 'Asc';
            }
        }
        //make the data type var avaible to our view
        $data['order_type_selected'] = $order_type;


        //we must avoid a page reload with the previous session data
        //if any filter post was sent, then it's the first time we load the content
        //in this case we clean the session filter data
        //if any filter post was sent but we are in some page, we must load the session data

        //filtered && || paginated
        if($search_string !== false && $order !== false || $this->uri->segment(3) == true){

            /*
            The comments here are the same for line 79 until 99

            if post is not null, we store it in session data array
            if is null, we use the session data already stored
            we save order into the the var to load the view with the param already selected
            */
            if($search_string){
                $filter_session_data['search_string_selected'] = $search_string;
            }else{
                $search_string = $this->session->userdata('search_string_selected');
            }
            $data['search_string_selected'] = $search_string;

            if($order){
                $filter_session_data['order'] = $order;
            }
            else{
                $order = $this->session->userdata('order');
            }
            $data['order'] = $order;

            //save session data into the session
            if(isset($filter_session_data)){
                $this->session->set_userdata($filter_session_data);
            }

            //fetch sql data into arrays
            $data['count_vehicles']= $this->vehicles_model->count_vehicles($search_string, $order);
            $config['total_rows'] = $data['count_vehicles'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['vehicles'] = $this->vehicles_model->get_vehicles($search_string, $order, $order_type, $config['per_page'],$limit_end);
                }else{
                    $data['vehicles'] = $this->vehicles_model->get_vehicles($search_string, '', $order_type, $config['per_page'],$limit_end);
                }
            }else{
                if($order){
                    $data['vehicles'] = $this->vehicles_model->get_vehicles('', $order, $order_type, $config['per_page'],$limit_end);
                }else{
                    $data['vehicles'] = $this->vehicles_model->get_vehicles('', '', $order_type, $config['per_page'],$limit_end);
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['vehicle_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_vehicles']= $this->vehicles_model->count_vehicles();
            $data['vehicles'] = $this->vehicles_model->get_vehicles('', '', $order_type, $config['per_page'],$limit_end);
            $config['total_rows'] = $data['count_vehicles'];

        }//!isset($search_string) && !isset($order)

        //initializate the panination helper
        $this->pagination->initialize($config);

        //load the view
        $data['main_content'] = 'admin/vehicles/list';
        $this->load->view('includes/template', $data);

    }//index

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

    public function update($vehicle_id) {

        $vehicle_id = $this->uri->segment(4);
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
            $this->form_validation->set_rules('vehicle_registration', 'Registration', 'required');
            $this->form_validation->set_rules('vehicle_make', 'Make', 'required');
            $this->form_validation->set_rules('vehicle_model', 'Model', 'required');
            $this->form_validation->set_rules('vehicle_year_of_production', 'Year of Production', 'required');
            $this->form_validation->set_rules('company_id','Company','required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            if ($this->form_validation->run())
            {
                $data_to_store = array(
                  'vehicle_registration' => $this->input->post('vehicle_registration'),
                  'vehicle_make' => $this->input->post('vehicle_make'),
                  'vehicle_model' => $this->input->post('vehicle_model'),
                  'vehicle_year_of_production' => $this->input->post('vehicle_year_of_production'),
                  'company_id' => $this->input->post('company_id')
                );
                if($this->vehicles_model->update_vehicle($vehicle_id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
            }
        }
        $data['companies'] = $this->suppliers_model->get_suppliers();
        $data['vehicle'] = $this->vehicles_model->get_vehicle_by_id($vehicle_id);
        $data['main_content'] = 'admin/vehicles/edit';
        $this->load->view('includes/template',$data);
    }

    public function add() {
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $this->form_validation->set_rules('vehicle_registration', 'Registration', 'required');
            $this->form_validation->set_rules('vehicle_make', 'Make', 'required');
            $this->form_validation->set_rules('vehicle_model', 'Model', 'required');
            $this->form_validation->set_rules('vehicle_year_of_production', 'Year of Production', 'required');
            $this->form_validation->set_rules('company_id','Company','required');
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                    'vehicle_registration' => $this->input->post('vehicle_registration'),
                    'vehicle_make' => $this->input->post('vehicle_make'),
                    'vehicle_model' => $this->input->post('vehicle_model'),
                    'vehicle_year_of_production' => $this->input->post('vehicle_year_of_production'),
                    'company_id' => $this->input->post('company_id')
                );
                if($this->vehicles_model->store_vehicle($data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
            }

        }
        $data['companies'] = $this->suppliers_model->get_suppliers();
        $data['main_content'] = 'admin/vehicles/add';
        $this->load->view('includes/template',$data);
    }
    public function delete($vehicle_id){
        $vehicle_id = $this->uri->segment(4);
        $this->vehicles_model->delete_vehicle($vehicle_id);
        redirect('admin/vehicles');
    }
}