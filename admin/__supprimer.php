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

include("../includes/config.inc.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>AJPSC Annuaire - Supprimer une fiche</title>
	<meta name="author" content="Guillaume Florimond">
	<!-- Date: 2006-12-21 -->
</head>
<body>

<?php
/* Se connecter à la bdd et effectuer les changements voulus  */
if($_GET["action"] == "supprimer") {

/* Récupération du contenu du formulaire */
$id = $_POST['id'];

/* Connexion à la base de données */
$db = mysql_connect($_config['host'], $_config['user'], $_config['passwd']);
mysql_select_db($_config['base'],$db);

$sql = "DELETE FROM utilisateur WHERE id=$id;";
mysql_query($sql) or die('Erreur');

/* Affichage d'un message pour dire que tout s'est bien passé */
echo "Fiche supprimée.";
}
else
{
?>

<form name="supprimer" method="post" action="supprimer.php?action=supprimer">
<table width="45%" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <td>Numéro de la fiche à supprimer: </td>
    <td><input type="input" name="id" /></td>
  </tr>
  <tr>
    <td colspan="2"><label>
    <div align="center">
      <input type="submit" name="Submit" value="Supprimer" />
    </div>
    </label></td>
  </tr>
</table>
</form>

<?php
}
?>

</body>
</html>