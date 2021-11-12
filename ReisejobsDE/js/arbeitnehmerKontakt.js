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
btns = document.getElementsByClassName('kontaktbtn')
Array.prototype.forEach.call(btns, function(button) {
	// Do stuff here
	button.onclick = function(){
		let intBewerberID = button.id;

		console.log(intBewerberID)
		document.getElementById('arbeitnehmerid').value = intBewerberID;
		document.getElementById('id01').style.display = 'block';
	}
});

