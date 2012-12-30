<?php
/**
 * admin/actions.php
 *
 * Contains the specific actions for the different menu Items
 *
 * @author Chethan G
 */

require_once('../lib/init.inc.php');
require_once(FILE_ROOT.'admin/include/functions.php');

extract($_REQUEST);
// if the action is present
if ($action) {
//on which module
	switch($module) {

		case 'menus':
					$slug = strtolower($menuname);
					$data = array('description' => addslashes($menuname), 'link' => $menulink, 'position' => $menupos, 'slug' => $slug);
					doActions($action, $data, 'tblmenu', $id, $status);
					break;

		case 'pages':
					$data = array('title' => addslashes($title), 'content' => addslashes($content), 'slug' => $slug);
					doActions($action, $data, 'tblpages', $id);
					break;

		case 'sections':
					$data = array('section' => addslashes($sectionname));
					doActions($action, $data, 'tblcampus_section', $id);
					break;

		case 'spacetype':
					$data = array('type' => addslashes($spacetype), 'full_text' => addslashes($spacetext));
					doActions($action, $data, 'tblspace_type', $id);
					break;

		case 'space':
					$data = array('type' => addslashes($type), 'lot_id' => $lotid, 'capacity' => $capacity, 'occupied' => $occupied);
					doActions($action, $data, 'tblspace', $id);
					break;

		case 'locations':
					$data = array('location' => addslashes($locationname), 'section' => $locationsection, 'important' => $locationimportant);
					doActions($action, $data, 'tbllocation', $id);
					break;

		case 'events':
					if (empty($created_by))
						$created_by = $_SESSION['user_id'];
					$data = array('description' => addslashes($description), 'start_dt_tm' => $start_dt_tm, 'end_dt_tm' => $end_dt_tm, 'lot_id' => $lotid, 'created_by' => $created_by);
					doActions($action, $data, 'tblevent', $id);
						break;

		case 'lotdetails':
					$data = array('type' => addslashes($type), 'struct_nm' => addslashes($struct_nm), 'struct_flr' => $struct_flr, 'capacity' => $capacity, 'occupied' => $occupied, 'open_time' => $open_time, 'close_time' => $close_time);

					doActions($action, $data, 'tbllot', $id);

					break;

	}


	if (empty($redirect))
		$redirect = DOC_ROOT."admin/?module=".$module;

	header('location:'.$redirect);
}

//actions for each menu item
function doActions($action, $data, $table, $id='', $status='') {
	global $db;
	//echo $action;
	switch ($action) {
		case 'add':
                                // data is broken down into the key and value
				foreach($data as $key => $value) {
					$temp1[] .= $key;
					$temp2[] .= "'".$value."'";
				}
                                //implode converts array to string
				$elements = implode(', ', $temp1);
				$values = implode(', ', $temp2);

				$sql = 'INSERT into '.$table.' ('.$elements.') VALUES ('.$values.');';
				//echo $sql;exit;
				$return = $db->insert($sql);
				break;

		case 'edit':
				foreach($data as $key => $value) {
					$temp1[] .= $key." = '".$value."'";
				}
				$values = implode(', ', $temp1);

				$sql = 'UPDATE '.$table.' SET '.$values.' WHERE id = '.$id.';';
				$db->query($sql);
				break;

		case 'delete':
				$sql = 'DELETE FROM '.$table.' where id = '.$id;
				$db->query($sql);
				break;

		case 'status':
				$sql = 'UPDATE '.$table.' set status='.$status.' where id = '.$id;
				$db->query($sql);
				break;
	}
}
?>