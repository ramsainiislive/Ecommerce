<?php
include('config.php');

$validate=new Validation();
if($_POST['action']=='action_cpass')
	{
		
   
 	   if($_POST['new_pass']==$_POST['r_pass']) 
	   {	
		 
  		   $aryData=array
						(	
								'password'     	 	         		=>	$_POST['new_pass'],
								
 						 );  
 			 $flgIn = $db->updateAry("customerdeatails", $aryData , "where id='".$_SESSION['userid']."'");		


			/* 
			echo  $flgIn = $db->getLastQuery();
			 exit(); */
 		     $stat['success']="password change Successfully";
			 echo '1';
 			 
    }
		else
			{
	        echo " Confirm password do not match";   
            }	
		
 }
   

		
	
 ?>