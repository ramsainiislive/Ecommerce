<?php include('config.php');


echo $_SESSION['cartid'];
$FileName ='basket.php';

if($_POST['action']=='addtocart') {
 
 $iPIDALreadyExit=$db->getVal("select * from cartdetail where cartid='".$_SESSION['cartid']."' and pid = '".$_POST['pid']."'");
 if( $iPIDALreadyExit=='') {
 $aryData=array(	
				                'pid'   =>	$_POST['pid'],
								'qty'   =>	$_POST['qty'],
								'cartid'   =>	 $_SESSION['cartid'],
						  	  	);  
				$flgIn = $db->insertAry("cartdetail",$aryData);

	}
	else{
		
            $aryData=array(	
				                'pid'   =>	$_POST['pid'],
								'qty'   =>	$_POST['qty'],
								'cartid'   =>	 $_SESSION['cartid'],
						  	  	);  
				$flgIn = $db->updateAry("cartdetail",$aryData,"where id = '".$iPIDALreadyExit['cartid']."' and pid = '".$_POST['pid']."'");
		        echo $flgIn = $db->getLastQuery();
                  exit();				
		
		 
	}

}



elseif(($_REQUEST['action']=='delete'))
	        {
			    $flgIn1 = $db->delete("cartdetail","where id='".$_GET['id']."' and cartid = '".$_SESSION['cartid']."'");	
			  
                redirect($FileName);	
	        } 
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<?php include('inc.meta.php');?>
    
</head>

<body>
 <?php include('inc.header.php'); ?>


    <div id="all">

        <div id="content">
            <div class="container">
			      

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="index1.php">Home</a>
                        </li>
                        <li>Shopping cart</li>
                    </ul>
                </div>

                <div class="col-md-9" id="basket">

                    <div class="box">

                        <form method="post" action="checkout1.php?id=<?php echo $iList['id']; ?>">

                            <h1>Shopping cart</h1>
                            <p class="text-muted">You currently item(s) in your cart.</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Product</th>
                                            <th>Quantity</th>
                                            <th>Unit price</th>
                                            <th>Discount</th>
                                            <th colspan="2">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
						 
										$GetEmailId=$db->getRows("select * from cartdetail where cartid='".$_SESSION['cartid']."' ");
							 foreach($GetEmailId as $iList)
									{
										
				$iPrfoductDetail=$db->getRow("select * from product where id='".$iList['pid']."' ");						
							 ?> 
                                        <tr>
                                            <td>
                                                <a href="#">
                                 <img src="uploads/<?php echo $iPrfoductDetail['uploadimage'];?>" alt="" width="450" height="600" class="img-responsive">
                                                </a>
                                            </td>
                                            <td><a href="#"><?php echo $iPrfoductDetail['title']; ?></a>
                                            </td>
                                            											
											<td><?php echo $iList['qty'];?></td>

                                            
                                            <td><?php echo $iPrfoductDetail['price'];?>.00</td>
                                            <td>KD 0.00</td>
                                            <td><?php echo $iTOtalPrice = $iPrfoductDetail['price']*$iList['qty'];?>.00</td>
											<td>
<a href="<?php echo $FileName; ?>?action=delete&id=<?php echo $iList['id']; ?>"><i class="fa fa-trash-o"></i></a>									
											</td>
                                           
                                            
                                        </tr>
								<?php $iFinalPrice +=	$iTOtalPrice; }?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5">Total</th>
                                            <th colspan="2"><?php echo $iFinalPrice; ?>.00</th>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
						
                            <!-- /.table-responsive -->

                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="category.php?id=<?php echo $iList['id']; ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i> Continue shopping</a>
                                </div>
                                <div class="pull-right">
                                    <button class="btn btn-default"><i class="fa fa-refresh"></i> Update basket</button>
                                    <button type="submit" class="btn btn-primary">Proceed to checkout <i class="fa fa-chevron-right"></i>
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
                                        <th><?php echo $iList['price']; ?></th>
                                    </tr>
                                    <tr>
                                        <td>Shipping and handling</td>
                                        <th><?php echo $iList['price']; ?>.00</th>
                                    </tr>
                                    <tr>
                                        <td>Tax</td>
                                       <th><?php echo $iList['price']; ?>.00</th>
                                    </tr>
                                    <tr class="total">
                                        <td>Total</td>
                                        <th><?php echo $iList['price']; ?>.00</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
					 				

                    <div class="box">
                        <div class="box-header">
                            <h4>Coupon code</h4>
                        </div>
                        <p class="text-muted">If you have a coupon code, please enter it to apply.</p>
                        <form>
                            <div class="input-group">

                                <input type="text" class="form-control">

                                <span class="input-group-btn">

					<button class="btn btn-primary" type="button"><i class="fa fa-gift"></i></button>

				    </span>
                            </div>
                            <!-- /input-group -->
                        </form>
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