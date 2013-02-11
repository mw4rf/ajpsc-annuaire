<?php
/*
               ANNUAIRE AIDE
SECTION : 8.0 Exportation

Fichier inclus � partir de faq.php
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
	On d�signe sous le nom d'<i>exportation</i> le fait pour un utilisateur d'enregistrer dans un fichier sur son disque dur le contenu de l'annuaire, sous un format exploitable par lui.
</p>

<p class="aide_texte">
	Il est possible d'exporter:
	<ol>
		<li />Toutes les fiches de l'annuaire. (<a href="#8.2">v. n�8.2</a>)
		<li />Les r�sultats d'une recherche. (<a href="#8.3">v. n�8.3</a>)
	</ol>
</p>

<p class="aide_texte">
	Deux types d'exportations sont possibles:
	<ol>
		<li /><b>Exportation rapide</b>: inclut le nom de famille, le pr�nom, la promotion et l'adresse e-mail.
		<li /><b>Exporter tout</b>: inclut toutes les donn�es (les 4 champs de l'exportation rapide, le lieu et la date de naissance et les 7 champs question-r�ponse)
	</ol>
</p>

<p class="aide_texte">
	<b>Important</b>:
	<ul>
	<li />La question personnelle et la r�ponse secr�te associ�es � chaque fiche ne sont <i>pas</i> export�es.
	<li />Les administrateurs ont pu restreindre l'exportation aux seuls champs pr�vus dans le cadre de l'exportation rapide. Dans ce cas, "Exporter tout" donnera les m�mes r�sultats que "Exportation rapide".
	</ul>
</p>

<p class="aide_section"><a name="8.2"></a>
8.2 Comment exporter tout le contenu de l'annuaire ?
</p>

<p class="aide_texte">
	Pour exporter tout le contenu de l'annuaire, cliquez sur <b>Exportation</b> dans la barre de menu, puis sur <b>Exporter tout</b> ou <b>Exportation rapide</b>. Pour les diff�rences entre ces deux modes d'exportation, <a href="#8.1">v. n�8.1</a>.
</p>

<p class="aide_texte">
	Vous pouvez exporter les donn�es dans 3 formats diff�rents:
	<ol>
		<li />Format CSV (<a href="#8.4">v. n�8.4</a>)
		<li />Fichier XLS (<a href="#8.5">v. n�8.5</a>)
		<li />Format XML (<a href="#8.6">v. n�8.6</a>)
	</ol>
</p>

<p class="aide_section"><a name="8.3"></a>
8.3 Comment exporter les r�sultats d'une recherche ?
</p>

<p class="aide_texte">
	Pour exporter les r�sultats d'une recherche, cliquez sur <b>Exportation</b> dans la barre de menu, puis sur <b>Exporter les r�sultats de la recherche</b> dans le sous-menu.
</p>

<p class="aide_texte">
	Vous pouvez exporter les donn�es dans 3 formats diff�rents:
	<ol>
		<li />Format CSV (<a href="#8.4">v. n�8.4</a>)
		<li />Fichier XLS (<a href="#8.5">v. n�8.5</a>)
		<li />Format XML (<a href="#8.6">v. n�8.6</a>)
	</ol>
</p>

<p class="aide_section"><a name="8.4"></a>
8.4 Comment utiliser le fichier CSV ?
</p>

<p class="aide_texte">
	Le fichier CSV est un fichier de valeurs tabulaires <i>s�par�es par des virgules</i> (CSV pour <i>Coma Separated Values</i>). Il s'agit d'un format standard pour l'exportation du contenu des bases de donn�es. Vous pouvez effectuer toutes sortes de manipulations sur ces donn�es (<a href="#8.7">v. n�8.7</a>).
</p>

<p class="aide_section"><a name="8.5"></a>
8.5 Comment utiliser le fichier XLS ?
</p>

<p class="aide_texte">
	Le fichier XLS n'est pas un v�ritable fichier Excel. En effet, les sp�cifications du format Excel ne sont pas publiques (tout du moins pour les versions ant�rieures � Office 2007, non-bas�es sur OpenXML), et il est tr�s difficile de g�n�rer un fichier r�pondant exactement � ces sp�cifications.
</p>

<p class="aide_texte">
	Le fichier cr�� par l'exportation XLS est en r�alit� un fichier CSV d�guis� (type MIME et extension) en fichier Excel. Il s'ouvrira par d�faut dans Microsoft Excel, mais il n'est pas diff�rent du fichier CSV (<a href="#8.4">v. n�8.4</a>).
</p>

<p class="aide_section"><a name="8.6"></a>
8.6 Comment utiliser le fichier XML ? (experts)
</p>

<p class="aide_texte">
	Le fichier XML est r�serv� aux personnes d�sirant r�aliser un logiciel de traitement des donn�es. M�me s'il peut parfois �tre utilis� directement dans une application existante, il est conseill� d'utiliser le format CSV pour cela.
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
8.7 Techniquement, que puis-je faire avec les donn�es export�es ?
</p>

<p class="aide_texte">
	Tout l'int�r�t d'exporter les donn�es de l'annuaire est de pouvoir par la suite les r�utiliser dans un autre logiciel. Vous pouvez notamment les utiliser dans les logiciels suivants:
	<ul>
		<li /><i>Microsoft Excel</i> ou tout autre <i>tableur</i>: sous forme de tableau, une colonne repr�sente un champ, une ligne repr�sente un enregistrement.
		<li /><i>Filemaker</i> ou tout autre logiciel de BDD: sous forme de fiches, par le biais du syst�me d'importation CSV du logiciel.
		<li />Logiciels de gestion des contacts: par le biais de l'importation CSV.
		<li /><i>Microsoft Word</i>: pour r�aliser un mod�le de fusion et publipostage, � partir d'une source de donn�es CSV, Excel (ouvrez le fichier dans Excel et re-enregistrez le au format Excel) ou Filemaker. Pour plus de pr�cisions, <a href="#8.8">v. n�8.8</a>.
	</ul>
</p>

<!-- 8.8 Comment cr�er un mod�le de fusion dans MS Word -->
<p class="aide_section"><a name="8.8"></a>
8.8 Comment cr�er un mod�le de fusion dans MS Word ?
</p>

<p class="aide_texte">
	L'annuaire est en r�alit� une base de donn�es. C'est-�-dire qu'elle contient des <i>champs</i> et que ces champs contiennent des <i>donn�es</i>. Il est possible de cr�er un document dans MS Word qui contient une r�f�rence vers les champs, puis de demander � Word de remplacer ces r�f�rences par le contenu des champs, c'est-�-dire par les donn�es. Ce proc�d� est connu sous le nom de <i>cr�ation d'un mod�le de fusion</i>.
</p>

<p class="aide_texte">
	La cr�ation d'un mod�le de fusion est assez complexe. L'op�ration se d�roule en effet en plusieurs �tapes:
	<ol>
		<li />Exportation des enregistrements de la base de donn�es (format CSV).
		<li />Cr�ation d'un document vierge de fusion dans Word
		<li />Cr�ation et configuration de la source de donn�es
		<li />Cr�ation du mod�le avec les champs de fusion
		<li />Cr�ation du document final avec les donn�es
	</ol>
</p>

<p class="aide_texte">
	1) Exportation des enregistrements de la base de donn�es (format CSV)
</p>
<p class="aide_texte">
	Pour la proc�dure, v. <a href="#8.2">n�8.2</a> et <a href="#8.4">n�8.4</a>.
</p>

<p class="aide_texte">
	2) Cr�ation d'un document vierge de fusion dans Word
</p>
<p class="aide_texte">
	Les �tapes sont les suivantes:
	<ol>
		<li />Menu <b>Fichier > Nouveau document</b> (vierge)
		<li />Menu <b>Outils</b>: cliquez sur <b>Gestionnaire de fusion de donn�es</b>. v�rifiez que cette option dans le menu est maintenant <i>coch�e</i> (petit V � gauche du texte).
		<li />Dans le panneau <i>Gestionnaire de fusion de donn�es</i>, sous <i>Document principal</i>, cliquez sur <b>Cr�er</b> et choisissez <b>Catalogue</b> dans le menu d�roulant.
		<li />Dans le panneau <i>Gestionnaire de fusion de donn�es</i>, sous <i>Source de donn�es</i>, cliquez sur <b>Lire les donn�es</b> et choisissez <b>Ouvrir la source de donn�es</b> dans le menu d�roulant.
		<li />Dans la bo�te de dialogue qui s'ouvre, s�lectionnez le fichier CSV issu de l'exportation des donn�es de l'annuaire (�tape 1).
	</ol>
</p>

<p class="aide_texte">
	3) Configuration de la source de donn�es
</p>
<p class="aide_texte">
	Les �tapes sont les suivantes:
	<ol>
		<li />
	</ol>
</p>

<p class="aide_texte">
	4) Cr�ation du mod�le avec les champs de fusion
</p>
<p class="aide_texte">
	Les �tapes sont les suivantes:
	<ol>
		<li />Ecrivez ce que vous avez � �crire dans le document ouvert. Imaginez pour cela qu'il s'agit d'un enregistrement par d�faut, et que tous les autres enregistrements seront pr�sent�s de la m�me mani�re. De cette mani�re, <i>vous ne devez �crire que ce qui n'est pas susceptible de modification d'un enregistrement � l'autre</i>. Par exemple, �crivez: <i>Le pr�nom est , le nom de famille est , et l'adresse est .</i>
		<li />Dans le panneau <i>Gestionnaire de fusion de donn�es</i> (ouvert � l'�tape 2), sous <i>Champ de fusion</i>, cliquez sur un �l�ment et amenez-le par un glisser-d�poser (drag&drop) dans votre document, � l'endroit o� il devra se situer. Pour reprendre l'exemple pr�c�dent, glissez-d�posez l'�l�ment "pr�nom" dans l'espace vide laiss� entre le premier <i>est</i> et la virgule, puis faites de m�me pour "nom" et "adresse", � leurs places respectives.
		<li />Optionnel: ajoutez un saut de page � la fin de la page (Menu <b>Insertion > Saut > Saut de page</b>). Chaque enregistrement sera ainsi affich� sur une page.
	</ol>
</p>

<p class="aide_texte">
	5) Cr�ation du document final avec les donn�es
</p>
<p class="aide_texte">
	Les �tapes sont les suivantes:
	<ol>
		<li />Dans le panneau <i>Gestionnaire de fusion de donn�es</i> (ouvert � l'�tape 2), sous <i>Fusionner</i>, cliquez sur l'ic�ne qui repr�sente un document vierge (<i>Fusionner vers un nouveau document</i>).
		<li />Un nouveau document s'ouvre dans une nouvelle fen�tre: vous n'avez plus qu'� modifier manuellement ce qui doit l'�tre et � enregistrer ou imprimer ce fichier.
	</ol>
</p>

<!-- 8.9 Quels sont mes droits et mes obligations vis-�-vis des donn�es export�es ? -->
<p class="aide_section"><a name="8.9"></a>
8.9 Quels sont mes droits et mes obligations vis-�-vis des donn�es export�es ?
</p>

<p class="aide_texte">
	R�serv�
</p>

<!-- 8.10 Qu'est ce que l'exportation "PDF" ? -->
<p class="aide_section"><a name="8.10"></a>
8.10 Qu'est ce que l'exportation "PDF" ?
</p>

<p class="aide_texte">
	L'exportation PDF g�n�re un fichier au format PDF pr�t � �tre imprim�. Si vous souhaitez imprimer le contenu de l'annuaire et que vous n'avez pas besoin de modifier les donn�es avant cela, l'utilisation du format PDF repr�sente de tr�s loin la meilleure solution.
</p>

<p class="aide_texte">
	En r�alit�, il est impropre de parler d'exportation PDF, m�me si la fonction est accessible depuis le menu <i>Exportation</i> de l'annuaire. Pour �tre correct, il faut parler d'impression PDF. C'est pour cette raison que les d�veloppements sur le format PDF sont r�alis�es dans le chapitre suivant qui concerne l'impression. Pour de plus amples informations, v. <a href="#9.5">n�9.5</a>
</p>


























