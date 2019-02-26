<?php include('../config.php');
$PageTitle="Sub";
$FileName ='sub.php';
include('inc.session.php'); 
$validate=new Validation();
if($_SESSION['success']!="")
  {
     $stat['success']=$_SESSION['success'];
     unset($_SESSION['success']);
  }
 if(isset($_POST['addnewrecord']))
 	   { 
	       $validate->addRule($_POST['category_id'],'','Category Name',true);
		    $validate->addRule($_POST['subcategory'],'','Subcategory',true);
		   $validate->addRule($_POST['status'],'','status',true);
		 if($validate->validate() && count($stat)==0)
			{
		$aryChkName=$db->getRow("select subcategory from  subcategory where subcategory='".$_POST['subcategory']."'");
				if(is_array($aryChkName) && count($aryChkName)>0){   		   
				$stat['error'] = "This subcategory  Already Exist";
				}
				else{	
 			     $aryData=array(	
				                'category_id'   =>	$_POST['category_id'],
								'subcategory'   =>	$_POST['subcategory'],
						  	    'status'   =>	$_POST['status'],
								);  
				$flgIn = $db->insertAry("subcategory",$aryData);
				$_SESSION['success']="Registered Successfully";
				redirect($FileName);
				}}
		else
			{
				$stat["error"]=$validate->errors();
			}} 
        elseif(isset($_POST['update']))
 {
	    
		$validate->addRule($_POST['categoryname'],'','Category Name',true);
		$validate->addRule($_POST['subcategory'],'','Subcategory',true);
		   $validate->addRule($_POST['status'],'','status',true);
		
		if($validate->validate() && count($stat)==0)
		
	        { 
 			    $aryData=array(	
								'category_id'   =>	$_POST['categoryname'],
								'subcategory'   =>	$_POST['subcategory'],
						  	    'status'   =>	$_POST['status'],	
							   );  
		     $flgIn = $db->updateAry("subcategory", $aryData , "where id='".$_GET['id']."'");
		     $_SESSION['success']="Update Successfully";
		     redirect($FileName);
 }      else
			{
				$stat["error"]=$validate->errors();
			}}
elseif(($_REQUEST['action']=='delete'))
	        {
			    $flgIn1 = $db->delete("subcategory","where id='".$_GET['id']."'");	
			    $_SESSION['success'] = 'Deleted Successfully';
                redirect($FileName);	
	        } 

	elseif(($_REQUEST['action']=='reject'))
	{ 
		
	
			$aryData=array(		
							'status1'     	 	         	    	=>	11,
							);
			
			$flgIn1 = $db->updateAry("subcategory",$aryData, "where id='".$_GET['id']."'");
			/* echo $flgIn1 = $db->getLastQuery();
			exit(); */
			
				$_SESSION['success']="Move to trash Successfully";
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

                       <label class="col-lg-2 control-label " for="confirm">Category id* </label>

                        <div class="col-lg-10">

                  <span id="getsubsuccess"> <select name="category_id"  class="form-control">

                  <option value="" >Select Category</option>

                <?php 
			
 	$aryList=$db->getRows("select * from category ");

                foreach($aryList as $iList)

                {

                ?>

               <option value="<?php echo $iList['id']; ?>" <?php if($_POST['category_id']==$iList['id']) { echo "selected"; } ?>>
			   
				<?php echo $iList['categoryname']; ?></option>

                <?php  }?> 

                </select></span>

                     </div> 

                    </div> 
								  
								  
									<div class="form-group clearfix">
									<label class="col-lg-2 control-label " for="price">Subcategory*</label>
									<div class="col-lg-10">
									<input type="text" id="" name="subcategory" value="<?php echo $_POST['subcategory']; ?>" class="form-control ">
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
						  $aryDetail=$db->getRow("select * from  subcategory where id='".$_GET['id']."'");
				?>
                            	
							<div class="card-box">
 							<form id="basic-form"  action="" method="post" enctype="multipart/form-data">
							 <div class="form-group clearfix">

                       <label class="col-lg-2 control-label " for="confirm">Category Name  </label>

                        <div class="col-lg-10">
						
						 <span id="getsubsuccess"> <select name="categoryname"  class="required form-control">

                  <option value="" >Select Category</option>

                <?php 	
				$aryList=$db->getRows("select * from category");

                foreach($aryList as $iList)

                {

                ?>

               <option value="<?php echo $iList['id']; ?>" <?php if($aryDetail['category_id']==$iList['id']) { echo "selected"; } ?>>
			   
				<?php echo $iList['categoryname']; ?></option>

                <?php }  ?>
                </select></span>

                     </div> 

                    </div>
                                    
									<div class="form-group clearfix">
									<label class="col-lg-2 control-label " for="price">Subcategory*</label>
									<div class="col-lg-10">
						    <input type="text" name="subcategory" value="<?php echo $aryDetail['subcategory']; ?>" class="form-control ">
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
								 
			                 $GetEmailId=$db->getRow("select * from subcategory where id='".$_GET['id']."'");
		                ?>
                                <div class="card-box"> 
                                    <div>
									<div class="form-group clearfix">
									<label class="col-lg-2 control-label " for="price">category_id:</label>
									<?php
                         $iCategoryName = $db->getRow("select categoryname from  category where id = '".$GetEmailId['category_id']."' order by id desc");
									echo $iCategoryName['categoryname']; ?>
									</div>
                                             
						            <div class="form-group clearfix">
									<label class="col-lg-2 control-label " for="price">Subcategory :</label>
									<?php echo $GetEmailId['subcategory']; ?>
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
                                            <th>category_id</th>
											<th>subcategory</th>
											<th>Status</th>
											 <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
					 $aryList=$db->getRows("select * from  subcategory  where status!= 11 order by id desc");
							 foreach($aryList as $iList)
									{	$i=$i+1;
									$aryPgAct["id"]=$iList['id'];
							 ?>       
									<tr class="<?php if($i%2=='0'){ echo "success"; } else { echo "warning"; } ?>">
									<td><?php echo $i ?></td>
									<td><?php 
									$iCategoryName = $db->getRow("select categoryname from  category where id = '".$iList['category_id']."' order by id desc");
									echo $iCategoryName['categoryname']; ?></td>
									<td><?php echo $iList['subcategory']; ?></td>
									
								    <td><?php
                                   if($iList['status']=='1'){echo "Active";}
								   if($iList['status']=='0'){echo "Inactive";} ?></td>
                                    <td>
      <a href="<?php echo $FileName; ?>?action=view&id=<?php echo $iList['id']; ?>" class="table-action-btn"> <i class="fa fa-search"></i></a>
      <a href="<?php echo $FileName; ?>?action=edit&id=<?php echo $iList['id']; ?>"  class="table-action-btn" > <i class="fa fa-pencil"></i> </a>
      <a href="javascript:del('<?php echo $FileName; ?>?action=delete&id=<?php echo $iList['id']; ?>')"    class="table-action-btn" > <i class="fa fa-times"></i> </a>
      <a href="<?php echo $iClassName.$FileName; ?>?action=reject&id=<?php echo $iList['id']; ?>"    class="table-action-btn" > <i class="fa fa-trash"></i> </a>
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
 <script>

   

	</script>
</body>
</html>