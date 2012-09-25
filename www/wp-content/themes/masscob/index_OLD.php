<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>
	
	<?php
	
	$video_home = true;
	
	if(!empty($_SESSION['video_home']) AND $_SESSION['video_home']==1){
		$video_home = false;
	}
	else{
		$_SESSION['video_home']=1;
	}
	
	if(!empty($_GET['video'])) $video_home = true;
	
	// LUNDI 13 : ENLEVER CECI
	//$video_home = false;

	if($video_home==true){	
		//if(empty($_GET['inscription_newsletter']) AND empty($_GET['wpnewsletter_email'])){
	
	?>
	<div id="video" style="position:absolute; z-index:10000; height:750px; width:816px; background-color:#fff; opacity:0.8; filter : alpha(opacity=80); -moz-opacity : 0.8; " onclick="this.style.display='none';document.getElementById('video2').style.display='none'">
		<!-- height:550px; width:816px; -->
	</div>
	
	<div id="video2" style="position:absolute; z-index:10001; height:460px; width:600px; border:0;" >
		<!-- height:460px; width:600px; -->
		<div style="float:left; margin-top:140px; margin-left:110px;">
			<object type="application/x-shockwave-flash" data="./player_flv_maxi.swf" width="600" height="460" border="0">
				<param name="movie" value="./player_flv_maxi.swf" />
				<param name="allowFullScreen" value="true" />
				<param name="FlashVars" value="flv=masscob.flv&amp;margin=0&amp;bgcolor1=47ffe0&amp;bgcolor2=ffffff&amp;playercolor=ffffff&amp;loadingcolor=aaaaaa&amp;buttoncolor=cccccc&amp;buttonovercolor=aaaaaa&amp;sliderovercolor=aaaaaa&amp;autoplay=1&amp;border=0" />
			</object>

		</div>
	</div> 
	
	<?php
		}
	

	?>
	
	<div id="content" class="narrowcolumn" role="main">
		
		<? /* <a title="Video" rel="shadowbox[samples;height=320;width=480]" href="http://vimeo.com/moogaloop.swf?clip_id=6891763&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=&amp;fullscreen=1">
			<img src="<?php bloginfo('stylesheet_directory'); ?>/images/home.jpg" />
		</a> */ ?>
		<?php 
		//$T_image = array('home','points-of-sale','credit', 'history');
		//$T_image = array('home','home2','home','home2');
		$T_image = array('home1','home2','home1','home2');
		?>
			<img style="float:left;" src="<?php bloginfo('stylesheet_directory'); ?>/images/<?php echo $T_image[rand(0,3)] ?>.jpg" />
			
		<div style="clear:both"></div>
		<div style="float:left; width:550px;">
			<form name="form_newsletter" id="form_newsletter" action="<?php bloginfo('url'); ?>" method="get">
				<input type="hidden" name="inscription_newsletter" value="true">
				<?php wpnewsletter_opt_in(); ?>
			</form>
		</div>
	</div>
	
	<?php
		// A deplacer si necessaire !
		
		$inscription_valide = true;
		$already_user = false;
		$new_member = false;
		$format_mail = true;
		
		
		if(empty($_GET['inscription_newsletter'])) $inscription_valide = false;
		if(empty($_GET['wpnewsletter_email'])) $inscription_valide = false;
		// SI un jour on veut récupérer le nom : [wpnewsletter_name] => 
		
		
		if($inscription_valide==true AND is_email($_GET['wpnewsletter_email'])){
			global $wpdb;
			
			$wpnewsletter_email = $_GET['wpnewsletter_email'];
			$joindate = date('Y').'-'.date('m').'-'.date('d').' '.date('H').':'.date('i').':'.date('s');
			$ip = $_SERVER["REMOTE_ADDR"];
			$name = '';
			
			
			// On check si cette personne est deja membre
			
			$connexion = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
			mysql_select_db(DB_NAME);
			mysql_query("SET NAMES 'utf8'");
			
			$q1 = "
				SELECT *
				FROM wp_newsletter_users
				WHERE email = '$wpnewsletter_email'
			";
			
			$r1 = mysql_query($q1,$connexion);
			
			if($d1=mysql_fetch_assoc($r1)){
				// on ne fait rien
				$already_user = true;
			}
			else{
				$new_member = true;
				$query = "
					INSERT INTO `wp_newsletter_users` (
						`id` ,
						`joindate` ,
						`ip` ,
						`name` ,
						`email` ,
						`joinstatus`
					)
					VALUES (
						NULL , '$joindate', '$ip', '$name', '$wpnewsletter_email', '1'
					);
				";
			
				//echo $query;
			
				$wpdb->query($query);
			}
		}		
	?>
	
	<?php
		if(!empty($_GET['inscription_newsletter']) AND !is_email($_GET['wpnewsletter_email'])) echo "The format of mail is not valid. Please try again.";
		if($already_user == true) echo '<div>You have already subscribed to the newsletter.</div>';
		if($new_member == true) echo '<div>Thank you for your subscription.</div>';
	?>
	
	<script type="text/javascript">
		// <![CDATA[
		jQuery(document).ready(function(){
			jQuery("#submit_form_newsletter").click( function(){	
				document.getElementById('form_newsletter').submit();
			});

		});
		//-->
	</script>
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>
