<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Main extends CI_Controller{
		
		public function Main(){
			parent::__construct();
				
			$this->load->helper('url');
			
		}
		public function index()
		{
			// Data Variables
			$data['pData'] = '';
			
			// Load View
			$this->load->view('header.php',$data);
			$this->load->view('content/main_view.php',$data);
			$this->load->view('footer.php',$data);
		}
		
		public function generate(){
			
			// Data variables
			$data['pData'] = $_POST;
			
			// Load View
			$this->load->view('header.php',$data);
			$this->load->view('content/main_view.php',$data);
			$this->load->view('footer.php',$data);
		}
		
		public function getQuote($kW=NULL,$Amt=NULL){
				
		}
		
		/*public function jsArr(){
			$arr = array(1,2,3,4,5,6,7);
					echo json_encode($arr);
		}*/
	}
	
?>
