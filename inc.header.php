<?php 
$iSingleValue=$db->getRow("select * from customerdeatails where id='".$_SESSION['userid']."'");

 
 if($_SESSION['userid']!='') {  

  $flgInReg = $db->update("update  customerdeatails set  no_of_click = no_of_click + 1  where id = '".$_SESSION['userid']."' ");
 
 }
 
 
 if($_GET['id']!='')
 {
	$id =$_GET['id']; 
	
	
 	   
     $flgIn1 = $db->update("update product set  no_of_click = no_of_click + 1 , percentage_click = percentage_click +0.07  where id = $id ");
	
	
	$cateogy_id =  $db->getVal("select category_id from product where id= $id");
	     
	 $flgIn1 = $db->update("update category set  click = click + 1 where id = $cateogy_id ");
                  
	
	
	
 }
 else
 {
	 $id='0';
 }
 	
	  $aryData=array(	
						'ip_address'     			=>	$ua['ipaddress'],
						'datetime'     			=>	date("Y-m-d h:i:s"),
						'page_name'     			=>	$request_url,
						'product_id'     			=>	$id,
						'status'     			=>	1,
 						
 					 );
	   
	   
	    $flgIn1 = $db->insertAry("user_move",$aryData);
 
 
?>

 <!-- *** TOPBAR ***
 _________________________________________________________ -->
    <div id="top">
        <div class="container">
            <div class="col-md-6 offer" data-animate="fadeInDown">
                <a href="#" class="btn btn-success btn-sm" data-animate-hover="shake">Only Today</a>  <a href="#">With any purchase you will have a Gift!</a>
            </div>
            <div class="col-md-6" data-animate="fadeInDown">
                <ul class="menu">
				<?php if($_SESSION['userid']=='')
				{
				?>
                    <li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a>
                    </li>
                    <li><a href="register.php">Register</a>
                    </li>
                    <li><a href="contact.php">Contact</a>
				<?php }
else{?>
		
                   <li>
				   
                    <font color="white"> Welcome : <?php echo $iSingleValue["firstname"]?></font>
                                </li>
                    <li>
                                    <a href="customer-account.php"><i class="fa fa-user"></i> My account</a>
                                </li>
                                <li>
                                    <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                                </li>
<?php }?>
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
					
					<form action=" " id="LoginForm"  method="post" class="log">
						<span id="log"></span>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="emailid" id="ema">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="pass">
                            </div>
                            <div class="text-center">
                               <input type="button" onclick="action_log()" class="btn btn-primary" value="Log in" />
                            </div>
                        </form> 
						<br>

                        <p class="text-center text-muted">Not registered yet?</p>
                        <p class="text-center text-muted"><a href="register.php"><strong>Register now</strong></a>! It is easy and done in 1&nbsp;minute and gives you access to special discounts and much more!</p>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- *** TOP BAR END *** -->

    <!-- *** NAVBAR ***
 _________________________________________________________ -->

    <div class="navbar navbar-default yamm" role="navigation" id="navbar">
        <div class="container">
            <div class="navbar-header">

                <a class="navbar-brand home" href="index.php" data-animate-hover="bounce">
                    <img src="uploads/logon.jpg" alt="logo" class="hidden-xs" width="150" height="50" >
                    <img src="uploads/logon.jpg" alt="logo" class="visible-xs" width="150" height="50"><span class="sr-only">Ecommerce  - go to homepage</span>
                </a>
                <div class="navbar-buttons">

                    
                    <a class="btn btn-default navbar-toggle" href="basket.php">
                        <i class="fa fa-shopping-cart"></i>  <span class="hidden-xs"><?php echo $db->getVal("select count(id) from cartdetail");?>items in cart</span>
                    </a>
                </div>
            </div>
            <!--/.navbar-header -->

            <div class="navbar-collapse collapse" id="navigation">

                <ul class="nav navbar-nav navbar-left">
                    <li class="active"><a href="index.php">Home</a> </li>
                   
				<?php
					 $aryList=$db->getRows("select * from  category order by id desc");
							 foreach($aryList as $iList)
									{	
									
							 ?>       
               <li class="dropdown yamm-fw">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200"><?php echo $iList['categoryname']; ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="yamm-content">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h5><?php echo $iList['categoryname']; ?></h5>
                                            <ul>
                                             <?php
					 $aryList=$db->getRows("select *from  subcategory where category_id='".$iList['id']."' order by id desc");
							 foreach($aryList as $iList)
									{	
							 ?>     
                      <li><?php echo $iList['subcategory']; ?>
					  
					   <ul>
                                             <?php
					 $aryList=$db->getRows("select * from  childcategory where subcategory_id='".$iList['id']."' order by id desc");
							 foreach($aryList as $iList)
									{	
							 ?>     
                      <li><a href="<?php echo URL_ROOT; ?>apple-iphones.php?id=<?php echo $iList['id']; ?>"><?php echo $iList['childcategory']; ?></a></li>

									<?php } ?>					  
                                            </ul>
					  
					  
					  </li>
									<?php } ?>					  
                                            </ul>
											
                                        </div>
                                        
                                    </div>
                                </div>
                                <!-- /.yamm-content -->
                            </li>
                        </ul>
                    </li>
<?php } ?>
                    
					
					

                    <li class="dropdown yamm-fw">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">My Account <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="yamm-content">
                                    <div class="row">
                                        <div class="col-sm-3">
										
                                            <h5>User</h5>
                                            <ul>
                                                <li><a href="register.php">Register / login</a>
                                                </li>
                                                <li><a href="customer-orders.php">Orders history</a>
                                                </li>
                                                <li><a href="customer-order.php">Order history detail</a>
                                                </li>
                                                <li><a href="customer-wishlist.php">Wishlist</a>
                                                </li>
                                                <li><a href="customer-account.php">Customer account / change password</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-3">
                                            <h5>Other pages</h5>
                                            <ul>
                                                <li><a href="faq.php">FAQ</a>
                                                </li>
                                                <li><a href="contact.php">Contact us</a>
                                                </li>
                                              
                                            </ul>
                                        </div>
                                        
                                    </div>
                                </div>
                                
                            </li>
                        </ul>
                    </li>   
                </ul>

            </div>
            <!--/.nav-collapse -->

            <div class="navbar-buttons">
                  
                <div class="navbar-collapse collapse right" id="basket-overview">
                    <a href="basket.php" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span class="hidden-sm"><?php echo $db->getVal("select count(id) from cartdetail");?> items in cart</span></a>
                </div>
                <!--/.nav-collapse -->

                <div class="navbar-collapse collapse right" id="search-not-mobile">
                    <button type="button" class="btn navbar-btn btn-primary" data-toggle="collapse" data-target="#search">
                        <span class="sr-only">Toggle search</span>
                        <i class="fa fa-search"></i>
                    </button>
                </div>

            </div>

            <div class="collapse clearfix" id="search">

                <form class="navbar-form" role="search" action="<?php echo URL_ROOT;?>index.php" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" name="event" value="<?php echo $_GET['event'];?>">
                        <span class="input-group-btn">

			<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>

		    </span>
                    </div>
                </form>

            </div>
            <!--/.nav-collapse -->

        </div>
        <!-- /.container -->
    </div>
    <!-- /#navbar -->

    <!-- *** NAVBAR END *** -->
<script src="js/jquery.min.js" type="text/javascript"></script>	
<script>
function action_log()
 	{
	/* alert('action_log');  */
	 		 var ema= document.getElementById('ema').value;
		 /* alert('ema'); */
		 var pass= document.getElementById('pass').value;
		  /* alert('pass'); */
		$.ajax({
				type: 'post',
				url:'ajax.php',
				data:{
					action           :"action_log",
					
					emailid		     :	ema,
					password         :  pass,
				},
				
				success: function( data){
					/* alert(data); */

		if(data==1){
						//$("#log").html('<p style="color:green;">Login successfully.</p>');
						
						 window.location.href="index.php?id=<?php echo $iList['id']?>"; 
					}
				else{
					$("#log").html(data);
				}
				}
		});
	}	
</script>

