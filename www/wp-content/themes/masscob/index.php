<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.cycle.lite.js"></script>
    
    <script>
    
$(function() {
       
    $('#slideshow1').cycle({
        delay: 3000,
        speed: 800
    });
    
});


    </script>
    
	<div id="content" class="narrowcolumn" role="main">
		
<?php 
		//$T_image = array('home','points-of-sale','credit', 'history');
		// $T_image = array('home','home2','home','home2');
		//$T_image = array('home3','home4','home5','home6',);
		$T_image = array('home1','home2','home3','home4','home5');
		?>
        
        <div id="slideshow1" class="pics" style="position: relative; height:541px ">
           <?php foreach ($T_image as $id=>$img):
		    ?>
           
           <img style="float:left;" src="<?php bloginfo('stylesheet_directory'); ?>/images/sept12/<?php echo $img ?>.jpg" />
           
           <?php endforeach; ?>
           
        </div>
        
        
        
        
        
        
			
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
