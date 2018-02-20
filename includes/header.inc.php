<!DOCTYPE html>

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
?>

<!--
/*******************************************************************************
********************************************************************************
**********                          AJPSC Annuaire                    **********
**********                          Version <?php echo $_version; ?>                     **********
**********          Copyright (c) 2006-<?php echo date("Y"); ?> Guillaume Florimond       **********
**********                       www.ajpsc.com                        **********
**********                       www.valhalla.fr                      **********
********************************************************************************
*******************************************************************************/
-->

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>AJPSC.com::Annuaire</title>
	<meta name="author" content="Guillaume Florimond">
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
	<LINK REL="SHORTCUT ICON" HREF="lib/favicon.ico">

	<!-- Style CSS -->
	<style type="text/css" media="screen">
		@import url("lib/bootstrap/css/bootstrap.min.css");
        @import url("includes/styles.css");
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

<div id="holder">

    <div id="header">
    	<div id="logo"></div>
    </div>

    <div id="content">