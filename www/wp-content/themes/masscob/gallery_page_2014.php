<?php

/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Gallery 2014 Horz
*/


get_header(); 

$colWidth=130;
?>
<style type='text/css'>
		/*this is modded in functions **/
			
			#galleria_lookbook {
			margin: 0 auto !important;
			padding: 0;
			width: 795px;
			height: 386px;
			overflow: hidden;
			overflow-x: scroll;	
			white-space:nowrap;		
			margin-top: -10px !important;
			}
			#galleria_lookbook .gallery-item {
				float:none;
				text-align: center;
				/*width: {$itemwidth}%;*/
				margin:5px !important;
			}
			#galleria_lookbook img {
				/*border: 2px solid #cfcfcf;*/
			}
			#galleria_lookbook .gallery-caption {
				margin-left: 0;
			}
			.gallery-icon{
				margin:2px;}
			#horz_gallery{
				}
			.vertic_column{
				
display: block;
height: 350px;
/*width:<?php echo $colWidth;?>px;*/
display: inline-block;
 *display:inline;/* For IE7*/
    *zoom:1;/* For IE7*/
    vertical-align:top;
				}
		</style>
        
	<div id="content" class="narrowcolumn" role="main">


		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<div class="post" id="post-<?php the_ID(); ?>">
        <div class="entry">
			
			<?php 
			dump_post();
		// extrae variables de array a "root". Tenemos $order, $orderby...
		extract(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order',
		'id'         => $post->ID,
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 6,
		'rows'		=> 2,
		'size'       => 'medium',
		'include'    => '',
		'exclude'    => ''
	));
			$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
			
			//d($size);
			
			
			
	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$columns = intval($columns);
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	$float = is_rtl() ? 'right' : 'left';

	//$selector = "gallery-{$instance}";
//$selector = "gallery{$id}";
$selector = "galleria_lookbook";
$gallery_style = $gallery_div = '';
	

$size_class = sanitize_html_class( $size );
	$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
	//$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );
echo $gallery_div;
$wg=(count($attachments)/2) * 130;
echo "<div id='horz_gallery' style='width:{$wg}px'>";
	$i = 0;
	foreach ( $attachments as $id => $attachment ) {
	
	
	$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);
	
	/*if($attachment->post_excerpt=="horizontal"){
		$image=vt_resize( $id, null ,250 , 180, true );
		$img_page = get_permalink($id);
		$link="<a href='{$img_page}' rel='shadowbox[sbalbum-{$post->ID}];player=img;'>";
		$link.="<img src='{$image[url]}' width='$image[width]' height='$image[height]' /></a>";

		}*/
	// $link=vt_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false );
	
		if ( $i % $rows == 0 ){
			echo "<div class='vertic_column'>";
			}
		
		echo "<{$itemtag} class='gallery-item pic_gallery'>";
		echo "
			<{$icontag} class='gallery-icon'>
				$link
			</{$icontag}>";
		if ( $captiontag && trim($attachment->post_excerpt) ) {
			/*echo "
				<{$captiontag} class='wp-caption-text gallery-caption'>
				" . wptexturize($attachment->post_excerpt) . "
				</{$captiontag}>";*/
		}
		echo "</{$itemtag}>";
		// echo "$i % 2=".$i % 2;
		if ( $i % $rows == 1 ){
			echo "</div>";
			}
			
		++$i;
		
	} // fin foreach

	echo "
			<br style='clear: both;' />
		</div>\n";
	
// echo the_content(' ' . __('', 'kubrick') . ' '); ?>
			
			</div>
				
		</div>
        
	</div>
		<?php 
            $root=get_bloginfo("stylesheet_directory");
						
			echo '<div id="bb_separator">&nbsp;</div>';
          //  print '<a href="'.get_bloginfo('url').'/autumn-winter-2012-13" id="bb_img_summer3" style="background-position:bottom left; background:url('.$root.'/images/col_winner_double.jpg");></a>';
		//echo "http://www.masscob.com/wp-content/themes/masscob/images/col_winner_double.jpg";
		
		print '<a href="'.get_bloginfo('url').'/autumn-winter-2012-13" id="bb_img_summer3" style="background-position:bottom left; "><img src="'.$root.'/images/col_winner_double.jpg" /></a>';
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
