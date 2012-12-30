<?php

/**
 * index.php
 * 
 * PHP controller for contact us form.
 * 
 * @author Chethan G
 */
/* 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for
 * more details.
 */

require_once('../lib/init.inc.php');
require_once(FILE_ROOT.'admin/include/functions.php');


$header_data['title'] = 'Admin';

$smarty -> assign('header', $header_data);
$smarty -> assign('error', $error);
$smarty -> assign('data', $data);
$smarty -> display('admin/index.tpl');

?>
