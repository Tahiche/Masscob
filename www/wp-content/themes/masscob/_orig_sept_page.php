<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); 


?>

	<div id="content" class="narrowcolumn" role="main">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php
		if (get_the_ID()==444) {
		?>
				<div id="video" style="position:absolute; z-index:10000; height:550px; width:816px; background-color:#fff; opacity:0.8; top:0px;" onclick="this.style.display='none';">
		
				</div>
				
				<div id="video2" style="position:absolute; z-index:10001; height:550px; width:816px; top:0px;" onclick="this.style.display='none'; document.getElementById('video').style.display='none'">
					<div style="float:left; margin-top:140px; margin-left:110px;">
						<?php
							echo the_content(' ' . __('', 'kubrick') . ' ');
						?>
					</div>
				</div> 
	

		<?php
		}
		?>
		<div class="post" id="post-<?php the_ID(); ?>">
			
			<?php if (get_the_ID()==2) { ?>
				<img src="<?php bloginfo('stylesheet_directory'); ?>/images/history.jpg" />
				<div style="float:left; width:816px; margin-top:20px;"><?php get_sidebar();?></div>
				<?php get_sidebar(); ?>
				</div>
			<?php } ?> 
			<?php if (get_the_ID()==9) { ?>
				<!--<img src="<?php bloginfo('stylesheet_directory'); ?>/images/contact.jpg" />-->
				
			<?php } ?>
			<?php if (get_the_ID()==172) { ?>
				<img src="<?php bloginfo('stylesheet_directory'); ?>/images/credit.jpg" />
				<?php get_sidebar(); ?>
			<?php } ?>
			<?php
				if(get_the_ID()==172){
			?>
			<div style="float: left; width: 816px; margin-top: 20px;">
			<div style="float: right; margin-top: -20px; width: 400px;" id="lang">
				<!--<img src="http://www.masscob.com/wp-content/themes/masscob/images/tiret.gif"> -->
				<a href="http://www.masscob.com/contact/"><img style="margin-top:-4px;" src="http://www.masscob.com/wp-content/themes/masscob/images/contact_en.gif" class="" id="bt_contact"></a>
				<a href="http://www.masscob.com/credit/"><img src="http://www.masscob.com/wp-content/themes/masscob/images/credits.gif"></a>
			</div>

			</div>

			<?php
				}
			?>
			
			<div class="entry">
				<?php 
				if (get_the_ID()==259) {
				?>
				<center>
					<table>
						<tr><td><img src="<?php bloginfo('stylesheet_directory'); ?>/images/shop.jpg" /></td>
						<td valign="bottom"><?php echo the_content(' ' . __('', 'kubrick') . ' '); ?></td></tr>
					</table>
				</center>
				<?php
				}
				elseif (get_the_ID()==2) {
					$T_colonne = explode('[colonne]', the_content('<p class="serif">' . __('Read the rest of this page &raquo;', 'kubrick') . '</p>')); 
					foreach($T_colonne as $key=>$value)
					{
						echo '<div class="colonne">'.$value.'</div>';
					}
				}
				elseif (get_the_ID()==9) {
					$T_page = explode('[formulaire]', the_content('<p class="serif">' . __('Read the rest of this page &raquo;', 'kubrick') . '</p>')); 
					$T_colonne = explode('[colonne]', $T_page[0]); 
					
					echo '<div style="float:left; width:810px; border-top:0px dashed #CCCCCC; margin-top:5px;">';
					foreach($T_colonne as $key=>$value)
					{
						if($key==2)
							$add = 'style="float:left; margin-top:39px"';
						else
							$add = '';
						if($key<3)
							echo '<div '.$add.' class="colonne2">'.$value.'</div>';
					}
					echo '</div>';
					echo '<div style="float:left; width:810px; border-top:1px dashed #CCCCCC;">';
					echo '<div style="float:left; width:247px;text-align:left;">'.$T_colonne[3].'</div>';
					
					$attachments = get_children(Array(
					'post_parent' => get_the_ID(),
					'post_status' => 'inherit',
					'post_type' => 'attachment',
					'post_mime_type' => 'image',
					'order' => 'ASC',
					'orderby' => 'menu_order' ));
					error_reporting(1);
					if(count($attachments)>0)
					{
						foreach($attachments  as $id => $attachment) {
							echo '<img style="float:left;" src="'.$attachment->guid.'" />';
						}	
					}
					
					echo '</div>';
					?>
					
					<?
						
						//echo "<pre>";
						//print_r($_POST);
						//echo "</pre>";
						
						$validation_form = true;
						
						if(empty($_POST['form_contact'])) $validation_form = false;
						
						if(empty($_POST['first'])) $validation_form = false;
						if(empty($_POST['second'])) $validation_form = false;
						if(empty($_POST['city'])) $validation_form = false;
						if(empty($_POST['coutry'])) $validation_form = false;
						if(empty($_POST['email'])) $validation_form = false;
						if(empty($_POST['message'])) $validation_form = false;
						
					?>
					
					<?php
						//if($validation_form==false){
					?>
					<div class="contact_formulaire">
						
						<?php 
							if(!empty($_POST['form_contact']) AND $validation_form==false){
								 echo '<div id="mail"><span>Please, fill in ';
								$n_element = 0;
									if(empty($_POST['first'])){
										echo 'your first name';
										$n_element++;
									}  
									
									if($n_element>0) echo ' - '; 
									if(empty($_POST['second'])){
										echo 'your second name';
										$n_element++;	
									} 
									
									if($n_element>0) echo ' - ';
									if(empty($_POST['city'])){
										echo 'your city';
										$n_element++;
									}
									
									if($n_element>0) echo ' - ';
									 if(empty($_POST['coutry'])){
										echo 'your country';
										$n_element++; 
									}
									
									if($n_element>0) echo ' - ';
									if(empty($_POST['email'])){
										echo 'your e-mail';
										$n_element++; 
									}
									
									if($n_element>0) echo ' - ';
									if(empty($_POST['message'])){
										echo 'your message';
										$n_element++;
									}
									
								echo '</span></div>';
							}
							if(!empty($_POST['form_contact']) AND $validation_form==true) echo '<div id="mail"><span>Thank you for your message, we will answer you soon</span></div>';
						?>
						
						<form method="post" action="http://www.masscob.com/?page_id=9#mail" name="contact_form" id="contact_form" style="margin-left:-30px;">
						<input type="hidden" name="form_contact" value="true">
						<table>
							<tr>
								<td class="rightalign" style="width:125px;">FIRST NAME *</td>
								<td><input type="texte" name="first" value="<?php if(!empty($_POST['first'])) echo $_POST['first']; ?>" /></td>
								<td class="rightalign">SECOND NAME *</td>
								<td><input type="texte" name="second" value="<?php if(!empty($_POST['second'])) echo $_POST['second']; ?>" /></td>
							</tr>
							<tr>
								<td class="rightalign" style="width:125px;">CITY*</td>
								<td><input type="texte" name="city" value="<?php if(!empty($_POST['city'])) echo $_POST['city']; ?>" /></td>
								<td class="rightalign">COUNTRY*</td>
								<td><input type="texte" name="coutry" value="<?php if(!empty($_POST['coutry'])) echo $_POST['coutry']; ?>" /></td>
							</tr>
							<tr>
								<td class="rightalign" style="width:125px;">E-MAIL*</td>
								<td><input type="texte" name="email" value="<?php if(!empty($_POST['email'])) echo $_POST['email']; ?>" /></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td class="rightalign"  style="width:125px;" valign="top">MESSAGE*</td>
								<td colspan="3"><textarea name="message"><?php if(!empty($_POST['message'])) echo $_POST['message']; ?></textarea></td>
							</tr>
							<tr>
								<td class="rightalign" colspan="4"><img class="pointer" onclick="document.forms['contact_form'].submit()" src="<?php bloginfo('stylesheet_directory'); ?>/images/send.gif" /></td>
							</tr>
						</table>
						</form>
						<br />
						
						
					</div>
					
					<?php
						if($validation_form==false){
						}
						else{ // mail ok
							
							$to      = 'info@masscob.com'; // Personne qui recoit le mail
							$subject = 'Masscob : new contact';
							
							
							$message = 'Nom : '.$_POST['first'].'
Prenom : '.$_POST['second'].'
Ville : '.$_POST['city'].'
Pays : '.$_POST['coutry'].'
Email : '.$_POST['email'].'

Message :
'.$_POST['message'];

							// avec les parametres habituels
							$headers = 'From: www.masscob.com <postmaster@masscob.com>'; // Personne qui envoit le mail

							// Special be-poles
							$params  = '-oi -f postmaster@masscob.com';
							//mail($to, $subject, $message, $headers, $params);
								
							mail($to, $subject, $message, $headers, $params);
							mail('jonathan@be-poles.com', $subject, $message, $headers, $params);
							mail('furansujin121@hotmail.fr', $subject, $message, $headers, $params);
							
					
						//<div id="message_confirm_mail_contact">
						//	<div id="mail"><div>Votre message a &eacute;t&eacute; envoy&eacute; avec succ&eacute;s !</div></div>
						//</div>
						
						
						}
					?>
					
					
					<script>
						function showShowRoom()
						{
							if(document.getElementById('showroom').style.display=='none')
								document.getElementById('showroom').style.display='block';
							else
								document.getElementById('showroom').style.display='none';
						}
					</script>
					<?php
				}
				else
				{
				
					
					
					if(get_the_ID()==5 || get_the_ID()==6 || get_the_ID()==1577 || get_the_ID()==2000)
					{
						
				?>		
					
				<script type="text/javascript">
					// <![CDATA[
					jQuery(document).ready(function(){ // la 1er image est l'email de contact a press
						//jQuery('.gallery img').hide();
						var n_img_gallery = jQuery('.gallery img').length;
						
						n_img_gallery++;
						
						jQuery('.gallery div').eq(n_img_gallery-1).attr('onmouseout','').attr('onmouseover','');
						jQuery('.gallery a').eq(n_img_gallery-1).attr('rel','').attr('title','').attr('href','').css('cursor','default').attr('onclick','return false;');
						
						jQuery('.gallery div').eq(n_img_gallery-1).hide();
						
						jQuery('#lang').css('marginTop','0px');
							
					});
					//-->
				</script>
					
				<?php
					
					}
				 
				/*	http://www.masscob.com/masscobv8.flv
					http://www.masscob.com/masscobv8.flv*/
					if (get_the_ID()!=444)
						echo the_content(' ' . __('', 'kubrick') . ' ');
					else
						echo '<div style="float:left; width:814px;height:300px;"><center><br /><br /><br /><br /><br /><br /><br /><a style="cursor:pointer;" onclick="document.getElementById(\'video2\').style.display=\'block\'; document.getElementById(\'video\').style.display=\'block\'">play</a></center></div>';
				
					if(get_the_ID()==1775){
						
/******************************** PARA PONER LOS VIDEOS EN ESTÁ PÁGINA EN VEZ DE EN DONDE SALEN (CODIGO EXTRAIDO DE wp-contents/themes/mascob/index.php) **************************************/
							
							//if(empty($_GET['inscription_newsletter']) AND empty($_GET['wpnewsletter_email'])){
						
						// <div id="video" style="position:absolute; z-index:10000; height:750px; width:816px; background-color:#fff; opacity:0.8; filter : alpha(opacity=80); -moz-opacity : 0.8; " onclick="this.style.display='none';document.getElementById('video2').style.display='none'">
						
						if(!empty($_GET['movie']) AND $_GET['movie']=="spring_summer_10"){ 
						?>
							<div id="video2">
								<!-- height:460px; width:600px; -->
								<div style="float:left; margin-top:10px; margin-left:110px;">
									<object type="application/x-shockwave-flash" data="/player_flv_maxi.swf" width="600" height="460" border="0">
										<param name="movie" value="/player_flv_maxi.swf" />
										<param name="allowFullScreen" value="true" />
										<param name="FlashVars" value="flv=masscobv5.flv&amp;margin=0&amp;bgcolor1=47ffe0&amp;bgcolor2=ffffff&amp;playercolor=ffffff&amp;loadingcolor=aaaaaa&amp;buttoncolor=cccccc&amp;buttonovercolor=aaaaaa&amp;sliderovercolor=aaaaaa&amp;autoplay=1&amp;border=0" />
									</object>
					
								</div>
							</div> 
						<?php 
							} 
							else{
					
							 if(!empty($_GET['movie']) AND $_GET['movie']=="spring_autum_winter_10_11")
							 {
								?>
								<div id="video2">
									<!-- height:460px; width:600px; -->
									<div style="float:left; margin-top:10px; margin-left:110px;">
										<object type="application/x-shockwave-flash" data="/player_flv_maxi.swf" width="600" height="460" border="0">
											<param name="movie" value="/player_flv_maxi.swf" />
											<param name="allowFullScreen" value="true" />
											<param name="FlashVars" value="flv=masscob.flv&amp;margin=0&amp;bgcolor1=47ffe0&amp;bgcolor2=ffffff&amp;playercolor=ffffff&amp;loadingcolor=aaaaaa&amp;buttoncolor=cccccc&amp;buttonovercolor=aaaaaa&amp;sliderovercolor=aaaaaa&amp;autoplay=1&amp;border=0" />
										</object>
							
									</div>
								</div>
								
								<?php
							   }
							   else
							   {
		
								  if(!empty($_GET['movie']) AND $_GET['movie']=="summer_11")
								  {
									?>
									<div id="video2">
										<!-- height:460px; width:600px; -->
										<div style="float:left; margin-top:10px; margin-left:110px;">
											<object type="application/x-shockwave-flash" data="/player_flv_maxi.swf" width="600" height="480" border="0">
												   <param name="movie" value="/player_flv_maxi.swf" />
											   <param name="allowFullScreen" value="true" />
											   <param name="FlashVars" value="flv=masscobv7_old.flv&amp;margin=0&amp;bgcolor1=47ffe0&amp;bgcolor2=ffffff&amp;playercolor=ffffff&amp;loadingcolor=aaaaaa&amp;buttoncolor=cccccc&amp;buttonovercolor=aaaaaa&amp;sliderovercolor=aaaaaa&amp;autoplay=1&amp;border=0" />
										   </object>
							
									   </div>
								   </div>
								
								   <?php
												}
					
					
					
											  else
											  {
												  if(!empty($_GET['movie']) AND $_GET['movie']=="autum_winter_11_12")
												  {
							?>
							<div id="video2">
								<!-- height:460px; width:600px; -->
								<div style="float:left; margin-top:10px; margin-left:110px;">
									<object type="application/x-shockwave-flash" data="/player_flv_maxi.swf" width="600" height="480" border="0">
										   <param name="movie" value="/player_flv_maxi.swf" />
									   <param name="allowFullScreen" value="true" />
									   <param name="FlashVars" value="flv=masscobv7.flv&amp;margin=0&amp;bgcolor1=47ffe0&amp;bgcolor2=ffffff&amp;playercolor=ffffff&amp;loadingcolor=aaaaaa&amp;buttoncolor=cccccc&amp;buttonovercolor=aaaaaa&amp;sliderovercolor=aaaaaa&amp;autoplay=1&amp;border=0" />
								   </object>
					
							   </div>
						   </div>
						
						   <?php
												}
					
					
					
											  else
											  {
												
					
					
					
							?>
							<div id="video2">
								<!-- height:460px; width:600px; -->
								<div style="float:left; margin-top:10px; margin-left:110px;">
									<object type="application/x-shockwave-flash" data="/player_flv_maxi.swf" width="600" height="480" border="0">
										   <param name="movie" value="/player_flv_maxi.swf" />
									   <param name="allowFullScreen" value="true" />
									   <param name="FlashVars" value="flv=masscobv8.flv&amp;margin=0&amp;bgcolor1=47ffe0&amp;bgcolor2=ffffff&amp;playercolor=ffffff&amp;loadingcolor=aaaaaa&amp;buttoncolor=cccccc&amp;buttonovercolor=aaaaaa&amp;sliderovercolor=aaaaaa&amp;autoplay=1&amp;border=0" />
								   </object>
					
							   </div>
						   </div>
						
						   <?php
												 
												}
					
					
					
										   }
					
							}
						}
	/**************************************************************************************************************************************************************************/
					?>	
					
						<ul id="archive_video" style="margin-top:500px;" >
                        
                                                        <a href="<?php echo  get_bloginfo('url'); ?>/archives-video/?video=true&movie=spring_summer_12"><img src="<?php echo  get_bloginfo('url'); ?>/wp-content/themes/masscob/images/film_spring_summer_12.gif" style="margin-right:64px;" /></a>
                                                        <a href="<?php echo  get_bloginfo('url'); ?>/archives-video/?video=true&movie=autum_winter_11_12"><img src="<?php echo  get_bloginfo('url'); ?>/wp-content/themes/masscob/images/film_autum_winter_11_12.gif" style="margin-right:64px;" /></a>
                                                        <a href="<?php echo  get_bloginfo('url'); ?>/archives-video/?video=true&movie=summer_11"><img src="<?php echo  get_bloginfo('url'); ?>/wp-content/themes/masscob/images/film_spring_summer_11.gif" style="margin-right:64px;" /></a>
							<a href="<?php echo  get_bloginfo('url'); ?>/archives-video/?video=true&movie=spring_autum_winter_10_11"><img src="<?php echo  get_bloginfo('url'); ?>/wp-content/themes/masscob/images/film_autum_winter_10_11.gif" style="margin-right:64px;" /></a>
						
							<a href="<?php echo  get_bloginfo('url'); ?>/archives-video/?video=true&movie=spring_summer_10"><img src="<?php echo  get_bloginfo('url'); ?>/wp-content/themes/masscob/images/film_spring_summer_10.gif" /></a>
						</ul>
						
					<?php
					}
				
				}
				?>
			</div>
		</div>
	
		<?php
		if(get_the_ID()==6){
			echo '<div id="bb_separator">&nbsp;</div>';
			echo '<a href="'.get_bloginfo('url').'/spring-summer-2011/" id="bb_img_summer3"></a>';
			// cacher : echo '<a href="'.get_bloginfo('url').'/winter/" id="bb_img_winter" style="background-position:bottom left;"></a>';
			
		}
		
		if(get_the_ID()==1577){
			echo '<div id="bb_separator">&nbsp;</div>';
                        echo '<a href="'.get_bloginfo('url').'/spring-summer-2011/" id="bb_img_summer3" style="background-position:bottom left;"></a>';
			// cacher : echo '<a href="'.get_bloginfo('url').'/winter/" id="bb_img_winter"></a>';
		}
		
		if(get_the_ID()==5){
			echo '<div id="bb_separator">&nbsp;</div>';
			echo '<a href="'.get_bloginfo('url').'/automne-hiver-1011/" id="bb_img_summer2" style="background-position:bottom left;"></a>';
			// cacher : echo '<a href="'.get_bloginfo('url').'/winter/" id="bb_img_winter"></a>';
		}
                if(get_the_ID()==2000){
			echo '<div id="bb_separator">&nbsp;</div>';
                        echo '<a href="'.get_bloginfo('url').'/autunm-winter-2011-12/" id="bb_img_summer2" style="background-position:bottom left;"></a>';
			// echo '<a href="'.get_bloginfo('url').'/automne-hiver-1011/" id="bb_img_summer2" style="background-position:bottom left;"></a>';
			// cacher : echo '<a href="'.get_bloginfo('url').'/winter/" id="bb_img_winter"></a>';
		}
                if(get_the_ID()==2406){
			//echo '<div id="bb_separator">&nbsp;</div>';
                        //echo '<a href="'.get_bloginfo('url').'/spring-summer-2011/" id="bb_img_summer3" style="background-position:bottom left;"></a>';
			echo '<div id="bb_separator">&nbsp;</div>';
                        echo '<a href="'.get_bloginfo('url').'/spring-summer-2012/" id="bb_img_summer3" style="background-position:bottom left;"></a>';
		}
                if(get_the_ID()==2746){
			echo '<div id="bb_separator">&nbsp;</div>';
                        echo '<a href="'.get_bloginfo('url').'/autunm-winter-2011-12/" id="bb_img_summer2" style="background-position:bottom left;"></a>';
		}
		?>
		<div class="clear"></div>
		
		
		
		<?php if (get_the_ID()!=2) { ?>
		
			<?php get_sidebar(); ?>
		<?php } ?> 
		<?php wp_link_pages(array('before' => '<p><strong>' . __('Pages:', 'kubrick') . '</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

		<?php endwhile; endif; ?>
	<?php edit_post_link(__('Edit this entry.', 'kubrick'), '<p>', '</p>'); ?>
	
	
	
	</div>



<?php get_footer(); ?>
