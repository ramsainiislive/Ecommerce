<?php include('../config.php');

$validate=new Validation();
if($_SESSION['user_id']!="")
  {
     redirect("dashboard.php");
  }
 
if(isset($_POST['submit']))
	{
	$validate->addRule($_POST['emailid'],'email','Email id',true);
	$validate->addRule($_POST['password'],'','Password',true);
	if($validate->validate() && count($stat)==0)
	{				
	$EmailId=$db->getRow("select * from  admin_deatails where emailid = '".$_POST['emailid']."' ");	
	if($EmailId['id']!='')
		{		
          $aryList=$db->getRow("select * from  admin_deatails where emailid = '".$_POST['emailid']."' and password = '".$_POST['password']."'");
							
							if($aryList['id']=='')
								{ 
 									 $stat['error'] = 'Please enter correct password.';	
								}
							
						else   {
							    $_SESSION['user_id']=$aryList['id'];
								echo '1';
								
                                redirect("dashboard.php"); 
 									
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

<!DOCTYPE html>
<html>
    <head>
       <?php include('inc.meta.php'); ?>

    </head>
    <body>

        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
        	<div class=" card-box">
            <div class="panel-heading"> 
                <h3 class="text-center"> Sign In to <strong class="text-custom">UNIKA </strong>CLASSIFIED </h3>
                <?php echo msg($stat); ?>
            </div> 
            <div class="panel-body">
            <form class="form-horizontal m-t-20" action="" method="post">
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" required placeholder="emailid" name="emailid" value="<?php echo $_POST['emailid'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" required placeholder="password" name="password" value="<?php echo $_POST['password'];?>">
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        
						
                    </div>
                </div>
				
                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit" name="submit">Log In</button>
                    </div>
                </div>
               
                <div class="form-group m-t-30 m-b-0">
                    <div class="col-sm-12">
                                         </div>
                </div>
            </form> 
            </div>   
            </div>                              
                <div class="row">
            	<div class="col-sm-12 text-center">
            		<p>Design And Developed By <a href="https://en-gb.facebook.com/login/" target="_blank" class="text-primary m-l-5"><b>Ramkumar Saini</b></a></p>
                    </div>
            </div>
        </div>
	</body>
</html>