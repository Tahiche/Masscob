<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>

	<div id="content" class="narrowcolumn flocont" role="main">
	<?php
	$category = get_the_category(); 
	$id_cat = $category[0]->term_id;
	?>
	<?php if (have_posts()) : ?>

		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
		
		<?
		if($id_cat != 3) { ?>
		<div class="dv_blogroll">
			<?php //wp_list_bookmarks(); ?>
		</div>
		<? } ?>

		
		<?php
		if($id_cat == 3) 
		{
			query_posts('orderby=title&order=ASC&category_name=points-of-sale&posts_per_page=100'); 
			?>
			<img src="<?php bloginfo('stylesheet_directory'); ?>/images/sept12/sales.jpg" />
			<div style="float:left; width:816px; margin-top:20px;"><?php get_sidebar();?></div>
			<?php
		}
		else
		{
			?>
			<div class="listing flocont" style="margin-left:175px;">
				<div class="intro">
					<!-- <p><?php echo $category[0]->description; ?></p> -->
				</div>
				<h5 id="marga_and_jacobo"><span style="font-weight: normal;"> Marga and Jacobo</span></h5>
			</div>
			<?php
		}
		?>

		<?php 
		$count_ = 0;
		while (have_posts()) : the_post(); ?>
			
			<?php 
			if($id_cat == 3) 
			{
			
				$T_pays[$count_] = the_title_attribute('echo=0');
				$T_pays_id[$count_] = get_the_ID();
				$T_adresse[$count_] = the_content();
				$count_++;
			}
			else 
			{
			?>
			
				<div class="listing flocont" style="">
					
					<div class="post_titre">
						<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'kubrick'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h3>
						<div class="post_time"><?php the_time(__('d-m-y', 'kubrick')) ?></div>
					</div>
					
					
					
					<div style="float:right;">
						<?php echo the_content() ?>
					</div>
					
					
					<div style="clear:both;"></div>
	
					
						
						<?php
						global $post;
						
						//echo "<pre>";
						//print_r(get_post($post->ID)); 
						//echo "</pre>";
						//echo get_comments_number(); 
						
						if($post->comment_status=="open"){
					?>	
					<div style="float:left; margin-left:-20px;">
						<img src="<?php bloginfo('stylesheet_directory'); ?>/images/tiret.gif" />
					</div>
					<?php comments_popup_link(__('No Comments', 'kubrick'), __('1 Comment', 'kubrick'), __('% Comments', 'kubrick'), '', __('Comments Closed', 'kubrick') ); ?>
					
					<!--<p class="postmetadata"><?php the_tags(__('Tags:', 'kubrick'), ', ', '<br />'); ?> <?php printf(__('Posted in %s', 'kubrick'), get_the_category_list(', ')); ?> | <?php edit_post_link(__('Edit', 'kubrick'), '', ' | '); ?>  </p>-->
					
					<?php
						}
					?>	
				</div>
				
			<?php
			}
			?>

		<?php endwhile; ?>
		
		
		
		<?php
		if($id_cat == 3) 
		{
			?>
			<script>
			var T_pays = new Array();
			</script>
			<?php
			echo '<div style="float:left; margin-top:15px;"><div class="pays">';
			$count_all = 0;
			$onlinestores = '';
			
			foreach($T_pays as $key=>$pays)
			{
				/*if($key==0)
					$ajout = 'style="text-decoration:underline;"';
				else*/
					$ajout = '';
				
				/*
				if($key!=0) echo '<p><a id="pays_'.$key.'" class="pointer" '.$ajout.' onclick="showAdress('.$key.')">'.$pays.'</a></p>';
				else{
					$onlinestores = '<br/><p><a id="pays_'.$key.'" class="pointer" '.$ajout.' onclick="showAdress('.$key.')">'.$pays.'</a></p>';
				}
				*/
				
				if($pays!="Online Boutiques") echo '<p><a id="pays_'.$key.'" class="pointer" '.$ajout.' onclick="showAdress('.$key.')">'.$pays.'</a></p>';
				else{
					$onlinestores = '<br/><p><a id="pays_'.$key.'" class="pointer" '.$ajout.' onclick="showAdress('.$key.')">'.$pays.'</a></p>';
				}
				
				$count_all++;
			}
			
			echo $onlinestores;
			echo '</div>';
			
			?>
			
			<script type="text/javascript">
				// <![CDATA[
				
				function str_replace (search, replace, subject, count) {
				            f = [].concat(search),
				            r = [].concat(replace),
				            s = subject,
				            ra = r instanceof Array, sa = s instanceof Array;    s = [].concat(s);
				    if (count) {
				        this.window[count] = 0;
				    }
				     for (i=0, sl=s.length; i < sl; i++) {
				        if (s[i] === '') {
				            continue;
				        }
				        for (j=0, fl=f.length; j < fl; j++) {            temp = s[i]+'';
				            repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
				            s[i] = (temp).split(f[j]).join(repl);
				            if (count && s[i] !== temp) {
				                this.window[count] += (temp.length-s[i].length)/f[j].length;}        }
				    }
				    return sa ? s : s[0];
				}
				
				jQuery(document).ready(function(){ 
					
					jQuery('#dv_city_95').html(jQuery('#dv_shop_95').html()); // ce truc permet d'aller sur : http://www.modetrotter.com/
					
					// l'histoire des onglets qui reste ouvert
					jQuery('.pointer').click(function(){
						var a_pays_number = str_replace('pays_', '', jQuery(this).attr('id'));
						var not_pays_number = "#adresse_" + a_pays_number;
						jQuery('.name_shop').not(not_pays_number + " .name_shop").each(function(i){
							jQuery(this).attr('style',  str_replace('underline;', 'none;', jQuery(this).attr('style')) );
						})
						jQuery('.adresse_shop').not(not_pays_number + " .adresse_shop").hide();
							
					});
				});
				//-->
			</script>

			
			<?php		
			
			echo '<div class="adresse" id="adresses" style="display:none;">';
			
			
			
			foreach($T_adresse as $key=>$adresse)
			{
				if($key!=0)
					$ajout = 'style="display:none;"';
				$T_temp = explode('</p>',$adresse);
				echo '<div id="adresse_'.$key.'" '.$ajout.'>';
				$T_meta = get_post_custom($T_pays_id[$key]);
				$T_meta_keys = array_keys($T_meta);
				sort($T_meta_keys);
				$count_shop = 0;
				foreach($T_meta_keys as $T_tmp)
				{
					$count_all++;
					if($count_shop==0) {
						$shop_underline = 'text-decoration:none';
						$display_shop = 'display:none';
						?>
						<script>
							T_pays[<?php echo $key; ?>] = <?php echo $count_all; ?>;
						</script>
						<?php
					}
					else {
						$shop_underline = 'text-decoration:none';
						$display_shop = 'display:none';
					}
					if($T_tmp != '_edit_lock' && $T_tmp != '_edit_last' && $T_tmp != '_encloseme' && $T_tmp != '_pingme') 
						echo '<div id="dv_city_'.$count_all.'" class="name_shop" style="cursor:pointer;font-size:13px;'.$shop_underline.'" onclick="showShop('.$count_all.')"><i>'.$T_tmp.'</i></div><div id="dv_shop_'.$count_all.'" class="adresse_shop"  style="font-size:13px; '.$display_shop.'">'.$T_meta[$T_tmp][0].'</div></p><div class="clear"></div><br />';
					$count_shop++;
				}
				echo '</div>';
			}
			
			echo '</div></div>';
			?>
			<script>
			var enCours = 0;
			var dvShopEnCours = 0;
			var dvCityCours = 0;
			var paysFirst = 0;
			function showShop(n)
			{
				if(paysFirst == 0) {
					document.getElementById('dv_shop_'+T_pays[enCours]).style.display = 'none';
					document.getElementById('dv_city_'+T_pays[enCours]).style.textDecoration = 'none';
					paysFirst++;
				} else {
					document.getElementById('dv_shop_'+dvShopEnCours).style.display = 'none';
					document.getElementById('dv_city_'+dvCityCours).style.textDecoration = 'none';
				}
				document.getElementById('dv_shop_'+n).style.display = 'block';
				document.getElementById('dv_city_'+n).style.textDecoration = 'underline';
				dvShopEnCours = n;
				dvCityCours = n;
			}
			function showAdress(n)
			{
				document.getElementById('dv_shop_'+T_pays[enCours]).style.display = 'none';
				document.getElementById('dv_city_'+T_pays[enCours]).style.textDecoration = 'none';
				document.getElementById('adresse_'+enCours).style.display = 'none';
				document.getElementById('adresses').style.display = 'block';
				document.getElementById('adresse_'+n).style.display = 'block';
				document.getElementById('pays_'+enCours).style.textDecoration = 'none';
				document.getElementById('pays_'+n).style.textDecoration = 'underline';
				enCours = n;
				paysFirst = 0;
			}
			</script>
			<?php
		}
		?>

		<div class="navigation flocont" style="clear:both; padding-left:260px; width:366px;">
			<div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries', 'kubrick')); ?></div>
			<div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;', 'kubrick')); ?></div>
		</div>
	<?php


	
	endif;
	?>
	
	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
