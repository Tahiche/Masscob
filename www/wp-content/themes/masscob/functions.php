<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
 // medium or thumbnail options WP uses by default.

if ( function_exists( 'add_image_size' ) ) add_theme_support( 'post-thumbnails' );

// Add custom thumbnail sizes to your theme. These sizes will be auto-generated
// by the media manager when adding images to it on a new post.
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'pressThumb', 125, 178, true );
	/*add_image_size( 't500fit', 500, 320 );
	add_image_size( 'w510', 510, 1700, true );*/
	/*add_image_size( 't2x1', 307, 200, true );
	add_image_size( 't2x2', 307, 417, true );*/
}


 add_filter("post_gallery", "Masscob_modded_gallery_shortcode",10,2);
 
 function Masscob_modded_gallery_shortcode($attr) {
	global $post;

	static $instance = 0;
	$instance++;
// d($attr);
	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => ''
	), $attr));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$include = preg_replace( '/[^0-9,]+/', '', $include );
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$columns = intval($columns);
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	$float = is_rtl() ? 'right' : 'left';

	//$selector = "gallery-{$instance}";
$selector = "gallery{$id}";
	$gallery_style = $gallery_div = '';
	if ( apply_filters( 'use_default_gallery_style', true ) )
		$gallery_style = "
		<style type='text/css'>
		/*this is modded in functions **/
			
			#{$selector} {
				margin: auto;
			}
			#{$selector} .gallery-item {
				float: {$float};
				margin-top: 0px;
				text-align: center;
				/*width: {$itemwidth}%;*/
			}
			#{$selector} img {
				/*border: 2px solid #cfcfcf;*/
			}
			#{$selector} .gallery-caption {
				margin-left: 0;
			}
		</style>
		<!-- see gallery_shortcode() in wp-includes/media.php -->";
	$size_class = sanitize_html_class( $size );
	$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
	$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {
		$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);

		$output .= "<{$itemtag} class='gallery-item'>";
		$output .= "
			<{$icontag} class='gallery-icon'>
				$link
			</{$icontag}>";
		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$output .= "
				<{$captiontag} class='wp-caption-text gallery-caption'>
				" . wptexturize($attachment->post_excerpt) . "
				</{$captiontag}>";
		}
		$output .= "</{$itemtag}>";
		if ( $columns > 0 && ++$i % $columns == 0 )
			// $output .= '<br style="clear: both" />';
			$output .= "";
	}

	$output .= "
			<br style='clear: both;' />
		</div>\n";

	return $output;
}
 

load_theme_textdomain( 'kubrick' );

$content_width = 450;

automatic_feed_links();

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));
}


function kubrick_head() {
	$head = "<style type='text/css'>\n<!--";
	$output = '';
	if ( kubrick_header_image() ) {
		$url =  kubrick_header_image_url() ;
		$output .= "#header { background: url('$url') no-repeat bottom center; }\n";
	}
	if ( false !== ( $color = kubrick_header_color() ) ) {
		$output .= "#headerimg h1 a, #headerimg h1 a:visited, #headerimg .description { color: $color; }\n";
	}
	if ( false !== ( $display = kubrick_header_display() ) ) {
		$output .= "#headerimg { display: $display }\n";
	}
	$foot = "--></style>\n";
	if ( '' != $output )
		echo $head . $output . $foot;
}

add_action('wp_head', 'kubrick_head'); 

function kubrick_header_image() {
	return apply_filters('kubrick_header_image', get_option('kubrick_header_image'));
}

function kubrick_upper_color() {
	if (strpos($url = kubrick_header_image_url(), 'header-img.php?') !== false) {
		parse_str(substr($url, strpos($url, '?') + 1), $q);
		return $q['upper'];
	} else
		return '69aee7';
}

function kubrick_lower_color() {
	if (strpos($url = kubrick_header_image_url(), 'header-img.php?') !== false) {
		parse_str(substr($url, strpos($url, '?') + 1), $q);
		return $q['lower'];
	} else
		return '4180b6';
}

function kubrick_header_image_url() {
	if ( $image = kubrick_header_image() )
		$url = get_template_directory_uri() . '/images/' . $image;
	else
		$url = get_template_directory_uri() . '/images/kubrickheader.jpg';

	return $url;
}

function kubrick_header_color() {
	return apply_filters('kubrick_header_color', get_option('kubrick_header_color'));
}

function kubrick_header_color_string() {
	$color = kubrick_header_color();
	if ( false === $color )
		return 'white';

	return $color;
}

function kubrick_header_display() {
	return apply_filters('kubrick_header_display', get_option('kubrick_header_display'));
}

function kubrick_header_display_string() {
	$display = kubrick_header_display();
	return $display ? $display : 'inline';
}


add_action('template_redirect', 'start_mascob_session', 0);

function start_mascob_session () {

	$session_id = session_id();

	if(empty($session_id)) 

	{
  		session_start();
	}

}


function web_col( $atts, $content = null ) {

   return '<div class="colonne">' . do_shortcode($content) . '</div>';

}
//add_shortcode('colonne', 'web_col'); 
remove_shortcode('colonne'); 


// this can live in /themes/mytheme/functions.php, or maybe as a dev plugin?
function get_template_name () {
	foreach ( debug_backtrace() as $called_file ) {
		foreach ( $called_file as $index ) {
			if ( !is_array($index[0]) AND strstr($index[0],'/themes/') AND !strstr($index[0],'footer.php') ) {
				$template_file = $index[0] ;
			}
		}
	}
	$template_contents = file_get_contents($template_file) ;
	preg_match_all("(Template Name:(.*)\n)siU",$template_contents,$template_name);
	$template_name = trim($template_name[1][0]);
	if ( !$template_name ) { $template_name = '(default)' ; }
	$template_file = array_pop(explode('/themes/', basename($template_file)));
	return $template_file . ' > '. $template_name ;
}





///////////////////////////////////////////////
//
// Start WPOutfitters.com Custom Galley Function
//
//////////////////////////////////////////////

function wpo_get_images($size = 'thumbnail', $limit = '0', $offset = '0', $big = 'large', $post_id = '$post->ID', $link = '1', $img_class = 'attachment-image', $wrapper = 'div', $wrapper_class = 'attachment-image-wrapper') {
	global $post;

	$images = get_children( array('post_parent' => $post_id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );

	if ($images) {

		$num_of_images = count($images);

		if ($offset > 0) : $start = $offset--; else : $start = 0; endif;
		if ($limit > 0) : $stop = $limit+$start; else : $stop = $num_of_images; endif;

		$i = 0;
		foreach ($images as $attachment_id => $image) {
			if ($start <= $i and $i < $stop) {
			$img_title = $image->post_title;   // title.
			$img_description = $image->post_content; // description.
			$img_caption = $image->post_excerpt; // caption.
			//$img_page = get_permalink($image->ID); // The link to the attachment page.
			$img_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
			if ($img_alt == '') {
			$img_alt = $img_title;
			}
				if ($big == 'large') {
				$big_array = image_downsize( $image->ID, $big );
 				$img_url = $big_array[0]; // large.
				} else {
				$img_url = wp_get_attachment_url($image->ID); // url of the full size image.
				}
			//echo "XXX".startsWithNumber($size );
			// FIXED to account for non-existant thumb sizes.
			$preview_array = image_downsize( $image->ID, $size );
			//d($preview_array );
			if ($preview_array[3] != 'true') {
			$preview_array = image_downsize( $image->ID, 'thumbnail' );
 			$img_preview = $preview_array[0]; // thumbnail or medium image to use for preview.
 			$img_width = $preview_array[1];
 			$img_height = $preview_array[2];
			} else {
 			$img_preview = $preview_array[0]; // thumbnail or medium image to use for preview.
 			$img_width = $preview_array[1];
 			$img_height = $preview_array[2];
 			}
 			// End FIXED to account for non-existant thumb sizes.

 			///////////////////////////////////////////////////////////
			// This is where you'd create your custom image/link/whatever tag using the variables above.
			// This is an example of a basic image tag using this method.
			?>
			<?php if ($wrapper != '0') : ?>
			<<?php echo $wrapper; ?> class="<?php echo $wrapper_class; ?>">
			<?php endif; ?>
			<?php if ($link == '1') : ?>
			<a href="<?php echo $img_url; ?>" title="<?php echo $img_title; ?>">
			<?php endif; ?>
			<img class="<?php echo $img_class; ?>" src="<?php echo $img_preview; ?>" alt="<?php echo $img_alt; ?>" title="<?php echo $img_title; ?>" />
			<?php if ($link == '1') : ?>
			</a>
			<?php endif; ?>
			<?php if ($img_caption != '') : ?>
			<div class="attachment-caption"><?php echo $img_caption; ?></div>
			<?php endif; ?>
			<?php if ($img_description != '') : ?>
			<div class="attachment-description"><?php echo $img_description; ?></div>
			<?php endif; ?>
			<?php if ($wrapper != '0') : ?>
			</<?php echo $wrapper; ?>>
			<?php endif; ?>
			<?
			// End custom image tag. Do not edit below here.
			///////////////////////////////////////////////////////////

			}
			$i++;
		}

	}
} 

///////////////////////////////////////////////
//
// End WPOutfitters.com WP Custom Galley Function
//
//////////////////////////////////////////////
/*******************************************
Explanation of the arguments passed to the function:

wpo_get_images(
[preview_size], // See note 1
[number_of_images_to_show], // See note 2
[offset_from_first_image], // See note 3
[big_image_size], // See note 4
[post_id_to_get_images_from], // See note 5
[link_to_large_image], // See note 6
[image_class], // See note 7
[html_wrapper_tag], // See note 8
[html_wrapper_class] // See note 9
);

Notes:

1. The size of the WP produced thumbnail you want displayed. WP gives you 4 choices by default: 'thumbnail', 'medium', 'large', or 'full'. Using the add_image_size function in your functions.php file you can add your own sizes. This function defaults to 'thumbnail'.

2. Max number of images you want displayed for this call to the function. It will max out at the total number of images attached to the post. Defaults to showing all images.

3. Lets you start at image 2, 3, etc. Useful for distributing images around your post. The number here can override the numb roof images to show. Example: Say your post has 10 attached images. If you set this to 6 the function will only return images number 7,8,9,10 (4 total images) since you told the function to start at image number 6. This is simply because you've run out of images to print before you reach the number you requested.

4. The size of the large image you want to link to. Can either be 'large' or 'full'. Setting it to large will link to an image that WP resizes in accordance to what you set your large image size to on the media settings page. Setting it to 'full' will link to the untouched image you uploaded.

5. The post ID you want to show images from. Useful if you want to grab images form another post or want to set up a portfolio type thing. Defaults to the current post's ID ("$post->ID"). Remember to use double quotes when setting this one!

6. Whether or not to link to a large image. 0 = no, 1 = yes. If set to no, it will just display your chosen images set in [preview_size] without linking to bigger ones.

7. Name of the css class added to the image tag. Defaults to 'attachment-image'.

8. Type of html wrapper to enclose each image and all of it's related code in. Defaults to 'div'. Can also be 'ul', 'p', 'span', etc.

9. The css class assigned to each [html_wrapper_tag]. Defaults to 'attachment-image-wrapper'.

More notes: 

- In the media manager you can set the image's alt and title for each image. 

- If you choose to set a caption for an image, it will be displayed below the image and wrapped in a div called "attachment-caption".

- If you choose to set a description for an image, it will be displayed below the image and caption and wrapped in a div called "attachment-description".

*******************************************/


/*
 * Resize images dynamically using wp built in functions
 * Victor Teixeira
 *
 * php 5.2+
 *
 * Exemplo de uso:
 * 
 * <?php 
 * $thumb = get_post_thumbnail_id(); 
 * $image = vt_resize( $thumb, '', 140, 110, true );
 * ?>
 * <img src="<?php echo $image[url]; ?>" width="<?php echo $image[width]; ?>" height="<?php echo $image[height]; ?>" />
 *
 * @param int $attach_id
 * @param string $img_url
 * @param int $width
 * @param int $height
 * @param bool $crop
 * @return array
 */
function vt_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false ) {

  /* echo "att ".$attach_id;
   echo "img_url ".$img_url;*/
	// this is an attachment, so we have the ID
	if ( $attach_id ) {
	
		$image_src = wp_get_attachment_image_src( $attach_id, 'full' );
		$file_path = get_attached_file( $attach_id );
	
	// this is not an attachment, let's use the image url
	} else if ( $img_url ) {
		
		$file_path = parse_url( $img_url );
		$file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];
		
		//$file_path = ltrim( $file_path['path'], '/' );
		//$file_path = rtrim( ABSPATH, '/' ).$file_path['path'];
		
		$orig_size = getimagesize( $file_path );
		
		$image_src[0] = $img_url;
		$image_src[1] = $orig_size[0];
		$image_src[2] = $orig_size[1];
	}
	
	$file_info = pathinfo( $file_path );
	$extension = '.'. $file_info['extension'];

	// the image path without the extension
	$no_ext_path = $file_info['dirname'].'/'.$file_info['filename'];

	$cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;

	// checking if the file size is larger than the target size
	// if it is smaller or the same size, stop right here and return
	if ( $image_src[1] > $width || $image_src[2] > $height ) {

		// the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
		if ( file_exists( $cropped_img_path ) ) {

			$cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );
			
			$vt_image = array (
				'url' => $cropped_img_url,
				'width' => $width,
				'height' => $height
			);
			
			return $vt_image;
		}

		// $crop = false
		if ( $crop == false ) {
		
			// calculate the size proportionaly
			$proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
			$resized_img_path = $no_ext_path.'-'.$proportional_size[0].'x'.$proportional_size[1].$extension;			

			// checking if the file already exists
			if ( file_exists( $resized_img_path ) ) {
			
				$resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );

				$vt_image = array (
					'url' => $resized_img_url,
					'width' => $proportional_size[0],
					'height' => $proportional_size[1]
				);
				
				return $vt_image;
			}
		}

		// no cache files - let's finally resize it
		$new_img_path = image_resize( $file_path, $width, $height, $crop );
		$new_img_size = getimagesize( $new_img_path );
		$new_img = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );

		// resized output
		$vt_image = array (
			'url' => $new_img,
			'width' => $new_img_size[0],
			'height' => $new_img_size[1]
		);
		
		return $vt_image;
	}

	// default output - without resizing
	$vt_image = array (
		'url' => $image_src[0],
		'width' => $image_src[1],
		'height' => $image_src[2]
	);
	
	return $vt_image;
}
?>
