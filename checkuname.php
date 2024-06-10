<?php
		include("inc/dbsetting.php");
		if (isset($_POST["usrname"])) {
			$usrname =$_POST["usrname"];
			$sql1="SELECT * FROM user_table WHERE username='" . $usrname . "';";
			$result1 = $dbconn->query($sql1);
			echo $result1->num_rows;
		}
?>