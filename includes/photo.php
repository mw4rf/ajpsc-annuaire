<?php

//        Annuaire Alumnii
//        Base de données et annuaire d'anciens étudiants.
//        Copyright (C) <2006>  <Guillaume Florimond>    

//        This program is free software: you can redistribute it and/or modify
//        it under the terms of the GNU General Public License as published by
//        the Free Software Foundation, either version 3 of the License, or
//        (at your option) any later version.    

//        This program is distributed in the hope that it will be useful,
//        but WITHOUT ANY WARRANTY; without even the implied warranty of
//        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//        GNU General Public License for more details.    

//        You should have received a copy of the GNU General Public License
//        along with this program.  If not, see <https://www.gnu.org/licenses/>. 

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