
<?php
include("inc/nav.php");
include("inc/dbsetting.php");
//session_start();
 if($_SESSION["login"] != 1000 || strpos($_SESSION["usrlevel"], "|60")< -1)
 {	 
	header("location:index.php");
 }
//$usrlevel = $_SESSION["usrlevel"];


?>   

<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	
<style type="text/css">
	
	body 
    {
        background-image: url('images/entry.jpg');
        background-size: cover; /* ensure the image covers the entire background */
        background-repeat: no-repeat; /* prevent the image from repeating */
        background-attachment: fixed; /* fixed background position */
        }
	.formbox{
		box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
		margin-top:10%;
		border-radius:30px;
		padding: 20px;
        width: 50%;
        min-width: 350px;
        justify-content: center;
        background: linear-gradient(300deg, #f7b69e, #f7f69e);

	}
    	.eyeclass {
      position: absolute;
      right: 9px;
      z-index:999;
      top: 3px;

    }
    .inbox{
        min-width: 250px;
        max-width: 700px;

    }
    #mycontent{
        padding-left: 20px;
    }
    label{
        font-size: 18pt;
    }
    @media (max-width: 720px) {
            .formbox { 
                padding: 10px;
                margin-top: 45%;
            }
            label{
                font-size: 16pt;
            
            }
            h2{
                font-size: 20pt;
            }
            #levelbtn{
                margin-top: 5%;
            }
            #clear{
                margin-top: 5%;
            }
        }
</style>
</head>


<body id="entrybd">


<div class="container-sm formbox">
    

	<form action="submit.php" method="POST" class="was-validated">
		<h2 style="margin-top: 8px;"><center>User Account Form</center></h2><br><br>

		<div id="mycontent">
			<label for="text">Full Name:</label><br>
				<input type="text" class="form-control inbox" id="memname" placeholder="Your Name" name="memname" required autofocus><br>
			<label for="text">User Name:</label>
				<span id="msg"></span><br>
				<input type="text" class="form-control inbox" id="usrname" placeholder="Your Username" 
				name="usrname" autocomplete="off" required><br>
					<button id="btncheck" style="width: auto; height: 38px; border-radius: 10px;" type="button" class="btn btn-dark" name="cbtn">Check Username</button><br><br>
       <label for="text">Choose User Level:</label><br>
   <select name="levelsel" id="levelsel" style="width: 200px; height: 35px; border-radius: 15px;" class="inbox" required>
    <option value=''>Select Level</option>
     <?php
       
       $sql = "SELECT * FROM level_table ORDER BY lvl_id";
       $result = $dbconn->query($sql);

       
       if ($result->num_rows > 0) {
           while ($row1 = $result->fetch_assoc()) {
               
               //$selected = ($row["type_id"] == $row1["type_id"]) ? " selected" : "";
               echo "<option value='" . $row1['level_id'] . "'>" . $row1['description'] . "</option>";
           }
       }
     ?>
   </select>
     <button type="button" name="levelbtn" id="levelbtn" style="border-radius: 10px;" class="btn btn-dark">Add Level</button><br><br>
     <input type="text" name="levelinput" id="levelinput" style="border-radius:  10px;" class="form-control" required readonly>&nbsp;
     <button type="button" style="border-radius: 15px; margin-top:10px;" name="clear" id="clear" class="btn btn-danger">Clear</button>
     <br><br>
     <input type="hidden" name="lvlhidden" id="lvlhidden" required>  
			<label for="text">Password:</label><br>
				<div class="input-group mb-3">
    				<input type="password" class="form-control inbox" id="entrypw" placeholder="Your Password" name="entrypw" autocomplete="off" required minlength="5">
    					<div class="form-controlinput-group-append">
       						<span class="input-group-text eyeclass"><i id="togglePassword" class="fa fa-eye"></i></span>
    					</div>
				</div><br>
			<label for="text">Confirm Password:</label>
			<span id="pwmsg"></span><br>
				<input type="password" class="form-control inbox" id="conpw" placeholder="Your Password" 
				name="conpw" required minlength="5"><br>
			<label for="text">Department:</label><br>
				<input type="text" class="form-control inbox" id="department" placeholder="Your Department Name" name="department"><br><br>
		
					<button type="submit" style="border-radius: 10px;" id="esub" name="entrysub" 
					class="btn btn-dark">Submit Form</button>
					<button type="Reset" style="margin-left:30px; border-radius: 10px;" class="btn btn-dark">Reset All</button>
		</div>
    </form>
</div><br><br><br><br><br>
<script type="text/javascript">
    var sp;
    var mval = "";
    var myvalue="";
$(document).ready(function(){
    $("#togglePassword").click(function() {
        var pwField = $("#entrypw");
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

    $("#esub").click(function(){
        var password = $("#entrypw");
        var conpass = $("#conpw");

          if (password.val().length < 5) {
        $("#pwmsg").html("<font color='red'>Password must be at least 5 characters long!</font>");
        return false;
    }

        if (password.val() !== conpass.val()) 
        {
            $("#pwmsg").html("<font color='red'>Passwords must be the same!</font>");
            return false;
        }
        else
        {
            $("#pwmsg").html("<font color='green'>Confirm Successful!</font>");
        }
    });

    $("#btncheck").click(function(){
        var getname = $("#usrname").val();
        $.ajax({
            type:"POST",
            url: "checkuname.php",
            data:"usrname=" + getname,
            success: function(data){
             //alert(data);
                if (data ==1) {
                    $("#msg").html("<font color='red'>Username Already Exist!</font>");
                }
                else{
                    //chkval = 1;
                    $("#msg").html("<font color='green'>Username Avaliable.</font>");
                }
            } 
        });
    });

    $("#levelbtn").click(function(){
    
    var addlevel = $("#levelsel option:selected").text();
    var value = $("#levelsel").val();
	if(value=='') return;
    mval += $("#levelinput").val().length >0 ? ", " + addlevel : addlevel;
    $("#levelinput").val(mval);
    myvalue += value;
    $("#lvlhidden").val(myvalue);
    //alert(myvalue);
});
     $("#clear").click(function(){
        $("#levelinput").val("");
        mval = "";
      });

});

</script>

</body>