<!-- Menu principal -->
<div id="menu">
    <ul>
        <li>
            <a href="index.php">
                <img src="themes/<?php echo obtenir_theme(); ?>/icones/m-accueil.png"
                     alt="accueil"
                     align="absmiddle" />
                <?php dire("menu_a"); ?>
            </a>
        </li>

        <li>
            <a href="index.php?action=logout">
                <img src="themes/<?php echo obtenir_theme(); ?>/icones/m-deconnexion.png"
                     alt="deconnexion"
                     align="absmiddle" />
                <?php dire("menu1"); ?>
            </a>
        </li>

        <li>
            <a href="index.php?action=page_liste">
                <img src="themes/<?php echo obtenir_theme(); ?>/icones/m-voir.png"
                     alt="liste"
                     align="absmiddle" />
                <?php dire("menu2b"); ?>
            </a>
        </li>

        <li id="galerie">
            <a href="#" onClick="javascript:menu('galerie', 'galerie_menu');">
                <img src = "themes/<?php echo obtenir_theme(); ?>/fleche.png" />
                <?php abbr("menu7"); ?>
            </a>
        </li>

        <li id="fiches">
            <a href="#" onClick="javascript:menu('fiches', 'fiches_menu');">
                <img src = "themes/<?php echo obtenir_theme(); ?>/fleche.png" />
                <?php abbr("menu2"); ?>
            </a>
        </li>

        <li id="export">
            <a href="#" onClick="javascript:menu('export', 'export_menu');">
                <img src = "themes/<?php echo obtenir_theme(); ?>/fleche.png" />
                <?php abbr("menu6"); ?>
            </a>
        </li>

        <li id="langue">
            <a href="#" onClick="javascript:menu('langue', 'langue_menu');">
                <img src = "themes/<?php echo obtenir_theme(); ?>/fleche.png" />
                <?php abbr("menu3"); ?>
            </a>
        </li>

        <li id="themes">
            <a href="#" onClick="javascript:menu('themes', 'themes_menu');">
                <img src = "themes/<?php echo obtenir_theme(); ?>/fleche.png" />
                <?php abbr("menu4"); ?>
            </a>
        </li>

        <li id="aide">
            <a href="#" onClick="javascript:menu('aide', 'aide_menu');">
                <img src = "themes/<?php echo obtenir_theme(); ?>/fleche.png" />
                <?php abbr("menu5"); ?>
            </a>
        </li>

    </ul>

    <?php
    /* Afficher le lien de retour vers les résultats de la recherche  */
    if(isset($_GET["action"])
        and $_GET["action"] == "page_voir"
        and isset($_SESSION["searchquery-rq"])
        and isset($_SESSION["searchquery-ch"])
        and isset($_GET["prov"])
        and $_GET["prov"]=="search")
    {
        echo "<br />
        <center>
            <a href=\"index.php?action=action_recherche&searchquery=1\">
                ".abbr2("retour_recherche")."
            </a>
        </center>";
    }
    ?>
</div>

<!-- Sous-menu::Aide -->
<div id="aide_menu" class="menu_deroulant" style="display:none;">
    <ul>
        <li>
            <a href="index.php?action=page_aide&page=about">
                <img src="themes/<?php echo obtenir_theme(); ?>/icones/about.png"
                     alt="about"
                     align="absmiddle" />
                <?php dire("menu5a"); ?>
            </a>
        </li>
        <li>
            <a href="index.php?action=page_aide&page=faq">
                <img src="themes/<?php echo obtenir_theme(); ?>/icones/faq.png"
                     alt="faq"
                     align="absmiddle" />
                <?php dire("menu5b"); ?>
            </a>
        </li>
        <li>
            <a href="index.php?action=page_aide&page=historique">
                <img src="themes/<?php echo obtenir_theme(); ?>/icones/historique.png"
                     alt="historique"
                     align="absmiddle" />
                <?php dire("menu5c"); ?>
            </a>
        </li>
        <!-- Admin -->
        <li>
            <a href="index.php?action=adminlogin">
                <img src="themes/<?php echo obtenir_theme(); ?>/icones/administration.png"
                     alt="administration"
                     align="absmiddle" />
                <?php abbr("menu5d"); ?>
            </a>
        </li>
    </ul>
</div>

<!-- Sous-menu::Themes -->
<div id="themes_menu" class="menu_deroulant" style="display:none;">
    <ul>
        <?php
        $dossiers = parcourir_dossier('themes/');
        if($dossiers) /* La fonction renvoie FALSE en cas d'échec */
        {
            foreach ($dossiers as $theme)
            {
                ?>
                <li>
                    <a href="index.php?action=action_themes&theme=<?php echo $theme; ?>">
                        <img src="themes/<?php echo $theme; ?>/preview.jpg"
                             alt="<?php echo $theme; ?> prévisualisation"
                             align="absmiddle" />
                        <?php /*echo formater_nom($theme);*/ ?>
                    </a>
                </li>
                <?php
            }
        }

        ?>
    </ul>
</div>

<!-- Sous-menu::Langue -->
<div id="langue_menu" class="menu_deroulant" style="display:none;">
    <ul>
        <li>
            <a href="index.php?action=action_langue&lang=fr">
                <img src="themes/<?php echo obtenir_theme(); ?>/icones/fr.png"
                     alt="fr"
                     align="absmiddle" />
                <?php dire("menu3a"); ?>
            </a>
        </li>
        <li>
            <a href="index.php?action=action_langue&lang=es">
                <img src="themes/<?php echo obtenir_theme(); ?>/icones/es.png"
                     alt="es"
                     align="absmiddle" />
                <?php dire("menu3b"); ?>
            </a>
        </li>
        <li>
            <a href="index.php?action=action_langue&lang=en">
                <img src="themes/<?php echo obtenir_theme(); ?>/icones/en.png"
                     alt="en"
                     align="absmiddle" />
                <?php dire("menu3c"); ?>
            </a>
        </li>
    </ul>
</div>

<!-- Sous-menu::galerie -->
<div id="galerie_menu" class="menu_deroulant" style="display:none;">
    <ul>
        <li>
            <a href="index.php?action=galerie&tri=pr-desc">
                <img src="themes/<?php echo obtenir_theme(); ?>/icones/galerie.png"
                     alt="galerie par promotion"
                     align="absmiddle" />
                <?php dire("menu7a"); ?>
            </a>
        </li>
        <li>
            <a href="index.php?action=galerie&tri=n-asc">
                <img src="themes/<?php echo obtenir_theme(); ?>/icones/galerie.png"
                     alt="galerie par nom"
                     align="absmiddle" />
                <?php dire("menu7b"); ?>
            </a>
        </li>
    </ul>
</div>

<!-- Sous-menu::Fiches -->
<div id="fiches_menu" class="menu_deroulant" style="display:none;">
    <ul>
        <li>
            <a href="index.php?action=page_ajouter">
                <img src="themes/<?php echo obtenir_theme(); ?>/icones/ajouter.png"
                     alt="ajouter"
                     align="absmiddle" />
                <?php dire("menu2a"); ?>
            </a>
        </li>

        <?php if(isset($_GET["action"]) and $_GET['action'] == "page_voir" and is_numeric($_GET['id'])) {?>
        <li>
            <a href="index.php?action=page_modifier&id=<?php echo $_GET['id']; ?>">
                <img src="themes/<?php echo obtenir_theme(); ?>/icones/modifier.png"
                     alt="modifier"
                     align="absmiddle" />
                <?php dire("menu2c"); ?>
            </a>
        </li>

        <li>
            <a href="index.php?action=action_supprimer&op=phase1&id=<?php echo $_GET['id']; ?>">
            <img src="themes/<?php echo obtenir_theme(); ?>/icones/supprimer.png"
                 alt="supprimer"
                 align="absmiddle" />
            <?php dire("menu2d"); ?>
        </a>
        </li>

        <li>&nbsp;</li>
        <?php } ?>

        <?php if(isset($_GET["action"]) and $_GET['action'] == "action_modifier") {?>
        <li>
            <a href="index.php?action=page_modifier&id=<?php echo $_POST['id']; ?>">
                <img src="themes/<?php echo obtenir_theme(); ?>/icones/modifier.png"
                     alt="modifier"
                     align="absmiddle" />
                <?php dire("menu2c"); ?>
            </a>
        </li>

        <li>
            <a href="index.php?action=action_supprimer&op=phase1&id=<?php echo $_POST['id']; ?>">
            <img src="themes/<?php echo obtenir_theme(); ?>/icones/supprimer.png"
                 alt="supprimer"
                 align="absmiddle" />
            <?php dire("menu2d"); ?>
        </a>
        </li>

        <li>&nbsp;</li>
        <?php } ?>

        <?php
            // Si aucun des deux IF au dessus n'est exécuté, il faut ajouter un <li> vide
            if(!isset($_GET['action']) or
                      $_GET['action'] != "page_voir" or
                      $_GET['action'] != "action_modifier") {?>
            <li>&nbsp;</li>
        <?php } ?>

        <li>
            <a href="index.php?action=page_liste&tri=maj">
                <img src="themes/<?php echo obtenir_theme(); ?>/icones/actualisation.png"
                     alt="actualisation"
                     align="absmiddle" />
                <?php dire("menu2i");?>
            </a>
        </li>

        <li>
            <a href="index.php?action=page_liste&tri=n-asc">
                <img src="themes/<?php echo obtenir_theme(); ?>/icones/voir.png"
                     alt="tri"
                     align="absmiddle" />
                <?php dire("menu2e");?>
            </a>
        </li>

        <li>
            <a href="index.php?action=page_liste&tri=n-desc">
                <img src="themes/<?php echo obtenir_theme(); ?>/icones/voir.png"
                     alt="tri"
                     align="absmiddle" />
                <?php dire("menu2f");?>
            </a>
        </li>

        <li>
            <a href="index.php?action=page_liste&tri=pr-asc">
                <img src="themes/<?php echo obtenir_theme(); ?>/icones/voir.png"
                     alt="tri"
                     align="absmiddle" />
                <?php dire("menu2g");?>
            </a>
        </li>

        <li>
            <a href="index.php?action=page_liste&tri=pr-desc">
                <img src="themes/<?php echo obtenir_theme(); ?>/icones/voir.png"
                     alt="tri"
                     align="absmiddle" />
                <?php dire("menu2h");?>
            </a>
        </li>

    </ul>
</div>

<!-- Sous-menu::Exportation -->
<div id="export_menu" class="menu_deroulant" style="display:none;">
    <ul>

    <?php
    /* CAS n°1 => Affichage d'une fiche                                               */
    if(isset($_GET['action']) and $_GET['action'] == "page_voir" and is_numeric($_GET['id'])) {?>

    <!-- Imprimer la fiche courante -->
    <li>
        <a href="export/imprimer.php?id=<?php echo $_GET['id']; ?>">
        <img src="themes/<?php echo obtenir_theme(); ?>/icones/imprimer.png"
             alt="imprimer"
             align="absmiddle" />
        <?php dire("menu6e"); ?>
        </a>
    </li>

    <!-- Génération de PDF à la volée: 1 fiche -->
    <li>
        <a href="export/pdfexport.php?pdf=fiche&id=<?php echo $_GET['id']; ?>">
        <img src="themes/<?php echo obtenir_theme(); ?>/icones/pdf.png"
             alt="pdf"
             align="absmiddle" />
        <?php dire("menu6pdf2"); ?>
        </a>
    </li>

    <li>&nbsp;</li>
    <?php } ?>

    <?php if(!isset($_GET['action']) or $_GET['action'] != "action_recherche"){ ?>

    <!-- Génération de PDF à la volée: tout l'annuaire -->
    <li>
        <a href="export/pdfexport.php?pdf=tout">
        <img src="themes/<?php echo obtenir_theme(); ?>/icones/pdf.png"
             alt="pdf"
             align="absmiddle" />
        <?php dire("menu6pdf1"); ?>
        </a>
    </li>

    <li>&nbsp;</li>
    <?php } ?>

    <?php
    /* CAS n°2 => Affichage des résultats de recherche                                */
    if(isset($_GET['action']) and $_GET['action'] == "action_recherche") {?>

    <!-- Génération de PDF à la volée: résultats de la recherche -->
    <li>
        <a href="export/pdfexport.php?pdf=recherche">
        <img src="themes/<?php echo obtenir_theme(); ?>/icones/pdf.png"
             alt="pdf"
             align="absmiddle" />
        <?php dire("menu6pdf3"); ?>
        </a>
    </li>

    <!-- Imprimer les résultats de la recherche -->
    <li>
        <a href="export/imprimer.php">
        <img src="themes/<?php echo obtenir_theme(); ?>/icones/imprimer.png"
             alt="imprimer"
             align="absmiddle" />
        <?php dire("menu6k"); ?>
        </a>
    </li>

    <!-- Exporter les résultats de la recherche (CSV) -->
    <li>
        <a href="export/csvexport.php">
        <img src="themes/<?php echo obtenir_theme(); ?>/icones/exporter.png"
             alt="exporter"
             align="absmiddle" />
        <?php dire("menu6b"); ?>
        </a>
    </li>

    <!-- Exporter les résultats de la recherche (XLS) -->
    <li>
        <a href="export/xlsexport.php">
        <img src="themes/<?php echo obtenir_theme(); ?>/icones/exporter.png"
             alt="exporter"
             align="absmiddle" />
        <?php dire("menu6d"); ?>
        </a>
    </li>

    <!-- Exporter les résultats de la recherche (XML) -->
    <li>
        <a href="export/xmlexport.php">
        <img src="themes/<?php echo obtenir_theme(); ?>/icones/exporter.png"
             alt="exporter"
             align="absmiddle" />
        <?php dire("menu6j"); ?>
        </a>
    </li>
    <li>&nbsp;</li>
    <?php } ?>

    <!-- Exportation rapide (CSV) -->
    <li>
        <a href="export/csvexport.php?tout=0">
            <img src="themes/<?php echo obtenir_theme(); ?>/icones/exporter.png"
                 alt="exporter"
                 align="absmiddle" />
            <?php dire("menu6l"); ?>
        </a>
    </li>

    <!-- Exportation rapide (XLS) -->
    <li>
        <a href="export/xlsexport.php?tout=0">
            <img src="themes/<?php echo obtenir_theme(); ?>/icones/exporter.png"
                 alt="exporter"
                 align="absmiddle" />
            <?php dire("menu6m"); ?>
        </a>
    </li>

    <!-- Exportation rapide (XML) -->
    <li>
        <a href="export/xmlexport.php?tout=0">
            <img src="themes/<?php echo obtenir_theme(); ?>/icones/exporter.png"
                 alt="exporter"
                 align="absmiddle" />
            <?php dire("menu6n"); ?>
        </a>
    </li>

    <li>&nbsp;</li>

    <?php if($_config['exporter_tout'] == 1) { ?>

    <!-- Exporter tout (CSV) -->
    <li>
        <a href="export/csvexport.php?tout=1">
            <img src="themes/<?php echo obtenir_theme(); ?>/icones/exporter.png"
                 alt="exporter"
                 align="absmiddle" />
            <?php dire("menu6a"); ?>
        </a>
    </li>

    <!-- Exporter tout (XLS) -->
    <li>
        <a href="export/xlsexport.php?tout=1">
            <img src="themes/<?php echo obtenir_theme(); ?>/icones/exporter.png"
                 alt="exporter"
                 align="absmiddle" />
            <?php dire("menu6c"); ?>
        </a>
    </li>

    <!-- Exporter tout (XML) -->
    <li>
        <a href="export/xmlexport.php?tout=1">
            <img src="themes/<?php echo obtenir_theme(); ?>/icones/exporter.png"
                 alt="exporter"
                 align="absmiddle" />
            <?php dire("menu6i"); ?>
        </a>
    </li>

    <li>&nbsp;</li>
    <?php } ?>

    <!-- Imprimer tout -->
    <li>
        <a href="export/imprimer.php?tout=1">
            <img src="themes/<?php echo obtenir_theme(); ?>/icones/imprimer.png"
                 alt="imprimer"
                 align="absmiddle" />
            <?php dire("menu6f"); ?>
        </a>
    </li>

    <!-- Imprimer tout, trier par PROMOTION -->
    <li>
        <a href="export/imprimer.php?tout=1&tri=pr">
            <img src="themes/<?php echo obtenir_theme(); ?>/icones/imprimer.png"
                 alt="imprimer"
                 align="absmiddle" />
            <?php dire("menu6g"); ?>
        </a>
    </li>

    <!-- Imprimer tout, trier par NOM -->
    <li>
        <a href="export/imprimer.php?tout=1&tri=nm">
            <img src="themes/<?php echo obtenir_theme(); ?>/icones/imprimer.png"
                 alt="imprimer"
                 align="absmiddle" />
            <?php dire("menu6h"); ?>
        </a>
    </li>
    </ul>
</div>