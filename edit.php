
<?php
include("inc/nav.php");
include("inc/dbsetting.php");
$id =0;
if (isset($_GET["id"])) {
	$id =$_GET["id"];
	$datesql = "SELECT *, DATE_FORMAT(letter_date, '%d-%m-%Y') AS formatted_date, DATE_FORMAT(int_out_date, '%d-%m-%Y') AS int_out_date FROM letter_table WHERE rec_id=" . $id;
	$result1= $dbconn->query($datesql); 

	//if ($result1->num_rows > 0) {


?>
<head>
	<link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style type="text/css">
	.letterbox{
		box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
		margin-top:10%;
		border-radius:30px;
		padding: 20px;
		width: 50%;
		height: auto;
		min-width: 350px;
		justify-content: center;
		background: linear-gradient(300deg, #fcd2c0, #ff9d80);
	}
	body {
     background-image: url('images/edit.jpg');
     background-size: cover; /* ensure the image covers the entire background */
     background-repeat: no-repeat; /* prevent the image from repeating */
     background-attachment: fixed; /* fixed background position */
        }
.inbox{
		min-width: 250px;
		max-width: 700px;

	}
	label{
		font-size: 18pt;
	}
	@media (max-width: 750px) {
            .letterbox { 
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
<!--<link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

</head>
<?php
	while($row = $result1->fetch_assoc())
	{ // this loop is end in the end of the code.
?>
<body id="letterbd">
	<div class="container-sm letterbox">
		<form action="edsubmit.php" method="POST" class="was-validated" enctype="multipart/form-data">
			<h2><center>Edit Letter Form</center></h2><br><br>
			<div>
				<label for="text">Letter Date:</label><br>
					<div class="input-group" data-date-format="dd-mm-yyyy"> 
						<input  id="txtDate" class="form-control inbox date" name="letterdate" type="text" readonly required value="<?php echo $row["formatted_date"]; ?>"/> 
						<label class="input-group-btn" for="txtDate">
							<span class="btn btn-default">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</label>
					</div><br>			
			
			<div class="mycontent">
				<label for="text">Sent (or) Received Date:</label><br>
					<!--<input type="date" class="form-control date inbox" id="letterdate" name="letterdate"><br>-->
					<div class="input-group" data-date-format="dd-mm-yyyy"> 
						<input  id="txtDate2" class="form-control inbox date" name="in_out_date" type="text" readonly required value="<?php echo $row["int_out_date"]; ?>" /> 
						<label class="input-group-btn" for="txtDate2">
							<span class="btn btn-default">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</label>
					</div><br>
					
					<input type="hidden" name="rec_id" value="<?php echo $id; ?>">
				<label for="text">Letter Number:</label>
					<input type="text" class="form-control inbox" id="letternum" value="<?php echo $row["letter_number"]; ?>" name="letternum"><br>
				<label for="text">Letter Title:</label><br>
					<textarea class="form-control inbox" rows="4" id="lettertitle" name="lettertitle"><?php echo $row["letter_title"]; ?></textarea><br>
				<label for="text">Letter Type:</label><br>
					<select name="seltype" id="seltype" class="form-control inbox">
					    <?php
					    
					    $sql = "SELECT * FROM type_table ORDER BY letter_type;";
					    $result = $dbconn->query($sql);

					    
					    if ($result->num_rows > 0) {
					        while ($row1 = $result->fetch_assoc()) {
					            
					            $selected = $row["type_id"] == $row1["type_id"] ? " selected" : "";
					            echo "<option value='" . $row1['type_id'] . "'" . $selected . ">" . $row1['letter_type'] . "</option>";
					        }
					    }
					    ?>
					</select><br><br>

				<label for="text">Sent to/ Sent from:</label><br>
					<textarea class="form-control inbox" rows="3" id="ldep" name="letterdep"><?php echo $row["dep_person"]; ?></textarea><br>
					<label for="text">Choose File Type:</label><br>
					<select name="filesel" id="filesel" class="form-control inbox">
						<?php
						 $sql = "SELECT * FROM letter_table ORDER BY rec_id;";
					    $result = $dbconn->query($sql);
					    if ($result->num_rows > 0) 
					    {
					    	$choose_type = $row['file_type']== 0 ? "0'>Normal Type</option><option value='1'>Secret Type</option>" : "1'>Secret Type</option><option value='0'>Normal Type</option>";
						 echo "<option value='" . $choose_type;
						
						} 
						?>
						
					</select><br>
				<label for="text">Uploaded File:</label><br>
					<input type="text" class="form-control inbox" id="upf" value="<?php echo $row["filename"]; ?>" name="upfile"><br><br>
				<label for="text">Update File:</label><br>
					<input type="file" class="form-control inbox" id="updatef" name="updatefile">
					<br>
					<label for="text">Remarks:</label><br>
					<textarea class="form-control inbox" rows="3" id="remarks" name="remarks"></textarea><br>
						<button type="submit" name="edbtn" style="border-radius: 10px;" class="btn btn-dark">Update form</button><br />
									
			</div>
	    </form>
	    
	    
</div>
    <?php 
	}
  }


?>


  <script type="text/javascript">
        $(function () {
            $('#txtDate').datepicker({  
			    format: "dd-mm-yyyy",
                autoclose: true,  
                //todayHighlight: true, 
                //todayBtn : "linked", 
                title : "Letter In/Out Date" 
            }); 
        });	
    </script>
</body>