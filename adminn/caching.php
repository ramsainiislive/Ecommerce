	<?php 
	
	include('../config.php');
	include('menu.php'); 
	
	
	?>
 	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		 
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Caching Of Pages</h1>
				
			</div>
		</div><!--/.row-->
		
		<!--/.<div class="row" style="display:none;">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Line Chart</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row" style="display:none;">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Bar Chart</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="main-chart" id="bar-chart" height="200" width="600"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>	
		
		<div class="row" style="display:none;">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Pie Chart</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="chart" id="pie-chart" ></canvas>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Doughnut Chart</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="chart" id="doughnut-chart" ></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>-->

		
		<div class="row">
        
          <?php 		$i=0;
			$iAryProductLista=$db->getRows("select * from product   order by no_of_click desc limit 0,10");
			foreach($iAryProductLista as $product_rows)
                                       {  $i=$i+1;
										  ?>
        
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4><?php echo $product_rows['title']; ?></h4>
						<div class="easypiechart" id="easypiechart-<?php if($i=='1') { echo "blue"; } 
 																		 elseif($i=='2') { echo "orange"; }
																		 elseif($i=='3') { echo "teal"; }
																		 elseif($i=='4') { echo "red"; }
																		 elseif($i=='5') { echo "pink"; }
																		 elseif($i=='6') { echo "yellow"; }
																		 elseif($i=='7') { echo "purple"; }
																		 elseif($i=='8') { echo "green"; }
																		 elseif($i=='9') { echo "brown"; } 
																		 elseif($i=='10') { echo "cyan"; } ?>" data-percent="<?php echo $product_rows['percentage_click']; ?>" >
																		 <span class="percent"><?php echo $product_rows['percentage_click']; ?>%</span>
						</div>
					</div>
				</div>
			</div>
            
            <?php } ?>
			 
            	 
		</div><!--/.row-->
											
	</div>	<!--/.main-->
	  

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
 
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
 
</body>

</html>
