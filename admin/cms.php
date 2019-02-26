<?php include('../config.php'); 
include('inc.session.php'); 
$PageTitle="CMS";
$FileName = 'cms.php';
$validate=new Validation();
if($_SESSION['success']!="")
{
$stat['success']=$_SESSION['success'];
unset($_SESSION['success']);
}
if(isset($_POST['submit']))
{ 
$validate->addRule($_POST['languages'],'','Language',true);
$validate->addRule($_POST['title'],'','Title',true);
$validate->addRule($_POST['description'],'','Description',true);
$validate->addRule($_POST['pageurl'],'','PageURL',true);

if($validate->validate() && count($stat)==0)
{
$iPageURL =	PageUrl($_POST['pageurl']);

$aryChkName=$db->getRow("select pageurl from  cms where pageurl='$iPageURL'");
				if(is_array($aryChkName) && count($aryChkName)>0){   		   
				$stat['error'] = "This PageURL is Already Exist";
				}
				else{



if(isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"]))
{	 
$filename = basename($_FILES['image']['name']);
$ext1 = strtolower(substr($filename, strrpos($filename, '.')+1));
if(in_array($ext1,array('jpg','png', 'gif')))
{ 	  
$newfile=md5(time())."_".$filename;
move_uploaded_file($_FILES['image']['tmp_name'],"../uploads/".$newfile);
}				
} 
$aryData=array(	
			   'title'     	 	         			    =>	$_POST['title'],
			   'language_id'     	 	         			    =>	$_POST['languages'],
			   'description'     	 	         			=>	$_POST['description'],
			   'image'     	 	         			    =>	$newfile,
			   'meta_title'     	 	         			=>	$_POST['meta_title'],
			   'meta_description'     	 	         	    =>	$_POST['meta_description'],
			   'pageurl'     	 	     	 				=>	$iPageURL,																																							
			   'meta_keyword'     	 	         		    =>	$_POST['meta_keyword'],
	           'status'     	 	         		        =>	$_POST['status'],												
				 );  
																																												$flgIn1 = $db->insertAry("cms",$aryData);
				//echo $db->getLastQuery();   
				//exit;																											
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
$validate->addRule($_POST['languages'],'','Language',true); 
$validate->addRule($_POST['title'],'','Title',true);
$validate->addRule($_POST['description'],'','Description',true);

if($validate->validate() && count($stat)==0)
{
	$iPageURL =	PageUrl($_POST['pageurl']);
	
	$aryChkName=$db->getRow("select pageurl from  cms where pageurl='$iPageURL' and id!='".$_GET['id']."'");
				if(is_array($aryChkName) && count($aryChkName)>0){   		   
				$stat['error'] = "This PageURL is Already Exist";
				}
				else{

	
	
if(isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"]))
{	 
$filename = basename($_FILES['image']['name']);
$ext1 = strtolower(substr($filename, strrpos($filename, '.')+1));
if(in_array($ext1,array('jpg','png', 'gif')))
{ 	  
$newfile=md5(time())."_".$filename;
move_uploaded_file($_FILES['image']['tmp_name'],"../uploads/".$newfile);
}				
}         
else { $newfile =$_POST['image_old']; }
			$aryData=array(	
							'title'     	 	         			    =>	$_POST['title'],
							'language_id'     	 	         			    =>	$_POST['languages'],
							'description'     	 	         		    =>	$_POST['description'],
							'image'     	 	         			    =>	$newfile,
							'meta_title'     	 	         		    =>	$_POST['meta_title'],
							'meta_description'     	 	         	    =>	$_POST['meta_description'],
							'meta_keyword'     	 	         		    =>	$_POST['meta_keyword'],
							'pageurl'     	 	     					=>	$iPageURL,
							'status'     	 	         		        =>	$_POST['status'],
							);  
																																							
				$flgIn = $db->updateAry("cms", $aryData , "where id='".$_GET['id']."'");
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
					 $flgIn1 = $db->delete("cms","where id='".$_GET['id']."'");			
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
              <li> <a href="<?php echo $iClassName; ?>">Home</a> </li>
              <li class="active"> <?php echo $PageTitle; ?> </li>
            </ol>
          </div>
        </div>
        <!-- Basic Form Wizard -->
        <div class="row">
          <div class="col-md-12">
            <div class="card-box aplhanewclass">
              <div class="row">
                <div class="col-md-9"> <?php echo msg($stat); ?> </div>
                <div class="col-md-3"> <a href="<?php echo $iClassName.$FileName; ?>?action=add"  class="btn btn-default" style="float:right">Add New Record</a> </div>
              </div>
            </div>
            <?php if($_GET['action']=='add') { ?>
            <div class="card-box">
              <form role="form" action="" method="post" enctype="multipart/form-data">
                <div>
                  <section>
                    <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">languages </label>
                      <div class="col-lg-10">
                        <select  class="form-control required" name="languages" id="userName">
                          <option value="">Select Language</option>
                          <?php
			$aryList=$db->getRows("select * from languages where  status='1'  order by id desc");
								foreach($aryList as $iList)
									{  ?>
                          <option value="<?php echo $iList['id']; ?>" <?php  if($_POST['languages']==$iList['id']) { echo "selected"; }  ?>><?php echo $iList['language']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">Title </label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" id="userName" name="title" value="<?php echo $_POST['title']; ?>">
                      </div>
                    </div>
                    <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">Description </label>
                      <div class="col-lg-10">
                        <textarea type="text" class="form-control required ckeditor" id="userName" name="description"><?php echo $_POST['description']; ?></textarea>
                      </div>
                    </div>
					
					<div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">Image </label>
                      <div class="col-lg-10">
                        <input type="file" class="form-control required" id="userName" name="image" value="<?php echo $_POST['image']; ?>">
                      </div>
                    </div>
					
                    <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">Meta Title </label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" name="meta_title" value="<?php echo $_POST['meta_title']; ?>">
                      </div>
                    </div>
                    <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">Meta Keyword </label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" name="meta_keyword" value="<?php echo $_POST['meta_keyword']; ?>">
                      </div>
                    </div>
                    <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">Meta Description </label>
                      <div class="col-lg-10">
                        <textarea type="text" class="form-control required" id="userName" name="meta_description"><?php echo $_POST['meta_description']; ?></textarea>
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
                    <a  href="<?php echo $iClassName.$FileName; ?>"  class="btn btn-default" >Back</a> </section>
                </div>
              </form>
            </div>
            <?php } elseif($_GET['action']=='edit') { 
			$aryDetail=$db->getRow("select * from  cms where id='".$_GET['id']."'");
					?>
            <div class="card-box">
              <form role="form" action="" method="post" enctype="multipart/form-data">
                <div>
                  <section>
                    <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">languages </label>
                      <div class="col-lg-10">
                        <select  class="form-control required" name="languages" id="userName">
                          <?php
		$aryList=$db->getRows("select * from languages where  status='1'  order by id desc");
							foreach($aryList as $iList)
									{
									?>
                          <option value="<?php echo $iList['id']; ?>" <?php  if($aryDetail['language_id']==$iList['id']) { echo "selected"; }  ?>><?php echo $iList['language']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">Title </label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" id="userName" name="title" value="<?php echo $aryDetail['title']; ?>">
                      </div>
                    </div>
                    <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">Description </label>
                      <div class="col-lg-10">
                        <textarea type="text" class="form-control required ckeditor" id="userName" name="description"><?php echo $aryDetail['description']; ?></textarea>
                      </div>
                    </div>
					
					<div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">Image</label>
                      <div class="col-lg-10">
                        <input type="file" class="form-control required"  id="image" name="image">
                        <input type="hidden" class="form-control required"  id="image_old" name="image_old"  value="<?php echo $aryDetail['image'] ?>" >
                        <img src="../uploads/<?php echo $aryDetail['image'] ?>" style="height:50px;"> </div>
                    </div>
					
                    <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">Meta Title </label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" id="userName" name="meta_title" value="<?php echo $aryDetail['meta_title']; ?>">
                      </div>
                    </div>			
                    <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">Meta Keyword </label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" id="userName" name="meta_keyword" value="<?php echo $aryDetail['meta_keyword']; ?>">
                      </div>
                    </div>
                    <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">Meta Description </label>
                      <div class="col-lg-10">
                        <textarea type="text" class="form-control required" id="userName" name="meta_description"><?php echo $aryDetail['meta_description']; ?></textarea>
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
                    <a  href="<?php echo $iClassName.$FileName; ?>"  class="btn btn-default" >Back</a> </section>
                </div>
              </form>
            </div>
            <?php  } 
	elseif($_GET['action']=='view') { 
	$GetEmailId=$db->getRow("select * from  cms where id='".$_GET['id']."'");
	?>
            <div class="card-box">
              <section>
                <div class="form-group clearfix">
                  <label class="col-lg-2 control-label " for="userName">Language </label>
                  <?php if($GetEmailId['language_id']=='1'){echo "English";}if($GetEmailId['language_id']=='2'){echo " Russian";} ?>
                </div>
                <div class="form-group clearfix">
                  <label class="col-lg-2 control-label " for="userName">Title </label>
                  <?php echo $GetEmailId['title']; ?> </div>
                <div class="form-group clearfix">
                  <label class="col-lg-2 control-label " for="userName">Description </label>
                  <?php echo $GetEmailId['description']; ?> </div>
                <div class="form-group clearfix">
                  <label class="col-lg-2 control-label " for="userName">Image </label>
                  <img src="../uploads/<?php echo $GetEmailId['image']; ?>" style="height:50px;"> </div>
                <div class="form-group clearfix">
                  <label class="col-lg-2 control-label " for="userName">Meta Title </label>
                  <?php echo $GetEmailId['meta_title']; ?> </div>
                <div class="form-group clearfix">
                  <label class="col-lg-2 control-label " for="userName">Meta Keyword Name </label>
                  <?php echo $GetEmailId['meta_keyword']; ?> </div>
                <div class="form-group clearfix">
                  <label class="col-lg-2 control-label " for="userName">Meta Description </label>
                  <?php echo $GetEmailId['meta_description']; ?> </div>
                <div class="form-group clearfix">
                  <label class="col-lg-2 control-label " for="userName">Page Url </label>
                  <?php echo $GetEmailId['pageurl']; ?> </div>
                <div class="form-group clearfix">
                  <label class="col-lg-2 control-label " for="userName">Status </label>
                  <?php if($GetEmailId['status']=='1'){echo "Active";}if($GetEmailId['status']=='0'){echo "Inactive";} ?>
                </div>
                <a  href="<?php echo $iClassName.$FileName; ?>"  class="btn btn-default" >Back</a> </section>
            </div>
          </div>
          <?php } else { ?>
          <div class="card-box">
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Title </th>
                  <th>Language</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
		$aryList=$db->getRows("select * from cms order by id desc");
	foreach($aryList as $iList)
			{	$i=$i+1;
		$aryPgAct["id"]=$iList['id'];
			 ?>
                <tr>
                  <td><?php echo $i ?></td>
                  <td><?php echo $iList['title']; ?></td>
                  <td><?php if($iList['language_id']=='1'){echo "English";}
if($iList['language_id']=='2'){echo "Russian";} ?>
                  </td>
                  <td><?php if($iList['status']=='1'){echo "Active";}
if($iList['status']=='0'){echo "Inactive";} ?>
                  </td>
                  <td><a href="<?php echo $iClassName.$FileName; ?>?action=view&id=<?php echo $iList['id']; ?>" class="table-action-btn"> <i class="fa fa-search"></i></a> <a href="<?php echo $iClassName.$FileName; ?>?action=edit&id=<?php echo $iList['id']; ?>"  class="table-action-btn" > <i class="fa fa-pencil"></i> </a> <a href="javascript:del('<?php echo $iClassName.$FileName; ?>?action=delete&id=<?php echo $iList['id']; ?>')"    class="table-action-btn" > <i class="fa fa-times"></i> </a> </td>
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
