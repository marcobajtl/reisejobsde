function getList(strInputFieldID, strOutPutList, getPara)
{

	let strSearch = document.getElementById(strInputFieldID).value;
	if(strSearch.length >= 3)
	{
		// Neue HTTP Request an /ajax/QuickSearch mit Suchparameter
		let objRequest = new XMLHttpRequest();
		objRequest.open("GET", "azubi/ReisejobsDE/ajax/QuickSearch?"+ getPara +"=" + strSearch, true);
		objRequest.onload  = function()
		{
			if(this.status >= 200 && this.status < 400)
			{
				//Erfolg -> Liste wird ausgegeben
				document.getElementById(strOutPutList).innerHTML = this.response;

			}
		};
		objRequest.send();
	}
	else
	{
		//Gibt Leere Liste aus, wenn in der Suchleiste weniger als 3 stellen eingegeben wurden.
		document.getElementById(strOutPutList).innerHTML = ""
	}
}

console.log("Quicksearch geladen!")
document.getElementById("unternehmen").onkeyup = function() {getList("unternehmen", "unternehmenliste", "unternehmen")};
document.getElementById("jobtitel").onkeyup = function() {getList("jobtitel", "jobliste", "jobtitel")};
document.getElementById("PLZ").onkeyup = function() {getList("PLZ", "OrtsListe", "postleitzahl")};