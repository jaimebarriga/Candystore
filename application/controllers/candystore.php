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

    function add(){
    	$this->load->model('product_model');
		
		$product = $this->product_model->get($this->input->post('id'));
		$quantity = $this->input->post('quantity');
		
		$insert = array(
			'id' => $this->input->post('id'),
			'qty' => $quantity,
			'price' => $product->price,
			'name' => $product->name
		);
		
		$this->cart->insert($insert);
	
		redirect('candystore');
    }

    function remove($rowid) {
		
		$this->cart->update(array(
			'rowid' => $rowid,
			'qty' => 0
		));
		
		redirect('candystore');
		
	}

	function cart() {
		$session_data = $this->session->userdata('logged_in');
		$cart = $this->cart->contents();
		$data['cart'] = $cart;
		$headerData['title']="Cart";
		$headerData['fname']=$session_data['first'];
		$headerData['lname']=$session_data['last'];
		$this->load->view('templates/header.php',$headerData);
		$this->load->view('candystore/cart_list.php',$data);
		$this->load->view('templates/footer.php');
	}

	function payment(){
		$session_data = $this->session->userdata('logged_in');
		$cart = $this->cart->contents();
		$data['cart'] = $cart;
		$headerData['title']="Cart";
		$headerData['fname']=$session_data['first'];
		$headerData['lname']=$session_data['last'];

		$this->load->library('form_validation');

		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('ccnumber','Credit Card Number','required|callback_checkccnumber');
		$this->form_validation->set_rules('ccmonth','Credit Card Expiry Month', 'required|callback_checkccmonth');
		$this->form_validation->set_rules('ccyear', 'Credit Card Expiry Year', 'required|callback_checkccyear');

		if($this->form_validation->run() == true && $this->cart->contents()){
			
			$this->load->model('order_model');
			$this->load->model('orderitem_model');

			$order['customer_id'] = $session_data['id'];
			$order['order_date'] = date("Y-m-d");
			$order['order_time'] = date("H:i:s");
			$order['total'] = (float)$this->cart->total();
			$order['creditcard_number'] = $this->input->post('ccnumber');
			$order['creditcard_month'] = (int)$this->input->post('ccmonth');
			$order['creditcard_year'] = (int)$this->input->post('ccyear');

			$this->order_model->insert($order);
			$orderid = (int)$this->db->insert_id();

			foreach($this->cart->contents() as $item){
				$order_item['order_id'] = $orderid;
				$order_item['product_id'] = $item['id'];
				$order_item['quantity'] = $item['qty'];

				$order_itemdb = $this->orderitem_model->insert($order_item);
			}

			$data['order_id'] = $orderid;

			//Send email
			$config = Array(
			    'protocol' => 'smtp',
			    'smtp_host' => 'ssl://smtp.googlemail.com',
			    'smtp_port' => 465,
			    'smtp_user' => 'xxx',
			    'smtp_pass' => 'xxx',
			    'mailtype'  => 'html', 
			    'charset'   => 'iso-8859-1'
			);
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");

			$this->email->from('candystore.csc309a2@gmail.com', 'Candystore');
			$this->email->to($session_data['email']);

			$this->email->subject('Order Confirmation');
			$this->email->message('Congratulations! Your order is complete. For reference, your order id is '.$orderid);
			    
			$result = $this->email->send(); 

			$data['cart'] = $this->cart->contents();
			$data['cart_total'] = $this->cart->total();
			$this->cart->destroy();

			$this->load->view('templates/header.php',$headerData);
			$this->load->view('candystore/payment_success.php',$data);
			$this->load->view('templates/footer.php');
		}
		else {
			if($this->cart->contents()){
				$this->load->view('templates/header.php',$headerData);
				$this->load->view('candystore/cart_list.php',$data);
				$this->load->view('templates/footer.php');
			}
			else {
				redirect('candystore', 'refresh');
			}
			
		}

	}

	function checkccnumber($ccnumber){
		if(preg_match("/^\d{16}$/",$ccnumber)){
			return true;
		}
		else {
			$this->form_validation->set_message(
	        	'checkccnumber', 'Invalid credit card number'
	        ); 
			return false;
		}
	}

	function checkccmonth($ccmonth){
		if(preg_match("/^\d?\d$/", $ccmonth)){
			$int = (int)$ccmonth;
			if($int < 13 && $int > 0){
				return true;
			}
			else {
				$this->form_validation->set_message(
	            	'checkccmonth', 'That is not a number from 1 to 12'
		        ); 
		        return false;
			}
		}
		else {
			$this->form_validation->set_message(
	            'checkccmonth', 'That is not a number from 1 to 12'
	        ); 
	        return false;
		}
	}

	function checkccyear($ccyear){
		$ccmonth = $this->input->post('ccmonth');
		if(preg_match("/^\d{4}$/", $ccyear)){
			$intyear = (int)$ccyear;
			$intmonth = (int)$ccmonth;
			if($intyear < (int)date("Y")){
				$this->form_validation->set_message(
	            	'checkccyear', 'Invalid Expiry Date'
		        ); 
				return false;
			}
			else {
				if($intyear == (int)date("Y")){
					if($intmonth <= (int)date("n")){
						$this->form_validation->set_message(
		            		'checkccyear', 'Invalid Expiry Date'
				        ); 
						return false;
					}
					return true;
				}
				return true;
			}
		}
		else {
			$this->form_validation->set_message(
	            'checkccyear', 'That is not a valid year'
	        ); 
	        return false;
		}

	}

    
}
?>