<?php

/*
Configuration de la base de donn�es:
Ces donn�es sont � modifier selon votre configuration MySQL !!

HOST: L'adresse du serveur
En g�n�ral, quelque chose comme: sql.monh�bergeur.com
Si la base de donn�es tourne en local: "localhost" ou "127.0.0.1"

USER: Le nom d'utilisateur
Cette information est communiqu�e par l'h�bergeur. Il peut s'agir du nom associ� au compte FTP.
En local, il s'agit en g�n�ral de l'utilisateur "root"

PASSWD: Le mot de passe associ� � l'utilisateur

BASE: Le nom de la base de donn�es
Cette information est communiqu�e par l'h�bergeur, � moins que vous ne puissiez cr�er plusieurs bases de donn�es. En local, vous pouvez choisir le nom de n'importe quelle base existante.
*/

$_config['host'] = 'localhost';
$_config['base'] = 'ajpsc_annuaire';
$_config['user'] = 'devuser';
$_config['passwd'] = 'devpwd';

/*
* AUTH
* Si cette valeur est plac�e � "1", le syst�me de protection par mot de passe est actif.
* Si elle est plac�e � "0", le syst�me est d�sactiv�.
*/
$_config['auth'] = 0;

/* ADMIN_PASSWORD
* Mot de passe pour acc�der � l'administration de l'annuaire.
*/
$_config['admin_password'] = "admin";

/*
* INT_AUTH
* Authentification intelligente: si cette option est activ�e, seules les personnes qui ont acc�s � l'espace priv� correspondand des forums vBulletin pourront acc�der au contenu de l'annuaire.
* INT_AUTH_ADDRESS
* Adresse du forum de redirection vBulletin.
*/
$_config['int_auth'] = 0;
$_config['int_auth_address'] = "";

/*
* RECHERCHE_ADMIN_ONLY
* Si activ�, seuls les administrateurs peuvent utiliser le moteur de recherche de l'annuaire. Sinon (par d�faut 0), tous les utilisateurs le peuvent
*/
$_config['recherche_admin_only'] = 0;

/* DATA_FOLDER
* Chemin vers le dossier contenant les donn�es.
* Ce dossier doit �tre accessible en �criture par le serveur.
* PAS DE SLASH A LA FIN DU CHEMIN !
*/
$_config['data_folder'] = "data";

/* PHOTOS_STORAGE
* Les photos doivent-elles �tre stock�es dans la base de donn�es ou sur le syst�me de fichiers (dans data/photos) ?
* Valeurs possibles : DB, FS
*/
$_config['photos_storage'] = "FS";

/* PAGINATION
* Indique combien d'enregistrements doivent �tre affich�s par page.
* S'il y a 10 enregistrements et que cette valeur est � 5, alors 2 pages seront cr��es.
*/
$_config['pagination'] = 20;

/* PAGINATION de la galerie
* Indique combien de photos doivent �tre affich�s par page.
* S'il y a 10 photos et que cette valeur est � 5, alors 2 pages seront cr��es.
*/
$_config['pagination_galerie'] = 9;

/* IMAGES PAR LIGNE
* Sur la page de la galerie, combien d'images doivent �tre affich�es sur chaque ligne ?
*/
$_config['images_par_ligne'] = 3;

/* LARGEUR IMAGES FICHES
* Indique la largeur des images dans les fiches individuelles, en PIXELS.
* Les images seront automatiquement redimentionn�es : la largeur sera celle indiqu�e ici, et
* la hauteur sera calcul�e en fonction de la largeur de mani�re � conserver les proportions
* de l'image d'origine.
*/
$_config['images_largeur_fiches'] = 150;

/* LARGEUR IMAGES galerie
* Indique la largeur des images de la galerie, en PIXELS.
* Les images seront automatiquement redimentionn�es : la largeur sera celle indiqu�e ici, et
* la hauteur sera calcul�e en fonction de la largeur de mani�re � conserver les proportions
* de l'image d'origine.
*/
$_config['images_largeur_galerie'] = 100;

/* TOOLTIPS
* Doit-on afficher les bulles d'aide (1) ou non (0) ?
*/
$_config['tooltips'] = 1;

/*
Choisissez ici le th�me graphique utilis�. C'est-�-dire le fichier CSS que vous d�sirez voir employ�.

Par exemple, si vous voulez le th�me ABCD, il faut placer un fichier "style.css" dans le r�petoire /themes/ABCD/

Par d�faut: valhalla
*/
$_config['theme'] = 'ajpsc';

/*
Certaines l�gislations interdisent que l'on puisse exporter tout le contenu d'une base de donn�es. Certains administrateurs peuvent vouloir emp�cher les utilisateurs d'exporter toutes les donn�es.
Si la propri�t� suivante est r�gl�e sur 1, le tout est export�.
Si elle est r�gl�e sur 0, seuls les champs nom, prenom, promotion et email seront export�s.
*/
$_config['exporter_tout'] = 1;

/*
* HTML_ALLOWED
* D�finissez ici les tags HTML qui seront accept�s. Tous les autres tags seront effac�s.
* Cela s'applique aux formulaires d'ajout et de modification d'une entr�e dans la bdd.
*/
$html_allowed = "<b><i><u><s><p><br><ul><ol><li><strong><em><blockquote><style>".
				 "<table><td><tr><span><a><h1><h2><h3><h4><h5><h6><h7><h8><h9>".
				 "<center><left><right><text>";

			/*
			* PDF
			* D�finissez ici les cha�nes de texte statiques qui seront imprim�es dans le fichier PDF
			* NOM => le nom de votre site (en-t�te)
			* TITRE => le titre de votre annuaire (en-t�te)
			* COPYRIGHT => les mentions de droits d'auteur (pied de page)
			* URL1 => Une URL (vers votre site p. ex.)
			* URL 2 => Une URL (vers votre annuaire p. ex.)
			*/
			$_config["pdf"]["nom"] = "Association des Juristes Panth�on-Sorbonne / Complutense";
			$_config["pdf"]["titre"] = "Annuaire des �tudiants - �dition ".date("Y");
			$_config["pdf"]["copyright"] = "Site Web AJPSC: http://www.ajpsc.com/ - Annuaire AJPSC: http://annuaire.ajpsc.com/ (CC 2006-".date("Y")." Guillaume Florimond)";
			$_config["pdf"]["url1"] = "http://www.ajpsc.com/";
			$_config["pdf"]["url2"] = "http://annuaire.ajpsc.com/";


?>