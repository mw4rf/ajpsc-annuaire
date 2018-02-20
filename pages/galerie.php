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

connexion();

/* PAGINATION */ /* $x doit être définie avant d'arriver à cet endroit du code */

// A partir de combien d'enregistrements une nouvelle page est-elle créée ? A partir de $z
$z = $_config['pagination_galerie'];

//Combien d'enregistrements au total dans la table ? Réponse: $t
$sql = "SELECT * FROM photo";
$req = mysql_query($sql);
$t = mysql_num_rows($req);

// Tri des enregistrements
	// Cas 1 => Première visualisation de la page: session close: tri par défaut
	if (!isset($_SESSION['tri_galerie']))
		$_SESSION['tri_galerie'] = "id DESC";

	// Cas 2 => L'utilisateur vient juste de cliquer sur un lien ordonnant un tri
	if(isset($_GET['tri']))
	{
		// Noms de famille
		if($_GET['tri'] == "n-asc")
			$_SESSION['tri_galerie'] = "nom ASC";
		if($_GET['tri'] == "n-desc")
			$_SESSION['tri_galerie'] = "nom DESC";

		// Promotions
		if($_GET['tri'] == "pr-asc")
			$_SESSION['tri_galerie'] = "promotion ASC";
		if($_GET['tri'] == "pr-desc")
			$_SESSION['tri_galerie'] = "promotion DESC";

		// Par date de mise à jour
		if($_GET['tri'] == "maj")
			$_SESSION['tri_galerie'] = "modif DESC";
	}


	// Conclusion => un tri est déjà actif, soit parce que c'est le tri par défaut (cas 1)
	// soit parce qu'il vient d'être défini (cas 2), soit encore parce qu'il est enregistré
	// dans la session en cours.
	$tri = $_SESSION['tri_galerie'];

//Générer la requête avant de modifier les limites ($x)
$sql = "SELECT * FROM utilisateur as U, photo as P WHERE U.id = P.user_id ORDER BY $tri LIMIT $x,$z";
$req = mysql_query($sql);

// On stocke le $x actuel dans $xa, car $x va être modifié par la suite
$xa = $x;
// Barre de navigation / répartition des résultats sur plusieurs pages
//Calculs
// $y est le premier enregistrement de la plage à afficher (LIMIT Y,...)
// $z est le seuil à partir duquel on passe à une autre page
// $x est le nombre d'enregistrements qu'il reste à afficher
	//Protéger y: il ne doit pas être négatif, car x peut être plus petit que z
	$y = $x - $z;
	if($y < 0)
		$y = 0;
	//Le nouveau x est l'ancien + la grandeur du nouvel intervalle ($z)
	$x = $x + $z;
	// $l représente le premier enregistrement de la dernière page
	$l = $t-$z;
	// $p représente le nombre de pages
	$p = ceil($t / $z); //ceil() arrondit à la valeur supérieure
	// $c représente la page courante
	$c = ceil($x / $z); //ceil() arrondit à la valeur supérieure


/* /PAGINATION */
?>

<div class="container well">
        <?php
            /* Construction et affichage du système de pagination */
            $avant =      abbr2("p-");
            $apres =      abbr2("p+");
            $avantx =     donner("p-");
            $apresx =     donner("p+");
            $il_y_a =     donner("p1");
            $fiches_sur = donner("p2b");
            $pages =      donner("p3");
            $page =       donner("p4");


            $result =  "<table style=\"width:100%;\"><tr><td align=\"left\">";
            $result .= "<span class=\"label\">$il_y_a <b>".$t."</b> $fiches_sur <b>".$p."</b> $pages</span>";
            $result .= "</td>";

            // Combobox qui permet de sauter d'une page à l'autre
              $co  = "<select class=\"span1 btn\" name=\"menu_pagination\" "
                   ."onchange=\"MM_jumpMenu('parent',this,0)\">";

            for($ix = 1 ; $ix <= $p ; $ix++)
            {
                // Page courante
                if($ix == $c)
                {
                    $co .= "<option selected=\"selected\">$c</option>";
                }
                // Autre page
                else
                {
                    /* $ix indique la page à laquelle on veut aller, mais quel sera la
                     valeur de x pour cette page (x=premier enregistrement de la page)
                    Réponse: page désirée ($ix) * seuil de pagination ($z)
                    MAIS: la première page porte le numéro 1, alors qu'elle est
                    construite avec un $x égal à 0 (limit $x=O,$z) => donc, il faut
                    en réalité utiliser ($ix - 1) au lieu de $ix*/
                    $xgo = ($ix - 1) * $z;

                    $co .= "<option value=\"index.php?action=galerie&x=$xgo"
                        ."\">$ix</option>";
                }
            }
            $co .= "</select>";

            $provresult = "<td align=\"center\"><div class=\"btn-group\">";
            // si $x>$z c'est qu'on est plus à la première page
            if($x > $z)
            {
                $provresult .="<a class=\"btn btn-small\" href=\"index.php?action=galerie\"><i class=\"icon-fast-backward\"></i></a>"
                        ." <a class=\"btn btn-small\" href=\"index.php?action=galerie&x=$y\"><i class=\"icon-backward\"></i></a>";
            }
            // sinon c'est qu'on est à la première page
            else
            {
                $provresult .= "<a class=\"btn btn-small disabled\"><i class=\"icon-fast-backward\"></i></a> <a class=\"btn btn-small disabled\"><i class=\"icon-backward\"></i></a>";
            }

            //si $x<$t c'est qu'on n'est pas encore à la dernière page
            if($x < $t)
            {
                $provresult .=" <a class=\"btn btn-small\" href=\"index.php?action=galerie&x=$x\"><i class=\"icon-forward\"></i></a>"
                        ." <a class=\"btn btn-small\" href=\"index.php?action=galerie&x=$l\"><i class=\"icon-fast-forward\"></i></a>";
            }
            // sinon c'est qu'on est à la dernière page
            else
            {
                $provresult .= " <a class=\"btn btn-small disabled\"><i class=\"icon-forward\"></i></a> <a class=\"btn btn-small disabled\"><i class=\"icon-fast-forward\"></i></a>";
            }
            $result .= $provresult."</div></td>";

            // Pour désactiver le Combo, remplacer ci-dessous $co par $c
            $result .= "<td align=\"right\"><span class=\"label\">$page</span> $co <span class=\"label\">/$p</span></td></tr></table>";

            echo $result;
        ?>
</div>

<div class="container">
<table class="table" align="center" cellpadding="4" cellspacing="0" border="0">
<tr>

<?php
// Pour l'exportation
/* NB: il faut refuser l'exportation ici (false) pour que soit générée une requête SQL de base, exportant TOUS les enregistrements... et non seulement ceux qui sont sur la page courante*/
$_SESSION["exportation_permission"] = false;
$_SESSION["exportation_requete"] = $sql;

$images_par_ligne = $_config['images_par_ligne'];

// variables modifiées à chaque itération de la boucle
$num = 0;
$promo = 0;

while($data = mysql_fetch_assoc($req))
{

	//print_r($data);

	// récupérer les données de l'utilisateur
	$photoid = $data['id'];
	$userid = $data['user_id'];
	$afficher['nom'] = (formater_nom(stripslashes($data['nom'])));
	$afficher['prenom'] = (formater_nom(stripslashes($data['prenom'])));
	$afficher['promotion'] = (stripslashes($data['promotion']));

	// récupérer l'id de l'image
	$sql2 = "SELECT * FROM photo WHERE user_id = '$userid'";
	$req2 = mysql_query($sql2);

	// pas de photo : arrêter le traitement et continuer avec l'utilisateur suivant
	if(mysql_num_rows($req2) < 1) continue;

	// une photo : poursuite du traitement
	$data2 = mysql_fetch_assoc($req2);
	// Créer l'image
	$imgW =  $data2['width'];
	$imgH = $data2['height'];
	if($imgW == 0) $imgW = 1;

	// Resizing image to make a thumbnail
	$thumb_width = $_config['images_largeur_galerie'];
	$thumb_height = round($imgH / $imgW * $thumb_width);

    // Stockage dans la BDD ou sur le système de fichiers ?
    if($_config['photos_storage'] == "FS")
        $src = $_config['data_folder']."/photos/".$data2['user_id'].'.'.$data2['extension'];
    else
        $src = "includes/photo.php?id=$userid";

	// affichage
	$photo = "<a href=\"index.php?action=page_voir&id=$userid\"><img height=\"$thumb_height\" width=\"$thumb_width\" src=\"$src\"></a>";

	// Taille de chaque colonne, en pourcentage
	$tdp = round( 100 / $images_par_ligne );

// Affichage

// Displaying : new line
	if($num == $images_par_ligne)
	{
		echo "\n\t</tr>\n\n\t<tr>";
		$num = 0;
	}
	$num++;

// Tri par promotions
if($afficher['promotion'] != $promo and ( $_SESSION['tri_galerie'] == "promotion ASC" or $_SESSION['tri_galerie'] == "promotion DESC" ) )
{
	$promo = $afficher['promotion'];
	echo "</tr><tr><th class=\"well\" style=\"text-align:center;\" colspan=\"$images_par_ligne\">".donner("c3")." $promo</th></tr><tr>";
}


?>

	<td style="text-align:center;" width="<?php echo $tdp; ?>%">
		<?php echo $photo; ?>
		<br />
		<?php echo "<b>".$afficher['prenom']." ".$afficher['nom']."</b><br />(".$afficher['promotion'].")"; ?>
	</td>

<?php } ?>
</tr>
</table>
</div>