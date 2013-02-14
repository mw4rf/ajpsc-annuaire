<?php
connexion();

/* PAGINATION */ /* $x doit être définie avant d'arriver à cet endroit du code */

// A partir de combien d'enregistrements une nouvelle page est-elle créée ? A partir de $z
$z = $_config['pagination'];

//Combien d'enregistrements au total dans la table ? Réponse: $t
$sql = "SELECT * FROM utilisateur;";
$req = mysql_query($sql);
$t = mysql_num_rows($req);

// Tri des enregistrements
	// Cas 1 => Première visualisation de la page: session close: tri par défaut
	if (!isset($_SESSION['tri']))
		$_SESSION['tri'] = "nom ASC";

	// Cas 2 => L'utilisateur vient juste de cliquer sur un lien ordonnant un tri
	if(isset($_GET['tri']))
	{
		// Noms de famille
		if($_GET['tri'] == "n-asc")
			$_SESSION['tri'] = "nom ASC";
		if($_GET['tri'] == "n-desc")
			$_SESSION['tri'] = "nom DESC";

		// Prénoms
		if($_GET['tri'] == "pn-asc")
			$_SESSION['tri'] = "prenom ASC";
		if($_GET['tri'] == "pn-desc")
			$_SESSION['tri'] = "prenom DESC";

		// Promotions
		if($_GET['tri'] == "pr-asc")
			$_SESSION['tri'] = "promotion ASC";
		if($_GET['tri'] == "pr-desc")
			$_SESSION['tri'] = "promotion DESC";

		// Adresses e-mail
		if($_GET['tri'] == "em-asc")
			$_SESSION['tri'] = "email ASC";
		if($_GET['tri'] == "em-desc")
			$_SESSION['tri'] = "email DESC";

		// Annuler la formule de tri
		if($_GET['tri'] == "no")
			$_SESSION['tri'] = "id ASC";

		// Par date de mise à jour
		if($_GET['tri'] == "maj")
			$_SESSION['tri'] = "modif DESC";
	}

	// Conclusion => un tri est déjà actif, soit parce que c'est le tri par défaut (cas 1)
	// soit parce qu'il vient d'être défini (cas 2), soit encore parce qu'il est enregistré
	// dans la session en cours.
	$tri = $_SESSION['tri'];

//Générer la requête avant de modifier les limites ($x)
$sql = "SELECT * FROM utilisateur ORDER BY $tri LIMIT $x,$z;";
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
			$fiches_sur = donner("p2");
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

					$co .= "<option value=\"index.php?action=page_liste&x=$xgo"
					    ."\">$ix</option>";
				}
			}
			$co .= "</select>";

			$provresult = "<td align=\"center\"><div class=\"btn-group\">";
			// si $x>$z c'est qu'on est plus à la première page
			if($x > $z)
			{
				$provresult	.="<a class=\"btn btn-small\" href=\"index.php?action=page_liste\"><i class=\"icon-fast-backward\"></i></a>"
						." <a class=\"btn btn-small\" href=\"index.php?action=page_liste&x=$y\"><i class=\"icon-backward\"></i></a>";
			}
			// sinon c'est qu'on est à la première page
			else
			{
				$provresult .= "<a class=\"btn btn-small disabled\"><i class=\"icon-fast-backward\"></i></a> <a class=\"btn btn-small disabled\"><i class=\"icon-backward\"></i></a>";
			}

			//si $x<$t c'est qu'on n'est pas encore à la dernière page
			if($x < $t)
			{
				$provresult	.=" <a class=\"btn btn-small\" href=\"index.php?action=page_liste&x=$x\"><i class=\"icon-forward\"></i></a>"
						." <a class=\"btn btn-small\" href=\"index.php?action=page_liste&x=$l\"><i class=\"icon-fast-forward\"></i></a>";
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
<table class="table table-hover">
<thead>
  <tr>
    <th width="25%">
        <span class="btn-group">
		    <a class="btn btn-mini" href="index.php?action=page_liste&x=<?php echo $xa; ?>&tri=n-asc">
    			<i class="icon-chevron-up"></i>
    		</a>
    		<a class="btn btn-mini" href="index.php?action=page_liste&x=<?php echo $xa; ?>&tri=n-desc">
    			<i class="icon-chevron-down"></i>
    		</a>
        </span>
        <?php dire("c1"); ?>
	</th>
    <th width="25%">
        <span class="btn-group">
            <a class="btn btn-mini" href="index.php?action=page_liste&x=<?php echo $xa; ?>&tri=pn-asc">
                <i class="icon-chevron-up"></i>
            </a>
            <a class="btn btn-mini" href="index.php?action=page_liste&x=<?php echo $xa; ?>&tri=pn-desc">
                <i class="icon-chevron-down"></i>
            </a>
        </span>
        <?php dire("c2"); ?>
	</th>
    <th>
        <span class="btn-group">
            <a class="btn btn-mini" href="index.php?action=page_liste&x=<?php echo $xa; ?>&tri=pr-asc">
                <i class="icon-chevron-up"></i>
            </a>
            <a class="btn btn-mini" href="index.php?action=page_liste&x=<?php echo $xa; ?>&tri=pr-desc">
                <i class="icon-chevron-down"></i>
            </a>
        </span>
        <?php dire("c3"); ?>
	</th>
    <th>
        <span class="btn-group">
            <a class="btn btn-mini" href="index.php?action=page_liste&x=<?php echo $xa; ?>&tri=em-asc">
                <i class="icon-chevron-up"></i>
            </a>
            <a class="btn btn-mini" href="index.php?action=page_liste&x=<?php echo $xa; ?>&tri=em-desc">
                <i class="icon-chevron-down"></i>
            </a>
        </span>
        <?php dire("c7"); ?>
	<th>
		<a class="btn btn-mini" href="index.php?action=page_liste&x=<?php echo $xa; ?>&tri=no">
			<i class="icon-remove"></i>
		</a>
	</th>
  </tr>
</thead>
<tbody>
<?php
// Pour l'exportation
/* NB: il faut refuser l'exportation ici (false) pour que soit générée une requête SQL de base, exportant TOUS les enregistrements... et non seulement ceux qui sont sur la page courante*/
$_SESSION["exportation_permission"] = false;
$_SESSION["exportation_requete"] = $sql;

while($data = mysql_fetch_assoc($req))
{
	$afficher['nom'] = htmlentities(formater_nom(stripslashes($data['nom'])));
	$afficher['prenom'] = htmlentities(formater_nom(stripslashes($data['prenom'])));
	$afficher['promotion'] = htmlentities(stripslashes($data['promotion']));
	$afficher['email'] = htmlentities(stripslashes($data['email']));

	$fiche = "index.php?action=page_voir&id=".$data['id'];

?>
  <tr style="cursor:pointer" onClick="javascript:js_direct('<?php echo $fiche; ?>');">
    <td><?php echo abbr3($afficher["nom"], donner("voir")); ?></td>
    <td><?php echo abbr3($afficher["prenom"], donner("voir")); ?></td>
    <td><?php echo abbr3($afficher["promotion"], donner("voir")); ?></td>
    <td><?php echo abbr3($afficher["email"], donner("voir")); ?></td>
	<td><i class="icon-eye-open"></i></td>
  </tr>

<?php } ?>
</tbody>
</table>
</div>