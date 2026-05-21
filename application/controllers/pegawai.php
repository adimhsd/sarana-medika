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

require_once APPPATH.'third_party/PHPExcel.php';

class Pegawai extends MY_Controller {

    // Primary Key & Table 
    private $pk      = 'nik';
    private $table   = 'pegawai';

    // Form Create & Display
    private $form    = 'pegawai/create';
    private $display = 'pegawai/read';

    // Title
    private $c_title = 'TAMBAH PEGAWAI';
    private $r_title = 'DATA PEGAWAI';
    private $u_title = 'EDIT PEGAWAI';

    // URL
    private $url     = array(
                       'read'   => 'pegawai/',
                       'delete' => 'pegawai/delete'
                       );

    // active menu
    private $active = 'pegawai';

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
                $file = $this->apps->upload_photo('pegawai');
                $this->m_global->save($this->table, $this->field_data($file));
                $this->session->set_flashdata('alert', alert('success', status('created')));
                redirect('pegawai');
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
            $data['pegawai']  = 'class="active"';
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
        $data['pegawai']  = 'class="active"';
        $data['title']   = $this->r_title;
        $data['action']  = site_url($this->url['delete']);
        $data['query']   = $this->db->query("SELECT * FROM pegawai WHERE  jabatan != 'administrator' ORDER BY RIGHT(nik, 4) ASC");
        $data['content'] = $this->display;
        $this->load->view('layout/index', $data);
    }

    public function update()
    {
        $nik = $this->uri->segment(3);

        $data['query'] = $this->m_global->find($this->pk, $nik, $this->table)->row_array();

        if ($_POST)
        {
            if ($this->validation())
            {
                $file = $this->apps->upload_photo('pegawai');

                if ($file != NULL)
                {
                    $this->apps->delete_photo($data['query']['photo'], 'pegawai');
                } 

                $this->m_global->update($this->pk, $nik, $this->table, $this->field_data($file));
                $this->session->set_flashdata('alert', alert('success', status('updated')));
                redirect(uri_string());
            }
            else
            {
                $this->session->set_flashdata('alert', alert('error', validation_errors(), TRUE));
                redirect(uri_string());
            }
        }
        elseif ($nik)
        {
            $data['alert']   = $this->session->flashdata('alert');
            $data['pegawai']  = 'class="active"';
            $data['title']   = $this->c_title;
            $data['action']  = site_url(uri_string());
            $data['query']   = $this->m_global->find($this->pk, $nik, $this->table)->row_array();
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
        $this->load->model('m_pegawai');

        $nik = $this->uri->segment(3);

        if ($nik)
        {
            if ($this->m_pegawai->delete($this->pk, $nik, $this->table))
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
            if ($this->m_pegawai->delete($this->pk, $_POST[$this->pk], $this->table))
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

    private function field_data($image = NULL)
    {
        $this->load->library('password');

        $data = array(
                'nik' => $this->uri->segment(2) == 'create' ? $this->apps->nomor_induk($this->input->post('tgl_lahir'), $this->input->post('jenis_kelamin')) : $this->uri->segment(3),
                'nama' => $this->input->post('nama'),
                'username' => $this->input->post('username'),
                //'password' => $this->input->post('password'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'alamat' => $this->input->post('alamat'),
                'no_telp' => $this->input->post('no_telp'),
                'pendidikan' => $this->input->post('pendidikan'),
                'tgl_masuk_kerja' => $this->input->post('tgl_masuk_kerja'),
                'gaji' => $this->input->post('gaji'),
                'jabatan' => $this->input->post('jabatan')
        );

        if ($image != NULL)
        {
            $data['photo'] = $image;
        }
        
        $password = $this->input->post('password');

        if ($password != '')
        {
            $data['password'] = $this->password->hash($password);
        }

        return $data;
    }

    private function validation()
    {
        $this->load->library('form_validation');
        //$this->form_validation->set_rules('nik',         'NIK',             'trim|required|xss_clean|callback_nik_check');
        $this->form_validation->set_rules('nama',        'Nama',            'trim|required|xss_clean');
        $this->form_validation->set_rules('username',    'Username',        'trim|required|xss_clean|callback_username_check');
        $this->form_validation->set_rules('password',    'Password',        'trim|xss_clean');
        $this->form_validation->set_rules('no_telp',     'Telp',            'trim|numeric|xss_clean');
        $this->form_validation->set_error_delimiters('<i class="icon-remove-sign"></i> ', '<br>');
        return $this->form_validation->run();
    }

    public function username_check($value)
    {
        $nik = $this->uri->segment(3);

        if ($nik)
        {
            if ( ! $this->m_global->is_exist('username', $value, $this->table, $this->pk, $nik))
            {
                return TRUE;
            }
            else
            {
                $this->form_validation->set_message('username_check', '%s sudah digunakan!');
                return FALSE;
            }
        }
        else
        {
            if ( ! $this->m_global->is_exist('username', $value, $this->table))
            {
                return TRUE;
            }
            else
            {
                $this->form_validation->set_message('username_check', '%s sudah digunakan!');
                return FALSE;
            }
        }
    }

    public function nik_check($value)
    {
        $nik = $this->uri->segment(3);

        if ($nik)
        {
            if ( ! $this->m_global->is_exist('nik', $value, $this->table, $this->pk, $nik))
            {
                return TRUE;
            }
            else
            {
                $this->form_validation->set_message('nik_check', '%s sudah digunakan!');
                return FALSE;
            }
        }
        else
        {
            if ( ! $this->m_global->is_exist('nik', $value, $this->table))
            {
                return TRUE;
            }
            else
            {
                $this->form_validation->set_message('nik_check', '%s sudah digunakan!');
                return FALSE;
            }
        }
    }

    public function laporan()
    {
        if ($this->uri->segment(3) && $this->uri->segment(3) == 'cetak')
        {
            $query = $this->db->query("SELECT * FROM pegawai");
            $file_name = 'laporan-pegawai';
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
            header("Content-Type: application/force-download");
            header("Content-Type: application/octet-stream");
            header("Content-Type: application/download");
            header("Content-Disposition: attachment;filename=laporan-pegawai.xls");
            header("Content-Transfer-Encoding: binary ");
            $table = "<table border='1'>
                      <tr>
                            <td>No.</td>
                            <td>NIK</td>
                            <td>NAMA</td>
                            <td>JENIS KELAMIN</td>
                            <td>TEMPAT LAHIR</td>
                            <td>TANGGAL LAHIR</td>
                            <td>ALAMAT</td>
                            <td>TELP</td>
                            <td>PENDIDIKAN</td>
                            <td>TANGGAL MASUK KERJA</td>
                            <td>GAJI</td>
                            <td>JABATAN</td>
                      </tr>";
            $no = 1;
            foreach($query->result_array() as $data)
            {
                $table .= '<tr>';
                $table.= '<td>'.$no.'</td>';
                $table.= '<td>'.$data['nik'].'</td>';
                $table.= '<td>'.$data['nama'].'</td>';
                $table.= '<td>'.$data['jenis_kelamin'].'</td>';
                $table.= '<td>'.$data['tempat_lahir'].'</td>';
                $table.= '<td>'.indo_date($data['tgl_lahir']).'</td>';
                $table.= '<td>'.$data['alamat'].'</td>';
                $table.= '<td>'.$data['no_telp'].'</td>';
                $table.= '<td>'.$data['pendidikan'].'</td>';
                $table.= '<td>'.$data['tgl_masuk_kerja'].'</td>';
                $table.= '<td>'.$data['gaji'].'</td>';
                $table.= '<td>'.$data['jabatan'].'</td>';
                $table.= '</tr>';
                $no++;    
            }
            $table .= '</table>';
            echo $table;
        }
        else
        {
            $data['alert']   = $this->session->flashdata('alert');
            $data['pegawai']  = 'class="active"';
            $data['title']   = $this->r_title;
            $data['action']  = site_url($this->url['delete']);
            $data['query']   = $this->m_global->find('', '', $this->table);
            $data['content'] = 'pegawai/laporan';
            $this->load->view('layout/index', $data);
        }
    }

    public function change_password()
    {
        if ($_POST)
        {
            $password = $this->input->post('password');
            $c_password = $this->input->post('c_password');
            if (! empty($password) && !empty($c_password) && $password === $c_password)
            {
                $this->load->library('password');

                $data = array(
                        'password' => $this->password->hash($password)
                        );
                $this->db->where('nik', $this->session->userdata('nik'))
                         ->update('pegawai', $data);
                $this->session->set_flashdata('alert', alert('success', 'Success !'));
                redirect('dashboard');
            }
            else
            {
                $this->session->set_flashdata('alert', alert('error', 'Error !'));
                redirect(uri_string());
            }
        }
        else
        {
            $data['alert']   = $this->session->flashdata('alert');
            //$data['pegawai'] = 'class="active"';
            $data['title']   = 'CHANGE PASSWORD';
            $data['action']  = site_url(uri_string());
            $data['content'] = 'pegawai/change_password';
            $this->load->view('layout/index', $data);
        }
    }

    public function cetak_pdf()
    {
        $data['query'] = $this->db->query("SELECT * FROM pegawai WHERE  jabatan != 'administrator' ORDER BY RIGHT(nik, 4) ASC");
        $this->load->view('pegawai/cetak_pdf', $data);
    }
}