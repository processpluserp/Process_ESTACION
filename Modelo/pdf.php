<?php
	require('../mpdf/mpdf.php');
	class Pdf_content{
		public $pdf;
		
		
		public __Construct Pdf_content(){
			$this->pdf = new mPDF('utf-8', array(279,210));
		}
		
		public function asad(){}
	}
?>