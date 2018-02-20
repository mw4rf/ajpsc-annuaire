
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