<?php
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
