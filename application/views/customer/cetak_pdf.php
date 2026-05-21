<?php
require APPPATH.'libraries/header_customer.php';
$pdf = new header_customer('L', PDF_UNIT, array(210, 140), true, 'UTF-8', false);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(8, 29.7, 8); // atur disini antara header dan content
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, 15);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->SetTitle('Uniku');
$pdf->AddPage();
$pdf->SetFont('freesans', '', 8);
$html = '<table width="100%" border="1" cellspacing="0" cellpadding="3">';
$no = 1;
foreach($query->result() as $row)
{
	$html.= '<tr>';
	$html.= '<td width="4%" align="left">'.$no.'</td>';
	$html.= '<td width="25%" align="left">'.$row->nama.'</td>';
	$html.= '<td width="31%" align="left">'.$row->alamat.'</td>';
	$html.= '<td width="10%" align="right">'.$row->no_telp.'</td>';
	$html.= '<td width="15%" align="right">'.$row->email.'</td>';
	$html.= '<td width="15%" align="center">'.rupiah($row->piutang).'</td>';
	$html.= '</tr>';
	$no++;
}
$html .= '</table>';
$pdf->writeHTML($html, true, false, true, false, 'C');
$pdf->Output('laporan-data-barang.pdf', 'I');?>