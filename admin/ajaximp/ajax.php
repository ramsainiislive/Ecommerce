<?php
include('config.php');
$validate=new Validation();
if($_POST['action']=='addtocart')
  	{
		addtocart($_POST['pid'],$_POST['qty']);
		sleep(1);
	}
	

if($_POST['action']=='get_Wishlist')
	{ 
		if($validate->validate() && count($stat)==0)
			{	
			
			
			$iAreadyRegister=$db->getRow("select id from whishlist where products_id='".$_POST['pid']."' and  userid='".$_SESSION['userid']."'");
			if($iAreadyRegister['id']=='') {
				
									
			 $aryData=array(	
								'products_id'     	 	         		    =>	$_POST['pid'],
								'userid'     	 	         			    =>	$_SESSION['userid'],
								    			   
									 );  									 
						$flgIn1 = $db->insertAry("whishlist",$aryData);	
				
			}
				
						sleep(1);
                    	echo "1";	
						exit;	
						
				
																
				}			
			else {
			$stat['error'] = $validate->errors();
			}
			echo msg_front($stat);
		}
		
if($_POST['action']=='get_statusting')  {
	
				$stat = $_POST['stat'];
			 		$aryList=$db->getRows("select * from products where status='1' order by id desc limit 0,$stat");			
		}
if($_POST['action']=='get_request')
{ 
 		$validate->addRule($_POST['firstname'],'','First name',true);
		$validate->addRule($_POST['lastname'],'','Last Name',true);
		$validate->addRule($_POST['emailid'],'','Email Id',true);
		$validate->addRule($_POST['contactno'],'','Contact No',true);
		$validate->addRule($_POST['comments'],'','Comments',true);
		
		if($validate->validate() && count($stat)==0)
			{
		
				 $aryData=array(	
								   
								   'firstname'     	 	         			   =>	$_POST['firstname'],
								   'lastname'     	 	         			    =>	$_POST['lastname'],
								   'emailid'     	 	         			    =>	$_POST['emailid'],
								   'contactno'     	 	         			    =>	$_POST['contactno'],
								   'comments'     	 	         			    =>	$_POST['comments'],
								   'pips-slider'     	 	         		    =>	$_POST['pips-slider'],
								   'cut'     	 	         			        =>	$_POST['cut'],
								   'color'     	 	         			        =>	$_POST['color'],
								   'clarity'     	 	         			    =>	$_POST['clarity'],
								  						   
									 );  
									 
						$flgIn1 = $db->insertAry("diamonds_request",$aryData);	
                      	 echo$flgIn1 = $db->getlastQuery();
				         $_SESSION['success']="Thank you for contact us. We will get back to you soon.";
						 redirect($iClassName.$FileName);
				}
			
			else {
			$stat['error'] = $validate->errors();
			}
			echo msg_front($stat);
		}
		
		if($_POST['action']=='drop_hint')
          { 
		$validate->addRule($_POST['email_id'],'','Email Id',true);
		$validate->addRule($_POST['friend_email'],'','Your Friend Email',true);
		$validate->addRule($_POST['messages'],'','Message',true);
		
		if($validate->validate() && count($stat)==0)
			{
		
				 $aryData=array(	
								   
								   'email_id'     	 	         			   =>	$_POST['email_id'],
								   'friend_email'     	 	         		   =>	$_POST['friend_email'],
								   'messages'     	 	         			    =>	$_POST['messages'],
								   'create_at'     	 	         		         =>	date("Y-m-d H:s:m"),	
								  						   
									 );  
									 
						$flgIn1 = $db->insertAry("drop_hint",$aryData);	
                      	 echo "1";						
			
				$_SESSION['success']="Submitted Successfully";
				}
			
				else {
			$stat['error'] = $validate->errors();
			}
			echo msg_front($stat);
		}
		
		if($_POST['action']=='get_req')
          { 
		$validate->addRule($_POST['firstname'],'alpha','First Name',true);
		$validate->addRule($_POST['lastname'],'alpha','Last Name',true);
		$validate->addRule($_POST['emailid'],'email','Email Id',true);	
		$validate->addRule($_POST['contactno'],'','Contactno',true);
		 $validate->addRule($_POST['region'],'','Region',true);			
		$validate->addRule($_POST['model_no'],'','Model No',true);	
        $validate->addRule($_POST['message'],'','Message',true);	
          
		
		if($validate->validate() && count($stat)==0)
			{
		
				 $aryData=array(	
								   
								   'firstname'     	 	         			      =>	$_POST['firstname'],
								   'lastname'     	 	         			      =>	$_POST['lastname'],
								   'emailid'     	 	         		          =>	$_POST['emailid'],						   
								   'contactno'     	 	         		          =>	$_POST['contactno'],
                                   'region'     	 	         		          =>	$_POST['region'],
                                   'model_no'     	 	         		          =>	$_POST['model_no'],								   
								   'message'     	 	         		          =>	$_POST['message'],
								  						   
									 );  
									 
						$flgIn1 = $db->insertAry("request_form",$aryData);	
                      echo "1";						
			
				$_SESSION['success']="Submitted Successfully";
				}
			
				else {
			$stat['error'] = $validate->errors();
			}
			echo msg_front($stat);
		}
		

if($_POST['action']=='custom_req')
          { 
	
		$validate->addRule($_POST['metal'],'','Metal',true);	
		$validate->addRule($_POST['time_frame'],'','Time Frame',true);	
		$validate->addRule($_POST['budget'],'','Budget',true);	
		$validate->addRule($_POST['stone_type'],'','Stone Type',true);	
		$validate->addRule($_POST['stone_shape'],'','Stone Shape',true);	
		$validate->addRule($_POST['certificate'],'','Certificate',true);	
		
		if($validate->validate() && count($stat)==0)
			{
		
				if(isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"]))
				{	 
 					$filename = basename($_FILES['image']['name']);
					$ext1 = strtolower(substr($filename, strrpos($filename, '.')+1));
					if(in_array($ext1,array('jpg','png', 'gif')))
					{ 	  
						$newfile=md5(time())."_".$filename;
 						move_uploaded_file($_FILES['image']['tmp_name'],"uploads/".$newfile);
 					 }				
				 }
				 
						 $aryData=array(	
								   
								   'messagenew'     	 	         			    =>	$_POST['messagenew'],								  
								   'image'     	 	                              =>	$newfile,								   
                                   'metal'     	 	         		              =>	$_POST['metal'],	
                                   'time_frame'     	 	         		      =>	$_POST['time_frame'],
                                   'budget'     	 	         		           =>	$_POST['budget'],
                                   'stone_status'     	 	         		      =>	$_POST['stone_status'],
                                   'stone_type'     	 	         		      =>	$_POST['stone_type'],	
                                   'stone_shape'     	 	         		      =>	$_POST['stone_shape'],	
                                   'weight_start'     	 	         		      =>	$_POST['weight_start'],
                                   'weight_end'     	 	         		      =>	$_POST['weight_end'],
                                   'colorrange_start'     	 	         		  =>	$_POST['colorrange_start'],
                                   'colorrange_end'     	 	         		   =>	$_POST['colorrange_end'],
								   'clarity_start'     	 	         		       =>	$_POST['clarity_start'],
								   'clarity_end'     	 	         		      =>	$_POST['clarity_end'],
								   'certificate'     	 	         		      =>	$_POST['certificate'],
								   
								   );
									 
						$flgIn1 = $db->insertAry("custom_form",$aryData);
						
						foreach($_POST['items'] as $key => $val)
 						{
			$aryData=array(	
					'customer_id'     	 	         			    =>	$flgIn1,
 					'items'     	 	         				=>	$_POST['items'][$key],
 					);  
					$flgIn111 = $db->insertAry("checked_items",$aryData);
					}
					 foreach($_POST['goals'] as $key => $val)
 						{
			$aryData=array(	
					'customer_id'     	 	         			    =>	$flgIn1,
 					'goals'     	 	         				=>	$_POST['goals'][$key],
 					);  
					$flgIn1111 = $db->insertAry("checked_goals",$aryData);
					
						}					
                	 echo "1";						
			
				$_SESSION['success']="Submitted Successfully";
				}
			
				else {
			$stat['error'] = $validate->errors();
			}
		
		}
if($_POST['action']=='get_subscribe')
{ 
		$validate->addRule($_POST['emailid'],'','Email Id',true);
		
		if($validate->validate() && count($stat)==0)
			{
		
				 $aryData=array(	
								   
								  
								   'emailid'     	 	         			    =>	$_POST['emailid'],
								    'userid'     	 	         			    =>	$_SESSION['userid'],
								   'create_at'     	 	         		          =>	date("Y-m-d H:s:m"),	
								   									 );  
									 
						$flgIn1 = $db->insertAry("subscribe",$aryData);	
                      	 echo$flgIn1 = $db->getlastQuery();
				         $_SESSION['success']="Thank you for subscribe. We will get back to you soon.";
						 redirect($iClassName.$FileName);
				}
			
			else {
			$stat['error'] = $validate->errors();
			}
			echo msg_front($stat);
		}
		

?>
	  
	 
