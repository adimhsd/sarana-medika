<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apps {

	private $CI;

	public function __construct()
	{
		$this->CI =& get_instance();
	}

	public function no_faktur($type = 'pembelian')
	{
        $prefix = date('Y').'.'.date('m').'.';
        $query  = $this->CI->db->query("SELECT MAX(RIGHT(no_faktur, 4)) AS no_max 
                                        FROM $type
                                        WHERE LEFT(no_faktur, 8) = '$prefix'");
        $kode = '';

        if ($query->num_rows() > 0 )
        {
            foreach ($query->result() as $data)
            {
                $temp = ((int) $data->no_max) + 1;
                $kode = str_pad($temp, 4, '0', STR_PAD_LEFT);
            }
        }
        else
        {
            $kode = '0001';
        }

        return $prefix . $kode;
	}

    public function nomor_induk($tgl_lahir, $jns_kelamin)
    {
        $sex = $jns_kelamin == 'Laki-laki' ? '01' : '02';
        $prefix = str_replace('-', '', $tgl_lahir).'.'.$sex.'.';
        $query  = $this->CI->db->query("SELECT MAX(RIGHT(nik, 4)) AS no_max FROM pegawai");
        $kode = '';

        if ($query->num_rows() > 0 )
        {
            foreach ($query->result() as $data)
            {
                $temp = ((int) $data->no_max) + 1;
                $kode = str_pad($temp, 4, '0', STR_PAD_LEFT);
            }
        }
        else
        {
            $kode = '0001';
        }

        return $prefix . $kode;
    }

    public function upload_photo($status = 'pegawai', $width = 113, $height = 170, $maintain_ratio = TRUE)
    {
        $config['upload_path']   = APPPATH . '../assets';
        $config['allowed_types'] = 'jpg';
        $config['max_size']      = '1000';
        $config['encrypt_name']  = TRUE;

        $this->CI->load->library('upload', $config);
        
        if ($this->CI->upload->do_upload('photo') == TRUE)
        {
            $data   = $this->CI->upload->data();
            $config = array(
                      'source_image'   => $data['full_path'],
                      'new_image'      => APPPATH . '../assets/photo/'.$status.'/',
                      'width'          => $width,
                      'height'         => $height,
                      'maintain_ratio' => $maintain_ratio
                      );
            $this->CI->load->library('image_lib', $config);
            $this->CI->image_lib->resize();
            $file = APPPATH . '../assets/' . $data['file_name'];
            unlink($file);
            return $data['file_name'];
        }
        else
        {
            return NULL;
        }
    }
    
    public function delete_photo($file, $status = 'pegawai')
    {
        if (file_exists('./assets/photo/'.$status.'/'.$file))
        {
            unlink('./assets/photo/'.$status.'/'.$file);
        }
    }
 }