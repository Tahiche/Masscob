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
		
		<? /* <a title="Video" rel="shadowbox[samples;height=320;width=480]" href="http://vimeo.com/moogaloop.swf?clip_id=6891763&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=&amp;fullscreen=1">
			<img src="<?php bloginfo('stylesheet_directory'); ?>/images/home.jpg" />
		</a> */ ?>
		<?php 
		//$T_image = array('home','points-of-sale','credit', 'history');
		// $T_image = array('home','home2','home','home2');
		//$T_image = array('home3','home4','home5','home6',);
		$T_image = array('home1','home2','home3','home4','home5');
		?>
        
        <div id="slideshow1" class="pics" style="position: relative; ">
           <?php foreach ($T_image as $id=>$img):
		    ?>
           
           <img style="float:left;" src="<?php bloginfo('stylesheet_directory'); ?>/images/sept12/<?php echo $img ?>.jpg" />
           
           <?php endforeach; ?>
           
        </div>
        
			
			
		<div style="clear:both"></div>
		
        
        
	</div>
	
	
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>
