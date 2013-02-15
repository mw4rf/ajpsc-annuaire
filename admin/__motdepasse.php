<?php
include("../includes/config.inc.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>AJPSC Annuaire - Modification du mot de passe</title>
	<meta name="author" content="Guillaume Florimond">
	<!-- Date: 2006-12-08 -->
</head>
<body>

<?php
/* Se connecter à la bdd et effectuer les changements voulus  */
if($_GET["action"] == "changer") {

/* Récupération du contenu du formulaire */
$pass = $_POST['pass'];

/* Chiffrement du mot de passe */
$pass = sha1($pass);

/* Connexion à la base de données */
$db = mysql_connect($_config['host'], $_config['user'], $_config['passwd']);
mysql_select_db($_config['base'],$db);

/* Construction de la requête SQL */
$sql = "UPDATE admin SET pass='$pass' WHERE id='1';";

/* Exécution de la requête */
$req = mysql_query($sql) or die("Erreur");

/* Affichage d'un message pour dire que tout s'est bien passé */
echo "Modification effectu&eacute;e.";
}
else
{
?>

<form id="mdp" name="mdp" method="post" action="motdepasse.php?action=changer">
<table width="45%" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <td>Nouveau mot de passe: </td>
    <td><input type="input" name="pass" /></td>
  </tr>
  <tr>
    <td colspan="2"><label>
    <div align="center">
      <input type="submit" name="Submit" value="Envoyer" />
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