<?php
session_start();

include('includes/config.inc.php');
include('includes/phrases.php');
include('includes/fonctions.inc.php');

/* Se connecter */
// En tant qu'utilisateur...
if(isset($_GET["action"]) and $_GET["action"] == "login")
{
	auth($_POST['pass']);
}
// En tant qu'administrateur...
if(isset($_GET["action"]) and $_GET["action"] == "adminlogin" and isset($_GET["adminpass"]) and !isadmin())
{
	adminauth($_GET['adminpass']);
}

/* Changer la langue pour la durée de la session */
if(isset($_GET["action"]) and $_GET["action"] == "action_langue")
{
	if(isset($_GET["lang"]))
	{
		changer_langue($_GET["lang"]);
	}
	else
	{
		changer_langue("fr");
	}
}

/* Changer le thème pour la durée de la session */
if(isset($_GET["action"]) and $_GET["action"] == "action_themes")
{
	if(isset($_GET["theme"]))
	{
		definir_theme($_GET["theme"]);
	}
	else
	{
		unset($_SESSION["theme_personnalise"]);
		$_SESSION["theme_personnalise"] = 0;
	}
}

/* SI L'UTILISATEUR N'EST PAS IDENTIFIÉ (MOT DE PASSE NON SAISI)*/
if(!checkauth())
{
	include('includes/header.inc.php');
	?>
	<div id="corps">
	<?php
	if(isset($_SESSION['mauvais_mdp']) and $_SESSION['mauvais_mdp'])
	{
		echo '<center>';
		message("bad-mdp");
		echo '</center><br />';
	}
	?>

	&nbsp;<p>&nbsp;</p>

	<p align="center">
		Bienvenue sur l'annuaire AJPSC.
	</p>
	<p align="center">
		L'annuaire en ligne n'est accessible qu'aux étudiants et anciens étudiants de la double-maîtrise inscrits comme tels sur les forums AJPSC.com.
	</p>

	<p align="center">
		Besoin d'aide ? Regardez la <a href="ftp://downloads.valhalla.fr/stsmhdan/ajpsc/ajpsc_annuaire.avi">vidéo de présentation</a>.
	</p>

	<?php if($_config['int_auth'] == 1) {?>
	<p align="center">
		Pour connaître le mot de passe,
		<a href="<?php echo $_config['int_auth_address']; ?>">cliquez ici</a>.
	</p>
	<?php } ?>

	<form id="login" name="login" method="post" action="index.php?action=login">
	<table width="45%" border="0" align="center" cellpadding="2" cellspacing="2">
	  <tr>
	    <td><?php dire("mdp"); ?></td>
	    <td>
			<?php if(isset($_GET['rem_auto']) and $_config['int_auth'] == 1)
				  {
					/**** ATTENTION: CECI EST UNE FAILLE DE SECURITE, LE MOT DE PASSE EST TRANSMIS EN CLAIR DANS L'URL DE LA PAGE !!!!!!!!! N'UTILISEZ CE SYSTEME QUE SI LA PROTECTION DOIT ÊTRE SOMMAIRE ET QUE LE MOT DE PASSE N'EST PAS UN "VRAI" SECRET. VOUS POUVEZ DÉSACTIVER CE SYSTÈME DANS LE FICHIER CONFIG.INC.PHP. D'un autre côté, si le mot de passe est transmis en clair par redirection depuis vBulletin, c'est que l'utilisateur a eu accès au forum de redirection vBulletin protégé par le système d'identification de vBulletin... donc ce n'est pas plus grave que lui donner le mot de passe sur un bout de papier: il est légitime à l'avoir, et s'il y a des fuites c'est qu'il aura donné ce mot de passe à des personnes qui ne sont pas censées l'avoir... */
					?>
					<input type="password"
						   name="pass"
						   value="<?php echo $_GET['rem_auto']; ?>" />

					<?php
				  }#BC0202
				  else
				  {
			?>
					<input type="text" name="pass" />
			<?php } ?>
		</td>
	  </tr>
		<tr><td colspan="2">&nbsp;</td></tr>
	  <tr>
	    <td colspan="2"><label>
	    <div align="center">
	      <input type="submit" name="Submit" value="<?php dire("co"); ?>" />
	    </div>
	    </label></td>
	  </tr>
	</table>
	</form>

	&nbsp;
	</div>
	<?php
}
else
{

include('includes/header.inc.php');
include('includes/menu.inc.php');
include('includes/back.inc.php');
?>

<div id="corps">
<?php
if(isset($_GET["action"])) /* if 2*/
{
/*
*
*     Actions
*
*/

/* Se déconnecter */
if($_GET["action"] == "logout")
{
	$_SESSION = array();
	message("deco");
}

/* Ajouter une fiche */
elseif($_GET["action"] == "action_ajouter")
{
	/* Appel de la fonction */
	$id = ajouter($_POST);
	/* Photo */
	if(!empty($_FILES['image']) and $id != "erreur")
		ajouter_photo($_FILES,$id);
}

/* Modifier une fiche */
elseif($_GET["action"] == "action_modifier")
{
	/* Appel de la fonction */
	modifier($_POST);
	/* Photo */
	modifier_photo($_FILES,$_POST['id']);
	/* Ok: re-afficher la fiche pour que l'utilisateur puisse voir les modifs */
	$voir_id = $_POST["id"];
	include("pages/voir.php");
}

/* Supprimer une fiche */
elseif($_GET["action"] == "action_supprimer")
{
	// Si id et op sont définis, on peut procéder
	if(isset($_GET['id']) and isset($_GET["op"]) and is_numeric($_GET['id']))
	{
		// Récupération de l'id de la fiche
		$id = $_GET['id'];
		// Récupération de l'opération (confirmation ou suppression)
		$op = $_GET["op"];
		// On procède
		include("pages/supprimer.php");
	}
	// Si id et op ne sont pas définis, on affiche le message d'erreur...
	else { message("err-sup"); }
}

/* Effectuer une recherche */
elseif($_GET["action"] == "action_recherche")
{
	include('pages/recherche.php');
}

/*
*
*    Affichage des pages
*
*/

/* Afficher la liste des utilisateurs */
elseif($_GET["action"] == "page_liste")
{
	if(!isset($_GET["x"]))
	{
		$x = 0;
		include('pages/liste.php');
	}
	else
	{
		$x = $_GET["x"];
		include('pages/liste.php');
	}

}

/* galerie */
elseif($_GET["action"] == "galerie")
{
	if(!isset($_GET["x"]))
	{
		$x = 0;
		include('pages/galerie.php');
	}
	else
	{
		$x = $_GET["x"];
		include('pages/galerie.php');
	}
}

/* Afficher la page d'ajout d'utilisateur */
elseif($_GET["action"] == "page_ajouter")
{
	include('pages/ajouter.php');
}

/* Voir la page d'un utilisateur */
elseif($_GET["action"] == "page_voir" and is_numeric($_GET['id']))
{
	$voir_id = $_GET['id'];
	include("pages/voir.php");
}

/* Voir la page de modification d'un utilisateur */
elseif($_GET["action"] == "page_modifier"  and is_numeric($_GET['id']))
{
	$modifier_id = $_GET['id'];
	include("pages/modifier.php");
}

/* Afficher la page d'accueil après la connexion */
elseif($_GET["action"] == "login")
{
	include("pages/accueil.php");
}

// Aide
elseif($_GET["action"] == "page_aide")
{
	if(!isset($_GET["page"]))
	{
		message("aideerr");
	}
	elseif($_GET["page"] == "about")
	{
		include("aide/about.php");
	}
	elseif($_GET["page"] == "faq")
	{
		include("aide/faq.php");
	}
	elseif($_GET["page"] == "historique")
	{
		include("aide/historique.php");
	}
}

// Administration
elseif($_GET["action"] == "adminlogin" and !isadmin())
{
    include("admin/adminlogin.php");
}
elseif($_GET["action"] == "adminlogin" and isadmin())
{
	include("admin/admin.php");
}
elseif($_GET["action"] == "admin" and isadmin())
{
	include("admin/admin.php");
}
elseif($_GET["action"] == "admindeco" and isadmin())
{
	$_SESSION["isadmin"] = null;
	?>
    <div class="container well text-center">
    <?php
        message("admin_deco");
    ?>
    </div>
    <?php
}

} /* if 2 */

/* Afficher la page d'accueil si aucune action n'est définie */
else
{
	include("pages/accueil.php");
}

/* Préserver le &nbsp; => hack pour éliminer un espace blanc entre div:corps et div:footer */
?>
&nbsp;
</div>
<?php
} // fin checkauth

/*NB: il ne doit pas y avoir de paragraphe HTML <p></p> dans le code avant l'inclusion du footer, sinon cela fait une ligne blanche minable entre le background gris du corps et le background orange du footer !*/
include('includes/footer.inc.php');
?>