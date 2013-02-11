<?php
session_start();

if(!isset($_GET['id']) or empty($_GET['id']))
	header("Location: index.php");

include('config.inc.php');
include('fonctions.inc.php');

// Get image ID in database
$id = intval($_GET['id']);

// Connecting database
connexion();

// Loading image
$r = mysql_fetch_assoc(mysql_query("SELECT photo,extension FROM photo WHERE user_id = '$id'"));

// Displaying
header('Content-type: image/'.$r['extension']);
echo $r['photo'];
?>