<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * MY_Admin_Controller class
 *
 * @author pathik gandhi
 */

class MY_Admin_Controller extends MY_Controller
{
	//public $data = array();
    public function __construct()
    {
        parent::__construct();

		// Set Header
        $this->template->set_partial('header','layouts/header');
        // Set Sidebar
        $this->template->set_partial('sidebar','layouts/sidebar');
        //Set theme
        $this->template->set_theme("default");
        //Set Layout Path
        $this->template->set_layout("default");
        //Set Img path
        $this->asset->set_asset_img_path('themes/admin/default');
        //Set Css path
        $this->asset->set_asset_css_path('themes/admin/default');
        //Set Js path
        $this->asset->set_asset_js_path('themes/admin/default');
        //Set data variable
        $this->template->set('userdata', $this->session->all_userdata());
    }
}
