<?php 

class Login extends CI_Controller {

function __construct()
	 {
	   parent::__construct();
       $this->load->model('users_model');
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
                    $data['main_content'] = 'frontend/view_userpage';
                    $this->load->view('includes/frontend_template', $data);
    
			} else{
                    $data['main_content'] = 'frontend/view_login';
                    $this->load->view('includes/frontend_template', $data);;

				  }
		}
		
		public function userpage(){
		
			if ($this->session->userdata('is_logged_in')){
                $data['main_content'] = 'frontend/view_userpage';
                $this->load->view('includes/frontend_template', $data);
			} else {
                redirect('login/loginAgain');
            }
		}
		
		public function loginAgain(){
            $data['main_content'] = 'frontend/view_login';
            $this->load->view('includes/frontend_template', $data);
		}
		
		
		public function validate_credentials(){
//			$this->load->model('model_users');
			
			if ($this->users_model->can_log_in()){
				return true;
			} else {
					$this->form_validation->set_message('validate_credentials','Incorrect email or password');
					return false;
					}
		
		}
		

}