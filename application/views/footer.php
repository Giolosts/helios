	<footer>
		<div class="row">
			<div class="col-md-6">
				<small><h5>Helios (n) - God of the Sun</h5>
				<p>This web app lets users project a solar conversion in their home.
					Made for Hack the Climate Manila during June 6-8, 2014</p></small>
					
				<div class="clear"></div>
			</div>
			<div class="col-md-6">
				<img src="<?=base_url();?>/assets/img/hacktheclimate.png" class="img-responsive" alt="Hack The Climate">
				<img src="<?=base_url();?>/assets/img/smartdevnet.png" class="img-responsive" alt="Hack The Climate">
			</div>
		</div>
	</footer>

	<!-- JS scripts here -->
	<script>
			var Months = ["January","February","March","April","May","June","July","August","September","October","Novemeber","December"]
			
			var barChartOptions1 = {
					//Boolean - If we show the scale above the chart data
					scaleOverlay : true,
					//Boolean - If we want to override with a hard coded scale
					scaleOverride : true,
					//** Required if scaleOverride is true **
					//Number - The number of steps in a hard coded scale
					scaleSteps : 10,
					//Number - The value jump in the hard coded scale
					scaleStepWidth : Math.ceil(<?php print_r($Emission * 1.1); ?> / 10),
					//Number - The scale starting value
					scaleStartValue : 0,
					//String - Colour of the scale line	
					scaleLineColor : "rgba(0,0,0,.1)",
					//Number - Pixel width of the scale line	
					scaleLineWidth : 1,
					//Boolean - Whether to show labels on the scale	
					scaleShowLabels : true,
					//Interpolated JS string - can access value
					scaleLabel : "<%=value%>",
					//String - Scale label font declaration for the scale label
					scaleFontFamily : "'Arial'",
					//Number - Scale label font size in pixels	
					scaleFontSize : 12,
					//String - Scale label font weight style	
					scaleFontStyle : "normal",
					//String - Scale label font colour	
					scaleFontColor : "#666",
					///Boolean - Whether grid lines are shown across the chart
					scaleShowGridLines : true,
					//String - Colour of the grid lines
					scaleGridLineColor : "rgba(0,0,0,.05)",
					//Number - Width of the grid lines
					scaleGridLineWidth : 1,	
					//Boolean - If there is a stroke on each bar	
					barShowStroke : true,
					//Number - Pixel width of the bar stroke	
					barStrokeWidth : 2,
					//Number - Spacing between each of the X value sets
					barValueSpacing : 100,
					//Number - Spacing between data sets within X values
					barDatasetSpacing : 0,
					//Boolean - Whether to animate the chart
					animation : true,
					//Number - Number of animation steps
					animationSteps : 60,
					//String - Animation easing effect
					animationEasing : "easeOutQuart",
					//Function - Fires when the animation is complete
					onAnimationComplete : null
					
			}

			var lineChartData1 = {
				labels : Months,
				datasets : [
					{
						fillColor : "rgba(220,220,220,0.5)",
						strokeColor : "rgba(220,220,220,1)",
						pointColor : "rgba(220,220,220,1)",
						pointStrokeColor : "#fff",
						data : <?php print_r($normalE);?>
					},
					{
						fillColor : "rgba(151,187,205,0.5)",
						strokeColor : "rgba(151,187,205,1)",
						pointColor : "rgba(151,187,205,1)",
						pointStrokeColor : "#fff",
						data : <?php print_r($solarMonthlybills); ?>
					},
					{
						fillColor : "rgba(190,190,190,0.5)",
						strokeColor : "rgba(151,187,205,1)",
						pointColor : "rgba(151,187,205,1)",
						pointStrokeColor : "#fff",
						data : <?php print_r($solarE);?>
					}
				]
				
			}
		
			var lineChartData2 = {
				labels : Months,
				datasets : [
					{
						fillColor : "rgba(151,187,205,0.5)",
						strokeColor : "rgba(151,187,205,1)",
						pointColor : "rgba(151,187,205,1)",
						pointStrokeColor : "#fff",
						data : [10,18,20,35,54,80,100]
					}
				]
				
			}
			
			var barChartData1 = {
				labels : ["Current Emissions", "Emissions after installation"],
				datasets : [
					{
						fillColor : "rgba(220,220,220,0.5)",
						strokeColor : "rgba(220,220,220,1)",
						pointColor : "rgba(220,220,220,1)",
						pointStrokeColor : "#fff",
						data : [<?php print_r($Emission);?>, <?php if($emissionSolar > 0) { print_r($emissionSolar);} else {echo 0;} ?>]
					}
					// ,
					// {
					// 	fillColor : "rgba(151,187,205,0.5)",
					// 	strokeColor : "rgba(151,187,205,1)",
					// 	pointColor : "rgba(151,187,205,1)",
					// 	pointStrokeColor : "#fff",
					// 	data : [51, 35]
					// }
				]
				
			}
			
			var myLine1 = new Chart(document.getElementById("myChart1").getContext("2d")).Line(lineChartData1);
			var myLine2 = new Chart(document.getElementById("myChart2").getContext("2d")).Line(lineChartData2);
			var myLine3 = new Chart(document.getElementById("myChart3").getContext("2d")).Bar(barChartData1, barChartOptions1);
	</script>
    </body>
</html>
