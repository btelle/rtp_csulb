<?php
/**
 * faq.php
 *
 * Frequently Asked Questions
 *
 *
 */
require_once('./lib/init.inc.php');

$header_data['title'] = 'FAQs';

$smarty -> assign('header', $header_data);
$smarty -> display('static/faq.tpl');

?>
