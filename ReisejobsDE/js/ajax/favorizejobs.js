document.querySelectorAll('.favbtn').forEach(function(objElement)
{
	objElement.addEventListener('click', function()
	{
		let classlist = objElement.classList.toString();
		let objRequest = new XMLHttpRequest();
		objRequest.open("GET", "azubi/ReisejobsDE/ajax/Favorite?ID=" + objElement.id, true);
		objRequest.onload  = function()
		{
			if(this.status >= 200 && this.status < 400)
			{
				if(classlist.includes("redicon")){
					objElement.classList.remove("redicon")

				}else{
					objElement.classList.add("redicon")
				}
			}
		};
		objRequest.send();

	});
})