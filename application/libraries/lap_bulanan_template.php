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

class Lap_bulanan_template extends tcpdf
{	
	public $lap_title;
	
	public function Header()
	{
		$this->SetFont('freesans', '', 7);
		$header = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td style="line-height:1.5;" width="10%"><img src="assets/logo.jpg" width="60px"></td>
				<td style="line-height:0.9;" width="90%" align="left"><br>
				<h3>CV. SARANA MEDIKA</h3>
				<h3>'.$this->lap_title.'</h3>
				</td>
			</tr>
		</table>';
		$this->writeHTML($header, true, false, true, false, 'C');
		$head = '<table width="100%" border="1" cellspacing="0" cellpadding="3">
					<tr>
						<td width="5%">NO</td>
						<td width="10%">NO FAKTUR</td>
						<td width="35%">CUSTOMER</td>
						<td width="12.5%">TANGGAL FAKTUR</td>
						<td width="12.5%">JATUH TEMPO</td>
						<td width="12.5%">STATUS</td>
						<td width="12.5%">TOTAL</td>
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