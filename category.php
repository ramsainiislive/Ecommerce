<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<?php include('inc.meta.php');?>
    
</head>

<body>
 <?php include('inc.header.php'); ?>

    <div id="all">

        <div id="content">
            <div class="container">
			<?php 
								         if(isset($_GET['id'])) {  
								   
										$GetEmailId=$db->getRows("select * from product where id='".$_GET['id']."'");
										 foreach($GetEmailId as $iList)
									{	
							 ?>    

                <div class="col-md-12">

                    <ul class="breadcrumb">
                        <li><a href="index.php">Home</a>
                        </li>
                        <li>Apple Mobile Phones</li>
                    </ul>

                  

                    <div class="box info-bar">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 products-showing">
                                Showing <strong>12</strong> of <strong>25</strong> products
                            </div>

                            <div class="col-sm-12 col-md-8  products-number-sort">
                                <div class="row">
                                    <form class="form-inline">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="products-number">
                                                <strong>Show</strong>  <a href="#" class="btn btn-default btn-sm btn-primary">12</a>  <a href="#" class="btn btn-default btn-sm">24</a>  <a href="#" class="btn btn-default btn-sm">All</a> products
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                       
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row products">
	                               
                        <div class="col-md-3 col-sm-4">
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
								<a href="detail.php?id=<?php echo $iList['id']; ?>" class="invisible">
                                    <img src="uploads/<?php echo $iList['uploadimage'];?>" alt="" width="450" height="600" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3><a href="detail.php?id=<?php echo $iList['id']; ?>"><?php echo $iList['title']; ?></a></h3>
                                    <p class="price"><?php echo $iList['price']; ?>.00</p>
                                    <p class="buttons">
                                        <a href="detail.php?id=<?php echo $iList['id']; ?>" class="btn btn-default">View detail</a>
                                        <a href="basket.php?id=<?php echo $iList['id']; ?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </p>
                                </div>
                                <!-- /.text -->
                            </div>
                            <!-- /.product -->
                        </div>
						
									

                         
                                
                                <!-- /.text -->
                            </div>
                            <!-- /.product -->
                        </div>
						<?php } }?>

                    </div>
                    <!-- /.products -->

                    <div class="pages">

                        <p class="loadMore">
                            <a href="#" class="btn btn-primary btn-lg"><i class="fa fa-chevron-down"></i> Load more</a>
                        </p>

                        <ul class="pagination">
                            <li><a href="#">&laquo;</a>
                            </li>
                            <li class="active"><a href="#">1</a>
                            </li>
                            <li><a href="#">2</a>
                            </li>
                            <li><a href="#">3</a>
                            </li>
                            <li><a href="#">4</a>
                            </li>
                            <li><a href="#">5</a>
                            </li>
                            <li><a href="#">&raquo;</a>
                            </li>
                        </ul>
                    </div>


                </div>
                <!-- /.col-md-9 -->

            </div>
           
        


            <?php include('inc.footer.php'); ?>	
    <?php include('inc.js.php'); ?>


</body>

</html>