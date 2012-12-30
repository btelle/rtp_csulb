{**
 * admin/templates/layout/admin_header.tpl
 * Image Path: The images are downloaded from the www.joomla.org which is an open source
 * framework for the version 1.15
 * To see the images Joomla has to be downloaded and the image path will be
 * Joomla\Administrator\images
 * We have used free jquery plugins for the editor used under Pages
 * Contains the Admin header information
 *
 * @author Chethan G
 *}
<!DOCTYPE html> 
<html lang="en">
    <head>
        <title>{$header.title} :: RTP@CSULB</title>
        
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta name="author" content="{$header.author}" />
	<meta name="keywords" content="{$header.keywords}" />
	<meta name="description" content="{$header.description}" />
        
        <link href="css/rtp_admin.css" rel="stylesheet" type="text/css" media="all" />
        <script type="text/javascript" src="scripts/jquery-1.7.min.js"></script>
        <script type="text/javascript" src="scripts/datetimepicker_css.js"></script>
	<script type="text/javascript" src="scripts/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript" src="scripts/tiny_mce/index.js"></script>

    </head>
    <body>

	<div class="main">
		<div class="header">
			<div class="logo"></div>
			<div class="main-menu">
				<ul class="menu">
					{$data.headermenu}
				</ul>
			</div>			
		</div>
