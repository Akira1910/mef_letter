<?php
include("inc/dbsetting.php");
include("inc/functions.php");
$target_dir = "uploadedfiles/";

	if (isset($_POST["edbtn"])) 
	    {
	    $rec_id =$_POST["rec_id"];
	    $letter_date = $_POST["letterdate"];
	    $formattedDate = convert_date($letter_date);
	    $letter_number= $_POST["letternum"];
	    $letter_title = $_POST["lettertitle"];
	    $letter_type=$_POST["seltype"];
	    $dep_person=$_POST["letterdep"];
	    $file_type = $_POST["filesel"];
	    	$sql2 ="UPDATE letter_table SET 
			        			letter_date= '". $formattedDate . "', 
			        			letter_number='" . $letter_number . "', 
			        			letter_title='" . $letter_title . "', 
			        			type_id=" . $letter_type . ", 
			        			dep_person='" . $dep_person. "', file_type='" . $file_type . "' ";
		    //$_FILES["updatefile"]["tmp_name"];
		    	if($_FILES["updatefile"]["error"] != 4)
		    	{
			        //$filename =basename($_FILES["updatefile"]["name"]);    
			        //$pdffile = $_FILES["updatefile"]["tmp_name"];
			        //echo $pdffile;
			        $filename = rand(0,100000);
			        $filename .= '-' . rand(0,100000);
			        $filename .= '-' . rand(0,100000);
			        move_uploaded_file($_FILES["updatefile"]["tmp_name"], $target_dir.$filename);

			        			/*$sql2 ="UPDATE letter_table SET 
			        			letter_date= '". $formattedDate . "', 
			        			letter_number='" . $letter_number . "', 
			        			letter_title='" . $letter_title . "', 
			        			letter_type='" . $letter_type . "', 
			        			dep_person='" . $dep_person. "',*/

			        			$sql2.= ", filename='" .$filename . "' "; 
			        			//WHERE rec_id=" . $_POST["rec_id"];
			    }
			    $sql2.= "WHERE rec_id=" . $rec_id;
			    	/*else
			    	{
			    		$sql2 = "UPDATE letter_table SET 
				            letter_date='" . $formattedDate . "', 
				            letter_number='" . $letter_number . "', 
				            letter_title='" . $letter_title . "', 
				            letter_type='" . $letter_type . "', 
				            dep_person='" . $dep_person . "' 
				            WHERE rec_id=" . $rec_id;
			    	}*/
			        		
	        			$result2 = $dbconn->query($sql2);
	        			
	   						if ($result2) 
	    						{
	        						//echo $sql2;
	        						header("location:display.php");
	        						exit();
	    						}
			        						
			    
		}

?>