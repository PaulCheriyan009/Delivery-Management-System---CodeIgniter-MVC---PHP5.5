<?php 

class Register extends CI_Controller {

function __construct()
	 {
	   parent::__construct();
         $this->load->model('Users_model');
	 }
	 
public function index()
	{
		$this->register();
	}

public function register()
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('firstname','FirstName','required|trim');
			$this->form_validation->set_rules('lastname','LastName','required|trim');
			$this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[membership.email_addres]|xss_clean');
			$this->form_validation->set_rules('confirmemail','Confirm Email','required|trim|matches[email]');
			$this->form_validation->set_rules('username','Username','required|trim');
			$this->form_validation->set_rules('password','Password','required|md5|trim|min_length[4]|max_length[32]');
			
			$this->form_validation->set_message('is_unique',"That email address already exist");
			
			if ($this->form_validation->run() == false){
                $data['main_content'] = 'frontend/view_register';
                $this->load->view('includes/frontend_template', $data);
			}else {
					
				$this->Users_model->create_driver_member();
                $data['main_content'] = 'frontend/view_userpage';
                $this->load->view('includes/frontend_template', $data);
				  }
		}
}	