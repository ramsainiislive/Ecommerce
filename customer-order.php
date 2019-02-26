<?php include('config.php');
if($_SESSION['userid']=='')
	{
		 redirect('index.php');
	}
$iSingleValue=$db->getRow("select * from customerdeatails where id='".$_SESSION['userid']."'"); 


?>
<?php
if(isset($_GET['id'])) {  
                  $GetEmailId=$db->getRows("select * from orderfeed where id='".$_GET['id']."' ");
							 foreach($GetEmailId as $iList)
									{
							$iProductDetail=$db->getRow("select * from product where id='".$iList['Productid']."' ");						
					/* $iTOtalPrice = $iProductDetail['price']*$iList['qty']; */
					
						$iProductDet=$db->getRow("select * from customerdeatails where id='".$iList['userid']."' ");
									}
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
				  
                    <font color="white"> Welcome : <?php echo $iSingleValue["firstname"]?></font>
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
                        <li><a href="#">My orders</a>
                        </li>
                        <li># <?php echo $iList['id']; ?></li>
                    </ul>

                </div>

                <div class="col-md-3">
                    <!-- *** CUSTOMER MENU ***
 _________________________________________________________ -->
                    <div class="panel panel-default sidebar-menu">

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
                                    <a href="customer-account.php"><i class="fa fa-user"></i> My account</a>
                                </li>
                                <li>
                                    <a href="index.php"><i class="fa fa-sign-out"></i> Logout</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <!-- /.col-md-3 -->

                    <!-- *** CUSTOMER MENU END *** -->
                </div>

                <div class="col-md-9" id="customer-order">
                    <div class="box">
                        <h1># <?php echo $iList['id']; ?></h1>

                        <p class="lead"># <?php echo $iList['id']; ?> was placed on <strong>
						<?php echo $iProductDet['date']; ?></strong> and is currently <strong>Being prepared</strong>.</p>
                        <p class="text-muted">If you have any questions, please feel free to <a href="contact.php">contact us</a>, our customer service center is working for you 24/7.</p>

                        <hr>

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
							if(isset($_GET['id'])) {  
                  $GetEmailId=$db->getRows("select * from orderfeed where id='".$_GET['id']."' ");
							 foreach($GetEmailId as $iList)
									{
							$iProductDetail=$db->getRow("select * from product where id='".$iList['Productid']."' ");						
					/* $iTOtalPrice = $iProductDetail['price']*$iList['qty']; */
									}
								   }?>
                                    <tr>
                                       
                                        <td><a href="#"><?php echo $iProductDetail['title']; ?></a>
										
                                        </td>
										<td>
                                            <a href="#">
                                            </a>
                                        </td>
                                       <td><?php echo $iList['quantity'];?></td>
                                        <td><?php echo $iList['price'];?></td>
                                        
                                        <td><?php echo  $iList['total'];?>.00</td>
                                    </tr>
                                  
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4" class="text-right">Order subtotal</th>
                                        <th><?php echo $iList['total'];?>.00</th>
                                    </tr>
                                   
                                   
                                    <tr>
                                        <th colspan="4" class="text-right">Total</th>
                                        <th><?php echo $iList['total'];?>.00</th>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                        <!-- /.table-responsive -->

                        <div class="row addresses">
                            
                            <div class="col-md-10">
							   <font align="left">
                                <h2>Shipping address</h2>
              <p> Customer Name : <font color="#4fbfa8"><?php echo $iSingleValue["firstname"]  ?><?php echo $iSingleValue["lastname"]  ?></font><br>
              Customer Address : <font color="#4fbfa8"> <?php echo $iSingleValue["address"]  ?></font><br>
				Customer EmailId : <font color="#4fbfa8"> <?php echo $iSingleValue["emailid"]  ?></font>
                                    </p>
									</font>
                            </div>
							<div class="col-md-2">
                                
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <!-- /.container -->
        </div>
         <?php include('inc.footer.php'); ?>	
    <?php include('inc.js.php'); ?>
</body>

</html>