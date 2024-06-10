<?php

				if (isset($_GET["downloadfile"])){
					$pdfpath ="uploadedfiles/" . $_GET["downloadfile"];
				if(file_exists($pdfpath)){
            		header('Content-Description: File Transfer');
				    header('Content-Type: file/pdf');
				    header('Content-Disposition: attachment; filename="' . $pdfpath .'.pdf"');
				    header('Content-Transfer-Encoding: binary');
				    header('Expires: 0');
				    header('Cache-Control: public');
				    header('Pragma: public');
				    header('Content-Length: ' . filesize($pdfpath));
					readfile($pdfpath);
					echo $pdfpath;
            	}
           }

?>