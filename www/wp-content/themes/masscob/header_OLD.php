<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
 define('LANG', 'en');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" href="<?php bloginfo('url'); ?>/wp-content/themes/masscob/favicon.ico"/>

<!--[if IE 7]>
	<style type="text/css">
		#video, #video2{/*display:none;*/ margin-left:-816px; margin-top:-300px;}
	</style>
<![endif]-->


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

<?php
if (!ereg("Safari", $_SERVER["HTTP_USER_AGENT"])) {
?>
<script type="text/javascript">
	// <![CDATA[
	jQuery(document).ready(function(){
		jQuery("#video, #video2").not('object, embed, param').click( function(){
			jQuery("#video").hide();
			jQuery("#video2").hide();	
		});
	});
	//-->
</script>

<?php 
	}
	else
	{
?>
	<script type="text/javascript">
		// <![CDATA[
		jQuery(document).ready(function(){
			 jQuery("#video, #video2").not('object, embed, param').click( function(){
				jQuery("#video").hide();
			 	jQuery("#video2").hide();	
			 });
		});
		//-->
	</script>

<?php
	}
?>


<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?> 

<?php wp_head(); ?>
<?php 
if (ereg("Safari", $_SERVER["HTTP_USER_AGENT"])) {
?>
<style>
	#menurightfilm {
		margin-top:-18px;	
	}
	#newsletter {
		margin-left:550px;
	}
</style>

<?php 
} 
?>
</head>
<body <?php body_class(); ?>>
<div id="page">

<div style="top:0;color:#111111; position:fixed; z-index:99;   background-color:#ffffff; *float: left;  *position:none;">
	<div id="header" role="banner">
		<a href="<?php echo  get_bloginfo('url'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.gif" /></a>
	</div>
	<hr />

	<div id="menu" class="flocont" style="position:relative;">
		<ul id="menuleft" class="flocont">
			<!--[if IE 6]>
		  		<li style="margin-left:0px;"><a onMouseOver="showOver('bt_history')" onMouseOut="showOut('bt_history')" href="<?php echo  get_bloginfo('url'); ?>/history/"><img id="bt_history" class="<?php if(strpos($_SERVER['REQUEST_URI'], 'history')) { echo 'selected'; $id_selected = 'bt_history';}  ?>" src="<?php bloginfo('stylesheet_directory'); ?>/images/history_<?php echo LANG; ?>.gif" /></a></li>
		 	<![endif]-->
			
			<!--[if !IE 6]>-->
				<li style="margin-left:-40px;"><a onMouseOver="showOver('bt_history')" onMouseOut="showOut('bt_history')" href="<?php echo  get_bloginfo('url'); ?>/history/"><img id="bt_history" class="<?php if(strpos($_SERVER['REQUEST_URI'], 'history')) { echo 'selected'; $id_selected = 'bt_history';}  ?>" src="<?php bloginfo('stylesheet_directory'); ?>/images/history_<?php echo LANG; ?>.gif" /></a></li>
			<!--<![endif]-->
			
			<li><img src="<?php bloginfo('stylesheet_directory'); ?>/images/collections_<?php echo LANG; ?>.gif" /></li>
			<li><a onMouseOver="showOver('bt_points')" onMouseOut="showOut('bt_points')" href="<?php echo  get_bloginfo('url'); ?>/category/points-of-sale"><img  id="bt_points" class="<?php if(strpos($_SERVER['REQUEST_URI'], 'points-of-sale')) {echo 'selected';$id_selected = 'bt_points';}?>" src="<?php bloginfo('stylesheet_directory'); ?>/images/pointsofsale_<?php echo LANG; ?>.gif" /></a></li>
			<li><a onMouseOver="showOver('bt_world')" onMouseOut="showOut('bt_world')" href="<?php echo  get_bloginfo('url'); ?>/category/masscob-diary"><img id="bt_world" class="<?php if(strpos($_SERVER['REQUEST_URI'], 'mascobs-world')) {echo 'selected';$id_selected = 'bt_world';}?>" src="<?php bloginfo('stylesheet_directory'); ?>/images/mascobworlds_<?php echo LANG; ?>.gif" /></a></li>
		</ul>
		<ul id="menuright">
			<li><a onMouseOver="showOver('bt_press')" onMouseOut="showOut('bt_press')" href="<?php echo  get_bloginfo('url'); ?>/press/"><img id="bt_press" class="<?php if(strpos($_SERVER['REQUEST_URI'], 'press')) {echo 'selected';$id_selected = 'bt_press';}?>" src="<?php bloginfo('stylesheet_directory'); ?>/images/press_<?php echo LANG; ?>.gif" /></a></li>
			<li><a onMouseOver="showOver('bt_boutique')" onMouseOut="showOut('bt_boutique')" href="<?php echo  get_bloginfo('url'); ?>/boutique/"><img id="bt_boutique" class="<?php if(strpos($_SERVER['REQUEST_URI'], 'boutique')) {echo 'selected';$id_selected = 'bt_boutique';}?>" src="<?php bloginfo('stylesheet_directory'); ?>/images/boutique_<?php echo LANG; ?>.gif" /></a></li>
			<li id="menurightfilm"><a onMouseOver="showOver('bt_contact')" onMouseOut="showOut('bt_contact')" href="<?php echo  get_bloginfo('url'); ?>?video=true"><img id="bt_contact" class="<?php if(strpos($_SERVER['REQUEST_URI'], 'video')) {echo 'selected';$id_selected = 'bt_contact';}?>" src="<?php bloginfo('stylesheet_directory'); ?>/images/film_<?php echo LANG; ?>.gif" /></a></li>
		</ul>
		<div id="menucollection" class="flocont" style="clear:both; position:absolute; height:22px; padding:0px; margin:0px; margin-top:0px; padding-top:25px; left:83px">
			<ul style="padding:0; margin:0px;">
				<li style="margin-left:0px;"><a style="padding:0px; left:50px; margin:0px;" id="menu_summer2" href="<?php bloginfo('url'); ?>/automne-hiver-1011/">&nbsp;</a></li> 
				
				<!--
				<li style="margin-left:0px;"><a onMouseOver="showOver('bt_summer')" onMouseOut="showOut('bt_summer')" href="<?php echo  get_bloginfo('url'); ?>/summer/"><img id="bt_summer" style="padding-bottom:1px;" class="<?php if(strpos($_SERVER['REQUEST_URI'], 'summer')) {echo 'selected';$id_selected = 'bt_summer';}?>" src="<?php bloginfo('stylesheet_directory'); ?>/images/summer_<?php echo LANG; ?>.gif" /></a></li><li style="margin-left:0px;"><img style="padding-bottom:1px;" src="<?php bloginfo('stylesheet_directory'); ?>/images/sepa.gif" /></li><li style="margin-left:0px;"><a onMouseOver="showOver('bt_winter')" onMouseOut="showOut('bt_winter')"  href="<?php echo  get_bloginfo('url'); ?>/winter/"><img id="bt_winter" style="padding-bottom:1px;" class="<?php if(strpos($_SERVER['REQUEST_URI'], 'winter')) {echo 'selected';$id_selected = 'bt_summer';}?>" src="<?php bloginfo('stylesheet_directory'); ?>/images/winter_<?php echo LANG; ?>.gif" /></a></li>
				-->
				
				<!-- <li style="margin-left:0px;"><a onMouseOver="showOver('bt_summer')" onMouseOut="showOut('bt_summer')" href="<?php echo  get_bloginfo('url'); ?>/summer/"><img id="bt_summer" style="padding-bottom:1px;" class="<?php if(strpos($_SERVER['REQUEST_URI'], 'summer')) {echo 'selected';$id_selected = 'bt_summer';}?>" src="<?php bloginfo('stylesheet_directory'); ?>/images/summer_<?php echo LANG; ?>.gif" /></a>
				</li><li style="margin-left:0px;"><img style="padding-bottom:1px;" src="<?php bloginfo('stylesheet_directory'); ?>/images/sepa.gif" /></li>
				<li style="margin-left:0px;"><a onMouseOver="showOver('bt_winter')" onMouseOut="showOut('bt_winter')"  href="<?php echo  get_bloginfo('url'); ?>/winter/"><img id="bt_winter" style="padding-bottom:1px;" class="<?php if(strpos($_SERVER['REQUEST_URI'], 'winter')) {echo 'selected';$id_selected = 'bt_summer';}?>" src="<?php bloginfo('stylesheet_directory'); ?>/images/winter_<?php echo LANG; ?>.gif" /></a></li>
								 -->							
			</ul>
		</div>
		<script>
			var id_selected = '<?php echo $id_selected?>';
			function showOver(id)
			{
				if(id != id_selected)
					document.getElementById(id).className = 'selected';
			}
			function showOut(id)
			{
				if(id != id_selected)
					document.getElementById(id).className = 'noselected';
			}
		</script>
	</div>
</div>