<?php
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