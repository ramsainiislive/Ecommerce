<?php include('../config.php'); 

include('inc.session.php');

$PageTitle="Order Feed";

$FileName = 'orderfeed.php';

$validate=new Validation();

if($_SESSION['success']!="")

{

   $stat['success']=$_SESSION['success'];

   unset($_SESSION['success']);

}

if(isset($_POST['update']))

	{ 
	  $aryData=array(	
       				'status'     	 	         		    =>	$_POST['status'],

								 );  

					$flgIn = $db->updateAry("orderfeed", $aryData , "where id='".$_GET['id']."'");
       			$_SESSION['success']="Update Successfully";

					unset($_POST);

					redirect($iClassName.$FileName);

							

	}

elseif(($_REQUEST['action']=='delete'))

	{

			 	 $flgIn1 = $db->delete("orderfeed","where id='".$_GET['id']."'");			

			     $_SESSION['success'] = 'Deleted Successfully';

                 redirect(ADMIN_URL.$FileName);	

	} 
?>
<?php						                                      
                       
					$GetEmailId=$db->getRows("select * from orderfeed  where userid='".$_GET['id']."'");
							 foreach($GetEmailId as $iList)
								{	$i=$i+1;

									$aryPgAct["id"]=$iList['id'];
								 
								$iProductDetail=$db->getRow("select * from customerdeatails where id='".$iList['userid']."'");}
							 
							 ?> 	
	
	



<!DOCTYPE html>

<html>

	<head>

		 <?php include('inc.meta.php'); ?>

	</head>

	<body class="fixed-left">

		<div id="wrapper">

             <?php include('inc.header.php'); ?> 

			 <?php include('inc.sideleft.php'); ?>

             

		 



			 

			<div class="content-page">

				<!-- Start content -->

				<div class="content">

					<div class="container">



						<!-- Page-Title -->

						<div class="row">

							<div class="col-sm-12">

								<h4 class="page-title"><?php echo $PageTitle; ?></h4>

								<ol class="breadcrumb">

									<li>

										<a href="<?php echo $iClassName; ?>">Home</a>

									</li>

									 

									<li class="active">

										<?php echo $PageTitle; ?>

									</li>

								</ol>

							</div>

						</div>



                        

                        

                        <!-- Basic Form Wizard -->

                        <div class="row">

                            <div class="col-md-12">

							

                                 <div class="card-box aplhanewclass">

                            		<div class="row">

                            				<div class="col-md-9">

                                        		<?php echo msg($stat); ?>

                                        	</div>

                                        	<div class="col-md-3">

							     <!-- <a href="<?php echo $iClassName.$FileName; ?>?action=add"  class="btn btn-default" style="float:right">Add New Record</a> --> 

                                 		 </div>

                                  </div>

							</div>

							<?php if($_GET['action']=='edit') { 

					    $aryDetail=$db->getRow("select * from  orderfeed where id='".$_GET['id']."'");
						
 $aryDetailName=$db->getRow("select * from  poducts where id = '".$aryDetail['product_id']."'");	

					   ?>

                           

                                                             	<div class="card-box">

 									<form role="form" action="" method="post" enctype="multipart/form-data">

                                        <div>

                                           

                                            <section>
											
										<div class="form-group clearfix">

                                         <label class="col-lg-2 control-label " for="userName">Product Name  </label>

                                                    <div class="col-lg-10">

 <input type="text" class="form-control required"  value="<?php echo $aryDetailName['title']; ?>">

                                                    </div>

                                                </div>

									<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="userName">Order feeds </label>
									
									<div class="col-lg-10">
						<textarea class="form-control required"><?php echo $aryDetail['order_desc']; ?></textarea>		
									
											
									</div>
									
									</div>
										
										
                                                

                                      <div class="form-group clearfix">

                                           <label class="col-lg-2 control-label " for="confirm">Status </label>

										    <div class="col-lg-10">

                                            <select  class="required form-control" name="status">

                                              <option value="1" <?php if($aryDetail['status']=='1') { echo "selected"; } ?>>Active</option>

							<option value="0" <?php if($aryDetail['status']=='0') { echo "selected"; } ?>>Inactive</option>

                                                

                                               

                                            </select>

                                        </div>

										</div>

                                	<button type="submit" name="update" class="btn btn-default">Submit</button>

                                     <a  href="<?php echo $iClassName.$FileName; ?>"  class="btn btn-default" >Back</a>      

                                            </section>

                                              

                                        </div>

                                    </form> 

                             	</div>

         <?php  } 
		elseif($_GET['action']=='view') { 
                  ?>
                  	<div class="card-box">
				<form role="form" action="" method="post" enctype="multipart/form-data">
				<div class="row addresses">
                            
                            <div class="col-md-6">
							   <font align="left">
                                <h2>Shipping address</h2>
              <p> Customer Name : <font color="red"><?php echo $iProductDetail["firstname"]  ?><?php echo $iProductDetail["lastname"]  ?></font><br>
              Customer Address : <font color="red"> <?php echo $iProductDetail["address"]  ?></font><br>
				Customer EmailId : <font color="red"> <?php echo $iProductDetail["emailid"]  ?></font>
                                    </p>
									</font>
                            </div>
							<div class="col-md-6">
                                <h2>Billing address</h2>
              <p> Customer Name : <font color="red"><?php echo $iProductDetail["firstname"]  ?><?php echo $iProductDetail["lastname"]  ?></font><br>
              Customer Address : <font color="red"> <?php echo $iProductDetail["address"]  ?></font><br>
				Customer EmailId : <font color="red"> <?php echo $iProductDetail["emailid"]  ?></font>
                                    </p>
									</font>
                            </div>
                        </div>
                        <hr>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
									    <th>orderid</th>
                                        <th>Product</th>
										 <th>Date</th>
                                        <th>Quantity</th>
                                        <th>Unit price</th>
                                         <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php						                                      
                       
					$GetEmailId=$db->getRows("select * from orderfeed  where userid='".$_GET['id']."'");
							 foreach($GetEmailId as $iList)
								{	$i=$i+1;

									$aryPgAct["id"]=$iList['id'];
								 
								$iProductDetail=$db->getRow("select * from customerdeatails where id='".$iList['userid']."'");
							 
							 ?> 	
	
								
						
                                    <tr>
									    <td><?php echo $iList['orderid'];?></td>
                                        <td><?php $iProductDet=$db->getRow("select * from product where id='".$iList['Productid']."' "); ?>
							
										<?php echo $iProductDet['title']; ?> </td>
                                        <td><?php echo $iProductDetail['date'];?></td>
									     <td><?php echo $iList['quantity'];?></td>
                                        <td><?php echo $iList['price'];?></td>
                                        
                                        <td><?php echo  $iList['total'];?>.00</td>
                                    </tr>
                                   
								<?php } ?>
                                    
                                </tbody>
                               
                            </table>

                        </div>
                        <!-- /.table-responsive -->

                        
                       <a  href="<?php echo $iClassName.$FileName; ?>"  class="btn btn-default" >Back</a>      
                                        </div>

                                    </form> 

                             	</div>

         <?php  } 

			   else { ?> 

                                <div class="card-box">

                               

                                    <table id="datatable" class="table table-striped table-bordered">

                                            <thead>

                                                <tr>

												   <th>#</th>

													 <th>Product Name</th>
													 <th>Full Name</th>
													 <th>Email Id</th>
													  <th>Mobile No</th>
													  <th>Action</th>
													 

                                               </tr>

                                            </thead>

                                            <tbody>
							
					<?php						                                      

					$GetEmailId=$db->getRows("select * from orderfeed ");
							 foreach($GetEmailId as $iList)
									

									{	$i=$i+1;

									$aryPgAct["id"]=$iList['id'];
							 $iProductDetail=$db->getRow("select * from customerdeatails where id='".$iList['userid']."' "); 
							 

							 ?> 

                                                <tr>

												    <td><?php echo $i ?></td>
													
                                         
										<td><?php $iProductDet=$db->getRow("select title from product where id='".$iList['Productid']."' "); ?>
										<?php echo $iProductDet['title']; ?> </td>
										  <td><?php echo $iProductDetail['firstname']; ?><?php echo $iProductDetail['lastname']; ?></td>
											<td><?php echo $iProductDetail['emailid']; ?></td>
											<td><?php echo $iProductDetail['contactno']; ?></td>
									                             <td>
      <a href="<?php echo $FileName; ?>?action=view&id=<?php echo $iList['userid']; ?>" class="table-action-btn"> <i class="fa fa-search"></i></a>
      
      </td>		
			
                                                </tr>

     

												<?php } ?>

                                            </tbody>

                                        </table>

								   </div>

                            <?php } ?> 

								



								

                        	</div>

                    	</div>



                         



                    </div>  

                               

                </div>  



               <?php include('inc.footer.php'); ?>



            </div>

             

         </div>

          <?php include('inc.js.php'); ?>

	</body>

</html>