/*
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
*/

/*
Renvoie 1 si le visiteur utilise IE, renvoie 0 dans le cas contraire.
*/
function isIE()
{
      var ua = window.navigator.userAgent;
      var msie = ua.indexOf ( "MSIE " );

      if ( msie > 0 )      
         return 1;
      else                 
         return 0;
}

function menu(base, obj)
{	
	/* Initialisation des variables */
	var base = document.getElementById(base);
	var elt = document.getElementById(obj);
	
	/* S'il est affiché, on va le cacher et ce n'est pas la peine de continuer */
	if(elt.style.display == "block") { montrer_cacher (obj); return ; }
	
	/* Placer le menu juste en dessous du titre */
	/* IE */
	if(isIE())
	{		
		var rect = base.getBoundingClientRect(); 		
		elt.style.top = rect.bottom + 5;
		elt.style.left = rect.left + 20;
	}
	/* Mozilla Gecko */
	else if(document.getBoxObjectFor)
	{
		var rect = document.getBoxObjectFor(base); 
		elt.style.top = rect.y + rect.height + 5;
		elt.style.left = rect.x + 15;
	}
	/* KHTML */
	else
	{
		/* Obtenir la position du titre du menu */
		var ybase = base.offsetTop;
		var xbase = base.offsetLeft;
		
		elt.style.top = ybase + 25;
		elt.style.left = xbase + 20;
	}
	
	/* Afficher ou cacher le menu */
	montrer_cacher(obj);
}

function montrer_cacher(obj)
{
	var elt = document.getElementById(obj);
	if(elt.style.display != "block")
	{
		elt.style.display = "block";
	
	}
	else
	{
		elt.style.display = "none";
	}
}

/* Fonction générée par DreamWeaver 8.0 */
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

function js_redirect(page) 
{	
	location = page;
}

function js_direct(page) 
{	
	window.location = page;
}

function change_couleur(objet)
{	objet.style.backgroundColor = "#FFCC66";
}

function restaure_couleur(objet)
{	objet.style.backgroundColor = "#E1E4F2";
}

function change_couleur(objet, couleur)
{	objet.style.backgroundColor = couleur;
}

function restaure_couleur(objet, couleur)
{	objet.style.backgroundColor = couleur;
}

function reinit_couleur(objet) 
{
	objet.style.backgroundColor = "#F5F5FF";
}

function say(o)
{
	alert(o);
}

function completude(objet)
{		
	var msg = "";
	
	//############ ALERTE SI UN CHAMP OU PLUS EST VIDE #########################
	if (objet.nom.value == ""
		|| objet.prenom.value == ""
		|| objet.promotion.value == ""
		|| objet.nationalite.value == ""
		|| objet.naissance.value == ""
		|| objet.email.value == ""
		|| objet.secret_question.value == ""
		|| objet.secret_reponse.value == "")	
	{	msg += "Veuillez remplir tous les champs obligatoires \n\n";
	}
	
	//########### COLORATION DU BACKGROUND DES CHAMPS VIDES EN ROUGE ###########
	if(objet.nom.value == "")
	{	objet.nom.style.backgroundColor = "#FF0000";
	}
	
	if(objet.prenom.value == "")
	{	objet.prenom.style.backgroundColor = "#FF0000";
	}
	
	if(objet.promotion.value == "")
	{	objet.promotion.style.backgroundColor = "#FF0000";
	}
	
	if(objet.nationalite.value == "")
	{	objet.nationalite.style.backgroundColor = "#FF0000";
	}
	
	if(objet.naissance.value == "")
	{	objet.naissance.style.backgroundColor = "#FF0000";
	}
	
	if(objet.email.value == "")
	{	objet.email.style.backgroundColor = "#FF0000";
	}
	
	if(objet.secret_question.value == "")
	{	objet.secret_question.style.backgroundColor = "#FF0000";
	}
	
	if(objet.secret_reponse.value == "")
	{	objet.secret_reponse.style.backgroundColor = "#FF0000";
	}
	
	//############ VERIFICATION DU FORMAT DE DATE ##############################
	
	var daten = objet.naissance.value;
	var temp = new Array();
	// temp = daten.split('-'); // DEPRECATED: ancien format
	temp = daten.split('/');
	
	// Si le séparateur de date n'est pas "-": message d'erreur
	if(temp[0] == null || temp[1] == null || temp[2] == null)
		// DEPRECATED: ancien format
		//msg += "Veuillez formater la date au format indiqué: \n\nAAAA-MM-JJ \n\n AAAA représente l'année sur 4 chiffres \n MM représente le mois sur 2 chiffres \n JJ représente le jour sur 2 chiffres";
				msg += "Veuillez formater la date au format indiqué: \n\nJJ/MM/AAAA \n\n JJ représente le jour sur 2 chiffres \n MM représente le mois sur 2 chiffres \n AAAA représente l'année sur 4 chiffres ";
	// Sinon, la date a le bon séparateur ("-")
	else
	{
		/* // DEPRECATED: ancien format
		j = temp[2];
		m = temp[1];
		a = temp[0];
		*/
		j = temp[0];
		m = temp[1];
		a = temp[2];
		
		// Contrôler que le jour, le mois et l'année sont bien à 2 et 4 chiffres.
		if(j.length < 2)
			msg += "Format de date incorrect. \nVeuillez entrer le jour sur 2 chiffres.";
		if(m.length < 2)
			msg += "Format de date incorrect. \nVeuillez entrer le mois sur 2 chiffres.";
		if(a.length < 4)
			msg += "Format de date incorrect. \nVeuillez entrer l'année sur 4 chiffres.";
			
		// Contrôler que le jour est entre 01 et 31, le mois entre 01 et 12, l'année >1900
		if(!(j >= 01 && j <= 31))
			msg += "Format de date incorrect. \nLe jour doit être compris entre 01 et 31.";
		if(!(m >= 01 && m <= 12))
			msg += "Format de date incorrect. \nLe mois doit être compris entre 01 et 12.";
		if(!(a >= 1900 && a <= 2100))
			msg += "Format de date incorrect. \nL'année doit être comprise entre 1900 et 2100.";			
	}

	/* // Pour une future version, mais ne fonctionne pas encore (pattern non reconnu ?)
	var daten = objet.naissance.value;
	var pattern="`([0-9]{2})/([0-9]{2})/([0-9]{4})`";
	var bool;
	
	bool = pattern.test(daten);	
	
	if(!bool)
	{
		msq += "Format de date incorrect. Veuillez formater la date au format indiqué: \n\nJJ/MM/AAAA \n\n AAAA représente l'année sur 4 chiffres \n MM représente le mois sur 2 chiffres \n JJ représente le jour sur 2 chiffres"
	}
	*/
	
	
	
	//############ VERIFICATION DU FORMAT E-MAIL ##############################
	var mailn = objet.email.value;

	var maila = new Array();
	maila = mailn.split('@');
	var mailb = new Array();
	mailb = mailn.split('.');
	
	if(maila[0] == null || maila[1] == null || mailb[0] == null || mailb[1] == null)
		msg += "\n\nVeuillez formater l'adresse e-mail au format suivant: \n dupont@martin.com";

	//########### VERIFICATION DU FORMAT DE PROMOTION ###########################
	var promon = objet.promotion.value;
	if(promon.length < 4)
		msg += "\n\nVeuillez spécifier l'année de votre promotion sur 4 chiffres.";

	//########### RETOUR ET AFFICHAGE DE L'ALERTE ##############################
	if (msg == "") return(true); // on envoie le formulaire
	else	// on n'envoie pas...
	{	alert(msg);
		return(false);
	}
}
