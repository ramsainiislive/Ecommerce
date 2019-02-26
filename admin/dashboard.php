<?php include('../config.php');

include('inc.session.php'); 



 ?>

<!DOCTYPE html>

<html>

    <head>

        <?php include('inc.meta.php'); ?>
            

    </head>

    <body class="fixed-left">

        <?php include('inc.header.php'); ?>

            <?php include('inc.sideleft.php'); ?>

            <div class="content-page">

                <div class="content">

                    <div class="container">

                        <div class="row">

                            <div class="col-sm-12">

                                <h4 class="page-title">Dashboard</h4>

                                <p class="text-muted page-title-alt">Welcome to  admin panel !</p>

                            </div>

                        </div>
						
						<div class="row">
						<div class="text-center">

                                        <!--<h2 class="text-dark"><b>Overall Report</b></h2>-->
							</div>
                                    </div>

                        <div class="row">

                            



                            <div class="col-md-6 col-lg-3">

                                <div class="widget-bg-color-icon card-box">

                                    <div class="bg-icon bg-icon-pink pull-left">

                                        <i class="glyphicon glyphicon-registration-mark text-pink"></i>

                                    </div>

                                    <div class="text-right">

                <h3 class="text-dark"><b class="counter"><?php echo $db->getVal("select count(id) from registration");?></b></h3>

                                        <p class="text-muted">Total Registration</p>

                                    </div>

                                    <div class="clearfix"></div>

                                </div>

                            </div>
							
							 <div class="col-md-6 col-lg-3">

                                <div class="widget-bg-color-icon card-box">

                                    <div class="bg-icon bg-icon-pink pull-left">

                                      <i class="glyphicon glyphicon-user text-pink"></i>

                                    </div>

                                    <div class="text-right">

                <h3 class="text-dark"><b class="counter"><?php echo $db->getVal("select count(id) from customerdeatails");?></b></h3>

                                        <p class="text-muted">Total Customer</p>

                                    </div>

                                    <div class="clearfix"></div>

                                </div>

                            </div>
							
							<div class="col-md-6 col-lg-3">

                                <div class="widget-bg-color-icon card-box">

                                    <div class="bg-icon bg-icon-pink pull-left">

                                         <i class="fa fa-shopping-cart text-pink"></i>

                                    </div>

                                    <div class="text-right">

                <h3 class="text-dark"><b class="counter"><?php echo $db->getVal("select count(id) from category");?></b></h3>

                                        <p class="text-muted">Total Category</p>

                                    </div>

                                    <div class="clearfix"></div>

                                </div>

                            </div>
						
						<div class="col-md-6 col-lg-3">

                                <div class="widget-bg-color-icon card-box">

                                    <div class="bg-icon bg-icon-pink pull-left">

                                        <i class="fa fa-shopping-cart text-pink"></i>

                                    </div>

                                    <div class="text-right">

                <h3 class="text-dark"><b class="counter"><?php echo $db->getVal("select count(id) from product");?></b></h3>

                                        <p class="text-muted">Total Products</p>

                                    </div>

                                    <div class="clearfix"></div>

                                </div>

                            </div>
							
						<div class="col-md-6 col-lg-3">

                                <div class="widget-bg-color-icon card-box">

                                    <div class="bg-icon bg-icon-pink pull-left">
									

                                     
										<i class="fa fa-shopping-bag text-pink" aria-hidden="true"></i>

                                    </div>

                                    <div class="text-right">
									
					  <h3 class="text-dark"><b class="counter"><?php echo 	$db->getVal("select count(id) from orderfeed	");  ?></b></h3>

                                        <p class="text-muted">New Orders</p>

                                    </div>

                                    <div class="clearfix"></div>

                                </div>

                            </div>
                 
                 <div class="col-md-6 col-lg-3">

                                <div class="widget-bg-color-icon card-box">

                                    <div class="bg-icon bg-icon-pink pull-left">

                                        <i class="fa fa-users text-pink" aria-hidden="true"></i>

                                    </div>

                                    <div class="text-right">

                <h3 class="text-dark"><b class="counter"><?php echo $iAryProductLista=$db->getVal("select count(id) from user_move");?></b></h3>

                                        <p class="text-muted">Visitors</p>

                                    </div>

                                    <div class="clearfix"></div>

                                </div>

                            </div>							
						

			


                            

                        </div>
						
						

						

                        


                    </div> <!-- container -->



                </div> <!-- content -->



                <?php include('inc.footer.php'); ?>

            </div>

        </div>

        <?php include('inc.js.php'); ?>

    </body>

</html>