<?php

class Model_users extends CI_Model {

	public function can_log_in(){
		$this->db->where('email_addres',$this->input->post('email'));
		$this->db->where('pass_word',md5($this->input->post('password')));
		
		$query = $this->db->get('membership');
		
		if($query->num_rows() == 1){
			return true;
		}else{return false;}
	}
	
	 public function add_user()
 {
  $data =array(
	'first_name'=>$this->input->post('firstname'),
    'last_name'=>$this->input->post('lastname'),
    'email_addres'=>$this->input->post('email'),
	'user_name'=>$this->input->post('username'),
    'pass_word'=>($this->input->post('password'))
  );
  $this->db->insert('membership',$data);
 }

}