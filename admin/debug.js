function test(date)
{
	var temp = new Array();
	temp = date.split('-');
	
	// Si le séparateur de date n'est pas "-": message d'erreur
	if(temp[0] == null || temp[1] == null || temp[2] == null)
		alert("Veuillez formater la date au format indiqué: \nAAAA-MM-JJ.");
	// Sinon, la date a le bon séparateur ("-")
	else
	{
		j = temp[2];
		m = temp[1];
		a = temp[0];
		
		// Contrôler que le jour, le mois et l'année sont bien à 2 et 4 chiffres.
		if(j.length < 2)
			alert("Format de date incorrect. Veuillez entrer le jour sur 2 chiffres.");
		if(m.length < 2)
			alert("Format de date incorrect. Veuillez entrer le mois sur 2 chiffres.");
		if(a.length < 4)
			alert("Format de date incorrect. Veuillez entrer l'année sur 4 chiffres.");
			
		// Contrôler que le jour est entre 01 et 31, le mois entre 01 et 12, l'année >1900
		if(!(j >= 01 && j <= 31))
			alert("Format de date incorrect. Le jour doit être compris entre 01 et 31.");
		if(!(m >= 01 && m <= 12))
			alert("Format de date incorrect. Le mois doit être compris entre 01 et 12.");
		if(!(a >= 1900 && a <= 2100))
			alert("Format de date incorrect. L'année doit être comprise entre 1900 et 2100.");			
	}
}