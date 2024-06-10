<?php
include("inc/nav.php");
include("inc/dbsetting.php");

 
//session_start();
	if($_SESSION["login"] != 1000)
	{
	header("location:login.php");
	//$_SESSION["uid"] = $_SESSION["uid"];
	}

		if (isset($_POST["searchbtn"])) //search button
		{

			$sql1 ="SELECT *, DATE_FORMAT(letter_date, '%d-%m-%Y') AS formatted_date FROM letter_table INNER JOIN type_table ON letter_table.type_id=type_table.type_id";
	//}		
			echo $sql1;
			$field = $_POST["field"];
			$letter_type = $_POST["ltype"];
			$sword = $_POST["sword"];			
			$str = "";
			/*if(strlen($sword)>0)
			{
				$str = $field . " LIKE '%" . $sword . "%' ";
			}*/
			if ($field ==="general") {
				$str =" (letter_table.letter_number LIKE '%" . $sword . "%' OR letter_table.letter_title LIKE '%" . $sword . "%' OR letter_table.dep_person LIKE '%" . $sword . "%')";
			}
			else if ($field ==="letter_number") {
				$str=" letter_table.letter_number LIKE '%" . $sword . "%'";
			}
			else if ($field ==="letter_title") {
				$str=" letter_table.letter_title LIKE '%" . $sword . "%'";
			}
			else if ($field ==="dep") {
				$str=" letter_table.dep_person LIKE '%" . $sword . "%'";
			}
			
			if(strlen($letter_type)>0 && $letter_type !=="ALL") 
			{
				$str .= " AND type_table.letter_type='" . $letter_type . "'";
			}
			else if ($letter_type ==="ALL") {
				
			}
			

			$sql1 .= " WHERE " . $str . " ORDER BY rec_id;";

		}
		else
		{
			$sql1= "SELECT *, DATE_FORMAT(letter_date, '%d-%m-%Y') AS formatted_date FROM letter_table INNER JOIN type_table ON letter_table.type_id=type_table.type_id ORDER BY rec_id;";
		}
		
		$result1 = $dbconn -> query($sql1);

?>
<head>
  		<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<style type="text/css">
	.displaytable{
      width: 100%;
      border: solid 2px;
      background: #fce1ca;
    }
    body {
            background-image: url('images/pwbg.jpg');
            background-size: cover; /* ensure the image covers the entire background */
            background-repeat: no-repeat; /* prevent the image from repeating */
            background-attachment: fixed; /* fixed background position */
        }
    table{
	    border-spacing: 0;
	    border: 2px solid;
	    box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
	    /*border-collapse:separate;*/
	    border-radius:6px;
    }
    th{
    	text-align: center;
    	border: 2px solid;
    	height: 40px;
    	padding: 10px;
    	font-size: 18pt;
    	

    }
    td{
    	width: 12%;
    	border: 2px solid;
    	padding: 10px;
    	font-size: 15pt;
    
    }
    tr {
   	width: 10%;
    border: 2px solid;
	}
	td:first-child, th:first-child {
     border-left: none;
}
	
	/*table {
    border-collapse:separate;
    border:solid black 1px;
    border-radius:6px;
}

td, th {
    border-left:solid black 1px;
    border-top:solid black 1px;
}

th {
    background-color: blue;
    border-top: none;
}

td:first-child, th:first-child {
     border-left: none;
}*/
	#actiontd{
		text-align: center;
	}
  
    /*#displaybd{
    	background: linear-gradient(300deg, #79ed77, #eddb77);
    }*/
    .sel{
    	border-radius: 15px;
    }
    .container{
    	margin-top: 4%;
    }
    #formd{
    	margin-left: 10%;
    }
    .btnd{
    	border-radius: 15px;
    }
	.modal-lg {
	    max-width: 90%;
	    margin: auto;
	}

	.modal-body {
	    max-height: 90%;
	  
	}
	#actth{
		width: 13%;
	}
	.edbtn{
		width: 70px;
		margin-bottom: 8%;
	}

	#pdfViewer {
	    width: 100%; 
	    height: 100%; 
	}
	@media (max-width: 750px){
		#formd{
		 padding: 10px;
         margin-top: 30%;
         margin-left: 30%;
		}
		#tablebox{
			padding: 10px;
			margin-top: 20%;
		}
		.srbox{
			margin-bottom: 3%;
		}

	}

</style>
</head>
<body id="displaybd">
	<p style="text-align: right; padding: 10px; margin-top: 7%;">
		<?php
		echo "User Id=" . $_SESSION["uid"];

		?>
	</p>
	<div class="container">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="formd" class=
			"was-validated" >
    		<div class="row">
		        <div class="col-lg-3 srbox">
		        	<select class="form-control sel" name="field">
		        		<option value="general">General</option>
		                <option value="letter_number">Letter Number</option>
		                <option value="letter_title">Letter Title</option>
		                <option value="dep">Department</option>
		            </select>		            
		        </div>

		        <div class="col-lg-2 srbox">
		        		<select class="form-control sel" name="ltype">
		        			<option value="ALL">ALL</option>
							<?php
						    
						    $sql = "SELECT * FROM type_table ORDER BY letter_type;";
						    $result = $dbconn->query($sql);

						    
						    if ($result->num_rows > 0) {
						        while ($row1 = $result->fetch_assoc()) {
						            
						            //$selected = ($row["type_id"] == $row1["type_id"]) ? " selected" : "";
						            echo "<option value='" . $row1['type_id'] . "'>" . $row1['letter_type'] . "</option>";
						        }
						    }
							?>
		            	</select> 
		        </div>
		   
		        <div class="col-lg-4 srbox">
		        	<input type="text" class="form-control" placeholder="Search" name="sword">
		        </div>
		        <div class="col-lg-3">
		        	<button type="submit" class="btn btn-dark btnd" name="searchbtn">Search</button>&nbsp;
		            <button type="reset" class="btn btn-dark btnd" onclick="location.href='display.php';">Cancel</button>
		        </div>
		    </div>
    	</form>
    	<div id="tablebox">
	    	<center>
				<h1>Here is Letter List</h1><br>
				
					<?php
						
						//$datesql = "SELECT *, DATE_FORMAT(letter_date, '%d-%m-%Y') AS formatted_date FROM letter_table INNER JOIN type_table ON letter_table.type_id=type_table.type_id ORDER BY rec_id;";
						//$result1 = $dbconn -> query($sql1);
						if ($result1->num_rows > 0) 
						{
							
							echo "<table class='table-bordered displaytable'><tr>";
							echo "<th>Letter Date</th><th>Letter Number</th><th>Letter Title</th><th>Letter Type</th><th>Department Person</th><th>Filename</th><th id='actth' >Action</th>";
	    					echo "</tr>";

	    						//table rows
	    						while ($row = $result1->fetch_assoc()) 
	    						{
	        					echo "<tr>";
	        					echo "<td>" . $row["formatted_date"] . "</td>";
	        					echo "<td>" . $row["letter_number"] . "</td>";
	        					 echo "<td><a href='#' class='pdflink' data-pdf='" . $row["filename"] . "' data-toggle='modal' data-target='#pdfModal'>" . $row["letter_title"] . "</a></td>";
	        					echo "<td>" . $row["letter_type"] . "</td>";
	        					echo "<td>" . $row["dep_person"] . "</td>";
	        					echo "<td>" . $row["filename"] . "</td>";
	 
	        					echo "<td id='actiontd'><button style='border_radius:10px;' data-id='" . $row["rec_id"] . "' class='btn btn-dark edbtn'>Edit</button><br>
	        					 <button style='border_radius:10px;' del-id='" . $row["rec_id"] . "' class='btn btn-danger delbtn'>Delete</button></td>";
	        					echo "</tr>";
	    						}
	    							echo "</table>";					

						}											
					?>
			</center>
		</div>
			<!-- PDF Modal -->
				<div class="modal" id="pdfModal">
				    <div class="modal-dialog modal-lg" role="document">
				        <div class="modal-content">
				            <div class="modal-header">
				                <h5 class="modal-title">Letter Title</h5>
				                <button type="button" style="margin-left: 90%;" class="btn btn-danger closebtn" data-dismiss="modal">Close
				                </button>
				            </div>
				            <div class="modal-body" id="Mbody">		
				            	<iframe id="pdfViewer" src="" style="width: 100%; height: 800px; border: none;"></iframe>	
				            </div>
				        </div>
				    </div>
				</div><br><br><br><br><br><br><br><br>

				<script type="text/javascript">
		$(document).ready(function(){
			$(".edbtn").click(function(){
				var id = $(this).attr("data-id");
				location.href= "edit.php?id=" + id; 

			});
			$(".delbtn").click(function(){
				if (!confirm("Are you sure?")) return; 
				var delid = $(this).attr("del-id");
				location.href= "delete.php?id=" + delid;
			
		});
			/*$(".pdflink").click(function() {
			    var pdfpath = $(this).attr('data-pdf');
			    var viewpdf = '<object data="' + 'uploadedfiles/' + pdfpath + '" type="application/pdf" width="90%" height="90%"></object>';
			    alert(viewpdf);
			    $("#Mbody").html(viewpdf);
			    $("#pdfModal").show();

			    $(".closebtn").click(function(){
			    	$("#pdfModal").hide();
			    });
			});*/

			$('.pdflink').click(function() {
            var pdfpath = $(this).attr('data-pdf');
            alert(pdfpath);
           // var viewpdf = '<iframe id="pdfViewer" src="' + 'uploadedfiles/' + pdfpath + '" style="width: 100%; height: 800px; border: none;"></iframe>';
           $("#pdfViewer").attr("src", 'uploadedfiles/' + pdfpath);
             alert(viewpdf);
            $("#Mbody").html(viewpdf);
            $("#pdfModal").modal('show');

            $(".closebtn").click(function(){
			    	$("#pdfModal").modal('hide');
			    });
        });

		});
	</script>
		</div>
	
	</body>