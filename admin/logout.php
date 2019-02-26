 <?php  
include('../config.php'); 
include('inc.session.php');

session_destroy();
redirect('index.php');	
?>