<?php
connexion();

/* $voir_id est transmise depuis index.php, juste avant l'include de voir.php */
$sql = "SELECT * FROM utilisateur WHERE id='$voir_id'";

$req = mysql_query($sql) or die("Erreur: $sql<br />".mysql_error());
$data = mysql_fetch_assoc($req);

$afficher['nom'] = (formater_nom(stripslashes($data['nom'])));
$afficher['prenom'] = (formater_nom(stripslashes($data['prenom'])));
$afficher['promotion'] = (stripslashes($data['promotion']));
$afficher['nationalite'] = (stripslashes($data['nationalite']));
$afficher['naissance'] = (stripslashes($data['naissance']));
$afficher['adresse'] = (stripslashes($data['adresse']));
$afficher['email'] = (stripslashes($data['email']));

$afficher['q1'] = (stripslashes($data['q1']));
$afficher['q2'] = (stripslashes($data['q2']));
$afficher['q3'] = (stripslashes($data['q3']));
$afficher['q4'] = (stripslashes($data['q4']));
$afficher['q5'] = (stripslashes($data['q5']));
$afficher['q6'] = (stripslashes($data['q6']));
$afficher['q7'] = (stripslashes($data['q7']));

$afficher['modif'] = formater_date($data['modif'],false);

/* Photo */
$sql2 = "SELECT * FROM photo WHERE user_id='$voir_id'";
$req2 = mysql_query($sql2) die("Erreur: $sql2<br />".mysql_error());
$data2 = mysql_fetch_assoc($req2);

$photo = "&nbsp;";
if(!is_empty($data2)) {
    $imgW =  $data2['width'];
    $imgH = $data2['height'];
    if($imgW == 0) $imgW = 1;

// Resizing image to make a thumbnail
    $thumb_width = $_config['images_largeur_fiches'];
    $thumb_height = round($imgH / $imgW * $thumb_width);

    $photo = "<img height=\"$thumb_height\" width=\"$thumb_width\" src=\"includes/photo.php?id=$voir_id\">";
}


?>

<table width="80%" border="0" align="center" cellpadding="2" cellspacing="2" class="reponse">
  <tr>
	<td>
		<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="reponse">
			<tr>
				<td>
					<table width="100%" border="0" align="left" cellpadding="2" cellspacing="2" class="reponse">
					<tr>
						<td class="plus-gros"><span class="petites-majuscules"><?php echo $afficher['nom']; ?></span>&nbsp;<?php echo $afficher['prenom']; ?></td>
					</tr>
					<tr>
						<td><?php dire("ne-vp") ?>
					    	&nbsp;<?php echo $afficher['nationalite']; ?>&nbsp;
					    	<?php dire("ne-le") ?>
					    	&nbsp;<?php echo convertir_date($afficher['naissance']); ?>
						</td>
					</tr>
					<tr>
						<td><?php dire('c3'); ?>&nbsp;<?php echo abbr3($afficher['promotion'], promotion($afficher['promotion'])); ?></td>
					</tr>
					</table>
				</td>
				<td style="text-align:right;"><?php echo $photo; ?></td>
			</tr>
		</table>
	</td>
  </tr>
  <tr>
	<td>&nbsp;</td>
  </tr><tr>
    <td><?php echo $afficher['adresse']; ?></td>
    </tr>
  <tr>
    <td>
		<?php
		echo abbr3('<a href="mailto:'.$afficher['email'].'">'.$afficher['email'].'</a>',
		       donner('env-mail')." ".$afficher['prenom']." ".$afficher['nom']);
		?>
	</td>
    </tr>
    <tr class="orange">
      <td height="3">&nbsp;</td>
    </tr>

	<?php if($afficher['q1'] != "") { ?>
    <tr>
      <td class="question"><?php dire("r1"); ?></td>
    </tr>
    <tr>
      <td><?php echo $afficher['q1']; ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <?php } ?>

	<?php if($afficher['q2'] != "") { ?>
	<tr>
      <td class="question"><?php dire("r2"); ?></td>
    </tr>
    <tr>
      <td><?php echo $afficher['q2']; ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <?php } ?>

	<?php if($afficher['q3'] != "") { ?>
	<tr>
      <td class="question"><?php dire("r3"); ?></td>
    </tr>
    <tr>
      <td><?php echo $afficher['q3']; ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <?php } ?>

	<?php if($afficher['q4'] != "") { ?>
	<tr>
      <td class="question"><?php dire("r4"); ?></td>
    </tr>
    <tr>
      <td><?php echo $afficher['q4']; ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <?php } ?>

	<?php if($afficher['q5'] != "") { ?>
	<tr>
      <td class="question"><?php dire("r5"); ?></td>
    </tr>
    <tr>
      <td><?php echo $afficher['q5']; ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <?php } ?>

	<?php if($afficher['q6'] != "") { ?>
	<tr>
      <td class="question"><?php dire("r6"); ?></td>
    </tr>
    <tr>
      <td><?php echo $afficher['q6']; ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <?php } ?>

	<?php if($afficher['q7'] != "") { ?>
	<tr>
      <td class="question"><?php dire("r7"); ?></td>
    </tr>
    <tr>
      <td><?php echo $afficher['q7']; ?></td>
    </tr>
	<?php } ?>

	<tr>
      <td align="right"><?php dire("modif"); echo " ".$afficher['modif']; ?></td>
    </tr>

  </table>

