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


<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" href="<?php bloginfo('url'); ?>/wp-content/themes/masscob/favicon.ico"/>
<script language="Javascript" type="text/javascript">
<!--
function trim(str){str = str.replace(/^\s*$/, '');return str;}
function $Npro(field){var element =  document.getElementById(field);return element;return false;}
function emailvalidation(field, errorMessage) {
	var goodEmail = field.value.match(/\b(^(\S+@).+((\.com)|(\.net)|(\.edu)|(\.mil)|(\.gov)|(\.org)|(\.info)|(\.sex)|(\.biz)|(\.aero)|(\.coop)|(\.museum)|(\.name)|(\.pro)|(\..{2,2}))$)\b/gi);
	apos=field.value.indexOf("@");dotpos=field.value.lastIndexOf(".");lastpos=field.value.length-1;var badEmail = (apos<1 || dotpos-apos<2 || lastpos-dotpos<2);
	if (goodEmail && !badEmail) {return true;}
	else {/*alert(errorMessage);*/$Npro("Error").innerHTML=errorMessage;$Npro("Error").style.display="inline";field.focus();field.select();return false;}
}
function emptyvalidation(entered, errorMessage) {
	$Npro("Error").innerHTML="";
	with (entered) {
	if (trim(value)==null || trim(value)=="") {/*alert(errorMessage);*/$Npro("Error").innerHTML=errorMessage;$Npro("Error").style.display="inline";return false;}
	else {return true;}}//with
}//emptyvalidation
function formvalidation(thisform) {
with (thisform) {
if (emailvalidation(email,"Porfavor introducca una dirección de correo electrónico válida")==false) {email.focus(); return false;};
}
}
//-->
</script>
<style type="text/css">
	#video{
		position:absolute; z-index:10000; left:0; top:0; height:100%; width:100%; 
		background-color:#FFF; opacity:0.8; filter : alpha(opacity=80); -moz-opacity : 0.8; 
	}
	#video2{/*position:absolute;*/ z-index:10001; height:380px; width:600px; border:0; margin-top:15px;}
</style>
<!--[if lte IE 7]>
	<style type="text/css">
		#video, #video2{}
		#video{left:816px; top:300px;}
		#video2{top:300px}
		#video, #video2{/*display:none;*/ margin-left:-816px; margin-top:-300px;}
	</style>
<![endif]-->

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>


				
				<?php		

if (!ereg("Safari", $_SERVER["HTTP_USER_AGENT"])) {
?>
<script type="text/javascript">
/*
	// <![CDATA[
	jQuery(document).ready(function(){
		jQuery("#video, #video2").not('object, embed, param').click( function(){
			jQuery("#video").hide();
			jQuery("#video2").hide();	
		});
	});
	//-->*/
</script>

<?php 
	}
	else
	{
?>
	<script type="text/javascript">
		/*// <![CDATA[
		jQuery(document).ready(function(){
			 jQuery("#video, #video2").not('object, embed, param').click( function(){
				jQuery("#video").hide();
			 	jQuery("#video2").hide();	
			 });
		});
		//-->*/
	</script>

<?php
	}
?>


<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?> 

<?php wp_head(); ?>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
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
<body <?php body_class(); ?> id="post-<?php global $post; echo $post->ID; ?>" >
<div id="page">

<div id="encabezado" style="top:0;color:#111111; z-index:99;   background-color:#ffffff; *float: left;  *position:none;">
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
				<li style="margin-left:-40px;"><a onMouseOver="showOver('bt_history')" onMouseOut="showOut('bt_history')" href="<?php echo  get_bloginfo('url'); ?>/masscob-history/"><img id="bt_history" class="<?php if(strpos($_SERVER['REQUEST_URI'], 'history')) { echo 'selected'; $id_selected = 'bt_history';}  ?>" src="<?php bloginfo('stylesheet_directory'); ?>/images/history_<?php echo LANG; ?>.gif" /></a></li>
			<!--<![endif]-->
			
			<li><img src="<?php bloginfo('stylesheet_directory'); ?>/images/collections_<?php echo LANG; ?>.gif" /></li>
			<li><a onMouseOver="showOver('bt_points')" onMouseOut="showOut('bt_points')" href="<?php echo  get_bloginfo('url'); ?>/category/points-of-sale"><img  id="bt_points" class="<?php if(strpos($_SERVER['REQUEST_URI'], 'points-of-sale')) {echo 'selected';$id_selected = 'bt_points';}?>" src="<?php bloginfo('stylesheet_directory'); ?>/images/pointsofsale_<?php echo LANG; ?>.gif" /></a></li>
			<li><a onMouseOver="showOver('bt_world')" onMouseOut="showOut('bt_world')" href="<?php echo  get_bloginfo('url'); ?>/category/masscob-diary"><img id="bt_world" class="<?php if(strpos($_SERVER['REQUEST_URI'], 'mascobs-world')) {echo 'selected';$id_selected = 'bt_world';}?>" src="<?php bloginfo('stylesheet_directory'); ?>/images/mascobworlds_<?php echo LANG; ?>.gif" /></a></li>
		</ul>
		<ul id="menuright">
			<li><a onMouseOver="showOver('bt_press')" onMouseOut="showOut('bt_press')" href="<?php echo  get_bloginfo('url'); ?>/press/"><img id="bt_press" class="<?php if(strpos($_SERVER['REQUEST_URI'], 'press')) {echo 'selected';$id_selected = 'bt_press';}?>" src="<?php bloginfo('stylesheet_directory'); ?>/images/press_<?php echo LANG; ?>.gif" /></a></li>
			<li><a onMouseOver="showOver('bt_boutique')" onMouseOut="showOut('bt_boutique')" href="<?php echo  get_bloginfo('url'); ?>/boutique/"><img id="bt_boutique" class="<?php if(strpos($_SERVER['REQUEST_URI'], 'boutique')) {echo 'selected';$id_selected = 'bt_boutique';}?>" src="<?php bloginfo('stylesheet_directory'); ?>/images/boutique_<?php echo LANG; ?>.gif" /></a></li>
			
			
			<!-- AVANT : <li id="menurightfilm"><a onMouseOver="showOver('bt_contact')" onMouseOut="showOut('bt_contact')" href="<?php echo  get_bloginfo('url'); ?>?video=true"><img id="bt_contact" class="<?php if(strpos($_SERVER['REQUEST_URI'], 'video')) {echo 'selected';$id_selected = 'bt_contact';}?>" src="<?php bloginfo('stylesheet_directory'); ?>/images/film_<?php echo LANG; ?>.gif" /></a></li> -->
			<li id="menurightfilm"><a onMouseOver="showOver('bt_contact')" onMouseOut="showOut('bt_contact')" href="<?php echo  get_bloginfo('url'); ?>/archives-video/"><img id="bt_contact" class="<?php if(strpos($_SERVER['REQUEST_URI'], 'video')) {echo 'selected';$id_selected = 'bt_contact';}?>" src="<?php bloginfo('stylesheet_directory'); ?>/images/film_<?php echo LANG; ?>.gif" /></a></li>
		
		
		</ul>
		<div id="menucollection" class="flocont" style="clear:both; position:absolute; height:22px; padding:0px; margin:0px; margin-top:0px; padding-top:25px; left:83px">
			<ul style="padding:0; margin:0px;">
				
				<?php global $post;
				 	if($post->ID==5){
				?>
				<li style="margin-left:0px;"><a style="padding:0px; left:50px; margin:0px; background: url('<?php bloginfo('stylesheet_directory'); ?>/images/spring_summer_black_1v2.gif');" id="menu_summer2" href="<?php bloginfo('url'); ?>/summer/">&nbsp;</a></li> 
				<?php
					}
					else{
				?>
				<?php //<li style="margin-left:0px;"><a style="padding:0px; left:50px; margin:0px;" id="menu_summer2" href="<?php //  bloginfo('url'); ?><?php // /autunm-winter-2011-12/">&nbsp;</a></li> ?> 
                                   <li style="margin-left:0px;"><a style="padding:0px; left:50px; margin:0px;background: url('<?php bloginfo('stylesheet_directory'); ?>/images/spring_summer_black_1.gif');" id="menu_summer2" href="<?php bloginfo('url'); ?>/spring-summer-2013/" alt="Spring-Summer 2013" title="Spring-Summer 2013">Spring-Summer 2013</a></li>
				<?php
					}
				?>
				
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
<?php
	if(get_the_ID()==7){
				?>
				<script type="text/javascript">
					// <![CDATA[
					jQuery(document).ready(function(){ // la 1er image est l'email de contact a press
						jQuery('.img_press img').eq(0).wrap('<a href="mailto:press@masscob.com"></a>');
                                                var n_img_gallery2  = (jQuery('.img_press img').length);
						var i 
                                                for(i=1;i<=n_img_gallery2-1;i++)
                                                {
                                                   var variable=jQuery('.img_press img').eq(i).attr('src');
                                                   variable=variable.split('-e');
                                                   var variable2=variable[1].split('.');

						    jQuery('.img_press img').eq(i).wrap('<a href="'+variable[0]+'.'+variable2[1]+'" rel="media"></a>');
                                                }
                                                 if(jQuery('a[rel=media]').size() > 0) {
                Shadowbox.init({
                adapter: "base",
		language: "fr",
		players: ["img"],
		animate: true,
		animateFade: true,
		animSequence: "sync",
		autoDimensions: false,
		modal: false,
		showOverlay: true,
		overlayColor: "#ffffff",
		overlayOpacity: 0.7,
		flashBgColor: "#ffffff",
		autoplayMovies: true,
		showMovieControls: true,
		slideshowDelay: 0,
		resizeDuration: 0.35,
		fadeDuration: 0.55,
		displayNav: true,
		continuous: false,
		displayCounter: true,
		counterType: "default",
		counterLimit: 10,
		viewportPadding: 20,
		handleOversize: "resize",
		handleUnsupported: "link",
		initialHeight: 160,
		initialWidth: 320,
		enableKeys: true,
		skipSetup: false,
		flashParams: {bgcolor:"#ffffff", allowFullScreen:true},
		flashVars: {},
		flashVersion: "9.0.0",
		useSizzle: false
                });
               
                Shadowbox.setup($('a[rel=media]'));     
              
        }
					
					});
					//-->
				</script>
				
				
				<?php		
					}

?>