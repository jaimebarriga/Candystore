<?php
class User_model extends CI_Model {
	
	function getUser()
	{
		// TODO: Get user from session
		// $query = $this->db->get_where('customer',array('id' => $id));
		// return $query->row(0,'User');
	}
	
	function createUser() {
		$data = array(
			'first' => $this->input->post('fname'),
			'last' => $this->input->post('lname'),
			'login' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'email' => $this->input->post('email')
		);

		return $this->db->insert('customer', $data);
	}
	 
	function updateUser() {
		
	}

	function userExists($email) {
	    $this->db->select('id');
	    $this->db->where('email', $email);
	    $query = $this->db->get('customer');

	    if ($query->num_rows() > 0) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function login($email, $password){
		$this->db->select('id, login, password');
		$this->db->from('customer');
		$this->db->where('email', $email);
		$this->db->where('password', $password);

		$query = $this->db->get();

		if($query->num_rows() == 1){
			return $query->result();
		}
		else {
			return false;
		}
	}
	
	
}
?>