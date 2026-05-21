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

class MY_Controller extends CI_Controller {
	
    public function __construct()
    {   
        parent::__construct();

        $this->auth->restrict();
    }
}