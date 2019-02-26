 <?php  

include('../config.php'); 

include('inc.session.php');  

$PageTitle="Changep";

$FileName = 'Changep.php';

$iClassName = ADMIN_URL;

$validate=new Validation();

if($_SESSION['success']!="")

{

   $stat['success']=$_SESSION['success'];

   unset($_SESSION['success']);

}

if(isset($_POST['update']))
 	{ 
$validate->addRule($_POST['eid'],'email','emailid',true);
$validate->addRule($_POST['new'],'','New Password',true);
$validate->addRule($_POST['confirm'],'','Confirm Password',true);
if($validate->validate())
{
 $aryList=$db->getRow("select * from login where emailid = '".$_POST['eid']."'");
     if($aryList!='')
	   {
 	   if($_POST['new']==$_POST['confirm']) {
  		   $aryData=array(	
							'password'  =>	$_POST['new'],
							
 						 );  
 			 $flgIn = $db->updateAry("login", $aryData , "where emailid = '".$_POST['eid']."'");
 		 $stat['success']="password change Successfully";
 				unset($_POST);
    }
		else {
	    $stat['error']="Confirm password does not match";   
        }	
 }
   else
   {
	$stat['error']="Current Password does not match";   
   }
}
	 else {
	    $stat['error'] = $validate->errors();
        }
	}
	$iSingleValue=$db->getRow("select * from login where id = '".$_SESSION['user_id']."' ");



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
										     <input type="text" class="form-control required" id="userName" name="eid" value="<?php echo  $iSingleValue['emailid']; ?>">

                                                    </div>

                                                </div>
												

								                  <div class="form-group clearfix">

                                                    <label class="col-lg-2 control-label " for="userName">New Password*</label>

                                                    <div class="col-lg-10">

                                                        <input type="text" class="form-control required" id="userName" name="new" value="<?php echo $_POST['new']; ?>">

                                                    </div>

                                                </div>
												<div class="form-group clearfix">

                                                    <label class="col-lg-2 control-label " for="userName">Confirm Password*</label>

                                                    <div class="col-lg-10">

                                                        <input type="text" class="form-control required" id="userName" name="confirm" value="<?php echo $_POST['confirm']; ?>">

                                                    </div>

                                                </div>

										<button type="submit" name="update" class="btn btn-default">update</button>
										

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