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
			$this->load->view('view_contact');
		}
}