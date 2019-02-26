<?php
 include('config.php');
ini_set('display_errors', '1');
if(isset($_GET['event']))
{
	
$event = $_GET['event'];
	
	  $aryData=array(	
						'product_name'     			=>	$event,
						'ip_address'				=>	$ua['ipaddress']
 						
 					 );
	   
	   
	    $flgIn1 = $db->insertAry("search",$aryData);
  /*  echo $flgIn1 = $db->getLastQuery();
    exit();
 */
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<?php include('inc.meta.php');?>
    
</head>

<body>
 <?php include('inc.header.php');
$ua=getBrowser(); ?>


    <div id="all">

        <div id="content">

            <div class="container">
                <div class="col-md-12">
                    <div id="main-slider">
					<?php
					 $i=0;
					       $iSearchList="";
				         if($_GET['event']!='') 
	 						{		$iTitle = trim($_GET['event']);
 									$iSearchList .= " AND title LIKE '%$iTitle%'";	
							} 	
							
										$GetEmailId=$db->getRows("select * from product where id!='' $iSearchList order by id desc limit 0,4");
										 foreach($GetEmailId as $iList)
									{	
							 ?>    
                        <div class="item">
						<img src="uploads/<?php echo $iList['uploadimage'];?>" alt="" style="height:800px; width:1200px;" class="img-responsive">
                         <h3 class="text-center"><?php echo $iList['title']; ?></h3>    
							 </div>
									<?php }?>
									
                    </div>
                    <!-- /#main-slider -->
                </div>
            </div>

            <!-- *** ADVANTAGES HOMEPAGE ***
 _________________________________________________________ -->
            <div id="advantages">

                <div class="container">
                    <div class="same-height-row">
                        <div class="col-sm-4">
                            <div class="box same-height clickable">
                                <div class="icon"><i class="fa fa-heart"></i>
                                </div>

                                <h3><a href="#">We love our customers</a></h3>
                                <p>We are known to provide best possible service ever</p>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="box same-height clickable">
                                <div class="icon"><i class="fa fa-tags"></i>
                                </div>

                                <h3><a href="#">Best prices</a></h3>
                                <p>You can check that the height of the boxes adjust when longer text like this one is used in one of them.</p>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="box same-height clickable">
                                <div class="icon"><i class="fa fa-thumbs-up"></i>
                                </div>

                                <h3><a href="#">100% satisfaction guaranteed</a></h3>
                                <p>Free returns on everything.</p>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.container -->

            </div>
            <!-- /#advantages -->

            <!-- *** ADVANTAGES END *** -->

            <!-- *** HOT PRODUCT SLIDESHOW ***
 _________________________________________________________ -->
            <div id="hot">

                <div class="box">
                    <div class="container">
                        <div class="col-md-12">
                            <h2>New Arrival </h2>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="product-slider">
					<?php
			 // for makging event dynamic and search event
			  $i=0;
								    $iSearchList="";
							if($_GET['event']!='') 
	 						{		$iTitle = trim($_GET['event']);
 									$iSearchList .= " AND event LIKE '%$iTitle%'";	
							} 			
					 
										$GetEmailId=$db->getRows("select * from product ");
										 foreach($GetEmailId as $iList)
									{	
							?>		
                        <div class="item">
                            <div class="product">
                                <div class="flip-container">

                                    <div class="flipper">
                                        <div class="front">
                                             <a href="detail.php?id=<?php echo $iList['id']; ?>">
                                                <img src="uploads/<?php echo $iList['uploadimage'];?>" alt="" width="450" height="600" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="detail.php?id=<?php echo $iList['id']; ?>">
                                                <img src="uploads/<?php echo $iList['uploadimage'];?>" alt="" width="450" height="600" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                 <a href="detail.php?id=<?php echo $iList['id']; ?>">
                                                <img src="uploads/<?php echo $iList['uploadimage'];?>" alt="" width="450" height="600" class="img-responsive">
                                            </a>
                                <div class="text">
                                    <h3><a href="detail.php?id=<?php echo $iList['id']; ?>"><?php echo $iList['title']; ?></a></h3>
							<a href="detail.php?id=<?php echo $iList['id']; ?>">		
                                    <p class="price"><?php echo $iList['price']; ?>.00</p>
									</a>
                                </div>
                                <!-- /.text -->
                            </div>
							  <div class="ribbon new">
                                    <div class="theribbon">NEW</div>
                                    <div class="ribbon-background"></div>
                                </div>
                            <!-- /.product -->
                        </div>

                        

                        
<?php  }?>
                    </div>
					
                    <!-- /.product-slider -->
                </div>
                <!-- /.container -->

            </div>
            <!-- /#hot -->

            <!-- *** HOT END *** -->

            <!-- *** GET INSPIRED ***
 _________________________________________________________ -->
            <div class="container" data-animate="fadeInUpBig">
                <div class="col-md-12">
                    <div class="box slideshow">
                        <h3>Get Inspired</h3>
                        <p class="lead">Get the inspiration from the new mobile phones </p>
                        <div id="get-inspired" class="owl-carousel owl-theme">
                            <div class="item">
                                <a href="#">
                                    <img src="img/getinspired1.jpg" alt="Get inspired" width="1108" height ="500" class="img-responsive">
                                </a>
                            </div>
                            <div class="item">
                                <a href="#">
                                    <img src="img/getinspired2.jpg" alt="Get inspired" width="1108" height ="500" class="img-responsive">
                                </a>
                            </div>
                            <div class="item">
                                <a href="#">
                                    <img src="img/getinspired3.jpg" alt="Get inspired" width="1108" height ="500" class="img-responsive">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- *** GET INSPIRED END *** -->

            <!-- *** BLOG HOMEPAGE ***
 _________________________________________________________ -->

            

            <!-- *** BLOG HOMEPAGE END *** -->


        </div>
		</div>
       
            <?php include('inc.footer.php'); ?>	
    <?php include('inc.js.php'); ?>

</body>

</html>