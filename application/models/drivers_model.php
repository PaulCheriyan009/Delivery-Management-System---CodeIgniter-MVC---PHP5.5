<?php
/**
 * Created by PhpStorm.
 * User: adambull
 * Date: 02/04/2014
 * Time: 19:01
 */

class Drivers_model extends CI_Model {
    public function __construct()
    {
        $this->load->database();
    }
    public function get_drivers($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
    {
        $this->db->select('drivers.driver_id');
        $this->db->select('drivers.driver_first_name');
        $this->db->select('drivers.driver_last_name');
        $this->db->select('drivers.driver_dob');
        $this->db->select('drivers.driver_phone_number');
        $this->db->select('supplier_companies.company_name');
        $this->db->from('drivers');

        $this->db->join('supplier_companies','drivers.company_id = supplier_companies.company_id','left');

        if($search_string){
            $this->db->where("CONCAT(drivers.driver_first_name, ' ', drivers.driver_last_name) LIKE '%".$search_string."%'", NULL, FALSE);
        }
        $this->db->group_by('driver_id');

        if($order){
            $this->db->order_by($order, $order_type);
        }else{
            $this->db->order_by('driver_id', $order_type);
        }

        if($limit_start && $limit_end){
            $this->db->limit($limit_start, $limit_end);
        }

        if($limit_start != null){
            $this->db->limit($limit_start, $limit_end);
        }

        $query = $this->db->get();

        return $query->result_array();
    }

    /**
     * Count the number of rows
     * @param int $search_string
     * @param int $order
     * @return int
     */
    function count_drivers($search_string=null, $order=null)
    {
        $this->db->select('*');
        $this->db->from('drivers');
        if($search_string){
            $this->db->where("CONCAT(drivers.driver_first_name, ' ', drivers.driver_last_name) LIKE '%".$search_string."%'", NULL, FALSE);
        }
        if($order){
            $this->db->order_by($order, 'Asc');
        }else{
            $this->db->order_by('driver_id', 'Asc');
        }
        $query = $this->db->get();
        return $query->num_rows();
    }
} 