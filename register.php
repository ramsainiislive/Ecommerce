
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
                        <li><a href="index.php">Home</a>
                        </li>
                        <li>New account / Sign in</li>
                    </ul>

                </div>

                <div class="col-md-6">
                    <div class="box">
                        <h1>New account</h1>

                        <p class="lead">Not our registered customer yet?</p>
                        <p>What are you waiting ? Join us to get discounts and great deals .. </p>
                        <p class="text-muted">If you have any questions, please feel free to <a href="contact.php">contact us</a>, our customer service center is working for you 24/7.</p>

                        <hr>

                         <form action=" " method="post" id="SubmitForm" class="register">
						 <span id="register"></span>
                            <div class="form-group">
                                <label for="name">Name</label>
                             <input type="name" class="form-control" name="name" id="name1" />
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="emailid"   id="emailid" />
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password"  id="password" />
                            </div>
                            <div class="text-center">
							
                 <input type="button" onclick="action_submit()" class="btn btn-primary" value="register" />
								
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box">
                        <h1>Login</h1>

                        <p class="lead">Already our customer?</p>
                        <p class="text-muted">Use this form to login.</p>

                        <hr>
						
                        <form action=" " id="LoginForm"  method="post" class="login">
						<span id="login"></span>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="emailid"   id="email" />
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password"  id="passwordn" />
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
 function action_submit()
 	{
		
		/* alert('action_submit');  */
		
		
		 var name1= document.getElementById('name1').value;
		 /* alert('name1'); */
 		 var emailid= document.getElementById('emailid').value;
		 var password= document.getElementById('password').value;
		 /* alert('password'); */
		 
		$.ajax({
				type: 'post',
				url:'ajax.php',
				data:{
					action           :"action_submit",
					  name		 :	name1,
					emailid		     :	emailid,
					password         :  password,
				},
				success: function( data){
					/* alert(data); */
					
		if(data==1){
						$("#register").html('<p style="color:green;">Submit successfully.</p>');
						document.getElementById('SubmitForm').reset();
						window.location.href="customer-orders.php";
						
				}
				else{
					$("#register").html(data);
				}
				}
		});
	}
	
function action_login()
 	{
		
		/* alert('action_login'); */ 
		
		
		
 		 var email= document.getElementById('email').value;
		 /* alert('email'); */
		 var passwordn= document.getElementById('passwordn').value;
		  /* alert('passwordn'); */
		 
		$.ajax({
				type: 'post',
				url:'ajaxlog.php',
				data:{
					action           :"action_login",
					
					emailid		     :	email,
					password         :  passwordn,
				},
				
				success: function( data){
					 alert(data);
 
					
		if(data==1){
						$("#login").html('<p style="color:green;">Login successfully.</p>');
						
						 window.location.href="checkout1.php?id=<?php echo $iList['id']; ?>";
						
						
				}
				else{
					$("#login").html(data);
				}
				}
		});
	}	
	
	
</script>


</body>

</html>