<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . 'libraries/password_hash.php';

class Password {
   
    private $hash;

    public function __construct()
    {
        $this->hash = new password_hash(8, FALSE);
    }

  /**
	* hash()
    * Fungsi untuk mengenkripsi password
	* @access	public
    * @param    string
	* @return	string
	*/
    public function hash($password)
    {
        return $this->hash->hash_password($password);
    }

   /**
	* verify()
    * Fungsi untuk memverifikasi password
	* @access	public
    * @param    string  Password yang dikirim users
    * @param    string  Password yang tersimpan dalam database
	* @return	bool
	*/    
    public function verify($password, $hash_password)
    {
        return $this->hash->check_password($password, $hash_password);
    }
}