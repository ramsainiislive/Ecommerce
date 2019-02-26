<?php include('../config.php'); 

include('inc.session.php'); 

$PageTitle="Category";

$FileName = 'category.php';

$validate=new Validation();

/* if($_SESSION['success']!="")

{

   $stat['success']=$_SESSION['success'];

   unset($_SESSION['success']);

} */



if(isset($_POST['submit']))

 	{ 

	$validate->addRule($_POST['categoryname'],'','Category Name',true);
	
	/* $validate->addRule($_POST['language_id'],'','Language',true);
	
	$validate->addRule($_POST['pageurl'],'','PageURL',true);
	 */

		if($validate->validate() && count($stat)==0)
 			{
			
			$iPageURL =	PageUrl($_POST['pageurl']);
			
			$aryChkName=$db->getRow("select pageurl from  categorys where pageurl='$iPageURL'");
				if(is_array($aryChkName) && count($aryChkName)>0){   		   
				$stat['error'] = "This PageURL is Already Exist";
				}
				else{
				
				
 			  $aryData=array(	
 												'categoryname'     	 	     			=>	$_POST['categoryname'],
 												/* 'language_id'     	 	     			=>	$_POST['language_id'],
												'pageurl'     	 	     				=>	$iPageURL,
 												'status'     	 	         		    =>	$_POST['status'], */
 							 );  

					$flgIn1 = $db->insertAry("project",$aryData);
					 
 					$_SESSION['success']="Submited Successfully";
  					redirect($iClassName.$FileName);
 					unset($_POST);
  		}
		}
 		 else {
 			$stat['error'] = $validate->errors();
 			}
  	} 
?>	
	<html>
	<head>
	<title>
	cotegory</title>
	</head>
	<body>
	<form action="" >
	
	
	<input type="text" name="categoryname" value="<?php echo $_POST['categoryname']; ?>">

        <select name="status">
       <option value="1" <?php if($_POST['status']=='1') { echo "selected"; } ?>>Active</option>
		<option value="0" <?php if($_POST['status']=='0') { echo "selected"; } ?>>Inactive</option>
						   </select>
						   <input type="submit" name="submit"value="submit">
		</form>
			</body>
			</html>