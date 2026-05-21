<?php
require APPPATH.'libraries/Penjualan_template.php';
$pdf = new Penjualan_template('L', PDF_UNIT, array(210, 140), true, 'UTF-8', false);
$pdf->no_faktur 	  = $this->uri->segment(3);
$pdf->customer 		  = $head['nama'];
$pdf->alamat 		  = $head['alamat'];
$pdf->tgl_faktur 	  = $head['tgl_faktur'];
$pdf->tgl_jatuh_tempo = $head['tgl_jatuh_tempo'];
$pdf->total_penjualan = $head['total_harga'];

$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(8, 62.5, 8); // atur disini antara header dan content
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, 15);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->SetTitle('Uniku');
$pdf->AddPage();
$pdf->SetFont('freesans', '', 8);
$html = '<table width="100%" border="1" cellspacing="0" cellpadding="3">';
$no = 1;
$total_penjualan = 0;
foreach($detail->result() as $row)
{
	$html.= '<tr>';
	$html.= '<td width="5%" align="left">'.$no.'</td>';
	$html.= '<td width="15%" align="left">'.$row->kd_barang.'</td>';
	$html.= '<td width="25%" align="left">'.$row->nama_barang.'</td>';
	$html.= '<td width="17.5%" align="left">Rp. '.rupiah($row->harga_jual).'/'.$row->satuan.'</td>';
	$html.= '<td width="12.5%" align="left">'.$row->jml_barang.'</td>';
	$html.= '<td width="12.5%" align="left">'.$row->diskon.'%</td>';
	$html.= '<td width="12.5%" align="left">Rp. '.rupiah(str_replace('.00', '', $row->total_harga)).'</td>';
	$html.= '</tr>';
	$no++;
	$total_penjualan += str_replace('.00', '', $row->total_harga);
}
$html .= '<tr>';
$html .= '<td colspan="6" align="right">TOTAL</td>';
$html .= '<td align="left">Rp. '.rupiah($total_penjualan).'</td>';
$html .= '</tr>';
$html .= '</table>';
$html .= '<table width="100%" border="0" cellspacing="0" cellpadding="3">';
	$html.= '<tr>';
	$html.= '<td></td>';
	$html.= '<td></td>';
	$html.= '<td></td>';
	$html.= '</tr>';

	$html.= '<tr>';
	$html.= '<td>Kurir</td>';
	$html.= '<td>'.$jab_penginput.'</td>';
	$html.= '<td>Customer</td>';
	$html.= '</tr>';
	
	$html.= '<tr>';
	$html.= '<td></td>';
	$html.= '<td></td>';
	$html.= '<td></td>';
	$html.= '</tr>';
	
	$html.= '<tr>';
	$html.= '<td></td>';
	$html.= '<td></td>';
	$html.= '<td></td>';
	$html.= '</tr>';
	
	$html.= '<tr>';
	$html.= '<td>'.$head['kurir'].'</td>';
	$html.= '<td>'.$nama_penginput.'</td>';
	$html.= '<td>'.$head['nama'].'</td>';
	$html.= '</tr>';

$html .= '</table>';
$pdf->writeHTML($html, true, false, true, false, 'C');
$pdf->Output('faktur-penjualan-'.$this->uri->segment(3).'.pdf', 'I');?>