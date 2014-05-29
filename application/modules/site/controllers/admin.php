<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Admin_Controller {

	private $rules = array(
        array(
                'field'   => 'email',
                'label'   => 'lang:Email',
                'rules'   => 'trim|required',
        ),
        array(
                'field'   => 'password',
                'label'   => 'lang:Password',
                'rules'   => 'trim|required',
        )
  	);

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
		if ($this->auth->logged_in() == FALSE){
			redirect('admin/site/login');
		}else {
			$this->template->build('dashboard');
		}

	}

	public function login($value='')
	{
		if ($this->auth->logged_in() == FALSE)
		{
			$this->form_validation->set_rules($this->rules);
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			
			//Set Layout Path to login
    		$this->template->set_layout("login");
			if ($this->form_validation->run() == FALSE){
				$this->template->build('login');
			} else {	
				$this->auth->login($this->input->post('email'), $this->input->post('password'), 'admin/site/login');
			}	
		}else {
			redirect('admin');
		}
	}

	public function logout()
	{
		$this->auth->logout('admin/site/login');
	}

	public function listing($tempVar = 'no')
	{
		var_dump($tempVar);
		echo __FILE__;
		echo "LISTRINH";
		var_dump($this->config->item('table_name'));
		$this->load->view('welcome_message');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */