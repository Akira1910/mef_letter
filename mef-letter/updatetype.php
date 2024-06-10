<?php
include("inc/dbsetting.php");
$addvalue = $_POST["addval"];
	$sql= "SELECT * FROM type_table ORDER BY letter_type;";
		$result = $dbconn -> query($sql);
			echo '<select name="seltype" id="seltype" class="form-control inbox">';
						    
			    if ($result->num_rows > 0) {
			        while ($row1 = $result->fetch_assoc()) {
			            
			        $selected = $row1["letter_type"] == $addvalue ? " selected" : "";
			        echo "<option value='" . $row1['type_id'] . "' $selected>" . $row1['letter_type'] . "</option>";
			        }
			    }	
				echo '</select>';
?>