<?php include('../config.php'); 

include('inc.session.php'); 

$PageTitle="Tags";

$FileName = 'tags.php';

$validate=new Validation();

if($_SESSION['success']!="")

{

   $stat['success']=$_SESSION['success'];

   unset($_SESSION['success']);

}



if(isset($_POST['submit']))

 	{ 

	$validate->addRule($_POST['tagname'],'','Tag Name',true);
	
	$validate->addRule($_POST['language_id'],'','Language',true);
	
	$validate->addRule($_POST['pageurl'],'','PageURL',true);
	

		if($validate->validate() && count($stat)==0)
 			{
			
			$iPageURL =	PageUrl($_POST['pageurl']);
			
			$aryChkName=$db->getRow("select pageurl from  tags where pageurl='$iPageURL'");
				if(is_array($aryChkName) && count($aryChkName)>0){   		   
				$stat['error'] = "This PageURL is Already Exist";
				}
				else{
				
				
 			  $aryData=array(	
 												'tagname'     	 	     			=>	$_POST['tagname'],
 												'language_id'     	 	     			=>	$_POST['language_id'],
												'pageurl'     	 	     				=>	$iPageURL,
 												'status'     	 	         		    =>	$_POST['status'],
 							 );  

					$flgIn1 = $db->insertAry("tags",$aryData);
					 
 					$_SESSION['success']="Submited Successfully";
  					redirect($iClassName.$FileName);
 					unset($_POST);
  		}
		}
 		 else {
 			$stat['error'] = $validate->errors();
 			}
  	} 
	
  elseif(isset($_POST['update']))
 	{ 

	$validate->addRule($_POST['tagname'],'','Tag Name',true);
	
	$validate->addRule($_POST['language_id'],'','Language',true);
	

		if($validate->validate() && count($stat)==0)

			{
			$iPageURL =	PageUrl($_POST['pageurl']);
			
	$aryChkName=$db->getRow("select pageurl from  tags where pageurl='$iPageURL' and id!='".$_GET['id']."'");
				if(is_array($aryChkName) && count($aryChkName)>0){   		   
				$stat['error'] = "This PageURL is Already Exist";
				}
				else{
				

			  $aryData=array(	

			  

												

												'tagname'     	 	     			=>	$_POST['tagname'],
												
												'language_id'     	 	     			=>	$_POST['language_id'],
												
												'pageurl'     	 	     				=>	$iPageURL,
												
												'status'     	 	         		    =>	$_POST['status'],

								 );  

					$flgIn = $db->updateAry("tags", $aryData , "where id='".$_GET['id']."'");

					



					$_SESSION['success']="Update Successfully";

					unset($_POST);

					redirect($iClassName.$FileName);

							}
					}

		 else {

			$stat['error'] = $validate->errors();

			}

	}

elseif(($_REQUEST['action']=='delete'))

	{

			 	 $flgIn1 = $db->delete("tags","where id='".$_GET['id']."'");			

			     $_SESSION['success'] = 'Deleted Successfully';

                 redirect(ADMIN_URL.$FileName);	

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
									
									<label class="col-lg-2 control-label " for="userName">Language *</label>
									
									<div class="col-lg-10">
									
									<select  class="required form-control" name="language_id">

                                <option value="">Select Language</option>
								
								<?php $aryLang=$db->getRows("select * from languages order by id desc");

							 foreach($aryLang as $iLang)

									{  ?>

			<option value="<?php echo $iLang['id']; ?>" <?php if($_POST['language_id']==$iLang['id']) { echo "selected"; } ?>>
			<?php echo $iLang['language']; ?></option>
							
							<?php } ?>

                                            </select>
											
									</div>
									
									</div>
									
									<div class="form-group clearfix">

                                         <label class="col-lg-2 control-label " for="userName">Tag Name * </label>

                                                    <div class="col-lg-10">

 <input type="text" class="form-control required" name="tagname" value="<?php echo $_POST['tagname']; ?>">

                                                    </div>

                                                </div>
												
												<div class="form-group clearfix">

                                         <label class="col-lg-2 control-label " for="userName">Pageurl  </label>

                                                    <div class="col-lg-10">

 <input type="text" class="form-control required" name="pageurl" value="<?php echo $_POST['pageurl']; ?>">

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

					    $aryDetail=$db->getRow("select * from  tags where id='".$_GET['id']."'");

					   ?>

                           

                                                             	<div class="card-box">

 									<form role="form" action="" method="post" enctype="multipart/form-data">

                                        <div>

                                           

                                            <section>
											
											<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="userName">Language </label>
									
									<div class="col-lg-10">
									
									<select  class="required form-control" name="language_id">

                                <option value="">Select Language</option>
								
								<?php $aryLang=$db->getRows("select * from languages order by id desc");

							 foreach($aryLang as $iLang)

									{  ?>

		<option value="<?php echo $iLang['id']; ?>" <?php if($aryDetail['language_id']==$iLang['id']) { echo "selected"; } ?>>
		
			<?php echo $iLang['language']; ?></option>
							
							<?php } ?>

                                            </select>
											
									</div>
									
									</div>
											
										<div class="form-group clearfix">

                                         <label class="col-lg-2 control-label " for="userName">Tag Name  </label>

                                                    <div class="col-lg-10">

 <input type="text" class="form-control required" name="tagname" value="<?php echo $aryDetail['tagname']; ?>">

                                                    </div>

                                                </div>

									
									
									<div class="form-group clearfix">

                                         <label class="col-lg-2 control-label " for="userName">Pageurl  </label>

                                                    <div class="col-lg-10">

 <input type="text" class="form-control required" name="pageurl" value="<?php echo $aryDetail['pageurl']; ?>">

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
													 
													 <th>Language</th>
													 
													 <th>Tag Name</th>

                                                    <th>Status</th>

													 <th>Action</th>

                                               </tr>

                                            </thead>

								

								

                                            <tbody>

											                                      

					<?php $aryList=$db->getRows("select * from tags  order by id desc");

							 foreach($aryList as $iList)

									{	$i=$i+1;

									$aryPgAct["id"]=$iList['id'];

							 ?> 

                                                <tr>

												    <td><?php echo $i ?></td>
										
						<td><?php echo $db->getVal("select language from  languages where id = '".$iList['language_id']."'"); ?>	 							</td>
											<td><?php echo $iList['tagname']; ?></td>

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