<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barang extends MY_Controller {

    // Primary Key & Table 
    private $pk      = 'kd_barang';
    private $table   = 'barang';

    // Form Create & Display
    private $form    = 'barang/create';
    private $display = 'barang/read';

    // Title
    private $c_title = 'TAMBAH BARANG';
    private $r_title = 'DATA BARANG';
    private $u_title = 'EDIT BARANG';

    // URL
    private $url     = array(
                       'read'   => 'barang/',
                       'delete' => 'barang/delete'
                       );

    // active menu
    private $active = 'barang';

    public function index()
    {
        $this->read();
    }

    public function create()
    {
        if ($_POST)
        {
            if ($this->validation())
            {
                if ($this->m_global->save($this->table, $this->field_data()))
                {
                    $this->session->set_flashdata('alert', alert('success', status('created')));
                    redirect('barang');
                }
                else
                {
                    $this->session->set_flashdata('alert', alert('error', status('existed')));
                    redirect(uri_string());
                }
            }
            else
            {
                $this->session->set_flashdata('alert', alert('error', validation_errors(), TRUE));
                redirect(uri_string());
            }
        }
        else
        {
            $data['alert']   = $this->session->flashdata('alert');
            $data['barang']  = 'class="active"';
            $data['title']   = $this->c_title;
            $data['action']  = site_url(uri_string());
            $data['query']   = FALSE;
            $data['content'] = $this->form;
            $this->load->view('layout/index', $data);
        }
    }

    public function read()
    {
        $data['alert']   = $this->session->flashdata('alert');
        $data['barang']  = 'class="active"';
        $data['title']   = $this->r_title;
        $data['action']  = site_url($this->url['delete']);
        $data['query']   = $this->m_global->find('', '', $this->table);
        $data['content'] = $this->display;
        $this->load->view('layout/index', $data);
    }

    public function update()
    {
        $kd_barang = $this->uri->segment(3);

        if ($_POST)
        {
            if ($this->validation())
            {
                if ($this->m_global->update($this->pk, $kd_barang, $this->table, $this->field_data()))
                {
                    $this->session->set_flashdata('alert', alert('success', status('updated')));
                    redirect(uri_string());
                }
                else
                {
                    $this->session->set_flashdata('alert', alert('error', status('existed')));
                    redirect(uri_string());
                }
            }
            else
            {
                $this->session->set_flashdata('alert', alert('error', validation_errors(), TRUE));
                redirect(uri_string());
            }
        }
        elseif ($kd_barang)
        {
            $data['alert']   = $this->session->flashdata('alert');
            $data['barang']  = 'class="active"';
            $data['title']   = $this->c_title;
            $data['action']  = site_url(uri_string());
            $data['query']   = $this->m_global->find($this->pk, $kd_barang, $this->table)->row_array();
            $data['content'] = $this->form;
            $this->load->view('layout/index', $data);
        }
        else
        {
            $this->session->set_flashdata('alert', alert('error', status('404')));
            redirect($this->url['read']);
        }
    }

    public function delete()
    {
        $kd_barang = $this->uri->segment(3);

        if ($kd_barang)
        {
            if ($this->m_global->delete($this->pk, $kd_barang, $this->table))
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

    private function field_data()
    {
        return array(
               'kd_barang'   => $this->input->post('kd_barang'),
               'nama_barang' => $this->input->post('nama_barang'),
               'harga_beli'  => $this->input->post('harga_beli'),
               'harga_jual'  => $this->input->post('harga_jual'),
               'diskon'      => $this->input->post('diskon'),
               'satuan'      => $this->input->post('satuan'),
               'jumlah_stok' => $this->input->post('jumlah_stok'),
               'stok_min'    => $this->input->post('stok_min')
               );
    }

    private function validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('kd_barang', 'Kode Barang', 'trim|required|xss_clean|callback_kode_check');
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required|xss_clean');
        $this->form_validation->set_rules('harga_beli', 'Harga Beli', 'trim|required|numeric|xss_clean');
        $this->form_validation->set_rules('harga_jual', 'Harga Jual', 'trim|required|numeric|xss_clean');
        $this->form_validation->set_rules('diskon', 'Diskon', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('satuan', 'Satuan', 'trim|required|xss_clean');
        $this->form_validation->set_rules('jumlah_stok', 'Jumlah Stok', 'trim|required|numeric|xss_clean');
        $this->form_validation->set_rules('stok_min', 'Stok Minimum', 'trim|required|numeric|xss_clean');

        $this->form_validation->set_error_delimiters('<i class="icon-remove-sign"></i> ', '<br>');
        return $this->form_validation->run();
    }

    public function kode_check($value)
    {
        $kd_barang = $this->uri->segment(3);

        if ($kd_barang)
        {
            if ( ! $this->m_global->is_exist('kd_barang', $value, $this->table, $this->pk, $kd_barang))
            {
                return TRUE;
            }
            else
            {
                $this->form_validation->set_message('kode_check', '%s sudah digunakan!');
                return FALSE;
            }
        }
        else
        {
            if ( ! $this->m_global->is_exist('kd_barang', $value, $this->table))
            {
                return TRUE;
            }
            else
            {
                $this->form_validation->set_message('kode_check', '%s sudah digunakan!');
                return FALSE;
            }
        }
    }

    public function laporan()
    {
        if ($this->uri->segment(3) && $this->uri->segment(3) == 'cetak')
        {
            $query = $this->db->query("SELECT * FROM barang");
            $file_name = 'laporan-pegawai';
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
            header("Content-Type: application/force-download");
            header("Content-Type: application/octet-stream");
            header("Content-Type: application/download");
            header("Content-Disposition: attachment;filename=laporan-barang.xls");
            header("Content-Transfer-Encoding: binary ");
            $table = "<table border='1'>
                      <tr>
                            <td>NO.</td>
                            <td>KODE</td>
                            <td>NAMA BARANG</td>
                            <td>HARGA BELI</td>
                            <td>HARGA JUAL</td>
                            <td>DISKON</td>
                            <td>SATUAN</td>
                            <td>JUMLAH STOK</td>
                            <td>STOK MINIMAL</td>
                      </tr>";
            $no = 1;
            foreach($query->result_array() as $data)
            {
                $table .= '<tr>';
                $table.= '<td>'.$no.'</td>';
                $table.= '<td>'.$data['kd_barang'].'</td>';
                $table.= '<td>'.$data['nama_barang'].'</td>';
                $table.= '<td>'.$data['harga_beli'].'</td>';
                $table.= '<td>'.$data['harga_jual'].'</td>';
                $table.= '<td>'.$data['diskon'].'</td>';
                $table.= '<td>'.$data['satuan'].'</td>';
                $table.= '<td>'.$data['jumlah_stok'].'</td>';
                $table.= '<td>'.$data['stok_min'].'</td>';
                $table.= '</tr>';
                $no++;    
            }
            $table .= '</table>';
            echo $table;
        }
        else
        {
            $data['alert']   = $this->session->flashdata('alert');
            $data['barang']  = 'class="active"';
            $data['title']   = $this->r_title;
            $data['action']  = site_url($this->url['delete']);
            $data['query']   = $this->m_global->find('', '', $this->table);
            $data['content'] = 'barang/laporan';
            $this->load->view('layout/index', $data);
        }
    }

    public function cetak_pdf()
    {
        $data['query'] = $this->m_global->find('', '', $this->table);
        $this->load->view('barang/cetak_pdf', $data);
    }
}