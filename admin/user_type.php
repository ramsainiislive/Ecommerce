 <?php  

include('../config.php'); 

include('inc.session.php'); 

$PageTitle="User Type";

$FileName = 'user_type.php';

$iClassName = ADMIN_URL;

$validate=new Validation();

if($_SESSION['success']!="")

{

   $stat['success']=$_SESSION['success'];

   unset($_SESSION['success']);

}



if(isset($_POST['submit']))

 	{ 

 		$validate->addRule($_POST['usertype_name'],'','User Name',true);



		if($validate->validate() && count($stat)==0)

			{

		  $aryData=array(	

			  

									'usertype_name'     	 	 =>	$_POST['usertype_name'],

									'status'     	 	         =>	$_POST['status'],

												

							 );  

					$flgIn1 = $db->insertAry("user_types",$aryData);

                    $_SESSION['success']="Submited Successfully";

					redirect($iClassName.$FileName);

					unset($_POST);

		}

		 else {

			$stat['error'] = $validate->errors();

			}



	} 

	



elseif(isset($_POST['update']))

	{ 

 $validate->addRule($_POST['usertype_name'],'','User Name',true);



		if($validate->validate() && count($stat)==0)

			{

		  $aryData=array(	

			  

									'usertype_name'     	 	 =>	$_POST['usertype_name'],

									'status'     	 	         =>	$_POST['status'],

								 );  

					$flgIn = $db->updateAry("user_types", $aryData , "where id='".$_GET['id']."'");

		          	$_SESSION['success']="Update Successfully";

					unset($_POST);

					redirect($iClassName.$FileName);



	}



 else {

	    $stat['error'] = $validate->errors();

        }

				

	}

elseif(($_REQUEST['action']=='delete'))

	{

			 	 $flgIn1 = $db->delete("user_types","where id='".$_GET['id']."'");			

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

                                        	<div class="col-md-3">

							      <a href="<?php echo $iClassName.$FileName; ?>?action=add"  class="btn btn-default" style="float:right">Add New Record</a> 

                                 		 </div>

                                  </div>

							</div>

                            

                            

                            

							<?php if($_GET['action']=='add') { ?>

                            	<div class="card-box">

 							<form role="form" action="" method="post" enctype="multipart/form-data">

                                        <div>

                                           

                                            <section>

                                                <div class="form-group clearfix">

                                                    <label class="col-lg-2 control-label " for="userName">User Type *</label>

                                                    <div class="col-lg-10">

           <input type="text" class="form-control required" name="usertype_name" value="<?php echo $_POST['usertype_name']; ?>">

                                                    </div>

                                                </div>

                                      <div class="form-group clearfix">

                                           <label class="col-lg-2 control-label " for="confirm">Status </label>

										    <div class="col-lg-10">

                                            <select  class="required form-control" name="status">

                                              <option value="1" <?php if($_POST['status']=='1') { echo "selected"; } ?>>Active</option>

							<option value="0" <?php if($_POST['status']=='0') { echo "selected"; } ?>>Inactive</option>

                                                

                                               

                                            </select>

                                        </div>

										</div>

                                	<button type="submit" name="submit" class="btn btn-default">Submit</button>

                                           <a  href="<?php echo $iClassName.$FileName; ?>"  class="btn btn-default" >Back</a>  

                                            </section>

                                              

                                        </div>

                                    </form> 

                             	</div>

                     <?php } elseif($_GET['action']=='edit') { 

					    $aryDetail=$db->getRow("select * from  user_types where id='".$_GET['id']."'");

					   ?>

                           

                                                             	<div class="card-box">

 									<form role="form" action="" method="post" enctype="multipart/form-data">

                                        <div>

                                           

                                            <section>

                                                <div class="form-group clearfix">

                                                    <label class="col-lg-2 control-label " for="userName">User Type </label>

                                                    <div class="col-lg-10">

       <input type="text" class="form-control required" name="usertype_name" value="<?php echo $aryDetail['usertype_name']; ?>">

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

			   else { ?> 

                                <div class="card-box">

                               

                                    <table id="datatable" class="table table-striped table-bordered">

                                            <thead>

                                                <tr>

												   <th>#</th>

                                                    <th>User Type</th>

                                                    <th>Status</th>

													 <th>Action</th>

                                               </tr>

                                            </thead>

								

								

                                            <tbody>

											                                      <?php

					 $aryList=$db->getRows("select * from user_types order by id desc");

							 foreach($aryList as $iList)

									{	$i=$i+1;

									$aryPgAct["id"]=$iList['id'];

							 ?> 

                                                <tr>

												    <td><?php echo $i ?></td>

                                                    <td><?php echo $iList['usertype_name']; ?></td>

                                                    <td>

													<?php if($iList['status']=='1'){echo "Active";}

													if($iList['status']=='0'){echo "Inactive";} ?>

													</td>

                                					<td>

            

            <a href="<?php echo $iClassName.$FileName; ?>?action=edit&id=<?php echo $iList['id']; ?>"  class="table-action-btn" > <i class="fa fa-pencil"></i> </a>

            <a href="javascript:del('<?php echo $iClassName.$FileName; ?>?action=delete&id=<?php echo $iList['id']; ?>')"    class="table-action-btn" > <i class="fa fa-times"></i> </a>

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