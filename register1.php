
<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<?php include('inc.meta.php');?>
    
</head>

<body>
 <?php include('inc.header.php'); ?>


    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">

                    <ul class="breadcrumb">
                        <li><a href="index.html">Home</a>
                        </li>
                        <li>New account / Sign in</li>
                    </ul>

                </div>

               

                <div class="col-md-6">
                    <div class="box">
                        <h1>Login</h1>

                        <p class="lead">Already our customer?</p>
                        <p class="text-muted">Use this form to login.</p>

                        <hr>
						
                        <form action=" " id="LoginForm"  method="post" class="log">
						<span id="log"></span>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="emailid"   id="ema" />
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password"  id="pass" />
                            </div>
                            <div class="text-center">
                               <input type="button" onclick="action_login()" class="btn btn-primary" value="login" />
                            </div>
                        </form>
                    </div>
                </div>


            </div>
            <!-- /.container -->
        </div>
       


    </div>
    <?php include('inc.footer.php'); ?>	
    <?php include('inc.js.php'); ?>
	
	
 <script>
 
function action_login()
 	{
		
		alert('action_login'); 
		
		
		
 		 var ema= document.getElementById('ema').value;
		  alert('ema'); 
		 var pass= document.getElementById('pass').value;
		  alert('pass');
		 
		$.ajax({
				type: 'post',
				url:'ajax.php',
				data:{
					action           :"action_login",
					
					emailid		     :	ema,
					password         :  pass,
				},
				
				success: function( data){
					alert(data);

					
		if(data==1){
						$("#log").html('<p style="color:green;">Login successfully.</p>');
						
						/*  window.location.href="myaccount.php"; */
						
						
				}
				else{
					$("#log").html(data);
				}
				}
		});
	}	
	
	
</script>


</body>

</html>