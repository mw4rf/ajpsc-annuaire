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

// Valider l'enregistrement
if(isset($_GET["step"]) and $_GET["step"] == 2) {
    $pwd = $_POST['adminpwd'];
    if($pwd == $_config['admin_password']) {
        $_SESSION['isadmin'] = 1;
        // affichage
        include('admin.php');
    } else { echo "Connexion refusée"; }

}
// Afficher le formulaire de connexion
else {
?>
<div class="container well">
<form class="form text-center" method="post" action="index.php?action=adminlogin&step=2">
    <label><?php dire("mdp"); ?></label>
    <input type="password" name="adminpwd" />
    <p><input class="btn btn-small btn-info" type="submit" value="<?php dire("co"); ?>" /></p>
</form>
</div>
<?php } ?>
