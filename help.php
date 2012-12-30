<?php
/**
 * faq.php
 *
 * Frequently Asked Questions
 *
 * @author Ibrahim Gokoglu
 */
require_once('./lib/init.inc.php');

$header_data['title'] = 'Help';

$smarty -> assign('header', $header_data);
$smarty -> display('static/faq.tpl');

?>
