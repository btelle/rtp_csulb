<?php
/**
 * admin/include/pageForm.php
 *
 * Contains functions like insert to access the database
 * and the results are returned
 *
 * @author Chethan G
 */
$output .= '<script type="text/javascript">
	$(document).ready(function(){
		$(\'input[name=title]\').change(function() {
			var title= $.trim($(\'input[name="title"]\').val());
			title = $.trim(title.replace(/[^a-zA-Z 0-9]+/g,\'\'));
			slug = title.toLowerCase().replace(/ +(?=)/g,\'-\');
			$(\'input[name="slug"]\').val(slug);
		});
	});
	</script>';



$output .= '<form action="actions.php" method="post">';
$output .= '<table width="100%" cellpadding="0" cellspacing="0" class="listtable">';
	$output .= '<tr>';
		$output .= '<td class="bold" width="15%">Title</td>';
		$output .= '<td><input tyle="text" name="title" value="'.$title.'" size=50></td>';
	$output .= '</tr>';

	$output .= '<tr>';
		$output .= '<td class="bold" width="15%">Content</td>';
		$output .= '<td><textarea id="textarea" name="content" rows=15 cols=70>'.$content.'</textarea></td>';
	$output .= '</tr>';
	$output .= '<tr>';
		$output .= '<td class="bold" width="15%">Slug</td>';
		$output .= '<td><input type="text" name="slug" value="'.$slug.'" size=25 readonly></td>';
	$output .= '</tr>';

	$output .= '<tr>';
		$output .= '<td colspan=2><input type="hidden" name="action" value="'.$action.'"><input type="hidden" name="module" value="'.$module.'"><input type="hidden" name="id" value="'.$id.'"><input type="submit" value="'.ucfirst($action).' Page"><input type="button" value="Cancel" onClick="location.href=\'?module='.$module.'\'"></td>';
	$output .= '</tr>';
$output .= '</table>';
$output .= '</form>';

?>