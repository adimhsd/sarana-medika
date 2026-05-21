<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_global extends CI_Model {

	/**
	 * find()
	 * Fungsi untuk mengambil record data
	 * @return array
	 */
	public function find($field = '', $value = '', $table, $order_by = '', $order_type = '')
	{
		if ($field != '' && $value != '')
        {
            $this->db->where($field, $value);
        }

        if ($order_by != '')
        {
        	if ($order_type != '')
        	{
        		$this->db->order_by($order_by, $order_type);
        	}
        	else
        	{
        		$this->db->order_by($order_by, 'ASC');
        	}
        }

        return $this->db->get($table);
	}

	/**
	 * save()
	 * Fungsi untuk menyimpan data kedalam tabel
	 * @return boolean
	 */
	public function save($table, $data)
	{
		return $this->db->insert($table, $data);
	}

	/**
	 * update()
	 * Fungsi untuk mengupdate record data dalam tabel
	 * @return boolean
	 */
	public function update($field, $value, $table, $data)
	{
		return $this->db->where($field, $value)->update($table, $data);
	}

	/**
	 * delete()
	 * Fungsi untuk menghapus record data dalam tabel
	 * @return boolean
	 */
	public function delete($field, $value, $table)
	{
		if (is_array($value))
        {
            $this->db->where_in($field, $value);
        }
        else
        {
            $this->db->where($field, $value);
        }

        return $this->db->delete($table);
	}

	/**
	 * dropdown()
	 * Fungsi untuk membuat form dropdown
	 * @return array
	 */
	public function dropdown($key, $value, $table, $is_null = FALSE)
	{
        $query = $this->db->get($table);

        if ($query->num_rows() > 0)
        {
        	if ($is_null != FALSE)
        	{
        		$data[NULL] = 'Pilih :';
        	}

			foreach ($query->result() as $row)
            {
				$data[$row->$key] = $row->$value;
			}
			return $data;
		}
        else
        {
            return array();
        }
	}

	/**
	 * is_exist()
	 * Fungsi untuk mengecek ketersediaan record data
	 * @return boolean
	 */
	public function is_exist($field, $value, $table, $pk = '', $id = '')
	{
		$this->db->where($field, $value);

		if ($id != '')
		{
			$this->db->where($pk . ' != ', $id);
		}

		return $this->db->count_all_results($table) > 0 ? TRUE : FALSE;
	}
}