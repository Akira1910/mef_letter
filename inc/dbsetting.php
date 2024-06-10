<?php
				$host = 'localhost';
				$dbname = 'myproject';
				$uname = 'root';
				$pw = '';
				$dbconn = new mysqli($host, $uname, $pw, $dbname);
					if ($dbconn -> connect_errno) {
						echo "Connection Error!" . $dbconn -> connect_error;
						exit();
					}
					$dbconn->set_charset('utf8');
					$dbconn->query("SET collection_connection = utf8mb4_unicode_ci");

?>