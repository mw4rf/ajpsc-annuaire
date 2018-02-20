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