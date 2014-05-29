<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/

//CodeIgniter calls a few built-in hooks as part of its execution process. You can find a complete list of hooks in the user guide. We’ll use the post_controller_constructor hook which is called immediately after our controller is instantiated and prior to any other method calls.
$hook['post_controller_constructor'] = array(
    'class' => 'LanguageLoader',
    'function' => 'initialize',
    'filename' => 'LanguageLoader.php',
    'filepath' => 'hooks'
);

/* End of file hooks.php */
/* Location: ./application/config/hooks.php */