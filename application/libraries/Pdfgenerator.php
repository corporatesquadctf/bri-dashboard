<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("dompdf/autoload.inc.php");
use Dompdf\Dompdf;
class Pdfgenerator {
	public function generate($html, $filename='', $stream=TRUE, $paper = 'A4', $orientation = "portrait")
	{
		$dompdf = new Dompdf();
		$dompdf->loadHtml($html);
		$dompdf->setPaper($paper, $orientation);
		$dompdf->set_option("isPhpEnabled", TRUE);
		$dompdf->set_option("isRemoteEnabled", TRUE);
		$dompdf->render();
		if ($stream) {
			/*
				If view only: $dompdf->stream($filename.".pdf", array("Attachment" => 0));
				If force download: $dompdf->stream($filename.".pdf", array("Attachment" => 1));
			*/
			$dompdf->stream($filename.".pdf", array("Attachment" => 1));
		} else {
			return $dompdf->output();
		}
	}
}