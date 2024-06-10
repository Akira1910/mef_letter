<?php
include("inc/nav.php");
include("inc/dbsetting.php");
//session_start();
  if($_SESSION["login"] != 1000 || strpos($_SESSION["usrlevel"], "|70") < -1)
    {
      header("location:index.php");
    }
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
		min-width: 350px;
		justify-content: center;
		background: linear-gradient(275deg, #ffbd96, #fce5c2);
	}
	body {
            background-image: url('images/letter1.jpg');
            background-size: cover; /* ensure the image covers the entire background */
            background-repeat: no-repeat; /* prevent the image from repeating */
            background-attachment: fixed;
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
	/*#letterbd{
		background: linear-gradient(255deg, #efe2ba, #ffbd96);*/
	}
	@media (max-width: 720px) {
            .letterbox{ 
                padding: 100px;
                margin-top: 100%;

            }
            label{
            	font-size: 16pt;
            
            }
            h2{
            	font-size: 20pt;
            }
           /* .inbox{
				width: 90%;
				height: 5%;
				padding: 1px; 
			}
			input{
				width: 20px;

			}*/
        }

</style>
<!--<link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

</head>
<body id="letterbd">
	<div class="container letterbox">
		<form action="lsubmit.php" method="POST" class="was-validated" enctype="multipart/form-data">
			<h2 style="margin-top: 8px;"><center>Letter Form</center></h2><br><br>
			<div class="mycontent">
				<label for="text">Letter Date:</label><br>
					<!--<input type="date" class="form-control date inbox" id="letterdate" name="letterdate"><br>-->
					<div class="input-group" data-date-format="dd-mm-yyyy"> 
						<input  id="txtDate" class="form-control inbox date" name="letterdate" type="text" readonly required /> 
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
						<input  id="txtDate2" class="form-control inbox date" name="in_out_date" type="text" readonly required /> 
						<label class="input-group-btn" for="txtDate2">
							<span class="btn btn-default">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</label>
					</div><br>
				<label for="text">Letter Number:</label>
					<input type="text" class="form-control inbox" id="letternum" name="letternum" required autofocus>
					<br>
				<label for="text">Letter Title:</label><br>
					<textarea class="form-control inbox" rows="4" id="lettertitle" name="lettertitle" required></textarea><br>
				<label for="text">Letter Type:</label><br>
					<span id="mysel">
						<select name="seltype" id="seltype" class="form-control inbox">
						  <?php
						    
						    $sql = "SELECT * FROM type_table ORDER BY letter_type";
						    $result = $dbconn->query($sql);

						    
						    if ($result->num_rows > 0) {
						        while ($row1 = $result->fetch_assoc()) {
						            
						            $selected = ($row["type_id"] == $row1["type_id"]) ? " selected" : "";
						            echo "<option value='" . $row1['type_id'] . "' $selected>" . $row1['letter_type'] . "</option>";
						        }
						    }
						    ?>
						</select></span><br>
						<button type="button" name="addbtn" id="addbtn" style="border-radius: 10px;" class="btn btn-dark">Add More</button><br><br>						
						
			

				<label for="text">Sent to/ Sent from:</label><br>
					<textarea class="form-control inbox" rows="3" id="ldep" name="letterdep" required></textarea><br>
					<label for="text">Choose File Type:</label><br>
					<select name="filesel" id="filesel" class="form-control inbox">
						<option value="0">Normal Type</option>
						<option value="1">Secret Type</option>
					</select><br>
				<label for="text">Upload File:</label><br>
					<input type="file" class="form-control inbox" id="upf" name="upfile"><br><br>
				<label for="text">Remarks:</label><br>
					<textarea class="form-control inbox" rows="3" id="remarks" name="remarks"></textarea><br>					
					
						<button type="submit" name="lettersub" style="border-radius: 10px;" class="btn btn-dark">Submit Form</button>
					
			</div>
	    </form>
	</div>
	    	<div class="modal" id="mymodal">
			    <div class="modal-dialog modal-dialog-centered">
				    <div class="modal-content">	      
				    	<div class="modal-header">
				        	<h4>Add Letter Type</h4>			        
				      	</div>

				     <form>
				      <div class="modal-body" id="mbody">
				      	<input type="text" name="addltype" id="addltype" style="width: 250px;" required>
				      	&nbsp;
				      	<button type="button" style="border-radius: 15px;" name="addtype" id="addtype" class="btn btn-dark">Add</button>
				      	<button type="button" style="border-radius: 15px;" name="clear" id="clear" class="btn btn-danger">Clear</button>
				      	<br><br>
				      	<span id="addmsg"></span><br>
					      	<div>
						      	<select name="updatetp" id="updatetp" class="form-control inbox">
								  <?php
								    
								    $sql = "SELECT * FROM type_table ORDER BY letter_type;";
								    $result = $dbconn->query($sql);

								    
								    if ($result->num_rows > 0) {
								        while ($row1 = $result->fetch_assoc()) {
								            
								            $selected = ($row["type_id"] == $row1["type_id"]) ? " selected" : "";
								            echo "<option value='" . $row1['type_id'] . "|" . $row1['letter_type'] . "' $selected>" . $row1['letter_type'] . "</option>";
								        }
								    }
								    ?>
								</select>
							</div>
				      	
				      </div>

				      
				      <div class="modal-footer">
				        <button type="button" id="closebtn" class="btn btn-danger mclose" data-bs-dismiss="modal">Close</button>
				      </div>
				  	</form>
				  	</div>
				</div>
			</div>

	    
	    

  <script type="text/javascript">
  	var sp;
  	var val1=0;
        $(document).ready(function(){
            $('#txtDate').datepicker({  
			    format: "dd-mm-yyyy",
                autoclose: true,  
                todayHighlight: true, 
                todayBtn : "linked", 
                title : "Letter Date" 
            }).datepicker('update', 'new Date()'); 
			
            $('#txtDate2').datepicker({  
			    format: "dd-mm-yyyy",
                autoclose: true,  
                todayHighlight: true, 
                todayBtn : "linked", 
                title : "Letter In/Out Date" 
            }).datepicker('update', 'new Date()');			

            $("#addbtn").click(function(){
					$("#addtype").text("Add");
					$("#addltype").val("");
            	$("#mymodal").show();


            });
            
      $("#addtype").click(function(){
      	if( $("#addltype").val().length == 0 )
      	{
					alert("Required!");
					return;
				}
				var addletter_type = $("#addltype").val();
				var id = $("#addtype").text() =="Add" ? 0 : sp[0];
				$.ajax({
				type:"POST",
				url: "addtype.php?rid=" + id,
				data:"addltype=" + addletter_type,
				success: function(data)
				{
					//alert(data);
					if (data==1) 
					{
						$("#addmsg").html("<font color='green'>Successful!</font>");
						val1 =1;
					}
				}

				})


			});

              $("#closebtn").click(function(){
			  		$("#mymodal").hide();
			  		$("#addmsg").html("");
			  		var addval = $("#addltype").val();

				$("#addltype").val("");
				if (val1==1){
					$("#seltype").remove();

					$.ajax({
						type:"POST",
						url: "updatetype.php",
						data: "addval=" + addval,
						success: function(data)
						{
							//alert(data);
							$("#mysel").append(data);
							
						}
					})
				}

			    });
              $("#updatetp").change(function(){
              	var upval= $("#updatetp").val();
              	sp = upval.split("|");
              	$("#addltype").val(sp[1]);
              	$("#addtype").text("Update");
              	
              });

              $("#clear").click(function(){
              	$("#addltype").val("");
              	$("#addtype").text("Add");
              });

        });	
    </script>
</body>