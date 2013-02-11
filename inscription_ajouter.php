<?php
//error_reporting(E_ALL);
session_start();

include('includes/config.inc.php');
include('includes/phrases.php');
include('includes/fonctions.inc.php');

include('includes/header.inc.php');

if(!empty($_POST)){

	// Connexion
	$db = mysql_connect($_config["host"], $_config["user"], $_config["passwd"]);
	mysql_select_db($_config["base"],$db);

	/* Collecte des données depuis le formulaire */
	/* Cela permettra de manipuler ces données, p. ex. pour contrôler leur conformité */
	$data["nom"] = addslashes(texte_vers_html(formater_nom($_POST["nom"])));
	$data["prenom"] = addslashes(texte_vers_html(formater_nom($_POST["prenom"])));
	$data["promotion"] = addslashes(texte_vers_html($_POST["promotion"]));
	$data["nationalite"] = addslashes(texte_vers_html($_POST["nationalite"]));
	$data["naissance"] = addslashes(texte_vers_html(formater_date($_POST["naissance"])));
	$data["adresse"] = addslashes(texte_vers_html($_POST["adresse"]));
	$data["email"] = addslashes(texte_vers_html($_POST["email"]));

	$data["q1"] = addslashes(texte_vers_html($_POST["q1"]));
	$data["q2"] = addslashes(texte_vers_html($_POST["q2"]));
	$data["q3"] = addslashes(texte_vers_html($_POST["q3"]));
	$data["q4"] = addslashes(texte_vers_html($_POST["q4"]));
	$data["q5"] = addslashes(texte_vers_html($_POST["q5"]));
	$data["q6"] = addslashes(texte_vers_html($_POST["q6"]));
	$data["q7"] = addslashes(texte_vers_html($_POST["q7"]));

	$data["secret_question"] = rand() + "--" + rand() + "--" + rand() + "--" + rand() + "--" + rand();
	$data["secret_reponse"] = sha1(rand() + "--" + rand() + "--" + rand() + "--" + rand() + "--" + rand());

	/* Le champ "modif" représente la date de la dernière modification de la fiche, aujourd'hui*/
	$modif = date("Y-m-d");

	/* Formulation de la requête */
	$sql = "INSERT INTO utilisateur (nom, prenom, promotion, nationalite, naissance, adresse, email, q1, q2, q3, q4, q5, q6, q7, secret_question, secret_reponse, modif) VALUES ('".$data["nom"]."', '".$data["prenom"]."', '".$data["promotion"]."', '".$data["nationalite"]."', '".$data["naissance"]."', '".$data["adresse"]."', '".$data["email"]."', '".$data["q1"]."', '".$data["q2"]."', '".$data["q3"]."', '".$data["q4"]."', '".$data["q5"]."', '".$data["q6"]."', '".$data["q7"]."', '".$data["secret_question"]."', '".$data["secret_reponse"]."', '$modif');";

	/* Exécution de la requête */
	@mysql_query($sql);

	/* Récupération de l'id de l'enregistrement créé */
	$sql = "SELECT id FROM utilisateur ORDER BY id DESC";
	$req = @mysql_query($sql);
	while($data = mysql_fetch_assoc($req))
		$id = $data['id'];

	//echo "id debug: $id";

	/* Photo */
	if(!empty($_FILES['image']) and is_numeric($id)) {
		@list($width, $height, $imgtype, $strtag) = getimagesize($_FILES['image']['tmp_name']);

		switch($imgtype)
		{
			case 1: $ext = 'gif'; break;
			case 2: $ext = 'jpeg'; break;
			case 3: $ext = 'png'; break;
			default: $ext = false; break;
		}

		$imgdata = file_get_contents($_FILES['image']['tmp_name']);
		$imgdata = addslashes($imgdata); // mysql_real_escape_string seems broken on some configurations...

		if(!empty($imgdata)) {
			$sql = "INSERT INTO photo SET id='', user_id='$id', photo='$imgdata', extension='$ext', height='$height', width='$width'";
			@mysql_query($sql);
		}
	}

	?>
		<div id="corps">Votre fiche a bien &eacute;t&eacute; enregistr&eacute;e, merci !</div>
	<?php

} else {

	?>
		Vous ne pouvez pas appeler cette page directement.
	<?php

}

?>