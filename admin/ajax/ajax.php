<?php 
include('config.php'); 
?>

<select id="sub_id">
<option>SElect Category</option>
<?php $iAryList=$db->getRows("select * from  sub_subcategory where category = '".$_POST['cat_id']."'");
	 foreach($iAryList as $iList) {	   	?>
     
     <option value="<?php echo $iList['id']; ?>"><?php echo $iList['subcategory']; ?></option>
     <?php } ?>


</select>