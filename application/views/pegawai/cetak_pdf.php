<?php
require APPPATH.'libraries/header_pegawai.php';
$pdf = new header_pegawai('L', PDF_UNIT, array(210, 330), true, 'UTF-8', false);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(8, 30, 8); // atur disini antara header dan content
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
	$html.= '<td width="6%" align="left">'.$row->nik.'</td>';
	$html.= '<td width="10%" align="left">'.$row->nama.'</td>';
	$html.= '<td width="10%" align="right">'.$row->alamat.'</td>';
	$html.= '<td width="8%" align="right">'.$row->jenis_kelamin.'</td>';
	$html.= '<td width="10%" align="right">'.$row->tempat_lahir.'</td>';
	$html.= '<td width="10%" align="right">'.$row->tgl_lahir.'</td>';
	$html.= '<td width="10%" align="right">'.$row->no_telp.'</td>';
	$html.= '<td width="8%" align="right">'.$row->pendidikan.'</td>';
	$html.= '<td width="10%" align="right">'.$row->tgl_masuk_kerja.'</td>';
	$html.= '<td width="5%" align="right">'.$row->gaji.'</td>';
	$html.= '<td width="10%" align="right">'.$row->jabatan.'</td>';
	$html.= '</tr>';
	$no++;
}
$html .= '</table>';
$pdf->writeHTML($html, true, false, true, false, 'C');
$pdf->Output('laporan-data-barang.pdf', 'I');?>