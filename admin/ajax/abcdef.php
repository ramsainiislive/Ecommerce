<?php 
include('config.php'); 
?>

<select onchange="getsubcategr()" id="cat_id">
<option>SElect Category</option>
<?php $iAryList=$db->getRows("select * from  category");
	 foreach($iAryList as $iList) {	   	?>
     
     <option value="<?php echo $iList['id']; ?>"><?php echo $iList['category']; ?></option>
     <?php } ?>


</select>
<div id="showsub"></div>

<script>
function getsubcategr()
	{
		
			var cat_id =	document.getElementById('cat_id').value;	
			alert(cat_id);
			
		$.post("ajax.php",
				{	 
					
					cat_id : cat_id
				 
					  
				},
		function(data){
							document.getElementById('showsub').innerHTML =data;
				});
		
	}
	
</script>












<input type="text"  id="x"    />
<input type="text"  id="y"  />
<input type="button" onclick="xyabc()" />

<div id="alph"></div>




<script src="js/jquery-1.11.0.min.js" type="text/javascript"></script>
        

<script>
function xyabc()
	{
		
		
	var x =	document.getElementById('x').value;	
		
	var y =	document.getElementById('y').value;		
		
		
		
		
	$.post("ajax.php",
				{	 
					
					
					x 	: x,
					y	:	y,
					  
				},
		function(data){
							document.getElementById('alph').innerHTML =data;
				});
	}
</script>

<br /><Br /><br />











<script>
function xyz()
	{
		
var c =	document.getElementById('c').value;
document.getElementById('d').value = c;
document.getElementById('alph').innerHTML  = c;
	 }
</script>









<input type="text"  id="a"  />
<input type="text"  id="b"  />
<input type="button"  value="Submit" onclick="abc()"/>


<script>

function abc()
	{
		
var a =	document.getElementById('a').value;
var b  =	document.getElementById('b').value;
	
 
	
	
	
	
	}
</script>