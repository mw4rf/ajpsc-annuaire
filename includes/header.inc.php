<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<!--
/*******************************************************************************
********************************************************************************
**********                          AJPSC Annuaire                    **********
**********                          Version 1.4.2                     **********
**********          Copyright (c) 2006-<?php echo date("Y"); ?> Guillaume Florimond       **********
**********                       www.ajpsc.com                        **********
**********                       www.valhalla.fr                      **********
********************************************************************************
*******************************************************************************/
-->

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>AJPSC.com::Annuaire</title>
	<meta name="generator" content="TextMate http://macromates.com/">
	<meta name="author" content="Guillaume Florimond">
	<!-- Date: 2006-12-08 -->

	<!-- JavaScript -->
		<!-- @GF -->
		<script src="includes/js/scripts.js" type="text/javascript"></script>
		<!-- @Tiecre-Partie : SweetTitles -->
		<script src="includes/js/sweettitles/addEvent.js" type="text/javascript"></script>
		<script src="includes/js/sweettitles/titles.js" type="text/javascript"></script>
        <!-- jQuery -->
        <script src="lib/jquery.js" type="text/javascript"></script>
        <!-- Twitter Bootstrap -->
        <script src="lib/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<!-- // JavaScript -->

	<!-- Favicon -->
	<LINK REL="SHORTCUT ICON" HREF="themes/<?php echo obtenir_theme(); ?>/favicon.ico">

	<!-- Style CSS -->
	<style type="text/css" media="screen">
		@import url("lib/bootstrap/css/bootstrap.min.css");
	</style>

	<!-- Google Analytics - @ GF -->
	<!-- Statistiques globale (ajpsc.com) -->
	<script type="text/javascript">
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	document.write("\<script src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'>\<\/script>" );
	</script>
	<script type="text/javascript">
	var pageTracker = _gat._getTracker("UA-3234441-1");
	pageTracker._initData();
	pageTracker._trackPageview();
	</script>
	<!-- Statistiques Annuaire (annuaire.ajpsc.com) -->
	<script type="text/javascript">
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	document.write("\<script src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'>\<\/script>" );
	</script>
	<script type="text/javascript">
	var pageTracker = _gat._getTracker("UA-3234441-3");
	pageTracker._initData();
	pageTracker._trackPageview();
	</script>
	<!-- / Google Analytics -->

</head>
<body>

<div id="header">
	<div id="logo"></div>
</div>


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