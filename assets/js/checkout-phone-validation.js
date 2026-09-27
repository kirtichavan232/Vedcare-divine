document.addEventListener('DOMContentLoaded', function () {
	const validationStore = window.wc?.wcBlocksData?.validationStore;

	if (!validationStore || !window.wp?.data) {
		return;
	}

	const errorId = 'vedcare-indian-phone';

	function getPhoneField() {
		return document.querySelector(
			'input[name="phone"], input[name="billing_phone"]'
		);
	}

	function showPhoneError(field) {
		field.style.borderColor = '#c62828';
		field.style.boxShadow = '0 0 0 1px #c62828';

		let error = document.getElementById('vedcare-phone-error');

		if (!error) {
			error = document.createElement('div');
			error.id = 'vedcare-phone-error';
			error.style.color = '#c62828';
			error.style.fontSize = '14px';
			error.style.marginTop = '6px';
			error.textContent =
				'Please enter a valid 10-digit Indian mobile number.';

			field.parentNode.appendChild(error);
		}
	}

	function clearPhoneError(field) {
		field.style.borderColor = '';
		field.style.boxShadow = '';

		const error = document.getElementById('vedcare-phone-error');

		if (error) {
			error.remove();
		}
	}

	function validatePhone() {
		const field = getPhoneField();

		if (!field) {
			return;
		}

		const phone = field.value.replace(/\D/g, '');
		const validation = window.wp.data.dispatch(validationStore);

		if (!phone) {
			clearPhoneError(field);
			validation.clearValidationError(errorId);
			return;
		}

		if (!/^[6-9][0-9]{9}$/.test(phone)) {
			showPhoneError(field);

			validation.setValidationErrors({
				[errorId]: {
					message:
						'Please enter a valid 10-digit Indian mobile number.',
					hidden: false
				}
			});

			return;
		}

		clearPhoneError(field);
		validation.clearValidationError(errorId);
	}

	document.addEventListener('input', function (event) {
		if (
			event.target.matches('input[name="phone"]') ||
			event.target.matches('input[name="billing_phone"]')
		) {
			validatePhone();
		}
	});

	document.addEventListener('change', function (event) {
		if (
			event.target.matches('input[name="phone"]') ||
			event.target.matches('input[name="billing_phone"]')
		) {
			validatePhone();
		}
	});

	document.addEventListener('click', function () {
		setTimeout(validatePhone, 100);
	});
});