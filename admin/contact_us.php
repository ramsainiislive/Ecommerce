<?php include('../config.php');

include('inc.session.php');  

$PageTitle=" Contact Us";

$FileName ='contact_us.php';

$iClassName = ADMIN_URL;

$validate=new Validation();

if($_SESSION['success']!="")

{

   $stat['success']=$_SESSION['success'];

   unset($_SESSION['success']);

}


	elseif(($_REQUEST['action']=='delete'))

	{

			 	 $flgIn1 = $db->delete("contacts","where id='".$_GET['id']."'");			

			     $_SESSION['success'] = 'Deleted Successfully';

                 redirect($iClassName.$FileName);	

	} 





?>


<!DOCTYPE html>

<html>

	<head>

		 <?php include('inc.meta.php'); ?>

	</head>

	<body class="fixed-left">

		<div id="wrapper">

             <?php include('inc.header.php'); ?> 

			 <?php include('inc.sideleft.php'); ?>

			 

			<div class="content-page">

				<!-- Start content -->

				<div class="content">

					<div class="container">



						<!-- Page-Title -->

						<div class="row">

							<div class="col-sm-12">

								<h4 class="page-title"><?php echo $PageTitle; ?></h4>
								
								<ol class="breadcrumb">

									<li>
									
										<a href="<?php echo $iClassName; ?>">Home</a>

									</li>

									 

									<li class="active">

										<?php echo $PageTitle; ?>

									</li>

								</ol>

							</div>

						</div>

                        

                        <!-- Basic Form Wizard -->

                        <div class="row">

                            <div class="col-md-12">

                            	  <div class="card-box">

                                        <div class="row">

                                                <div class="col-sm-8">

                                                <?php echo msg($stat); ?>

                                                </div>	

                                                <div class="col-sm-4">

                          
							
                                       </div>         

                                        </div>

                                        </div>

                                    </div>

                            </div>

							

							

                            

					   

					    

			   <?php if($_GET['action']=='view') { 

			    $GetEmailId=$db->getRow("select * from contacts where id='".$_GET['id']."'");



		?>

		        <div class="card-box"> 

                              <div>

                                             <section>            

									<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Full Name :</label>
									
									<?php echo $GetEmailId['name']; ?>
									
									
									</div>
                                      
                                       
                                    <div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Email ID :</label>
									
									<?php echo $GetEmailId['email']; ?>
									
									
									</div>
									
									 
									
									<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Message :</label>
									
									<?php echo $GetEmailId['message']; ?>
									
									</div> 
									
									
									
									<div class="form-group clearfix">
									
									<label class="col-lg-2 control-label " for="price">Create At :</label>
									
									
									
									<?php echo $GetEmailId['create_at']; ?>
									
									
									
									</div>
										

                                   <a  href="<?php echo  $iClassName.$FileName;  ?>"  class="btn btn-default" >Back</a>

                                    

                                </div>

                                </section>    

                                        </div>

                        			</div>
                        

                      <?php } else { ?>

                      

                       <div class="card-box">

                                <table id="datatable" class="table table-striped table-bordered">

                                     <thead>

                                        <tr>

                                            <th>#</th>
                                            <th>Full Name</th>
											 <th>Email ID</th>
  									        <th>Action</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                       <?php

					 $aryList=$db->getRows("select *from  contacts order by id desc");

							 foreach($aryList as $iList)

									{	$i=$i+1;

									$aryPgAct["id"]=$iList['id'];

							 ?>       

									<tr class="<?php if($i%2=='0'){ echo "success"; } else { echo "warning"; } ?>">
									
									<td><?php echo $i ?></td>
									
									<td><?php echo $iList['name']; ?></td>
									
									<td><?php echo $iList['email']; ?></td>
									
                                   

										

					 

                      <td>

      <a href="<?php echo $iClassName.$FileName; ?>?action=view&id=<?php echo $iList['id']; ?>" class="table-action-btn"> <i class="fa fa-search"></i></a>

            <a href="javascript:del('<?php echo $iClassName.$FileName; ?>?action=delete&id=<?php echo $iList['id']; ?>')"    class="table-action-btn" > <i class="fa fa-times"></i> </a>
			
			
                     								 </td>

                  </tr>

				  <?php } ?>

                                    </tbody>

                                </table>

                            </div>

                             

                         </div>

                         

                        <?php  }  ?> 

                         

                    </div>

                 </div>

             </div>

         </div>

     </div>
    

<?php include('inc.footer.php'); ?>

<?php include('inc.js.php'); ?>



				

</body>

</html>