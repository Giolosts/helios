<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Home extends CI_Controller{
		
		public function Home(){
			parent::__construct();
				
			$this->load->helper('url');
			
		}
		public function index()
		{
			$data['pData'] = '';
			$this->load->view('home_view.php',$data);
		}
		
		public function generate(){
				$data['pData'] = $_POST;
				
				
				$this->load->view('home_view.php',$data);
		}
		
		public function getQuote($kW=NULL,$Amt=NULL){
				
		}
		
		public function jsArr(){
			$arr = array(1,2,3,4,5,6,7);
					echo json_encode($arr);
		}
	}
	
?>
