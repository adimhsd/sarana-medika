<?php
require APPPATH.'libraries/header_barang.php';
$pdf = new header_barang('L', PDF_UNIT, array(210, 140), true, 'UTF-8', false);
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
	$html.= '<td width="12%" align="left">'.$row->kd_barang.'</td>';
	$html.= '<td width="12%" align="left">'.$row->nama_barang.'</td>';
	$html.= '<td width="12%" align="right">'.$row->harga_beli.'</td>';
	$html.= '<td width="12%" align="right">'.$row->harga_jual.'</td>';
	$html.= '<td width="12%" align="center">'.$row->diskon.'%</td>';
	$html.= '<td width="12%" align="left">'.$row->satuan.'</td>';
	$html.= '<td width="12%" align="center">'.$row->jumlah_stok.'</td>';
	$html.= '<td width="12%" align="center">'.$row->stok_min.'</td>';
	$html.= '</tr>';
	$no++;
}
$html .= '</table>';
$pdf->writeHTML($html, true, false, true, false, 'C');
$pdf->Output('laporan-data-barang.pdf', 'I');?>