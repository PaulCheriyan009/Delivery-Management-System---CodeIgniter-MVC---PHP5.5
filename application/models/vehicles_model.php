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
    public function get_vehicles($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
    {

        $this->db->select('*');
        $this->db->from('vehicles');
        $this->db->join('supplier_companies','vehicles.company_id = supplier_companies.company_id', 'inner');
        if($search_string){
            $this->db->like('vehicle_make', $search_string);
        }
        $this->db->group_by('vehicle_id');

        if($order){
            $this->db->order_by($order, $order_type);
        }else{
            $this->db->order_by('vehicle_id', $order_type);
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
    function count_vehicles($search_string=null, $order=null)
    {
        $this->db->select('*');
        $this->db->from('vehicles');
        if($search_string){
            $this->db->like('vehicle_make', $search_string);
        }
        if($order){
            $this->db->order_by($order, 'Asc');
        }else{
            $this->db->order_by('vehicle_id', 'Asc');
        }
        $query = $this->db->get();
        return $query->num_rows();
    }
    function delete_vehicle($id){
        $this->db->where('vehicle_id', $id);
        $this->db->delete('vehicles');
    }
} 