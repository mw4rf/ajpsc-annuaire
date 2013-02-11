<?php
/*
               ANNUAIRE AIDE
SECTION : Rechercher des fiches

Fichier inclus � partir de faq.php
*/
?>

<!-- 7. Rechercher des fiches -->
<p class="aide_chapitre"><a name="7"></a>
7. Rechercher des fiches
</p>

<!-- 7.1 Qu'est-ce que la recherche ? -->
<p class="aide_section"><a name="7.1"></a>
7.1 Qu'est-ce que la recherche ?
</p>

<p class="aide_texte">
	La recherche, comme son nom l'indique, vous permet de rechercher (et de trouver !) parmi toutes les fiches de l'annuaire celles qui r�pondent � une condition pr�cise.
</p>

<p class="aide_texte">
	Il s'agit par exemple de dire � la base de donn�e "<i>affiche toutes les fiches des �tudiants de la promotion 2006</i>" ou "<i>affiche toutes les fiches qui contiennent l'expression </i> droit international priv�".
</p>

<!-- 7.2 Quels sont les diff�rents types de recherches ? -->
<p class="aide_section"><a name="7.2"></a>
7.2 Quels sont les diff�rents types de recherches ?
</p>

<p class="aide_texte">
	Il existe actuellement 5 types de recherche:
	<ol>
		<li />La recherche automatique (<i>conseill�e</i>) (<a href="#7.3">v. n�7.3</a>)
		<li />La recherche diffuse (<a href="#7.4">v. n�7.4</a>)
		<li />La recherche focalis�e (<a href="#7.5">v. n�7.5</a>)
		<li />La recherche bas�e sur les expressions r�guli�res (<a href="#7.10">v. n�7.10</a>)
		<li />La recherche s�mantique (<a href="#7.11">v. n�7.11</a>)
	</ol>
</p>

<!-- 7.3 Qu'est ce que la recherche automatique et comment effectuer une recherche automatique ? -->
<p class="aide_section"><a name="7.3"></a>
7.3 Qu'est ce que la recherche automatique et comment effectuer une recherche automatique ?
</p>

<p class="aide_texte">
	La recherche automatique vous permet de recherche le ou les mot(s)-cl�(s) sp�cifi�(s) dans le champ de recherche dans toute la base de donn�es. C'est le type de recherche conseill� par d�faut. Si vous entrez plusieurs mots-cl�s, la recherche sera cumulative: elle retournera les fiches qui contiennent au moins l'un des mots-cl�s saisis.
</p>

<p class="aide_texte">
	<u>Exemples</u>:
	<ul>
		<li />Si vous tapez <i>2006</i>, la recherche ne portera que sur les champs promotion et date de naissance.
		<li />Si vous tapez <i>martin</i>, la recherche portera sur tous les champs de texte (nom, pr�nom, e-mail ainsi que tous les champs de "contenu").
		<li />Si vous tapez <i>martin 2006</i>, <i>martin</i> sera recherch� dans tous les champs de texte, et <i>2006</i> dans le champ promotion et dans le champ date. Seront affich�es dans les r�sultats les fiches qui contiennent <i>martin</i>, les fiches qui contiennent <i>2006</i>, et celles qui contiennent � la fois <i>martin</i> et <i>2006</i>.
	</ul>
</p>

<p class="aide_texte">
	<u>Exclusion des mots g�n�riques</u>
	<br />
	Certains mots g�n�riques sont automatiquement exclus de la recherche automatique. Il s'agit de certains mots propres � une langue qui, parce qu'ils sont n�cessaire � l'organisation grammaticale de la phrase, sont utilis�s tr�s souvent et perdent de ce fait toute pertinence dans une recherche. Il s'agit par exemple, en fran�ais, des mots "le", "la", "les", "un", "une", "de", "des", etc.
</p>

<p class="aide_texte">
	<u>Prise en charge des mots incomplets</u>
	<br />
	La recherche intelligente prend en consid�ration des cha�nes de caract�res et non des mots. Par exemple, si vous cherchez "mer", qui est un mot en soi, les r�sultats seront les fiches contenant "<u>mer</u>", "<u>mer</u>veille", "<u>mer</u>cantile", "<u>mer</u>cerie", "ab�<u>mer</u>", "ai<u>mer</u>", "a<u>mer</u>rir", etc.
	<br />
	Il est fr�quent, dans les moteurs de recherche, d'utiliser des <i>wildcards</i> ou, en fran�ais, des <i>jokers</i>. Ainsi, l'�toile (*) repr�sente une s�quence de plusieurs lettres ind�termin�es alors que le point d'interrogation (?) repr�sente une seule lettre ind�termin�e. Ces jokers n'existent pas dans le moteur de recherche de l'annuaire. Le comportement recherch� par le point d'interrogation peut �tre obtenu avec les expressions r�guli�res (<a href="#7.10">v. n�7.10</a>: <i>regex=x(.?)y</i>) et celui obtenu avec l'�toile est d�j� le comportement par d�faut. Ainsi, rechercher <i>mer</i> avec la recherche intelligente revient � rechercher <i>*mer*</i> dans les moteurs de recherche bas�s sur les jokers.
</p>

<p class="aide_texte">
	Pour ne recherche que le mot "mer" � l'exclusion des mots qui <i>contiennent</i> la cha�ne "mer", il faut entourer le mot de parenth�ses: <b>(</b> et <b>)</b>. Par exemple: <i>(mer)</i>. Cela revient � effectuer une recherche s�mantique (<i>full text search</i>) qui consid�re que chaque cha�ne est un mot � part enti�re (<a href="#7.11">v. n�7.11</a>). Il est �galement possible d'obtenir le m�me r�sultat gr�ce aux expressions r�guli�res (<a href="#7.10">v. n�7.10</a>).
</p>

<p class="aide_texte">
	La prise en charge des mots incomplets ne concerne que la recherches <i>litt�rales</i>, � l'exclusions des recherches <i>num�riques</i>. Ainsi, pour rechercher la promotion 2006, il faudra entrer <i>2006</i> et non <i>06</i>. L'annuaire n'interpr�te pas <i>06</i> comme l'ann�e 2006, mais comme l'an 6 apr�s J.-C...
</p>

<p class="aide_texte">
	<u>Op�rateur d'agr�gation (<b>&&</b>)</u>
	<br />
	Parfois la m�thode de recherche alternative d�crite ci-dessus ne suffit pas. C'est notamment le cas lorsqu'on ne veut rechercher que les fiches qui contiennent tous les termes de la recherche, � l'exclusion de celles qui ne contiennent que certains d'entre eux. C'est � dire, pour reprendre l'exemple pr�c�dent, qu'on veut les fiches qui contiennent � la fois <i>martin</i> et <i>2006</i>, mais pas celles qui ne contiennent que <i>martin</i> ou que <i>2006</i>.
</p>

<p class="aide_texte">
	Dans ce cas, il faut utiliser l'op�rateur d'agr�gation <b>&&</b> entre deux mots, <i><u>sans espace entre ces mots</u></i>. Par exemple, si vous tapez <i>martin&&2006</i>, la recherche ne renverra comme r�sultat que les fiches qui contiennent � la fois <i>martin</i> et <i>2006</i>.
</p>

<p class="aide_texte">
	Il est possible de combiner les espaces et l'op�rateur d'agr�gation <b>&&</b> pour effectuer une recherche plus complexe. Par exemple:
	<ul>
		<li />Si vous tapez <i>martin dupont 2006</i> (cas de cumul simple), les fiches retourn�es seront celles qui contiennent <i>martin</i>, celles qui contiennent <i>dupont</i>, celles qui contiennent <i>2006</i>, celles qui contiennent <i>martin</i> et <i>dupont</i>, celles qui contiennent <i>martin</i> et <i>2006</i> et celles qui contiennent <i>dupont</i> et <i>2006</i>.
		<li />Si vous tapez <i>martin&&dupont&&2006</i> (cas d'agr�gation simple), les fiches retourn�es seront celles qui contiennent � la fois <i>martin</i>, <i>dupont</i> et <i>2006</i>.
		<li />Si vous tapez <i>martin&&dupont 2006</i> (cas mixte), les fiches retourn�es seront celles qui contiennent � la fois <i>martin</i> et <i>dupont</i> mais pas <i>2006</i>, celles qui contiennent <i>2006</i> mais pas <i>martin</i> ni <i>dupont</i>, et celles qui contiennent � la fois <i>martin</i>, <i>dupont</i> et <i>2006</i>. Les fiches qui ne contiennent que <i>martin</i> ou que <i>dupont</i> et qui ne contiennent pas <i>2006</i> ne seront pas affich�es.
	</ul>
</p>

<p class="aide_texte">
	<u>Op�rateur de comparaison num�rique (<b>&lt;</b> ou <b>&gt;</b>)</u>
	<br />
	L'op�rateur de comparaison num�rique vous permet de rechercher une plage de <b>promotions</b>. Cet op�rateur n'a d'effet que sur le champ <b>promotion</b>. Il s'utilise ainsi: <i>2000&lt;2006</i> ou <i>2006&gt;2000</i>. Les r�sultats retourn�s seront toutes les fiches des �tudiants des promotions <i>2000, 2001, 2002, 2003, 2004, 2005 et 2006</i>.
</p>

<p class="aide_texte">
	L'op�rateur de comparaison est dans tous les cas <i>inclusif</i>, c'est-�-dire que les arguments sont inclus dans la recherche (ici, 2000 et 2006). Pour rechercher toutes les fiches qui correspondent aux promotions comprises entre 2000 et 2006, mais pas celles des promotions 2000 et 2006, il faudrait �crire: <i>2001&lt;2005</i> ou <i>2005&gt;2001</i>.
</p>

<p class="aide_texte">
	Notez que si vous voulez op�rer une recherche par plage <i>dans tous les champs</i>, et non seulement dans le champ <i>promotion</i>, vous pouvez obtenir le m�me r�sultat en formulant une expression r�guli�re (<a href="#7.10">v. n�7.10</a>). Dans l'exemple pr�c�dent, la plage des dates comprises entre 2000 et 2006 sera recherch�e dans tous les champs gr�ce � la requ�te suivante: <i>regex=(200[0-6])</i>.
</p>

<p class="aide_texte">
	***
</p>

<p class="aide_texte">
	Pour effectuer une recherche automatique, entrez un ou plusieurs mot(s)-cl�(s) dans le champ de recherche situ� en haut � droite de la page, puis appuyez sur la touche Entr�e ou Retour de votre clavier.
</p>

<!-- 7.4 Qu'est ce que la recherche diffuse et comment effectuer une recherche diffuse ? -->
<p class="aide_section"><a name="7.4"></a>
7.4 Qu'est ce que la recherche diffuse et comment effectuer une recherche diffuse ?
</p>

<p class="aide_texte">
	La recherche diffuse vous permet de chercher une cha�ne de texte compl�te et ordonn�e (une phrase) dans tous les champs de la base de donn�es.
</p>

<p class="aide_texte">
		Pour effectuer une recherche diffuse, entrez un ou plusieurs mot(s)-cl�(s) dans le champ de recherche situ� en haut � droite de la page, cliquez sur le symbole � (plus/moins) � droite de ce champ de recherche, puis s�lectionnez <b>Tous</b> dans le menu d�roulant. Finalement, appuyez sur la touche Entr�e ou Retour de votre clavier.
</p>

<!-- 7.5 Qu'est ce que la recherche focalis�e et comment effectuer une recherche focalis�e ? -->
<p class="aide_section"><a name="7.5"></a>
7.5 Qu'est ce que la recherche focalis�e et comment effectuer une recherche focalis�e ?
</p>

<p class="aide_texte">
	La recherche focalis�e vous permet de chercher un mot, un nombre ou une date dans un champ pr�cis de la base de donn�es.
</p>

<p class="aide_texte">
		Pour effectuer une recherche diffuse, entrez un ou plusieurs mot(s)-cl�(s) dans le champ de recherche situ� en haut � droite de la page, cliquez sur le symbole � (plus/moins) � droite de ce champ de recherche, puis s�lectionnez le crit�re de votre choix parmi ceux propos�s (nom, pr�nom, promotion, date de naissance, e-mail) dans le menu d�roulant. Finalement, appuyez sur la touche Entr�e ou Retour de votre clavier.
</p>

<p class="aide_texte">
	Attention ! Les formats de donn�es ne sont pas contr�l�s: si vous entrez par exemple du texte dans le champ de recherche et que vous lancez la recherche sur le champ "Promotion", qui ne peut contenir que des nombres entiers (les ann�es), la recherche ne pourra aboutir.
</p>

<!-- 7.6 Comment sont affich�s les r�sultats de recherche ? -->
<p class="aide_section"><a name="7.6"></a>
7.6 Comment sont affich�s les r�sultats de recherche ?
</p>

<p class="aide_texte">
	Les r�sultats de recherche sont affich�s dans une liste semblable � la liste des fiches (<a href="#5">v. n�5</a> � ce propos).
</p>

<!-- 7.7 Que faire avec ces r�sultats de recherche ? -->
<p class="aide_section"><a name="7.7"></a>
7.7 Que faire avec ces r�sultats de recherche ?
</p>

<p class="aide_texte">
	Vous pouvez bien entendu afficher les d�tails de toutes les fiches retourn�es par la recherche. Vous pouvez �galement exporter (<a href="#7.8">v. n�7.8</a>) et imprimer (<a href="#7.9">v. n�7.9</a>) ces fiches. En revanche, vous ne pouvez pas appliquer de crit�re de tri sur les r�sultats de recherche.
</p>

<!-- 7.8 Comment exporter les r�sultats d'une recherche ? -->
<p class="aide_section"><a name="7.8"></a>
7.8 Comment exporter les r�sultats d'une recherche ?
</p>

<p class="aide_texte">
	Pour exporter les r�sultats d'une recherche, cliquez choisissez <b>Exporter les r�sultats de la recherche</b> dans le menu <b>Exportation</b>. Pour plus d'information sur l'exportation, reportez-vous � la section <a href="#8">n�8</a>.
</p>

<!-- 7.9 Comment imprimer les r�sultats d'une recherche ? -->
<p class="aide_section"><a name="7.9"></a>
7.9 Comment imprimer les r�sultats d'une recherche ?
</p>

<p class="aide_texte">
	Pour exporter les r�sultats d'une recherche, cliquez choisissez <b>Imprimer les r�sultats de la recherche</b> dans le menu <b>Exportation</b>. Pour plus d'information sur l'impression, reportez-vous � la section <a href="#9">n�9</a>. Vous pouvez aussi imprimer les r�sultats de recherche dans un fichier PDF (<a href="#8.10">v. n�8.10</a>)
</p>

<!-- 7.10 Comment utiliser les expressions r�guli�res dans une recherche ? -->
<p class="aide_section"><a name="7.10"></a>
7.10 Comment utiliser les expressions r�guli�res dans une recherche ?
</p>

<p class="aide_texte">
	Le syst�me de recherche de l'annuaire vous permet d'utiliser les expressions r�guli�res (aussi appel�es <i>regex</i> pour <i>Regular Expressions</i>). Il s'agit d'un mode de recherche ultrapr�cis et tr�s puissant dans la formulation des requ�tes.
</p>

<p class="aide_texte">
	Pour rechercher dans la base de donn�es � l'aide d'une expression r�guli�re, vous devez entrer le mot cl� <b>regex</b> suivi du symbole <b>=</b> et de l'expression r�guli�re.
</p>

<p class="aide_texte">
	<u>Exemples</u>
	<br />
	<i>regex=(2000|2006)</i>
	<br />
	Cette expression recherchera dans la base de donn�es les nombres 2000 et 2006 et renverra toutes les fiches qui contiennent l'un ou l'autre de ces nombres, ou les deux � la fois.
	<br />
	<br />
	<i>regex=(200[0-6])</i>
	<br />
	Cette expression recherchera dans la base de donn�es toutes les fiches qui contiennent au moins un nombre compris entre 2000 et 2006.
	<br />
	<br />
	<i>regex=mer([a-z]+)</i>
	<br />
	Cette expression recherchera tous les mots qui commencent par <i>mer</i> et finissent par un nombre ind�termin� mais non nul de lettres entre A et Z. L'op�rateur + �tant exclusif (1 ou plus), le mot <i>mer</i> lui-m�me ne sera pas recherch�. Pour rechercher �galement le mot <i>mer</i> il faut utiliser l'op�rateur * (0 ou plus) � la place de l'op�rateur +. Pour rechercher <i>n'importe quel caract�re</i> (c'est-�-dire �galement des chiffres et des symboles), il faudrait remplacer <i>[a-z]</i> par un point (.).
	<br />
	<br />
	<i>regex=(.+)mer(.+)</i>
	<br />
	Cette expression recherchera la suite de lettres "mer" � l'int�rieur d'un autre mot. Les mots trouv�s ne pourront ni commencer ni finir par "mer". Pour inclure les mots qui commencent ou qui finissent par "mer", il faudrait remplacer l'op�rateur + par l'op�rateur *. Cette expression est celle par d�faut utilis�e par la recherche automatique sur tous les motifs de recherche (<a href="#7.3">v. n�7.3</a>).
	<br />
	<br />
	<i>regex=mer([a-z]{1,1})redi</i> ou (moins pr�cis) <i>regex=mer(.?)redi</i>
	<br />
	Cette expression peut �tre utilis�e pour remplacer le <i>wildcard</i> point d'interrogation (?), indisponible dans la recherche automatique (<a href="#7.3">v. n�7.3</a>), qui repr�sente 1 lettre ind�termin�e dans un mot. Ici, la lettre sera probablement un <i>c</i>, qui formera le mot <i>mercredi</i>.
	<br />
	<br />
	<i>regex=(^[a-z]*)mer(^[a-z]*)</i>
	<br />
	Cette expression recherche "mer" lorsqu'il s'agit d'un mot ind�pendant, qui n'est pas contenu dans un autre mot.
</p>

<p class="aide_texte">
	<u>Port�e</u>
	<br />
	Les expressions r�guli�res peuvent �tre utilis�es dans les recherches focalis�es (<a href="#7.5">v. n�7.5</a>), dans les recherches diffuses (<a href="#7.4">v. n�7.4</a>) et dans les recherches automatiques (<a href="#7.3">v. n�7.3</a>). C'est la raison pour laquelle si vous tapez dans le champ de recherche <i>regex=(2000|2006)</i>, la recherche ne se limitera pas au champ <i>promotion</i>. Si un utilisateur a indiqu� qu'il est de la promotion 1990, par exemple, mais qu'il a �crit n'importe o� ailleurs dans sa fiche qu'il a effectu� telle ou telle activit� en 2000, sa fiche sera retourn�e en r�sultat de la recherche. La recherche intelligente avec des expressions r�guli�res parcourt tous les champs. Si vous d�sirez ne rechercher que les promotions 2000 ou 2006, vous devriez plut�t effectuer une recherche focalis�e ou �crire une requ�te normale: <i>2000 2006</i>.
</p>

<p class="aide_texte">
	Les recherches bas�es sur les expressions r�guli�res ne prennent pas en compte les autres op�rateurs de recherche, tels que l'op�rateur d'agr�gation <b>&&</b>. Veillez donc � ne pas les utiliser car cela reviendrait � former une requ�te de recherche d�ficiente et aucun r�sultat correct ne serait retourn�. C'est pour cette raison que vous ne devez jamais mettre d'espace dans une expression r�guli�re: l'espace est interpr�t� comme un op�rateur logique <i>ou</i>.
</p>

<p class="aide_texte">
	<u>Syntaxe</u>
	<br />
	La syntaxe des expressions r�guli�res est bas�e sur l'impl�mentation d'Henry Spencer, qui est retenue par MySQL.
	<br />
	<ul style="list-style-type : none;">
		<li /><b>^</b>&nbsp;&nbsp;&nbsp;Correspond � l'op�rateur d'ouverture d'une expression.
		<li /><b>$</b>&nbsp;&nbsp;&nbsp;Correspond � l'op�rateur de fermeture d'une expression.
		<li /><b>.</b>&nbsp;&nbsp;&nbsp;Repr�sente n'importe quel caract�re.

		<li />&nbsp;

		<li /><b>x*</b> ou <b>x{0,}</b>&nbsp;&nbsp;&nbsp;Correspond � 0 ou plus caract�res <i>x</i>.
		<li /><b>x+</b> ou <b>x{1,}</b>&nbsp;&nbsp;&nbsp;Correspond � 1 ou plus caract�res <i>x</i>.
		<li /><b>x?</b> ou <b>x{0,1}</b>&nbsp;&nbsp;&nbsp;Correspond � 0 o� au caract�re <i>x</i>.
		<li /><b>(x)*</b>&nbsp;&nbsp;&nbsp;Correspond � une s�quence de 0 ou plus �l�ments <i>x</i>.
		<li /><b>(x)+</b>&nbsp;&nbsp;&nbsp;Correspond � une s�quence de 1 ou plus �l�ments <i>x</i>.
		<li /><b>(x)?</b>&nbsp;&nbsp;&nbsp;Correspond � 0 ou � la s�quence d'�l�ments <i>x</i>.

		<li />&nbsp;

		<li /><b>abc|xyx</b>&nbsp;&nbsp;&nbsp;Correspond � la s�quence <i>abc</i> <b>ou</b> � la s�quence <i>xyz</i>.

		<li />&nbsp;

		<li /><b>[a-d]</b>&nbsp;&nbsp;&nbsp;Renvoie toutes les valeurs entre <i>a</i> et <i>d</i>, c'est-�-dire <i>a b c d</i>.
		<li /><b>[1-4]</b>&nbsp;&nbsp;&nbsp;Renvoie toutes les valeurs entre <i>1</i> et <i>4</i>, c'est-�-dire <i>1 2 3 4</i>.
		<li /><b>[^a-d]</b>&nbsp;&nbsp;&nbsp;Renvoie toutes les valeurs qui ne sont pas comprises entre <i>a</i> et <i>d</i>.
		<li /><b>[^1-4]</b>&nbsp;&nbsp;&nbsp;Renvoie toutes les valeurs qui ne sont pas comprises entre <i>1</i> et <i>4</i>.

		<li />&nbsp;

		<li /><b>[:character_class:]</b>&nbsp;&nbsp;&nbsp;Remplace la liste des caract�re appartement � la class� sp�cifi�e. Les classes possibles sont les suivantes:
		<ul style="list-style-type : none;">
			<li /><i>alnum</i>&nbsp;&nbsp;&nbsp;Caract�res alpha-num�riques
			<li /><i>alpha</i>&nbsp;&nbsp;&nbsp;Caract�res alphab�tiques
			<li /><i>blank</i>&nbsp;&nbsp;&nbsp;Caract�res espace
			<li /><i>cntrl</i>&nbsp;&nbsp;&nbsp;Caract�res de contr�le
			<li /><i>digit</i>&nbsp;&nbsp;&nbsp;Chiffres
			<li /><i>graph</i>&nbsp;&nbsp;&nbsp;Caract�res graphiques
			<li /><i>lower</i>&nbsp;&nbsp;&nbsp;Minuscules
			<li /><i>print</i>&nbsp;&nbsp;&nbsp;Caract�res graphiques ou espaces
			<li /><i>punct</i>&nbsp;&nbsp;&nbsp;Ponctuation
			<li /><i>space</i>&nbsp;&nbsp;&nbsp;Espace, tabulation, nouvelle ligne et retour chariot
			<li /><i>upper</i>&nbsp;&nbsp;&nbsp;Majuscules
			<li /><i>xdigit</i>&nbsp;&nbsp;&nbsp;Chiffres hexad�cimaux
		</ul>


		<li /><b></b>&nbsp;&nbsp;&nbsp;
		<li /><b></b>&nbsp;&nbsp;&nbsp;
		<li /><b></b>&nbsp;&nbsp;&nbsp;
		<li /><b></b>&nbsp;&nbsp;&nbsp;
	</ul>
</p>

<p class="aide_texte">
	<b>NB</b>: Dans le cas d'une recherche par formulation d'une expression r�guli�re, les r�sultats ne sont pas tri�s par pertinence. La pertinence de chaque r�sultat n'est m�me pas calcul�e. La raison est la suivante: les expressions r�guli�res permettent de formuler des requ�tes conditionnelles. Par hypoth�se, seules les fiches qui satisfont la condition pos�e dans la requ�te sont retourn�es en r�sultat. Par cons�quent, tous les r�sultats ont la m�me pertinence puisqu'ils satisfont tous la m�me condition de la m�me mani�re.
</p>

<!-- 7.11 Comment effectuer une recherche s�mantique ? -->
<p class="aide_section"><a name="7.11"></a>
7.11 Comment effectuer une recherche s�mantique ?
</p>

<p class="aide_texte">
	Vous pouvez effectuer une recherche s�mantique en entourant le terme recherch� de parenth�ses, de cette mani�re: <b><i>(cherchez-moi)</i></b>.
</p>

<p class="aide_texte">
	Cette m�thode de recherche ne concerne que les champs correspondant aux 7 questions. Les champs contenant les donn�es personnelles (nom, pr�nom, date de naissance, promotion, etc.) ne sont pas concern�s.
</p>

<p class="aide_texte">
	La recherche s�mantique est bas�e sur un <i>index</i> qui contient des mots-cl�s. Sont exclus les mots g�n�riques, qui sont tr�s souvent employ�s. Par exemple, dans la phrase (Je vais me baigner � la mer), seuls seront index�s les mots "vais", "baigner" et "mer". La base de donn�es n'a pas de liste pr�d�finie de mots g�n�riques. La liste est construite en fonction du contenu actuel de la base de donn�es. Ainsi, par exemple, dans le cas du pr�sent annuaire, il est probable que les mots "anglais" et "fran�ais" ne soient pas index�s car la plupart des personnes auront entr� des deux langues en tant que langues parl�es, lues ou �crites.
</p>

<p class="aide_texte">
	Les r�sultats sont tri�s par ordre d�croissant de pertinence. Ainsi, si vous recherchez le mot "mer" et que plusieurs fiches sont retourn�es, celle qui contiendra le plus grand nombre d'occurrences de ce mot sera en haut de la liste.
</p>

<p class="aide_texte">
	Le principal int�r�t de la recherche s�mantique est de prendre en compte des phrases compl�tes, compos�es de plusieurs mots. Dans l'exemple pr�c�dent, (Je vais me baigner � la mer), les mots recherch�s sont "vais", "baigner" et "mer": s'ils sont tous les trois pr�sents dans la m�me fiche, cette fiche aura un score de pertinence �lev�. Si une autre fiche contient deux de ces mots, mais pas le troisi�me, sa pertinence sera beaucoup plus faible.
</p>

<p class="aide_texte">
	Les recherches s�mantiques ne prennent pas en compte les autres op�rateurs de recherche, tels que l'op�rateur d'agr�gation <b>&&</b>. Veillez donc � ne pas les utiliser car cela reviendrait � former une requ�te de recherche d�ficiente et aucun r�sultat correct ne serait retourn�.
</p>

<!-- 7.12 Comment fonctionne la "pertinence" des r�sultats de recherche ? -->
<p class="aide_section"><a name="7.12"></a>
7.12 Comment fonctionne la "pertinence" des r�sultats de recherche ?
</p>

<p class="aide_texte">
	Tous les r�sultats affich�s apr�s une recherche r�pondent � la requ�te de recherche formul�e. Mais certains y r�pondent <i>mieux</i> que d'autres. La pertinence vous sert � rep�rer en un coup d'oeil les meilleurs r�sultats.
</p>

<p class="aide_texte">
	<u>Exemple</u>. Imaginons que nous ayons les fiches suivantes:
	<ul style="list-style-type : none;">
		<li>
			<u>Fiche 1</u>
			<ul>
				<li /><b>Nom</b>: Dupont
				<li /><b>Pr�nom</b>: Pierre
				<li /><b>Promotion</b>: 2000
			</ul>
		</li>
		<li>
			<u>Fiche 2</u>
			<ul>
				<li /><b>Nom</b>: Dupont
				<li /><b>Pr�nom</b>: Martin
				<li /><b>Promotion</b>: 2000
			</ul>
		</li>
		<li>
			<u>Fiche 3</u>
			<ul>
				<li /><b>Nom</b>: Dupont
				<li /><b>Pr�nom</b>: Robert
				<li /><b>Promotion</b>: 2005
			</ul>
		</li>
	</ul>
</p>

<p class="aide_texte">
	Imaginons maintenant les requ�tes suivantes, et voyons si certains r�sultats sont plus pertinents que d'autres.
	<ul style="list-style-type : none;">
		<li>
			<u>Recherche</u>: <i>2000</i>
			<ul>
				<li><b>Fiche 1</b>
					<ul>
						<li />Terme de recherche cit�: <b>1</b> fois
						<li />Pertinence: 1/1 soit 100%
					</ul>
				</li>
				<li><b>Fiche 2</b>
					<ul>
						<li />Terme de recherche cit�: <b>1</b> fois
						<li />Pertinence: 1/1 soit 100%
					</ul>
				</li>
				<li><b>Fiche 3</b>
					<ul>
						<li />Terme de recherche cit�: <b>0</b> fois
						<li />Pertinence: 0/1 soit 0%
					</ul>
				</li>
			</ul>
		</li>
		<br />

		<li>
			<u>Recherche</u>: <i>2000 Dupont</i>
			<ul>
				<li><b>Fiche 1</b>
					<ul>
						<li />Terme de recherche 1 cit�: <b>1</b> fois
						<li />Terme de recherche 2 cit�: <b>1</b> fois
						<li />Pertinence: 2/2 soit 100%
					</ul>
				</li>
				<li><b>Fiche 2</b>
					<ul>
						<li />Terme de recherche 1 cit�: <b>1</b> fois
						<li />Terme de recherche 2 cit�: <b>1</b> fois
						<li />Pertinence: 2/2 soit 100%
					</ul>
				</li>
				<li><b>Fiche 3</b>
					<ul>
						<li />Terme de recherche 1 cit�: <b>0</b> fois
						<li />Terme de recherche 2 cit�: <b>1</b> fois
						<li />Pertinence: 1/2 soit 50%
					</ul>
				</li>
			</ul>
		</li>
		<br />

		<li>
			<u>Recherche</u>: <i>2000 Dupont Pierre</i>
			<ul>
				<li><b>Fiche 1</b>
					<ul>
						<li />Terme de recherche 1 cit�: <b>1</b> fois
						<li />Terme de recherche 2 cit�: <b>1</b> fois
						<li />Terme de recherche 3 cit�: <b>1</b> fois
						<li />Pertinence: 3/3 soit 100%
					</ul>
				</li>
				<li><b>Fiche 2</b>
					<ul>
						<li />Terme de recherche 1 cit�: <b>1</b> fois
						<li />Terme de recherche 2 cit�: <b>1</b> fois
						<li />Terme de recherche 3 cit�: <b>0</b> fois
						<li />Pertinence: 2/3 soit 66%
					</ul>
				</li>
				<li><b>Fiche 3</b>
					<ul>
						<li />Terme de recherche 1 cit�: <b>0</b> fois
						<li />Terme de recherche 2 cit�: <b>1</b> fois
						<li />Terme de recherche 3 cit�: <b>0</b> fois
						<li />Pertinence: 1/3 soit 33%
					</ul>
				</li>
			</ul>
		</li>
	</ul>
</p>

<p class="aide_texte">
	Il est clair dans les exemples ci-dessus que tous les r�sultats de recherche n'ont pas la m�me pertinence. Les requ�tes formul�es ci-dessus sont des requ�tes par d�faut, qui utilisent le mot cl� <i>OU</i>. Par exemple, la troisi�me recherche pourrait �tre formul�e en fran�ais: <i>affichez les fiches qui contiennent <u>2000</u> ou <u>Dupont</u> ou <u>Pierre</u></i>. Cela revient � dire: <i>affichez les fiches dans lesquelles appara�t <u>2000</u> et toutes celles dans lesquelles appara�t <u>Dupont</u> et toutes celles dans lesquelles appara�t <u>Pierre</u></i>.
</p>

<p class="aide_texte">
Si une des fiches affich�es en r�sultat contient � la fois <u>2000</u> et <u>Dupont</u>, par exemple, elle n'aura <i>a priori</i> pas plus de valeur qu'une fiche qui ne contient qu'un seul de ces termes. La pertinence intervient ici pour donner plus de valeur � la premi�re fiche. La pertinence est donc d�termin�e -en partie- par le nombre de termes de recherche pr�sents dans chaque r�sultat.
</p>

<p class="aide_texte">
	De m�me, si une des fiches contient plusieurs fois <u>2000</u>, elle n'aura <i>a priori</i> pas plus de valeur qu'une fiche qui ne contient qu'une seule fois <u>2000</u>. L� encore, le m�canisme de pertinence intervient comme correcteur pour donner une plus grande valeur � cette premi�re fiche. La pertinence est donc d�termin�e non seulement par le nombre de terme recherch�s pr�sents dans chaque r�sultat, mais aussi par le nombre d'occurrences de chaque terme recherch�.
</p>

<p class="aide_texte">
	<u>Exemple</u>. Pour reprendre l'exemple pr�c�dent un peu modifi�, imaginons que nous ayons les fiches suivantes:
	<ul style="list-style-type : none;">
		<li>
			<u>Fiche 1</u>
			<ul>
				<li /><b>Nom</b>: Dupont
				<li /><b>Stage en</b>: 2000
				<li /><b>Dans le cabinet</b>: Dupont
				<li /><b>Promotion</b>: 2000
			</ul>
		</li>
		<li>
			<u>Fiche 2</u>
			<ul>
				<li /><b>Nom</b>: Dupont
				<li /><b>Stage en</b>: 2000
				<li /><b>Dans le cabinet</b>: Martin
				<li /><b>Promotion</b>: 2000
			</ul>
		</li>
		<li>
			<u>Fiche 3</u>
			<ul>
				<li /><b>Nom</b>: Dupont
				<li /><b>Stage en</b>: 2000
				<li /><b>Dans le cabinet</b>: Pierre
				<li /><b>Promotion</b>: 2005
			</ul>
		</li>
		<li>
			<u>Fiche 4</u>
			<ul>
				<li /><b>Nom</b>: Dupont
				<li /><b>Stage en</b>: 2007
				<li /><b>Dans le cabinet</b>: Paul
				<li /><b>Promotion</b>: 2006
			</ul>
		</li>
	</ul>
</p>

<p class="aide_texte">
	Imaginons maintenant la requ�te suivante, et voyons si certains r�sultats sont plus pertinents que d'autres.
	<ul style="list-style-type : none;">
		<li>
			<u>Recherche</u>: <i>2000 Dupont</i>
			<ul>
				<li><b>Fiche 1</b>
					<ul>
						<li />Terme de recherche 1 cit�: <b>2</b> fois
						<li />Terme de recherche 2 cit�: <b>2</b> fois
						<li />Pertinence: 4/4 soit 100%
					</ul>
				</li>
				<br />

				<li><b>Fiche 2</b>
					<ul>
						<li />Terme de recherche 1 cit�: <b>2</b> fois
						<li />Terme de recherche 2 cit�: <b>1</b> fois
						<li />Pertinence: 3/4 soit 75%
					</ul>
				</li>
				<br />

				<li><b>Fiche 3</b>
					<ul>
						<li />Terme de recherche 1 cit�: <b>1</b> fois
						<li />Terme de recherche 2 cit�: <b>1</b> fois
						<li />Pertinence: 2/4 soit 50%
					</ul>
				</li>
				<br />

				<li><b>Fiche 4</b>
					<ul>
						<li />Terme de recherche 1 cit�: <b>1</b> fois
						<li />Terme de recherche 2 cit�: <b>0</b> fois
						<li />Pertinence: 1/4 soit 25%
					</ul>
				</li>
			</ul>
		</li>
	</ul>
</p>

<p class="aide_texte">
<u>La pertinence est un m�canisme correcteur qui permet de mettre en valeur les fiches en fonction du nombre de termes recherch�s qu'elles contiennent et du nombre d'occurrences de chacun de ces termes.</u>
</p>

<p class="aide_texte">
L'op�rateur d'agr�gation <b>&&</b> (<a href="#7.3">v. n�7.3</a>) fonctionne en r�alit� comme une exclusion de tous les r�sultats qui n'ont pas un score de pertinence de 100%. Par exemple, <i>2000&&Dupont</i> ne renverra que les fiches qui contiennent � la fois <i>2000</i> et <i>Dupont</i>. C'est-�-dire les fiches qui, abstraction faite du nombre d'occurrences des termes de recherche � l'int�rieur de chaque fiche, ont un score de pertinence de 100%. La seule diff�rence entre la pertinence et l'exclusion par l'op�rateur d'agr�gation est la prise en compte du nombre d'occurrences du terme recherch�.
</p>

<p class="aide_texte">
La pertinence prend parfois en compte des param�tres ext�rieurs � la requ�te. Elle ignore ainsi les restrictions de port�e fix�es � certains champs, pour certains types de recherches. La pertinence est calcul�e en principe pour les requ�tes complexes compos�es, comme dans les exemples ci-dessus. Mais elle n'est calcul�e qu'apr�s que la recherche ait �t� effectu�e. Or, certains termes de recherche ne seront recherch�s que dans certains champs. Dans le premier exemple donn� ci-dessus, <i>2000</i> n'est recherch� que dans les champs num�riques, c'est-�-dire <i>Promotion</i> et <i>Date de naissance</i>. Si une fiche contient le terme <i>2000</i> dans un autre champ, sa pertinence sera <i>plus �lev�e</i> que la pertinence des fiches qui ne contiennent <i>2000</i> que dans le champ <i>Promotion</i> ou dans le champ <i>Date de naissance</i>. En revanche, un fiche ne contenant <i>2000</i> ni dans le champ <i>Promotion</i> ni dans le champ <i>Date de naissance</i> aura obligatoirement une pertinence de 0. De m�me, la motif de recherche <i>2000&lt;2006</i> renvoie toutes les fiches correspondant aux promotions comprises entre 2000 et 2006 (bornes incluses). Par hypoth�se, seules les fiches r�pondant � ce seul et unique crit�re sont affich�es: elles devraient donc toutes avoir, en principe, la m�me pertinence, la pertinence maximale de 100%. Cependant, dans ce cas, la pertinence est calcul�e en fonction de param�tres ext�rieurs � la requ�te: elle ne se limite pas au champ <i>Promotion</i> qui est le seul pris en compte par la recherche. La pertinence sera donc calcul�e en fonction du nombre d'occurrences de chacune des dates pr�sentes dans l'intervalle sp�cifi�.
</p>

<p class="aide_texte">
Il en r�sulte que l'affichage de la pertinence prend en compte les donn�es r�ellement pr�sentes dans la fiche, peu important qu'elles aient �t� ignor�es par la recherche. La pertinence parcourt tous les champs de la fiche, comme lorsqu'il s'agit d'effectuer une recherche diffuse (<a href="#7.4">v. n�7.4</a>) avec un seul terme. Ainsi, une recherche diffuse (qui parcourt tous les champs) avec pour terme de recherche <i>2000</i> affichera plus de r�sultats qu'une recherche automatique (qui ne parcourt que les champs <i>Promotion</i> et <i>Date de naissance</i>) avec le m�me terme de recherche. Les r�sultats retourn�s auront un indice de pertinence diff�rent selon que l'on effectue l'une ou l'autre des recherches. L'indice de pertinence d'un r�sultat <i>n'</i>est <i>pas</i> absolu ; il d�pend en r�alit� de l'indice de pertinence accord� aux autres r�sultats.
</p>

<p class="aide_texte">
Pour r�sumer, la pertinence est donc d�termin�e en fonction de 3 facteurs principaux:
<ul>
	<li />Le nombre de termes de recherches pr�sents dans les champs de la fiche retourn�e en r�sultat ;
	<li />Le nombre d'occurrences de chacun de ces termes de recherche dans la fiche retourn�e en r�sultat ;
	<li />La pertinence des autres fiches retourn�es en r�sultat.
</ul>
</p>

<p class="aide_texte">
* * *
</p>

<p class="aide_texte">
Le syst�me de recherche "full text" ou s�mantique (<a href="#7.11">v. n�7.11</a>) calcule aussi la pertinence des r�sultats. Cependant, le calcul est effectu� directement au moment du passage de la requ�te et par MySQL, alors que dans les recherches "normales" le calcul est effectu� apr�s obtention des r�sultats. La recherche s�mantique calcule donc la pertinence des r�sultats, mais elle ne le fait pas selon la m�me formule que la recherche "normale". En revanche, la formule utilis�e prend en compte, grosso modo, les m�mes param�tres (occurrences et position des termes de recherche). La pertinence calcul�e par MySQL, dans le cas d'une recherche s�mantique, est "normalis�e" pour pouvoir �tre affich�e de la m�me mani�re que la pertinence calcul�e par une recherche normale (c'est-�-dire exprim�e en pourcentage, avec un indice 100 sur la valeur la plus pertinente). En pratique, on peut observer une pertinence moins homog�ne (un �cart-type beaucoup plus important, une moyenne globalement plus basse) avec la recherche s�mantique qu'avec la recherche normale: avec la recherche s�mantique, il y aura de plus grosses diff�rences de pertinence entre les r�sultats les plus pertinents et les r�sultats les moins pertinents.
</p>

<p class="aide_texte">
Le syst�me de pertinence ne fonctionne pas avec les expressions r�guli�res (<a href="#7.10">v. n�7.10</a>).
</p>


