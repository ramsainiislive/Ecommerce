	<?php 
	
	include('../config.php');
	include('menu.php'); 
	
	
	$pd1 =  $db->getVal("select click from  category where id='1'");
	$pd2 =  $db->getVal("select click from  category where id='2'");
	$pd3 =  $db->getVal("select click from  category where id='4'");
	$pd4 =  $db->getVal("select click from  category where id='5'");
	$pd5 =  $db->getVal("select click from  category where id='6'");

	?>
 	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">Charts</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Category Wise Priority</h1>
				
			</div>
		</div><!--/.row-->
        
        
        
        
        	 
		
        <div style="background-color:#30a5ff; height:20px!important; text-align:center; width:100px!important;">Pens</div>
		 <div style="background-color:#98ea85; height:20px!important; text-align:center; width:100px!important;">Shoes</div>
        <div style="background-color:#ffb53e; height:20px!important; text-align:center; width:100px!important;">Books</div>
        <div style="background-color:#1ebfae; height:20px!important; text-align:center; width:100px!important;">Electronics</div>
        <div style="background-color:#f9243f; height:20px!important; text-align:center; width:100px!important;">Furniture</div>
        
		<div class="row" style="display:none;">
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
		</div><!--/.row-->
		
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
		</div><!--/.row-->		
		
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Pie Chart</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="chart" id="pie-chart"></canvas>
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
		</div><!--/.row-->
		
		 <!--/.row-->
											
	</div>	<!--/.main-->
	  

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script>
    
    
    
     
	var randomScalingFactor = function(){ return Math.round(Math.random()*1000)};
	
	var lineChartData = { }
		
	var barChartData = {
			labels : ["January","February","March","April","May","June","July"],
			datasets : [ ]
	
		}

	var pieData = [
				{ <?php $p1=$pd1?>
					value: <?php echo $p1; ?>,
					color:"#30a5ff",
					highlight: "#62b9fb",
					label: "Pens"
				},
				{
					<?php $p2=$pd2?>
					value: <?php echo $p2; ?>,
					color:"#98ea85",
					highlight: "#62b9fb",
					label: "Shoes"
				},
				{
					<?php $p3=$pd3?>
					value: <?php echo $p3; ?>,
					color: "#ffb53e",
					highlight: "#fac878",
					label: "Books"
				},
				{
					<?php $p4=$pd4 ?>
					value: <?php echo $p4; ?>,
					color: "#1ebfae",
					highlight: "#3cdfce",
					label: "Electronics"
				},
				{
					<?php $p5=$pd5?>
					value: <?php echo $p5; ?>,
					color: "#f9243f",
					highlight: "#f6495f",
					label: "Furniture"
				}

			];
			
	var doughnutData = [
					{
						<?php $p1=$pd1?>
						value: <?php echo $p1; ?>,
						color:"#30a5ff",
						highlight: "#62b9fb",
						label: "Pens"
					},
					{
						<?php $p2=$pd2?>
					value: <?php echo $p2; ?>,
					color:"#98ea85",
					highlight: "#62b9fb",
					label: "Shoes"
				   },
					{
						<?php $p3=$pd3?>
						value: <?php echo $p3; ?>,
						color: "#ffb53e",
						highlight: "#fac878",
						label: "Books"
					},
					{
						<?php $p4=$pd4?>
						value: <?php echo $p4; ?>,
						color: "#1ebfae",
						highlight: "#3cdfce",
						label: "Electronics"
					},
					{
						<?php $p5=$pd5?>
						value: <?php echo $p5; ?>,
						color: "#f9243f",
						highlight: "#f6495f",
						label: "Furniture"
					}
	
				];

window.onload = function(){
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
		responsive: true
	});
	var chart2 = document.getElementById("bar-chart").getContext("2d");
	window.myBar = new Chart(chart2).Bar(barChartData, {
		responsive : true
	});
	var chart3 = document.getElementById("doughnut-chart").getContext("2d");
	window.myDoughnut = new Chart(chart3).Doughnut(doughnutData, {responsive : true
	});
	var chart4 = document.getElementById("pie-chart").getContext("2d");
	window.myPie = new Chart(chart4).Pie(pieData, {responsive : true
	});
	
};
 
    
    
    
    </script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>
