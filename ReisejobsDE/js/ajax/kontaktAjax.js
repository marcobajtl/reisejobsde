document.querySelectorAll('#submitbtn').forEach(function(objElement)
{
	objElement.addEventListener('click', function()
	{
		let myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
		myModal.toggle();
		let objRequest = new XMLHttpRequest();
		objRequest.open('POST', 'azubi/ReisejobsDE/ajax/KontaktAjax', true);
		objRequest.onreadystatechange = function()
		{
			if(objRequest.readyState === 4 && objRequest.status === 200)
			{
				document.getElementById('name').value       = '';
				document.getElementById('nachname').value   = '';
				document.getElementById('email').value      = '';
				document.getElementById('nachricht').value  = '';
				document.getElementById('honeypot').value   = '';
				document.getElementById('csrf_token').value = '';
				myModal.toggle();
				console.log(this.response)
				if(this.response === "1"){
					document.getElementById('errorbox').style.display = 'block';
				}else{
					document.getElementById('successbox').style.display = 'block';
				}

			}
		};

		let strVorame    = document.getElementById('name').value;
		let strNachname  = document.getElementById('nachname').value;
		let strEmail     = document.getElementById('email').value;
		let strNachricht = document.getElementById('nachricht').value;
		let strHoneypot  = document.getElementById('honeypot').value;
		let strCSRFToken = document.getElementById('csrf_token').value;

		let arrData = JSON.stringify({
			'vorname':   strVorame,
			'nachname':  strNachname,
			'email':     strEmail,
			'nachricht': strNachricht,
			'honeypot':  strHoneypot,
			'CSRFToken': strCSRFToken
		});
		objRequest.send(arrData);
	});
});
