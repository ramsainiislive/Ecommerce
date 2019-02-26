 <?php  

include('../config.php'); 

//include('inc.session-create.php'); 

$PageTitle="Product List";

$FileName ='product.php';

$iClassName = ADMIN_URL;

$validate=new Validation();

if($_SESSION['success']!="")

{
   $stat['success']=$_SESSION['success'];

   unset($_SESSION['success']);

}
if(isset($_POST['submit']))

 	{ 

		$validate->addRule($_POST['title'],'','Title',true);
		
		$validate->addRule($_POST['description'],'','Description',true);
		
		$validate->addRule($_POST['category_id'],'','Category Name',true);
		
		$validate->addRule($_POST['subcategory_id'],'','Subcategory Name',true);
		
	
		if($validate->validate() && count($stat)==0)

			{
			
			
			 if(isset($_FILES["uploadimage"]["name"]) && !empty($_FILES["uploadimage"]["name"]))

				{	 

 					$filename = basename($_FILES['uploadimage']['name']);

					$ext1 = strtolower(substr($filename, strrpos($filename, '.')+1));

					
						$newfile=md5(time())."_".$filename;

 						move_uploaded_file($_FILES['uploadimage']['tmp_name'],"../uploads/".$newfile);

		  $aryData=array(	

			  
									
									'title'     	 	     	 =>	$_POST['title'],
									
									'description'     	 	     =>	$_POST['description'],
									
									'uploadimage'     	 	     	 =>	$newfile,
									
									'price'     	 	 =>	$_POST['product_price'],
									
									'category_id'     	 	     =>	$_POST['category_id'],
									
									'subcategory_id'     	 	 =>	$_POST['subcategory_id'],
									
									'status'     	 	         =>	$_POST['status'],

												

							 );  

					$flgIn1 = $db->insertAry("product",$aryData);
					 $_SESSION['success']="Submited Successfully";
					
			}

		   
		 else {

			$stat['error'] = $validate->errors();

			}

			}

	} 

	



elseif(isset($_POST['update']))

	{ 

		if($validate->validate() && count($stat)==0)

			{
			
			if(isset($_FILES["uploadimage"]["name"]) && !empty($_FILES["uploadimage"]["name"]))

				{	 

 					$filename = basename($_FILES['uploadimage']['name']);

					$ext1 = strtolower(substr($filename, strrpos($filename, '.')+1));

					
						$newfile=md5(time())."_".$filename;

 						move_uploaded_file($_FILES['uploadimage']['tmp_name'],"../uploads/".$newfile);

 									

				
		  $aryData=array(	

			  

									
									
									'title'     	 	     	 =>	$_POST['title'],
									
									'description'     	 	     =>	$_POST['description'],
									
									'uploadimage'     	 	     	 =>	$newfile,
									
									'product_price'     	 	 =>	$_POST['product_price'],
									
									'category_id'     	 	     =>	$_POST['category_id'],
									
									'subcategory_id'     	 	 =>	$_POST['subcategory_id'],
									
									'status'     	 	         =>	$_POST['status'],

								 );  

					$flgIn = $db->updateAry("product", $aryData , "where id='".$_GET['id']."'");
					
			  
			  //echo  	$db->getLastQuery();
		//exit();
			
					
			}

		          	$_SESSION['success']="Update Successfully";

					unset($_POST);

					redirect($iClassName.$FileName);



	

	}

 else {

	    $stat['error'] = $validate->errors();

        }

				

	}

/* @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@           delete data @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/
elseif(($_REQUEST['action']=='delete'))

	{

			 	 $flgIn1 = $db->delete("poducts","where id='".$_GET['id']."'");
				 
				 $flgIn1 = $db->delete("specification","where product_id='".$_GET['id']."'");			
				 $flgIn1 = $db->delete("product_image","where product_id='".$_GET['id']."'");
				 $flgIn1 = $db->delete("product_files","where product_id='".$_GET['id']."'");
			     $_SESSION['success'] = 'Deleted Successfully';

                 redirect($iClassName.$FileName);	

	}
	
	elseif(($_REQUEST['action']=='imagedelete'))

	{

			 	
				 
				 $flgIn1 = $db->delete("product_image","where id='".$_GET['imid']."' and product_id='".$_GET['id']."'");			

			     $_SESSION['success'] = 'Deleted Successfully';

                redirect($iClassName."product.php?action=uploadimage&id=".$_GET['id']);

	} 
	
	elseif(($_REQUEST['action']=='filedelete'))

	{

			 	
				 
				 $flgIn1 = $db->delete("product_files","where id='".$_GET['fid']."' and product_id='".$_GET['id']."'");			

			     $_SESSION['success'] = 'Deleted Successfully';

                redirect($iClassName."product.php?action=uploadfile&id=".$_GET['id']);

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

							<?php if($_GET['action']=='uploadfile') { ?>
							
							<a href="<?php echo $iClassName.$FileName; ?>?action=uploadfile&id=<?php echo $_GET['id']?>"  class="btn btn-default" style="float:left; margin-right: 5px;">Upload File</a>
				
						  <a href="<?php echo $iClassName.$FileName; ?>?action=uploadimage&id=<?php echo $_GET['id']?>"  class="btn btn-default" style="float:left; margin-right: 5px;">Upload Image</a>
						  
						  <a href="<?php echo $iClassName.$FileName; ?>?action=edit&id=<?php echo $_GET['id']?>"  class="btn btn-default" style="float:left">Product Detail</a>
						  <br>
						  <br> 

                            	<div class="card-box">

 							<form role="form" action="" method="post" enctype="multipart/form-data">

                                        <div>

                                           

                                         

                                        </div>

                                    </form> 

                             	</div>

                     <?php }
					 
					 elseif($_GET['action']=='uploadimage') { ?>
					 
					 <a href="<?php echo $iClassName.$FileName; ?>?action=uploadfile&id=<?php echo $_GET['id']?>"  class="btn btn-default" style="float:left; margin-right: 5px;">Upload File</a>
				
						  <a href="<?php echo $iClassName.$FileName; ?>?action=uploadimage&id=<?php echo $_GET['id']?>"  class="btn btn-default" style="float:left; margin-right: 5px;">Upload Image</a>
						  
						  <a href="<?php echo $iClassName.$FileName; ?>?action=edit&id=<?php echo $_GET['id']?>"  class="btn btn-default" style="float:left">Product Detail</a>
						  <br>
						  <br> 

                            	<div class="card-box">

 							<form role="form" action="" method="post" enctype="multipart/form-data">

                                        <div>
                                            <section>
						
						
												
									<div class="form-group clearfix">
									
				<label class="col-lg-2 control-label " for="userName">Image </label>
				
				<div class="col-lg-10">
				
				<input type="file" class="form-control " id="uploadimage" name="uploadimage">
				
				</div>
				
				</div>
                                      

                                	<button type="submit" name="upload_image" class="btn btn-default">Submit</button>

                               <br><br> 
										   
										   
					<table id="" class="table table-striped table-bordered">

                                            <thead>

                                                <tr>

												   <th>#</th>

                                                    <th>Product</th>
													 
													 <th>Image</th>
													 
													 <th>Action</th>

                                               </tr>

                                            </thead>

                                            <tbody>

											                                     

				 <?php $aryList=$db->getRows("select * from product where product_id='".$_GET['id']."' order by id desc");

							 foreach($aryList as $iList)

									{	$i=$i+1;

									$aryPgAct["id"]=$iList['id'];

							 ?> 

                                                <tr>

												    <td><?php echo $i ?></td>
													
				<td><?php echo $db->getVal("select title from product where id = '".$iList['product_id']."'"); ?></td>

                   									

								<td><img src="../uploads/<?php echo $iList['uploadimage']; ?>" style="height:50px;"></td>
						<td><a href="javascript:del('<?php echo $iClassName."product.php?action=uploadimage&id=".$_GET['id']; ?>&action=imagedelete&imid=<?php echo $iList['id']; ?>')"    class="table-action-btn" > <i class="fa fa-times"></i> </a></td>
													
				

                                                </tr>

     

												<?php } ?>

                                            </tbody>

                                        </table>

                                            </section>

                                              

                                        </div>

                                    </form> 

                             	</div>

                     <?php }
/* @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ Insert data @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ */

					  elseif($_GET['action']=='add') { ?>

                            	<div class="card-box">

 							<form role="form" action="" method="post" enctype="multipart/form-data">

                                        <div>

                                           

                                            <section>
											
											
						
						
						
						<div class="form-group clearfix">

                                         <label class="col-lg-2 control-label " for="userName">Title *</label>

                                                    <div class="col-lg-10">

             <input type="text" class="form-control required" name="title" value="<?php echo $_POST['title']; ?>">

                                                    </div>

                                                </div>
												
									<div class="form-group clearfix">

                                         <label class="col-lg-2 control-label " for="userName">Description *</label>

                                                    <div class="col-lg-10">

             <textarea class="form-control required ckeditor" name="description"><?php echo $_POST['description']; ?></textarea>

                                                    </div>

                                                </div>
												
									<div class="form-group clearfix">
									
				<label class="col-lg-2 control-label " for="userName">Product Image *</label>
				
				<div class="col-lg-10">
				
				<input type="file" class="form-control " id="" name="pimage">
				
				</div>
				
				</div>
				
									<div class="form-group clearfix">

                                         <label class="col-lg-2 control-label " for="userName">Product Price *</label>

                                                    <div class="col-lg-10">

          <input type="text" class="form-control required" name="product_price" value="<?php echo $_POST['price']; ?>">

                                                    </div>

                                                </div>

 			       <span id="getcategorysuccess"><div class="form-group clearfix">

                       <label class="col-lg-2 control-label " for="confirm">Category Name* </label>

                        <div class="col-lg-10">

                  
				   <select name="category_id" id="cat_id"  class="required form-control" onChange="getsubcategory()">

                  <option value="" >Select Category</option>

                <?php if($_POST['category_id']!='') { 
			 $aryList=$db->getRows("select * from category where language_id = '".$_POST['language_id']."' and status = '1' order by id desc");

                foreach($aryList as $iList)

                {

                ?>

               <option value="<?php echo $iList['id']; ?>" <?php if($_POST['category_id']==$iList['id']) { echo "selected"; } ?>>
			   
				<?php echo $iList['categoryname']; ?></option>

                <?php }  }?> 

                

                </select>

                     </div> 

                    </div>
                                                <div class="form-group clearfix">

                                         <label class="col-lg-2 control-label " for="userName">Subcategory Name *</label>

                                                    <div class="col-lg-10">

            <span id="getcatsuccess">
			<select name="subcategory_id" class="form-control">
			<option value="">Select Subcategory</option>
			
		<?php if($_POST['subcategory_id']!='') { 
			 $aryLists=$db->getRows("select * from subcategory where cat_id = '".$_POST['category_id']."' and status = '1' order by id desc");
      foreach($aryLists as $iLists){  ?>
<option <?php if($_POST['subcategory_id']==$iLists['id']){ echo "selected";} ?> value="<?php echo $iLists['id']; ?>">

<?php echo $iLists['subcategory']; ?></option>
	
	<?php }  }  ?>
			
			</select></span>

                                                    </div>

                                                </div></span>
							

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
 <!-- *************************************** EDIT ****************************************************** --> 


                     <?php } elseif($_GET['action']=='edit') { 

					    $aryDetail=$db->getRow("select * from  product where id='".$_GET['id']."'");

					 ?>

                          <a href="<?php echo $iClassName.$FileName; ?>?action=uploadfile&id=<?php echo $_GET['id']?>"  class="btn btn-default" style="float:left; margin-right: 5px;">Upload File</a>
				
						  <a href="<?php echo $iClassName.$FileName; ?>?action=uploadimage&id=<?php echo $_GET['id']?>"  class="btn btn-default" style="float:left">Upload Image</a>
						  <br>
						  <br> 

                                                             	<div class="card-box">

 									<form role="form" action="" method="post" enctype="multipart/form-data">

                                        <div>

                                           

                                            <section>

											

					
						
						<div class="form-group clearfix">

                                         <label class="col-lg-2 control-label " for="userName">Title </label>

                                                    <div class="col-lg-10">

             <input type="text" class="form-control required" name="title" value="<?php echo $aryDetail['title']; ?>">

                                                    </div>

                                                </div>
												
									<div class="form-group clearfix">

                                         <label class="col-lg-2 control-label " for="userName">Description </label>

                                                    <div class="col-lg-10">

             <textarea class="form-control required ckeditor" name="description"><?php echo $aryDetail['description']; ?></textarea>

                                                    </div>

                                                </div>
												
									<div class="form-group clearfix">
									
				<label class="col-lg-2 control-label " for="userName">Product Image </label>
				
				<div class="col-lg-10">
				
				<input type="file" class="form-control"  name="pimage" >
				
		<input type="hidden" class="form-control required" name="pimage_old" value="<?php echo $aryDetail['uploadimage']; ?>">
		
		<img src="../uploads/<?php echo $aryDetail['uploadimage']; ?>" style="height:50px;">
				
				</div>
				
				</div>
				
								<div class="form-group clearfix">

                                         <label class="col-lg-2 control-label " for="userName">Product Price </label>

                                                    <div class="col-lg-10">

      <input type="text" class="form-control required" name="product_price" value="<?php echo $aryDetail['price']; ?>">

                                                    </div>

                                                </div>

 			 			 <span id="getcategorysuccess"><div class="form-group clearfix">

                       <label class="col-lg-2 control-label " for="confirm">Category Name </label>

                        <div class="col-lg-10">

                  
				   <select name="category_id" id="cat_id"  class="required form-control" onChange="getsubcategory()">

                  <option value="" >Select Category</option>

                <?php if($_POST['category_id']!='') { 
			 $aryList=$db->getRows("select * from category where language_id = '".$_POST['language_id']."' and status = '1' order by id desc");

                foreach($aryList as $iList)

                {

                ?>

              <option value="<?php echo $iList['id']; ?>" <?php if($_POST['category_id']==$iList['id']) { echo "selected"; } ?>>
			   
				<?php echo $iList['categoryname']; ?></option>

                <?php }  } else {

                $aryList=$db->getRows("select * from categorys where language_id = '".$aryDetail['language_id']."' and status = '1' order by id desc");

                foreach($aryList as $iList)

                {

                ?>

         <option value="<?php echo $iList['id']; ?>" <?php if($aryDetail['category_id']==$iList['id']) { echo "selected"; } ?>>
			   
				<?php echo $iList['categoryname']; ?></option>

                <?php } } ?>

                </select>

                     </div> 

                    </div> 
					
									

											

                                                <div class="form-group clearfix">

                                         <label class="col-lg-2 control-label " for="userName">Subcategory Name </label>

                                                    <div class="col-lg-10">

            <span id="getcatsuccess">
			<select name="subcategory_id" class="form-control">
			<option value="" selected>Select Subcategory</option>
			<?php 
			 $aryList1=$db->getRows("select * from subcategory where cat_id='".$aryDetail['category_id']."' and
			  status = '1' order by id desc");
      foreach($aryList1 as $iList1){  ?>
<option <?php if($aryDetail['subcategory_id']==$iList1['id']){ echo "selected";} ?> value="<?php echo $iList1['id']; ?>">

<?php echo $iList1['subcategory']; ?></option>
	
	<?php } ?>
			
			</select></span>
           </div>
             </div></span>
						
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
		 
		 /*  <!-- *************************************** VIEW ****************************************************** --> */
		 			elseif($_GET['action']=='view') { 

					    $GetEmailId=$db->getRow("select * from  product where id='".$_GET['id']."'");

					   ?>
								
                           

                                                             	<div class="card-box">

                                       
											<div>
                                           

                                            <section>

											

						
						
						<div class="form-group clearfix">

                                         <label class="col-lg-2 control-label " for="userName">Title :</label>

            			<?php echo $GetEmailId['title']; ?>

                                                </div>
												
									<div class="form-group clearfix">

                                         <label class="col-lg-2 control-label " for="userName">Description :</label>

             				<?php echo $GetEmailId['description']; ?>
                                                 

                                                </div>
												
									<div class="form-group clearfix">
									
				<label class="col-lg-2 control-label " for="userName">Product Image :</label>
				
		
		<img src="../uploads/<?php echo $GetEmailId['uploadimage']; ?>" style="height:50px;">
			
				
				</div>
				
				<div class="form-group clearfix">

                                         <label class="col-lg-2 control-label " for="userName">Product Price :</label>

      								<?php echo $GetEmailId['price']; ?>

                                                </div>

 			 <div class="form-group clearfix">

                       <label class="col-lg-2 control-label " for="confirm">Category Name :</label>

                       
		<?php echo $db->getVal("select categoryname from  category where id = '".$GetEmailId['category_id']."'"); ?>
                   

                    </div> 
					
                                                <div class="form-group clearfix">

                                         <label class="col-lg-2 control-label " for="userName">Subcategory Name :</label>
										 
			<?php echo $db->getVal("select subcategory from  subcategory where id = '".$GetEmailId['subcategory_id']."'"); ?>

                                                    

                                                </div>
			
									  <div class="form-group clearfix">

                                           <label class="col-lg-2 control-label " for="confirm">Status :</label>

                                <?php if($GetEmailId['status']=='1') { echo "Active"; } ?>

							<?php if($GetEmailId['status']=='0') { echo "Inactive"; } ?>

										</div>

									

                                           <a  href="<?php echo $iClassName.$FileName; ?>"  class="btn btn-default" >Back</a>     

                                            </section>

                                              

                                        </div>

                                    </form> 

                             	</div>

         <?php  } 
 /*  <!-- *************************************** Front ****************************************************** --> */
		   else { ?> 

                                <div class="card-box">

                               

                                    <table id="datatable" class="table table-striped table-bordered">

                                            <thead>

                                                <tr>

												   <th>#</th>

                                                    <th>Title</th>
													
													<th>Product Image</th>
													
                                                    <th>Status</th>

													 <th>Action</th>

                                               </tr>

                                            </thead>

								

								

                                            <tbody>

											                                     

				 <?php	 $aryList=$db->getRows("select * from product  order by id desc");

							 foreach($aryList as $iList)

									{	$i=$i+1;

									$aryPgAct["id"]=$iList['id'];

							 ?> 

                                                <tr>

												    <td><?php echo $i ?></td>

                   									<td><?php echo $iList['title']; ?> </td>

										<td><img src="../uploads/<?php echo $iList['uploadimage']; ?>" style="height:50px;"></td>
										
						<!--							
				<td><?php echo $db->getVal("select language from  languages where id = '".$iList['language_id']."'"); ?></td>  -->


                                                    <td>

													<?php if($iList['status']=='1'){echo "Active";}

													if($iList['status']=='0'){echo "Inactive";} ?>

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

                            <?php } ?> 

								



								

                        	</div>

                    	</div>



                         



                    </div>  

                               

                </div>  



               <?php include('inc.footer.php'); ?>




            </div>

             

         </div>

          <?php include('inc.js.php'); ?>
		  
<script type="text/javascript">

$(document).ready(function() {	
		$("#btnAdd1").on("click",function(){
		var $tableBody = $('#table-data1').find("tbody"),
		$trLast = $tableBody.find("tr:last"),
		$trNew = $trLast.clone();
		$trLast.after($trNew);
		 });	 
});


</script>

<script type="text/javascript">
 
 var deleteRow = function (link, getthis) {
 
 var rowCount = $('#'+getthis+' >tbody >tr').length;	
  if(rowCount>1)	
 	{
     var row = link.parentNode.parentNode;
     var table = row.parentNode; 
     table.removeChild(row);
	 
	 } 
 }
</script>
		  
		  <script>

   function getsubcategory()

   	{
	

 	 var cat_id = document.getElementById("cat_id").value;

 		$.ajax({

			type: 'post',

			url: 'ajax.php',

			data: {

				 action	: "getsubcategory",

				cat_id	: cat_id,

			 },

			 success: function( data ) {

				

				$("#getcatsuccess").html(data);

			}

			});

 	}

	</script>
	
	<script>

   function getcategory()

   	{
	

 	 var language_id = document.getElementById("language_id").value;

 		$.ajax({

			type: 'post',

			url: 'ajax.php',

			data: {

				 action	: "getcategory",

				language_id	: language_id,

			 },

			 success: function( data ) {

				

				$("#getcategorysuccess").html(data);

			}

			});

 	}

	</script>

	</body>

</html>