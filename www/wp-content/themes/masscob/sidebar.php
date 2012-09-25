<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
?>

<div id="lang"  style="float:right; margin-top:-<?php if (ereg("Safari", $_SERVER["HTTP_USER_AGENT"])) echo '20'; else echo '20'; ?>px; width:400px; ">
	<!-- <img src="<?php bloginfo('stylesheet_directory'); ?>/images/tiret.gif" /> -->
	<a href="<?php echo  get_bloginfo('url'); ?>/contact/"><img style="" id="bt_contact" class="<?php if(strpos($_SERVER['REQUEST_URI'], 'contact')) {echo 'selected';$id_selected = 'bt_contact';}?>" src="<?php bloginfo('stylesheet_directory'); ?>/images/contact_<?php echo LANG; ?>.gif" /></a>
	<a href="<?php echo  get_bloginfo('url'); ?>/credit/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/credits.gif" /></a>
</div>

