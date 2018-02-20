<?php
//        Annuaire Alumnii
//        Base de données et annuaire d'anciens étudiants.
//        Copyright (C) <2006>  <Guillaume Florimond>    

//        This program is free software: you can redistribute it and/or modify
//        it under the terms of the GNU General Public License as published by
//        the Free Software Foundation, either version 3 of the License, or
//        (at your option) any later version.    

//        This program is distributed in the hope that it will be useful,
//        but WITHOUT ANY WARRANTY; without even the implied warranty of
//        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//        GNU General Public License for more details.    

//        You should have received a copy of the GNU General Public License
//        along with this program.  If not, see <https://www.gnu.org/licenses/>. 


// Première phase: on demande confirmation
if($op == "phase1")
{
	?>

	<div align="center">

		<?php
				if(isadmin()) {
					$urlsp = "index.php?action=action_supprimer&op=phase3&id=$id";
				} else {
					$urlsp = "index.php?action=action_supprimer&op=phase2&id=$id";
				}
		 ?>

		<a href = "<?php echo $urlsp; ?>">
			<?php
				dire("conf-sup");
			?>
		</a>
	</div>

	<?php
}

// Deuxième phase: on demande la réponse à la question secrète...
else if($op == "phase2")
{
	connexion();
	$sql = "SELECT secret_question FROM utilisateur WHERE id='$id'";
	$req = mysql_query($sql) or die('Erreur');
	$dat = mysql_fetch_assoc($req);
	$question = $dat["secret_question"];
	?>
	<form name="supprimer" method="post" action="index.php?action=action_supprimer&op=phase3&id=<?php echo $id; ?>">
	  <table width="50%" border="0" align="center" cellpadding="2" cellspacing="2">
	    <tr>
	      <td colspan="2" align="center">&nbsp;</td>
	    </tr>
		<tr>
	      <td class="question"><?php dire("s1"); ?></td>
	      <td><?php echo $question; ?></td>
	    </tr>
	    <tr>
	      <td class="question"><?php dire("s2"); ?></td>
	      <td>
	      <input type="text" name="secret_reponse" size="60" />
	      </td>
	    </tr>
	    <tr>
	      <td colspan="2" align="center">&nbsp;</td>
	    </tr>
	    <tr>
	      <td colspan="2" align="center">
	        <input type="submit" name="Submit" value="<?php dire("menu2d"); ?>" />
	      </td>
	    </tr>
	  </table>
	</form>
	<?php
}

// Troisième phase: on supprime l'enregistrement
else if($op == "phase3")
{
	//Premier cas: administrateur => procédure rapide
	if(isadmin())
	{
		supprimer($id);
		message("ok-sup");
		return;
	}

	//Deuxième cas: utilisateur normal => procédure normale
	// On vérifie que la réponse donnée à la phase 2 est exacte.
	connexion();
	$sql = "SELECT secret_reponse FROM utilisateur WHERE id='$id'";
	$req = mysql_query($sql) or die('Erreur');
	$dat = mysql_fetch_assoc($req);
	if($dat["secret_reponse"] != sha1($_POST["secret_reponse"]))
	{
		message("sr");
		return; // Si cela ne correspond pas, on sort. Sinon, on continue.
	}
	else
	{
		supprimer($id);
		message("ok-sup");
	}
}


?>