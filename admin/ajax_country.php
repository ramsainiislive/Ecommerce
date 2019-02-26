<?php include('../config.php');
$PageTitle="ajx";
$FileName ='ajx.php'; 
?>

<select onchange="getcity()" id= "state_id"  name="state_id"  class="required form-control">
<option>Select State</option>

<?php 
$aryList=$db->getRows("select * from  state where  country_id = '".$_POST['country_id']."' ");

                foreach($aryList as $iList)

                {

                ?>

               <option value="<?php echo $iList['id']; ?>" <?php if($_POST['state_id']==$iList['id']) { echo "selected"; } ?>>
			   
				<?php echo $iList['state']; ?></option>

     
     <?php } ?>

</select>












