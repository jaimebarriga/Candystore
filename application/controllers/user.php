<?php

class User extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	function index(){
		redirect('/user/login', 'refresh');
	}

	function login(){
		$data["title"] = "Login";

		$this->load->library('form_validation');

		$this->form_validation->set_rules('username','Username','trim|required|callback_checkUsername');
		$this->form_validation->set_rules('password','Password','required|callback_checkDatabase');

		if($this->form_validation->run() == true){
			if($this->input->post('username') == 'admin'){
				redirect('/admin', 'refresh');
			}
			else {
				redirect('/candystore', 'refresh');
			}
		}
		else {
			$this->load->view('/user/login.php',$data);
		}
	}

	function checkUsername($username){
		return true;
	}

	function checkDatabase($password){
		$username = $this->input->post('username');
		$this->load->model('user_model');

		$result = $this->user_model->login($username, $password);

		if($result){
			$sess_array = array();
			foreach($result as $row){
				$sess_array = array(
					'id' => $row->id,
					'username' => $row->login,
					'first' => $row->first,
					'last' => $row->last,
					'email' => $row->email
				);
				$this->session->set_userdata('logged_in', $sess_array);
			}
			return true;
		}
		else{
			$this->form_validation->set_message('checkDatabase', 'Invalid username or password');
			return false;
		}
	}



	function userExists($email){
		$this->load->library('form_validation');
	    $this->load->model('user_model');
	    $is_exist = $this->user_model->userExists($email);

	    if ($is_exist) {
	        return true;
	    } 
	    else {
	    	$this->form_validation->set_message(
	            'userExists', 'That email/password combination is incorrect.'
	        ); 
	        return false;
	    }
	}

	function signup(){
		$data['title'] = "Sign Up";

		$this->load->library('form_validation');

		$this->form_validation->set_rules('fname', 'First Name', 'trim|required');
		$this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]|is_unique[customer.login]|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[passconf]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[customer.email]');

		$this->form_validation->set_message('is_unique', "%s is already taken.");

		if ($this->form_validation->run() == false)
		{
			$this->load->view('user/signup.php',$data);
		}
		else
		{
			$this->load->model('user_model');
			$this->user_model->createUser();

			redirect('/candystore', 'refresh');
		}
	}

	function logout(){
    	$this->session->unset_userdata('logged_in');
    	redirect('/');
    }
}

?>