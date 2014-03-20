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

    /****START PRODUCTS****/

    function products(){
    	//Only if logged in
    	if($this->session->userdata('logged_in')){
			//Header Data
			$session_data = $this->session->userdata('logged_in');
			if($session_data['username'] === "admin"){
				$headerData['title']="Admin - Products";
				$headerData['nav']='products';
				//Page Data
				$this->load->model('product_model');
				$products = $this->product_model->getAll();
				$data['products']=$products;
				//Views
				$this->load->view('templates/admin_header.php',$headerData);
				$this->load->view('admin/product_list.php',$data);
				$this->load->view('templates/admin_footer.php');
			}
			else {
				redirect('candystore', 'refresh');
			}
			
		}
		else{
			redirect('/user/login', 'refresh');
		}
    }

     function newProduct() {
     		$headerData['title']="Add Prouct";
			$headerData['nav']='products';
     		$this->load->view('templates/admin_header.php',$headerData);
	    	$this->load->view('admin/product_newForm.php');
	    	$this->load->view('templates/admin_footer.php');
    }
    
	function createProduct() {
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
				$headerData['title'] = "Add Product";
				$headerData['nav'] = 'products';
				$this->load->view('templates/admin_header.php',$headerData);
				$this->load->view('admin/product_newForm.php',$data);
				$this->load->view('templates/admin_footer.php');
				return;
			}
			
			$headerData['title'] = "Add Product";
			$headerData['nav'] = 'products';
			$this->load->view('templates/admin_header.php',$header_data);
			$this->load->view('admin/product_newForm.php');
			$this->load->view('templates/admin_footer.php');
		}	
	}
	
	function readProduct($id) {
		$this->load->model('product_model');
		$product = $this->product_model->get($id);
		$data['product']=$product;
		$headerData['title'] = "View Product";
		$headerData['nav'] = "products";
		$this->load->view('templates/admin_header.php',$headerData);
		$this->load->view('admin/product_read.php',$data);
		$this->load->view('templates/admin_footer.php');
	}
	
	function editProduct($id) {
		$this->load->model('product_model');
		$product = $this->product_model->get($id);
		$data['product']=$product;
		$headerData['title'] = "Update Product";
		$headerData['nav'] = 'products';
		$this->load->view('templates/admin_header.php',$headerData);
		$this->load->view('admin/product_editForm.php',$data);
		$this->load->view('templates/admin_footer.php');
	}
	
	function updateProduct($id) {
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
			$headerData['title'] = "Update Product";
			$headerData['nav'] = "products";
			$this->load->view('templates/admin_header',$headerData);
			$this->load->view('admin/product_editForm.php',$data);
			$this->load->view("templates/admin_footer.php");
		}
	}
    	
	function deleteProduct($id) {
		$this->load->model('product_model');
		
		if (isset($id)) 
			$this->product_model->delete($id);
		
		//Then we redirect to the index page again
		redirect('admin/index', 'refresh');
	}
      
   /****END PRODUCTS    START CUSTOMER****/

    function customers(){
    	if($this->session->userdata('logged_in')){
			//Header Data
			$session_data = $this->session->userdata('logged_in');
			if($session_data['username'] === "admin"){
				$headerData['title']="Admin - Customers";
				$headerData['nav']='customers';
				//Page Data
				// $this->load->model('product_model');
				// $products = $this->product_model->getAll();
				// $data['products']=$products;
				//Views
				$this->load->view('templates/admin_header.php',$headerData);
				$this->load->view('admin/customer_list.php');
				$this->load->view('templates/admin_footer.php');
			}
			else {
				redirect('candystore', 'refresh');
			}
			
		}
		else{
			redirect('/user/login', 'refresh');
		}

    }

    /*****END CUSTOMER     START ORDERS*****/

    function orders(){
    	if($this->session->userdata('logged_in')){
			//Header Data
			$session_data = $this->session->userdata('logged_in');
			if($session_data['username'] === "admin"){
				$headerData['title']="Admin - Orders";
				$headerData['nav']='orders';
				//Page Data
				// $this->load->model('product_model');
				// $products = $this->product_model->getAll();
				// $data['products']=$products;
				//Views
				$this->load->view('templates/admin_header.php',$headerData);
				$this->load->view('admin/order_list.php');
				$this->load->view('templates/admin_footer.php');
			}
			else {
				redirect('candystore', 'refresh');
			}
			
		}
		else{
			redirect('/user/login', 'refresh');
		}
    }   
}
?>
