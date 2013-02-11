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
?>

<!-- Menu principal -->
<div id="menu">
	<ul>
		<li>
			<a href="index.php">
				<img src="themes/<?php echo obtenir_theme(); ?>/icones/m-accueil.png"
					 alt="accueil"
					 align="absmiddle" />
				<?php dire("menu_a"); ?>
			</a>
		</li>

		<li>
			<a href="index.php?action=logout">
				<img src="themes/<?php echo obtenir_theme(); ?>/icones/m-deconnexion.png"
					 alt="deconnexion"
					 align="absmiddle" />
				<?php dire("menu1"); ?>
			</a>
		</li>

		<li>
			<a href="index.php?action=page_liste">
				<img src="themes/<?php echo obtenir_theme(); ?>/icones/m-voir.png"
					 alt="liste"
					 align="absmiddle" />
				<?php dire("menu2b"); ?>
			</a>
		</li>

		<li id="galerie">
			<a href="#" onClick="javascript:menu('galerie', 'galerie_menu');">
				<img src = "themes/<?php echo obtenir_theme(); ?>/fleche.png" />
				<?php abbr("menu7"); ?>
			</a>
		</li>

		<li id="fiches">
			<a href="#" onClick="javascript:menu('fiches', 'fiches_menu');">
				<img src = "themes/<?php echo obtenir_theme(); ?>/fleche.png" />
				<?php abbr("menu2"); ?>
			</a>
		</li>

		<li id="export">
			<a href="#" onClick="javascript:menu('export', 'export_menu');">
				<img src = "themes/<?php echo obtenir_theme(); ?>/fleche.png" />
				<?php abbr("menu6"); ?>
			</a>
		</li>

		<li id="langue">
			<a href="#" onClick="javascript:menu('langue', 'langue_menu');">
				<img src = "themes/<?php echo obtenir_theme(); ?>/fleche.png" />
				<?php abbr("menu3"); ?>
			</a>
		</li>

		<li id="themes">
			<a href="#" onClick="javascript:menu('themes', 'themes_menu');">
				<img src = "themes/<?php echo obtenir_theme(); ?>/fleche.png" />
				<?php abbr("menu4"); ?>
			</a>
		</li>

		<li id="aide">
			<a href="#" onClick="javascript:menu('aide', 'aide_menu');">
				<img src = "themes/<?php echo obtenir_theme(); ?>/fleche.png" />
				<?php abbr("menu5"); ?>
			</a>
		</li>

	</ul>

	<?php
	/* Afficher le lien de retour vers les résultats de la recherche  */
	if(isset($_GET["action"])
		and $_GET["action"] == "page_voir"
		and isset($_SESSION["searchquery-rq"])
		and isset($_SESSION["searchquery-ch"])
		and isset($_GET["prov"])
		and $_GET["prov"]=="search")
	{
		echo "<br />
		<center>
			<a href=\"index.php?action=action_recherche&searchquery=1\">
				".abbr2("retour_recherche")."
			</a>
		</center>";
	}
	?>
</div>

<!-- Sous-menu::Aide -->
<div id="aide_menu" class="menu_deroulant" style="display:none;">
	<ul>
		<li>
			<a href="index.php?action=page_aide&page=about">
				<img src="themes/<?php echo obtenir_theme(); ?>/icones/about.png"
					 alt="about"
					 align="absmiddle" />
				<?php dire("menu5a"); ?>
			</a>
		</li>
		<li>
			<a href="index.php?action=page_aide&page=faq">
				<img src="themes/<?php echo obtenir_theme(); ?>/icones/faq.png"
					 alt="faq"
					 align="absmiddle" />
				<?php dire("menu5b"); ?>
			</a>
		</li>
		<li>
			<a href="index.php?action=page_aide&page=historique">
				<img src="themes/<?php echo obtenir_theme(); ?>/icones/historique.png"
					 alt="historique"
					 align="absmiddle" />
				<?php dire("menu5c"); ?>
			</a>
		</li>
		<li>
			<a href="#" onclick="javascript:location='http://www.ajpsc.com/forum/forumdisplay.php?f=73'">
				<img src="themes/<?php echo obtenir_theme(); ?>/icones/administration.png"
					 alt="administration"
					 align="absmiddle" />
				<?php abbr("menu5d"); ?>
			</a>
		</li>
	</ul>
</div>

<!-- Sous-menu::Themes -->
<div id="themes_menu" class="menu_deroulant" style="display:none;">
	<ul>
		<?php
		$dossiers = parcourir_dossier('themes/');
		if($dossiers) /* La fonction renvoie FALSE en cas d'échec */
		{
			foreach ($dossiers as $theme)
			{
				?>
				<li>
					<a href="index.php?action=action_themes&theme=<?php echo $theme; ?>">
						<img src="themes/<?php echo $theme; ?>/preview.jpg"
							 alt="<?php echo $theme; ?> prévisualisation"
							 align="absmiddle" />
						<?php /*echo formater_nom($theme);*/ ?>
					</a>
				</li>
				<?php
			}
		}

		?>
	</ul>
</div>

<!-- Sous-menu::Langue -->
<div id="langue_menu" class="menu_deroulant" style="display:none;">
	<ul>
		<li>
			<a href="index.php?action=action_langue&lang=fr">
				<img src="themes/<?php echo obtenir_theme(); ?>/icones/fr.png"
					 alt="fr"
					 align="absmiddle" />
				<?php dire("menu3a"); ?>
			</a>
		</li>
		<li>
			<a href="index.php?action=action_langue&lang=es">
				<img src="themes/<?php echo obtenir_theme(); ?>/icones/es.png"
					 alt="es"
					 align="absmiddle" />
				<?php dire("menu3b"); ?>
			</a>
		</li>
		<li>
			<a href="index.php?action=action_langue&lang=en">
				<img src="themes/<?php echo obtenir_theme(); ?>/icones/en.png"
					 alt="en"
					 align="absmiddle" />
				<?php dire("menu3c"); ?>
			</a>
		</li>
	</ul>
</div>

<!-- Sous-menu::galerie -->
<div id="galerie_menu" class="menu_deroulant" style="display:none;">
	<ul>
		<li>
			<a href="index.php?action=galerie&tri=pr-desc">
				<img src="themes/<?php echo obtenir_theme(); ?>/icones/galerie.png"
					 alt="galerie par promotion"
					 align="absmiddle" />
				<?php dire("menu7a"); ?>
			</a>
		</li>
		<li>
			<a href="index.php?action=galerie&tri=n-asc">
				<img src="themes/<?php echo obtenir_theme(); ?>/icones/galerie.png"
					 alt="galerie par nom"
					 align="absmiddle" />
				<?php dire("menu7b"); ?>
			</a>
		</li>
	</ul>
</div>

<!-- Sous-menu::Fiches -->
<div id="fiches_menu" class="menu_deroulant" style="display:none;">
	<ul>
		<li>
			<a href="index.php?action=page_ajouter">
				<img src="themes/<?php echo obtenir_theme(); ?>/icones/ajouter.png"
				 	 alt="ajouter"
				 	 align="absmiddle" />
				<?php dire("menu2a"); ?>
			</a>
		</li>

		<?php if(isset($_GET["action"]) and $_GET['action'] == "page_voir" and is_numeric($_GET['id'])) {?>
		<li>
			<a href="index.php?action=page_modifier&id=<?php echo $_GET['id']; ?>">
				<img src="themes/<?php echo obtenir_theme(); ?>/icones/modifier.png"
				 	 alt="modifier"
				 	 align="absmiddle" />
				<?php dire("menu2c"); ?>
			</a>
		</li>

		<li>
			<a href="index.php?action=action_supprimer&op=phase1&id=<?php echo $_GET['id']; ?>">
			<img src="themes/<?php echo obtenir_theme(); ?>/icones/supprimer.png"
			 	 alt="supprimer"
			 	 align="absmiddle" />
			<?php dire("menu2d"); ?>
		</a>
		</li>

		<li>&nbsp;</li>
		<?php } ?>

		<?php if(isset($_GET["action"]) and $_GET['action'] == "action_modifier") {?>
		<li>
			<a href="index.php?action=page_modifier&id=<?php echo $_POST['id']; ?>">
				<img src="themes/<?php echo obtenir_theme(); ?>/icones/modifier.png"
				 	 alt="modifier"
				 	 align="absmiddle" />
				<?php dire("menu2c"); ?>
			</a>
		</li>

		<li>
			<a href="index.php?action=action_supprimer&op=phase1&id=<?php echo $_POST['id']; ?>">
			<img src="themes/<?php echo obtenir_theme(); ?>/icones/supprimer.png"
			 	 alt="supprimer"
			 	 align="absmiddle" />
			<?php dire("menu2d"); ?>
		</a>
		</li>

		<li>&nbsp;</li>
		<?php } ?>

		<?php
			// Si aucun des deux IF au dessus n'est exécuté, il faut ajouter un <li> vide
			if(!isset($_GET['action']) or
					  $_GET['action'] != "page_voir" or
					  $_GET['action'] != "action_modifier") {?>
			<li>&nbsp;</li>
		<?php } ?>

		<li>
			<a href="index.php?action=page_liste&tri=maj">
				<img src="themes/<?php echo obtenir_theme(); ?>/icones/actualisation.png"
				 	 alt="actualisation"
				 	 align="absmiddle" />
				<?php dire("menu2i");?>
			</a>
		</li>

		<li>
			<a href="index.php?action=page_liste&tri=n-asc">
				<img src="themes/<?php echo obtenir_theme(); ?>/icones/voir.png"
				 	 alt="tri"
				 	 align="absmiddle" />
				<?php dire("menu2e");?>
			</a>
		</li>

		<li>
			<a href="index.php?action=page_liste&tri=n-desc">
				<img src="themes/<?php echo obtenir_theme(); ?>/icones/voir.png"
				 	 alt="tri"
				 	 align="absmiddle" />
				<?php dire("menu2f");?>
			</a>
		</li>

		<li>
			<a href="index.php?action=page_liste&tri=pr-asc">
				<img src="themes/<?php echo obtenir_theme(); ?>/icones/voir.png"
				 	 alt="tri"
				 	 align="absmiddle" />
				<?php dire("menu2g");?>
			</a>
		</li>

		<li>
			<a href="index.php?action=page_liste&tri=pr-desc">
				<img src="themes/<?php echo obtenir_theme(); ?>/icones/voir.png"
				 	 alt="tri"
				 	 align="absmiddle" />
				<?php dire("menu2h");?>
			</a>
		</li>

	</ul>
</div>

<!-- Sous-menu::Exportation -->
<div id="export_menu" class="menu_deroulant" style="display:none;">
	<ul>

	<?php
	/* CAS n°1 => Affichage d'une fiche                                               */
	if(isset($_GET['action']) and $_GET['action'] == "page_voir" and is_numeric($_GET['id'])) {?>

	<!-- Imprimer la fiche courante -->
	<li>
		<a href="export/imprimer.php?id=<?php echo $_GET['id']; ?>">
		<img src="themes/<?php echo obtenir_theme(); ?>/icones/imprimer.png"
		 	 alt="imprimer"
		 	 align="absmiddle" />
		<?php dire("menu6e"); ?>
		</a>
	</li>

	<!-- Génération de PDF à la volée: 1 fiche -->
	<li>
		<a href="export/pdfexport.php?pdf=fiche&id=<?php echo $_GET['id']; ?>">
		<img src="themes/<?php echo obtenir_theme(); ?>/icones/pdf.png"
		 	 alt="pdf"
		 	 align="absmiddle" />
		<?php dire("menu6pdf2"); ?>
		</a>
	</li>

	<li>&nbsp;</li>
	<?php } ?>

	<?php if(!isset($_GET['action']) or $_GET['action'] != "action_recherche"){ ?>

	<!-- Génération de PDF à la volée: tout l'annuaire -->
	<li>
		<a href="export/pdfexport.php?pdf=tout">
		<img src="themes/<?php echo obtenir_theme(); ?>/icones/pdf.png"
		 	 alt="pdf"
		 	 align="absmiddle" />
		<?php dire("menu6pdf1"); ?>
		</a>
	</li>

	<li>&nbsp;</li>
	<?php } ?>

	<?php
	/* CAS n°2 => Affichage des résultats de recherche                                */
	if(isset($_GET['action']) and $_GET['action'] == "action_recherche") {?>

	<!-- Génération de PDF à la volée: résultats de la recherche -->
	<li>
		<a href="export/pdfexport.php?pdf=recherche">
		<img src="themes/<?php echo obtenir_theme(); ?>/icones/pdf.png"
		 	 alt="pdf"
		 	 align="absmiddle" />
		<?php dire("menu6pdf3"); ?>
		</a>
	</li>

	<!-- Imprimer les résultats de la recherche -->
	<li>
		<a href="export/imprimer.php">
		<img src="themes/<?php echo obtenir_theme(); ?>/icones/imprimer.png"
		 	 alt="imprimer"
		 	 align="absmiddle" />
		<?php dire("menu6k"); ?>
		</a>
	</li>

	<!-- Exporter les résultats de la recherche (CSV) -->
	<li>
		<a href="export/csvexport.php">
		<img src="themes/<?php echo obtenir_theme(); ?>/icones/exporter.png"
		 	 alt="exporter"
		 	 align="absmiddle" />
		<?php dire("menu6b"); ?>
		</a>
	</li>

	<!-- Exporter les résultats de la recherche (XLS) -->
	<li>
		<a href="export/xlsexport.php">
		<img src="themes/<?php echo obtenir_theme(); ?>/icones/exporter.png"
		 	 alt="exporter"
		 	 align="absmiddle" />
		<?php dire("menu6d"); ?>
		</a>
	</li>

	<!-- Exporter les résultats de la recherche (XML) -->
	<li>
		<a href="export/xmlexport.php">
		<img src="themes/<?php echo obtenir_theme(); ?>/icones/exporter.png"
		 	 alt="exporter"
		 	 align="absmiddle" />
		<?php dire("menu6j"); ?>
		</a>
	</li>
	<li>&nbsp;</li>
	<?php } ?>

	<!-- Exportation rapide (CSV) -->
	<li>
		<a href="export/csvexport.php?tout=0">
			<img src="themes/<?php echo obtenir_theme(); ?>/icones/exporter.png"
			 	 alt="exporter"
			 	 align="absmiddle" />
			<?php dire("menu6l"); ?>
		</a>
	</li>

	<!-- Exportation rapide (XLS) -->
	<li>
		<a href="export/xlsexport.php?tout=0">
			<img src="themes/<?php echo obtenir_theme(); ?>/icones/exporter.png"
			 	 alt="exporter"
			 	 align="absmiddle" />
			<?php dire("menu6m"); ?>
		</a>
	</li>

	<!-- Exportation rapide (XML) -->
	<li>
		<a href="export/xmlexport.php?tout=0">
			<img src="themes/<?php echo obtenir_theme(); ?>/icones/exporter.png"
			 	 alt="exporter"
			 	 align="absmiddle" />
			<?php dire("menu6n"); ?>
		</a>
	</li>

	<li>&nbsp;</li>

	<?php if($_config['exporter_tout'] == 1) { ?>

	<!-- Exporter tout (CSV) -->
	<li>
		<a href="export/csvexport.php?tout=1">
			<img src="themes/<?php echo obtenir_theme(); ?>/icones/exporter.png"
			 	 alt="exporter"
			 	 align="absmiddle" />
			<?php dire("menu6a"); ?>
		</a>
	</li>

	<!-- Exporter tout (XLS) -->
	<li>
		<a href="export/xlsexport.php?tout=1">
			<img src="themes/<?php echo obtenir_theme(); ?>/icones/exporter.png"
			 	 alt="exporter"
			 	 align="absmiddle" />
			<?php dire("menu6c"); ?>
		</a>
	</li>

	<!-- Exporter tout (XML) -->
	<li>
		<a href="export/xmlexport.php?tout=1">
			<img src="themes/<?php echo obtenir_theme(); ?>/icones/exporter.png"
			 	 alt="exporter"
			 	 align="absmiddle" />
			<?php dire("menu6i"); ?>
		</a>
	</li>

	<li>&nbsp;</li>
	<?php } ?>

	<!-- Imprimer tout -->
	<li>
		<a href="export/imprimer.php?tout=1">
			<img src="themes/<?php echo obtenir_theme(); ?>/icones/imprimer.png"
			 	 alt="imprimer"
			 	 align="absmiddle" />
			<?php dire("menu6f"); ?>
		</a>
	</li>

	<!-- Imprimer tout, trier par PROMOTION -->
	<li>
		<a href="export/imprimer.php?tout=1&tri=pr">
			<img src="themes/<?php echo obtenir_theme(); ?>/icones/imprimer.png"
			 	 alt="imprimer"
			 	 align="absmiddle" />
			<?php dire("menu6g"); ?>
		</a>
	</li>

	<!-- Imprimer tout, trier par NOM -->
	<li>
		<a href="export/imprimer.php?tout=1&tri=nm">
			<img src="themes/<?php echo obtenir_theme(); ?>/icones/imprimer.png"
			 	 alt="imprimer"
			 	 align="absmiddle" />
			<?php dire("menu6h"); ?>
		</a>
	</li>
	</ul>
</div>

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
	message("admin_deco");
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


// Div spécial pour indiquer qu'on est en mode administration.
if(isadmin())
{
	?><div id="admin">MODE ADMINISTRATION</div><?php
}

?>