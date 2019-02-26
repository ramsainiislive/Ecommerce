<?php include('../config.php');
$PageTitle="abc";
$FileName ='abc.php';
?>

<select onchange="getsubcategr()" id="category_id">
<option>SElect Category</option>
<?php $iAryList=$db->getRows("select * from  category");
	 foreach($iAryList as $iList) {	   	?>
     
     <option value="<?php echo $iList['id']; ?>"><?php echo $iList['categoryname']; ?></option>
     <?php } ?>


</select>
<div id="showsub"></div>
<script src="assets/js/jquery.min.js" type="text/javascript"></script>
<script>
function getsubcategr()
	{
		
			var category_id =	document.getElementById('category_id').value;	
			alert(category_id);
			
		$.post("ajx.php",
				{	 
					
					category_id : category_id
				 
					  
				},
		function(data){
							document.getElementById('showsub').innerHTML =data;
				});
		
	}
	
</script>











