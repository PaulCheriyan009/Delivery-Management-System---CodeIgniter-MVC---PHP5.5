<?php

class Users_model extends CI_Model {

    /**
    * Validate the login's data with the database
    * @param string $user_name
    * @param string $password
    * @return void
    */
	function validate($user_name, $password)
	{
		$this->db->where('user_name', $user_name);
		$this->db->where('pass_word', $password);
		$query = $this->db->get('membership');
		
		if($query->num_rows == 1)
		{
			return true;
		}		
	}

    /**
    * Serialize the session data stored in the database, 
    * store it in a new array and return it to the controller 
    * @return array
    */
	function get_db_session_data()
	{
		$query = $this->db->select('user_data')->get('ci_sessions');
		$user = array(); /* array to store the user data we fetch */
		foreach ($query->result() as $row)
		{
		    $udata = unserialize($row->user_data);
		    /* put data in array using username as key */
		    $user['user_name'] = $udata['user_name']; 
		    $user['is_logged_in'] = $udata['is_logged_in']; 
		}
		return $user;
	}
	function create_driver_member() {
        $this->db->where('user_name', $this->input->post('username'));
        $query = $this->db->get('membership');
        if($query->num_rows > 0){
            echo '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>';
            echo "Username already taken";
            echo '</strong></div>';
        } else {
            // first insert into drivers table
            $new_driver_insert_data = array(
              'driver_first_name' => $this->input->post('first_name'),
              'driver_last_name' => $this->input->post('last_name'),
              'driver_dob' => $this->input->post('date_of_birth'),
              'driver_phone_number' => $this->input->post('phone_number'),
              'company_id' => $this->input->post('company_id')
            );
            $this->db->insert('drivers',$new_driver_insert_data);
            $new_member_insert_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email_addres' => $this->input->post('email_address'),
                'user_name' => $this->input->post('username'),
                'pass_word' => md5($this->input->post('password')),
                'membership_type_id' => 4
            );
            $insert = $this->db->insert('membership', $new_member_insert_data);
            return $insert;
        }
    }
    /**
    * Store the new user's data into the database - THIS IS FOR ADMIN
    * @return boolean - check the insert
    */	
	function create_member()
	{

		$this->db->where('user_name', $this->input->post('username'));
		$query = $this->db->get('membership');

        if($query->num_rows > 0){
        	echo '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>';
			  echo "Username already taken";	
			echo '</strong></div>';
		}else{

			$new_member_insert_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'email_addres' => $this->input->post('email_address'),			
				'user_name' => $this->input->post('username'),
				'pass_word' => md5($this->input->post('password')),
                'membership_type_id' => $this->input->post('membership_type_id')
			);
			$insert = $this->db->insert('membership', $new_member_insert_data);
		    return $insert;
		}
	      
	}//create_member
    function get_all_membership_types() {
        $this->db->select('*');
        $this->db->from('membership_types');
        $this->db->where('membership_type_id != 4');
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_membership_type($user_id) {
        $this->db->select('membership_types.membership_type_id');
        $this->db->select('membership_types.membership_type_name');
        $this->db->from('membership');
        $this->db->where('id',$user_id);
        $this->db->join('membership_types', 'membership.membership_type_id = membership_types.membership_type_id', 'inner');
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_membership_type_by_user_name($name) {
        $this->db->select('membership.membership_type_id');
        $this->db->from('membership');
        $this->db->where('membership.user_name',$name);
        $query = $this->db->get();
        return $query;
    }
}

