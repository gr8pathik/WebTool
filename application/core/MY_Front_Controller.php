<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CMS_Controller class
 *
 * @author gofrendi
 */

class MY_Front_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        echo "Front--";
    }
}
