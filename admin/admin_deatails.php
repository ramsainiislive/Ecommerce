<?php include('../config.php');
$PageTitle="Admin_deatails";
$FileName ='admin_deatails.php';
$validate=new Validation();
if($_SESSION['success']!="")
  {
     $stat['success']=$_SESSION['success'];
     unset($_SESSION['success']);
  }
 if(isset($_POST['addnewrecord'])){
	        $validate->addRule($_POST['fullname'],'alpha','Fullname',true); 
			$validate->addRule($_POST['emailid'],'email','Emailid',true);
			$validate->addRule($_POST['password'],'','password',true);
			 $validate->addRule($_POST['contactno'],'num','contactno',true);
		   	 $validate->addRule($_POST['address'],'','address',true);
		    $validate->addRule($_POST['city'],'','city',true);
		   $validate->addRule($_POST['state'],'','state',true);
		   $validate->addRule($_POST['country'],'','country',true);
		     $validate->addRule($_POST['zip_code'],'','zip_code',true);
		   $validate->addRule($_POST['gender'],'','gender',true);
		  
		   
		  if($validate->validate() && count($stat)==0)
		    {	
            $aryChkName=$db->getRow("select emailid from  admin_deatails where emailid='".$_POST['emailid']."'");
				if(is_array($aryChkName) && count($aryChkName)>0){   		   
				$stat['error'] = "This Email is Already Exist";
				}
				else{
 


		        if(isset($_FILES["uploadimage"]["name"]) && !empty($_FILES["uploadimage"]["name"]))

				{	 

 					$filename = basename($_FILES['uploadimage']['name']);

					$ext1 = strtolower(substr($filename, strrpos($filename, '.')+1));
						$newfile2=md5(time())."_".$filename;

 						move_uploaded_file($_FILES['uploadimage']['tmp_name'],"uploads/".$newfile2);
					 } 
 			     $aryData=array(	        
									'fullname'     =>	$_POST['fullname'],
									'emailid'    =>	$_POST['emailid'],
									'password'      =>	$_POST['password'],								
									'contactno'     	=>	$_POST['contactno'],
									'address'   =>	$_POST['address'],
									'city'     	=>	$_POST['city'],
									'state'     	=>	$_POST['state'],
									'country'     	=>	$_POST['country'],
									'zip_code'     	=>	$_POST['zip_code'],
									'gender'    =>	$_POST['gender'],
									'uploadimage'    =>	$newfile2,
							  );  
							
							
				$flgIn = $db->insertAry("admin_deatails",$aryData);
				/*  echo $flgIn = $db->getLastQuery();
				exit(); */
				echo "Registered Successfully";
				redirect('index.php');
			}}
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
	

		<div class="content">
					<div class="container">


                        <!-- Basic Form Wizard -->

                        <div class="row">
                              <div class="col-md-12">
                                     <div class="col-sm-12">

								<h4 class="page-title"><?php echo $PageTitle; ?></h4>


							</div>
							

                                 <div class="card-box aplhanewclass">

                            		<div class="row">

                            				<div class="col-md-9">

                                        		<?php echo msg($stat); ?>

                                        	</div>

                    

                                  </div>

							</div>
                           

                              	<div class="card-box">

 									<form role="form" action="" method="post" enctype="multipart/form-data">

                                      

										<div class="form-group clearfix">
										

											 <label class="col-lg-1 control-label " for="fullname">Fullname</label>

											 <div class="col-lg-6">
                        
						<input type="text" id="" name="fullname" value="<?php echo $_POST['fullname']; ?>" class="form-control required">
										   </div>
                                        </div>
										<div class="form-group clearfix">

											 <label class="col-lg-1 control-label " for="emailid">Emailid</label>

											<div class="col-lg-6">
                  <input type="text" id="" name="emailid" value="<?php echo $_POST['emailid']; ?>" class="form-control required">
										 </div>

                                        </div>
										<div class="form-group clearfix">

											 <label class="col-lg-1 control-label " for="password">Password</label>

											 <div class="col-lg-6">

						<input type="password" id="" name="password" value="<?php echo $_POST['password']; ?>" class="form-control required">

											  </div>

                                        </div>
										<div class="form-group clearfix">

											 <label class="col-lg-1 control-label " for="contactno">Contact No</label>

											 <div class="col-lg-6">

							<input type="text" id="" name="contactno" value="<?php echo $_POST['contactno']; ?>" class="form-control required">

											  </div>

                                        </div>
										<div class="form-group clearfix">

											 <label class="col-lg-1 control-label " for="address">Address</label>

											<div class="col-lg-6">

										 <input type="text" id="" name="address" value="<?php echo $_POST['address']; ?>" class="form-control required">

											  </div>

                                        </div>
										<div class="form-group clearfix">

											 <label class="col-lg-1 control-label " for="city">City</label>

											 <div class="col-lg-6">

										  <input type="text" id="" name="city" value="<?php echo $_POST['city']; ?>" class="form-control required">

											  </div>

                                        </div>
										<div class="form-group clearfix">

											 <label class="col-lg-1 control-label " for="state">State </label>

											 <div class="col-lg-6">

										  <input type="text" id="" name="state" value="<?php echo $_POST['state']; ?>" class="form-control required">

											  </div>

                                        </div>
										<div class="form-group clearfix">

											 <label class="col-lg-1 control-label " for="country">Country</label>

											 <div class="col-lg-6">

										  <input type="text" id="" name="country" value="<?php echo $_POST['country']; ?>" class="form-control required">

											  </div>

                                        </div>
										<div class="form-group clearfix">

											 <label class="col-lg-1 control-label " for="zip_code">Zip_Code</label>

											 <div class="col-lg-6">

										  <input type="text" id="" name="zip_code" value="<?php echo $_POST['zip_code']; ?>" class="form-control required">

											  </div>

                                        </div>
										<div class="form-group clearfix">

											 <label class="col-lg-1 control-label " for="gender">Gender</label>

											 <div class="col-lg-6">
                          Male: <input type="radio" id="" name="gender" value="male" <?php if($_POST['gender'] =='male') echo "checked"; ?>  />
                         Female: <input type="radio" id=""  name="gender" value="female" <?php if($_POST['gender'] =='female') echo "checked"; ?>  />
										 

											  </div>

                                        </div>
										<div class="form-group clearfix">

											 <label class="col-lg-1 control-label " for="uploadimage">Image</label>

											 <div class="col-lg-6">

										 <input type="file" class="form-control required" " id="uploadimage" name="uploadimage" value="<?php echo $_POST['uploadimage']; ?>">

											  </div>

                                        </div>
										
										<button type="submit" name="addnewrecord" class="btn btn-default">Submit</button>
                                   <a  href="index.php"  class="btn btn-default" >Back</a>
	                           
										
                                     
                                    </form> 
                             	</div>
                        	
                    	</div>
                    </div>  
					</div>
                    </div>  
            
      <?php include('inc.js.php'); ?>
	</body>
</html>