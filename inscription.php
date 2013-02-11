<?php
session_start();

include('includes/config.inc.php');
include('includes/phrases.php');
include('includes/fonctions.inc.php');

include('includes/header.inc.php');
?>

<div id="corps">

<form name="soumettre" method="post" action="inscription_ajouter.php" enctype="multipart/form-data">
  <table width="80%" border="0" align="center" cellpadding="2" cellspacing="10">
    <tr>
      <td class="question"><?php dire("c1"); ?> <span style="color:#F00">*</span></td>
      <td><input name="nom" type="text" size="60" onKeyUp="javascript:reinit_couleur(this);" /> <span class="commentaires"><?php dire("a1"); ?></span></td>
    </tr>
    <tr>
      <td class="question"><?php dire("c2"); ?> <span style="color:#F00">*</span></td>
      <td><input name="prenom" type="text" size="60" onKeyUp="javascript:reinit_couleur(this);" /> <span class="commentaires"><?php dire("a2"); ?></span></td>
    </tr>
    <tr>
      <td class="question"><?php dire("c3"); ?> <span style="color:#F00">*</span></td>
      <td><input name="promotion" type="text" size="4" maxlength="4" onKeyUp="javascript:reinit_couleur(this);" />
        <span class="commentaires"><?php dire("a3"); ?></span></td>
    </tr>
    <tr>
      <td class="question"><?php dire("c4"); ?> <span style="color:#F00">*</span></td>
      <td><input type="text" name="nationalite" onKeyUp="javascript:reinit_couleur(this);" />
		<span class="commentaires"><?php dire("a4"); ?></span></td>
    </tr>
    <tr>
      <td class="question"><?php dire("c5"); ?> <span style="color:#F00">*</span></td>
      <td><input name="naissance" type="text" size="10" maxlength="10" onKeyUp="javascript:reinit_couleur(this);" />
        <span class="commentaires"><?php dire("a5"); ?></span></td>
    </tr>
    <tr>
      <td class="question"><?php dire("c6"); ?></td>
      <td><textarea name="adresse" cols="60" rows="3"></textarea></td>
    </tr>
    <tr>
      <td class="question"><?php dire("c7"); ?> <span style="color:#F00">*</span></td>
      <td><input name="email" type="text" size="50" onKeyUp="javascript:reinit_couleur(this);" /></td>
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
      <td colspan="2"><textarea name="q1" cols="72" rows="6"></textarea></td>
    </tr>
    <tr>
      <td colspan="2" class="question"><?php dire("q2"); ?></td>
    </tr>
    <tr>
      <td colspan="2"><textarea name="q2" cols="72" rows="6"></textarea></td>
    </tr>
    <tr>
      <td colspan="2" class="question"><?php dire("q3"); ?></td>
    </tr>
    <tr>
      <td colspan="2"><textarea name="q3" cols="72" rows="6"></textarea></td>
    </tr>
    <tr>
      <td colspan="2" class="question"><?php dire("q4"); ?></td>
    </tr>
    <tr>
      <td colspan="2"><textarea name="q4" cols="72" rows="3"></textarea></td>
    </tr>
    <tr>
      <td colspan="2" class="question"><?php dire("q5"); ?></td>
    </tr>
    <tr>
      <td colspan="2"><textarea name="q5" cols="72" rows="3"></textarea></td>
    </tr>
    <tr>
      <td colspan="2" class="question"><?php dire("q6"); ?></td>
    </tr>
    <tr>
      <td colspan="2"><textarea name="q6" cols="72" rows="6"></textarea></td>
    </tr>
    <tr>
      <td colspan="2" class="question"><?php dire("q7"); ?></td>
    </tr>
    <tr>
      <td colspan="2"><textarea name="q7" cols="72" rows="12"></textarea></td>
    </tr>
    <tr class="orange">
      <td height="2" colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="Submit" value="<?php dire("o1"); ?>" />
      </div></td>
    </tr>
  </table>
</form>

</div>