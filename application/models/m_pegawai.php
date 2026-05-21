<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_pegawai extends CI_Model {

	/**
     * dropdown()
     * Fungsi untuk membuat form dropdown
     * @return array
     */
    public function get_kurir()
    {
        $query = $this->db->query("SELECT nik, nama FROM pegawai WHERE jabatan = 'kurir'");

        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $data[$row->nik] = $row->nama;
            }
            
            return $data;
        }
        else
        {
            return array();
        }
    }

    public function delete($pk, $id, $table)
    {
        if ( ! is_array($id))
        {
            $query = $this->m_global->find($pk, $id, $table)->row_array();
            $image = $query['photo'];

            $this->db->where($pk, $id);

            if ($this->db->delete($table))
            {
                if ($image != '' && file_exists('./assets/photo/pegawai/'.$image))
                {
                    unlink('./assets/photo/pegawai/'.$image);
                }
            }
            
            return TRUE;
        }
        else
        {
            foreach($id as $id_pegawai)
            {
                $query = $this->m_global->find($pk, $id_pegawai, $table)->row_array();
                $image = $query['photo'];

                $this->db->where($pk, $id_pegawai);

                if ($this->db->delete($table))
                {
                    if ($image != '' && file_exists('./assets/photo/pegawai/'.$image))
                    {
                        unlink('./assets/photo/pegawai/'.$image);
                    }
                }
            }

            return TRUE;
        }
    }
}