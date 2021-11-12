document.getElementById('changebtn').onclick = function()
{
	editField(['uname', 'uort', 'ubeschreibung']);
};

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
		if(counter <= 1)
		{
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

//Lässt das Popup Fenster zum erstellen neuer Jobangebote verschwinden
let modal      = document.getElementById('id01');
window.onclick = function(event)
{
	if(event.target === modal)
	{
		modal.style.display = 'none';
	}
};

//Zeigt das Popup Fenster an.
document.getElementById('addbtn').onclick = function()
{
	document.getElementById('id01').style.display = 'block';
};