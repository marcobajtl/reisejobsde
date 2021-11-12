window.onload = function(){

	//Springt direkt auf das Kontaktformular, wenn ein Parameter im get angegeben ist.
	if(window.location.search.substr(1)){
		setWindowKontakt()
	}

	//Setzen der Event Listener
	document.getElementById('favjobs').onclick = function()
	{
		setWindowJobs()
	}

	document.getElementById('quickkontakt').onclick = function()
	{
		setWindowKontakt()
	};

	document.getElementById('changebtn').onclick = function()
	{
		editField(['sidevorname', 'sidenachname', 'sideemail', 'sidebeschreibung']);
	};
}



function editField(arrFieldid)
{
	for(let counter in arrFieldid)
	{
		let objChangebtn       = document.getElementById('changebtn');
		let objElement         = document.getElementById(arrFieldid[counter]);
		let objUploadbtn       = document.getElementById('uploadbtn');
		let strCurrentText     = objElement.textContent;
		//Ändert Value Button vom Inhalt auf "Save"
		objUploadbtn.classList = '';
		objChangebtn.value     = 'Save';
		//Ändert Textfelder zu eingabefelder mit dem vorgeschriebenen Text, der zuvor bereits eingegeben wurde.
		if(counter <= 2)
		{
			console.log("123")
			objElement.innerHTML = '<input id=\'' + arrFieldid[counter] + 'new\' type=\'text\' name="' + arrFieldid[counter] + '" value=\'' + strCurrentText + '\'/>';
		}
		else
		{
			objElement.innerHTML = '<textarea rows="10" class="editarea" id=\'' + arrFieldid[counter] + 'new\' name="' + arrFieldid[counter] + '">' + strCurrentText + '</textarea>';
		}
		//Ändert Button auf den Typ Button
		objChangebtn.type = 'button';
	}

	document.getElementById('changebtn').onclick = function()
	{
		for(let counter in arrFieldid)
		{
			//Ändert den Type des Savebuttons auf Submit
			let objChangebtn                             = document.getElementById('changebtn');
			objChangebtn.type                            = 'submit';
			document.getElementById('changebtn').onclick = function()
			{
				editField(arrFieldid);
			};
		}
	};
}

//Setzt die Anzeige in der Main Section auf das Kontaktformular
function setWindowKontakt(){
	let objButton = document.getElementById('favjobs')
	let objOtherBtn = document.getElementById('quickkontakt')
	let objJobContainer = document.getElementById('jobcontainer');
	let objQuickKontakt = document.getElementById('quickkontaktarea');
	if(objQuickKontakt.classList.toString().includes("hidden")){
		objQuickKontakt.classList.replace("hidden", "shown")
		objJobContainer.classList += " hidden"
		objOtherBtn.classList += " active"
		objButton.classList.replace("active", "shown")
	}
}

//Setzt die Anzeige in der Main Section auf die Favorisierten Jobs
function setWindowJobs(){
	let objButton = document.getElementById('favjobs')
	let objOtherBtn = document.getElementById('quickkontakt')
	let objJobContainer = document.getElementById('jobcontainer');
	let objQuickKontakt = document.getElementById('quickkontaktarea');
	if(objJobContainer.classList.toString().includes("hidden")){
		objJobContainer.classList.replace("hidden", "shown")
		objQuickKontakt.classList += " hidden"
		objButton.classList += " active"
		objOtherBtn.classList.replace("active", "shown")
	}
}