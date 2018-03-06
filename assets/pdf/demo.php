<?php


			include('cppdf/dompdf_config.inc.php');
			
			global $_dompdf_show_warnings;
			global $_dompdf_debug;
			global $_DOMPDF_DEBUG_TYPES;

			$outfile = 'test.pdf';
			$save_file = false; // Save the file or not
			
			$buff = file_get_contents('html/index.html');

			$dompdf = new DOMPDF();
		$base_path = $_SERVER['DOCUMENT_ROOT'].'/pdf/html2/html/';

			$dompdf->load_html($buff);
			if ( isset($base_path) ) {
				$dompdf->set_base_path($base_path);
			}
			$dompdf->render();
			
	
			if ( $_dompdf_show_warnings ) {
				global $_dompdf_warnings;
				foreach ($_dompdf_warnings as $msg) {
					echo $msg . "\n";
				}
				echo $dompdf->get_canvas()->get_cpdf()->messages;
				flush();
			}
//
			if ( $save_file ) {
				// if ( !is_writable($outfile) )
					// throw new DOMPDF_Exception("'$outfile' is not writable.");

				if ( strtolower(DOMPDF_PDF_BACKEND) == "gd" ) {
					$outfile = str_replace(".pdf", ".png", $outfile);
				}

				list($proto, $host, $path, $file) = explode_url($outfile);

				if ( $proto != "" ) // i.e. not file://
					$outfile = $file; // just save it locally, FIXME? could save it like wget: ./host/basepath/file

				$outfile = dompdf_realpath($outfile);
				// if ( strpos($outfile, DOMPDF_CHROOT) !== 0 )
					// throw new DOMPDF_Exception("Permission denied.");
				file_put_contents($outfile, $dompdf->output( array("compress" => 0) ));
			}

			if (!headers_sent() ) 
				$dompdf->stream($outfile);

?>