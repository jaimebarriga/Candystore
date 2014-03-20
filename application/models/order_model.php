<?php
class Order_model extends CI_Model {

	function getAll()
	{  
		$query = $this->db->get('order');
		return $query->result();
	}  

	function insert($order) {
		return $this->db->insert("order", array('customer_id' => $order['customer_id'],
				                                  'order_date' => $order['order_date'],
											      'order_time' => $order['order_time'],
												  'total' => $order['total'],
												  'creditcard_number' => $order['creditcard_number'],
												  'creditcard_month' => $order['creditcard_month'],
												  'creditcard_year' => $order['creditcard_year']
												  ));
	}
	
	function deleteAll() {
		//return $this['db['delete("product",array('id' => $id ));
	}	
}
?>