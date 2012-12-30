<?php /* Smarty version Smarty 3.1.4, created on 2011-12-15 14:39:32
         compiled from "./templates/admin/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17864311654eea7724aa9cf4-18777030%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '136eb1b0fbcdc162f2d607593da19d4d2b53396b' => 
    array (
      0 => './templates/admin/index.tpl',
      1 => 1323987859,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17864311654eea7724aa9cf4-18777030',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_4eea7724bea08',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4eea7724bea08')) {function content_4eea7724bea08($_smarty_tpl) {?>

<?php echo $_smarty_tpl->getSubTemplate ("layout/admin_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>




<div class="contentwraper">

	<div class="content-top"></div>
	<div class="content-main">
		<div class="leftsidebar">
			<?php echo $_smarty_tpl->tpl_vars['data']->value['leftsidebar'];?>

		</div>

		<div class="content">
			<?php echo $_smarty_tpl->getSubTemplate ("util/error.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


			<?php echo $_smarty_tpl->tpl_vars['data']->value['maincontent'];?>

		</div>
	</div>
	<div class="content-bottom"></div>
</div>	     


<script type="text/javascript" src="js/jquery/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/contact_validate.js"></script>

<?php echo $_smarty_tpl->getSubTemplate ("layout/admin_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>