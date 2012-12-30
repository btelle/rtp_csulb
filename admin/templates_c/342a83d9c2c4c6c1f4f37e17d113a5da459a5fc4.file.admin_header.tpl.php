<?php /* Smarty version Smarty 3.1.4, created on 2011-12-15 16:46:03
         compiled from "./templates/layout/admin_header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12542495694eea7724c721b4-61967080%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '342a83d9c2c4c6c1f4f37e17d113a5da459a5fc4' => 
    array (
      0 => './templates/layout/admin_header.tpl',
      1 => 1323996113,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12542495694eea7724c721b4-61967080',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_4eea7724d3326',
  'variables' => 
  array (
    'header' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4eea7724d3326')) {function content_4eea7724d3326($_smarty_tpl) {?>
<!DOCTYPE html> 
<html lang="en">
    <head>
        <title><?php echo $_smarty_tpl->tpl_vars['header']->value['title'];?>
 :: RTP@CSULB</title>
        
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta name="author" content="<?php echo $_smarty_tpl->tpl_vars['header']->value['author'];?>
" />
	<meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['header']->value['keywords'];?>
" />
	<meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['header']->value['description'];?>
" />
        
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
					<?php echo $_smarty_tpl->tpl_vars['data']->value['headermenu'];?>

				</ul>
			</div>			
		</div>
<?php }} ?>