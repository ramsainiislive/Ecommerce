 <?php  

include('../config.php'); 
include('inc.session.php'); 

$PageTitle="Update Profile";

$FileName = 'login_profile.php';

$iClassName = ADMIN_URL;

$validate=new Validation();

if($_SESSION['success']!="")

{

   $stat['success']=$_SESSION['success'];

   unset($_SESSION['success']);

}



if(isset($_POST['update']))

	{ 
    $validate->addRule($_POST['fullname'],'','fullname',true);
	$validate->addRule($_POST['address'],'','address',true);
	$validate->addRule($_POST['city'],'','city',true);
	$validate->addRule($_POST['contactno'],'','contactno',true);
	$validate->addRule($_POST['emailid'],'','emailid',true);
	if($validate->validate() && count($stat)==0)
	{	{
if(isset($_FILES["uploadimage"]["name"]) && !empty($_FILES["uploadimage"]["name"]))

				{	 

 					$filename = basename($_FILES['uploadimage']['name']);

					$ext1 = strtolower(substr($filename, strrpos($filename, '.')+1));

					
						$newfile2=md5(time())."_".$filename;

 						move_uploaded_file($_FILES['uploadimage']['tmp_name'],"uploads/".$newfile2);

 					
				 } 
		
   		   $aryData=array
						(	
				'fullname'     => $_POST['fullname'],
				'address'      => $_POST['address'],
				'city'          => $_POST['city'],
				'contactno'     =>$_POST['contactno'],
				'emailid'       => $_POST['emailid'],
				'uploadimage'    =>	$newfile2,		
								
								
 						 );  
 			 $flgIn = $db->updateAry("admin_deatails", $aryData , "where id='".$_SESSION['user_id']."'");		

			/* echo  $flgIn = $db->getLastQuery();
			 exit();  */
 		      $stat['success']="Data change Successfully";
			 echo '1';
 			 
    } }
	else
		          {
			       $stat["error"]=$validate->errors();
		           }
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

 									<form role="form" action="" method="post" enctype="multipart/form-data">

                                        <div>

                                           

                                            <section>
				<div class="form-group clearfix">
                   <label class="col-lg-2 control-label " for="fullname">Fullname*</label>
                         <div class="col-lg-10">
                              <input type="text" class="form-control required" id="userName" name="fullname" value="<?php echo $aryDetail['fullname']; ?>">
                         </div>
                      </div>
												
												<div class="form-group clearfix">

                                                    <label class="col-lg-2 control-label " for="address">Address*</label>

                                                    <div class="col-lg-10">

                                                        <input type="text" class="form-control required" id="userName" name="address" value="<?php echo  $aryDetail['address']; ?>">

                                                    </div>

                                                </div>
												
												
												<div class="form-group clearfix">

                                                    <label class="col-lg-2 control-label " for="userName">City *</label>

                                                    <div class="col-lg-10">

                                                        <input type="text" class="form-control required" id="userName" name="city" value="<?php echo $aryDetail['city']; ?>">

                                                    </div>

                                                </div>

												 <div class="form-group clearfix">

                                                    <label class="col-lg-2 control-label " for="userName">Contact No. *</label>

                                                    <div class="col-lg-10">

                                                        <input type="text" class="form-control required" id="userName" name="contactno" value="<?php echo $aryDetail['contactno']; ?>">

                                                    </div>

                                                </div>

                                                <div class="form-group clearfix">

                                                    <label class="col-lg-2 control-label " for="userName">Email Id *</label>

                                                    <div class="col-lg-10">

                                                        <input type="text" class="form-control required" id="userName" name="emailid" value="<?php echo $aryDetail['emailid']; ?>">

                                                    </div>

                                                </div>

								                  
					                                       <div class="form-group clearfix">

                                                    <label class="col-lg-2 control-label " for="userName">Image *</label>

                                                    <div class="col-lg-10">
													<input type="file" class="form-control " id="uploadimage" name="uploadimage">
												   <input type="hidden" class="required form-control" name="uploadimage_old"  value="<?php echo $aryDetail['uploadimage'];?> ">
													   <img src = "uploads/<?php echo $aryDetail['uploadimage'];?>" style="height:100px;">
                                                    </div>

                                                </div>						

												                                       

										<button type="submit" name="update" class="btn btn-default">Update</button>

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