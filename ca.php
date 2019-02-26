<?php
include('config.php');

$validate=new Validation();
if($_POST['action']=='action_cdeatail')
	{
		/* $validate->addRule($_POST['firstname'],'','firstname',true);
	$validate->addRule($_POST['lastname'],'','lastname',true);
	$validate->addRule($_POST['company'],'','company',true);
	$validate->addRule($_POST['address'],'','address',true);
	$validate->addRule($_POST['city'],'','city',true);
	$validate->addRule($_POST['zipcode'],'','zipcode',true);
	$validate->addRule($_POST['contactno'],'','contactno',true);
	$validate->addRule($_POST['emailid'],'','emailid',true);
	if($validate->validate() && count($stat)==0)
	{				 */
  		   $aryData=array
						(	
				'firstname'     => $_POST['firstname'],
				'lastname'      => $_POST['lastname'],
				'company'       =>  $_POST['company'],
				'address'        =>  $_POST['address'],
				'city'          => $_POST['city'],
				'zipcode'       =>  $_POST['zipcode'],
				'contactno'     =>$_POST['contactno'],
				'emailid'       => $_POST['emailid'],
						
								
								
 						 );  
 			 $flgIn = $db->updateAry("customerdeatails", $aryData , "where id='".$_SESSION['userid']."'");		


			/* 
			echo  $flgIn = $db->getLastQuery();
			 exit(); */
 		     /* $stat['success']="Data change Successfully";
			 echo '1';
 			 
    } */
		
		
 }
   

		
	
 ?>