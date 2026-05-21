<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();        
    }

    public function index()
    {
        if ($_POST)
        {
            if ($this->validation())
            {
                $username = $this->input->post('username');
                $password = $this->input->post('password');

                if ($this->auth->login($username, $password))
                {
                    redirect('dashboard');
                }
                else
                {
                    redirect('login');
                }
            }
            else
            {
                redirect('login');
            }
        }
        else
        {
            $data['error']  = $this->session->flashdata('login_error');
            $data['title']  = 'Universitas Kuningan';
            $data['action'] = site_url(uri_string());
            $this->load->view('form_login', $data);
        }
    }

    public function logout()
    {
        if ($this->auth->is_logged_in())
        {
            $this->auth->logout();
        }

        redirect(base_url());
    }

	private function validation()
	{
		$this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Nama Akun',  'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Kata Sandi', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<i class="icon-remove-sign"></i> ', '<br>');
        return $this->form_validation->run();
	}
}