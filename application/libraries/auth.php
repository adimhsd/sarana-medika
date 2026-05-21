<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth {

    /**
     * The CodeIgniter super object
     *
     * @var object
     * @access public
     */
    public $CI;

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->CI =& get_instance();
    }

   /**
    * login()
    * Fungsi untuk mengecek ketersediaan account users dalam proses login
    * @access	  public
    * @param    string
    * @return	  bool
    */	
    public function login($username, $password)
    {
        $this->CI->load->library('password');
        /* Pengecekan account users di database */
        $result = $this->CI->db
   		                     ->where('username', $username)
                           ->limit(1)
   		                     ->get('pegawai');

        /* Jika hasil yang didapatkan sama dengan 0 */
     		if ($result->num_rows() == 0)
       	{
            // log_message('error', $username." gagal login !");
            return FALSE;
       	}
       	/* Jika hasil yang didapatkan tidak sama dengan 0 */
        else
       	{
     	      /* Simpan data yang didapatkan kedalam variabel $data berupa single result object */
     	      $data = $result->row();

            if ($this->CI->password->verify($password, $data->password))
            {
                $session_data            = array();
                $session_data['nik']     = $data->nik;
                $session_data['nama']    = $data->nama;
                $session_data['jabatan'] = $data->jabatan;
                $this->CI->session->set_userdata($session_data);
                return TRUE;
            }
            
            return FALSE;
     		}
	  }

   /**
  	* is_logged_in()
    * Fungsi untuk mengecek apakah data session user id kosong / tidak
  	* @access	public    
  	* @return	bool
  	*/
  	public function is_logged_in()
  	{
  	    return $this->CI->session->userdata('nik') != '' ? TRUE : FALSE;
  	}
    
   /**
  	* restrict()
    * Fungsi untuk memvalidasi status login
  	* @access	public
  	* @return	bool
  	*/
  	public function restrict()
  	{
  	    if ( ! $this->is_logged_in() == TRUE)
        {
            redirect(base_url());
        }
  	}

   /**
  	* logout()
    * Fungsi untuk menghapus data session user 
  	* @return	void
  	*/
    public function logout()
  	{
        $this->CI->session->sess_destroy();
  	}
}