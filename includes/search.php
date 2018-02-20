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
?>

<?php if(checkauth()) { // Recherche: uniquement si l'on est connecté
        if( ($_config['recherche_admin_only'] and isadmin()) or !$_config['recherche_admin_only']) {
?>
	<div id="recherche">

		<p>&nbsp;</p>

		<form name="recherche"
			   method="post" action="index.php?action=action_recherche">

		<div id="ch_recherche">
		<input id="input_recherche" name="requete"
			   type="text" size="25" value="<?php dire("menu0"); ?>" onclick="value=''"/>
		<a     href="#"
			   id = "ln_recherche"
		 onClick="javascript:menu('input_recherche','av_recherche');"
		       style="vertical-align:center;"><?php abbr("±"); ?></a>
		</div>

			<div id="av_recherche" class="menu_deroulant" style="display:none;">
			  <select name="champ" id="option_recherche">
				<option value="defaut" selected="selected"><?php dire("cx"); ?></option>
			    <option value="tous"><?php dire("c0"); ?></option>
			    <option value="nom"><?php dire("c1"); ?></option>
			    <option value="prenom"><?php dire("c2"); ?></option>
			    <option value="promotion"><?php dire("c3"); ?></option>
			    <option value="naissance"><?php dire("c5"); ?></option>
			    <option value="email"><?php dire("c7"); ?></option>
			  </select>
				<a href="index.php?action=page_aide&page=faq#7"><?php dire("menu5"); ?></a>
			</div>

		</form>

	</div>
<?php }} ?>