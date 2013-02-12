<?php
session_start();

include('../includes/config.inc.php');
include('../includes/fonctions.inc.php');
include('../includes/phrases.php');

/* Début: authentification */
if(checkauth())
{

	// Récupération des données
	$sql = generer_requete();
	connexion();
	$req = mysql_query($sql);
	$numf = mysql_num_rows($req);

	// Création de l'objet PDF
	include('../lib/pdf.php');
	$pdf=new PDF();

	// Si on affiche tout l'annuaire, ajouter la page de garde. Sinon ne pas l'ajouter.
	if($_GET["pdf"] == "tout")
		$pdf->PageDeGarde();

	// Remplissage des données
	while($data = mysql_fetch_assoc($req))
	{
		// Ajouter une page pour chaque fiche
		$pdf->ajouter_page($data);
	}

	// Si on affiche tout l'annuaire, ajouter les annexes. Sinon, ne pas les ajouter.
	if($_GET["pdf"] == "tout")
	{
		$pdf->colonnes = TRUE;
		// Annexe des étudiants par promotion
		$pdf->liste_promo(promo_count());
		// Annexe des étudiants par nom de famille
		$pdf->liste_nom(nom_count());
		// Ajouter la dernière page
		$pdf->DernierePage();
	}

	// Sortie (Affichage du PDF)
	$pdf->Output();
}
else
{
	echo "Erreur d'identification";
}

/* Renvoie un tableau avec 1 entrée par nom. ex: $return[0] = "Guillaume Florimond"*/
function nom_count()
{
	// Récupérer tous les noms et prénoms, les classer par ordre alphabétique
	$sql = "SELECT nom,prenom FROM utilisateur ORDER BY nom ASC;";
	$req = mysql_query($sql);

	// Combien de noms ?
	$count = mysql_num_rows($req);

	// Rentrer chaque nom dans une case du tableau
	$i = 0;
	while($data = mysql_fetch_assoc($req))
	{
		$nom = trim(formater_nom($data["nom"]));
		$prenom = trim(formater_nom($data["prenom"]));

		// $nom{0} est le premier caractère de la chaîne $nom
		$tab[$nom{0}][$i] = "$nom $prenom";
		$i++;
	}

	// Retour
	return $tab;
}

/* Renvoie un tableau bidimentionnel. ex: $return[2006][1] = "Guillaume Florimond" */
function promo_count()
{
	// Récupérer toutes les valeurs DISTINCTES dans la colonne "promotion"
	$sql = "SELECT DISTINCT promotion FROM utilisateur ORDER BY promotion ASC;";
	$req = mysql_query($sql) or die ("Erreur: version de MySQL trop ancienne.");

	// Combien de promos différentes ?
	$count = mysql_num_rows($req);

	// Rentrer chaque promo différente dans une case du tableau
	$i = 0;
	while($data = mysql_fetch_assoc($req))
	{
		$promos[$i] = $data["promotion"];
		$i++;
	}

	// Pour chaque promo différente, récupérer tous les noms+prénoms
	for($i = 0; $i < $count ; $i++)
	{

		$p = $promos[$i];

		$sqlx = "SELECT nom,prenom FROM utilisateur WHERE promotion=$p;";
		$reqx = mysql_query($sqlx) or die ("Erreur");

		$j = 0;
		while($datax = mysql_fetch_assoc($reqx))
		{
			$tab[$p][$j] = formater_nom($datax["prenom"])." ".formater_nom($datax["nom"]);
			$j++;
		}
	}

	return $tab;
	// Tab doit se lire ainsi: $tab[année de la promotion][1...n] = "Guillaume Florimond"
}

/*Génère la requête SQL et la renvoie.
Trois types de requêtes:
- Résultat de recherche => ...pdfexport.php?pdf=recherche
- Exporter tout => ...pdfexport.php?pdf=tout
- Exporter la fiche courante => ...pdfexport.php?pdf=fiche&id=X
*/
function generer_requete()
{
	// Sécurité
	if(!checkauth()) return;

	global $_config;

	// 1 - S'il y a une requête en mémoire correspondant à un résultat de recherche...
	if( isset($_SESSION["exportation_permission"])
		  and $_SESSION["exportation_permission"] == true
		  and $_GET['pdf'] == "recherche")
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

	// 2 - Si on demande EXPRESSEMENT de tout exporter ou d'exporter une partie seulement
	if($_GET['pdf'] == "tout")
	{
		// On exporte tout
		if($_config['exporter_tout'] == 1)
		{
			$sql = "SELECT nom, prenom, promotion, nationalite, naissance, adresse, email, q1, q2, q3, q4, q5, q6, q7 FROM utilisateur ORDER BY promotion ASC;";
		}
		// A défaut, on exporte seulement une partie (=> si $_config['exporter_tout'] != 1)
		else
		{
			$sql = "SELECT nom, prenom, promotion, email FROM utilisateur;";
		}
	}

	// 3 -  Si l'on n'exporte qu'une seule fiche
	if($_GET['pdf'] == "fiche" and isset($_GET['id']) and is_numeric($_GET['id']))
	{
        // Security
        $id = $_GET['id'];
        if(!is_numeric($id))
            die("No injection, please :)");
        // Query
		$sql = "SELECT * FROM utilisateur
                JOIN photo ON utilisateur.id = photo.user_id
                WHERE utilisateur.id=$id";
	}

	return $sql;
}

?>