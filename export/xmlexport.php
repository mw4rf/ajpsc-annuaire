<?php
session_start();

include('../includes/config.inc.php');
include('../includes/fonctions.inc.php');

/* Début: authentification */
if(checkauth())
{

// S'il y a une requête en mémoire correspondant à un résultat de recherche...
if(isset($_SESSION["exportation_permission"]) and $_SESSION["exportation_permission"] == true)
{
	// Premier cas: l'exportation de tout le contenu est permise
	if($_config['exporter_tout'] == 1)
	{
		$sql = $_SESSION["exportation_requete"];
	}
	// Deuxième cas: l'exportation du tout n'est pas permise
	else
	{
		$sql = $_SESSION["exportation_requete"];

		// On récupère la requête et on remplace le "SELECT *" par autre chose
		$requete = explode("*", $sql, 2);
		$sql = "SELECT nom, prenom, promotion, email ".$requete[1];

		$exporter_tout = false;
	}
}

// Si on demande EXPRESSEMENT de tout exporter ou d'exporter une partie seulement
if(isset($_GET['tout']))
{
	// On exporte tout
	if($_GET['tout'] == 1 and $_config['exporter_tout'] == 1)
	{
		$sql = "SELECT * FROM utilisateur;";
		$tout_exporter = true;
	}
	// On exporte une partie (exportation rapide)
	elseif($_GET['tout'] == 0)
	{
		$sql = "SELECT nom, prenom, promotion, email FROM utilisateur;";
		$tout_exporter = false;
	}
	// A défaut, on exporte seulement une partie (=> si $_config['exporter_tout'] != 1)
	else
	{
		$sql = "SELECT nom, prenom, promotion, email FROM utilisateur;";
		$tout_exporter = false;
	}
}

connexion();
$req = mysql_query($sql);

$export = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";

if($tout_exporter)
{
	$export .= "<!DOCTYPE annuaire [\n
	  			<!ELEMENT annuaire    (personne+)>\n
				<!ELEMENT personne    (donnees, questions)>\n
				<!ELEMENT donnees    (nom, prenom, promotion, lieu_naissance, date_naissance, adresse, e-mail)>\n
				<!ELEMENT questions    (reponse1, reponse2, reponse3, reponse4, reponse5, reponse6, notes)>\n
	  			<!ELEMENT nom      (#PCDATA)>\n
	  			<!ELEMENT prenom    (#PCDATA)>\n
	  			<!ELEMENT promotion (#PCDATA)>\n
	  			<!ELEMENT lieu_naissance    (#PCDATA)>\n
				<!ELEMENT date_naissance      (#PCDATA)>\n
				<!ELEMENT adresse      (#PCDATA)>\n
				<!ELEMENT e-mail      (#PCDATA)>\n
				<!ELEMENT reponse1      (#PCDATA)>\n
				<!ELEMENT reponse2      (#PCDATA)>\n
				<!ELEMENT reponse3      (#PCDATA)>\n
				<!ELEMENT reponse4      (#PCDATA)>\n
				<!ELEMENT reponse5      (#PCDATA)>\n
				<!ELEMENT reponse6      (#PCDATA)>\n
				<!ELEMENT notes      (#PCDATA)>\n
				]>\n";
}
else
{
	$export .= "<!DOCTYPE annuaire [\n
	  			<!ELEMENT annuaire    (personne+)>\n
				<!ELEMENT personne    (donnees)>\n
				<!ELEMENT donnees    (nom, prenom, promotion, e-mail)>\n
	  			<!ELEMENT nom      (#PCDATA)>\n
	  			<!ELEMENT prenom    (#PCDATA)>\n
	  			<!ELEMENT promotion (#PCDATA)>\n
				<!ELEMENT e-mail      (#PCDATA)>\n
				]>\n";
}

$export .= "<annuaire>\n";

while ($data = mysql_fetch_array($req))
{
	$export .= "<personne>\n";

	$export .= "\t<donnees>\n";

		$export .= "\t\t<nom>\n";
		$export .= "\t\t".utf8_encode(strip_tags(stripslashes($data['nom'])))."\n";
		$export .= "\t\t</nom>\n";

		$export .= "\t\t<prenom>\n";
		$export .= "\t\t".utf8_encode(strip_tags(stripslashes($data['prenom'])))."\n";
		$export .= "\t\t</prenom>\n";

		$export .= "\t\t<promotion>\n";
		$export .= "\t\t".utf8_encode(strip_tags(stripslashes($data['promotion'])))."\n";
		$export .= "\t\t</promotion>\n";

		if($exporter_tout)
		{
		$export .= "\t\t<lieu_naissance>\n";
		$export .= "\t\t".utf8_encode(strip_tags(stripslashes($data['nationalite'])))."\n";
		$export .= "\t\t</lieu_naissance>\n";

		$export .= "\t\t<date_naissance>\n";
		$export .= "\t\t".utf8_encode(strip_tags(stripslashes($data['naissance'])))."\n";
		$export .= "\t\t</date_naissance>\n";

		$export .= "\t\t<adresse>\n";
		$export .= "\t\t".utf8_encode(strip_tags(stripslashes($data['adresse'])))."\n";
		$export .= "\t\t</adresse>\n";
		}

		$export .= "\t\t<e-mail>\n";
		$export .= "\t\t".utf8_encode(strip_tags(stripslashes($data['email'])))."\n";
		$export .= "\t\t</e-mail>\n";

	$export .= "\t</donnees>\n";

	if($exporter_tout)
	{
	$export .= "\t<questions>\n";

		$export .= "\t\t<reponse1>\n";
		$export .= "\t\t".utf8_encode(strip_tags(stripslashes($data['q1'])))."\n";
		$export .= "\t\t</reponse1>\n";

		$export .= "\t\t<reponse2>\n";
		$export .= "\t\t".utf8_encode(strip_tags(stripslashes($data['q2'])))."\n";
		$export .= "\t\t</reponse2>\n";

		$export .= "\t\t<reponse3>\n";
		$export .= "\t\t".utf8_encode(strip_tags(stripslashes($data['q3'])))."\n";
		$export .= "\t\t</reponse3>\n";

		$export .= "\t\t<reponse4>\n";
		$export .= "\t\t".utf8_encode(strip_tags(stripslashes($data['q4'])))."\n";
		$export .= "\t\t</reponse4>\n";

		$export .= "\t\t<reponse5>\n";
		$export .= "\t\t".utf8_encode(strip_tags(stripslashes($data['q5'])))."\n";
		$export .= "\t\t</reponse5>\n";

		$export .= "\t\t<reponse6>\n";
		$export .= "\t\t".utf8_encode(strip_tags(stripslashes($data['q6'])))."\n";
		$export .= "\t\t</reponse6>\n";

		$export .= "\t\t<notes>\n";
		$export .= "\t\t".utf8_encode(strip_tags(stripslashes($data['q7'])))."\n";
		$export .= "\t\t</notes>\n";

	$export .= "\t</questions>\n";
	}

	$export .= "</personne>\n";
}

$export .= "</annuaire>";

/* Récupérer la date du jour pour former le nom du fichier téléchargé */
$date = date("Ymd");

/* Définition des header() PHP: le navigateur affiche un dialog de sauvegarde, mais pas cette page*/
header("Content-Type: text/xml");
header("Content-Disposition: attachment; filename=ajpsc_annuaire_".$date.".xml");
header("Content-Encoding: UTF-8");
header("Pragma: no-cache");
header("Expires: 0");
print "$export";

} else { echo "Erreur";}
/* Fin authentification */

?>