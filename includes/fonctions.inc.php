<?php
/*
Nom: dire
But: D�tecte la langue du client et affiche une phrase dans sa langue
Info: Guillaume Florimond, 16/12/2006
*/
function dire($item)
{
	echo donner($item);
}

/*
Nom: message
But: D�tecte la langue du client et affiche le message, dans le div MESSAGE, dans sa langue
Alors que la fonction dire() n'affique que le string localis�, cette fonction d'encapsule dans une div qui peut �tre format�e avec les CSS.
Info: Guillaume Florimond, 10/04/2007
*/
function message($item)
{
	echo "<div class=\"message\">".donner($item)."</div>";
}

/*
Nom: donner
But: D�tecte la langue du client et renvoie une phrase dans sa langue
Info: Guillaume Florimond, 16/12/2006
*/
function donner($item)
{
	// V�rifie si l'utilisateur a choisi manuellement une langue
	if(isset($_SESSION["langue"]))
	{
		$lang = $_SESSION["langue"];
	}
	// S'il n'a rien choisi, d�terminer la langue par d�faut de son navigateur
	else
	{
		// V�rifie si l'information a bien �t� transmise en header
		if(isset($_SERVER["HTTP_ACCEPT_LANGUAGE"]))
		{
			/* Obtient les deux premiers caract�res de la cha�ne qui correspondent � la
			langue par d�faut du client (fr, en, etc...). Le reste de la cha�ne contient
			la liste des langues g�r�es par le client, ce qui n'est pas utile ici. */
			$lang = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2);
		}
		// S'il n'y a pas de choix et que le header n'a pas �t� transmis: par d�faut
		else
		{
			$lang = "fr"; // par d�faut
		}
	}

	// Liste � modifier en fonction des langues disponibles:
	// fran�ais (fr) - espagnol (es) - anglais (en)
	if($lang != "fr" and $lang != "es" and $lang != "en")
	{
		$lang = "fr";
	}

	// Obtient la phrase demand�e dans la langue demand�e
	global $phrase;

		// 1er cas: la phrase existe dans la langue choisie.
		if(isset($phrase[$lang][$item]))
		{
			$res = $phrase[$lang][$item];
		}
		// 2�me cas: la phrase n'existe pas dans la langue choisie mais elle existe en FR
		elseif(isset($phrase["fr"][$item]))
		{
			$res = $phrase["fr"][$item];
		}
		// 3�me cas: la phrase n'existe ni dans la langue choisie ni en fran�ais
		else
		{
			$res = "";
		}

	// AFFICHE le r�sultat
	return $res;
}

/*
Nom: obtenir_theme
But: Renvoie le nom du th�me utilis� � l'instant
Info: Guillaume Florimond, 01/01/2007
*/
function obtenir_theme()
{
	global $_config;

	if(isset($_SESSION['theme_personnalise']) and $_SESSION['theme_personnalise'] == 1 and isset($_SESSION['theme']))
	{
		return $_SESSION['theme'];
	}
	else
	{
		return $_config['theme'];
	}
}

/*
Nom: definir_theme
But: D�finit un th�me personnalis� pour l'utilisateur, qui dure le temps de la session
Info: Guillaume Florimond, 01/01/2007
*/
function definir_theme($theme)
{
	/* Correction bug - 03/01/07: les changements de th�me ne sont pas pris en compte apr�s rafraichissement de la page */

	/* Etrangement, chez Celeonet, �craser l'ancienne valeur de $_SESSION["theme"] par une nouvelle valeur ne suffit pas. Cela l'�crase sur le moment, mais au prochain appel de $_SESSION["theme"], c'est la valeur d'origine qui sera retourn�e ! Pour �viter cela, il faut utiliser la fonction unset() qui supprime r�ellement l'entr�e dans le tableau $_SESSION, pour laisser la place � une nouvelle entr�e. */
	unset($_SESSION['theme']);
	unset($_SESSION['theme_personnalise']);

	$_SESSION['theme'] = $theme;
	$_SESSION['theme_personnalise'] = 1;
}

/*
Nom: parcourir_dossier
But: Renvoie le contenu d'un dossier du FTP sous forme de tableau, ou FALSE en cas d'erreur
Info: Guillaume Florimond, 01/01/2007
*/
function parcourir_dossier($chemin)
{
	if ($handle = opendir($chemin))
	{
		/* Indice pour remplir le tableau */
		$i = 0;
		/* Ceci est la bonne mani�re pour parcourir un dossier. */
	    while (false !== ($fichier = readdir($handle)))
	    {
			if ($fichier != "." // prot�ge contre le r�pertoire sup�rieur
				and $fichier != ".." // prot�ge contre le r�pertoire racine
				and $fichier{0} != ".") // prot�ge contre les fichiers cach�s unix (".file")
			{
				$contenu[$i] = $fichier;
				$i++;
			}
	    }
	   closedir($handle);
	   return $contenu;
	}
	return false;
}

/*
Nom: changer_langue
But: Change la langue courante et l'enregistre dans la SESSION, en fonction du choix de l'utilisateur
Param: la langue en deux lettre: "fr" fran�ais, "es" espagnol, "en" anglais
Info: Guillaume Florimond, 01/01/2007
*/
function changer_langue($langue)
{
	// Protection pour ne pas appliquer une langue inconnue
	if($langue != "fr" and $langue != "es" and $langue != "en")
	{
		$langue = "fr";
	}

	$_SESSION["langue"] = $langue;
}

/*
Nom: abbr
But: Affiche le r�sultat de abbr2 - Argument: la cha�ne dans le tableau $phrases
Info: Guillaume Florimond, 25/12/2006
*/
function abbr($c)
{
	echo abbr2($c);
}

/*
Nom: abbr2
But: Renvoie le code HTML qui contient le tooltip et le contenu � afficher.
Info: Guillaume Florimond, 25/12/2006
Dans le fichier de langue, cr�er deux entr�es:
- $phrase["fr"]["x"]
- $phrase["fr"]["@x"]
L'argument $c doit �tre "x". La fonction renvoie alors "x" affich� sur la page et "@x" en tooltip.
*/
function abbr2($c)
{
	global $_config;
	if($_config['tooltips'] == 1)
	{
		return "<abbr title=\"".donner("@".$c)."\">".donner($c)."</abbr>";
	}
	else
	{
		return donner($c);
	}
}

/*
Nom: abbr3
But: Renvoie le code HTML qui contient le tooltip et le contenu � afficher.
Info: Guillaume Florimond, 25/12/2006
*/
function abbr3($contenu, $abbr)
{
	global $_config;
	if($_config['tooltips'] == 1)
	{
		return "<abbr title=\"$abbr\">$contenu</abbr>";
	}
	else
	{
		return $contenu;
	}
}

/*
Nom: promotion
But: Renvoie la date de d�but et de fin des �tudes en fonction de la promotion (dans une phrase)
Info: Guillaume Florimond, 25/12/2006
*/
function promotion($promo)
{
	$fin = $promo;
	$debut = $promo-4;
	$res = donner('promo1')." $promo ".donner('promo2')." $debut ".donner('promo3')." $fin ".donner('promo4');
	return $res;
}

/*
Nom: convertir_date
But: Affiche d'une date du type 1900-01-01 sous la forme "1er janvier 1900"
Info: Guillaume Florimond, 16/12/2006
*/
function convertir_date($date)
{
	$dt = explode("-", $date);
	$j = $dt["2"]; // jour
	$m = $dt["1"]; // mois
	$a = $dt["0"]; // ann�e

	// Convertir les jours sur 1 chiffre si n�cessaire, p. ex. 03 janvier => 3 janvier
	switch($j)
	{
		case 01: $j = "1"; break;
		case 02: $j = "2"; break;
		case 03: $j = "3"; break;
		case 04: $j = "4"; break;
		case 05: $j = "5"; break;
		case 06: $j = "6"; break;
		case 07: $j = "7"; break;
		case 08: $j = "8"; break;
		case 09: $j = "9"; break;
		default;
	}

	// Modificateur �ventuel pour le 1 => 1er janvier...
	if($j == 1) { $j = $j.donner("dt-1er"); }

	// Nommer les mois
	$m = donner($m);

	// Construire la date
	$sep = donner("dt-sep"); // s�parateur de date, p. ex. "de" => "1 de enero de 1900"
	$res = $j." ".$sep." ".$m." ".$sep." ".$a;

	// Renvoyer
	return $res;
}

/*
Nom: formater_date
But: Convertit une date au format fran�ais vers le format MySQL: 01/02/2006 => 2006-02-01
Info: Guillaume Florimond, 10/04/2007
Param: $date: la date � convertir
	$vers_mysql: TRUE pour JJ/MM/AAAA => AAAA-MM-JJ ; FALSE pour AAAA-MM-JJ => JJ/MM/AAAA
ATTENTION: quand la langue est l'anglais, les dates sont affich�es au format am�ricain, MM/DD/YYYY
*/
function formater_date($date, $vers_mysql = true)
{
	// 1er cas: la langue est l'ANGLAIS, format US: MM/DD/YYYY
	if(isset($_SESSION["langue"]) and $_SESSION["langue"] == "en")
	{
		// MM/DD/YYYY => YYYY-MM-DD
		if($vers_mysql)
		{
			$pattern     = "`([0-9]{2})/([0-9]{2})/([0-9]{4})`";
			$replacement = "$3-$1-$2";
		}
		// YYYY-MM-DD => DD/MM/YYYY
		else
		{
			$pattern     = "`([0-9]{4})-([0-9]{2})-([0-9]{2})`";
			$replacement = "$2/$3/$1";
		}
	}

	// 2�me cas: la langue est FRANCAIS ou ESPAGNOl, format EUROPEEN: DD/MM/AAAA
	else
	{
		// JJ/MM/AAAA => AAAA-MM-JJ
		if($vers_mysql)
		{
			$pattern     = "`([0-9]{2})/([0-9]{2})/([0-9]{4})`";
			$replacement = "$3-$2-$1";
		}
		// AAAA-MM-JJ => JJ/MM/AAAA
		else
		{
			$pattern     = "`([0-9]{4})-([0-9]{2})-([0-9]{2})`";
			$replacement = "$3/$2/$1";
		}
	}

	return preg_replace($pattern, $replacement, $date);
}

/*
Nom: formater_nom
But: Convertit le nom de famille: FULANO => Fulano
Info: Guillaume Florimond, 17/12/2006
*/
function formater_nom($nom)
{
	/** DEPRECATED
	** Les apelidos espagnols avec 2 noms sont mal convertis: FULANO MENGANO donne "Fulano mengano" au lieu de "Fulano Mengano".
	// Tout en minuscules
	$nom = strtolower($nom);
	// Le premier caract�re en majuscule
	$nom = ucfirst($nom);
	*/

	// CASE_TITLE mets des majuscules � la premi�re lettre de chaque mot
	// Avantage: les minuscules accentu�es sont bien converties en majuscules accentu�es.
	$nom = mb_convert_case($nom, MB_CASE_TITLE, "ISO-8859-1");
	return $nom;
}

/*
Nom: texte_vers_html
But: Convertir du texte brut en html *s�curis�* (p. ex. remplacer linebreak par <br />)
Info: Guillaume Florimond, 17/12/2006
*/
function texte_vers_html($texte)
{
	// Enlever tous les vilains tags
	global $html_allowed; // voir dans config.inc.php
	$texte = strip_tags($texte, $html_allowed);

	// Convertir les linebreak en <br />
	$texte = nl2br($texte);

	return $texte;
}

/*
Nom: html_vers_texte
But: Convertir du html en texte brut, SEULEMENT en ce qui concerne les <br /> !!
Info: Guillaume Florimond, 17/12/2006
*/
function html_vers_texte($html)
{
	// Convertir les <br /> en linebreak
	$html = str_replace("\r\n", "\n", $html);
	$html = str_replace("<br />\n", "\n", $html);

	return $html;
}

/*
Nom: connexion
But: Connexion � la base de donn�es
Info: Guillaume Florimond, 9/12/2006
*/
function connexion()
{
	if(!checkauth()) return;
	global $_config;
	$db = mysql_connect($_config["host"], $_config["user"], $_config["passwd"]);
	mysql_select_db($_config["base"],$db);
}

/*
Nom: auth
But: V�rification du mot de passe soumis et connexion de l'utilisateur
Info: Guillaume Florimond, 9/12/2006
*/
function auth($passwd)
{
	global $_config;

	$db = mysql_connect($_config["host"], $_config["user"], $_config["passwd"]);
	mysql_select_db($_config["base"],$db);

	$sql = "SELECT pass FROM admin WHERE id=1;";
	$req = mysql_query($sql);
	$data = mysql_fetch_assoc($req) or die("Erreur");
	$passwd = sha1($passwd);

	//Hypoth�se 1: identification correcte
	if($passwd == $data['pass'])
	{
		//Identification r�ussie
		$_SESSION['auth'] = 1;
		$_SESSION['mauvais_mdp'] = false;

	}
	//Hypoth�se 2: identification incorrecte
	else
	{
		$_SESSION['mauvais_mdp'] = true;
	}
}

/*
Nom: checkauth
But: V�rifie si l'utilisateur est bien connect� avant de lui donner acc�s aux donn�es
Info: Guillaume Florimond, 9/12/2006
*/
function checkauth()
{
	global $_config;
	if($_config['auth'] == 0)
	{
		return true;
	}

	if(isset($_SESSION['auth']) and $_SESSION['auth'] == 1)
	{
		return true;
	}
	else return false;
}

/*
Nom: adminauth
But: Authentification en tant qu'administrateur de l'annuaire
Info: Guillaume Florimond, 23/02/2007
*/
function adminauth($passwd)
{
	global $_config;

	$db = mysql_connect($_config["host"], $_config["user"], $_config["passwd"]);
	mysql_select_db($_config["base"],$db);

	$sql = "SELECT adminpass FROM admin WHERE id=1;";
	$req = mysql_query($sql);
	$data = mysql_fetch_assoc($req) or die("Erreur");
	$passwd = sha1($passwd);

	//Hypoth�se 1: identification correcte
	if($passwd == $data['adminpass'])
	{
		//Identification r�ussie
		$_SESSION['isadmin'] = 1;
		$_SESSION['auth'] = 1;
		$_SESSION['mauvais_mdp'] = false;

	}
	//Hypoth�se 2: identification incorrecte
	else
	{
		$_SESSION['mauvais_mdp'] = true;
	}
}

/*
Nom: isadmin
But: Renvoie TRUE si l'utilisateur est administrateur, FALSE dans le cas contraire
Info: Guillaume Florimond, 23/02/2007
*/
function isadmin()
{
	if(isset($_SESSION['isadmin']) and $_SESSION['isadmin'] == 1)
		return true;
	else
		return false;
}

/*
Nom: ajouter
But: Ajoute une fiche � la base de donn�es
Info: Guillaume Florimond, 9/12/2006
*/
function ajouter($post)
{
	connexion();

	/* Collecte des donn�es depuis le formulaire */
	/* Cela permettra de manipuler ces donn�es, p. ex. pour contr�ler leur conformit� */
	$data["nom"] = addslashes(texte_vers_html(formater_nom($post["nom"])));
	$data["prenom"] = addslashes(texte_vers_html(formater_nom($post["prenom"])));
	$data["promotion"] = addslashes(texte_vers_html($post["promotion"]));
	$data["nationalite"] = addslashes(texte_vers_html($post["nationalite"]));
	$data["naissance"] = addslashes(texte_vers_html(formater_date($post["naissance"])));
	$data["adresse"] = addslashes(texte_vers_html($post["adresse"]));
	$data["email"] = addslashes(texte_vers_html($post["email"]));

	$data["q1"] = addslashes(texte_vers_html($post["q1"]));
	$data["q2"] = addslashes(texte_vers_html($post["q2"]));
	$data["q3"] = addslashes(texte_vers_html($post["q3"]));
	$data["q4"] = addslashes(texte_vers_html($post["q4"]));
	$data["q5"] = addslashes(texte_vers_html($post["q5"]));
	$data["q6"] = addslashes(texte_vers_html($post["q6"]));
	$data["q7"] = addslashes(texte_vers_html($post["q7"]));

	$data["secret_question"] = addslashes($post["secret_question"]);
	$data["secret_reponse"] = sha1($post["secret_reponse"]);

	/* Syst�me anti-doublons */
	$sql = "SELECT id FROM utilisateur WHERE nom='".$data["nom"]."' AND prenom='".$data["prenom"]."'";
    $req = mysql_query($sql) or die("Erreur: $sql<br />".mysql_error());
	$res = mysql_num_rows($req);
	if($res!=0) { message("doublon"); return "erreur"; }

	/* Le champ "modif" repr�sente la date de la derni�re modification de la fiche, aujourd'hui*/
	$modif = date("Y-m-d");

	/* Formulation de la requ�te */
	$sql = "INSERT INTO utilisateur (nom, prenom, promotion, nationalite, naissance, adresse, email, q1, q2, q3, q4, q5, q6, q7, secret_question, secret_reponse, modif) VALUES ('".$data["nom"]."', '".$data["prenom"]."', '".$data["promotion"]."', '".$data["nationalite"]."', '".$data["naissance"]."', '".$data["adresse"]."', '".$data["email"]."', '".$data["q1"]."', '".$data["q2"]."', '".$data["q3"]."', '".$data["q4"]."', '".$data["q5"]."', '".$data["q6"]."', '".$data["q7"]."', '".$data["secret_question"]."', '".$data["secret_reponse"]."', '$modif');";

	/* Ex�cution de la requ�te */
	mysql_query($sql) or die ("Erreur: $sql<br />".mysql_error());

	/* Message ok */
	message("enre");

	/* R�cup�ration de l'id de l'enregistrement cr�� */
	$sql = "SELECT id FROM utilisateur ORDER BY id DESC";
	$req = mysql_query($sql);
	while($data = mysql_fetch_assoc($req))
		//echo "id = ".$data['id'];
		return $data['id'];
}

function ajouter_photo($_UPLOADED_UPLOADED_FILES,$id)
{
	// debug
	//print_r($_UPLOADED_UPLOADED_FILES);

	@list($width, $height, $imgtype, $strtag) = getimagesize($_UPLOADED_UPLOADED_FILES['image']['tmp_name']);

	switch($imgtype)
	{
		case 1: $ext = 'gif'; break;
		case 2: $ext = 'jpeg'; break;
		case 3: $ext = 'png'; break;
		default: $ext = false; break;
	}

	if(!$ext) // unknown file format
		die(dire("photo1"));

	$imgdata = file_get_contents($_UPLOADED_UPLOADED_FILES['image']['tmp_name']);
	$imgdata = addslashes($imgdata); // mysql_real_escape_string seems broken on some configurations...

	/* Ins�rer dans la bdd */
	connexion();

	$sql = "INSERT INTO photo SET id='', user_id='$id', photo='$imgdata', extension='$ext', height='$height', width='$width'";
	@mysql_query($sql);
}

/*
Nom: modifier
But: Modifie une fiche de la base de donn�es
Info: Guillaume Florimond, 9/12/2006
*/
function modifier($post)
{
	connexion();
	/* Collecte des donn�es depuis le formulaire */
	/* Cela permettra de manipuler ces donn�es, p. ex. pour contr�ler leur conformit� */
	$id = $post["id"];
	$data["nom"] = addslashes(texte_vers_html(formater_nom($post["nom"])));
	$data["prenom"] = addslashes(texte_vers_html(formater_nom($post["prenom"])));
	$data["promotion"] = addslashes(texte_vers_html($post["promotion"]));
	$data["nationalite"] = addslashes(texte_vers_html($post["nationalite"]));
	$data["naissance"] = addslashes(texte_vers_html(formater_date($post["naissance"])));
	$data["adresse"] = addslashes(texte_vers_html($post["adresse"]));
	$data["email"] = addslashes(texte_vers_html($post["email"]));

	$data["q1"] = addslashes(texte_vers_html($post["q1"]));
	$data["q2"] = addslashes(texte_vers_html($post["q2"]));
	$data["q3"] = addslashes(texte_vers_html($post["q3"]));
	$data["q4"] = addslashes(texte_vers_html($post["q4"]));
	$data["q5"] = addslashes(texte_vers_html($post["q5"]));
	$data["q6"] = addslashes(texte_vers_html($post["q6"]));
	$data["q7"] = addslashes(texte_vers_html($post["q7"]));

	/* Si l'utilisateur est administrateur on passe, sinon on teste la r�ponse secrete*/
	if(!isadmin())
	{
		/* On v�rifie que la r�ponse secr�te correspond � celle stock�e dans la bdd */
		$sql = "SELECT secret_reponse FROM utilisateur WHERE id='$id'";
		$req = mysql_query($sql) or die('Erreur');
		$dat = mysql_fetch_assoc($req);
		if($dat["secret_reponse"] != sha1($post["secret_reponse"]))
		{
			message("sr");
			return; // Si cela ne correspond pas, on sort. Sinon, on continue.
		}
	}

	/* Le champ "modif" repr�sente la date de la derni�re modification de la fiche, aujourd'hui*/
	$modif = date("Y-m-d");

	/* Formulation de la requ�te */
	$sql = "UPDATE utilisateur SET"
			." nom='".$data["nom"]."',"
			." prenom='".$data["prenom"]."',"
			." promotion='".$data["promotion"]."',"
			." nationalite='".$data["nationalite"]."',"
			." naissance='".$data["naissance"]."',"
			." adresse='".$data["adresse"]."',"
			." email='".$data["email"]."',"
			." q1='".$data["q1"]."',"
			." q2='".$data["q2"]."',"
			." q3='".$data["q3"]."',"
			." q4='".$data["q4"]."',"
			." q5='".$data["q5"]."',"
			." q6='".$data["q6"]."',"
			." q7='".$data["q7"]."',"
			." modif='$modif'"
			." WHERE id='$id';";

	/* Ex�cution de la requ�te */
	mysql_query($sql) or die ("Erreur: ".$sql);
}

function modifier_photo($_UPLOADED_FILES,$id)
{
	if(empty($_UPLOADED_FILES['image']['tmp_name'])) return;

	@list($width, $height, $imgtype, $strtag) = getimagesize($_UPLOADED_FILES['image']['tmp_name']);

	switch($imgtype)
	{
		case 1: $ext = 'gif'; break;
		case 2: $ext = 'jpeg'; break;
		case 3: $ext = 'png'; break;
		default: $ext = false; break;
	}

	if(!$ext) // unknown file format
		die(dire('photo1'));

	$imgdata = file_get_contents($_UPLOADED_FILES['image']['tmp_name']);
	$imgdata = addslashes($imgdata); // mysql_real_escape_string seems broken on some configurations...

	/* Op�rations sur la bdd */
	connexion();

	// Rechercher si la photo existe d�j�
	$sql = "SELECT * FROM photo WHERE user_id='$id'";
	$num = mysql_num_rows(mysql_query($sql));
	// Si elle existe, la supprimer
	if($num)
	{
		$sql = "DELETE FROM photo WHERE user_id='$id'";
		@mysql_query($sql);
	}
	// Ajouter ensuite la photo
	$sql = "INSERT INTO photo SET id='', user_id='$id', photo='$imgdata', extension='$ext', height='$height', width='$width'";
	@mysql_query($sql);
}

/*
Nom: supprimer
But: Supprime une fiche de la base de donn�es
Info: Guillaume Florimond, 17/12/2006
*/
function supprimer($id)
{
	connexion();
	$sql = "DELETE FROM utilisateur WHERE id=$id;";
	mysql_query($sql) or die('Erreur');
}
?>