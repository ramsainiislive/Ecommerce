<?php include('../config.php');
$PageTitle="ajaxchild";
$FileName ='ajaxchild.php'; 
?>

<select id="child_id">

<option>Select Childcategory</option>

<?php 
$aryList=$db->getRows("select * from  childcategory where  subcategory_id = '".$_POST['subcategory_id']."' ");

                foreach($aryList as $iList)

                {

                ?>

               <option value="<?php echo $iList['id']; ?>"> <?php echo $iList['childcategory']; ?></option>

     
     <?php } ?>

</select>


