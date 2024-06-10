<?php
include("inc/dbsetting.php");
$udelid =0;
if (isset($_GET["userid"])) {
	$udelid =$_GET["userid"];
	$sql= "DELETE FROM user_table WHERE user_id =" . $udelid;
	$result1= $dbconn->query($sql);
	if ($result1) {
		header("location:userlist.php");
	}
	else
	{
		echo "delete errors";
	}
}

?>