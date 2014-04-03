<?php
class Deliveries_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function add_facility_to_existing_delivery($data) {
        // add record to intersection table
        $insert = $this->db->insert('delivery_facility_link', $data);
        return $insert;
    }
    public function delete_facility_from_existing_delivery($delivery_facility_link_id) {
        $this->db->where('id', $delivery_facility_link_id);
        $this->db->delete('delivery_facility_link');
    }
    public function get_todays_deliveries_count() {
        $this->db->select('deliveries.delivery_id');
        $this->db->from('deliveries');
        $this->db->where('deliveries.date_stamp = "'.date('Y-m-d').'"');
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function get_todays_new_deliveries() {
        $this->db->select('*');
        $this->db->from('deliveries');
        $this->db->where('deliveries.date_stamp = "'.date('Y-m-d').'"');
        $this->db->join('delivery_facility_link','deliveries.delivery_id = delivery_facility_link.delivery_id','left');
        $this->db->join('facilities','delivery_facility_link.facility_id = facilities.facility_id','left');
        $this->db->group_by('deliveries.delivery_id');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_delivery_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('deliveries');
		$this->db->where('deliveries.delivery_id', $id);
        $this->db->join('vehicles','deliveries.vehicle_id = vehicles.vehicle_id','inner');
		$query = $this->db->get();
		return $query->result_array();
    }
    public function get_delivery_with_facility($id) {
        $this->db->select('*');
        $this->db->from('deliveries');
        $this->db->where('deliveries.delivery_id', $id);
        $this->db->join('delivery_facility_link','deliveries.delivery_id = delivery_facility_link.delivery_id','inner');
        $this->db->join('facilities','delivery_facility_link.facility_id = facilities.facility_id','inner');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_deliveries($facility_id=null, $search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    
//		$this->db->select('*');
        $this->db->select('deliveries.delivery_id');
		$this->db->select('deliveries.date_stamp');
		$this->db->select('deliveries.time_stamp');
		$this->db->select('deliveries.driver_id');
		$this->db->select('deliveries.vehicle_id');
        $this->db->select('deliveries.description');
        $this->db->select('delivery_statuses.status_name');
        $this->db->select('delivery_statuses.status_id');
        $this->db->select('deliveries.status_id');
		$this->db->select('facilities.facility_id');
        $this->db->select('facilities.facility_name');
        $this->db->select('drivers.driver_first_name');
        $this->db->select('drivers.driver_last_name');
        $this->db->select('vehicles.vehicle_registration');
		$this->db->from('deliveries');
		if($facility_id != null && $facility_id != 0){
			$this->db->where('facilities.facility_id', $facility_id);
		}
		if($search_string){
			$this->db->like('description', $search_string);
		}

        // joins
        $this->db->join('vehicles','deliveries.vehicle_id = vehicles.vehicle_id','inner');
        $this->db->join('drivers', 'deliveries.driver_id = drivers.driver_id', 'left');
        $this->db->join('delivery_statuses', 'deliveries.status_id = delivery_statuses.status_id', 'left');
		$this->db->join('delivery_facility_link', 'deliveries.delivery_id = delivery_facility_link.delivery_id', 'left');
        $this->db->join('facilities', 'delivery_facility_link.facility_id = facilities.facility_id', 'left');


		$this->db->group_by('deliveries.delivery_id');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('deliveries.delivery_id', $order_type);
		}


		$this->db->limit($limit_start, $limit_end);
		//$this->db->limit('4', '4');


		$query = $this->db->get();
		
		return $query->result_array(); 	
    }

    function count_deliveries($facility_id=null, $search_string=null, $order=null)
    {
        $this->db->select('deliveries.delivery_id');
        $this->db->select('deliveries.date_stamp');
        $this->db->select('deliveries.time_stamp');
        $this->db->select('deliveries.driver_id');
        $this->db->select('drivers.driver_first_name');
        $this->db->select('drivers.driver_last_name');
        $this->db->select('deliveries.vehicle_id');
        $this->db->select('deliveries.description');
        $this->db->select('delivery_statuses.status_name');
        $this->db->select('facilities.facility_id');
        $this->db->select('drivers.driver_last_name');
        $this->db->select('vehicles.vehicle_registration');
		$this->db->from('deliveries');

        $this->db->join('vehicles','deliveries.vehicle_id = vehicles.vehicle_id','inner');
        $this->db->join('drivers', 'deliveries.driver_id = drivers.driver_id', 'left');
        $this->db->join('delivery_statuses', 'deliveries.status_id = delivery_statuses.status_id', 'left');
        $this->db->join('delivery_facility_link', 'deliveries.delivery_id = delivery_facility_link.delivery_id', 'left');
        $this->db->join('facilities', 'delivery_facility_link.facility_id = facilities.facility_id', 'left');

		if($facility_id != null && $facility_id != 0){
			$this->db->where('facilities.facility_id', $facility_id);
		}
		if($search_string){
			$this->db->like('description', $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('deliveries.delivery_id', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    function store_deliveries($data)
    {
		$insert = $this->db->insert('deliveries', $data);
	    return $insert;
	}

    function update_delivery($id, $data)
    {
        $this->db->set($data);
        $this->db->where('delivery_table.delivery_id', $id);
        $this->db->update('deliveries as delivery_table');

		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function delete_delivery($id){
        //delete record from junction table
        $this->db->where('delivery_id', $id);
        $this->db->delete('delivery_facility_link');
        //delete from main deliveries table
		$this->db->where('delivery_id', $id);
		$this->db->delete('deliveries');
	}
    public function get_all_delivery_statuses() {
        $this->db->select('*');
        $this->db->from('delivery_statuses');
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>