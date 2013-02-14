<?php
connexion();

/* PAGINATION */ /* $x doit �tre d�finie avant d'arriver � cet endroit du code */

// A partir de combien d'enregistrements une nouvelle page est-elle cr��e ? A partir de $z
$z = $_config['pagination'];

//Combien d'enregistrements au total dans la table ? R�ponse: $t
$sql = "SELECT * FROM utilisateur;";
$req = mysql_query($sql);
$t = mysql_num_rows($req);

// Tri des enregistrements
	// Cas 1 => Premi�re visualisation de la page: session close: tri par d�faut
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

		// Pr�noms
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

		// Par date de mise � jour
		if($_GET['tri'] == "maj")
			$_SESSION['tri'] = "modif DESC";
	}

	// Conclusion => un tri est d�j� actif, soit parce que c'est le tri par d�faut (cas 1)
	// soit parce qu'il vient d'�tre d�fini (cas 2), soit encore parce qu'il est enregistr�
	// dans la session en cours.
	$tri = $_SESSION['tri'];

//G�n�rer la requ�te avant de modifier les limites ($x)
$sql = "SELECT * FROM utilisateur ORDER BY $tri LIMIT $x,$z;";
$req = mysql_query($sql);

// On stocke le $x actuel dans $xa, car $x va �tre modifi� par la suite
$xa = $x;
// Barre de navigation / r�partition des r�sultats sur plusieurs pages
//Calculs
// $y est le premier enregistrement de la plage � afficher (LIMIT Y,...)
// $z est le seuil � partir duquel on passe � une autre page
// $x est le nombre d'enregistrements qu'il reste � afficher
	//Prot�ger y: il ne doit pas �tre n�gatif, car x peut �tre plus petit que z
	$y = $x - $z;
	if($y < 0)
		$y = 0;
	//Le nouveau x est l'ancien + la grandeur du nouvel intervalle ($z)
	$x = $x + $z;
	// $l repr�sente le premier enregistrement de la derni�re page
	$l = $t-$z;
	// $p repr�sente le nombre de pages
	$p = ceil($t / $z); //ceil() arrondit � la valeur sup�rieure
	// $c repr�sente la page courante
	$c = ceil($x / $z); //ceil() arrondit � la valeur sup�rieure


/* /PAGINATION */
?>

<div class="container well">
    	<?php
			/* Construction et affichage du syst�me de pagination */
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

			// Combobox qui permet de sauter d'une page � l'autre
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
					/* $ix indique la page � laquelle on veut aller, mais quel sera la
					 valeur de x pour cette page (x=premier enregistrement de la page)
					R�ponse: page d�sir�e ($ix) * seuil de pagination ($z)
					MAIS: la premi�re page porte le num�ro 1, alors qu'elle est
					construite avec un $x �gal � 0 (limit $x=O,$z) => donc, il faut
					en r�alit� utiliser ($ix - 1) au lieu de $ix*/
					$xgo = ($ix - 1) * $z;

					$co .= "<option value=\"index.php?action=page_liste&x=$xgo"
					    ."\">$ix</option>";
				}
			}
			$co .= "</select>";

			$provresult = "<td align=\"center\"><div class=\"btn-group\">";
			// si $x>$z c'est qu'on est plus � la premi�re page
			if($x > $z)
			{
				$provresult	.="<a class=\"btn btn-small\" href=\"index.php?action=page_liste\"><i class=\"icon-fast-backward\"></i></a>"
						." <a class=\"btn btn-small\" href=\"index.php?action=page_liste&x=$y\"><i class=\"icon-backward\"></i></a>";
			}
			// sinon c'est qu'on est � la premi�re page
			else
			{
				$provresult .= "<a class=\"btn btn-small disabled\"><i class=\"icon-fast-backward\"></i></a> <a class=\"btn btn-small disabled\"><i class=\"icon-backward\"></i></a>";
			}

			//si $x<$t c'est qu'on n'est pas encore � la derni�re page
			if($x < $t)
			{
				$provresult	.=" <a class=\"btn btn-small\" href=\"index.php?action=page_liste&x=$x\"><i class=\"icon-forward\"></i></a>"
						." <a class=\"btn btn-small\" href=\"index.php?action=page_liste&x=$l\"><i class=\"icon-fast-forward\"></i></a>";
			}
			// sinon c'est qu'on est � la derni�re page
			else
			{
				$provresult .= " <a class=\"btn btn-small disabled\"><i class=\"icon-forward\"></i></a> <a class=\"btn btn-small disabled\"><i class=\"icon-fast-forward\"></i></a>";
			}
			$result .= $provresult."</div></td>";

			// Pour d�sactiver le Combo, remplacer ci-dessous $co par $c
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
/* NB: il faut refuser l'exportation ici (false) pour que soit g�n�r�e une requ�te SQL de base, exportant TOUS les enregistrements... et non seulement ceux qui sont sur la page courante*/
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