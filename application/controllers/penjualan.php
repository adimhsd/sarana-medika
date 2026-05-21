<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penjualan extends MY_Controller {

    // Primary Key & Table 
    private $pk      = 'no_faktur';
    private $table   = 'penjualan';

    // Form Create & Display
    private $form    = 'penjualan/create';
    private $display = 'penjualan/read';

    // Title
    private $c_title = 'PENJUALAN';
    private $r_title = 'DATA PENJUALAN';
    private $u_title = 'EDIT PENJUALAN';

    // URL
    private $url     = array(
                       'read'   => 'penjualan/',
                       'delete' => 'penjualan/delete'
                       );

    // active menu
    private $active = 'penjualan';

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
                redirect('penjualan/create_list/'.$this->input->post('no_faktur'));
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
            $data['penjualan']  = 'class="active"';
            $data['title']   = $this->c_title;
            $data['action']  = site_url(uri_string());
            $data['no_faktur'] = $this->apps->no_faktur('penjualan');
            $data['q_customer'] = $this->m_global->dropdown('kd_customer', 'nama', 'customer');
            $data['q_kurir'] = $this->m_pegawai->get_kurir();
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
            $kd_barang   = $this->input->post('kd_barang');
            $barang      = $this->m_global->find('kd_barang', $kd_barang, 'barang')->row_array();
            $stok_barang = $barang['jumlah_stok'];
            $stok_min    = $barang['stok_min'];
            $jml_barang  = $this->input->post('jml_barang');

            if (($stok_barang - $jml_barang ) < $stok_min)
            {
                $this->session->set_flashdata('alert', alert('error', 'Stok Barang tidak mencukupi'));
            }
            else
            {
                $query = $this->db->query("SELECT * FROM detail_penjualan WHERE no_faktur = '$no_faktur' AND kd_barang = '$kd_barang'");

                if ($query->num_rows() == 1)
                {
                    $hasil  = $query->row_array();
                    $jumlah = $hasil['jml_barang'] + $jml_barang; // update penjualan jika duplikat data kode barang
                    $data = array(
                            'jml_barang' => $jumlah,
                            'subtotal_harga' => ($barang['harga_jual'] * $jumlah) - (($barang['harga_jual'] * $jumlah) * ($barang['diskon'] / 100))
                            );
                    $this->db->where('no_faktur', $no_faktur)
                            ->where('kd_barang', $kd_barang)
                            ->update('detail_penjualan', $data);
                }
                else
                {
                    $data = array(
                            'no_faktur'  => $no_faktur,
                            'kd_barang'  => $kd_barang,
                            'jml_barang' => $jml_barang,
                            'subtotal_harga' => ($barang['harga_jual'] * $jml_barang) - (($barang['harga_jual'] * $jml_barang) * ($barang['diskon'] / 100))
                            );
                    $this->db->insert('detail_penjualan', $data);
                }
            }

            redirect('penjualan/create_list/'.$no_faktur);
        }
        elseif ($no_faktur)
        {
            $data['alert']     = $this->session->flashdata('alert');
            $data['penjualan'] = 'class="active"';
            $data['title']     = 'TRANSAKSI PENJUALAN BARANG DENGAN NO. FAKTUR '.$this->uri->segment(3);
            $data['action']    = site_url(uri_string());
            $data['q_barang']  = $this->m_global->dropdown('kd_barang', 'nama_barang', 'barang');
            $data['detail_penjualan'] = $this->db->query("SELECT dp.no_faktur, dp.kd_barang, b.nama_barang, b.harga_jual, b.satuan, b.diskon, dp.jml_barang, dp.subtotal_harga
                                                          FROM detail_penjualan dp
                                                          LEFT JOIN barang b ON b.kd_barang = dp.kd_barang
                                                          WHERE dp.no_faktur = '$no_faktur'");
            $data['query']     = FALSE;
            $data['content']   = 'penjualan/create_list';
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
        $data['alert']     = $this->session->flashdata('alert');
        $data['penjualan'] = 'class="active"';
        $data['title']     = $this->r_title;
        $data['action']    = site_url($this->url['delete']);
        $data['query']     = $this->db->query("SELECT p.no_faktur, p.tgl_faktur, p.tgl_jatuh_tempo, c.nama, p.status, (SELECT SUM(subtotal_harga) FROM detail_penjualan WHERE no_faktur = p.no_faktur) AS total_harga
                                               FROM penjualan p
                                               LEFT JOIN customer c ON c.kd_customer = p.kd_customer");
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
            $query = $this->db->query("SELECT p.no_faktur, p.tgl_faktur, p.tgl_jatuh_tempo, c.nama, p.status, (SELECT SUM(subtotal_harga) FROM detail_penjualan WHERE no_faktur = p.no_faktur) AS total_harga
                                       FROM penjualan p
                                       LEFT JOIN customer c ON c.kd_customer = p.kd_customer
                                       WHERE LEFT(tgl_faktur, 7) = '$key'");
            $file_name = 'laporan-penjualan-bulan-'.get_bulan($bulan).'-'.$tahun;
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
                            <td>CUSTOMER</td>
                            <td>TANGGAL FAKTUR</td>
                            <td>TANGGAL JATUH TEMPO</td>
                            <td>TOTAL</td>
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
                $table.= '</tr>';
                $no++;
                $total += $data['total_harga'];
            }
            $table .= '<tr>';
                $table.= '<td colspan="5">TOTAL PENJUALAN</td>';
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
            $data['file_name'] = 'laporan-penjualan-bulan-'.get_bulan($bulan).'-'.$tahun;
            $data['lap_title'] = 'LAPORAN PENJUALAN BULAN '.strtoupper(get_bulan($bulan)). ' '.$tahun;
            $data['query'] = $this->db->query("SELECT p.no_faktur, p.tgl_faktur, p.tgl_jatuh_tempo, c.nama, p.status, (SELECT SUM(subtotal_harga) FROM detail_penjualan WHERE no_faktur = p.no_faktur) AS total_harga
                                       FROM penjualan p
                                       LEFT JOIN customer c ON c.kd_customer = p.kd_customer
                                       WHERE LEFT(tgl_faktur, 7) = '$key'");
            $this->load->view('penjualan/cetak_lap_bulanan', $data);
        }
        else
        {
            $data['alert']         = $this->session->flashdata('alert');
            $data['lap_penjualan'] = 'class="active"';
            $data['title']         = 'LAPORAN PENJUALAN';
            $data['action']        = site_url(uri_string());
            $data['content']       = 'penjualan/lap_bulanan';
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
                ->delete('detail_penjualan');
        redirect('penjualan/create_list/'.$no_faktur);
    }

    private function field_data()
    {
        return array(
               'no_faktur'       => $this->input->post('no_faktur'),
               'kd_customer'     => $this->input->post('kd_customer'),
               'tgl_faktur'      => $this->input->post('tgl_faktur'),
               'tgl_jatuh_tempo' => $this->input->post('tgl_jatuh_tempo'),
               //'jml_harga'       => $this->input->post('jml_harga'),
               'nik'             => $this->session->userdata('nik'),
               'nik_kurir'       => $this->input->post('nik_kurir')
               );
    }

    public function update_stok_barang($no_faktur)
    {
        $query = $this->db->where('no_faktur', $no_faktur)->get('detail_penjualan');
        foreach($query->result() as $row)
        {
            $this->db->query("UPDATE barang SET jumlah_stok = jumlah_stok - '$row->jml_barang' WHERE kd_barang = '$row->kd_barang'");
        }
        $this->db->query("UPDATE penjualan SET is_update = 'y' WHERE no_faktur = '$no_faktur' ");
    }

    public function cetak_faktur()
    {
        $no_faktur = $this->uri->segment(3);
        
        $query = $this->db->where('no_faktur', $no_faktur)->get('detail_penjualan');

        foreach($query->result() as $row)
        {
            $this->db->query("UPDATE barang SET jumlah_stok = jumlah_stok - '$row->jml_barang' WHERE kd_barang = '$row->kd_barang'");
        }

        // Kode Customer
        $qry2 = $this->db->query("SELECT kd_customer FROM penjualan WHERE no_faktur = '$no_faktur'")->row_array();
        $kd_customer = $qry2['kd_customer'];

        // Total penjualan
        $qry1 = $this->db->query("SELECT SUM(subtotal_harga) as total FROM view_penjualan WHERE kd_customer = '$kd_customer'")->row_array();
        $jml_piutang = $qry1['total'];     

        // Update Piutang        
        $this->db->query("UPDATE customer SET jml_piutang = '$jml_piutang' WHERE kd_customer = '$kd_customer'");

        $this->db->query("UPDATE penjualan SET is_update = 'y' WHERE no_faktur = '$no_faktur' ");

        if ($no_faktur)
        {
            $data['head']   = $this->db->query("SELECT p.no_faktur, 
                                                       p.tgl_faktur, 
                                                       p.tgl_jatuh_tempo, 
                                                       c.nama, 
                                                       c.alamat, 
                                                       (SELECT SUM(subtotal_harga) FROM detail_penjualan WHERE no_faktur = p.no_faktur) AS total_harga,
                                                       pg.nama as marketing,
                                                       pg2.nama as kurir
                                                FROM penjualan p
                                                LEFT JOIN customer c ON c.kd_customer = p.kd_customer
                                                LEFT JOIN pegawai pg ON pg.nik = p.nik
                                                LEFT JOIN pegawai pg2 ON pg2.nik = p.nik_kurir
                                                WHERE no_faktur = '$no_faktur'")->row_array();

            $qry2 = $this->db->where('no_faktur', $no_faktur)->get('penjualan')->row_array();
            $nik_pegawai = $qry2['nik'];
            $pegawai_input = $this->db->where('nik', $nik_pegawai)->get('pegawai')->row_array();
            $data['nama_penginput'] = $pegawai_input['nama'];
            $data['jab_penginput'] = $pegawai_input['jabatan'];

            $data['detail'] = $this->db->query("SELECT dp.no_faktur, dp.kd_barang, b.nama_barang, 
                                                       b.harga_jual, 
                                                        b.satuan,
                                                        dp.jml_barang,
                                                        (b.harga_jual * dp.jml_barang) as total,
                                                        b.diskon, 
                                                        ( (b.harga_jual * dp.jml_barang) - ( (b.harga_jual * dp.jml_barang) * ROUND(b.diskon / 100, 2) ) ) AS total_harga
                                                FROM detail_penjualan dp
                                                LEFT JOIN barang b ON b.kd_barang = dp.kd_barang
                                                WHERE dp.no_faktur = '$no_faktur'");
            //echo '<pre>';
            //print_r($data['head']);

            $this->load->view('penjualan/cetak', $data);
        }
        else
        {
            $this->session->set_flashdata('alert', alert('error', status('404')));
            redirect('penjualan/create_list/'.$no_faktur);
        }
    }

    public function print_faktur()
    {
        $no_faktur = $this->uri->segment(3);
        
        if ($no_faktur)
        {
            $data['head']   = $this->db->query("SELECT p.no_faktur, 
                                                       p.tgl_faktur, 
                                                       p.tgl_jatuh_tempo, 
                                                       c.nama, 
                                                       c.alamat, 
                                                       (SELECT SUM(subtotal_harga) FROM detail_penjualan WHERE no_faktur = p.no_faktur) AS total_harga,
                                                       pg.nama as marketing,
                                                       pg2.nama as kurir
                                                FROM penjualan p
                                                LEFT JOIN customer c ON c.kd_customer = p.kd_customer
                                                LEFT JOIN pegawai pg ON pg.nik = p.nik
                                                LEFT JOIN pegawai pg2 ON pg2.nik = p.nik_kurir
                                                WHERE no_faktur = '$no_faktur'")->row_array();
            $qry2 = $this->db->where('no_faktur', $no_faktur)->get('penjualan')->row_array();
            $nik_pegawai = $qry2['nik'];
            $pegawai_input = $this->db->where('nik', $nik_pegawai)->get('pegawai')->row_array();
            $data['nama_penginput'] = $pegawai_input['nama'];
            $data['jab_penginput'] = $pegawai_input['jabatan'];
            
            $data['detail'] = $this->db->query("SELECT dp.no_faktur, dp.kd_barang, b.nama_barang, 
                                                       b.harga_jual, 
                                                        b.satuan,
                                                        dp.jml_barang,
                                                        (b.harga_jual * dp.jml_barang) as total,
                                                        b.diskon, 
                                                        ( (b.harga_jual * dp.jml_barang) - ( (b.harga_jual * dp.jml_barang) * ROUND(b.diskon / 100, 2) ) ) AS total_harga
                                                FROM detail_penjualan dp
                                                LEFT JOIN barang b ON b.kd_barang = dp.kd_barang
                                                WHERE dp.no_faktur = '$no_faktur'");
            //echo '<pre>';
            //print_r($data['head']);

            $this->load->view('penjualan/cetak', $data);
        }
        else
        {
            $this->session->set_flashdata('alert', alert('error', status('404')));
            redirect('penjualan/create_list/'.$no_faktur);
        }
    }

    public function kurir()
    {
        $data['alert']     = $this->session->flashdata('alert');
        $data['penjualan'] = 'class="active"';
        $data['title']     = $this->r_title;
        $data['action']    = site_url($this->url['delete']);
        $data['query']     = $this->db->query("SELECT p.no_faktur, p.tgl_faktur, p.tgl_jatuh_tempo, c.nama, (SELECT SUM(subtotal_harga) FROM detail_penjualan WHERE no_faktur = p.no_faktur) AS total_harga
                                               FROM penjualan p
                                               LEFT JOIN customer c ON c.kd_customer = p.kd_customer");
        $data['content'] = 'penjualan/kurir';
        $this->load->view('layout/index', $data);
    }

    public function lunas()
    {
        $no_faktur = $this->uri->segment(3);
        $query_1 = $this->db->query("SELECT kd_customer, subtotal_harga FROM view_penjualan WHERE no_faktur = '$no_faktur' ")->row_array();
        $kd_customer = $query_1['kd_customer'];
        $jml_piutang = $query_1['subtotal_harga'];

        $this->db->query("UPDATE customer SET jml_piutang = (jml_piutang - '$jml_piutang') WHERE kd_customer = '$kd_customer' ");

        $this->db->where('no_faktur', $no_faktur)->update('penjualan', array('status' => 'y'));
        $this->session->set_flashdata('alert', alert('success', 'Data sudah diperbaharui'));
        redirect('penjualan');
    }
}