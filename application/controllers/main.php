<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Main extends CI_Controller{
		
		//===========================
		// Assets Loader
		//===========================
		public function Main(){
			parent::__construct();

			$this->load->helper('url');

		}
		
		//===========================
		// Save data to be generated
		// return avegery enery consumption less than solar energy producs (if using solar panels)
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
		
		//===========================
		// Save data to be generated
		// return avegery enery consumption less than solar energy producs (if using solar panels)
		//===========================
		public function generate($kwH = NULL,$budget = NULL){
			
			// POST Data Variables
			$kW = isset($_POST['kW'])? $_POST['kW'] : '';
			$Amt = isset($_POST['Amt']) ? $_POST['Amt'] : '' ;
			
			// Unique url(xcode generator)
			// has database checking
			do{
				$xcode = $this->generateRandomString();
				$cData = $this->db->where('xcode',$xcode)->count_all_results('cache');
			}while($cData > 0);
			
			
			// Unique Xcode for data being evaluated
			$data = array(
			   'xcode' => $xcode ,
			   'kwH' => $kW ,
			   'budget' => $Amt
			);
			
			// Push Data into database
			$this->db->insert('cache', $data); 
			
			// redirect to generated url code to view data
			header('Location:xcode/'.$xcode);
		}
		
		//===========================
		// Unique Url xcodes for bigData
		//===========================
		public function xcode(){
			$xcode = $this->uri->segment('3');
			
			// Check wether a bigData is generated else return generation page
			if($xcode != ''){
				
				// Get db cache of the generated  big Data  
				$data = $this->db->get_where('cache', array('xcode' => $xcode))->result();
				
				foreach ($data as $row)
				{
					$data['kW'] = $row->kwH;
					$data['Amt'] = $row->budget;
				}
				// end 
				
				// Data pulled from db by unique xcodes 
				$kwH = $data['kW'];
				$budget = $data['Amt'];
		
				// Normal Energy Bill
				$data['monthlyBill'] = $this->getBillQuote($kwH);
				$data['dailykwH'] = $kwH/30;
<<<<<<< HEAD
				$data['Emission'] = $kwH*12; //
=======
				$data['Emission'] = $kwH*12;
>>>>>>> 1c80df6842d804f7f1ec2a6d97a58688d2ae321f
				
				// With Solar Panel Bill
				$data['monthlySolarBill'] = $this->getSolarQuote('monthlySavings',$kwH,$budget);
				$data['dailySolar'] = $this->getSolarQuote('daily',$kwH,$budget);
				$data['monthlySolar'] = $this->getSolarQuote('monthly',$kwH,$budget);
				$data['monthlyEsave'] = $this->getSolarQuote('monthlyEsave',$kwH,$budget);
				$data['monthlySavings'] = $this->getSolarQuote('monthlySavings',$kwH,$budget);
				$data['solarMonthlybills'] = $this->getSolarQuote('solarMonthlybills',$kwH,$budget);
				$data['averageMonthlysavings'] = $this->getSolarQuote('averageMonthlysavings',$kwH,$budget);
				$data['emissionSolar'] =  $data['Emission'] - ($data['Emission'] - (($kwH - $data['monthlySolar']) * 12));
				
				// Compute how much you can save if you use solar panel
				$data['saveEnergy'] = $data['monthlyBill'] - $data['monthlySolarBill'];
				
				// Compute equivalent no. of trees based on the Co2
				$data['trees'] =  ($data['Emission'] - $data['emissionSolar']) / 48;
				
				// Data for Monthly Chart  solar bills savings for 12 months of start using solar panel
				$data['monthlyChart'] = $this->getSolarQuote('monthlyChart',$data['monthlySolarBill']);
				
				// Savings per month
				$data['monthlySavings'] = round($data['monthlySolarBill'] / 12,2);
				
				// return data from script data labels on view side
				$normalE = array();
				$solarE	= array();
				
				for($i=0;$i<12;$i++){
					array_push($data['normalE'],$data['monthlyBill']);
					array_push($data['solarE'],$data['monthlySolarBill']);
				}
				$data['normalE'] = json_encode($normalE);
				$data['solarE'] = json_encode($solarE);
				
				// Load View
				$this->load->view('header.php',$data);
				$this->load->view('content/main_view.php',$data);
				$this->load->view('footer.php',$data);
			}
			else{
				header('Location:'.base_url().'index.php/main');
			}
		}
		
		//===========================
		// Get Total Computations (Solar)
		// return avegery enery consumption less than solar energy producs (if using solar panels)
		//===========================
		public function getSolarQuote($cat=NULL,$kwH=NULL,$budget=NULL){
			
			// Data Variables
			$monthlyBill = $this->getBillQuote($kwH);
			$solarIsolation = array(1.09,1.24,1.5,1.73,1.51,1.03,0.93,0.95,0.93,1.01,1,1);
			$solarMonthlybills = array();
			$monthlySavings = array();
			$averageMonthlysavings = 0;

			// Computations for Solar
			$kW = $budget/100000;
			$daily = $kW * 4.5;
			$monthly = $daily * 30;
			$monthlyEsave = $kW * 1795.33;
		
			// Get Monthly savings, Solar Monthly bills, Average Monthly bill
			for($i=0;$i<12;$i++){
				$mSavings = $monthlyEsave * $solarIsolation[$i];
				array_push($monthlySavings,$mSavings);
				$solarMbills = $monthlyBill - $monthlySavings[$i];
				array_push($solarMonthlybills,$solarMbills);
				$averageMonthlysavings += $monthlySavings[$i];
			
			};
			
			// return needed category info
			switch($cat):
				case 'kW':
					return $kW;
				case 'daily':
					return $daily;
				case 'monthly':
					return $monthly;
				case 'monthlyEsave':
					return $monthlyEsave;
				case 'monthlySavings':
					return json_encode($monthlySavings);
				case 'solarMonthlybills':
					return json_encode($solarMonthlybills);
				case 'averageMonthlysavings':
					return $averageMonthlysavings/12;
				default:
					return 'No Data';
			endswitch;
		}
		
		//===========================
		// Solar Co2 Emission
		// return co2 emission produce using solar panel
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
			//$kwH = 100; // Test Data
			$uniCharge = array(0.1561,0.0025,0.1938); // Fix Universal charge rates
			$uniAmt = 0; // Average Universal Charge per kwH

			// Loop::getting the average subsidies amount from const charge * kwH
			for($i=0;$i<count($uniCharge);$i++){
				$uniAmt += $kwH * $uniCharge[$i];
			}

			return $uniAmt;
		}
		
		
		//===========================
		// Generate Unique Url Code for bigData for saving into cache db
		// 
		//===========================
		function generateRandomString($length = 5) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, strlen($characters) - 1)];
			}
			return $randomString;
		}
	}
	
?>

