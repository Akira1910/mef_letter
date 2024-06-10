<?php
include("inc/nav.php");
include("inc/dbsetting.php");


?>
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<style type="text/css">
		body {
            background-image: url('images/chgbg.jpg');
            background-size: cover; /* ensure the image covers the entire background */
            background-repeat: no-repeat; /* prevent the image from repeating */
            background-attachment: fixed; /* fixed background position */
        }
        .changebox{
		box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
		margin-top:15%;
		border-radius:30px;
		padding: 30px;
        width: 40%;
        min-width: 350px;
        justify-content: center;
        background: linear-gradient(275deg,#fcb174, #ff8c5e);

	}
	.inbox{
        min-width: 250px;
        max-width: 700px;

    }
    .eyeclass {
      position: absolute;
      right: 9px;
      z-index:999;
      top: 3px;

    }
     @media (max-width: 720px) {
            .changebox { 
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
</head>
<body>
	<div class="container-sm changebox">
	<form action="change.php" method="POST" class="was-validated">
		<h2 style="margin-top: 8px;"><center>Change Password</center></h2><br><br>
		<div id="">
			<label for="text">Enter New Password:</label><br>
				<div class="input-group mb-3">
    				<input type="password" class="form-control inbox" id="chgpw" placeholder="New Password" name="chgpw" required autofocus>
    					<div class="form-control-input-group-append">
       						<span class="input-group-text eyeclass"><i id="togglePassword" class="fa fa-eye"></i></span>
    					</div>
				</div><br>
			<label for="text">Confirm Password:</label>
			<span id="pwmsg"></span><br>
				<input type="password" class="form-control inbox" id="conpw" placeholder="Type Password Again" name="conpw" required><br>
					<button type="submit" style="border-radius: 10px;" id="pwsub" name="pwsub" 
					class="btn btn-dark">Update</button>
					<button type="Reset" style="margin-left:30px; border-radius: 10px;" class="btn btn-dark">Reset All</button>
		</div>
    </form>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		 $("#togglePassword").click(function() {
        var pwField = $("#chgpw");
        var icon = $("#togglePassword");

        if (pwField.attr("type") === "password") 
        {
            pwField.attr("type", "text");
            icon.removeClass("fa-eye").addClass("fa-eye-slash");
        } 
        else 
        {
            pwField.attr("type", "password");
            icon.removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });

    $("#pwsub").click(function(){
        var password = $("#chgpw");
        var conpass = $("#conpw");

        if (password.val() !== conpass.val()) 
        {
            $("#pwmsg").html("<font color='red'>Passwords must be the same!</font>");
            return false;
        }
        else
        {
            $("#pwmsg").html("<font color='green'>Confirm Successful!</font>");
            header("location:display.php");
        }
    });
});
</script>
</body>