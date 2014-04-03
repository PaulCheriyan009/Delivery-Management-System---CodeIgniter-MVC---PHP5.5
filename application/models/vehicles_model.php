<?php
/**
 * Created by PhpStorm.
 * User: adambull
 * Date: 02/04/2014
 * Time: 16:48
 */

class Vehicles_model extends CI_Model {
    public function __construct()
    {
        $this->load->database();
    }
    public function get_vehicles_by_registration($search_string) {
        $this->db->select('*');
        $this->db->from('vehicles');
        $this->db->like('vehicle_registration',$search_string);
        $query = $this->db->get();
        return $query->result_array();
    }
} 