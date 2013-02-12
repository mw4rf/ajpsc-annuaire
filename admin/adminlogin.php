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
<form method="post" action="index.php?action=adminlogin&step=2">
    <table width="45%" border="0" align="center" cellpadding="2" cellspacing="2">
        <tr>
            <td><?php dire("mdp"); ?></td>
            <td><input type="password" name="adminpwd" /></td>
            <td><input type="submit" value="<?php dire("co"); ?>" /></td>
        </tr>
    </table>
</form>
<?php } ?>
