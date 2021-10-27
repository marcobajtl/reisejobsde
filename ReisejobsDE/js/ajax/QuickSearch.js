function getList(strInputFieldID, strOutPutList, getPara)
{

	let strSearch = document.getElementById(strInputFieldID).value;
	if(strSearch.length >= 3)
	{
		let objRequest = new XMLHttpRequest();
		objRequest.open("GET", "azubi/ReisejobsDE/ajax/QuickSearch?"+ getPara +"=" + strSearch, true);
		objRequest.onload  = function()
		{
			if(this.status >= 200 && this.status < 400)
			{
				//Erfolg
				document.getElementById(strOutPutList).innerHTML = this.response;

			}
			else
			{
				console.log("Something went wrong")
			}
		};
		objRequest.onerror = function()
		{
			console.log("Error")
		}
		objRequest.send();
	}
	else
	{
		document.getElementById(strOutPutList).innerHTML = ""
	}
}
console.log("Quicksearch geladen!")
document.getElementById("unternehmen").onkeyup = function() {getList("unternehmen", "unternehmenliste", "unternehmen")};
document.getElementById("jobtitel").onkeyup = function() {getList("jobtitel", "jobliste", "jobtitel")};
document.getElementById("PLZ").onkeyup = function() {getList("PLZ", "OrtsListe", "postleitzahl")};