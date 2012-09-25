<?php

/*
Plugin Name: Recuperation mail
Plugin URI: 
Description: Permet de récupérer les mails de la newsletter
Version: 1.0.0
Author: Fal&eacute;m&eacute; Jonathan
Author URI: 
Update Server:  
Min WP Version: 1.0.0
Max WP Version: 1.0.0
License: Free GPL
 
 
*/

function toto(){

	echo ('<br/>Pour recuperer les mails cliquez : <a href="'.get_bloginfo('url').'/wp-content/ici.php?show=true&toto=tutu">ici</a>');
	
}

function menu_telecharger_membre_newsletter(){
	add_menu_page('telecharger_membre_newsletter','telecharger',7,__FILE__,'toto');
}


add_action('admin_menu','menu_telecharger_membre_newsletter');

/****
header('Content-Type: application/csv-tab-delimited-table');
header('Content-disposition: filename='.$_GET['date'].'_comma.csv');

function fct_curl($url) {
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_URL, $url);
	
	$xxx = curl_error($curl).curl_exec($curl).curl_error($curl);
	
	
	curl_close ($curl);
	if(substr($xxx,0,9) != '<!DOCTYPE')
		return $xxx;
	else
		return '';
}

$content .= fct_curl('http://www.woolandthegang.com/media/csv/'.$_GET['date'].'.csv');
$content .= fct_curl('http://uk.woolandthegang.com/media/csv/'.$_GET['date'].'.csv');
$content .= fct_curl('http://usa.woolandthegang.com/media/csv/'.$_GET['date'].'.csv');

echo ( str_replace(';','',$content) );
****/

?>