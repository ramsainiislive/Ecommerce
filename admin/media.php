<?php include('../config.php'); 
include('inc.session.php'); 
$PageTitle="Media";
$FileName = 'media.php';
$validate=new Validation();
if($_SESSION['success']!="")
{
$stat['success']=$_SESSION['success'];
unset($_SESSION['success']);
}
if(isset($_POST['submit']))
{ 
//$validate->addRule($_POST['title'],'','Title',true);
//	$validate->addRule($_POST['description'],'','Description',true);
if($validate->validate() && count($stat)==0)
{
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
'image'     	 	         			    =>	$newfile,
);  
$flgIn1 = $db->insertAry("media",$aryData);
$_SESSION['success']="Submited Successfully";
redirect($iClassName.$FileName);
unset($_POST);
}
else {
$stat['error'] = $validate->errors();
}
} 
elseif(($_REQUEST['action']=='delete'))
{
$flgIn1 = $db->delete("media","where id='".$_GET['id']."'");			
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
<div class="form-group clearfix">
<label class="col-lg-2 control-label " for="userName">Image *</label>
<div class="col-lg-10">
<input type="file" class="form-control required" id="userName" name="image" value="<?php echo $_POST['image']; ?>" required>
</div>
</div>

<button type="submit" name="submit" class="btn btn-default">Submit</button>
<a  href="<?php echo $iClassName.$FileName; ?>"  class="btn btn-default" >Back</a>  
</section>
</div>
</form> 
</div>
<?php } else { ?> 
<div class="card-box">
<table id="datatable" class="table table-striped table-bordered">
<thead>
<tr>
<th>#</th>
<th>Image</th>
<th>URL Image </th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php $aryList=$db->getRows("select * from media order by id asc");
foreach($aryList as $iList)
{	$i=$i+1;
$aryPgAct["id"]=$iList['id'];
?> 
<tr>
<td><?php echo $i ?></td>
<td><img src="../uploads/<?php echo $iList['image']; ?>" style="height:50px;"></td>
<td><?php echo SITE_URL; ?>uploads/<?php echo $iList['image']; ?></td>
<td>
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