 <?php
include('config.php');
$validate=new Validation();
   if($_POST['action']=='action_customer')
	   
	{	
	
	
	
		$validate->addRule($_POST['firstname'],'alpha','Firstname',true);
		$validate->addRule($_POST['lastname'],'alpha','lastname',true);
		$validate->addRule($_POST['company'],'alpha','company',true);
		$validate->addRule($_POST['address'],'alpha','address',true);
		$validate->addRule($_POST['city'],'','city',true);
		$validate->addRule($_POST['zip'],'','zip',true);
		$validate->addRule($_POST['phone'],'','phone',true);
		$validate->addRule($_POST['email'],'email','Email id',true);
		
	
	if($validate->validate() && count($stat)==0){
		 
							       $aryData=array(	 
								  
														'firstname'          	 =>	$_POST['firstname'],
														'lastname'    			 =>	$_POST['lastname'],
														'company'   			 => $_POST['company'],
														'address'          	 =>	$_POST['address'],
														'city'    			 =>	$_POST['city'],
														'zipcode'   			 => $_POST['zip'],
														'contactno'          	 =>	$_POST['phone'],
														'emailid'    			 =>	$_POST['email'],
														'date'   			 => $_POST['date'],
											     );  
							$flgIn = $db->updateAry("customerdeatails",$aryData,"where id='".$_SESSION['userid']."'");
							
							/* echo $flgIn = $db->getLastQuery();
							exit();  */
							echo "1";
							$_SESSION["success"]='Register successfully.';
				            
				         
                    $GetEmailId=$db->getRows("select * from cartdetail where cartid='".$_SESSION['cartid']."' ");
							 foreach($GetEmailId as $iList)
									{
										
				$iProductDetail=$db->getRow("select * from product where id='".$iList['pid']."' ");						
							
                     $iTOtalPrice = $iProductDetail['price']*$iList['qty'];
									   
									$iFinalPrice +=	$iTOtalPrice; 
					 
						 $aryData=array(	 
								  
														'userid'          	 =>	$_SESSION['userid'] ,
														'Productid'    			 =>	$iList['pid'],
														'quantity'   			 => $iList['qty'],
														'price'          	 =>	$iProductDetail['price'],
														'total'    			 =>	$iTOtalPrice,
														'orderid'   			 => $iList['id'] ,
														
											     );  
							$flgIn = $db->insertAry("orderfeed",$aryData,"where id='".$_SESSION['userid']."'");
							
							 //  echo $flgIn = $db->getLastQuery();
							 
					
							$_SESSION["success"]='Register successfully.';
						 
								
									}
                        // exit(); 
	}						 
		          else
		          {
			       $stat["error"]=$validate->errors();
		           }

	 echo msg($stat);
	   }
?>