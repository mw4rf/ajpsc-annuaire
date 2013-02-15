<?php
session_start();

include('../includes/config.inc.php');
include('../includes/phrases.php');
include('../includes/fonctions.inc.php');

connexion();

/*
* Ce fichier s'appelle de manière autonome, sans passer par index.php.
* Les paramètres sont:
* - id => l'id de la fiche à afficher pour imprimer. Si non défini: toutes les fiches.
* - tri => "pr" pour trier par promo ou "nm" pour trier par nom. Si non défini: pas de tri.
*
*/

// Exportation 1 fiche
if(isset($_GET['id']))
{
	$voir_id = addslashes($_GET['id']);
	if(!is_numeric($voir_id)) die();

	$sql = "SELECT * FROM utilisateur WHERE id='$voir_id'";
}
// Exportation TOUTES les fiches
elseif(isset($_GET["tout"]) and $_GET["tout"] == 1)
{
	$sql = "SELECT * FROM utilisateur";

	if(isset($_GET['tri']))
	{
		$tri = $_GET['tri'];

		if($tri == "pr")
			$sql .= " ORDER BY promotion ASC;";
		elseif($tri == "nm")
			$sql .= " ORDER BY nom ASC;";
		else
			$sql .= ";";
	}
}
// Exportation résultat recherche
elseif(isset($_SESSION["exportation_permission"]) and $_SESSION["exportation_permission"] == true)
{
	$sql = $_SESSION["exportation_requete"];
}
// Si rien de ce qui précède... par défaut => tout
else
{
	$sql = "SELECT * FROM utilisateur";
}

$req = mysql_query($sql) or die('Erreur');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<!--
/*******************************************************************************
********************************************************************************
**********                          AJPSC Annuaire                    **********
**********                            Version <?php echo $_version; ?>                   **********
**********          Copyright (c) 2006-<?php echo date("Y"); ?> Guillaume Florimond       **********
**********                       www.ajpsc.com                        **********
**********                       www.valhalla.fr                      **********
********************************************************************************
*******************************************************************************/
-->

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>AJPSC.com::Annuaire</title>
	<meta name="author" content="Guillaume Florimond">
	<!-- JavaScript -->
		<!-- @GF -->
		<script src="../includes/js/scripts.js" type="text/javascript"></script>
		<!-- @Tierce-Partie : SweetTitles -->
		<script src="../includes/js/sweettitles/addEvent.js" type="text/javascript"></script>
		<script src="../includes/js/sweettitles/titles.js" type="text/javascript"></script>
	<!-- // JavaScript -->

	<!-- Style CSS -->
	<style type="text/css" media="screen,print">
		@import url("../themes/<?php echo obtenir_theme(); ?>/style.css");
	</style>
</head>
<body>
<div id="imprimer">

<?php
// Debut WHILE
while($data = mysql_fetch_assoc($req))
{

$afficher['nom'] = (stripslashes(formater_nom($data['nom'])));
$afficher['prenom'] = (stripslashes(formater_nom($data['prenom'])));
$afficher['promotion'] = (stripslashes($data['promotion']));
$afficher['nationalite'] = (stripslashes($data['nationalite']));
$afficher['naissance'] = (stripslashes($data['naissance']));
$afficher['adresse'] = (stripslashes($data['adresse']));
$afficher['email'] = (stripslashes($data['email']));
$afficher['modif'] = formater_date($data['modif'],false);

$afficher['q1'] = (stripslashes($data['q1']));
$afficher['q2'] = (stripslashes($data['q2']));
$afficher['q3'] = (stripslashes($data['q3']));
$afficher['q4'] = (stripslashes($data['q4']));
$afficher['q5'] = (stripslashes($data['q5']));
$afficher['q6'] = (stripslashes($data['q6']));
$afficher['q7'] = (stripslashes($data['q7']));

/* Photo */
$sql2 = "SELECT height,width FROM photo WHERE user_id='".$data['id']."'";
$req2 = mysql_query($sql2) or die('Erreur');
$data2 = mysql_fetch_assoc($req2);

$imgW =  $data2['width'];
$imgH = $data2['height'];
if($imgW == 0) $imgW = 1;

// Resizing image to make a thumbnail
$thumb_width = $_config['images_largeur_fiches'];
$thumb_height = round($imgH / $imgW * $thumb_width);

$photo = "<img height=\"$thumb_height\" width=\"$thumb_width\" src=\"../includes/photo.php?id=".$data['id']."\">";

?>

<table width="80%" border="0" align="center" cellpadding="2" cellspacing="2" class="imprimer_reponse">
  <tr>
    <td>
		<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="reponse">
			<tr>
				<td>
					<table width="100%" border="0" align="left" cellpadding="2" cellspacing="2" class="reponse">
					<tr>
						<td class="plus-gros"><span class="petites-majuscules"><?php echo $afficher['nom']; ?></span>&nbsp;<?php echo $afficher['prenom']; ?></td>
					</tr>
					<tr>
						<td><?php dire("ne-vp") ?>
					    	&nbsp;<?php echo $afficher['nationalite']; ?>&nbsp;
					    	<?php dire("ne-le") ?>
					    	&nbsp;<?php echo convertir_date($afficher['naissance']); ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php dire('c3'); ?>&nbsp;<?php echo abbr3($afficher['promotion'], promotion($afficher['promotion'])); ?>
							<br />
							<i><?php dire("modif"); echo " ".$afficher['modif']; ?></i>
						</td>
					</tr>
					</table>
				</td>
				<td style="text-align:right;"><?php echo $photo; ?></td>
			</tr>
		</table>
	</td>
  </tr>
  <tr>
	<td>&nbsp;</td>
  </tr><tr>
    <td><?php echo $afficher['adresse']; ?></td>
    </tr>
  <tr>
    <td>
		<?php echo $afficher['email']; ?>
	</td>
    </tr>
    <tr class="imprimer_orange">
      <td height="3">&nbsp;</td>
    </tr>

	<?php if($afficher['q1'] != "") { ?>
	<tr>
      <td class="imprimer_question"><?php dire("q1"); ?></td>
    </tr>
    <tr>
      <td><?php echo $afficher['q1']; ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
	<?php } ?>

	<?php if($afficher['q2'] != "") { ?>
    <tr>
      <td class="imprimer_question"><?php dire("q2"); ?></td>
    </tr>
    <tr>
      <td><?php echo $afficher['q2']; ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
	<?php } ?>

	<?php if($afficher['q3'] != "") { ?>
	<tr>
      <td class="imprimer_question"><?php dire("q3"); ?></td>
    </tr>
    <tr>
      <td><?php echo $afficher['q3']; ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
	<?php } ?>

	<?php if($afficher['q4'] != "") { ?>
	<tr>
      <td class="imprimer_question"><?php dire("q4"); ?></td>
    </tr>
    <tr>
      <td><?php echo $afficher['q4']; ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
	<?php } ?>

	<?php if($afficher['q5'] != "") { ?>
	<tr>
      <td class="imprimer_question"><?php dire("q5"); ?></td>
    </tr>
    <tr>
      <td><?php echo $afficher['q5']; ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
	<?php } ?>

	<?php if($afficher['q6'] != "") { ?>
	<tr>
      <td class="imprimer_question"><?php dire("q6"); ?></td>
    </tr>
    <tr>
      <td><?php echo $afficher['q6']; ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <?php } ?>

	<?php if($afficher['q7'] != "") { ?>
	<tr>
      <td class="imprimer_question"><?php dire("q7"); ?></td>
    </tr>
    <tr>
      <td><?php echo $afficher['q7']; ?></td>
    </tr>
	<?php } ?>
  </table>

	<?php if(!isset($_GET['id'])) { ?>
	<p class="imprimer_separateur">&nbsp;</p>
	<?php } ?>

<?php
// Fin WHILE
}
?>
</div>
</body>
</html>
