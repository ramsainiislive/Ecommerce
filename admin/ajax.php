<?php include('../config.php');

	if($_POST['action']=='getsubcategory')	{	?>
	
 <select name="subcategory_id" class="form-control">
  <option value="" selected>Select Subcategory</option>
 
 	
 <?php $aryList1=$db->getRows("select * from subcategorys where cat_id = '".$_POST['cat_id']."' and status = '1' order by id desc");
      foreach($aryList1 as $iList1){  ?>
<option <?php if($_POST['subcategory_id']==$iList1['id']){ echo "selected";} ?> value="<?php echo $iList1['id']; ?>">

<?php echo $iList1['subcategory']; ?></option>
	
	<?php } ?>

    </select>

<?php }  

	elseif($_POST['action']=='getcategory')	{	?>
	
	<div class="form-group clearfix">

                       <label class="col-lg-2 control-label " for="confirm">Category Name * </label>

                        <div class="col-lg-10">
	
  <select name="category_id" id="cat_id"  class="required form-control" onChange="getsubcategory()">

                  <option value="" >Select Category</option>

                <?php

 	$aryList=$db->getRows("select * from categorys where language_id = '".$_POST['language_id']."' and status = '1' order by id desc");

                foreach($aryList as $iList)

                {

                ?>

               <option value="<?php echo $iList['id']; ?>" <?php if($_POST['category_id']==$iList['id']) { echo "selected"; } ?>>
			   
				<?php echo $iList['categoryname']; ?></option>

                <?php } ?> 

                

                </select>
				</div>
				</div>
				
				<div class="form-group clearfix">

                                         <label class="col-lg-2 control-label " for="userName">Subcategory Name *</label>

                                                    <div class="col-lg-10">

            <span id="getcatsuccess">
			<select name="subcategory_id" class="form-control">
			<option value="">Select Subcategory</option>
			
		<?php if($_POST['subcategory_id']!='') { 
			 $aryLists=$db->getRows("select * from subcategorys where cat_id = '".$_POST['category_id']."' and status = '1' order by id desc");
      foreach($aryLists as $iLists){  ?>
<option <?php if($_POST['subcategory_id']==$iLists['id']){ echo "selected";} ?> value="<?php echo $iLists['id']; ?>">

<?php echo $iLists['subcategory']; ?></option>
	
	<?php }  }  ?>
			
			</select></span>

                                                    </div>

                                                </div>

<?php }
	
 
 
 elseif($_POST['action']=='getcategories')	{	?>
	
  <select name="cat_id"  class="required form-control">

                  <option value="" >Select Category</option>

                <?php

 	$aryList=$db->getRows("select * from categorys where language_id = '".$_POST['language']."' and status = '1' order by id desc");

                foreach($aryList as $iList)

                {

                ?>

               <option value="<?php echo $iList['id']; ?>" <?php if($_POST['cat_id']==$iList['id']) { echo "selected"; } ?>>
			   
				<?php echo $iList['categoryname']; ?></option>

                <?php } ?> 

                

                </select>

<?php }
 
  ?>

	







