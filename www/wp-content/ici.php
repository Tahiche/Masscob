<?php

if(empty($_GET['toto'])) return '';
if(empty($_GET['show'])) return '';

if($_GET['show']!='true') return '';
if($_GET['toto']!='tutu') return '';

define('HOST', 'hl94.dinaserver.com');
define('USER', 'masscob');
define('PWD', 'masscob01');
define('DB', 'masscob');

$connexion=mysql_connect(HOST, USER, PWD);
mysql_select_db(DB);
mysql_query("SET NAMES 'utf8'");

header('Content-Type: application/csv-tab-delimited-table');
header('Content-disposition: filename=membre_newsletter.csv');


	$query = "
		SELECT *
		FROM wp_newsletter_users
		ORDER BY email
	";
	
	$res = mysql_query($query,$connexion);
	
	while($data=mysql_fetch_assoc($res)){
		echo $data['email'].';'.$data['joindate']."\n";
	} 
	
?>