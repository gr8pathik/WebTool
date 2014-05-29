<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CMS_Controller class
 *
 * @author gofrendi
 */

class MY_Controller extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
}

/* load the MX_Loader class */
require APPPATH."core/MY_Front_Controller.php";
require APPPATH."core/MY_Admin_Controller.php";