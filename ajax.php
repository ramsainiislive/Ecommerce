<?php
include('config.php');

$validate=new Validation();

   if($_POST['action']=='action_submit')
	{	
		$validate->addRule($_POST['name'],'alpha','Fullname',true);
		$validate->addRule($_POST['emailid'],'email','Email id',true);
		$validate->addRule($_POST['password'],'','Password',true,6,15);
	
	if($validate->validate() && count($stat)==0){
		 $aryChkName=$db->getRow("select id from  customerdeatails where emailid='".$_POST['emailid']."'");
 				        if($aryChkName['id']!=''){   		   
						           $stat['error'] = "This email id is already registered.";
				              }
				             else{
							       $aryData=array(	        
														'firstname'          	 =>	$_POST['name'],
														'emailid'    			 =>	$_POST['emailid'],
														'password'   			 => $_POST['password'],
											     );  
							$flgIn = $db->insertAry("customerdeatails",$aryData);
							/* echo $flgIn = $db->getLastQuery();
							exit(); */
							echo "1";
							$_SESSION["success"]='Register successfully.';
				                }
				         }
		          else
		          {
			       $stat["error"]=$validate->errors();
		           }

	 echo msg($stat);
	   }
?>

<?php

$validate=new Validation();
if($_SESSION['userid']!="")
  {
     redirect("index.php");
  }
  

if($_POST['action']=='action_log')
	{
	$validate->addRule($_POST['emailid'],'email','Email id',true);
	$validate->addRule($_POST['password'],'','Password',true);
	if($validate->validate() && count($stat)==0)
	{				
	$EmailId=$db->getRow("select * from  customerdeatails where emailid = '".$_POST['emailid']."' ");	
	if($EmailId['id']!='')
		{		
          $aryList=$db->getRow("select * from  customerdeatails where emailid = '".$_POST['emailid']."' and password = '".$_POST['password']."'");
							
							if($aryList['id']=='')
								{ 
 									 $stat['error'] = 'Please enter correct password.';	
								}
							
						else   {
							    $_SESSION['userid']=$aryList['id'];
								echo '1';
								
                               /*  redirect("customer-orders.php"); */
 									
								}
		}
		else
			{
			 $stat['error'] = 'Email and password combination incorect';	
			}
		}
		else {
			$stat['error'] = $validate->errors();
		}	
			
	echo msg($stat);
	
	}	   

?>


 


<?php

/* $validate=new Validation();
if($_POST['action']=='action_pmethod')
	{	
	$validate->addRule($_POST['delivery'],'alpha','deliver',true);
	
	
	
	if($validate->validate() && count($stat)==0)
				{	
				$aryData=array(	   				
									'dmethod'     	=>	$_POST['delivery'],
									
							  );  
							$flgIn = $db->updateAry("customerdeatails",$aryData,"where dmethod='".$_GET['id']."'");
							echo $flgIn = $db->getLastQuery();
							exit(); 
							echo "1";
							 $_SESSION['success']="update Successfully";
				         }
		          else
		          {
			       $stat["error"]=$validate->errors();
		           }

	 echo msg($stat);
	   } */
?>



 