<?
	error_reporting(E_ALL);
	session_start();
	header('Content-Type: text/html; charset=utf-8');

	function checkEmail($mail) {
		if (strlen($mail)==0) return true;
		
		if (!preg_match("/^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i",$mail)) {
				return false;
			}
		return true;
	}

	if ($_SESSION["name"]) {
		return;
	}

	// Показываем форму Авторизация
	$isLogin = false;
	// Показываем форму Регистрация
	$isRegister = false;
	// Показываем форму Восстановление пароля
	$isForgot = false;
	//Это POST запрос
	$isPost = false;

	// Общая переменная для хранения email
	$email = '';
	// Флаг, указывающий на валидность
	$emailIsValid = true;
	$loginIsValid = true;

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['seen'])) {
		
		if (isset($_POST['register_form'])) {
			$email = $_POST['reg_email'];
			$login = $_POST['reg_login'];
			$password = $_POST['reg_pass'];
			$repassword = $_POST['reg_repass'];

			$isRegister = true;
		} else if (isset($_POST['login_form'])) {
			$login = $_POST['auth_login'];
			$password = $_POST['auth_pass'];
			$isPost = true;
			$isLogin = true;
		} else if (isset($_POST['forgot_form'])) {
			$email = $_POST['forgot_email'];

			$isForgot = true;
		}

		$emailIsValid = checkEmail($email);
		$loginIsValid = strlen($login) >= 5;
		if ($isForgot) {
			$passIsValid = true;
		} else {
			$passIsValid = strlen($password) >= 4 && $login != $password && ($isRegister ? $password == $repassword : true); 
		}
		
		if ($emailIsValid && $passIsValid) {

			// соединяемся с базой
			$conn = mysql_connect("localhost","nastya4835","4835"); 
			mysql_select_db("mybd"); 

			// составляем запрос
			$query = "select name, email, password, isadmin from users where name = '". $login . "' OR email = '" . $email . "';";
			$mysqlQuery = mysql_query($query);
			// найден ли кто-нибудь 
			$usersCount = mysql_num_rows($mysqlQuery);
			$value = NULL; 
			if ($usersCount != 0) {
				$value=mysql_fetch_array($mysqlQuery);
			}

			if ($isLogin && $value["password"] == $password) {
				// записываем логин и емейл в сессию
				$_SESSION['isadmin'] = $value['isadmin'];
				$_SESSION['name'] = $value['name'];
			} else if ($isRegister) {
				if ($value == NULL) {
					$query = "insert into users (email, name, password) values ('". $email . "', '" . $login . "', '" . $password . "')";
					if (mysql_query($query)) {
						$_SESSION['isadmin'] = 0;
						$_SESSION['name'] = $login;
					}
				} else {
					$badUserName = true;
				}
			} else if ($isForgot && $value != NULL) {
				$to = '=?utf-8?B?'.base64_encode($value["email"]).'?=';
				$subject = '=?utf-8?B?'.base64_encode("Восстановление пароля").'?=';
				$headers  = "Content-type: text/html; charset=utf-8\r\n"; 
				$headers .= "From: Kotova Nastya <kotova4835@gmail.com>\r\n"; 
				$message = "Ваш пароль: " . $value["password"]; 
				if (mail($to, $subject, $message, $headers)) {
					echo "<h3>ПИСЬМО ОТПРАВЛЕНО</h3>";
				} else {
					echo "<h3>ПИСЬМО НЕ ОТПРАВЛЕНО</h3>";
				}
			}

			mysql_close();
		}
	} else {
		$isLogin = true;
	}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
	<? 
		$titlePage = 'Здоровый образ жизни и правильное питание'; 
		include 'header_footer/base_meta.php';
	?>
	<link rel="stylesheet" type="text/css" href="css/semantic.css" />
	<link rel="stylesheet" type="text/css" href="css/styles.css" />
	<link rel="stylesheet" type="text/css" href="css/button_styles.css" />
	<link rel="stylesheet" type="text/css" href="css/font_styles.css" />
	<link rel='stylesheet prefetch' href="form/css/font-awesome.min.css" />
	<link rel="stylesheet" href="form/css/style.css" media="screen" type="text/css" />
	<script type="text/javascript" src="js/jquery-2.2.3.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="js/semantic.js"></script>
</head>

<body topmargin="0">
	<span id="doc_time" class="clock">Дата и время</span>
		<script type="text/javascript"> 
		clock();
		</script>
	<input style="margin: 10px"  id="b1" value="Отличный сайт!" onclick="alert('Спасибо!');" type="button"/>
	<div id="image123" class="center_div">
		<?
			include 'header_footer/header.php';
		?>

		<div class="indicator loading"><img src="images/indicator.gif" alt=""></div>

		<select style="margin: 10px" class="ui dropdown" id="background_page">
			<option value=0>Черный фон</option>
			<option value=1 selected>Белый фон</option>
			<option value=2>Туманно-розовый</option>
			<option value=3>Оливковый</option>
			<option value=4>Желто-зеленый</option>
			<option value=5>Бирюзовый</option>
		</select>
		
		<?
			include 'header_footer/menu.php';

			if ($_SESSION["name"]) {
		?>
		<h2 style="color:#01DF01" >Привет, <?=@ $_SESSION["name"] ?></h2>

		<? 
			} else {
				include 'registration_div';
			}
		?>


















		<script src="form/js/index.js"></script>
		<script type="text/javascript" src="form/js/main.js"></script>

		<div>
			<div>
					<h1 class="green_text"><blink>Правильное питание</blink></h1> 

					<em>Почему важно правильное питание, что мы можем получить в итоге и как действовать, чтобы прийти к желаемому результату...</em>
			</div>

			<div>
				<h2 class="green_text">Какие цели поможет реализовать здоровое питание?</h2>

				<a href="image_viewer.php?image=eda.jpg"><img class="index_img1" alt="Правильное питание" src="images/eda.jpg" title="Правильное питание - почему оно необходимо?" /></a>

				<div id="animate"><p> Питание - это жизненно необходимый процесс для нашего организма, хочешь жить - необходимо питаться. В результате этого процесса мы получаем энергию, строительный материал для обновления (роста) организма, биологические активные питательные вещества, определенное воздействие на психику.</p></div>

				<p><strong>Правильное питание</strong> способно подарить нам здоровье, долголетие и красоту. Оно предполагает, что в организм регулярно, в необходимом количестве и оптимальных соотношениях должны поступать многие питательные вещества - белки, углеводы, жиры, вода, минеральные вещества и <a href="pages/vitamini.php"> <target="_blank" title="Роль витаминов в питании">витамины</a>.</p>

				<p>А недостаток, как и избыток питательных элементов становятся причиной сначала временных неудобств, затем источником развития заболеваний, фактором преждевременного старения и ранней смерти.</p>
				
				<p>Так, дефицит витаминов влияет на здоровье, ум и молодость значительное больше, чем ряд других причин. В основе большинства заболеваний лежит недостаток какого-либо витамина. Неудовлетворительное количество минеральных веществ представляет собой основной механизм старения организма, так же как и процесс обезвоживания. Аналогичным образом действует на организм несбалансированность в рационе других компонентов питания, таких как, углеводы, жиры и белки.</p>
			</div>

			<div>
				<h2 class="green_text">Проблемы питания</h2>

				<p>Достаточно серьезной на сегодняшний день является проблема питания на мировом и государственном уровне. И об этом нужно знать и принимать это во внимание.</p>

				<div class="div_style">
					<a href="image_viewer.php?image=slide_1.jpg"><img class="index_img2 img_style hidden" id="img_1" src="images/slide_1.jpg"></a>
					<a href="image_viewer.php?image=slide_2.jpg"><img class="index_img2 img_style hidden" id="img_2" src="images/slide_2.jpg"></a>
					<a href="image_viewer.php?image=slide_3.jpg"><img class="index_img2 img_style hidden" id="img_3" src="images/slide_3.jpg"></a>
					<a href="image_viewer.php?image=slide_4.jpg"><img class="index_img2 img_style hidden" id="img_4" src="images/slide_4.jpg"></a>
					<a href="image_viewer.php?image=23.jpg"><img class="index_img2 img_style hidden" id="img_5" src="images/23.jpg"></a>
				</div>

				<p>Дефицит необходимых пищевых веществ (витаминов, минеральных веществ, аминокислот и т.д.) связан с рядом причин:

				<ol>
					<li>
						Из-за уменьшения физической активности населения и соответственно снижения энергетических затрат, резко сократилось количество потребляемой пищи (в 2 - 3 раза). То есть вместо 5000 - 6000 ккал потребляется 2000 - 3000 ккал.</li>
					<li>
						Проблема с экологией, с одной стороны, это обеднение почв, с другой - загрязнение окружающей среды. То есть, это приводит к недостатку необходимых биологически активных веществ в продуктах питания для человека и к концентрации токсических веществ в его организме.</li>
					<li>
						Современные технологии производства (пастеризация, консервация, введение гормонов, эмульгирование, рафинирование и т.д.) на всех производственных этапах становятся причиной потери минеральных веществ, витаминов и других биологически ценных элементов. Основная цель данных технологий - увеличить количество, чтобы повысить прибыль производителей, но никак не качество продукции.</li>
					<li>
						Использование высокотемпературных режимов приготовления блюд провоцирует потерю необходимых пищевых веществ. К примеру, рафинирование растительных масел.</li>
					<li>
						Нарушение режима питания и структуры, когда питаются на ходу, жирной, углеводной, однообразной, рафинированной пищей с обильными трапезами в вечернее время.</li>
				</ol>

				<p>В России проблема питания еще больших размеров по сравнению с ведущими развитыми странами. На самом деле достаточно печальная ситуация, но вполне решаемая, если только есть желание и можешь приложить усилия.</p>
				<p>Учеными был найден способ, как восполнить тотальный недостаток питательных веществ в организме людей - были разработаны биологически активные добавки, которые в течение многих десятилетий успешно применяются в ведущих развитых странах мира, среди них Япония, США и другие.</p>
			</div>
		</div>


		<?php if ($_SESSION["name"]) {?>
			<div style="text-align: center">
				<h1 class="green_text">Обратная связь</h1>
			</div>
				<?php
					if (isset($_POST['seen']))
					{
						$fio = trim(htmlspecialchars($_POST["fio"]));
						$el_p = trim(htmlspecialchars($_POST["el_p"]));
						$theme = trim(htmlspecialchars($_POST["theme"]));
						$mes = trim(htmlspecialchars($_POST["message"]));

						$sp_mes = NULL;
						$sp_fio = NULL;
						$sp_elp = NULL;

						$flag = true;

						if (mb_strlen($fio, "UTF-8") < 15)
						{
							$sp_fio.="  Заполните поле 'ФИО'";
							$flag = false;
						}
						if((mb_strlen($el_p, "UTF-8") == 0) || (!preg_match("/^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i",$el_p)))
						{
							$sp_elp.="  Поле 'Электронная почта' не заполнено, либо введен неверный E-Mail.";
							$flag = false;
						}
						if (mb_strlen($mes, "UTF-8") < 10)
						{
							$sp_mes.="  Корректно заполните поле 'Сообщение. Необходимо ввести не менее 10 символов.'";
							$flag = false;
						}

						if ($flag) {
							$from = '=?utf-8?B?'.base64_encode($el_p).'?=';
							$subject = '=?utf-8?B?'.base64_encode($theme).'?=';
							$headers  = "Content-type: text/html; charset=utf-8\r\n"; 
							$headers .= "From: Kotova Nastya <kotova4835@gmail.com>\r\n"; 
							if (mail($from, $subject, $fio . ", " . $mes, $headers)) {
								echo "<h3>ПИСЬМО ОТПРАВЛЕНО</h3>";
								$fio=$el_p=$theme=$mes=NULL;
							} else {
								echo "<h3>ПИСЬМО НЕ ОТПРАВЛЕНО</h3>";
							}
						}
					}
				?>

			<div id="content">
				<form method='post'>
					<p>ФИО*: <br> <input style="width: 200px; border: solid 1px #cccccc;" type="text" name="fio" value="<?=@$fio;?>"></input><span style="background:#FF0000;"><?=@$sp_fio;?></span></p>
					<p>Электронная почта*: <br> <input style="width: 200px; border: solid 1px #cccccc;" type="text" name="el_p" value="<?=@$el_p;?>"></input><span style="background:#FF0000;"><?=@$sp_elp;?></span></p>
					<p>Тема сообщения: <br> <input style="width: 200px; border: solid 1px #cccccc;" type="text" name="theme"></input></p>
					<p>Сообщение*:</p>
					<p><textarea name="message" rows="10" cols="50"><?=@$mes;?></textarea><span style="background:#FF0000;"><?=@$sp_mes;?></span></p>
					<input type="hidden" name="seen" value="data"></input>
					<p><input type="submit"  value="Отправить"></input></p>
				</form>
			</div>
		<?} ?>
		<p><center><a href="<? echo $pathBegin; ?>pages/about.php">О сайте</a></center></p>
	</div>
</body>
</html>