<?php
include("inc/dbsetting.php");
$delid =0;
if (isset($_GET["id"])) {
	$delid =$_GET["id"];
	$sql= "DELETE FROM letter_table WHERE rec_id =" . $delid;
	$result1= $dbconn->query($sql);
	if ($result1) {
		header("location:display.php");
	}
	else
	{
		echo "delete errors";
	}
}

?>