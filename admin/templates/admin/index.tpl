{**
 * admin/index.tpl
 *
 * Loads the main structure of the admin page
 *
 * @author Chethan G
 *}

{include file="layout/admin_header.tpl"}



<div class="contentwraper">

	<div class="content-top"></div>
	<div class="content-main">
		<div class="leftsidebar">
			{$data.leftsidebar}
		</div>

		<div class="content">
			{include file="util/error.tpl"}

			{$data.maincontent}
		</div>
	</div>
	<div class="content-bottom"></div>
</div>	     


<script type="text/javascript" src="js/jquery/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/contact_validate.js"></script>

{include file="layout/admin_footer.tpl"}