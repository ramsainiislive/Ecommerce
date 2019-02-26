<?php

$_SESSION[LOGIN_ADMIN]['usertype'];

$currentfie = basename($_SERVER["SCRIPT_FILENAME"], '.php').".php"; 
$iLoginUserDetail=$db->getRow("select * from admin_deatails where id='".$_SESSION['userid']."'");

if($currentfie!='dashboard.php') 

{

 $aryDetail123Per=$db->getVal("select id from file_permission where user_role='".$_SESSION[LOGIN_ADMIN]['usertype']."' and file_name='".$currentfie."'");



				 

 	if($aryDetail123Per=='') {

		// redirect('dashboard.php');

		  } 					

}

$menu=$db->getRows("select * from file_permission where user_role='".$_SESSION[LOGIN_ADMIN]['usertype']."'");	

		foreach($menu as $iList)

		{

		 $file[] = $iList['file_name'];

		 }

/* ***********************************   Url  search  ****************************************************/ 		 
error_reporting(0);
$request_url = apache_getenv("HTTP_HOST") . apache_getenv("REQUEST_URI");
 
function getBrowser()
{
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version= "";

        
        if (preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
        {
            $bname = 'Internet-Explorer';
			$ip_address = '199.16.156.124';
            $ub = "MSIE";
        }
        elseif (preg_match('/Firefox/i',$u_agent))
        {
            $bname = 'Mozilla-Firefox';
			$ip_address = '123.125.71.14';
            $ub = "Firefox";
        }
        elseif (preg_match('/Chrome/i',$u_agent))
        {
            $bname = 'Google-Chrome';
			$ip_address = '104.168.37.52';
            $ub = "Chrome";
        }
        elseif (preg_match('/Safari/i',$u_agent))
        {
            $bname = 'Apple-Safari';
			$ip_address = '220.181.108.93';
            $ub = "Safari";
        }
        elseif (preg_match('/Opera/i',$u_agent))
        {
            $bname = 'Opera';
			$ip_address = '216.69.191.97';
            $ub = "Opera";
        }
        elseif (preg_match('/Netscape/i',$u_agent))
        {
            $bname = 'Netscape';
			$ip_address = '122.175.192.118';
            $ub = "Netscape";
        }
		 else
        {
            $bname = 'Netscape';
			$ip_address = '216.70.191.00';
            $ub = "Netscape";
        }

        // Finally get the correct version number.
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
        ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }

        // See how many we have.
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                $version= $matches['version'][0];
            }
            else {
                $version= $matches['version'][1];
            }
        }
        else {
            $version= $matches['version'][0];
        }

        // Check if we have a number.
        if ($version==null || $version=="") {$version="?";}
 
        return array(
            'userAgent' => $u_agent,
			'ipaddress' => $ip_address,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'    => $pattern
        );
    }
$ua=getBrowser();
 
 
 if($_SESSION['userid']!='') {  

  $flgInReg = $db->update("update  customerdeatails set  no_of_click = no_of_click + 1  where id = '".$_SESSION['userid']."' ");
 
 }
 
 
 if($_GET['id']!='')
 {
	$id =$_GET['id']; 
	
	
 	   
     $flgIn1 = $db->update("update product set  no_of_click = no_of_click + 1 , percentage_click = percentage_click +0.07  where id = $id ");
	
	
	$cateogy_id =  $db->getVal("select category_id from product where id= $id");
	
	 $flgIn1 = $db->update("update category_click set  click = click + 1 where category_id = $cateogy_id ");
 
	
	
	
 }
 else
 {
	 $id='0';
 }
 	
	  $aryData=array(	
						'ip_address'     			=>	$ua['ipaddress'],
						'datetime'     			=>	date("Y-m-d h:i:s"),
						'page_name'     			=>	$request_url,
						'product_id'     			=>	$id,
						'status'     			=>	1,
 						
 					 );
	   
	   
	    $flgIn1 = $db->insertAry("user_move",$aryData);
?>

         <div id="wrapper">

             <div class="topbar">

                 <div class="topbar-left">

                    <div class="text-center">
					 <img src="uploads/logo6.jpg" alt="user-img" style="height:50px!important; width:150px;">

                    </div>

                </div>
						


                <div class="navbar navbar-default" role="navigation">

                    <div class="container">

                        <div class="">

                            <div class="pull-left">

                                <button class="button-menu-mobile open-left">

                                    <i class="fa fa-bars"></i>

                                </button>

                                <span class="clearfix"></span>
								

                            </div>



                            <form role="search" class="navbar-left app-search pull-left hidden-xs">

			                     <input type="text" placeholder="Search..." class="form-control">

			                     <a href=""><i class="fa fa-search"></i></a>

			                </form>





                            <ul class="nav navbar-nav navbar-right pull-right">
                                 <li> <font color="white"> Welcome : <?php echo $iLoginUserDetail["fullname"] ?></font> </li>
                             
                                <li class="dropdown">

                                    <a class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true">

                                    <img src="uploads/logo.jpg" alt="user-img" class="img-circle" style="height:50px!important; width:50px;">

                                      </a>

                                    <ul class="dropdown-menu">
									
									<!--	<li><a href="<?php echo ADMIN_URL; ?>settings_en.php"><i class="ti-settings m-r-5"></i>English Setting</a></li>
                                        <li><a href="<?php echo ADMIN_URL; ?>settings_ru.php"><i class="ti-settings m-r-5"></i>Russian Setting</a></li> -->

                                         <li><a href="<?php echo ADMIN_URL; ?>login_profile.php"><i class="ti-user m-r-5"></i> Update Profile</a></li>

                                         <li><a href="<?php echo ADMIN_URL; ?>login_pass.php"><i class="ti-user m-r-5"></i>Change Password</a></li>
                                         <li><a href="<?php echo ADMIN_URL; ?>logout.php"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
          </div>
  </div>