<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pembelian extends MY_Controller {

    // Primary Key & Table 
    private $pk      = 'no_faktur';
    private $table   = 'pembelian';

    // Form Create & Display
    private $form    = 'pembelian/create';
    private $display = 'pembelian/read';

    // Title
    private $c_title = 'PEMBELIAN';
    private $r_title = 'DATA PEMBELIAN';
    private $u_title = 'EDIT PEMBELIAN';

    // URL
    private $url     = array(
                       'read'   => 'pembelian/',
                       'delete' => 'pembelian/delete'
                       );

    // active menu
    private $active = 'pembelian';

    public function index()
    {
        $this->read();
    }

    public function create()
    {
        if ($_POST)
        {
            if ($this->m_global->save($this->table, $this->field_data()))
            {
                redirect('pembelian/create_list/'.$this->input->post('no_faktur'));
            }
            else
            {
                $this->session->set_flashdata('alert', alert('error', status('existed')));
                redirect(uri_string());
            }
        }
        else
        {
            $data['alert']   = $this->session->flashdata('alert');
            $data['pembelian']  = 'class="active"';
            $data['title']   = $this->c_title;
            $data['action']  = site_url(uri_string());
            //$data['no_faktur'] = $this->apps->no_faktur('pembelian');
            $data['q_supplier'] = $this->m_global->dropdown('kd_supplier', 'nama', 'supplier');
            $data['query']   = FALSE;
            $data['content'] = $this->form;
            $this->load->view('layout/index', $data);
        }
    }

    public function create_list()
    {
        $no_faktur = $this->uri->segment(3);

        if ($_POST)
        {
            $kd_barang = $this->input->post('kd_barang');
            $jml_barang = $this->input->post('jml_barang');
            $brg       = $this->db->query("SELECT harga_beli FROM barang WHERE kd_barang = '$kd_barang'")->row_array();
            $harga     = $brg['harga_beli'];

            $query = $this->db->query("SELECT * FROM detail_pembelian 
                                       WHERE no_faktur = '$no_faktur' 
                                       AND kd_barang = '$kd_barang'");
            if ($query->num_rows() == 1)
            {
                $hasil  = $query->row_array();
                $jumlah = $hasil['jml_barang'] + $jml_barang;
                $data = array(
                        'jml_barang' => $jumlah,
                        'subtotal_harga' => $harga * $jumlah
                        );
                $this->db->where('no_faktur', $no_faktur)
                        ->where('kd_barang', $kd_barang)
                        ->update('detail_pembelian', $data);
            }
            else
            {
                $data = array(
                        'no_faktur'  => $no_faktur,
                        'kd_barang'  => $this->input->post('kd_barang'),
                        'jml_barang' => $jml_barang,
                        'subtotal_harga' => $harga * $jml_barang
                        );
                $this->db->insert('detail_pembelian', $data);
            }
            redirect('pembelian/create_list/'.$no_faktur);
        }
        elseif ($no_faktur)
        {
            $data['alert']     = $this->session->flashdata('alert');
            $data['pembelian'] = 'class="active"';
            $data['title']     = 'TRANSAKSI PEMBELIAN BARANG DENGAN NO. FAKTUR '.$this->uri->segment(3);
            $data['action']    = site_url(uri_string());
            $data['q_barang']  = $this->m_global->dropdown('kd_barang', 'nama_barang', 'barang');
            $data['detail_pembelian'] = $this->db->query("SELECT dp.no_faktur, dp.kd_barang, b.nama_barang, b.harga_beli, b.satuan, dp.jml_barang, dp.subtotal_harga
                                                          FROM detail_pembelian dp
                                                          LEFT JOIN barang b ON b.kd_barang = dp.kd_barang
                                                          WHERE dp.no_faktur = '$no_faktur'");
            $data['query']     = FALSE;
            $data['content']   = 'pembelian/create_list';
            $this->load->view('layout/index', $data);
        }
        else
        {
            $this->session->set_flashdata('alert', alert('error', status('404')));
            redirect($this->url['read']);
        }
    }

    public function read()
    {
        $data['alert']   = $this->session->flashdata('alert');
        $data['pembelian']  = 'class="active"';
        $data['title']   = $this->r_title;
        $data['action']  = site_url($this->url['delete']);
        $data['query']   = $this->db->query("SELECT p.no_faktur, p.tgl_faktur, p.status, p.tgl_jatuh_tempo, s.nama, (SELECT SUM(subtotal_harga) FROM detail_pembelian WHERE no_faktur = p.no_faktur) AS total_harga
                                             FROM pembelian p
                                             LEFT JOIN supplier s ON s.kd_supplier = p.kd_supplier");
        $data['content'] = $this->display;
        $this->load->view('layout/index', $data);
    }

    public function lap_bulanan()
    {
        if (isset($_POST['excel']))
        {
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
            $key = $tahun.'-'.$bulan;
            $query = $this->db->query("SELECT p.no_faktur, p.tgl_faktur, p.status, p.tgl_jatuh_tempo, s.nama, (SELECT SUM(subtotal_harga) FROM detail_pembelian WHERE no_faktur = p.no_faktur) AS total_harga
                                       FROM pembelian p
                                       LEFT JOIN supplier s ON s.kd_supplier = p.kd_supplier
                                       WHERE LEFT(tgl_faktur, 7) = '$key'");
            $file_name = 'laporan-pembelian-bulan-'.get_bulan($bulan).'-'.$tahun;
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
            header("Content-Type: application/force-download");
            header("Content-Type: application/octet-stream");
            header("Content-Type: application/download");
            header("Content-Disposition: attachment;filename={$file_name}.xls");
            header("Content-Transfer-Encoding: binary ");
            $table = "<table border='1'>
                      <tr>
                            <td>NO.</td>
                            <td>NO FAKTUR</td>
                            <td>SUPPLIER</td>
                            <td>TANGGAL PEMBELIAN</td>
                            <td>TANGGAL JATUH TEMPO</td>
                            <td>TOTAL</td>
                            <td>STATUS</td>
                      </tr>";
            $no = 1;
            $total = 0;
            foreach($query->result_array() as $data)
            {
                $table .= '<tr>';
                $table.= '<td>'.$no.'</td>';
                $table.= '<td>'.$data['no_faktur'].'</td>';
                $table.= '<td>'.$data['nama'].'</td>';
                $table.= '<td>'.$data['tgl_faktur'].'</td>';
                $table.= '<td>'.$data['tgl_jatuh_tempo'].'</td>';
                $table.= '<td>'.$data['total_harga'].'</td>';
                if ($data['status'] == 'n')
                {
                    $table.= '<td>Belum Lunas</td>';    
                }
                else
                {
                    $table.= '<td>Lunas</td>';
                }                
                $table.= '</tr>';
                $no++;
                $total += $data['total_harga'];
            }
            $table .= '<tr>';
                $table.= '<td colspan="6">TOTAL pembelian</td>';
                $table.= '<td>'.$total.'</td>';
                $table.= '</tr>';
            $table .= '</table>';
            echo $table;
        }
        elseif(isset($_POST['pdf']))
        {
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
            $key   = $tahun.'-'.$bulan;
            $data['file_name'] = 'laporan-pembelian-bulan-'.get_bulan($bulan).'-'.$tahun;
            $data['lap_title'] = 'LAPORAN PEMBELIAN BULAN '.strtoupper(get_bulan($bulan)). ' '.$tahun;
            $data['query'] = $this->db->query("SELECT p.no_faktur, p.tgl_faktur, p.status, p.tgl_jatuh_tempo, s.nama, (SELECT SUM(subtotal_harga) FROM detail_pembelian WHERE no_faktur = p.no_faktur) AS total_harga
                                               FROM pembelian p
                                               LEFT JOIN supplier s ON s.kd_supplier = p.kd_supplier
                                               WHERE LEFT(tgl_faktur, 7) = '$key'");
            $this->load->view('pembelian/cetak_lap_bulanan', $data);
        }
        else
        {
            $data['alert']         = $this->session->flashdata('alert');
            $data['lap_pembelian'] = 'class="active"';
            $data['title']         = 'LAPORAN PEMBELIAN';
            $data['action']        = site_url(uri_string());
            $data['content']       = 'pembelian/lap_bulanan';
            $this->load->view('layout/index', $data);
        }
    }

    public function delete()
    {
        $no_faktur = $this->uri->segment(3);

        if ($no_faktur)
        {
            if ($this->m_global->delete($this->pk, $no_faktur, $this->table))
            {
                $this->session->set_flashdata('alert', alert('success', status('deleted')));
                redirect($this->url['read']);
            }
            else
            {
                $this->session->set_flashdata('alert', alert('error', status('is_used')));
                redirect($this->url['read']);
            }
        }
        elseif (isset($_POST[$this->pk]))
        {
            if ($this->m_global->delete($this->pk, $_POST[$this->pk], $this->table))
            {
                $this->session->set_flashdata('alert', alert('success', status('deleted')));
                redirect($this->url['read']);
            }
            else
            {
                $this->session->set_flashdata('alert', alert('error', status('is_used')));
                redirect($this->url['read']);
            }
        }
        else
        {
            $this->session->set_flashdata('alert', alert('warning', status('not_selected')));
            redirect($this->url['read']);
        }
    }

    public function delete_detail()
    {
        $no_faktur = $this->uri->segment(3);
        $kd_barang = $this->uri->segment(4);
        $this->db->where('no_faktur', $no_faktur)
                ->where('kd_barang', $kd_barang)
                ->delete('detail_pembelian');
        redirect('pembelian/create_list/'.$no_faktur);
    }

    private function field_data()
    {
        return array(
               'no_faktur'       => $this->input->post('no_faktur'),
               'kd_supplier'     => $this->input->post('kd_supplier'),
               'tgl_faktur'      => $this->input->post('tgl_faktur'),
               'tgl_jatuh_tempo' => $this->input->post('tgl_jatuh_tempo'),
               //'jml_harga'       => $this->input->post('jml_harga'),
               'nik'             => $this->session->userdata('nik')
               );
    }

    public function update_stok_barang($no_faktur)
    {
        
        $this->session->set_flashdata('alert', alert('success', 'Stok Barang sudah di update'));
        redirect('pembelian/create_list/'.$no_faktur);
    }

    public function cetak_faktur()
    {
        $no_faktur = $this->uri->segment(3);

        $query = $this->db->where('no_faktur', $no_faktur)->get('detail_pembelian');
        
        $qry2 = $this->db->query("SELECT SUM(subtotal_harga) AS total_hutang FROM detail_pembelian WHERE no_faktur = '$no_faktur'")->row_array();
        $utang = $qry2['total_hutang'];

        $qry_4 = $this->db->query("SELECT kd_supplier FROM pembelian WHERE no_faktur = '$no_faktur'")->row_array();
        $kd_supplier = $qry_4['kd_supplier'];
        $qry3 = $this->db->query("UPDATE supplier SET jml_utang = jml_utang + '$utang' WHERE kd_supplier = '$kd_supplier' ");

        foreach($query->result() as $row)
        {
            $this->db->query("UPDATE barang SET jumlah_stok = jumlah_stok + '$row->jml_barang' WHERE kd_barang = '$row->kd_barang'");
        }
        

        $this->db->query("UPDATE pembelian SET is_update = 'y' WHERE no_faktur = '$no_faktur' ");

        if ($no_faktur)
        {
            $data['head']   = $this->db->query("SELECT p.no_faktur, p.tgl_faktur, p.tgl_jatuh_tempo, s.nama, (SELECT SUM(subtotal_harga) FROM detail_pembelian WHERE no_faktur = p.no_faktur) AS total_harga
                                                FROM pembelian p
                                                LEFT JOIN supplier s ON s.kd_supplier = p.kd_supplier
                                                WHERE no_faktur = '$no_faktur'")->row_array();
            $data['detail'] = $this->db->query("SELECT dp.no_faktur, dp.kd_barang, b.nama_barang, b.harga_beli, b.satuan, dp.jml_barang, dp.subtotal_harga
                                              FROM detail_pembelian dp
                                              LEFT JOIN barang b ON b.kd_barang = dp.kd_barang
                                              WHERE dp.no_faktur = '$no_faktur'");
            $this->load->view('pembelian/cetak', $data);
        }
        else
        {
            $this->session->set_flashdata('alert', alert('error', status('404')));
            redirect('pembelian/create_list/'.$no_faktur);
        }
    }

    public function print_faktur()
    {
        $no_faktur = $this->uri->segment(3);

        if ($no_faktur)
        {
            $data['head']   = $this->db->query("SELECT p.no_faktur, p.tgl_faktur, p.tgl_jatuh_tempo, s.nama, (SELECT SUM(subtotal_harga) FROM detail_pembelian WHERE no_faktur = p.no_faktur) AS total_harga
                                                FROM pembelian p
                                                LEFT JOIN supplier s ON s.kd_supplier = p.kd_supplier
                                                WHERE no_faktur = '$no_faktur'")->row_array();
            $data['detail'] = $this->db->query("SELECT dp.no_faktur, dp.kd_barang, b.nama_barang, b.harga_beli, b.satuan, dp.jml_barang, dp.subtotal_harga
                                              FROM detail_pembelian dp
                                              LEFT JOIN barang b ON b.kd_barang = dp.kd_barang
                                              WHERE dp.no_faktur = '$no_faktur'");

            $qry2 = $this->db->where('no_faktur', $no_faktur)->get('pembelian')->row_array();
            $nik_pegawai = $qry2['nik'];
            $pegawai_input = $this->db->where('nik', $nik_pegawai)->get('pegawai')->row_array();
            $data['nama_penginput'] = $pegawai_input['nama'];
            $data['jab_penginput'] = $pegawai_input['jabatan'];

            $this->load->view('pembelian/cetak', $data);
        }
        else
        {
            $this->session->set_flashdata('alert', alert('error', status('404')));
            redirect('pembelian/create_list/'.$no_faktur);
        }
    }

    public function lunas()
    {
        $no_faktur = $this->uri->segment(3);
        $this->db->where('no_faktur', $no_faktur)->update('pembelian', array('status' => 'y'));
        
        $query = $this->db->query("SELECT SUM(subtotal_harga) as jumlah FROM detail_pembelian WHERE no_faktur = '$no_faktur'")->row_array();
        $jumlah = $query['jumlah'];

        $qry_4 = $this->db->query("SELECT kd_supplier FROM pembelian WHERE no_faktur = '$no_faktur'")->row_array();
        $kd_supplier = $qry_4['kd_supplier'];
        $this->db->query("UPDATE supplier SET jml_utang = jml_utang - '$jumlah' WHERE kd_supplier = '$kd_supplier' ");

        $this->session->set_flashdata('alert', alert('success', 'Data sudah diperbaharui'));
        redirect('pembelian');
    }
}