  <?php
include("inc/nav.php");
include("inc/dbsetting.php");
//session_start();
 if (isset($_POST["logsub"])) {
 	$password = md5($_POST["passlog"]);
 	$sql = "SELECT * FROM user_table WHERE username='" . $_POST["userlog"] . "' AND password='" . $password . "';";
 	
 	$result = $dbconn->query($sql);	
 	if ($result->num_rows > 0)
 	{

 		$_SESSION["login"] = 1000;


 		
 		while ($row = $result->fetch_assoc()) 
 		{
			$_SESSION["fullname"] = $row["fullname"];
	 		$_SESSION["usrname"] = $row["username"];
	 		$_SESSION["usrlevel"]= $row["level_id"];
	 		$_SESSION["uid"]= $row["user_id"];
 		}

 			header("location:display.php");
 	}	
 	if ($result->num_rows == 0) {
 		echo "<script> alert('Worng UserName or Password!');</script>";
 	}
 	
 }
?>
<style type="text/css">
	.loginbox{
		box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
		background-color: #dce3fc;
		margin-top:13%;
		border-radius:30px;
		padding: 20px;
		width: 35%;
		min-width: 350px;
		justify-content: center;
		background: linear-gradient(245deg, #f7b094,#fce4ac);
	}
	body {
            background-image: url('images/login.jpg');
            background-size: cover; /* ensure the image covers the entire background */
            background-repeat: no-repeat; /* prevent the image from repeating */
            background-attachment: fixed; /* fixed background position */
        }
	#btncheck{
		width: 150px; 
		height: 28px; 
		border-radius: 10px; 
	}
	.inbox{
		min-width: 150px;
		max-width: 500px;

	}
	#mycontent{
		padding-left: 20px;
	}
	/*#loginbd{
		background: linear-gradient(275deg, #76c0f5, #d7aefc);
		background:  #faf1c5;
	}*/
	@media (max-width: 720px) {
            .loginbox { 
                padding: 10px;
                margin-top: 45%;

            }
            label{
                font-size: 16pt;
            
            }
            h2{
                font-size: 20pt;
            }
         }

</style>
<body id="loginbd">
	<div class="container-sm loginbox">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="was-validated">
			<h2 style="padding: 8px;"><center>Log In Form</center></h2><br><br>
			<div id="mycontent">
				<label for="text">Enter Username:</label><br>
					<span id="msg"></span><br>
						<input type="text" class="form-control inbox" id="ulog" placeholder="Your Username" 
					name="userlog" required autocomplete="off" autofocus><br>
				<label for="text">Enter Your Password:</label>
					<input type="Password" class="form-control inbox" id="plog" name="passlog"><br>

						<button type="submit" name="logsub" style="border-radius: 10px;" class="btn btn-dark">Log In</button>
					
			</div>
	    </form>
</div><br><br>
</body>