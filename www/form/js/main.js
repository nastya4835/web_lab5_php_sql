$(document).ready(function() {
	$('#email_id_reg').blur(function() { checkEmail('#email_id_reg', '#valid_reg'); });
	$('#email_id_rec').blur(function() { checkEmail('#email_id_rec', '#valid_rec'); });
});

function checkEmail(input, valid_view) {
	if($(input).val() != '') {
		var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
		if(pattern.test($(input).val())){
			$(input).css({'border' : '1px solid #569b44'});
			$(valid_view).text('Верно');
			return true;
		} else {
			$(input).css({'border' : '1px solid #ff0000'});
			$(valid_view).text('Не верно');
		}
	} else {
		$(input).css({'border' : '1px solid #ff0000'});
		$(valid_view).text('Поле email не должно быть пустым');
	}
	return false;
};

function CountLogin(login_id, count_view, correct_view_login, pass_id, correct_view_pass) {
	// pass_id Поле ввода пароля
	// count_view Поле вывода количества символов в пароле
	// correct_view_pass Сообщение для пароля
	// login_id Поле ввода логина
	// correct_view_login Сообщение для логина

	// Обновляем количество введенных символов
	document.getElementById(count_view).innerHTML = document.getElementById(login_id).value.length; 
	// Проверяем данные
	checkPassAndLogin(login_id, pass_id, correct_view_login, correct_view_pass);
}

function CountPass(pass_id, count_view, correct_view_pass, login_id, correct_view_login, repass_id, correct_view_repass) {
	// Обновляем количество введенных символов
	document.getElementById(count_view).innerHTML = document.getElementById(pass_id).value.length; 
	// Проверяем данные
	checkPassAndLogin(login_id, pass_id, correct_view_login, correct_view_pass, repass_id, correct_view_repass);
}

function checkPassAndLogin(login_id, pass_id, correct_view_login, correct_view_pass, repass_id, correct_view_repass) {
	var login_value = document.getElementById(login_id).value;
	var pass_value = document.getElementById(pass_id).value;

	var correctViewLogin = document.getElementById(correct_view_login);
	var correctViewPass = document.getElementById(correct_view_pass);

	// Если логин меньше 4 символов
	if (login_value.length < 5) {
		correctViewLogin.innerHTML = 'не менее 5 символов';
		// меняем класс слоя для показа ошибки
		correctViewLogin.className = 'info';
		return;
	}
	correctViewLogin.innerHTML = 'верно';
	correctViewLogin.className = 'correct';
	
	// если пароль меньше 4 символов
	if (pass_value.length < 4) {
		correctViewPass.innerHTML = 'пароль должен содержать от 4 до 20 символов';
		correctViewPass.className = 'info';
		return;
	}

	// Если логин и пароль совпадают
	if (login_value == pass_value) {
		correctViewPass.innerHTML = 'пароль совпадает с логином';
		correctViewPass.className = 'acorrect';
		return;
	}

	correctViewPass.innerHTML = 'верно';
	correctViewPass.className = 'correct';

	if (repass_id && correct_view_repass) {
		CorrectPass(repass_id, false, correct_view_repass, pass_id);
	}
}

function CorrectPass(repass_id, count_view, correct_view, pass_id) {
	var repass = document.getElementById(repass_id).value;
	var pass = document.getElementById(pass_id).value;

	if (count_view) {
		document.getElementById(count_view).innerHTML = repass.length;
	}

	var correctView = document.getElementById(correct_view);
	if (repass.length != pass.length || repass != pass) {
		correctView.innerHTML = 'пароли не совпадают';
		correctView.className = 'acorrect';
	} else {
		correctView.innerHTML = 'совпадают';
		correctView.className = 'correct';
	}
}

// как проверять заполненность полей при отправке форм

function checkLengthAllFields(login, pass, repass, email) {
	if (login != undefined && !login.length) {
		return false;
	}

	if (pass != undefined && !pass.length) {
		return false;
	}

	if (repass != undefined && !repass.length) {
		return false;
	}

	if (email != undefined && !email.length) {
		return false;
	}

	return true;
}

$(function() {
	$('#auth_form').submit(function(e) {
		// Получаем логин и пароль
		var login = $('#auth_login_id').val();
		var pass = $('#auth_pass_id').val();

		if (!checkLengthAllFields(login, pass)) {
			e.preventDefault()
			alert('Вы должны заполнить все поля');
			return;
		}

		// Проверяем
		if ((login.length < 5 && pass < 4) || login == pass) {
			// Отменяем отправку формы
			e.preventDefault();
			// Выводим сообщение пользователю
			alert('Пара логин/пароль неверна');
			return;
		}
	});

	// Обработка формы регистрации
	$('#reg_form').submit(function(e) {
		var email = $('#email_id_reg').val();
		var login = $('#reg_login_id').val();
		var pass = $('#reg_pass_id').val();
		var repass = $('#reg_repass_id').val();

		if (!checkLengthAllFields(login, pass, repass, email)) {
			e.preventDefault()
			alert('Вы должны заполнить все поля');
			return;
		}

		if (!email.length) {
			e.preventDefault();
			alert('Поле E-mail не должно быть пустым');
			return;
		}

		if (!checkEmail('#email_id_reg', '#valid_reg')) {
			e.preventDefault();
			alert('Ошибка в введенном E-mail');
			return;
		}

		if (login == pass) {
			e.preventDefault();
			alert('Логин и пароль не должны совпадать');
			return;
		}

		if (login.length < 5 || pass < 4) {
			e.preventDefault();
			alert('Логин должен быть длиннее 4 символов. Пароль длиннее 3 символов');
			return;	
		}

		if (pass != repass) {
			// Отменяем отправку формы
			// preventDefault отменяет у обработчика действие по умолчанию
			// У формы действие по умолчанию -- отправиться
			e.preventDefault();
			// Выводим сообщение пользователю
			alert('Пароли не совпадают');
			return;
		}
	}); 

	// Обработка формы восстановления
	$('#rec_form').submit(function(e) {
		var email = $('#email_id_rec').val();

		if (!checkLengthAllFields(undefined, undefined, undefined, email)) {
			e.preventDefault()
			alert('Вы должны заполнить все поля');
			return;
		}

		if (!email.length) {
			e.preventDefault();
			alert('Поле E-mail не должно быть пустым');
			return;
		}

		if (!checkEmail('#email_id_rec', '#valid_rec')) {
			e.preventDefault();
			alert('Ошибка в введенном E-mail');
			return;
		}
	});
});