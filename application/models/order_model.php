<?php
class Order_model extends CI_Model {

	function getAll()
	{  
		$query = $this->db->get('order');
		return $query->result();
	}  
	
	function deleteAll() {
		//return $this->db->delete("product",array('id' => $id ));
	}	
}
?>