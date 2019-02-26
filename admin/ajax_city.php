<?php include('../config.php');
$PageTitle="ajax_city";
$FileName ='ajax_city.php'; 
?>

<select id="city_id">
<option>Select City</option>

<?php 
$aryList=$db->getRows("select * from  city where  state_id = '".$_POST['state_id']."' ");

                foreach($aryList as $iList)

                {

                ?>

               <option value="<?php echo $iList['id']; ?>" <?php if($_POST['state_id']==$iList['id']) { echo "selected"; } ?>>
			   
				<?php echo $iList['city']; ?></option>

     
     <?php } ?>

</select>












