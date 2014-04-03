<?php
class Admin_deliveries extends CI_Controller {
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('deliveries_model');
        $this->load->model('facilities_model');

        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
    }
 
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {
        // enable sql profiler
        $this->output->enable_profiler(TRUE);
        //all the posts sent by the view
        $facility_id = $this->input->post('facility_id');
        $search_string = $this->input->post('search_string');        
        $order = $this->input->post('order'); 
        $order_type = $this->input->post('order_type'); 

        //pagination settings
        $config['per_page'] = 5;
        $config['base_url'] = base_url().'admin/deliveries';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
//        $config['next_link'] = '<li><a href="#">&raquo;</a></li>';
//        $config['prev_link'] = '<li><a href="#">&laquo;</a></li>';
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
        if($facility_id !== false && $search_string !== false && $order !== false || $this->uri->segment(3) == true){
           
            /*
            The comments here are the same for line 79 until 99

            if post is not null, we store it in session data array
            if is null, we use the session data already stored
            we save order into the the var to load the view with the param already selected       
            */

            if($facility_id !== 0){
                $filter_session_data['facility_selected'] = $facility_id;
            }else{
                $facility_id = $this->session->userdata('facility_selected');
            }
            $data['facility_selected'] = $facility_id;

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
            $this->session->set_userdata($filter_session_data);

            //fetch facilities data into arrays
            $data['facilities'] = $this->facilities_model->get_facilities();

            $data['count_deliveries']= $this->deliveries_model->count_deliveries($facility_id, $search_string, $order);
            $config['total_rows'] = $data['count_deliveries'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['deliveries'] = $this->deliveries_model->get_deliveries($facility_id, $search_string, $order, $order_type, $config['per_page'],$limit_end);
                }else{
                    $data['deliveries'] = $this->deliveries_model->get_deliveries($facility_id, $search_string, '', $order_type, $config['per_page'],$limit_end);
                }
            }else{
                if($order){
                    $data['deliveries'] = $this->deliveries_model->get_deliveries($facility_id, '', $order, $order_type, $config['per_page'],$limit_end);
                }else{
                    $data['deliveries'] = $this->deliveries_model->get_deliveries($facility_id, '', '', $order_type, $config['per_page'],$limit_end);
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['facility_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['facility_selected'] = 0;
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['facilities'] = $this->facilities_model->get_facilities();
            $data['count_deliveries']= $this->deliveries_model->count_deliveries();
            $data['deliveries'] = $this->deliveries_model->get_deliveries('', '', '', $order_type, $config['per_page'],$limit_end);
            $config['total_rows'] = $data['count_deliveries'];

        }//!isset($facility_id) && !isset($search_string) && !isset($order)

        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/deliveries/list';
        $this->load->view('includes/template', $data);  

    }//index


    public function add_facility($delivery_id=null, $facility_id=null) {
//        $this->output->enable_profiler(TRUE);
        if($this->uri->segment(5) === FALSE) {
            // display form
            $delivery_id = $this->uri->segment(4);
            //fetch facility data to populate the select field
            $data['facilities'] = $this->facilities_model->get_facilities();
            $data['delivery_info'] = $this->deliveries_model->get_delivery_with_facility($delivery_id);
            $data['delivery_id'] = $delivery_id;
            $data['main_content'] = 'admin/deliveries/add_facility';
            $this->load->view('includes/ajax', $data);
        } else {
            // do logic relating to insert
            if ($this->input->server('REQUEST_METHOD') === 'POST') {
                    $data_to_store = array(
                        'delivery_id' => $this->uri->segment(4),
                        'facility_id' => $this->uri->segment(5)
                    );
                    if($this->deliveries_model->add_facility_to_existing_delivery($data_to_store)){
                        $data['flash_message'] = TRUE;
                        $data['returned_results'] = $this->deliveries_model->get_delivery_with_facility($this->uri->segment(4));
                        $data['main_content'] = 'admin/deliveries/list/'.$this->uri->segment(4).'/'.$this->uri->segment(5);
                        $this->load->view('includes/ajax',$data, true);
                    }else{
                        $data['flash_message'] = FALSE;
                    }
            }
        }
    }
    public function delete_facility($id) {
//        print('test');
        if($this->input->server('REQUEST_METHOD') === 'POST') {
            $linking_id = $this->uri->segment(4);

            $this->deliveries_model->delete_facility_from_existing_delivery($linking_id);
        }
    }

    function valid_date($str)
    {
        if ( ereg("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", $str) ) {
            $arr = split("-",$str);     // splitting the array
            $yy = $arr[0];            // first element of the array is year
            $mm = $arr[1];            // second element is month
            $dd = $arr[2];            // third element is days
            return ( checkdate($mm, $dd, $yy) );
        } else {
            return FALSE;
        }
    }
    public function validate_time($str)
    {
//Assume $str SHOULD be entered as HH:MM

        list($hh, $mm) = preg_split('[:]', $str);

        if (!is_numeric($hh) || !is_numeric($mm))
        {
            $this->form_validation->set_message('validate_time', 'Not numeric');
            return FALSE;
        }
        else if ((int) $hh > 24 || (int) $mm > 59)
        {
            $this->form_validation->set_message('validate_time', 'Invalid time');
            return FALSE;
        }
        else if (mktime((int) $hh, (int) $mm) === FALSE)
        {
            $this->form_validation->set_message('validate_time', 'Invalid time');
            return FALSE;
        }

        return TRUE;
    }
    public function add()
    {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
            //form validation
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('date_stamp', 'Date', 'required|callback_validdate');
            $this->form_validation->set_rules('time_stamp', 'Time', 'required|trim|min_length[3]|max_length[5]|callback_validate_time');
            $this->form_validation->set_rules('vehicle_id', 'Vehicle ID', 'required|numeric');
            $this->form_validation->set_rules('status_id', 'Status', 'required');
            $this->form_validation->set_rules('driver_id','driver_id','required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $date_to_format_to_mysql_time = $this->input->post('date_stamp');
                $db_date = DateTime::createFromFormat('d-m-Y', $date_to_format_to_mysql_time);
                $data_to_store = array(
                    'date_stamp' => $db_date->format('Y-m-d'),
                    'time_stamp' => $this->input->post('time_stamp'),
                    'driver_id' => $this->input->post('driver_id'),
                    'vehicle_id' => $this->input->post('vehicle_id'),
                    'status_id' => $this->input->post('status_id'),
                    'driver_id' => $this->input->post('driver_id')
                );
                //if the insert has returned true then we show the flash message
                if($this->deliveries_model->store_deliveries($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }
            }

        }
        //fetch facilities data to populate the select field
        $data['status'] = $this->deliveries_model->get_all_delivery_statuses();
        $data['facility'] = $this->facilities_model->get_facilities();
        //load the view
        $data['main_content'] = 'admin/deliveries/add';
        $this->load->view('includes/template', $data);
//        redirect('admin/deliveries');
    }       

    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        $this->output->enable_profiler(TRUE);
        //deliveryid
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('date_stamp', 'Date', 'required|callback_validdate');
            $this->form_validation->set_rules('time_stamp', 'Time', 'required|trim|min_length[3]|max_length[5]|callback_validate_time');
            $this->form_validation->set_rules('vehicle_id', 'Vehicle ID', 'required|numeric');
//            $this->form_validation->set_rules('facility_id', 'Facility ID', 'required');
            $this->form_validation->set_rules('driver_id','driver_id','required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $date_to_format_to_mysql_time = $this->input->post('date_stamp');
                $db_date = DateTime::createFromFormat('d-m-Y', $date_to_format_to_mysql_time);
                $data_to_store = array(
                    'description' => $this->input->post('description'),
                    'date_stamp' => $db_date->format('Y-m-d'),
                    'time_stamp' => $this->input->post('time_stamp'),
                    'vehicle_id' => $this->input->post('vehicle_id'),
                    'driver_id' => $this->input->post('driver_id')
                );
                //if the insert has returned true then we show the flash message
                if($this->deliveries_model->update_delivery($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
//                redirect('admin/deliveries/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //delivery data
        $data['status'] = $this->deliveries_model->get_all_delivery_statuses();
        $data['delivery'] = $this->deliveries_model->get_delivery_by_id($id);
        //fetch facility data to populate the select field
        $data['facilities'] = $this->facilities_model->get_facilities();
        //load the view
        $data['main_content'] = 'admin/deliveries/edit';
        $this->load->view('includes/template', $data);            

    }//update

    /**
    * Delete delivery by his id
    * @return void
    */
    public function delete()
    {
        //delivery id
        $id = $this->uri->segment(4);
        $this->deliveries_model->delete_delivery($id);
        redirect('admin/deliveries');
    }//edit
}