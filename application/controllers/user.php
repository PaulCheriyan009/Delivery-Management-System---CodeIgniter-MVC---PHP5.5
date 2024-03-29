<?php

class User extends CI_Controller {

    /**
    * Check if the user is logged in, if he's not,
    * send him to the login page
    * @return void
    */
	function index()
	{
		if($this->session->userdata('is_logged_in')){
			redirect('admin/deliveries');
        } else{
        	$this->load->view('admin/login');
        }
	}

    /**
    * encript the password
    * @return mixed
    */
    function __encrip_password($password) {
        return md5($password);
    }

    /**
    * check the username and the password with the database
    * @return void
    */
	function validate_credentials()
	{

		$this->load->model('Users_model');

		$user_name = $this->input->post('user_name');
		$password = $this->__encrip_password($this->input->post('password'));

		$is_valid = $this->Users_model->validate($user_name, $password);

		if($is_valid)
		{
			$data = array(
				'user_name' => $user_name,
				'is_logged_in' => true
			);
			$this->session->set_userdata($data);

            // default view redirect
			redirect('admin/dashboard');
		}
		else // incorrect username or password
		{
			$data['message_error'] = TRUE;
			$this->load->view('admin/login', $data);
		}
	}
    function validate_frontend_credentials()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        $this->load->model('Users_model');

        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));

        $is_valid = $this->Users_model->validate_frontend($email, $password);

        if($is_valid)
        {
            $user_id = $this->Users_model->get_user_id_by_email_address($this->input->post('email'));
            $driver_id = $this->Users_model->get_driver_id($user_id);
            $first_name = $this->Users_model->get_user_first_name($user_id);
            $data = array(
                'is_logged_in' => true,
                'user_id' => $user_id,
                'driver_id' => $driver_id,
                'first_name' => $first_name
            );
            $this->session->set_userdata($data);

            // default view redirect
            redirect(base_url());
        } else // incorrect username or password
        {
            $data['message_error'] = TRUE;
            $data['main_content'] = 'frontend/view_login';
            $this->load->view('includes/frontend_template', $data);
        }
        // non HTTP $_POST stuff
        } else {
            $data['main_content'] = 'frontend/view_login';
            $this->load->view('includes/frontend_template',$data);
        }

    }
    /**
    * The method just loads the signup view
    * @return void
    */
	function signup()
	{
        $this->load->model('Users_model');
        $data['membership_types'] = $this->Users_model->get_all_membership_types();
		$this->load->view('admin/signup_form', $data);
	}


    /**
    * Create new user and store it in the database
    * @return void
    */
	function create_member()
	{
		$this->load->library('form_validation');

		// field name, error message, validation rules
		$this->form_validation->set_rules('first_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email_addres', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/signup_form');
		}

		else
		{
			$this->load->model('Users_model');

			if($query = $this->Users_model->create_member())
			{
				$this->load->view('admin/signup_successful');
			}
			else
			{
				$this->load->view('admin/signup_form');
			}
		}

	}
    function create_driver_member()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('firstname','First Name','required|trim');
        $this->form_validation->set_rules('lastname','Last Name','required|trim');
        $this->form_validation->set_rules('phonenumber','Phone Number','required|trim');
        $this->form_validation->set_rules('driver_date_of_birth','Date of Birth','required');
        $this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[membership.email_addres]|xss_clean');
        $this->form_validation->set_rules('confirmemail','Confirm Email','required|trim|matches[email]');
        $this->form_validation->set_rules('username','Username','required|trim');
        $this->form_validation->set_rules('company_id_hdn','Company','required|trim');
        $this->form_validation->set_rules('password','Password','required|trim|min_length[4]|max_length[32]');

        $this->form_validation->set_message('is_unique',"That email address already exists");
//        $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

        if ($this->form_validation->run() == false){
            $this->load->model('suppliers_model');
            $data['companies'] = $this->suppliers_model->get_suppliers();
            $data['main_content'] = 'frontend/view_register';
            $this->load->view('includes/frontend_template', $data);
        }
        else
        {
            $this->load->model('Users_model');

            if($query = $this->Users_model->create_driver_member())
            {
                $user_id = $this->Users_model->get_user_id_by_email_address($this->input->post('email'));
                $driver_id = $this->Users_model->get_driver_id($user_id);
                $first_name = $this->Users_model->get_user_first_name($user_id);
                $data = array(
                    'is_logged_in' => true,
                    'user_id' => $user_id,
                    'driver_id' => $driver_id,
                    'first_name' => $first_name
                );
                $this->session->set_userdata($data);
//                $data['main_content'] = 'frontend/view_delivery_listing';
//                $this->load->view('includes/frontend_template', $data);
                redirect(base_url());
            }
        }

    }
	/**
    * Destroy the session, and logout the user.
    * @return void
    */
	function logout()
	{
		$this->session->sess_destroy();
		redirect('admin');
	}
    function logout_frontend()
    {
        $this->session->sess_destroy();
        redirect('');
    }
    function unauthorized_access() {
        $this->load->view('admin/error_unauthorized');
    }
}