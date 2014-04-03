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
} 