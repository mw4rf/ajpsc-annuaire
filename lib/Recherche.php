<?php

class Recherche
{

// Variables de classe
var $tab; // stocke les résultats avant affichage
var $num = 0; // stocke le nombre de résultats retournés par la recherche
var $rq; // stocke la requête
var $type; // le type de recherche: DEFAULT ; REGEX ; FULLTEXT

// Mots-clés génériques qui doivent être exclus de la recherche

var $gen = array(
	// Français
	"le", "la", "les", "de", "du", "des", "un", "une", "et", "a",
	// Espagnol
	"el", "los", "lo", "del", "uno", "una", "y", "en", "para", "por", "no", "o",
	// Anglais
	"the", "and", "or"
);



/*
****** CONSTRUCTEUR *****
Nom: Recherche
But: constructeur de la classe Recherche. Effectue les traitements préliminaires sur les données transmises par le formulaire, et effectue la recherche.
Info: Guillaume Florimond, 07/04/2007
Arguments:
 $rq est la requête (le contenu du champ de recherche)
 $ch est la valeur du champ modificateur (combobox)
*/
function Recherche($rq = null, $ch = null)
{
	// Si $rq n'a pas été initialisée, c'est qu'on n'utilisera qu'une méthode statique
	// donc: pas besoin de continuer le traitement ici
	if(!isset($rq) or !isset($ch) or $rq == "") return;

	// Enregistrement de la requête dans la session
	$_SESSION["searchquery-rq"] = $rq; // la requête
	$_SESSION["searchquery-ch"] = $ch; // le champ de délimitation

	/* Protection des requêtes SQL: l'espace étant un opérateur ET, il faut enlever les espaces au début et à la fin de la requête ; de plus, c'est important car l'analyse de la formation de la requête s'opère en prélevant des caractères spéciaux à des endroits précis (p. ex. le premier et le dernier caractères doivent être " pour une fulltext search) */
	$rq = trim($rq);

	/* On enlève les slash pour ne pas causer de problème lors de la vérification des conditions. On remettra plus tard les slash pour protéger la requête SQL. */
	$rq = stripslashes($rq);

	// 1er cas: c'est une expression régulière
	if(strcasecmp(substr($rq, 0, 6) , "regex=") == 0)
	{
		$this->type = "REGEX";

		// Note: la condition ci-dessus a 2 particularités:
		// 1) la comparaison est insensible à la casse
		// 2) la méthode strcasecmp retourne 0 si les deux chaînes comparées sont égales...

		// Extraire l'expression régulière
		// Ne pas utiliser la fonction explode car elle est sensible à la casse...
		$regex =  substr($rq, 6);
		// Protection des requêtes SQL: on protège les ' par des \
		$regex = addslashes($regex);
		/* Construction de la requête et exécution */
		$this->rq = $regex;
		$this->executer_requete($this->construire_requete( $regex , $ch , true , false ));
	}

	// 2ème cas: c'est une recherche fulltext
	elseif(substr($rq, 0, 1) == '(' and substr($rq, -1, 1) == ')')
	{
		$this->type = "FULLTEXT";

		// Note: substr prélève une partie de la chaîne $rq
		// 0,1 signifie 1 caractère depuis la position 0 (le premier caractère)
		// -1,1 signifie 1 caractère depuis la position -1 (le dernière caractère)

		// Extraire le motif (ce qui se trouve entre les guillemets)
		$rqa = substr($rq, 1, -1);
		// Protection des requêtes SQL: on protège les ' par des \
		$rqa = addslashes($rqa);
		/* Construction de la requête et exécution */
		$this->rq = $rqa;
		$this->executer_requete( $this->construire_requete ( $rqa , $ch , false, true ) );
	}

	// 3ème cas: ce n'est PAS une expression régulière NI une recherche fulltext
	else
	{
		$this->type = "DEFAULT";

		// Nettoyage: on enlève tous les mots-clés génériques
		$rq = $this->nettoyer_requete($rq);
		// Protection des requêtes SQL: on protège les ' par des \
		$rq = addslashes($rq);
		// On récupère les mots séparés: il y a autant d'espaces que de requêtes
		$rqa = explode(" ", $rq);
		// Combien de mots dans ce tableau ?
		$nbr = count($rqa);
		// Recherche intelligente: on crée autant de requêtes SQL qu'il y a de mots
		for ( $i = 0 ; $i < $nbr ; $i++ )
		{
			/* Construction de la requête et exécution */
			$this->rq[$i] = $rqa[$i];
			$this->executer_requete($this->construire_requete($rqa[$i],$ch,false,false));
		}
		// Traitement des résultats
		$this->definir_pertinence();
	}

}

/*
*******************************************************************************************
*/

/*
Nom: afficher_requete
But: Renvoie la requête pour être affichée "proprement" (la transtype en string si elle est de type array)
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
But: Elimine les mots-clés génériques de la chaîne passée en argument, tels que définis dans la variable de classe $gen.
Info: Guillaume Florimond, 07/04/2007
*/
function nettoyer_requete($req)
{
		/* La fonction remplace à l'intérieur des mots. Pour éviter d'enlever des lettres aux mots recherchés, il faut que ce qu'on enlève soient des mots complets, c'est-à-dire des chaînes entournées d'espaces... Le tableau $gen n'admettant pas d'espace de part et d'autre de ses composantes, pour des raisons de lisibilité, il convient d'en ajouter ici */
	for($i = 0 ; $i < count($this->gen) ; $i++ )
		$mots[$i] = " ".$this->gen[$i]." ";

	/* On ajoute un espace AVANT et APRES le mot à éliminer. Bien. Mais si ce mot est en début de chaîne, il n'aura pas d'espace avant lui. S'il est en fin de chaîne, il n'aura pas d'espace après lui. Il ne sera donc pas éliminé. Il faut donc ajouter ici un espace en début de chaîne et un espace en fin de chaîne, pour que l'analyse soit correcte. Il faudra par la suite retirer ces espaces à l'aide de la fonction trim() */
	$req = " ".$req." ";

	/* Cette fonction remplace les occurences des mots définis dans $mots rencontrés dans $req par des chaînes vides
	NB 1: str_replace est sensible à la casse, str_ireplace ne l'est pas
	NB 2: la fonction se charge de parcourir le tableau $mots toute seule
	NB 3: il faut remplacer PAR un espace, sinon les mots seront collés les uns autre autres
	*/
	// PHP 4
	if (!function_exists('str_ireplace'))
	    include "lib/php5functions/str_ireplace.php";

	$req = str_ireplace($mots, " ", $req);



	/* La fonction ci-dessus remplace le mot clé par un caractère vide. Mais comme ce mot était séparé d'un espace de chaque côté, on se retrouve avec 2 espaces à la suite. Cela déclenche la fonction explode utilisée pour séparer les mots dans la requête, et cela génère une erreur car un espace n'est pas un motif de recherche valable... Il faut donc absolument réparer ce dommage et remplacer les espaces doubles par des espaces simples */

	//$req = str_ireplace("  ", " ", $req); // DEPRECATED
	$req = preg_replace('/\s\s+/', ' ', $req);

	// Retirer l'espace simple en début et fin de chaîne qui a été ajouté plus haut
	$req = trim($req);

	// retour
	return $req;
}

/*
Nom: definir_pertinence
But: Calcule la pertinence de chacun des résultats de la recherche. Modifie le conteneur des résultats, $this->tab, pour y ajouter l'indice de pertinence de chaque résultat: $this->pertinence[X]["pertinence"]
Info: Guillaume Florimond, 07/04/2007
*/
function definir_pertinence()
{
	// Retour s'il n'y a pas de résultat
	if($this->num == 0) return;

	// Initialisation des variables
	$note = 0; // La note du résultat (sa pertinence, sur une échelle de 0 à 10)
	$p = 0;// Variable de comptage
	$ct = 0; // Variable de comptage
	$rq = $this->rq; // Variable stockant la requête (tableau ou non)
	$rs = $this->tab; // Variable stockant les résultats de la recherche

	// Vérifier qu'en fait d'une requête simple ce soit une agrégation ou une comparaison
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

	// A. Si $rq est un tableau (si la requête contient plusieurs mots-clés)
	if(is_array($rq) and count($rq) > 1)
	{
		// Parcourir les résultats
		for($i = 0; $i < count($rs) ; $i++)
		{
			// Parcourir les mots-clés (les mots qui composent la requête)
			foreach( $rq as $key=>$val ) /* val contient les mots-clés */
			{
				// Parcourir les champs de chaque résultat
				foreach($rs[$i] as $k=>$v)
				{
					/* substr_count(A,B) compte le nombre d'occurrences de B dans A*/
					/*si ce qu'on cherche est + petit ou = à que ce dans quoi on cherche!!*/
					if(strlen($v) >= strlen($val))
						$ct = substr_count( $v , $val );

					$p = $p + $ct; // $p contient le nombre d'occurences
					$ct = 0; // on réinitialise le compteur
				}
				$note = $note + $p; // note = somme des notes (p) pour chaque champ
				$p = 0; // on réinitialise le compteur
				$rs[$i]["pertinence"] = $note; // on enregistre la note
			}
			$note = 0; // on réinitialise le compteur
		}
	}

	// B. Si $rq n'est pas un tableau (si la requête ne contient qu'une expression)
	else
	{
		// Parcourir les résultats
		for($i = 0; $i < count($rs) ; $i++)
		{
			$val = $rq[0];
			// Parcourir les champs de chaque résultat
			foreach($rs[$i] as $k=>$v)
			{
				/* substr_count(A,B) compte le nombre d'occurrences de B dans A*/
				/*si ce qu'on cherche est + petit ou = à que ce dans quoi on cherche!!*/
				if(strlen($v) >= strlen($val))
					$ct = substr_count( $v , $val );

				$p = $p + $ct; // $p contient le nombre d'occurences
				$ct = 0; // on réinitialise le compteur
			}
			$note = $p;
			$p = 0; // on réinitialise le compteur
			$rs[$i]["pertinence"] = $note; // on enregistre la note
		}
	}

	// 2. CALCULER LE POURCENTAGE DE PERTINENCE DE CHAQUE FICHE
	$rs = $this->normaliser_pertinence($rs);

	// 3. TRI DU TABLEAU PAR PERTINENCE DÉCROISSANTE
	foreach($rs as $key=>$val)
		$tri[$key] = $val["pertinence"];
	array_multisort($tri, SORT_DESC, $rs);

	// 4. FINITION: retour le nouveau tableau avec toutes les notes de pertinence en plus
	$this->tab = $rs;
}

/*
Nom: normaliser_pertinence
But: Calcule le pourcentage de pertinence de chaque résultat en fonction de la petinence des autres résultats (le plus pertinence est l'indice: 100%).
Info: Guillaume Florimond, 07/04/2007
*/
function normaliser_pertinence($rs)
{
	// Retour s'il n'y a pas de résultat
	if($this->num == 0) return;

	// Calculer la plus haute valeur de pertinence
	$max = 0;
	for($i = 0; $i < count($rs); $i++)
		if($rs[$i]["pertinence"] > $max)
			$max = $rs[$i]["pertinence"];

	// Pour empêcher une future division par 0...
	if($max == 0) $max = 1;

	// Calculer le pourcentage de chaque pertinence ($max = 100%)
	for($i = 0; $i < count($rs); $i++)
		$rs[$i]["pertinence"] = round(($rs[$i]["pertinence"] / $max) * 100);

	return $rs;
}

/*
Nom: executer_requete
But: Exécute la requête SQL passée en argument et appelle la fonction ajouter_ligne pour chaque résultat.
Info: Guillaume Florimond, 07/04/2007
*/
function executer_requete($sql)
{
	/* Exécution de la requête */
	connexion();
	$req = mysql_query($sql) or die("Erreur ".$sql);

	/* Calcul du nombre de résultats (remplissage de $this->num) -- Avec ce système de recherche, chaque motif de recherche séparé d'un espace donne lieu à sa propre requête. On doit donc INCREMENTER le compteur et non pas remplacer le compteur existant par une nouvelle valeur (d'où += au lieu de =), sinon seul le nombre de résultats de la dernière recherche sera affiché. */
	$this->num += mysql_num_rows($req);

	/* Remplissage du tableau ($this->tab) des résultats */
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

		// Appelle la fonction qui ajoute une ligne qui correspond à un résultat.
		$this->ajouter_ligne($afficher);
	}
}

/*
Nom: ajouter_ligne
But: Ajoute une ligne dans le tableau qui stocke les résultats, $this->tab. Fonction appelée par la fonction executer_requete pour chaque résultat de recherche.
Info: Guillaume Florimond, 07/04/2007
*/
function ajouter_ligne($data)
{
	// On se place à la prochaine ligne
	$i = count($this->tab); // pas de + 1 car tab est initialisé à 0, il a 1 élt de retard

	// On ajoute les données dans $tab
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
But: Affiche les résultats de la recherche à l'écran. Cette fonction affiche le contenu de la variable de classe $this->tab qui contient les résultats.
Info: Guillaume Florimond, 07/04/2007
Argument $ttype:
 DEFAULT => recherche intelligente, focalisée ou diffuse
 REGEX => expression régulière
 FULLTEXT => full text search
La définition de cet argument permet de déterminer quand afficher la pertinence des résultats. La pertinence n'est affichée que s'il est DEFAULT.
*/
function afficher_resultats($ttype = null)
{
	if(isset($this->type)) $ttype = $this->type;

	// Déclaration du tableau
	$ligne = '<table width="80%" align="center" cellpadding="4" cellspacing="0" border="0" class="orange">';

	// Nombre de résultats
	$ligne .= '<tr class="orange">';
		$ligne .= '<td colspan="2"><b>';
		// Afficher le nombre ou afficher "Aucun" (si 0 résultat) ?
		if ($this->num == 0) $ligne .= donner("rech_resultat_aucun").' ';
		else $ligne .= $this->num.' ';
		// Mot "résultat" au singulier ou au pluriel ?
		if($this->num < 2 != 0) $ligne .= donner("rech_resultat_singulier");
		else $ligne .= donner("rech_resultat_pluriel");
	$ligne .= '</b></td>';
	$ligne .= '<td colspan="3"><b>'.donner("rech_requete").'</b> ';
	$ligne .= '( <u>'.$ttype.'</u> )';
	$ligne .= ' &gt; <i>'.$this->afficher_requete($this->rq).'</i></td>';
	$ligne .= "</tr>";

	// En-tête du tableau
	$ligne .= '<tr class="orange">';
	  $ligne .= '<td style="border-top: 1px solid #FF8000;">'.donner("c1").'</td>';
	  $ligne .= '<td style="border-top: 1px solid #FF8000;">'.donner("c2").'</td>';
	  $ligne .= '<td style="border-top: 1px solid #FF8000;">'.donner("c3").'</td>';
	  $ligne .= '<td style="border-top: 1px solid #FF8000;">'.donner("c7").'</td>';
	if($ttype == "DEFAULT" or $ttype == "FULLTEXT")
	  $ligne .= '<td style="border-top: 1px solid #FF8000;">'.donner("pertinence").'</td>';
	$ligne .= '</tr>';
	echo $ligne;

	/* Avant d'afficher les résultats, on doit normaliser la pertinence s'il s'agit d'une fulltext search. La raison est la suivante: l'indice de pertinence des fulltext search est calculé directement par MySQL. Il n'est pas calculé par la fonction definir_pertinence comme l'indice de pertinence "classique" pour les recherches normales. Or, MySQL n'utilise pas un indice 100 comme cette classe. Il en résulte une distortion de l'indice de pertinence qu'il faut corriger. C'est pourquoi on appelle ici la fonction normaliser_pertinence sur les résultats de recherche s'il s'agit d'une fulltext search */
	if($ttype == "FULLTEXT")
		$this->tab = $this->normaliser_pertinence($this->tab);

	// Remplissage: $lignes = 1 résultat de recherche par ligne
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

	// Dédoublonnage (uniquement s'il y a plusieurs lignes...)
	if(isset($lignes) and count($lignes) > 1)
		$lignes = array_unique($lignes);

	// Affichage final	(uniquement s'il y a des résultats, càd si $lignes existe...)
	if(isset($lignes))
		foreach($lignes as $key=>$val)
			echo $val;

	echo "</table>";
}

/*
Nom: construire_requete
But: Cette fonction construit la requête SQL de recherche en fonction des arguments qui lui sont transmis.
Info: Guillaume Florimond, 07/04/2007
Arguments:
 $rq => la chaîne ou l'expression régulière à rechercher
 $rc => le délimiteur du champ de recherche ($_POST["champ"])
 $regex => TRUE s'il s'agit d'une expression régulière, FALSE dans le cas contraire
 $fulltext => TRUE si on fait une recherche fulltext, FALSE dans le cas contraire
*/
function construire_requete($rq, $rc, $regex, $fulltext)
{
	$recherche["requete"] = $rq;
	$recherche["champ"] = $rc;

	/* Construction de la racine de la requête SQL */
	/* Ne pas faire de (SELECT * FROM...) pour éviter que les champs contenant la question personnelle et la réponse secrète soient exportés. */
	$sql = "SELECT id, nom, prenom, promotion, email, naissance, adresse, nationalite, q1, q2, q3, q4, q5, q6, q7 FROM utilisateur WHERE ";

/* RECHERCHE FOCALISEE
*/
	if(isset($recherche["champ"])
		and $recherche["champ"] != "tous"
		and $recherche["champ"] != "defaut")
	{
		$sql .= $recherche["champ"];

		// Si c'est une expression régulière
		if($regex)
			$sql .= " REGEXP '".$recherche["requete"]."';";
		// Si c'est une fulltext search
		elseif($fulltext)
			// la recherche fulltext ne fonctionne pas dans les colonnes DATE
			$sql = "SELECT id, nom, prenom, promotion, email FROM utilisateur WHERE  MATCH(q1,q2,q3,q4,q5,q6,q7) AGAINST ('".$recherche["requete"]."');";
		// Si ce n'est pas une expression régulière ni une fulltext search
		else
			$sql .= "= '".$recherche["requete"]."';";
	}
/* RECHERCHE DIFFUSE
*/
	elseif(isset($recherche["champ"])
			and $recherche["champ"] == "tous"
			and $recherche["champ"] != "defaut")
	{
		// Si c'est une expression régulière
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
		// Si ce n'est pas une expression régulière ni une fulltext search
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

// 1. S'il s'agit d'une expression régulière
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
			// Requête générale

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

/* 3. Si ce n'est pas une expression régulière ni une fulltext search, on continue le traitement... */

		/* Combien y a-t-il d'opérateurs ET ? (&&)
		S'il n'y en a pas, le tableau $rqb aura tout de même 1 instance, qui contiendra la chaîne de recherche entière= $rqb[0];*/
		$rqb = explode("&&", $recherche["requete"]);

		/* On exécute la boucle de recherche autant de fois qu'il y a de termes dans la boucle ET (p. ex. A&&B&&C&&D = 4 fois ; A = 1 fois). S'il n'y a aucun "ET", il y a tout de même 1 terme dans la recherche, et la boucle est exécutée 1 fois (l'opérateur AND n'est pas ajouté dans ce cas, c'est un ; qui termine l'instruction qui le remplace) */
		for ( $i = 0 ; $i < count($rqb) ; $i++ )
		{
			// Détermine s'il existe un opérateur de comparaison pour la suite
			// Les régex exigent entre 2 et 4 chiffres, < ou >, et entre 2 et 4 chiffres.

			$regexa = "`^([[:digit:]]{2,4})<([[:digit:]]{2,4})$`";
			$regexb = "`^([[:digit:]]{2,4})>([[:digit:]]{2,4})$`";

			// 1. Si l'opérateur de comparaison est présent, il est exclusif du reste
			if(preg_match($regexa,$rqb[$i]) or preg_match($regexb,$rqb[$i]))
			{
				// Si c'est l'opérateur < qui est utilisé
				if(preg_match($regexa,$rqb[$i],$taba))
					$sql .= "promotion BETWEEN ".$taba[1]." AND ".$taba[2];
				// Si c'est l'opérateur > qui est utilisé
				if(preg_match($regexb,$rqb[$i],$tabb))
					$sql .= "promotion BETWEEN ".$tabb[2]." AND ".$tabb[1];
			}

			// 2. Si l'opérateur de comparaison n'est pas présent, continuer le traitement
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

			// On n'ajoute AND que si la boucle va s'exécuter encore une fois au moins
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