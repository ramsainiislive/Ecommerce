 <?php  

include('../config.php'); 

include('inc.session.php'); 

$PageTitle="Login";

$FileName = 'login.php';

$iClassName = ADMIN_URL;

$validate=new Validation();

if($_SESSION['success']!="")

{

   $stat['success']=$_SESSION['success'];

   unset($_SESSION['success']);

}

if(isset($_POST['addnewrecord']))
	
	{
		$validate->addRule($_POST['emailid'],'email','Emaild Id',true);
	    $validate->addRule($_POST['password'],'','password',true);
	if($validate->validate() && count($stat)==0)
	{
		
		$aryData=array(	        
									'emailid'     	=>	$_POST['emailid'],
									'password'     	=>	$_POST['password'],
									
							  );  
							
							$flgIn = $db->insertAry("login",$aryData);
							 $stat['success']="Data insert Successfully";
							
	  
	}
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

					    $aryDetail=$db->getRow("select * from  admin_login where id='".$_SESSION[LOGIN_ADMIN]['id']."'");

					   ?>

                           

                                 	<div class="card-box">

 									<form role="form" action="" method="post" enctype="multipart/form-data">

                                        <div>

                                           

                                            <section>

                                                <div class="form-group clearfix">

                                                    <label class="col-lg-2 control-label " for="userName">Email Id *</label>

                                                    <div class="col-lg-10">
                                               <input type="text" class="form-control required" id="userName" name="emailid" value="<?php echo  $_POST['emailid']; ?>">

                                                    </div>

                                                </div>

								                  <div class="form-group clearfix">

                                                    <label class="col-lg-2 control-label " for="userName">Password*</label>

                                                    <div class="col-lg-10">

                                                        <input type="text" class="form-control required" id="userName" name="password" value="<?php echo $_POST['password']; ?>">

                                                    </div>

                                                </div>

										<button type="submit" name="addnewrecord" class="btn btn-default">create user</button>
										<a href="http://localhost/fresh/admin/changep.php">Change password</a>

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