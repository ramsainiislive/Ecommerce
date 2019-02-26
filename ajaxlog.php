<?php
include('config.php');

$validate=new Validation();
if($_SESSION['userid']!="")
  {
     redirect("checkout1.php");
  }
  
 
if($_POST['action']=='action_login')
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