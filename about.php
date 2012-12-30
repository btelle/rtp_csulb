<?php

require_once('./lib/init.inc.php');

$header_data['title'] = 'About Us';

$smarty -> assign('header', $header_data);
$smarty -> display('static/about.tpl');

?>
