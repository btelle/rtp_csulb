<?php
/**
 * lotdetailForm.php
 *
 * Contains lot details form information
 *
 * @author Chethan G
 */
$output .= '<script type="text/javascript">
	$(document).ready(function(){
		$(\'input[name=title]\').change(function() {
			var title= $.trim($(\'input[name="title"]\').val());
			title = $.trim(title.replace(/[^a-zA-Z 0-9]+/g,\'\'));
			slug = title.toLowerCase().replace(/ +(?=)/g,\'\');
			$(\'input[name="classname"]\').val(slug);
		});
	});
	</script>';



$output .= '<form action="actions.php" method="post">';
$output .= '<table width="100%" cellpadding="0" cellspacing="0" class="listtable">';
	$output .= '<tr>';
		$output .= '<td class="bold" width="15%">Lot Name</td>';
		$output .= '<td><input tyle="text" name="type" value="'.$type.'" size=25></td>';
	$output .= '</tr>';

	$output .= '<tr>';
		$output .= '<td class="bold" width="15%">Structure Name</td>';
		$output .= '<td><input type="text" name="struct_nm" size=25 value="'.$struct_nm.'"></td>';
	$output .= '</tr>';
	$output .= '<tr>';
		$output .= '<td class="bold" width="15%">Structure Floor</td>';
		$output .= '<td><input type="text" name="struct_flr" value="'.$struct_flr.'" size=25></td>';
	$output .= '</tr>';
	$output .= '<tr>';
		$output .= '<td class="bold" width="15%">Capacity</td>';
		$output .= '<td><input type="text" name="capacity" value="'.$capacity.'" size=5></td>';
	$output .= '</tr>';

	$output .= '<tr>';
		$output .= '<td class="bold" width="15%">Occupied</td>';
		$output .= '<td><input type="text" name="occupied" value="'.$occupied.'" size=5></td>';
	$output .= '</tr>';

	$output .= '<tr>';
		$output .= '<td class="bold" width="15%">Open Time</td>';
		$output .= '<td><input type="text" name="open_time" value="'.$open_time.'" size=8> &nbsp; <i>Eg: hh:mm:ss</i></td>';
	$output .= '</tr>';

	$output .= '<tr>';
		$output .= '<td class="bold" width="15%">Close Time</td>';
		$output .= '<td><input type="text" name="close_time" value="'.$close_time.'" size=8> &nbsp; <i>Eg: hh:mm:ss</i></td>';
	$output .= '</tr>';

	$output .= '<tr>';
		$output .= '<td colspan=2><input type="hidden" name="classname" value=""><input type="hidden" name="action" value="'.$action.'"><input type="hidden" name="module" value="'.$module.'"><input type="hidden" name="id" value="'.$id.'"><input type="submit" value="'.ucfirst($action).' Page"><input type="button" value="Cancel" onClick="location.href=\'?module='.$module.'\'"></td>';
	$output .= '</tr>';
$output .= '</table>';
$output .= '</form>';

?>