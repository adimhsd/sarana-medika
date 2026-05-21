<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Sistem Informasi Manajemen | STIKes Kuningan
 * @version    1.0
 * @author     Anton Sofyan | http://antonsofyan.com | 0857 5988 8922
 * @copyright  (c) 2013
 * @license    Premium
 * @category   Controllers
 * @package    Controllers
 */

class Customer extends MY_Controller {

    // Primary Key & Table 
    private $pk      = 'kd_customer';
    private $table   = 'customer';

    // Form Create & Display
    private $form    = 'customer/create';
    private $display = 'customer/read';

    // Title
    private $c_title = 'TAMBAH CUSTOMER';
    private $r_title = 'DATA CUSTOMER';
    private $u_title = 'EDIT CUSTOMER';

    // URL
    private $url     = array(
                       'read'   => 'customer/',
                       'delete' => 'customer/delete'
                       );

    // active menu
    private $active = 'customer';

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
                    redirect('customer');
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
            $data['customer']  = 'class="active"';
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
        $data['customer']  = 'class="active"';
        $data['title']   = $this->r_title;
        $data['action']  = site_url($this->url['delete']);
        $data['query']   = $this->db->query("SELECT c.kd_customer, 
                                                     c.nama, 
                                                     c.alamat,
                                                     c.no_telp, 
                                                     c.email, 
                                                     c.jml_piutang,
                                                     p.status
                                            FROM customer c
                                            LEFT JOIN view_penjualan p ON p.kd_customer = c.kd_customer
                                            GROUP BY c.kd_customer");
        $data['content'] = $this->display;
        $this->load->view('layout/index', $data);
    }

    public function update()
    {
        $kd_customer = $this->uri->segment(3);

        if ($_POST)
        {
            if ($this->validation())
            {
                if ($this->m_global->update($this->pk, $kd_customer, $this->table, $this->field_data()))
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
        elseif ($kd_customer)
        {
            $data['alert']   = $this->session->flashdata('alert');
            $data['customer']  = 'class="active"';
            $data['title']   = $this->c_title;
            $data['action']  = site_url(uri_string());
            $data['query']   = $this->m_global->find($this->pk, $kd_customer, $this->table)->row_array();
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
        $kd_customer = $this->uri->segment(3);

        if ($kd_customer)
        {
            if ($this->m_global->delete($this->pk, $kd_customer, $this->table))
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
               'nama'        => $this->input->post('nama'),
               'alamat'      => $this->input->post('alamat'),
               'no_telp'     => $this->input->post('no_telp'),
               'email'       => $this->input->post('email') == '' ? NULL : $this->input->post('email'),
               //'jml_piutang' => $this->input->post('jml_piutang'),
               //'tgl_daftar'  => $this->input->post('tgl_daftar') == '' ? date('Y-m-d') : $this->input->post('tgl_daftar')
               );
    }

    private function validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama',        'Nama customer',  'trim|required|xss_clean');
        $this->form_validation->set_rules('alamat',      'Alamat',         'trim|required|xss_clean');
        $this->form_validation->set_rules('no_telp',     'Telp',           'trim|required|numeric|xss_clean');
        $this->form_validation->set_rules('email',       'Email',          'trim|valid_email|xss_clean|callback_email_check');
        $this->form_validation->set_rules('jml_piutang', 'Jumlah Piutang', 'trim|numeric|xss_clean');
        $this->form_validation->set_rules('tgl_daftar',  'Tanggal Daftar', 'trim|xss_clean');
        $this->form_validation->set_error_delimiters('<i class="icon-remove-sign"></i> ', '<br>');
        return $this->form_validation->run();
    }

    public function email_check($value)
    {
        $kd_customer = $this->uri->segment(3);

        if ($kd_customer)
        {
            if ( ! $this->m_global->is_exist('email', $value, $this->table, $this->pk, $kd_customer))
            {
                return TRUE;
            }
            else
            {
                $this->form_validation->set_message('email_check', '%s sudah digunakan!');
                return FALSE;
            }
        }
        else
        {
            if ( ! $this->m_global->is_exist('email', $value, $this->table))
            {
                return TRUE;
            }
            else
            {
                $this->form_validation->set_message('email_check', '%s sudah digunakan!');
                return FALSE;
            }
        }
    }

    public function laporan()
    {
        if ($this->uri->segment(3) && $this->uri->segment(3) == 'cetak')
        {
            $query = $this->db->query("SELECT c.kd_customer, 
                                                         c.nama, 
                                                         c.alamat,
                                                         c.no_telp, 
                                                         c.email, 
                                                         SUM(p.subtotal_harga) as piutang,
                                                         p.status
                                            FROM customer c
                                            LEFT JOIN view_penjualan p ON p.kd_customer = c.kd_customer
                                            GROUP BY c.kd_customer");
            $file_name = 'laporan-customer';
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
            header("Content-Type: application/force-download");
            header("Content-Type: application/octet-stream");
            header("Content-Type: application/download");
            header("Content-Disposition: attachment;filename=laporan-customer.xls");
            header("Content-Transfer-Encoding: binary ");
            $table = "<table border='1'>
                      <tr>
                            <td>NO.</td>
                            <td>NAMA</td>
                            <td>ALAMAT</td>
                            <td>TELP</td>
                            <td>EMAIL</td>
                            <td>JUMLAH PIUTANG</td>
                      </tr>";
            $no = 1;
            foreach($query->result_array() as $data)
            {
                $table .= '<tr>';
                $table.= '<td>'.$no.'</td>';
                $table.= '<td>'.$data['nama'].'</td>';
                $table.= '<td>'.$data['alamat'].'</td>';
                $table.= '<td>'.$data['no_telp'].'</td>';
                $table.= '<td>'.$data['email'].'</td>';
                if ($data['status'] == 'n')
                {
                    $table.= '<td>Rp. '.rupiah($data['piutang']).'</td>';    
                }
                else
                {
                    $table.= '<td>Rp. 0</td>';
                }                
                $table.= '</tr>';
                $no++;    
            }
            $table .= '</table>';
            echo $table;
        }
        else
        {
            $data['alert']   = $this->session->flashdata('alert');
            $data['customer']  = 'class="active"';
            $data['title']   = $this->r_title;
            $data['action']  = site_url($this->url['delete']);
            $data['query']   = $this->m_global->find('', '', $this->table);
            $data['content'] = 'customer/laporan';
            $this->load->view('layout/index', $data);
        }
    }

    public function cetak_pdf()
    {
        $data['query'] = $this->db->query("SELECT c.kd_customer, 
                                                         c.nama, 
                                                         c.alamat,
                                                         c.no_telp, 
                                                         c.email, 
                                                         SUM(p.subtotal_harga) as piutang,
                                                         p.status
                                            FROM customer c
                                            LEFT JOIN view_penjualan p ON p.kd_customer = c.kd_customer
                                            GROUP BY c.kd_customer");
        $this->load->view('customer/cetak_pdf', $data);
    }
}