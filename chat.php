<?php

  session_start();
  
    $msgErr="";
    $msg=$msgalert="";
    $user=$usermsg="";
    $loginErr="";
	if (!isset($_SESSION["RegisterNumber"]) && !isset($_SESSION["Name"])) 
	{ 
    $loginErr = "You have to log in first"; 
	header('location: Login.php');
	}
	   if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
		  if (empty($_POST["message"]))
		   {
               $msgErr = "messagerequired";
           }
		  else
		   {
               $msg = test_input($_POST["message"]);
           }
		}
		function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }
	
	if(isset(($_POST['send'])))
	{	 $con=mysqli_connect("localhost","Projectphp","php123!@#","gceb");
		$query="insert into chat values('{$_SESSION["Name"]}','{$msg}')";
		if(mysqli_query($con,$query))
		{
           $msgalert='<script>alert("Sent Successfull")</script>';			
		}
		else
		{
			$msgalert='<script>alert("Sent UnSuccessfull")</script>';
		}
			  
	}
	if(isset($_POST['Logout'])) {
    session_destroy();
    unset($_SESSION['Name']);
    header('location:Login.php');
}


?>
<html>
<head>
<title>Chat</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://kit.fontawesome.com/7379abcdff.js" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<style>
.chat
{
 background-image:url('https://wallpaperaccess.com/full/2224414.jpg');
  width: 425px;
  height: 400px;
  overflow: auto;
  margin:auto;
  border: 3px solid black;
  width:50%;
  padding:10px;
}
body{
	background-image:url('https://wallpaperaccess.com/full/2224414.jpg');
}
form{
	margin:auto;
	width:50%;
	
}

#chathead{
	text-align:center;
	background-color:#6a6eec;
	padding:20px;
	

}
hr{
	border: 0.5px solid red;
}
.tophead
{
	color:#ffffff;
	text-align:right;
	background-color:#6a6eec;
	padding:40px;
}
.footer{
	  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  color: white;
  text-align: center;
  padding:5px;
  
}.btt{
	padding:4px;
}
</style>
<div class="tophead">

<h1 style="text-align:center"><i class='far fa-comment-dots' style='font-size:52px;color:black'></i>  Simple Group Chatting Application</h1><p><b>User Name : <?php echo($_SESSION["Name"]);?></b></p>
<form style="float:right" method="post" action="<?php 
         echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
		 <input type="submit" value="LOGOUT" name="Logout" class="btn btn-danger">
		
</form>
<form style="float:right" method="post" action="users.php">
		  <input type="submit" value="View Users" name="users" class="btn btn-success">
		
</form>
</div>
<body >

<div class="chat" >
<div id="chathead">
<h3 style="font-weight:800;">Happy Chatting  <?php echo ($_SESSION["Name"]);?></h3></div>
<hr><br>
<?php

 $con=mysqli_connect("localhost","Projectphp","php123!@#","gceb");
 $q="select usrname,message from chat";
	$result=mysqli_query($con,$q);
	if(mysqli_num_rows($result)>0)
	{
		
		while($row=mysqli_fetch_assoc($result))
		{
			$user=$row["usrname"];
			$usermsg=$row["message"];
			if($_SESSION['Name'] == $user)
			{
				
echo '<div style="background: rgb(174,183,238);
background: linear-gradient(90deg, rgba(174,183,238,1) 6%, rgba(217,235,123,0.9752275910364145) 71%);
border-radius:20px;margin-left:400px;
padding:5px;
margin-bottom:5px;


      ">';
echo '<h4 style="color:blue;float:right;"><b>You</b></h4><br><br>';
   echo '<div style="width:100%;padding:20px;word-wrap: break-word;">'.$usermsg.'</div>';
echo '</div>';
}
else
{
echo '<div style="background: rgb(34,193,195);width=50px;
background: linear-gradient(0deg, rgba(34,193,195,1) 0%, rgba(253,188,45,1) 100%);
border-radius:20px;
margin-right:400px;
margin-bottom:5px;
padding:5px;
">';
  echo '<h4 style="color:red;float:left"><b>'.$user.'</b></h4><br><br>';
  echo '<div style="width:100%;padding:20px;word-wrap: break-word;">'.$usermsg.'</div>';
  echo '</div>';
}
		}
		
	}
	?></div>

<div class="footer">
<form method="post" action="<?php 
         echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<div class="form-group">
<input  type="text" name="message" class="form-control input-lg" placeholder="Enter Your Message" required>
<div class="btt">
<input  type="submit" value="Send" name="send" id="sendmessage" class="btn btn-primary">
</div>
<span><?php echo $msgalert; ?></span>
</div>

</div>

</form>

</div>
</body>
</html>