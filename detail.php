<?php include('config.php');
$iSingleValue=$db->getRow("select * from customerdeatails where id='".$_SESSION['userid']."'"); 

?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<?php include('inc.meta.php');?>
    
</head>

<body>
 <?php include('inc.header.php');?>

    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">
                   

                </div>

                <div class="col-md-3">
                    <!-- *** MENUS AND FILTERS ***
 _________________________________________________________ -->
                    
                    <!-- *** MENUS AND FILTERS END *** -->

                  
                </div>
                  <?php 
								   
								   if(isset($_GET['id'])) {  
										$iList=$db->getRow("select * from product where id='".$_GET['id']."' ");
										 	  ?>    
                <div class="col-md-9">

                    <div class="row" id="productMain">
                        <div class="col-sm-6">
                            <div id="mainImage">
                               <img src="uploads/<?php echo $iList['uploadimage'];?>"class="img-responsive" >
                            </div>

                         

                        </div>
                        <div class="col-sm-6">
                            <div class="box">
                                <h1 class="text-center"><?php echo $iList['title']; ?></h1>
                                <p class="goToDescription"><a href="#details" class="scroll-to">Scroll to product details.</a>
                                </p>
                                <p class="price"><?php echo $iList['price']; ?>.00</p>

                                <p class="text-center buttons">
								
								<form action="basket.php?id=<?php echo $iList['id']; ?>" method="post">
								<input type="text" value="1" name="qty"> Enter the Quantity
								<input type="hidden" value="addtocart" name="action">
								<input type="hidden" value="<?php echo $iList['id']; ?>" name="pid"><br>
								<br>
								
								<input type="submit" class="btn btn-primary" value="Add TO Cart" >
								</form>
								<form action="customer-wishlist.php" method="post">
								<input type="hidden" value="addtowishlist" name="action">
								<input type="hidden" value="<?php echo $_SESSION['userid']; ?>" name="uid"><br>
								<input type="hidden" value="<?php echo $iList['id']; ?>" name="pid"><br>
                               <input type="submit" class="btn btn-primary" name="wishlist" value="Add to wishlist" />
                                </form>
								</p>


                            </div>

                            
                            </div>
                        </div>

                    </div>
								   <?php } ?>
									

                    <div class="box" id="details">
                        <p>
                            <h4><?php echo $iList['description']; ?></h4>
                            
                           
                            <blockquote>
                                <p><em>We will provide to you a warrantley for 1 year (( Software only )).</em>
                                </p>
                            </blockquote>

                            <hr>
                           
                    </div>

                    
                </div>
                <!-- /.col-md-9 -->
            </div>
            <!-- /.container -->
        </div>
        <?php include('inc.footer.php'); ?>	
    <?php include('inc.js.php'); ?>

</body>

</html>