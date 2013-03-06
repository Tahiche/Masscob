<?php

/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Videos
*/


get_header(); 


?>
	<div id="content" class="narrowcolumn" role="main">


		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<div class="post" id="post-<?php the_ID(); ?>">
			
			
			
			<div class="entry">
				<?php
				
					
						
/******************************** PARA PONER LOS VIDEOS EN ESTÁ PÁGINA EN VEZ DE EN DONDE SALEN (CODIGO EXTRAIDO DE wp-contents/themes/mascob/index.php) **************************************/
							
							//if(empty($_GET['inscription_newsletter']) AND empty($_GET['wpnewsletter_email'])){
						
						// <div id="video" style="position:absolute; z-index:10000; height:750px; width:816px; background-color:#fff; opacity:0.8; filter : alpha(opacity=80); -moz-opacity : 0.8; " onclick="this.style.display='none';document.getElementById('video2').style.display='none'">
						
						if(!empty($_GET['movie']) AND $_GET['movie']=="spring_summer_10"){ 
						?>
							<div id="video2">
								<!-- height:460px; width:600px; -->
								<div style="float:left; margin-top:10px; margin-left:110px;">
									<object type="application/x-shockwave-flash" data="/player_flv_maxi.swf" width="600" height="450" border="0">
										<param name="movie" value="/player_flv_maxi.swf" />
										<param name="allowFullScreen" value="true" />
										<param name="FlashVars" value="flv=masscobv5.flv&amp;margin=0&amp;bgcolor1=47ffe0&amp;bgcolor2=ffffff&amp;playercolor=ffffff&amp;loadingcolor=aaaaaa&amp;buttoncolor=cccccc&amp;buttonovercolor=aaaaaa&amp;sliderovercolor=aaaaaa&amp;autoplay=1&amp;border=0" />
									</object>
					
								</div>
							</div> 
						<?php 
							} 
							
					
							else if(!empty($_GET['movie']) AND $_GET['movie']=="spring_summer_12")
							 {
								?>
								<div id="video2">
									<!-- height:460px; width:600px; -->
									<div style="float:left; margin-top:10px; margin-left:110px;">
										<object type="application/x-shockwave-flash" data="/player_flv_maxi.swf" width="600" height="338" border="0">
											<param name="movie" value="/player_flv_maxi.swf" />
											<param name="allowFullScreen" value="true" />
											<param name="FlashVars" value="flv=masscob_spring_12.mp4&amp;margin=0&amp;bgcolor1=47ffe0&amp;bgcolor2=ffffff&amp;playercolor=ffffff&amp;loadingcolor=aaaaaa&amp;buttoncolor=cccccc&amp;buttonovercolor=aaaaaa&amp;sliderovercolor=aaaaaa&amp;autoplay=1&amp;border=0" />
										</object>
							
									</div>
								</div>
								
								<?php
							   }
							   else if(!empty($_GET['movie']) AND $_GET['movie']=="spring_autum_winter_10_11")
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
		
								  else if(!empty($_GET['movie']) AND $_GET['movie']=="summer_11")
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
					
					
					
											 
				else if(!empty($_GET['movie']) AND $_GET['movie']=="autum_winter_12")
												  {
							?>
							<div id="video2" style=" ">
								<!-- height:460px; width:600px; -->
								<div style="float:left; margin-top:10px; margin-left:110px;">
									<object type="application/x-shockwave-flash" data="/player_flv_maxi.swf" width="600" height="338" border="0">
										   <param name="movie" value="/player_flv_maxi.swf" />
									   <param name="allowFullScreen" value="true" />
									   <param name="FlashVars" value="flv=masscob_aut_win_2012.mp4&amp;margin=0&amp;bgcolor1=47ffe0&amp;bgcolor2=ffffff&amp;playercolor=ffffff&amp;loadingcolor=aaaaaa&amp;buttoncolor=cccccc&amp;buttonovercolor=aaaaaa&amp;sliderovercolor=aaaaaa&amp;autoplay=1&amp;border=0" />
								   </object>
					
							   </div>
						   </div>
						
						   <?php
												}
					
						// main video page		
			  else {
												
					
					
					
							?>
							<div id="video2" style=" ">
								<!-- height:460px; width:600px; -->
								<div style="float:left; margin-top:10px; margin-left:110px;">
									<object type="application/x-shockwave-flash" data="/player_flv_maxi.swf" width="600" height="338" border="0">
										   <param name="movie" value="/player_flv_maxi.swf" />
									   <param name="allowFullScreen" value="true" />
									   <param name="FlashVars" value="flv=videos_col/masscob essaouira.mp4&amp;margin=0&amp;bgcolor1=47ffe0&amp;bgcolor2=ffffff&amp;playercolor=ffffff&amp;loadingcolor=aaaaaa&amp;buttoncolor=cccccc&amp;buttonovercolor=aaaaaa&amp;sliderovercolor=aaaaaa&amp;autoplay=1&amp;border=0" />
								   </object>
					
							   </div>
						   </div>
						
						   <?php
												 
							}
					
					
					
						
	/**************************************************************************************************************************************************************************/
					?>	
					
						<ul id="archive_video" style="margin-top:0px" >
                        
                        <a href="<?php echo  get_bloginfo('url'); ?>/archives-video"><img src="<?php echo  get_bloginfo('url'); ?>/wp-content/themes/masscob/images/film_spring_summer_13.gif" style="margin-right:64px;" /></a>
                        
                        
                        <a href="<?php echo  get_bloginfo('url'); ?>/archives-video/?video=true&movie=autum_winter_12"><img src="<?php echo  get_bloginfo('url'); ?>/wp-content/themes/masscob/images/film_aut_win_12.gif" style="margin-right:64px;" /></a>
                         
                                                      <!--  <a href="<?php echo  get_bloginfo('url'); ?>/archives-video/?video=true&movie=spring_summer_12"><img src="<?php echo  get_bloginfo('url'); ?>/wp-content/themes/masscob/images/film_spring_summer_12.gif" style="margin-right:64px;" /></a>
                                                        
                                                        <a href="<?php echo  get_bloginfo('url'); ?>/archives-video/?video=true&movie=autum_winter_11_12"><img src="<?php echo  get_bloginfo('url'); ?>/wp-content/themes/masscob/images/film_autum_winter_11_12.gif" style="margin-right:64px;" /></a>
                                                        <a href="<?php echo  get_bloginfo('url'); ?>/archives-video/?video=true&movie=summer_11"><img src="<?php echo  get_bloginfo('url'); ?>/wp-content/themes/masscob/images/film_spring_summer_11.gif" style="margin-right:64px;" /></a>
							 <a href="<?php echo  get_bloginfo('url'); ?>/archives-video/?video=true&movie=spring_autum_winter_10_11"><img src="<?php echo  get_bloginfo('url'); ?>/wp-content/themes/masscob/images/film_autum_winter_10_11.gif" style="margin-right:64px;" /></a>
						
							<a href="<?php echo  get_bloginfo('url'); ?>/archives-video/?video=true&movie=spring_summer_10"><img src="<?php echo  get_bloginfo('url'); ?>/wp-content/themes/masscob/images/film_spring_summer_10.gif" /></a> -->
						</ul>
						
		
			</div>
		</div>
	
		
		<div class="clear"></div>
		
		
		
		<?php if (get_the_ID()!=2) { ?>
		
			<?php get_sidebar(); ?>
		<?php } ?> 
		<?php wp_link_pages(array('before' => '<p><strong>' . __('Pages:', 'kubrick') . '</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

		<?php endwhile; endif; ?>
	<?php edit_post_link(__('Edit this entry.', 'kubrick'), '<p>', '</p>'); ?>
	
	
	
	</div>



<?php get_footer(); ?>
