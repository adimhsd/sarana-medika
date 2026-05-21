<?php
require APPPATH.'libraries/Pembelian_template.php';
$pdf = new Pembelian_template('L', PDF_UNIT, array(210, 140), true, 'UTF-8', false);
$pdf->no_faktur 	  = $this->uri->segment(3);
$pdf->supplier 		  = $head['nama'];
$pdf->tgl_faktur 	  = $head['tgl_faktur'];
$pdf->tgl_jatuh_tempo = $head['tgl_jatuh_tempo'];
$pdf->total 		  = $head['total_harga'];

$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(8, 58.5, 8); // atur disini antara header dan content
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, 15);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->SetTitle('Uniku');
$pdf->AddPage();
$pdf->SetFont('freesans', '', 8);
$html = '<table width="100%" border="1" cellspacing="0" cellpadding="3">';
$no = 1;
foreach($detail->result() as $row)
{
	$html.= '<tr>';
	$html.= '<td width="5%" align="left">'.$no.'</td>';
	$html.= '<td width="15%" align="left">'.$row->kd_barang.'</td>';
	$html.= '<td width="35%" align="left">'.$row->nama_barang.'</td>';
	$html.= '<td width="15%" align="left">'.$row->harga_beli.'/'.$row->satuan.'</td>';
	$html.= '<td width="15%" align="left">'.$row->jml_barang.'</td>';
	$html.= '<td width="15%" align="left">Rp. '.rupiah($row->subtotal_harga).'</td>';
	$html.= '</tr>';
	$no++;
}
$html .= '</table>';
$html .= '<table width="100%" border="0" cellspacing="0" cellpadding="3">';
	$html.= '<tr>';
	$html.= '<td></td>';
	$html.= '<td></td>';
	$html.= '</tr>';
	$html.= '<tr>';
	$html.= '<td>'.$jab_penginput.'</td>';
	$html.= '<td>Supplier</td>';
	$html.= '</tr>';
	$html.= '<tr>';
	$html.= '<td></td>';
	$html.= '<td></td>';
	$html.= '</tr>';
	$html.= '<tr>';
	$html.= '<td></td>';
	$html.= '<td></td>';
	$html.= '</tr>';
	$html.= '<tr>';
	$html.= '<td>'.$nama_penginput.'</td>';
	$html.= '<td>'.$head['nama'].'</td>';
	$html.= '</tr>';
$html .= '</table>';
$pdf->writeHTML($html, true, false, true, false, 'C');
$pdf->Output('faktur-pembelian-'.$this->uri->segment(3).'.pdf', 'I');?>