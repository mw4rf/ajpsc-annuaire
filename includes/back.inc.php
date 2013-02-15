
    <?php
    /* Afficher le lien de retour vers les résultats de la recherche  */
    if(isset($_GET["action"])
        and $_GET["action"] == "page_voir"
        and isset($_SESSION["searchquery-rq"])
        and isset($_SESSION["searchquery-ch"])
        and isset($_GET["prov"])
        and $_GET["prov"]=="search")
    { ?>
    <div class="container" style="text-align: center;">
        <p>
        <a class="btn btn-info" href="index.php?action=action_recherche&searchquery=1">
            <i class="icon-arrow-left icon-white"></i>
            <?php abbr("retour_recherche"); ?>
        </a>
        </p>
    </div>
    <?php
    }
    ?>