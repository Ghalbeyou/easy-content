<?php
// load json config file
$config = json_decode(file_get_contents('config.json'), true);
// now set the global variables
$GLOBALS['site_name'] = $config['site_name'];
$GLOBALS['setup'] = $config['setup'];
?>