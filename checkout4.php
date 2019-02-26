<?php include('config.php');
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
		<?php   
						/* 		   if(isset($_GET['id'])) {  
										$GetEmailId=$db->getRow("select * from product where id='".$_GET['id']."' ");
										 */
							 ?>    
            <div class="col-md-6 offer" data-animate="fadeInDown">
                <a href="#" class="btn btn-success btn-sm" data-animate-hover="shake">Only Today</a>  <a href="#">With any purchase you will have a Gift!</a>
            </div>
            <div class="col-md-6" data-animate="fadeInDown">
                <ul class="menu">
				<li>
				   
                    <font color="white"> Welcome : <?php echo $iSingleValue["firstname"]  ?></font>
                                </li>
				
				 
                    <li>
                 <a href="customer-account.php"><i class="fa fa-user"></i> My account</a>
                    </li>
                                <li>
                                    <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                                </li>

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
                        <li>Checkout - Order review</li>
                    </ul>
                </div>

                <div class="col-md-9" id="checkout">

                    <div class="box">
                        <form method="post" action="customer-orders.php?id=<?php echo $_SESSION['cartid'];?>">
                            <h1>Checkout - Order review</h1>
                            <ul class="nav nav-pills nav-justified">
                                <li><a href="checkout1.php"><i class="fa fa-map-marker"></i><br>Address</a>
                                </li>
                                <li><a href="checkout2.php"><i class="fa fa-truck"></i><br>Delivery Method</a>
                                </li>
                                <li><a href="checkout3.php"><i class="fa fa-money"></i><br>Payment Method</a>
                                </li>
                                <li class="active"><a href="#"><i class="fa fa-eye"></i><br>Order Review</a>
                                </li>
                            </ul>

                            <div class="content">
							
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Product</th>
                                                <th>Quantity</th>
                                                <th>Unit price</th>
                                               
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
									<?php
						 
										$GetEmailId=$db->getRows("select * from cartdetail where cartid='".$_SESSION['cartid']."' ");
							 foreach($GetEmailId as $iList)
									{
										
				$iProductDetail=$db->getRow("select * from product where id='".$iList['pid']."' ");						
							 ?> 
                                        <tr>
                                            <td>
                                                <a href="#">
                                 <img src="uploads/<?php echo $iProductDetail['uploadimage'];?>" alt="" width="450" height="600" class="img-responsive">
                                                </a>
                                            </td>
                                            <td><a href="#"><?php echo $iProductDetail['title']; ?></a>
                                            </td>
                                            											
											<td><?php echo $iList['qty'];?></td>

                                            
                                            <td><?php echo $iProductDetail['price'];?>.00</td>
                                           
                                            <td><?php echo $iTOtalPrice = $iProductDetail['price']*$iList['qty'];?>.00</td>
											<td>
                       <a href="<?php echo $FileName; ?>?action=delete&id=<?php echo $iList['id']; ?>"><i class="fa fa-trash-o"></i></a>									
											</td>
                                           
                                            
                                        </tr>
								<?php $iFinalPrice +=	$iTOtalPrice; }?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4">Total</th>
                                            <th colspan="2"><?php echo $iFinalPrice; ?>.00</th>
                                        </tr>
                                    </tfoot>
                                    </table>
							 
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.content -->

                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="checkout3.php?id=<?php echo $iList['id']; ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i>Back to Payment method</a>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" name="submit" class="btn btn-primary">Place an order<i class="fa fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->

								 
                </div>
                <!-- /.col-md-9 -->

                <div class="col-md-3">

                    <div class="box" id="order-summary">
                        <div class="box-header">
                            <h3>Order summary</h3>
                        </div>
                        <p class="text-muted">Shipping and additional costs are calculated based on the values you have entered.</p>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Order subtotal</td>
                                        <th><?php echo $iFinalPrice; ?>.00</th>
                                    </tr>
									 <!-- 
                                    <tr>
                                        <td>Shipping and handling</td>
                                        <th>KD 10.00</th>
                                    </tr>
									/.row -->
                                
                                    <tr class="total">
                                        <td>Total</td>
                                        <th><?php echo $iFinalPrice; ?>.00</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
                <!-- /.col-md-3 -->

            </div>
            <!-- /.container -->
        </div>
        </div>
      <?php include('inc.footer.php'); ?>	
    <?php include('inc.js.php'); ?>


</body>

</html>