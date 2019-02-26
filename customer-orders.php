<?php include('config.php');
if($_SESSION['userid']=='')
	{
		 redirect('index.php');
	}
						   
$iSingleValue=$db->getRow("select * from customerdeatails where id='".$_SESSION['userid']."'");

							

?>      
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<?php include('inc.meta.php');?>
    
</head>

<body>
 <!-- *** TOPBAR ***
 _________________________________________________________ -->
    <div id="top">
        <div class="container">
		
            <div class="col-md-6 offer" data-animate="fadeInDown">
                <a href="#" class="btn btn-success btn-sm" data-animate-hover="shake">Only Today</a>  <a href="#">With any purchase you will have a Gift!</a>
            </div>
            <div class="col-md-6" data-animate="fadeInDown">
                <ul class="menu">
				<li> <font color="white"> Welcome : <?php echo $iSingleValue["firstname"]?></font> </li>
				<li><a href="customer-account.php"><i class="fa fa-user"></i> My account</a>  </li>
                 <li>  <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>     </li>         
                 </ul>
            </div>
								   
        </div>
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
            <div class="modal-dialog modal-sm">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="Login">Customer login</h4>
                    </div>
                    <div class="modal-body">
                        <form action="customer-orders.php" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" id="email-modal" placeholder="email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password-modal" placeholder="password">
                            </div>

                            <p class="text-center">
                                <button class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
                            </p>

                        </form>

                        <p class="text-center text-muted">Not registered yet?</p>
                        <p class="text-center text-muted"><a href="register.php"><strong>Register now</strong></a>! It is easy and done in 1&nbsp;minute and gives you access to special discounts and much more!</p>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- *** TOP BAR END *** -->
	
	
    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">

                    <ul class="breadcrumb">
                        <li><a href="index.php">Home</a>
                        </li>
                        <li>My orders</li>
                    </ul>

                </div>

                <div class="col-md-3">
                    <!-- *** CUSTOMER MENU ***
 _________________________________________________________ -->
                    <div class="panel panel-default sidebar-menu">
					  <?php 
								   
								   if(isset($_GET['id'])) {  
										$iList=$db->getRow("select * from product where id='".$_GET['id']."' ");
										 	  ?>    
                        <div class="panel-heading">
                            <h3 class="panel-title">Customer section</h3>
                        </div>

                        <div class="panel-body">

                            <ul class="nav nav-pills nav-stacked">
                                <li class="active">
                                    <a href="customer-orders.php"><i class="fa fa-list"></i> My orders</a>
                                </li>
                                <li>
                                    <a href="customer-wishlist.php"><i class="fa fa-heart"></i> My wishlist</a>
                                </li>
                                <li>
                                    <a href="customer-account.php?id=<?php echo $_GET['id'];?>"><i class="fa fa-user"></i> My account</a>
                                </li>
                                <li>
                                    <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                                </li>
                            </ul>
                        </div>   
										  <?php } ?>
                    </div>
                    <!-- /.col-md-3 -->

                    <!-- *** CUSTOMER MENU END *** -->
                </div>

                <div class="col-md-9" id="customer-orders">
                    <div class="box">
                        <h1>My orders</h1>

                        <p class="lead">Your orders on one place.</p>
                        <p class="text-muted">If you have any questions, please feel free to <a href="contact.php">contact us</a>, our customer service center is working for you 24/7.</p>

                        <hr>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Order</th>
										<th>Quantity</th>
										<th>Price</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
						 $GetEmailId=$db->getRows("select * from cartdetail where cartid='".$_SESSION['cartid']."' ");
							 foreach($GetEmailId as $iList)
									{
							$iProductDetail=$db->getRow("select * from product where id='".$iList['pid']."' ");						
							 ?>								
					<?php $iTOtalPrice = $iProductDetail['price']*$iList['qty'];?>
         						<tr>
                                        <td># <?php echo $iList['id']; ?></td>
										<td><?php echo $iList['qty'];?></td>
										<td><?php echo $iProductDetail['price'];?></td>
										
                                        <td><?php echo $iTOtalPrice;?>.00</td>
								 <td><span class="label label-info"> <?php if($iProductDetail['status']=='1'){echo "Active";}
								 if($iProductDetail['status']=='0'){echo "Inactive";}?> </span>
                                        </td>
                    <td><a href="customer-order.php?id=<?php echo $iList['id']; ?>" class="btn btn-primary btn-sm">View</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container -->
        </div>
       <div> 
            <?php include('inc.footer.php'); ?>	
    <?php include('inc.js.php'); ?>
</body>

</html>