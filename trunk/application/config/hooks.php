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



$hook['post_controller'][] = array(
    'class' => 'DebugToolbar',
    'function' => 'render',
    'filename' => 'DebugToolbar.php',
    'filepath' => 'hooks'
);
$hook['post_controller'][] = array(
    'class' => '',
    'function' => 'runFactory',
    'filename' => 'namespaceses.php',
    'filepath' => 'third_party/'
);


/* End of file hooks.php */
/* Location: ./application/config/hooks.php */