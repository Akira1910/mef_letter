<?php
include("inc/dbsetting.php");


					if (isset($_POST["entrysub"])) 
					{
						$fullname = $_POST["memname"];
						$username = $_POST["usrname"];
						$levelid  = $_POST["lvlhidden"];
						$password = md5($_POST["entrypw"]);
						$dep      =$_POST["department"];
						
							$sql = "INSERT INTO user_table (
									fullname, username, level_id, password, dep) VALUES ('$fullname', '$username', '$levelid', '$password', '$dep');";
									$result = $dbconn->query($sql);
									if ($result) 
									{
										header("location:entry.php");
										exit();
									}
					}
?>