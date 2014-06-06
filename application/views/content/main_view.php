<form method="POSt" action='<?=base_url();?>index.php/main/generate'>
	<input type='text' name='kW'>
	<input type='text' name='Amt'>
	<input type='submit' value='Get Quote'>
	<?php print_r($pData);?>
</form>
<hr/>

<?php if(!empty($pData)){ ?>
<canvas id="myChart1" width="400" height="400"></canvas>
<canvas id="myChart2" width="400" height="400"></canvas>
<canvas id="myChart3" width="400" height="400"></canvas>
<?php } ?>
