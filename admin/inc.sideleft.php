<?php  $iCurrentFileName = basename($_SERVER['PHP_SELF']);


?>

<div class="left side-menu">

                <div class="sidebar-inner slimscrollleft">

                	   <div class="user-details">

                        <div class="pull-left">

                           

                           

                           

                           <?php if($iLoginUserDetail['uploadimage']!='') { ?>

                                   <img src="uploads/<?php echo $iLoginUserDetail['uploadimage'] ?>" alt="user-img" class="thumb-md img-circle" >

                                     <?php } else { ?>

                                <img src="uploads/logo.jpg" alt="user-img" class="thumb-md img-circle" >     

                                      <?php }  ?>

                          

                        </div>

                        <div class="user-info">

                            <div class="dropdown">

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> 

                                <?php echo $iLoginUserDetail['fullname']; ?>

                                 <span class="caret"></span></a>

                                <ul class="dropdown-menu">

                                    <li><a href="profileview.php"><i class="md md-face-unlock"></i> Profile<div class="ripple-wrapper"></div></a></li>

                                    <li><a href="<?php echo ADMIN_URL; ?>login_profile.php"><i class="ti-user m-r-5"></i> Update Profile</a></li>

                                         <li><a href="<?php echo ADMIN_URL; ?>login_pass.php"><i class="ti-user m-r-5"></i>Change Password</a></li>

                                    <li><a href="logout.php"><i class="md md-settings-power"></i> Logout</a></li>

                                </ul>

                            </div>

                            <p class="text-muted m-0">Developer</p>

                        </div>

                    </div>

                     <div id="sidebar-menu">

                        <ul>

                         	<li class="text-muted menu-title">Navigation</li>

 	<li class=""><a href="<?php echo ADMIN_URL; ?>dashboard.php" class="waves-effect <?php if($iCurrentFileName=='dashboard.php') { echo "active"; } ?>"><i class="fa fa-bar-chart"></i> <span> Dashboard </span> </a> </li>
		
	
		<li class=""> <a href="<?php echo ADMIN_URL; ?>customer.php" class="waves-effect <?php if($iCurrentFileName=='customer.php') { echo "active"; } ?>"><i class="fa fa-user"></i> <span> Manage Customer </span> </a></li>
    
    	<li class=""> <a href="<?php echo ADMIN_URL; ?>product1.php" class="waves-effect <?php if($iCurrentFileName=='product1.php') { echo "active"; } ?>"><i class="fa fa-shopping-cart"></i> <span> Product </span> </a></li>
		
		<!-- <li class=""> <a href="<?php echo ADMIN_URL; ?>down_product.php" class="waves-effect <?php if($iCurrentFileName=='down_product.php') { echo "active"; } ?>"><i class="fa fa-file"></i> <span>Download Files </span> </a></li> -->
		
		
    <li class=""> <a href="<?php echo ADMIN_URL; ?>orderfeed.php" class="waves-effect <?php if($iCurrentFileName=='orderfeed.php') { echo "active"; } ?>"><i class="fa fa-sort"></i> <span> Order </span> </a></li>

   <!-- <li class=""> <a href="<?php echo ADMIN_URL; ?>news.php" class="waves-effect <?php if($iCurrentFileName=='news.php') { echo "active"; } ?>"><i class="fa fa-newspaper-o"></i> <span> News </span> </a></li> -->
  
    
		
<li class="has_sub">
	<a href="#" class="waves-effect <?php if($iCurrentFileName=='cat.php' || $iCurrentFileName=='sub.php' || $iCurrentFileName=='child.php'   ) { echo "active"; } ?>"><i class="fa fa-crosshairs"></i> <span>Manage Catalog</span> </a>
 	<ul class="list-unstyled">
 		 
         <li class=""> <a href="<?php echo ADMIN_URL; ?>cat.php" class="waves-effect <?php if($iCurrentFileName=='cat.php') { echo "active"; } ?>"><i class="fa fa-list-alt"></i> <span> Category </span> </a></li>
		<li class=""> <a href="<?php echo ADMIN_URL; ?>sub.php" class="waves-effect <?php if($iCurrentFileName=='sub.php') { echo "active"; } ?>"><i class="fa fa-circle"></i> <span> Subcategory </span> </a></li>
		<li class=""> <a href="<?php echo ADMIN_URL; ?>child.php" class="waves-effect <?php if($iCurrentFileName=='child.php') { echo "active"; } ?>"><i class="fa fa-circle"></i> <span> Childcategory </span> </a></li>

         </ul>
</li> 		
		
		
		
 		




<li class="has_sub">
	<a href="#" class="waves-effect <?php if($iCurrentFileName==' admin_deatails') { echo "active"; } ?>"><i class="fa fa-users"></i> <span>Manage Staff</span> </a>
 	<ul class="list-unstyled">
 		 
       <li class=""> <a href="<?php echo ADMIN_URL; ?>admin_deatails.php" class="waves-effect <?php if($iCurrentFileName==' admin_deatails.php') { echo "active"; } ?>"><i class="fa fa-user-secret"></i> <span> Registration </span> </a></li>
 		</ul>
</li>  




<li class="has_sub">
	<a href="#" class="waves-effect <?php if($iCurrentFileName=='index.php') { echo "active"; } ?>"><i class="fa fa-folder"></i> <span>Graphs</span> </a>
 		<ul class="list-unstyled">
<li class=""> <a href="<?php echo ADMIN_URLN;?>priority.php" class="waves-effect <?php if($iCurrentFileName=='adminn/priority.php') { echo "active"; } ?>"><i class="fa fa-medium"></i> <span>Data</span> </a></li>


        
        
        
         </ul>
</li>  


						 </ul>

					

						 

						  

						  

                        <div class="clearfix"></div>

                    </div>

                    <div class="clearfix"></div>

                </div>

            </div>