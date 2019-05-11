<?php
require_once("../TCPDF-master/informes/tcpdf_include.php");

  $pdf = new TCPDF(PDF_PAGE_ORIENTATION, 'mm', 'A4', true, 'UTF-8', false);

	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Miguel Caro');
	$pdf->SetTitle('factura');

	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);
	$pdf->SetMargins(20, 20, 20, false);
	$pdf->SetAutoPageBreak(true, 20);
	$pdf->SetFont('Helvetica', '', 10);
	$pdf->addPage();

  $content = '';
  $content .= '
		<div class="row">
        	<div class="col-md-12">
            	<h1 style="text-align:center;">factura!</h1>

      <table border="1" cellpadding="5">
        <thead>
          <tr>
            <th>DNI</th>
            <th>A. PATERNO</th>
            <th>A. MATERNO</th>
            <th>NOMBRES</th>
            <th>AREA</th>
            <th>SUELDO</th>
          </tr>
        </thead>
	';

  $pdf->writeHTMLCell(0, 0, '', '', $content, 0, 1, 0, true, '', true);

  $pdf->Output('example_001.pdf', 'I');
 ?>
