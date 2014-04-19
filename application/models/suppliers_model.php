<?php
/**
 * Created by PhpStorm.
 * User: adambull
 * Date: 01/04/2014
 * Time: 19:43
 */

class Suppliers_model extends CI_Model {
    public function __construct()
    {
        $this->load->database();
    }
    public function get_suppliers($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
    {

        $this->db->select('*');
        $this->db->from('supplier_companies');

        if($search_string){
            $this->db->like('company_name', $search_string);
        }
        $this->db->group_by('company_id');

        if($order){
            $this->db->order_by($order, $order_type);
        }else{
            $this->db->order_by('company_id', $order_type);
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
    function count_suppliers($search_string=null, $order=null)
    {
        $this->db->select('*');
        $this->db->from('supplier_companies');
        if($search_string){
            $this->db->like('company_name', $search_string);
        }
        if($order){
            $this->db->order_by($order, 'Asc');
        }else{
            $this->db->order_by('company_id', 'Asc');
        }
        $query = $this->db->get();
        return $query->num_rows();
    }
    function store_supplier($data_to_store) {
        $insert = $this->db->insert('supplier_companies', $data_to_store);
        return $insert;
    }
    function update_supplier($supplier_id,$data_to_store) {
        $this->db->set($data_to_store);
        $this->db->where('suppliers_table.vehicle_id', $supplier_id);
        $this->db->update('supplier_companies as suppliers_table');

        $report = array();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        if($report !== 0){
            return true;
        }else{
            return false;
        }
    }
    function delete_supplier($id){
        $this->db->where('company_id', $id);
        $this->db->delete('vehicles');
        $this->db->where('company_id', $id);
        $this->db->delete('supplier_companies');
    }
    function get_supplier_name($supplier_id) {
        $this->db->select('company_name');
        $this->db->from('supplier_companies');
        $this->db->where('company_id',$supplier_id);
        $query = $this->db->get();
        return $query->row()->company_name;
    }
    function list_vehicles($supplier_id) {
        $this->db->select('*');
        $this->db->from('vehicles');
        $this->db->where('company_id',$supplier_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    function list_drivers($supplier_id) {
        $this->db->select('*');
        $this->db->from('drivers');
        $this->db->where('company_id',$supplier_id);
        $query = $this->db->get();
        return $query->result_array();
    }
} 