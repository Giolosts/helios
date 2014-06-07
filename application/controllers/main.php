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
			$data['kW'] = '';
			$data['Amt'] = '';

			// Load View
			$this->load->view('header.php',$data);
			$this->load->view('content/main_view.php',$data);
			$this->load->view('footer.php',$data);
		}

		public function generate($kwH = NULL,$budget = NULL){

			// Data variables
			//$data['pData'] = $_POST;

			$data['kW'] = isset($_POST['kW'])? $_POST['kW'] : '';
			$data['Amt'] = isset($_POST['Amt']) ? $_POST['Amt'] : '' ;

			$kwH = $data['kW'];
			$budget = $data['Amt'];
			// Normal Energy Bill
			$data['monthlyBill'] = $this->getBillQuote($kwH);
			$data['dailykwH'] = $kwH/30;
			$data['Emission'] = $kwH*12;
			
			// With Solar Panel Bill
			$data['monthlySolar'] = $this->getSolarQuote($kwH,$budget);
			$data['dailySolar'] = $this->energySolar('dailykWh',$budget);
			$data['monthlySolar'] = $this->energySolar('monthlykWh',$budget);
			$data['emissionSolar'] =  $data['Emission'] - ($data['Emission'] - (($kwH - $data['monthlySolar']) * 12));
			
			// Load View
			$this->load->view('header.php',$data);
			$this->load->view('content/main_view.php',$data);
			$this->load->view('footer.php',$data);
		}

		//===========================
		// Get Total Computations (Solar)
		// return avegery enery consumption less than solar energy producs (if using solar panels)
		//===========================
		public function getSolarQuote($kwH=NULL,$budget=NULL){
			$solarkWh = $this->energySolar('kW',$budget);
			$solarkWh = $solarkWh['kW'];
			$monthlyBill = $this->getBillQuote($kwH);
			return $monthlyBill - ($solarkWh * 1885.325);
		}

		public function energySolar($cat=NULL,$budget=NULL){
			$solarkWh = array(); // data set container for kwH
			$solarkWh['kW'] = $budget/100000;	// daily kW produces by solar panel
			$solarkWh['dailykWh'] = $solarkWh['kW'] * 4.5;	// Daily kWh consumble energy produces by solar panel
			$solarkWh['monthlykWh'] = $solarkWh['dailykWh'] * 30;	// Monthly kwH consumable energy produces by solar panel
			
			switch($cat):
				case 'kW':
					return $solarkWh['kW'];
				case 'dailykWh':
					return $solarkWh['dailykWh'];
				case 'monthlykWh': 
					return $solarkWh['monthlykWh'];
				default:
					return 'No Selected Category';
			endswitch;
			
		} 

		public function CO2Emission($normalkwH=NULL,$solarkwH=NULL){
			$emission = ($normalkwH - $solarkwH) * 365;
			return $emission;
		}

		//===========================
		// General Total Computation (Meralco)
		// return avarage energy consumption from distributor
		//===========================
		public function getBillQuote($kwH=NULL){
			//$kwH = 100; // Test Data
			$govTax = 241.28;	// Declared Gov Tax Rate Value

			$genTotal = $this->generation($kwH);	// Total Generation Charge
			$transTotal = $this->transmission($kwH);// Total Transmission Charge
			$sysTotal = $this->systemLoss($kwH);	// Total System Loss charge
			$disTotal = $this->distribution($kwH);	// Total Distribution Charge
			$subTotal = $this->subsidies($kwH);		// Total Subsidies Charge
			$uniTotal = $this->universal($kwH);		// Total Universal Charge

			$genAv = $genTotal+$transTotal+$sysTotal+$disTotal+$subTotal+$uniTotal+$govTax; // Average Energy Consumption Cost
			return $genAv;
		}


		//===========================
		// Compute Generation Charges
		//===========================
		public  function generation($kwH = NULL){
				//$kwH = 100; // Test Data
				$genCharge = array(5.6673,0.0314,0); // Fix Generation charge rates
				$genAmt = 0; // Average Generation Charge for given kwH used

				// Loop::getting the average Generation Charge from  Rates * kwH
				for($i=0;$i<count($genCharge);$i++){
					$genAmt += $kwH * $genCharge[$i];
				}

				return $genAmt;
		}

		//===========================
		// Compute Transmission Charges
		//===========================
		public function transmission($kwH = NULL){
			//$kwH = 100; // Test Data
			$transCharge = array(0.9333); // Fix Transmission charge rates
			$transAmt = 0; // Average Transmission Charge for given kwH used

			// Loop::getting the average Transmission Charge from Rates * kwH
			for($i=0;$i<count($transCharge);$i++){
				$transAmt += $kwH * $transCharge[$i];
			}

			return $transAmt; 

		}

		//===========================
		// Compute SystemLoss Charges
		//===========================
		public function systemLoss($kwH = NULL){
			//$kwH = 100; // Test Data
			$sysCharge = array(0.6062); // Fix SystemLoss charge rates
			$sysAmt = 0; // Average SystemLoss Charge for given kwH used

			// Loop::getting the average SystemLoss amount from  Rates * kwH
			for($i=0;$i<count($sysCharge);$i++){
				$sysAmt += $kwH * $sysCharge[$i];
			}
			return $sysAmt;
		}

		//===========================
		// Compute Distribution Charges
		//===========================
		public function distribution($kwH = NULL){
			//$kwH = 100; // Test Data
			$disCharge = array(1.5789, 0.4066, 0.6043); // Fix Distribution charge rates
			$disAmt = 0; // Average Distribution Amount for given kwH used
			$extAmt = 24.88;
			// Loop::getting the average Distribution amount from  Rates * kwH
			for($i=0;$i<count($disCharge);$i++){
				$disAmt += $kwH * $disCharge[$i];
			}

			return $disAmt + $extAmt;
		}

		//===========================
		// Compute Subsidies Charges
		//===========================
		public function subsidies($kwH = NULL){
			//$kwH = 100; // Test Data
			$subCharge = array(0.1173, 0.0001); // Fix Subsidies charge rates
			$subAmt = 0; // Average Subsidies Charge per kwH

			// Loop::getting the average subsidies amount from const charge * kwH
			for($i=0;$i<count($subCharge);$i++){
				$subAmt += $kwH * $subCharge[$i];
			}
			return $subAmt ;
		}

		//===========================
		// Compute Universal Charges
		//===========================
		public function universal($kwH = NULL){
			$kwH = 100; // Test Data
			$uniCharge = array(0.1561,0.0025,0.1938); // Fix Universal charge rates
			$uniAmt = 0; // Average Universal Charge per kwH

			// Loop::getting the average subsidies amount from const charge * kwH
			for($i=0;$i<count($uniCharge);$i++){
				$uniAmt += $kwH * $uniCharge[$i];
			}

			return $uniAmt;
		}
		
		public function xcode(){
			$xcode = $this->uri->segment('3');
			if($xcode != ''){
				
				
				// Load View
				$this->load->view('header.php',$data);
				$this->load->view('content/main_view.php',$data);
				$this->load->view('footer.php',$data);
			}
			else{
				header('Location:'.base_url().'index.php/main');
			}
		}
		
		function generateRandomString($length = 10) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, strlen($characters) - 1)];
			}
			return $randomString;
		}
	}
	
?>

