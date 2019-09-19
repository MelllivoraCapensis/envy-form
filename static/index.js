window.onload = function () {
	var form = document.querySelector('form');
	var controls = document.querySelectorAll('form .form-control');
	var infoBox = document.querySelector('form .alert-info');

	for (var control of controls) {
		control.addEventListener('focus', function (e) {
			e.target.closest('.form-group').querySelector(
				'.alert-danger').innerHTML = '';
			infoBox.innerHTML = '';
		});
	}

	form.onsubmit = function (e) {
		e.preventDefault();
		var xhr = new XMLHttpRequest();
		xhr.open('POST', '');
		var data = new FormData(form);
		xhr.send(data);
		xhr.onreadystatechange = function () {
			if(xhr.readyState == 4) {
				if(xhr.status == 201) {
					var successMessage = 
						JSON.parse(xhr.responseText)['message'];
					form.reset();
					infoBox.innerHTML = successMessage;
					return;
				}
				if(xhr.status == 200) {
					var errors = JSON.parse(
						xhr.responseText)['errors'];
					for (var error in errors) {
						form.querySelector(
							`#${error}Input ~ .alert-danger`).innerHTML 
							= errors[error];
					}
					infoBox.innerHTML = 'Error! Post was not sent';
					return;
				}
				if(xhr.status == 400) {
					infoBox.innerHTML = 'Error!Select type of storage!!'
				}

			}
		}

	}
}