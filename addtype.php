<?php
include("inc/dbsetting.php");
$val = 0;
	$addltype = $_POST["addltype"];
	$sql3= "INSERT INTO type_table (letter_type) VALUES('$addltype');";
	$result3 = $dbconn->query($sql3);
	if ($result3) {
		$val = 1;

	}
	echo $val;
	
?>