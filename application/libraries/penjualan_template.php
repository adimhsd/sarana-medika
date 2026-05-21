<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Sistem Informasi Terpadu STIKes Kuningan
 * @version    1.0
 * @author     Anton Sofyan | http://antonsofyan.com | 0857 5988 8922
 * @copyright  (c) 2013
 * @license    Premium
 * @category   Libraries
 * @package    Libraries
 */

require APPPATH.'third_party/tcpdf/tcpdf.php';

class Penjualan_template extends tcpdf
{	
	public $no_faktur;
	public $customer;
	public $alamat;	
	public $tgl_faktur;
	public $tgl_jatuh_tempo;
	public $total_penjualan;

	public function Header()
	{
		$this->SetFont('freesans', '', 7);
		$header = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td style="line-height:1.5;" width="10%"><img src="assets/logo.jpg" width="60px"></td>
				<td style="line-height:0.9;" width="90%" align="left"><br>
				<h3>CV. SARANA MEDIKA</h3>
				<h3>FAKTUR PENJUALAN</h3>
				</td>
			</tr>
		</table>';
		$this->writeHTML($header, true, false, true, false, 'C');
		$this->SetFont('freesans', '', 9);
		$html = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="20%" align="left">No Faktur</td>
						<td width="2%">:</td>
						<td width="78%" align="left">'.$this->no_faktur.'</td>
					</tr>
					<tr>
						<td width="20%" align="left">Customer</td>
						<td width="2%">:</td>
						<td width="78%" align="left">'.$this->customer.'</td>
					</tr>
					<tr>
						<td width="20%" align="left">Alamat</td>
						<td width="2%">:</td>
						<td width="78%" align="left">'.$this->alamat.'</td>
					</tr>
					<tr>
						<td width="20%" align="left">Tanggal</td>
						<td width="2%">:</td>
						<td width="78%" align="left">'.indo_date($this->tgl_faktur).'</td>
					</tr>
					<tr>
						<td width="20%" align="left">Jatuh Tempo</td>
						<td width="2%">:</td>
						<td width="78%" align="left">'.indo_date($this->tgl_jatuh_tempo).'</td>
					</tr>
					<tr>
						<td width="20%" align="left">Total Penjualan</td>
						<td width="2%">:</td>
						<td width="78%" align="left">Rp. '.rupiah($this->total_penjualan).'</td>
					</tr>
					<tr>
						<td width="20%" align="left">Terbilang</td>
						<td width="2%">:</td>
						<td width="78%" align="left">'.terbilang($this->total_penjualan).'</td>
					</tr>
				</table>';
		$this->writeHTML($html, true, false, true, false, 'C');
		$head = '<table width="100%" border="1" cellspacing="0" cellpadding="3">
					<tr>
						<td width="5%">NO</td>
						<td width="15%">KODE</td>
						<td width="25%">NAMA BARANG</td>
						<td width="17.5%">HARGA SATUAN</td>
						<td width="12.5%">JUMLAH</td>
						<td width="12.5%">DISKON</td>
						<td width="12.5%">SUB TOTAL</td>
					</tr>
				</table>';
		$this->writeHTML($head, true, false, true, false, 'C');
	}

	public function Footer()
	{
		$this->SetFont('freesansi', '', 8);
		$html = '<table width="100%" border="0" cellpadding="3">
					<tr>
						<td style="border-top:1px solid black;" align="left">CV. Sarana Medika</td>
					</tr>
				</table>';
		$this->writeHTML($html, true, false, true, false, 'C');
	}
}