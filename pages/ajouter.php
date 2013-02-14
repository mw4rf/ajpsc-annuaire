<div class="container">
<form name="soumettre" method="post"
    class="form"
    action="index.php?action=action_ajouter"
    onSubmit="return completude(this);"
    enctype="multipart/form-data">
<fieldset>

      <label><?php dire("c1"); ?> <span style="color:#F00">*</span></label>
      <input class="span6" name="nom" type="text" size="60" onKeyUp="javascript:reinit_couleur(this);" />
      <span class="help-block"><?php dire("a1"); ?></span>

      <label><?php dire("c2"); ?> <span style="color:#F00">*</span></label>
      <input class="span6" name="prenom" type="text" size="60" onKeyUp="javascript:reinit_couleur(this);" />
      <span class="help-block"><?php dire("a2"); ?></span>

      <label><?php dire("c3"); ?> <span style="color:#F00">*</span></label>
      <input class="span1" name="promotion" type="text" size="4" maxlength="4" onKeyUp="javascript:reinit_couleur(this);" />
      <span class="help-block"><?php dire("a3"); ?></span>

      <label><?php dire("c4"); ?> <span style="color:#F00">*</span></label>
      <input class="span6" type="text" name="nationalite" onKeyUp="javascript:reinit_couleur(this);" />
	  <span class="help-block"><?php dire("a4"); ?></span>

      <label><?php dire("c5"); ?> <span style="color:#F00">*</span></label>
      <input class="span2" name="naissance" type="text" size="10" maxlength="10" onKeyUp="javascript:reinit_couleur(this);" />
      <span class="help-block"><?php dire("a5"); ?></span>

      <label><?php dire("c6"); ?></label>
      <textarea class="span6" name="adresse" cols="60" rows="3"></textarea>

      <label><?php dire("c7"); ?> <span style="color:#F00">*</span></label>
      <div class="input-prepend">
        <span class="add-on">@</span>
        <input class="span6" name="email" type="text" size="50" onKeyUp="javascript:reinit_couleur(this);" />
      </div>

      <label><?php dire("c8"); ?></label>
	  <input class="span6" type="hidden" name="MAX_FILE_SIZE" value="1000000" /> <!-- 1 Mb -->
	  <input class="span6" type="file" name="image" />
	  <span class="help-block"><?php dire("photo2"); ?></span>


    <div class="alert alert-info">
        <span style="color:#F00;font-size:2em;">*</span><?php dire("ax"); ?>
    </div>

    <label><?php dire("q1"); ?></label>
    <textarea class="span6" name="q1" cols="72" rows="6"></textarea>

    <label><?php dire("q2"); ?></label>
    <textarea class="span6" name="q2" cols="72" rows="6"></textarea>

    <label><?php dire("q3"); ?></label>
    <textarea class="span6" name="q3" cols="72" rows="6"></textarea>

    <label><?php dire("q4"); ?></label>
    <textarea class="span6" name="q4" cols="72" rows="3"></textarea>

    <label><?php dire("q5"); ?></label>
    <textarea class="span6" name="q5" cols="72" rows="3"></textarea>

    <label><?php dire("q6"); ?></label>
    <textarea class="span6" name="q6" cols="72" rows="6"></textarea>

    <label><?php dire("q7"); ?></label>
    <textarea class="span6" name="q7" cols="72" rows="12"></textarea>

    <label><?php dire("sx"); ?></label>

    <label><?php dire("s1"); ?> <span style="color:#F00">*</span></label>
    <input class="span6" name="secret_question" type="text" size="50" onKeyUp="javascript:reinit_couleur(this);" />

    <label><?php dire("s2"); ?> <span style="color:#F00">*</span></label>
    <input class="span6" name="secret_reponse" type="text" size="50" onKeyUp="javascript:reinit_couleur(this);" />

    <p><input class="btn btn-large btn-success span6" type="submit" name="Submit" value="<?php dire("o1"); ?>" /></p>
</fieldset>
</form>
</div>