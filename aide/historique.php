<span>&nbsp;</span>

<p>Version 1.5 (XX/XX/2013)
<ul>
    <li />Retour du moteur de recherche.
    <li />Affichage conditionnelle du moteur de recherche (v. fichier de configuration)
</ul>
</p>

<p>Version 1.4.2 (16/11/2010)
<ul>
	<li />[Bug] Correction d'une faille de s�curit� dans le script d'exportation "imprimer".
	<li />Am�lioration de la pr�sentation de l'exportation "imprimer".
	<li />[Photos] Affichage des photos dans l'exportation "imprimer".
	<li />Am�lioration de la pr�sentation du menu de navigation dans les pages liste et galerie.
</ul>
</p>

<p>Version 1.4.1 (15/11/2010)
<ul>
	<li /><b>Galerie de photos</b>
	<li />[Photos] Tri des photos de la galerie par Promotion (2->1).
	<li />[Photos] Tri des photos de la galerie par Nom de famille (A->Z).
	<li />[Bug] La mise-�-jour d'une fiche sans modification de la photo n'affiche plus de message d'erreur relatif au format de l'image.
</ul>
</p>

<p>Version 1.4 (14/11/2010)
<ul>
	<li /><b>Ajout de photographies aux fiches.</b>
	<li />[Photos] Mise en ligne d'une photo d'identit� lors de la cr�ation d'une fiche.
	<li />[Photos] Mise en ligne d'une (nouvelle) photo lors de la modification d'une fiche.
</ul>
</p>

<p>Version 1.3.1 (16/04/2007)
<ul>
	<li /><b>Gestion des favicons dans les th�mes.</b>
	<li />[Bug] Les �l�ments du menu sont d�sormais correctement affich�s sur une seule ligne avec Firefox (et les navigateurs Gecko).
	<li />[Bug] Les sous-menus sont d�sormais correctement positionn�s au dessous de leur �l�ment parent avec Safari (et les navigateurs KHTML).
	<li />[Bug] Le menu principal est d�sormais correctement align� � gauche dans Internet Explorer.
	<li />[Bug] Les �l�ments des sous-menus sont d�sormais correctement align�s � gauche dans Internet Explorer.
	<li />[Bug] Le champ de recherche est d�sormais correctement align� verticalement dans Internet Explorer.
	<li />[Bug] Le champ de recherche est d�sormais correctement align� horizontalement dans tous les navigateurs.
</ul>
</p>

<p>Version 1.3 (14/04/2007)
<ul>
	<li />R��criture compl�te du moteur de recherche (avec instanciation).
	<li /><b>Il est d�sormais possible d'utiliser des <i>expressions r�guli�res</i> dans les recherches.</b>
	<li /><b>Il est d�sormais possible d'effectuer des recherches <i>fulltext</i> (ou s�mantiques).</b>
	<li />Les r�sultats de recherche (auto et <i>fulltext</i>) sont not�s en fonction de leur pertinence.
	<li />Ajout d'op�rateurs de comparaison (&lt; et &gt;) pour rechercher des plages de dates (la recherche se limite aux promotions).
	<li />Les mots g�n�riques (le, las, les...) sont d�sormais automatiquement exclus de la recherche.
	<li />Le nombre de r�sultats de recherche est d�sormais affich� sur la page des r�sultats.
	<li />La requ�te ou les motifs de recherche sont d�sormais affich�s sur la page des r�sultats.
	<li />Les dates sont d�sormais affich�es par d�faut au format europ�en JJ/MM/AAAA.
	<li />Les dates sont d�sormais remplies dans les formulaires au format europ�en JJ/MM/AAAA.
	<li />Lorsque la langue courante de l'annuaire est l'ANGLAIS, les dates sont affich�es au format AM�RICAIN et doivent �tre ins�r�es dans les formulaires au format AM�RICAIN (MM/DD/YYYY).
	<li />Certains messages (ajout de fiche, modification, erreur d'identification, etc.) sont d�sormais affich�s de mani�re plus visible.
	<li />[Bug] Les doublons dans les r�sultats de recherche sont d�sormais �limin�s (si un r�sultat r�pond � deux crit�res s�par�s par OR, il ne sera plus affich� deux fois)
	<li />[Bug] Les noms de famille compos�s sont d�sormais correctement affich�s dans les r�sultats de recherche, sur les pages d'impression et de modification et dans les donn�es export�es.
	<li />[Bug] Le menu Th�mes pouvait afficher les fichiers cach�s du r�pertoire des th�mes. Ce probl�me d� � la fonction de parcours des fichiers du r�pertoire est r�solu.
</ul>
</p>

<p>Version 1.2.1 (31/03/2007)
<ul>
	<li />[Bug] Tous les membres des noms de famille et des pr�noms compos�s ont d�sormais leur premi�re lettre en majuscule (Hubert Bonisseur de la bath => Hubert Bonisseur De La Bath)
	<li />[Bug] Le bug qui d�calait vers la droite le pied de page de la derni�re page du fichier PDF g�n�r� lors de l'exportation de l'entier contenu de l'annuaire est corrig�.
	<li />[Bug] Le bug qui d�calait trop en bas les deux derni�res colonnes, sauf sur la premi�re page, est corrig�.
</ul>
</p>


<p>Version 1.2 (30/03/2007)
<ul>
	<li /><b>Syst�me de g�n�ration de PDF � la vol�e.</b>
	<li />PDF: Exportation vers un PDF de la totalit� de l'annuaire (menu Exportation, option permanente).
	<li />PDF: Exportation vers un PDF des r�sultats de la recherche (menu Exportation, option visible apr�s une recherche).
	<li />PDF: Exportation vers un PDF de la fiche courante (menu Exportation, option visible lors de la consultation d'une fiche).
	<li />PDF: Mod�le PDF "AJPSC Annuaire".
	<li />PDF: Annexe 1, liste des �tudiants par promotion.
	<li />PDF: Annexe 2, liste des �tudiants par ordre alphab�tique.
	<li />PDF: Variables dynamiques (date, compteur) sur la page de garde.
	<li />PDF: Logos sur la page de garde.
	<li />PDF: Liens externes dans le fichier PDF g�n�r� (e-mail et URLs).
	<li />PDF: Remplissage automatique des m�ta-donn�es du fichier PDF g�n�r�.
	<li />PDF: Les annexes et la page de garde ne s'affichent que lors de l'exportation de l'annuaire entier.
	<li />PDF: En-t�tes et pieds de page personnalis�s (logo et titre calligraphi�).
	<li />PDF: Police d�di�e (avec fichiers m�triques "maison"): Lucida calligraphy.
	<li />PDF: Reformulation des questions sous la forme affirmative.
	<li />[S�curit�] Correction d'une faille de s�curit� dans le passage des requ�tes GET qui utilisent une variable num�rique ID.
	<li />Reformulation des questions sous la forme affirmative dans l'affichage des fiches.
</ul>
</p>

<p>Version 1.1.3 (03/03/2007)
<ul>
	<li />Le mode administration d�bouche d�sormais sur une page d'accueil sp�cifique.
	<li />Le mode administration permet d�sormais de modifier la r�ponse secr�te d'un utilisateur.
	<li />[Admin] G�n�ration d'un hash SHA1 depuis un formulaire.
	<li />[Admin] Possibilit� de modifier la r�ponse secr�te d'un utilisateur.
	<li />[Admin] Liens pour une version papier
	<li />[Admin] Statistiques de la base de donn�es
	<li />Les pr�noms seront d�sormais format�s comme les noms de famille: premi�re lettre en majuscule, le reste en minuscules.
	<li />Contr�le du format des dates dans le formulaire d'ajout (YYYY-MM-DD).
	<li />Contr�le du format des e-mails dans le formulaire d'ajout (dupont@martin.com).
	<li />Contr�le du format de la promotion dans le formulaire d'ajout (4 chiffres).
</ul>
</p>

<p>Version 1.1.2 (26/02/2007)
<ul>
	<li />[Bug] Le bug qui emp�chait la reconnaissance des r�ponses secr�tes contenant une majuscule en d�but de cha�ne est d�sormais corrig�.
</ul>
</p>

<p>Version 1.1.1 (25/02/2007)
<ul>
	<li />Ajout d'un lien direct pour retourner aux r�sultats de recherche depuis les d�tails d'une fiche.
	<li />Annuler tout crit�re de tri des fiches ("X") a d�sormais pour effet de les afficher par id, en ordre ascendant.
	<li />Tri des fiches par ordre de mise � jour, depuis le menu Fiches, pour afficher les fiches les plus r�cemment actualis�es.
	<li />[Bug] Cliquer sur une ligne dans les r�sultats d'une recherche renvoie d�sormais vers la fiche correspondante (avant: pouvait renvoyer sur une page vide).
	<li />[Bug] Les tooltips (abbr) sont d�sormais correctement affich�s dans la liste des r�sultats d'une recherche.
</ul>
</p>

<p>Version 1.1 (23/02/2007)
<ul>
	<li /><b>Impl�mentation du syst�me d'administration.</b>
	<li />Les administrateurs peuvent modifier n'importe quelle fiche sans r�pondre � la question secr�te.
	<li />Les administrateurs peuvent supprimer n'importe quelle fiche sans r�pondre � la question secr�te.
</ul>
</p>

<p>Version 1.0.1 (22/02/2007)
<ul>
	<li />La date d'ajout d'une fiche est enregistr�e lors de l'enregistrement de cette fiche.
	<li />La date de modification d'une fiche est enregistr�e lors de la modification de cette fiche.
	<li />La date d'ajout ou de derni�re modification d'une fiche est affich�e dans les d�tails de cette fiche.
	<li />Ce syst�me permet aux gens qui consultent l'annuaire de savoir si telle ou telle fiche est � jour.
</ul>
</p>

<p>Version 1.0 (21/02/2007)
<ul>
	<li /><b>Ouverture publique de l'annuaire, le mercredi 21 f�vrier 2007.</b>
</ul>
</p>

<p>Version 0.9.3 <i>b�ta</i> (09/01/2007)
<ul>
	<li />Renum�rotation des versions
	<li />Possibilit� de choisir la page � afficher par un menu d�roulant dans la vue par liste.
	<li />La Recherche intelligente prend d�sormais en charge l'op�rateur d'agr�gation &&.
	<li />La recherche intelligente op�re d�sormais une comparaison approximative au lieu d'une comparaison exacte sur les champs nom, pr�nom, adresse et e-mail.
	<li />Bug corrig�: les champs contenant la question personnelle et la r�ponse secr�te ne sont d�sormais plus export�s (XLS, CSV).
</ul>
</p>

<p>Version 0.9.2 <i>b�ta</i> (08/01/2007)
<ul>
	<li />Traduction de l'interface en espagnol.
</ul>
</p>

<p>Version 0.9.1 <i>b�ta</i> (05/01/2007)
<ul>
	<li />Menu aide
	<li />Exportation rapide: seuls certains champs seront export�s.
	<li />Les administrateurs peuvent d�sormais emp�cher l'exportation du tout et forcer l'exportation rapide.
	<li />Les slashes et les tags HTML sont d�sormais retir�s avant l'exportation CVS et XLS.
</ul>
</p>

<p>Version 0.8.4 <i>b�ta</i> (03/01/2007)
<ul>
	<li />Correction du bug � cause duquel les changements de th�me n'�taient pas pris en compte apr�s rafra�chissement de la page (sur Celeonet - incompatibilit� PHP4).
	<li />Il est d�sormais possible de modifier/supprimer une fiche apr�s l'avoir modifi�e, sans la r�afficher pr�alablement.
	<li />Si une phrase n'a pas �t� traduite dans la langue choisie (ou d�sign�e), elle sera affich�e � fran�ais.
	<li />Si une phrase n'a pas �t� d�finie en fran�ais, un espace vide sera laiss� et aucun message d'erreur PHP ne sera affich�.
</ul>
</p>

<p>Version 0.8.3 <i>b�ta</i> (02/01/2007)
<ul>
	<li />Traduction de l'interface en anglais.
	<li />Choix du th�me graphique par l'utilisateur pour la dur�e de la session.
	<li />D�localisation des couleurs du fichier JS central vers le JS des th�mes.
	<li />Appel d'une feuille de style sp�cifique � Microsoft Internet Explhorreur.
	<li />Compatibilit� CSS IE: le menu s'affiche d�sormais horizontalement.
	<li />Compatibilit� CSS IE: les sous-menus sont d�sormais affich�s au bon endroit.
	<li />Compatibilit� CSS IE: le conteneur principal est d�sormais centr� � l'�cran.
</ul>
</p>

<p>Version 0.8.2 <i>b�ta</i> (01/01/2007)
<ul>
	<li />Choix de la langue par l'utilisateur pour la dur�e de la session.
	<li />Impression des fiches renvoy�es en r�sultat d'une recherche.
	<li />Des ic�nes dans les menus pour faire plus color� et joyeux...
	<li />Correction d'un bug � cause duquel la pagination des fiches n'�tait pas traduite.
</ul>
</p>

<p>Version 0.8 <i>b�ta</i> (31/12/2006)
<ul>
	<li />Impression des fiches.
	<li />Exportation au format XML (b�ta) et XLS (b�ta).
	<li />Sous menus.
	<li />Sous-menu "Exportation.." avec les fonctions d'exportation et d'impression avanc�es.
	<li />Sous-menu "Fiches..." avec les fonctions avanc�es de manipulation des fiches (modifier, supprimer, trier).
	<li />Les questions ne sont plus affich�es lorsqu'elles n'ont pas de r�ponse.
	<li />Le cadre des options de recherche a �t� retravaill� pour �tre mieux affich�.
	<li />Le champ de mot de passe lors de la connexion affiche sont contenu en clair.
	<li />Interception d'un lien vers la page d'accueil de remplissage automatique du champ de mot de passe.
	<li />Correction d'un bug d'affichage (IE7/Firefox): la hauteur des pages est maintenant fix�e.
	<li />Correction d'un bug d'affichage (Firefox): la page d'accueil est directement affich�e apr�s la connexion.
</ul>
</p>

<p>Version 0.7.2 <i>b�ta</i> (30/12/2006)
<ul>
	<li />Correction d'un bug � cause duquel seuls les enregistrements de la page courante �taient export�s par la fonction "Exporter tout".
	<li />Correction d'un bug d'affichage qui faisait appara�tre une bande blanche entre le corps de la page et le pied de page.
</ul>
</p>

<p>Version 0.7.1 <i>b�ta</i> (29/12/2006)
<ul>
	<li />Tri des enregistrements.
	<li />Le tri est possible en vue par liste, selon les crit�res suivants: nom, pr�nom, promotion, e-mail.
	<li />Le tri s'op�re par ordre ascendant ou descendant.
	<li />Le crit�re de tri choisi est conserv� pendant la dur�e de la session ou jusqu'� ce qu'il soit modifi�.
	<li />Par d�faut les enregistrements sont tri�s par nom de A � Z.
	<li />Correction d'un bug mineur qui g�n�rait des alertes PHP.
	<li />Pied de page et mentions de copyright.
</ul>
</p>

<p>Version 0.6 <i>b�ta</i> (25/12/2006)
<ul>
	<li />Tooltips (abbr).
	<li />Cr�ation automatique du tooltip "promotion".
	<li />Ajout de l'entr�e "Accueil" au menu principal.
	<li />Correction d'un bug qui g�n�rait des alertes PHP sur la page d'accueil.
</ul>
</p>

<p>Version 0.5.2 <i>b�ta</i> (21/12/2006)
<ul>
	<li />Pagination de la liste des enregistrements.
	<li />D�finition du crit�re d'indentation de la pagination par les administrateurs.
	<li />Outils � disposition des administrateurs pour supprimer des enregistrements.
</ul>
</p>

<p>Version 0.5.1 <i>b�ta</i> (21/12/2006)
<ul>
	<li />Syst�me de protection des enregistrements contre les modifications et les suppressions par question et r�ponse secr�te.
	<li />Le syst�me �value la r�ponse soumise et la r�ponse enregistr�e en lower case.
	<li />Il est d�sormais possible de d�sactiver le syst�me de protection global par mot de passe (r�serv� aux administrateurs).
</ul>
</p>

<p>Version 0.4 <i>b�ta</i> (18/12/2006)
<ul>
	<li />Exportation CSV.
	<li />[Exportation] Il est possible d'exporter toutes les donn�es en vue "liste".
	<li />[Exportation] Il est possible d'exporter uniquement les r�sultats d'une recherche.
</ul>
</p>

<p>Version 0.3.2 <i>b�ta</i> (18/12/2006)
<ul>
	<li />[Bug] Le formulaire de recherche est d�sormais affich� d�s la connexion, sans qu'il soit n�cessaire de recharger la page.
	<li />[Compatibilit� PHP] Modification de quelques variables qui causaient une mauvaise segmentation des requ�tes de recherche en PHP4.
	<li />[S�curit�] Protection des apostrophes et des espaces initiales/finales dans les requ�tes de recherche.
	<li />[Bug] Le message signalant un mauvais mot de passe ne s'affiche plus hors du corps de la page.
	<li />[Bug] Il n'y aura plus de message d'erreur de perte de la connexion MySQL lors de la d�connexion.
</ul>
</p>

<p>Version 0.3.1 <i>b�ta</i> (18/12/2006)
<ul>
	<li />Impl�mentation des fonctions de recherche.
	<li />[Recherche automatique] La recherche par d�faut trie automatiquement les nombres (promotion et dates de naissance) des cha�nes de texte (tous les autres champs). En outre, un espace est interpr�t� comme un op�rateur "ET". Les premiers champs sont compar�s avec un crit�re d'exactitude, les champs correspondant aux questions sont parcourus � la recherche d'approximations avec les crit�res de recherche.
	<li />[Recherche manuelle] Il est possible d'effectuer la recherche d'un bout de texte dans tous les champs de la base de donn�es, avec prise en compte automatique des approximations.
	<li />[Recherche manuelle] Il est possible de restreindre la recherche � certains champs, la valeur entr�e sera alors compar�e � l'identique (pas d'approximation possible).
</ul>
</p>

<p>Version 0.2.2 <i>b�ta</i> (17/12/2006)
<ul>
	<li />Les sauts de ligne simples et doubles sont d�sormais pris en compte.
	<li />Il est d�sormais possible d'ajouter des tags HTML de formatage de texte.
	<li />Les tags HTML agressifs (p. ex. div ou php) ne peuvent plus �tre utilis�s.
	<li />Le menu et les messages sont maintenant traduits.
	<li />Il est d�sormais possible de supprimer des enregistrements.
	<li />Protection contre les doublons (bas�e sur le nom et le pr�nom, insensible � la casse).
	<li />V�rification de la compl�tude des champs lors de l'ajout et de la modification d'un enregistrement.
	<li />Le nom de famille est mis en minuscules, sauf la premi�re lettre, lors de l'ajout et de la modification.
</ul>
</p>

<p>Version 0.2.1 <i>b�ta</i> (16/12/2006)
<ul>
	<li />[Bug] D�sormais, il n'y aura plus de coupure entre l'en-t�te et le menu avec le message "connexion r�ussie".
	<li />Apr�s d'une fiche, l'utilisateur est renvoy� vers la page d'affichage de cette fiche.
	<li />D�tection automatique de la langue du navigateur de l'utilisateur et affichage du texte en fonction.
	<li />Formatage des dates en toutes lettres dans la vue "fiche".
	<li />Am�liorations diverses dans l'interface.
</ul>
</p>

<p>Version 0.1.4 <i>alpha</i> (09/12/2006)
<ul>
	<li />Modification des fiches d'utilisateur.
	<li />Correction de probl�mes d'encodage.
	<li />Base de la structure HTML (squelette des pages).
	<li />Base de la structure CSS (apparence des pages).
</ul>
</p>

<p>Version 0.1.3 <i>alpha</i> (09/12/2006)
<ul>
	<li />Formulaire d'ajout d'utilisateur
	<li />Liste des utilisateurs inscrits
	<li />Fiche compl�tes des utilisateurs
</ul>
</p>

<p>Version 0.1.2 <i>alpha</i> (08/12/2006)
<ul>
	<li />Cr�ation du template de la page principale: bloc corps et bloc menu.
	<li />Syst�me d'includes pour les pages contenant les formulaires.
	<li />Possibilit� pour les administrateurs de modifier le mot de passe de la base de donn�es.
</ul>
</p>

<p>Version 0.1.1 <i>alpha</i> (07/12/2006)
<ul>
	<li />Cr�ation de la structure du logiciel.
	<li />Protection de la base de donn�es par un mot de passe (pas d'identification des utilisateurs).
</ul>
</p>