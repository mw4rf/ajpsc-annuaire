<span>&nbsp;</span>

<p>Version 1.5 (XX/XX/2013)
<ul>
    <li />Retour du moteur de recherche.
    <li />Affichage conditionnelle du moteur de recherche (v. fichier de configuration)
</ul>
</p>

<p>Version 1.4.2 (16/11/2010)
<ul>
	<li />[Bug] Correction d'une faille de sécurité dans le script d'exportation "imprimer".
	<li />Amélioration de la présentation de l'exportation "imprimer".
	<li />[Photos] Affichage des photos dans l'exportation "imprimer".
	<li />Amélioration de la présentation du menu de navigation dans les pages liste et galerie.
</ul>
</p>

<p>Version 1.4.1 (15/11/2010)
<ul>
	<li /><b>Galerie de photos</b>
	<li />[Photos] Tri des photos de la galerie par Promotion (2->1).
	<li />[Photos] Tri des photos de la galerie par Nom de famille (A->Z).
	<li />[Bug] La mise-à-jour d'une fiche sans modification de la photo n'affiche plus de message d'erreur relatif au format de l'image.
</ul>
</p>

<p>Version 1.4 (14/11/2010)
<ul>
	<li /><b>Ajout de photographies aux fiches.</b>
	<li />[Photos] Mise en ligne d'une photo d'identité lors de la création d'une fiche.
	<li />[Photos] Mise en ligne d'une (nouvelle) photo lors de la modification d'une fiche.
</ul>
</p>

<p>Version 1.3.1 (16/04/2007)
<ul>
	<li /><b>Gestion des favicons dans les thèmes.</b>
	<li />[Bug] Les éléments du menu sont désormais correctement affichés sur une seule ligne avec Firefox (et les navigateurs Gecko).
	<li />[Bug] Les sous-menus sont désormais correctement positionnés au dessous de leur élément parent avec Safari (et les navigateurs KHTML).
	<li />[Bug] Le menu principal est désormais correctement aligné à gauche dans Internet Explorer.
	<li />[Bug] Les éléments des sous-menus sont désormais correctement alignés à gauche dans Internet Explorer.
	<li />[Bug] Le champ de recherche est désormais correctement aligné verticalement dans Internet Explorer.
	<li />[Bug] Le champ de recherche est désormais correctement aligné horizontalement dans tous les navigateurs.
</ul>
</p>

<p>Version 1.3 (14/04/2007)
<ul>
	<li />Réécriture complète du moteur de recherche (avec instanciation).
	<li /><b>Il est désormais possible d'utiliser des <i>expressions régulières</i> dans les recherches.</b>
	<li /><b>Il est désormais possible d'effectuer des recherches <i>fulltext</i> (ou sémantiques).</b>
	<li />Les résultats de recherche (auto et <i>fulltext</i>) sont notés en fonction de leur pertinence.
	<li />Ajout d'opérateurs de comparaison (&lt; et &gt;) pour rechercher des plages de dates (la recherche se limite aux promotions).
	<li />Les mots génériques (le, las, les...) sont désormais automatiquement exclus de la recherche.
	<li />Le nombre de résultats de recherche est désormais affiché sur la page des résultats.
	<li />La requête ou les motifs de recherche sont désormais affichés sur la page des résultats.
	<li />Les dates sont désormais affichées par défaut au format européen JJ/MM/AAAA.
	<li />Les dates sont désormais remplies dans les formulaires au format européen JJ/MM/AAAA.
	<li />Lorsque la langue courante de l'annuaire est l'ANGLAIS, les dates sont affichées au format AMÉRICAIN et doivent être insérées dans les formulaires au format AMÉRICAIN (MM/DD/YYYY).
	<li />Certains messages (ajout de fiche, modification, erreur d'identification, etc.) sont désormais affichés de manière plus visible.
	<li />[Bug] Les doublons dans les résultats de recherche sont désormais éliminés (si un résultat répond à deux critères séparés par OR, il ne sera plus affiché deux fois)
	<li />[Bug] Les noms de famille composés sont désormais correctement affichés dans les résultats de recherche, sur les pages d'impression et de modification et dans les données exportées.
	<li />[Bug] Le menu Thèmes pouvait afficher les fichiers cachés du répertoire des thèmes. Ce problème dû à la fonction de parcours des fichiers du répertoire est résolu.
</ul>
</p>

<p>Version 1.2.1 (31/03/2007)
<ul>
	<li />[Bug] Tous les membres des noms de famille et des prénoms composés ont désormais leur première lettre en majuscule (Hubert Bonisseur de la bath => Hubert Bonisseur De La Bath)
	<li />[Bug] Le bug qui décalait vers la droite le pied de page de la dernière page du fichier PDF généré lors de l'exportation de l'entier contenu de l'annuaire est corrigé.
	<li />[Bug] Le bug qui décalait trop en bas les deux dernières colonnes, sauf sur la première page, est corrigé.
</ul>
</p>


<p>Version 1.2 (30/03/2007)
<ul>
	<li /><b>Système de génération de PDF à la volée.</b>
	<li />PDF: Exportation vers un PDF de la totalité de l'annuaire (menu Exportation, option permanente).
	<li />PDF: Exportation vers un PDF des résultats de la recherche (menu Exportation, option visible après une recherche).
	<li />PDF: Exportation vers un PDF de la fiche courante (menu Exportation, option visible lors de la consultation d'une fiche).
	<li />PDF: Modèle PDF "AJPSC Annuaire".
	<li />PDF: Annexe 1, liste des étudiants par promotion.
	<li />PDF: Annexe 2, liste des étudiants par ordre alphabétique.
	<li />PDF: Variables dynamiques (date, compteur) sur la page de garde.
	<li />PDF: Logos sur la page de garde.
	<li />PDF: Liens externes dans le fichier PDF généré (e-mail et URLs).
	<li />PDF: Remplissage automatique des méta-données du fichier PDF généré.
	<li />PDF: Les annexes et la page de garde ne s'affichent que lors de l'exportation de l'annuaire entier.
	<li />PDF: En-têtes et pieds de page personnalisés (logo et titre calligraphié).
	<li />PDF: Police dédiée (avec fichiers métriques "maison"): Lucida calligraphy.
	<li />PDF: Reformulation des questions sous la forme affirmative.
	<li />[Sécurité] Correction d'une faille de sécurité dans le passage des requêtes GET qui utilisent une variable numérique ID.
	<li />Reformulation des questions sous la forme affirmative dans l'affichage des fiches.
</ul>
</p>

<p>Version 1.1.3 (03/03/2007)
<ul>
	<li />Le mode administration débouche désormais sur une page d'accueil spécifique.
	<li />Le mode administration permet désormais de modifier la réponse secrète d'un utilisateur.
	<li />[Admin] Génération d'un hash SHA1 depuis un formulaire.
	<li />[Admin] Possibilité de modifier la réponse secrète d'un utilisateur.
	<li />[Admin] Liens pour une version papier
	<li />[Admin] Statistiques de la base de données
	<li />Les prénoms seront désormais formatés comme les noms de famille: première lettre en majuscule, le reste en minuscules.
	<li />Contrôle du format des dates dans le formulaire d'ajout (YYYY-MM-DD).
	<li />Contrôle du format des e-mails dans le formulaire d'ajout (dupont@martin.com).
	<li />Contrôle du format de la promotion dans le formulaire d'ajout (4 chiffres).
</ul>
</p>

<p>Version 1.1.2 (26/02/2007)
<ul>
	<li />[Bug] Le bug qui empêchait la reconnaissance des réponses secrètes contenant une majuscule en début de chaîne est désormais corrigé.
</ul>
</p>

<p>Version 1.1.1 (25/02/2007)
<ul>
	<li />Ajout d'un lien direct pour retourner aux résultats de recherche depuis les détails d'une fiche.
	<li />Annuler tout critère de tri des fiches ("X") a désormais pour effet de les afficher par id, en ordre ascendant.
	<li />Tri des fiches par ordre de mise à jour, depuis le menu Fiches, pour afficher les fiches les plus récemment actualisées.
	<li />[Bug] Cliquer sur une ligne dans les résultats d'une recherche renvoie désormais vers la fiche correspondante (avant: pouvait renvoyer sur une page vide).
	<li />[Bug] Les tooltips (abbr) sont désormais correctement affichés dans la liste des résultats d'une recherche.
</ul>
</p>

<p>Version 1.1 (23/02/2007)
<ul>
	<li /><b>Implémentation du système d'administration.</b>
	<li />Les administrateurs peuvent modifier n'importe quelle fiche sans répondre à la question secrète.
	<li />Les administrateurs peuvent supprimer n'importe quelle fiche sans répondre à la question secrète.
</ul>
</p>

<p>Version 1.0.1 (22/02/2007)
<ul>
	<li />La date d'ajout d'une fiche est enregistrée lors de l'enregistrement de cette fiche.
	<li />La date de modification d'une fiche est enregistrée lors de la modification de cette fiche.
	<li />La date d'ajout ou de dernière modification d'une fiche est affichée dans les détails de cette fiche.
	<li />Ce système permet aux gens qui consultent l'annuaire de savoir si telle ou telle fiche est à jour.
</ul>
</p>

<p>Version 1.0 (21/02/2007)
<ul>
	<li /><b>Ouverture publique de l'annuaire, le mercredi 21 février 2007.</b>
</ul>
</p>

<p>Version 0.9.3 <i>bêta</i> (09/01/2007)
<ul>
	<li />Renumérotation des versions
	<li />Possibilité de choisir la page à afficher par un menu déroulant dans la vue par liste.
	<li />La Recherche intelligente prend désormais en charge l'opérateur d'agrégation &&.
	<li />La recherche intelligente opère désormais une comparaison approximative au lieu d'une comparaison exacte sur les champs nom, prénom, adresse et e-mail.
	<li />Bug corrigé: les champs contenant la question personnelle et la réponse secrète ne sont désormais plus exportés (XLS, CSV).
</ul>
</p>

<p>Version 0.9.2 <i>bêta</i> (08/01/2007)
<ul>
	<li />Traduction de l'interface en espagnol.
</ul>
</p>

<p>Version 0.9.1 <i>bêta</i> (05/01/2007)
<ul>
	<li />Menu aide
	<li />Exportation rapide: seuls certains champs seront exportés.
	<li />Les administrateurs peuvent désormais empêcher l'exportation du tout et forcer l'exportation rapide.
	<li />Les slashes et les tags HTML sont désormais retirés avant l'exportation CVS et XLS.
</ul>
</p>

<p>Version 0.8.4 <i>bêta</i> (03/01/2007)
<ul>
	<li />Correction du bug à cause duquel les changements de thème n'étaient pas pris en compte après rafraîchissement de la page (sur Celeonet - incompatibilité PHP4).
	<li />Il est désormais possible de modifier/supprimer une fiche après l'avoir modifiée, sans la réafficher préalablement.
	<li />Si une phrase n'a pas été traduite dans la langue choisie (ou désignée), elle sera affichée à français.
	<li />Si une phrase n'a pas été définie en français, un espace vide sera laissé et aucun message d'erreur PHP ne sera affiché.
</ul>
</p>

<p>Version 0.8.3 <i>bêta</i> (02/01/2007)
<ul>
	<li />Traduction de l'interface en anglais.
	<li />Choix du thème graphique par l'utilisateur pour la durée de la session.
	<li />Délocalisation des couleurs du fichier JS central vers le JS des thèmes.
	<li />Appel d'une feuille de style spécifique à Microsoft Internet Explhorreur.
	<li />Compatibilité CSS IE: le menu s'affiche désormais horizontalement.
	<li />Compatibilité CSS IE: les sous-menus sont désormais affichés au bon endroit.
	<li />Compatibilité CSS IE: le conteneur principal est désormais centré à l'écran.
</ul>
</p>

<p>Version 0.8.2 <i>bêta</i> (01/01/2007)
<ul>
	<li />Choix de la langue par l'utilisateur pour la durée de la session.
	<li />Impression des fiches renvoyées en résultat d'une recherche.
	<li />Des icônes dans les menus pour faire plus coloré et joyeux...
	<li />Correction d'un bug à cause duquel la pagination des fiches n'était pas traduite.
</ul>
</p>

<p>Version 0.8 <i>bêta</i> (31/12/2006)
<ul>
	<li />Impression des fiches.
	<li />Exportation au format XML (bêta) et XLS (bêta).
	<li />Sous menus.
	<li />Sous-menu "Exportation.." avec les fonctions d'exportation et d'impression avancées.
	<li />Sous-menu "Fiches..." avec les fonctions avancées de manipulation des fiches (modifier, supprimer, trier).
	<li />Les questions ne sont plus affichées lorsqu'elles n'ont pas de réponse.
	<li />Le cadre des options de recherche a été retravaillé pour être mieux affiché.
	<li />Le champ de mot de passe lors de la connexion affiche sont contenu en clair.
	<li />Interception d'un lien vers la page d'accueil de remplissage automatique du champ de mot de passe.
	<li />Correction d'un bug d'affichage (IE7/Firefox): la hauteur des pages est maintenant fixée.
	<li />Correction d'un bug d'affichage (Firefox): la page d'accueil est directement affichée après la connexion.
</ul>
</p>

<p>Version 0.7.2 <i>bêta</i> (30/12/2006)
<ul>
	<li />Correction d'un bug à cause duquel seuls les enregistrements de la page courante étaient exportés par la fonction "Exporter tout".
	<li />Correction d'un bug d'affichage qui faisait apparaître une bande blanche entre le corps de la page et le pied de page.
</ul>
</p>

<p>Version 0.7.1 <i>bêta</i> (29/12/2006)
<ul>
	<li />Tri des enregistrements.
	<li />Le tri est possible en vue par liste, selon les critères suivants: nom, prénom, promotion, e-mail.
	<li />Le tri s'opère par ordre ascendant ou descendant.
	<li />Le critère de tri choisi est conservé pendant la durée de la session ou jusqu'à ce qu'il soit modifié.
	<li />Par défaut les enregistrements sont triés par nom de A à Z.
	<li />Correction d'un bug mineur qui générait des alertes PHP.
	<li />Pied de page et mentions de copyright.
</ul>
</p>

<p>Version 0.6 <i>bêta</i> (25/12/2006)
<ul>
	<li />Tooltips (abbr).
	<li />Création automatique du tooltip "promotion".
	<li />Ajout de l'entrée "Accueil" au menu principal.
	<li />Correction d'un bug qui générait des alertes PHP sur la page d'accueil.
</ul>
</p>

<p>Version 0.5.2 <i>bêta</i> (21/12/2006)
<ul>
	<li />Pagination de la liste des enregistrements.
	<li />Définition du critère d'indentation de la pagination par les administrateurs.
	<li />Outils à disposition des administrateurs pour supprimer des enregistrements.
</ul>
</p>

<p>Version 0.5.1 <i>bêta</i> (21/12/2006)
<ul>
	<li />Système de protection des enregistrements contre les modifications et les suppressions par question et réponse secrète.
	<li />Le système évalue la réponse soumise et la réponse enregistrée en lower case.
	<li />Il est désormais possible de désactiver le système de protection global par mot de passe (réservé aux administrateurs).
</ul>
</p>

<p>Version 0.4 <i>bêta</i> (18/12/2006)
<ul>
	<li />Exportation CSV.
	<li />[Exportation] Il est possible d'exporter toutes les données en vue "liste".
	<li />[Exportation] Il est possible d'exporter uniquement les résultats d'une recherche.
</ul>
</p>

<p>Version 0.3.2 <i>bêta</i> (18/12/2006)
<ul>
	<li />[Bug] Le formulaire de recherche est désormais affiché dès la connexion, sans qu'il soit nécessaire de recharger la page.
	<li />[Compatibilité PHP] Modification de quelques variables qui causaient une mauvaise segmentation des requêtes de recherche en PHP4.
	<li />[Sécurité] Protection des apostrophes et des espaces initiales/finales dans les requêtes de recherche.
	<li />[Bug] Le message signalant un mauvais mot de passe ne s'affiche plus hors du corps de la page.
	<li />[Bug] Il n'y aura plus de message d'erreur de perte de la connexion MySQL lors de la déconnexion.
</ul>
</p>

<p>Version 0.3.1 <i>bêta</i> (18/12/2006)
<ul>
	<li />Implémentation des fonctions de recherche.
	<li />[Recherche automatique] La recherche par défaut trie automatiquement les nombres (promotion et dates de naissance) des chaînes de texte (tous les autres champs). En outre, un espace est interprété comme un opérateur "ET". Les premiers champs sont comparés avec un critère d'exactitude, les champs correspondant aux questions sont parcourus à la recherche d'approximations avec les critères de recherche.
	<li />[Recherche manuelle] Il est possible d'effectuer la recherche d'un bout de texte dans tous les champs de la base de données, avec prise en compte automatique des approximations.
	<li />[Recherche manuelle] Il est possible de restreindre la recherche à certains champs, la valeur entrée sera alors comparée à l'identique (pas d'approximation possible).
</ul>
</p>

<p>Version 0.2.2 <i>bêta</i> (17/12/2006)
<ul>
	<li />Les sauts de ligne simples et doubles sont désormais pris en compte.
	<li />Il est désormais possible d'ajouter des tags HTML de formatage de texte.
	<li />Les tags HTML agressifs (p. ex. div ou php) ne peuvent plus être utilisés.
	<li />Le menu et les messages sont maintenant traduits.
	<li />Il est désormais possible de supprimer des enregistrements.
	<li />Protection contre les doublons (basée sur le nom et le prénom, insensible à la casse).
	<li />Vérification de la complétude des champs lors de l'ajout et de la modification d'un enregistrement.
	<li />Le nom de famille est mis en minuscules, sauf la première lettre, lors de l'ajout et de la modification.
</ul>
</p>

<p>Version 0.2.1 <i>bêta</i> (16/12/2006)
<ul>
	<li />[Bug] Désormais, il n'y aura plus de coupure entre l'en-tête et le menu avec le message "connexion réussie".
	<li />Après d'une fiche, l'utilisateur est renvoyé vers la page d'affichage de cette fiche.
	<li />Détection automatique de la langue du navigateur de l'utilisateur et affichage du texte en fonction.
	<li />Formatage des dates en toutes lettres dans la vue "fiche".
	<li />Améliorations diverses dans l'interface.
</ul>
</p>

<p>Version 0.1.4 <i>alpha</i> (09/12/2006)
<ul>
	<li />Modification des fiches d'utilisateur.
	<li />Correction de problèmes d'encodage.
	<li />Base de la structure HTML (squelette des pages).
	<li />Base de la structure CSS (apparence des pages).
</ul>
</p>

<p>Version 0.1.3 <i>alpha</i> (09/12/2006)
<ul>
	<li />Formulaire d'ajout d'utilisateur
	<li />Liste des utilisateurs inscrits
	<li />Fiche complètes des utilisateurs
</ul>
</p>

<p>Version 0.1.2 <i>alpha</i> (08/12/2006)
<ul>
	<li />Création du template de la page principale: bloc corps et bloc menu.
	<li />Système d'includes pour les pages contenant les formulaires.
	<li />Possibilité pour les administrateurs de modifier le mot de passe de la base de données.
</ul>
</p>

<p>Version 0.1.1 <i>alpha</i> (07/12/2006)
<ul>
	<li />Création de la structure du logiciel.
	<li />Protection de la base de données par un mot de passe (pas d'identification des utilisateurs).
</ul>
</p>