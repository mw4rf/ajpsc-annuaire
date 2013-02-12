<?php
session_start();

include('../includes/config.inc.php');
include('../includes/fonctions.inc.php');
include('../includes/phrases.php');

/* D�but: authentification */
if(checkauth())
{

	// R�cup�ration des donn�es
	$sql = generer_requete();
	connexion();
	$req = mysql_query($sql);
	$numf = mysql_num_rows($req);

	// Cr�ation de l'objet PDF
	include('../lib/pdf.php');
	$pdf=new PDF();

	// Si on affiche tout l'annuaire, ajouter la page de garde. Sinon ne pas l'ajouter.
	if($_GET["pdf"] == "tout")
		$pdf->PageDeGarde();

	// Remplissage des donn�es
	while($data = mysql_fetch_assoc($req))
	{
		// Ajouter une page pour chaque fiche
		$pdf->ajouter_page($data);
	}

	// Si on affiche tout l'annuaire, ajouter les annexes. Sinon, ne pas les ajouter.
	if($_GET["pdf"] == "tout")
	{
		$pdf->colonnes = TRUE;
		// Annexe des �tudiants par promotion
		$pdf->liste_promo(promo_count());
		// Annexe des �tudiants par nom de famille
		$pdf->liste_nom(nom_count());
		// Ajouter la derni�re page
		$pdf->DernierePage();
	}

	// Sortie (Affichage du PDF)
	$pdf->Output();
}
else
{
	echo "Erreur d'identification";
}

/* Renvoie un tableau avec 1 entr�e par nom. ex: $return[0] = "Guillaume Florimond"*/
function nom_count()
{
	// R�cup�rer tous les noms et pr�noms, les classer par ordre alphab�tique
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

		// $nom{0} est le premier caract�re de la cha�ne $nom
		$tab[$nom{0}][$i] = "$nom $prenom";
		$i++;
	}

	// Retour
	return $tab;
}

/* Renvoie un tableau bidimentionnel. ex: $return[2006][1] = "Guillaume Florimond" */
function promo_count()
{
	// R�cup�rer toutes les valeurs DISTINCTES dans la colonne "promotion"
	$sql = "SELECT DISTINCT promotion FROM utilisateur ORDER BY promotion ASC;";
	$req = mysql_query($sql) or die ("Erreur: version de MySQL trop ancienne.");

	// Combien de promos diff�rentes ?
	$count = mysql_num_rows($req);

	// Rentrer chaque promo diff�rente dans une case du tableau
	$i = 0;
	while($data = mysql_fetch_assoc($req))
	{
		$promos[$i] = $data["promotion"];
		$i++;
	}

	// Pour chaque promo diff�rente, r�cup�rer tous les noms+pr�noms
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
	// Tab doit se lire ainsi: $tab[ann�e de la promotion][1...n] = "Guillaume Florimond"
}

/*G�n�re la requ�te SQL et la renvoie.
Trois types de requ�tes:
- R�sultat de recherche => ...pdfexport.php?pdf=recherche
- Exporter tout => ...pdfexport.php?pdf=tout
- Exporter la fiche courante => ...pdfexport.php?pdf=fiche&id=X
*/
function generer_requete()
{
	// S�curit�
	if(!checkauth()) return;

	global $_config;

	// 1 - S'il y a une requ�te en m�moire correspondant � un r�sultat de recherche...
	if( isset($_SESSION["exportation_permission"])
		  and $_SESSION["exportation_permission"] == true
		  and $_GET['pdf'] == "recherche")
	{
		// Premier cas: l'exportation de tout le contenu est permise
		if($_config['exporter_tout'] == 1)
		{
			$sql = $_SESSION["exportation_requete"];
		}
		// Deuxi�me cas: l'exportation du tout n'est pas permise
		else
		{
			$sql = $_SESSION["exportation_requete"];

			// On r�cup�re la requ�te et on remplace le "SELECT *" par autre chose
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
		// A d�faut, on exporte seulement une partie (=> si $_config['exporter_tout'] != 1)
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