<!-- Menu principal -->
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <!-- ADMIN -->
    <?php if(isadmin()) { ?>
        <a class="brand alert-error" href="index.php?action=adminlogin">&nbsp;Mode Administration</a>
    <?php } else { ?>
        <a class="brand" href="index.php">&nbsp;AJPSC Annuaire</a>
    <?php } ?>
    <ul class="nav">
        <!-- Voir les fiches -->
        <li><a href="index.php?action=page_liste"><i class="icon-eye-open"></i> <?php dire("menu2b"); ?></a></li>

        <!-- MENU: Gallerie -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                <i class="icon-user"></i>
                <?php abbr("menu7"); ?>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="index.php?action=galerie&tri=pr-desc">
                        <i class="icon-chevron-down"></i>
                        <?php abbr("menu7a"); ?>
                    </a>
                </li>
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="index.php?action=galerie&tri=n-asc">
                        <i class="icon-chevron-up"></i>
                        <?php abbr("menu7b"); ?>
                    </a>
                </li>
            </ul>
        </li>

        <!-- MENU: Fiches -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                <i class="icon-list-alt"></i>
                <?php abbr("menu2"); ?>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                <!-- Nouvelle fiche -->
                <li role="presentation" class="alert-success">
                    <a role="menuitem" tabindex="-1" href="index.php?action=page_ajouter">
                        <i class="icon-plus-sign"></i>
                        <?php abbr("menu2a"); ?>
                    </a>
                </li>
                <!-- Actions à afficher lorsqu'on est sur la page d'une fiche -->
                <?php if(isset($_GET["action"]) and $_GET['action'] == "page_voir" and is_numeric($_GET['id'])) {?>
                <!-- Modifier la fiche -->
                <li role="presentation" class="alert-info">
                    <a role="menuitem" tabindex="-1" href="index.php?action=page_modifier&id=<?php echo $_GET['id']; ?>">
                        <i class="icon-edit"></i>
                        <?php abbr("menu2c"); ?>
                    </a>
                </li>
                <!-- Supprimer la fiche -->
                <li role="presentation" class="alert-error">
                    <a role="menuitem" tabindex="-1" href="index.php?action=action_supprimer&op=phase1&id=<?php echo $_GET['id']; ?>">
                        <i class="icon-minus-sign"></i>
                        <?php abbr("menu2d"); ?>
                    </a>
                </li>
                <?php } ?>
                <?php if(isset($_GET["action"]) and $_GET['action'] == "action_modifier") {?>
                <!-- Modifier la fiche -->
                <li role="presentation" class="alert-info">
                    <a role="menuitem" tabindex="-1" href="index.php?action=page_modifier&id=<?php echo $_POST['id']; ?>">
                        <i class="icon-edit"></i>
                        <?php abbr("menu2c"); ?>
                    </a>
                </li>
                <!-- Supprimer la fiche -->
                <li role="presentation" class="alert-error">
                    <a role="menuitem" tabindex="-1" href="index.php?action=action_supprimer&op=phase1&id=<?php echo $_POST['id']; ?>">
                        <i class="icon-minus-sign"></i>
                        <?php abbr("menu2d"); ?>
                    </a>
                </li>
                <?php } ?>
                <li class="divider"></li>
                <!-- Affichage (les dernières, tri...) -->
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="index.php?action=page_liste&tri=maj">
                        <i class="icon-eye-open"></i>
                        <?php abbr("menu2i"); ?>
                    </a>
                </li>
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="index.php?action=page_liste&tri=n-asc">
                        <i class="icon-chevron-up"></i>
                        <?php abbr("menu2e"); ?>
                    </a>
                </li>
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="index.php?action=page_liste&tri=n-desc">
                        <i class="icon-chevron-down"></i>
                        <?php abbr("menu2f"); ?>
                    </a>
                </li>
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="index.php?action=page_liste&tri=pr-asc">
                        <i class="icon-chevron-up"></i>
                        <?php abbr("menu2g"); ?>
                    </a>
                </li>
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="index.php?action=page_liste&tri=pr-desc">
                        <i class="icon-chevron-down"></i>
                        <?php abbr("menu2h"); ?>
                    </a>
                </li>
            </ul>
        </li>

        <!-- MENU: Exportation -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                <i class="icon-download-alt"></i>
                <?php dire("menu6"); ?>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                <?php
                /* CAS n°1 => Affichage d'une fiche                                               */
                if(isset($_GET['action']) and $_GET['action'] == "page_voir" and is_numeric($_GET['id'])) {?>
                <!-- Imprimer la fiche courante -->
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="export/imprimer.php?id=<?php echo $_GET['id']; ?>">
                        <i class="icon-print"></i>
                        <?php dire("menu6e"); ?>
                    </a>
                </li>
                <!-- Génération de PDF à la volée: 1 fiche -->
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="export/pdfexport.php?pdf=fiche&id=<?php echo $_GET['id']; ?>">
                        <i class="icon-book"></i>
                        <?php dire("menu6pdf2"); ?>
                    </a>
                </li>
                <li class="divider"></li>
                <?php }
                if(!isset($_GET['action']) or $_GET['action'] != "action_recherche"){
                ?>
                <!-- Génération de PDF à la volée: tout l'annuaire -->
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="export/pdfexport.php?pdf=tout">
                        <i class="icon-book"></i>
                        <?php dire("menu6pdf1"); ?>
                    </a>
                </li>
                <?php
                }
                /* CAS n°2 => Affichage des résultats de recherche                                */
                if(isset($_GET['action']) and $_GET['action'] == "action_recherche") {?>
                <li class="divider"></li>
                <!-- Génération de PDF à la volée: résultats de la recherche -->
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="export/pdfexport.php?pdf=recherche">
                        <i class="icon-book"></i>
                        <?php dire("menu6pdf3"); ?>
                    </a>
                </li>
                <!-- Imprimer les résultats de la recherche -->
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="export/imprimer.php">
                        <i class="icon-print"></i>
                        <?php dire("menu6k"); ?>
                    </a>
                </li>
                <!-- Exporter les résultats de la recherche (CSV) -->
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="export/csvexport.php">
                        <?php dire("menu6b"); ?>
                    </a>
                </li>
                <!-- Exporter les résultats de la recherche (XLS) -->
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="export/xlsexport.php">
                        <?php dire("menu6d"); ?>
                    </a>
                </li>
                <!-- Exporter les résultats de la recherche (XML) -->
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="export/xmlexport.php">
                        <?php dire("menu6j"); ?>
                    </a>
                </li>
                <?php } ?>

                <li class="divider"></li>
                <!-- Exportation rapide (CSV) -->
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="export/csvexport.php?tout=0">
                        <?php dire("menu6l"); ?>
                    </a>
                </li>
                <!-- Exportation rapide (XLS) -->
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="export/xlsexport.php?tout=0">
                        <?php dire("menu6m"); ?>
                    </a>
                </li>
                <!-- Exportation rapide (XML) -->
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="export/xmlexport.php?tout=0">
                        <?php dire("menu6n"); ?>
                    </a>
                </li>

                <?php if($_config['exporter_tout'] == 1) { ?>
                <li class="divider"></li>
                <!-- Exportation rapide (CSV) -->
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="export/csvexport.php?tout=1">
                        <?php dire("menu6a"); ?>
                    </a>
                </li>
                <!-- Exportation rapide (XLS) -->
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="export/xlsexport.php?tout=1">
                        <?php dire("menu6c"); ?>
                    </a>
                </li>
                <!-- Exportation rapide (XML) -->
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="export/xmlexport.php?tout=1">
                        <?php dire("menu6i"); ?>
                    </a>
                </li>
                <?php } ?>

                <li class="divider"></li>
                <!-- Imprimer tout -->
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="export/imprimer.php?tout=1">
                        <i class="icon-print"></i>
                        <?php dire("menu6f"); ?>
                    </a>
                </li>
                <!-- Imprimer tout, trier par PROMOTION -->
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="export/imprimer.php?tout=1&tri=pr">
                        <i class="icon-print"></i>
                        <?php dire("menu6g"); ?>
                    </a>
                </li>
                <!-- Imprimer tout, trier par NOM -->
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="export/imprimer.php?tout=1&tri=nm">
                        <i class="icon-print"></i>
                        <?php dire("menu6h"); ?>
                    </a>
                </li>
            </ul>
        </li>

        <!-- MENU: Langues -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                <i class="icon-flag"></i>
                <?php abbr("menu3"); ?>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="index.php?action=action_langue&lang=fr">
                        <?php dire("menu3a"); ?>
                    </a>
                </li>
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="index.php?action=action_langue&lang=es">
                        <?php dire("menu3b"); ?>
                    </a>
                </li>
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="index.php?action=action_langue&lang=en">
                        <?php dire("menu3c"); ?>
                    </a>
                </li>
            </ul>
        </li>

        <!-- MENU: Aide -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                <i class="icon-question-sign"></i>
                <?php abbr("menu5"); ?>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="index.php?action=page_aide&page=about">
                        <i class="icon-info-sign"></i>
                        <?php dire("menu5a"); ?>
                    </a>
                </li>
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="index.php?action=page_aide&page=faq">
                        <i class="icon-question-sign"></i>
                        <?php dire("menu5b"); ?>
                    </a>
                </li>
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="index.php?action=page_aide&page=historique">
                        <i class="icon-list-alt"></i>
                        <?php dire("menu5c"); ?>
                    </a>
                </li>
                <li class="divider"></li>
                <li role="presentation" class="alert-danger">
                    <a role="menuitem" tabindex="-1" href="index.php?action=adminlogin">
                        <i class="icon-fire"></i>
                        <?php dire("menu5d"); ?>
                    </a>
                </li>
            </ul>
        </li>
    </ul>

    <form class="form-inline navbar-form" name="recherche" action="index.php?action=action_recherche" method="post">
    <ul class="nav pull-right">
        <li>
                <input type="text" class="search-query" placeholder="<?php dire("menu0"); ?>" name="requete">
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                <li role="presentation">
                    <select name="champ" id="option_recherche">
                        <option value="defaut" selected="selected"><?php dire("cx"); ?></option>
                        <option value="tous"><?php dire("c0"); ?></option>
                        <option value="nom"><?php dire("c1"); ?></option>
                        <option value="prenom"><?php dire("c2"); ?></option>
                        <option value="promotion"><?php dire("c3"); ?></option>
                        <option value="naissance"><?php dire("c5"); ?></option>
                        <option value="email"><?php dire("c7"); ?></option>
                    </select>
                    <br />
                    <a role="menuitem" tabindex="-1" href="index.php?action=page_aide&page=faq#7">
                        <?php dire("menu5"); ?>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    </form>
  </div>
</div>
