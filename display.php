<?php
include("inc/nav.php");
include("inc/dbsetting.php");

 
//session_start();
	
	if($_SESSION["login"] != 1000)
	{
	header("location:index.php");
	//$_SESSION["uid"] = $_SESSION["uid"];
	}
$usrlevel = $_SESSION["usrlevel"];

		$sql1 = "";
		if (isset($_POST["searchbtn"])) //search button
		{

			$field = $_POST["field"];
			$letter_type = $_POST["ltype"];
			$sword = $_POST["sword"];			
			$str = "";
			/*if(strlen($sword)>0)
			{
				$str = $field . " LIKE '%" . $sword . "%' ";
			}*/

			if ($field ==="general" && strlen($sword)>0) {
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
			
			if(strlen($letter_type) > 0 && $letter_type !=="ALL") 
			{
				if(strlen($str)>0) {
				$str .= " AND letter_table.type_id=" . $letter_type;
				} else {
					$str .= " letter_table.type_id=" . $letter_type;
				}
			}
			//else if ($letter_type ==="ALL") {
				
			//}
			

			$where = strlen($str)>0 ? " WHERE " : " ";

			 $sql1 = "SELECT letter_table.*, DATE_FORMAT(letter_table.letter_date, '%d-%m-%Y') AS formatted_date, type_table.letter_type FROM letter_table 
             INNER JOIN type_table ON letter_table.type_id = type_table.type_id" . $where 
             . $str . " ORDER BY rec_id DESC;";
			 
			 echo $sql1 . "ZZZ";
			$result1 = $dbconn -> query($sql1);
			
		}
		else
		{
			$sql1 = "SELECT letter_table.*, DATE_FORMAT(letter_table.letter_date, '%d-%m-%Y') AS formatted_date, type_table.letter_type FROM letter_table 
             INNER JOIN type_table ON letter_table.type_id = type_table.type_id 
             ORDER BY rec_id DESC;";
             $result1 = $dbconn -> query($sql1);
		}
		
		

?>
<head>
  		<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<style type="text/css">
	.closebtn {float: right;}
	.downloadbtn {float: right;}
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
    	
    	border: 2px solid;
    	padding: 5px;
    	font-size: 14pt;
    	vertical-align: text-top;
		text-align:justify;
    
    }
    tr {
   	width: 10%;
    border: 2px solid;
	}

.modal-title{
	text-align: center;
}
	
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
    	margin-top: 15%;
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
		width: 8%;
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
			margin-top: 10%;
		}
		.srbox{
			margin-bottom: 3%;
		}

	}
	
a:link {
  text-decoration: none;
}

a:visited {
  text-decoration: none;
}
#Mbody 
{
	#overflow:hidden;
}		
iframe.desktop {

                top: 0px; 
                left: 0; 
                bottom: 0; 
                right: 0; 
                width: 100%; 
                #height: 100%;
                border: none; 
                margin: 0; 
                padding: 0; 
                overflow: hidden; 
                z-index: 999;
            }
            
            iframe.mobile {

                top: 0px; 
                left: 0; 
                bottom: 0; 
                right: 0; 
                width: 100%;
                max-width: 420px; 
                /* height: 93%; */
                border: none; 
                margin: 0; 
                padding: 0; 
                overflow: hidden; 
                z-index: 999;
            }

</style>
</head>
<body id="displaybd">

	<div class="container">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="formd" class=
			"was-validated" >
    		<div class="row">
		        <div class="col-lg-3 srbox">
		        	<select class="form-control sel" name="field">
		        		<option value="general">General</option>
		                <option value="letter_number">Letter Number</option>
		                <option value="letter_title">Letter Title</option>
		                <option value="dep">Sent or Received</option>
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
		        	<input type="text" class="form-control" placeholder="Search" id="sarea" name="sword" autofocus>
		        </div>
		        <div class="col-lg-3">
		        	<button type="submit" class="btn btn-dark btnd" name="searchbtn">Search</button>&nbsp;
		            <button type="reset" class="btn btn-dark btnd" onclick="location.href='display.php';">Cancel</button>
		        </div>
		    </div>
    	</form>
    	<div id="tablebox">
	    	<center>
				<h1>Letter List</h1>
				
					<?php
						
						if ($result1->num_rows > 0) 
						{

							echo "<h5>(" . $result1->num_rows . " items are found)</h5><br>";
							
							echo "<table class='table-bordered displaytable'><tr>";
							echo "<th>No.</th>
									<th>Letter Date</th>
									<th>Letter Number</th>
									<th>Letter Title</th><th>Letter Type</th>
									<th>Sent or Received</th>
									<th id='actth' >Action</th>";
	    					echo "</tr>";
	    						$number=1;
	    						//table rows
	    						while ($row = $result1->fetch_assoc()) 
	    						{
	        					echo "<tr>";
	        					echo "<td width=3% style='padding:6px;'>" . $number . "</td>";
	        					echo "<td width=10%>" . $row["formatted_date"] . "</td>";
	        					echo "<td width=18%>" . $row["letter_number"] . "</td>";
	        					echo "<td>";
	        					 if (strpos($usrlevel, "|30") > -1 && strpos($usrlevel, "|50") < -1 && $row["file_type"] == 0) 
	        					 {
	        					 echo"<a href='#' class='pdflink' data-pdf='" . $row["filename"] . "' data-toggle='modal' data-target='#pdfModal'>" . $row["letter_title"] . "</a>";
	        					}
	        					else if(strpos($usrlevel, "|50") > -1 && strpos($usrlevel, "|30") > -1 && ($row["file_type"] == 1 || $row["file_type"] == 0))
	        					{
	        						echo"<a href='#' class='pdflink' data-pdf='" . $row["filename"] . "' data-toggle='modal' data-target='#pdfModal'>" . $row["letter_title"] . "</a>";
	        					}
	        					else
	        					{
	        						echo "<p>" . $row["letter_title"] . "</p>";
	        					}
	        					 echo "</td>";
	        					
	        					echo "<td>" . $row["letter_type"] . "</td>";
	        					echo "<td>" . $row["dep_person"] . "</td>";
	        					//echo "<td>" . $row["filename"] . "</td>";
	        					echo "<td id='actiontd'>";
	 												if (strpos($usrlevel, "|20") > -1) {
	        					echo "<button style='border_radius:10px;' data-id='" . $row["rec_id"] . "' class='btn btn-dark edbtn'>Edit</button><br>";
	        				}
	        					if (strpos($usrlevel, "|10") > -1){
	        					 echo "<button style='border_radius:10px;' del-id='" . $row["rec_id"] . "' class='btn btn-danger delbtn'>Delete</button>";
	        					}
	        					echo "</td>";
	        				
	        					echo "</tr>";
	        					$number++;
	    							}
	    							echo "</table>";					
	    						}
						
						if (isset($_POST["searchbtn"])){
							if ($result1->num_rows == 0) {
								echo "<h5 style='text-align: center; padding: 10px; color: red; margin-top: 5%;'>List not Found!</h5>";
							}
						}											
					?>
			</center>
		</div>
			<!-- PDF Modal -->
				<div class="modal" id="pdfModal">
				    <div class="modal-dialog modal-lg" role="document">
				        <div class="modal-content">
				            <div class="modal-header">
				                <center><h5 class="modal-title">Letter Title</h5></center>
				                <?php  
				                if (strpos($usrlevel, "|40") > -1)
				                echo '<button type="button" class="btn btn-dark downloadbtn" style="position:absolute;right: 80px;" data-dismiss="modal">Download
				                </button>';
				                ?>
				                &nbsp;
				                <button type="button" class="btn btn-danger closebtn" style="position:absolute;right: 10px;" data-dismiss="modal">Close
				                </button>
				            </div>
				            <div class="modal-body" id="Mbody">		
				            	<iframe id="pdfViewer" src="" style="width: 100%; height: 800px; border: none;"></iframe>	
				            </div>
				        </div>
				    </div>
				</div><br><br><br><br><br><br><br><br>

				<script type="text/javascript">
					var pdfpath= "";
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
			$(".sel").change(function(){
				$("#sarea").focus();
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
				pdfpath = $(this).attr('data-pdf');
            //alert(pdfpath);
                var viewerDesktop = 'generic/web/viewer_readonly.html?file=../../uploadedfiles/' + pdfpath;
                var viewerMobile  = 'mobile-viewer/viewer_readonly.html?file=../uploadedfiles/' + pdfpath;

                var screenHeight  = screen.height; //$(window).height();
				var screenWidth   = $(window).width();
				//$('#Mbody').height = screenHeight + 50;
				
                var topSize       = 100; // pixels
                var iframeHeight  = screenHeight - topSize; // window height reduced by top size (navbar)
                //console.log( 'screenWidth: '  + screenWidth   +'px' );
                //console.log( 'screenHeight: ' + screenHeight  +'px' );

                $('iframe').attr('height', iframeHeight +'px'); 

                if ( screenWidth > 767) {
                    $('iframe').attr('src', viewerDesktop);
                } else {
                    $('iframe').attr('src', viewerMobile);
                }

                /*$('#btnDesktop').click(function(){
                    $('iframe').remove();
                    $('#content').append('<iframe class="desktop" height="'+ iframeHeight +'px" />');
                    $('iframe').attr('src', viewerDesktop);
                });

                $('#btnMobile').click(function(){
                    $('iframe').remove();
                    $('#content').append('<iframe class="mobile" height="'+ iframeHeight +'px" />');
                    $('iframe').attr('src', viewerMobile);
                });*/


            $("#pdfModal").modal('show');

            $(".closebtn").click(function(){
			    	$("#pdfModal").modal('hide');
			    });
            $(".downloadbtn").click(function(){

            	location.href= "downloadPDF.php?downloadfile=" + pdfpath;
            	return false;
            	//pdfpath = $(this).attr('data-pdf');

        });
            /*var pdfpath = $(this).attr('data-pdf');
         
           $("#pdfViewer").attr("src", 'uploadedfiles/' + pdfpath);
             //alert(viewpdf);
            //$("#Mbody").html(viewpdf);
            $("#pdfModal").modal('show');

            $(".closebtn").click(function(){
			    	$("#pdfModal").modal('hide');
			    });*/
			
        });

	});
	</script>
		</div>
	
	</body>