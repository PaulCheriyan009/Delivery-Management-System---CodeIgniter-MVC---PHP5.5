<?php 

class Home extends CI_Controller {

function __construct()
	 {
	   parent::__construct();
	 }
	 
public function index()
	{
		$this->main();
		//echo 'hello universe';
		
	}	
		
		
		public function main(){
            $data['main_content'] = 'frontend/view_index';
            $this->load->view('includes/frontend_template', $data);
		
		}
		
		public function logout(){
			$this->session->sess_destroy();
			redirect('home');
		
		}
		
	
		
}