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
        $this->load->model('suppliers_model');
        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
    }
    public function index() {
        $this->output->enable_profiler(TRUE);
        //all the posts sent by the view
        $search_string = $this->input->post('search_string');
        $order = $this->input->post('order');
        $order_type = $this->input->post('order_type');

        //pagination settings
        $config['per_page'] = 5;

        $config['base_url'] = base_url().'admin/drivers';
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
            $data['count_drivers']= $this->drivers_model->count_drivers($search_string, $order);
            $config['total_rows'] = $data['count_deliveries'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['drivers'] = $this->drivers_model->get_drivers($search_string, $order, $order_type, $config['per_page'],$limit_end);
                }else{
                    $data['drivers'] = $this->drivers_model->get_drivers($search_string, '', $order_type, $config['per_page'],$limit_end);
                }
            }else{
                if($order){
                    $data['drivers'] = $this->drivers_model->get_drivers('', $order, $order_type, $config['per_page'],$limit_end);
                }else{
                    $data['drivers'] = $this->drivers_model->get_drivers('', '', $order_type, $config['per_page'],$limit_end);
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['driver_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_drivers']= $this->drivers_model->count_drivers();
            $data['suppliers'] = $this->suppliers_model->get_suppliers('', '', $order_type, $config['per_page'],$limit_end);
            $data['drivers'] = $this->drivers_model->get_drivers('', '', $order_type, $config['per_page'],$limit_end);
            $config['total_rows'] = $data['count_drivers'];

        }//!isset($search_string) && !isset($order)

        //initializate the panination helper
        $this->pagination->initialize($config);

        //load the view
        $data['main_content'] = 'admin/drivers/list';
        $this->load->view('includes/template', $data);

    }
    public function delete($driver_id) {
        $driver_id = $this->uri->segment(4);
        $this->drivers_model->delete_driver($driver_id);
        redirect('admin/drivers');
    }

} 