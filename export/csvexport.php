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
	}
}

// Si on demande EXPRESSEMENT de tout exporter ou d'exporter une partie seulement
if(isset($_GET['tout']))
{
	// On exporte tout
	if($_GET['tout'] == 1 and $_config['exporter_tout'] == 1)
	{
		$sql = "SELECT nom, prenom, promotion, nationalite, naissance, email, q1, q2, q3, q4, q5, q6, q7 FROM utilisateur;";
	}
	// On exporte une partie (exportation rapide)
	elseif($_GET['tout'] == 0)
	{
		$sql = "SELECT nom, prenom, promotion, email FROM utilisateur;";
	}
	// A défaut, on exporte seulement une partie (=> si $_config['exporter_tout'] != 1)
	else
	{
		$sql = "SELECT nom, prenom, promotion, email FROM utilisateur;";
	}
}


connexion();
$export = mysql_query($sql);
$fields = mysql_num_fields($export);

/* Extraction du titre des colonnes */
for ($i = 0; $i < $fields; $i++)
{	$header .= mysql_field_name($export, $i) . ";";
}

/* Extraction du contenu des colonnes */
while($row = mysql_fetch_row($export))
{	$line = '';
    foreach($row as $value) // pour parcourir le tableau
    {	if ((!isset($value)) OR ($value == ""))
        {	$value = ";"; }
        else
        {	$value = str_replace('"', '""', $value);
            $value = '"' . $value . '"' . ";";
			// Enlever les slashes
			$value = stripslashes($value);
			// Enlever les tags HTML
			$value = strip_tags($value);
        }
        $line .= $value;
    }
    $data .= trim($line)."\n";
}

/* $data contient toute la base de donnée */
$data = str_replace("\r","",$data);

/* Prévenir l'utilisateur s'il n'y a aucune entrée dans la BDD */
if ($data == "") {
    $data = "\n Aucune entrée dans la base de données.\n";
}

/* IMPORTANT
* Malheureusement, MS Excel 2004 pour Mac n'est pas parfait... Il n'arrive pas à ouvrir le fichier de sortie avec l'encodage correct. Les caractères français sont mal interprétés, que l'encodage soit Latin1 ou UTF-8. Il n'y a aucune solution à cela. Il faudra utiliser une version PC ou attendre que Microsoft se réveille...*/
// Encoder le tout en UTF-8
//utf8_encode($data);

/* Récupérer la date du jour pour former le nom du fichier téléchargé */
$date = date("Ymd");

/* Définition des header() PHP: le navigateur affiche un dialog de sauvegarde, mais pas cette page*/
header("Content-Type: application/csv-tab-delimited-table; charset=UTF-8");
header("Content-Disposition: attachment; filename=ajpsc_annuaire_".$date.".csv");
header("Content-Encoding:UTF-8");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";

} else { echo "Erreur";}
/* Fin authentification */

?>