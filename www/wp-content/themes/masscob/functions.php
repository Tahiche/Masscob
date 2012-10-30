<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

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

add_action('admin_menu', 'kubrick_add_theme_page');

function kubrick_add_theme_page() {
	if ( isset( $_GET['page'] ) && $_GET['page'] == basename(__FILE__) ) {
		if ( isset( $_REQUEST['action'] ) && 'save' == $_REQUEST['action'] ) {
			check_admin_referer('kubrick-header');
			if ( isset($_REQUEST['njform']) ) {
				if ( isset($_REQUEST['defaults']) ) {
					delete_option('kubrick_header_image');
					delete_option('kubrick_header_color');
					delete_option('kubrick_header_display');
				} else {
					if ( '' == $_REQUEST['njfontcolor'] )
						delete_option('kubrick_header_color');
					else {
						$fontcolor = preg_replace('/^.*(#[0-9a-fA-F]{6})?.*$/', '$1', $_REQUEST['njfontcolor']);
						update_option('kubrick_header_color', $fontcolor);
					}
					if ( preg_match('/[0-9A-F]{6}|[0-9A-F]{3}/i', $_REQUEST['njuppercolor'], $uc) && preg_match('/[0-9A-F]{6}|[0-9A-F]{3}/i', $_REQUEST['njlowercolor'], $lc) ) {
						$uc = ( strlen($uc[0]) == 3 ) ? $uc[0]{0}.$uc[0]{0}.$uc[0]{1}.$uc[0]{1}.$uc[0]{2}.$uc[0]{2} : $uc[0];
						$lc = ( strlen($lc[0]) == 3 ) ? $lc[0]{0}.$lc[0]{0}.$lc[0]{1}.$lc[0]{1}.$lc[0]{2}.$lc[0]{2} : $lc[0];
						update_option('kubrick_header_image', "header-img.php?upper=$uc&lower=$lc");
					}

					if ( isset($_REQUEST['toggledisplay']) ) {
						if ( false === get_option('kubrick_header_display') )
							update_option('kubrick_header_display', 'none');
						else
							delete_option('kubrick_header_display');
					}
				}
			} else {

				if ( isset($_REQUEST['headerimage']) ) {
					check_admin_referer('kubrick-header');
					if ( '' == $_REQUEST['headerimage'] )
						delete_option('kubrick_header_image');
					else {
						$headerimage = preg_replace('/^.*?(header-img.php\?upper=[0-9a-fA-F]{6}&lower=[0-9a-fA-F]{6})?.*$/', '$1', $_REQUEST['headerimage']);
						update_option('kubrick_header_image', $headerimage);
					}
				}

				if ( isset($_REQUEST['fontcolor']) ) {
					check_admin_referer('kubrick-header');
					if ( '' == $_REQUEST['fontcolor'] )
						delete_option('kubrick_header_color');
					else {
						$fontcolor = preg_replace('/^.*?(#[0-9a-fA-F]{6})?.*$/', '$1', $_REQUEST['fontcolor']);
						update_option('kubrick_header_color', $fontcolor);
					}
				}

				if ( isset($_REQUEST['fontdisplay']) ) {
					check_admin_referer('kubrick-header');
					if ( '' == $_REQUEST['fontdisplay'] || 'inline' == $_REQUEST['fontdisplay'] )
						delete_option('kubrick_header_display');
					else
						update_option('kubrick_header_display', 'none');
				}
			}
			//print_r($_REQUEST);
			wp_redirect("themes.php?page=functions.php&saved=true");
			die;
		}
		add_action('admin_head', 'kubrick_theme_page_head');
	}
	add_theme_page(__('Custom Header'), __('Custom Header'), 'edit_themes', basename(__FILE__), 'kubrick_theme_page');
}

function kubrick_theme_page_head() {
?>
<script type="text/javascript" src="../wp-includes/js/colorpicker.js"></script>
<script type='text/javascript'>
// <![CDATA[
	function pickColor(color) {
		ColorPicker_targetInput.value = color;
		kUpdate(ColorPicker_targetInput.id);
	}
	function PopupWindow_populate(contents) {
		contents += '<br /><p style="text-align:center;margin-top:0px;"><input type="button" class="button-secondary" value="<?php esc_attr_e('Close Color Picker'); ?>" onclick="cp.hidePopup(\'prettyplease\')"></input></p>';
		this.contents = contents;
		this.populated = false;
	}
	function PopupWindow_hidePopup(magicword) {
		if ( magicword != 'prettyplease' )
			return false;
		if (this.divName != null) {
			if (this.use_gebi) {
				document.getElementById(this.divName).style.visibility = "hidden";
			}
			else if (this.use_css) {
				document.all[this.divName].style.visibility = "hidden";
			}
			else if (this.use_layers) {
				document.layers[this.divName].visibility = "hidden";
			}
		}
		else {
			if (this.popupWindow && !this.popupWindow.closed) {
				this.popupWindow.close();
				this.popupWindow = null;
			}
		}
		return false;
	}
	function colorSelect(t,p) {
		if ( cp.p == p && document.getElementById(cp.divName).style.visibility != "hidden" )
			cp.hidePopup('prettyplease');
		else {
			cp.p = p;
			cp.select(t,p);
		}
	}
	function PopupWindow_setSize(width,height) {
		this.width = 162;
		this.height = 210;
	}

	var cp = new ColorPicker();
	function advUpdate(val, obj) {
		document.getElementById(obj).value = val;
		kUpdate(obj);
	}
	function kUpdate(oid) {
		if ( 'uppercolor' == oid || 'lowercolor' == oid ) {
			uc = document.getElementById('uppercolor').value.replace('#', '');
			lc = document.getElementById('lowercolor').value.replace('#', '');
			hi = document.getElementById('headerimage');
			hi.value = 'header-img.php?upper='+uc+'&lower='+lc;
			document.getElementById('header').style.background = 'url("<?php echo get_template_directory_uri(); ?>/images/'+hi.value+'") center no-repeat';
			document.getElementById('advuppercolor').value = '#'+uc;
			document.getElementById('advlowercolor').value = '#'+lc;
		}
		if ( 'fontcolor' == oid ) {
			document.getElementById('header').style.color = document.getElementById('fontcolor').value;
			document.getElementById('advfontcolor').value = document.getElementById('fontcolor').value;
		}
		if ( 'fontdisplay' == oid ) {
			document.getElementById('headerimg').style.display = document.getElementById('fontdisplay').value;
		}
	}
	function toggleDisplay() {
		td = document.getElementById('fontdisplay');
		td.value = ( td.value == 'none' ) ? 'inline' : 'none';
		kUpdate('fontdisplay');
	}
	function toggleAdvanced() {
		a = document.getElementById('jsAdvanced');
		if ( a.style.display == 'none' )
			a.style.display = 'block';
		else
			a.style.display = 'none';
	}
	function kDefaults() {
		document.getElementById('headerimage').value = '';
		document.getElementById('advuppercolor').value = document.getElementById('uppercolor').value = '#69aee7';
		document.getElementById('advlowercolor').value = document.getElementById('lowercolor').value = '#4180b6';
		document.getElementById('header').style.background = 'url("<?php echo get_template_directory_uri(); ?>/images/kubrickheader.jpg") center no-repeat';
		document.getElementById('header').style.color = '#FFFFFF';
		document.getElementById('advfontcolor').value = document.getElementById('fontcolor').value = '';
		document.getElementById('fontdisplay').value = 'inline';
		document.getElementById('headerimg').style.display = document.getElementById('fontdisplay').value;
	}
	function kRevert() {
		document.getElementById('headerimage').value = '<?php echo esc_js(kubrick_header_image()); ?>';
		document.getElementById('advuppercolor').value = document.getElementById('uppercolor').value = '#<?php echo esc_js(kubrick_upper_color()); ?>';
		document.getElementById('advlowercolor').value = document.getElementById('lowercolor').value = '#<?php echo esc_js(kubrick_lower_color()); ?>';
		document.getElementById('header').style.background = 'url("<?php echo esc_js(kubrick_header_image_url()); ?>") center no-repeat';
		document.getElementById('header').style.color = '';
		document.getElementById('advfontcolor').value = document.getElementById('fontcolor').value = '<?php echo esc_js(kubrick_header_color_string()); ?>';
		document.getElementById('fontdisplay').value = '<?php echo esc_js(kubrick_header_display_string()); ?>';
		document.getElementById('headerimg').style.display = document.getElementById('fontdisplay').value;
	}
	function kInit() {
		document.getElementById('jsForm').style.display = 'block';
		document.getElementById('nonJsForm').style.display = 'none';
	}
	addLoadEvent(kInit);
// ]]>
</script>
<style type='text/css'>
	#headwrap {
		text-align: center;
	}
	#kubrick-header {
		font-size: 80%;
	}
	#kubrick-header .hibrowser {
		width: 780px;
		height: 260px;
		overflow: scroll;
	}
	#kubrick-header #hitarget {
		display: none;
	}
	#kubrick-header #header h1 {
		font-family: 'Trebuchet MS', 'Lucida Grande', Verdana, Arial, Sans-Serif;
		font-weight: bold;
		font-size: 4em;
		text-align: center;
		padding-top: 70px;
		margin: 0;
	}

	#kubrick-header #header .description {
		font-family: 'Lucida Grande', Verdana, Arial, Sans-Serif;
		font-size: 1.2em;
		text-align: center;
	}
	#kubrick-header #header {
		text-decoration: none;
		color: <?php echo kubrick_header_color_string(); ?>;
		padding: 0;
		margin: 0;
		height: 200px;
		text-align: center;
		background: url('<?php echo kubrick_header_image_url(); ?>') center no-repeat;
	}
	#kubrick-header #headerimg {
		margin: 0;
		height: 200px;
		width: 100%;
		display: <?php echo kubrick_header_display_string(); ?>;
	}
	
        .description {
                margin-top: 16px;
                color: #fff;
        }
	
	#jsForm {
		display: none;
		text-align: center;
	}
	#jsForm input.submit, #jsForm input.button, #jsAdvanced input.button {
		padding: 0px;
		margin: 0px;
	}
	#advanced {
		text-align: center;
		width: 620px;
	}
	html>body #advanced {
		text-align: center;
		position: relative;
		left: 50%;
		margin-left: -380px;
	}
	#jsAdvanced {
		text-align: right;
	}
	#nonJsForm {
		position: relative;
		text-align: left;
		margin-left: -370px;
		left: 50%;
	}
	#nonJsForm label {
		padding-top: 6px;
		padding-right: 5px;
		float: left;
		width: 100px;
		text-align: right;
	}
	.defbutton {
		font-weight: bold;
	}
	.zerosize {
		width: 0px;
		height: 0px;
		overflow: hidden;
	}
	#colorPickerDiv a, #colorPickerDiv a:hover {
		padding: 1px;
		text-decoration: none;
		border-bottom: 0px;
	}
</style>
<?php
}

function kubrick_theme_page() {
	if ( isset( $_REQUEST['saved'] ) ) echo '<div id="message" class="updated fade"><p><strong>'.__('Options saved.').'</strong></p></div>';
?>
<div class='wrap'>
	<h2><?php _e('Customize Header'); ?></h2>
	<div id="kubrick-header">
		<div id="headwrap">
			<div id="header">
				<div id="headerimg">
					<h1><?php bloginfo('name'); ?></h1>
					<div class="description"><?php bloginfo('description'); ?></div>
				</div>
			</div>
		</div>
		<br />
		<div id="nonJsForm">
			<form method="post" action="">
				<?php wp_nonce_field('kubrick-header'); ?>
				<div class="zerosize"><input type="submit" name="defaultsubmit" value="<?php esc_attr_e('Save'); ?>" /></div>
					<label for="njfontcolor"><?php _e('Font Color:'); ?></label><input type="text" name="njfontcolor" id="njfontcolor" value="<?php echo esc_attr(kubrick_header_color()); ?>" /> <?php printf(__('Any CSS color (%s or %s or %s)'), '<code>red</code>', '<code>#FF0000</code>', '<code>rgb(255, 0, 0)</code>'); ?><br />
					<label for="njuppercolor"><?php _e('Upper Color:'); ?></label><input type="text" name="njuppercolor" id="njuppercolor" value="#<?php echo esc_attr(kubrick_upper_color()); ?>" /> <?php printf(__('HEX only (%s or %s)'), '<code>#FF0000</code>', '<code>#F00</code>'); ?><br />
				<label for="njlowercolor"><?php _e('Lower Color:'); ?></label><input type="text" name="njlowercolor" id="njlowercolor" value="#<?php echo esc_attr(kubrick_lower_color()); ?>" /> <?php printf(__('HEX only (%s or %s)'), '<code>#FF0000</code>', '<code>#F00</code>'); ?><br />
				<input type="hidden" name="hi" id="hi" value="<?php echo esc_attr(kubrick_header_image()); ?>" />
				<input type="submit" name="toggledisplay" id="toggledisplay" value="<?php esc_attr_e('Toggle Text'); ?>" />
				<input type="submit" name="defaults" value="<?php esc_attr_e('Use Defaults'); ?>" />
				<input type="submit" class="defbutton" name="submitform" value="&nbsp;&nbsp;<?php esc_attr_e('Save'); ?>&nbsp;&nbsp;" />
				<input type="hidden" name="action" value="save" />
				<input type="hidden" name="njform" value="true" />
			</form>
		</div>
		<div id="jsForm">
			<form style="display:inline;" method="post" name="hicolor" id="hicolor" action="<?php echo esc_attr($_SERVER['REQUEST_URI']); ?>">
				<?php wp_nonce_field('kubrick-header'); ?>
	<input type="button"  class="button-secondary" onclick="tgt=document.getElementById('fontcolor');colorSelect(tgt,'pick1');return false;" name="pick1" id="pick1" value="<?php esc_attr_e('Font Color'); ?>"></input>
		<input type="button" class="button-secondary" onclick="tgt=document.getElementById('uppercolor');colorSelect(tgt,'pick2');return false;" name="pick2" id="pick2" value="<?php esc_attr_e('Upper Color'); ?>"></input>
		<input type="button" class="button-secondary" onclick="tgt=document.getElementById('lowercolor');colorSelect(tgt,'pick3');return false;" name="pick3" id="pick3" value="<?php esc_attr_e('Lower Color'); ?>"></input>
				<input type="button" class="button-secondary" name="revert" value="<?php esc_attr_e('Revert'); ?>" onclick="kRevert()" />
				<input type="button" class="button-secondary" value="<?php esc_attr_e('Advanced'); ?>" onclick="toggleAdvanced()" />
				<input type="hidden" name="action" value="save" />
				<input type="hidden" name="fontdisplay" id="fontdisplay" value="<?php echo esc_attr(kubrick_header_display()); ?>" />
				<input type="hidden" name="fontcolor" id="fontcolor" value="<?php echo esc_attr(kubrick_header_color()); ?>" />
				<input type="hidden" name="uppercolor" id="uppercolor" value="<?php echo esc_attr(kubrick_upper_color()); ?>" />
				<input type="hidden" name="lowercolor" id="lowercolor" value="<?php echo esc_attr(kubrick_lower_color()); ?>" />
				<input type="hidden" name="headerimage" id="headerimage" value="<?php echo esc_attr(kubrick_header_image()); ?>" />
				<p class="submit"><input type="submit" name="submitform" class="button-primary" value="<?php esc_attr_e('Update Header'); ?>" onclick="cp.hidePopup('prettyplease')" /></p>
			</form>
			<div id="colorPickerDiv" style="z-index: 100;background:#eee;border:1px solid #ccc;position:absolute;visibility:hidden;"> </div>
			<div id="advanced">
				<form id="jsAdvanced" style="display:none;" action="">
					<?php wp_nonce_field('kubrick-header'); ?>
					<label for="advfontcolor"><?php _e('Font Color (CSS):'); ?> </label><input type="text" id="advfontcolor" onchange="advUpdate(this.value, 'fontcolor')" value="<?php echo esc_attr(kubrick_header_color()); ?>" /><br />
					<label for="advuppercolor"><?php _e('Upper Color (HEX):');?> </label><input type="text" id="advuppercolor" onchange="advUpdate(this.value, 'uppercolor')" value="#<?php echo esc_attr(kubrick_upper_color()); ?>" /><br />
					<label for="advlowercolor"><?php _e('Lower Color (HEX):'); ?> </label><input type="text" id="advlowercolor" onchange="advUpdate(this.value, 'lowercolor')" value="#<?php echo esc_attr(kubrick_lower_color()); ?>" /><br />
					<input type="button" class="button-secondary" name="default" value="<?php esc_attr_e('Select Default Colors'); ?>" onclick="kDefaults()" /><br />
					<input type="button" class="button-secondary" onclick="toggleDisplay();return false;" name="pick" id="pick" value="<?php esc_attr_e('Toggle Text Display'); ?>"></input><br />
				</form>
			</div>
		</div>
	</div>
</div>
<?php } 


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
