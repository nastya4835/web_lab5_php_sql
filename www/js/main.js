var inputGoodColor = "#476AE8";
var inputBadColor = "#E8444C";
var inputDefaultColor = "#aaa";
var inputRegExp = /\W/;
	
var $password;
var $userName;
var $button;
var $isBackgroundBlue = false;

//Выпадающий список и фон
$(function() {
	// id -- # ;  class -- . ;
	var selector = $("#background_page");
	$("#background_page").change(function() {
		var backgroundPage = $("#image123");
		switch ($("#background_page").val()) {
			case "0": {
				backgroundPage.css ({
					background: "#000"
				});
			} break;
			case "1": {
				backgroundPage.css ({
					background: "#FFF"
				});
			} break;
			case "2": {
				backgroundPage.css ({
					background: "#FFE4E1"
				});
			} break; 
			case "3": {
				backgroundPage.css ({
					background: "#808000"
				});
			} break;
			case "4": {
				backgroundPage.css ({
					background: "#9ACD32"
				});
			} break;
			case "5": {
				backgroundPage.css ({
					background: "#40E0D0"
				});
			} break;
			default: break;
		}
	});
});

//Индикатор загрузки
$(document).ready(function(){
	$("div.indicator").delay(2000).fadeOut(1000);
});

//Мигающий заголовок
$(document).ready(function(){
	$.fn.wait = function(time, type) {
		time = time || 10;
		type = type || "fx";
		return this.queue(type, function() {
			var self = this;
			setTimeout(function() {
				$(self).dequeue();
			}, time);
		});
	};
	function runIt() {
		$("blink").wait()
			.animate({"opacity": 0.1},2000)
			.wait()
			.animate({"opacity": 1},1500,runIt);
	}
	runIt();
});

//Текущая дата и время
function clock() {
var d = new Date();
var month_num = d.getMonth()
var day = d.getDate();
var hours = d.getHours();
var minutes = d.getMinutes();
var seconds = d.getSeconds();
	month = new Array("января", "февраля", "марта", "апреля", "мая", "июня", "июля", "августа", "сентября", "октября", "ноября", "декабря");
	if (day <= 9) day = "0" + day;
	if (hours <= 9) hours = "0" + hours;
	if (minutes <= 9) minutes = "0" + minutes;
	if (seconds <= 9) seconds = "0" + seconds;
		
	date_time = "Сегодня - " + day + " " + month[month_num] + " " + d.getFullYear() + " г.&nbsp;&nbsp;&nbsp;Текущее время - "+ hours + ":" + minutes + ":" + seconds;
		if (document.layers) {
			document.layers.doc_time.document.write(date_time);
			document.layers.doc_time.document.close();
		} else document.getElementById("doc_time").innerHTML = date_time;
		setTimeout("clock()", 1000);
}

//Анимация текста
$(document).ready(function(){
	$.fn.animate_Text = function() {
		var string = this.text();
		return this.each(function(){
			var $this = $(this);
			$this.html(string.replace(/./g, '<span class="new">$&</span>'));
			$this.find('span.new').each(function(i, el){
				setTimeout(function(){ $(el).addClass('div_opacity'); }, 20 * i);
			});
		});
	};
	$('#animate').show();
	$('#animate').animate_Text();
});

//Поворот изображения
$(document).ready(function() {
	$(".rotate1").rotate(45);

	$("#rotate2").rotate({ bind:{
		mouseover:function(){ $(this).rotate({animateTo:90}) },
		mouseout:function(){ $(this).rotate({animateTo:0}) }
	}});

	var angle=0;
	setInterval(function(){
		angle+=3;
		jQuery("#rotate3").rotate(angle);
	},90);
	
});

//Меняющиеся картинки
var img_count = 5;     // число картинок
var time_show = 1500;  // время показа, мс.
var time_change = 15;  // интервал между шагами изменения opacity, мс.
var i = 0;             // переменная итератор
var timeout_id;        // идентификатор таймера изменения значений opacity ()
var opacity_val = 100; // число шагов изменения opacity
var start = 2;         // флаг состояния таймера смены картинок
var play_id;           // идентификатор таймера смены картинок
 
function ChangeImage()
{
	opacity_val--;
	var j = i + 1;
	var current_img = 'img_' + i;
	if (i == img_count) j = 1;
	var next_img = 'img_' + j;
	document.getElementById(current_img).style.opacity=opacity_val/100;
	document.getElementById(current_img).style.filter='alpha(opacity='+opacity_val+')';
	document.getElementById(next_img).style.opacity=(100-opacity_val)/100;
	document.getElementById(next_img).style.filter='alpha(opacity='+(100-opacity_val)+')';
	timeout_id = setTimeout("ChangeImage()", time_change);

	if (opacity_val==99)
	{
		document.getElementById(next_img).style.zIndex = 1000;
	}

	if (opacity_val==1)
	{
		opacity_val = 100;
		document.getElementById(current_img).style.zIndex = -1000;
		clearTimeout(timeout_id);
	}
}

window.onblur = function()
{
	clearInterval(play_id);
	start = 1;
}
 
window.onfocus = function()
{
	if (start==1)
	{
		play_id = setInterval (function() {i++; if (i>img_count) i=1; ChangeImage();}, time_show);
		start = 0;
	}
}

if (start==2)
{
	play_id = setInterval (function() {i++; if (i>img_count) i=1; ChangeImage();}, time_show);
	start = 0;
}


//Проверка на правильность Email
$(document).ready(function() {
	$('#email_id').blur(function() {
		if($(this).val() != '') {
			var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
			if(pattern.test($(this).val())){
				$(this).css({'border' : '1px solid #569b44'});
				$('#valid').text('Верно');
				document.getElementById('check_email').value = 1;
			} else {
				$(this).css({'border' : '1px solid #ff0000'});
				$('#valid').text('Не верно');
				document.getElementById('check_email').value = 0;
			}
		} else {
			$(this).css({'border' : '1px solid #ff0000'});
			$('#valid').text('Поле email не должно быть пустым');
			document.getElementById('check_email').value = 0;
		}
	});
});

//Проверка на правильность Логина
function CountLogin(item) {
// определяем переменную для слоя показа кол-ва введенных символов
var item_view = 'login_view';
// определяем переменную для показа сообщения об ошибке
var item_correct = 'login_correct';
// узнаем кол-во введенных в поле символов и записываем значение в слой показа
document.getElementById(item_view).innerHTML = document.getElementById(item).value.length++; 
// проверяем данные
// если введено  больше 5 символов
	if (document.getElementById(item).value.length >= 5) {
		// записываем в слой сообщений, что все верно
		document.getElementById(item_correct).innerHTML = 'верно';
		// и меняем класс слоя 
		document.getElementById(item_correct).className = 'correct';
		document.getElementById('check_login').value = 1;
	} else {
		// если введено меньше 5 символов, то так и записываем
		document.getElementById(item_correct).innerHTML = 'не менее 5 символов';
		// если введено меньше 5 символов, то так и записываем
		document.getElementById(item_correct).className = 'info';
		document.getElementById('check_login').value = 0;
		}
	checkAll(); 
}

//Проверка на правильность Пароля
function CountPass(item) {
// определяем переменную для слоя показа кол-ва введенных символов
var item_view = 'pass_view';
// определяем переменную для показа сообщения об ошибке
var item_correct = 'pass_correct';
// записываем значение поля логина
var item_login_value = document.getElementById('login_id').value;
// записываем кол-во символов в поле логина
var item_login_length = document.getElementById('login_id').value.length;
// узнаем кол-во введенных в поле символов и записываем значение в слой показа
document.getElementById(item_view).innerHTML = document.getElementById(item).value.length++; 
// проверяем данные
// если пароль совпадает с логином и логин больше 5 символов 
	if (document.getElementById(item).value == item_login_value && item_login_length >= 5) {
		// записываем сообщение об ошибке
		document.getElementById(item_correct).innerHTML = 'пароль совпадает с логином';
		// и меняем класс слоя для показа ошибки
		document.getElementById(item_correct).className = 'acorrect';
		document.getElementById('check_pass').value = 0;
	} else {
				// если пароль не совпадает с логином 
				// если пароль больше 4 символов
		if (document.getElementById(item).value.length >= 4) {
				// то все верно, сообщаем об этом 
			document.getElementById(item_correct).innerHTML = 'верно';
			document.getElementById(item_correct).className = 'correct';
			document.getElementById('check_pass').value = 1;
		} else if (document.getElementById(item).value.length < 4) {
			// если пароль меньше 4 символов
			document.getElementById(item_correct).innerHTML = 'пароль должен содержать от 4 до 20 символов';
			document.getElementById(item_correct).className = 'info';
			document.getElementById('check_pass').value = 0;
		}
	}
	checkAll();
}

//Проверка на правильность Повторите пароль
function CorrectPass(item) {
var item_view = 'true_pass_view';
// записываем в переменную значение введенного пароля
var item_pass_value = document.getElementById('pass_id').value;
// записываем в переменную кол-во символов введенного пароля
var item_pass_length = document.getElementById('pass_id').value.length
// определяем переменную для показа сообщения об ошибке
var item_correct = 'repass_correct';
document.getElementById(item_view).innerHTML = document.getElementById(item).value.length++; 
// проверяем правильно ли введен пароль
	if (item_pass_length >= 4) {
		// проверяем совпадают ли значения введеных паролей
		if (document.getElementById(item).value == item_pass_value) {
				// если совпадают, сообщаем об этом
				document.getElementById(item_correct).innerHTML = 'совпадают';
				document.getElementById(item_correct).className = 'correct';
				document.getElementById('check_repass').value = 1;		
		} 
		// если введенный пароль меньше 4 символов и не совпадает 
		else if (document.getElementById(item).value.length >= 4) {
				document.getElementById(item_correct).innerHTML = 'пароли не совпадают';
				document.getElementById(item_correct).className = 'acorrect';
				document.getElementById('check_repass').value = 0;
		}
	}
	checkAll();
}

//Проверка на заполненность всех полей и Зарегистрироваться
function checkAll() {
var x;
var check_login = document.getElementById('check_login').value;
var check_pass = document.getElementById('check_pass').value;
var check_repass = document.getElementById('check_repass').value;
var check_email = document.getElementById('check_email').value;
		x = check_login + check_pass + check_repass + check_email;
		document.getElementById('check_all').value = x;
	if (document.getElementById('check_all').value == 1111) {
		document.getElementById('submit_id').disabled = false;
	} else {
		document.getElementById('submit_id').disabled = true;
	}
}















								// $button.click(function() {
	
								//     if($userName.val().length < 7) {
								//         alert("Логин должен быть длинее 6 символов");
								//         return false;
								//     }
								//     var hasBadSymbols = inputRegExp.test($userName.val());
								//     if(hasBadSymbols) {
								//         alert("Имя пользователя может модержать только цифры и буквы латинского алфавита");
								//         return false;
								//     }
	
								//     if($password.val().length < 4) {
								//         alert("Пароль должен быть минимум из 4 символов");
								//         return false;
								//     }
	
								//     hasBadSymbols = inputRegExp.test($password.val());
								//     if(hasBadSymbols) {
								//         alert("Пароль может содержать только цифры и буквы латинского алфавита");
								//         return false;
								//     }
	
								//     var login = CryptoJS.MD5('fsdfsdf');
								//     var password = CryptoJS.MD5('sdfsdf');  
								//     alert("Зарегистрировались\nLogin: " + login + "\nPassword: " + password);
								// });
	
// userName
// $(function(){
//         $userName = $("#login_name");
	
//         $userName.focusin(function() {
//             $userName.css({
//                     borderColor: inputGoodColor
//             });
//         });
	
//         $userName.focusout(function() {
//             $userName.css({
//                     borderColor: inputDefaultColor
//             });
//         });
	
//         $userName.keyup(function() {
//             var color = inputGoodColor;
//             if (inputRegExp.test($userName.val())) {
//                 color = inputBadColor;
//             } 
	
//             $userName.css({
//                 borderColor: color
//             });
//         });
// });
	
// // password
// $(function(){
//         $password = $("#login_password");
	
//         $password.focusin(function() {
//             $password.css({
//                     borderColor: inputGoodColor
//             });
//         });
	
//         $password.focusout(function() {
//             $password.css({
//                     borderColor: inputDefaultColor
//             });
//         });
	
//         $password.keyup(function() {
//             $password.css({
	
//             });
//         });
// });