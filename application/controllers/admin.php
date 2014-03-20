<?php

class Admin extends CI_Controller {
   
     
    function __construct() {
    		// Call the Controller constructor
	    	parent::__construct();
	    	
	    	$config['upload_path'] = './images/product/';
	    	$config['allowed_types'] = 'gif|jpg|png';

	    	$this->load->library('upload', $config);
	    	
    }

    function index() {
    	redirect('admin/products','refresh');
    }

    function products(){
    	//Only if logged in
    	if($this->session->userdata('logged_in')){
			//Header Data
			$session_data = $this->session->userdata('logged_in');
			if($session_data['username'] === "admin"){
				$headerData['title']="Candy Products";
				$headerData['fname']=$session_data['first'];
				$headerData['lname']=$session_data['last'];
				//Page Data
				$this->load->model('product_model');
				$products = $this->product_model->getAll();
				$data['products']=$products;
				//Views
				$this->load->view('templates/header.php',$headerData);
				$this->load->view('admin/product_list.php',$data);
				$this->load->view('templates/footer.php');
			}
			else {
				redirect('candystore', 'refresh');
			}
			
		}
		else{
			redirect('/user/login', 'refresh');
		}
    }

    function customers(){
    	if($this->session->userdata('logged_in')){
			//Header Data
			$session_data = $this->session->userdata('logged_in');
			if($session_data['username'] === "admin"){
				$headerData['title']="Candy Products";
				$headerData['fname']=$session_data['first'];
				$headerData['lname']=$session_data['last'];
				//Page Data
				$this->load->model('product_model');
				$products = $this->product_model->getAll();
				$data['products']=$products;
				//Views
				$this->load->view('templates/header.php',$headerData);
				$this->load->view('admin/product_list.php',$data);
				$this->load->view('templates/footer.php');
			}
			else {
				redirect('candystore', 'refresh');
			}
			
		}
		else{
			redirect('/user/login', 'refresh');
		}

    }

    function orders(){

    }
    
    function newProduct() {
	    	$this->load->view('admin/product_newForm.php');
    }
    
	function create() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','required|is_unique[product.name]');
		$this->form_validation->set_rules('description','Description','required');
		$this->form_validation->set_rules('price','Price','required');
		
		$fileUploadSuccess = $this->upload->do_upload();
		
		if ($this->form_validation->run() == true && $fileUploadSuccess) {
			$this->load->model('product_model');

			$product = new Product();
			$product->name = $this->input->get_post('name');
			$product->description = $this->input->get_post('description');
			$product->price = $this->input->get_post('price');
			
			$data = $this->upload->data();
			$product->photo_url = $data['file_name'];
			
			$this->product_model->insert($product);

			//Then we redirect to the index page again
			redirect('admin/index', 'refresh');
		}
		else {
			if ( !$fileUploadSuccess) {
				$data['fileerror'] = $this->upload->display_errors();
				$this->load->view('admin/product_newForm.php',$data);
				return;
			}
			
			$this->load->view('admin/product_newForm.php');
		}	
	}
	
	function read($id) {
		$this->load->model('product_model');
		$product = $this->product_model->get($id);
		$data['product']=$product;
		$this->load->view('admin/product_read.php',$data);
	}
	
	function editForm($id) {
		$this->load->model('product_model');
		$product = $this->product_model->get($id);
		$data['product']=$product;
		$this->load->view('admin/product_editForm.php',$data);
	}
	
	function update($id) {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('description','Description','required');
		$this->form_validation->set_rules('price','Price','required');
		
		if ($this->form_validation->run() == true) {
			$product = new Product();
			$product->id = $id;
			$product->name = $this->input->get_post('name');
			$product->description = $this->input->get_post('description');
			$product->price = $this->input->get_post('price');
			
			$this->load->model('product_model');
			$this->product_model->update($product);
			//Then we redirect to the index page again
			redirect('admin/index', 'refresh');
		}
		else {
			$product = new Product();
			$product->id = $id;
			$product->name = set_value('name');
			$product->description = set_value('description');
			$product->price = set_value('price');
			$data['product']=$product;
			$this->load->view('admin/product_editForm.php',$data);
		}
	}
    	
	function delete($id) {
		$this->load->model('product_model');
		
		if (isset($id)) 
			$this->product_model->delete($id);
		
		//Then we redirect to the index page again
		redirect('admin/index', 'refresh');
	}
      
   
    
    
    
}
?>
