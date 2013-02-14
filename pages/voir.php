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
$req2 = mysql_query($sql2) or die("Erreur: $sql2<br />".mysql_error());
$data2 = mysql_fetch_assoc($req2);

$photo = "&nbsp;";
if(!empty($data2)) {
    $imgW =  $data2['width'];
    $imgH = $data2['height'];
    if($imgW == 0) $imgW = 1;

    // Resizing image to make a thumbnail
    $thumb_width = $_config['images_largeur_fiches'];
    $thumb_height = round($imgH / $imgW * $thumb_width);

    // Storage: DB / FS ?
    if($_config['photos_storage'] == "DB")
        $src = "includes/photo.php?id=$voir_id";
    else
        $src = $_config['data_folder']."/photos/".$data2['user_id'].'.'.$data2['extension'];

    $photo = "<img height=\"$thumb_height\" width=\"$thumb_width\" src=\"$src\">";
}

?>

<div class="container">
    <div class="row-fluid">
        <div  class="span8 well">

            <h2>
                <?php echo $afficher['prenom']; ?>
                <span style="font-variant: small-caps;"><?php echo $afficher['nom']; ?></span>
            </h2>

            <p><b>
            <?php dire('c3'); ?>&nbsp;<?php echo abbr3($afficher['promotion'], promotion($afficher['promotion'])); ?>
            </b></p>

            <p>
            <i class="icon-user"></i>
            <?php dire("ne-vp") ?>
			&nbsp;<?php echo $afficher['nationalite']; ?>&nbsp;
			<?php dire("ne-le") ?>
			&nbsp;<?php echo convertir_date($afficher['naissance']); ?>
            </p>

            <p>
                <i class="icon-envelope"></i>
                <?php echo $afficher['adresse']; ?>
            </p>

            <p>
                <i class="icon-pencil"></i>
                <?php
                    echo abbr3('<a href="mailto:'.$afficher['email'].'">'.$afficher['email'].'</a>',
                    donner('env-mail')." ".$afficher['prenom']." ".$afficher['nom']);
                ?>
            </p>

        </div>
        <div class="span4 text-center">
            <?php echo $photo; ?>
        </div>
    </div>


	<?php if($afficher['q1'] != "") { ?>
        <div class="well well-small">
            <p class="lead"><?php dire("r1"); ?></p>
            <blockquote><?php echo $afficher['q1']; ?></blockquote>
        </div>
    <?php } ?>

	<?php if($afficher['q2'] != "") { ?>
        <div class="well well-small">
            <p class="lead"><?php dire("r2"); ?></p>
            <blockquote><?php echo $afficher['q2']; ?></blockquote>
        </div>
    <?php } ?>

	<?php if($afficher['q3'] != "") { ?>
        <div class="well well-small">
            <p class="lead"><?php dire("r3"); ?></p>
            <blockquote><?php echo $afficher['q3']; ?></blockquote>
        </div>
    <?php } ?>

	<?php if($afficher['q4'] != "") { ?>
        <div class="well well-small">
            <p class="lead"><?php dire("r4"); ?></p>
            <blockquote><?php echo $afficher['q4']; ?></blockquote>
        </div>
    <?php } ?>

	<?php if($afficher['q5'] != "") { ?>
        <div class="well well-small">
            <p class="lead"><?php dire("r5"); ?></p>
            <blockquote><?php echo $afficher['q5']; ?></blockquote>
        </div>
    <?php } ?>

	<?php if($afficher['q6'] != "") { ?>
        <div class="well well-small">
            <p class="lead"><?php dire("r6"); ?></p>
            <blockquote><?php echo $afficher['q6']; ?></blockquote>
        </div>
    <?php } ?>

	<?php if($afficher['q7'] != "") { ?>
        <div class="well well-small">
            <p class="lead"><?php dire("r7"); ?></p>
            <blockquote><?php echo $afficher['q7']; ?></blockquote>
        </div>
	<?php } ?>

    <p class="pull-right"><span class="label"><?php dire("modif"); echo " ".$afficher['modif']; ?></span><p>

</div>
