<?php include('../config.php');
$PageTitle="ajx";
$FileName ='ajx.php'; 
?>

<select onchange="getsubchild()" id= "subcategory_id"  name="subcategory_id"  class="required form-control">

<option>Select Subcategory</option>

<?php 
$aryList=$db->getRows("select * from  subcategory where  category_id = '".$_POST['category_id']."' ");

                foreach($aryList as $iList)

                {

                ?>

               <option value="<?php echo $iList['id']; ?>" <?php if($_POST['subcategory_id']==$iList['id']) { echo "selected"; } ?>>
			   
				<?php echo $iList['subcategory']; ?></option>

     
     <?php } ?>

</select>


