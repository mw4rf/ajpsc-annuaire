<?php
/* Protection première: isadmin()*/
if(!isadmin())
{
	dire("admin_badauth");
}
else //if(!isadmin())
{
// Inclure le fichier contenant les fonctions d'administration
include("admin/adminfct.php");
?>

<!-- En-tête -->
<div class="container hero-unit">
  <h1><?php dire("admin_accueil"); ?></h1>
  <p style="color:#FF0000;"><?php dire("admin_accueil2"); ?></p>
  <p>
    <a class="btn btn-large btn-inverse" href="index.php?action=admindeco"><?php dire("admin_menu0a"); ?></a>
  </p>
</div>

<!-- Conteneur principal -->
<div class="container">
<ol>

<!-- 2. Statistiques -->
<li>
	<p>
		<span class="admintitre">
			<?php dire("admin_menu3a"); ?>
		</span>
		<br />
		<span class="adminsoustitre"><?php dire("admin_menu3b"); ?></span>
	</p>
		<!-- Liste des statistiques (conteneur principal) -->
		<ul>
			<?php connexion(); ?>

			<!-- Nombre de fiches -->
			<li>
				<?php
				dire("admin_menu3_1");
				//Combien d'enregistrements au total dans la table ? Réponse: $t
				$sql = "SELECT * FROM utilisateur;";
				$req = mysql_query($sql);
				$t = mysql_num_rows($req);
				echo ": ".$t;
				?>
			</li>

			<!-- Taille de la base de données -->
			<li>
				<?php
				dire("admin_menu3_6");

				$sql = "SHOW TABLE STATUS;";
				$result = mysql_query($sql);
				$dbSize = 0; // quelle taille ?
				while ($row = mysql_fetch_array($result))
			 	{
			 		$dbSize += $row['Data_length'] + $row['Index_length'];
			 	}
				$dbSizeKo = file_size_info($dbSize);

				echo ": ".$dbSizeKo['size']." ".$dbSizeKo['type']." ($dbSize Octets)";
				?>
			</li>

			<!-- Dernière fiche modifiée -->
			<li>
				<?php
				dire("admin_menu3_2");
				$sql = "SELECT * FROM utilisateur ORDER BY modif DESC;";
				$req = mysql_query($sql);
				while($data = mysql_fetch_assoc($req))
				{
					$id = $data["id"];
					$modif = formater_date($data["modif"],false);
					$nom = $data["nom"];
					$prenom = $data["prenom"];

					echo ": <a href=\"index.php?action=page_voir&id=$id\">$prenom $nom</a> ($modif)";
					break;
				}
				?>
			</li>

			<!-- Adresse IP -->
			<li>
				<?php
				dire("admin_menu3_3");
				echo ": ".$_SERVER["REMOTE_ADDR"];
				?>
			</li>

			<!-- Server Software -->
			<li>
				<?php
				dire("admin_menu3_4");
				echo ": ".$_SERVER["SERVER_SOFTWARE"];
				?>
			</li>

			<!-- Langue -->
			<li>
				<?php
				dire("admin_menu3_5");
				echo ": ".$_SERVER["HTTP_ACCEPT_LANGUAGE"];
				?>
			</li>
		</ul>
</li>

<!-- 3. Version Papier -->
<li>
	<p>
		<span class="admintitre">
			<?php dire("admin_menu4a"); ?>
		</span>
		<br />
		<span class="adminsoustitre"><?php dire("admin_menu4b"); ?></span>
	</p>
	<ol>
		<!-- Aide -->
		<li>
			<a href="index.php?action=page_aide&page=faq#8.8"><?php dire("admin_menu4_0"); ?></a>
		</li>
		<!-- Exportation MySQL -->
		<li>
			<a href="export/csvexport.php"><?php dire("admin_menu4_1"); ?></a>
		</li>

		<!-- Modèles MS Word -->
		<li>
			<a href="msword/"><?php dire("admin_menu4_2"); ?></a>
		</li>
	</ol>
</li>

<!-- 4. Générer le hash SHA1 -->
<li>
	<p>
		<span class="admintitre"><?php dire("admin_menu1a"); ?></span>
		<br />
		<span class="adminsoustitre"><?php dire("admin_menu1b"); ?></span>
	</p>
	<form id="sha1" name="sha1" method="post" action="index.php?action=admin&op=sha1">
	  <input name="sha1phrase" type="text" size="30"
	         value="<?php if(isset($_POST["sha1phrase"]))
	                      { echo stripslashes($_POST["sha1phrase"]); }
	                ?>"
	  />
	  <input type="submit" name="Submit" value="<?php dire("admin_menu1c"); ?>" />
	</form>

	<?php
	// On affiche le hash sha1 après soumission du formulaire
	if(isset($_GET["op"]) and isset($_POST["sha1phrase"]) and $_GET["op"] == "sha1")
	{
	?>
	<p>
		<?php dire("admin_resultat"); ?>:&nbsp;
		<span class="adminresultat">
		<?php echo sha1(stripslashes($_POST["sha1phrase"])); ?>
		</span>
	</p>
	<?php
	}
	?>
</li>

<!-- 5. Insérer le hash SHA1 (réponse secrète) -->
<li>
	<p>
		<span class="admintitre"><?php dire("admin_menu2a"); ?></span>
		<br />
		<span class="adminsoustitre"><?php dire("admin_menu2b"); ?></span>
	</p>
	<form id="sha1" name="sha1" method="post" action="index.php?action=admin&op=repsecrt">
	  <?php dire("admin_menu2c"); ?>&nbsp;
	  <input
			name="sha1hash"
			type="text"
			size="50"
			value="<?php
						if(isset($_POST["sha1phrase"]))
						{ echo sha1(stripslashes($_POST["sha1phrase"])); }
				  ?>" />
	  <br />
	  <?php dire("admin_menu2d"); ?>
	  <input name="iduser" type="text" size="5" />
	  <br />
	  <input type="submit" name="Submit" value="<?php dire("admin_menu2e"); ?>" />
	</form>

	<?php
	// On affiche le résultat après soumission du formulaire
	if(isset($_GET["op"]) and isset($_POST["sha1hash"]) and isset($_POST["iduser"])
	and $_GET["op"] == "repsecrt")
	{
		if(changer_reponse_secrete($_POST["sha1hash"], $_POST["iduser"]))
		{
	?>
		<p>
			<?php dire("admin_resultat"); ?>:&nbsp;
			<span class="adminresultat">
			<?php dire("admin_menu2f"); ?>
			</span>
		</p>
	<?php
		}
		else
		{
			dire("admin_erreur");
		}
	}
	?>
</li>





<!-- FIN conteneur principal -->
</div>
<?php

//--
}
?>