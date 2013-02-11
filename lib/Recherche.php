<?php

class Recherche
{

// Variables de classe
var $tab; // stocke les r�sultats avant affichage
var $num = 0; // stocke le nombre de r�sultats retourn�s par la recherche
var $rq; // stocke la requ�te
var $type; // le type de recherche: DEFAULT ; REGEX ; FULLTEXT

// Mots-cl�s g�n�riques qui doivent �tre exclus de la recherche

var $gen = array(
	// Fran�ais
	"le", "la", "les", "de", "du", "des", "un", "une", "et", "a",
	// Espagnol
	"el", "los", "lo", "del", "uno", "una", "y", "en", "para", "por", "no", "o",
	// Anglais
	"the", "and", "or"
);



/*
****** CONSTRUCTEUR *****
Nom: Recherche
But: constructeur de la classe Recherche. Effectue les traitements pr�liminaires sur les donn�es transmises par le formulaire, et effectue la recherche.
Info: Guillaume Florimond, 07/04/2007
Arguments:
 $rq est la requ�te (le contenu du champ de recherche)
 $ch est la valeur du champ modificateur (combobox)
*/
function Recherche($rq = null, $ch = null)
{
	// Si $rq n'a pas �t� initialis�e, c'est qu'on n'utilisera qu'une m�thode statique
	// donc: pas besoin de continuer le traitement ici
	if(!isset($rq) or !isset($ch) or $rq == "") return;

	// Enregistrement de la requ�te dans la session
	$_SESSION["searchquery-rq"] = $rq; // la requ�te
	$_SESSION["searchquery-ch"] = $ch; // le champ de d�limitation

	/* Protection des requ�tes SQL: l'espace �tant un op�rateur ET, il faut enlever les espaces au d�but et � la fin de la requ�te ; de plus, c'est important car l'analyse de la formation de la requ�te s'op�re en pr�levant des caract�res sp�ciaux � des endroits pr�cis (p. ex. le premier et le dernier caract�res doivent �tre " pour une fulltext search) */
	$rq = trim($rq);

	/* On enl�ve les slash pour ne pas causer de probl�me lors de la v�rification des conditions. On remettra plus tard les slash pour prot�ger la requ�te SQL. */
	$rq = stripslashes($rq);

	// 1er cas: c'est une expression r�guli�re
	if(strcasecmp(substr($rq, 0, 6) , "regex=") == 0)
	{
		$this->type = "REGEX";

		// Note: la condition ci-dessus a 2 particularit�s:
		// 1) la comparaison est insensible � la casse
		// 2) la m�thode strcasecmp retourne 0 si les deux cha�nes compar�es sont �gales...

		// Extraire l'expression r�guli�re
		// Ne pas utiliser la fonction explode car elle est sensible � la casse...
		$regex =  substr($rq, 6);
		// Protection des requ�tes SQL: on prot�ge les ' par des \
		$regex = addslashes($regex);
		/* Construction de la requ�te et ex�cution */
		$this->rq = $regex;
		$this->executer_requete($this->construire_requete( $regex , $ch , true , false ));
	}

	// 2�me cas: c'est une recherche fulltext
	elseif(substr($rq, 0, 1) == '(' and substr($rq, -1, 1) == ')')
	{
		$this->type = "FULLTEXT";

		// Note: substr pr�l�ve une partie de la cha�ne $rq
		// 0,1 signifie 1 caract�re depuis la position 0 (le premier caract�re)
		// -1,1 signifie 1 caract�re depuis la position -1 (le derni�re caract�re)

		// Extraire le motif (ce qui se trouve entre les guillemets)
		$rqa = substr($rq, 1, -1);
		// Protection des requ�tes SQL: on prot�ge les ' par des \
		$rqa = addslashes($rqa);
		/* Construction de la requ�te et ex�cution */
		$this->rq = $rqa;
		$this->executer_requete( $this->construire_requete ( $rqa , $ch , false, true ) );
	}

	// 3�me cas: ce n'est PAS une expression r�guli�re NI une recherche fulltext
	else
	{
		$this->type = "DEFAULT";

		// Nettoyage: on enl�ve tous les mots-cl�s g�n�riques
		$rq = $this->nettoyer_requete($rq);
		// Protection des requ�tes SQL: on prot�ge les ' par des \
		$rq = addslashes($rq);
		// On r�cup�re les mots s�par�s: il y a autant d'espaces que de requ�tes
		$rqa = explode(" ", $rq);
		// Combien de mots dans ce tableau ?
		$nbr = count($rqa);
		// Recherche intelligente: on cr�e autant de requ�tes SQL qu'il y a de mots
		for ( $i = 0 ; $i < $nbr ; $i++ )
		{
			/* Construction de la requ�te et ex�cution */
			$this->rq[$i] = $rqa[$i];
			$this->executer_requete($this->construire_requete($rqa[$i],$ch,false,false));
		}
		// Traitement des r�sultats
		$this->definir_pertinence();
	}

}

/*
*******************************************************************************************
*/

/*
Nom: afficher_requete
But: Renvoie la requ�te pour �tre affich�e "proprement" (la transtype en string si elle est de type array)
Info: Guillaume Florimond, 07/04/2007
*/
function afficher_requete($req)
{
	$str = "";

	if(is_array($req))
		foreach($req as $key=>$val)
			$str .= $val." ";
	else
		$str = $req;

	$str = trim($str);

	return $str;
	//return $_SESSION["searchquery-rq"]; // DEBUG
}

/*
Nom: nettoyer_requete
But: Elimine les mots-cl�s g�n�riques de la cha�ne pass�e en argument, tels que d�finis dans la variable de classe $gen.
Info: Guillaume Florimond, 07/04/2007
*/
function nettoyer_requete($req)
{
		/* La fonction remplace � l'int�rieur des mots. Pour �viter d'enlever des lettres aux mots recherch�s, il faut que ce qu'on enl�ve soient des mots complets, c'est-�-dire des cha�nes entourn�es d'espaces... Le tableau $gen n'admettant pas d'espace de part et d'autre de ses composantes, pour des raisons de lisibilit�, il convient d'en ajouter ici */
	for($i = 0 ; $i < count($this->gen) ; $i++ )
		$mots[$i] = " ".$this->gen[$i]." ";

	/* On ajoute un espace AVANT et APRES le mot � �liminer. Bien. Mais si ce mot est en d�but de cha�ne, il n'aura pas d'espace avant lui. S'il est en fin de cha�ne, il n'aura pas d'espace apr�s lui. Il ne sera donc pas �limin�. Il faut donc ajouter ici un espace en d�but de cha�ne et un espace en fin de cha�ne, pour que l'analyse soit correcte. Il faudra par la suite retirer ces espaces � l'aide de la fonction trim() */
	$req = " ".$req." ";

	/* Cette fonction remplace les occurences des mots d�finis dans $mots rencontr�s dans $req par des cha�nes vides
	NB 1: str_replace est sensible � la casse, str_ireplace ne l'est pas
	NB 2: la fonction se charge de parcourir le tableau $mots toute seule
	NB 3: il faut remplacer PAR un espace, sinon les mots seront coll�s les uns autre autres
	*/
	// PHP 4
	if (!function_exists('str_ireplace'))
	    include "lib/php5functions/str_ireplace.php";

	$req = str_ireplace($mots, " ", $req);



	/* La fonction ci-dessus remplace le mot cl� par un caract�re vide. Mais comme ce mot �tait s�par� d'un espace de chaque c�t�, on se retrouve avec 2 espaces � la suite. Cela d�clenche la fonction explode utilis�e pour s�parer les mots dans la requ�te, et cela g�n�re une erreur car un espace n'est pas un motif de recherche valable... Il faut donc absolument r�parer ce dommage et remplacer les espaces doubles par des espaces simples */

	//$req = str_ireplace("  ", " ", $req); // DEPRECATED
	$req = preg_replace('/\s\s+/', ' ', $req);

	// Retirer l'espace simple en d�but et fin de cha�ne qui a �t� ajout� plus haut
	$req = trim($req);

	// retour
	return $req;
}

/*
Nom: definir_pertinence
But: Calcule la pertinence de chacun des r�sultats de la recherche. Modifie le conteneur des r�sultats, $this->tab, pour y ajouter l'indice de pertinence de chaque r�sultat: $this->pertinence[X]["pertinence"]
Info: Guillaume Florimond, 07/04/2007
*/
function definir_pertinence()
{
	// Retour s'il n'y a pas de r�sultat
	if($this->num == 0) return;

	// Initialisation des variables
	$note = 0; // La note du r�sultat (sa pertinence, sur une �chelle de 0 � 10)
	$p = 0;// Variable de comptage
	$ct = 0; // Variable de comptage
	$rq = $this->rq; // Variable stockant la requ�te (tableau ou non)
	$rs = $this->tab; // Variable stockant les r�sultats de la recherche

	// V�rifier qu'en fait d'une requ�te simple ce soit une agr�gation ou une comparaison
	$regexa = "`^([[:digit:]]{2,4})<([[:digit:]]{2,4})$`"; // a < b
	$regexb = "`^([[:digit:]]{2,4})>([[:digit:]]{2,4})$`"; // a > b
	$regexc = "`^(.+)&&(.+)$`"; // a&&b
	if(is_array($rq)
		and count($rq) == 1
		and (preg_match($regexa,$rq[0],$tabx)
				or preg_match($regexb,$rq[0],$tabx)
				or preg_match($regexc,$rq[0],$tabx)) )
	{
		$rq[0] = $tabx[1];
		$rq[1] = $tabx[2];
	}

	// 1. CALCULER LA PERTINENCE INDIVIDUELLE DE CHAQUE FICHE

	// A. Si $rq est un tableau (si la requ�te contient plusieurs mots-cl�s)
	if(is_array($rq) and count($rq) > 1)
	{
		// Parcourir les r�sultats
		for($i = 0; $i < count($rs) ; $i++)
		{
			// Parcourir les mots-cl�s (les mots qui composent la requ�te)
			foreach( $rq as $key=>$val ) /* val contient les mots-cl�s */
			{
				// Parcourir les champs de chaque r�sultat
				foreach($rs[$i] as $k=>$v)
				{
					/* substr_count(A,B) compte le nombre d'occurrences de B dans A*/
					/*si ce qu'on cherche est + petit ou = � que ce dans quoi on cherche!!*/
					if(strlen($v) >= strlen($val))
						$ct = substr_count( $v , $val );

					$p = $p + $ct; // $p contient le nombre d'occurences
					$ct = 0; // on r�initialise le compteur
				}
				$note = $note + $p; // note = somme des notes (p) pour chaque champ
				$p = 0; // on r�initialise le compteur
				$rs[$i]["pertinence"] = $note; // on enregistre la note
			}
			$note = 0; // on r�initialise le compteur
		}
	}

	// B. Si $rq n'est pas un tableau (si la requ�te ne contient qu'une expression)
	else
	{
		// Parcourir les r�sultats
		for($i = 0; $i < count($rs) ; $i++)
		{
			$val = $rq[0];
			// Parcourir les champs de chaque r�sultat
			foreach($rs[$i] as $k=>$v)
			{
				/* substr_count(A,B) compte le nombre d'occurrences de B dans A*/
				/*si ce qu'on cherche est + petit ou = � que ce dans quoi on cherche!!*/
				if(strlen($v) >= strlen($val))
					$ct = substr_count( $v , $val );

				$p = $p + $ct; // $p contient le nombre d'occurences
				$ct = 0; // on r�initialise le compteur
			}
			$note = $p;
			$p = 0; // on r�initialise le compteur
			$rs[$i]["pertinence"] = $note; // on enregistre la note
		}
	}

	// 2. CALCULER LE POURCENTAGE DE PERTINENCE DE CHAQUE FICHE
	$rs = $this->normaliser_pertinence($rs);

	// 3. TRI DU TABLEAU PAR PERTINENCE D�CROISSANTE
	foreach($rs as $key=>$val)
		$tri[$key] = $val["pertinence"];
	array_multisort($tri, SORT_DESC, $rs);

	// 4. FINITION: retour le nouveau tableau avec toutes les notes de pertinence en plus
	$this->tab = $rs;
}

/*
Nom: normaliser_pertinence
But: Calcule le pourcentage de pertinence de chaque r�sultat en fonction de la petinence des autres r�sultats (le plus pertinence est l'indice: 100%).
Info: Guillaume Florimond, 07/04/2007
*/
function normaliser_pertinence($rs)
{
	// Retour s'il n'y a pas de r�sultat
	if($this->num == 0) return;

	// Calculer la plus haute valeur de pertinence
	$max = 0;
	for($i = 0; $i < count($rs); $i++)
		if($rs[$i]["pertinence"] > $max)
			$max = $rs[$i]["pertinence"];

	// Pour emp�cher une future division par 0...
	if($max == 0) $max = 1;

	// Calculer le pourcentage de chaque pertinence ($max = 100%)
	for($i = 0; $i < count($rs); $i++)
		$rs[$i]["pertinence"] = round(($rs[$i]["pertinence"] / $max) * 100);

	return $rs;
}

/*
Nom: executer_requete
But: Ex�cute la requ�te SQL pass�e en argument et appelle la fonction ajouter_ligne pour chaque r�sultat.
Info: Guillaume Florimond, 07/04/2007
*/
function executer_requete($sql)
{
	/* Ex�cution de la requ�te */
	connexion();
	$req = mysql_query($sql) or die("Erreur ".$sql);

	/* Calcul du nombre de r�sultats (remplissage de $this->num) -- Avec ce syst�me de recherche, chaque motif de recherche s�par� d'un espace donne lieu � sa propre requ�te. On doit donc INCREMENTER le compteur et non pas remplacer le compteur existant par une nouvelle valeur (d'o� += au lieu de =), sinon seul le nombre de r�sultats de la derni�re recherche sera affich�. */
	$this->num += mysql_num_rows($req);

	/* Remplissage du tableau ($this->tab) des r�sultats */
	while($data = mysql_fetch_assoc($req))
	{
		$afficher['nom'] = (formater_nom(stripslashes($data['nom'])));
		$afficher['prenom'] = (formater_nom(stripslashes($data['prenom'])));
		$afficher['promotion'] = (stripslashes($data['promotion']));
		$afficher['nationalite'] = (stripslashes($data['nationalite']));
		$afficher['naissance'] = (stripslashes($data['naissance']));
		$afficher['adresse'] = (stripslashes($data['adresse']));
		$afficher['email'] = (stripslashes($data['email']));

		$afficher['q1'] = (stripslashes($data['q1']));
		$afficher['q2'] = (stripslashes($data['q2']));
		$afficher['q3'] = (stripslashes($data['q3']));
		$afficher['q4'] = (stripslashes($data['q4']));
		$afficher['q5'] = (stripslashes($data['q5']));
		$afficher['q6'] = (stripslashes($data['q6']));
		$afficher['q7'] = (stripslashes($data['q7']));

		$afficher['fiche'] = "index.php?action=page_voir&prov=search&id=".$data['id'];

		// Dans le cas d'une fulltext search
		if(isset($data["pertinence"])) $afficher["pertinence"] = $data["pertinence"];

		// Appelle la fonction qui ajoute une ligne qui correspond � un r�sultat.
		$this->ajouter_ligne($afficher);
	}
}

/*
Nom: ajouter_ligne
But: Ajoute une ligne dans le tableau qui stocke les r�sultats, $this->tab. Fonction appel�e par la fonction executer_requete pour chaque r�sultat de recherche.
Info: Guillaume Florimond, 07/04/2007
*/
function ajouter_ligne($data)
{
	// On se place � la prochaine ligne
	$i = count($this->tab); // pas de + 1 car tab est initialis� � 0, il a 1 �lt de retard

	// On ajoute les donn�es dans $tab
	$this->tab[$i]["nom"] = $data["nom"];
	$this->tab[$i]["prenom"] = $data["prenom"];
	$this->tab[$i]["promotion"] = $data["promotion"];
	$this->tab[$i]["nationalite"] = $data["nationalite"];
	$this->tab[$i]["naissance"] = $data["naissance"];
	$this->tab[$i]["adresse"] = $data["adresse"];
	$this->tab[$i]["email"] = $data["email"];

	$this->tab[$i]["q1"] = $data["q1"];
	$this->tab[$i]["q2"] = $data["q2"];
	$this->tab[$i]["q3"] = $data["q3"];
	$this->tab[$i]["q4"] = $data["q4"];
	$this->tab[$i]["q5"] = $data["q5"];
	$this->tab[$i]["q6"] = $data["q6"];
	$this->tab[$i]["q7"] = $data["q7"];

	$this->tab[$i]["fiche"] = $data["fiche"];

	// Dans le cas d'une fulltext search
	if(isset($data["pertinence"])) $this->tab[$i]["pertinence"] = $data["pertinence"];
}

/*
Nom: afficher_resultats
But: Affiche les r�sultats de la recherche � l'�cran. Cette fonction affiche le contenu de la variable de classe $this->tab qui contient les r�sultats.
Info: Guillaume Florimond, 07/04/2007
Argument $ttype:
 DEFAULT => recherche intelligente, focalis�e ou diffuse
 REGEX => expression r�guli�re
 FULLTEXT => full text search
La d�finition de cet argument permet de d�terminer quand afficher la pertinence des r�sultats. La pertinence n'est affich�e que s'il est DEFAULT.
*/
function afficher_resultats($ttype = null)
{
	if(isset($this->type)) $ttype = $this->type;

	// D�claration du tableau
	$ligne = '<table width="80%" align="center" cellpadding="4" cellspacing="0" border="0" class="orange">';

	// Nombre de r�sultats
	$ligne .= '<tr class="orange">';
		$ligne .= '<td colspan="2"><b>';
		// Afficher le nombre ou afficher "Aucun" (si 0 r�sultat) ?
		if ($this->num == 0) $ligne .= donner("rech_resultat_aucun").' ';
		else $ligne .= $this->num.' ';
		// Mot "r�sultat" au singulier ou au pluriel ?
		if($this->num < 2 != 0) $ligne .= donner("rech_resultat_singulier");
		else $ligne .= donner("rech_resultat_pluriel");
	$ligne .= '</b></td>';
	$ligne .= '<td colspan="3"><b>'.donner("rech_requete").'</b> ';
	$ligne .= '( <u>'.$ttype.'</u> )';
	$ligne .= ' &gt; <i>'.$this->afficher_requete($this->rq).'</i></td>';
	$ligne .= "</tr>";

	// En-t�te du tableau
	$ligne .= '<tr class="orange">';
	  $ligne .= '<td style="border-top: 1px solid #FF8000;">'.donner("c1").'</td>';
	  $ligne .= '<td style="border-top: 1px solid #FF8000;">'.donner("c2").'</td>';
	  $ligne .= '<td style="border-top: 1px solid #FF8000;">'.donner("c3").'</td>';
	  $ligne .= '<td style="border-top: 1px solid #FF8000;">'.donner("c7").'</td>';
	if($ttype == "DEFAULT" or $ttype == "FULLTEXT")
	  $ligne .= '<td style="border-top: 1px solid #FF8000;">'.donner("pertinence").'</td>';
	$ligne .= '</tr>';
	echo $ligne;

	/* Avant d'afficher les r�sultats, on doit normaliser la pertinence s'il s'agit d'une fulltext search. La raison est la suivante: l'indice de pertinence des fulltext search est calcul� directement par MySQL. Il n'est pas calcul� par la fonction definir_pertinence comme l'indice de pertinence "classique" pour les recherches normales. Or, MySQL n'utilise pas un indice 100 comme cette classe. Il en r�sulte une distortion de l'indice de pertinence qu'il faut corriger. C'est pourquoi on appelle ici la fonction normaliser_pertinence sur les r�sultats de recherche s'il s'agit d'une fulltext search */
	if($ttype == "FULLTEXT")
		$this->tab = $this->normaliser_pertinence($this->tab);

	// Remplissage: $lignes = 1 r�sultat de recherche par ligne
	for($i = 0; $i < count($this->tab) ; $i++)
	{
		// Calcul de la pertinence
		if(isset($this->tab[$i]["pertinence"]))
		{
		$nbsp = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		$pertinence = "<td><div class=\"pertinence\" ";
		$pertinence .= "style=\"width:".$this->tab[$i]["pertinence"]."px;\">";
		$pertinence .= abbr3($nbsp, donner("pertinence").": ".$this->tab[$i]["pertinence"]."%");
		$pertinence .="</div></td>";
		}

		$lignes[$i] = "<tr class=\"transparent\" style=\"cursor:pointer\"
			onClick=\"javascript:js_direct('".$this->tab[$i]["fiche"]."');\"
			onMouseOver=\"javascript:change_couleur(this, couleur_hover);\"
			onMouseOut=\"javascript:restaure_couleur(this, couleur_origine);\">
		    	<td>".abbr3($this->tab[$i]["nom"], donner("afficher_details"))."</td>
		    	<td>".abbr3($this->tab[$i]["prenom"], donner("afficher_details"))."</td>
		    	<td>".abbr3($this->tab[$i]["promotion"], donner("afficher_details"))."</td>
		    	<td>".abbr3($this->tab[$i]["email"], donner("afficher_details"))."</td>";

		if(isset($this->tab[$i]["pertinence"])
			and ($ttype == "DEFAULT" or $ttype == "FULLTEXT") )
			$lignes[$i] .= $pertinence;
		else
			$lignes[$i] .= "<td>&nbsp;</td>";

		$lignes[$i] .= "</tr>\n";
	}

	// D�doublonnage (uniquement s'il y a plusieurs lignes...)
	if(isset($lignes) and count($lignes) > 1)
		$lignes = array_unique($lignes);

	// Affichage final	(uniquement s'il y a des r�sultats, c�d si $lignes existe...)
	if(isset($lignes))
		foreach($lignes as $key=>$val)
			echo $val;

	echo "</table>";
}

/*
Nom: construire_requete
But: Cette fonction construit la requ�te SQL de recherche en fonction des arguments qui lui sont transmis.
Info: Guillaume Florimond, 07/04/2007
Arguments:
 $rq => la cha�ne ou l'expression r�guli�re � rechercher
 $rc => le d�limiteur du champ de recherche ($_POST["champ"])
 $regex => TRUE s'il s'agit d'une expression r�guli�re, FALSE dans le cas contraire
 $fulltext => TRUE si on fait une recherche fulltext, FALSE dans le cas contraire
*/
function construire_requete($rq, $rc, $regex, $fulltext)
{
	$recherche["requete"] = $rq;
	$recherche["champ"] = $rc;

	/* Construction de la racine de la requ�te SQL */
	/* Ne pas faire de (SELECT * FROM...) pour �viter que les champs contenant la question personnelle et la r�ponse secr�te soient export�s. */
	$sql = "SELECT id, nom, prenom, promotion, email, naissance, adresse, nationalite, q1, q2, q3, q4, q5, q6, q7 FROM utilisateur WHERE ";

/* RECHERCHE FOCALISEE
*/
	if(isset($recherche["champ"])
		and $recherche["champ"] != "tous"
		and $recherche["champ"] != "defaut")
	{
		$sql .= $recherche["champ"];

		// Si c'est une expression r�guli�re
		if($regex)
			$sql .= " REGEXP '".$recherche["requete"]."';";
		// Si c'est une fulltext search
		elseif($fulltext)
			// la recherche fulltext ne fonctionne pas dans les colonnes DATE
			$sql = "SELECT id, nom, prenom, promotion, email FROM utilisateur WHERE  MATCH(q1,q2,q3,q4,q5,q6,q7) AGAINST ('".$recherche["requete"]."');";
		// Si ce n'est pas une expression r�guli�re ni une fulltext search
		else
			$sql .= "= '".$recherche["requete"]."';";
	}
/* RECHERCHE DIFFUSE
*/
	elseif(isset($recherche["champ"])
			and $recherche["champ"] == "tous"
			and $recherche["champ"] != "defaut")
	{
		// Si c'est une expression r�guli�re
		if($regex)
		{
			$sql .= "nom REGEXP '".$recherche["requete"]."' OR ";
			$sql .= "prenom REGEXP '".$recherche["requete"]."' OR ";
			$sql .= "promotion REGEXP '".$recherche["requete"]."' OR ";
			$sql .= "naissance REGEXP '".$recherche["requete"]."' OR ";
			$sql .= "nationalite REGEXP '".$recherche["requete"]."' OR ";
			$sql .= "adresse REGEXP '".$recherche["requete"]."' OR ";
			$sql .= "email REGEXP '".$recherche["requete"]."' OR ";
			$sql .= "q1 REGEXP '".$recherche["requete"]."' OR ";
			$sql .= "q2 REGEXP '".$recherche["requete"]."' OR ";
			$sql .= "q3 REGEXP '".$recherche["requete"]."' OR ";
			$sql .= "q4 REGEXP '".$recherche["requete"]."' OR ";
			$sql .= "q5 REGEXP '".$recherche["requete"]."' OR ";
			$sql .= "q6 REGEXP '".$recherche["requete"]."' OR ";
			$sql .= "q7 REGEXP '".$recherche["requete"]."';";
		}
		// Si c'est une fulltext search
		elseif($fulltext)
		{
			/* Ancienne forme: avant pertinence: DEPRECATED
			$sql = "SELECT id, nom, prenom, promotion, email  FROM utilisateur WHERE  MATCH(q1,q2,q3,q4,q5,q6,q7) AGAINST ('".$recherche["requete"]."');";
			*/

			$sql = "SELECT id, nom, prenom, promotion, email, naissance, adresse, nationalite, q1, q2, q3, q4, q5, q6, q7, MATCH (q1,q2,q3,q4,q5,q6,q7) AGAINST ('".$recherche["requete"]."') AS pertinence FROM utilisateur WHERE MATCH (q1,q2,q3,q4,q5,q6,q7) AGAINST ('".$recherche["requete"]."');";
		}
		// Si ce n'est pas une expression r�guli�re ni une fulltext search
		else
		{
			$sql .= "nom LIKE '%".$recherche["requete"]."%' OR ";
			$sql .= "prenom LIKE '%".$recherche["requete"]."%' OR ";
			$sql .= "promotion LIKE '%".$recherche["requete"]."%' OR ";
			$sql .= "naissance LIKE '%".$recherche["requete"]."%' OR ";
			$sql .= "nationalite LIKE '%".$recherche["requete"]."%' OR ";
			$sql .= "adresse LIKE '%".$recherche["requete"]."%' OR ";
			$sql .= "email LIKE '%".$recherche["requete"]."%' OR ";
			$sql .= "q1 LIKE '%".$recherche["requete"]."%' OR ";
			$sql .= "q2 LIKE '%".$recherche["requete"]."%' OR ";
			$sql .= "q3 LIKE '%".$recherche["requete"]."%' OR ";
			$sql .= "q4 LIKE '%".$recherche["requete"]."%' OR ";
			$sql .= "q5 LIKE '%".$recherche["requete"]."%' OR ";
			$sql .= "q6 LIKE '%".$recherche["requete"]."%' OR ";
			$sql .= "q7 LIKE '%".$recherche["requete"]."%';";
		}
	}
/* RECHERCHE INTELLIGENTE
*/
	else
	{

// 1. S'il s'agit d'une expression r�guli�re
		if($regex)
		{
			$sql .= "nom REGEXP '".$recherche["requete"]."' OR ";
			$sql .= "prenom REGEXP '".$recherche["requete"]."' OR ";
			$sql .= "promotion REGEXP '".$recherche["requete"]."' OR ";
			$sql .= "naissance REGEXP '".$recherche["requete"]."' OR ";
			$sql .= "nationalite REGEXP '".$recherche["requete"]."' OR ";
			$sql .= "adresse REGEXP '".$recherche["requete"]."' OR ";
			$sql .= "email REGEXP '".$recherche["requete"]."' OR ";
			$sql .= "q1 REGEXP '".$recherche["requete"]."' OR ";
			$sql .= "q2 REGEXP '".$recherche["requete"]."' OR ";
			$sql .= "q3 REGEXP '".$recherche["requete"]."' OR ";
			$sql .= "q4 REGEXP '".$recherche["requete"]."' OR ";
			$sql .= "q5 REGEXP '".$recherche["requete"]."' OR ";
			$sql .= "q6 REGEXP '".$recherche["requete"]."' OR ";
			$sql .= "q7 REGEXP '".$recherche["requete"]."';";

			// Pour l'exportation
			$_SESSION["exportation_permission"] = true;
			$_SESSION["exportation_requete"] = $sql;
			// Retour
			return $sql;
		}

// 2. S'il s'agit d'une fulltext search
		if($fulltext)
		{
			// Requ�te g�n�rale

			/* Ancienne forme: avant pertinence: DEPRECATED
			$sql = "SELECT id, nom, prenom, promotion, email  FROM utilisateur WHERE  MATCH(q1,q2,q3,q4,q5,q6,q7) AGAINST ('".$recherche["requete"]."');";
			*/

			$sql = "SELECT id, nom, prenom, promotion, email, naissance, adresse, nationalite, q1, q2, q3, q4, q5, q6, q7, MATCH (q1,q2,q3,q4,q5,q6,q7) AGAINST ('".$recherche["requete"]."') AS pertinence FROM utilisateur WHERE MATCH (q1,q2,q3,q4,q5,q6,q7) AGAINST ('".$recherche["requete"]."');";

			// Pour l'exportation
			$_SESSION["exportation_permission"] = true;
			$_SESSION["exportation_requete"] = $sql;
			// Retour
			return $sql;
		}

/* 3. Si ce n'est pas une expression r�guli�re ni une fulltext search, on continue le traitement... */

		/* Combien y a-t-il d'op�rateurs ET ? (&&)
		S'il n'y en a pas, le tableau $rqb aura tout de m�me 1 instance, qui contiendra la cha�ne de recherche enti�re= $rqb[0];*/
		$rqb = explode("&&", $recherche["requete"]);

		/* On ex�cute la boucle de recherche autant de fois qu'il y a de termes dans la boucle ET (p. ex. A&&B&&C&&D = 4 fois ; A = 1 fois). S'il n'y a aucun "ET", il y a tout de m�me 1 terme dans la recherche, et la boucle est ex�cut�e 1 fois (l'op�rateur AND n'est pas ajout� dans ce cas, c'est un ; qui termine l'instruction qui le remplace) */
		for ( $i = 0 ; $i < count($rqb) ; $i++ )
		{
			// D�termine s'il existe un op�rateur de comparaison pour la suite
			// Les r�gex exigent entre 2 et 4 chiffres, < ou >, et entre 2 et 4 chiffres.

			$regexa = "`^([[:digit:]]{2,4})<([[:digit:]]{2,4})$`";
			$regexb = "`^([[:digit:]]{2,4})>([[:digit:]]{2,4})$`";

			// 1. Si l'op�rateur de comparaison est pr�sent, il est exclusif du reste
			if(preg_match($regexa,$rqb[$i]) or preg_match($regexb,$rqb[$i]))
			{
				// Si c'est l'op�rateur < qui est utilis�
				if(preg_match($regexa,$rqb[$i],$taba))
					$sql .= "promotion BETWEEN ".$taba[1]." AND ".$taba[2];
				// Si c'est l'op�rateur > qui est utilis�
				if(preg_match($regexb,$rqb[$i],$tabb))
					$sql .= "promotion BETWEEN ".$tabb[2]." AND ".$tabb[1];
			}

			// 2. Si l'op�rateur de comparaison n'est pas pr�sent, continuer le traitement
			else
			{
				/* Si on recherche une promotion ou une date de naissance... */
				if(is_numeric($rqb[$i]))
				{
					$sql .= "(promotion='".$rqb[$i]."' OR ";
					$sql .= "naissance='".$rqb[$i]."')";
				}
				/* Sinon, c'est qu'on recherche du texte ...*/
				else
				{
					$sql .= "(nom LIKE '%".$rqb[$i]."%' OR ";
					$sql .= "prenom LIKE '%".$rqb[$i]."%' OR ";
					$sql .= "adresse LIKE '%".$rqb[$i]."%' OR ";
					$sql .= "email LIKE '%".$rqb[$i]."%' OR ";
					$sql .= "q1 LIKE '%".$rqb[$i]."%' OR ";
					$sql .= "q2 LIKE '%".$rqb[$i]."%' OR ";
					$sql .= "q3 LIKE '%".$rqb[$i]."%' OR ";
					$sql .= "q4 LIKE '%".$rqb[$i]."%' OR ";
					$sql .= "q5 LIKE '%".$rqb[$i]."%' OR ";
					$sql .= "q6 LIKE '%".$rqb[$i]."%' OR ";
					$sql .= "q7 LIKE '%".$rqb[$i]."%')";
				}
			}

			// On n'ajoute AND que si la boucle va s'ex�cuter encore une fois au moins
			if($i+1 < count($rqb))
				$sql .= " AND ";
			else
				$sql .= ";";
		}
	}
// FIN RECHERCHE INTELLIGENTE

	// Pour l'exportation
	$_SESSION["exportation_permission"] = true;
	$_SESSION["exportation_requete"] = $sql;
	// Retour
	return $sql;
}

} // fin de la classe
?>