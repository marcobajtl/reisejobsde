document.getElementById('changebtn').onclick = function()
{
	editField(['uname', 'uort', 'ubeschreibung']);
};

function editField(arrFieldid)
{
	for(let counter in arrFieldid)
	{
		let objChangebtn   = document.getElementById('changebtn');
		let objElement     = document.getElementById(arrFieldid[counter]);
		let objUploadbtn = document.getElementById("uploadbtn");
		let strCurrentText = objElement.textContent;
		objUploadbtn.classList = ""
		objChangebtn.value   = 'Save';
		objElement.innerHTML = '<input id=\'' + arrFieldid[counter] + 'new\' type=\'text\' name="' + arrFieldid[counter] + '" value=\'' + strCurrentText + '\'/>';
		objChangebtn.type    = 'button';
	}

	document.getElementById('changebtn').onclick = function()
	{
		for(let counter in arrFieldid)
		{
			let objChangebtn = document.getElementById('changebtn');
			objChangebtn.type                               = 'submit';
			document.getElementById('changebtn').onclick = function()
			{
				editField(arrFieldid);
			};
		}
	};
}


let modal = document.getElementById('id01');
window.onclick = function(event) {
	if (event.target === modal) {
		modal.style.display = "none";
	}
}

document.getElementById('addbtn').onclick = function(){
	document.getElementById('id01').style.display='block'
}


// 	let strSearch = document.getElementById(strInputFieldID).value;
// 	if(strSearch.length >= 3)
// 	{
// 		let objRequest = new XMLHttpRequest();
// 		objRequest.open("GET", "azubi/ReisejobsDE/ajax/QuickSearch?"+ getPara +"=" + strSearch, true);
// 		objRequest.onload  = function()
// 		{
// 			if(this.status >= 200 && this.status < 400)
// 			{
// 				//Erfolg
// 				document.getElementById(strOutPutList).innerHTML = this.response;
//
// 			}
// 			else
// 			{
// 				console.log("Something went wrong")
// 			}
// 		};
// 		objRequest.onerror = function()
// 		{
// 			console.log("Error")
// 		}
// 		objRequest.send();
// 	}
// 	else
// 	{
// 		document.getElementById(strOutPutList).innerHTML = ""
// 	}