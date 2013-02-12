<?php
include("fpdf/fpdf.php");

class PDF extends FPDF
{
	var $col = 0; // nombre de colonnes sur lesquelles le texte doit �tre r�parti
	var $colonnes; // est-ce que la r�partition du texte sur plusieurs colonnes est activ�e?
	var $titre; // est-ce que le titre de la page doit �tre affich�? (mode multi-colonnes)

// Constructeur
function PDF($orientation='P',$unit='mm',$format='A4')
{
	global $_config;

	//Appel au constructeur parent
    $this->FPDF($orientation,$unit,$format);

	// Num�rotation des pages
	$this->AliasNbPages();

	// Ajout des polices
	$this->AddFont('Lucida Calligraphy','','lucidacalligraphy.php');

	// Variables du document
	$this->SetSubject($_config["pdf"]["titre"]); //sujet
	$this->SetTitle($_config["pdf"]["titre"]); // titre
	$this->SetCreator("ANNUAIRE Copyright (c) 2006-".date("Y")." Guillaume Florimond (gflorimond@gmail.com)");
	$this->SetAuthor($_config["pdf"]["nom"]); // auteur (=> l'organisme qui �met l'annuaire)
	$this->SetKeywords("Annuaire version papier"); // mots-cl�s

	// Initialisation des variables
	$this->colonnes = false;
	$this->titre = false;
}

/* En-t�te de chaque page */
function Header()
{
	global $_config;

	$img = "../themes/".obtenir_theme()."/pdf_logo.png";
	$this->Image($img, 5, 0);

	$this->SetFont('Lucida Calligraphy','',20);
	$this->Cell(0, 8, $_config["pdf"]["titre"], 0, 2, "C", 0, $_config["pdf"]["url2"]);
	$this->SetFont('Lucida Calligraphy','',12);
	$this->Cell(0, 8, $_config["pdf"]["nom"], 0, 2, "C", 0, $_config["pdf"]["url1"]);

    $this->Ln(20);
	$this->Line(0, 32, 240, 32);
}

/* Pied de page de chaque page */
function Footer()
{
	global $_config;

	// Hack bug fix: mode 1 colonne pour emp�cher que le texte se d�cale sur la droite
	$this->SetCol(0);

    //Positionnement � 1,5 cm du bas
    $this->SetY(-15);
    $this->SetFont('Times','', 12);

	//Num�ro de page
    $this->Cell(0, 5 ,$this->PageNo()." / {nb}", 0 ,0 ,"C");
	$this->ln(5);

	//Mentions de copyright
	//$this->SetFont('Times','', 9);
	//$this->SetTextColor(128);
	//$this->Cell(0, 5, $_config["pdf"]["copyright"], 0, 0, "C");
}

/* Page de garde du PDF */
function PageDeGarde()
{
	global $_config, $numf; //numf est le nombre de fiches

	// Ajouter la premi�re page
	$this->AddPage();

	// Logo n�1 Annuaire
	$img = "../themes/".obtenir_theme()."/pdf_logo1.jpg";
	$this->Image($img, 0, 40);

	// Masquer l'en-t�te et le pieds de page en les recouvrant d'un bloc blanc
	$this->SetFillColor(255,255,255);
	$this->Rect(0,0,240,33,"F");
	$this->Rect(0,282,240,15,"F");

	// Positionnement du curseur en milieu de page
	$this->SetY(130);

	// Texte
	$this->SetFontSize(22);
	$this->Cell(0, 5, $_config["pdf"]["titre"], 0, 0, "C");
	$this->ln(20);
	$this->SetFontSize(16);
	$this->Cell(0, 5, $_config["pdf"]["url2"], 0, 0, "C", 0, $_config["pdf"]["url2"]);

	// Nombre de fiches
	if(isset($numf))
	{
		$this->SetFontSize(14);
		$this->ln(30);
		$this->Cell(0, 7, "Imprim� le ".convertir_date(date("Y-m-d")) , 0, 2, "C");
		$this->Cell(0, 7, "L'annuaire contient actuellement ".$numf." fiches" , 0, 0, "C");
	}

	// Logo n�2
	$img = "../themes/".obtenir_theme()."/pdf_logo2.jpg";
	$this->Image($img, 42, 220);
}

/* Derni�re page */
function DernierePage()
{
	global $_config;

	// Ajouter la page
	$this->AddPage();

	// Une seule colonne
	$this->SetCol(0);

	// Se mettre au tiers de la page
	$this->SetY(90);

	// Le nom
	$this->SetFontSize(22);
	$this->Cell(0, 5, $_config["pdf"]["nom"], 0, 0, "C");
	$this->ln(10);
	$this->SetFontSize(16);
	$this->Cell(0, 5, $_config["pdf"]["url1"], 0, 0, "C", 0, $_config["pdf"]["url1"]);
	$this->ln(20);

	// Le titre
	$this->SetFontSize(22);
	$this->Cell(0, 5, $_config["pdf"]["titre"], 0, 0, "C");
	$this->ln(10);
	$this->SetFontSize(16);
	$this->Cell(0, 5, $_config["pdf"]["url2"], 0, 0, "C", 0, $_config["pdf"]["url2"]);
	$this->ln(20);

	// Le copyright de l'annuaire
	$this->SetFontSize(14);
	$this->Cell(0, 5, "Annuaire: Logiciel sous licence Creative Commons Paternit�-ShareAlike France", 0, 0, "C");
	$this->ln(10);
	$this->Cell(0, 5, "2006-".date("Y")." Guillaume Florimond", 0, 2, "C");
	$this->SetFontSize(12);
	$this->Cell(0, 5, "gflorimond@gmail.com", 0, 0, "C", 0, "mailto:gflorimond@gmail.com");

}

/* Produit la liste des fiches de l'annuaire, class�es par NOM ordre alphab�tique*/
function liste_nom($data)
{
	// Ajouter une page
	$this->AddPage();

	// Premi�re page de la liste: on affiche le titre
	$this->titre = true;

	// Titre
	$this->SetY(40);
	$this->SetFont('Times','B',14);
	$this->Cell(0, 7, "ANNEXE 2" , 0, 2, "C");
	$this->Cell(0, 7, "Liste des �tudiants par ordre alphab�tique" , 0, 2, "C");
	$this->setY(60);

	// Imprimer les lignes
	// $cle est la lettre et $valeur la liste des noms qui commencent par cette lettre
	foreach($data as $cle=>$valeur)
	{
		if(is_array($valeur))
		{
			// Ceci est une promotion

			$this->SetFont('Times','B',14);
			$this->Cell(0, 7, $cle , 0, 2, "L");

			foreach($valeur as $key=>$val)
			{
				// Ceci est un �tudiant
				$this->SetFont('Times','',10);
				$this->MultiCell(60, 5, $val);
			}
			$this->ln(); // saut de ligne
		}
	}
}

/* Produit la liste des fiches de l'annuaire, class�es par PROMOTION ordre chronologique*/
function liste_promo($data)
{
	/* $data est un tableau � double dim qui contient toutes les promos et tous les noms
	des �tudiants: $data["2006"][1] = "Guillaume Florimond"...*/

	// Ajouter une page
	$this->AddPage();

	// Premi�re page de la liste: on affiche le titre
	$this->titre = true;

	// Titre
	$this->SetY(40);
	$this->SetFont('Times','B',14);
	$this->Cell(0, 7, "ANNEXE 1" , 0, 2, "C");
	$this->Cell(0, 7, "Liste des �tudiants par promotion" , 0, 2, "C");
	$this->setY(60);

	foreach($data as $cle=>$valeur)
	{
		if(is_array($valeur))
		{
			// Ceci est une promotion

			$this->SetFont('Times','B',14);
			$this->Cell(0, 7, "Promotion ".$cle , 0, 2, "L");

			foreach($valeur as $key=>$val)
			{
				// Ceci est un �tudiant
				$this->SetFont('Times','',10);
				$this->MultiCell(60, 5, $val);
			}
			$this->ln(); // saut de ligne
		}
	}
}

/* Fonction appel�e � chaque changement de page */
function AcceptPageBreak()
{
	// Mettre la variable $colonnes � TRUE pour r�partir le texte sur 3 colonnes.
	if($this->colonnes)
		return $this->PageBreak();
	else
		return $this->AutoPageBreak;
}

/* Pour placer les annexes sur 3 colonnes */
function SetCol($col)
{
    //Positionnement sur une colonne
    $this->col=$col;
    $x=10+$col*65;
    $this->SetLeftMargin($x);
    $this->SetX($x);
}

/* Pour placer les annexes sur 3 colonnes lorsque c'est n�cessaire */
function PageBreak()
{
    //M�thode autorisant ou non le saut de page automatique
    if($this->col<2)
    {
        //Passage � la colonne suivante
        $this->SetCol($this->col+1);

		//Ordonn�e en haut
        if($this->titre) // s'il y a un titre � afficher...
			// 6cm du haut pour les 2 derni�res colonnes de la premi�re page
			$this->SetY(60);
		else // s'il n'y a pas de titre � afficher
			// 4cm du haut pour toutes les colonnes de toutes les pages saut la premi�re
			$this->SetY(40);

        //On reste sur la page
        return false;
    }
    else
    {
        //Retour en premi�re colonne
        $this->SetCol(0);

		// on a eu un saut de page, donc le titre a d�j� �t� imprim�
		$this->titre = false;

        //Saut de page
        return true;
    }
}

function inserer_photo($data) {
    // TODO
}

/* Ajoute une page au PDF avec les infos pass�es en argument*/
function ajouter_page($data)
{
	// Nettoyer les donn�es
	foreach($data as $key=>$value)
		$data[$key] = html_vers_texte(stripslashes($value));

	// Ajouter une page
	$this->AddPage();

	// Bloc 1: nom et pr�nom
	$this->SetFont('Times','B',24);
	$this->Cell(0,7, formater_nom($data['prenom'])." ".formater_nom($data["nom"]), 0, 0);

    // Bloc PHOTO
    $this->SetFont('Times','B',14);
    $this->Cell(0,7, "ET ICI, LE TEXTE AHAHAHAHAHAHAHA".$data[''], 0, 2, "R");
    $this->ln();

	// Bloc 2: promotion
	$this->SetFont('Times','B',14);
	$this->Cell(0,7, donner("c3")." ".$data["promotion"], 0, 2, "R");
	$this->ln();

	// Bloc 3: date et lieu de naissance
	$this->SetFont('Times','',14);
	$this->MultiCell(0,7, donner("ne-vp")." ".$data["nationalite"]." ".
						 donner("ne-le")." ".convertir_date($data["naissance"]));

	// Bloc 4: adresse postale
	$this->SetFont('Times','',14);
	$this->MultiCell(0,7, $data["adresse"]);

	// Bloc 5: adresse e-mail
	$this->SetFont('Times','',14);
	//$this->MultiCell(0,7, $data["email"]);
	$this->Write(7, $data["email"], "mailto:".$data["email"]);
	$this->ln();

	// Bloc 6: Saut de ligne
	$this->ln();

	// Bloc 7: Question 1
	if($data["q1"] != "")
	{
	$this->SetFont('Times','U',12);
	$this->MultiCell(0,5, donner("r1"));
	$this->SetFont('Times','',12);
	$this->MultiCell(0,5, $data["q1"]);
	$this->ln();
	}

	// Bloc 8: Question 2
	if($data["q2"] != "")
	{
	$this->SetFont('Times','U',12);
	$this->MultiCell(0,5, donner("r2"));
	$this->SetFont('Times','',12);
	$this->MultiCell(0,5, $data["q2"]);
	$this->ln();
	}

	// Bloc 9: Question 3
	if($data["q3"] != "")
	{
	$this->SetFont('Times','U',12);
	$this->MultiCell(0,5, donner("r3"));
	$this->SetFont('Times','',12);
	$this->MultiCell(0,5, $data["q3"]);
	$this->ln();
	}

	// Bloc 10: Question 4
	if($data["q4"] != "")
	{
	$this->SetFont('Times','U',12);
	$this->MultiCell(0,5, donner("r4"));
	$this->SetFont('Times','',12);
	$this->MultiCell(0,5, $data["q4"]);
	$this->ln();
	}

	// Bloc 11: Question 5
	if($data["q5"] != "")
	{
	$this->SetFont('Times','U',12);
	$this->MultiCell(0,5, donner("r5"));
	$this->SetFont('Times','',12);
	$this->MultiCell(0,5, $data["q5"]);
	$this->ln();
	}

	// Bloc 12: Question 6
	if($data["q6"] != "")
	{
	$this->SetFont('Times','U',12);
	$this->MultiCell(0,5, donner("r6"));
	$this->SetFont('Times','',12);
	$this->MultiCell(0,5, $data["q6"]);
	$this->ln();
	}

	// Bloc 13: Question 7
	if($data["q7"] != "")
	{
	$this->SetFont('Times','U',12);
	$this->MultiCell(0,5, donner("r7"));
	$this->SetFont('Times','',12);
	$this->MultiCell(0,5, $data["q7"]);
	$this->ln();
	}
}

}
?>