<?php 

class Contact extends CI_Controller {

function __construct()
	 {
	   parent::__construct();
	 }
	 
public function index()
	{
		//echo 'hello universe';
		$this->contact();

	}

public function contact()
		{
            $data['main_content'] = 'frontend/view_contact';
            $this->load->view('includes/frontend_template', $data);
		}
}