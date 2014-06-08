	<!-- home -->
	<?php if(empty($kW) && empty($Amt)){ ?>
	<div class="container-fluid">
    	<nav>
    		<h5>Helios</h5>
    		<div class="share">
				<div class="fb-share-button" data-href="<?=base_url();?>/index.php/main/content" data-width="100" data-type="button"></div>
			</div>
    	</nav>
		<div id="header">
			<div class="header-text">
				<h1>Convert your home to Solar.</h1>
				<p>Always wanted to know if it's worth it to invest in solar power?<br>
					Compute how much money you'll save if you convert your home to renewable energy.<br>
				</p>
			</div>
			<form class="form-horizontal" role="form" method="POSt" action='<?=base_url();?>index.php/main/generate'>
				<div class="clear"></div>
				<div class="form-group">
					<div class="row">
						<div class="col-sm-4">
							<input type="number" class="form-control" name="kW" min="50" max="2000" placeholder="Average kWH/month">
						</div>
						<div class="kwh-info">
							<div class="hidden-xs">
								<div class="left">
									<small>Look for it at the right side of your electric bill, next to the graph.</small>
								</div>
								<div class="right">
									<img src="<?=base_url();?>/assets/img/meralco.png" class="img-responsive" alt="Meralco Bill kWh">
								</div>
							</div>
						</div>
					</div>

					<div class="clear"></div>

					<div class="row">
						<div class="col-sm-6">
							<input type="number" class="form-control" name="Amt" min="50000" max="500000"placeholder="Budget for conversion">
							<div class="clear"></div>
						</div>
						<div class="col-sm-3">
							<button type="submit" class="btn btn-default">Compute</button>
						</div>
					</div>
				</div>
			</form>
		</div>	
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
	<?php } ?>

	<!-- user has entered kWh and budget -->
	<?php if(!empty($kW) && !empty($Amt)){ ?>
	<div class="container-fluid">
		<nav>
    		<h5>Helios</h5>
    		<div class="share">
				<div class="fb-share-button" data-href="<?=base_url();?>/index.php/main/content" data-width="100" data-type="button"></div>
			</div>
    	</nav>
		<div id="short-header">
			<h3>Your average monthly kWh usage: <strong><?php print_r($kW);?> kWh</strong></h1>
			<h4>Budget for solar conversion: <strong>PHP <?php print_r($Amt);?></strong></h2>
		</div>
		<div class="chart">
			<h5>This chart shows how much money you will save on your electricity bill per month.
				Based on your budget, you can get <strong>PHP <?php print_r(round($monthlyEsave,2));?></strong> savings per month.</h5>
			<canvas id="myChart1" width="900" height="300"></canvas>
			<div class="clearfix"></div>
			<div class="legend">
				<img src="<?=base_url();?>/assets/img/orange.png" alt="orange">
			</div>
			<h6>Current average monthly electric bill average per month: <strong><?php print_r($monthlyBill); ?></strong></h6>
			<div class="clearfix"></div>
			<div class="legend">
				<img src="<?=base_url();?>/assets/img/gray.png" alt="orange">
			</div>
			<?php if($monthlySolarBill > 0) { ?>
				<h6>Average monthly electric bills after solar installation: <strong><?php print_r($monthlySolarBill); ?></strong>.</h6>
				<div class="clearfix"></div>
				<div class="legend">
					<img src="<?=base_url();?>/assets/img/blue.png" alt="orange">
				</div>
				<h6>Projected monthly bills with solar installation</h6>
				<div class="clearfix"></div>
			<?php } else { ?>
				<h6>Average monthly electricity credit from Meralco: <strong><?php print_r($monthlySolarBill * -1); ?></strong>.</h6>
				<div class="clearfix"></div>
				<div class="legend">
					<img src="<?=base_url();?>/assets/img/blue.png" alt="orange">
				</div>
				<h6>Projected monthly electricity credit from Meralco</h6>
				<div class="clearfix"></div>
				<div class="legend"></div><h6>Want to find out how the Meralco's Net Metering for electricity credit works? Click <a href="#">here.</a></h6>
			<?php } ?>
		</div>
		<div class="chart">
			<h5>Within <strong><?php print_r($years); ?> years<?php if($months > 0) { ?> and <?php print_r($months); ?> months<?php } ?></strong>, your investment will have paid for itself and 
				you have helped the environment along the way.<h5>
			<canvas id="myChart2" width="900" height="300"></canvas>
		</div>
		<div class="chart">
			<?php if($emissionSolar > 0) { ?>
			<h5>Your overall carbon footprint will be lowered from <strong><?php print_r($Emission);?> pounds of CO2
			</strong> to <strong><?php print_r($emissionSolar);?> pounds of CO2</strong>,
				equivalent to <span class="text-success"><strong><?php print_r(round($trees, 0));?> trees being planted.</strong></span></h5>
			<?php } ?>
			<?php if($emissionSolar <= 0) { ?>
			<h5>Upon installing solar panels, your carbon footprint from your home will be completely gone.
				Your solar installation is equivalent to <span class="text-success"><strong><?php print_r(round($trees, 0));?></strong></span>
				trees planted in terms of <strong>CO2 absorption</strong>. You're helping mother earth in a big way!</h5>
			<?php } ?>
			<canvas id="myChart3" width="900" height="300"></canvas>
			<div class="clearfix"></div>
			<div class="legend">
				<img src="<?=base_url();?>/assets/img/orange.png" alt="orange">
			</div>
			<h6>Current average CO2 emissions: <strong><?php print_r($Emission); ?> pounds of CO2 per year</strong></h6>
			<div class="clearfix"></div>
			<div class="legend">
				<img src="<?=base_url();?>/assets/img/blue.png" alt="orange">
			</div>
			<h6>Projected average CO2 emissions after solar installation: <strong><?php if($emissionSolar > 0) { print_r($emissionSolar); ?> pounds of CO2 per year<?php } else { echo "0";?>, Your home won't have a carbon footprint anymore!<?php } ?></strong></h6>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
		<div class="interested">
			<h4>Interested in converting your home to Solar? Order Solar panels from these local distributors: </h3>
			<div class="distributor">
				<a href="<?=base_url();?>main/sendForm" taget="_tab"><img src="<?=base_url();?>/assets/img/distributor1.png" alt="Solar distributor 1" class="img-responsive"></a>
			</div>
			<div class="distributor">
				<a href="<?=base_url();?>main/sendForm" taget="_tab"><img src="<?=base_url();?>/assets/img/distributor2.png" alt="Solar distributor 2" class="img-responsive"></a>
			</div>
			<div class="distributor">
				<a href="<?=base_url();?>main/sendForm" taget="_tab"><img src="<?=base_url();?>/assets/img/distributor3.png" alt="Solar distributor 3" class="img-responsive"></a>
			</div>
		</div>
	</div>
	<?php }?>
