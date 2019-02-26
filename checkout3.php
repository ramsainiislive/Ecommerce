<?php 
include('config.php');
$iSingleValue=$db->getRow("select * from customerdeatails where id='".$_SESSION['userid']."'");
	$GetEmailId=$db->getRows("select * from cartdetail where cartid='".$_SESSION['cartid']."' ");
			 foreach($GetEmailId as $iList)
			{
		 	$iProductDetail=$db->getRow("select * from product where id='".$iList['pid']."' ");						
                      $iTOtalPrice = $iProductDetail['price']*$iList['qty'];
		$iFinalPrice +=	$iTOtalPrice; }
?>
<?php

$validate=new Validation();
 if(isset($_POST['register']))
	{
		$validate->addRule($_POST['payment'],'','Payment',true);
		if($validate->validate() && count($stat)==0)
				{	
				$aryData=array(	   				
									'pmethod'     	=>	$_POST['payment'],
								  );  
							$flgIn = $db->updateAry("customerdeatails",$aryData,"where id='".$_SESSION['userid']."'");
							/* echo $flgIn = $db->getLastQuery();
							exit();  */
							
							 $_SESSION['success']="update Successfully";
							 redirect('checkout4.php?id='.$_GET['id']);
				         }
		          else
		          {
			       $stat["error"]=$validate->errors();
		           }

	 echo msg($stat);
	   }

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
                        <li>Checkout - Payment method</li>
                    </ul>
                </div>

                <div class="col-md-9" id="checkout">

                    <div class="box">
                        <form method="post" action="">
                            <h1>Checkout - Payment method</h1>
                            <ul class="nav nav-pills nav-justified">
                                <li><a href="checkout1.php?id=<?php echo $iList['id']; ?>"><i class="fa fa-map-marker"></i><br>Address</a>
                                </li>
                                <li><a href="checkout2.php?id=<?php echo $iList['id']; ?>"><i class="fa fa-truck"></i><br>Delivery Method</a>
                                </li>
                                <li class="active"><a href="#"><i class="fa fa-money"></i><br>Payment Method</a>
                                </li>
                                <li class="disabled"><a href="checkout4.php"><i class="fa fa-eye"></i><br>Order Review</a>
                                </li>
                            </ul>

                            <div class="content">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="box payment-method">

                                            <h4>KNET</h4>

                                            <p>easiest and secured method to pay.</p>

                                            <div class="box-footer text-center">
                      <input type="radio" name="payment" value="KNET" <?php if($_POST['payment'] =='KNET') echo "checked"; ?>  />
                                              
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="box payment-method">

                                            <h4>Pay with credit card</h4>

                                            <p>VISA and Mastercard only.</p>

                                            <div class="box-footer text-center">

    <input type="radio" name="payment" value="Pay with credit card" <?php if($_POST['payment'] =='Pay with credit card') echo "checked"; ?>  />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="box payment-method">

                                            <h4>Cash on delivery</h4>

                                            <p>You pay when you get it.</p>

                                            <div class="box-footer text-center">

  <input type="radio" name="payment" value="Cash on delivery" <?php if($_POST['payment'] =='Cash on delivery') echo "checked"; ?>  />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->

                            </div>
                            <!-- /.content -->

                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="checkout2.php?id=<?php echo $iList['id']; ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i>Back to Shipping method</a>
                                </div>
                                <div class="pull-right">
                                 
               <input type="submit"  name="register" class="btn btn-primary" value="Continue to Order review">
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
                                  -->
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
							 <?php /* }} */ ?>

            </div>
            <!-- /.container -->
        </div>
        </div>
      <?php include('inc.footer.php'); ?>	
    <?php include('inc.js.php'); ?>


</body>

</html>