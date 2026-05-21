<?php
require APPPATH.'libraries/Lap_pembelian_template.php';
$pdf = new Lap_pembelian_template('L', PDF_UNIT, array(210, 140), true, 'UTF-8', false);
$pdf->lap_title = $lap_title;
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
$total = 0;
foreach($query->result() as $row)
{
	$html.= '<tr>';
	$html.= '<td width="5%" align="left">'.$no.'</td>';
	$html.= '<td width="10%" align="left">'.$row->no_faktur.'</td>';
	$html.= '<td width="35%" align="left">'.$row->nama.'</td>';
	$html.= '<td width="12.5%" align="left">'.$row->tgl_faktur.'</td>';
	$html.= '<td width="12.5%" align="left">'.$row->tgl_jatuh_tempo.'</td>';
	if ($row->status == 'n')
	{
		$html.= '<td width="12.5%" align="left">Belum Lunas</td>';	
	}
	else
	{
		$html.= '<td width="12.5%" align="left">Lunas</td>';		
	}

	$html.= '<td width="12.5%" align="left">Rp. '.rupiah($row->total_harga).'</td>';
	$html.= '</tr>';
	$no++;
	$total += $row->total_harga;
}
$html.= '<tr>';
	$html.= '<td width="87.5%" align="left" colspan="5">TOTAL PEMBELIAN</td>';
	$html.= '<td width="12.5%" align="left">Rp. '.rupiah($total).'</td>';
	$html.= '</tr>';
$html .= '</table>';
$pdf->writeHTML($html, true, false, true, false, 'C');
$pdf->Output('faktur-pembelian-'.$this->uri->segment(3).'.pdf', 'I');?>