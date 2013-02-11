<?php
// Inclure la classe nécessaire
include("lib/Recherche.php");


// Cas 1: requête enregistrée: on affiche directement les résultats
if(isset($_GET["searchquery"])
	and $_GET["searchquery"] == 1
	and isset($_SESSION["searchquery-rq"])
	and isset($_SESSION["searchquery-ch"]) )
{
	// Créer un objet Recherche
	$rech = new Recherche($_SESSION["searchquery-rq"], $_SESSION["searchquery-ch"]);
}
// Cas 2: pas de requête enregistrée: on crée la nouvelle requête
else
{
	// Créer un objet Recherche
	$rech = new Recherche($_POST["requete"], $_POST["champ"]);
}

// Afficher les résultats
$rech->afficher_resultats();


?>
</table>