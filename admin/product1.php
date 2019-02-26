<?php include('../config.php');
include('inc.session.php'); 
$PageTitle="Product Section";
$FileName ='product1.php';
$validate=new Validation();
if($_SESSION['success']!="")
  {
     $stat['success']=$_SESSION['success'];
     unset($_SESSION['success']);
  }
 if(isset($_POST['addnewrecord'])){
	        $validate->addRule($_POST['title'],'','Title',true); 
			$validate->addRule($_POST['shortdescription'],'','shortdescription',true);
			$validate->addRule($_POST['description'],'','description',true);
		   	
		   $validate->addRule($_POST['price'],'','Price',true);
		    $validate->addRule($_POST['category_id'],'','category',true);
		   $validate->addRule($_POST['subcategory_id'],'','subcategory',true);
		   $validate->addRule($_POST['child_id'],'','child',true);
		     $validate->addRule($_POST['country_id'],'','country',true);
		   $validate->addRule($_POST['state_id'],'','state',true);
		   $validate->addRule($_POST['city_id'],'','city',true);
		    $validate->addRule($_POST['brand'],'','Brand',true);
			 $validate->addRule($_POST['quantity'],'','Quantity',true);
			  $validate->addRule($_POST['color'],'','Color',true);
			   $validate->addRule($_POST['size'],'','Size',true);
		   $validate->addRule($_POST['status'],'','status',true); 
		  if($validate->validate() && count($stat)==0)
		    {	  if(isset($_FILES["uploadimage"]["name"]) && !empty($_FILES["uploadimage"]["name"]))

				{	 

 					$filename = basename($_FILES['uploadimage']['name']);

					$ext1 = strtolower(substr($filename, strrpos($filename, '.')+1));

					
						$newfile2=md5(time())."_".$filename;

 						move_uploaded_file($_FILES['uploadimage']['tmp_name'],"../uploads/".$newfile2);

 					
				 } 
		
		
 			     $aryData=array(	
				                'title'   =>	$_POST['title'],
								'shortdiscription'=>	$_POST['shortdescription'],
								'description'=>	$_POST['description'],
								'price' =>	$_POST['price'],
								'uploadimage' =>	$newfile2,
								'category_id' =>	$_POST['category_id'],
								'subcategory_id' =>	$_POST['subcategory_id'],
								'child_id' =>	$_POST['child_id'],
								'country_id'=>	$_POST['country_id'],
								'state_id'=>	$_POST['state_id'],
								'city_id'=>	$_POST['city_id'],
								'brand' =>	$_POST['brand'],
								'quantity' =>	$_POST['quantity'],
								'color' =>	$_POST['color'],
						  	    'size'   =>	$_POST['size'],
						  	    'status'   =>	$_POST['status'],
								
								);  
				$flgIn = $db->insertAry("product",$aryData);
				/* echo $flgIn = $db->getLastQuery();
				exit(); */
				$_SESSION['success']="Registered Successfully";
				redirect($FileName);
			}
		else
			{
				$stat["error"]=$validate->errors();
			}} 
        elseif(isset($_POST['update'])){
				$validate->addRule($_POST['title'],'','Title',true);
$validate->addRule($_POST['shortdescription'],'','shortdescription',true);
			$validate->addRule($_POST['description'],'','description',true);				
		   			   $validate->addRule($_POST['price'],'','Price',true);
		    $validate->addRule($_POST['category_id'],'','category',true);
		   $validate->addRule($_POST['subcategory_id'],'','subcategory',true);
		   $validate->addRule($_POST['child_id'],'','child',true);
		     $validate->addRule($_POST['country_id'],'','country',true);
		   $validate->addRule($_POST['state_id'],'','state',true);
		   $validate->addRule($_POST['city_id'],'','city',true);
		    $validate->addRule($_POST['brand'],'','Brand',true);
			 $validate->addRule($_POST['quantity'],'','Quantity',true);
			  $validate->addRule($_POST['color'],'','Color',true);
			   $validate->addRule($_POST['size'],'','Size',true);
		   $validate->addRule($_POST['status'],'','status',true);
		  if($validate->validate() && count($stat)==0)
		    {
 {	  if(isset($_FILES["uploadimage"]["name"]) && !empty($_FILES["uploadimage"]["name"]))

				{	 

 					$filename = basename($_FILES['uploadimage']['name']);

					$ext1 = strtolower(substr($filename, strrpos($filename, '.')+1));

					
						$newfile2=md5(time())."_".$filename;

 						move_uploaded_file($_FILES['uploadimage']['tmp_name'],"../uploads/".$newfile2);

 					
				 } 
		
   else {$newfile2 = $_POST['uploadimage_old']; }

		
 			     $aryData=array(	
				                'title'   =>	$_POST['title'],
								'shortdiscription'=>	$_POST['shortdescription'],
								'description'=>	$_POST['description'],
								'price' =>	$_POST['price'],
								'uploadimage' =>	$newfile2,
								'category_id' =>	$_POST['category_id'],
								'subcategory_id' =>	$_POST['subcategory_id'],
								'child_id' =>	$_POST['child_id'],
								'country_id'=>	$_POST['country_id'],
								'state_id'=>	$_POST['state_id'],
								'city_id'=>	$_POST['city_id'],
								'brand' =>	$_POST['brand'],
								'quantity' =>	$_POST['quantity'],
								'color' =>	$_POST['color'],
						  	    'size'   =>	$_POST['size'],
						  	    'status'   =>	$_POST['status'],
								
								);  
				$flgIn = $db->updateAry("product",$aryData,"where id='".$_GET['id']."'");
				$_SESSION['success']="update Successfully";
				redirect($FileName);
 }  

			}



 else
			{
				$stat["error"]=$validate->errors();
			}}
elseif(($_REQUEST['action']=='delete'))
	        {
			    $flgIn1 = $db->delete("product","where id='".$_GET['id']."'");	
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

                              /*  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ adddata  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@     */							
					    if($_GET['action']=='add') 
			{ ?>
				          <div class="card-box">
 							 <div class="row">
                                 <div class="col-sm-8">
                                 </div>	   
                                 </div>
                                  <form id="basic-form"  action="" method="post" enctype="multipart/form-data">
									<div class="form-group clearfix">
									<label class="col-lg-2 control-label " for="price">TITLE</label>
									<div class="col-lg-10">
									<input type="text" id="" name="title" value="<?php echo $_POST['title']; ?>" class="form-control ">
									</div>
									</div>
									
									<div class="form-group clearfix">
									<label class="col-lg-2 control-label " for="userName"> Short Description *</label>
									<div class="col-lg-10">
									<input type="text" id="" name="shortdescription" value="<?php echo $_POST['shortdescription']; ?>" class="form-control ">
									</div>
									</div>

													
									<div class="form-group clearfix">
									<label class="col-lg-2 control-label " for="userName">Description *</label>
										<div class="col-lg-10">
										<textarea class="form-control required ckeditor" name="description"><?php echo $_POST['description']; ?></textarea>
										</div>
									</div>
									
									<div class="form-group clearfix">
                                    <label class="col-lg-2 control-label " for="userName">Product Price *</label>
                                      <div class="col-lg-10">
									  <input type="text" class="form-control required" name="price" value="<?php echo $_POST['price']; ?>">
                                      </div>
                                    </div>

												
									<div class="form-group clearfix">
									
				<label class="col-lg-2 control-label " for="userName">Image </label>
				
				<div class="col-lg-10">
				
				<input type="file" class="form-control " id="uploadimage" name="uploadimage">
				
				</div>
				
				</div>
                                      
                       <div class="form-group clearfix">
                       <label class="col-lg-2 control-label " for="confirm">Category </label>
                        <div class="col-lg-10">
						<span id="getsubsuccess"> <select onchange="getsubcategr();getsubchild();" id="category_id" name="category_id"  class="required form-control">
					<option value="" >Select Category</option>
                <?php 
			
					$aryList=$db->getRows("select * from category" );
						foreach($aryList as $iList){
                ?>

					<option value="<?php echo $iList['id']; ?>" <?php if($_POST['category_id']==$iList['id']) { echo "selected"; } ?>>
				<?php echo $iList['categoryname']; ?></option>
                <?php } ?> 
                </select></span>
                     </div> 
					</div> 
					
					<div class="form-group clearfix">
                       <label class="col-lg-2 control-label " for="confirm">Sub category </label>
                        <div class="col-lg-10">
						<span id="showsub"> <select onchange="getsubchild()" id= "subcategory_id"  name="subcategory_id"  class="required form-control">
						<option value="" >Select Subcategory</option>
						
						<?php	if($_POST['category_id']!='') { 
				
			$aryList=$db->getRows("select * from subcategory where category_id='".$_POST['category_id']."' order by id desc");
							
					foreach($aryList as $iList){  ?>

				  <option <?php if($_POST['subcategory_id']==$iList['id']){ echo "selected";} ?> value="<?php echo $iList['id'] ?>"><?php echo $iList['subcategory']; ?> </option>
				       <?php  }	} ?>
						
						
                            </select></span>
                     </div> 
                    </div> 
					
					<div class="form-group clearfix">
                       <label class="col-lg-2 control-label " for="confirm">Child Category </label>
                        <div class="col-lg-10">
						<span id="getsubsuccess"> <select  id="showchild" name="child_id"  class="required form-control">
						<option value="" >Select Childcategory</option>
						
						 <?php 
			if($_POST['subcategory_id']!='') { 
					$aryList=$db->getRows("select * from childcategory where subcategory_id='".$_POST['subcategory_id']."' order by id desc " );
						foreach($aryList as $iList){
                ?>

					<option value="<?php echo $iList['id']; ?>" <?php if($_POST['child_id']==$iList['id']) { echo "selected"; } ?>>
				<?php echo $iList['childcategory']; ?></option>
			<?php } }?> 
						
						
                            </select></span>
                     </div> 
                    </div> 
						<div class="form-group clearfix">
                       <label class="col-lg-2 control-label " for="confirm">Country </label>
                        <div class="col-lg-10">
						<span id="getsubsuccess"> <select onchange="getsubcountr();getcity();" id="country_id" name="country_id"  class="required form-control">
						<option value="" >Select Country</option>
                <?php 
			
					$aryList=$db->getRows("select * from country" );
							foreach($aryList as $iList){
                ?>
						<option value="<?php echo $iList['id']; ?>" <?php if($_POST['country_id']==$iList['id']) { echo "selected"; } ?>>			   
				<?php echo $iList['countryname']; ?></option>
               <?php } ?> 
                </select></span>
                     </div> 
                   </div> 
					
					
					<div class="form-group clearfix">
                       <label class="col-lg-2 control-label " for="confirm">State </label>
                        <div class="col-lg-10">
			<span id="showsta"> <select onchange="getcity()" id= "state_id"  name="state_id"  class="required form-control">
					
					<option value="" >Select State</option>
					
					<?php 
			if($_POST['country_id']!='') { 
					$aryList=$db->getRows("select * from state where country_id='".$_POST['country_id']."' order by id desc " );
						foreach($aryList as $iList){
                ?>

					<option value="<?php echo $iList['id']; ?>" <?php if($_POST['state_id']==$iList['id']) { echo "selected"; } ?>>
				<?php echo $iList['state']; ?></option>
			<?php } }?> 
					
					
				</select></span>
			</div> 
            </div> 
			
			<div class="form-group clearfix">
                       <label class="col-lg-2 control-label " for="confirm">City</label>
                        <div class="col-lg-10">
						<span id="getsubsuccess"> <select  id="showcity" name="city_id"  class="required form-control">
						<option value="" >Select City</option>
						
						 <?php 
			if($_POST['state_id']!='') { 
					$aryList=$db->getRows("select * from city where state_id='".$_POST['state_id']."' order by id desc " );
						foreach($aryList as $iList){
                ?>

					<option value="<?php echo $iList['id']; ?>" <?php if($_POST['city_id']==$iList['id']) { echo "selected"; } ?>>
				<?php echo $iList['city']; ?></option>
			<?php } }?> 
						
						
                            </select></span>
                     </div> 
                    </div> 
			
			
			
			
			<div class="form-group clearfix">
									<label class="col-lg-2 control-label " for="price">Brand</label>
									<div class="col-lg-10">
									<input type="text" id="" name="brand" value="<?php echo $_POST['brand']; ?>" class="form-control ">
									</div>
									</div>
									
									<div class="form-group clearfix">
									<label class="col-lg-2 control-label " for="price">Quantity</label>
									<div class="col-lg-10">
									<input type="text" id="" name="quantity" value="<?php echo $_POST['quantity']; ?>" class="form-control ">
									</div>
									</div>
									
									<div class="form-group clearfix">
									<label class="col-lg-2 control-label " for="price">Color</label>
									<div class="col-lg-10">
									<input type="text" id="" name="color" value="<?php echo $_POST['color']; ?>" class="form-control ">
									</div>
									</div>
									
									<div class="form-group clearfix">
									<label class="col-lg-2 control-label " for="price">Size</label>
									<div class="col-lg-10">
									<input type="text" id="" name="size" value="<?php echo $_POST['size']; ?>" class="form-control ">
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
			
			/*  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ editdata  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@     */
			
			
					      elseif($_GET['action']=='edit') {
						  $aryDetail=$db->getRow("select * from  product where id='".$_GET['id']."'");
				?>
                            	
							<div class="card-box">
 							<form id="basic-form"  action="" method="post" enctype="multipart/form-data">
                                    
									<div class="form-group clearfix">
									<label class="col-lg-2 control-label " for="price">TITLE</label>
									<div class="col-lg-10">
									<input type="text" id="" name="title" value="<?php echo $aryDetail['title']; ?>" class="form-control ">
									</div>
									</div>
									
									<div class="form-group clearfix">
									<label class="col-lg-2 control-label " for="userName"> Short Description *</label>
									<div class="col-lg-10">
									<input type="text" id="" name="shortdescription" value="<?php echo $aryDetail['shortdiscription']; ?>" class="form-control ">
									</div>
									</div>
								
													
									<div class="form-group clearfix">
									<label class="col-lg-2 control-label " for="userName">Description *</label>
										<div class="col-lg-10">
										<textarea class="form-control required ckeditor" name="description"><?php echo $aryDetail['description']; ?></textarea>
										</div>
									</div>
									
									<div class="form-group clearfix">
                                    <label class="col-lg-2 control-label " for="userName">Product Price *</label>
                                      <div class="col-lg-10">
									  <input type="text" class="form-control required" name="price" value="<?php echo $aryDetail['price']; ?>">
                                      </div>
                                    </div>

										
									
										<div class="form-group clearfix">
				<label class="col-lg-2 control-label " for="userName">Image </label>
				
				<div class="col-lg-10">
				
				<input type="file" class="form-control " id="uploadimage" name="uploadimage">
				<input type="hidden" class="required form-control" name="uploadimage_old"  value="<?php echo $aryDetail['uploadimage'];?> ">
				<img src = "../uploads/<?php echo $aryDetail['uploadimage'];?>" style="height:100px;">
				
				</div>
				
				</div>

				
				<div class="form-group clearfix">
                       <label class="col-lg-2 control-label " for="confirm">Category </label>
                        <div class="col-lg-10">
						<span id="getsubsuccess"> <select onchange="getsubcategr(); getsubchild();" id="category_id" name="category_id"  class="required form-control">
					<option value="" >Select Category</option>
                <?php 
			
					$aryList=$db->getRows("select * from category" );
						foreach($aryList as $iList){
                ?>

					<option value="<?php echo $iList['id']; ?>" <?php if($aryDetail['category_id']==$iList['id']) { echo "selected"; } ?>>
				<?php echo $iList['categoryname']; ?></option>
                <?php } ?> 
                </select></span>
                     </div> 
					</div> 
				
					
					
					<div class="form-group clearfix">
                       <label class="col-lg-2 control-label " for="confirm">Sub category </label>
                        <div class="col-lg-10">
						<span id="showsub"> <select onchange="getsubchild()" id= "subcategory_id"  name="subcategory_id"  class="required form-control">
						<option value="" >Select Subcategory</option>
						
						<?php	/* if($_POST['category_id']!='') {  */
				
			$aryList=$db->getRows("select * from subcategory where category_id='".$aryDetail['category_id']."' order by id desc");
							
					foreach($aryList as $iList){  ?>

				  <option <?php if($aryDetail['subcategory_id']==$iList['id']){ echo "selected";} ?> value="<?php echo $iList['id'] ?>"><?php echo $iList['subcategory']; ?> </option>
				       <?php  } ?>
						
						
                            </select></span>
                     </div> 
                    </div> 
					
					<div class="form-group clearfix">
                       <label class="col-lg-2 control-label " for="confirm">Child Category </label>
                        <div class="col-lg-10">
						<span id="getsubsuccess"> <select  id="showchild" name="child_id"  class="required form-control">
						<option value="" >Select Childcategory</option>
						
						 <?php 
			
					$aryList=$db->getRows("select * from childcategory where subcategory_id= '".$aryDetail['subcategory_id']."'  order by id desc" );
						foreach($aryList as $iList){
                ?>

					<option value="<?php echo $iList['id']; ?>" <?php if($aryDetail['child_id']==$iList['id']) { echo "selected"; } ?>>
				<?php echo $iList['childcategory']; ?></option>
                <?php } ?> 
						
						
                            </select></span>
                     </div> 
                    </div> 
					
						<div class="form-group clearfix">
                       <label class="col-lg-2 control-label " for="confirm">Country </label>
                        <div class="col-lg-10">
						<span id="getsubsuccess"> <select onchange="getsubcountr();getcity();" id="country_id" name="country_id"  class="required form-control">
						<option value="" >Select Country</option>
                <?php 
			
					$aryList=$db->getRows("select * from country" );
							foreach($aryList as $iList){
                ?>
						<option value="<?php echo $iList['id']; ?>" <?php if($aryDetail['country_id']==$iList['id']) { echo "selected"; } ?>>			   
				<?php echo $iList['countryname']; ?></option>
               <?php } ?> 
                </select></span>
                     </div> 
                   </div> 
				 
					<div class="form-group clearfix">
                       <label class="col-lg-2 control-label " for="confirm">State </label>
                        <div class="col-lg-10">
	<span id="showsta"> <select onchange="getcity()" id= "state_id"  name="state_id"  class="required form-control">
						
					<option value="" >Select State</option>

                <?php 
				/* if($_POST['country_id']!='') {  */
					$aryList=$db->getRows("select * from state where country_id='".$aryDetail['country_id']."' order by id desc " );
                foreach($aryList as $iList)	{
                ?>
               <option value="<?php echo $iList['id']; ?>" <?php if($aryDetail['state_id']==$iList['id']) { echo "selected"; } ?>>
			   <?php echo $iList['state']; ?></option>
				<?php  }?> 
				</select></span>
			</div> 
            </div> 
			
						
			<div class="form-group clearfix">
                       <label class="col-lg-2 control-label " for="confirm">City</label>
                        <div class="col-lg-10">
						<span id="getsubsuccess"> <select  id="showcity" name="city_id"  class="required form-control">
						<option value="" >Select City</option>
						
						 <?php 
			
					/* if($_POST['state_id']!='') {  */
					$aryList=$db->getRows("select * from city where state_id='".$aryDetail['state_id']."' order by id desc " );
						foreach($aryList as $iList){
                ?>

					<option value="<?php echo $iList['id']; ?>" <?php if($aryDetail['city_id']==$iList['id']) { echo "selected"; } ?>>
				<?php echo $iList['city']; ?></option>
					<?php  }?> 
						
						
                            </select></span>
                     </div> 
                    </div> 
			
			
			<div class="form-group clearfix">
									<label class="col-lg-2 control-label " for="price">Brand</label>
									<div class="col-lg-10">
									<input type="text" id="" name="brand" value="<?php echo $aryDetail['brand']; ?>" class="form-control ">
									</div>
									</div>
									
									<div class="form-group clearfix">
									<label class="col-lg-2 control-label " for="price">Quantity</label>
									<div class="col-lg-10">
									<input type="text" id="" name="quantity" value="<?php echo $aryDetail['quantity']; ?>" class="form-control ">
									</div>
									</div>
									
									<div class="form-group clearfix">
									<label class="col-lg-2 control-label " for="price">Color</label>
									<div class="col-lg-10">
									<input type="text" id="" name="color" value="<?php echo $aryDetail['color']; ?>" class="form-control ">
									</div>
									</div>
									
									<div class="form-group clearfix">
									<label class="col-lg-2 control-label " for="price">Size</label>
									<div class="col-lg-10">
									<input type="text" id="" name="size" value="<?php echo $aryDetail['size']; ?>" class="form-control ">
									</div>
									</div>
					
									
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
			  		 	
		/*  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ viewdata  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@     */
						  

						  elseif($_GET['action']=='view') { 
			                 $GetEmailId=$db->getRow("select * from product where id='".$_GET['id']."'");
		                ?>
                                <div class="card-box"> 
                                    <div>
                                             
						            <div class="form-group clearfix">
									<label class="col-lg-2 control-label " for="price">Title   :</label>
									<?php echo $GetEmailId['title']; ?>
									</div>
									
									  <div class="form-group clearfix">
									<label class="col-lg-2 control-label " for="price">Short Description  :</label>
									<?php echo $GetEmailId['shortdiscription']; ?>
									</div>
									
									  <div class="form-group clearfix">
									<label class="col-lg-2 control-label " for="price">Description  :</label>
									<?php echo $GetEmailId['description']; ?>
									</div>
									  <div class="form-group clearfix">
									<label class="col-lg-2 control-label " for="price">Price :</label>
									<?php echo $GetEmailId['price']; ?>
									</div>
									
									
									<div class="form-group clearfix">				
									<label class="col-lg-2 control-label " for="price">Product Image :</label>
								<img src="../uploads/<?php echo $GetEmailId['uploadimage']; ?>" style="height:50px;">	
									</div>
									
									  <div class="form-group clearfix">
								    <label class="col-lg-2 control-label " for="price">Category  :</label>
									<?php echo $db->getVal("select categoryname from category where  id='".$GetEmailId['category_id']."' ");?>
								     </div>
									
									
									<div class="form-group clearfix">
								    <label class="col-lg-2 control-label " for="price">Sub category :</label>
									<?php echo $db->getVal("select subcategory from subcategory where  id='".$GetEmailId['subcategory_id']."' ");?>
								     </div>
									
									<div class="form-group clearfix">
								    <label class="col-lg-2 control-label " for="price">Child category :</label>
									<?php echo $db->getVal("select childcategory from childcategory where  id='".$GetEmailId['child_id']."' ");?>
								     </div>
									
									
									    <div class="form-group clearfix">
								    <label class="col-lg-2 control-label " for="price">Country  :</label>
									<?php echo $db->getVal("select countryname from country where  id='".$GetEmailId['country_id']."' ");?>
								    </div>
									
									
									<div class="form-group clearfix">
								    <label class="col-lg-2 control-label " for="price">state :</label>
									<?php echo $db->getVal("select state from state where  id='".$GetEmailId['state_id']."' ");?>
								    </div>
									
									<div class="form-group clearfix">
								    <label class="col-lg-2 control-label " for="price">City :</label>
									<?php echo $db->getVal("select city from city where  id='".$GetEmailId['city_id']."' ");?>
								     </div>
									 
									<div class="form-group clearfix">
									<label class="col-lg-2 control-label " for="price">Brand   :</label>
									<?php echo $GetEmailId['brand']; ?>
									</div>
									<div class="form-group clearfix">
									<label class="col-lg-2 control-label " for="price">Quantity   :</label>
									<?php echo $GetEmailId['quantity']; ?>
									</div>
									<div class="form-group clearfix">
									<label class="col-lg-2 control-label " for="price">Color   :</label>
									<?php echo $GetEmailId['color']; ?>
									</div>
									<div class="form-group clearfix">
									<label class="col-lg-2 control-label " for="price">Size   :</label>
									<?php echo $GetEmailId['size']; ?>
									</div>
								
									<div class="form-group clearfix">
									<label class="col-lg-2 control-label " for="price">Status   :</label>
									<?php
					 $aryList=$db->getRows("select *from  product order by id desc");
							 foreach($aryList as $iList)
									{	$i=$i+1;
									$aryPgAct["id"]=$iList['id'];
							 ?>   <?php } ?>
                                         <?php if($iList['status']=='1'){echo "Active";}
                                         if($iList['status']=='0'){echo "Inactive";} ?>							 
									  
									</div>  
                                     
                                   <a  href="<?php echo  $FileName;  ?>"  class="btn btn-default" >Back</a>
                                </div>
                             
                                     
                       
                      <?php } 
					  
	  /*  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ front  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@     */
					 	else { ?>
                       <div class="card-box">
                                <table id="datatable" class="table table-striped table-bordered">
                                     <thead>
                                        <tr>
                                            <th>Serial No.</th>
                                            <th>Title</th>
											<th>Status</th>
											 <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
					 $aryList=$db->getRows("select * from  product where status!= 11 order by id desc");
							 foreach($aryList as $iList)
									{	$i=$i+1;
									$aryPgAct["id"]=$iList['id'];
							 ?>       
									<tr class="<?php if($i%2=='0'){ echo "success"; } else { echo "warning"; } ?>">
									<td><?php echo $i ?></td>
									<td><?php echo $iList['title']; ?></td>
									
								    <td><?php if($iList['status']=='1'){echo "Active";}
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
<script src="assets/js/jquery.min.js" type="text/javascript"></script>
<script>


function getsubcategr()
	{
		
			var category_id =	document.getElementById('category_id').value;	
			//alert(category_id);
			
		$.post("ajx.php",
				{	 
					
					category_id : category_id
				 
					  
				},
		function(data){
							document.getElementById('showsub').innerHTML =data;
				});
		
	}
	

function getsubcountr()
	{
		
			var country_id =	document.getElementById('country_id').value;	
		/* alert(country_id); */
			
		$.post("ajax_country.php",
				{	 
					
					country_id : country_id
				 
					  
				},
		function(data){
							document.getElementById('showsta').innerHTML =data;
				});
		
	}
	
	
	function getcity()
	{
		
			var state_id =	document.getElementById('state_id').value;	
		/* alert(country_id); */
			
		$.post("ajax_city.php",
				{	 
					
					state_id : state_id
				 
					  
				},
		function(data){
							document.getElementById('showcity').innerHTML =data;
				});
		
	}
	
	
	function getsubchild()
	{
		
			var subcategory_id =	document.getElementById('subcategory_id').value;	
		/* alert(subcategory_id); */
			
		$.post("ajaxchild.php",
				{	 
					
					subcategory_id : subcategory_id
				 
					  
				},
		function(data){
							document.getElementById('showchild').innerHTML =data;
				});
		
	}
	
</script>
</body>
</html>