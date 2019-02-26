<?php

$_SESSION[LOGIN_ADMIN]['usertype'];

$currentfie = basename($_SERVER["SCRIPT_FILENAME"], '.php').".php"; 
$iLoginUserDetail=$db->getRow("select * from admin_deatails where id='".$_SESSION['user_id']."'");

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
                                 <li> <font color="white"> Welcome : <?php echo $iLoginUserDetail["fullname"]?></font> </li>
                              <!--  <li class="dropdown hidden-xs">
								 
                                </li>
                            
                                <li class="hidden-xs">

                                    <a href="#" id="btn-fullscreen" class="waves-effect waves-light">Fullscreen  <i class="fa fa-arrows-alt"></i></a>

                                </li> -->

                               

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