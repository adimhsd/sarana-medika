<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function index()
	{
		$data['dashboard'] = 'class="active"';
		$data['content'] = 'dashboard';
		$this->load->view('layout/index', $data);
	}
}