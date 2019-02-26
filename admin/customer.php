<?php include('../config.php');

include('inc.session.php'); 

$PageTitle=" Customers";

$FileName ='customer.php';

$iClassName = ADMIN_URL;

$validate=new Validation();

if($_SESSION['success']!="")

{

   $stat['success']=$_SESSION['success'];

   unset($_SESSION['success']);

}



if(isset($_POST['submit']))
 	{ 
 $validate->addRule($_POST['f_name'],'','First Name',true);
 $validate->addRule($_POST['l_name'],'','Last Name',true);
 $validate->addRule($_POST['c_name'],'','Company Name',true);
 $validate->addRule($_POST['emailid'],'email','Email',true);
 $validate->addRule($_POST['contactno'],'num','Contact Number',10,10,true);
 
 

 


		if($validate->validate() && count($stat)==0)
			{
		$aryChkName=$db->getRow("select emailid from  customerdeatails where emailid='".$_POST['emailid']."'");
				if(is_array($aryChkName) && count($aryChkName)>0){   		   
				$stat['error'] = "This Email is Already Exist";
				}
				else{
				
				
				
				
				
			  $aryData=array(	
			  									
												'firstname'     	 	         			    =>	$_POST['f_name'],
												'lastname'     	 	         			    =>	$_POST['l_name'],
												'company'     	 	         			    =>	$_POST['c_name'],
												'emailid'     	 	         		        =>	$_POST['emailid'],
												'contactno'     	 	         			=>	$_POST['contactno'],
												'address'     	 	         				=>	$_POST['address'],
												'zipcode'     	 	         		        =>	$_POST['pincode'],
												/* 'status' 				   					=>	$_POST['status'],
												'create_at'     	 	         		    =>	date("Y-m-d H-i-s"), */
												
												
							 );  
							 
					$flgIn = $db->insertAry("customerdeatails",$aryData);
					$_SESSION['success']="Submit Successfully";
					
					redirect($iClassName.$FileName);

		}
		}
		
		 else {
			$stat['error'] = $validate->errors();
			}

	} 


elseif(isset($_POST['update']))

	 { 

 $validate->addRule($_POST['f_name'],'','First Name',true);
 $validate->addRule($_POST['l_name'],'','Last Name',true);
 $validate->addRule($_POST['c_name'],'','Company Name',true);
 $validate->addRule($_POST['emailid'],'email','Email',true);
 $validate->addRule($_POST['contactno'],'num','Contact Number',10,10,true);

 


		if($validate->validate() && count($stat)==0)
			{
		$aryChkName=$db->getRow("select emailid from  customerdeatails where emailid='".$_POST['emailid']."' 
		and id!='".$_GET['id']."'");
				if(is_array($aryChkName) && count($aryChkName)>0){   		   
				$stat['error'] = "This Email is Already Exist";
				}
				else{
				
				
				
				
			  $aryData=array(	
			  									
												'firstname'     	 	         		    =>	$_POST['f_name'],
												'lastname'     	 	         			    =>	$_POST['l_name'],
												'company'     	 	         			    =>	$_POST['c_name'],
												'emailid'     	 	         		        =>	$_POST['emailid'],
												'contactno'     	 	         			=>	$_POST['contactno'],
												'address'     	 	         				=>	$_POST['address'],
												'zipcode'     	 	         		        =>	$_POST['pincode'],
												/* 'status' 				   					=>	$_POST['status'],
												'create_at'     	 	         		    =>	date("Y-m-d H-i-s"), */
												
												
							 );  

				

							$flgIn = $db->updateAry("customerdeatails", $aryData , "where id='".$_GET['id']."'");
							
							$_SESSION['success']="Update Successfully";
							
							redirect($iClassName.$FileName);			 
	}
	}

			else {

			$stat['error'] = $validate->errors();

			}

	} 
	
	 elseif(($_REQUEST['action']=='reject'))
	{ 
		
	
			$aryData=array(		
							'status'     	 	         	    	=>	11,
							);
			
			$flgIn1 = $db->updateAry("customerdeatails",$aryData, "where id='".$_GET['id']."'");
			/* echo $flgIn1 = $db->getLastQuery();
			exit(); */
			
				$_SESSION['success']="Move to trash Successfully";
					redirect($FileName);
					
			
	}		

	 elseif(($_REQUEST['action']=='delete'))

	{
		       $flgIn1 = $db->delete("customerdeatails","where id='".$_GET['id']."'");			

			     $_SESSION['success'] = 'Deleted Successfully';

                 redirect($FileName);	

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
									
									<label class="col-lg-2 control-label " for="price">First Name*</label>
									
									<div class="col-lg-10">
									
								<input type="text" name="f_name" value="<?php echo $_POST['firstname']; ?>" class="form-control ">
								
									
									</div>
									
									</div>
									
									<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Last Name*</label>
									
									<div class="col-lg-10">
									
								<input type="text"  name="l_name" value="<?php echo $_POST['lastname']; ?>" class="form-control "> 
									
									</div>
									</div> 
									<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Company*</label>
									
									<div class="col-lg-10">
									
								<input type="text"  name="c_name" value="<?php echo $_POST['company']; ?>" class="form-control "> 
									
									</div>
									</div> 
                                      
                                       
                                    <div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Email ID*</label>
									
									<div class="col-lg-10">
									
						<input type="text" id="" name="emailid" value="<?php echo $_POST['emailid']; ?>" class="form-control ">
									
									</div>
									
									</div>
                                     
                                    
									
									<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Contact Number*</label>
									
									<div class="col-lg-10">
									
					<input type="text" id="" name="contactno" maxlength="10" value="<?php echo $_POST['contactno']; ?>" class="form-control ">
									
									</div>
									
									</div>
									
									
									
									<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Address</label>
									
									<div class="col-lg-10">
									
						<textarea name="address"  class="form-control "><?php echo $_POST['address']; ?></textarea>
									
									</div>
									
									</div>
									
									 
									<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Pin Code</label>
									
									<div class="col-lg-10">
									
					<input type="text"  name="pincode" value="<?php echo $_POST['pincode']; ?>" class="form-control ">
									
									</div>
									
									</div>
									
                                   <!--  
									<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="countryName">Status </label>
									
									<div class="col-lg-10">
									
									<select name="status" class="form-control">
									
									<option value="1" <?php if($_POST['status']=='1') { echo "selected"; } ?>>Active</option>
									
									<option value="0" <?php if($_POST['status']=='0') { echo "selected"; } ?>>Inactive</option>
									
									</select> 
									
									</div>
									
									</div>
									 -->
											

										<button type="submit" name="submit" class="btn btn-default">Submit</button>

                                       <a  href="<?php echo  $iClassName.$FileName;  ?>"  class="btn btn-default" >Back</a>

										 </form>

										</div>
 						   

                       <?php }

					   

					    elseif($_GET['action']=='edit') {

						  $aryDetail=$db->getRow("select * from  customerdeatails where id='".$_GET['id']."'");

						 ?>

						

                            	<div class="card-box">

 							<form id="basic-form"  action="" method="post" enctype="multipart/form-data">
							
									    
                                      <div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">First Name</label>
									
									<div class="col-lg-10">
									
						<input type="text" name="f_name" value="<?php echo $aryDetail['firstname']; ?>" class="form-control ">
							
									</div>
									
									</div>
									
									<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Last Name</label>
									
									<div class="col-lg-10">
									
							<input type="text"  name="l_name" value="<?php echo $aryDetail['lastname']; ?>" class="form-control "> 
									
									</div>
									</div> 
                                      
									 <div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Company*</label>
									
									<div class="col-lg-10">
									
								<input type="text"  name="c_name" value="<?php echo $aryDetail['company']; ?>" class="form-control "> 
									
									</div>
									</div> 
                                       
                                    <div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Email ID</label>
									
									<div class="col-lg-10">
									
					<input type="text" name="emailid" value="<?php echo $aryDetail['emailid']; ?>" class="form-control ">
									
									</div>
									
									</div>
                                     
									
									<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Contact Number</label>
									
									<div class="col-lg-10">
									
				<input type="text" name="contactno" maxlength="10" value="<?php echo $aryDetail['contactno']; ?>" class="form-control ">
									
									</div>
									
									</div>
									
									
									
									<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Address</label>
									
									<div class="col-lg-10">
									
						<textarea name="address"  class="form-control "><?php echo $aryDetail['address']; ?></textarea>
									
									</div>
									
									</div>
                                        
									<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Pin Code</label>
									
									<div class="col-lg-10">
									
					<input type="text"  name="pincode" value="<?php echo $aryDetail['zipcode']; ?>" class="form-control ">
									
									</div>
									
									</div>
									 <!--
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
											 -->

										<button type="submit" name="update" class="btn btn-default">Update</button>
										<a  href="<?php echo  $iClassName.$FileName;  ?>"  class="btn btn-default" >Back</a>
                                       

										 </form> 

                             	</div>

						

						 <?php  } 

			   elseif($_GET['action']=='view') { 

			    $GetEmailId=$db->getRow("select * from customerdeatails where  id='".$_GET['id']."'");



		?>

		        <div class="card-box"> 

                              <div>

                                             <section>            

									<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">First Name :</label>
									
									<?php echo $GetEmailId['firstname']; ?>
									
									
									</div>
									
									<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Last Name :</label>
									
									<?php echo $GetEmailId['lastname']; ?>
									
									
									
									</div> 
									
									<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Company*</label>
									
									<?php echo $GetEmailId['company']; ?>
									</div>
                                      
                                       
                                    <div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Email ID :</label>
									
									
									
								<?php echo $GetEmailId['emailid']; ?>
									
									
									
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
									
									<label class="col-lg-2 control-label " for="price">Pin Code :</label>
									
								
									
								<?php echo $GetEmailId['zipcode']; ?>
									
								
									
									</div>
									<!-- 
									<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Create At :</label>
									
									
									
									<?php echo $GetEmailId['create_at']; ?>
									
									
									
									</div>
                                        
										<div class="form-group clearfix">
										
										<label class="col-lg-2 control-label " for="countryName">Status :</label>
										
										
										
										<?php if($GetEmailId['status']=='1') { echo "Active"; } ?>  
                                        <?php if($GetEmailId['status']=='0') { echo "Inactive"; } ?>
                                        
										
										
										
										
										</div>
										 -->
										

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
                                            <th>First Name</th>
											<th>Last Name</th>
											 <th>Email ID</th>
											 <th>Contact Number</th>
											 
  									        <th>Action</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                       <?php

					 $aryList=$db->getRows("select *from  customerdeatails where status!= 11 order by id desc");

							 foreach($aryList as $iList)

									{	$i=$i+1;

									$aryPgAct["id"]=$iList['id'];

							 ?>       

									<tr class="<?php if($i%2=='0'){ echo "success"; } else { echo "warning"; } ?>">
									
							<td><?php echo $i; ?></td>
									
									<td><?php echo $iList['firstname']; ?></td>
									<td><?php echo $iList['lastname']; ?></td>
									<td><?php echo $iList['emailid']; ?></td>
									<td><?php echo $iList['contactno']; ?></td>
									
                                    
										

					 

                      <td>

      <a href="<?php echo $iClassName.$FileName; ?>?action=view&id=<?php echo $iList['id']; ?>" class="table-action-btn"> <i class="fa fa-search"></i></a>

            <a href="<?php echo $iClassName.$FileName; ?>?action=edit&id=<?php echo $iList['id']; ?>"  class="table-action-btn" > <i class="fa fa-pencil"></i> </a>

            <a href="<?php echo $iClassName.$FileName; ?>?action=delete&id=<?php echo $iList['id']; ?>"    class="table-action-btn" > <i class="fa fa-times"></i> </a>
			<a href="<?php echo $iClassName.$FileName; ?>?action=reject&id=<?php echo $iList['id']; ?>"    class="table-action-btn" > <i class="fa fa-trash"></i> </a>
			
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