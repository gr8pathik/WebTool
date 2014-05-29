<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Language extends MY_Front_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }
 
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

		echo lang("msg_first_name");
		echo lang("msg_last_name", "last_name");
		$this->load->view('welcome_message');
	}

	function change($language = "") {
        $language = ($language != "") ? $language : $this->config->item('language');
        $this->session->set_userdata('site_lang', $language);
        redirect(base_url());
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */