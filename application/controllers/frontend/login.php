<?php 

class Login extends CI_Controller {

function __construct()
	 {
	   parent::__construct();

	 }
	 
public function index()
	{
		//echo 'hello universe';
		$this->login();
	}

public function login()
		{
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('email','Email','required|trim|xss_clean');
			$this->form_validation->set_rules('password','Password','required|md5|trim|callback_validate_credentials');
				if ($this->form_validation->run()){
					$data = array(
						'email_addres'=> $this->input->post('email'),
						'pass_word'=> $this->input->post('password'),
						'is_logged_in'=> 1
					);
					$this->session->set_userdata($data);
					$this->load->view('view_userpage');
    
			} else{
					$this->load->view('view_login');

				  }
		}
		
		public function userpage(){
		
			if ($this->session->userdata('is_logged_in')){
				$this->load->view('view_userpage');
			}else{redirect('login/loginAgain');}
		}
		
		public function loginAgain(){
			$this->load->view('view_login');
		}
		
		
		public function validate_credentials(){
			$this->load->model('model_users');
			
			if ($this->model_users->can_log_in()){
				return true;
			} else {
					$this->form_validation->set_message('validate_credentials','Incorrect email or password');
					return false;
					}
		
		}
		

}