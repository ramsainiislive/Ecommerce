<?php  
if($_SESSION['user_id']=='')
	{
		redirect("index.php");	
 	}
 $iLoginUserDetail=$db->getRow("select * from admin_deatails where id='".$_SESSION['user_id']."'");
 
?>