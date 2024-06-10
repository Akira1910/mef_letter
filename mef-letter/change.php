<?php
		session_start();
		include("inc/dbsetting.php");
		if (isset($_POST["pwsub"])) {
			if($_SESSION["uid"]) $uid = $_SESSION["uid"];
			$change = md5($_POST["conpw"]);
			$sql1="UPDATE user_table SET password='" . $change . "' WHERE user_id=" . $uid . ";";
			$result1 = $dbconn->query($sql1);
			if($result1 > 0){
				header("location:logout.php");
			}
			
		}
?>