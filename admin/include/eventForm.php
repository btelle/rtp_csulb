<?php
/**
 * database.php
 *
 * Contains functions like insert to access the database
 * and the results are returned
 *
 * @author Chethan G
 */

$output .= '<form action="actions.php" method="post">';
$output .= '<table width="100%" cellpadding="0" cellspacing="0" class="listtable">';
	$output .= '<tr>';
		$output .= '<td class="bold" width="15%">Description</td>';
		$output .= '<td><input tyle="text" name="description" value="'.$description.'" size=100></td>';
	$output .= '</tr>';

	$output .= '<tr>';
               $output .= '<td class="bold" width="15%">Start Date</td>';
               $output .= '<td><input tyle="text" name="start_dt_tm" id="start_dt_tm" value="'.$start_dt_tm.'" size=15 readonly><img src="images/cal.gif"  onclick="javascript:NewCssCal (\'start_dt_tm\',\'yyyyMMdd\',\'arrow\',true,\'24\',true)"></td>';
       $output .= '</tr>';

       $output .= '<tr>';
               $output .= '<td class="bold" width="15%">End Date</td>';
               $output .= '<td><input tyle="text" name="end_dt_tm" id="end_dt_tm" value="'.$end_dt_tm.'" size=15 readonly><img src="images/cal.gif"  onclick="javascript:NewCssCal (\'end_dt_tm\',\'yyyyMMdd\',\'arrow\',true,\'24\',true)"></td>';
       $output .= '</tr>';

	$output .= '<tr>';
		$output .= '<td class="bold" width="15%">Lot</td>';
		$output .= '<td>'.lotForm($lot_id).'</td>';
	$output .= '</tr>';

	$output .= '<tr>';
		$output .= '<td colspan=2><input type="hidden" name="action" value="'.$action.'"><input type="hidden" name="created_by" value="'.$created_by.'"><input type="hidden" name="module" value="'.$module.'"><input type="hidden" name="id" value="'.$id.'"><input type="submit" value="'.ucfirst($action).' Page"><input type="button" value="Cancel" onClick="location.href=\'?module='.$module.'\'"></td>';
	$output .= '</tr>';
$output .= '</table>';
$output .= '</form>';

?>