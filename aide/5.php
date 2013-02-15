<?php
/*
               ANNUAIRE AIDE
SECTION : Voir les fiches

Fichier inclus à partir de faq.php
*/
?>

<!-- 5. Voir les fiches -->
<p class="aide_chapitre"><a name="5"></a>
5. Voir les fiches (liste et fiche)
</p>

<!-- 5.1 Qu'est-ce qu'une fiche ? -->
<p class="aide_section"><a name="5.1"></a>
5.1 Qu'est-ce qu'une fiche ?
</p>

<p class="aide_texte">
	V. la <a href="#2.1">section 2.1</a> à ce propos.
</p>

<!-- 5.2 Comment voir la liste des fiches ? -->
<p class="aide_section"><a name="5.2"></a>
5.2 Comment voir la liste des fiches ?
</p>

<p class="aide_texte">
	Pour voir la liste des fiches, vous devez cliquer sur <b>Voir les fiches</b> dans le menu principal, ou cliquer sur <b>Fiches</b> dans le menu principal et choisir ensuite <b>Voir les fiches - Trier par...</b> dans le sous-menu.
</p>

<p class="aide_texte">
	La première option vous permet de voir toutes les fiches, dans l'ordre par défaut (triées par nom de famille, de A à Z). La seconde option vous permet également de voir toutes les fiches, mais en choisissant un critère de tri différent. Pour plus de précisions sur les fonctions de tri, <a href="#6">v. n° 6</a>.
</p>

<p class="aide_texte">
	Pour plus d'informations sur la présentation et le fonctionnement de la liste des fiches, reportez-vous à la <a href="#5.3">v. n° 5.3</a>.
</p>

<!-- 5.3 Qu'est-ce que la liste des fiches ? -->
<p class="aide_section"><a name="5.3"></a>
5.3 Qu'est ce que la liste des fiches ?
</p>

<p class="aide_texte">
	La liste des fiches vous permet de voir toutes les fiches enregistrées dans la base de données, c'est-à-dire toutes les personnes enregistrées dans l'annuaire (<a href="#2.1">v. n° 2.1</a> pour plus de précisions).
</p>

<p class="aide_texte">
	Les données sont affichées de manière "tabulaire", c'est-à-dire que chaque ligne correspond à une fiche et chaque colonne à une information. Voici les colonnes affichées et, donc, les informations disponibles:
	<ul>
		<li />Nom: le(s) nom(s) de famille du titulaire de la fiche.
		<li />Prénom: le(s) prénom(s) du titulaire de la fiche.
		<li />Promotion: la promotion à laquelle appartient le titulaire de la fiche (c'est-à-dire <i>l'année au terme de laquelle il recevra son diplôme</i>).
		<li />Adresse e-mail: l'adresse de courrier électronique du titulaire de la fiche.
	</ul>
</p>

<p class="aide_texte">
	La liste des fiches est répartie sur plusieurs pages, en fonction du nombre de fiches enregistrées dans l'annuaire (<a href="#5.4">v. n° 5.4</a>). Les fiches peuvent être triées selon plusieurs critères (<a href="#6">v. n° 6</a>). Lorsque le curseur de la souris se situe sur une ligne, cette ligne apparaît en surbrillance: il suffit alors de cliquer pour voir les détails de la fiche correspondante (<a href="#5.5">v. n° 5.5</a>).
</p>

<!-- 5.4 Qu'est ce que la pagination et comment cela fonctionne-t-il ? -->
<p class="aide_section"><a name="5.4"></a>
5.4 Qu'est-ce que la pagination et comment cela fonctionne-t-il ?
</p>

<p class="aide_texte">
	L'annuaire peut contenir un nombre important de fiches. Toutes les afficher sur la même page pourrait nuire aux performances du logiciel et à l'expérience de l'utilisateur: la page serait lourde et très longue à charger, et la navigation dans cette page serait très lente.
</p>

<p class="aide_texte">
	C'est pourquoi les fiches sont réparties sur plusieurs pages. Le nombre de fiches par page est défini par les administrateurs de l'annuaire. Par exemple, si l'annuaire contient 500 fiches et que les administrateurs ont spécifié qu'il fallait afficher 50 fiches par page, il y aura 10 pages.
</p>

<p class="aide_texte">
	Le passage d'une page à l'autre n'affecte ni le tri des fiches (<a href="#6">v. n°6</a>) ni les résultats d'une recherche (<a href="#7.6">v. n°7.6</a>).
</p>

<p class="aide_texte">
	Le système de pagination est affiché en haut de la liste des fiches et en dessous du menu principal de l'annuaire. Il se compose de 3 blocs (de gauche à droite):
	<ol>
		<li />Le nombre total de fiches de l'annuaire et le nombre total de pages: <i>Il y a X fiches sur Y pages</i>.
		<li />La page actuellement affichée (ou page "courante") (X) et le nombre total de pages (Y): <i>Page X/Y</i>. Vous pouvez cliquer sur le numéro de la page courante (X) pour dérouler un menu qui vous permettra d'afficher n'importe quelle autre page.
		<li />Le menu de navigation parmi les fiches:
		<ul>
			<li /><b>&lt;&lt;</b> vous permet de vous rendre à la <i>première</i> page.
			<li /><b>&lt; précédent</b>: vous permet de vous rendre à la page qui précède la page actuellement affichée.
			<li /><b>suivant &gt;</b>: vous permet de vous rendre à la page qui suit la page actuellement affichée.
			<li /><b>&gt;&gt;</b> vous permet de vous rendre à la <i>dernière</i> page.
		</ul>
	</ol>
</p>

<!-- 5.5 Comment voir les détails d'une fiche ? -->
<p class="aide_section"><a name="5.5"></a>
5.5 Comment voir les détails d'une fiche ?
</p>

<p class="aide_texte">
	La liste des fiches ne permet de voir, pour chaque fiche, qu'une partie des informations disponibles (<a href="#5.3">v. n°5.3</a>). Pour accéder aux autres informations, vous devez afficher la fiche complète.
</p>

<p class="aide_texte">
	Pour afficher les détails d'une fiche, positionnez d'abord le curseur de votre souris sur la ligne qui correspond à cette fiche. Cette ligne apparaîtra alors en surbrillance. Cliquez ensuite n'importe où sur cette ligne pour faire apparaître la fiche complète.
</p>