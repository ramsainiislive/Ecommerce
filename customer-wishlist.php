<?php include('config.php');
if($_SESSION['userid']=='')
	{
		 redirect('index.php');
	}

 $iSingleValue=$db->getRow("select * from customerdeatails where id='".$_SESSION['userid']."'"); 
 

if(isset($_POST['wishlist'])) {
 /* 
 $iPIDALreadyExit=$db->getVal("select * from wishlist where cartid='".$_SESSION['cartid']."' and pid = '".$_POST['pid']."'");
 if( $iPIDALreadyExit=='') { */
 $aryData=array(	              
                                'uid'   =>	 $_SESSION['userid'], 
				                'pid'   =>	$_POST['pid'],
								'cartid'   =>	 $_SESSION['cartid'],
						  	  	);  
				$flgIn = $db->insertAry("wishlist",$aryData);
				/* echo $flgIn = $db->getLastQuery();
                  exit(); */
                  redirect('detail.php?id='.$_POST['pid']);
	}
	/* else{
		
            $aryData=array(	
				                'pid'   =>	$_POST['pid'],
								
								'cartid'   =>	 $_SESSION['cartid'],
						  	  	);  
				$flgIn = $db->updateAry("wishlist",$aryData,"where id = '".$iPIDALreadyExit['cartid']."' and pid = '".$_POST['pid']."'");
		        				
		
		 
	}


} */




 
							
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
                       

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
									    <th colspan="2">Image</th>
                                        <th colspan="2">Productname</th>
                                       
                                        <th>Unit price</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								
						 $GetEmailId=$db->getRows("select * from wishlist where uid='".$_SESSION['userid']."' ");
							 foreach($GetEmailId as $iList)
									{
						$GetData=$db->getRow("select * from product where id='".$iList['pid']."' ");
										?>
                                    <tr>
                                         <td>
                                             
                                 <img src="uploads/<?php echo $GetData['uploadimage'];?>" alt="" width="450" height="600" class="img-responsive">
                                            </td>
											<td>
                                            <a href="#">
                                            </a>
                                        </td>
                                        <td><a href="#"><?php echo $GetData['title']; ?></a>
										
                                        </td>
										<td>
                                            <a href="#">
                                            </a>
                                        </td>
                                       
                                        <td><?php echo $GetData['price'];?></td>
                                        
                                        
                                    </tr>
							  <?php }?>
                                    
                                </tbody>
                                
                            </table>

                        </div>
                        <!-- /.table-responsive -->

                       
                    </div>
                </div>

            </div>
            <!-- /.container -->
        </div>
         <?php include('inc.footer.php'); ?>	
    <?php include('inc.js.php'); ?>
</body>

</html>