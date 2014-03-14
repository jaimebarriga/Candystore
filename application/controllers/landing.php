<?php

class Landing extends CI_Controller {
   
     
    function __construct() {
    		// Call the Controller constructor
	    	parent::__construct();	    	
    }

    function index(){

    	$data['title'] = "Homes - Candy Store";

    	$this->load->view('index.php',$data);
    }

}
?>
