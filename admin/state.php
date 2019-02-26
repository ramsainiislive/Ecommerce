<?php include('../config.php');
$PageTitle="State";
$FileName ='state.php';
include('inc.session.php'); 
$validate=new Validation();
if($_SESSION['success']!="")
  {
     $stat['success']=$_SESSION['success'];
     unset($_SESSION['success']);
  }
 if(isset($_POST['addnewrecord']))
 	   { 
	       $validate->addRule($_POST['country_id'],'','Country Name',true);
		    $validate->addRule($_POST['state'],'','State Name',true);
		   $validate->addRule($_POST['status'],'','status',true);
		  if($validate->validate() && count($stat)==0)
		    {	
 			     $aryData=array(	
				                'country_id'   =>	$_POST['country_id'],
								'state'   =>	$_POST['state'],
						  	    'status'   =>	$_POST['status'],
								);  
				$flgIn = $db->insertAry("state",$aryData);
				$_SESSION['success']="Registered Successfully";
				redirect($FileName);
			}
		else
			{
				$stat["error"]=$validate->errors();
			}} 
        elseif(isset($_POST['update']))
 {
	    
		$validate->addRule($_POST['countryname'],'','Country Name',true);
		$validate->addRule($_POST['state'],'','State Name',true);
		   $validate->addRule($_POST['status'],'','status',true);
		
		if($validate->validate() && count($stat)==0)
		
	        { 
 			    $aryData=array(	
								'country_id'   =>	$_POST['countryname'],
								'state'   =>	$_POST['state'],
						  	    'status'   =>	$_POST['status'],	
							   );  
		     $flgIn = $db->updateAry("state", $aryData , "where id='".$_GET['id']."'");
		     $_SESSION['success']="Update Successfully";
		     redirect($FileName);
 }      else
			{
				$stat["error"]=$validate->errors();
			}}
elseif(($_REQUEST['action']=='delete'))
	        {
			    $flgIn1 = $db->delete("state","where id='".$_GET['id']."'");	
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
                          <a href="<?php echo $FileName; ?>?action=add"  class="btn btn-default" style="float:right">Add New Record</a>
                                       </div>         
                                        </div>
                                        </div>
                                    </div>
                            </div>
                            <?php  
					    if($_GET['action']=='add') 
			{ ?>
				          <div class="card-box">
 							 <div class="row">
                                 <div class="col-sm-8">
                                 </div>	   
                                 </div>
                                  <form id="basic-form"  action="" method="post" enctype="multipart/form-data">
								  
								  
								  <div class="form-group clearfix">

                       <label class="col-lg-2 control-label " for="confirm">Country id* </label>

                        <div class="col-lg-10">

                  <span id="getsubsuccess"> <select name="country_id"  class="form-control">

                  <option value="" >Select Country</option>

                <?php 
			
 	$aryList=$db->getRows("select * from country ");

                foreach($aryList as $iList)

                {

                ?>

               <option value="<?php echo $iList['id']; ?>" <?php if($_POST['country_id']==$iList['id']) { echo "selected"; } ?>>
			   
				<?php echo $iList['countryname']; ?></option>

                <?php  }?> 

                </select></span>

                     </div> 

                    </div> 
								  
								  
									<div class="form-group clearfix">
									<label class="col-lg-2 control-label " for="price">State*</label>
									<div class="col-lg-10">
									<input type="text" id="" name="state" value="<?php echo $_POST['state']; ?>" class="form-control ">
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
									<button type="submit" name="addnewrecord" class="btn btn-default">Submit</button>
                                   <a  href="<?php echo  $FileName;  ?>"  class="btn btn-default" >Back</a>
	                           </form>
							   </div>
									
									
            <?php }
					      elseif($_GET['action']=='edit') {
						  $aryDetail=$db->getRow("select * from  state where id='".$_GET['id']."'");
				?>
                            	
							<div class="card-box">
 							<form id="basic-form"  action="" method="post" enctype="multipart/form-data">
							<div class="form-group clearfix">

                       <label class="col-lg-2 control-label " for="confirm">Country id</label>

                        <div class="col-lg-10">
						
						 <span id="getsubsuccess"> <select name="countryname"  class="required form-control">

                  <option value="" >Select Country</option>

                <?php 	
				$aryList=$db->getRows("select * from country");

                foreach($aryList as $iList)

                { ?>

               <option value="<?php echo $iList['id']; ?>" <?php if($aryDetail['category_id']==$iList['id']) { echo "selected"; } ?>>
			   
				<?php echo $iList['countryname']; ?></option>

                <?php }  ?>
                </select></span>

                     </div> 

                    </div>
                 
									<div class="form-group clearfix">
									<label class="col-lg-2 control-label " for="price">State</label>
									<div class="col-lg-10">
						    <input type="text" name="state" value="<?php echo $aryDetail['state']; ?>" class="form-control ">
									</div></div>
									
									
									 <div class="form-group clearfix">

                                           <label class="col-lg-2 control-label " for="confirm">Status </label>

										    <div class="col-lg-10">

                             <select  class="required form-control" name="status">
							<option value="1" <?php if($aryDetail['status']=='1') { echo "selected"; } ?>>Active</option>
                             <option value="0" <?php if($aryDetail['status']=='0') { echo "selected"; } ?>>Inactive</option>
                             </select></div></div>
									
									
								<button type="submit" name="update" class="btn btn-default">Update</button>
										<a  href="<?php echo  $FileName;  ?>"  class="btn btn-default" >Back</a>
										 </form></div>
						<?php 
						 } 
			  		 	
						     elseif($_GET['action']=='view') 
							 
							 {
								 
			                 $GetEmailId=$db->getRow("select * from state where id='".$_GET['id']."'");
		                ?>
                                <div class="card-box"> 
                                    <div>
									<div class="form-group clearfix">
									<label class="col-lg-2 control-label " for="price">Country id:</label>
									<?php
                         $iCategoryName = $db->getRow("select countryname from country where id = '".$GetEmailId['country_id']."' order by id desc");
									echo $iCategoryName['countryname']; ?>
									</div>
                                             
						            <div class="form-group clearfix">
									<label class="col-lg-2 control-label " for="price">State :</label>
									<?php echo $GetEmailId['state']; ?>
									</div>
									
									<div class="form-group clearfix">
									<label class="col-lg-2 control-label " for="price">Status   :</label>
									<?php if($GetEmailId['status']=='1'){echo "Active";}
								   if($GetEmailId['status']=='0'){echo "Inactive";} ?>
									</div>
                                     
                                   <a  href="<?php echo  $FileName;  ?>"  class="btn btn-default" >Back</a>
                                </div>
                             
                                     
                       
                      <?php } 
					 	else { ?>
                       <div class="card-box">
                                <table id="datatable" class="table table-striped table-bordered">
                                     <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>country id</th>
											<th>state</th>
											<th>Status</th>
											 <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
					 $aryList=$db->getRows("select * from  state order by id desc");
							 foreach($aryList as $iList)
									{	$i=$i+1;
									$aryPgAct["id"]=$iList['id'];
							 ?>       
									<tr class="<?php if($i%2=='0'){ echo "success"; } else { echo "warning"; } ?>">
									<td><?php echo $i ?></td>
									<td><?php 
									$iCategoryName = $db->getRow("select countryname from  country where id = '".$iList['country_id']."' order by id desc");
									echo $iCategoryName['countryname']; ?></td>
									<td><?php echo $iList['state']; ?></td>
									
								    <td><?php
                                   if($iList['status']=='1'){echo "Active";}
								   if($iList['status']=='0'){echo "Inactive";} ?></td>
                                    <td>
      <a href="<?php echo $FileName; ?>?action=view&id=<?php echo $iList['id']; ?>" class="table-action-btn"> <i class="fa fa-search"></i></a>
      <a href="<?php echo $FileName; ?>?action=edit&id=<?php echo $iList['id']; ?>"  class="table-action-btn" > <i class="fa fa-pencil"></i> </a>
      <a href="javascript:del('<?php echo $FileName; ?>?action=delete&id=<?php echo $iList['id']; ?>')"    class="table-action-btn" > <i class="fa fa-times"></i> </a>
      </td></tr>
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