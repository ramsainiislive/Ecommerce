 <?php  

include('../config.php'); 
include('inc.session.php'); 

$PageTitle="Profile view";

$FileName = 'profileview.php';

$iClassName = ADMIN_URL;

$validate=new Validation();

if($_SESSION['success']!="")

{

   $stat['success']=$_SESSION['success'];

   unset($_SESSION['success']);

}


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

 				<div class="content">

					<div class="container">

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

                    

                                  </div>

							</div>

                     <?php 

					   $aryDetail=$db->getRow("select * from  admin_deatails where id='".$_SESSION['user_id']."'");

					   ?>

                           

                                 	<div class="card-box">

 									<form role="form" action="dashboard.php" method="post" enctype="multipart/form-data">

                                        <div>

                                           

                                            <section>
				<div class="form-group clearfix">
                   <label class="col-lg-2 control-label " for="fullname">Fullname*</label>
                         <div class="col-lg-10">
                              <?php echo $aryDetail['fullname']; ?>
							  </div>
                      </div>
					  

												
												<div class="form-group clearfix">

                                                    <label class="col-lg-2 control-label " for="address">Address*</label>

                                                    <div class="col-lg-10">

                                                       <?php echo  $aryDetail['address']; ?>

                                                    </div>

                                                </div>
												
												
												<div class="form-group clearfix">

                                                    <label class="col-lg-2 control-label " for="userName">City *</label>

                                                    <div class="col-lg-10">

                                                        <?php echo $aryDetail['city']; ?>

                                                    </div>

                                                </div>

												 <div class="form-group clearfix">

                                                    <label class="col-lg-2 control-label " for="userName">Contact No. *</label>

                                                    <div class="col-lg-10">

                                                       <?php echo $aryDetail['contactno']; ?>

                                                    </div>

                                                </div>

                                                <div class="form-group clearfix">

                                                    <label class="col-lg-2 control-label " for="userName">Email Id *</label>

                                                    <div class="col-lg-10">

                                                       <?php echo $aryDetail['emailid']; ?>

                                                    </div>

                                                </div>

								                  
					                             <div class="form-group clearfix">

                                                    <label class="col-lg-2 control-label " for="userName">Image *</label>

                                                    <div class="col-lg-10">
													
													   <img src = "uploads/<?php echo $aryDetail['uploadimage'];?>" style="height:100px;">
                                                    </div>

                                                </div>	
												 <div class="form-group clearfix">

                                                    <label class="col-lg-2 control-label " for="userName">State*</label>

                                                    <div class="col-lg-10">

                                                       <?php echo $aryDetail['state']; ?>

                                                    </div>

                                                </div>
												 <div class="form-group clearfix">

                                                    <label class="col-lg-2 control-label " for="userName">Country *</label>

                                                    <div class="col-lg-10">

                                                       <?php echo $aryDetail['country']; ?>

                                                    </div>

                                                </div>
                                       <button type="submit" name="Back" class="btn btn-default">Back</button>
									   
                                            </section>

                                        </div>

                                    </form> 
                                      
                             	</div>

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