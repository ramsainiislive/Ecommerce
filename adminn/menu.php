<?php $iLoginUserDetail=$db->getRow("select * from admin_deatails where id='".$_SESSION['user_id']."'"); ?>
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Lumino - Dashboard</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				
<a class="navbar-brand" href="#"><span><img src="uploads/logo7.jpg" alt="user-img" style="height:30px; width:150px;"></span></a>
                   
              	<ul class="user-menu">
				<li class="dropdown pull-right"> <font color="white"> Welcome : <?php echo $iLoginUserDetail["fullname"] ?></font> </li>
				<br>
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> User <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="<?php echo ADMIN_URL; ?>login_profile.php"><i class="ti-user m-r-5"></i> Update Profile</a></li>

                                         <li><a href="<?php echo ADMIN_URL; ?>login_pass.php"><i class="ti-user m-r-5"></i>Change Password</a></li>
                                         <li><a href="<?php echo ADMIN_URL; ?>logout.php"><i class="ti-power-off m-r-5"></i> Logout</a></li>
						</ul>
					</li>
					
					
				</ul>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group">
				
			</div>
		</form>
		<ul class="nav menu">
		     <li><a href="<?php echo ADMIN_URL; ?>dashboard.php"><span class="glyphicon glyphicon-dashboard"></span> Home</a></li>
			<!-- <li class="active"><a href="index.php"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li> -->
			
			<li class="active"><a href="priority.php"><span class="glyphicon glyphicon-info-sign"></span> Page Priority</a></li>
            <li><a href="category.php"><span class="glyphicon glyphicon-stats"></span> Category Priority</a></li>
            <li><a href="caching.php"><span class="glyphicon glyphicon-cog"></span> Frequently Visited Pages </a></li>
			<li><a href="user_behaviour.php"><span class="glyphicon glyphicon-list-alt"></span> User Behaviour</a></li>
			<li><a href="search.php"><span class="glyphicon glyphicon-pencil"></span> Search Behaviour</a></li>
		<!--	<li><a href="panels.html"><span class="glyphicon glyphicon-info-sign"></span> Alerts &amp; Panels</a></li>-->
			 
		 
		</ul>
		 
	</div> 