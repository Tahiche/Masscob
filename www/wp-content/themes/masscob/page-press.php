<?php

/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Press
*/


get_header(); 


?>
	<div id="content" class="narrowcolumn" role="main">


		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<div class="post" id="post-<?php the_ID(); ?>">
			
			
			
			<div class="entry">
            
            <div id="press-gal" style="margin: auto; margin-left: 60px;">
				<?php
				
					//the_content();
					
						// Example call with all arguments:
// wpo_get_images('thumbnail','0','0','large',"$post->ID",'1','attachment-image','div','small-thumb');
					//the_content(__('(more...)'));
/******************************** PARA PONER LOS VIDEOS EN ESTÁ PÁGINA EN VEZ DE EN DONDE SALEN (CODIGO EXTRAIDO DE wp-contents/themes/mascob/index.php) **************************************/
							
							//if(empty($_GET['inscription_newsletter']) AND empty($_GET['wpnewsletter_email'])){
						
						// <div id="video" style="position:absolute; z-index:10000; height:750px; width:816px; background-color:#fff; opacity:0.8; filter : alpha(opacity=80); -moz-opacity : 0.8; " onclick="this.style.display='none';document.getElementById('video2').style.display='none'">
$images = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );

	if ($images) {
		//d($images);
		$num_of_images = count($images);

		if ($offset > 0) : $start = $offset--; else : $start = 0; endif;
		if ($limit > 0) : $stop = $limit+$start; else : $stop = $num_of_images; endif;

		$i = 0;
		foreach ($images as $attachment_id => $image) {
			
			$img_title = $image->post_title;   // title.
			$img_description = $image->post_content; // description.
			$img_caption = $image->post_excerpt; // caption.
			$img_page = get_permalink($image->ID); // The link to the attachment page.
			$img_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
				if ($img_alt == '') {
				$img_alt = $img_title;
				}
				
				$imageR=vt_resize( $image->ID,'' , 125, 178, true, 70 );
				//d($image);
				?>
                <div class="img_press">
                <a href="<?php echo $img_page;?>" rel="shadowbox[sbalbum-<?php echo $post->ID?>];player=img;" title="<?php echo $img_caption?>"><img width="125" height="178" src="<?php echo $imageR['url']?>" class="attachment-thumbnail" alt="<?php echo $img_alt?>" title="<?php echo $img_caption?>"></a>
                <b><?php echo $img_caption;?></b>
                </div>
                <?php
		}
	}
						?>
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
