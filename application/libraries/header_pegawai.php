<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'third_party/tcpdf/tcpdf.php';

class Header_pegawai extends tcpdf
{
	public function Header()
	{
		$this->SetFont('freesans', '', 7);
		$header = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td style="line-height:1.5;" width="10%"><img src="assets/logo.jpg" width="60px"></td>
				<td style="line-height:0.9;" width="90%" align="left"><br>
				<h3>CV. SARANA MEDIKA</h3>
				<h3>LAPORAN DATA PEGAWAI</h3>
				</td>
			</tr>
		</table>';
		$this->writeHTML($header, true, false, true, false, 'C');
		$head = '<table width="100%" border="1" cellspacing="0" cellpadding="3">
					<tr>
						<td width="4%">NO</td>
						<td width="6%">NIK</td>
						<td width="10%">NAMA</td>
						<td width="10%">ALAMAT</td>
						<td width="8%">JENIS KELAMIN</td>
						<td width="10%">TEMPAT LAHIR</td>
						<td width="10%">TANGGAL LAHIR</td>
						<td width="10%">TELP</td>
						<td width="8%">PENDIDIKAN</td>
						<td width="10%">TGL. MASUK KERJA</td>
						<td width="5%">GAJI</td>
						<td width="10%">JABATAN</td>
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