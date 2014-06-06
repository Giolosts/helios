    <div id="container-fluid">
    	<nav>
    		<h5>Helios</h5>
    	</nav>
    	<div class="row">
    		<div class="col-md-12">
    			<div id="header">
    				<div class="header-text">
    					<h1>Convert your home to Solar.</h1>
						<p>Compute how much you'll save if you convert your home to renewable energy.</p>
    				</div>
    				<form class="form-horizontal" role="form" method="POSt" action='<?=base_url();?>index.php/main/generate'>
	    				<div class="clear"></div>
						<div class="form-group">
							<div class="row">
								<div class="col-sm-4">
									<input type="text" class="form-control" name="kW" placeholder="Average monthy kWH">
								</div>
							</div>

							<div class="clear"></div>

							<div class="row">
								<div class="col-sm-6">
									<input type="text" class="form-control" name="Amt" placeholder="Budget for conversion">
									<div class="clear"></div>
								</div>
								<div class="col-sm-3">
									<button type="submit" class="btn btn-default">Compute</button>
								</div>
							</div>
						</div>
						<?php print_r($pData);?>
					</form>
    			</div>
    		</div>
    	</div>
	</div>

	<div class="clear"></div>

	<div class="container">
		<div class="row">
			<div class="info">
				<div class="col-md-4">
					<h3>Compute</h3>
					<span class="entypo-chart-area"></span>
					<p>How much CO2 or you using? Find out by computing your Carbon Dioxide footprint.</p>
					<div class="clear"></div>
				</div>
				<div class="col-md-4">
					<h3>Visualize</h3>
					<span class="entypo-chart-line"></span>
					<p>View your savings and ROI in beautiful charts that show you a yearly timeline.</p>
					<div class="clear"></div>
				</div>
				
				<div class="col-md-4">
					<h3>Measure</h3>
					<span class="entypo-chart-bar"></span>
					<p>Measure how much energy you'll save when you convert your home to renewable energy</p>
					<div class="clear"></div>
				</div>
				
			</div>
		</div>	
	</div>

	<div class="container">
		<?php if(!empty($pData)){ ?>
		<div class="col-md-12">
			<canvas id="myChart1" width="600" height="200"></canvas>
		</div>
		<canvas id="myChart2" width="600" height="200"></canvas>
		<canvas id="myChart3" width="600" height="400"></canvas>
		<?php } ?>
	</div>

