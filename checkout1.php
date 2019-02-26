<?php include('config.php');
if($_SESSION['userid']=='')
	{
		 redirect('register.php');
	}
$iSingleValue=$db->getRow("select * from customerdeatails where id='".$_SESSION['userid']."'");

?>

<?php
						 
										$GetEmailId=$db->getRows("select * from cartdetail where cartid='".$_SESSION['cartid']."' ");
							 foreach($GetEmailId as $iList)
									{
										
				$iProductDetail=$db->getRow("select * from product where id='".$iList['pid']."' ");						
							
                     $iTOtalPrice = $iProductDetail['price']*$iList['qty'];
									   
								 $iFinalPrice +=	$iTOtalPrice; }
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
			<?php   
								  /*  if(isset($_GET['id'])) {  
										$GetEmailId=$db->getRows("select * from product where id='".$_GET['id']."' ");
										 foreach($GetEmailId as $iList)
									{	 */
							 ?>    

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="index.php">Home</a>
                        </li>
                        <li>Checkout - Address</li>
                    </ul>
                </div>

                <div class="col-md-9" id="checkout">

                    <div class="box">
                       
						<form method="post" action="" id="SubmitForm" class="register">
						<span id="register"></span>
                            <h1>Checkout</h1>
                            <ul class="nav nav-pills nav-justified">
                                <li class="active"><a href="#"><i class="fa fa-map-marker"></i><br>Address</a>
                                </li>
                                <li class="disabled"><a href="#"><i class="fa fa-truck"></i><br>Delivery Method</a>
                                </li>
                                <li class="disabled"><a href="#"><i class="fa fa-money"></i><br>Payment Method</a>
                                </li>
                                <li class="disabled"><a href="#"><i class="fa fa-eye"></i><br>Order Review</a>
                                </li>
                            </ul>
                           <div class="content">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="firstname">First Name</label>
											<input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo $iSingleValue["firstname"] ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="lastname">Last Name</label>
											<input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo $iSingleValue["lastname"] ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="company">Company</label>
											<input type="text" class="form-control" name="company" id="company" value="<?php echo $iSingleValue["company"] ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="street">Address</label>
											<input type="text" class="form-control" name="address" id="address" value="<?php echo $iSingleValue["address"] ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->

                                <div class="row">
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label for="city">City</label>
											<input type="text" class="form-control" name="city" id="city" value="<?php echo $iSingleValue["city"] ?>">
                                     </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label for="zip">ZIP</label>
											<input type="text" class="form-control" name="zip" id="zip" value="<?php echo $iSingleValue["zipcode"] ?>">
                                        </div>
                                    </div>
                               

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="phone">Phone Number</label>
											<input type="text" class="form-control" name="phone" id="phone" value="<?php echo $iSingleValue["contactno"] ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
											<input type="text" class="form-control" name="email" id="email" value="<?php echo $iSingleValue["emailid"] ?>">
                                    </div>
                                        </div>
									 <div class="col-sm-6">
                                     <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="date">Date</label>
											<input type="text" class="form-control" name="date" id="date" value="<?php echo $iSingleValue["date"] ?>">
                                       </div>
                                    </div>
										
                                    </div>

                                </div>
							</div>
                                <!-- /.row -->
                           
                            <div class="box-footer">
                                <div class="pull-left">
                                <a href="basket.php?id=<?php echo $iList['id']; ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i>Back to basket</a>
                                </div>
                                <div class="pull-right">
                                    <input type="button" onclick="action_customer()" name="register" class="btn btn-primary" value="Continue to Delivery Method" /> 
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                   </div>
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
			<?php /* }} */ ?>
            <!-- /.container -->
        </div>
		</div>
		
      <?php include('inc.footer.php'); ?>	
    <?php include('inc.js.php'); ?>
	
<script>
 function action_customer()
 	{
		
		//alert('action_customer');  
		
		
		var firstname= document.getElementById('firstname').value;
		/* alert('firstname');  */
		  var lastname= document.getElementById('lastname').value;
		 /* alert('lastname'); */ 
		 var company= document.getElementById('company').value;
		 /* alert('company'); */
		 var address= document.getElementById('address').value;
		// alert('address');
		var city= document.getElementById('city').value;
		 //alert('city');
		var zip= document.getElementById('zip').value;
		 //alert('zip');
		var phone= document.getElementById('phone').value;
		 //alert('phone');
 		 var email= document.getElementById('email').value;
		//alert('email'); 
		 var date= document.getElementById('date').value;
		  //alert('date'); 
		  
		$.ajax({
				type: 'post',
				url:'ajaxc.php',
				data:{
					action           :"action_customer",
					firstname		 :	firstname,
					lastname		 :	lastname,
					company		     :	company,
					address		     :	address,
					city		     :	city,
					zip		         :	zip,
					phone		     :	phone,
					email		     :	email,
					date         :  date,
				},
				success: function( data){
					//alert(data);
		if(data==1){
						$("#register").html('<p style="color:green;">Submit successfully.</p>');
						/* document.getElementById('SubmitForm').reset(); */
						window.location.href="checkout2.php?id=<?php echo $iList['id']; ?>";
				}
				else{
					$("#register").html(data);
				}
				}
		});
	}
	
</script>
</body>

</html>