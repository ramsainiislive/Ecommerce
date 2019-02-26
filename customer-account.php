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
                        <li>My account</li>
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
                                    <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <!-- /.col-md-3 -->

                    <!-- *** CUSTOMER MENU END *** -->
                </div>

                <div class="col-md-9">
                    <div class="box">
                        <h1>My account</h1>
                        <p class="lead">Change your personal details or your password here.</p>
                        <p class="text-muted">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>

                        <h3>Change password</h3>

						<form action="" method="post" id="Cpassword" class="register">
		                 <span id="register"></span>  
						 <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="password_old">Old password <span class="required">*</span></label>
                                     <input type="text" class="form-control" name="oldpass" id="password_old" value="<?php echo $iSingleValue['password'];?>" />
                                    </div>
                                </div>
                            </div>
							
							<div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
							   
                                        <label for="password_1">New password <span class="required">*</span></label>
                                        <input type="password" class="form-control" id="password_1" name="new_pass" />
                                    </div>
                                </div>
								
								<div class="col-sm-6">
                                    <div class="form-group">
					          <label for="password_2">Retype new password <span class="required">*</span></label>
                                        <input type="password" class="form-control" id="password_2" name="r_pass" />
                                    </div>
                                </div>
							</div>
							<div class="col-sm-12 text-center">
									<input type="hidden" id="_wpnonce" name="_wpnonce" value="7e707fc314">
									<input type="hidden" name="_wp_http_referer" value="/handmade/my-account/">	
									<input type="button"  name="register" onclick="action_cpass()" class="btn btn-primary" value="Save new password">
							
                                <!-- <i class="fa fa-save"></i> Save new password</button> -->
                            </div>
							
                            
					 
						   </form>
						
                       <!-- <form>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password_old">Old password</label>
                                        <input type="password" class="form-control" id="password_old">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password_1">New password</label>
                                        <input type="password" class="form-control" id="password_1">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password_2">Retype new password</label>
                                        <input type="password" class="form-control" id="password_2">
                                    </div>
                                </div>
                            </div>
                           

                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save new password</button>
                            </div>
                        </form>
  -->
   <!-- /.row -->
                      

                        <h3>Personal details</h3>
						<form action="" method="post"  class="uregister">
		                 <span id="uregister"></span>  
                          <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="firstname">Firstname</label>
                                   <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $iSingleValue['firstname'];?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="lastname">Lastname</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $iSingleValue['lastname'];?>">
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="company">Company</label>
                                     <input type="text" class="form-control" id="company" name="company" value="<?php echo $iSingleValue['company'];?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="street">Street</label>
                                        <input type="text" class="form-control" id="address" name="address" value="<?php echo $iSingleValue['address'];?>">
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" id="city" name="city" value="<?php echo $iSingleValue['city'];?>">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label for="zip">ZIP</label>
                                        <input type="text" class="form-control" id="zipcode" name="zipcode" value="<?php echo $iSingleValue['zipcode'];?>">
                                    </div>
                                </div>
                           

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input type="text" class="form-control" id="contactno" name="contactno" value="<?php echo $iSingleValue['contactno'];?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="emailid" name="emailid" value="<?php echo $iSingleValue['emailid'];?>">
                                    </div>
                                </div>
                                <div class="col-sm-12 text-center">
								   <input type="button"  onclick="action_cdeatails()" name="uregister" class="btn btn-primary" value="Save changes">
                                    

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <!-- /.container -->
        </div>
        </div>
		<?php include('inc.footer.php'); ?>	
    <?php include('inc.js.php'); ?>
	<script>
 function action_cpass()
 	{
		
		/* alert('action_cpass');  */
		
		
		 
 		 var password_1= document.getElementById('password_1').value;
		  /* alert('password_1');  */
		 var password_2= document.getElementById('password_2').value;
		/*  alert('password_2'); */
		 
		$.ajax({
				type: 'post',
				url:'cpass.php',
				data:{
					action           :"action_cpass",
					  
				new_pass        :  password_1,
				r_pass        :  password_2,
				},
				success: function( data){
					 /* alert(data); */
					
		if(data==1){
						$("#register").html('<p style="color:green;">Submit successfully.</p>');
						//document.getElementById('Cpassword').reset();
						window.location.href="customer-orders.php?id=<?php echo $iSingleValue['id']; ?>";
						
				}
				else{
					$("#register").html(data);
				}
				}
		});
	}
	</script>
	<script>
	function action_cdeatails()
 	{
		
		/* alert('action_cdeatails');  */
		
		
		 
 		 var firstname= document.getElementById('firstname').value;
		  /* alert('firstname');  */
		 var lastname= document.getElementById('lastname').value;
		/*  alert('lastname'); */
		 var company= document.getElementById('company').value;
		  /* alert('company');  */
		 var address= document.getElementById('address').value;
		/*  alert('address'); */
		 var city= document.getElementById('city').value;
		/*  alert('city'); */
		 var zipcode= document.getElementById('zipcode').value;
		  /* alert('zipcode');  */
		 var contactno= document.getElementById('contactno').value;
		/*  alert('contactno'); */
		 var emailid= document.getElementById('emailid').value;
		  /* alert('emailid');  */
		
		 
		$.ajax({
				type: 'post',
				url:'cuser.php',
				data:{
					action           :"action_cdeatails",
					  
				firstname      :  firstname,
				lastname       :  lastname,
				company        :  company,
				address        :  address,
				city           :  city,
				zipcode        :  zipcode,
				contactno      :  contactno,
				emailid        :  emailid,
				
				},
				success: function( data){
					 /* alert(data); */
					
		if(data==1){
						$("#register").html('<p style="color:green;">Submit successfully.</p>');
						//document.getElementById('Cpassword').reset();
						window.location.href="customer-orders.php?id=<?php echo $iSingleValue['id']; ?>";
						
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