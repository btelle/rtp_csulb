<?php 
/**
 * admin/include/functions.php
 *
 * Contains functions like insert to access the database
 * and the results are returned
 *
 * @author Chethan G
 */

// Checks if the User is logged in and has the admin rights else
// redirect back to the home page
if (empty($_SESSION['user_id']) || $_SESSION['user_role'] != 1) {
	header("location:".DOC_ROOT);
	exit;
}

//include database actions
include_once("./include/database.php");

//placeholder for the menu
$menuPos = array ('' => 'Select Position', 'header' => 'Header', 'footer' => 'Footer', 'lsidebar' => 'Left Sidebar', 'rsidebar' => 'Right Sidebar');

//Check for the current module. If no module is present then initialize to 'home'
$module = @$_REQUEST[module];
if (empty($module))
	$module = "home";

$error = array();
$data = array();

$data['headermenu'] = getMenus('header');
$data['leftsidebar'] = sideContent();
$data['footermenu'] = getMenus('footer');
$data['title'] = getPageTitle($module);

$data['maincontent'] = mainContent();

function getString($name='') {
	global $string;
	if ($name)
		return $string[$name];
}

//Gets the title for the current page
function getPageTitle($module) {
	global $db;
	$www = DOC_ROOT.'admin';
	$output = '';

	$sql = 'SELECT description FROM tblmenu where  slug = "'.$module.'" and type="admin" order by created_dt';
	$menus = $db->query($sql);
	$menu = mysql_fetch_assoc($menus);
	return $menu[description];
}

//Gets the Menu's for the header and the footer
function getMenus($position) {
	global $db, $module;
	$www = DOC_ROOT.'admin';
	$output = '';

	$sql = 'SELECT description, link, slug FROM tblmenu where  position = "'.$position.'" and type="admin" order by id';
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

// Placeholder for Add, Edit and View options on the left side bar
function sideContent() {
	global $db, $module;
	$header = 'Actions';
        //Side bar menu items name to select the actions for the current page
        $tasks = array();
        //Side bar menu items link
	$links = array();

	switch($module) {

		case 'home':
					//$header = 'Recent Activity' for future enhancements
					$header = '';
					break;

		case 'menus':
					$tasks = array('add' => 'Add Menu', 'edit' => 'Edit Menu', 'view' => 'View Menus');
					$link = array('add' => '?module='.$module.'&action=add', 'edit' => '#', 'view' => '?module='.$module); 
					break;

		case 'pages':
					$tasks = array('add' => 'Add Page', 'edit' => 'Edit Page', 'view' => 'View Pages');												
					$link = array('add' => '?module='.$module.'&action=add', 'edit' => '#', 'view' => '?module='.$module); 					
					break;

		case 'sections':
					$tasks = array('add' => 'Add Section', 'edit' => 'Edit Section', 'view' => 'View Sections');
					$link = array('add' => '?module='.$module.'&action=add', 'edit' => '#', 'view' => '?module='.$module); 					
					break;

		case 'space':
					$tasks = array('add' => 'Add Space', 'edit' => 'Edit Space', 'view' => 'View Spaces');											
					$link = array('add' => '?module='.$module.'&action=add', 'edit' => '#', 'view' => '?module='.$module); 					
					break;

		case 'spacetype':
					$tasks = array('add' => 'Add Space Type', 'edit' => 'Edit Space Type', 'view' => 'View Space Type');											
					$link = array('add' => '?module='.$module.'&action=add', 'edit' => '#', 'view' => '?module='.$module); 					
					break;

		case 'locations':
					$tasks = array('add' => 'Add Location', 'edit' => 'Edit Location', 'view' => 'View Locations');											
					$link = array('add' => '?module='.$module.'&action=add', 'edit' => '#', 'view' => '?module='.$module); 					
					break;

		case 'lotdetails':
					$tasks = array('add' => 'Add Lot Detail', 'edit' => 'Edit Lot Detail', 'view' => 'View Lots Detail');									
					$link = array('add' => '?module='.$module.'&action=add', 'edit' => '#', 'view' => '?module='.$module); 					
					break;

		case 'events':
					$tasks = array('add' => 'Add Event', 'edit' => 'Edit Event', 'view' => 'View Events');												
					$link = array('add' => '?module='.$module.'&action=add', 'edit' => '#', 'view' => '?module='.$module); 					
					break;

		default:	break;

	}

	return actions($tasks, $link, '', $header);	
}

//To display the side bar items by populating the corresponding name and title
//Build the side menu
function actions($tasks, $link, $params='', $header = 'Actions') {

	$output = '<h3>'.$header.'</h3>';

        //Default action is "View"
	$task = $_REQUEST[action];
	if (empty($task))
		$task = 'view';
        
	foreach ($tasks as $action => $name) {
                //Highlight the current action
		if ($action != $task)
			$output .= '<li '.$params[$action].'><a href="'.$link[$action].'" >'.$name.'</a></li>';
		else 
			$output .= '<li class="selected" '.$params[$action].'><a href="'.$link[$action].'" >'.$name.'</a></li>';
	}
	return $output;
}

//Build queries to access content for different modules
function mainContent() {
	global $db, $module;
        //Places all the request variables into individual variable names
	extract($_REQUEST);

	switch($module) {

		case 'home':
					$sql = 'SELECT * FROM tblmenu where position = "header" and type="admin" order by id';
					break;

		case 'menus':
					$sql = 'SELECT * FROM tblmenu where type<>"admin" order by id';										
					break;

		case 'pages':
					$sql = 'SELECT * FROM tblpages where status = 1 order by title';
					break;

		case 'sections':
					$sql = 'SELECT * FROM tblcampus_section where 1 order by id';
					break;

		case 'space':
					$sql = 'SELECT s.*, l.type as lotname,st.full_text as spacename FROM tblspace as s, tbllot as l, tblspace_type as st where st.type=s.type and s.lot_id=l.id order by s.id';
					break;
                                    
                case 'lotdetails':
                                       $sql = 'SELECT * FROM tbllot where 1 order by id';
                                       break;
                                   
		case 'spacetype':
					$sql = 'SELECT * FROM tblspace_type where 1 order by type';
					break;

		case 'locations':
					$sql = 'SELECT l.*, s.section as sectionname FROM tbllocation as l, tblcampus_section as s  where l.section=s.id order by l.location';
					break;

		case 'events':
					$sql = 'SELECT *, u.name FROM tblevent as e, tblusers as u where e.created_by = u.uid order by e.created_dt';
					break;

		default:	break;

	}	
	$sqlresult = $db->query($sql);

        //build the corresponding function name to be called for the current module
	$functionName = $module.'Assist';

        //Build the path for the icon
	$imagePath = FILE_ROOT.'/admin/images/'.$module.'.png';

        //Check if the image exists else display the default image
	if (file_exists($imagePath))
		$icon = DOC_ROOT.'admin/images/'.$module.'.png';
	else 
		$icon = DOC_ROOT.'admin/images/default.png';

	$output = '<h2><img src="'.$icon.'" height="30px"> '.getPageTitle($module).'</h2>';
        /*Call the current module function with its respective parameters
        $action Gets the corresponding action for the page(Add,Edit and View)
        $module current page
        $editid- this is passed only when the action is "Edit" else '' */
	$output .= $functionName($sqlresult, $action, $module, $editid);
        //return the result
	return $output;
}

/******************************************** Start Home ***********************************************/
//Display all the Admin menu items
function homeAssist($home, $action = '', $module = '', $editid = '') {
	
	$output .= '<div class="menuitems">';
		while ($result = mysql_fetch_assoc($home)) {
			$imagePath = FILE_ROOT.'/admin/images/'.$result[slug].'.png';
			
			if (file_exists($imagePath))
				$icon = DOC_ROOT.'admin/images/'.$result[slug].'.png';
			else 
				$icon = DOC_ROOT.'admin/images/default.png';

			$output .= "<div><a href='".DOC_ROOT."admin/".$result[link]."'><img src='".$icon."'> <br/> ".$result[description]."</a></div>";
		}
	$output .= '</div>';
	return $output;
}

/********************************************* End Home ************************************************/

/********************************************* Start Menu ************************************************/
//Display the list of Menu Items to perform specific action
function menusAssist($menus, $action = '', $module = '', $editid = '') {
					
	$output .= '<table width="100%" cellpadding="0" cellspacing="0" class="listtable">';
                //if the action is "add" display the menu add form
		if ($action == 'add') {
			$output .= '<tr>';
				$output .= '<form action="actions.php" method="post">';
					$output .= '<td align="left" style="height:40px;"><b>Add Menu</b></td>';
                                        //Add the Menu Add form
					$output .= menuForm();
					$output .= '<td colspan=2><input type="hidden" name="action" value="add"><input type="hidden" name="module" value="'.$module.'"><input type="submit" value="Add Menu"></td>';
				$output .= '</form>';
			$output .= '</tr>';
		}

                //Prepare the headings to display Menu items
		$output .= '<tr>';
			$output .= '<th align="left">No.</th>';
			$output .= '<th align="left">Description</th>';
			$output .= '<th align="left">Link</th>';
			$output .= '<th align="left">Position</th>';
			$output .= '<th align="left">ID</th>';
			$output .= '<th>Action</th>';
		$output .= '</tr>';
			
                //Start displaying the menu Items
		$count = 1;
		while($menu = mysql_fetch_assoc($menus)) { 
			$output .= '<tr>';
                                //Check if the current item is being edited if it is
                                //then display the edit form
				if ($menu['id'] == $editid) {
					$output .= '<form action="actions.php" method="post">';
						$output .= '<td align="left" style="height:40px;">'.$count++.'</td>';
						$output .= menuForm($menu);
						$output .= '<td colspan=2><input type="hidden" name="action" value="edit">
							<input type="hidden" name="module" value="'.$module.'">
							<input type="hidden" name="id" value="'.$menu['id'].'">
							<input type="submit" value="Change">
							<input type="button" value="Cancel" onClick="location.href=\'?module='.$module.'\'"></td>';
					$output .= '</form>';
				} else { //else display the contents
					$output .= '<td>'.$count++.'</td>';
					$output .= '<td><a href="?module='.$module.'&action=edit&editid='.$menu['id'].'">'.$menu['description'].'</a></td>';	
					$output .= '<td>'.$menu['link'].'</td>';
					$output .= '<td>'.$menu['position'].'</td>';									
					$output .= '<td>'.$menu['id'].'</td>';
					$status = 1;
                                        //Check the status of the menu. If red(0) then the menu will not be displayed
					if ($menu['status'])
						$status = 0;
                                        //the corresponding actions are called based on the action items
                                        //this calls actions.php with module name, type of action and corresponding id if needed
					$output .= '<td align="center"><a href="?module='.$module.'&action=edit&editid='.$menu['id'].'"><img src="./images/edit.png" /></a> &nbsp; <a href="actions.php/?module='.$module.'&action=delete&id='.$menu['id'].'"><img src="./images/delete.png"/></a> &nbsp; <a href="actions.php/?module='.$module.'&action=status&status='.$status.'&id='.$menu['id'].'"><img src="./images/'.$menu['status'].'.png"/></a></td>';
				}
			$output .= '</tr>';
		}		
	$output .= '</table>';

	return $output;
}

//Build the Edit form if menu is passed else build the Add form
function menuForm($menu = '') {
	global $menuPos;

	$output .= '<td align="left"><input type="text" name="menuname" value="'.$menu['description'].'" size=15></td>';
	$output .= '<td align="left"><input type="text" name="menulink" value="'.$menu['link'].'" size=30></td>';
	$output .= '<td align="left">';
		$output .= '<select name="menupos" style="width:115px">';
			foreach ($menuPos as $pos => $value) {
                                //Selection of the position for the menu
                                //Current position for the existing menus
				if ($pos == $menu['position'])
					$output .= '<option value="'.$pos.'" selected>'.$value.'</option>';
				else 
					$output .= '<option value="'.$pos.'">'.$value.'</option>';
			}
		$output .= '</select>';
	$output .= '</td>';

	return $output;
}
/********************************************* End Menu ************************************************/

/********************************************* Start Pages ************************************************/
//The logic is same as in the menusAssist function
function pagesAssist($pages, $action, $module, $editid='') {
	global $db;

	switch($action) {
		case 'add': 
		case 'edit':
					if (isset($editid)) {
						$sql = 'SELECT * FROM tblpages where id = '.$editid.' order by title';
						$results = $db->query($sql);
						$content =  @mysql_fetch_array($results);
						extract($content);
					}

					include "include/pageForm.php";				
					break;

		default: 
					$output = '<table width="100%" cellpadding="0" cellspacing="0" class="listtable">';
						$output .= '<tr>';
							$output .= '<th align="left">No.</th>';
							$output .= '<th align="left" width="35%">Title</th>';
							$output .= '<th align="left" width="30%">Page Link</th>';
							$output .= '<th align="left">ID</th>';
							$output .= '<th>Action</th>';
						$output .= '</tr>';

						$count = 1;
						while($page = @mysql_fetch_assoc($pages)) { 
							$output .= '<tr>';
								$output .= '<td style="padding-left:5px;">'.$count++.'</td>';
								$output .= '<td><a href="?module='.$module.'&action=edit&editid='.$page['id'].'">'.$page['title'].'</td>';	
								$output .= '<td><a href="'.DOC_ROOT.'?module='.$module.'&type='.$page['slug'].'" target="_blank" >type='.$page['slug'].'</td>';	
								$output .= '<td>'.$page['id'].'</td>';
								$output .= '<td align="center"><a href="?module='.$module.'&action=edit&editid='.$page['id'].'"><img src="./images/edit.png" /></a> &nbsp; <a href="actions.php/?module='.$module.'&action=delete&id='.$page['id'].'"><img src="./images/delete.png"/></a></td>';	
							$output .= '</tr>';
						}
					$output .= '</table>';
					break;
	}

	return $output;
}
/********************************************* End Pages ************************************************/

/********************************************* Start Sections ************************************************/
//The logic is same as in the menusAssist function
function sectionsAssist($sections, $action = '', $module = '', $editid = '') {
					
	$output .= '<table width="60%" cellpadding="0" cellspacing="0" class="listtable">';
		if ($action == 'add') {
			$output .= '<tr>';
				$output .= '<form action="actions.php" method="post">';
					$output .= '<td align="left" style="height:40px;"><b>Add Section</b></td>';
					$output .= '<td align="left"><input type="text" name="sectionname" value="" size=15></td>';
					$output .= '<td colspan=2><input type="hidden" name="action" value="add"><input type="hidden" name="module" value="'.$module.'"><input type="submit" value="Add Section"></td>';
				$output .= '</form>';
			$output .= '</tr>';
		}

		$output .= '<tr>';
			$output .= '<th align="left">No.</th>';
			$output .= '<th align="left">Section</th>';
			$output .= '<th align="left">ID</th>';
			$output .= '<th>Action</th>';
		$output .= '</tr>';
			

		$count = 1;
		while($section = mysql_fetch_assoc($sections)) { 
			$output .= '<tr>';

				if ($section['id'] == $editid) {
					$output .= '<form action="actions.php" method="post">';
						$output .= '<td align="left" style="height:40px;">'.$count++.'</td>';
						$output .= '<td align="left"><input type="text" name="sectionname" value="'.$section['section'].'" size=15></td>';
						$output .= '<td colspan=2><input type="hidden" name="action" value="edit">
							<input type="hidden" name="module" value="'.$module.'">
							<input type="hidden" name="id" value="'.$section['id'].'">
							<input type="submit" value="Change">
							<input type="button" value="Cancel" onClick="location.href=\'?module='.$module.'\'"></td>';
					$output .= '</form>';
				} else {
					$output .= '<td>'.$count++.'</td>';
					$output .= '<td><a href="?module='.$module.'&action=edit&editid='.$section['id'].'">'.$section['section'].'</a></td>';	
					$output .= '<td>'.$section['id'].'</td>';
					$output .= '<td align="center"><a href="?module='.$module.'&action=edit&editid='.$section['id'].'"><img src="./images/edit.png" /></a> &nbsp; <a href="actions.php/?module='.$module.'&action=delete&id='.$section['id'].'"><img src="./images/delete.png"/></a></td>';	
				}
			$output .= '</tr>';
		}		
	$output .= '</table>';

	return $output;
}
/********************************************* End Sections ************************************************/

/********************************************* Start Space Type ************************************************/
//The logic is same as in the menusAssist function
function spacetypeAssist($spaces, $action = '', $module = '', $editid = '') {
					
	$output .= '<table width="70%" cellpadding="0" cellspacing="0" class="listtable">';
		if ($action == 'add') {
			$output .= '<tr>';
				$output .= '<form action="actions.php" method="post">';
					$output .= '<td align="left" style="height:40px;"><b>Add Space</b></td>';
					$output .= '<td align="left"><input type="text" name="spacetype" value="" size=15></td>';
					$output .= '<td align="left"><input type="text" name="spacetext" value="" size=15></td>';
					$output .= '<td colspan=2><input type="hidden" name="action" value="add"><input type="hidden" name="module" value="'.$module.'"><input type="submit" value="Add Space"></td>';
				$output .= '</form>';
			$output .= '</tr>';
		}

		$output .= '<tr>';
			$output .= '<th align="left">No.</th>';
			$output .= '<th align="left">Type</th>';
			$output .= '<th align="left">Full Text</th>';
			$output .= '<th>Action</th>';
		$output .= '</tr>';
			

		$count = 1;
		while($space = mysql_fetch_assoc($spaces)) { 
			$output .= '<tr>';

				if ($space['id'] == $editid) {
					$output .= '<form action="actions.php" method="post">';
						$output .= '<td align="left" style="height:40px;">'.$count++.'</td>';
						$output .= '<td align="left"><input type="text" name="spacetype" value="'.$space['type'].'" size=15></td>';
						$output .= '<td align="left"><input type="text" name="spacetext" value="'.$space['full_text'].'" size=25></td>';
						$output .= '<td colspan=2><input type="hidden" name="action" value="edit">
							<input type="hidden" name="module" value="'.$module.'">
							<input type="hidden" name="id" value="'.$space['id'].'">
							<input type="submit" value="Change">
							<input type="button" value="Cancel" onClick="location.href=\'?module='.$module.'\'"></td>';
					$output .= '</form>';
				} else {
					$output .= '<td>'.$count++.'</td>';
					$output .= '<td><a href="?module='.$module.'&action=edit&editid='.$space['id'].'">'.$space['type'].'</a></td>';	
					$output .= '<td>'.$space['full_text'].'</td>';	
					$output .= '<td align="center"><a href="?module='.$module.'&action=edit&editid='.$space['id'].'"><img src="./images/edit.png" /></a> &nbsp; <a href="actions.php/?module='.$module.'&action=delete&id='.$space['id'].'"><img src="./images/delete.png"/></a></td>';	
				}
			$output .= '</tr>';
		}		
	$output .= '</table>';

	return $output;
}

/********************************************* End Space Type ************************************************/

/********************************************* Start Space ************************************************/
function spaceAssist($spaces, $action = '', $module = '', $editid = '') {
					
	$output .= '<table width="100%" cellpadding="0" cellspacing="0" class="listtable">';
		if ($action == 'add') {
			$output .= '<tr>';
				$output .= '<form action="actions.php" method="post">';
					$output .= '<td align="left" style="height:40px;"><b>Add Space</b></td>';
					$output .= '<td align="left">'.spaceForm()."</td>";
					$output .= '<td align="left">'.lotForm()."</td>";
					$output .= '<td align="left"><input type="text" name="capacity" value="'.$space['capacity'].'" size=4></td>';
					$output .= '<td align="left"><input type="text" name="occupied" value="'.$space['occupied'].'" size=4></td>';
					$output .= '<td colspan=2><input type="hidden" name="action" value="add"><input type="hidden" name="module" value="'.$module.'"><input type="submit" value="Add space"></td>';
				$output .= '</form>';
			$output .= '</tr>';
		}

		$output .= '<tr>';
			$output .= '<th align="left">No.</th>';
			$output .= '<th align="left">Space Type</th>';
			$output .= '<th align="left">Lot</th>';
			$output .= '<th align="left">Capacity</th>';
			$output .= '<th align="left">Occupied</th>';
			$output .= '<th align="left">ID</th>';
			$output .= '<th>Action</th>';
		$output .= '</tr>';
			

		$count = 1;
		while($space = mysql_fetch_assoc($spaces)) { 
			$output .= '<tr>';

				if ($space['id'] == $editid) {
					$output .= '<form action="actions.php" method="post">';
						$output .= '<td align="left" style="height:40px;">'.$count++.'</td>';
						$output .= '<td align="left">'.spaceForm($space['type'])."</td>";
						$output .= '<td align="left">'.lotForm($space['lot_id'])."</td>";
						$output .= '<td align="left"><input type="text" name="capacity" value="'.$space['capacity'].'" size=4></td>';
						$output .= '<td align="left"><input type="text" name="occupied" value="'.$space['occupied'].'" size=4></td>';
						$output .= '<td colspan=2><input type="hidden" name="action" value="edit">
							<input type="hidden" name="module" value="'.$module.'">
							<input type="hidden" name="id" value="'.$space['id'].'">
							<input type="submit" value="Change">
							<input type="button" value="Cancel" onClick="location.href=\'?module='.$module.'\'"></td>';
					$output .= '</form>';
				} else {
					$output .= '<td>'.$count++.'</td>';
					$output .= '<td><a href="?module='.$module.'&action=edit&editid='.$space['id'].'">'.$space['spacename'].'</a></td>';	
					$output .= '<td>'.$space['lotname'].'</td>';
					$output .= '<td>'.$space['capacity'].'</td>';									
					$output .= '<td>'.$space['occupied'].'</td>';
					$output .= '<td>'.$space['id'].'</td>';
					$output .= '<td align="center"><a href="?module='.$module.'&action=edit&editid='.$space['id'].'"><img src="./images/edit.png" /></a> &nbsp; <a href="actions.php/?module='.$module.'&action=delete&id='.$space['id'].'"><img src="./images/delete.png"/></a></td>';	
				}
			$output .= '</tr>';
		}		
	$output .= '</table>';

	return $output;
}


function spaceForm($space = '') {
	global $db;

	$sql = 'SELECT DISTINCT type, full_text as spacename FROM tblspace_type order by type';
	$results = $db->query($sql);
	
	$output .= '<select name="type" style="width:180px">';
	while ($content =  @mysql_fetch_array($results)) {
		//echo $content['type'].' '.$space."<br/>";
		if ($content['type'] == $space)
			$output .= '<option value="'.$content['type'].'" selected>'.$content['spacename'].'</option>';
		else 
			$output .= '<option value="'.$content['type'].'">'.$content['spacename'].'</option>';
	}
	$output .= '</select>';

	return $output;
}
/********************************************* End Space ************************************************/

/********************************************* Start Location ************************************************/
function locationsAssist($locations, $action = '', $module = '', $editid = '') {
					
	$output .= '<table width="100%" cellpadding="0" cellspacing="0" class="listtable">';
		if ($action == 'add') {
			$output .= '<tr>';
				$output .= '<form action="actions.php" method="post">';
					$output .= '<td align="left" style="height:40px;"><b>Add Location</b></td>';
					$output .= locationForm();
					$output .= '<td colspan=2><input type="hidden" name="action" value="add"><input type="hidden" name="module" value="'.$module.'"><input type="submit" value="Add Location"></td>';
				$output .= '</form>';
			$output .= '</tr>';
		}

		$output .= '<tr>';
			$output .= '<th align="left">No.</th>';
			$output .= '<th align="left">Location</th>';
			$output .= '<th align="left">Section</th>';
			$output .= '<th align="left">Major</th>';
			$output .= '<th align="left">ID</th>';
			$output .= '<th>Action</th>';
		$output .= '</tr>';
			

		$count = 1;
		while($location = mysql_fetch_assoc($locations)) { 
			$output .= '<tr>';

				if ($location['id'] == $editid) {
					$output .= '<form action="actions.php" method="post">';
						$output .= '<td align="left" style="height:40px;" id="'.$location['id'].'">'.$count++.'</td>';
						$output .= locationForm($location);
						$output .= '<td colspan=2><input type="hidden" name="action" value="edit">
							<input type="hidden" name="module" value="'.$module.'">
							<input type="hidden" name="id" value="'.$location['id'].'">
							<input type="submit" value="Change">
							<input type="button" value="Cancel" onClick="location.href=\'?module='.$module.'\'"></td>';
					$output .= '</form>';
				} else {
					$output .= '<td>'.$count++.'</td>';
					$output .= '<td><a href="?module='.$module.'&action=edit&editid='.$location['id'].'#'.$location['id'].'">'.$location['location'].'</a></td>';	
					$output .= '<td>'.$location['sectionname'].'</td>';
					$important = 'No';
					if ($location['important'])
						$important = 'Yes';
					$output .= '<td>'.$important.'</td>';									
					$output .= '<td>'.$location['id'].'</td>';
					$output .= '<td align="center"><a href="?module='.$module.'&action=edit&editid='.$location['id'].'#'.$location['id'].'"><img src="./images/edit.png" /></a> &nbsp; <a href="actions.php/?module='.$module.'&action=delete&id='.$location['id'].'"><img src="./images/delete.png"/></a></td>';	
				}
			$output .= '</tr>';
		}		
	$output .= '</table>';

	return $output;
}


function locationForm($location = '') {
	global $db;

	$sections = $db->query("select id, section from tblcampus_section where 1 order by id");


	$locImportant = array ('' => 'Select', 1 => 'Yes', 0 => 'No');

	$output .= '<td align="left"><input type="text" name="locationname" value="'.$location['location'].'" size=35></td>';

	$output .= '<td align="left">';
		$output .= '<select name="locationsection" style="width:155px">';
			while($section = mysql_fetch_assoc($sections)) { 	
				if ($section['id'] == $location['section'])
					$output .= '<option value="'.$section['id'].'" selected>'.$section['section'].'</option>';
				else 
					$output .= '<option value="'.$section['id'].'">'.$section['section'].'</option>';
			}
		$output .= '</select>';
	$output .= '</td>';

	$output .= '<td align="left">';
		$output .= '<select name="locationimportant" style="width:70px">';
			foreach ($locImportant as $pos => $value) {
				if ($pos == $location['important'])
					$output .= '<option value="'.$pos.'" selected>'.$value.'</option>';
				else 
					$output .= '<option value="'.$pos.'">'.$value.'</option>';
			}
		$output .= '</select>';
	$output .= '</td>';

	return $output;
}
/********************************************* End Location ************************************************/

/********************************************* Start Lot Details ************************************************/
function lotdetailsAssist($lotdetails, $action, $module, $editid='') {
	global $db;
 	switch($action) {
		case 'add':
		case 'edit':
					if (isset($editid)) {
						$sql = 'SELECT * FROM tbllot where id = '.$editid.' order by id';
						$results = $db->query($sql);
						$content =  @mysql_fetch_array($results);
						extract($content);
					}

					include "include/lotdetailForm.php";
					break;

		default:
					$output = '<table width="100%" cellpadding="0" cellspacing="0" class="listtable">';
						$output .= '<tr>';
							$output .= '<th align="left">No.</th>';
							$output .= '<th align="left" width="20%">Lot</th>';
							$output .= '<th align="left">Capacity</th>';
							$output .= '<th align="left">Occupied</th>';
							$output .= '<th align="left">Open Time</th>';
							$output .= '<th align="left">Close Time</th>';
							$output .= '<th align="left">ID</th>';
							$output .= '<th>Action</th>';
						$output .= '</tr>';

						$count = 1;
						while($lotdetail = @mysql_fetch_assoc($lotdetails)) {
							$output .= '<tr>';
								$output .= '<td style="padding-left:5px;">'.$count++.'</td>';
								$output .= '<td><a href="?module='.$module.'&action=edit&editid='.$lotdetail['id'].'">'.$lotdetail['type'].'</td>';
								$output .= '<td>'.$lotdetail['capacity'].'</td>';
								$output .= '<td>'.$lotdetail['occupied'].'</td>';
								$output .= '<td>'.$lotdetail['open_time'].'</td>';
								$output .= '<td>'.$lotdetail['close_time'].'</td>';
								$output .= '<td>'.$lotdetail['id'].'</td>';
								$output .= '<td align="center"><a href="?module='.$module.'&action=edit&editid='.$lotdetail['id'].'"><img src="./images/edit.png" /></a> &nbsp; <a href="actions.php/?module='.$module.'&action=delete&id='.$lotdetail['id'].'"><img src="./images/delete.png"/></a></td>';
							$output .= '</tr>';
						}
					$output .= '</table>';
					break;
	}
	return $output;
}

 function locForm($lotid = '') {
	global $db;
	$sql = 'SELECT * FROM tbllocation where 1 order by id';
	$results = $db->query($sql);

	$lot_loc = 	array();
	if (isset($lotid)) {
		$sql = 'SELECT * FROM tbljoin_lot_location where lot_id='.$lotid.'';
		$results2 = $db->query($sql);
		while ($locs =  @mysql_fetch_array($results2)) {
			  $lot_loc[] = $locs['loc_id'];
		}
	}

	$output .= '<select multiple name="loc_ids[]" style="width:280px" size=15>';
	while ($content =  @mysql_fetch_array($results)) {
		if (in_array($content['id'], $lot_loc))
			$output .= '<option value="'.$content['id'].'" selected>'.$content['location'].'</option>';
		else
			$output .= '<option value="'.$content['id'].'">'.$content['location'].'</option>';
	}
	$output .= '</select>';

	return $output;
}
/********************************************* End Lot Details ************************************************/

/********************************************* Start Events ************************************************/
function eventsAssist($events, $action, $module, $editid='') {
	global $db;

	switch($action) {
		case 'add': 
		case 'edit':
					if (isset($editid)) {
						$sql = 'SELECT * FROM tblevent where id = '.$editid.' order by created_dt';
						$results = $db->query($sql);
						$content =  @mysql_fetch_array($results);
						extract($content);
					}

					include "include/eventForm.php";				
					break;

		default: 
					$output = '<table width="100%" cellpadding="0" cellspacing="0" class="listtable">';
						$output .= '<tr>';
							$output .= '<th align="left" width="5%">No.</th>';
							$output .= '<th align="left" width="50%">Description</th>';
							$output .= '<th align="left" width="18%">Start Date / End Date</th>';
							$output .= '<th align="left">Lot ID</th>';
							$output .= '<th align="left">Created By</th>';
							$output .= '<th>Action</th>';
						$output .= '</tr>';

						$count = 1;
						while($event = @mysql_fetch_assoc($events)) { 
							$output .= '<tr>';
								$output .= '<td style="padding-left:5px;">'.$count++.'</td>';
								$output .= '<td><a href="?module='.$module.'&action=edit&editid='.$event['id'].'">'.$event['description'].'</td>';	
								$output .= '<td>'.$event['start_dt_tm'].' / '.$event['end_dt_tm'].'</td>';	
								$output .= '<td>'.$event['id'].'</td>';
								$output .= '<td>'.$event['name'].'</td>';
								$output .= '<td align="center"><a href="?module='.$module.'&action=edit&editid='.$event['id'].'"><img src="./images/edit.png" /></a> &nbsp; <a href="actions.php/?module='.$module.'&action=delete&id='.$event['id'].'"><img src="./images/delete.png"/></a></td>';	
							$output .= '</tr>';
						}
					$output .= '</table>';
					break;
	}

	return $output;
}


function lotForm($lotid = '') {
	global $db;
	$sql = 'SELECT * FROM tbllot where 1 order by type';
	$results = $db->query($sql);
	
	$output .= '<select name="lotid" style="width:110px">';
	while ($content =  @mysql_fetch_array($results)) {
		//echo $content['id']." - ".$lotid."</br/>";
		if ($content['id'] == $lotid)
			$output .= '<option value="'.$content['id'].'" selected>'.$content['type'].'</option>';
		else 
			$output .= '<option value="'.$content['id'].'">'.$content['type'].'</option>';
	}
	$output .= '</select>';

	return $output;
}
/********************************************* End Events ************************************************/

/********************************************* Start Logout ************************************************/
function logoutAssist($pages, $action, $module, $editid='') {
	global $db;

	return $output;
}
/********************************************* End Logout ************************************************/
?>