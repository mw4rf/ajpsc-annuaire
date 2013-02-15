<?php
/*
               ANNUAIRE AIDE
SECTION : 8.0 Exportation

Fichier inclus à partir de faq.php
*/
?>

<!-- 8. Exportation -->
<p class="aide_chapitre"><a name="8"></a>
8. Exportation
</p>
<p class="aide_section"><a name="8.1"></a>
8.1 Qu'est ce que l'exportation ?
</p>

<p class="aide_texte">
	On désigne sous le nom d'<i>exportation</i> le fait pour un utilisateur d'enregistrer dans un fichier sur son disque dur le contenu de l'annuaire, sous un format exploitable par lui.
</p>

<p class="aide_texte">
	Il est possible d'exporter:
	<ol>
		<li />Toutes les fiches de l'annuaire. (<a href="#8.2">v. n°8.2</a>)
		<li />Les résultats d'une recherche. (<a href="#8.3">v. n°8.3</a>)
	</ol>
</p>

<p class="aide_texte">
	Deux types d'exportations sont possibles:
	<ol>
		<li /><b>Exportation rapide</b>: inclut le nom de famille, le prénom, la promotion et l'adresse e-mail.
		<li /><b>Exporter tout</b>: inclut toutes les données (les 4 champs de l'exportation rapide, le lieu et la date de naissance et les 7 champs question-réponse)
	</ol>
</p>

<p class="aide_texte">
	<b>Important</b>:
	<ul>
	<li />La question personnelle et la réponse secrète associées à chaque fiche ne sont <i>pas</i> exportées.
	<li />Les administrateurs ont pu restreindre l'exportation aux seuls champs prévus dans le cadre de l'exportation rapide. Dans ce cas, "Exporter tout" donnera les mêmes résultats que "Exportation rapide".
	</ul>
</p>

<p class="aide_section"><a name="8.2"></a>
8.2 Comment exporter tout le contenu de l'annuaire ?
</p>

<p class="aide_texte">
	Pour exporter tout le contenu de l'annuaire, cliquez sur <b>Exportation</b> dans la barre de menu, puis sur <b>Exporter tout</b> ou <b>Exportation rapide</b>. Pour les différences entre ces deux modes d'exportation, <a href="#8.1">v. n°8.1</a>.
</p>

<p class="aide_texte">
	Vous pouvez exporter les données dans 3 formats différents:
	<ol>
		<li />Format CSV (<a href="#8.4">v. n°8.4</a>)
		<li />Fichier XLS (<a href="#8.5">v. n°8.5</a>)
		<li />Format XML (<a href="#8.6">v. n°8.6</a>)
	</ol>
</p>

<p class="aide_section"><a name="8.3"></a>
8.3 Comment exporter les résultats d'une recherche ?
</p>

<p class="aide_texte">
	Pour exporter les résultats d'une recherche, cliquez sur <b>Exportation</b> dans la barre de menu, puis sur <b>Exporter les résultats de la recherche</b> dans le sous-menu.
</p>

<p class="aide_texte">
	Vous pouvez exporter les données dans 3 formats différents:
	<ol>
		<li />Format CSV (<a href="#8.4">v. n°8.4</a>)
		<li />Fichier XLS (<a href="#8.5">v. n°8.5</a>)
		<li />Format XML (<a href="#8.6">v. n°8.6</a>)
	</ol>
</p>

<p class="aide_section"><a name="8.4"></a>
8.4 Comment utiliser le fichier CSV ?
</p>

<p class="aide_texte">
	Le fichier CSV est un fichier de valeurs tabulaires <i>séparées par des virgules</i> (CSV pour <i>Coma Separated Values</i>). Il s'agit d'un format standard pour l'exportation du contenu des bases de données. Vous pouvez effectuer toutes sortes de manipulations sur ces données (<a href="#8.7">v. n°8.7</a>).
</p>

<p class="aide_section"><a name="8.5"></a>
8.5 Comment utiliser le fichier XLS ?
</p>

<p class="aide_texte">
	Le fichier XLS n'est pas un véritable fichier Excel. En effet, les spécifications du format Excel ne sont pas publiques (tout du moins pour les versions antérieures à Office 2007, non-basées sur OpenXML), et il est très difficile de générer un fichier répondant exactement à ces spécifications.
</p>

<p class="aide_texte">
	Le fichier créé par l'exportation XLS est en réalité un fichier CSV déguisé (type MIME et extension) en fichier Excel. Il s'ouvrira par défaut dans Microsoft Excel, mais il n'est pas différent du fichier CSV (<a href="#8.4">v. n°8.4</a>).
</p>

<p class="aide_section"><a name="8.6"></a>
8.6 Comment utiliser le fichier XML ? (experts)
</p>

<p class="aide_texte">
	Le fichier XML est réservé aux personnes désirant réaliser un logiciel de traitement des données. Même s'il peut parfois être utilisé directement dans une application existante, il est conseillé d'utiliser le format CSV pour cela.
</p>

<p class="aide_texte">
	La DTD du fichier XLM est la suivante:
</p>

<p class="aide_texte">
	&lt;!DOCTYPE annuaire [<br />
	  			&lt;!ELEMENT annuaire    (personne+)><br />
				&lt;!ELEMENT personne    (donnees, questions)><br />
				&lt;!ELEMENT donnees    (nom, prenom, promotion, lieu_naissance, date_naissance, adresse, e-mail)><br />
				&lt;!ELEMENT questions    (reponse1, reponse2, reponse3, reponse4, reponse5, reponse6, notes)><br />
	  			&lt;!ELEMENT nom      (#PCDATA)><br />
	  			&lt;!ELEMENT prenom    (#PCDATA)><br />
	  			&lt;!ELEMENT promotion (#PCDATA)><br />
	  			&lt;!ELEMENT lieu_naissance    (#PCDATA)><br />
				&lt;!ELEMENT date_naissance      (#PCDATA)><br />
				&lt;!ELEMENT adresse      (#PCDATA)><br />
				&lt;!ELEMENT e-mail      (#PCDATA)><br />
				&lt;!ELEMENT reponse1      (#PCDATA)><br />
				&lt;!ELEMENT reponse2      (#PCDATA)><br />
				&lt;!ELEMENT reponse3      (#PCDATA)><br />
				&lt;!ELEMENT reponse4      (#PCDATA)><br />
				&lt;!ELEMENT reponse5      (#PCDATA)><br />
				&lt;!ELEMENT reponse6      (#PCDATA)><br />
				&lt;!ELEMENT notes      (#PCDATA)><br />
				]&gt;
</p>

<p class="aide_section"><a name="8.7"></a>
8.7 Techniquement, que puis-je faire avec les données exportées ?
</p>

<p class="aide_texte">
	Tout l'intérêt d'exporter les données de l'annuaire est de pouvoir par la suite les réutiliser dans un autre logiciel. Vous pouvez notamment les utiliser dans les logiciels suivants:
	<ul>
		<li /><i>Microsoft Excel</i> ou tout autre <i>tableur</i>: sous forme de tableau, une colonne représente un champ, une ligne représente un enregistrement.
		<li /><i>Filemaker</i> ou tout autre logiciel de BDD: sous forme de fiches, par le biais du système d'importation CSV du logiciel.
		<li />Logiciels de gestion des contacts: par le biais de l'importation CSV.
		<li /><i>Microsoft Word</i>: pour réaliser un modèle de fusion et publipostage, à partir d'une source de données CSV, Excel (ouvrez le fichier dans Excel et re-enregistrez le au format Excel) ou Filemaker. Pour plus de précisions, <a href="#8.8">v. n°8.8</a>.
	</ul>
</p>

<!-- 8.8 Comment créer un modèle de fusion dans MS Word -->
<p class="aide_section"><a name="8.8"></a>
8.8 Comment créer un modèle de fusion dans MS Word ?
</p>

<p class="aide_texte">
	L'annuaire est en réalité une base de données. C'est-à-dire qu'elle contient des <i>champs</i> et que ces champs contiennent des <i>données</i>. Il est possible de créer un document dans MS Word qui contient une référence vers les champs, puis de demander à Word de remplacer ces références par le contenu des champs, c'est-à-dire par les données. Ce procédé est connu sous le nom de <i>création d'un modèle de fusion</i>.
</p>

<p class="aide_texte">
	La création d'un modèle de fusion est assez complexe. L'opération se déroule en effet en plusieurs étapes:
	<ol>
		<li />Exportation des enregistrements de la base de données (format CSV).
		<li />Création d'un document vierge de fusion dans Word
		<li />Création et configuration de la source de données
		<li />Création du modèle avec les champs de fusion
		<li />Création du document final avec les données
	</ol>
</p>

<p class="aide_texte">
	1) Exportation des enregistrements de la base de données (format CSV)
</p>
<p class="aide_texte">
	Pour la procédure, v. <a href="#8.2">n°8.2</a> et <a href="#8.4">n°8.4</a>.
</p>

<p class="aide_texte">
	2) Création d'un document vierge de fusion dans Word
</p>
<p class="aide_texte">
	Les étapes sont les suivantes:
	<ol>
		<li />Menu <b>Fichier > Nouveau document</b> (vierge)
		<li />Menu <b>Outils</b>: cliquez sur <b>Gestionnaire de fusion de données</b>. vérifiez que cette option dans le menu est maintenant <i>cochée</i> (petit V à gauche du texte).
		<li />Dans le panneau <i>Gestionnaire de fusion de données</i>, sous <i>Document principal</i>, cliquez sur <b>Créer</b> et choisissez <b>Catalogue</b> dans le menu déroulant.
		<li />Dans le panneau <i>Gestionnaire de fusion de données</i>, sous <i>Source de données</i>, cliquez sur <b>Lire les données</b> et choisissez <b>Ouvrir la source de données</b> dans le menu déroulant.
		<li />Dans la boîte de dialogue qui s'ouvre, sélectionnez le fichier CSV issu de l'exportation des données de l'annuaire (étape 1).
	</ol>
</p>

<p class="aide_texte">
	3) Configuration de la source de données
</p>
<p class="aide_texte">
	Les étapes sont les suivantes:
	<ol>
		<li />
	</ol>
</p>

<p class="aide_texte">
	4) Création du modèle avec les champs de fusion
</p>
<p class="aide_texte">
	Les étapes sont les suivantes:
	<ol>
		<li />Ecrivez ce que vous avez à écrire dans le document ouvert. Imaginez pour cela qu'il s'agit d'un enregistrement par défaut, et que tous les autres enregistrements seront présentés de la même manière. De cette manière, <i>vous ne devez écrire que ce qui n'est pas susceptible de modification d'un enregistrement à l'autre</i>. Par exemple, écrivez: <i>Le prénom est , le nom de famille est , et l'adresse est .</i>
		<li />Dans le panneau <i>Gestionnaire de fusion de données</i> (ouvert à l'étape 2), sous <i>Champ de fusion</i>, cliquez sur un élément et amenez-le par un glisser-déposer (drag&drop) dans votre document, à l'endroit où il devra se situer. Pour reprendre l'exemple précédent, glissez-déposez l'élément "prénom" dans l'espace vide laissé entre le premier <i>est</i> et la virgule, puis faites de même pour "nom" et "adresse", à leurs places respectives.
		<li />Optionnel: ajoutez un saut de page à la fin de la page (Menu <b>Insertion > Saut > Saut de page</b>). Chaque enregistrement sera ainsi affiché sur une page.
	</ol>
</p>

<p class="aide_texte">
	5) Création du document final avec les données
</p>
<p class="aide_texte">
	Les étapes sont les suivantes:
	<ol>
		<li />Dans le panneau <i>Gestionnaire de fusion de données</i> (ouvert à l'étape 2), sous <i>Fusionner</i>, cliquez sur l'icône qui représente un document vierge (<i>Fusionner vers un nouveau document</i>).
		<li />Un nouveau document s'ouvre dans une nouvelle fenêtre: vous n'avez plus qu'à modifier manuellement ce qui doit l'être et à enregistrer ou imprimer ce fichier.
	</ol>
</p>

<!-- 8.9 Quels sont mes droits et mes obligations vis-à-vis des données exportées ? -->
<p class="aide_section"><a name="8.9"></a>
8.9 Quels sont mes droits et mes obligations vis-à-vis des données exportées ?
</p>

<p class="aide_texte">
	Réservé
</p>

<!-- 8.10 Qu'est ce que l'exportation "PDF" ? -->
<p class="aide_section"><a name="8.10"></a>
8.10 Qu'est ce que l'exportation "PDF" ?
</p>

<p class="aide_texte">
	L'exportation PDF génère un fichier au format PDF prêt à être imprimé. Si vous souhaitez imprimer le contenu de l'annuaire et que vous n'avez pas besoin de modifier les données avant cela, l'utilisation du format PDF représente de très loin la meilleure solution.
</p>

<p class="aide_texte">
	En réalité, il est impropre de parler d'exportation PDF, même si la fonction est accessible depuis le menu <i>Exportation</i> de l'annuaire. Pour être correct, il faut parler d'impression PDF. C'est pour cette raison que les développements sur le format PDF sont réalisées dans le chapitre suivant qui concerne l'impression. Pour de plus amples informations, v. <a href="#9.5">n°9.5</a>
</p>


























