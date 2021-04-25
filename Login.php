
<?php
session_start();

             $passErr = $RegErr="";
             $regno =$name=$dbpass= $pass ="";
			 
			 if ($_SERVER["REQUEST_METHOD"] == "POST") {
			 if (empty($_POST["register_num"])) {
               $RegErr = "Register Number required";
            }else {
               $regno = test_input($_POST["register_num"]);
            }
			if (empty($_POST["password"])) {
               $passErr = "Password is Required";
            }else {
               $pass = test_input($_POST["password"]);
			   if(strlen($pass)<6)
			   {
				   $passErr="Must contains 6 characters";
			   }
            }
        }
		function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }
		  $con=mysqli_connect("localhost","Projectphp","php123!@#","Your Database Name");
		if(isset(($_POST['Login'])))
		{
			
		    $query2="select * from students where RegisterNumber='{$regno}';";
			$result=mysqli_query($con,$query2);
             if(mysqli_num_rows($result)>0)
             {
	             while($row = mysqli_fetch_assoc($result))
			 		{
						$_SESSION["RegisterNumber"]=$regno;
						$name=$row["Name"];
						$_SESSION["Name"]=$name;
                       $dbpass=$row["Password"];
                     }
                  }
				  if($pass==$dbpass)
				  {
					 header("Location:chat.php");
				  }
				  else
				  {
					  echo '<script>alert("Please Enter Valid Credentials")</script>';
				  }
		}
		         
  
?>

<html>
    <head>
        <title>Login Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://kit.fontawesome.com/7379abcdff.js" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<style>
		.container_decor{
		background-color:#19191b;
		}
		#log{
		  
		  text-align:center;
		  color:#3e9fd5;
		  font:small-caps bolder 28px arial;
		}
		#log1{
		 text-align:center;
		  color:#ffffff;
		  font:small-caps bolder 28px arial;
		
		}
		form{
		width: 100%;
        margin: 0 auto;
	    height:150 px;
	    padding:50px 0;
	    align-items:center;
	    justify-content: space-around;
        display: flex;
        float:none;
		}
		
		
		.error {color: #FF0000;}
		.footer{
	  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  background-color: red;
  color: white;
  text-align: center;
}
body{
	background-image:url('https://cdn.hipwallpaper.com/i/66/96/InEKeg.jpg');
}
		
		
		</style>
    </head>
    <body >
	
	<div class="container-fluid container_decor">
	<h2 id="log"> Login</h2>
	</div>
	<form method="post" action = "<?php 
         echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<div class="col-xs-4">
	<div class="panel panel-primary">
	<div class="panel-heading text-center">
	<i class='fas fa-user-circle' style='font-size:60px;color:white'></i>
	</div>
	<div class="panel-body">
	<div class="form-group">
	<i class='fas fa-user-circle' style='font-size:15px'></i>
	  <label for="register number"> Register Number</label>
	  <input type="text" name="register_num" class="form-control input-lg" placeholder="Register Number" id="reg_no" required="required">
	  <span class = "error">* <?php echo $RegErr;?></span>
	</div>
	<div class="form-group">
	<i class='fas fa-user-lock' style='font-size:15px'></i>
	  <label for="password"> Password</label>
	  <input type="password" name="password" class="form-control input-lg" placeholder="password" id="pass" required="required">
	  <span class = "error">* <?php echo $passErr;?></span>
	</div>

	<input type="Submit" value="Login" name="Login" id="bt_sub" class="btn btn-primary btn-block"><br>
	<p>If you forget the password</p><i class='fas fa-user-cog' style='font-size:15px'></i><a href="Resetpass.php">Forget Password</a><br><br>
	<p>If You dont have an account</p><i class='fas fa-user-plus' style='font-size:15px'></i><a href="Signup.php">Create New</a>
	</div>
	</div>
	</div>
	</form>
	<div class="footer">
<p>Ramalingasamy M K</p>
<p>Copyright © 2020, Ramalingasamy M K</p>
</div>
    </body>
</html>
