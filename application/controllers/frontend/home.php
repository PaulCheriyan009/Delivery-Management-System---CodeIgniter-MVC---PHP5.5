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
		
			$this->load->view('frontend/view_index');
		
		}
		
		public function logout(){
			$this->session->sess_destroy();
			redirect('home');
		
		}
		
	
		
}