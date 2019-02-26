<?php include('../config.php');

 //include('inc.session-create.php'); 

$PageTitle=" Registeration";

$FileName ='admin_reg.php';

$iClassName = ADMIN_URL;

$validate=new Validation();

if($_SESSION['success']!="")

{

   $stat['success']=$_SESSION['success'];

   unset($_SESSION['success']);

}



if(isset($_POST['submit']))
 	{ 
 $validate->addRule($_POST['fullname'],'','Full Name',true);
 $validate->addRule($_POST['user_type'],'','User Type',true);
 $validate->addRule($_POST['emailid'],'email','Email',true);
 $validate->addRule($_POST['password'],'','Password',true);
 $validate->addRule($_POST['contactno'],'num','Phone Number',10,10,true);
 

 


		if($validate->validate() && count($stat)==0)
			{
		$aryChkName=$db->getRow("select emailid from  admin_login where emailid='".$_POST['emailid']."'");
				if(is_array($aryChkName) && count($aryChkName)>0){   		   
				$stat['error'] = "This Email is Already Exist";
				}
				else{
				
				
				
				
				
			  $aryData=array(	
			  									
												'fullname'     	 	         			    	=>	$_POST['fullname'],
												'user_type'     	 	         			    =>	$_POST['user_type'],
												'emailid'     	 	         		        	=>	$_POST['emailid'],
												'password'     	 	         		            =>	$_POST['password'],
												'contactno'     	 	         				=>	$_POST['contactno'],
												'address'     	 	         					=>	$_POST['address'],
												'status' 				   						=>	$_POST['status'],
												'create_at'     	 	         		        =>	date("Y-m-d H-i-s"),
												
												
							 );  
							 
					$flgIn = $db->insertAry("admin_login",$aryData);
					$_SESSION['success']="Registered Successfully";
					
					redirect($iClassName.$FileName);

		}
		}
		
		 else {
			$stat['error'] = $validate->errors();
			}

	} 


elseif(isset($_POST['update']))

	 { 

 $validate->addRule($_POST['fullname'],'','Full Name',true);
 $validate->addRule($_POST['user_type'],'','User Type',true);
 $validate->addRule($_POST['emailid'],'email','Email',true);
 $validate->addRule($_POST['password'],'','Password',true);
 $validate->addRule($_POST['contactno'],'num','Phone Number',10,10,true);

 


		if($validate->validate() && count($stat)==0)
			{
		$aryChkName=$db->getRow("select emailid from  admin_login where emailid='".$_POST['emailid']."' 
		and id!='".$_GET['id']."'");
				if(is_array($aryChkName) && count($aryChkName)>0){   		   
				$stat['error'] = "This Email is Already Exist";
				}
				else{
				
				
				
				
			  $aryData=array(	
			  									
												'fullname'     	 	         			    	=>	$_POST['fullname'],
												'user_type'     	 	         			    =>	$_POST['user_type'],
												'emailid'     	 	         		        	=>	$_POST['emailid'],
												'password'     	 	         		            =>	$_POST['password'],
												'contactno'     	 	         				=>	$_POST['contactno'],
												'address'     	 	         					=>	$_POST['address'],
												'status' 				   						=>	$_POST['status'],
												'create_at'     	 	         		        =>	date("Y-m-d H-i-s"),
												
												
							 );  

				

							$flgIn = $db->updateAry("admin_login", $aryData , "where id='".$_GET['id']."'");
							
							$_SESSION['success']="Update Successfully";
							
							redirect($iClassName.$FileName);
				  

	}
	}

			else {

			$stat['error'] = $validate->errors();

			}

	} 

	elseif(($_REQUEST['action']=='delete'))

	{

			 	 $flgIn1 = $db->delete("admin_login","where id='".$_GET['id']."'");			

			     $_SESSION['success'] = 'Deleted Successfully';

                 redirect($iClassName.$FileName);	

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

				<!-- Start content -->

				<div class="content">

					<div class="container">



						<!-- Page-Title -->

						<div class="row">

							<div class="col-sm-12">

								<h4 class="page-title"><?php echo $PageTitle; ?></h4>
								<?php echo $isubId; ?>
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

                            	  <div class="card-box">

                                        <div class="row">

                                                <div class="col-sm-8">

                                                <?php echo msg($stat); ?>

                                                </div>	

                                                <div class="col-sm-4">

                          <a href="<?php echo $iClassName.$FileName; ?>?action=add"  class="btn btn-default" style="float:right">Add New Record</a>
							
                                       </div>         

                                        </div>

                                        </div>

                                    </div>

                            </div>

							

							

                            <?php  if($_GET['action']=='add') { ?>

							

				          <div class="card-box">

 							 <div class="row">

                                 <div class="col-sm-8">

                                 </div>	   

                                 </div>

                                  <form id="basic-form"  action="" method="post" enctype="multipart/form-data">

									<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Full Name*</label>
									
									<div class="col-lg-10">
									
						<input type="text" id="" name="fullname" value="<?php echo $_POST['fullname']; ?>" class="form-control ">
									
									</div>
									
									</div>
									
									<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">User Type*</label>
									
									<div class="col-lg-10">
									
									 <select name="user_type" class="form-control">
									
									<option value="">Select Choice</option>
									
								<?php $aryList=$db->getRows("select * from user_types order by id desc");

							 foreach($aryList as $iList)

									{  ?>
									
				<option value="<?php echo $iList['id']; ?>" <?php if($_POST['user_type']== $iList['id']) { echo "selected"; } ?>>
				
							<?php echo $iList['usertype_name']; ?></option>
							
							<?php } ?>
									
									</select> 
									
									</div>
									</div> 
                                      
                                       
                                    <div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Email ID*</label>
									
									<div class="col-lg-10">
									
						<input type="text" id="" name="emailid" value="<?php echo $_POST['emailid']; ?>" class="form-control ">
									
									</div>
									
									</div>
                                     
                                    
                                     <div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Password*</label>
									
									<div class="col-lg-10">
									
					<input type="password" id="" name="password" value="<?php echo $_POST['password']; ?>" class="form-control ">
									
									</div>
									
									</div>
									
									<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Contact Number*</label>
									
									<div class="col-lg-10">
									
					<input type="text" id="" name="contactno" value="<?php echo $_POST['contactno']; ?>" class="form-control ">
									
									</div>
									
									</div>
									
									
									
									<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Address*</label>
									
									<div class="col-lg-10">
									
						<textarea name="address"  class="form-control "><?php echo $_POST['address']; ?></textarea>
									
									</div>
									
									</div>
									
									 
									
									
                                    
									<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="countryName">Status *</label>
									
									<div class="col-lg-10">
									
									<select name="status" class="form-control">
									
									<option value="1" <?php if($_POST['status']=='1') { echo "selected"; } ?>>Active</option>
									
									<option value="0" <?php if($_POST['status']=='0') { echo "selected"; } ?>>Inactive</option>
									
									</select> 
									
									</div>
									
									</div>
											

										<button type="submit" name="submit" class="btn btn-default">Submit</button>

                                       <a  href="<?php echo  $iClassName.$FileName;  ?>"  class="btn btn-default" >Back</a>

										 </form>

										</div>
 						   

                       <?php }

					   

					    elseif($_GET['action']=='edit') {

						  $aryDetail=$db->getRow("select * from  admin_login where id='".$_GET['id']."'");

						 ?>

						

                            	<div class="card-box">

 							<form id="basic-form"  action="" method="post" enctype="multipart/form-data">
							
									    
                                      <div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Full Name</label>
									
									<div class="col-lg-10">
									
						<input type="text" name="fullname" value="<?php echo $aryDetail['fullname']; ?>" class="form-control ">
									
									</div>
									
									</div>
									
									<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">User Type</label>
									
									<div class="col-lg-10">
									
									 <select name="user_type" class="form-control">
									
									<option value="">Select Choice</option>
									
								<?php $aryList=$db->getRows("select * from user_types order by id desc");

							 foreach($aryList as $iList)

									{  ?>
									
			<option value="<?php echo $iList['id']; ?>" <?php if($aryDetail['user_type']== $iList['id']) { echo "selected"; } ?>>
				
							<?php echo $iList['usertype_name']; ?></option>
							
							<?php } ?>
									
									</select> 
									
									</div>
									</div> 
                                      
                                       
                                    <div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Email ID</label>
									
									<div class="col-lg-10">
									
					<input type="text" name="emailid" value="<?php echo $aryDetail['emailid']; ?>" class="form-control ">
									
									</div>
									
									</div>
                                     
                                    
                                     <div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Password</label>
									
									<div class="col-lg-10">
									
					<input type="password" name="password" value="<?php echo $aryDetail['password']; ?>" class="form-control ">
									
									</div>
									
									</div>
									
									<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Contact Number</label>
									
									<div class="col-lg-10">
									
				<input type="text" name="contactno" value="<?php echo $aryDetail['contactno']; ?>" class="form-control ">
									
									</div>
									
									</div>
									
									
									
									<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Address</label>
									
									<div class="col-lg-10">
									
						<textarea name="address"  class="form-control "><?php echo $aryDetail['address']; ?></textarea>
									
									</div>
									
									</div>
                                        
									
									<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="countryName">Status </label>
									
									<div class="col-lg-10">
									
									<select name="status" class="form-control">
									
									<option value="1" <?php if($aryDetail['status']=='1') { echo "selected"; } ?>>Active</option>
									
									<option value="0" <?php if($aryDetail['status']=='0') { echo "selected"; } ?>>Inactive
									</option>
									
									</select> 
									
									</div>
									
									</div>
											

										<button type="submit" name="update" class="btn btn-default">Update</button>
										<a  href="<?php echo  $iClassName.$FileName;  ?>"  class="btn btn-default" >Back</a>
                                       

										 </form> 

                             	</div>

						

						 <?php  } 

			   elseif($_GET['action']=='view') { 

			    $GetEmailId=$db->getRow("select * from admin_login where id='".$_GET['id']."'");



		?>

		        <div class="card-box"> 

                              <div>

                                             <section>            

									<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Full Name :</label>
									
									<?php echo $GetEmailId['fullname']; ?>
									
									
									</div>
									
									<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">User Type :</label>
									
					<?php echo $db->getVal("select usertype_name from  user_types where id = '".$GetEmailId['user_type']."'"); ?>
									
									
									
									</div> 
                                      
                                       
                                    <div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Email ID :</label>
									
									
									
								<?php echo $GetEmailId['emailid']; ?>
									
									
									
									</div>
                                     
                                    
                                     <div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Password :</label>
									
								
									
								<?php echo $GetEmailId['password']; ?>
									
								
									
									</div>
									
									<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Contact Number :</label>
									
									
									
									<?php echo $GetEmailId['contactno']; ?>
									
									
									
									</div>
									
									
									
									<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Address :</label>
									
									
									
									<?php echo $GetEmailId['address']; ?>
									
									
									
									</div>
									
									<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Create At :</label>
									
									
									
									<?php echo $GetEmailId['create_at']; ?>
									
									
									
									</div>
                                        
										<div class="form-group clearfix">
										
										<label class="col-lg-2 control-label " for="countryName">Status :</label>
										
										
										
										<?php if($GetEmailId['status']=='1') { echo "Active"; } ?>  
                                        <?php if($GetEmailId['status']=='0') { echo "Inactive"; } ?>
                                        
										
										
										
										
										</div>
										

                                   <a  href="<?php echo  $iClassName.$FileName;  ?>"  class="btn btn-default" >Back</a>

                                    

                                </div>

                                </section>    

                                        </div>

                        			</div>
                        

                      <?php } else { ?>

                      

                       <div class="card-box">

                                <table id="datatable" class="table table-striped table-bordered">

                                     <thead>

                                        <tr>

                                            <th>#</th>
                                            <th>Full Name</th>
                                            <th>Contact Number</th>
											 <th>Email ID</th>
											 
											<th>Status</th>
  									        <th>Action</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                       <?php

					 $aryList=$db->getRows("select *from  admin_login order by id desc");

							 foreach($aryList as $iList)

									{	$i=$i+1;

									$aryPgAct["id"]=$iList['id'];

							 ?>       

									<tr class="<?php if($i%2=='0'){ echo "success"; } else { echo "warning"; } ?>">
									
									<td><?php echo $i ?></td>
									
									<td><?php echo $iList['fullname']; ?></td>
									<td><?php echo $iList['contactno']; ?></td>
									<td><?php echo $iList['emailid']; ?></td>
									
                                    <td>
									<?php if($iList['status']=='1') { echo "Active"; } ?>  
									<?php if($iList['status']=='0') { echo "Inactive"; } ?>
									</td>

										

					 

                      <td>

      <a href="<?php echo $iClassName.$FileName; ?>?action=view&id=<?php echo $iList['id']; ?>" class="table-action-btn"> <i class="fa fa-search"></i></a>

            <a href="<?php echo $iClassName.$FileName; ?>?action=edit&id=<?php echo $iList['id']; ?>"  class="table-action-btn" > <i class="fa fa-pencil"></i> </a>

            <a href="javascript:del('<?php echo $iClassName.$FileName; ?>?action=delete&id=<?php echo $iList['id']; ?>')"    class="table-action-btn" > <i class="fa fa-times"></i> </a>
			
			
                     								 </td>

                  </tr>

				  <?php } ?>

                                    </tbody>

                                </table>

                            </div>

                             

                         </div>

                         

                        <?php  }  ?> 

                         

                    </div>

                 </div>

             </div>

         </div>

     </div>
    

<?php include('inc.footer.php'); ?>

<?php include('inc.js.php'); ?>



				

</body>

</html>