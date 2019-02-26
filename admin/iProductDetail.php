<?php include('../config.php');
include('inc.session.php'); 
$PageTitle="Product Detail";
$FileName = 'iProductDetail.php'; 
$validate=new Validation();
if($_SESSION['success']!="")
{
$stat['success']=$_SESSION['success'];
unset($_SESSION['success']);
}
if(isset($_POST['submit']))
{ 
 		$validate->addRule($_POST['emailid'],'email','Your Email Id',true);
		$validate->addRule($_POST['email'],'email','Your Friend Email Id',true);	
		$validate->addRule($_POST['message'],'','Message',true);	
		
		if($validate->validate() && count($stat)==0)
			{
						 $aryData=array(	
								   
								   'emailid'     	 	         			      =>	$_POST['emailid'],								  
								   'email'     	 	         		              =>	$_POST['email'],								   			   
								   'message'     	 	         		          =>	$_POST['message'],							  
								   'create_at'     	 	         		          =>	date("Y-m-d H:s:m"),			   
 										 );  
						$flgIn1 = $db->insertAry("drop_hint",$aryData);
                        
									
			 			$_SESSION['success']="submit sucessfully";
						 redirect($iClassName.$FileName);
			}
       else {
			$stat['error'] = $validate->errors();
			}		  
}

?>
<?php  
 $GetEmailId=$db->getRow("select * from  products where id='".$_GET['id']."'");
$iMcategory=$db->getRow("select mcategory, id, pageurl from category_master where  pageurl='".$_GET['masid']."'");
$iPcategory=$db->getRow("select  pcategory,	id, pageurl from category_parent where  pageurl='".$_GET['parid']."'");
 ?>
<html>
<head>
<?php include('inc.meta.php'); ?>
 <style>
.btn.btn-default:hover{color:black!important;
    background-color: transparent;
    border-color: #adadad;}
	
	
	
	
</style>
<style>
.produt-menu {cursor:pointer; }
</style>

</head>
    <?php include('inc.header.php'); ?>
  

<section class="welcome-bg">
<div class="container">
  <div>
    <h5 class="mira-sec-1">
            <a href="<?php echo SITE_URL; ?>index.php">Home</a>&nbsp;&nbsp;/&nbsp;&nbsp;
            <a  href="<?php echo SITE_URL; ?>diamonds-engagement.html">
			<?php echo $db->getVal("select mcategory from category_master where id='".$GetEmailId['mcategory']."' order by id desc");?></a>&nbsp;&nbsp;/&nbsp;
            <a href="<?php echo SITE_URL; ?>category/<?php echo $iMcategory['pageurl']; ?>/<?php echo $iList['pageurl']; ?>/"><?php echo $db->getVal("select pcategory from category_parent where id='".$GetEmailId['pcategory']."'  order by id desc");?></a>&nbsp;&nbsp;/&nbsp;&nbsp;
            <a ><?php echo $GetEmailId['item_code']; ?></a> 
	 </h5>
  </div>
  <div class="row">
    <div class="col-md-8">
      <div class="wrapper row">
	 <div class="preview col-md-6">
          <div class="preview-pic tab-content">
          <?php	$i=0;
            $aryList=$db->getRows("select * from product_image where product_id='".$GetEmailId['id']."' order by id desc");
                 foreach($aryList as $iList)
                { 	$i=$i+1;?>
            <div class="tab-pane <?php if($i=='1') { echo 'active'; } ?>" id="pic-<?php echo $i; ?>"><img src="<?php echo SITE_URL; ?>uploads/<?php echo $iList['product_image'];?>" /></div>
          		<?php } ?>
          </div>
          <ul class="preview-thumbnail nav nav-tabs">
		  <?php	$i=0;
            $aryList=$db->getRows("select * from product_image where product_id='".$GetEmailId['id']."' order by id desc");
			
                foreach($aryList as $iList)
                { 	$i=$i+1;?>
		  <li class="<?php if($i=='1') { echo 'active'; } ?>"><a data-target="#pic-<?php echo $i; ?>" data-toggle="tab"><img src="<?php echo SITE_URL; ?>uploads/<?php echo $iList['product_image'];?>" /></a></li>
		   
				<?php } ?>
              </ul>
        </div>
        <div class="details col-md-6">
          <h3 class="pro-tittle"><?php echo $GetEmailId['title']; ?></h3>
		   <p class="pro-tittle pro-cls">ITEM#&nbsp;<?php echo $GetEmailId['item_code']; ?>
		     <?php if($GetEmailId['type_id']=='1') { ?>
		   &nbsp;&nbsp;PRICE:&nbsp;$<?php echo $GetEmailId['price']; ?>
		     <?php } ?></P>
		   
          <p class="pro-items"><?php echo $GetEmailId['description']; ?></p>
         
          <div class="items-box">
         <a href="#"onClick="showsearch5();"><i class="fa fa-info" aria-hidden="true"></i> Request more information</a>
            <div class="section-items">
              <p><span>or</span> </p>
            </div>
        <a href="#"onClick="showsearch5();"><i class="fa fa-file-text-o"  aria-hidden="true"></i>Custom Design Quote</a> 
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="box1-item1">
        <h4>Diamond Info</h4>
        <p>The carat weight in the product title is for the center diamond alone. 
          The amount of diamonds in the ring setting itself is mentioned below the description</p>
      </div>
      <div class="box2-item2">
        <ul class="mira-items-ul produt-menu">
        
         <li>
         <?php if($GetEmailId['type_id']=='1') { ?>
         <form action="<?php echo SITE_URL; ?>cart.php" method="post">
         	<input type="hidden" name="action" value="addtocart">
 			<input type="hidden" name="pid" value="<?php echo $_GET['id']; ?>">
            <input type="hidden" name="qty" value="1">			
			<button type="submit"  class="btn btn-info btn-sm">Add to Cart</button>
          </form>
          <?php } else { ?>
          
         <a href="#"onClick="showsearch5();">Custom Design Quote</a> 
            <?php } ?>
            </li>
          <li>
          <?php if($_SESSION['user_id']!='') { ?>
          <a onClick="Wishlist('<?php echo $GetEmailId['id']; ?>')" >Add to Wishlist</a>
          <?php } else { ?>
           <a  href="<?php echo SITE_URL; ?>register.php">Add to Wishlist</a>
          <?php } ?>
          </li>
         <a href="#"onClick="showsearch4();"> Drop a Hint</a></li>
          <li><a href="<?php echo SITE_URL; ?>contact-us/">Contact Us</a></li>
          <li><a href="<?php echo SITE_URL; ?>faq.php">Ask A Question</a></li>
          <li><a href="<?php echo SITE_URL; ?>schedule-appointment/">Schedule Appointment</a></li>
        </ul>
        <div>
		 <?php 
					    $iSettings=$db->getRow("select * from settings where id='1'");
					   ?>
          <h3><a href="#"><span class="mira-items-spn1">SHARE</span> <span class="mira-items-spn2">
          <a href="<?php echo $iSettings['facebook']; ?>">
          	<i class="fa fa-facebook" aria-hidden="true"></i>
          </a>
          <a href="<?php echo $iSettings['instagram']; ?>">
          	<i class="fa fa-instagram" aria-hidden="true"></i>
           </a> <a href="<?php echo $iSettings['pinterest']; ?>"><i class="fa fa-pinterest-p" aria-hidden="true"></a></i><a href="<?php echo $iSettings['twitter']; ?>"> <i class="fa fa-twitter" aria-hidden="true"></i></a></span></a> </h3>
        </div>
      </div>
    </div>
  </div>
 <div class="serch-box-bh" id="serch-box-bh4">	
		  
		  
		  
		  <div class="bh-content">
		  
		  
		  
		  
<button style="color:black;margin: -22px -16px;padding: 0px 8px 9px;background: black;border-radius: 38px;" type="button" onclick="closesearch4();" class="close" data-dismiss="modal">×</button>
	<span id="showhint"></span>	
	<form id="SubmimyForm"   style="text-align: left;">
	 <h2>Email A Friend</h2>
  <h3>1.62 CT BAGUETTE CUT DIAMOND ETERNITY BAND RING</h3>
  <label>Straight baguette cut diamonds set into delicate channel setting; continuing all the way around. </label>
  <div class="row">
  <div class="form-group col-sm-4">
  
    <label for="email">Your Email Address:*

</label>
    <input type="email" class="form-control" id="email_id" value="<?php echo $_POST['email_id']; ?>">
  </div>
  <div class="form-group col-sm-4">
    <label for="email">Friends Email Address:*</label>
    <input type="email" class="form-control" id="friend_email" value="<?php echo $_POST['friend_email']; ?>">
  </div>
  <div class="form-group col-sm-4">
   
  </div>
   
  </div>
  
 <div class="form-group col-sm-12" style="margin-top: 51px;">
  <label for="comment" style="text-align: left;">Your Message:*</label>
  <textarea class="form-control" rows="5" id="messages"><?php echo $_POST['messages']; ?></textarea>
</div>
  <button type="button" onclick="drop_hint();" class="btn btn-default" style="float: right;">Submit</button>
<a href="#" style="float: left;">*required fields</a>
</form>

</div>
	  </div>

	  
 <div class="serch-box-bh" id="serch-box-bh5">	
		  
		  
		  
		  <div class="bh-content">
		  
		  
		 
		  <button style="color:black;margin: -22px -16px;padding: 0px 8px 9px;background: black;border-radius: 38px;" type="button" onclick="closesearch5();" class="close" data-dismiss="modal">×</button>
		  
		 
 <form id="SubmitForm" method="post"  style="text-align: left;">
 <span id="showreq"></span>
<h2>REQUEST FOR MORE INFO

</h2>
 

  <div class="row">
  <div class="form-group col-sm-4">
  
    <label for="firstname">firstname:*

</label>
    <input type="text" class="form-control" id="firstname" value="<?php echo $_POST['firstname']; ?>">
	</div>
	<div class="form-group col-sm-4">
  
    <label for="firstname">Lastname:*

</label>
    <input type="text" class="form-control" id="lastname" value="<?php echo $_POST['lastname']; ?>">
	</div>
  
  <div class="form-group col-sm-4">
   <label for="email">email:*

</label>
    <input type="email" class="form-control" id="emailid" value="<?php echo $_POST['emailid']; ?>">
  </div>
   <div class="form-group col-sm-4">
  
    <label for="phonenumber">phonenumber:*

</label>
    <input type="text" class="form-control" id="contactno" value="<?php echo $_POST['contactno']; ?>">
  </div>
  
 
  <div class="form-group col-sm-4">
    <label for="region">region:*</label>
      <select name="region" id="region" title="Region" class="form-control"> 
	                                <option value="Select Region"> </option>

                                                                         
                                 <option value="US-NY-Tri-State-area">US NY Tri-State area</option>
                                <option value="US-East-Coast">US EastCoast</option>
                                <option value="US-West-Coast">US WestCoast</option>
                                <option value="US-Midwest">US Midwest</option>
                                <option value="US-South">US South</option>
                                <option value="US-IPO">US IPO</option>
                                <option value="Int-Great-Britain">IntGreat Britain</option>
                                <option value="Int-Canada">Int Canada</option>
                                <option value="Int-France">Int France</option>
                                <option value="Int-Russia">Int Russia</option>
                                <option value="Int-Europe">Int Europe</option>
                                <option value="Int-Australia/NZ">IntAustralia/NZ</option>
                                <option value="Int-Asia">Int Asia</option>
                                <option value="Int-South-America">IntSouth America</option>
                                <option value="Int-Middle-East">IntMiddle East</option>
                            </select>
  </div>
   <div class="form-group col-sm-4">
  
    <label for="phonenumber">Model No:*

</label>
    <input type="text" class="form-control" id="model_no"value="<?php echo $_POST['model_no']; ?>">
  </div>
  
  
 <div class="form-group col-sm-12" style="margin-top:15px;">
  <label for="comment" style=" text-align: left;">Your Message:*</label>
  <textarea class="form-control" rows="5" id="message"><?php echo $_POST['message']; ?></textarea>

 <button type="button"  onclick="get_req();" class="btn btn-default" style="float: right;margin-top: 23px;">Submit info requests</button><a href="#" style="float: left;">*required fields</a></div>
</form>

 </div>








 


 <div class="for2">


<h2 class="h2-bhh"><span class="form-title">B</span> CUSTOM DESIGN QUOTE FORM</h2><hr><hr>
 <span id="customreq"></span>
 <form id="SubmitForms" method="post"  style="text-align: left;">
 <h4>About the Project</h4>
  <label>Type of item</label>

<div class="row bh-mar">

<div class="col-md-3">


				
                
                <div class="form-group">    
         <input type="checkbox" value="Engagement Ring" id="items" name="items" class="items">
                                  Engagement Ring

</div>

</div>
<div class="col-md-3">


				
                
                <div class="form-group">    
         <input type="checkbox" value="Wedding Band" id="items"  name="items"  class="items">
                                 Wedding Band

</div>

</div>
<div class="col-md-3">


				
                
                <div class="form-group">    
         <input type="checkbox" value="Pandent" id="items"  name="items" class="items">
                                  Pandent
</div>

</div>


<div class="col-md-3">


				
               
                <div class="form-group">    
         <input type="checkbox" value="Other" id="items"  name="items" class="items">
                                  Other

</div>

</div>
</div>




<div class="row bh-mar">

<div class="col-md-4">
 
<div class="form-group">
      <label for="email">Metal</label>
     
							<select id="metal" title="Region" class="form-control">
							   <option value="">---Please Choose---</option>
								 
									   <!--<option value=""> </option> -->
							    <option value="Platinum-or-white-gold">Platinum or white gold</option>
                                <option value="Rose-Gold">Rose Gold</option>
                                <option value="Yellow-Gold">Yellow Gold</option>
                                <option value="Platinum">Platinum</option>
                                <option value="White-Gold">White Gold</option>
                           
                                  </select>
						      
    </div>
 
</div>

<div class="col-md-4">
 
<div class="form-group">
      <label for="email">Time Frame</label>
     
							<select   title="Region" class="form-control" id="time_frame">
							   <option value="">---Please Choose---</option>
								 
									   <!--<option value=""> </option> -->
								<option value="now">Now</option>
                                <option value="Flexible">Flexible</option>
                                <option value="Several-week">Several week</option>
                                <option value="Several-Month">Several Month</option>
                                                            </select>
						      
    </div>
 
</div>

<div class="col-md-4">
 
<div class="form-group">
      <label for="email">Budget</label>
     
							<select   title="Region" class="form-control" id="budget">
							   <option value="">---Please Choose---</option>
								 
									   <!--<option value=""> </option> -->
								 <option value="up to $5000">Up tp $5000</option>
                                <option value="$5k to $10,000">$5k to $10,000</option>
                                <option value="$10k to $15,000">$10k to $15,000</option>
                                <option value="$10k to $15,000">$20k to $25,000</option>
                                <option value="$10k to $15,000">$10k to $15,000</option>
                                <option value="Undecided">Undecided</option>
                                                           </select>
						      
    </div>
 
</div>
	

</div>
<div class="f5">
<label>My Goal is to</label>

<div class="row bh-mar">

<div class="col-md-7">


				
                
                <div class="form-group">    
         <input type="checkbox" value="Re-create this design with different center stone" id="goals" name="goals[]" class="">
                                 Re-create this design with different center stone

</div>

</div>
  <div class="col-md-5">


				
                
                <div class="form-group">    
         <input type="checkbox" value=" Need advice" id="goals"  name="goals" class="">
                                Need advice

</div>

</div>
<div class="col-md-7">


				
                
                <div class="form-group">    
         <input type="checkbox" value="Create a different version" id="goals" name="goals" class=" ">
                                Create a different version

</div>

</div>
<div class="col-md-5">


				
                
                <div class="form-group">    
         <input type="checkbox" value="Replicate something I saw" id="goals" name="goals"  class="">
                              Replicate something I saw
</div>

</div>

</div>

 </div>
</div>

<hr>

<div class="for2">
<h4>About the Diamond</h4>
  <label>Center Stone Status</label>
<div class="row bh-mar">
<span id="customstatus"></span>
<div class="col-md-6">


				
                
                <div class="form-group">    
         <input type="radio" value=" Interest in purchasing through Lauren B" name="stone_status"  id="stone_status" class="">
                                  Interest in purchasing through Lauren B

</div>

</div>
<div class="col-md-6">


				
                
                <div class="form-group">    
         <input type="radio" value=" Already have one"  name="stone_status" id="stone_status" class="">
                                 Already have one

</div>

</div>
</div>







 
<div class="row bh-mar">

<div class="col-md-6">
 
<div class="form-group">
      <label for="email">Stone Type</label>
     
							<select   title="Region" class="form-control" id="stone_type">
							   <option value="">---Please Choose---</option>
								 
									   <!--<option value=""> </option> -->
							<option value="US-NY-Tri-State-area">US NY Tri-State area</option>
                              
                                <option value="Int-Russia">Diamond</option>
                                <option value="Int-Europe">Sapphire</option>
                                <option value="Int-Australia/NZ">Ruby</option>
								<option value="Int-Australia/NZ">Emerald</option>
                                <option value="Int-Asia">Missanite</option>
                                <option value="Int-South-America">Other</option>
                                
                            </select>
						      
    </div>
 
</div>
	
	
	
	<div class="col-md-6">
 
<div class="form-group">
      <label for="email">Stone Shape</label>
     
							<select   title="Region" class="form-control" id="stone_shape">
							   <option value="">---Please Choose---</option>
								 
									   <!--<option value=""> </option> -->
								                           
                              
                                <option value="Rounded">Rounded</option>
                                <option value="Cushion">Cushion</option>
                                <option value="Princess">Princess</option>
								
                            </select>
						      
    </div>
 
</div>
	
</div>

 




<div class="row bh-mar">

<label class="col-md-6">Center Stone Carat Weight</label>

<label class="col-md-6">Color Range</label>

<div class="col-md-6">

<div class="col-md-6 bh-111">
<label for="email" class="col-sm-4 bh-111">Form</label>
	  
	  <div class="col-sm-8">
      <input type="number" class="form-control frm-c " id="weight_start" name="weight_start">
    </div>

</div>

 <div class="col-md-6">



 
      <label for="email" class="col-sm-4 bh-111">To</label>
	  
	  <div class="col-sm-8">
      <input type="number" class="form-control frm-c " id="weight_end"name="weight_end">
 
  </div>
 
 </div>



</div>






<div class="col-md-6">

<div class="col-md-6 bh-111">
<label for="email" class="col-sm-4 bh-111">Form</label>
	  
	  <div class="col-sm-8">
      
	  <select  id="colorrange_start" title="Color Range" class="form-control" name="colorrange_start">
                                            
																						<option value="D">D</option>
																						<option value="E">E</option>
																						<option value="F">F</option>
																						<option value="G">G</option>
																						<option value="H">H</option>
																						<option value="I">I</option>
																						<option value="J">J</option>
																						<option value="K">K</option>
																						<option value="L">L</option>
																						<option value="M">M</option>
																						<option value="N">N</option>
																						<option value="O">O</option>
																						<option value="P">P</option>
																						<option value="Q">Q</option>
																						<option value="R">R</option>
																						<option value="S">S</option>
																						<option value="T">T</option>
																						<option value="U">U</option>
																						<option value="V">V</option>
																						<option value="W">W</option>
																						<option value="X">X</option>
																						<option value="Y">Y</option>
																						<option value="Z">Z</option>
											                                          </select>
	  
    </div>

</div>

 <div class="col-md-6">



 
      <label for="email" class="col-sm-4 bh-111">To</label>
	  
	  <div class="col-sm-8">
       <select  id="colorrange_end" title="Color Range" class="form-control"name="colorrange_end">
                                            
																						<option value="D">D</option>
																						<option value="E">E</option>
																						<option value="F">F</option>
																						<option value="G">G</option>
																						<option value="H">H</option>
																						<option value="I">I</option>
																						<option value="J">J</option>
																						<option value="K">K</option>
																						<option value="L">L</option>
																						<option value="M">M</option>
																						<option value="N">N</option>
																						<option value="O">O</option>
																						<option value="P">P</option>
																						<option value="Q">Q</option>
																						<option value="R">R</option>
																						<option value="S">S</option>
																						<option value="T">T</option>
																						<option value="U">U</option>
																						<option value="V">V</option>
																						<option value="W">W</option>
																						<option value="X">X</option>
																						<option value="Y">Y</option>
																						<option value="Z">Z</option>
											                                          </select>
	  
 
  </div>
 
 </div>



</div>

</div>




<div class="row bh-mar">

<label class="col-md-6">Clarity Range</label>

<label class="col-md-6">Certification</label>






<div class="col-md-6">

<div class="col-md-6 bh-111">
<label for="email" class="col-sm-4 bh-111">Form</label>
	  
	  <div class="col-sm-8">
      
	  <select  id="clarity_start" title="Color Range" class="form-control" name="clarity_start">
                                            
																						<option value="D">D</option>
																						<option value="E">E</option>
																						<option value="F">F</option>
																						<option value="G">G</option>
																						<option value="H">H</option>
																						<option value="I">I</option>
																						<option value="J">J</option>
																						<option value="K">K</option>
																						<option value="L">L</option>
																						<option value="M">M</option>
																						<option value="N">N</option>
																						<option value="O">O</option>
																						<option value="P">P</option>
																						<option value="Q">Q</option>
																						<option value="R">R</option>
																						<option value="S">S</option>
																						<option value="T">T</option>
																						<option value="U">U</option>
																						<option value="V">V</option>
																						<option value="W">W</option>
																						<option value="X">X</option>
																						<option value="Y">Y</option>
																						<option value="Z">Z</option>
											                                          </select>
	  
    </div>

</div>

 <div class="col-md-6">



 
      <label for="email" class="col-sm-4 bh-111">To</label>
	  
	  <div class="col-sm-8">
       <select  id="clarity_end" title="Color Range" class="form-control"name="clarity_end">
                                            
																						<option value="D">D</option>
																						<option value="E">E</option>
																						<option value="F">F</option>
																						<option value="G">G</option>
																						<option value="H">H</option>
																						<option value="I">I</option>
																						<option value="J">J</option>
																						<option value="K">K</option>
																						<option value="L">L</option>
																						<option value="M">M</option>
																						<option value="N">N</option>
																						<option value="O">O</option>
																						<option value="P">P</option>
																						<option value="Q">Q</option>
																						<option value="R">R</option>
																						<option value="S">S</option>
																						<option value="T">T</option>
																						<option value="U">U</option>
																						<option value="V">V</option>
																						<option value="W">W</option>
																						<option value="X">X</option>
																						<option value="Y">Y</option>
																						<option value="Z">Z</option>
											                                          </select>
	  
 
  </div>
 
 </div>



</div>






<div class="col-md-6">

 

 

  
 
 
	  
	  <div class="col-sm-12">
      <input type="text" class="form-control frm-c " id="certificate" name="certificate"value=" ">
 
  
 
 </div>



</div>













</div>


<div class="row bh-mar">

 <div class="col-md-12">

<div class="form-group">
      <label for="email">Message:</label>

  <textarea class="form-control" rows="5" id="messagenew" name="messagenew"></textarea>

</div>

</div>


</div>
 <label>Attach image</label>
  <div class="row bh-mar">
  
 <div class="col-md-6">
 
			
  <input  type="file" id="image"  name="image" value="" > 
 			
</div>
				
		 <div class="col-md-6 text-right">		
				 
		 <button type="button"  onclick="custom_req();"  class="button bh-sum"> Submit Info Request  </button>
	 
</div>

</div>
 
</div>






  </form>


  
  




</div>

	  </div>
	  
    <h4 class="mira-last-sec" style="font-family: inherit;">CLICK HERE TO WATCH VIDEOS RELATED TO THIS ITEM<span class="sectn3"><a href="#"> <i class="fa fa-caret-right" aria-hidden="true"></i></a></span></h4>
   	
		<h5 class="mira-last-sec"><i class="fa fa-globe" aria-hidden="true"></i> Shipping and Return Policy <span class="mira-sec5">Registered and insured delivery available worldwide.</span>  <span class="mira-sec6">
		<a href="#"onClick="showsearch();"><i class="fa fa-caret-right" aria-hidden="true"></i> <p class="sec-p-tag">LEARN MORE</p></a>
	
		</span>
		
		</h5>
		 <div class="serch-box-bh" id="serch-box-bh">	
		  
		  
		  
		  <div class="bh-content">
		  
		  <form action="#" method="get" style="">
		  <button style="color:black;margin: -22px -16px;padding: 0px 8px 9px;background: black;border-radius: 38px;" type="button" onClick="closesearch();" class="close" data-dismiss="modal">×</button>
	    <div class="page-heading">
<h1>shipping-information</h1>

<p>All in-stock items are processed and shipped within five business days. We do ship internationally to all addresses across the world. The client is responsible for any duties or taxes collected by your local government. Lauren B is not responsible for any of these charges so please check the rates ahead of time. Orders of less than $10,000 will be shipped and insured via UPS or FedEx second- day air. Items above this price will be shipped and insured via UPS or FedEx next-day air and these costs will be added to the total order price. Once the order is shipped, we will provide you with a tracking number. We fully insure each item for the final purchase price, from the time it is in transit until the time it arrives at its destination and the recipient&rsquo;s signature is required at the time of delivery.&nbsp;Please note Lauren B cannot be held accountable for delays on the shipper's part due to severe weather or other unexpected conditions.</p>
<table style="width: 80%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td><span style="font-size: small;">ITEM VALUE</span></td>
<td><span style="font-size: small;">SHIPPING/INSURANCE COST</span></td>
</tr>
<tr>
<td><span style="font-size: small;">Up to $2,500</span></td>
<td><span style="font-size: small;">$40</span></td>
</tr>
<tr>
<td><span style="font-size: small;">$2,500 to $5,000</span></td>
<td><span style="font-size: small;">$50</span></td>
</tr>
<tr>
<td><span style="font-size: small;">$5,000 to $10,000</span></td>
<td><span style="font-size: small;">$70</span></td>
</tr>
<tr>
<td><span style="font-size: small;">$10,000 and up (next day air)</span></td>
<td><span style="font-size: small;">$100 and up</span></td>
</tr>
</tbody>
</table>
<p>If you would like to ship your item to an address other than the one listed on your credit card, you must place the address on file with your credit card company. Doing so will protect you from fraudulent charges. Please note that we cannot ship to PO boxes. In-store pickup can also be arranged for any item purchased online.</p>
<h1>refund/exchange policy</h1>
<p>If you are not satisfied with your purchase at Laurenbjewelry.com, standard in stock items may be returned or exchanged within 10 days of first delivery attempt. The merchandise must be in original condition; we do not accept refunds for products showing any signs of wear or damage. In addition, we do not allow returns or exchanges on any altered items. These would include custom sizing, engraving and rhodium polishing, and special orders &ndash; essentially, any items that we do not usually keep in stock or that have to be custom made. At Lauren B, we are confident that you will be thrilled with your jewelry; however, if the item is not to your liking or specifications, we feel that 10 days is enough time to evaluate your purchase.</p>
<p>Custom made or specially ordered pieces (including engagement rings and wedding bands) are created especially for, and based on, the exact requirements of each individual client and therefore may not be returned or exchanged. &nbsp;</p>
<p><span>&nbsp;- See more at:&nbsp;</span></p>
</div>
 </form>




</div>

	  </div>
	   
		<h5 class="mira-last-sec"><i class="fa fa-globe" aria-hidden="true"></i> Payments and Financing  <span class="mira-sec5">layaway and financing options available (financing subject to credit approval)</span>  <span class="mira-sec6">
		<a href="#"onClick="showsearch11();"><i class="fa fa-caret-right" aria-hidden="true"></i> <p class="sec-p-tag">LEARN MORE</p></a>
	
		</span>
		
		</h5>
		 <div class="serch-box-bh" id="serch-box-bh">	
		  
		  
		  
		  <div class="bh-content">
		  
		  <form action="#" method="get" style="">
		  <button style="color:black;margin: -22px -16px;padding: 0px 8px 9px;background: black;border-radius: 38px;" type="button" onClick="closesearch11();" class="close" data-dismiss="modal">×</button>
	    <div class="page-heading">
<h1>Payments and Financing</h1>

<p>All in-stock items are processed and shipped within five business days. We do ship internationally to all addresses across the world. The client is responsible for any duties or taxes collected by your local government. Lauren B is not responsible for any of these charges so please check the rates ahead of time. Orders of less than $10,000 will be shipped and insured via UPS or FedEx second- day air. Items above this price will be shipped and insured via UPS or FedEx next-day air and these costs will be added to the total order price. Once the order is shipped, we will provide you with a tracking number. We fully insure each item for the final purchase price, from the time it is in transit until the time it arrives at its destination and the recipient&rsquo;s signature is required at the time of delivery.&nbsp;Please note Lauren B cannot be held accountable for delays on the shipper's part due to severe weather or other unexpected conditions.</p>
<table style="width: 80%;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td><span style="font-size: small;">ITEM VALUE</span></td>
<td><span style="font-size: small;">SHIPPING/INSURANCE COST</span></td>
</tr>
<tr>
<td><span style="font-size: small;">Up to $2,500</span></td>
<td><span style="font-size: small;">$40</span></td>
</tr>
<tr>
<td><span style="font-size: small;">$2,500 to $5,000</span></td>
<td><span style="font-size: small;">$50</span></td>
</tr>
<tr>
<td><span style="font-size: small;">$5,000 to $10,000</span></td>
<td><span style="font-size: small;">$70</span></td>
</tr>
<tr>
<td><span style="font-size: small;">$10,000 and up (next day air)</span></td>
<td><span style="font-size: small;">$100 and up</span></td>
</tr>
</tbody>
</table>
<p>If you would like to ship your item to an address other than the one listed on your credit card, you must place the address on file with your credit card company. Doing so will protect you from fraudulent charges. Please note that we cannot ship to PO boxes. In-store pickup can also be arranged for any item purchased online.</p>
<h1>refund/exchange policy</h1>
<p>If you are not satisfied with your purchase at Laurenbjewelry.com, standard in stock items may be returned or exchanged within 10 days of first delivery attempt. The merchandise must be in original condition; we do not accept refunds for products showing any signs of wear or damage. In addition, we do not allow returns or exchanges on any altered items. These would include custom sizing, engraving and rhodium polishing, and special orders &ndash; essentially, any items that we do not usually keep in stock or that have to be custom made. At Lauren B, we are confident that you will be thrilled with your jewelry; however, if the item is not to your liking or specifications, we feel that 10 days is enough time to evaluate your purchase.</p>
<p>Custom made or specially ordered pieces (including engagement rings and wedding bands) are created especially for, and based on, the exact requirements of each individual client and therefore may not be returned or exchanged. &nbsp;</p>
<p><span>&nbsp;- See more at:&nbsp;</span></p>
</div>
 </form>




</div>

	  </div>
	   
	
     <h5 class="mira-last-sec"><i class="fa fa-check" aria-hidden="true"></i> MIRA Guarantee  <span class="mira-sec5">100% customer satisfaction from our superior craftsmanship and knowledgeable experts.</span> <span class="mira-sec6">
		<a href="#"onClick="showsearch1();"><i class="fa fa-caret-right" aria-hidden="true"></i> <p class="sec-p-tag">LEARN MORE</p></a>
		
		
		
		
	 <div class="serch-box-bh" id="serch-box-bh1">	
		  
		  
		  
		  <div class="bh-content">
		  
		<form action="#" method="get" style="">
		  <button style="color:black;margin: -22px -16px;padding: 0px 8px 9px;background: black;border-radius: 38px;" type="button" onClick="closesearch1();" class="close" data-dismiss="modal">×</button>
<div class="">

<h2>Jewelers, New York: About Us</h2>
<hr>
<div class="col-md-8">
<div class="left-side">


<p>Lauren B Jewelry and Diamonds is not your standard, run-of-the-mill mom and pop store. We have become a well known and respected&hellip;facet&hellip;of the NYC jewelry industry. Since 1978, the Behar family has continued the family tradition of not only providing pieces of exceptional jewelry, but dedicating time to making each and every one of our customers happy.</p>
<p>Lauren B carries a wide selection of finely-crafted diamond and colored gemstone jewelry. The company has become best-known for specializing in engagement rings and bridal jewelry, and houses a huge inventory of GIA and EGL certified diamonds. Guiding you smoothly through the process of narrowing down the details is what we have years of experience doing and take great satisfaction in doing. From art-deco and vintage styles, to modern, edgy looks, our Lepozzi collection has something to meet everyones taste. For those looking for something one of a kind, we can customize any of our styles, as well as design a ring from scratch.</p>
<p>&nbsp;Quality is a given at Lauren B, and our competitive pricing allows us to give you the best deal possible in a relaxed, pressure-free atmosphere. As proud members of the Jewelers of America and Better Business Bureau, Lauren B is committed to the highest standards and will do everything in our power to ensure a stellar shopping experience.</p>
<p>The newest facet of Lauren B is our website&nbsp;<a title="This external link will open in a new window" href="http://www.laurenbjewelry.com/" target="_blank">www.laurenbjewelry.com</a>, and we seek to strengthen our relationship with past, present, and future customers through the convenience of online shopping. Our website continues to evolve based on our customers needs, and we now work on a global scale every day. We recently reached over 150,000 Instagram followers, so we want to thank our loyal customers and followers!</p>
<p>&nbsp;From our Lauren B family to yours, thank you for visiting! Please browse our selection online, or stop by our brand new showroom at 44 East 46th Street, New York, NY 10017. We look forward to hearing from you!&nbsp;</p>
</div>

</div>
</div>
<div class="col-md-4">
<div class="right-part"><img src="images/about-us-page-layout.png" alt="" style="height:624px;"></div>

</div>
 </form>




</div>

	  </div>	
		
		
		
		
		
		
		
		
		
   	<h5 class="mira-last-sec" > <i class="fa fa-file-text-o" aria-hidden="true"></i> Documentation <span class="mira-sec5"> purchase comes with appraisal, manufacturer warranty, receipt and certification </span> <span class="mira-sec6"> <a href="#"onClick="showsearch2();"><i class="fa fa-caret-right" aria-hidden="true"></i><p class="sec-p-tag"> LEARN MORE</p></a></span></h5>
		
			
	 <div class="serch-box-bh" id="serch-box-bh2">	
		  
		  
		  
		  <div class="bh-content">
		  
		<form action="#" method="get" style="">
		  <button style="color:black;margin: -22px -16px;padding: 0px 8px 9px;background: black;border-radius: 38px;" type="button" onClick="closesearch2();" class="close" data-dismiss="modal">×</button>
<div class="my-content" >

<h3>MANUFACTURING WARRANTY</h3>
<hr>
<p class="ms" style="font-size:15px; font-family: serif;">

Lauren B Jewelry & Diamonds is committed to providing our clients with the highest quality craftsmanship and professional expertise for every jewelry purchase. Our manufacturing guarantee is to stand behind the integrity of every piece and make sure you are completely satisfied with the entire shopping experience. Under this warranty, we cover any defects in the manufacturing for the lifetime of the piece that results in the loss or breakage of diamonds and precious metal. Please be advised that this does not cover accidental or incidental breakage, normal wear and tear, theft, loss, or any damage that our professionals deem is not due to craftsmanship related issues. Lastly, if the piece has been altered in any way by a jeweler other than Lauren B, the warranty is no longer valid. It is our recommendation that each piece be regularly maintained and checked once a year by a service professional. At Lauren B Jewelry we provide complimentary inspection and basic cleaning for rings purchased through our store or website. - See more at: https://www.laurenbjewelry.com/1-62-ct-baguette-cut-diamond-eternity-band-ring.html#sthash.eaxa50tL.dpuf

</p>
<h4 style="margin-bottom:-14px; font-size:20px">RING CARE</h4>
<hr>
<p class="my-2" style="font-size:15px; font-family: serif;">


To avoid any durablity issues with your ring please adhere to some of the basic ring care guidlines outlined here on our website.  - See more at: https://www.laurenbjewelry.com/1-62-ct-baguette-cut-diamond-eternity-band-ring.html#sthash.eaxa50tL.dpuf


</p>
<h4 style="margin-bottom:-14px; font-size:20px">APPRAISAL AND CERTIFICATION</h4>
<hr>
<p class="my-1" style="font-size:15px; font-family: serif;">


Your purchase will be come with all of the necessary documentation including an official store invoice, appraisal, and any applicable certification.   We advise you to have your piece insured upon receiving it so that you are covered in the case of loss or theft. - See more at: https://www.laurenbjewelry.com/1-62-ct-baguette-cut-diamond-eternity-band-ring.html#sthash.eaxa50tL.dpuf


</p>


</div>

 </form>




</div>

	  </div>	
		

		
	
		
		
				
					
   	<h5 class="mira-last-sec"><i class="fa fa-diamond" aria-hidden="true"></i> Center Diamond Selection Process <span class="mira-sec5">work with our graduate gemologists to find the perfect diamond.</span> <span class="mira-sec6"> 
		<a href="#"onClick="showsearch3();"><i class="fa fa-caret-right" aria-hidden="true"></i><p class="sec-p-tag">LEARN MORE</p></a></span></h5>
		 <div class="serch-box-bh" id="serch-box-bh3">	
		  
		  
		  
		  <div class="bh-content">
		  
		<form action="#" method="get" style="">
		  <button style="color:black;margin: -22px -16px;padding: 0px 8px 9px;background: black;border-radius: 38px;" type="button" onClick="closesearch3();" class="close" data-dismiss="modal">×</button>
<div class="" >

<h3 style="
    color: black;
">CENTER DIAMOND SELECTION PROCESS</h3>
<p style="
    color: black;
    font-family: latoregular;
    font-weight: normal;
    font-size: 20px;
">
At Lauren B Jewelry, one of our graduate gemologists will guide you through the custom engagement ring selection process from start to finish. We take special care in helping our clients select the perfect center diamond to complement the ring setting they desire. Every individual has unique requests and preferences for center diamond shape, quality and size. With this in mind we only offer those that best match each individual client’s specifications while still remaining within their target price range. Our gemologists carefully sort through many center diamonds, eliminating a large percentage of unsuitable choices, before presenting the options to you that best fit your needs. In that regard we consider ourselves matchmakers, linking prospective clients to the best available diamond options on the market. - See more at: https://www.laurenbjewelry.com/1-62-ct-baguette-cut-diamond-eternity-band-ring.html#sthash.eaxa50tL.dpuf
</p>
<p style="
    color: black;
    font-family: latoregular;
    font-weight: normal;
    font-size: 20px;
">
At Lauren B Jewelry, one of our graduate gemologists will guide you through the custom engagement ring selection process from start to finish. We take special care in helping our clients select the perfect center diamond to complement the ring setting they desire. Every individual has unique requests and preferences for center diamond shape, quality and size. With this in mind we only offer those that best match each individual client’s specifications while still remaining within their target price range. Our gemologists carefully sort through many center diamonds, eliminating a large percentage of unsuitable choices, before presenting the options to you that best fit your needs. In that regard we consider ourselves matchmakers, linking prospective clients to the best available diamond options on the market. - See more at: https://www.laurenbjewelry.com/1-62-ct-baguette-cut-diamond-eternity-band-ring.html#sthash.eaxa50tL.dpuf
</p>


<p style="
    color: black;
    font-family: latoregular;
    font-weight: normal;
    font-size: 20px;
">

We have access to a comprehensive inventory of certified stones in all shapes and sizes so you can be certain we have what you are looking for! In the diamond selection process we present anywhere from two to four center-stone options across similar size, color and clarity ranges for our in-store and online clients to consider. By visually comparing several options side by side, either in person or via e-mailed videos, our clients can make a confident purchase because they are able to see the nuances and details in a diamond that do not necessarily show up on a certificate. We urge them to use these lab reports as a guide and advise against basing their entire purchase solely on the stated grades. This is the reason why we do not simply list a database of loose diamonds on our website which we have yet to inspect ourselves for quality. The strategy commonly used by large scale diamond websites (without a brick and mortar location) is to compete on price and sell in volume, with complete disregard for how this precious stone actually looks and performs in real life which is crucial. In sharp contrast, our team at Lauren B thoroughly previews and examines each option beforehand and will provide you with a detailed description of each diamond along with any necessary videos or photos. - See more at: https://www.laurenbjewelry.com/1-62-ct-baguette-cut-diamond-eternity-band-ring.html#sthash.eaxa50tL.dpuf

</p>

<p style="
    color: black;
   font-family: latoregular;
    font-weight: normal;
    font-size: 20px;
">

When the time is right for you to shop for your engagement ring, Lauren B Jewelry should be your first and last stop. We are here to answer any questions you may have along the way and help guide you to your final decision. We look forward to working with you! - See more at: https://www.laurenbjewelry.com/1-62-ct-baguette-cut-diamond-eternity-band-ring.html#sthash.eaxa50tL.dpuf

</p>


</div>

 </form>




</div>

	  </div>	
		
		
		
		
		

		
		
		
  </div>
</div>
</div>
<?php include('inc.footer.php'); ?>
<?php include('inc.js.php'); ?>
<script>

		 function showsearch4()

		 	{

				

				document.getElementById("serch-box-bh4").style.display='block';

			}

		 function closesearch4()

		 	{

				

				document.getElementById("serch-box-bh4").style.display='none';

			}	

			

		</script>
		<script>

		 function showsearch()

		 	{

				

				document.getElementById("serch-box-bh").style.display='block';

			}

		 function closesearch()

		 	{

				

				document.getElementById("serch-box-bh").style.display='none';

			}	

			

		</script>
		<script>

		 function showsearch11()

		 	{

				

				document.getElementById("serch-box-bh").style.display='block';

			}

		 function closesearch11()

		 	{

				

				document.getElementById("serch-box-bh").style.display='none';

			}	

			

		</script>
		<script>

		 function showsearch2()

		 	{

				

				document.getElementById("serch-box-bh2").style.display='block';

			}

		 function closesearch2()

		 	{

				

				document.getElementById("serch-box-bh2").style.display='none';

			}	

			

		</script>	
		
		
		     <script>

		 function showsearch1()

		 	{

				

				document.getElementById("serch-box-bh1").style.display='block';

			}

		 function closesearch1()

		 	{

				

				document.getElementById("serch-box-bh1").style.display='none';

			}	

			

		</script>
	
		
		
			
			
	<script>

		 function showsearch3()

		 	{

				

				document.getElementById("serch-box-bh3").style.display='block';

			}

		 function closesearch3()

		 	{

				

				document.getElementById("serch-box-bh3").style.display='none';

			}	

			

		</script>
<script>

		 function showsearch5()

		 	{

				

				document.getElementById("serch-box-bh5").style.display='block';

			}

		 function closesearch5()

		 	{

				

				document.getElementById("serch-box-bh5").style.display='none';

			}	

			

		</script>
		
			
		
		
				

<script>

function Wishlist(pid)
{	

document.getElementById("preloader").style.display = "block";
document.getElementById("preloadoverlay").style.display = "block";	

$.ajax({
type: 'post',
url: '<?php echo SITE_URL;?>ajax.php',
data: {
action	: "get_Wishlist",
pid		:pid,
},
success: function( data ) {
		window.location.href = '<?php echo SITE_URL; ?>wishlist.php'; 
	}
});
}
</script> 
<script>
function drop_hint()
{
var email_id = document.getElementById("email_id").value;
var friend_email = document.getElementById("friend_email").value;
var messages = document.getElementById("messages").value;
				$.ajax({
				type: 'post',
				url: 'ajax.php',
				data: {
				action	         : "drop_hint",
				email_id		     : email_id,
				friend_email		 : friend_email,
				messages		     : messages,

				},
				success: function( data ) {
	
if(data==1)
{		
		$("#showhint").html('<p style="color:green;">Submit Successfully.</p>');
		document.getElementById("SubmimyForm").reset();
		
}
else {
		$("#showhint").html(data);
}
}

				});
}

</script>
<script>
function get_req()
{
var firstname = document.getElementById("firstname").value;
var lastname = document.getElementById("lastname").value;
var emailid = document.getElementById("emailid").value;
var contactno = document.getElementById("contactno").value;
var region = document.getElementById("region").value;
var model_no = document.getElementById("model_no").value;
var message = document.getElementById("message").value;
				$.ajax({
				type: 'post',
				url: 'ajax.php',
				data: {
				action	         : "get_req",
				firstname		     : firstname,
				lastname		     : lastname,
				emailid		         : emailid,
				contactno		     : contactno,
				region		         : region,
				model_no		     : model_no,
				message		         : message,

				},
				success: function( data ) {
	
if(data==1)
{		
		$("#showreq").html('<p style="color:green;">Submit Successfully.</p>');
		document.getElementById("SubmitForm").reset();
		
}
else {
		$("#showreq").html(data);
}
}
				});
}

</script>

<script>
function custom_req()
{
	
var messagenew = document.getElementById("messagenew").value;
var image = document.getElementById("image").value;
var metal = document.getElementById("metal").value;
var time_frame = document.getElementById("time_frame").value;
var budget = document.getElementById("budget").value;
if($('input[name="stone_status"]:checked').length != 0)
    {
    var stone_status  = document.querySelector('input[name="stone_status"]:checked').value;
     }
   else
   {
    var stone_status  = ''; 
   }
   
   
var stone_type = document.getElementById("stone_type").value;
var stone_shape = document.getElementById("stone_shape").value;
var weight_start = document.getElementById("weight_start").value;
var weight_end = document.getElementById("weight_end").value;
var colorrange_start = document.getElementById("colorrange_start").value;
var colorrange_end = document.getElementById("colorrange_end").value;
var clarity_start = document.getElementById("clarity_start").value;
var clarity_end = document.getElementById("clarity_end").value;
var certificate = document.getElementById("certificate").value;
 var items = new Array();
 
        $("input:checkbox[name=items]:checked").each(function() {
           items.push($(this).val());
        });
		var goals = new Array();
        $("input:checkbox[name=goals]:checked").each(function() {
           goals.push($(this).val());
        });

				$.ajax({
				type: 'post',
				url: 'ajax.php',
				data: {
				action	         : "custom_req",
				messagenew		     : messagenew,
				image		         : image,
				metal		         : metal,
				time_frame		     : time_frame,
				budget		         : budget,
				stone_status		 : stone_status,
				stone_type		     : stone_type,
				stone_shape		     : stone_shape,
				weight_start		  : weight_start,
				weight_end		      : weight_end,
				colorrange_start	 : colorrange_start,
				colorrange_end		 : colorrange_end,
				clarity_start		 : clarity_start,
				clarity_end	         : clarity_end,
				certificate		    : certificate,
				items               : items,
	 	        goals	            : goals,
					

				},
				success: function( data ) {
	
if(data==1)
{		
		$("#customreq").html('<p style="color:green;">Submit Successfully.</p>');
		document.getElementById("SubmitForms").reset();
		
}
else {
		$("#customreq").html(data);
}
}
				});
}

</script>



 </body>
</html>