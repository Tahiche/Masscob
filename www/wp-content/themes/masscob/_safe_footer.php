<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
 
/* if (is_user_logged_in()) {
	echo ' | '. get_template_name() ;
}*/

?>
 
<hr />
<div id="footer" role="contentinfo">

</div>
</div>

<!-- Gorgeous design by Michael Heilemann - http://binarybonsai.com/kubrick/ -->
<?php /* "Just what do you think you're doing Dave?" */ ?>

		<?php wp_footer(); ?>
		
		<script type="text/javascript">
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
				
				/*********************************************/
				jQuery('#gallery_5 img').click(function(){
					//alert("c la fete");
					
					jQuery("#sb-title").html('<a href="#" onclick="Shadowbox.close(); return false;" class="cloclose">X</a>' +  str_replace('<a href="#" onclick="Shadowbox.close(); return false;" class="cloclose">X</a>', '', jQuery("#sb-title").html()));
					jQuery("#sb-title").attr('style','padding-right:3px; text-align:right; height:10px; padding-top:16px;' + jQuery("#sb-title").attr('style'));
				
				});
				
				/*****************************************/
			});
			jQuery(document).ready(function(){
				
				/*********************************************/
				jQuery('#gallery_7 img').click(function(){
					//alert("c la fete");
					
					jQuery("#sb-title").html('<a href="#" onclick="Shadowbox.close(); return false;" class="cloclose">X</a>' +  str_replace('<a href="#" onclick="Shadowbox.close(); return false;" class="cloclose">X</a>', '', jQuery("#sb-title").html()));
					jQuery("#sb-title").attr('style','padding-right:3px; text-align:right; height:10px; padding-top:16px;' + jQuery("#sb-title").attr('style'));
				
				});
				
				/*****************************************/
			});
jQuery(document).ready(function(){
				
				/*********************************************/
				jQuery('#gallery_1577 img').click(function(){
					//alert("c la fete");
					
					jQuery("#sb-title").html('<a href="#" onclick="Shadowbox.close(); return false;" class="cloclose">X</a>' +  str_replace('<a href="#" onclick="Shadowbox.close(); return false;" class="cloclose">X</a>', '', jQuery("#sb-title").html()));
					jQuery("#sb-title").attr('style','padding-right:3px; text-align:right; height:10px; padding-top:16px;' + jQuery("#sb-title").attr('style'));
				
				});
				
				/*****************************************/
			});
jQuery(document).ready(function(){
				
				/*********************************************/
				jQuery('#gallery_2000 img').click(function(){
					//alert("c la fete");
					
					jQuery("#sb-title").html('<a href="#" onclick="Shadowbox.close(); return false;" class="cloclose">X</a>' +  str_replace('<a href="#" onclick="Shadowbox.close(); return false;" class="cloclose">X</a>', '', jQuery("#sb-title").html()));
					jQuery("#sb-title").attr('style','padding-right:3px; text-align:right; height:10px; padding-top:16px;' + jQuery("#sb-title").attr('style'));
				
				});
				
				/*****************************************/
			});
		</script>
<script type="text/javascript">
// document.getElementById('sb-title').innerHTML='<a class="cloclose" onclick="Shadowbox.close(); return false;" href="#">X</a>'+document.getElementById('sb-title').innerHTML
</script>
</body>
</html>
