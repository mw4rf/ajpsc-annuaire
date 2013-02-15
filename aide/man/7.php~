<?php
/*
               ANNUAIRE AIDE
SECTION : Rechercher des fiches

Fichier inclus à partir de faq.php
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
	La recherche, comme son nom l'indique, vous permet de rechercher (et de trouver !) parmi toutes les fiches de l'annuaire celles qui répondent à une condition précise.
</p>

<p class="aide_texte">
	Il s'agit par exemple de dire à la base de donnée "<i>affiche toutes les fiches des étudiants de la promotion 2006</i>" ou "<i>affiche toutes les fiches qui contiennent l'expression </i> droit international privé".
</p>

<!-- 7.2 Quels sont les différents types de recherches ? -->
<p class="aide_section"><a name="7.2"></a>
7.2 Quels sont les différents types de recherches ?
</p>

<p class="aide_texte">
	Il existe actuellement 5 types de recherche:
	<ol>
		<li />La recherche automatique (<i>conseillée</i>) (<a href="#7.3">v. n°7.3</a>)
		<li />La recherche diffuse (<a href="#7.4">v. n°7.4</a>)
		<li />La recherche focalisée (<a href="#7.5">v. n°7.5</a>)
		<li />La recherche basée sur les expressions régulières (<a href="#7.10">v. n°7.10</a>)
		<li />La recherche sémantique (<a href="#7.11">v. n°7.11</a>)
	</ol>
</p>

<!-- 7.3 Qu'est ce que la recherche automatique et comment effectuer une recherche automatique ? -->
<p class="aide_section"><a name="7.3"></a>
7.3 Qu'est ce que la recherche automatique et comment effectuer une recherche automatique ?
</p>

<p class="aide_texte">
	La recherche automatique vous permet de recherche le ou les mot(s)-clé(s) spécifié(s) dans le champ de recherche dans toute la base de données. C'est le type de recherche conseillé par défaut. Si vous entrez plusieurs mots-clés, la recherche sera cumulative: elle retournera les fiches qui contiennent au moins l'un des mots-clés saisis.
</p>

<p class="aide_texte">
	<u>Exemples</u>:
	<ul>
		<li />Si vous tapez <i>2006</i>, la recherche ne portera que sur les champs promotion et date de naissance.
		<li />Si vous tapez <i>martin</i>, la recherche portera sur tous les champs de texte (nom, prénom, e-mail ainsi que tous les champs de "contenu").
		<li />Si vous tapez <i>martin 2006</i>, <i>martin</i> sera recherché dans tous les champs de texte, et <i>2006</i> dans le champ promotion et dans le champ date. Seront affichées dans les résultats les fiches qui contiennent <i>martin</i>, les fiches qui contiennent <i>2006</i>, et celles qui contiennent à la fois <i>martin</i> et <i>2006</i>.
	</ul>
</p>

<p class="aide_texte">
	<u>Exclusion des mots génériques</u>
	<br />
	Certains mots génériques sont automatiquement exclus de la recherche automatique. Il s'agit de certains mots propres à une langue qui, parce qu'ils sont nécessaire à l'organisation grammaticale de la phrase, sont utilisés très souvent et perdent de ce fait toute pertinence dans une recherche. Il s'agit par exemple, en français, des mots "le", "la", "les", "un", "une", "de", "des", etc.
</p>

<p class="aide_texte">
	<u>Prise en charge des mots incomplets</u>
	<br />
	La recherche intelligente prend en considération des chaînes de caractères et non des mots. Par exemple, si vous cherchez "mer", qui est un mot en soi, les résultats seront les fiches contenant "<u>mer</u>", "<u>mer</u>veille", "<u>mer</u>cantile", "<u>mer</u>cerie", "abî<u>mer</u>", "ai<u>mer</u>", "a<u>mer</u>rir", etc.
	<br />
	Il est fréquent, dans les moteurs de recherche, d'utiliser des <i>wildcards</i> ou, en français, des <i>jokers</i>. Ainsi, l'étoile (*) représente une séquence de plusieurs lettres indéterminées alors que le point d'interrogation (?) représente une seule lettre indéterminée. Ces jokers n'existent pas dans le moteur de recherche de l'annuaire. Le comportement recherché par le point d'interrogation peut être obtenu avec les expressions régulières (<a href="#7.10">v. n°7.10</a>: <i>regex=x(.?)y</i>) et celui obtenu avec l'étoile est déjà le comportement par défaut. Ainsi, rechercher <i>mer</i> avec la recherche intelligente revient à rechercher <i>*mer*</i> dans les moteurs de recherche basés sur les jokers.
</p>

<p class="aide_texte">
	Pour ne recherche que le mot "mer" à l'exclusion des mots qui <i>contiennent</i> la chaîne "mer", il faut entourer le mot de parenthèses: <b>(</b> et <b>)</b>. Par exemple: <i>(mer)</i>. Cela revient à effectuer une recherche sémantique (<i>full text search</i>) qui considère que chaque chaîne est un mot à part entière (<a href="#7.11">v. n°7.11</a>). Il est également possible d'obtenir le même résultat grâce aux expressions régulières (<a href="#7.10">v. n°7.10</a>).
</p>

<p class="aide_texte">
	La prise en charge des mots incomplets ne concerne que la recherches <i>littérales</i>, à l'exclusions des recherches <i>numériques</i>. Ainsi, pour rechercher la promotion 2006, il faudra entrer <i>2006</i> et non <i>06</i>. L'annuaire n'interprète pas <i>06</i> comme l'année 2006, mais comme l'an 6 après J.-C...
</p>

<p class="aide_texte">
	<u>Opérateur d'agrégation (<b>&&</b>)</u>
	<br />
	Parfois la méthode de recherche alternative décrite ci-dessus ne suffit pas. C'est notamment le cas lorsqu'on ne veut rechercher que les fiches qui contiennent tous les termes de la recherche, à l'exclusion de celles qui ne contiennent que certains d'entre eux. C'est à dire, pour reprendre l'exemple précédent, qu'on veut les fiches qui contiennent à la fois <i>martin</i> et <i>2006</i>, mais pas celles qui ne contiennent que <i>martin</i> ou que <i>2006</i>.
</p>

<p class="aide_texte">
	Dans ce cas, il faut utiliser l'opérateur d'agrégation <b>&&</b> entre deux mots, <i><u>sans espace entre ces mots</u></i>. Par exemple, si vous tapez <i>martin&&2006</i>, la recherche ne renverra comme résultat que les fiches qui contiennent à la fois <i>martin</i> et <i>2006</i>.
</p>

<p class="aide_texte">
	Il est possible de combiner les espaces et l'opérateur d'agrégation <b>&&</b> pour effectuer une recherche plus complexe. Par exemple:
	<ul>
		<li />Si vous tapez <i>martin dupont 2006</i> (cas de cumul simple), les fiches retournées seront celles qui contiennent <i>martin</i>, celles qui contiennent <i>dupont</i>, celles qui contiennent <i>2006</i>, celles qui contiennent <i>martin</i> et <i>dupont</i>, celles qui contiennent <i>martin</i> et <i>2006</i> et celles qui contiennent <i>dupont</i> et <i>2006</i>.
		<li />Si vous tapez <i>martin&&dupont&&2006</i> (cas d'agrégation simple), les fiches retournées seront celles qui contiennent à la fois <i>martin</i>, <i>dupont</i> et <i>2006</i>.
		<li />Si vous tapez <i>martin&&dupont 2006</i> (cas mixte), les fiches retournées seront celles qui contiennent à la fois <i>martin</i> et <i>dupont</i> mais pas <i>2006</i>, celles qui contiennent <i>2006</i> mais pas <i>martin</i> ni <i>dupont</i>, et celles qui contiennent à la fois <i>martin</i>, <i>dupont</i> et <i>2006</i>. Les fiches qui ne contiennent que <i>martin</i> ou que <i>dupont</i> et qui ne contiennent pas <i>2006</i> ne seront pas affichées.
	</ul>
</p>

<p class="aide_texte">
	<u>Opérateur de comparaison numérique (<b>&lt;</b> ou <b>&gt;</b>)</u>
	<br />
	L'opérateur de comparaison numérique vous permet de rechercher une plage de <b>promotions</b>. Cet opérateur n'a d'effet que sur le champ <b>promotion</b>. Il s'utilise ainsi: <i>2000&lt;2006</i> ou <i>2006&gt;2000</i>. Les résultats retournés seront toutes les fiches des étudiants des promotions <i>2000, 2001, 2002, 2003, 2004, 2005 et 2006</i>.
</p>

<p class="aide_texte">
	L'opérateur de comparaison est dans tous les cas <i>inclusif</i>, c'est-à-dire que les arguments sont inclus dans la recherche (ici, 2000 et 2006). Pour rechercher toutes les fiches qui correspondent aux promotions comprises entre 2000 et 2006, mais pas celles des promotions 2000 et 2006, il faudrait écrire: <i>2001&lt;2005</i> ou <i>2005&gt;2001</i>.
</p>

<p class="aide_texte">
	Notez que si vous voulez opérer une recherche par plage <i>dans tous les champs</i>, et non seulement dans le champ <i>promotion</i>, vous pouvez obtenir le même résultat en formulant une expression régulière (<a href="#7.10">v. n°7.10</a>). Dans l'exemple précédent, la plage des dates comprises entre 2000 et 2006 sera recherchée dans tous les champs grâce à la requête suivante: <i>regex=(200[0-6])</i>.
</p>

<p class="aide_texte">
	***
</p>

<p class="aide_texte">
	Pour effectuer une recherche automatique, entrez un ou plusieurs mot(s)-clé(s) dans le champ de recherche situé en haut à droite de la page, puis appuyez sur la touche Entrée ou Retour de votre clavier.
</p>

<!-- 7.4 Qu'est ce que la recherche diffuse et comment effectuer une recherche diffuse ? -->
<p class="aide_section"><a name="7.4"></a>
7.4 Qu'est ce que la recherche diffuse et comment effectuer une recherche diffuse ?
</p>

<p class="aide_texte">
	La recherche diffuse vous permet de chercher une chaîne de texte complète et ordonnée (une phrase) dans tous les champs de la base de données.
</p>

<p class="aide_texte">
		Pour effectuer une recherche diffuse, entrez un ou plusieurs mot(s)-clé(s) dans le champ de recherche situé en haut à droite de la page, cliquez sur le symbole ± (plus/moins) à droite de ce champ de recherche, puis sélectionnez <b>Tous</b> dans le menu déroulant. Finalement, appuyez sur la touche Entrée ou Retour de votre clavier.
</p>

<!-- 7.5 Qu'est ce que la recherche focalisée et comment effectuer une recherche focalisée ? -->
<p class="aide_section"><a name="7.5"></a>
7.5 Qu'est ce que la recherche focalisée et comment effectuer une recherche focalisée ?
</p>

<p class="aide_texte">
	La recherche focalisée vous permet de chercher un mot, un nombre ou une date dans un champ précis de la base de données.
</p>

<p class="aide_texte">
		Pour effectuer une recherche diffuse, entrez un ou plusieurs mot(s)-clé(s) dans le champ de recherche situé en haut à droite de la page, cliquez sur le symbole ± (plus/moins) à droite de ce champ de recherche, puis sélectionnez le critère de votre choix parmi ceux proposés (nom, prénom, promotion, date de naissance, e-mail) dans le menu déroulant. Finalement, appuyez sur la touche Entrée ou Retour de votre clavier.
</p>

<p class="aide_texte">
	Attention ! Les formats de données ne sont pas contrôlés: si vous entrez par exemple du texte dans le champ de recherche et que vous lancez la recherche sur le champ "Promotion", qui ne peut contenir que des nombres entiers (les années), la recherche ne pourra aboutir.
</p>

<!-- 7.6 Comment sont affichés les résultats de recherche ? -->
<p class="aide_section"><a name="7.6"></a>
7.6 Comment sont affichés les résultats de recherche ?
</p>

<p class="aide_texte">
	Les résultats de recherche sont affichés dans une liste semblable à la liste des fiches (<a href="#5">v. n°5</a> à ce propos).
</p>

<!-- 7.7 Que faire avec ces résultats de recherche ? -->
<p class="aide_section"><a name="7.7"></a>
7.7 Que faire avec ces résultats de recherche ?
</p>

<p class="aide_texte">
	Vous pouvez bien entendu afficher les détails de toutes les fiches retournées par la recherche. Vous pouvez également exporter (<a href="#7.8">v. n°7.8</a>) et imprimer (<a href="#7.9">v. n°7.9</a>) ces fiches. En revanche, vous ne pouvez pas appliquer de critère de tri sur les résultats de recherche.
</p>

<!-- 7.8 Comment exporter les résultats d'une recherche ? -->
<p class="aide_section"><a name="7.8"></a>
7.8 Comment exporter les résultats d'une recherche ?
</p>

<p class="aide_texte">
	Pour exporter les résultats d'une recherche, cliquez choisissez <b>Exporter les résultats de la recherche</b> dans le menu <b>Exportation</b>. Pour plus d'information sur l'exportation, reportez-vous à la section <a href="#8">n°8</a>.
</p>

<!-- 7.9 Comment imprimer les résultats d'une recherche ? -->
<p class="aide_section"><a name="7.9"></a>
7.9 Comment imprimer les résultats d'une recherche ?
</p>

<p class="aide_texte">
	Pour exporter les résultats d'une recherche, cliquez choisissez <b>Imprimer les résultats de la recherche</b> dans le menu <b>Exportation</b>. Pour plus d'information sur l'impression, reportez-vous à la section <a href="#9">n°9</a>. Vous pouvez aussi imprimer les résultats de recherche dans un fichier PDF (<a href="#8.10">v. n°8.10</a>)
</p>

<!-- 7.10 Comment utiliser les expressions régulières dans une recherche ? -->
<p class="aide_section"><a name="7.10"></a>
7.10 Comment utiliser les expressions régulières dans une recherche ?
</p>

<p class="aide_texte">
	Le système de recherche de l'annuaire vous permet d'utiliser les expressions régulières (aussi appelées <i>regex</i> pour <i>Regular Expressions</i>). Il s'agit d'un mode de recherche ultraprécis et très puissant dans la formulation des requêtes.
</p>

<p class="aide_texte">
	Pour rechercher dans la base de données à l'aide d'une expression régulière, vous devez entrer le mot clé <b>regex</b> suivi du symbole <b>=</b> et de l'expression régulière.
</p>

<p class="aide_texte">
	<u>Exemples</u>
	<br />
	<i>regex=(2000|2006)</i>
	<br />
	Cette expression recherchera dans la base de données les nombres 2000 et 2006 et renverra toutes les fiches qui contiennent l'un ou l'autre de ces nombres, ou les deux à la fois.
	<br />
	<br />
	<i>regex=(200[0-6])</i>
	<br />
	Cette expression recherchera dans la base de données toutes les fiches qui contiennent au moins un nombre compris entre 2000 et 2006.
	<br />
	<br />
	<i>regex=mer([a-z]+)</i>
	<br />
	Cette expression recherchera tous les mots qui commencent par <i>mer</i> et finissent par un nombre indéterminé mais non nul de lettres entre A et Z. L'opérateur + étant exclusif (1 ou plus), le mot <i>mer</i> lui-même ne sera pas recherché. Pour rechercher également le mot <i>mer</i> il faut utiliser l'opérateur * (0 ou plus) à la place de l'opérateur +. Pour rechercher <i>n'importe quel caractère</i> (c'est-à-dire également des chiffres et des symboles), il faudrait remplacer <i>[a-z]</i> par un point (.).
	<br />
	<br />
	<i>regex=(.+)mer(.+)</i>
	<br />
	Cette expression recherchera la suite de lettres "mer" à l'intérieur d'un autre mot. Les mots trouvés ne pourront ni commencer ni finir par "mer". Pour inclure les mots qui commencent ou qui finissent par "mer", il faudrait remplacer l'opérateur + par l'opérateur *. Cette expression est celle par défaut utilisée par la recherche automatique sur tous les motifs de recherche (<a href="#7.3">v. n°7.3</a>).
	<br />
	<br />
	<i>regex=mer([a-z]{1,1})redi</i> ou (moins précis) <i>regex=mer(.?)redi</i>
	<br />
	Cette expression peut être utilisée pour remplacer le <i>wildcard</i> point d'interrogation (?), indisponible dans la recherche automatique (<a href="#7.3">v. n°7.3</a>), qui représente 1 lettre indéterminée dans un mot. Ici, la lettre sera probablement un <i>c</i>, qui formera le mot <i>mercredi</i>.
	<br />
	<br />
	<i>regex=(^[a-z]*)mer(^[a-z]*)</i>
	<br />
	Cette expression recherche "mer" lorsqu'il s'agit d'un mot indépendant, qui n'est pas contenu dans un autre mot.
</p>

<p class="aide_texte">
	<u>Portée</u>
	<br />
	Les expressions régulières peuvent être utilisées dans les recherches focalisées (<a href="#7.5">v. n°7.5</a>), dans les recherches diffuses (<a href="#7.4">v. n°7.4</a>) et dans les recherches automatiques (<a href="#7.3">v. n°7.3</a>). C'est la raison pour laquelle si vous tapez dans le champ de recherche <i>regex=(2000|2006)</i>, la recherche ne se limitera pas au champ <i>promotion</i>. Si un utilisateur a indiqué qu'il est de la promotion 1990, par exemple, mais qu'il a écrit n'importe où ailleurs dans sa fiche qu'il a effectué telle ou telle activité en 2000, sa fiche sera retournée en résultat de la recherche. La recherche intelligente avec des expressions régulières parcourt tous les champs. Si vous désirez ne rechercher que les promotions 2000 ou 2006, vous devriez plutôt effectuer une recherche focalisée ou écrire une requête normale: <i>2000 2006</i>.
</p>

<p class="aide_texte">
	Les recherches basées sur les expressions régulières ne prennent pas en compte les autres opérateurs de recherche, tels que l'opérateur d'agrégation <b>&&</b>. Veillez donc à ne pas les utiliser car cela reviendrait à former une requête de recherche déficiente et aucun résultat correct ne serait retourné. C'est pour cette raison que vous ne devez jamais mettre d'espace dans une expression régulière: l'espace est interprété comme un opérateur logique <i>ou</i>.
</p>

<p class="aide_texte">
	<u>Syntaxe</u>
	<br />
	La syntaxe des expressions régulières est basée sur l'implémentation d'Henry Spencer, qui est retenue par MySQL.
	<br />
	<ul style="list-style-type : none;">
		<li /><b>^</b>&nbsp;&nbsp;&nbsp;Correspond à l'opérateur d'ouverture d'une expression.
		<li /><b>$</b>&nbsp;&nbsp;&nbsp;Correspond à l'opérateur de fermeture d'une expression.
		<li /><b>.</b>&nbsp;&nbsp;&nbsp;Représente n'importe quel caractère.

		<li />&nbsp;

		<li /><b>x*</b> ou <b>x{0,}</b>&nbsp;&nbsp;&nbsp;Correspond à 0 ou plus caractères <i>x</i>.
		<li /><b>x+</b> ou <b>x{1,}</b>&nbsp;&nbsp;&nbsp;Correspond à 1 ou plus caractères <i>x</i>.
		<li /><b>x?</b> ou <b>x{0,1}</b>&nbsp;&nbsp;&nbsp;Correspond à 0 où au caractère <i>x</i>.
		<li /><b>(x)*</b>&nbsp;&nbsp;&nbsp;Correspond à une séquence de 0 ou plus éléments <i>x</i>.
		<li /><b>(x)+</b>&nbsp;&nbsp;&nbsp;Correspond à une séquence de 1 ou plus éléments <i>x</i>.
		<li /><b>(x)?</b>&nbsp;&nbsp;&nbsp;Correspond à 0 ou à la séquence d'éléments <i>x</i>.

		<li />&nbsp;

		<li /><b>abc|xyx</b>&nbsp;&nbsp;&nbsp;Correspond à la séquence <i>abc</i> <b>ou</b> à la séquence <i>xyz</i>.

		<li />&nbsp;

		<li /><b>[a-d]</b>&nbsp;&nbsp;&nbsp;Renvoie toutes les valeurs entre <i>a</i> et <i>d</i>, c'est-à-dire <i>a b c d</i>.
		<li /><b>[1-4]</b>&nbsp;&nbsp;&nbsp;Renvoie toutes les valeurs entre <i>1</i> et <i>4</i>, c'est-à-dire <i>1 2 3 4</i>.
		<li /><b>[^a-d]</b>&nbsp;&nbsp;&nbsp;Renvoie toutes les valeurs qui ne sont pas comprises entre <i>a</i> et <i>d</i>.
		<li /><b>[^1-4]</b>&nbsp;&nbsp;&nbsp;Renvoie toutes les valeurs qui ne sont pas comprises entre <i>1</i> et <i>4</i>.

		<li />&nbsp;

		<li /><b>[:character_class:]</b>&nbsp;&nbsp;&nbsp;Remplace la liste des caractère appartement à la classé spécifiée. Les classes possibles sont les suivantes:
		<ul style="list-style-type : none;">
			<li /><i>alnum</i>&nbsp;&nbsp;&nbsp;Caractères alpha-numériques
			<li /><i>alpha</i>&nbsp;&nbsp;&nbsp;Caractères alphabétiques
			<li /><i>blank</i>&nbsp;&nbsp;&nbsp;Caractères espace
			<li /><i>cntrl</i>&nbsp;&nbsp;&nbsp;Caractères de contrôle
			<li /><i>digit</i>&nbsp;&nbsp;&nbsp;Chiffres
			<li /><i>graph</i>&nbsp;&nbsp;&nbsp;Caractères graphiques
			<li /><i>lower</i>&nbsp;&nbsp;&nbsp;Minuscules
			<li /><i>print</i>&nbsp;&nbsp;&nbsp;Caractères graphiques ou espaces
			<li /><i>punct</i>&nbsp;&nbsp;&nbsp;Ponctuation
			<li /><i>space</i>&nbsp;&nbsp;&nbsp;Espace, tabulation, nouvelle ligne et retour chariot
			<li /><i>upper</i>&nbsp;&nbsp;&nbsp;Majuscules
			<li /><i>xdigit</i>&nbsp;&nbsp;&nbsp;Chiffres hexadécimaux
		</ul>


		<li /><b></b>&nbsp;&nbsp;&nbsp;
		<li /><b></b>&nbsp;&nbsp;&nbsp;
		<li /><b></b>&nbsp;&nbsp;&nbsp;
		<li /><b></b>&nbsp;&nbsp;&nbsp;
	</ul>
</p>

<p class="aide_texte">
	<b>NB</b>: Dans le cas d'une recherche par formulation d'une expression régulière, les résultats ne sont pas triés par pertinence. La pertinence de chaque résultat n'est même pas calculée. La raison est la suivante: les expressions régulières permettent de formuler des requêtes conditionnelles. Par hypothèse, seules les fiches qui satisfont la condition posée dans la requête sont retournées en résultat. Par conséquent, tous les résultats ont la même pertinence puisqu'ils satisfont tous la même condition de la même manière.
</p>

<!-- 7.11 Comment effectuer une recherche sémantique ? -->
<p class="aide_section"><a name="7.11"></a>
7.11 Comment effectuer une recherche sémantique ?
</p>

<p class="aide_texte">
	Vous pouvez effectuer une recherche sémantique en entourant le terme recherché de parenthèses, de cette manière: <b><i>(cherchez-moi)</i></b>.
</p>

<p class="aide_texte">
	Cette méthode de recherche ne concerne que les champs correspondant aux 7 questions. Les champs contenant les données personnelles (nom, prénom, date de naissance, promotion, etc.) ne sont pas concernés.
</p>

<p class="aide_texte">
	La recherche sémantique est basée sur un <i>index</i> qui contient des mots-clés. Sont exclus les mots génériques, qui sont très souvent employés. Par exemple, dans la phrase (Je vais me baigner à la mer), seuls seront indexés les mots "vais", "baigner" et "mer". La base de données n'a pas de liste prédéfinie de mots génériques. La liste est construite en fonction du contenu actuel de la base de données. Ainsi, par exemple, dans le cas du présent annuaire, il est probable que les mots "anglais" et "français" ne soient pas indexés car la plupart des personnes auront entré des deux langues en tant que langues parlées, lues ou écrites.
</p>

<p class="aide_texte">
	Les résultats sont triés par ordre décroissant de pertinence. Ainsi, si vous recherchez le mot "mer" et que plusieurs fiches sont retournées, celle qui contiendra le plus grand nombre d'occurrences de ce mot sera en haut de la liste.
</p>

<p class="aide_texte">
	Le principal intérêt de la recherche sémantique est de prendre en compte des phrases complètes, composées de plusieurs mots. Dans l'exemple précédent, (Je vais me baigner à la mer), les mots recherchés sont "vais", "baigner" et "mer": s'ils sont tous les trois présents dans la même fiche, cette fiche aura un score de pertinence élevé. Si une autre fiche contient deux de ces mots, mais pas le troisième, sa pertinence sera beaucoup plus faible.
</p>

<p class="aide_texte">
	Les recherches sémantiques ne prennent pas en compte les autres opérateurs de recherche, tels que l'opérateur d'agrégation <b>&&</b>. Veillez donc à ne pas les utiliser car cela reviendrait à former une requête de recherche déficiente et aucun résultat correct ne serait retourné.
</p>

<!-- 7.12 Comment fonctionne la "pertinence" des résultats de recherche ? -->
<p class="aide_section"><a name="7.12"></a>
7.12 Comment fonctionne la "pertinence" des résultats de recherche ?
</p>

<p class="aide_texte">
	Tous les résultats affichés après une recherche répondent à la requête de recherche formulée. Mais certains y répondent <i>mieux</i> que d'autres. La pertinence vous sert à repérer en un coup d'oeil les meilleurs résultats.
</p>

<p class="aide_texte">
	<u>Exemple</u>. Imaginons que nous ayons les fiches suivantes:
	<ul style="list-style-type : none;">
		<li>
			<u>Fiche 1</u>
			<ul>
				<li /><b>Nom</b>: Dupont
				<li /><b>Prénom</b>: Pierre
				<li /><b>Promotion</b>: 2000
			</ul>
		</li>
		<li>
			<u>Fiche 2</u>
			<ul>
				<li /><b>Nom</b>: Dupont
				<li /><b>Prénom</b>: Martin
				<li /><b>Promotion</b>: 2000
			</ul>
		</li>
		<li>
			<u>Fiche 3</u>
			<ul>
				<li /><b>Nom</b>: Dupont
				<li /><b>Prénom</b>: Robert
				<li /><b>Promotion</b>: 2005
			</ul>
		</li>
	</ul>
</p>

<p class="aide_texte">
	Imaginons maintenant les requêtes suivantes, et voyons si certains résultats sont plus pertinents que d'autres.
	<ul style="list-style-type : none;">
		<li>
			<u>Recherche</u>: <i>2000</i>
			<ul>
				<li><b>Fiche 1</b>
					<ul>
						<li />Terme de recherche cité: <b>1</b> fois
						<li />Pertinence: 1/1 soit 100%
					</ul>
				</li>
				<li><b>Fiche 2</b>
					<ul>
						<li />Terme de recherche cité: <b>1</b> fois
						<li />Pertinence: 1/1 soit 100%
					</ul>
				</li>
				<li><b>Fiche 3</b>
					<ul>
						<li />Terme de recherche cité: <b>0</b> fois
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
						<li />Terme de recherche 1 cité: <b>1</b> fois
						<li />Terme de recherche 2 cité: <b>1</b> fois
						<li />Pertinence: 2/2 soit 100%
					</ul>
				</li>
				<li><b>Fiche 2</b>
					<ul>
						<li />Terme de recherche 1 cité: <b>1</b> fois
						<li />Terme de recherche 2 cité: <b>1</b> fois
						<li />Pertinence: 2/2 soit 100%
					</ul>
				</li>
				<li><b>Fiche 3</b>
					<ul>
						<li />Terme de recherche 1 cité: <b>0</b> fois
						<li />Terme de recherche 2 cité: <b>1</b> fois
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
						<li />Terme de recherche 1 cité: <b>1</b> fois
						<li />Terme de recherche 2 cité: <b>1</b> fois
						<li />Terme de recherche 3 cité: <b>1</b> fois
						<li />Pertinence: 3/3 soit 100%
					</ul>
				</li>
				<li><b>Fiche 2</b>
					<ul>
						<li />Terme de recherche 1 cité: <b>1</b> fois
						<li />Terme de recherche 2 cité: <b>1</b> fois
						<li />Terme de recherche 3 cité: <b>0</b> fois
						<li />Pertinence: 2/3 soit 66%
					</ul>
				</li>
				<li><b>Fiche 3</b>
					<ul>
						<li />Terme de recherche 1 cité: <b>0</b> fois
						<li />Terme de recherche 2 cité: <b>1</b> fois
						<li />Terme de recherche 3 cité: <b>0</b> fois
						<li />Pertinence: 1/3 soit 33%
					</ul>
				</li>
			</ul>
		</li>
	</ul>
</p>

<p class="aide_texte">
	Il est clair dans les exemples ci-dessus que tous les résultats de recherche n'ont pas la même pertinence. Les requêtes formulées ci-dessus sont des requêtes par défaut, qui utilisent le mot clé <i>OU</i>. Par exemple, la troisième recherche pourrait être formulée en français: <i>affichez les fiches qui contiennent <u>2000</u> ou <u>Dupont</u> ou <u>Pierre</u></i>. Cela revient à dire: <i>affichez les fiches dans lesquelles apparaît <u>2000</u> et toutes celles dans lesquelles apparaît <u>Dupont</u> et toutes celles dans lesquelles apparaît <u>Pierre</u></i>.
</p>

<p class="aide_texte">
Si une des fiches affichées en résultat contient à la fois <u>2000</u> et <u>Dupont</u>, par exemple, elle n'aura <i>a priori</i> pas plus de valeur qu'une fiche qui ne contient qu'un seul de ces termes. La pertinence intervient ici pour donner plus de valeur à la première fiche. La pertinence est donc déterminée -en partie- par le nombre de termes de recherche présents dans chaque résultat.
</p>

<p class="aide_texte">
	De même, si une des fiches contient plusieurs fois <u>2000</u>, elle n'aura <i>a priori</i> pas plus de valeur qu'une fiche qui ne contient qu'une seule fois <u>2000</u>. Là encore, le mécanisme de pertinence intervient comme correcteur pour donner une plus grande valeur à cette première fiche. La pertinence est donc déterminée non seulement par le nombre de terme recherchés présents dans chaque résultat, mais aussi par le nombre d'occurrences de chaque terme recherché.
</p>

<p class="aide_texte">
	<u>Exemple</u>. Pour reprendre l'exemple précédent un peu modifié, imaginons que nous ayons les fiches suivantes:
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
	Imaginons maintenant la requête suivante, et voyons si certains résultats sont plus pertinents que d'autres.
	<ul style="list-style-type : none;">
		<li>
			<u>Recherche</u>: <i>2000 Dupont</i>
			<ul>
				<li><b>Fiche 1</b>
					<ul>
						<li />Terme de recherche 1 cité: <b>2</b> fois
						<li />Terme de recherche 2 cité: <b>2</b> fois
						<li />Pertinence: 4/4 soit 100%
					</ul>
				</li>
				<br />

				<li><b>Fiche 2</b>
					<ul>
						<li />Terme de recherche 1 cité: <b>2</b> fois
						<li />Terme de recherche 2 cité: <b>1</b> fois
						<li />Pertinence: 3/4 soit 75%
					</ul>
				</li>
				<br />

				<li><b>Fiche 3</b>
					<ul>
						<li />Terme de recherche 1 cité: <b>1</b> fois
						<li />Terme de recherche 2 cité: <b>1</b> fois
						<li />Pertinence: 2/4 soit 50%
					</ul>
				</li>
				<br />

				<li><b>Fiche 4</b>
					<ul>
						<li />Terme de recherche 1 cité: <b>1</b> fois
						<li />Terme de recherche 2 cité: <b>0</b> fois
						<li />Pertinence: 1/4 soit 25%
					</ul>
				</li>
			</ul>
		</li>
	</ul>
</p>

<p class="aide_texte">
<u>La pertinence est un mécanisme correcteur qui permet de mettre en valeur les fiches en fonction du nombre de termes recherchés qu'elles contiennent et du nombre d'occurrences de chacun de ces termes.</u>
</p>

<p class="aide_texte">
L'opérateur d'agrégation <b>&&</b> (<a href="#7.3">v. n°7.3</a>) fonctionne en réalité comme une exclusion de tous les résultats qui n'ont pas un score de pertinence de 100%. Par exemple, <i>2000&&Dupont</i> ne renverra que les fiches qui contiennent à la fois <i>2000</i> et <i>Dupont</i>. C'est-à-dire les fiches qui, abstraction faite du nombre d'occurrences des termes de recherche à l'intérieur de chaque fiche, ont un score de pertinence de 100%. La seule différence entre la pertinence et l'exclusion par l'opérateur d'agrégation est la prise en compte du nombre d'occurrences du terme recherché.
</p>

<p class="aide_texte">
La pertinence prend parfois en compte des paramètres extérieurs à la requête. Elle ignore ainsi les restrictions de portée fixées à certains champs, pour certains types de recherches. La pertinence est calculée en principe pour les requêtes complexes composées, comme dans les exemples ci-dessus. Mais elle n'est calculée qu'après que la recherche ait été effectuée. Or, certains termes de recherche ne seront recherchés que dans certains champs. Dans le premier exemple donné ci-dessus, <i>2000</i> n'est recherché que dans les champs numériques, c'est-à-dire <i>Promotion</i> et <i>Date de naissance</i>. Si une fiche contient le terme <i>2000</i> dans un autre champ, sa pertinence sera <i>plus élevée</i> que la pertinence des fiches qui ne contiennent <i>2000</i> que dans le champ <i>Promotion</i> ou dans le champ <i>Date de naissance</i>. En revanche, un fiche ne contenant <i>2000</i> ni dans le champ <i>Promotion</i> ni dans le champ <i>Date de naissance</i> aura obligatoirement une pertinence de 0. De même, la motif de recherche <i>2000&lt;2006</i> renvoie toutes les fiches correspondant aux promotions comprises entre 2000 et 2006 (bornes incluses). Par hypothèse, seules les fiches répondant à ce seul et unique critère sont affichées: elles devraient donc toutes avoir, en principe, la même pertinence, la pertinence maximale de 100%. Cependant, dans ce cas, la pertinence est calculée en fonction de paramètres extérieurs à la requête: elle ne se limite pas au champ <i>Promotion</i> qui est le seul pris en compte par la recherche. La pertinence sera donc calculée en fonction du nombre d'occurrences de chacune des dates présentes dans l'intervalle spécifié.
</p>

<p class="aide_texte">
Il en résulte que l'affichage de la pertinence prend en compte les données réellement présentes dans la fiche, peu important qu'elles aient été ignorées par la recherche. La pertinence parcourt tous les champs de la fiche, comme lorsqu'il s'agit d'effectuer une recherche diffuse (<a href="#7.4">v. n°7.4</a>) avec un seul terme. Ainsi, une recherche diffuse (qui parcourt tous les champs) avec pour terme de recherche <i>2000</i> affichera plus de résultats qu'une recherche automatique (qui ne parcourt que les champs <i>Promotion</i> et <i>Date de naissance</i>) avec le même terme de recherche. Les résultats retournés auront un indice de pertinence différent selon que l'on effectue l'une ou l'autre des recherches. L'indice de pertinence d'un résultat <i>n'</i>est <i>pas</i> absolu ; il dépend en réalité de l'indice de pertinence accordé aux autres résultats.
</p>

<p class="aide_texte">
Pour résumer, la pertinence est donc déterminée en fonction de 3 facteurs principaux:
<ul>
	<li />Le nombre de termes de recherches présents dans les champs de la fiche retournée en résultat ;
	<li />Le nombre d'occurrences de chacun de ces termes de recherche dans la fiche retournée en résultat ;
	<li />La pertinence des autres fiches retournées en résultat.
</ul>
</p>

<p class="aide_texte">
* * *
</p>

<p class="aide_texte">
Le système de recherche "full text" ou sémantique (<a href="#7.11">v. n°7.11</a>) calcule aussi la pertinence des résultats. Cependant, le calcul est effectué directement au moment du passage de la requête et par MySQL, alors que dans les recherches "normales" le calcul est effectué après obtention des résultats. La recherche sémantique calcule donc la pertinence des résultats, mais elle ne le fait pas selon la même formule que la recherche "normale". En revanche, la formule utilisée prend en compte, grosso modo, les mêmes paramètres (occurrences et position des termes de recherche). La pertinence calculée par MySQL, dans le cas d'une recherche sémantique, est "normalisée" pour pouvoir être affichée de la même manière que la pertinence calculée par une recherche normale (c'est-à-dire exprimée en pourcentage, avec un indice 100 sur la valeur la plus pertinente). En pratique, on peut observer une pertinence moins homogène (un écart-type beaucoup plus important, une moyenne globalement plus basse) avec la recherche sémantique qu'avec la recherche normale: avec la recherche sémantique, il y aura de plus grosses différences de pertinence entre les résultats les plus pertinents et les résultats les moins pertinents.
</p>

<p class="aide_texte">
Le système de pertinence ne fonctionne pas avec les expressions régulières (<a href="#7.10">v. n°7.10</a>).
</p>


