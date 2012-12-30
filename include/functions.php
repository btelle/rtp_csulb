<?php 
/**
 * functions.php
 *
 * Contains functions like insert to access the database
 * and the results are returned
 *
 * @author Chethan G
 */
include_once("./include/database.php");


$module = @$_REQUEST[module];
$slug = @$_REQUEST[type];
if (empty($module))
	$module = "home";

$error = array();
$data = array();

$data['headermenu'] = getMenus('header');
$data['footermenu'] = getMenus('footer');
$data['title'] = ucfirst($module);
$data['homelink'] = DOC_ROOT;

$smarty -> assign('data', $data);

function getMenus($position) {
	global $db, $module;
	$www = DOC_ROOT;
	$output = '';

	$sql = 'SELECT * FROM tblmenu where position = "'.$position.'" and type="site" and status=1 order by created_dt LIMIT '.LIMIT_MENU;
	$menus = $db->query($sql);
	while ($menu = mysql_fetch_assoc($menus)) {
		$class = '';
		if ($module == $menu[slug])
			$class = "class='selected'";
		$link = $www.$menu[link];
		$output .= "<li><a href='".$link."' ".$class.">".$menu[description]."</a></li>";
	}
	return $output;
}

?>