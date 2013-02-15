<?php

/*
Configuration de la base de données:
Ces données sont à modifier selon votre configuration MySQL !!

HOST: L'adresse du serveur
En général, quelque chose comme: sql.monhébergeur.com
Si la base de données tourne en local: "localhost" ou "127.0.0.1"

USER: Le nom d'utilisateur
Cette information est communiquée par l'hébergeur. Il peut s'agir du nom associé au compte FTP.
En local, il s'agit en général de l'utilisateur "root"

PASSWD: Le mot de passe associé à l'utilisateur

BASE: Le nom de la base de données
Cette information est communiquée par l'hébergeur, à moins que vous ne puissiez créer plusieurs bases de données. En local, vous pouvez choisir le nom de n'importe quelle base existante.
*/

$_config['host'] = 'localhost';
$_config['base'] = 'ajpsc_annuaire';
$_config['user'] = 'devuser';
$_config['passwd'] = 'devpwd';

/*
* AUTH
* Si cette valeur est placée à "1", le système de protection par mot de passe est actif.
* Si elle est placée à "0", le système est désactivé.
*/
$_config['auth'] = 0;

/* ADMIN_PASSWORD
* Mot de passe pour accéder à l'administration de l'annuaire.
*/
$_config['admin_password'] = "admin";

/*
* INT_AUTH
* Authentification intelligente: si cette option est activée, seules les personnes qui ont accès à l'espace privé correspondand des forums vBulletin pourront accéder au contenu de l'annuaire.
* INT_AUTH_ADDRESS
* Adresse du forum de redirection vBulletin.
*/
$_config['int_auth'] = 0;
$_config['int_auth_address'] = "";

/*
* RECHERCHE_ADMIN_ONLY
* Si activé, seuls les administrateurs peuvent utiliser le moteur de recherche de l'annuaire. Sinon (par défaut 0), tous les utilisateurs le peuvent
*/
$_config['recherche_admin_only'] = 0;

/* DATA_FOLDER
* Chemin vers le dossier contenant les données.
* Ce dossier doit être accessible en écriture par le serveur.
* PAS DE SLASH A LA FIN DU CHEMIN !
*/
$_config['data_folder'] = "data";

/* PHOTOS_STORAGE
* Les photos doivent-elles être stockées dans la base de données ou sur le système de fichiers (dans data/photos) ?
* Valeurs possibles : DB, FS
*/
$_config['photos_storage'] = "FS";

/* PAGINATION
* Indique combien d'enregistrements doivent être affichés par page.
* S'il y a 10 enregistrements et que cette valeur est à 5, alors 2 pages seront créées.
*/
$_config['pagination'] = 20;

/* PAGINATION de la galerie
* Indique combien de photos doivent être affichés par page.
* S'il y a 10 photos et que cette valeur est à 5, alors 2 pages seront créées.
*/
$_config['pagination_galerie'] = 9;

/* IMAGES PAR LIGNE
* Sur la page de la galerie, combien d'images doivent être affichées sur chaque ligne ?
*/
$_config['images_par_ligne'] = 3;

/* LARGEUR IMAGES FICHES
* Indique la largeur des images dans les fiches individuelles, en PIXELS.
* Les images seront automatiquement redimentionnées : la largeur sera celle indiquée ici, et
* la hauteur sera calculée en fonction de la largeur de manière à conserver les proportions
* de l'image d'origine.
*/
$_config['images_largeur_fiches'] = 150;

/* LARGEUR IMAGES galerie
* Indique la largeur des images de la galerie, en PIXELS.
* Les images seront automatiquement redimentionnées : la largeur sera celle indiquée ici, et
* la hauteur sera calculée en fonction de la largeur de manière à conserver les proportions
* de l'image d'origine.
*/
$_config['images_largeur_galerie'] = 100;

/* TOOLTIPS
* Doit-on afficher les bulles d'aide (1) ou non (0) ?
*/
$_config['tooltips'] = 1;

/*
Choisissez ici le thème graphique utilisé. C'est-à-dire le fichier CSS que vous désirez voir employé.

Par exemple, si vous voulez le thème ABCD, il faut placer un fichier "style.css" dans le répetoire /themes/ABCD/

Par défaut: valhalla
*/
$_config['theme'] = 'ajpsc';

/*
Certaines législations interdisent que l'on puisse exporter tout le contenu d'une base de données. Certains administrateurs peuvent vouloir empêcher les utilisateurs d'exporter toutes les données.
Si la propriété suivante est réglée sur 1, le tout est exporté.
Si elle est réglée sur 0, seuls les champs nom, prenom, promotion et email seront exportés.
*/
$_config['exporter_tout'] = 1;

/*
* HTML_ALLOWED
* Définissez ici les tags HTML qui seront acceptés. Tous les autres tags seront effacés.
* Cela s'applique aux formulaires d'ajout et de modification d'une entrée dans la bdd.
*/
$html_allowed = "<b><i><u><s><p><br><ul><ol><li><strong><em><blockquote><style>".
				 "<table><td><tr><span><a><h1><h2><h3><h4><h5><h6><h7><h8><h9>".
				 "<center><left><right><text>";

			/*
			* PDF
			* Définissez ici les chaînes de texte statiques qui seront imprimées dans le fichier PDF
			* NOM => le nom de votre site (en-tête)
			* TITRE => le titre de votre annuaire (en-tête)
			* COPYRIGHT => les mentions de droits d'auteur (pied de page)
			* URL1 => Une URL (vers votre site p. ex.)
			* URL 2 => Une URL (vers votre annuaire p. ex.)
			*/
			$_config["pdf"]["nom"] = "Association des Juristes Panthéon-Sorbonne / Complutense";
			$_config["pdf"]["titre"] = "Annuaire des étudiants - édition ".date("Y");
			$_config["pdf"]["copyright"] = "Site Web AJPSC: http://www.ajpsc.com/ - Annuaire AJPSC: http://annuaire.ajpsc.com/ (CC 2006-".date("Y")." Guillaume Florimond)";
			$_config["pdf"]["url1"] = "http://www.ajpsc.com/";
			$_config["pdf"]["url2"] = "http://annuaire.ajpsc.com/";


?>