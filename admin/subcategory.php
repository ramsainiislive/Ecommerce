 <?php  

include('../config.php'); 

include('inc.session.php'); 

$PageTitle="Subcategory";

$FileName ='subcategory.php';

$iClassName = ADMIN_URL;

$validate=new Validation();

if($_SESSION['success']!="")

{

   $stat['success']=$_SESSION['success'];

   unset($_SESSION['success']);

}



if(isset($_POST['submit']))

 	{ 
		
		$validate->addRule($_POST['language_id'],'','Language',true);
		
        $validate->addRule($_POST['cat_id'],'','Category Name',true);
		
		$validate->addRule($_POST['subcategory'],'','Subcategory',true);
		
		$validate->addRule($_POST['pageurl'],'','PageURL',true);



		if($validate->validate() && count($stat)==0)

			{
			
			$iPageURL =	PageUrl($_POST['pageurl']);
			
			$aryChkName=$db->getRow("select pageurl from  subcategorys where pageurl='$iPageURL'");
				if(is_array($aryChkName) && count($aryChkName)>0){   		   
				$stat['error'] = "This PageURL is Already Exist";
				}
				else{
			
			if(isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"]))

				{	 

 					$filename = basename($_FILES['image']['name']);

					$ext1 = strtolower(substr($filename, strrpos($filename, '.')+1));

					
						$newfile=md5(time())."_".$filename;

 						move_uploaded_file($_FILES['image']['tmp_name'],"../uploads/".$newfile);

 							

				 } 

		  $aryData=array(	

			  

									'cat_id'     	 	     	 =>	$_POST['cat_id'],

									'language_id'     	 	     =>	$_POST['language_id'],
									
									'subcategory'     	 	     =>	$_POST['subcategory'],
									
									'image'     	 	     	 =>	$newfile,
									
									'pageurl'     	 	     	 =>	$iPageURL,

									'status'     	 	         =>	$_POST['status'],

												

							 );  

					$flgIn1 = $db->insertAry("subcategorys",$aryData);

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

        
		$validate->addRule($_POST['language_id'],'','Language',true);
		
       $validate->addRule($_POST['cat_id'],'','Category Name',true);
		
		$validate->addRule($_POST['subcategory'],'','Subcategory',true);



		if($validate->validate() && count($stat)==0)

			{
			
			$iPageURL =	PageUrl($_POST['pageurl']);
			
	$aryChkName=$db->getRow("select pageurl from  subcategorys where pageurl='$iPageURL' and id!='".$_GET['id']."'");
				if(is_array($aryChkName) && count($aryChkName)>0){   		   
				$stat['error'] = "This PageURL is Already Exist";
				}
				else{
			
			if(isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"]))

				{	 

 					$filename = basename($_FILES['image']['name']);

					$ext1 = strtolower(substr($filename, strrpos($filename, '.')+1));

					
						$newfile=md5(time())."_".$filename;

 						move_uploaded_file($_FILES['image']['tmp_name'],"../uploads/".$newfile);

				 }
				 
				 else { $newfile = $_POST['image_old']; } 

		  $aryData=array(	

			  

									'cat_id'     	 	     	 =>	$_POST['cat_id'],

									'language_id'     	 	     =>	$_POST['language_id'],
									
									'subcategory'     	 	     =>	$_POST['subcategory'],
									
									'image'     	 	     	 =>	$newfile,
									
									'pageurl'     	 	     	 =>	$iPageURL,

									'status'     	 	         =>	$_POST['status'],

								 );  

					$flgIn = $db->updateAry("subcategorys", $aryData , "where id='".$_GET['id']."'");

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

			 	 $flgIn1 = $db->delete("subcategorys","where id='".$_GET['id']."'");			

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
									
					<select  class="required form-control" name="language_id" id="language" onChange="getcategory_insub()">

                                <option value="">Select Language</option>
								
								<?php $aryLang=$db->getRows("select * from languages order by id desc");

							 foreach($aryLang as $iLang)

									{  ?>

			<option value="<?php echo $iLang['id']; ?>" <?php  if($_POST['language_id']==$iLang['id']) { echo "selected"; } ?>>
			<?php echo $iLang['language']; ?></option>
							
							<?php } ?>

                                            </select>
											
									</div>
									
									</div>
								

 			 <div class="form-group clearfix">

                       <label class="col-lg-2 control-label " for="confirm">Category Name * </label>

                        <div class="col-lg-10">

                  <span id="getsubsuccess"> <select name="cat_id"  class="required form-control">

                  <option value="" >Select Category</option>

                <?php if($_POST['cat_id']!='') { 
			
 	$aryList=$db->getRows("select * from categorys where language_id = '".$_POST['language_id']."' and status = '1' order by id desc");

                foreach($aryList as $iList)

                {

                ?>

               <option value="<?php echo $iList['id']; ?>" <?php if($_POST['cat_id']==$iList['id']) { echo "selected"; } ?>>
			   
				<?php echo $iList['categoryname']; ?></option>

                <?php } }?> 

                

                </select></span>

                     </div> 

                    </div> 
					
																			

                                                <div class="form-group clearfix">

                                         <label class="col-lg-2 control-label " for="userName">Subcategory Name *</label>

                                                    <div class="col-lg-10">

             <input type="text" class="form-control required" name="subcategory" value="<?php echo $_POST['subcategory']; ?>">

                                                    </div>

                                                </div>
												
												<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="userName"> Image *</label>
									
									<div class="col-lg-10">
									
									<input type="file" class="form-control " id="" name="image">
									
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

					    $aryDetail=$db->getRow("select * from  subcategorys where id='".$_GET['id']."'");

					   ?>

                           

                                                             	<div class="card-box">

 									<form role="form" action="" method="post" enctype="multipart/form-data">

                                        <div>

                                           

                                            <section>

								
								<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="userName">Language </label>
									
									<div class="col-lg-10">
									
				<select  class="required form-control" name="language_id" id="language" onChange="getcategory_insub()">

                                <option value="">Select Language</option>
								
								<?php $aryLang=$db->getRows("select * from languages order by id desc");

							 foreach($aryLang as $iLang)

									{  ?>

			<option value="<?php echo $iLang['id']; ?>" <?php if($_POST['language_id']!='') { if($_POST['language_id']==$iLang['id']) { echo "selected"; } } else { if($aryDetail['language_id']==$iLang['id']) { echo "selected"; } }?>>
			<?php echo $iLang['language']; ?></option>
							
							<?php } ?>

                                            </select>
											
									</div>
									
									</div>
											

						<div class="form-group clearfix">

                       <label class="col-lg-2 control-label " for="confirm">Category Name  </label>

                        <div class="col-lg-10">
						
						 <span id="getsubsuccess"> <select name="cat_id"  class="required form-control">

                  <option value="" >Select Category</option>

                <?php if($_POST['cat_id']!='') { 
			
 	$aryList=$db->getRows("select * from categorys where language_id = '".$_POST['language_id']."' and status = '1' order by id desc");

                foreach($aryList as $iList)

                {

                ?>

               <option value="<?php echo $iList['id']; ?>" <?php if($_POST['cat_id']==$iList['id']) { echo "selected"; } ?>>
			   
				<?php echo $iList['categoryname']; ?></option>

                <?php } } else {
				$aryList=$db->getRows("select * from categorys where  status = '1' order by id desc");

                foreach($aryList as $iList)

                {

                ?>

               <option value="<?php echo $iList['id']; ?>" <?php if($aryDetail['cat_id']==$iList['id']) { echo "selected"; } ?>>
			   
				<?php echo $iList['categoryname']; ?></option>

                <?php } } ?>

                

                </select></span>

                   

                     </div> 

                    </div> 
					
																			

                                                <div class="form-group clearfix">

                                         <label class="col-lg-2 control-label " for="userName">Subcategory Name </label>

                                                    <div class="col-lg-10">

            <input type="text" class="form-control required" name="subcategory" value="<?php echo $aryDetail['subcategory']; ?>">

                                                    </div>

                                                </div>
												
												<div class="form-group clearfix">
									
				<label class="col-lg-2 control-label " for="userName"> Image </label>
				
				<div class="col-lg-10">
				
				<input type="file" class="form-control"  name="image" >
				
		<input type="hidden" class="form-control required" name="image_old" value="<?php echo $aryDetail['image']; ?>">
		
		<img src="../uploads/<?php echo $aryDetail['image']; ?>" style="height:50px;">
				
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

                                                    <th>Category Name</th>

													 <th>Subcategory Name</th>
													 
													 <th>Image</th>

                                                    <th>Status</th>

													 <th>Action</th>

                                               </tr>

                                            </thead>

								

								

                                            <tbody>

											                                     

				 <?php	 $aryList=$db->getRows("select * from subcategorys  order by id desc");

							 foreach($aryList as $iList)

									{	$i=$i+1;

									$aryPgAct["id"]=$iList['id'];

							 ?> 

                                                <tr>

												    <td><?php echo $i ?></td>
													
					<td><?php echo $db->getVal("select language from  languages where id = '".$iList['language_id']."'"); ?></td>

                   <td><?php echo $db->getVal("select categoryname from categorys where  id='".$iList['cat_id']."' ");?> </td>
                        

													<td><?php echo $iList['subcategory']; ?></td>
										<td><img src="../uploads/<?php echo $iList['image']; ?>" style="height:50px;"></td>

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
		  
		  <script>

   function getcategory_insub()

   	{
	

 	 var language = document.getElementById("language").value;

 		$.ajax({

			type: 'post',

			url: 'ajax.php',

			data: {

				 action	: "getcategories",

				language	: language,

			 },

			 success: function( data ) {

				

				$("#getsubsuccess").html(data);

			}

			});

 	}

	</script>

	</body>

</html>