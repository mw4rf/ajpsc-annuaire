<?php
/*
Nom: changer_reponse_secrete
But: Remplace la réponse secrète par le nouveau hash SHA1 pour l'utilisateur spécifié
Info: Guillaume Florimond, 27/02/2007
*/
function changer_reponse_secrete($sha1hash, $userid)
{
	/* Protection */
	if(!isadmin()) return false;

	/* Connexion */
	connexion();

    // Anti injection
    $sha1hash = addslashes($sha1hash);

	/* Formulation de la requête */
	$sql = "UPDATE utilisateur SET secret_reponse='$sha1hash' WHERE id='$userid';";

	/* Exécution de la requête */
	mysql_query($sql) or die ("Erreur: ".$sql);

	/* Tout s'est bien passé: retour true */
	return true;
}

/*
Nom: changer_question
But: Change la question d'un utilisateur
Info: Guillaume Florimond, 21/02/2013
*/
function changer_question($question, $userid)
{
    /* Protection */
    if(!isadmin()) return false;

    /* Connexion */
    connexion();

    // Anti injection
    $question = addslashes($question);

    /* Formulation de la requête */
    $sql = "UPDATE utilisateur SET secret_question='$question' WHERE id='$userid';";

    /* Exécution de la requête */
    mysql_query($sql) or die ("Erreur: ".$sql);

    /* Tout s'est bien passé: retour true */
    return true;
}

/*
Nom: file_size_info
But: Calcule la taille d'un fichier en octets
Info: http://www.webmasterworld.com/forum88/2069.htm, 02/03/2007
*/
function file_size_info($filesize)
{
 $bytes = array('Octets', 'Ko', 'Mo', 'Go', 'To');

 if ($filesize < 1024) $filesize = 1;
 	for ($i = 0; $filesize > 1024; $i++)
 		$filesize /= 1024;

 $file_size_info['size'] = ceil($filesize);
 $file_size_info['type'] = $bytes[$i];

 return $file_size_info;
 }

?>