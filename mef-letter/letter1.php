<?php
include("inc/nav.inc");
include("inc/dbsetting.php");
?>
<head>
	<link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style type="text/css">
	.letterbox{
		box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
		background-color: #d0f5ef;
		margin-top:15%;
		border-radius:30px;
		padding: 20px;
		width: 800px;

	}
	.inbox{
		min-width: 300px;

	}
	label{
		font-size: 18pt;
	}
	#letterbd{
		background: linear-gradient(255deg, #8ee0f5, #93f5cf);
	}
	@media (max-width: 770px) {
            .letterbox {
                width: 90%; 
                padding: 1px;
                margin-top: 50%;

            }
            label{
            	font-size: 13pt;
            	/*margin-right: 30%;*/
            }
            h2{
            	font-size: 18pt;
            }
            .inbox{
				width: 90%;
				height: 5%;
				padding: 1px; 
			}
			input{
				width: 20px;

			}
        }

</style>
<!--<link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

</head>
<body id="letterbd">
	<div class="container-sm letterbox">
		<form action="submit.php" method="POST" class="was-validated" enctype="multipart/form-data">
			<h2 style="padding: 8px;"><center>Letter Form</center></h2><br><br>
			<div style="padding-right: 100px; padding-left: 150px;">
				<label for="text">Enter Letter Date:</label><br>
					<!--<input type="date" class="form-control date inbox" id="letterdate" name="letterdate"><br>-->
					<div class="input-group" data-date-format="dd-mm-yyyy"> 
						<input  id="txtDate" class="form-control date" name="letterdate" type="text" readonly required /> 
						<label class="input-group-btn" for="txtDate">
							<span class="btn btn-default">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</label>
					</div><br>
				<label for="text">Enter Letter Number:</label>
					<input type="text" class="form-control" id="letternum" name="letternum"><br>
				<label for="text">Enter Letter Title:</label><br>
					<textarea class="form-control inbox" rows="4" id="lettertitle" name="lettertitle"></textarea><br>
				<label for="text">Letter Type:</label><br>
					<select name="seltype" id="seltype" class="form-control inbox">
					  <option value="IN">IN</option>
					  <option value="OUT">OUT</option>
					</select><br>
				<label for="text">Enter Department Person:</label><br>
					<textarea class="form-control inbox" rows="3" id="ldep" name="letterdep"></textarea><br>
				<label for="text">Upload File:</label><br>
					<input type="file" class="form-control inbox" id="upf" name="upfile"><br><br>
						<button type="submit" name="lettersub" style="border-radius: 10px;" class="btn btn-dark">Submit Form</button>
					
			</div>
	    </form>
	    
	    
</div><br><br><br><br><br><br><br><br>
  <script type="text/javascript">
        $(function () {
            $('#txtDate').datepicker({  
			    format: "dd-mm-yyyy",
                autoclose: true,  
                todayHighlight: true, 
                todayBtn : "linked", 
                title : "Letter In/Out Date" 
            }).datepicker('update', 'new Date()'); 
        });	
    </script>
</body>