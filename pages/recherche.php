<?php
// Inclure la classe n�cessaire
include("lib/Recherche.php");


// Cas 1: requ�te enregistr�e: on affiche directement les r�sultats
if(isset($_GET["searchquery"])
	and $_GET["searchquery"] == 1
	and isset($_SESSION["searchquery-rq"])
	and isset($_SESSION["searchquery-ch"]) )
{
	// Cr�er un objet Recherche
	$rech = new Recherche($_SESSION["searchquery-rq"], $_SESSION["searchquery-ch"]);
}
// Cas 2: pas de requ�te enregistr�e: on cr�e la nouvelle requ�te
else
{
	// Cr�er un objet Recherche
	$rech = new Recherche($_POST["requete"], $_POST["champ"]);
}

// Afficher les r�sultats
$rech->afficher_resultats();


?>
</table>