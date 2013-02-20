<?php
connexion();

/* $voir_id est transmise depuis index.php, juste avant l'include de voir.php */
$sql = "SELECT * FROM utilisateur WHERE id='$modifier_id'";

$req = mysql_query($sql) or die('Erreur');
$data = mysql_fetch_assoc($req);

$afficher['nom'] = stripslashes(html_vers_texte(formater_nom($data['nom'])));
$afficher['prenom'] = stripslashes(html_vers_texte(formater_nom($data['prenom'])));
$afficher['promotion'] = stripslashes(html_vers_texte($data['promotion']));
$afficher['nationalite'] = stripslashes(html_vers_texte($data['nationalite']));
$afficher['naissance'] = stripslashes(html_vers_texte(formater_date($data['naissance'],false)));
$afficher['adresse'] = stripslashes(html_vers_texte($data['adresse']));
$afficher['email'] = stripslashes(html_vers_texte($data['email']));

$afficher['q1'] = stripslashes(html_vers_texte($data['q1']));
$afficher['q2'] = stripslashes(html_vers_texte($data['q2']));
$afficher['q3'] = stripslashes(html_vers_texte($data['q3']));
$afficher['q4'] = stripslashes(html_vers_texte($data['q4']));
$afficher['q5'] = stripslashes(html_vers_texte($data['q5']));
$afficher['q6'] = stripslashes(html_vers_texte($data['q6']));
$afficher['q7'] = stripslashes(html_vers_texte($data['q7']));

$afficher['secret_question'] = stripslashes($data['secret_question']);

?>


<form name="soumettre" method="post" action="index.php?action=action_modifier" onSubmit="return completude(this);" enctype="multipart/form-data">
  <input name="id" type="hidden" value="<?php echo $modifier_id; ?>" />
  <table width="80%" border="0" align="center" cellpadding="2" cellspacing="10">
    <tr>
      <td class="question"><?php dire("c1"); ?> <span style="color:#F00">*</span></td>
      <td><input name="nom" type="text" size="60" value="<?php echo $afficher['nom']; ?>" onKeyUp="javascript:reinit_couleur(this);" /> <span class="commentaires"><?php dire("a1"); ?></span></td>
    </tr>
    <tr>
      <td class="question"><?php dire("c2"); ?> <span style="color:#F00">*</span></td>
      <td><input name="prenom" type="text" size="60" value="<?php echo $afficher['prenom']; ?>" onKeyUp="javascript:reinit_couleur(this);" /> <span class="commentaires"><?php dire("a2"); ?></span></td>
    </tr>
    <tr>
      <td class="question"><?php dire("c3"); ?> <span style="color:#F00">*</span></td>
      <td><input name="promotion" type="text" size="4" maxlength="4" value="<?php echo $afficher['promotion']; ?>" onKeyUp="javascript:reinit_couleur(this);" />
        <span class="commentaires"><?php dire("a3"); ?></span>  </td>
    </tr>
    <tr>
      <td class="question"><?php dire("c4"); ?> <span style="color:#F00">*</span></td>
      <td><input type="text" name="nationalite" value="<?php echo $afficher['nationalite']; ?>" onKeyUp="javascript:reinit_couleur(this);" /><span class="commentaires"><?php dire("a4"); ?></span></td>
    </tr>
    <tr>
      <td class="question"><?php dire("c5"); ?> <span style="color:#F00">*</span></td>
      <td><input name="naissance" type="text" size="10" maxlength="10" value="<?php echo $afficher['naissance']; ?>" onKeyUp="javascript:reinit_couleur(this);" />
        <span class="commentaires"><?php dire("a5"); ?></span></td>
    </tr>
    <tr>
      <td class="question"><?php dire("c6"); ?></td>
      <td><textarea name="adresse" cols="60" rows="3"><?php echo $afficher['adresse']; ?></textarea></td>
    </tr>
    <tr>
      <td class="question"><?php dire("c7"); ?> <span style="color:#F00">*</span></td>
      <td><input name="email" type="text" size="50" value="<?php echo $afficher['email']; ?>" onKeyUp="javascript:reinit_couleur(this);" /></td>
    </tr>
	<tr>
      <td class="question"><?php dire("c8"); ?></td>
      <td>
			<input type="hidden" name="MAX_FILE_SIZE" value="1000000" /> <!-- 1 Mb -->
			<input type="file" name="image" />
			<br /><small><?php dire("photo2"); ?></small>
	  </td>
    </tr>
    <tr>
      <td colspan="2"><span style="color:#F00">*</span>&nbsp;<span class="commentaires"><?php dire("ax"); ?></span></td>
    </tr>
    <tr class="orange">
      <td height="2" colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" class="question"><?php dire("q1"); ?></td>
    </tr>
    <tr>
      <td colspan="2"><textarea name="q1" cols="72" rows="6"><?php echo $afficher['q1']; ?></textarea></td>
    </tr>
    <tr>
      <td colspan="2" class="question"><?php dire("q2"); ?></td>
    </tr>
    <tr>
      <td colspan="2"><textarea name="q2" cols="72" rows="6"><?php echo $afficher['q2']; ?></textarea></td>
    </tr>
    <tr>
      <td colspan="2" class="question"><?php dire("q3"); ?></td>
    </tr>
    <tr>
      <td colspan="2"><textarea name="q3" cols="72" rows="6"><?php echo $afficher['q3']; ?></textarea></td>
    </tr>
    <tr>
      <td colspan="2" class="question"><?php dire("q4"); ?></td>
    </tr>
    <tr>
      <td colspan="2"><textarea name="q4" cols="72" rows="3"><?php echo $afficher['q4']; ?></textarea></td>
    </tr>
    <tr>
      <td colspan="2" class="question"><?php dire("q5"); ?></td>
    </tr>
    <tr>
      <td colspan="2"><textarea name="q5" cols="72" rows="3"><?php echo $afficher['q5']; ?></textarea></td>
    </tr>
    <tr>
      <td colspan="2" class="question"><?php dire("q6"); ?></td>
    </tr>
    <tr>
      <td colspan="2"><textarea name="q6" cols="72" rows="6"><?php echo $afficher['q6']; ?></textarea></td>
    </tr>
    <tr>
      <td colspan="2" class="question"><?php dire("q7"); ?></td>
    </tr>
    <tr>
      <td colspan="2"><textarea name="q7" cols="72" rows="12"><?php echo $afficher['q7']; ?></textarea></td>
    </tr>

	<?php if(!isadmin()) { // Si c'est un admin, il passe outre la question/réponse?>

    <tr class="orange">
      <td height="2" colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td class="commentaires" colspan="2"><?php dire("sy"); ?></td>
    </tr>
	<td class="question"><?php dire("s1"); ?></td>
      <td><?php echo $afficher['secret_question']; ?></td>
    </tr>
    <tr>
      <td class="question"><?php dire("s2"); ?> <span style="color:#F00">*</span></td>
      <td><input name="secret_reponse" type="text" size="60"></td>
    </tr>
    <tr class="orange">
      <td height="2" colspan="2">&nbsp;</td>
    </tr>

	<?php } else { ?>
		<input name="secret_reponse" type="hidden" value="">
	<?php } // fin if/else: isadmin ?>

    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" class="btn btn-large btn-success" name="Submit" value="<?php dire("o2"); ?>" />
      </div></td>
    </tr>
  </table>
</form>
