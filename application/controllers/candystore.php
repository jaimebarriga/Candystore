<?php

class CandyStore extends CI_Controller {
   
     
    function __construct() {
    		// Call the Controller constructor
	    	parent::__construct();
    }

    function index() {
    	if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$this->load->model('product_model');
			$products = $this->product_model->getAll();
			$data['products']=$products;
			$headerData['title']="Candy Products";
			$headerData['fname']=$session_data['first'];
			$headerData['lname']=$session_data['last'];
			$this->load->view('templates/header.php',$headerData);
			$this->load->view('candystore/list.php',$data);
			$this->load->view('templates/footer.php');
		}
		else{
			redirect('/user/login', 'refresh');
		}
    }

    
    
    }
?>