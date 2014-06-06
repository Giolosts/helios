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
			var Months = ["January","February","March","April","May","June","July"]
			var lineChartData1 = {
				labels : Months,
				datasets : [
					{
						fillColor : "rgba(220,220,220,0.5)",
						strokeColor : "rgba(220,220,220,1)",
						pointColor : "rgba(220,220,220,1)",
						pointStrokeColor : "#fff",
						data : [65,59,90,81,56,55,40]
					},
					{
						fillColor : "rgba(151,187,205,0.5)",
						strokeColor : "rgba(151,187,205,1)",
						pointColor : "rgba(151,187,205,1)",
						pointStrokeColor : "#fff",
						data : [28,48,40,19,96,27,100]
					}
				]
				
			}
		
			var lineChartData2 = {
				labels : Months,
				datasets : [
					{
						fillColor : "rgba(220,220,220,0.5)",
						strokeColor : "rgba(220,220,220,1)",
						pointColor : "rgba(220,220,220,1)",
						pointStrokeColor : "#fff",
						data : [65,59,90,81,56,55,40]
					},
					{
						fillColor : "rgba(151,187,205,0.5)",
						strokeColor : "rgba(151,187,205,1)",
						pointColor : "rgba(151,187,205,1)",
						pointStrokeColor : "#fff",
						data : [28,48,40,19,96,27,100]
					}
				]
				
			}
			
			var lineChartData3 = {
				labels : Months,
				datasets : [
					{
						fillColor : "rgba(220,220,220,0.5)",
						strokeColor : "rgba(220,220,220,1)",
						pointColor : "rgba(220,220,220,1)",
						pointStrokeColor : "#fff",
						data : [65,59,90,81,56,55,40]
					},
					{
						fillColor : "rgba(151,187,205,0.5)",
						strokeColor : "rgba(151,187,205,1)",
						pointColor : "rgba(151,187,205,1)",
						pointStrokeColor : "#fff",
						data : [28,48,40,19,96,27,100]
					}
				]
				
			}
			
			var myLine1 = new Chart(document.getElementById("myChart1").getContext("2d")).Line(lineChartData1);
			var myLine2 = new Chart(document.getElementById("myChart2").getContext("2d")).Line(lineChartData2);
			var myLine3 = new Chart(document.getElementById("myChart3").getContext("2d")).Line(lineChartData3);
	</script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.1.min.js"><\/script>')</script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
        (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
        function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
        e=o.createElement(i);r=o.getElementsByTagName(i)[0];
        e.src='//www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
        ga('create','UA-XXXXX-X');ga('send','pageview');
    </script>
    </body>
</html>